<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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
        //$user->id = Str::uuid();
        $user->name = $request['name'];
        $user->lastname = $request['lastname'];
        $user->tel = $request['tel'];
        $user->adresse = $request['adresse'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);

        $save = $user->save();
        $user->assignRole("user");




        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Successfully created user!',

            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }


    public function asynrole(Request $request){

        $admin = New user() ;

        $admin->name = "Superadmin";
        $admin->lastname ="Superadmin";
        $admin->tel ="1111";
        $admin->adresse ="SSS";

        $admin->email = "superadmin@admin.com";
        $admin->password = Hash::make($request['password']);

        $admin->save();
        $admin->assignRole("SuperAdmin");
        // $all_users_with_all_their_roles = User::with('roles')->get();
        // return response()->json([

        //     'message' => $all_users_with_all_their_roles
        // ], 500);



    }
}
