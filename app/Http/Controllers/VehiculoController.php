<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller
{
    public function index(){
        $vehiculo = Vehiculo::all();
        return response()->json([
            'Mensaje' => $vehiculo,
        ]);
    }

    public function registro_unico($id){
        $vehiculo = Vehiculo::find($id);
        if(!$vehiculo){
            return response()->json([
                'messegue'=>'vehiculo no existe',
                200
            ]);
        }
        return response()->json([
            'messegue'=>'Vehiculo',
            'Vehiculo'=>$vehiculo,
            200
        ]);

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'nombre_vehiculo'=>'required|string|unique:vehiculo',
            'descripcion'=>'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $vehiculo = Vehiculo::create([
            'nombre_vehiculo'=> $request->nombre_vehiculo,
            'descripcion'=>$request->descripcion
        ]);
        return response()->json([
            'messegue'=> 'vehiculo creado exitosamente:',
            'vehiculo'=> $vehiculo,
            200
        ]);
    }

    public function update(Request $request, $id){
        $vehiculo= Vehiculo::find($id);
        if(!$vehiculo)
        {
            return response()->json([
                'messegue'=>'Vehiculo no encontrado'
            ]);
        }

        $validator = Validator::make($request->all(),  [
            'nombre_vehiculo'=>'sometimes|unique:vehiculo|string',
            'descripcion'=>'sometimes|string'
            ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $vehiculo ->update([
            'nombre_vehiculo'=> $request->nombre_vehiculo?? $vehiculo->nombre_vehiculo,
            'descripcion'=> $request->descripcion?? $vehiculo->descripcion

        ]);
        return response()->json([
            'messegue'=> 'vehiculo actualizado exitosamente:',
            'vehiculo'=> $vehiculo,
            200
        ]);
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id);
        if(!$vehiculo){
            return response()->json([
                'messegue'=>'vehiculo no encontrado'
            ]);
        }
        $vehiculo->delete();
        return response()->json([
            'messegue'=>'vehiculo eliminado',
            200
        ]);
    }
}
