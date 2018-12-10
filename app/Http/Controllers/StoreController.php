<?php
//Instancia
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

//COntrolador de la tienda 
class StoreController extends Controller
{   
    //Funcion principal
    public function index()
    {
    	$products = Product::all();
    	//dd($products);
    	return view('store.index', compact('products'));
    }
    //Muestra todo lo visto en la tienda, productos por categorias
    public function show($slug)
    {
    	$product = Product::where('slug', $slug)->first();
    	//dd($product);
        //redireccion
    	return view('store.show', compact('product'));
    }
}
