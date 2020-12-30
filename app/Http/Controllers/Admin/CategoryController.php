<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCategoryRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $this->authorize('view', $category = new Category);

        return view('admin.categories.index', [
            "category" => $category
        ]);
    }

    public function store(SaveCategoryRequest $request)
    {
        $this->authorize('create', new Category);

        $category = Category::create($request->validated());        

        return response()->json([
            'success' => true, 
            'message' => 'La Categoría <strong>' . $category->name . '</strong> fue creada con éxito!!!',
            'title' => 'Categoría Creada',
            'icon' => 'success'
        ]);
    }

    public function all(){
        if(request()->ajax()){
			return datatables()
			->eloquent(Category::query()->latest())
			->addColumn('btn', 'admin.categories._actions')
			->rawColumns(['btn'])
			->make(true);
        }else{
            return redirect()->back();
        }
        
    }

    public function getCategory(Category $category)
    {
        return response()->json($category->load('posts'));
    }

    public function update(SaveCategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $category->update(['name' => $request->name]);

        return response()->json([
            'success' => true, 
            'message' => 'La Categoría <strong>' . $category->name . '</strong> fue editada con éxito!!!',
            'title' => 'Categoría Actualizada',
            'icon' => 'success'
        ]);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        $category->delete();

        return response()->json([
            'success' => true, 
            'message' => 'La Categoría <strong>' . $category->name . '</strong> fue eliminada con éxito!!!',
            'title' => 'Categoría Eliminada',
            'icon' => 'success'
        ]);
    }
}
