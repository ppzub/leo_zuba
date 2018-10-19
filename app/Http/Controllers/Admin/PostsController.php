<?php

namespace Kazka\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Kazka\Http\Controllers\Controller;
use Kazka\Category;
use Kazka\Post;

class PostsController extends Controller
{
    /**
     * Show записи конкретної категорії
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        $cat = Category::where('alias', $alias)->get();
        $cat_id = $cat[0]->id;
        $posts = Post::where('category_id', $cat_id)->orderBy('id', 'desc')->paginate(10);
        $cats = Category::orderBy('id')->get();
        return view('admin.index', compact('posts', 'cats', 'alias'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('admin');
    }

    /**
     * Show форма створення нового запису
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::orderBy('id')->pluck('title', 'id')->all();
        return view('admin.posts.create', compact('cats'));
    }

    /**
     * Збереження нового запису
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image',
            'video' => 'nullable|string',
        ]);
        $data = $request->except('_token');
        $post = new Post;

        //загружаєм картінку
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $data['image'] = $post->uploadMainImage($image);
        }
        //загружаєм галерею
        if ($request->hasFile('gallery'))
        {
            $gallery = $request->file('gallery');
            $gallery_for_insert = $post->uploadGallery($gallery);
        }

        $post->fill($data);
        $post->save();
        if ($request->hasFile('gallery'))
        {
            $post->galleries()->createMany($gallery_for_insert); // заповнення таблиці galleries
        }

        return redirect()->route('admin');
    }

    /**
     * Show редагування запису
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $pics = $post->getGallery();
        $pics = array_reverse($pics);
        $cats = Category::orderBy('id')->pluck('title', 'id')->all();
        return view('admin.posts.edit', compact('cats','post', 'pics'));
    }

    /**
     * Update запис
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image',
            'video' => 'nullable|string',
        ]);

        $data = $request->except('_method','_token');
        $post = Post::findOrFail($id);

        //загружаєм картінку
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $data['image'] = $post->uploadMainImage($image);
        }

        $post->fill($data);
        $post->save();

        return redirect()->route('admin');
    }

    /**
     * Remove запис
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->remove();
        return redirect()->route('admin');
    }
}
