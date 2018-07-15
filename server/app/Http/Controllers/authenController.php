<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class authenController extends Controller
{
    public function login(request $request){
    	$check = User::where([
    	 	['email', $request->email],
    	 	['password', hash('ripemd160',$request->password)]
    	 ])->select('name', 'id', 'email')->first();
		if($check==null){
			return ["result" => 0, "error" => "Wrong Email or Password"];
		}
		$check->token = hash('ripemd160',$request->password.strval(rand(0,2000000000)));
		User::where('id', $check->id)->update([
                'remember_token' => $check->token
        ]);
		$check->result = 1;
		return $check;
    }

    public function register(request $request){
		$check = User::where('email', $request->email)->first();
		if($check!=NULL){
			return ["result" => 0, "error" => "Account already existed"];
		}
    	$newUser = new User;
    	$newUser->email = $request->email;
    	$newUser->password = hash('ripemd160',$request->password);
    	$newUser->name = $request->email;
    	$newUser->save();
    	return ["result" => 1];
    }

    public function token(request $request){
        $check = User::where([
            ['remember_token', $request->token],
         ])->select('name', 'id', 'email')->first();
        if($check==null){
            return ["result" => 0];
        }
        $check->token = hash('ripemd160',$request->token.strval(rand(0,2000000000)));
        User::where('id', $check->id)->update([
                'remember_token' => $check->token
        ]);
        $check->result = 1;
        return $check;
    }
}
