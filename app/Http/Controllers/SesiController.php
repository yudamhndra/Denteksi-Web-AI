<?php

namespace App\Http\Controllers;

use App\Models\PoliHari;
use App\Models\Sesi;
use App\Models\DokterSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idPoli)
    {
        $dataJadwalPoli = PoliHari::where('poli_id',$idPoli)->get();
        return view('admin.sesi.index', compact('dataJadwalPoli'));
    }

    public function getData(Request $request)
    {
        $data = Sesi::where('poli_hari_id',$request->klinik_hari)->get();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('sesi.edit',$row->id).'" class="btn btn-xs btn-icon btn-warning text-white mx-1"><i class="fa fa-pencil-square-o"></i></a>';
            $btn = $btn . '<button id="delete" class="btn btn-xs btn-icon btn-danger mx-1"><i class="fa fa-trash"></i></button>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $poliHari = PoliHari::find($request->sesiHari);
        $namaSesi =['Pagi','Siang'];
        $jamSesi =[['mulai' => '08:00', 'selesai' => '12:00'], ['mulai' => '13:00', 'selesai' => '16:00']];
        return view('admin.sesi.create', compact('poliHari', 'namaSesi', 'jamSesi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
          'sesi' => 'required',
          'mulai' => 'required',
          'selesai' => 'required',
          'jumlah_dokter' => 'required',
          'dokter' => 'required',
        ]);

        DB::beginTransaction();
        $sesi = new Sesi();
        $sesi->sesi = $request->sesi;
        $sesi->poli_hari_id = $request->sesiHari;
        $sesi->mulai = $request->mulai;
        $sesi->selesai = $request->selesai;
        $sesi->jumlah_dokter = $request->jumlah_dokter;
        $sesi->save();
        foreach ($request->dokter as $key => $value) {
          $sesi_dokter = new DokterSesi();
          $sesi_dokter->sesi_id = $sesi->id;
          $sesi_dokter->dokter_id = $value;
          $sesi_dokter->save();
        }
        DB::commit();

        return redirect()->route('klinik.sesi.index',$sesi->poliHari->poli_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sesi  $sesi
     * @return \Illuminate\Http\Response
     */
    public function show(Sesi $sesi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sesi  $sesi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwalSesi = Sesi::find($id);
        $namaSesi =['Pagi','Siang'];
        $jamSesi =[['mulai' => '08:00', 'selesai' => '12:00'], ['mulai' => '13:00', 'selesai' => '16:00']];

        return view('admin.sesi.edit', compact('jadwalSesi', 'namaSesi', 'jamSesi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sesi  $sesi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jadwalSesi = Sesi::find($id);

        $this->validate(request(), [
          'sesi' => 'required',
          'mulai' => 'required',
          'selesai' => 'required',
          'jumlah_dokter' => 'required',
          'dokter' => 'required',
        ]);

        DB::beginTransaction();
        $jadwalSesi->update([
            'sesi' => $request->sesi,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'jumlah_dokter' => $request->jumlah_dokter,
        ]);

        $sesi_dokter = DokterSesi::where('sesi_id', $jadwalSesi->id)->get();
        foreach ($sesi_dokter as $key => $value) {
            $value->delete();
        }
        foreach ($request->dokter as $key => $value) {
          $sesi_dokter = new DokterSesi();
          $sesi_dokter->sesi_id = $jadwalSesi->id;
          $sesi_dokter->dokter_id = $value;
          $sesi_dokter->save();
        }
        DB::commit();

        return redirect()->route('klinik.sesi.index',$jadwalSesi->poliHari->poli_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sesi  $sesi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sesi::find($id)->delete();
        $sesiDokter = DokterSesi::where('sesi_id',$id)->get();
        foreach ($sesiDokter as $key => $value) {
          $value->delete();
        }
    }
}
