@extends('layouts.master')
@section('title','All User | Kasir')
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
          <h1><i class="fa fa-th-list"></i> All User</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">User</li>
          <li class="breadcrumb-item active"><a href="#">All User</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="button" style="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>
          Add User
    </button>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Level</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($user as $all)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$all->username}}</td>
                        <td>{{$all->name}}</td>
                        <td>{{$all->address}}</td>
                        <td>{{$all->Level->name}}</td>
                        <td>
                            <a href="{{url('/user/edit-user/'.$all->id)}}" title="Edit Data" class="btn btn-primary btn-sm"><i class="fa fa-pencil fa-sm"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete"  title="Hapus Data" user-id="{{$all->id}}"><i class="fas fa-sm fa fa-trash"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('sweetalert::alert')
    </main>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{url('/user/add')}}" method="POST">
                  {{csrf_field()}}
              <div class="form-group{{$errors->has('name') ? 'has-error' : '' }}">
                <label for="validationServer033">Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="">
                @if($errors->has('name'))
                  <span class="text-danger">
                    <small>{{$errors->first('name')}}</small>
                  </span>
                @endif
              </div>
              <div class="form-group{{$errors->has('username') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Username</label>
                <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                @if($errors->has('username'))
                  <span class="text-danger">
                    <small>{{$errors->first('username')}}</small>
                  </span>
                @endif
              </div>
              
              <div class="form-group{{$errors->has('password') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                 @if($errors->has('password'))
                  <span class="text-danger">
                    <small>{{$errors->first('password')}}</small>
                  </span>
                @endif
              </div>
               <div class="form-group{{$errors->has('passwordconf') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Password Confirmation</label>
                <input name="passwordconf" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
                 @if($errors->has('passwordconf'))
                  <span class="text-danger">
                    <small>{{$errors->first('passwordconf')}}</small>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="">Address</label>
                <textarea name="address" class="form-control" rows="3"></textarea>
                 @if($errors->has('address'))
                  <span class="text-danger">
                    <small>{{$errors->first('address')}}</small>
                  </span>
                @endif
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1">Level</label>
                <select name="level_id" id="level_id" class="form-control demoSelect" required="">
                    <option disabled selected>--Select Level-- </option>
                      @foreach ($level as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                      @endforeach
                      </select>
                   @if($errors->has('level_id'))
                  <span class="text-danger">
                    <small>{{$errors->first('level_id')}}</small>
                  </span>
                @endif
              </div>
              
              
            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Submit</button>
                </form>
              </div>
            </div>
            @include('sweetalert::alert')

          </div>
@endsection
@push('bottom')
    <script type="text/javascript">
          $('.btn-delete').click(function(){
            var user_id = $(this).attr('user-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Yakin Mau Dihapus',
                text: "Mau dihapus data User ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  window.location = "/user/delete/"+user_id+"";
                } else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                  )
                }
              })
          });
              
    </script>
@endpush