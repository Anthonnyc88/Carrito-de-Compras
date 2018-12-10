<?php
//Instancia
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

//clase controller Carrito compras
class BuyController extends Controller
{
	public function __construct()
	{
		if(!\Session::has('cart')) \Session::put('cart', array());
    }
}

