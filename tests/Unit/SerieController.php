<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SerieController extends TestCase
{
    
    public function invalidprefijo() : array
    {
        return [
            ['prefijo', null, 'El campo prefijo es obligatorio.']            
        ];
    }
    public function invalidinicial() : array
    {
        return [
            ['inicial', null, 'El campo inicial es obligatorio.']            
        ];
    }
    public function invalidfinal() : array
    {
        return [
            ['final', null, 'El campo final es obligatorio.']            
        ];
    }
    private $formFields = [
        
        'prefijo' => 'required',
        'inicial' => 'required',
        'final' => 'required'
    ];
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invalidprefijo
     *  @dataProvider invalidinicial
     *  @dataProvider invalidfinal
     */
    public function CP2_serie_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('serie.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
