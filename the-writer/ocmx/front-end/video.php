<?php function video_info($url) {

	// Handle Youtube
	if (strpos($url, "youtube.com")) :
		$url = parse_url($url);
		$vid = parse_str($url['query'], $output);
		$video_id = $output['v'];
		$data['video_type'] = 'youtube';
		$data['video_id'] = $video_id;

		$response = wp_remote_get("http://gdata.youtube.com/feeds/api/videos?v=2&alt=jsonc&q=$video_id", array( 'sslverify' => false ));

		if(empty($response) || is_wp_error( $response )) return;

		$body = json_decode($response['body']);

		foreach ($body->data->items as $entry) :
			// get video player URL
			$watch = $entry->player->default;

			// get video thumbnail
			$data['thumb_large'] = $entry->thumbnail->hqDefault;
			$data['cat'] = $entry->category; // Video category
			$data['duration'] = $entry->duration;
			$data['views'] = $entry->viewCount;
			$data['title']=$entry->title;
			$data['info']=$entry->description;
		endforeach;
	// Handle Vimeo
	elseif (strpos($url, "vimeo.com")) :
		$video_id=explode('vimeo.com/', $url);
		$video_id=$video_id[1];
		$data['video_type'] = 'vimeo';
		$data['video_id'] = $video_id;

		$response = wp_remote_get("http://vimeo.com/api/v2/video/$video_id.json", array( 'sslverify' => false ));

		if(empty($response) || is_wp_error( $response )) return;

		$body = json_decode($response['body']);

		foreach ($body as $video) :

			$data['id']=$video->id;
			$data['title']=$video->title;
			$data['info']=$video->description;
			$data['url']=$video->url;
			$data['upload_date']=$video->upload_date;
			$data['mobile_url']=$video->mobile_url;
			$data['thumb_small']=$video->thumbnail_small;
			$data['thumb_medium']=$video->thumbnail_medium;
			$data['thumb_large']=$video->thumbnail_large;
			$data['user_name']=$video->user_name;
			$data['urer_url']=$video->user_url;
			$data['user_thumb_small']=$video->user_portrait_small;
			$data['user_thumb_medium']=$video->user_portrait_medium;
			$data['user_thumb_large']=$video->user_portrait_large;
			$data['user_thumb_huge']=$video->user_portrait_huge;
			$data['likes']=$video->stats_number_of_likes;
			$data['views']=$video->stats_number_of_plays;
			$data['comments']=$video->stats_number_of_comments;
			$data['duration']=$video->duration;
			$data['width']=$video->width;
			$data['height']=$video->height;
			$data['tags']=$video->tags;
		endforeach;
	// Set false if invalid URL
	else :
		$data = false;
	endif;
	return $data;

}