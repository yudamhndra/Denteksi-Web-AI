<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseContoller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;
use App\Models\Orangtua;
use Illuminate\Support\Facades\DB;

class UserController extends BaseContoller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' =>['required','email'],
            'password' => ['required']
        ]);

        if($validator->fails()){
            return $this->responseError('Login failed', 422, $validator->errors());
        }

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $response=[
                'email'=>$user->email,
                'token'=> $user->createToken('Mytoken')->accessToken,
                
            ];
            return $this->responseOk($response);

        }else{
            return $this->responseError('Wrong email or password',401);
        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'email' =>['required','email','unique:users'],
            'password' => ['required'],
            
        ]);

        if($validator->fails()){
            return $this->responseError('Register failed', 422, $validator->errors());
        }
        DB::beginTransaction();
        try{
        $user = New User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role ="orangtua";
        
        $user->save();
        $token = $user->createToken('MyToken')->accessToken;
        $orangtua = new Orangtua();
        $orangtua->id_users=$user->id;

        $orangtua->save();
        DB::commit();
         return response()->json([
            "message"=>"success",
            "user"=>$user,
            "orangtua"=>$orangtua,
             "token" =>$token
             ]);
             
        }catch(\Exception $e){
            DB::rollback();
            return $this->responseError('Registratation failed',422);
            }
            
        }

    

    public function logout(Request $request)
    {
       $token= $request->user()->token();
       $token->revoke();
       return response()->json([
         'message' => 'Berhasil Keluar'
       ]);
    }
}
