<?php

namespace App\Http\Controllers;

use App\Turno;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turno = Turno::orderBy('id', 'desc')->get();
        $turnos = [];
        foreach($turno as $p){
            $turnos[] = [
                "id" => $p->id,
                "codigo" => "#TURNO".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "responsable_name" => $p->asignacion->usuario->name,
                "responsable_sucursal" => $p->asignacion->sucursal->razon,
                "descripcion" => $p->descripcion,
                "estado" => $p->estado,
                "nrovisitas" =>$p->visitas()->count(),
                "created_at" => $p->created_at->format('d/m/Y H:i:s A'),
            ];
        }
        return $turnos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $caja = new Turno;

        $caja->estado =  1;
        $caja->asignacion_id =  $request->asignacion_id;
        $caja->save();

        return $caja;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function show(Turno $turno)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turno $turno)
    {
        $turno->estado =  2;
        $turno->descripcion =  $request->descripcion;
        $turno->save();

        return $turno;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turno $turno)
    {
        //
    }
    public function getArqueoAbierto($id){
        $validacion = ['estado' => 1];
        $Turno = Turno::where($validacion)->get();
        foreach($Turno as $t){
            if($t->asignacion->usuario->id ==$id){
                $visita =  $t->visitas()->orderBy('id','desc')->get();
                $visitas = [];
                foreach($visita as $p){

                    $visitas[] = [
                        "id" => $p->id,
                        "codigo" => "VISITA".str_pad($p->id,5,'0',STR_PAD_LEFT),
                        "asunto" => Str::upper($p->asunto),
                        "estado" => Str::upper($p->estado),
                        "visitantename" => Str::upper($p->visitante->razon),
                        "nrodocumento" => Str::upper($p->visitante->nrodocumento),
                        "responsable" => Str::upper($p->responsable->razon),
                        "imagen" => $p->imagen,
                        "area" => Str::upper($p->responsable->area->area),
                        "inicio" => Carbon::parse($p->inicio)->format('Y-m-d H:i:s'),
                        "visita"=>$p
                    ];
                }
                $t->visitalist = $visitas;
                return $t;
            }
        }
    }
}
