<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SupplierExcel;
use PDF;
use App\Imports\SupplierImport;

class SupplierController extends Controller
{
    public function getAddsupplier()
    {
        return view('supplier.add');
    }

    public function saveAddsupllier(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
        $this->validate($request, [
            'name' => 'required|min:2|unique:suppliers',
            'phone' => 'required|min:2|numeric',
            'address' => 'required',
            'description' => 'required',
        ], $messages);
        $user_id = Auth::user()->id;
        $supplier = new Supplier;
        $supplier->fill($request->all());
        \LogActivity::addToLog([
            'data' => 'Menambahkan Supplier ' . $request->name,
            'user' => $user_id,
        ]);
        $result = $supplier->save();
        if ($result) {
            alert()->success('Supplier Successfully Added', 'Success');
            return redirect('/supplier/all');
        } else {
            alert()->error('Supplier Failed Added', 'Error');
            return back();
        }
    }

    public function getIndexsupplier()
    {

        $supplier = Supplier::all();
        return view('supplier.all', compact('supplier'));
    }

    public function getEditsupplier($supplier_id)
    {
        $supplier = Supplier::findOrFail($supplier_id);
        return view('supplier.edit', compact('supplier'));
    }
    public function getupdatesupplier(Request $request, $supplier_id)
    {
        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
        $this->validate($request, [
            'name' => 'required|min:2',
            'phone' => 'required|min:2|numeric',
            'address' => 'required',
            'description' => 'required',
        ], $messages);
        $user_id = Auth::user()->id;
        $supplier = Supplier::find($supplier_id);
        $supplier->fill($request->all());
         \LogActivity::addToLog([
            'data' => 'Mengupdate Supplier ' . $request->name,
            'user' => $user_id,
        ]);
        $supplier->update();
        alert()->success('Supplier Successfully Updated', 'Success');
        return redirect('/supplier/all');
    }

    public function getdeletecategory(Request $request,$supplier_id)
    {
        $user_id = Auth::user()->id;
        $supplier = Supplier::find($supplier_id);
        \LogActivity::addToLog([
            'data' => 'Menghapus Supplier ' . $supplier->name,
            'user' => $user_id,
        ]);
        $supplier->delete();
        alert()->success('Supplier Successfully Deleted', 'Success');
        return back();
    }
    public function export_excel()
    {
        return Excel::download(new SupplierExcel,'Supplier.xlsx');
    }
    public function export_pdf()
    {   
        $supplier = Supplier::all();
        $pdf = PDF::loadView('export.supplier_pdf',compact('supplier'));
        return $pdf->stream('Supplier.pdf');
    }
    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_supplier',$nama_file);

        // import data
        Excel::import(new SupplierImport, public_path('/file_supplier/'.$nama_file));

        // notifikasi dengan session
        alert()->success('Import Success', 'Success');

        // alihkan halaman kembali
        return redirect()->back();
    }
}
