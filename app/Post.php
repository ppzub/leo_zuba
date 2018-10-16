<?php

namespace Kazka;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Kazka\Traits\Youtube;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use DB;

class Post extends Model
{
    use Youtube;
    use Eloquence;
    protected $fillable = ['content', 'category_id', 'image', 'video', 'created_at', 'updated_at'];
    protected $searchableColumns = ['content' => 5];

    public function category()
    {
    	return $this->belongsTo('Kazka\Category');
    }


    public function galleries()
    {
        return $this->hasMany('Kazka\Gallery');
    }
    /**
     * формат дати укр мовою
     */
    public function getDate()
    {
        $date = Date::parse($this->created_at)->format('d F Y');
        return $date;
    }
    /**
     * формат дати для запису в БД
     */
    public function getCarbonDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('Y-m-d');
    }

    public static function setSidebarForMediaContent()
    {
        $sidebar_posts = Post::orderBy('id', 'desc')->take(10)->get();
        view()->composer('layouts.sidebar', function ($view) use($sidebar_posts){
            $view->with('sidebar_posts', $sidebar_posts);
        });
    }
    public static function setSidebarForReviewsContent()
    {
        $sidebar_posts = Post::orderBy('id', 'desc')->take(5)->get();
        view()->composer('layouts.sidebar', function ($view) use($sidebar_posts){
            $view->with('sidebar_posts', $sidebar_posts);
        });
    }
    public static function setSidebarForCategoryContent($ids = [])
    {
        $sidebar_posts = Post::whereNotIn('id', $ids)->orderBy('id', 'desc')->take(5)->get();
        view()->composer('layouts.sidebar', function ($view) use($sidebar_posts){
            $view->with('sidebar_posts', $sidebar_posts);
        });
    }
    public function getVideoData()
    {
        $this->video = $this->YoutubeID($this->video);
        $post_video_data = array();
        $post_video_data['id'] = $this->video;
        $post_video_data['thumb'] = 'http://img.youtube.com/vi/'.$this->video.'/0.jpg';
        $post_video_data['title'] = $this->youtube_title($this->video);

        return $post_video_data;
    }
    /**
     * загрузка основної картінки
     */
    public function uploadMainImage($image)
    {
        if ($image == null) { return; }
        $this->removeImage(); // якщо вже є в БД картінка для даного запису, видаляєм

        $obj = new \stdClass;
        if ($image->isValid())
        {
            $str = str_random(10);

            $obj->small = $str.'_small.png';
            $obj->medium = $str.'_medium.png';
            $obj->large = $str.'_large.png';

            $img = Image::make($image);
            $img->fit(800, 600)->save(public_path().'/images/large/'.$obj->large);
            $img->fit(412, 309)->save(public_path().'/images/medium/'.$obj->medium);
            $img->fit(120, 90)->save(public_path().'/images/small/'.$obj->small);

            $obj = json_encode($obj);
        }
        return $obj;
    }
    /**
     * загрузка галереї картінок
     */
    public function uploadGallery($gallery)
    {
        if ($gallery == null) { return; }
        $this->removeGallery(); // якщо вже є в БД галерея для даного запису, видаляєм

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
        return $array_of_objs;
    }
    public function removeImage()
    {
        if ($this->image != null)
        {
            $image = json_decode($this->image);
            Storage::delete('/images/small/'.$image->small);
            Storage::delete('/images/medium/'.$image->medium);
            Storage::delete('/images/large/'.$image->large);
        }
    }
    public function removeGallery()
    {
        if ($this->galleries != null)
        {
            foreach ($this->galleries as $image)
            {
                $temp = json_decode($image->pic);
                Storage::delete('/gallery/medium/'.$temp->medium);
                Storage::delete('/gallery/large/'.$temp->large);
                unset($temp);
            }
        }
        DB::table('galleries')->where('post_id', $this->id)->delete();
    }
    /**
     * ф-я для отримання картінки в blade
     */
    public function getImage()
    {
        $obj = new \stdClass;
        if ($this->image == null)
        {
            $obj->small = '/images/small/default_small.png';
            $obj->medium = '/images/medium/default_medium.png';
            $obj->large = '/images/large/default_large.png';
            return $obj;
        }
        else
        {
            $image = json_decode($this->image);
            $obj->small = '/images/small/'.$image->small;
            $obj->medium = '/images/medium/'.$image->medium;
            $obj->large = '/images/large/'.$image->large;
            return $obj;
        }
    }
    /**
     * ф-я для отримання галереї в blade
     */
    public function getGallery()
    {
        if ($this->galleries != null)
        {
            $array_of_objs = array();
            foreach ($this->galleries as $image)
            {
                $obj = new \stdClass;
                $image = json_decode($image->pic);
                $obj->medium = '/gallery/medium/'.$image->medium;
                $obj->large = '/gallery/large/'.$image->large;
                array_push($array_of_objs, $obj);
                unset($obj);
            }
        return $array_of_objs;
        }
    }
    /**
     * ф-я для видалення запису
     */
    public function remove()
    {
        $this->removeImage();
        $this->removeGallery();
        $this->delete();
    }
}

