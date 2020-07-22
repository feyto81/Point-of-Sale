 <?php
    $toti = 0;
    ?>
    @foreach($cart as $row)
    <?php $sub = $toti+($row->price*$row->qty) ?>
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->Item->barcode}}</td>
        <td>{{$row->Item->name}}</td>
        <td>@currency($row->price)</td>
        <td>{{$row->qty}}</td>
        <td>{{$row->discount_item}}</td>
        <td id="total">{{$row->total}}</td>
        <td>
            <button id="update_cart" data-toggle="modal" data-target="#modal-item-edit"
                data-cartid="{{$row->cart_id}}"
                data-barcode="{{$row->Item->barcode}}"
                data-product="{{$row->Item->name}}"
                data-price="{{$row->price}}"
                data-qty="{{$row->qty}}"
                data-discount="{{$row->discount_item}}"
                data-total="{{$row->total}}"
                class="btn btn-sm btn-primary">
                    <i class="fa fa-pencil"></i> Update
                </button>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-delete" title="Hapus Data" cart-id="{{$row->cart_id}}">
              <i class="fas fa-sm fa fa-trash"></i>Hapus</a>
          </td>
    </tr>
@endforeach