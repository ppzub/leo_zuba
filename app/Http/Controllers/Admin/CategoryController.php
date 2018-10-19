<?php

namespace Kazka\Http\Controllers\Admin;

use Kazka\Category;
use Illuminate\Http\Request;
use Kazka\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('edit.category.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Kazka\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::findOrFail($id);
        return view('admin.category.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Kazka\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
        ]);

        $data = $request->except('_method','_token');
        $cat = Category::findOrFail($id);

        //загружаєм картінку
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $data['image'] = $cat->uploadMainImage($image, $cat);
        }

        $cat->fill($data);
        $cat->save();

        return redirect()->route('edit.category.show');
    }
}
