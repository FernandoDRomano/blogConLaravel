<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTagRequest;

class TagController extends Controller
{

    public function index()
    {
        return view('admin.tags.index');
    }

    public function all(){
        if(request()->ajax()){
			return datatables()
			->eloquent(Tag::query()->latest())
			->addColumn('btn', 'admin.tags._actions')
			->rawColumns(['btn'])
			->make(true);
        }else{
            return redirect()->back();
        }
    }

    public function getTag(Tag $tag)
    {
        return response()->json($tag);
    }

    public function store(SaveTagRequest $request)
    {
        $tag = new Tag();
        $tag->fill($request->validated());
        $tag->generateUrl();
        $tag->save();

        return response()->json([
            "success" => true,
            "session" => "La Etiqueta " . $tag->name ." fue creada con éxito!!!"
        ]);
    }

    public function update(SaveTagRequest $request, Tag $tag)
    {
        $tag->fill($request->validated());
        $tag->generateUrl();
        $tag->update();
        return response()->json(["success" => true, "session" => "La Etiqueta " . $tag->name ." fue editada con éxito!!!"]); 
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(["success" => true, "session" => "La Etiqueta " . $tag->name ." fue eliminada con éxito!!!"]);
    }
}
