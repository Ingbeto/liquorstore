<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductoControllerTest extends TestCase
{
    
    public function invalidNombre() : array
    {
        return [
            ['nombre', null, 'El campo nombre es obligatorio.']            
        ];
    }
    public function invalidpresentacion() : array
    {
        return [
            ['presentacion', null, 'El campo presentacion es obligatorio.']            
        ];
    }
    
    public function invalidstock_minimo() : array
    {
        return [
            ['stock_minimo', null, 'El campo stock minimo es obligatorio.'],
            ['stock_minimo', 'H', 'El campo stock minimo debe ser un número.']            
        ];
    }
    public function invalidstock_maximo() : array
    {
        return [
            ['stock_maximo', null, 'El campo stock maximo es obligatorio.'],            
            ['stock_maximo', 'H', 'El campo stock maximo debe ser un número.']            
        ];
    }
    public function invalidmarca_id() : array
    {
        return [
            ['marca_id', null, 'El campo marca id es obligatorio.']            
        ];
    }
    public function invalidsubcategoria_id() : array
    {
        return [
            ['subcategoria_id', null, 'El campo subcategoria id es obligatorio.']            
        ];
    } 
    private $formFields = [
        
        'nombre' => 'required',
        'presentacion' => 'required',
        'stock_minimo' => 2,
        'stock_maximo' => 5,
        'marca_id' => 'required',
        'subcategoria_id' => 'required'
    ];           
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invalidnombre
     *  @dataProvider invalidpresentacion
     *  @dataProvider invalidstock_minimo
     *  @dataProvider invalidstock_maximo
     *  @dataProvider invalidmarca_id
     *  @dataProvider invalidsubcategoria_id
     *  
     */
    public function CP2_producto_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('productos.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
