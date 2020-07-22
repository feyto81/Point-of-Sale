<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerExcel;
use PDF;
use App\Imports\CustomerImport;

class CustomerController extends Controller
{
    public function getAddcustomer()
    {
        return view('customer.add');
    }
    public function saveAddcustomer(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => ':attribut sama dengan database !!!',
            'numeric' => ':attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
        $this->validate($request, [
            'name' => 'required|min:2|unique:suppliers',
            'phone' => 'required|min:2|numeric',
            'address' => 'required',
            'gender' => 'required',
        ], $messages);
        $user_id = Auth::user()->id;
        $customer = new Customer;
        $customer->fill($request->all());
        \LogActivity::addToLog([
            'data' => 'Menambahkan Customer ' . $request->name,
            'user' => $user_id,
        ]);
        $result = $customer->save();
        if ($result) {
            alert()->success('Customer Successfully Added', 'Success');
            return redirect('/customer/all');
        } else {
            alert()->error('Customer Failed Added', 'Error');
            return back();
        }
    }

     public function getIndexcustomer()
    {

        $customer = Customer::all();
        return view('customer.all', compact('customer'));
    }
    public function getEditcustomer($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        return view('customer.edit', compact('customer'));
    }
    public function getupdatecustomer(Request $request, $customer_id)
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
            'gender' => 'required',
            'phone' => 'required|min:2|numeric',
            'address' => 'required',
        ], $messages);
        $user_id = Auth::user()->id;
        $customer = Customer::find($customer_id);
        $customer->fill($request->all());
        \LogActivity::addToLog([
            'data' => 'Mengupdate Customer ' . $request->name,
            'user' => $user_id,
        ]);
        $customer->update();
        alert()->success('Customer Successfully Updated', 'Success');
        return redirect('/customer/all');
    }

    public function getdeletecustomer(Request $request,$customer_id)
    {
        $customer = Customer::find($customer_id);
        $user_id = Auth::user()->id;
        \LogActivity::addToLog([
            'data' => 'Menghapus Customer ' . $request->name,
            'user' => $user_id,
        ]);
        $customer->delete();
        alert()->success('Customer Successfully Deleted', 'Success');
        return back();
    }
    public function export_excel()
    {
        return Excel::download(new CustomerExcel,'Customer.xlsx');
    }
    public function export_pdf()
    {   
        $customer = Customer::all();
        $pdf = PDF::loadView('export.customer_pdf',compact('customer'));
        return $pdf->stream('Customer.pdf');
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
        $file->move('file_customer',$nama_file);

        // import data
        Excel::import(new CustomerImport, public_path('/file_customer/'.$nama_file));

        // notifikasi dengan session
        alert()->success('Import Success', 'Success');

        // alihkan halaman kembali
        return redirect()->back();
    }
}
