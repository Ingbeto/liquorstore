<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmbalajesControllerTest extends TestCase
{
    
    public function invalidDescripcion() : array
    {
        return [
            ['descripcion', null, 'El campo descripcion es obligatorio.']
        ];
    }
    
    private $formFields = [
        'descripcion'=>'Cerveza',
    ];
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invaliddescripcion
    */
    public function CP2_embalaje_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('embalajes.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
