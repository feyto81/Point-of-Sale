@extends('layouts.master')
@section('title','Invoice | Kasir')
@section('menu')
<ul class="app-menu">
  @if(auth()->user()->level_id == '1')
  <li><a class="app-menu__item" href="{{url('/home')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-truck"></i><span class="app-menu__label">Supplier</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('/supplier/addsupplier')}}"><i class="icon fa fa-circle-o"></i> Add Supplier</a></li>
      <li><a class="treeview-item" href="{{url('/supplier/all')}}"><i class="icon fa fa-circle-o"></i> All Supplier</a></li>
    </ul>
  </li>
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Customer</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('/customer/addcustomer')}}"><i class="icon fa fa-circle-o"></i> Add Customer</a></li>
      <li><a class="treeview-item" href="{{url('/customer/all')}}"><i class="icon fa fa-circle-o"></i> All Customer</a></li>
    </ul>
  </li>
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Products</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('/categoryall')}}"><i class="icon fa fa-circle-o"></i> Categories</a></li>
      <li><a class="treeview-item" href="{{url('/unitall')}}"><i class="icon fa fa-circle-o"></i> Units</a></li>
      <li><a class="treeview-item" href="{{url('/itemall')}}"><i class="icon fa fa-circle-o"></i> Items</a></li>

    </ul>
  </li>
  @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '2')
  <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item active" href="{{url('/sales/all')}}"><i class="icon fa fa-circle-o"></i> Sales</a></li>
      <li><a class="treeview-item" href="{{url('/stock-in/all')}}"><i class="icon fa fa-circle-o"></i> Stock In</a></li>
      <li><a class="treeview-item" href="{{url('/stock-out/all')}}"><i class="icon fa fa-circle-o"></i> Stock Out</a></li>

    </ul>
  </li>
  @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '2')
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-usd"></i><span class="app-menu__label">Finance</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      
      <li><a class="treeview-item" href="{{url('/finance/pengeluaran/all')}}"><i class="icon fa fa-circle-o"></i> Pengeluaran</a></li>
      <li><a class="treeview-item" href="{{url('/finance/akumulasi/all')}}"><i class="icon fa fa-circle-o"></i> Akumulasi</a></li>
    </ul>
  </li>
  @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '3')
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('/report/day')}}"><i class="icon fa fa-circle-o"></i> Day</a></li>
      <li><a class="treeview-item" href="{{url('/report/month')}}"><i class="icon fa fa-circle-o"></i> Month</a></li>
      <li><a class="treeview-item" href="{{url('/report/year')}}"><i class="icon fa fa-circle-o"></i> Year</a></li>

    </ul>
  </li>
  @endif
  @if(auth()->user()->level_id == '1')
  <li><a class="app-menu__item" href="{{url('/user/all')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a></li>
  @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '2' || auth()->user()->level_id == '3')
   <li><a class="app-menu__item" href="{{url('/profile')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Profile</span></a></li>
   @endif
   @if(auth()->user()->level_id == '1')
   <li><a class="app-menu__item" href="{{url('/logActivity')}}"><i class="app-menu__icon fa fa-bookmark"></i><span class="app-menu__label">Log Activity</span></a></li>
   @endif
</ul>
@endsection
@section('content')
<title>Detail | Kasir</title>
<style>
.table {
  border-collapse: collapse;
  width: 100%;
}

.td {
  color:black;
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#f5f5f5;}
</style>
<main class="app-content">
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <section class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header"><i class="fa fa-globe"></i> Invoice</h2>
            </div>
            <div class="col-6">
                    @foreach ($data as $k)
                     <h5 class="text-right">Date: {{$k->created}}</h5>
                
              
            </div>
          </div>
          <div class="row invoice-info">
           
            <div class="col-4"><b>Invoice : {{$k->sale_id}}</b><br><b> Kasir&nbsp;&nbsp;&nbsp;&nbsp;     :  {{$k->name}}</b> <br></div>
            <br>
            @endforeach
            @foreach($detailtransaksi as $row)
                <div class="col-8"><b>Customer Name : {{$row->customer_name}}</b><br><b></div>
            @endforeach


        </div>
          
          <br>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($detailtransaksi as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->name}}</td>
                        <td class="td">{{$row->qty}}</td>
                        <td class="td">{{$row->price}}</td>
                        <td class="td">{{$row->total}}</td>

                    </tr>
                    @endforeach
                    @foreach ($data as $l)
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Total Semua Barang : </td>
                        <td class="td">{{$l->total_price}}</td>
                        <input type="hidden" id="" value="{{$l->total_price}}">
                    </tr>
                    
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Diskon : </td>
                        <td class="td">{{$l->discount}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->discount}}">
                    </tr>
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Total Kesuluruhan : </td>
                        <td class="td">{{$l->final_price}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->final_price}}">
                    </tr>
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Bayar : </td>
                        <td class="td">{{$l->cash}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->cash}}">
                    </tr>
                    
                    
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Kembalian : </td>
                        <td class="td">{{$l->remaining}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->remaining}}">
                    </tr>
                    <tr>
                        <td colspan="4" class="td" style="text-align:right">Note : </td>
                        <td class="td">{{$l->note}}</td>
                        <input type="hidden" id="jumlah" value="{{$l->note}}">
                    </tr>
                    
                </tbody>
              </table>
            </div>
          </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="/sale/cetak/{{$l->sale_id}}" target="_blank"><i class="fa fa-print"></i> Print</a>
                <a href="/sales/all" class="btn btn-danger"><i class="fa fa-backward"></i>Back</a></div>
           
          </div>
        </section>
        @endforeach

      </div>
    </div>
  </div>

</main>
@endsection