@extends('layouts.master')
@section('title','Transaction | Kasir')
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
<main class="app-content">
    <div class="app-title">
        <div>
          <h1><i class="fa fa-shopping-cart"></i> Transaction</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="{{url('/add-ticket')}}">Transaction</a></li>
        </ul>
      </div>
      <form id="formSave" method="POST">
        {{csrf_field()}}

      <div class="row">
         <div class="col-md-4">
            <div class="tile">
              <div class="tile-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align: top">
                            <label for="date">Date</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="date" id="date" name="date" value="<?=date('Y-m-d')?>" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 30%">
                            <label for="user">Kasir</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" id="user_id" name="user_id" value="{{Auth::user()->name}}" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">
                            <label for="customer">Customer</label>
                        </td>
                        <td>
                            <div>
                                <select id="customer_name" name="customer_name" class="form-control demoSelect">
                                    <option value="umum">Umum</option>
                                    @foreach ($customer as $row)
                                        <option value="{{$row->name}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tile">
              <div class="tile-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align: top;width: 30%">
                            <label for="barcode">Barcode</label>
                        </td>
                        <td>
                            <div class="form-group input-group">
                                <input type="hidden" id="item_id" name="item_id">
                                <input type="hidden" id="price" name="price">
                                <input type="hidden" id="stock" name="stock">
                                
                                <input type="text" id="barcode" name="barcode" class="form-control" autofocus >
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">
                            <label for="qty">Qty</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="number" id="qty" name="qty" value="1" min="1" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div>
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="fa fa-cart-plus"></i> Add
                                  </button>
                            </div>
                        </td>
                    </tr>
                </table>
                </form>
              </div>

            </div>
          </div>

          <div class="col-lg-4">
            <div class="tile">
              <div class="tile-body">
                <div class="box box-widget">
                    <div class="box-body">
                        <div align="right">
                            <h4>Invoice <b><span id="sale_id" name="sale_id">{{$max_code}}</span></b></h4>
                            <h1><b><span id="grand_total2" style="font-size: 50pt">0</span></b></h1>
                        </div>
                        <br>
                    </div>
                </div>
              </div>
            </div>
          </div>
        
      </div>
    </form>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Barcode</th>
                      <th>Product Item</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Discount Item</th>
                      <th>Total</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="cart_table">
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <form action="{{url('/sales/transaction/')}}" method="POST">
        {{ csrf_field() }}
      <div class="row">
        
        <div class="col-md-3">
           <div class="tile">
            <div class="tile-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align: top;width: 30%">
                            <label for="sub_total">Sub Total</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="sub_total" name="sub_total" value="" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">
                            <label for="discount">Discount</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="discount" name="discount" value="0" min="0" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">
                            <label for="grand_total">Grand Total</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="grand_total" name="grand_total" class="form-control" readonly>
                            </div>
                        </td>
                    </tr>
                </table>
                  


            </div>
           </div>
        </div>
        <div class="col-md-3">
            <div class="tile">
             <div class="tile-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align: top; width: 30%">
                            <label for="cash">Cash</label>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" id="cash" name="cash" value="0" min="0" class="form-control">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">
                            <label for="change">Change</label>
                        </td>
                        <td>
                            <div>
                                <input type="number" id="change" name="change" class="form-control" readonly>
                                <input type="hidden" id="date" name="date" value="{{date('Y-m-d')}}">
                                <input type="hidden" id="sale_id" name="sale_id" value="{{$max_code}}">
                            </div>
                        </td>
                    </tr>
                </table>
             </div>
            </div>
         </div>

         <div class="col-md-3">
            <div class="tile">
             <div class="tile-body">
                <table width="100%">
                    <tr>
                        <td style="vertical-align: top">
                            <label for="note">Note</label>
                        </td>
                        <td>
                            <div>
                                <textarea id="note" name="note" rows="3" class="form-control" required=""></textarea>
                                
                            </div>
                        </td>
                    </tr>
                </table>
             </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="">
             <div class="">
                <table width="100%">
                    <tr>
                     
                       <br><br>
                        <button type="submit" id="process_payment" class="btn btn-flat btn-lg btn-success">
                            <i class="fa fa-paper-plane-o"></i> Process Payment
                        </button>
                    </tr>
                </table>
                
             </div>
            </div>
            
         </div>
      </div>
      </form>
    
    </main>

{{-- modal barcode --}}
<div class="modal"  tabindex="-1" role="dialog"  id="modal-item">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Product Item</h5>
          <button type="button" class="close" id="closeModalTambah" data-dismiss="modal" aria-label="Close">
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
                     data-price="{{$data->price}}"
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
  <!-- Modal Edit Cart Item -->
<div class="modal fade" id="modal-item-edit">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form id="formEdit" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Update Product Item</h5>
            <button type="button" class="close" id="closeModalEdit" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body table-responsive">
          <input type="hidden" id="cartid_item">
          <div class="form-group">
            <label for="product_item">Product Item</label>
            <div class="row">
              <div class="col-md-5">
                <input type="text" id="barcode_item" class="form-control" readonly>
              </div>
              <div class="col-md-7">
                <input type="text" id="product_item" class="form-control" readonly>
              </div>          
            </div>
          </div>
          <div class="form-group">
            <label for="price_item">Price</label>
            <input type="number" id="price_item" name="price" min="0" class="form-control">
          </div>
          <div class="form-group">
            <label for="qty_item">Qty</label>
            <input type="number" id="qty_item" name="qty" min="1" class="form-control">
          </div>
          <div class="form-group">
            <label for="total_before">Total Before discount</label>
            <input type="number" id="total_before" min="0" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="discount_item">Discount Per Item</label>
            <input type="number" id="discount_item" name="discount_item" class="form-control">
          </div>
          <div class="form-group">
            <label for="total_item">Total After Discount</label>
            <input type="number" id="total_item" name="total" min="0" class="form-control" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <div class="pull-right">

            <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-paper-plane"></i> Save</button>
            
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@include('sweetalert::alert')
@endsection
@push('bottom')

<script type="text/javascript">

function loadDataTable(){
      $.ajax({
        url: "{{url('/sales/getDataTable')}}",
        success:function(data){
          $('#cart_table').html(data);
          calculate();
        }
      })
    }
    loadDataTable();
    $('#formSave').submit(function(e){
      e.preventDefault();
      var request = new FormData(this);
      var item_id = $('#item_id').val()
      var price = $('#price').val()
      var stock = $('#stock').val()
      var qty = $('#qty').val()
      if(item_id == '') {
        toastr["error"]("Product Belum DiPilih","Error")
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        $('#barcode').focus()
      } else if(stock < 1) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Stock Habis',
        })
        $('#item_id').val('')
        $('#barcode').val('')
        $('#barcode').focus();
      } else if(stock < qty) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Pembelian Lebih dari stock yang ada',
        })
        $('#qty').val('')
        $('#qty').focus()
      } else {
        $.ajax({
          url: "{{url('sales/cart')}}",
          method: "POST",
          data: request,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data){
            if(data == "sukses"){
              
              loadDataTable();
              calculate();
            }
            else {
              alert('gagal menambah data');
            }
          }
        });
      }
    });

  $(document).on('click', '#select', function() {
	$('#item_id').val($(this).data('id'))
	$('#barcode').val($(this).data('barcode'))
	$('#price').val($(this).data('price'))
	$('#stock').val($(this).data('stock'))
	// $('#modal-item').modal('hide')
  $('#closeModalTambah').click();
});

</script>
<script>
function count_edit_modal() {
  var price = $('#price_item').val()
  var qty = $('#qty_item').val()
  var discount = $('#discount_item').val()

  total_before = price * qty
  $('#total_before').val(total_before)

  total = (price - discount) * qty
  $('#total_item').val(total)
  // unutk 0 discount
  if(discount == '') {
    $('#discount_item').val()
  }
}
function calculate() {
	var subtotal = 0;
	$('#cart_table tr').each(function() {
		subtotal += parseInt($(this).find('#total').text())
	})
	isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

	var discount = $('#discount').val()
	var grand_total = subtotal - discount
	if(isNaN(grand_total)) {
		$('#grand_total').val(0)
		$('#grand_total2').text(0)

	} else {
		$('#grand_total').val(grand_total)
		$('#grand_total2').text(grand_total)
	}

	var cash = $('#cash').val();
	cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)
	// unutk 0 discount
	if(discount == '') {
		$('#discount').val()
	}
}


$(document).on('keyup mouseup', '#discount, #cash', function() {
	calculate()
})
$(document).on('keyup mouseup', '#price_item, #qty_item, #discount_item', function() {
  count_edit_modal()
})

$(document).ready(function() {
	calculate()
})
$(document).on('click', '.btn-delete', function(e){
      if(confirm('Apakah Anda Yakin?')) {//
      e.preventDefault();
      var cart_id = $(this).attr('cart-id');
      $.ajax({
        url: "{{url('/sales/delete-cart')}}/"+cart_id,
        method: "GET",
        success:function(data){
          if(data == "sukses"){
            toastr["success"]("Cart Berhasil Dihapus","Success")
            $('#item_id').val('')
            $('#barcode').val('')
            loadDataTable();
          } else {
            alert('Gagal');
        }
        }
      });
      }//
    });
    $('#formEdit').submit(function(e){
      e.preventDefault();
      var request = new FormData(this);
      var cart_id = $('#cartid_item').val();
      var price = $('#price_item').val()
      var qty = $('#qty_item').val()
      var discount = $('#discount_item').val()
      var total = $('#total_item').val()
      if(price == '' || price < 1) {
        toastr["error"]("Harga Tidak Boleh Kosong","Error")
        $('#price_item').focus()
      } else if(qty == '' || qty < 1) {
        toastr["error"]("Qty Tidak Boleh Kosong","Error")
        $('#qty_item').focus()
      } else {
        $.ajax({
          url: "{{url('/sales/EditData') }}/"+cart_id,
          method: "POST",
          data: request,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data){
            if(data == "sukses"){
              $('#closeModalEdit').click();
              $('#formSave')[0].reset();
              alert('berhasil memperbarui data');
              loadDataTable();
            }
            else {
              alert('Gaga');
            }
          }
        });
      }
    });
    $(document).on('click', '#update_cart', function() {
      $('#cartid_item').val($(this).data('cartid'))
      $('#barcode_item').val($(this).data('barcode'))
      $('#product_item').val($(this).data('product'))
      $('#price_item').val($(this).data('price'))
      $('#qty_item').val($(this).data('qty'))
      $('#total_before').val($(this).data('price') * $(this).data('qty'))
      $('#discount_item').val($(this).data('discount'))
      $('#total_item').val($(this).data('total'))
    });
    



</script>
@endpush