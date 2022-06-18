<?php

namespace App\Imports;

use App\Models\InvoiceProvided;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoiceProvidedImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new InvoiceProvided([
            //
        ]);
    }
}
