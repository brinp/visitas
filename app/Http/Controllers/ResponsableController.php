<?php

namespace App\Http\Controllers;

use App\Responsable;
use Illuminate\Http\Request;

class ResponsableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Responsable =  Responsable::with('area')->get();
        $Responsables = [];
        foreach($Responsable as $p){
            $Responsables[] = [
                "id" => $p->id,
                "codigo" => "RESPONSABLE".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "serie" => $p->serie,
                "area" => [
                    "id" => $p->area->id,
                    "area" => $p->area->area
                ],
                "razon" => $p->razon,
            ];
        }
        return $Responsables;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Responsable = new Responsable;

        $Responsable->razon =  $request->razon;
        $Responsable->area_id =  $request->area_id;
        $Responsable->save();

        return $Responsable;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function show(Responsable $responsable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Responsable $responsable)
    {
        $responsable->razon =  $request->razon;
        $responsable->area_id =  $request->area_id;

        $responsable->save();

        return $responsable;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Responsable  $responsable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Responsable $responsable)
    {
        return $responsable->delete();
    }
}
