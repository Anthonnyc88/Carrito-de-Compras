<?php
/*Esta Clase llamada Order es la clase modelo de la compra de los productos que 
tiene almecenados en el carrito de compras, esta clase contiene los atributos
 para la creacion o manipulacion de datos de la factura,
 de la seccion Cliente. */

//Instancia 
namespace App;

use Illuminate\Database\Eloquent\Model;
//Extension Orden
class Order extends Model
{
	//Nombre de la tabla de la base de datos
    protected $table = 'orders';
	//Nombres de las columnas de la tabla, con su respectivo orden
	protected $fillable = ['subtotal', 'shipping', 'user_id'];

	// Relacion con el usuario
	public function user()
	{
		//Redireccion
	    return $this->belongsTo('App\User');
	}
	// Redireccionando a la clase modelo de ordenar los articulos
	public function order_items()
	{
	// Redireccion
	    return $this->hasMany('App\OrderItem');
	}
}
