<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;
use Auth;
use App\Cart;
use App\Sale;

class TransactionController extends Controller
{
    public function all_sales()
    {
        $max = DB::table('sales')->where('sale_id', \DB::raw("(select max(`sale_id`) from sales)"))->pluck('sale_id');
        $check_max = DB::table('sales')->count();
        if ($check_max == null) {
            $max_code = "INV000001";
        } else {
            $max_code = $max[0];
            $max_code++;
        }
        $item = DB::table('items')
            ->join('units', 'items.unit_id', '=', 'units.unit_id')
            ->select('items.*', 'units.*', 'units.name as unit_name')
            ->get();
        $customer = Customer::all();
        $cart = Cart::all();
        return view('transaction.sales.all', compact('customer', 'max_code', 'item', 'cart'));
    }
    public function NoTransaksi()
    {
        $max = DB::table('sales')->where('sale_id', \DB::raw("(select max(`sale_id`) from sales)"))->pluck('sale_id');
        $check_max = DB::table('sales')->count();
        if ($check_max == null) {
            $max_code = "INV000001";
        } else {
            $max_code = $max[0];
            $max_code++;
        }
        return $max_code;
    }
    public function get()
    {
        $cart = Cart::orderby('cart_id','DESC')->get();
        return view('transaction.sales.getDataTable', compact('cart'));
    }
    public function save_cart(Request $request)
    {
        $user_id = Auth::user()->id;
        $cek_stock = $request->stock;
        $customer_id = $request->customer_id;
        $qty = $request->qty;
        $total = $qty * $request->price;
        
        $pdata = new Cart;
        $pdata->item_id = $request->item_id;
        $pdata->transaction_code = self::NoTransaksi();
        $pdata->price = $request->price;
        $pdata->qty = $request->qty;
        $pdata->total = $total;
        $pdata->user_id = $user_id;
        $pdata->customer_name = $request->customer_name;
        $result = $pdata->save();
        echo "sukses";
           
    }

    public function delete_cart($cart_id)
    {
        $cart = Cart::find($cart_id);
        $cart->delete();
        echo "sukses";
        // alert()->success('Cart Successfully Deleted', 'Success');
        // return back();
    }

    public function kirim_semua(Request $request)
    {
        $customer_id = $request->customer_id;
        $sale_id = $request->sale_id;
        $user_id = Auth::user()->id;
        DB::table('sales')->insert([
            'sale_id' => self::NoTransaksi(),
            'total_price' => $request->sub_total,
            'discount' => $request->discount,
            'final_price' => $request->grand_total,
            'cash' => $request->cash,
            'remaining' => $request->change,
            'note' => $request->note,
            'date' => $request->date,
            'user_id' => $user_id,
        ]);
        \LogActivity::addToLog([
            'data' => 'Menambahkan Transaksi ',
            'user' => $user_id,
        ]);
        $select = DB::table('carts')->get();

        foreach ($select as $s) {
            DB::table('sale_details')->insert([
                'sale_id' => $s->transaction_code,
                'item_id' => $s->item_id,
                'price' => $s->price,
                'qty' => $s->qty,
                'customer_name' => $s->customer_name,
                'discount_item' => $s->discount_item,
                'total' => $s->total,

            ]);
        }

        foreach ($select as $s) {
            DB::table('carts')->truncate([
                'sale_id' => $s->transaction_code,
                'item_id' => $s->item_id,
                'price' => $s->price,
                'qty' => $s->qty,
                'discount_item' => $s->discount_item,
                'total' => $s->total,
                'customer_name' => $s->customer_name,
            ]);
        }

        $detailtransaksi = DB::table('sale_details')->where('sale_id',  $sale_id)
            ->join('items', function ($join) {
                $join->on('sale_details.item_id', '=', 'items.item_id');
            })->get();
        $us = DB::table('sales')->where('sale_id', $sale_id)->get();
        $data = DB::table('sales')->where('sale_id',  $sale_id)
            ->join('users', function ($join) {
                $join->on('sales.user_id', '=', 'users.id');
            })->get();
        // $l = Sale::where('sale_id', $sale_id)->get();
        return view('transaction.sales.detail', compact('data', 'detailtransaksi', 'us'));
    }
    public function print($sale_id)
    {
        $detailtransaksi = DB::table('sale_details')->where('sale_id',  $sale_id)
            ->join('items', function ($join) {
                $join->on('sale_details.item_id', '=', 'items.item_id');
            })->get();
        $data = DB::table('sales')->where('sale_id',  $sale_id)
            ->join('users', function ($join) {
                $join->on('sales.user_id', '=', 'users.id');
            })->get();
        return view('transaction.sales.print', compact('data', 'detailtransaksi'));
    }

    public function update(Request $r, $cart_id)
    {
        $cart = Cart::find($cart_id);
        $cart->price = $r->input('price');
        $cart->qty = $r->input('qty');
        $cart->discount_item = $r->input('discount_item');
        $cart->total = $r->input('total');
        $cart->save();
        echo "sukses";
    }
}
