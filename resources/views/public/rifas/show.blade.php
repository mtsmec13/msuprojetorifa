{{-- Esta view usa o layout mestre para manter o design --}}
<x-app-layout>
    <style>
        .number-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(50px, 1fr)); gap: 12px; }
        .number-btn { transition: all 0.2s ease-in-out; aspect-ratio: 1 / 1; display: flex; align-items: center; justify-content: center; font-weight: 700; border-radius: 50%; cursor: pointer; border: 2px solid transparent; }
        .number-btn.disponivel { background-color: #374151; color: #d1d5db; border-color: #4b5563; }
        .number-btn.disponivel:hover { background-color: #4b5563; transform: scale(1.08); }
        .number-btn.selecionado { background-color: #2563eb; color: white; transform: scale(1.1); border-color: #3b82f6; box-shadow: 0 0 15px rgba(59, 130, 246, 0.5); }
        .number-btn.vendido { background-color: #1f2937; color: #4b5563; cursor: not-allowed; text-decoration: line-through; }
        .checkout-footer { transition: transform 0.3s ease-in-out; transform: translateY(100%); }
        .checkout-footer.visible { transform: translateY(0); }
        .modal { display: none; /* Escondido por padrão */ }
        .modal.is-open { display: flex; /* Mostra o modal */ }
    </style>

    <div class="container mx-auto max-w-4xl p-4 pb-32">

        <!-- CARD DO PRÉMIO -->
        <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-lg p-6 md:p-8 text-center mb-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-blue-400 mb-3">{{ $rifa->nome }}</h1>
            <p class="text-gray-400 mb-4 max-w-2xl mx-auto">
                {{ $rifa->descricao }}
            </p>

            {{-- **NOVA SEÇÃO ADICIONADA** --}}
            @if($rifa->data_sorteio)
            <div class="flex items-center justify-center space-x-2 text-yellow-400 font-semibold mb-6">
                <i data-feather="calendar" class="w-5 h-5"></i>
                <span>Sorteio: {{ \Carbon\Carbon::parse($rifa->data_sorteio)->format('d/m/Y \à\s H:i') }}</span>
            </div>
            @endif

            <div class="bg-gray-900 rounded-xl p-4 inline-block">
                <p class="text-lg font-bold text-white">
                    R$ {{ number_format($rifa->preco, 2, ',', '.') }} <span class="font-normal text-gray-400">por número</span>
                </p>
            </div>
        </div>
        
        <!-- CARD DA SELEÇÃO DE NÚMEROS -->
        <div class="bg-gray-800 border border-gray-700 rounded-2xl shadow-lg p-6 md:p-8">
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
                <h2 class="text-2xl font-bold text-white">Escolha seus números da sorte</h2>
                <div class="flex items-center space-x-3 text-xs sm:text-sm">
                    <div class="flex items-center space-x-2"><div class="w-4 h-4 rounded-full bg-gray-700"></div><span>Disponível</span></div>
                    <div class="flex items-center space-x-2"><div class="w-4 h-4 rounded-full bg-blue-600"></div><span>Selecionado</span></div>
                    <div class="flex items-center space-x-2"><div class="w-4 h-4 rounded-full bg-gray-800 border-2 border-gray-600"></div><span>Vendido</span></div>
                </div>
            </div>
            
            <div id="number-grid" class="number-grid">
                {{-- O JavaScript vai popular esta área --}}
            </div>
        </div>
    </div>

    <!-- MODAL 1: ESCOLHA (Entrar / Registar / Convidado) - SÓ APARECE SE NÃO ESTIVER LOGADO -->
    <div id="choice-modal" class="modal fixed inset-0 bg-black bg-opacity-70 items-center justify-center p-4 z-50">
        <div class="bg-gray-800 rounded-2xl shadow-xl w-full max-w-md p-8 text-center">
            <i data-feather="user-check" class="w-16 h-16 text-blue-500 mx-auto mb-4"></i>
            <h3 class="text-2xl font-bold text-white mb-4">Como deseja continuar?</h3>
            <p class="text-gray-400 mb-8">Poupe tempo fazendo login ou participe rapidamente como convidado.</p>
            <div class="flex flex-col space-y-4">
                <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-lg">Entrar na minha conta</a>
                <button type="button" id="continue-as-guest-btn" class="w-full bg-gray-600 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-lg">Continuar sem cadastro</button>
                <a href="{{ route('register') }}" class="text-sm text-gray-400 hover:text-white pt-2">Não tenho uma conta, quero criar uma</a>
            </div>
        </div>
    </div>
    
    <!-- MODAL 2: INFORMAÇÕES DO CONVIDADO -->
    <div id="guest-info-modal" class="modal fixed inset-0 bg-black bg-opacity-70 items-center justify-center p-4 z-50">
        <div class="bg-gray-800 rounded-2xl shadow-xl w-full max-w-md p-8">
            <h3 class="text-2xl font-bold text-white mb-4">Finalizar como Convidado</h3>
            <p class="text-gray-400 mb-6">Por favor, preencha seus dados para gerar o PIX.</p>
            <form id="guest-info-form">
                <div class="mb-4">
                    <label for="nome" class="block text-gray-300 text-sm font-bold mb-2">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" class="w-full bg-gray-700 border border-gray-600 rounded-lg py-2 px-3 text-white focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="mb-6">
                    <label for="whatsapp" class="block text-gray-300 text-sm font-bold mb-2">WhatsApp:</label>
                    <input type="tel" id="whatsapp" name="whatsapp" placeholder="(XX) XXXXX-XXXX" class="w-full bg-gray-700 border border-gray-600 rounded-lg py-2 px-3 text-white focus:outline-none focus:border-blue-500" required>
                </div>
                <div class="flex items-center justify-between">
                    <button type="button" id="cancel-guest-info" class="text-gray-400 hover:text-white">Voltar</button>
                    <button type="submit" id="submit-guest-info" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded-lg">Gerar PIX</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- MODAL 3: EXIBIÇÃO DO PIX -->
    <div id="pix-modal" class="modal fixed inset-0 bg-black bg-opacity-70 items-center justify-center p-4 z-50">
        <div class="bg-gray-800 rounded-2xl shadow-xl w-full max-w-md p-8 text-center">
            <h3 class="text-2xl font-bold text-green-400 mb-2">Pague com PIX</h3>
            <p class="text-gray-400 mb-4">Aponte a câmara do seu telemóvel para o QR Code ou use o código abaixo.</p>
            <img id="pix-qr-code-img" src="" alt="PIX QR Code" class="mx-auto my-4 border-4 border-white rounded-lg">
            <textarea id="pix-copia-cola" class="w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-xs text-white break-all" rows="4" readonly></textarea>
            <button id="copy-pix-code" class="mt-2 text-sm text-blue-400 hover:text-blue-300">Copiar Código</button>
            <div class="mt-6">
                <p class="text-lg font-bold text-white">Valor: <span id="pix-valor"></span></p>
                <p class="text-sm text-red-400">Expira em: <span id="pix-countdown">15:00</span></p>
            </div>
             <button type="button" id="close-pix-modal" class="mt-6 bg-gray-600 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded-lg">Fechar</button>
        </div>
    </div>

    <!-- FOOTER DE CHECKOUT FLUTUANTE -->
    <div id="checkout-footer" class="checkout-footer fixed bottom-0 left-0 right-0 bg-gray-800/80 backdrop-blur-sm border-t border-gray-700 shadow-2xl z-50">
        <div class="container mx-auto max-w-4xl p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-400">Total</p>
                    <p id="total-price" class="text-2xl font-bold text-white">R$ 0,00</p>
                </div>
                <button id="buy-button" class="bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all duration-200 ease-in-out disabled:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                    Participar com <span id="selected-count">(0)</span> números
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- VERIFICA SE O UTILIZADOR ESTÁ LOGADO (vindo do PHP) ---
            const isUserLoggedIn = @json(auth()->check());

            // --- DADOS DA RIFA (vindo do PHP) ---
            const rifaData = {
                quantidade: {{ $rifa->quantidade_numeros }},
                preco: {{ $rifa->preco }},
                numerosVendidos: @json($rifa->numeros->where('status', '!=', 'Disponivel')->pluck('numero')->all())
            };

            // --- ELEMENTOS DO DOM ---
            const numberGrid = document.getElementById('number-grid');
            const checkoutFooter = document.getElementById('checkout-footer');
            const totalPriceEl = document.getElementById('total-price');
            const selectedCountEl = document.getElementById('selected-count');
            const buyButton = document.getElementById('buy-button');
            const choiceModal = document.getElementById('choice-modal');
            const guestInfoModal = document.getElementById('guest-info-modal');
            const pixModal = document.getElementById('pix-modal');
            const continueAsGuestBtn = document.getElementById('continue-as-guest-btn');
            const cancelGuestInfoBtn = document.getElementById('cancel-guest-info');
            const guestInfoForm = document.getElementById('guest-info-form');
            const qrCodeImg = document.getElementById('pix-qr-code-img');
            const copiaColaEl = document.getElementById('pix-copia-cola');
            const copyPixBtn = document.getElementById('copy-pix-code');
            const pixValorEl = document.getElementById('pix-valor');
            const pixCountdownEl = document.getElementById('pix-countdown');
            const closePixModalBtn = document.getElementById('close-pix-modal');
            
            let selectedNumbers = [];
            const soldNumbersSet = new Set(rifaData.numerosVendidos);
            let countdownInterval;

            // --- FUNÇÕES DE GERAÇÃO DA GRADE E SELEÇÃO DE NÚMEROS ---
            function generateGrid() {
                let gridHtml = '';
                for (let i = 0; i < rifaData.quantidade; i++) {
                    let numberStatus = soldNumbersSet.has(i) ? 'vendido' : 'disponivel';
                    gridHtml += `<button type="button" class="number-btn ${numberStatus}" data-number="${i}">${String(i).padStart(3, '0')}</button>`;
                }
                numberGrid.innerHTML = gridHtml;
            }
            
            numberGrid.addEventListener('click', function(event) {
                const target = event.target;
                if (target.classList.contains('number-btn') && !target.classList.contains('vendido')) {
                    toggleNumberSelection(target);
                }
            });

            function toggleNumberSelection(element) {
                const number = parseInt(element.dataset.number);
                element.classList.toggle('selecionado');
                if (element.classList.contains('selecionado')) {
                    selectedNumbers.push(number);
                } else {
                    selectedNumbers = selectedNumbers.filter(n => n !== number);
                }
                updateFooter();
            }

            function updateFooter() {
                const count = selectedNumbers.length;
                checkoutFooter.classList.toggle('visible', count > 0);
                totalPriceEl.textContent = `R$ ${(count * rifaData.preco).toFixed(2).replace('.', ',')}`;
                selectedCountEl.textContent = `(${count})`;
                buyButton.disabled = count === 0;
            }

            // --- LÓGICA DO FLUXO DE COMPRA ---
            buyButton.addEventListener('click', function() {
                if (selectedNumbers.length === 0) return;
                if (isUserLoggedIn) {
                    handlePixGeneration();
                } else {
                    choiceModal.classList.add('is-open');
                }
            });

            continueAsGuestBtn.addEventListener('click', () => {
                choiceModal.classList.remove('is-open');
                guestInfoModal.classList.add('is-open');
            });

            cancelGuestInfoBtn.addEventListener('click', () => {
                guestInfoModal.classList.remove('is-open');
            });

            guestInfoForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handlePixGeneration();
            });

            async function handlePixGeneration() {
                const submitBtn = document.getElementById('submit-guest-info');
                if(submitBtn) submitBtn.disabled = true;
                buyButton.disabled = true;
                buyButton.textContent = 'Aguarde...';

                let requestBody = { numeros_selecionados: JSON.stringify(selectedNumbers) };
                if (!isUserLoggedIn) {
                    requestBody.nome = document.getElementById('nome').value;
                    requestBody.whatsapp = document.getElementById('whatsapp').value;
                }

                try {
                    const response = await fetch("{{ route('rifa.reservar', $rifa) }}", {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify(requestBody)
                    });
                    const data = await response.json();
                    if (!response.ok) throw new Error(data.error || 'Erro no servidor.');
                    
                    guestInfoModal.classList.remove('is-open');
                    displayPixModal(data);
                } catch (error) {
                    alert(`Erro: ${error.message}`);
                } finally {
                    if(submitBtn) submitBtn.disabled = false;
                    buyButton.disabled = false;
                    buyButton.innerHTML = `Participar com <span id="selected-count">${selectedNumbers.length}</span> números`;
                }
            }

            function displayPixModal(data) {
                qrCodeImg.src = data.qr_code;
                copiaColaEl.value = data.copia_cola;
                pixValorEl.textContent = data.valor;
                pixModal.classList.add('is-open');
                startCountdown(data.expira_em);
            }

            function startCountdown(expiration) {
                const endTime = new Date(expiration).getTime();
                countdownInterval = setInterval(() => {
                    const now = new Date().getTime();
                    const distance = endTime - now;
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    if (distance < 0) {
                        clearInterval(countdownInterval);
                        pixCountdownEl.textContent = "EXPIRADO";
                    } else {
                        pixCountdownEl.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                    }
                }, 1000);
            }

            copyPixBtn.addEventListener('click', () => { copiaColaEl.select(); document.execCommand('copy'); alert('Código PIX copiado!'); });
            closePixModalBtn.addEventListener('click', () => { pixModal.classList.remove('is-open'); clearInterval(countdownInterval); location.reload(); });

            // --- INICIALIZAÇÃO ---
            generateGrid();
            updateFooter();
            feather.replace();
        });
    </script>
</x-app-layout>

