<?php
	
    $output .= '<div class="videowrap '. ( $ratio != 'normal' ? 'ratio '. $ratio : '' ) .'">';
            
    $media_url = $NV_movieurl;
    $file = basename($media_url); 
    $parts = explode(".", $file); 
	
	$height = ( !empty( $img['max_height'] ) ? 'height="'. $img['max_height'] .'"' : '' );
	$width = ( !empty( $img['max_width'] ) ? 'height="'. $img['max_width'] .'"' : '' );
    
    $vidid = $parts[0]; //File name 

	if( $NV_videotype == "oembed" )
	{		
		$video_types_array = array("mp4", "mov", "flv", "wmv", "wmv", "webm", "ogv");
		$audio_types_array = array("mp3");
		
		$video_types = implode('|', $video_types_array);
		$audio_types = implode('|', $audio_types_array);
		
		if( preg_match( '/^.*\.('. $video_types .')$/i', $media_url ) )
		{
			echo do_shortcode('[video src="'. $media_url .'" '. $height .' '. $width .' ]');
		}
		elseif( preg_match( '/^.*\.('. $audio_types .')$/i', $media_url ) )
		{
			echo do_shortcode('[audio src="'. $media_url .'"]');
		}		
		else
		{
			global $wp_embed;
			echo $wp_embed->run_shortcode( '[embed '. $height .' '. $width .' ]'. $media_url .'[/embed]' );
		}
	}
    elseif( $NV_videotype == "youtube" )
	{	
		$vidid = strstr( $vidid , '=' ); // trim id after = 
		$params = strstr( $vidid , '&' ); // trim id after = 
            
		$splitter = '?'; // set url parameter	
		$isplaylist = strpos($media_url ,"playlist?list="); // check if playlist
		$isredirect = strpos($media_url ,"youtu.be"); // check if share url
       
		// if share url retrieve video id   
		if( $isredirect != false ) 
		{ 
			$vidid=$parts[0];
			$splitter = '?'; // set url parameter	
		}				
                                
		if( $isplaylist != false ) 
		{
			$vidid = 'videoseries?list='.$vidid;
			$splitter = '&amp;';		
		}	
    
            
		if( $isredirect == false )
		{
			$vidid = substr($vidid, 1); // remove = if not youtu.be address		
		}
            
		$vidid = str_replace( $params ,'', $vidid );
		$params = str_replace( '?','', $params );
		
		$output .= '<iframe frameborder="0" '. $height .' '. $width .' marginheight="0" marginwidth="0" src="//www.youtube.com/embed/'. $vidid . $splitter .'autoplay='. $NV_videoautoplay .'&amp;loop='. $NV_loop . $params .'&amp;wmode=opaque&amp;title=" allowfullscreen></iframe>';
		
    }
	elseif( $NV_videotype == "wistia" )
	{
		$extras = $components = '';
		
		$components = parse_url( $vidid );

		$vidid = str_ireplace( array('/medias/', '/embed/iframe/'), '', $components['path'] );
		$extras = $components['query'];
		
		if( $extras == '' ) $extras = 'controlsVisibleOnLoad=true&amp;version=v1&amp;volumeControl=true';
		
		// autoplay
		if( $NV_videoautoplay == '1' ) $NV_videoautoplay = 'true'; else $NV_videoautoplay = 'false'; 

		$extras = $extras . '&amp;autoPlay='.  $NV_videoautoplay;
		
		$output .= '<iframe src="http://fast.wistia.net/embed/iframe/'. $vidid .'?'. $extras .'" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" '. $height .' '. $width .'></iframe>'; 
		
    }
	elseif( $NV_videotype == "vimeo" )
	{ 
    	$output .= '<iframe frameborder="0" marginheight="0" marginwidth="0"  src="//player.vimeo.com/video/'. $vidid .'?autoplay='. $NV_videoautoplay .'&amp;loop='. $NV_loop .'&amp;title=0&amp;byline=0&amp;portrait=0&amp;" '. $height .' '. $width .' ></iframe>';
    
	} 	
	elseif( $NV_videotype == "jwp" )
	{
		$vidid = $media_url;
                
		if( empty($NV_imgwidth) ) $NV_vidwidth = $NV_imgheight * "1.595"; else $NV_vidwidth = $NV_imgwidth; // 16:9 Ratio for Video
    
		if( empty($NV_imgheight) && !empty($NV_imgwidth) ) 
		{ 
			$jwplayer_height = $jwplayer_height="". ceil( $NV_imgwidth / "1.595" ); $NV_imgheight=ceil( $NV_imgwidth / "1.595" ); 
		}
		elseif( !empty($NV_imgheight) )
		{ 
			$jwplayer_height = $NV_imgheight;
		} 
    
		if( !empty ( $video_id ) ) $slide_id = 'slide-'.$video_id;


		// hide controls if background layer
		$icons = ( !empty($NV_customlayer) ? 'true' : 'false' );
		
		$output .= '<div class="jwplayer-wrapper '. ( !empty( $NV_show_slider ) && $NV_videoautoplay == '1' ? 'autoplay' : '' ) .'"><div id="'. $slide_id .'" class="jwplayer-container" data-jw-width="'. $NV_vidwidth .'" data-jw-height="'. $jwplayer_height .'" data-jw-media="'. $NV_mediatype .'" data-jw-mediaurl="'. $vidid .'" data-jw-loop="'. $NV_loop .'" data-jw-icons="'. $icons .'" data-jw-swfsrc="'. of_get_option('jwplayer_swf') .'" data-jw-autoplay="'. ( !empty( $NV_show_slider ) && $NV_videoautoplay == '1' ? '0' : $NV_videoautoplay  ) .'"></div></div>';
		
	
		if ( is_plugin_active('jw-player-plugin-for-wordpress/jwplayermodule.php') )
		{
            wp_deregister_script( 'jw-player-init' );	
            wp_register_script( 'jw-player-init', get_template_directory_uri().'/js/jw-player.init.min.js',false,null,true );
            wp_enqueue_script( 'jw-player-init' );					
		}
    }
	
	$output .= '</div>';