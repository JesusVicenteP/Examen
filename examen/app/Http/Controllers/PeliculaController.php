<?php

namespace App\Http\Controllers;

use App\Models\pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeliculaController extends Controller
{
    
    public function index(Request $request)
    {
        return pelicula::all();
    }

    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'ruta'=> 'required',
            'duracion'=> 'required',
            'clasificacion'=> 'required'
        ]);

        $peliculas = pelicula::create($request->all());

        return \response($peliculas);
    }

    
    public function show(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $response = pelicula::where('id', $request->id)
            ->get();

        return response()->json($response);
    }

    public function update(Request $request, $id)
    {

        $rules=[
            'nombre'=>'required',
            'ruta'=> 'required',
            'duracion'=> 'required',
            'clasificacion'=> 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $validator->errors();
        }
        $peli = pelicula::find($id);

        if($peli){

            $peli-> nombre= $request->nombre;
            $peli-> ruta= $request->ruta;
            $peli-> duracion= $request->duracion;
            $peli-> clasificacion= $request->clasificacion;

        if($peli->update()){
            return response()->json([
                'mensaje'=>'registro actualizado',
                'datos'=>$peli
            ],200);
        }else{
            return response()->json([
                'message' => 'Error al actualizar el registro',
                'data' => false
            ], 400);
        }
    } else {
        return response()->json([
            'message' => 'La pelicula no existe',
            'data' => false
        ], 400);  
        }
    }


    public function destroy(Request $request)
    { 
        $request->validate([
        'id' => 'required'
    ]);
        pelicula::destroy('id', $request->id);

        return \response('La pelicula a sido borrada de cartelera');
    }
}
