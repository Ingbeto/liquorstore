@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a style="color:white" href="{{route('admin.almacen')}}">Almacen</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DEL ALMACEN<small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert alert-dismissible" style="background-color: #FFD700;" role="alert">
                    <button type="button" style="color: black" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong style="color: black">Detalles: </strong > <span style="color: black">Gestione las Marcas, Categorías, Subcategorías, Productos, Embalajes de los productos, como también las Bodegas de la empresa.</span>
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_MARCAS'))
                        <a href="{{route('marcas.index')}}" class="btn  btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="material-icons">bubble_chart</i></span>
                                <span>MARCAS</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                    @if(session()->exists('PAG_EMBALAJES'))
                        <a href="{{route('embalajes.index')}}" class="btn  btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="material-icons">account_balance_wallet</i></span>
                                <span>EMBALAJES</span>
                                <span class="ink animate"></span>
                            </div>
                        </a>
                    @endif
                    @if(session()->exists('PAG_CATEGORIAS'))
                        <a href="{{route('categorias.index')}}" class="btn  btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="material-icons">category</i></span>
                                <span>CATEGORÍAS</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
