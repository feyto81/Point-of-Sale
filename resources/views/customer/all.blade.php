@extends('layouts.master')
@section('title','All Customer | Kasir')
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
  <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Customer</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item" href="{{url('/customer/addcustomer')}}"><i class="icon fa fa-circle-o"></i> Add Customer</a></li>
      <li><a class="treeview-item active" href="{{url('/customer/all')}}"><i class="icon fa fa-circle-o"></i> All Customer</a></li>
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
          <h1><i class="fa fa-th-list"></i> All Customer</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Customer</li>
          <li class="breadcrumb-item active"><a href="#">All Customer</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="{{url('/customer/addcustomer')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Customer</a>&nbsp;
          <a href="{{url('/customer/export-excel')}}" class="btn btn-sm btn-info"><i class="fa fa-file-excel-o"></i> Export Excel</a>&nbsp;
          <a href="{{url('/customer/export-pdf')}}" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> Export PDF</a>&nbsp;
          <a href=""  data-toggle="modal" data-target="#importexcel" class="btn btn-sm btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Import Excel</a>&nbsp;
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
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($customer as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        @if($item->gender=='laki-laki')
                        <td>Laki-laki</td>
                        @else
                        <td>Perempuan</td>
                        @endif
                        <td>{{$item->phone}}</td>
                        <td>{{$item->address}}</td>
                        <td>
                          <a title="Detail Data" id="set_dtl" class="btn btn-warning btn-sm" 
                              data-toggle="modal" data-target="#modal-detail"
                              data-name="{{$item->name}}"
                              data-gender="{{$item->gender}}"
                              data-phone="{{$item->phone}}"
                              data-address="{{$item->address}}"
                              data-created="{{$item->created_at}}"
                              data-updated="{{$item->updated_at}}">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{url('/customer/edit-customer/'.$item->customer_id)}}" title="Edit Data" class="btn btn-primary btn-sm"><i class="fa fa-pencil fa-sm"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete"  title="Hapus Data" customer-id="{{$item->customer_id}}"><i class="fas fa-sm fa fa-trash"></i></a>
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
<div class="modal"  tabindex="-1" role="dialog"  id="modal-detail">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Supplier Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped" id="sampleTable">
          <tbody>
            <tr>
              <th style="width: 35%">Supplier Name</th>
              <td><span id="name"></span></td>
            </tr>
            <tr>
              <th style="">Phone</th>
              <td><span id="phone"></span></td>
            </tr>
            <tr>
              <th style="">Address</th>
              <td><span id="address"></span></td>
            </tr>
            <tr>
              <th style="">Gender</th>
              <td><span id="gender"></span></td>
            </tr>
            <tr>
              <th style="">Created</th>
              <td><span id="created"></span></td>
            </tr>
            <tr>
              <th style="">Updated</th>
              <td><span id="updated"></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="importexcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{url('/customer/import-excel')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="validationServer033">Upload Customer</label>
                   <input class="form-control"  type="file" name="file" required="required">
                   <small>(File Harus berupa xlsx,xlx,csv)</small>
                   @if($errors->has('file'))
                    <span class="text-danger">
                      <small>{{$errors->first('file')}}</small>
                    </span>
                  @endif
                    
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
            var customer_id = $(this).attr('customer-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Yakin Mau Dihapus',
                text: "Mau dihapus data Customer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  window.location = "/customer/delete-customer/"+customer_id+"";
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
          $(document).ready(function() {
            $(document).on('click', '#set_dtl', function() {
              var name = $(this).data('name');
              var phone = $(this).data('phone');
              var gender = $(this).data('gender');
              var address = $(this).data('address');
              var created = $(this).data('created');
              var updated = $(this).data('updated');
              $('#name').text(name);
              $('#phone').text(phone);
              $('#address').text(address);
              $('#gender').text(gender);
              $('#created').text(created);
              $('#updated').text(updated);

            })
          })
              
    </script>
@endpush