<html>
<head>
    <meta charset="utf-8">
    <title>Laravel Barcode Generator Tutorial With Example </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<h2>Laravel Barcode Generator Tutorial With Example</h2><br/>
<div class="container text-center">
    <h2>One-Dimensional (1D) Barcode Types</h2><br/>
   {{-- <div>{!!DNS1D::getBarcodeHTML(8889899, 'C39')!!}--}}
       {{-- {!!DNS2D::getBarcodeHTML(335553, 'QRCODE')!!}--}}
    {!! QrCode::size(250)->generate('ItSolutionStuff.com'); !!}
    <?php
    $a=5675;
    Storage::disk('public')->put('test5.png',base64_decode(DNS2D::getBarcodePNG($a, "PDF417")));
    ?>

</div>
</body>
</html>
