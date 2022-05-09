<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController1 extends Controller
{
    public function Register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'tel' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 400);
        }

        $user = New User() ;
        $user->id = Str::uuid();
        $user->name = $request['name'];
        $user->lastname = $request['lastname'];
        $user->tel = $request['tel'];
        $user->adresse = $request['adresse'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $save = $user->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Successfully created user!'
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }
}
