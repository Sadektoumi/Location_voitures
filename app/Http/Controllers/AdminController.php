<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class AdminController extends Controller
{
    public function CreateAdmin (Request $request){
        $user = Auth::user();
        $roles = $user->roles;
        //return [$roles[0]->name];

                if ($roles[0]->name == 'SuperAdmin'){
                 $user = New User() ;

                 $user->name = $request['name'];
                 $user->lastname = $request['lastname'];
                 $user->tel = $request['tel'];
                 $user->adresse = $request['adresse'];
                 $user->email = $request['email'];
                 $user->password = Hash::make($request['password']);

                 $save = $user->save();
                 $user->assignRole("admin");

                 if($save){
                    return response()->json([
                        'success' => true,
                        'message' => 'Successfully created admin!',

                    ], 201);
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Something went wrong!'
                    ], 500);
                }

               }

            }




            public function UpdateAdmin(Request $request,$id){
                $user = Auth::user();
                $roles = $user->roles;
                //return [$roles[0]->name];

                        if ($roles[0]->name == 'SuperAdmin'){


                $admin=User::find($id);


                $admin->name = $request ->get('name');
                $admin->lastname = $request ->get('lastname');
                $admin->tel = $request ->get('tel');
                $admin->adresse = $request ->get('adresse');
                $admin->email = $request ->get('email');
                $admin ->password = Hash::make($request ->get('password'));

                $save = $admin->save();
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
             'message' => 'C est pas un superadmin!'
         ], 500);
       }
        }



        public  function DeleteAdmin($id){
            $user = Auth::user();
            $roles = $user->roles;
            //return [$roles[0]->name];

                    if ($roles[0]->name == 'SuperAdmin'){

            $admin = User::find($id);
            $delete =$admin->delete();
            if($delete){
                return response()->json([
                    'message' =>'admin deleted'
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
             'message' => 'C est pas un superadmin!'
         ], 500);
       }
        }








            public function index(){

                $user = Auth::user();
                $roles = $user->roles;
                //return [$roles[0]->name];

                if ($roles[0]->name == 'SuperAdmin'){

                $admin = User::role('admin')->get();
                return response()->json([
                    'admins' => $admin,
                ],200);



            }
            else{
                return response()->json([
                 'success' => false,
                 'message' => 'C est pas un superadmin!'
             ], 500);
           }
            }




}
