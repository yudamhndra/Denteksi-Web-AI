<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orangtua;
use App\Models\Anak;
use App\Models\Reminder;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;



class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(){
        $reminder = Reminder::all();
        return datatables()->of($reminder)
            ->addColumn('action', function($row){

                $btn = '<a href="'.route('reminder.edit',$row->id).'" class="btn btn-warning "><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
                $btn = $btn. ' <button title="Delete" id="btn-delete" class="delete-modal btn btn-danger "><i class="fa fa-trash " ></i> Hapus</button>';


                return $btn;
            })
            ->addColumn('orangtua',function($row){
                return $row->orangtua->nama;
            })
            ->addColumn('anak',function ($row){
                return $row->anak->nama;
            })

            ->rawColumns(['action'])->addIndexColumn()->make(true);
    }
    public function index()
    {
        return view("dokter.reminder.index");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dokter.reminder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reminder = new Reminder();
        $reminder->id_orangtua = $request->id_orangtua;
        $reminder->id_anak = $request->id_anak;
        $reminder->puskesmas= $request->puskesmas;
        $reminder->waktu_pemeriksaan = $request->waktu_pemeriksaan;
        $reminder->description = $request -> description;

        $reminder->save();

        return redirect()->route('reminder.index');
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
}
