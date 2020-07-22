<!DOCTYPE html>
<html>
<head>
	<title>Export PDF</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Data Pengeluaran</h5>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Pengeluaran</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($pengeluaran as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>@currency($p->pengeluaran_count)</td>
				<td>{{$p->keterangan}}</td>
				
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>