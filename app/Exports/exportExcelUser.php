<?php

namespace App\Exports;

use App\Models\UserDB;
use Maatwebsite\Excel\Concerns\FromCollection;

class exportExcelUser implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserDB::all();
    }
}
