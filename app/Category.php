<?php

namespace Kazka;

use Illuminate\Database\Eloquent\Model;
use Kazka\Category;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class Category extends Model
{
	protected $fillable = ['title', 'content', 'image'];

    public function posts()
    {
    	return $this->hasMany('Kazka\Post');
    }


    public function getNewsForCategory()
    {
    	return (!$this->posts->isEmpty()) ? $this->posts : collect($value = null);
    }
    public function getVideosForCategory()
    {
    	$videos = array();
    	if (!$this->posts->isEmpty())
            {
                foreach ($this->posts as $key => $post)
                {
                    if ($post->video == null)
                    {
                        continue;
                    }
                    else
                    {
                    	array_unshift($videos, $post->video);
                    }
                }
            }
        return $videos;
    }
    public function getImagesForCategory()
    {
    	$images = array();
    	if (!$this->posts->isEmpty())
            {
                foreach ($this->posts as $key => $post)
                {
                    if ($post->image == null)
                    {
                    	continue;
                    }
                    else
                    {
                        array_push($images, $post->getImage($post->image));
                        if($post->galleries)
                        {
                            foreach ($post->galleries as $gallery)
                            {
                                array_push($images, $this->getPic($gallery->pic));
                            }
                        }
                    }
                }
            }

        return $images;
    }

    /**
     * загрузка основної картінки
     */
    public function uploadMainImage($image, Category $cat)
    {
        if ($image == null) { return; }
        $this->removeImage(); // якщо вже є в БД картінка для даної категорії, видаляєм

        $obj = new \stdClass;
        if ($image->isValid())
        {
            $str = $cat->alias;

            $obj->small = $str.'_small.png';
            $obj->medium = $str.'_medium.png';
            $obj->large = $str.'_large.png';

            $img = Image::make($image);
            $img->fit(800, 600)->save(public_path().'/img/category/large/'.$obj->large);
            $img->fit(412, 309)->save(public_path().'/img/category/medium/'.$obj->medium);
            $img->fit(120, 90)->save(public_path().'/img/category/small/'.$obj->small);

            $obj = json_encode($obj);
        }
        return $obj;
    }
    public function getImage($image)
    {
        $obj = new \stdClass;
        if ($image == null)
        {
            $obj->small = '/images/small/default_small.png';
            $obj->medium = '/images/medium/default_medium.png';
            $obj->large = '/images/large/default_large.png';
            return $obj;
        }
        else
        {
            $image = json_decode($image);
            $obj->small = '/img/category/small/'.$image->small;
            $obj->medium = '/img/category/medium/'.$image->medium;
            $obj->large = '/img/category/large/'.$image->large;
            return $obj;
        }
    }
    public function removeImage()
    {
        if ($this->image != null)
        {
            $image = json_decode($this->image);
            Storage::delete('/img/category/small/'.$image->small);
            Storage::delete('/img/category/medium/'.$image->medium);
            Storage::delete('/img/category/large/'.$image->large);
        }
    }
    public function getPic($image)
    {
        $obj = new \stdClass;
        $image = json_decode($image);
        $obj->medium = '/gallery/medium/'.$image->medium;
        $obj->large = '/gallery/large/'.$image->large;
        return $obj;
    }
}