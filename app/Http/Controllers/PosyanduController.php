<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use Validator;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(){
        $sekolah = Sekolah::where('type','posyandu')->get();
        return datatables()->of($sekolah)
        ->addColumn('action', function($row){
           
            $btn = '<button type="button" id="btn-edit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>';
            $btn = $btn. ' <button type="button" id="btn-delete" class="btn btn-danger"><i class="fa fa-trash" ></i>Hapus</button>';
            
            

           return $btn;
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
        return view('admin.posyandu.index');
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
        $data= new Sekolah();
        $data->id_kelurahan= $request->kelurahan;
        $data->type= 'posyandu';
        $data->nama= $request->nama;
        $data->alamat= $request->alamat;

        $data->save(); 
        return response()->json(['success'=>'Data added successfully','data'=>$data]);
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
        $data = Sekolah::find($id);
        $data->id_kelurahan   = $request->kelurahan_edit;
        $data->type   = 'posyandu';
        $data->nama = $request->nama_edit;
        $data->alamat = $request->alamat_edit;
        $data->save();

        return response()->json(['success'=>'Data added successfully','data'=>$data]);
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
}
