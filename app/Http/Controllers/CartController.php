<?php
/*
Clase Cart controller
Controllador de los Productos,
Las acciones que se dan en esta clase Productos
son Agregar Modificar Eliminar y la Vista del carrito.
*/

//Instancia
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
use App\OrderItem;

//clase controller Carrito compras
class CartController extends Controller
{
	public function __construct()
	{
		if(!\Session::has('cart')) \Session::put('cart', array());
	}

    // mostramos el carrito
    public function show()
    {
    	$cart = \Session::get('cart');
    	$total = $this->total();
    	return view('store.cart', compact('cart', 'total'));
    }

    // Agregamos los productos al carrito 
    public function add(Product $product)
    {
    	$cart = \Session::get('cart');
    	$product->quantity = 1;
    	$cart[$product->slug] = $product;
    	\Session::put('cart', $cart);

    	return redirect()->route('cart-show');
    }

    // Eliminamos el carrito de compras
    public function delete(Product $product)
    {
    	$cart = \Session::get('cart');
    	unset($cart[$product->slug]);
    	\Session::put('cart', $cart);

    	return redirect()->route('cart-show');
    }

    // Modificamos el carrito de compras
    public function update(Product $product, $quantity)
    {
    	$cart = \Session::get('cart');
    	$cart[$product->slug]->quantity = $quantity;
    	\Session::put('cart', $cart);

    	return redirect()->route('cart-show');
    }

    // Carrito que eliminamos
    public function trash()
    {
    	\Session::forget('cart');

    	return redirect()->route('cart-show');
    }

    // Total del carrito de compras
    private function total()
    {
    	$cart = \Session::get('cart');
    	$total = 0;
    	foreach($cart as $item){
    		$total += $item->price * $item->quantity;
    	}

    	return $total;
    }

    // Detalle del pedido
    public function orderDetail()
    {
        if(count(\Session::get('cart')) <= 0) return redirect()->route('home');
        $cart = \Session::get('cart');
        $total = $this->total();

        return view('store.order-detail', compact('cart', 'total'));
    }
    //Guardar el proceso del carrito en la base de datos
    public function saveOrder()
    {
    $cart = \Session::get('cart');
    $subtotal = 0;
    foreach($cart as $item){
    $subtotal += $item->price * $item->quantity;
    }

    $order = Order::create([
    'subtotal' => $subtotal,
    'shipping' => 100,
    'user_id' => \Auth::user()->id
    ]);

    foreach($cart as $item){
    $this->saveOrderItem($item, $order->id);
    }
    return redirect()->route('home');
    }

    //Salvar la orden del carrio con sus datos dentro
    private function saveOrderItem($item, $order_id)
    {
    OrderItem::create([
    'quantity' => $item->quantity,
    'price' => $item->price,
    'product_id' => $item->id,
    'order_id' => $order_id
    ]);
    }





}


