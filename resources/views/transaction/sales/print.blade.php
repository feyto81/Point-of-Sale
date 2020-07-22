<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<title>Kasir - Print Nota</title>
		<style type="text/css">
			html { font-family: "Verdana, Arial"; }
			.content {
				width: 80mm;
				font-size: 12px;
				padding: 5px;
			}
			.title {
				text-align: center;
				font-size: 13px;
				padding-bottom: 5px;
				border-bottom: 1px dashed;
			}
			.head {
				margin-top: 5px;
				margin-bottom: 10px;
				padding-bottom: 10px;
				border-bottom: 1px solid;
			}
			table {
				width: 100%;
				font-size: 12px;
			}
			.thanks {
				margin-top: 10px;
				padding-top: 10px;
				text-align: center;
				border-top: 1px dashed;
			}
			@media print {
				@page {
					width: 80mm;
					margin: 0mm;
				}
			}
		</style>
	</head>
	<body onload="window.print()">
		<div class="content">
			<div class="title">
				<b>Dewangga Store</b>
				<br>
				Jl. Bumiharjo
			</div>
			<div class="head">
                @foreach($data as $item)
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td style="width: 200px">
							{{$item->created}}
						</td>
						<td>
							Cashier
						</td>
						<td style="text-align: center; width: 10px">
							:
						</td>
                        <td style="text-align: right;">
                            {{$item->name}}
						</td>
					</tr>
					<tr>
						<td>
							{{$item->sale_id}}
						</td>
						<td>
							Customer
                        </td>
                    @endforeach
                        
						<td style="text-align: center;">
							:
						</td>
                        <td style="text-align: right;">
                            @foreach ($detailtransaksi as $p)
                                {{$p->customer_name}}
                            @endforeach
							
						</td>
					</tr>
				</table>
            </div>

			<div class="transaction">
				<table class="transaction-table" cellspacing="0" cellpadding="0">
					@foreach($detailtransaksi as $row)
                    <tr>
                        <td style="width: 110px">{{$loop->iteration}}</td>
                        <td style="width: 110px">{{$row->name}}</td>
                        <td style="text-align: ; width: 60px">{{$row->price}}</td>
                        <td style="text-align: ; width: 60px">{{$row->qty}}</td>
                        <td style="text-align: right" class="td">{{$row->total}}</td>

                    </tr>
                    @endforeach
                    <tr>
						<td colspan="5" style="border-bottom: 1px dashed; padding-top: 5px"></td>
                    </tr>
                    @foreach($data as $item)
					<tr>
						<td colspan="3"></td>
						<td style="text-align: right; padding-top:5px">Sub  Total</td>
						<td style="text-align: right; padding-top: 5px">
							{{$item->total_price}}
						</td>
					</tr>
						<tr>
							<td colspan="3"></td>
							<td style="text-align: right; padding-bottom:5px ">Disc. Sale</td>
							<td style="text-align: right; padding-bottom: 5px">{{$item->discount}}</td>
						</tr>
					<tr>
						<td colspan="3"></td>
						<td style="border-top: 1px dashed; text-align: right; padding: 5px 0">
							Grand Total
						</td>
						<td style="border-top: 1px dashed; text-align: right; padding: 5px 0">
							{{$item->final_price}}
						</td>
					</tr>
					<tr>
						<td colspan="3">
							
						</td>
						<td style="border-top: 1px dashed; text-align: right; padding-top: 5px">
							Cash
						</td>
						<td style="border-top: 1px dashed; text-align: right; padding: 5px">
							{{$item->cash}}
						</td>
					</tr>
					<tr>
						<td colspan="3">
							
						</td>
						<td style="text-align: right;">
							Change
						</td>
						<td style="text-align: right;">
							{{$item->remaining}}
						</td>
                    </tr>
                    @endforeach
					
				</table>
			</div>
			<div class="thanks">
				--- Thank You ---
				<br>
				www.dewangga.ga
			</div>
		</div>
	</body>

</html>