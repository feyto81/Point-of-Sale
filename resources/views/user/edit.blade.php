@extends('layouts.master')
@section('title','Edit User | Kasir')
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
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('/sales/all')}}"><i class="icon fa fa-circle-o"></i> Sales</a></li>
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
  <li><a class="app-menu__item active" href="{{url('/user/all')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a></li>
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
          <h1><i class="fa fa-dashboard"></i> Edit User</h1>
          <p>Fill items carefully</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="">Edit User</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Edit User</h3>
            <div class="tile-body">
              <form role="form" action="{{url('/user/update-user/'.$user->id)}}" method="post">
                {{ csrf_field() }}
                <div class="form-group{{$errors->has('name') ? 'has-error' : '' }}">
                  <label class="control-label">Name</label>
                  <input class="form-control" name="name" id="name" type="text" placeholder="Enter Name" value="{{$user->name}}">
                  @if($errors->has('name'))
                    <span class="text-danger">
                        <small>{{$errors->first('name')}}</small>
                    </span>
                  @endif
                </div>
                <div class="form-group{{$errors->has('username') ? 'has-error' : '' }}">
                  <label class="control-label">Username</label>
                  <input class="form-control" name="username" id="username" type="text" placeholder="Enter Name" value="{{$user->username}}">
                  @if($errors->has('username'))
                    <span class="text-danger">
                        <small>{{$errors->first('username')}}</small>
                    </span>
                  @endif
                </div>
                  <div class="form-group{{$errors->has('level_id') ? 'has-error' : '' }}">
                    <label class="control-label">Level</label>
                     <select name="level_id" class="form-control demoSelect" id="level_id">
                          <option disabled selected>-- Select Level -- </option>
                          @foreach ($level as $row)
                          <option @if($row->id==$user->level_id) selected @endif value="{{ $row->id}}">{{$row->name }}</option>
                        @endforeach
                        </select>
                        @if($errors->has('level_id'))
                        <span class="text-danger">
                            <small>{{$errors->first('level_id')}}</small>
                        </span>
                        @endif
                  </div>
                  <div class="form-group{{$errors->has('password') ? 'has-error' : '' }}">
                    <label class="control-label">Password</label>
                    <input class="form-control" name="password" id="password" type="password" placeholder="Enter Password" value="">
                    <small>Biarkan kosong jika tidak ingin mengubah password</small>
                    @if($errors->has('password'))
                      <span class="text-danger">
                          <small>{{$errors->first('password')}}</small>
                      </span>
                    @endif
                  </div>
                  <div class="form-group{{$errors->has('confPassword')?' has-error':''}}">
                    <label class="control-label" for="confPassword">Confirm Password</label>
                    <input class="form-control" name="confPassword" id="confPassword" type="password"  placeholder="Enter Conf Password" value="">
                    @if($errors->has('confPassword'))
                      <span class="text-danger">
                          <small>{{$errors->first('confPassword')}}</small>
                      </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="">Address</label>
                    <textarea name="address" class="form-control" rows="3">{{$user->address}}</textarea>
                     @if($errors->has('address'))
                      <span class="text-danger">
                        <small>{{$errors->first('address')}}</small>
                      </span>
                    @endif
                    
              </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                    &nbsp;&nbsp;&nbsp;
                    <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                <a href="{{url('/all-user')}}" class="btn btn-primary"><i class="fa fa-backward"></i>Back</a>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    @include('sweetalert::alert')

    </main>
@endsection
