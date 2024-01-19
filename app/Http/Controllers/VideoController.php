<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(){
        $video = Video::orderBy('judul','desc')->get();
        return datatables()->of($video)
        ->addColumn('action', function($row){
            
          
            $btn =  '<a type="button" id="btn-edit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';
            $btn = $btn. ' <a type="button" id="btn-delete" class="btn btn-danger"> <i class="fa fa-trash " ></i>Hapus</a>';
            
       
           return $btn;
       })
       ->addColumn('link',function($row){
        return '<iframe width="426" height="240" src="'.$row->link.'">
            </iframe>';
       })
      

       ->addIndexColumn()
       ->rawColumns(['link','action'])
       ->make(true);
    }
    
    public function index()
    {
        return view('admin.video.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
           
            'judul.required' => 'Judul wajib diisi.',
            'link.required'=>'Link wajib diisi',

        ];
        $validator = $request->validate([
            'judul' => 'required',
            'link' => 'required' 
        ], $messages);

        $video = new Video();
        $video->judul = $request->judul;
        $video->link = $request->link;
        
        
        $video->save();
        return response()->json(['success'=>'Data added successfully','video'=>$video]);
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
        $messages = [
           
            

        ];
        $validator = $request->validate([
            
        ], $messages);

        $video=Video::find($id);
        $video->judul=$request->judul_edit;
        if(!empty($request->link_edit)){
            $video->link=$request->link_edit;
        }
        
        
        $video->save();

        return response()->json(['success'=>'Data added successfully','video'=>$video]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video=Video::find($id);
        $video->delete();

        return response()->json(['success'=>'Data delete successfully']);
    }
}
