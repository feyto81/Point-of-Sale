@extends('layouts.master')
@section('title','Report Day | Kasir')
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
  <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item active" href="{{url('/report/day')}}"><i class="icon fa fa-circle-o"></i> Day</a></li>
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
          <h1><i class="fa fa-th-list"></i> Report Day</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Report</li>
          <li class="breadcrumb-item active"><a href="#">Day</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <div class="tile-body">
                    <form class="navbar-form navbar-right" role="search" action="{{url('/report/day/search')}}">
                        <div class="input-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>From Date </label>
                                        <input type="date" id=""  name="date1"  class="form-control ">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">For Date</label>
                                            <input type="date"  name="date2"  class="form-control ">                                            
                                    </div>
                                </div>                            
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label></label>
                                        <button  style="margin-top: 30px" class="btn btn-success" type="submit"><i class="fa fa-search"></i> </button> 
                                    </div>
                                </div>
                                             <!--/span-->
                            </div>
                
                            </div>
                        
                    </form>
                    <a href="{{url('/report/sale/cetakpdf/?date1='.Request::get('date1').'&date2='.Request::get('date2'))}}"
                     class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Cetak PDF</a>

                     <a href="{{url('/report/sale/dayp?date1='.Request::get('date1').
                     '&date2='.Request::get('date2'))}}"
                      class="btn btn-success btn-sm" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
                      <a href="{{url('/report/day')}}"><button type="button" class="btn btn-danger btn-sm">
                        <i class="fa fa-sw fa-refresh">  Reload</i></button></a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Transaksi ID</th>
                       <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $row)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$row->sale_id}}</td>
                      <td>{{$row->date}}</td> 
                      <td>
                        <a href="{{url('/sale/cetak/'.$row->sale_id)}}" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-print"></i>Print</a>
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
              
    </script>
@endpush