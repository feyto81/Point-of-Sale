<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Unit;
use DB;
use Storage;
use PDF;
use Auth;

class ItemController extends Controller
{
    public function all_item()
    {
        $item = Item::all();
        return view('product.item.all', compact('item'));
    }

    public function add_item()
    {
        $category = Category::all();
        $unit = Unit::all();
        return view('product.item.add', compact('category', 'unit'));
    }
    public function save_item(Request $request)
    {


        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
        $this->validate($request, [
            'barcode' => 'required|min:2|unique:items',
            'name' => 'required|min:2',
            'category_id' => 'required',
            'unit_id' => 'required',
            'price' => 'required',
            'image' => 'required',
        ], $messages);
        $user_id = Auth::user()->id;
        if (empty($request->file('image'))) {
            Item::create([
                'barcode' => $request->barcode,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'price' => $request->price,

            ]);
        } else {
            Item::create([
                'barcode' => $request->barcode,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'price' => $request->price,
                'image' => $request->file('image')->store('images'),
            ]);
        }
        \LogActivity::addToLog([
            'data' => 'Menambahkan Item ' . $request->name,
            'user' => $user_id,
        ]);
        alert()->success('Item Successfully Added', 'Success');
        return redirect('/itemall');
        // if (empty($request->file('image'))) {
        //     DB::table('items')->insert([
        //         'barcode' => $request->barcode,
        //         'name' => $request->name,
        //         'category_id' => $request->category_id,
        //         'unit_id' => $request->unit_id,
        //         'price' => $request->price,
        //     ]);
        //     alert()->success('Item Failded Added', 'Success');
        // } else {
        //     DB::table('items')->insert([
        //         'barcode' => $request->barcode,
        //         'name' => $request->name,
        //         'category_id' => $request->category_id,
        //         'unit_id' => $request->unit_id,
        //         'price' => $request->price,
        //         'image' => $request->file('image')->store('images'),
        //     ]);
        // }
        // alert()->success('Item Successfully Added', 'Success');
        // return redirect('/itemall');
    }
    public function edit_item($item_id)
    {
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::findOrFail($item_id);
        return view('product.item.edit', compact('item', 'category', 'unit'));
    }

    public function update_item(Request $request, $item_id)
    {
        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique' => 'attribut sama dengan database !!!',
            'numeric' => 'attribut harus diisi dengan angka !!!',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!',
        ];
        $this->validate($request, [
            'barcode' => 'required|min:2',
            'name' => 'required|min:2',
            'category_id' => 'required',
            'unit_id' => 'required',
            'price' => 'required',
        ], $messages);
        $user_id = Auth::user()->id;
        if (empty($request->file('image'))) {
            $item = Item::find($item_id);
            $item->update([
                'barcode' => $request->barcode,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'price' => $request->price,
            ]);
            alert()->error('Item Successfully Updated', 'Success');
        } else {
            $item = Item::find($item_id);
            Storage::delete($item->image);
            $item->update([
                'barcode' => $request->barcode,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'price' => $request->price,
                'image' => $request->file('image')->store('images'),
            ]);
        }
        \LogActivity::addToLog([
            'data' => 'Mengupdate Item ' . $request->name,
            'user' => $user_id,
        ]);
        alert()->success('Item Successfully Updated', 'Success');
        return redirect('/itemall');
    }
    public function delete_item(Request $request,$item_id)
    {
        $item = Item::find($item_id);
        $user_id = Auth::user()->id;
        Storage::delete($item->image);
        \LogActivity::addToLog([
            'data' => 'Menghapus Item ' . $request->name,
            'user' => $user_id,
        ]);
        $item->delete();
        alert()->success('Item Successfully Deleted', 'Success');
        return back();
    }
    public function barcodeqrcode($item_id)
    {
        $row = Item::find($item_id);
        return view('product.item.bq', compact('row'));
    }
    public function print_barcode($item_id)
    {
        $row = Item::find($item_id);
        $pdf = PDF::loadView('product.item.print_barcode', ['row' => $row]);
        return $pdf->stream('Barcode.pdf');
    }
    public function print_qrcode($item_id)
    {
        $data = Item::find($item_id);
        $pdf = PDF::loadView('product.item.print_qrcode', ['data' => $data]);
        return $pdf->stream('QR-Code.pdf');
    }
    public function print_all_barcode()
    {
        $row = Item::all();
        $pdf = PDF::loadView('product.item.all_barcode', ['row' => $row]);
        return $pdf->stream('All Barcode.pdf');
    }
    public function print_all_qrcode()
    {
        $row = Item::all();
        $pdf = PDF::loadView('product.item.all_qrcode', ['row' => $row]);
        return $pdf->stream('All QR-Code.pdf');
    }
}
