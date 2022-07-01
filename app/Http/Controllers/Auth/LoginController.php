<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class LoginController extends Controller
{
     /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function Register (Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'lastname' => 'required|string|max:255',
    //         'tel' => 'required|string|max:255',
    //         'adresse' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6',
    //     ]);
    //     if ($validator->fails())
    //     {
    //         return response(['errors'=>$validator->errors()->all()], 400);
    //     }

    //     $user = New User() ;
    //     $user->id = Str::uuid();
    //     $user->name = $request['name'];
    //     $user->lastname = $request['lastname'];
    //     $user->tel = $request['tel'];
    //     $user->adresse = $request['adresse'];
    //     $user->email = $request['email'];
    //     $user->password = Hash::make($request['password']);
    //     $save = $user->save();

    //     if($save){
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Successfully created user!'
    //         ], 201);
    //     }else{
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Something went wrong!'
    //         ], 500);
    //     }
    // }

    public function Login(Request $request){



        $validator =  Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 400);

        }



        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;
        $roles = $user->getRoleNames();

        return response()->json([
                    'message'=>'user connected', $user,
                   'access_token' => $token,
                   'role' => $roles,
                   'user' => $user
        ]);
    }



}
