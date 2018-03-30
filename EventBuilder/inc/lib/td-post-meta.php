<?php

/**
 * Create the Post meta boxes
 */
 
add_action('add_meta_boxes', 'themesdojo_metabox_posts');
function themesdojo_metabox_posts(){
	
	/* Create a link metabox ----------------------------------------------------*/
	$meta_box = array(
		'id' => 'themesdojo-metabox-post-link',
		'title' =>  __('Link Settings', 'themesdojo'),
		'description' => __('Input your link', 'themesdojo'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' =>  __('The Link', 'themesdojo'),
					'desc' => __('Insert your link URL, e.g. http://www.alexgurghis.com.', 'themesdojo'),
					'id' => '_td_link_url',
					'type' => 'text',
					'std' => ''
				)
		)
	);
    td_add_meta_box( $meta_box );
    
    /* Create a video metabox -------------------------------------------------------*/
    $meta_box = array(
		'id' => 'themesdojo-metabox-post-video',
		'title' => __('Video Settings', 'themesdojo'),
		'description' => __('These settings enable you to embed videos into your posts.', 'themesdojo'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' => __('Embedded Code', 'themesdojo'),
					'desc' => __('Paste the embed code here. Width is best at 1060px with any height.', 'themesdojo'),
					'id' => '_td_video_embed_code',
					'type' => 'textarea',
					'std' => ''
				)
		)
	);
	td_add_meta_box( $meta_box ); 
	
	/* Create a audio metabox -------------------------------------------------------*/
    $meta_box = array(
		'id' => 'themesdojo-metabox-post-audio',
		'title' => __('Audio Settings', 'themesdojo'),
		'description' => __('These settings enable you to embed audio soundcloud into your posts.', 'themesdojo'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' => __('Embedded Code', 'themesdojo'),
					'desc' => __('Paste the embed code here. Width is best at 1060px with any height.', 'themesdojo'),
					'id' => '_td_audio_embed_code',
					'type' => 'textarea',
					'std' => ''
				)
		)
	);
	td_add_meta_box( $meta_box ); 

	/* Create a audio metabox -------------------------------------------------------*/
    $meta_box = array(
		'id' => 'themesdojo-metabox-post-quote',
		'title' => __('Quote Settings', 'themesdojo'),
		'description' => __('These settings enable you to add quote into your posts.', 'themesdojo'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' => __('Quote', 'themesdojo'),
					'desc' => __('Add here the quote.', 'themesdojo'),
					'id' => '_td_quote',
					'type' => 'textarea',
					'std' => ''
				),
			array(
					'name' =>  __('Quote Author', 'themesdojo'),
					'desc' => __('Add here quote author.', 'themesdojo'),
					'id' => '_td_quote_author',
					'type' => 'text',
					'std' => ''
				)
		)
	);
	td_add_meta_box( $meta_box ); 
	
	/* Create an audio metabox ------------------------------------------------------*/
	/*

	$meta_box = array(
		'id' => 'themesdojo-metabox-post-audio',
		'title' =>  __('Audio Settings', 'themesdojo'),
		'description' => __('These settings enable you to embed audio into your posts. You must provide both .mp3 and .agg/.oga file formats in order for self hosted audio to function accross all browsers.', 'themesdojo'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('MP3 File URL', 'themesdojo'),
					'desc' => __('The URL to the .mp3 audio file', 'themesdojo'),
					'id' => '_themesdojo_audio_mp3',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('OGA File URL', 'themesdojo'),
					'desc' => __('The URL to the .oga, .ogg audio file', 'themesdojo'),
					'id' => '_themesdojo_audio_ogg',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Audio Poster Image', 'themesdojo'),
					'desc' => __('The preview image for this audio track. Image width should be 500px.', 'themesdojo'),
					'id' => '_themesdojo_audio_poster_url',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Audio Poster Image Height', 'themesdojo'),
					'desc' => __('The height of the poster image', 'themesdojo'),
					'id' => '_themesdojo_audio_height',
					'type' => 'text',
					'std' => ''
				)
		)
	);
	td_add_meta_box( $meta_box );

	*/
}