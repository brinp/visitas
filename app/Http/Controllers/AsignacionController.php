<?php

namespace App\Http\Controllers;

use App\Asignacion;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal =  Asignacion::all();
        $sucursals = [];
        foreach($sucursal as $p){
            $sucursals[] = [
                "id" => $p->id,
                "codigo" => "SUCURSAL".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "razon" => $p->sucursal->razon,
                "usuario" => $p->usuario->name,

            ];
        }
        return $sucursals;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Asignacion = new Asignacion;

        $Asignacion->sucursal_id =  $request->sucursal_id;
        $Asignacion->usuario_id =  $request->usuario_id;
        $Asignacion->save();

        return $Asignacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function show(Asignacion $asignacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asignacion $asignacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignacion $asignacion)
    {
        //
    }
    public function getSucursalAsignada($id){
        $asignacion =  Asignacion::where('usuario_id','=',$id)->get();
        $asig=[];
        foreach($asignacion as $a){
            $asig[]=[
                "id" => $a->id,
                "razon" => $a->sucursal->razon
            ];
        }
        return $asig;
    }
}
