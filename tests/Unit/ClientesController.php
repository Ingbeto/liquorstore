<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientesController extends TestCase
{
    public function invalidNombre() : array
    {
        return [
            ['nombre', null, 'El campo nombre es obligatorio.']            
        ];
    }
    public function invalidTelefono() : array
    {
        return [
            ['telefono', null, 'El campo telefono es obligatorio.']            
        ];
    }
    public function invalidEmail() : array
    {
        return [
            ['email', null, 'El campo email es obligatorio.']            
        ];
    }
    private $formFields = [
        
        'nombre' => 'required',
        'telefono'=>'31843333',
        'email'=>'c@c.com'
    ];
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invalidnombre
     *  @dataProvider invalidtelefono
     *  @dataProvider invalidemail
     */
    public function CP2_cliente_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('clientes.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
