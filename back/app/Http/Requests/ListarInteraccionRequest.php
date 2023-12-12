<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ListarInteraccionRequest extends FormRequest
{
      
    public function rules()
    {
        return [
         "id"=>"required|exists:perro,id",
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'integer' => 'El campo :attribute debe ser un número entero',
            'numeric' => 'El campo :attribute debe ser un número',
            'exists' => 'El :attribute debe existir en nuestro sistema',
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST)
        );
    }
}

