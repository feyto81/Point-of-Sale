<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Pengeluaran;

class PengeluaranExcel implements FromCollection,WithMapping,WithHeadings
{
    public function collection()
    {
        return Pengeluaran::all();
    }
    public function map($pengeluaran): array
    {
    	return [
    		$pengeluaran->pengeluaran_count,
    		$pengeluaran->keterangan
    		
    	];
    }
    public function headings(): array
    {
    	return [
    		'Pengeluaran',
    		'Keterangan'
    
    	];
    }
}
