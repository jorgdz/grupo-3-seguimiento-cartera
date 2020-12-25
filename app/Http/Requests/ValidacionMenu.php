<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidarCampoUrl;
use App\Models\Menu;
class ValidacionMenu extends FormRequest
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
            'nombre' => 'required|max:50|unique:menu,nombre,'. $this->route('id'),//validar un solo nombre que exista
            'url' => ['required','max:100',new ValidarCampoUrl],
            'icono' => 'nullable|max:50'
        ];
    }

  /*  public function messages()
    {
        return [
            'nombre.required' => 'El campo Nombre es Requerido',
            'url.required' => 'El campo Url es Requerido',
        ];
    }*/
}
