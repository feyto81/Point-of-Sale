<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Supplier;

class SupplierExcel implements FromCollection,WithMapping,WithHeadings
{
    public function collection()
    {
        return Supplier::all();
    }
    public function map($supplier): array
    {
    	return [
    		$supplier->name,
    		$supplier->phone,
    		$supplier->address,
    		$supplier->description
    	];
    }
    public function headings(): array
    {
    	return [
    		'Supplier Name',
    		'Phone',
    		'Address',
    		'Description'
    	];
    }
}
