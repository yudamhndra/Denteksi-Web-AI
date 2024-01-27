<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Pasien;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(){
        $pasien = Pasien::with('dokter')->whereHas('dokter', function ($q) {
            $q->whereNotNull('nama');
        })->get();
        return datatables()->of($pasien)
            ->addColumn('action', function($row){
                $editBtn = '<a href="'.route('anak.edit',$row->id).'"
                    class="btn btn-warning "><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';
                $deleteBtn = '<a title="Delete" id="btn-delete"
                    class="delete-modal btn btn-danger "><i class="fa fa-trash " ></i> Hapus</a>';
                $cetaktBtn = '<a href="#" type="button" id="btn-create" class="btn btn-info" style="margin-right: 15px;" onclick="var selectedDataToSend = [{ id: ' . $row->id . ', nama: \'' . $row->nama . '\', nama_orangtua: \'' . $row->nama_orangtua . '\' }]; var dataInJson = JSON.stringify(selectedDataToSend); var url = \'/admin/cetakQR?data=\' + encodeURIComponent(dataInJson); window.open(url, \'_self\');">
                    <i class="fas fa-qrcode"></i>
                    Cetak QR
                    </a>';
                return $editBtn . ' ' . $deleteBtn . ' ' . $cetaktBtn;
            })
            ->addColumn('orangtua',function($row){
                return $row->dokter->nama ??" ";
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function index()
    {
        return view ('admin.anak.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.anak.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [

            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 huruf.',
        ];
        $validator = $request->validate([
            'nama'=>'required',
        ], $messages);
            $pasien = new Pasien();
            $pasien->id_dokter=$request->dokter;
            $pasien->nama = $request->nama;
            if($request->no_whatsapp != null){
            $pasien->no_whatsapp = $request->no_whatsapp;
            }
            $pasien->nama_orangtua = $request->nama_orangtua;
            // $pasien->jenis_kelamin = $request->jenis_kelamin;
            // $pasien->tempat_lahir = $request->tempat_lahir;
            // $pasien->tanggal_lahir = $request->tanggal_lahir;
            $pasien->save();
            return redirect()->route('anak.index')->with('success','data berhasil ditambahkan');
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
        $pasien = Pasien::find($id);

        return view('admin.anak.edit',compact('pasien'));
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
        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            // 'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi',
            // 'tempat_lahir.required'  => 'Tempat lahir wajib diisi',
            // 'tanggal_lahir.required' => 'Tanggal lahir wajib diisi'

        ];
        $validator = $request->validate([

            'nama' => 'required',
            // 'tempat_lahir' => 'required',
            // 'tanggal_lahir' => 'required',
            // 'jenis_kelamin' => 'required'

        ], $messages);
        $pasien = Pasien::find($id);

        $pasien->id_dokter=$request->orangtua;
        $pasien->nama = $request->nama;
        $pasien->nama_orangtua = $request->nama_orangtua;
        $pasien->no_whatsapp = $request->no_whatsapp;
        // $pasien->tanggal_lahir = $request->tanggal_lahir;


        $pasien->save();
        return redirect()->route('anak.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        $pasien->delete();
        return response()->json('success delete');
    }

    public function listAnakByOrangtua($id)
    {
        $pasien = Pasien::Where('id_dokter',$id)->get();
        return response()->json($pasien);
    }
}
