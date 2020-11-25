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
        return view('admin.categories.index');
    }

    public function store(SaveCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->generateUrl();
        $category->save();

        return response()->json(["success" => true, "session" => "La Categoría " . $category->name ." fue creada con éxito!!!"]);
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
        return response()->json($category);
    }

    public function update(SaveCategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->generateUrl();
        $category->update();
        return response()->json(["success" => true, "session" => "La Categoría " . $category->name ." fue editada con éxito!!!"]); 
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(["success" => true, "session" => "La Categoría " . $category->name ." fue eliminada con éxito!!!"]);
    }
}
