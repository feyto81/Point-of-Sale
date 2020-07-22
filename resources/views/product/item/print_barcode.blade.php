<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Barcode Product {{$row->barcode}}</title>
    <link href="{{asset('backend/images/favicon.png')}}" rel="icon">
</head>
<body>
	  <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($row->barcode, 'C39')}}" height="60" width="180">
      <br>
      {{$row->barcode}}


</body>
</html>