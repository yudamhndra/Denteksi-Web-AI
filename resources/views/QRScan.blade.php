@extends('layouts.app')

@section('content')
{{-- width di seusaikan --}}
    <div id="reader" style="width:300px"></div>
    
    
    
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
      // handle the scanned code as you like, for example:
        console.log(`Code matched = ${decodedText}`, decodedResult);
        window.open(decodedText, "_self");
};
    
    function onScanFailure(error) {
    }
    
    let html5QrcodeScanner = new Html5QrcodeScanner(
      "reader",
      { fps: 10, qrbox: {width: 250, height: 250} },
      /* verbose= */ false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>    
@endsection
