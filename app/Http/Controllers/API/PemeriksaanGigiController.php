<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SkriningIndeks;
use Illuminate\Http\Request;
use App\Models\Orangtua;
use App\Models\Anak;
use App\Models\PemeriksaanGigi;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;


class PemeriksaanGigiController extends Controller
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

            $waktu_pemeriksaan = Carbon::now();
            $imageArray = array();
            $pgigi = new PemeriksaanGigi();
            $pgigi->id_anak = $request->id_anak;
            $pgigi->id_sekolah= $request->id_sekolah;
            $pgigi->id_kelas = $request->id_kelas;
            $pgigi->waktu_pemeriksaan = $waktu_pemeriksaan;
            if(!empty($request->gambar1)){
                $file = $request->file('gambar1');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename1 = uniqid() . '.' . $extension;
                $imageArray[0] = ['gambar' => $file, 'filename' => $filename1];

                Storage::put('public/gigi/' . $filename1, File::get($file));
                $pgigi->gambar1=$filename1;
            }
            if(!empty($request->gambar2)){
                $file = $request->file('gambar2');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename2 = uniqid() . '.' . $extension;
                $imageArray[1] = ['gambar' => $file, 'filename' => $filename2];

                Storage::put('public/gigi/' . $filename2, File::get($file));
                $pgigi->gambar2=$filename2;
            }
            if(!empty($request->gambar3)){
                $file = $request->file('gambar3');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename3 = uniqid() . '.' . $extension;
                $imageArray[2] = ['gambar' => $file, 'filename' => $filename3];

                Storage::put('public/gigi/' . $filename3, File::get($file));
                $pgigi->gambar3=$filename3;
            }
            if(!empty($request->gambar4)){
                $file = $request->file('gambar4');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename4 = uniqid() . '.' . $extension;
                $imageArray[3] = ['gambar' => $file, 'filename' => $filename4];

                Storage::put('public/gigi/' . $filename4, File::get($file));
                $pgigi->gambar4=$filename4;
            }
            if(!empty($request->gambar5)){
                $file = $request->file('gambar5');
                $extension = strtolower($file->getClientOriginalExtension());
                $filename5 = uniqid() . '.' . $extension;
                $imageArray[4] = ['gambar' => $file, 'filename' => $filename5];

                Storage::put('public/gigi/' . $filename5, File::get($file));
                $pgigi->gambar5=$filename5;
            }
        if(!empty($request->gambarai1)){
            $file = $request->file('gambarai1');
            $extension = strtolower($file->getClientOriginalExtension());
            $filenameai1 = uniqid() . '.' . $extension;
            $imageArray[0] = ['gambar' => $file, 'filename' => $filenameai1];

            Storage::put('public/gigi/' . $filenameai1, File::get($file));
            $pgigi->gambarai1=$filenameai1;
        }
        if(!empty($request->gambarai2)){
            $file = $request->file('gambarai2');
            $extension = strtolower($file->getClientOriginalExtension());
            $filenameai2 = uniqid() . '.' . $extension;
            $imageArray[1] = ['gambar' => $file, 'filename' => $filenameai2];

            Storage::put('public/gigi/' . $filenameai2, File::get($file));
            $pgigi->gambarai2=$filenameai2;
        }
        if(!empty($request->gambarai3)){
            $file = $request->file('gambarai3');
            $extension = strtolower($file->getClientOriginalExtension());
            $filenameai3 = uniqid() . '.' . $extension;
            $imageArray[2] = ['gambar' => $file, 'filename' => $filenameai3];

            Storage::put('public/gigi/' . $filenameai3, File::get($file));
            $pgigi->gambarai3=$filenameai3;
        }
        if(!empty($request->gambarai4)){
            $file = $request->file('gambarai4');
            $extension = strtolower($file->getClientOriginalExtension());
            $filenameai4 = uniqid() . '.' . $extension;
            $imageArray[3] = ['gambar' => $file, 'filename' => $filenameai4];

            Storage::put('public/gigi/' . $filenameai4, File::get($file));
            $pgigi->gambarai4=$filenameai4;
        }
        if(!empty($request->gambarai5)){
            $file = $request->file('gambarai5');
            $extension = strtolower($file->getClientOriginalExtension());
            $filenameai5 = uniqid() . '.' . $extension;
            $imageArray[4] = ['gambar' => $file, 'filename' => $filenameai5];

            Storage::put('public/gigi/' . $filenameai5, File::get($file));
            $pgigi->gambarai5=$filenameai5;
        }


            $pgigi->gsoal1= $request->gsoal1;
            $pgigi->gsoal2= $request->gsoal2;
            $pgigi->ghasil_atas = $request->ghasil_atas;
            $pgigi->ghasil_bawah= $request->ghasil_bawah;

            $pgigi->save();

            return response()->json([
                'messages'=>'success',
                'data'=> $pgigi
            ]);

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

    public function updateDmft (Request $request ){
//        $validator = Validator::make($request->all(), [
//            'id_pemeriksaan' => 'required',
//            'def_d' => 'required|numeric',
//            'def_e' => 'required|numeric',
//            'def_f' => 'required|numeric',
//            'dmf_d' => 'required|numeric',
//            'dmf_e' => 'required|numeric',
//            'dmf_f' => 'required|numeric',
//            'diagnosa' => 'required|string',
//            'rekomendasi' => 'required|string'
//        ]);

//        if ($validator->fails()) {
//            return response()->json([
//                'message' => 'Validation Error',
//                'errors' => $validator->errors()
//            ], 422);
//        }
        $data = [
            'def_d' => $request->def_d,
            'def_e' => $request->def_e,
            'def_f' => $request->def_f,
            'dmf_d' => $request->dmf_d,
            'dmf_e' => $request->dmf_e,
            'dmf_f' => $request->dmf_f,
            'diagnosa' => $request->diagnosa,
            'rekomendasi' => $request->rekomendasi
        ];

        if ($data['def_d'] > 0 || $data['def_e'] > 0 || $data['def_f'] > 0 || $data['dmf_d'] > 0 || $data['dmf_e'] > 0 || $data['dmf_f'] > 0) {
            $data['reservasi'] = 'ya';
        } else {
            $data['reservasi'] = 'tidak';
        }

        $skriningIndeks = SkriningIndeks::updateOrCreate(
            ['id_pemeriksaan' => $request->id_pemeriksaan],
            $data
        );

        return response()->json([
            'message' => 'success',
            'data' => $skriningIndeks
        ]);

    }


}
