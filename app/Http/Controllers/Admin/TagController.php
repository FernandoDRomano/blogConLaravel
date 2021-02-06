<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTagRequest;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{

    public function index()
    {
        $this->authorize('view', $tag = new Tag);

        return view('admin.tags.index', [
            "tag" => $tag
        ]);
    }

    public function all(){
        if(request()->ajax()){
            return DataTables::eloquent(Tag::select('id', 'name', 'url')->latest())
                                ->addColumn('btn', 'admin.tags._actions')
                                ->rawColumns(['btn'])
                                ->toJson();
        }else{
            return redirect()->back();
        }
    }

    public function getTag(Tag $tag)
    {
        return response()->json($tag->load('posts'));
    }

    public function store(SaveTagRequest $request)
    {
        $this->authorize('create', new Tag);

        $tag = Tag::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'La Etiqueta <strong>' . $tag->name . '</strong> fue creada con éxito!!!',
            'title' => 'Etiqueta Creada',
            'icon' => 'success'
        ]);
    }

    public function update(SaveTagRequest $request, Tag $tag)
    {
        $this->authorize('update', $tag);

        $tag->update(['name' => $request->name]);

        return response()->json([
            'success' => true, 
            'message' => 'La Etiqueta <strong>' . $tag->name .'</strong> fue editada con éxito!!!',
            'title' => 'Etiqueta Actualizada',
            'icon' => 'success'
        ]); 
    }

    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        $tag->delete();
        
        return response()->json([
            'success' => true, 
            'message' => 'La Etiqueta <strong>' . $tag->name .'</strong> fue eliminada con éxito!!!',
            'title' => 'Categoría Eliminada',
            'icon' => 'success'
        ]);
    }
}
