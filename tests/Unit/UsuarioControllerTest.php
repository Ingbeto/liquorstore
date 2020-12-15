<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuarioControllerTest extends TestCase
{
    
     public function invalidIdentificacion() : array
    {
        return [
            ['identificacion', null, 'El campo identificacion es obligatorio.']
        ];
    }
    public function invalidNombres() : array
    {
        return [
            ['nombres', null, 'El campo nombres es obligatorio.'],
            ['nombres','CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir', 'El campo nombres no debe contener más de 250 caracteres.']
        ];
    }

    public function invalidApellidos() : array
    {
        return [
            ['apellidos', null, 'El campo apellidos es obligatorio.'],
            ['apellidos','CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir', 'El campo apellidos no debe contener más de 250 caracteres.']
        ];
    }
    public function invalidPassword() : array
    {
        return [
            ['password', '99999', 'El campo password debe contener al menos 6 caracteres.'],
            ['password', null, 'El campo password es obligatorio.']
          ];
    }
    public function invalidEstado() : array
    {
        return [
            ['estado', null, 'El campo estado es obligatorio.'],
            ['estado','CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir', 'El campo estado no debe contener más de 50 caracteres.'],
            ['estado', 'Arch', 'El campo estado debe contener al menos 5 caracteres.']
        ];
    }
    private $formFields = [
        'identificacion' => 1000,
        'nombres'=>'Fausto',
        'apellidos'=>'Augusto',
        'password' => '12345',    
        'estado'=>'Activo'
    ];
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invalididentificacion
     *  @dataProvider invalidnombres
     *  @dataProvider invalidapellidos
     *  @dataProvider invalidpassword
     *  @dataProvider invalidestado

     */
        
    public function CP2_user_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('usuario.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
