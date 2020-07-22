<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\Item;
use App\Supplier;
use DB;
use Auth;
use App\StockOut;
use Alert;

class StockController extends Controller
{
    public function all_stock_in()
    {
        $stock = Stock::all();
        return view('transaction.stock_in.all', compact('stock'));
    }
    public function add_stock_in()
    {
        // $item = Item::all();
        $user_id = Auth::user()->id;
        $supplier = Supplier::all();
        $item = DB::table('items')
            ->join('units', 'items.unit_id', '=', 'units.unit_id')
            ->select('items.*', 'units.*', 'units.name as unit_name')
            ->get();
        return view('transaction.stock_in.add', compact('item', 'supplier'));
    }

    public function save_stock_in(Request $request)
    {
        $user_id = Auth::user()->id;

        for ($a = 0; $a < count($request->item_id); $a++) {

            DB::table('stock')->insert([
                'item_id' =>  $request->item_id[$a],
                'type' => 'in',
                'detail' => $request->detail,
                'supplier_id' => $request->supplier_id,
                'qty' => $request->qty[$a],
                'date' => $request->date,
                'user_id' => $user_id
            ]);
            \LogActivity::addToLog([
                'data' => 'Menambahkan Stock In ',
                'user' => $user_id,
            ]);
            alert()->success('Stock In Successfully Added', 'Success');
            return redirect('/stock-in/all');
        }
    }
    public function delete_stock_in($stock_id)
    {
        $stock = Stock::find($stock_id);
        $user_id = Auth::user()->id;
        \LogActivity::addToLog([
                'data' => 'Menghapus Stock In ' . $stock->item_id,
                'user' => $user_id,
            ]);
        $stock->delete();
        alert()->success('Stock Successfully Deleted', 'Success');
        return back();
    }

    public function all_stock_out()
    {
        $stockout = StockOut::all();
        return view('transaction.stock_out.all', compact('stockout'));
    }

    public function add_stock_out()
    {
        // $item = Item::all();
        $user_id = Auth::user()->id;
        $supplier = Supplier::all();
        $item = DB::table('items')
            ->join('units', 'items.unit_id', '=', 'units.unit_id')
            ->select('items.*', 'units.*', 'units.name as unit_name')
            ->get();
        return view('transaction.stock_out.add', compact('item', 'supplier'));
    }
    public function save_stock_out(Request $request)
    {
        $user_id = Auth::user()->id;
        $cek_stock = $request->stock;
        $qty = $request->qty;

        if ($cek_stock > $qty) {
            $data = new StockOut;
            $data->item_id = $request->item_id;
            $data->type = 'out';
            $data->detail = $request->detail;
            $data->supplier_id = $request->supplier_id;
            $data->qty = $request->qty;
            $data->date = $request->date;
            $data->user_id = $user_id;
            $result = $data->save();
            if ($result) {
                alert()->success('Stock Out Successfully Add', 'Success');
                return redirect('/stock-out/all');
            } else {
                alert()->error('Stock Out Gagal Ditambahkan', 'Berhasil');
                return back();
            }
        }
        \LogActivity::addToLog([
                'data' => 'Menambahkan Stock Out ' . $request->item_id,
                'user' => $user_id,
        ]);
        alert()->error('Stock Out Melebihi Stock Awal', 'Error');
        return back();
    }
    public function delete_stock_out($stockout_id)
    {
        $stock = StockOut::find($stockout_id);
        $user_id = Auth::user()->id;
        \LogActivity::addToLog([
                'data' => 'Menghapus Stock Out ' . $stock->item_id,
                'user' => $user_id,
        ]);
        $stock->delete();
        alert()->success('Stock Out Successfully Deleted', 'Success');
        return back();
    }
}
