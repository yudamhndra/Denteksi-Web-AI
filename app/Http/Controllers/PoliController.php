<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use App\Models\Poli;
use App\Models\PoliHari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.poli.index');
    }

    public function getData(Request $request)
    {
        $data = Poli::all();
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('klinik.edit',$row->id).'" class="btn btn-xs btn-icon btn-warning text-white mx-1"><i class="fa fa-pencil-square-o"></i></a>';
            $btn = $btn . '<button id="delete" class="btn btn-xs btn-icon btn-danger mx-1"><i class="fa fa-trash"></i></button>';
            return $btn;
        })
        ->addColumn('jadwal', function($row){
            $idPoli = $row->id;
            if ($row->url_registrasi) {
                $btn = '<a href="'.$row->url_registrasi.'" class="btn btn-xs btn-info"><i class="fa fa-globe"></i> Link Registrasi</a>';
            } else {
                $btn = '<a href="'.route('klinik.sesi.index',$idPoli).'" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Kelola Jadwal</a>';
            }
            return $btn;
        })
        ->rawColumns(['action','jadwal'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.poli.create');
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
            'poli' => 'required',
            'kode_poli' => 'required',
            'waktu' => 'required|gt:0'
        ]);

        DB::beginTransaction();
        $poli = new Poli();
        $poli->kode = $request->kode_poli;
        $poli->poli = $request->poli;
        $poli->waktu = $request->waktu;
        $poli->save();

        if($request->haveRegUrl === 'true') {
            $this->validate(request(), [
                'url_external' => 'required|url'
            ]);
            $poli->url_registrasi = $request->url_external;
            $poli->save();
        } else {
            $hari = Hari::all();
            foreach ($hari as $key => $value) {
                $poliHari = new PoliHari();
                $poliHari->poli_id = $poli->id;
                $poliHari->hari_id = $value->id;
                $poliHari->save();
            }
        }
        DB::commit();

        return redirect()->route('klinik.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function show(Poli $poli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poli = Poli::find($id);
        return view('admin.poli.edit',compact('poli'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $poli = Poli::find($id);

        $this->validate(request(), [
            'poli' => 'required',
            'kode_poli' => 'required',
            'waktu' => 'required|gt:0'
        ]);

        DB::beginTransaction();
        $poli->update([
            'kode' => $request->kode_poli,
            'poli' => $request->poli,
            'waktu' => $request->waktu,
        ]);

        if($request->haveRegUrl === 'true') {
            $this->validate(request(), [
                'url_external' => 'required|url'
            ]);
            $poli->update([
                'url_registrasi' => $request->url_external
            ]);
        } else {
            $poli->update([
                'url_registrasi' => null
            ]);
            if ($poli->poliHAri->isEmpty()) {
                $hari = Hari::all();
                foreach ($hari as $key => $value) {
                    $poliHari = new PoliHari();
                    $poliHari->poli_id = $poli->id;
                    $poliHari->hari_id = $value->id;
                    $poliHari->save();
                }
            }
        }
        DB::commit();

        return redirect()->route('klinik.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Poli::find($id);
        $data->delete();
    }
}
