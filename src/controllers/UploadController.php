<?php

class UploadController extends BaseController {

	public function uploadVideo()
	{
        $videoData = array(
            //path to file
            'source' => __DIR__. '/../../public/' . 'test.avi',
            'mime' => 'video/x-msvideo',
            'slug' => 'test.avi',
            'title' => 'Title',
            'description' => 'Lorem ipsum dolor..',
            //must be valid youtube video category
            'category' => 'Autos',
            // Please note that this must be a comma-separated string
            // and that individual keywords cannot contain whitespace
            'tags' => 'cars, funny',
            'developer_tags' => array('mydevtag', 'anotherdevtag') //optional
        );

		$youtubeConfig = Config::get('gdata.youtube');

        $youtubeClient = new YoutubeClient(
            $youtubeConfig['youtube_email'],
            $youtubeConfig['youtube_pass'],
            $youtubeConfig['api_key'],
            $youtubeConfig['api_name']
        );

        $youtubeClient->insertVideo($videoData);

        echo $youtubeClient->getVideoId(); die();

	}

}