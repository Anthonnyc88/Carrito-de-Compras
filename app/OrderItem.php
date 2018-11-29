<?php
/*Esta Clase llamada OrderItems es la clase modelo del orden de los productos que 
tiene almecenados, esta clase contiene los atributos
 para la creacion o manipulacion de datos,
 de la seccion Cliente. */ 

//Instancia  
namespace App;

use Illuminate\Database\Eloquent\Model;
//Extension Orden de los productos
class OrderItem extends Model
{
	//Nombre de la tabla de la base de datos
    protected $table = 'order_items';
	//Nombres de las columnas de la tabla, con su respectivo orden
	protected $fillable = ['price', 'quantity', 'product_id', 'order_id'];

	public $timestamps = false;

	// Relacion con la clase modelo Orden
	public function order()
	{
		//Redireccion
	    return $this->belongsTo('App\Order');
	}
	// Relacion con la clase modelo Producto
	public function product()
    {
		//Redireccion
        return $this->belongsTo('App\Product');
    }
}
