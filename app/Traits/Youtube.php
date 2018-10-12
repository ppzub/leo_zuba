<?php

namespace Kazka\Traits;

trait Youtube
{
    /**
     * id відео з youtube
     */
	public function YoutubeID($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;
        }
        return $url;
    }
    /**
     * title відео з youtube
     */
    public function youtube_title($id) {
        $html = 'https://www.googleapis.com/youtube/v3/videos?id='.$id.'&key=AIzaSyC9J6iJ89bIAYIBQItH21rWCbJa7o9rrnU&part=snippet';
        $response = file_get_contents($html);
        $decoded = json_decode($response, true);
        foreach ($decoded['items'] as $items)
        {
            $title = $items['snippet']['title'];
            return $title;
        }
    }
}