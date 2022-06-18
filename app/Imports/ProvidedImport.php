<?php

namespace App\Imports;

use App\Models\Provided;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Prophecy\Call\Call;

class ProvidedImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Provided([
            'tax_code' => $row[0],
            'name' => $row[1],
            'email' => $row[2],
            'phone' => $row[3],
            'address' => $row[4],
            'notes' => $row[5],
            'created_at' =>Carbon::now(),
        ]);
    }
}
