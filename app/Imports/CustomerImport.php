<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomerImport implements ToModel
{
    public function model(array $row)
    {
        return new Customer([
            'name' => $row[0],
            'gender' => $row[1], 
            'phone' => $row[2],
            'address' => $row[3], 

        ]);
    }
}
