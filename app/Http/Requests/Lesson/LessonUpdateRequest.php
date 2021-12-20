<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class LessonUpdateRequest extends FormRequest
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
            'name' => 'required|unique:lessons,name,'.$this->route('lesson')->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese el nombre del estudiante',
            'name.unique' => 'El nombre ingresado ya se ha registrado',
        ];
    }
}
