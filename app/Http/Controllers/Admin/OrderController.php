<?php
/*
Clase Order Controller 
Controllador de las ordenes,
Esta clase OrdenController Obtiene los datos de los productos 
seleccionador por el cliente a la hora de 
llevarlos al carrito de compras
*/


//Instancia
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;

//Clase OrderController, Controllador de las ordenes del carrito de compra
class OrderController extends Controller
{

     //La funcion principal, la que se toma de primero en esta clase para redireccionar a la vista Ordenes
    public function index()
    {
    	$orders = Order::orderBy('id', 'desc')->paginate(5);
    	//dd($orders);
    	return view('admin.order.index', compact('orders'));
    }

    //Funcion que obtiene los datos de la orden del cliente a la hora de comprar
    public function getItems(Request $request)
    {
    	$items = OrderItem::with('product')->where('order_id', $request->get('order_id'))->get();
    	return json_encode($items);
    }

    //Elimina lo que contiene el carrito de compras que se lleva hasta ese momento
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        $deleted = $order->delete();
        
        $message = $deleted ? 'Pedido eliminado correctamente!' : 'El Pedido NO pudo eliminarse!';
        
        return redirect()->route('admin.order.index')->with('message', $message);
    }
}
