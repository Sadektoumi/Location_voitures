<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function AddReservation( Request $request)
    {
        $request -> validate([
            'date_deb'=>'required',
            'date_fin'=>'required',
            'name'=>'required',
            'lastname'=>'required',
            'phone'=>'required',
            'cin'=>'required',


        ]);

        $reservation = new Reservation(
           [

               'name'=>$request->get('name'),
               'user_id'=>$request->get('user_id'),
               'lastname'=>$request->get('lastname'),
               'phone'=>$request->get('phone'),
               'cin'=>$request->get('cin'),
               'etat' =>$request->get('etat'),
               'date_deb'=>$request->get('date_deb'),
               'date_fin'=>$request->get('date_fin'),
               'vehicule_id' => $request->get('vehicule_id')
           ]
           );
        $save = $reservation->save();

        if($save){
            Vehicule::where('id' , $request->get('vehicule_id'))->update(['etat' => 'reserved']);
            return response()->json([
                'message'=>'Reservation added successfully'
            ],201

            );
        }else{
            return response()->json([
                'message' =>'something went wrong'
            ],500
        );
    };
    }
    public function UpdateReservation(Request $request,$id){
     $reservation=Reservation::find($id);
     $reservation->etat = $request->get('etat');
     $reservation->date_deb =$request ->get('date_deb');
     $reservation->date_fin=$request ->get('date_fin');

     $save = $reservation->save();
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

    public  function DeleteReservation($id){


        $reservation = Reservation::find($id);
         $delete =$reservation->delete();

        if($delete){
        return response()->json([
            'message' =>'reservation deleted'
            ],201);
        }else{
        return response()->json([
            'message'=>'something went wrong'
            ],500);
             }
    }
    public function index(){
        $Reservation =Reservation::with('users')->get();
        return  response()->json([
            'success' => true ,
            'message' => $Reservation
        ],201);
    }

    public function user_reservation(Request $request){
        $Reservation =Reservation::with('vehicule')->where('user_id', $request->user()->id)->get();
        return  response()->json([
            'success' => true ,
            'message' => $Reservation
        ],201);
    }


}
