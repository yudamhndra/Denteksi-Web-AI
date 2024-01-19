<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orangtua;
use App\Models\Sekolah;
use App\Models\Anak;
use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(){
        $admin = User::where('role','admin')->get();
        return datatables()->of($admin)
        ->addColumn('action', function($row){
            
            $btn = '<a href="'.route('admin.edit',$row->id).'" type="button" id="btn-edit" class="btn btn-warning "><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
            if(Auth::user()->id != $row->id){
                $btn = $btn .' <button title="Delete" id="btn-delete" class="delete-modal btn btn-danger "><i class="fa fa-trash " ></i>Hapus</button>';
            }
            

            
            return $btn;
        })
        ->rawColumns(['action'])->addIndexColumn()->make(true);
    }

    public function index()
    {
        return view('admin.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
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

            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terpakai.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 4 karaketer.',


        ];
        $validator = $request->validate([

            'email' => ['required', 'email',
                        Rule::unique('users', 'email')],
            'password' => 'required',


        ], $messages);
        $user = New User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role ="admin";
        $user->save();
        return redirect()->route('admin.index')->with('success','Data berhasil ditambahkan');
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
        $admin= User::find($id);
        return view('admin.admin.edit',compact('admin'));
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

            'email.required' => 'Email wajib diisi.',
            



        ];
        $validator = $request->validate([

            'email' => ['required', 'email',
                        Rule::unique('users', 'email')->ignore($id)],
           

        ], $messages);
        $admin= User::find($id);
        $admin->email = $request->email;
        if($request->password != null){
            $admin->password = bcrypt($request->password);
        }
        $admin->role ="admin";
        $admin->save();

        return redirect()->route('admin.index')->with('success','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin= User::find($id);
        $admin->delete();
        
    }

    public function dashboard(){
        $orangtua = DB::table('orangtua')->count();
        $anak = Anak::count();
        $sekolah = Sekolah::where('type','sekolah')->count();


        return view('admin.dashboard.dashboard',compact('orangtua','anak','sekolah'));
    }
}
