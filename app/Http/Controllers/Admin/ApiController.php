<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    
    public function categories(){
		if(request()->ajax()){
			return datatables()
			->eloquent(Category::query()->latest())
			->addColumn('btn', 'admin.categories._actions')
			->rawColumns(['btn'])
			->make(true);
		}

		/* if(request()->ajax())
        {
            $data = Category::latest()->get();
            return datatables()->of($data)
                    ->addColumn('btn', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['btn'])
                    ->make(true);
        } */
    }

}
