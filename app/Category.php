<?php
/*Esta Clase llamada Category es la clase modelo de categorias 
que contiene los atributos para la creacion o manipulacion de datos de las categorias,
 de la seccion administrador. */

//Instancia
namespace App;

use Illuminate\Database\Eloquent\Model;
//Extension Categoria
class Category extends Model
{
    //Nombre de la tabla de la base de datos
    protected $table = 'categories';
    //Nombre de las columnas de la tabla, con su respectivo orden
	protected $fillable = ['name', 'slug', 'description', 'color'];
    //
	public $timestamps = false;
    
    //Funcion products que redirecciona a la clase modelo products
    public function products()
    {
        //Redireccion
        return $this->hasMany('App\Product');
    }
}
