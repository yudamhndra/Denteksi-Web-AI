<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Sekolah;
use App\Models\Kelas;
class SekolahController extends Controller
{
    
    public function getKecamatan(){
        $kecamatan = Kecamatan::all();
        return response()->json([
            'messages'=>'Success',
            'data'  => $kecamatan
        ]);
    }

    public function getKelurahan($id)
    {
        $kelurahan = Kelurahan::WHERE('id_kecamatan', $id)->orderBy('nama','asc')->get();
        return response()->json([
            'message'=> 'Success',
            'data' =>$kelurahan
            
        ]);
    }

        
    public function listSekolah($id)
    {
        $sekolah = Sekolah::where('type','sekolah')->where('id_kelurahan', $id)->get();
        return response()->json(
            [
                'messages' => 'Success',
                'data' => $sekolah
            ]);
    }

    public function listKelas($id)
    {
        $kelas = Kelas::where('id_sekolah', $id)->get();
        return response()->json([
            'messsages' => 'Success',
            'data' => $kelas
        ]);
    }

    
}
