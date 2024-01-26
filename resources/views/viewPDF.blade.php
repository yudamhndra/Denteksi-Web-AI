{{--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Preview PDF</title>
</head>
<body>
    <h1 style="text-align: center;">QR CODE</h1>
    @foreach ($qrCodes as $row)
        <div class="col-md-3">
            <p class="" id="auto-increment-id"></p>
            <p>Original ID from Selected Data: {{ $row['id'] }}</p>
            <p>Nama: {{ $row['nama'] }}</p>
            <div class="visible-print text-center">
                @if(isset($row['base64QR']))
                    {!! '<img src="' . $row['base64QR'] . '" alt="QR Code for ' . $row['nama'] . '">' !!}
                @endif
            </div>
        </div>
    @endforeach
</body>
</html>
--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Preview PDF</title>
</head>
<body>
    <h1 style="text-align: center;">QR CODE</h1>

    <div class="row mt-3">
    @foreach ($qrCodes as $row)
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="" id="auto-increment-id"></p>
                        <p>{{ $row['id'] }}</p>
                        {{-- <p>{{ $row['whatsapp'] }}</p> --}}

                        <p>Nama: {{ $row['nama'] }}</p>
                        <p>Orang Tua: {{ $row['nama_orangtua'] }}</p>
                        <div class="visible-print text-center">
                            @if(isset($row['base64QR']))
                                {!! '<img src="' . $row['base64QR'] . '" alt="QR Code for ' . $row['nama'] . '">' !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>


