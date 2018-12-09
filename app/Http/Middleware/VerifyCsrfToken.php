<?php
/*Verficamos el token del producto
*/
//Instancia
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * manejar Los URI que deben excluirse de la verificación CSRF..
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
