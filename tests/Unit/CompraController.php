<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompraController extends TestCase
{
    public function invalidproveedor_id() : array
    {
        return [
            ['proveedor_id', null, 'El campo proveedor id es obligatorio.']            
        ];
    }
    public function invalidserie() : array
    {
        return [
            ['serie', null, 'El campo serie es obligatorio.']            
        ];
    } public function invalidbodega_id() : array
    {
        return [
            ['bodega_id', null, 'El campo bodega id es obligatorio.']            
        ];
    } public function invalidfecha() : array
    {
        return [
            ['fecha', null, 'El campo fecha es obligatorio.'],
            ['fecha','200/200/200','El campo fecha no corresponde con una fecha válida.']            
        ];
    }
    private $formFields = [
        'proveedor_id' => 'required',
        'serie' => 'required',
        'bodega_id' => 'required',
        'fecha' => '02/03/2020',
    ];
    /**
     *  @param $formInput
     *  @param $formInputValue
     *  @param $message
     *  @test
     *  @dataProvider invalidproveedor_id
     *  @dataProvider invalidserie
     *  @dataProvider invalidbodega_id
     *  @dataProvider invalidfecha
     */
    public function CP2_compra_cant_regis_using_invalid_data($formInput, $formInputValue, $message) :void
    {
        $response = $this->post(route('compra.store'), array_replace($this->formFields, [$formInput=>$formInputValue]));
        $response->assertSessionHasErrors([$formInput=>$message]);
        //$response->assertJsonValidationErrors([$formInput=>$message]);
    }
}
