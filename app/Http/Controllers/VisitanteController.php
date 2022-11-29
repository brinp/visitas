<?php

namespace App\Http\Controllers;

use App\Visitante;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente =  Visitante::with('documento')->get();
        $clientes = [];
        foreach($cliente as $p){
            $clientes[] = [
                "id" => $p->id,
                "codigo" => "VISITANTE".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "razon" => $p->razon,
                "nrodocumento" => $p->nrodocumento,
                "telefono" => $p->telefono,
                "direccion" => $p->direccion,
                "doc" => $p->documento->sigla,
                "documento" => [
                    "id" => $p->documento->id,
                    "sigla" => $p->documento->sigla
                ],
                "ordenes" => $p->ordenservicios
            ];
        }
        return $clientes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Visitante;

        $cliente->razon =  $request->razon;
        $cliente->documento_id =  $request->documento_id;
        $cliente->nrodocumento =  $request->num;
        $cliente->telefono =  $request->telefono;
        $cliente->direccion =  $request->direccion;
        $cliente->save();

        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function show(Visitante $visitante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitante $visitante)
    {
        $visitante->razon =  $request->razon;
        $visitante->documento_id =  $request->documento_id;
        $visitante->nrodocumento =  $request->num;
        $visitante->telefono =  $request->telefono;
        $visitante->direccion =  $request->direccion;
        $visitante->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitante $visitante)
    {
        $visitante->delete();
    }
}
