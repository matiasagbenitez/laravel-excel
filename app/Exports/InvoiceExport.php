<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class InvoiceExport implements FromCollection, WithCustomStartCell, Responsable
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
}
