<?php

namespace Kazka\Http\Controllers;

use Illuminate\Http\Request;
use Kazka\Post;
use Kazka\Category;
use Kazka\Traits\Youtube;
use SEOMeta;
use OpenGraph;

class MainController extends Controller
{
    use Youtube;

    public function index()
    {
        SEOMeta::setTitle('kazka agency - все для вашого свята');
        SEOMeta::setDescription('В нас є все, щоб зробити ваше весілля найкращим! Музика і ведучий на весілля, шоу-балет, декор, фото та відеозйомка');
        SEOMeta::setKeywords(['весілля', 'музика', 'ведучий', 'декор', 'фото', 'відео']);
        SEOMeta::setCanonical(route('index'));

        OpenGraph::setTitle('kazka agency - все для вашого свята'); // define title
        OpenGraph::setDescription('В нас є все, щоб зробити ваше весілля найкращим! Музика і ведучий на весілля, шоу-балет, декор, фото та відеозйомка');  // define description
        OpenGraph::setUrl(route('index')); // define url
        OpenGraph::setSiteName('kazka agency'); //define site_name
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('locale', 'uk_UA');
        OpenGraph::addImage(asset('images/medium') . '/default_medium.png');

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

        //SEO
        SEOMeta::setTitle('Новини kazka agency - '. $post->category->title);
        SEOMeta::setDescription($post->content);
        SEOMeta::setCanonical(route('post.show', $id));
        SEOMeta::addKeyword($post->category->title);
        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $post->category->title, 'property');

        OpenGraph::setTitle('Новини kazka agency - '. $post->category->title);; // define title
        OpenGraph::setDescription($post->content);  // define description
        OpenGraph::setUrl(route('post.show', $id)); // define url
        OpenGraph::setSiteName('kazka agency'); //define site_name
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'uk_UA');
        OpenGraph::addImage(route('index').$post->getImage()->medium);
        //END SEO
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
        $news = Post::orderBy('id', 'desc')->paginate(10);
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
        $count = count($cats) + count($posts);

        $sidebar_video_data = $this->getVideosSidebar();
        return view('layouts.site')->with([
            'cats' => $cats,
            'posts' => $posts,
            'count' => $count,
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
