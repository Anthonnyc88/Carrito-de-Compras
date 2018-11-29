<?php
/**/

//Instancia
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;


//Clase controllador de la contraseña
class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    |
        Restablecer contraseña del controlador
    |--------------------------------------------------------------------------
    |
    | 
      Este controlador es responsable de manejar las solicitudes de restablecimiento de contraseña
    | y utiliza un rasgo simple para incluir este comportamiento. Eres libre de
    | Explora este rasgo y anula cualquier método que desees modificar.
    |
    */

    use ResetsPasswords;

    /**
     * Crear una nueva instancia de controlador de contraseña.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
