<?php

namespace Kazka\Http\Controllers\Admin;

use Kazka\Gallery;
use Illuminate\Http\Request;
use Kazka\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Kazka\Post;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Show форма створення галереї до поста
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $post = Post::findOrFail($id);
        $array_of_obj = $post->getGallery();
        $array_of_obj = array_reverse($array_of_obj);
        $gal_ids = Gallery::orderBy('id', 'desc')->where('post_id', $id)->pluck('id')->all();
        return view('admin.gallery.create', compact('array_of_obj','post', 'gal_ids'));
    }

    /**
     * Збереження новоствореної галереї
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if ($request->hasFile('gallery'))
        {
            $gallery = $request->file('gallery');
        }

        $post = Post::findOrFail($id);
        $array_of_objs = array();
        foreach ($gallery as $image)
        {
            $obj = new \stdClass;
            if ($image->isValid())
            {
                $str = str_random(10);
                $obj->medium = $str.'_medium.png';
                $obj->large = $str.'_large.png';

                $img = Image::make($image);
                $img->fit(800, 600)->save(public_path().'/gallery/large/'.$obj->large);
                $img->fit(412, 309)->save(public_path().'/gallery/medium/'.$obj->medium);
                $obj = json_encode($obj);

                array_push($array_of_objs, ['pic' => $obj]);
                unset($obj);
            }
        }
        $post->galleries()->createMany($array_of_objs); // заповнення таблиці galleries
        return redirect()->back();
    }
    /**
     * Сторінка редагуванння галереї
     *
     * @param  \Kazka\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $array_of_obj = $post->getGallery();
        $array_of_obj = array_reverse($array_of_obj);
        $gal_ids = Gallery::orderBy('id', 'desc')->where('post_id', $id)->pluck('id')->all();
        return view('admin.gallery.edit', compact('array_of_obj','post', 'gal_ids'));
    }

    /**
     * Додавання фоток до галереї
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Kazka\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('gallery'))
        {
            $gallery = $request->file('gallery');
        }

        $post = Post::findOrFail($id);
        $array_of_objs = array();
        foreach ($gallery as $image)
        {
            $obj = new \stdClass;
            if ($image->isValid())
            {
                $str = str_random(10);
                $obj->medium = $str.'_medium.png';
                $obj->large = $str.'_large.png';

                $img = Image::make($image);
                $img->fit(800, 600)->save(public_path().'/gallery/large/'.$obj->large);
                $img->fit(412, 309)->save(public_path().'/gallery/medium/'.$obj->medium);
                $obj = json_encode($obj);

                array_push($array_of_objs, ['pic' => $obj]);
                unset($obj);
            }
        }
        $post->galleries()->createMany($array_of_objs); // заповнення таблиці galleries
        return redirect()->back();
    }

    /**
     * Видалення однієї фоткі з галереї
     *
     * @param  \Kazka\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gal = Gallery::findOrFail($id);
        $temp = json_decode($gal->pic);
        Storage::delete('/gallery/medium/'.$temp->medium);
        Storage::delete('/gallery/large/'.$temp->large);
        $gal->delete();
        return redirect()->back();
    }
}
