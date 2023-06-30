<?php

namespace App\Exports;

use App\Models\Fans;
use Maatwebsite\Excel\Concerns\FromCollection;

class FansExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fans::all();
    }
}
