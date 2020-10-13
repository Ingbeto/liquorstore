<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Subcategoria;
use App\Producto;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategorias  = Subcategoria::all();
        return view('almacen.subcategorias.list')->with('subcategorias',$subcategorias)->with('location','almacen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias =  Categorias::all();
        $location = 'almacen';
        return view('almacen.subcategorias.create',compact('categorias','location'));
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

        $subcategoria =  new Subcategoria();
        $subcategoria->categoria_id= $request->categoria_id;
        $subcategoria->nombre = $request->nombre;
        $result = $subcategoria->save();

        if($result){
            flash("La Subcategoria <strong>" . $subcategoria->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return  redirect()->route('subcategorias.index');
        }else{
            flash("La Subategoria <strong>" . $subcategoria->nombre . "</strong> no fue almacenada de forma exitosa!")->error();
            return  redirect()->back();
        }
    }

}
