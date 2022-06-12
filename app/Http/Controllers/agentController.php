<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;



class agentController extends Controller
{

    public function CreateAgent (Request $request){
$user = Auth::user();
$roles = $user->roles;
//return [$roles[0]->name];

        if ($roles[0]->name == 'admin'){
         $user = New User() ;

         $user->name = $request['name'];
         $user->lastname = $request['lastname'];
         $user->tel = $request['tel'];
         $user->adresse = $request['adresse'];
         $user->email = $request['email'];
         $user->password = Hash::make($request['password']);

         $save = $user->save();
         $user->assignRole("agent");

         if($save){
            return response()->json([
                'success' => true,
                'message' => 'Successfully created agent!',

            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }

       }
       else{
           return response()->json([
            'success' => false,
            'message' => 'C est pas un admin!'
        ], 500);
      }
       }




       public function UpdateAdmin(Request $request,$id){
        $user = Auth::user();
        $roles = $user->roles;
        //return [$roles[0]->name];

                if ($roles[0]->name == 'admin'){


        $agent=User::find($id);


        $agent->name = $request ->get('name');
        $agent->lastname = $request ->get('lastname');
        $agent->tel = $request ->get('tel');
        $agent->adresse = $request ->get('adresse');
        $agent->email = $request ->get('email');
        $agent ->password = Hash::make($request ->get('password'));

        $save = $agent->save();
        if($save){
            return response()->json([
                'message' => 'updated',
            ],201
           );
        }
        else{
            return response()->json([
                'message' =>'something wrong'
            ],500);
        }



    }

else{
    return response()->json([
     'success' => false,
     'message' => 'C est pas un admin!'
 ], 500);
}
}



public  function DeleteAdmin($id){
    $user = Auth::user();
    $roles = $user->roles;
    //return [$roles[0]->name];

            if ($roles[0]->name == 'admin'){

    $agent = User::find($id);
    $delete =$agent->delete();
    if($delete){
        return response()->json([
            'message' =>'agent deleted'
        ],201);
    }else{
        return response()->json([
            'message'=>'something went wrong'
        ],500);
    }
}
else{
    return response()->json([
     'success' => false,
     'message' => 'C est pas un admin!'
 ], 500);
}
}

       public function index(){
        $user = Auth::user();
        $roles = $user->roles;
        //return [$roles[0]->name];

                if ($roles[0]->name == 'admin'){
        $agent = User::role('agent')->get();
        return response()->json([
            'agents' => $agent,
        ],500);


    }}

    }

