<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Usuario::get();
        $usuarios = [];
        foreach($usuario as $p){
            $usuarios[] = [
                "id" => $p->id,
                "codigo" => "USUARIO".str_pad($p->id,5,'0',STR_PAD_LEFT),
                "name" => $p->name,
                "email" => $p->email,
                "level" => $p->level,
                "active_user" => $p->active_user,
                "imagen" => $p->profile,
            ];
        }
        return $usuarios;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')->store('public/imagenes/usuario');
            $url = Storage::url($imagen);
            $usuario->profile =  $url;
        }
        $usuario->active_user = $request->active_user;
        $usuario->level = $request->level;
        $usuario->save();
        return $usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if ($request->hasFile('imagen')) {
            $img = str_replace("storage","public",$usuario->profile);
            $imagen = $request->file('imagen')->store('public/imagenes/usuario');
            $url = Storage::url($imagen);
            $usuario->profile =  $url;
            Storage::delete($img);
        }
        if(!empty($request->password)){
            $usuario->password =  bcrypt($request->password);
        }
        $usuario->active_user = $request->active_user;
        $usuario->level = $request->level;
        $usuario->save();
        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $img = str_replace("storage","public",$usuario->imagen);
        Storage::delete($img);
        $usuario->delete();
    }
}
