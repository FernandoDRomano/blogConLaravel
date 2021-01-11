<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function show()
    {
        return view('admin.dashboard')->with([
            'posts' => Post::owner()-> approveds()->latest()->with('user')->take(4)->get(),
            'users' => User::latest()->take(9)->get(),
            'comments' => Comment::latest()->take(4)->get(),
        ]);
    }
}
