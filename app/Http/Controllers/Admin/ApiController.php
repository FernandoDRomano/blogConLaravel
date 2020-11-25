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
    }

}
