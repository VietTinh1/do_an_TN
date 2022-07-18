<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class exportExcelInvoice implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
        {
            $headings = [
                ['a'],
                ['b'],
                ['c']
            ];

            return $headings;
        }
    public function collection()
    {
        return Invoice::with('invoiceDetail')->get();
    }
}
