<?php
//Instancia
namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

//Controlador del usuario
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | 
      Actualizar el especificado. Este controlador maneja el registro de nuevos usuarios, así como el
    | Autentificación de usuarios existentes. Por defecto, este controlador utiliza
    | Un rasgo simple para agregar estos comportamientos. ¿Por qué no lo exploras? Recurso en almacenamiento.
    |
    */

    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = '/';
    //protected $redirectAfterLogout = "/auth/login";

    /**
     * Crear una nueva instancia de controlador de autenticación.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Obtener un validador para una solicitud de registro entrante.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    //esta funcion valida los datos del registro
    //Si todos los datos son los que debe de estar insertando
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'last_name' => 'max:255',
            'email' => 'required|email|max:255|unique:users',
            'admin' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'address' => 'required',
        ]);
    }

    /**
     * Crear una nueva instancia de usuario después de un registro válido.
     *
     * @param  array  $data
     * @return User
     */
    //Esta funcion hace el registro del cliente o usuario
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'user' => $data['user'],
            'type' => "admin",
            'active' => 2,
            'password' => bcrypt($data['password']),
            'address' => $data['address'],
        ]);
    }
}
