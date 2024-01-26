<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Dokter;
use App\Models\Orangtua;
use App\Models\Pasien;
use App\Models\PemeriksaanGigi;
use Barryvdh\DomPDF\Facade;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class qrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::user();
        $dokter = Dokter::Where('id_users', Auth::user()->id)->value('id');
        $pasien = Pasien::Where('id_dokter',$dokter)->get();  //mendapatkan list anak berdasarkan id orangtua yang login
        $autoAnak = $pasien[(int)$id - 1];
        $QRGenerator = new Generator;
        $logoPath = asset('assets/logo-senyumin-black.png');
        // Dikasih UQ biar tiap QR yang digenerate beda
        $uniqueIdentifier = mt_rand(100000, 999999);
        $QR = $QRGenerator->size(500)->mergeString( $logoPath)->generate($id.'_'.$uniqueIdentifier);
        return view('QRtest',compact('QR'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function viewPDF(Request $request){
        $jsonData = $request->query('data');
        $selectedData = json_decode($jsonData, true);
        $qrCodes = [];

        foreach ($selectedData as $row) {
            $id = $row['id'];
            $nama = $row['nama'];
            $QRGenerator = new Generator;
            $uniqueIdentifier = mt_rand(100000, 999999);
            $logoPath = asset('assets/images/logo-senyumin-black.png');

            $QR = $QRGenerator->size(150)->mergeString( $logoPath)->generate($id.'_'.$uniqueIdentifier);
            // $QR = $QRGenerator->size(300)->mergeString( $logoPath)->generate($id.'_'.$uniqueIdentifier);
            // Convert the image data to base64
            $base64QR = 'data:image/png;base64,' . base64_encode($QR);

            // Add the base64-encoded QR to the row data
            $row['base64QR'] = $base64QR;
            $qrCodes[$id] = $row;
        }

        $pdf = Pdf::loadview('viewPDF', compact('selectedData', 'qrCodes'));
        $pdfContent = $pdf->output();

        // return $pdf->stream();
        return Response::streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'QR - ' . $nama . ' - ' . now() . '.pdf');
    
    }


    public function formToPdf(Request $request){

            $jsonData = $request->query('data');
            $selectedData = json_decode($jsonData, true);
            $selectedData = $selectedData[0];
            $url = config('app.ai_url') . "/api/result-image/?pemeriksaan_id=" . $selectedData['id'];
            $response = Http::withBasicAuth('user@senyumin.com', 'sdgasdfklsdwqorn')->get($url);
            $pgigi = PemeriksaanGigi::find($selectedData['id']);
            $pasien = Pasien::find($pgigi -> id_pasien);

            $decodedImage = null; // Initialize the variable

            $responseData = $response->json();

            if (isset($responseData['status']) && isset($responseData['data'])) {
                $status = $responseData['status'];
                $data = $responseData['data'];
    
                // Check if the status is 'Success' and data is not empty
                if ($status === 'Success' && !empty($data)) {
                    foreach ($data as $item) {
                        $result = $item['result'];
    
                        foreach ($result as $filename => $resultData) {
                            $decodedImage = base64_decode($resultData);
                            // Break out of the loop as you only want one image
                            break;
                        }
                    }
                }
            }
    
            $pdf = Pdf::loadview('viewResultPdf', compact('selectedData', 'decodedImage'));

            // return $pdf->stream();

            if ($pasien -> nama_orangtua != null) {
                return Response::streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, 'Hasil Pemeriksaan - ' . $selectedData['nama'] . ' - ' . $pasien -> nama_orangtua . ' .pdf');
            } else {
                return Response::streamDownload(function () use ($pdf) {
                    echo $pdf->output();
                }, 'Hasil Pemeriksaan - ' . $selectedData['nama'] . ' .pdf');
            }
            
            // untuk auto download :
            
    }

    // public function viewPDF(Request $request){
    //     $jsonData = $request->query('data');
    //     $selectedData = json_decode($jsonData, true);
    //     $qrCodes = [];

    //     foreach ($selectedData as $row) {
    //         $id = $row['id'];
    //         // Dikasih UQ biar tiap QR yang digenerate beda
    //         $QR = 'http://127.0.0.1:8000/orangtua/pemeriksaanfisik/create/'.$id;

    //         $base64QR = 'data:image/png;base64,' . base64_encode($QR);
    //         $row['base64QR'] = $base64QR;

    //         $qrCodes[$id] = $row;
    //     }
    //     Log::info("selected data", $selectedData);

    //     $pdf = Pdf::loadview('viewPDF', compact('selectedData', 'qrCodes'));

    //     // Ini untuk pdf
    //     // return $pdf->download('list kode QR');
    //     return $pdf -> stream();

    //     // return view('viewPDF', compact('selectedData', 'qrCodes'));

    // }
}
