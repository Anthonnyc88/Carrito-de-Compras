<?php
/*
Clase llamada categorycontroller
Su finalidad es crear agregar modificiar y eliminar datos de la categoria, 
con sus respectivas funcionas.
Y incluyendo sus respectivas validaciones a la hora de elaborarsen estas 
acciones.
*/ 

//Instancia
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

//Controlador Categorias
class CategoryController extends Controller
{
    /**
     * Mostrar una lista del recurso
     *
     * @return Response
     */

    //La funcion principal, la que se toma de primero en esta clase para redireccionar a la vista categorias.
    public function index()
    {
        $categories = Category::all();
        //dd($categories);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.

     *
     * @return Response
     */

    //Redirecciona a la vista (Crear Categoria)
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Almacenar un recurso recién creado en el almacenamiento.
     *
     * @return Response
     */
    //Esta funcines contiene las validaciones que se hacen a la hora de crear modificar eliminar y mostrar los datos de la categoria
    public function store(Request $request)
    {
        //return $request->all();

        $this->validate($request, [
          'name' => 'required|unique:categories|max:255',
          'color' => 'required',
        ]);
        
        $category = Category::create([
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name')),
            'description' => $request->get('description'),
            'color' => $request->get('color')
        ]);
        
        $message = $category ? 'Categoría agregada correctamente!' : 'La Categoría NO pudo agregarse!';
        //Redireccion
        return redirect()->route('admin.category.index')->with('message', $message);
    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */

    //Esta funcion muestra las categorias que se encuentran en la base de datos
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Muestra el formulario para editar el dato especifico..
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Actualizar el recurso especificado en el almacenamiento..
     *
     * @param  int  $id
     * @return Response
     */
    //Esta funcion modifica una categoria de la seccion administrador
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
          'name' => 'required|max:255',
          'color' => 'required',
        ]);

        $category->fill($request->all());
        $category->slug = str_slug($request->get('name'));
        
        $updated = $category->save();
        
        $message = $updated ? 'Categoría actualizada correctamente!' : 'La Categoría NO pudo actualizarse!';
        
        return redirect()->route('admin.category.index')->with('message', $message);
    }

    /**
     * Eliminar el recurso especificado del almacenamiento..
     *
     * @param  int  $id
     * @return Response
     */

    // Esta funcion elimina una categoria
    public function destroy(Category $category)
    {
        $deleted = $category->delete();
        
        $message = $deleted ? 'Categoría eliminada correctamente!' : 'La Categoría NO pudo eliminarse!';
        
        return redirect()->route('admin.category.index')->with('message', $message);
    }
}
