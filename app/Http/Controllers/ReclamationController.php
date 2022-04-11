<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;


class ReclamationController extends Controller
{
    public function addReclamation (Request $request){
      $request -> validate([
          'reclamation' => 'required',
      ]);


      $reclam = new Reclamation(
          [
              'reclamation'=>$request->get('reclamation'),

          ]);
      $save = $reclam ->save() ;

      if($save){
        return response()->json([
            'success' => true,
            'message' => 'Successfully created reclamation!'
        ], 201);
    }else{
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong!'
        ], 500);
    }



    }

    public function UpdateReclamation(Request $request,$id){
      $reclam = Reclamation::find($id);
      $reclam->reclamation = $request->get('reclamation');

      $save = $reclam->save();

      if($save){
          return response()->json([
              'message' => 'relacmation updated'
          ],201);

      }else{
          return response ()->json([
              'message'=>'wrong'
          ],500);
      }


    }


   public  function DeleteReclamation($id){
       $reclam = Reclamation::find($id);
       $delete =$reclam->delete();
       if($delete){
           return response()->json([
               'message' =>'reclamation deleted'
           ],201);
       }else{
           return response()->json([
               'message'=>'something went wrong'
           ],500);
       }
   }
}
