<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    use ResponseTrait;

    function login(Request $request) : object {
        $validation = Validator::make($request->all(),[
            'email'=>'required|email:rfc,dns|exists:users,email',
            'password'=>'required|string|min:8',
        ]);


        if ($validation->fails()) {
            # code...
            return $this->sendError($validation->errors());
        }

        try {
            //code...

            $user = User::where('email','=',$request->email)->first();

            if ($user) {
                # code...

                if (Hash::check($request->password,$user->password)) {
                    # code...
                    $token = $user->createToken('LaravelChatPassportTokenization')->accessToken;
                    return $this->sendSuccess([
                        'email'=>$user->email,
                        'name'=>$user->name,
                        'token'=>$token
                    ]);
                }
            }

            return $this->sendError(['message'=>'User not exsit']);


        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError(['message'=>$th->getMessage()]);
        }
    }

    function signup(Request $request) : object {
        $validation = Validator::make($request->all(),[
            'email'=>'required|email:rfc,dns|unique:users,email',
            'password'=>'required|string|min:8',
            'name'=>'required|string|min:8',
        ]);

        if ($validation->fails()) {
            # code...
            return $this->sendError($validation->errors());
        }

        try {
            //code...

            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
            ]);

            return $this->sendSuccess([]);

        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError(['message'=>$th->getMessage()]);
        }
    }
}
