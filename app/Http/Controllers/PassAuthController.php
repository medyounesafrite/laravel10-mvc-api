<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PassAuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
//            'password' => brcrypt($request->password)
            'password' => Hash::make($request->password)
        ]);


        $token = $user->createToken('MohamedYounesAFRTITE')->accessToken;


        return response()->json(['token'=>$token],200);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(auth()->attempt($data)){
            $token = auth()->user()->createToken('MohamedYounesAFRITE')->accessToken;
            return response()->json(['token'=>$token,200]);
        }else{
            return response()->json(['error'=>'unauthorised',401]);
        }


    }

    public function userInfo()
    {
        $user = auth()->user();
        return response()->json(['user'=>$user,200]);
    }
}
