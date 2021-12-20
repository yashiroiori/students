<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class LessonStoreRequest extends FormRequest
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
            'name' => 'required|unique:lessons,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese el nombre de la materia',
            'name.unique' => 'El nombre ingresado ya se ha registrado',
        ];
    }
}
