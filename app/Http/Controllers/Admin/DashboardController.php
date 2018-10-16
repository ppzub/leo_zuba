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

        $cats = Category::orderBy('id')->get();
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.index', compact('posts', 'cats'));
    }
    public function edit_category_show()
    {
    	$cats = Category::orderBy('id')->get();
        return view('admin.category.index')->with('cats', $cats);
    }
    public function search(Request $request)
    {
        $cats = Category::orderBy('id')->get();
        $posts = Post::search($request->key)->orderBy('id', 'desc')->paginate(10);
        $count = count($posts);
        return view('admin.index', compact('posts', 'cats', 'count'));
    }
}
