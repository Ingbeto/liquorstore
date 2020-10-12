<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuarioControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function invalidIdentificacion() : array
    {
        return [
            ['identificacion', 100000000000, 'El campo identificacion debe ser menor que 999999999.'],
            ['identificacion', 9999, 'El campo identificacion debe tener al menos 10000.'],
            ['identificacion', null, 'El campo identificacion es requerido.'],
            ['identificacion', 'cinco', 'El campo identificacion debe ser un número.']

        ];
    }
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invalididentificacion
     */
    
    private $formFields = [
        'identificacion' => 1000,
        'nombres'=>'Fausto',
        'apellidos'=>'Augusto',
        'email' => 'est@gmail.com',
        'password' => '12345',    
    ];
    public function CP2_user_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('guardar_usuario'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        $response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
