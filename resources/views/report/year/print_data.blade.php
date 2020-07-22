<!DOCTYPE html>
<html>
<head>
    <title>Cetak Year Sale</title>
</head>
<body>
     <center>
<table style="text-align: center;">
    <tr>
        <td><img src=""></td>
        
        <td><img src=""></td>
    </tr>
</table>
</center>
<br>
<table class="table table-hover table-striped table-bordered" cellspacing="0" width="100%" border="1">
                <thead>
                    <tr class="success"><th colspan="6" style="text-align: center"></th></tr>

                    <tr class="success"><td colspan="6" style="font-family: sans-serif;text-align: center;">

                        <div style="text-align: center;">
                            <h3>Report Sale Tahun  {{Request::get('tahun')}}</h3>
                            <h3>CV Sejahtera</h3>
                        </div>
                        <p style="text-align: center">Jl. Kelet Ploso KM 36, Kelet, Keling, Jepara, Jawa Tengah 59454</p>
                    </td></tr>

                    <tr class="success"><th colspan="6" style="text-align: center"></th></tr>
                    <tr>
                        <th>No</th>
                        <th>Sale ID</th>
                        <th>Total Price</th>
                        <th>Discount</th>
                        <th>Final Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->sale_id}}</td>
                        <td>@currency($item->total_price)</td>
                        <td>@currency($item->discount)</td>
                        <td>@currency($item->final_price)</td>
                        <td>{{$item->date}}</td>
                    </tr>
                    @endforeach
                </tbody>
                                               
</table>
<table style="text-align: center;">
    <tr>
        <td style="font-family: sans-serif;text-align: center;">
            <div style="text-align: right;float: right;margin-left: 1170px;margin-top: 25px;">
                Jepara, {{date('Y-m-d')}}
            </div>
        </td>
    </tr>
</table>
<table style="text-align: center;">
    <tr>
        <td style="font-family: sans-serif;text-align: center;">
            <div style="text-align: center;float: right;margin-left: 1220px;margin-top: 40px;">
                {{Auth::user()->name}}
            </div>
        </td>
    </tr>
</table>
</center>
</body>
</html>
<script>
    window.print();
</script>