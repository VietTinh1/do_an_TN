<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Provided;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Price;

class exportExcelProvided implements FromCollection
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'name',
            'tax_code',
            'email',
            'phone',
            'address',
            'notes',
            'status',
        ];
    }
    public function collection()
    {
       return Provided::all();
    }

}
