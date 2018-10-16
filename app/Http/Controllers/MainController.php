<?php

namespace Kazka\Http\Controllers;

use Illuminate\Http\Request;
use Kazka\Post;
use Kazka\Category;
use Kazka\Traits\Youtube;

class MainController extends Controller
{
    use Youtube;

    public function index()
    {
        return view('index');
    }
    /**
     * Відображення сторінки окремого запису
     */
    public function post($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        $pics = $post->getGallery();
        $pics = array_reverse($pics);
        $post->video = $this->YoutubeID($post->video);
        $post_video_data = array();
        $post_video_data['id'] = $post->video;
        $post_video_data['thumb'] = 'http://img.youtube.com/vi/'.$post->video.'/0.jpg';
        $post_video_data['title'] = $this->youtube_title($post->video);

        $post_content = view('layouts.main_content')->with(compact('post', 'post_video_data', 'pics'))->render();

        $sidebar_posts = Post::whereNotIn('id', [$id])->orderBy('id', 'desc')->take(5)->get();

        view()->composer('layouts.sidebar', function ($view) use($sidebar_posts){
            $view->with('sidebar_posts', $sidebar_posts);
        });
        return view('layouts.site')->with('main_content', $post_content);
    }
    /**
     * Відображення сторінки новини з shuffle відосами в sidebar
     */
    public function news()
    {
        $news = Post::orderBy('id', 'desc')->paginate(5);
        $sidebar_video_data = $this->getVideosSidebar();
        return view('layouts.site')->with([
            'news' => $news,
            'sidebar_video_data' => $sidebar_video_data
        ]);
    }
    /**
     * Відображення сторінки відгуки
     */
    public function reviews()
    {
        $reviews = 'Відгуки';
        $reviews_content = view('layouts.main_content')->with('reviews', $reviews)->render();
        Post::setSidebarForReviewsContent();
        return view('layouts.site')->with('main_content', $reviews_content);
    }
    public function search(Request $request)
    {
        $posts = Post::search($request->key)->get();
        $cats = Category::search($request->key)->get();
        $sidebar_video_data = $this->getVideosSidebar();
        return view('layouts.site')->with([
            'cats' => $cats,
            'posts' => $posts,
            'sidebar_video_data' => $sidebar_video_data
        ]);
    }
    public function getVideosSidebar ()
    {
        $videos = Post::pluck('video');
        $sidebar_video_data = array();
        foreach ($videos as $key => $value)
        {
            if ($value == null)
            {
                $videos->forget($key);
            }
        }

        $videos = $videos->shuffle()->take(3);

        for ($i=0; $i<count($videos); $i++)
        {
            $videos[$i] = $this->YoutubeID($videos[$i]);
            $sidebar_video_data[$i] = array();
            $sidebar_video_data[$i]['id'] = $videos[$i];
            $sidebar_video_data[$i]['thumb'] = 'http://img.youtube.com/vi/'.$videos[$i].'/0.jpg';
            $sidebar_video_data[$i]['title'] = $this->youtube_title($videos[$i]);
        }
        return $sidebar_video_data;
    }
}
