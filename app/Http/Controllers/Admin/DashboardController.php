<?php

namespace Kazka\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kazka\Http\Controllers\Controller;
use Kazka\Post;
use Kazka\Category;

class DashboardController extends Controller
{
	/**
     * Відображення адмінки с постами
     */
    public function index()
    {
    	$posts = Post::orderBy('id', 'desc')->paginate(10);
        $cats = Category::orderBy('id')->get();
        return view('admin.index', compact('posts', 'cats'));
    }
    public function edit_category_show()
    {
    	$cats = Category::orderBy('id')->get();
        return view('admin.category.index')->with('cats', $cats);
    }
}
