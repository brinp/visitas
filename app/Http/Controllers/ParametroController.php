<?php

namespace App\Http\Controllers;

use App\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Parametro::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parametro = new Parametro;
        $parametro->id = 1;
        $parametro->documento_id = $request->documento_id;
        $parametro->nrodocumento = $request->nrodocumento;
        $parametro->logo = $request->imagen;
        $parametro->razon = $request->razon;
        $parametro->telefono = $request->telefono;
        $parametro->direccion = $request->direccion;
        $parametro->horarios = $request->horario;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('public/imagenes/sucursal');
            $url = Storage::url($logo);
            $parametro->logo =  $url;
        }
        $parametro->save();
        return $parametro;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parametro  $parametro
     * @return \Illuminate\Http\Response
     */
    public function show(Parametro $parametro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parametro  $parametro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parametro $parametro)
    {
        $parametro->documento_id = $request->documento_id;
        $parametro->nrodocumento = $request->nrodocumento;
        $parametro->razon = $request->razon;
        $parametro->telefono = $request->telefono;
        $parametro->direccion = $request->direccion;
        $parametro->horarios = $request->horarios;
        if ($request->hasFile('logo')) {
            $img = str_replace("storage","public",$parametro->logo);
            $imagen = $request->file('logo')->store('public/imagenes/sucursal');
            $url = Storage::url($imagen);
            $parametro->logo =  $url;
            Storage::delete($img);
        }
        $parametro->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parametro  $parametro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parametro $parametro)
    {
        //
    }
}
