<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequestTriaje extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'presion'  =>  'required|numeric|min:5|max:200',
            'temperatura'     =>  'required|numeric|min:5|max:80',            
            'cardiaca'      =>  'required|numeric|min:5|max:180',
            'saturacion' =>  'required|numeric|min:5|max:100',
            'peso'     =>  'required|numeric|min:5|max:300',
            'talla'  =>  'required|regex:/^\d+(\.\d{1,2})?$/'
        ];  
    }
    public function attributes()
    {
        return [
            'document' => 'Documento de identificación',
        ];
    }
    public function messages()
    {
        return [
           
            'presion.numeric'  =>  'La presión debe ser un número',
            'presion.required' =>  'Debes ingresar la presión',
            'presion.max'      => 'Sobrepasa el limite maximo de valor aceptado',

            'temperatura.numeric'  =>  'La temperatura debe ser un número',
            'temperatura.required' =>  'Debes ingresar la temperatura',
            'temperatura.max'      => 'El maximo valor aceptado es 80',

            'cardiaca.numeric'  =>  'El frecuencia cardiaco debe ser un número',
            'cardiaca.required' =>  'Debes ingresar frecuencia',
            'cardiaca.max'      => 'El maximo valor aceptado es 180',

            'saturacion.numeric'  =>  'La saturación debe ser un número',
            'saturacion.required' =>  'Debes ingresar una saturación',
            'saturacion.max'      => 'El maximo valor aceptado es 100',

            'peso.numeric'  =>  'El peso debe ser un número',
            'peso.required' =>  'Debes ingresar un peso',
            'peso.max'      => 'El maximo valor aceptado es 300',

            'talla.regex'  =>  'La talla debe ser un número aceptable',
            'talla.required' =>  'Debes ingresar una talla',
            'talla.max'      => 'El maximo valor aceptado es 2147483647',
        ];
    }
}
