<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orangtua;
use App\Models\Anak;
use App\Models\PemeriksaanFisik;
use App\Models\PemeriksaanMata;
use App\Models\PemeriksaanTelinga;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class PemeriksaanFisikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        DB::beginTransaction();
        try{

            $user = Auth::user();
            $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
            $anak = Anak::Where('id_orangtua',$orangtua)->get();

            $waktu_pemeriksaan = Carbon::now(); //mendapatkan waktu sekarang

            $pFisik = new PemeriksaanFisik();
            $pFisik->id_anak =  $request->id_anak;
            $pFisik->id_sekolah= $request->id_sekolah;
            $pFisik->id_kelas = $request->id_kelas;
            $pFisik->tinggi_badan = $request->tinggi_badan;
            $pFisik->berat_badan = $request->berat_badan;
            if($request->tinggi_badan > 0 && $request->berat_badan > 0){
                $pFisik->imt = $request->berat_badan/((($request->tinggi_badan)/100)*(($request->tinggi_badan)/100)); // perhitungan IMT
            }
            $pFisik->sistole = $request->sistole;
            $pFisik->diastole = $request->diastole;
            $pFisik->waktu_pemeriksaan = $waktu_pemeriksaan;
            $pFisik->save(); // MENYIMPAN PEMERIKSAAN FISIK

            $pMata = new PemeriksaanMata();
            $pMata->id_anak =  $request->id_anak;
            $pMata->id_sekolah= $request->id_sekolah;
            $pMata->id_kelas = $request->id_kelas;
            $pMata->msoal1=$request->msoal1; // menyimpan jawaban soal mata
            $pMata->msoal2=$request->msoal2; // menyimpan jawaban soal mata
            $pMata->msoal3=$request->msoal3; // menyimpan jawaban soal mata
            $pMata->msoal4=$request->msoal4; // menyimpan jawaban soal mata
            $pMata->msoal5=$request->msoal5; // menyimpan jawaban soal mata
            $pMata->msoal6=$request->msoal6; // menyimpan jawaban soal mata (menentukan keterangan mata minus plus atau butawarna)
            $pMata->msoal7=$request->msoal7; // menyimpan jawaban soal mata
            $pMata->waktu_pemeriksaan=$waktu_pemeriksaan;
            $pMata->save(); // MENYIMPAN PEMERIKSAAN MATA
            $pTelinga = new PemeriksaanTelinga();
            $pTelinga->id_anak =  $request->id_anak;
            $pTelinga->id_sekolah= $request->id_sekolah;
            $pTelinga->id_kelas = $request->id_kelas;
            $pTelinga->tsoal1=$request->tsoal1;
            $pTelinga->tsoal2=$request->tsoal2;
            $pTelinga->tsoal3=$request->tsoal3;
            $pTelinga->tsoal4=$request->tsoal4;
            $pTelinga->tsoal5=$request->tsoal5;
            $pTelinga->tsoal6=$request->tsoal6;
            $pTelinga->tsoal7=$request->tsoal7;
            $pTelinga->tsoal8=$request->tsoal8;
            $pTelinga->tsoal9=$request->tsoal9;
            $pTelinga->waktu_pemeriksaan=$waktu_pemeriksaan;
            $pTelinga->save(); // MENYIMPAN PEMERIKSAAN TELINGA



            DB::commit();

            return response()->json([
                'messages'=>'success',
                'pemeriksaan fisik'=>$pFisik,
                'pemeriksaan mata'=>$pMata,
                'pemerikssan telinga' =>$pTelinga

            ]);
        }catch(\Exception $e){
            DB::rollback();

            return response()->json([
                'messages'=>'fail'
            ]);
        }

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

    public function riwayatfisik($id){
        // MENAMPILKAN DATA PEMERIKSAAN FISIK
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');  // MENDAPATKAN ID ORANGTUA
        $anak = Anak::Where('id_orangtua',$orangtua)->get(); // MENDAPATKAN LIST ANAK BERDAS;ARKAN ID ORANGTUA
        $pemeriksaanFisik = PemeriksaanFisik::Where('id_anak',$id)->get();



        // MENDAPATKAN LIST PEMERIKSAAN FISIK BERDASARKAN ID ANAK
        $data=[];
        foreach ($pemeriksaanFisik as $key => $value){

            if($value->imt < 18.5){
                $hasil= 'Kurus';
            }else if($value->imt >= 18.5 && $value->imt <= 25.0){
                $hasil = 'Ideal';
            }else if($value->imt >= 25.1 && $value->imt <= 29.9){
                $hasil = 'Gemuk';
            }else{
                $hasil = 'Obesitas';
            }

            if($value->created_at){
                $waktu_pemeriksaan = date('d-m-Y', strtotime($value->created_at));
            }

            $data [] = [
                'id'=> $value->id,
                'id_anak'=> $value->id_anak,
                'hasil'=> $hasil,
                'waktu_pemeriksaan'=> $waktu_pemeriksaan
            ];

        }
        return response()->json([
            'messages'=> 'Success',
            'data' => $data


        ]);

    }


    public function riwayatmata($id){
        // MENAMPILKAN DATA PEMERIKSAAN FISIK
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');  // MENDAPATKAN ID ORANGTUA
        $anak = Anak::Where('id_orangtua',$orangtua)->get(); // MENDAPATKAN LIST ANAK BERDAS;ARKAN ID ORANGTUA
        $pemeriksaanMata = PemeriksaanMata::Where('id_anak',$id)->get();


        // MENDAPATKAN LIST PEMERIKSAAN FISIK BERDASARKAN ID ANAK
        $data=[];
        foreach ($pemeriksaanMata as $key => $value){

            if($value->msoal6=='normal'){
                $hasil = 'Mata Normal';
            }else if($value->msoal6=='minus'){
                $hasil = 'Mata Minus';
            }else{
                $hasil = 'Mata Buta Warna';
            }

            if($value->created_at){
                $waktu_pemeriksaan = date('d-m-Y', strtotime($value->created_at));
            }

            $data [] = [
                'id'=> $value->id,
                'id_anak'=> $value->id_anak,
                'hasil'=> $hasil,
                'waktu_pemeriksaan'=> $waktu_pemeriksaan
            ];

        }
        return response()->json([
            'messages'=> 'Success',
            'data' => $data


        ]);
    }

    public function riwayattelinga($id){
        // MENAMPILKAN DATA PEMERIKSAAN FISIK
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');  // MENDAPATKAN ID ORANGTUA
        $anak = Anak::Where('id_orangtua',$orangtua)->get(); // MENDAPATKAN LIST ANAK BERDAS;ARKAN ID ORANGTUA
        $pemeriksaanTelinga = PemeriksaanTelinga::Where('id_anak',$id)->get();

        // MENDAPATKAN LIST PEMERIKSAAN FISIK BERDASARKAN ID ANAK

        $data=[];
        foreach ($pemeriksaanTelinga as $key => $value){

            if($value->tsoal7=='ya'&& $value->tsoal8=='ya'){
                $hasil = 'Serumen 2';
            }else if($value->tsoal7=='ya'&& $value->tsoal8=='tidak'){
                $hasil = 'Serumen Kanan';
            }else if($value->tsoal7=='tidak'&& $value->tsoal8=='ya'){
                $hasil = 'Serumen Kiri';
            }else{
                $hasil = 'Serumen Tidak Ada';
            }

            if($value->created_at){
                $waktu_pemeriksaan = date('d-m-Y', strtotime($value->created_at));
            }

            $data [] = [
                'id'=> $value->id,
                'id_anak'=> $value->id_anak,
                'hasil'=> $hasil,
                'waktu_pemeriksaan'=> $waktu_pemeriksaan
            ];

        }
        return response()->json([
            'messages'=> 'Success',
            'data' => $data


        ]);
    }



}

