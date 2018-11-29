<?php
/*
Clase Product Controller 
Controllador de los Productos,
Las acciones que se dan en esta clase Productos
son Agregar Modifica Eliminar y la Vista de los productos.
*/

//Instancia
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SaveProductRequest;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    /**
     * Mostrar una lista del recurso.
     *
     * @return Response
     */
    //La funcion principal, la que se toma de primero en esta clase para redireccionar a la vista Productos.
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);
        //dd($products);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso..
     *
     * @return Response
     */

    //Funcion crear los datos de los productos
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->lists('name', 'id');
        //dd($categories);
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Almacenar un recurso recién creado en el almacenamiento.
     *
     * @param  Request  $request
     * @return Response
     */

    //Funcion que crea los productos con sus respectivos datos
    public function store(SaveProductRequest $request)
    {
        $data = [
            'name'          => $request->get('name'),
            'slug'          => str_slug($request->get('name')),
            'description'   => $request->get('description'),
            'extract'       => $request->get('extract'),
            'price'         => $request->get('price'),
            'image'         => $request->get('image'),
            'visible'       => $request->has('visible') ? 1 : 0,
            'category_id'   => $request->get('category_id')
        ];

        $product = Product::create($data);

        $message = $product ? 'Producto agregado correctamente!' : 'El producto NO pudo agregarse!';
        
        return redirect()->route('admin.product.index')->with('message', $message);
    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */
    //Muestra todos los productos cn sus reespectivos datos
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */
    //Funcion que muestra y da la opcion de editar el producto
    public function edit(Product $product)
    {
        $categories = Category::orderBy('id', 'desc')->lists('name', 'id');

        return view('admin.product.edit', compact('categories', 'product'));
    }

    /**
     * Actualizar el recurso especificado en el almacenamiento.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    //Funcion que nos permite modificar los datos de los productos enlazada a la funcio anterior
    public function update(SaveProductRequest $request, Product $product)
    {
        $product->fill($request->all());
        $product->slug = str_slug($request->get('name'));
        $product->visible = $request->has('visible') ? 1 : 0;
        
        $updated = $product->save();
        
        $message = $updated ? 'Producto actualizado correctamente!' : 'El Producto NO pudo actualizarse!';
        
        return redirect()->route('admin.product.index')->with('message', $message);
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return Response
     */
    //FUNCION QUE ELIMINA ALGUN PRODUCTO EN ESPECIFICO
    public function destroy(Product $product)
    {
        $deleted = $product->delete();
        
        $message = $deleted ? 'Producto eliminado correctamente!' : 'El producto NO pudo eliminarse!';
        
        return redirect()->route('admin.product.index')->with('message', $message);
    }
}
