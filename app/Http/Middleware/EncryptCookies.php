<?php
//Instancia
namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;
//Clase encrypt Cookies 
class EncryptCookies extends BaseEncrypter
{
    /**
     * Los nombres de las cookies que no deben ser encriptadas.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
