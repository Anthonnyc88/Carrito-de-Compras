<?php
/*Esta Clase llamada Products es la clase Productos 
que se encuentran almacenados en la base de datos,
esta clase contiene los datos que estan en la tabla producto
 para la creacion o manipulacion de datos,
 de la seccion Administrador. */

//Instancia 
namespace App;

use Illuminate\Database\Eloquent\Model;
//Extension productos
class Product extends Model
{
	//Nombre de la tabla de la base de datos    
    protected $table = 'products';
    //Nombres de las columnas de la tabla, con su respectivo orden
	protected $fillable = ['name', 'slug', 'description', 'extract', 'image', 'visible', 'price', 'category_id'];

    
    //Relacion con las categorias
    public function category()
    {
        //Redireccion
        return $this->belongsTo('App\Category');
    }

    // Relacion con el orden de los productos
    public function order_item()
    {
        //Redireccion
        return $this->hasOne('App\OrderItem');
    }
}
