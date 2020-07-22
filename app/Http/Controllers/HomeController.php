<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Customer;
use App\Supplier;
use App\Category;
use App\Unit;
use App\Item;
use App\Sale;
use DB;

class HomeController extends Controller
{
    

    public function index()
    {
        $user = User::count();
        $customer = Customer::count();
        $supplier = Supplier::count();
        $category = Category::count();
        $unit = Unit::count();
        $item = Item::count();
        $sales = Sale::count();
        $pemasukan1 = DB::table('sales')->sum('final_price');
        $pemasukan2 = DB::table('pemasukans')->sum('pemasukan_count');
        $pemasukan = $pemasukan1;
        $pengeluaran = DB::table('pengeluarans')->sum('pengeluaran_count');
        $laba = $pemasukan-$pengeluaran;
        //bulan
        $data = DB::table("sales")->select(DB::raw('EXTRACT(MONTH FROM created) AS Bulan, SUM(final_price) as Pendapatan'))
        ->groupBy(DB::raw('EXTRACT(MONTH FROM created)'))
        ->get();
        //tahun
        $tahun = DB::table("sales")->select(DB::raw('EXTRACT(YEAR FROM created) AS Tahun, SUM(final_price) as Pendapatan1'))
        ->groupBy(DB::raw('EXTRACT(YEAR FROM created)'))
        ->get();
        
        return view('home',compact('user','customer','supplier','category','unit','item','sales','pemasukan','pengeluaran','laba','data','tahun'));
    }
    public function login()
    {
        return view('login.login');
    }
    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('name', 'password'))) {
            alert()->success('Welcome To Kasir Aplication', 'Success');
            return redirect('/home');
        }
        toastr()->error('Maaf Cek Kembali Username Dan Password', 'Gagal');
        return redirect('/login');
    }
    public function logout()
    {
        Auth::logout();
        toastr()->success('Anda Berhasil Logout', 'Berhasil');
        return redirect('/login');
    }
    public function ApiLaporanBulanan()
    {
        $data = DB::table("sales")->select(DB::raw('EXTRACT(MONTH FROM created) AS Bulan, SUM(final_price) as Pendapatan'))
        ->groupBy(DB::raw('EXTRACT(MONTH FROM created)'))
        ->get();
        return response()->json($data);

        //Cara Akses
        dd($data[0]->Bulan);
    }
    public function logActivity()
    {
        $logs = DB::table('log_activity')
            ->leftJoin('users', 'log_activity.user_id', '=', 'users.id')
            ->select('log_activity.*', 'users.name')
            ->get();
        $user = User::all();
        $logs = \LogActivity::logActivityLists();
        return view('logactivity.index', compact('logs', 'user'));
    }
}
