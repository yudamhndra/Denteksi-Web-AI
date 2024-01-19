<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use Validator;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // untuk menampilkan data kecamatan di datatables
    public function data(){
        $kecamatan = Kecamatan::orderBy('nama','desc')->get();
        return datatables()->of($kecamatan)
        ->addColumn('action', function($row){
            $btn = '<a type="button" id="btn-edit" class="btn btn-warning">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
            $btn = $btn. ' <a type="button" id="btn-delete" class="btn btn-danger">
            <i class="fa fa-trash " ></i>Hapus</a>';
    
           return $btn;
       })

       ->addIndexColumn()
       ->make(true);
    }

    // view halaman admin list kecamatan
    public function index()
    {
        return view('admin.kecamatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // halaman create kecamatan
    public function create()
    {
        return view('admin.kecamatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  list menambah kecamatan di halaman admin
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }else{
            $data= Kecamatan::create([
                'nama'=> request('nama'),
                
            ]);
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

    //  untuk update kecamatan di halaman admin
    public function update(Request $request, $id)
    {
        $rules = [
            'nama_edit' => 'required',
        ];
        $message= [
            'nama_edit.required' => 'nama kecamatan harus diisi'
        ];
  
        $validator = Validator::make($request->all(), $rules,$message);
        if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()->all()]);
        } else {
          $data = Kecamatan::find($id);
          $data->nama   = $request->nama_edit;
  
          $data->save();
          return response()->json(['success'=>'Data added successfully','data'=>$data,'errors' => $validator->errors()->all()]);
        }
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // menghapus kecamatan dihalaman admin
    public function destroy($id)
    {
        $kecamatan = Kecamatan::find($id);
        $kecamatan->delete();
    }
}
