<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class InteraccionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'perro_interesado_id' => 'required|exists:perro,id',
            'perro_candidato_id' => 'required|exists:perro,id',
            'preferencia' => 'required|string|min:0|max:30',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'exists' => 'El :attribute debe existir en nuestro sistema',
            'string' => 'El campo :attribute debe ser de tipo string',
            'min' => 'El campo :attribute no cumple con la longitud mínima requerida',
            'max' => 'El campo :attribute supera la longitud máxima permitida',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST)
        );
    }
}
