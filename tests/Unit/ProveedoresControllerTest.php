<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProveedoresControllerTest extends TestCase
{
    public function invalidNombre() : array
    {
        return [
            ['nombre', null, 'El campo nombre es obligatorio.']            
        ];
    }
    public function invalidNit() : array
    {
        return [
            ['nit', null, 'El campo nit es obligatorio.']            
        ];
    }
    private $formFields = [
        
        'nombre' => 'required',
        'nit' => 'required'
    ];
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invalidnombre
     *  @dataProvider invalidnit 
     */
    public function CP2_proveedor_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('proveedores.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
