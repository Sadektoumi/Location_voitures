<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users= User::role('user')->get();
        return  response()->json([
            'success' => true ,
            'users' => $users

        ],201);

    }

        public  function DeleteUser($id){




            $user = User::find($id);
            $delete = $user->delete();
            if($delete){
                return response()->json([
                    'message' =>'user deleted'
                ],201);
            }else{
                return response()->json([
                    'message'=>'something went wrong'
                ],500);
            }
        }


    }

