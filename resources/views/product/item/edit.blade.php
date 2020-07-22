@extends('layouts.master')
@section('title','Edit Item | Kasir')
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
  <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Products</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('/categoryall')}}"><i class="icon fa fa-circle-o"></i> Categories</a></li>
      <li><a class="treeview-item" href="{{url('/unitall')}}"><i class="icon fa fa-circle-o"></i> Units</a></li>
      <li><a class="treeview-item active" href="{{url('/itemall')}}"><i class="icon fa fa-circle-o"></i> Items</a></li>

    </ul>
  </li>
   @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '2')
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('/sales/all')}}"><i class="icon fa fa-circle-o"></i> Sales</a></li>
      <li><a class="treeview-item" href="{{url('/stock-in/all')}}"><i class="icon fa fa-circle-o"></i> Stock In</a></li>
      <li><a class="treeview-item" href="{{url('/stock-out/all')}}"><i class="icon fa fa-circle-o"></i> Stock Out</a></li>

    </ul>
  </li>
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
          <h1><i class="fa fa-dashboard"></i> Edit Item</h1>
          <p>Fill items carefully</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="">Edit Item</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Edit Item</h3>
            <div class="tile-body">
              <form role="form" action="{{url('/update-item/'.$item->item_id)}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-md-6{{$errors->has('barcode') ? 'has-error' : '' }}">
                        <label for="barcode">Barcode *</label>
                        <input type="text" class="form-control" name="barcode" id="barcode" value="{{$item->barcode}}">
                        @if($errors->has('barcode'))
                        <span class="text-danger">
                            <small>{{$errors->first('barcode')}}</small>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6{{$errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Name *</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$item->name}}">
                        @if($errors->has('name'))
                        <span class="text-danger">
                            <small>{{$errors->first('name')}}</small>
                        </span>
                        @endif
                    </div>
                    
                </div>
                <div class="row">
                    <div class="form-group col-md-6{{$errors->has('category_id') ? 'has-error' : '' }}">
                        <label class="control-label" for="category_id">Category</label>
                        <select name="category_id" class="form-control demoSelect" id="category_id">
                          <option disabled selected>-- Select Category -- </option>
                          @foreach ($category as $row)
                          <option @if($row->category_id==$item->category_id) selected @endif value="{{ $row->category_id}}">{{$row->name }}</option>
                        @endforeach
                        </select>
                        @if($errors->has('category_id'))
                        <span class="text-danger">
                            <small>{{$errors->first('category_id')}}</small>
                        </span>
                        @endif
                      </div>
                      <div class="form-group col-md-6{{$errors->has('unit_id') ? 'has-error' : '' }}">
                        <label class="control-label" for="unit_id">Unit</label>
                        <select name="unit_id" class="form-control demoSelect" id="unit_id">
                          <option disabled selected>-- Select Unit -- </option>
                          @foreach ($unit as $row)
                          <option @if($row->unit_id==$item->unit_id) selected @endif value="{{ $row->unit_id}}">{{$row->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('unit_id'))
                        <span class="text-danger">
                            <small>{{$errors->first('unit_id')}}</small>
                        </span>
                        @endif
                      </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6{{$errors->has('price') ? 'has-error' : '' }}">
                        <label for="price">Price *</label>
                        <input type="text" class="form-control" name="price" id="price" value="{{$item->price}}">
                        @if($errors->has('price'))
                        <span class="text-danger">
                            <small>{{$errors->first('price')}}</small>
                        </span>
                        @endif
                    </div>
                    
                </div>
                <div class="row">
                    <div class="form-group col-md-6{{$errors->has('image') ? 'has-error' : '' }}">
                        <label for="image">Image *</label>
                        <?php
                        if($item->image != null) { ?>
                            <div style="margin-bottom: 4px">
                                <img src="{{asset('uploads/'.$item->image)}}" style="width: 100%;" >
                             </div>
                            <?php
                          } ?>
                        
                        <input type="file" class="form-control" name="image" id="image">
                        <small>(Biarkan kosong jika tidak ada)</small>
                        @if($errors->has('image'))
                        <span class="text-danger">
                            <small>{{$errors->first('image')}}</small>
                        </span>
                     @endif
                    </div>
                </div>
                
            </div>
            <div class="tile-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
              <a href="{{url('/categoryall')}}" class="btn btn-warning btn-flat">
                  <i class="fa fa-backward"></i> Back
                </a>
            </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    @include('sweetalert::alert')

    </main>
@endsection
