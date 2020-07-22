<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KeuanganController extends Controller
{
    public function getIndexAkumulasi()
    {
    	$pemasukan1 = DB::table('pemasukans')->sum('pemasukan_count');
    	$pengeluaran = DB::table('pengeluarans')->sum('pengeluaran_count');
    	$penjualan = DB::table('sales')->sum('final_price');

    	return view('keuangan.all.index',compact('pemasukan','pengeluaran','penjualan'));
    }
}
