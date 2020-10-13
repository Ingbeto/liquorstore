<?php

namespace Tests\Unit;

use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MarcasControllerTest extends TestCase
{
    public function invalidNombre() : array
    {
        return [
            ['nombre', null, 'El campo nombre es obligatorio.']
        ];
    }
    private $formFields = [
        'nombre'=>'Polar',
    ];
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invalidnombre
    */
    
    public function CP2_marcas_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        
        $response = $this->post(route('marcas.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
        
    }
}
