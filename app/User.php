<?php
/*Esta Clase llamada User es la clase modelo de los
datos del usuario que estaran almacenados en la base de datos 
La clase contiene los datos que seran utilizados
 para la manipulacion en la seccion registro y cliente */ 

//Intancia
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

//Extension Modelo Usuarios, con sus validaciones de autenticacion tanto de nombre de usuario como de contraseña.
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * La tabla de base de datos utilizada por el modelo.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Los atributos que son asignables en cantidad
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'last_name', 'user', 'type', 'active', 'address'];

    /**
     * Los atributos excluidos de la forma JSON del modelo.

     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // Relacion con la clase modelo Orders
    public function orders()
    {
        //Redireccion
        return $this->hasMany('App\Order');
    }
}
