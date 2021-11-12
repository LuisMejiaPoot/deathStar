<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    
    public function JediDataValidator($data)
    {
        return \Validator::make($data,[
            'nombre'=> 'required|String',
            'color_sable'=> 'required|String|min:3|max:250',
            'aprendiz' =>[
                'required',
                Rule::in([true, false,1,0])
                ] ,
            'estilo_batalla' =>"required|integer|between:1,7"
            ]);
            
    }
}
