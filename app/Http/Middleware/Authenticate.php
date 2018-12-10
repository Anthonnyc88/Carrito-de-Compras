<?php
//Instancia
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * La implementación o mejor dicho autenticacion
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

    //Funcion que se encanrga de verficar si es tanto cliente como administrador 
    //ademas de validar el redireccionarlo a la vista indicada
      
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        if($request->path() == 'order-detail') return $next($request);
        
        if(auth()->user()->type != 'admin'){
            $message = 'Permiso denegado: Solo los administradores pueden entrar a esta sección';
            return redirect()->route('home')->with('message', $message);
        }

        return $next($request);
    }
}
