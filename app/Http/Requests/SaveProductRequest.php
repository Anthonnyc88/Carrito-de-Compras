<?php
/* Clase Save Products 
Guarda los datos de los productos*/
//Instancia
namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveProductRequest extends Request
{
    /**
     * Determine si el usuario está autorizado para hacer esta solicitud.
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
    //Datos de la tabla 
    public function rules()
    {
        return [
            'name'          => 'required',
            'description'   => 'required',
            'extract'       => 'required',
            'price'         => 'required',
            'image'         => 'required',
            'category_id'   => 'required'
        ];
    }
}
