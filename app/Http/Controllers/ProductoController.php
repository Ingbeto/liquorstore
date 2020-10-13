<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\Embalaje;
use App\Kardex;
use App\Marcas;
use App\Producto;
use App\Kardexes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        $location = 'almacen';
        return view('almacen.productos.list',compact('productos','location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $embalajes =  Embalaje::all();
        $marcas = Marcas::all();
        $categorias = Categorias::all();
        $location = 'almacen';
        return view('almacen.productos.create',compact('embalajes','location','marcas','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ASI DEBE USARSE EL REQUEST
        $request->validate([
            'nombre' => 'required',
            'presentacion' => 'required',
            'stock_minimo' => 'required|numeric',
            'stock_maximo' => 'required|numeric',
            'marca_id' => 'required',
            'subcategoria_id' => 'required'
        ]);
        //ASI NO 
        $validate = Validator::make($request->all(),[
            'nombre' => 'required',
            'presentacion' => 'required',
            'stock_minimo' => 'required|numeric',
            'stock_maximo' => 'required|numeric',
            'marca_id' => 'required',
            'subcategoria_id' => 'required'
        ]);

        $producto = Producto::where([
            ['nombre','=',$request->nombre],
            ['presentacion','=',$request->presentacion]
        ])->first();

        if($producto){
            return response()->json([
                'status' => 'validate',
                'message' => [
                    'nombre' => 'el producto ya existe'
                ]
            ]);
        }

        if($validate->fails()){
            return response()->json([
                'status' => 'validate',
                'message' => $validate->errors()
            ]);
        }

        $producto = new Producto($request->all());
        $producto->sku = 'PRD-0000';
        $producto->imagen = '';
        $result = $producto->save();
        if($result){
            $producto->sku = 'PRD-'.$producto->id;
            $producto->save();
            if($request->file('file') != null){
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif'){
                    $path = $file->store('productos');
                    $producto->imagen = $path;
                    $producto->save();
                }else{
                    return response()->json([
                        'status' => 'formato',
                    ]);
                }
            }
            $embalajes = json_decode($request->embalajes);
            $array = [];
            foreach ($embalajes as $embalaje){
                $array[$embalaje->embalaje_id] = [
                    'codigo_de_barras' => $embalaje->codigo_de_barras,
                    'unidades' => $embalaje->unidades,
                    'precio_venta' => $embalaje->precio_venta
                ];
            }
            $producto->embalajes()->sync($array);
            return response()->json([
                'status' => 'ok',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

}
