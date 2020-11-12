<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BodegasController extends TestCase
{ 
    public function invalidNombre() : array
    {
        return [
            ['nombre', null, 'El campo nombre es obligatorio.']            
        ];
    }
    private $formFields = [
        
        'nombre' => 'required'
    ];
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invalidnombre
     */
    public function CP2_bodega_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('bodegas.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
