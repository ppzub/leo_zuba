<?php

namespace Kazka\Http\Controllers;

use Illuminate\Http\Request;
use Kazka\Post;
use Kazka\Category;
use Kazka\Traits\Youtube;
use SEOMeta;
use OpenGraph;
class CategoryController extends Controller
{
    use Youtube;

    //сторінка категорії
    public function cat($alias)
    {
    	$cat = Category::where('alias', $alias)->firstOrFail(); // достаєм з бази категорію

        //SEO
        SEOMeta::setTitle($cat->title . ' | kazka agency');
        SEOMeta::setDescription($cat->content);
        SEOMeta::setCanonical(route('cat.show', $cat->alias));
        if($cat->alias == 'davnia-kazka')
        {
            SEOMeta::setKeywords(['гурт', 'музика', 'луцьк', 'фольк', 'казкарок', 'пісня']);
        }
        else if($cat->alias == 'gulianka-live-band')
        {
            SEOMeta::setKeywords(['кавер-гурт', 'музика', 'луцьк', 'паб', 'корпоратив', 'дискотека']);
        }
        else if($cat->alias == 'guilanka-live-and-minus')
        {
            SEOMeta::setKeywords(['весілля', 'музика', 'Луцьк', 'Львів', 'Івано-Франківськ', 'Тернопіль']);
        }
        else if($cat->alias == 'mc-uzvar')
        {
            SEOMeta::setKeywords(['весілля', 'ведучий', 'Луцьк', 'Львів', 'Івано-Франківськ', 'Тернопіль']);
        }
        else if($cat->alias == 'liberta')
        {
            SEOMeta::setKeywords(['весілля', 'шоу-балет', 'перший', 'танець', 'корпоратив']);
        }
        else if($cat->alias == 'dzi-r-dzio')
        {
            SEOMeta::setKeywords(['дзідзьо', 'пародист', 'Луцьк', 'Львів', 'Івано-Франківськ', 'Тернопіль']);
        }
        else if($cat->alias == 'sax')
        {
            SEOMeta::setKeywords(['саксофон', 'музика', 'корпоратив', 'весілля', 'свято', 'Луцьк']);
        }
        else if($cat->alias == 'dj')
        {
            SEOMeta::setKeywords(['dj', 'музика', 'корпоратив', 'весілля', 'Луцьк']);
        }

        OpenGraph::setTitle($cat->title . ' | kazka agency'); // define title
        OpenGraph::setDescription($cat->content);  // define description
        OpenGraph::setUrl(route('cat.show', $cat->alias)); // define url
        OpenGraph::setSiteName('kazka agency'); //define site_name
        OpenGraph::addProperty('type', 'category');
        OpenGraph::addProperty('locale', 'uk_UA');
        OpenGraph::addImage(route('index').$cat->getImage()->medium);
        //END SEO

    	$cat_news = $cat->getNewsForCategory(); // формуєм записи, що стосуються категорії
    	$cat_news = $cat_news->reverse();
    	$cat_videos = $cat->getVideosForCategory(); // формуєм відоси, що стосуються категорії
        $cat_video_data = array();
    	$cat_images = $cat->getImagesForCategory(); // формуєм картінки, що стосуються категорії
        $cat_images = array_reverse($cat_images);
    	foreach ($cat_videos as $k => &$video)
    	{
    		$video = $this->YoutubeID($video);
            $cat_video_data[$k] = array();
            $cat_video_data[$k]['id'] = $video;
            $cat_video_data[$k]['thumb'] = 'http://img.youtube.com/vi/'.$video.'/0.jpg';
            $cat_video_data[$k]['title'] = $this->youtube_title($video);
    	}
    	unset($video);
        $ids = $this->getNewsIds($cat_news);
    	Post::setSidebarForCategoryContent($ids); // sidebar для сторінки категорії
    	$cat_content = view('layouts.main_content')->with(compact('cat','cat_news','cat_video_data','cat_images'))->render();

    	return view('layouts.site')->with('main_content', $cat_content);
    }

    //сторінка новин категорії
    public function news($alias)
    {
        $cat = Category::where('alias', $alias)->firstOrFail();
        $cat_news_show = $cat->getNewsForCategory();
        $cat_news_show = $cat_news_show->reverse();
        $ids = $this->getAllNewsIds($cat_news_show);
        Post::setSidebarForCategoryContent($ids);
        $cat_content = view('layouts.main_content')->with(compact('cat','cat_news_show'))->render();
        return view('layouts.site')->with('main_content', $cat_content);
    }

    //сторінка відосів категорії
    public function videos($alias)
    {
        $cat = Category::where('alias', $alias)->firstOrFail();
        $cat_videos_show = $cat->getVideosForCategory();
        $cat_video_data_show = array();
        foreach ($cat_videos_show as $k => &$video)
        {
            $video = $this->YoutubeID($video);
            $cat_video_data_show[$k] = array();
            $cat_video_data_show[$k]['id'] = $video;
            $cat_video_data_show[$k]['thumb'] = 'http://img.youtube.com/vi/'.$video.'/0.jpg';
            $cat_video_data_show[$k]['title'] = $this->youtube_title($video);
        }
        unset($video);

        Post::setSidebarForCategoryContent();
        $cat_content = view('layouts.main_content')->with(compact('cat','cat_video_data_show'))->render();
        return view('layouts.site')->with('main_content', $cat_content);
    }

    //сторінка картінок категорії
    public function images($alias)
    {
        $cat = Category::where('alias', $alias)->firstOrFail();
        $cat_images_show = $cat->getImagesForCategory();
        $cat_images_show = array_reverse($cat_images_show);
        Post::setSidebarForCategoryContent();
        $cat_content = view('layouts.main_content')->with(compact('cat','cat_images_show'))->render();
        return view('layouts.site')->with('main_content', $cat_content);
    }
    // id останніх трьох записів категорії
    public function getNewsIds ($value)
    {
        $ids = array();
        $i = 0;
        foreach ($value as $post)
        {
            if ($i == 3)
            {
                break;
            }
            array_push($ids, $post->id);
            $i++;
        }
        return $ids;
    }
    // id всіх записів категорії
    public function getAllNewsIds ($value)
    {
        $ids = array();
        foreach ($value as $post)
        {
            array_push($ids, $post->id);
        }
        return $ids;
    }
}