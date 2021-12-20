<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:students,name,'.$this->route('student')->id,
            'email' => 'required|unique:students,email,'.$this->route('student')->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese el nombre del estudiante',
            'name.unique' => 'El nombre ingresado ya se ha registrado',
            'email.required' => 'Ingrese el correo electrónico del estudiante',
            'email.unique' => 'El correo electrónico ingresado ya se ha registrado',
        ];
    }
}
