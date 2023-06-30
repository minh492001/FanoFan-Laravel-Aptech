<?php

namespace App\Imports;

use App\Models\Fans;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class FansImport implements ToModel
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Model|Fans|null
     */
    public function model(array $row): Model|Fans|null
    {
        return new Fans([
            'name' => $row[0],
            'product_code' => $row[1],
            'price' => $row[2],
            'description' => $row[3],
            'about' => $row[4],
            'type_id' => $row[5],
            'brand_id' => $row[6],
            'technical_id' => $row[7]
        ]);
    }
}
