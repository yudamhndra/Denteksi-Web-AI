<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Orangtua;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function storeOrangtua(Request $request)
    {
        
        
        DB::beginTransaction();
        try{
        $user = New User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role ="orangtua";
        if($user){
            $user->save();
        }
        if($user){
            $orangtua = new Orangtua();
            $orangtua->id_users=$user->id;
            $orangtua->nama = $request->nama;
            $orangtua->alamat = $request->alamat;
            $orangtua->pendidikan= $request->pendidikan;
            if($orangtua){
                $orangtua->save();
                
            }
        DB::commit();
            return redirect('/');
        }
    }catch(\Exception $e){
        DB::rollback();
        return redirect('/');
    }
    }
    protected function create(array $data)
    {
        $user = New User([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'orangtua'
        ]);
        $user->save();
        $user_id = $user->id;

        Orangtua::create([
            'id_user' =>$data['id_user'],
            'nama' => $data['nama'],
            'alamat' => $data['id_kecamatan'],
            'pendidikan' => $data['pendidikan']
        ]);
    }
}
