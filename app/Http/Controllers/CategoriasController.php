<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Producto;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias  = Categorias::all();
        return view('almacen.categorias.list')->with('categoria',$categorias)->with('location','almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = 'almacen';
        return view('almacen.categorias.create')->with('location',$location);
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

        $categoria =  new Categorias();
        $categoria->nombre = $request->nombre;
        $result = $categoria->save();

        if($result){
            flash("La Categorias <strong>" . $categoria->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return  redirect()->route('categorias.index');
        }else{
            flash("La Categorias <strong>" . $categoria->nombre . "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }
}
