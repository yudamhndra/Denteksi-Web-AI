<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemeriksaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .custom-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
        }

        .img-fluid {
            width: 200px;
            height: 200px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 90%;
            height: 5%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="custom-card">
        <div class="row mt-5">
            <div class="col-md-6 align-self-center">
                <h5 class="mb-3 mb-md-0 text-center">HASIL PEMERIKSAAN</h5>
            </div>
        </div>

        <div class="row col-md-12 mt-3 px-5">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama </label>
                <input type="text" disabled class="form-control" id="nama" name="nama" autocomplete="off" placeholder="Masukkan nama" value="{{$selectedData['nama']}}">
            </div>
        </div>

        <div class="row col-md-12 mt-3 px-5">
            <div class="mb-3">
                <label for="no_whatsapp" class="form-label">Nomor Whatsapp </label>
                <input type="text" disabled class="form-control" id="no_whatsapp" name="no_whatsapp" autocomplete="off" placeholder="Masukkan nomor whatsapp" value="{{$selectedData['whatsapp']}}">
            </div>
        </div>
        
        <div class="row col-md-12 mt-3 px-5">
            <div class="mb-3">
                <label for="hasil" class="form-label">Hasil Pemeriksaan </label>
                <input type="text" class="form-control" id="hasil" name="hasil" autocomplete="off" disabled placeholder="Hasil belum keluar" value="{{$selectedData['hasil']}}">
            </div>
        </div>
        <div class="row col-md-12 mt-3 px-5">
            <div class="mb-3">
                <label for="rekomendasi" class="form-label">Rekomendasi </label>
                <input type="text" disabled class="form-control" id="rekomendasi" name="rekomendasi" autocomplete="off" placeholder="Belum ada rekomendasi" value="{{$selectedData['rekomendasi']}}">
            </div>
        </div>
        <div class="row col-md-12 mt-3 px-5">
            <div class="mb-3">
                <label for="gambar" class="form-label">Foto  </label>
                <img class="img-fluid" src="data:image/jpeg;base64,{{ base64_encode($decodedImage) }}" alt="Profile Image" id="gambar">
            </div>
        </div>
    </div>
</body>
</html>

