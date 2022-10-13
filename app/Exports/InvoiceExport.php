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
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;

class InvoiceExport implements FromCollection, WithCustomStartCell, Responsable, WithMapping, WithColumnFormatting, WithHeadings, WithColumnWidths, WithDrawings
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

    public function headings(): array
    {
        return [
            'Serie',
            'Correlativo',
            'Base',
            'IVA',
            'Total',
            'Usuario',
            'Fecha',
        ];
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

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 10,
            'D' => 10,
            'E' => 10,
            'F' => 30,
            'G' => 15,
        ];
    }

    public function drawings()
    {
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(public_path('img/logo.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B2');

        return $drawing;
    }
}
