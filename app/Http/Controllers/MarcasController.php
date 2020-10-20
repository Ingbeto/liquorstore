<?php

namespace App\Http\Controllers;

use App\Marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marcas::all();
        return view('almacen.marcas.list')->with('marcas',$marcas)->with('location','almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'almacen';
        return view('almacen.marcas.create')->with('location',$location);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $exist = Marcas::where('nombre',$request->nombre)->first();

        if($exist){
            flash("El nombre de la marca $request->nombre ya existe")->error();
            return  redirect()->back();
        }

        $marca =  new Marcas();
        $marca->nombre = $request->nombre;
        $result = $marca->save();

        if($result){
            flash("La Marca <strong>" . $marca->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return  redirect()->route('marcas.index');
        }else{
            flash("La Marca <strong>" . $marca->nombre . "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }

    }

}
