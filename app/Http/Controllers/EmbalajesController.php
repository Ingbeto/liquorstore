<?php

namespace App\Http\Controllers;

use App\Embalaje;
use App\Producto;
use Illuminate\Http\Request;

class EmbalajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $embalajes  = Embalaje::all();
        return view('almacen.embalajes.list')->with('embalajes',$embalajes)->with('location','almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'almacen';
        return view('almacen.embalajes.create')->with('location',$location);
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
            'descripcion' => 'required'
        ]);

        $embalaje =  new Embalaje();
        $embalaje->descripcion = $request->descripcion;
        $result = $embalaje->save();

        if($result){
            flash("El Embalajes <strong>" . $embalaje->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return  redirect()->route('embalajes.index');
        }else{
            flash("El Embalajes <strong>" . $embalaje->descripcion. "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

}
