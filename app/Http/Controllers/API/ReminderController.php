<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Orangtua;
use App\Models\Reminder;
use Illuminate\Http\Request;

use Auth;

class ReminderController extends Controller
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
        //
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

    public function  getReminder(Request $request){
        $user = Auth::user();
        $orangtua = Orangtua::Where('id_users', Auth::user()->id)->value('id');
        $reminder = Reminder::Where('id_orangtua',$orangtua)->orderBy('waktu_pemeriksaan','ASC')->get();

        $data=[];
        foreach ($reminder as $key => $value){

            if($value->waktu_pemeriksaan){
                $waktu_pemeriksaan = date('d-m-Y', strtotime($value->waktu_pemeriksaan));
            }


            $data [] = [
                'id_orangtua'=> $value->id_orangtua,
                'anak'=> $value->anak->nama,
                'puskesmas'=> $value->puskesmas,
                'tanggal' => $waktu_pemeriksaan,
                'deskripsi'=> $value->description,
            ];

        }
        return response()->json([
            'messages'=> 'success',
            'data' => $data
        ]);


    }
}
