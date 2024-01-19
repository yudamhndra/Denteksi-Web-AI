<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Validator;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $sekolah = Sekolah::where('type','sekolah')->get();
        return datatables()->of($sekolah)
        ->addColumn('action', function($row){
            $editBtn = '<button type="button" class="btn btn-warning btn-edit"  id="btn-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>';
            $deleteBtn = '<button type="button" class="btn btn-danger btn-delete" id="btn-delete""><i class="fa fa-trash"></i> Hapus</button>';
            $viewBtn = '<a href="'.route('viewKelas',$row->id).'" class="btn btn-info"><i class="fa fa-eye"></i></a>';
            return $editBtn . ' ' . $deleteBtn . ' ' . $viewBtn;
        })

    ->addColumn('kecamatan',function($row){
        return $row->kelurahan->kecamatan->nama;
    })
    ->addColumn('kelurahan',function($row){
        return $row->kelurahan->nama;
    })
       ->addIndexColumn()
       ->make(true);
    }

    public function index()
    {
        return view('admin.sekolah.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sekolah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'kelurahan' => 'required',

            'nama' => 'required',
            'alamat' => 'required'
         ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }else{
            $data= new Sekolah();
            $data->id_kelurahan= $request->kelurahan;
            $data->type= 'sekolah';
            $data->nama= $request->nama;
            $data->alamat= $request->alamat;

            $data->save();

            foreach ($request->kelas as $key => $value){
                $kelas = new Kelas();
                $kelas->id_sekolah = $data->id;
                $kelas->kelas = $request->kelas[$key];
                $kelas->save();
                }
            return response()->json(['success'=>'Data added successfully','data'=>$data]);
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
        $rules = [
            'kelurahan_edit' => 'required',
            'type' =>'required',
            'nama_edit' => 'required',
            'alamat_edit' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()->all()]);
        } else {
          $data = Sekolah::find($id);
          $data->id_kelurahan   = $request->kelurahan_edit;
          $data->type   = 'sekolah';
          $data->nama = $request->nama_edit;
          $data->alamat = $request->alamat_edit;
          $data->save();

          return response()->json(['success'=>'Data added successfully','data'=>$data]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Sekolah::find($id);
        $data->delete();
    }



    public function listSekolah($id_kelurahan)
    {
        $sekolah = Sekolah::where('type','sekolah')->where('id_kelurahan', $id_kelurahan)->get();
        return response()->json($sekolah);
    }
    public function listKelas($id_sekolah)
    {
        $kelas = Kelas::where('id_sekolah', $id_sekolah)->get();
        return response()->json($kelas);
    }

    public function listPosyandu($id_kelurahan)
    {
        $posyandu = Sekolah::where('type','posyandu')->where('id_kelurahan', $id_kelurahan)->get();
        return response()->json($posyandu);
    }

    public function viewKelas($id){
        $sekolah= Sekolah::find($id);
        return view('admin.sekolah.kelas', compact('sekolah'));
    }
    public function dataKelas($id){
        $sekolah = Sekolah::find($id);
        $kelas = Kelas::where('id_sekolah',$sekolah)->get();
        return datatables()->of($kelas)
        ->addColumn('action', function($row){
            $btn = '<div class="btn-group btn-group-sm">';
            $btn .= '<button type="button" id="btn-edit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
            $btn .= '<button type="button" id="btn-delete" class="btn btn-danger"><i class="fa fa-trash " ></i></button>';
            $btn .= '</div>';

           return $btn;
        })
        ->addColumn('sekolah',function($row){
            return $row->sekolah->nama;
        });
    }
}
