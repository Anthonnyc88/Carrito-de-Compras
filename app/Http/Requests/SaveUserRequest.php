<?php
//Instancia
namespace App\Http\Requests;

use App\Http\Requests\Request;

//Clase Guadar los datos del usuario
class SaveUserRequest extends Request
{
    /**
     * Determine si el usuario está autorizado para realizar esta solicitud. .
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtener las reglas de validación que se aplican a la solicitud
     *
     * @return array
     */
    //Reglas que debe de tener el registro del cliente a la hora de ingrasar los datos 
    public function rules()
    {
        return [
            'name'      => 'required|max:100',
            'last_name' => 'required|max:100',
            'email'     => 'required|email|unique:users',
            'user'      => 'required|unique:users|min:4|max:20',
            'password'  => 'required|confirmed',
            'type'      => 'required|in:user,admin'
        ];
    }
}
