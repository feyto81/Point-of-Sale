<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Pemasukan;

class PemasukanExcel implements FromCollection,WithMapping,WithHeadings
{
    public function collection()
    {
        return Pemasukan::all();
    }
    public function map($pemasukan): array
    {
    	return [
    		$pemasukan->pemasukan_count,
    		$pemasukan->keterangan
    		
    	];
    }
    public function headings(): array
    {
    	return [
    		'Pemasukan',
    		'Keterangan'
    
    	];
    }
}
