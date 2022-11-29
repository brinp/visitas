<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visita =  Visita::with(['visitante','responsable'])->orderBy('id','desc')->get();
        $visitas = [];
        foreach($visita as $p){

            $visitas[] = [
                "id" => $p->id,
                "codigo" => "VISITA".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "asunto" => Str::upper($p->asunto),
                "estado" => Str::upper($p->estado),
                "visitante" => Str::upper($p->visitante->razon),
                "nrodocumento" => Str::upper($p->visitante->nrodocumento),
                "responsable" => Str::upper($p->responsable->razon),
                "imagen" => $p->imagen,
                "area" => Str::upper($p->responsable->area->area),
                "sucursal" => Str::upper($p->turno->asignacion->sucursal->razon),
                "usuario" => Str::upper($p->turno->asignacion->usuario->name),
                "inicio" => Carbon::parse($p->inicio)->format('Y-m-d H:i:s'),
                "fin" => $p->fin!=null?Carbon::parse($p->fin)->format('Y-m-d H:i:s'):"Visita en Curso",
                "visita"=>$p
            ];
        }
        return $visitas;
    }
    public function hoy()
    {
        $visita =  Visita::with(['visitante','responsable'])->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->orderBy('id','desc')->get();
        $visitas = [];
        foreach($visita as $p){

            $visitas[] = [
                "id" => $p->id,
                "codigo" => "VISITA".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "asunto" => Str::upper($p->asunto),
                "estado" => Str::upper($p->estado),
                "visitante" => Str::upper($p->visitante->razon),
                "nrodocumento" => Str::upper($p->visitante->nrodocumento),
                "responsable" => Str::upper($p->responsable->razon),
                "imagen" => $p->imagen,
                "area" => Str::upper($p->responsable->area->area),
                "inicio" => Carbon::parse($p->inicio)->format('Y-m-d H:i:s'),
                "fin" => $p->fin!=null?Carbon::parse($p->fin)->format('Y-m-d H:i:s'):"Visita en Curso",
                "visita"=>$p
            ];
        }
        return $visitas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visita = new Visita;
        $visita->asunto =  $request->asunto;
        $visita->responsable_id =  $request->responsable_id;
        $visita->visitante_id =  $request->visitante_id;
        $visita->turno_id =  $request->turno_id;
        $visita->inicio = Carbon::now();
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')->store('public/imagenes/visita');
            $url = Storage::url($imagen);
            $visita->imagen =  $url;
        }
        $visita->estado = 1;
        $visita->save();
        return $visita;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function show(Visita $visita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visita $visita)
    {
        $visita->fin = Carbon::now();
        $visita->estado = 2;
        $visita->save();
        return $visita;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visita $visita)
    {
        //
    }
}
