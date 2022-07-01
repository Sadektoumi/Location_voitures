<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VehiculeController extends Controller
{

    public function CreateVehicule(Request $request){
         $validator = Validator::make($request->all(), [
             'Matricule' => 'required',
             'vehicule_pic' => 'required',
             'kilometrage'=>'required',
             'date_mise_en_circulation' =>'required',

            ]);
             if ($validator->fails())
             {
                 return response(['errors'=>$validator->errors()->all()], 400);
            }

        $vehicule = New Vehicule() ;

        $vehicule->Matricule = $request['Matricule'];
        if ($request->file('vehicule_pic')) {
            $file = $request->file('vehicule_pic');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('assets'), $filename);
            $vehicule->vehicule_pic = $filename;
        }
        $vehicule->price= $request->get('price');
        $vehicule->etat = 'disponible';

        $vehicule->kilometrage =$request['kilometrage'];
        $vehicule->date_mise_en_circulation = $request['date_mise_en_circulation'];








        $save = $vehicule->save();

        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Successfully created vehicule!'
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }



    }

    public function UpdateVehicule(Request $request, $id)
    {
        /*$validator = Validator::make($request->all(), [
             'Matricule' => 'required',
             'vehicule_pic' => 'required',
             'kilometrage'=>'required',
             'date_mise_en_circulation' =>'required',
            ]);
             if ($validator->fails())
             {
                 return response(['errors'=>$validator->errors()->all()], 400);
            }*/
        return response()->json([
            'success' => $request['Matricule'],
        ], 201);
        $vehicule = Vehicule::find($id);
        $vehicule->Matricule =  $request->get('Matricule');
        if ($request->file('vehicule_pic')) {
            $file = $request->file('vehicule_pic');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('assets'), $filename);
            $vehicule->vehicule_pic = $filename;

        }
        $vehicule->price= $request->get('price');
        $vehicule->etat = 'disponible';
        $vehicule->kilometrage = $request->get('kilometrage');
        $vehicule->date_mise_en_circulation= $request->get('date_mise_en_circulation');

        // dd($vehicule);
        $save = $vehicule->save();
        if($save){
            return response()->json([
                'success' => true,
                'message' => 'Successfully updated vehicule!'
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }


    }

    public function DeleteVehicule(Request $request, $id)
    {
        $vehicule = Vehicule::find($id);
        $delete = $vehicule->delete();
        if ($delete){
        return  response()->json([
        'success' => true ,
        'message' => 'vehicule deleted!'

    ],201);
    }else{
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong!'
        ], 500);
    }
}


public function index(){
    $cars =Vehicule::all();
    return  response()->json([
        'success' => true ,
        'cars' => $cars

    ],201);




}


}


