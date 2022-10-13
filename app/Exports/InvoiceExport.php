<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class InvoiceExport implements FromCollection, WithCustomStartCell, Responsable, WithMapping, WithColumnFormatting
{
    use Exportable;

    private $filters;
    private $fileName = 'invoices.xlsx';
    private $writerType = Excel::XLSX;
    private $startCell = 'A10';

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Invoice::filter($this->filters)->get();
    }

    public function startCell(): string
    {
        return 'A10';
    }

    public function map($invoice): array
    {
        return [
            $invoice->serie,
            $invoice->correlative,
            $invoice->base,
            $invoice->iva,
            $invoice->total,
            $invoice->user->name,
            Date::dateTimeToExcel($invoice->created_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => 'dd/mm/yyyy',
        ];
    }
}
