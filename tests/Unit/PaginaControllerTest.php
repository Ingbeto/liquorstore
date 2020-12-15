<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaginaControllerTest extends TestCase
{
    public function invalidNombre() : array
    {
        return [
            ['nombre', null, 'El campo nombre es obligatorio.'],
            ['nombre','CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir
            CarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuirCarlosTuir', 'El campo nombre no debe contener más de 250 caracteres.'],
            ['nombre', 'Arch', 'El campo nombre debe contener al menos 5 caracteres.']
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
    public function CP2_pagina_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('pagina.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
