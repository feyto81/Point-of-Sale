@extends('layouts.master')
@section('title','Profile | Kasir')
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
  <li><a class="app-menu__item" href="{{url('/user/all')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a></li>
  @endif
  @if(auth()->user()->level_id == '1' || auth()->user()->level_id == '2' || auth()->user()->level_id == '3')
   <li><a class="app-menu__item active" href="{{url('/profile')}}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Profile</span></a></li>
   @endif
   @if(auth()->user()->level_id == '1')
   <li><a class="app-menu__item" href="{{url('/logActivity')}}"><i class="app-menu__icon fa fa-bookmark"></i><span class="app-menu__label">Log Activity</span></a></li>
   @endif
</ul>
@endsection
@section('content')
<main class="app-content">
    <div class="row user">
      <div class="col-md-12">
        <div class="profile">
          <div class="info"><img class="user-img" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg">
            <h4>{{Auth()->user()->name}}</h4>
               <span class="badge badge-success">{{Auth::user()->Level->name}}</span>
          </div>
          <div class="cover-image"></div>
        </div>
      </div>
      <br>
      <div class="row">>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Update Password</h3>
            <div class="tile-body">
              <form action="{{url('/update-password')}}" method="post">
                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group{{$errors->has('oldPassword') ? 'has-error' : '' }}">
                  <label for="oldPassword">Current Password</label>
                  <input type="text" class="form-control" name="oldPassword" id="oldPassword" placeholder="Enter Old Password">
                  @if($errors->has('oldPassword'))
                  <span class="text-danger">
                      <small>{{$errors->first('oldPassword')}}</small>
                  </span>
                   @endif
                </div>
                 <div class="form-group{{$errors->has('newPassword')?' has-error':''}}">
                    <label class="control-label" for="newPassword">New Password</label>
                    <input class="form-control" name="newPassword" id="newPassword" type="password"  placeholder="Enter New Password" value="">
                    @if($errors->has('newPassword'))
                      <span class="text-danger">
                          <small>{{$errors->first('newPassword')}}</small>
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
              
            <div class="tile-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
              <a href="{{url('/profile')}}" class="btn btn-warning btn-flat">
                  <i class="fa fa-backward"></i> Reload
                </a>
              </div>
            </div>
              </form>
            </div>
            
          </div>
        </div>
        <br><br>
        <div class="col-md-6" style="margin-top: 20px">
          <div class="tile">
            <h3 class="tile-title">Update Profile</h3>
            <div class="tile-body">
              <form action="{{url('/update-profile')}}" method="post">
               @csrf
                @foreach($profile as $value)
                <div class="row mb-4">
                  <div class="col-md-4">
                    <label>Name</label>
                    <input class="form-control" name="name" value="{{$value->name}}" type="text">
                    <span class="text-danger">{{$errors->first('name')}}</span>
                  </div>
                  <div class="col-md-4">
                    <label>Username</label>
                    <input class="form-control" name="username" type="text" value="{{$value->username}}">
                    <span class="text-danger">{{$errors->first('username')}}</span>
                  </div>
                  <div class="col-md-4">
                    <label>Address</label>
                    <input class="form-control" name="address" type="text" value="{{$value->address}}">
                    <span class="text-danger">{{$errors->first('address')}}</span>
                  </div>
                </div>
               
                @endforeach
                <div class="row mb-10">
                  <div class="col-md-12">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Update</button>
                  </div>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
@push('bottom')
    <script type="text/javascript">
          $('.btn-delete').click(function(){
            var item_id = $(this).attr('item-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Yakin Mau Dihapus',
                text: "Mau dihapus data Item",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  window.location = "/delete-item/"+item_id+"";
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