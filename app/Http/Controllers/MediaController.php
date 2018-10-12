<?php

namespace Kazka\Http\Controllers;

use Illuminate\Http\Request;
use Kazka\Post;
use Kazka\Category;
use Kazka\Traits\Youtube;

class MediaController extends Controller
{
    use Youtube;
    /**
     * Відображення сторінки відео
     */
    public function videos()
    {
        $media = Category::with('posts')->get(); // записи по категоріях
        $videos = array();
        $video_data = array();
        foreach ($media as $k => $cat)
        {
            if (!$cat->posts->isEmpty())
            {
                $videos[$k] = array();

                foreach ($cat->posts as $key => $post)
                {
                    if ($post->video == null)
                    {
                        $cat->posts->forget($key);
                    }
                    else
                    {
                        array_unshift($videos[$k], $post->video);
                    }
                }
            }
        }
        foreach ($videos as $k => &$video)
        {
            $video_data[$k] = array();
            foreach ($video as $i => &$value)
            {
                $value = $this->YoutubeID($value);
                $video_data[$k][$i]['id'] = $value;
                $video_data[$k][$i]['thumb'] = 'http://img.youtube.com/vi/'.$value.'/0.jpg';
                $video_data[$k][$i]['title'] = $this->youtube_title($value);
            }
            unset($value);
        }
        unset($video);
        $media_videos_content = view('layouts.main_content')->with([
            'media' => $media,
            'video_data' => $video_data,
        ])->render();

        Post::setSidebarForMediaContent();
        return view('layouts.site')->with('main_content', $media_videos_content);
    }
    /**
     * Відображення сторінки світлини
     */
    public function images()
    {
        $media = Category::with('posts')->get(); // записи по категоріях
        $images = array();

        foreach ($media as $k => $cat)
        {
            if (!$cat->posts->isEmpty()) // якщо категорія має записи
            {
                $images[$k] = array();
                foreach ($cat->posts as $key => $post)
                {
                    if ($post->image == null)
                    {
                        $cat->posts->forget($key);
                    }
                    else
                    {
                        array_unshift($images[$k], $post->getImage());
                        if($post->getGallery())
                        {
                            foreach ($post->getGallery() as $pic)
                            {
                                array_unshift($images[$k], $pic);
                            }
                        }
                    }
                }
            }
        }

        $media_images_content = view('layouts.main_content')->with([
            'media' => $media,
            'images' => $images])->render();

        Post::setSidebarForMediaContent();
        return view('layouts.site')->with('main_content', $media_images_content);
    }
}
