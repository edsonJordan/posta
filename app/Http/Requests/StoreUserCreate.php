<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserCreate extends FormRequest
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
            'document' =>  'required|numeric',
            'name'    =>  'required',
            'apellido'  =>  'required',
            'email'    =>  'required|unique:users',
            'telefono'  =>  'required',
            'user'   =>  'required|unique:users',
            'password'  =>  'required',
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
            'user.unique'   =>  'El usuario ya existe',
            'email.unique'  =>  'El correo ya existe',
            'document.numeric'  =>  'El documento debe ser un numero',

            'document.required'    =>  'Debes ingresar documento de identificación',
            'name.required'       =>  'Debes ingresar un nombre',
            'apellido.required'     =>  'Debes ingresar un apellido',
            'email.required'       =>  'Debes ingresar un correo',
            'telefono.required'     =>  'Debes ingresar telefono',
            'user.required'      =>  'Debes ingresar un nombre de usuario',
            'password.required'     =>  'Debes ingresar una clave',
        ];
    }
}
