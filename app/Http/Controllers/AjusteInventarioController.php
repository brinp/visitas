<?php

namespace App\Http\Controllers;

use App\AjusteInventario;
use App\Inventario;
use App\Kardex;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
class AjusteInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AjusteInventario =  AjusteInventario::with(['arqueo'])->orderBy('id', 'desc')->get();
        $AjusteInventarios = [];
        foreach($AjusteInventario as $p){

            $AjusteInventarios[] = [
                "id" => $p->id,
                "codigo" => "#AJUSTE".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "usuario" => Str::upper($p->arqueo->caja->usuario->name),
                "cajaname" => Str::upper($p->arqueo->caja->nombre),
                "item" => Str::upper($p->inventario->producto->descripcion),
                "imagen" => Str::upper($p->inventario->producto->imagen),
                "marca" => Str::upper($p->inventario->producto->marca->marca),
                "lote" => Str::upper($p->inventario->producto->lote),
                "tipo" => $p->tipo==1?'Agregar stock':'Quitar Stock',
                "motivo" => $p->descripcion,
                "cantidad" => $p->cantidad,
                "stock" => $p->stock,
                "ajustado" => $p->ajustado,
                "created_at" => $p->created_at->format('d/m/Y'),
            ];
        }
        return $AjusteInventarios;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $AjusteInventario = new AjusteInventario;
        $AjusteInventario->arqueo_id = $request->arqueo_id;
        $AjusteInventario->inventario_id = $request->inventario_id;
        $AjusteInventario->cantidad = $request->cantidad;
        $inventario = Inventario::where('id','=',$request->inventario_id)->get()->first();
        $stock_actual = $inventario->cantidad;
        if($request->tipo==1){
            $inventario->cantidad = $stock_actual+$request->cantidad;
        }else{
            $inventario->cantidad = $stock_actual-$request->cantidad;
        }
        $inventario->save();
        $AjusteInventario->stock = $stock_actual;
        $AjusteInventario->ajustado = $inventario->cantidad;
        $AjusteInventario->descripcion = $request->descripcion;
        $AjusteInventario->tipo = $request->tipo;
        $AjusteInventario->save();

        $kardex = new Kardex;
        $kardex->inventario_id = $inventario->id;
        $kardex->cantidad = $request->cantidad;
        $kardex->costo = $inventario->costo;
        $kardex->lote = $inventario->cantidad;
        //Falta modificar el stock global
        $kardex->global = Inventario::all()->where('producto_id',$inventario->producto_id)->groupBy('producto_id','distinct')->first()->sum('cantidad');
        //Entrada
        $kardex->tipo = 1;
        $kardex->detalle = "Por #AJUSTE".str_pad($AjusteInventario->id,5,'0',STR_PAD_LEFT);
        $kardex->save();
        return $AjusteInventario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AjusteInventario  $AjusteInventario
     * @return \Illuminate\Http\Response
     */
    public function show(AjusteInventario $AjusteInventario)
    {
        $Ventas = [];
        $Venta = $AjusteInventario->ventas()->where('estado',1)->orderBy('id', 'desc')->get();
        foreach($Venta as $p){
            $estado = ['Vigente','Anulado'];
            $tipo = ['Contado','Credito'];
            $n_estado = $p->estado-1;
            $n_tipo = $p->tipo-1;
            $Ventas[] = [
                "id" => $p->id,
                "codigo" => "#VENTA".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "cliente" => Str::upper($p->cliente->razon),
                "comprobante" => Str::upper($p->correlativo->comprobante->comprobante),
                "nro_comprobante" => Str::upper($p->correlativo->serie)."-".str_pad($p->nrocorrelativo,5,'0',STR_PAD_LEFT),
                "estado" => $estado[$n_estado],
                "tipo" => $tipo[$n_tipo],
                "subtotal" => number_format(floatval($p->subtotal),2),
                "inpuesto" => number_format(floatval($p->inpuesto),2),
                "descuento" => number_format(floatval($p->descuento),2),
                "total" => number_format(floatval($p->total),2),
                "created_at" => $p->created_at->format('d/m/Y'),
                "venta" =>[
                    "id"=>$p->id,
                    "tipo"=>$p->tipo,
                    "estado"=>$p->estado,
                ]

            ];
        }
        $Movimientos = [];
        $Movimiento = $AjusteInventario->movimientoAjusteInventarios()->orderBy('id', 'desc')->get();
        foreach($Movimiento as $p){
            $Movimientos[] = [
                "id" => $p->id,
                "codigo" => "#MOVIMIENTO".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "estado" => $p->estado,
                "descripcion" => $p->descripcion,
                "monto" => number_format(floatval($p->monto),2),
                "created_at" => $p->created_at->format('d/m/Y'),

            ];
        }
        $AjusteInventario->totalmovimientos = $Movimientos;
        $AjusteInventario->totalventas = $Ventas;
        return $AjusteInventario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AjusteInventario  $AjusteInventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjusteInventario $AjusteInventario)
    {
        $AjusteInventario->estado = 2;
        $AjusteInventario->final = $request->final;
        $AjusteInventario->fin = Carbon::now();
        $AjusteInventario->save();
        return $AjusteInventario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AjusteInventario  $AjusteInventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjusteInventario $AjusteInventario)
    {
        //
    }
    public function getAjusteInventarioAbierto($id){
        $validacion = ['usuario_id' => $id, 'estado' => 1];
        $AjusteInventario = AjusteInventario::where($validacion)->get()->first();
        if($AjusteInventario){
            $Ventas = [];
            $Venta = $AjusteInventario->ventas()->where('estado',1)->orderBy('id', 'desc')->get();
            foreach($Venta as $p){
                $estado = ['Vigente','Anulado'];
                $tipo = ['Contado','Credito'];
                $n_estado = $p->estado-1;
                $n_tipo = $p->tipo-1;
                $Ventas[] = [
                    "id" => $p->id,
                    "codigo" => "#VENTA".str_pad($p->id,5,'0',STR_PAD_LEFT),
                    "cliente" => Str::upper($p->cliente->razon),
                    "comprobante" => Str::upper($p->correlativo->comprobante->comprobante),
                    "nro_comprobante" => Str::upper($p->correlativo->serie)."-".str_pad($p->nrocorrelativo,5,'0',STR_PAD_LEFT),
                    "estado" => $estado[$n_estado],
                    "tipo" => $tipo[$n_tipo],
                    "subtotal" => number_format(floatval($p->subtotal),2),
                    "inpuesto" => number_format(floatval($p->inpuesto),2),
                    "descuento" => number_format(floatval($p->descuento),2),
                    "total" => number_format(floatval($p->total),2),
                    "created_at" => $p->created_at->format('d/m/Y'),
                    "venta" =>[
                        "id"=>$p->id,
                        "tipo"=>$p->tipo,
                        "estado"=>$p->estado,
                    ]

                ];
            }
            $Movimientos = [];
            $Movimiento = $AjusteInventario->movimientoAjusteInventarios()->orderBy('id', 'desc')->get();
            foreach($Movimiento as $p){
                $Movimientos[] = [
                    "id" => $p->id,
                    "codigo" => "#MOVIMIENTO".str_pad($p->id,5,'0',STR_PAD_LEFT),
                    "estado" => $p->estado,
                    "descripcion" => $p->descripcion,
                    "monto" => number_format(floatval($p->monto),2),
                    "created_at" => $p->created_at->format('d/m/Y'),

                ];
            }
            $Compras = [];
            $Compra = $AjusteInventario->compras()->where('tipo',1)->orderBy('id', 'desc')->get();
            foreach($Compra as $p){
                $estado = ['Vigente','Anulado'];
                $tipo = ['Contado','Credito'];
                $n_estado = $p->estado-1;
                $n_tipo = $p->tipo-1;
                $Compras[] = [
                    "id" => $p->id,
                    "codigo" => "#COMPRA".str_pad($p->id,5,'0',STR_PAD_LEFT),
                    "proveedor" => Str::upper($p->proveedor->razon),
                    "estado" => $estado[$n_estado],
                    "tipo" => $tipo[$n_tipo],
                    "subtotal" => floatval($p->subtotal),
                    "inpuesto" => floatval($p->inpuesto),
                    "descuento" => floatval($p->descuento),
                    "total" => floatval($p->total),
                    "created_at" => $p->created_at->format('d/m/Y'),

                ];
            }
            $AjusteInventario->totalmovimientos = $Movimientos;
            $AjusteInventario->totalcompras = $Compras;
            $AjusteInventario->totalventas = $Ventas;
            return $AjusteInventario;
        }
    }

}
