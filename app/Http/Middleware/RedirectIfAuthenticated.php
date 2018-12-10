<?php

/*Clase Redirect Authenticated 
Valida y Redirecciona los datos a la hora de guardarlos a la base de datos
*/
//Instancia
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
//Authenticacion de los datos 
class RedirectIfAuthenticated
{
    /**
     * La implementación del guardar.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Crear una nueva instancia de filtro.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
