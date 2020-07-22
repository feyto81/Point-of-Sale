@extends('layouts.master')
@section('title','Add Stock In | Kasir')
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
      <li><a class="treeview-item" href="{{url('/sales/all')}}"><i class="icon fa fa-circle-o"></i> Sales</a></li>
      <li><a class="treeview-item active" href="{{url('/stock-in/all')}}"><i class="icon fa fa-circle-o"></i> Stock In</a></li>
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
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Add Stock In</h1>
          <p>Fill items carefully</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="{{url('/add-barang')}}">Add Stock In</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form action="{{url('/stock-in/save-stock-in')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                  <div class="form-group col-md-5{{$errors->has('date') ? 'has-error' : '' }}">
                    <label for="date">Date *</label>
                    <input type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" id="date" required>
                    @if($errors->has('date'))
                    <span class="text-danger">
                        <small>{{$errors->first('date')}}</small>
                    </span>
                    @endif
                  </div>
                </div>
                 <div class="row">
                  <div class="form-group col-md-5{{$errors->has('date') ? 'has-error' : '' }}">
                    <label for="barcode">Barcode *</label>
                    <input type="hidden" name="item_id[]" id="item_id">
                    <input type="text" name="barcode" id="barcode" class="form-control" required autofocus>
                  </div>
                   <div class="col-md-2">
                        <div class="form-group">
                            <label></label>
                            <button style="margin-top: 29px;margin-left: -32px" class="btn btn-success" type="button"  data-toggle="modal" data-target="#modal-item"><i class="fa fa-search"></i> </button> 
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-5{{$errors->has('item_name') ? 'has-error' : '' }}">
                    <label for="item_name">Item Name</label>
                    <input type="text" class="form-control" name="item_name" id="item_name" required readonly="">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-3{{$errors->has('unit_name') ? 'has-error' : '' }}">
                    <label for="unit_name">Unit Name</label>
                    <input type="text" class="form-control" name="unit_name" id="unit_name" required readonly="">
                  </div>
                  <div class="form-group col-md-2{{$errors->has('stock') ? 'has-error' : '' }}">
                    <label for="stock">Initial Stock</label>
                    <input type="text" class="form-control" name="stock" id="stock" value="-" required readonly="">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-3{{$errors->has('supplier_id') ? 'has-error' : '' }}">
                    <label for="supplier_id">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-control demoSelect">
                    <option disabled selected>--Select Supplier-- </option>
                      @foreach ($supplier as $row)
                        <option value="{{$row->supplier_id}}">{{$row->name}}</option>
                      @endforeach
                      </select>
                  </div>
                  <div class="form-group col-md-2{{$errors->has('qty') ? 'has-error' : '' }}">
                    <label for="qty">Qty *</label>
                    <input type="number" class="form-control" name="qty[]" id="qty" value="" required >
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-5{{$errors->has('detail') ? 'has-error' : '' }}">
                    <label for="detail">Detail *</label>
                    <input type="text" class="form-control" name="detail" placeholder="kulakan / tambahan / etc" id="detail" value="" required >
                  </div>
                </div>
              
            <div class="tile-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
              <a href="{{url('/stock-in/all')}}" class="btn btn-warning btn-flat">
                  <i class="fa fa-backward"></i> Back
                </a>
              </div>
            </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </main>
<!--  <div class="modal fade" id="modal-item">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <h4 class="modal-title">Select Product Item</h4>
          <span aria-hidden="true">&times;</span>
        </button>
       
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped" id="table1">
          <thead>
            <tr>
              <th>Barcode</th>
              <th>Name</th>
              <th>Unit</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div> -->
<div class="modal"  tabindex="-1" role="dialog"  id="modal-item">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Product Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped" id="sampleTable">
          <thead>
            <tr>
              <th>Barcode</th>
              <th>Name</th>
              <th>Unit</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($item as $data)
              <tr>
                <td>{{$data->barcode}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->unit_name}}</td>
                <td>{{$data->price}}</td>
                <td>{{$data->stock}}</td>
                <td class="text-right">
                  <button class="btn btn-info btn-xs" id="select"
                   data-id="{{$data->item_id}}"
                   data-barcode="{{$data->barcode}}"
                   data-name="{{$data->name}}"
                   data-unit="{{$data->unit_name}}"
                   data-stock="{{$data->stock}}">
                    <i class="fa fa-check"></i> Select
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

    @include('sweetalert::alert')
@endsection
@push('bottom')

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#select', function() {
      var item_id = $(this).data('id');
      var barcode = $(this).data('barcode');
      var name = $(this).data('name');
      var unit_name = $(this).data('unit');
      var stock = $(this).data('stock');
      $('#item_id').val(item_id);
      $('#barcode').val(barcode);
      $('#item_name').val(name);
      $('#unit_name').val(unit_name);
      $('#stock').val(stock);
      $('#modal-item').modal('hide');
    })
  })
</script>

@endpush