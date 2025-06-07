<?php

namespace App\Exports;

use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComprasExport implements FromCollection, WithHeadings
{
    protected $rifa_id;

    public function __construct($rifa_id)
    {
        $this->rifa_id = $rifa_id;
    }

    public function collection()
    {
        return Compra::where('rifa_id', $this->rifa_id)
            ->select('numero', 'nome', 'whatsapp', 'created_at')
            ->orderBy('numero')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Número',
            'Nome',
            'WhatsApp',
            'Data da Compra',
        ];
    }
}