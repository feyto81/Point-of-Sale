<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PemasukanExcel;
use PDF;

class PemasukanController extends Controller
{
    public function getIndexPemasukan()
    {
    	$pemasukan = Pemasukan::all();
    	return view('keuangan.pemasukan.all',compact('pemasukan'));
    }
    public function add_pemasukan(Request $request)
    {
    	$messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
    	$this->validate($request, [
            'pemasukan_count' => 'required|min:2',
            'keterangan' => 'required|min:2',
        ], $messages);
        $user_id = Auth::user()->id;
        $pemasukan = new Pemasukan();
        $pemasukan->pemasukan_count = $request->pemasukan_count;
        $pemasukan->keterangan = $request->keterangan;
        \LogActivity::addToLog([
            'data' => 'Menambahkan Pemasukan ' . $request->pemasukan_count,
            'user' => $user_id,
        ]);
        $result = $pemasukan->save();
        if ($result) {
            alert()->success('Pemasukan Successfully Add', 'Success');
            return back();
        } else {
            alert()->error('Pemasukan Gagal Ditambahkan', 'Berhasil');
            return back();
        }
    }

    public function delete_pemasukan(Request $request,$pemasukan_id)
    {
    	$pemasukan = Pemasukan::find($pemasukan_id);
        $user_id = Auth::user()->id;
        \LogActivity::addToLog([
            'data' => 'Menghapus Pemasukan ' . $pemasukan->pemasukan_count,
            'user' => $user_id,
        ]);
        $pemasukan->delete();
        alert()->success('Pemasukan Successfully Deleted', 'Berhasil');
        return back();
    }
    public function edit_pemasukan($pemasukan_id)
    {
    	$pemasukan = Pemasukan::find($pemasukan_id);
    	return view('keuangan.pemasukan.edit',compact('pemasukan'));
    }
    public function update_pemasukan(Request $request, $pemasukan_id)
    {
    	$messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
    	$this->validate($request, [
            'pemasukan_count' => 'required|numeric',
            'keterangan' => 'required|min:2',
            
        ], $messages);
        $user_id = Auth::user()->id;
        $pemasukan = Pemasukan::find($pemasukan_id);
        $pemasukan->pemasukan_count = $request->get('pemasukan_count');
        $pemasukan->keterangan = $request->get('keterangan');
        \LogActivity::addToLog([
            'data' => 'Mengupdate Pemasukan ' . $request->pemasukan_count,
            'user' => $user_id,
        ]);
        $aks = $pemasukan->save();
        if ($aks) {
            alert()->success('Pemasukan Successfully Updated', 'Success');
            return redirect('/finance/pemasukan/all');
        } else {
            return back();
        }
    }
    public function export_excel()
    {
        return Excel::download(new PemasukanExcel,'Pemasukan.xlsx');
    }
    public function export_pdf()
    {   
        $pemasukan = Pemasukan::all();
        $pdf = PDF::loadView('export.pemasukan_pdf',compact('pemasukan'));
        return $pdf->stream('Pemasukan.pdf');
    }
}
