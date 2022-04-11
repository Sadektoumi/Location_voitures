<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function AddReservation( Request $request)
    {
        $request -> validate([
            'etat'=>'required',
            'date_deb'=>'required',
            'date_fin'=>'required',

        ]);

        $reservation = new Reservation(
           [
               'etat' =>$request->get('etat'),
               'date_deb'=>$request->get('date_deb'),
               'date_fin'=>$request->get('date_fin')
           ]


           );
        $save = $reservation->save();

        if($save){
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



}
