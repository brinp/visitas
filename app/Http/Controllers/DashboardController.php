<?php

namespace App\Http\Controllers;
use App\Visita;
use App\Visitante;
use App\Responsable;
use App\Area;
use App\Sucursal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function visitasmensuales()
    {
        $hoy = Carbon::now();
        $data = [];
        for ($i=0; $i <=11 ; $i++) {
            $total = Visita::whereYear('created_at', '=', $hoy->year)->whereMonth('created_at', '=', $i+1)->count();
            $data[] = floatval(number_format($total,2));
            # code...
        }
        return $data;
    }
    public function visiongeneral(){
        $Visitante = Visitante::get()->count();
        $Visita = Visita::get()->count();
        $Area = Area::get()->count();
        $Responsable = Responsable::get()->count();
        $Sucursal = Sucursal::get()->count();

        return [$Visitante,$Visita,$Area,$Responsable,$Sucursal];
    }
    public function ultimasvisitas(){
        $ordenservicio =  Visita::with(['visitante'])->orderBy('id', 'desc')->get()->take(10);
        $ordenservicios = [];
        foreach($ordenservicio as $p){
            $estado = ['En curso','Culminado'];
            $color = ['primary','success'];
            $n_estado = $p->estado-1;

            $ordenservicios[] = [
                "id" => Str::upper($p->id),
                "codigo" => "#VISITA".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "visitante" => Str::upper($p->visitante->razon),
                "doc" => Str::upper($p->visitante->documento->sigla)." ".$p->visitante->nrodocumento,
                "responsable" => Str::upper($p->responsable->razon),
                "area" => Str::upper($p->responsable->area->area),

                "estado" => $estado[$n_estado],
                "color" => $color[$n_estado],
                "created_at" => $p->created_at->diffForHumans(now()),

            ];

        }
        return $ordenservicios;
    }
    public function visitassucursal(){
        $sucursales =  Visita::join('turnos', 'visitas.turno_id', '=', 'turnos.id')->join('asignacions', 'turnos.asignacion_id', '=', 'asignacions.id')->join('sucursals', 'asignacions.sucursal_id', '=', 'sucursals.id')->select('visitas.*', 'sucursals.razon as sucursal' )->get()->groupBy('sucursal','distinct');
        $sucursales = collect($sucursales);
        $sucursales = $sucursales->map(function ($row) {
            return [
                "id"=>$row->first()->id,
                "sucursal"=>$row->first()->sucursal,
                "cantidad"=>$row->count()
            ];
        });
        return $sucursales->take(10)->values();
    }
}
