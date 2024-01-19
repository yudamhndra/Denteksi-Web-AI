<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(){
        $artikel = Artikel::orderBy('judul','desc')->get();
        return datatables()->of($artikel)
        ->addColumn('action', function($row){

            $btn = '<a type="button" id="btn-pdf" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>';
            $btn = $btn. ' <a href="'.route('artikel.edit',$row->id).'" type="button" id="btn-edit" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>';
            $btn = $btn.  ' <a type="button" id="btn-delete" class="btn btn-danger"> <i class="fa fa-trash " ></i> Hapus</a>';

           return $btn;
       })
       ->addColumn('gambar',function($row){
        // $url= url('storage/artikel/'.$row->gambar);
        $url = asset($row->gambar);
        $gambar='<img src="'.$url.'"  width="50" height="50" class="img-fluid" align="center" alt="" />';
        // $gambar='<p>'.$url.'</p>';
        return $gambar;
       })

       ->addIndexColumn()
       ->rawColumns(['gambar','action'])
       ->make(true);
    }

    public function index()
    {
        return view('admin.artikel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artikel.create');
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
            'gambar.required'=>'Gambar wajib diisi',
            'artikel.required'=>'Artikel wajib diisi',

        ];
        $validator = $request->validate([
            'judul' => 'required',
            'gambar' => 'required',
            'artikel' => 'required'
        ], $messages);

        $artikel = new Artikel();
        $artikel->judul = $request->judul;
        if(!empty($request->gambar)){
            $file = $request->file('gambar');
            // $extension = strtolower($file->getClientOriginalExtension());
            // $filename = uniqid() . '.' . $extension;
            $filename = time().'_'.$request->gambar->getClientOriginalName();
            $filePath = $request->file('gambar')->storeAs('uploads', $filename, 'public');
            Image::make(storage_path().'/app/public/uploads/'.$filename)
            ->fit(240,320)
            ->save();
            // Storage::put('public/artikel/' . $filename, File::get($file));
        //    $artikel->gambar=$filename;
           $artikel->gambar=$filePath;
       }
        if(!empty($request->artikel)){
            $file = $request->file('artikel');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = uniqid() . '.' . $extension;
            Storage::put('public/artikel/' . $filename, File::get($file));
            $artikel->artikel=$filename;
        }
        $artikel->save();
        return redirect()->route('artikel.index');

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
        $artikel=Artikel::find($id);
        return view('admin.artikel.edit',compact('artikel'));
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

        $artikel=Artikel::find($id);
        $artikel->judul=$request->judul_edit;
        if(!empty($request->gambar_edit)){

            $file = $request->file('gambar_edit');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = uniqid() . '.' . $extension;
            Storage::delete('/public/artikel/'.$artikel->gambar);
            Storage::put('public/artikel/' . $filename, File::get($file));
            $artikel->gambar=$filename;
       }
       if(!empty($request->artikel_edit)){

        $file = $request->file('artikel_edit');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid() . '.' . $extension;
        Storage::delete('/public/artikel/'.$artikel->artikel);
        Storage::put('public/artikel/' . $filename, File::get($file));
        $artikel->artikel=$filename;
        }
        $artikel->save();

        return redirect()->route('artikel.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel=Artikel::find($id);
        Storage::delete('/public/artikel/'.$artikel->gambar);
        Storage::delete('/public/artikel/'.$artikel->artikel);

        $artikel->delete();
    }

    public function artikelView($id){

        $artikel=Artikel::find($id);
        return view('orangtua.dashboard.artikel', compact('artikel'));

    }
}
