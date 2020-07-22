<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;

class SupplierImport implements ToModel
{
    public function model(array $row)
    {
        return new Supplier([
            'name' => $row[0],
            'phone' => $row[1], 
            'address' => $row[2],
            'description' => $row[3], 

        ]);
    }
}
