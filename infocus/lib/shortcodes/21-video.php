<?php
/**
 *
 */
class mysiteVideo {
	
	private static $video_id = 1;
	
	/**
	 *
	 */
	function _video_id() {
	    return self::$video_id++;
	}
	
	/**
	 * http://code.google.com/intl/en/apis/youtube/player_parameters.html
	 */
	function youtube( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array(
				'name' => __( 'YouTube', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'youtube',
				'options' => array(
					array(
						'name' => __( 'YouTube Video URL', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'When viewing your youtube video in your web browser copy the URL and paste it here.  Here is an example of what it might look like,<br /><br />http://www.youtube.com/watch?v=SX728EemOPOIw&feature=related', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'url',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Width', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can set the width of your video here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Height', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can set the height of your video here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Autohide', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can hide various youtube displays from showing on your video.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'autohide',
						'options' => array(
							'0' => __( 'Visible', MYSITE_ADMIN_TEXTDOMAIN ),
							'1' => __( 'Hide all', MYSITE_ADMIN_TEXTDOMAIN ),
							'2' => __( 'Hide video progress bar', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Autoplay', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this to have your video play after it is loaded.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'autoplay',
						'options' => array( '1' => __( 'Video will autoplay when the player loads', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Controls', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this to have the youtube player controls display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'controls',
						'options' => array( '0' => __( 'Disable video player controls', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Disable KB', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this to disable the keyboard controls', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '1' => __( 'Disable the player keyboard controls', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'disablekb',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Fullscreen', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this to allow your video to be played in fullscreen mode.<br /><br />A small button will display in the bottom right hand corner for fullscreen mode.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '1' => __( 'Enables the fullscreen button in the video player', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'fs',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'HD', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will enable your video to be viewed in HD format.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '1' => __( 'Enables HD video playback by default', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'hd',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Loop', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This will set your video to loop.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '1' => __( 'Play the initial video again and again', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'loop',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Related Videos', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will disable the related videos from appearing once your video is done playing.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '0' => __( 'Disable related videos once playback of the initial video starts', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'rel',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Search', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will disable the search box from displaying when the video is minimized.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '0' => __( 'Disables the search box from displaying when the video is minimized', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'showsearch',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Info', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will disable the display information.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '0' => __( 'Disable display information', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'showinfo',
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'url' 		=> false,
			'width' 	=> '',
			'height' 	=> '',
			'autohide'  => '2',
			'autoplay'  => '0',
			'controls'  => '1',
			'disablekb' => '0',
			'fs'        => '0',
			'hd'        => '0',
			'loop'      => '0',
			'rel'       => '1',
			'showsearch'=> '1',
			'showinfo'  => '1',
		), $atts));
		
		if( !$url )
			return __( 'Please enter the url to a YouTube video.', MYSITE_TEXTDOMAIN );
			
		if ( preg_match( '/^http\:\/\/(?:(?:[a-zA-Z0-9\-\_\.]+\.|)youtube\.com\/watch\?v\=|youtu\.be\/)([a-zA-Z0-9\-\_]+)/i', $url, $matches ) > 0 )
	        $video_id = $matches[1];
	
	    elseif ( preg_match('/^([a-zA-Z0-9\-\_]+)$/i', $url, $matches ) > 0 )
	        $video_id = $matches[1];
	
		if( !isset( $video_id ) )
			return __( 'There was an error retrieving the YouTube video ID for the url you entered, please verify that the url is correct.', MYSITE_TEXTDOMAIN );
			
		$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : '560';
		$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : '340';
		
		$_video_id = self::_video_id();
				
		return "<div class='video_frame'><iframe id='youtube_video_$_video_id' class='youtube_video' style='height:{$height}px;width:{$width}px' src='http://www.youtube.com/embed/{$video_id}?autohide={$autohide}&amp;autoplay={$autoplay}&amp;controls={$controls}&amp;disablekb={$disablekb}&amp;fs={$fs}&amp;hd={$hd}&amp;loop={$loop}&amp;rel={$rel}&amp;showinfo={$showinfo}&amp;showsearch={$showsearch}&amp;wmode=transparent&amp;enablejsapi=1' width='{$width}' height='{$height}' frameborder='0'></iframe></div>";
		
		
	}
	
	/**
	 * http://vimeo.com/api/docs/player
	 */
	function vimeo( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Vimeo', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'vimeo',
				'options' => array(
					array(
						'name' => __( 'Vimeo Video URL', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'When viewing your vimeo video in your web browser copy the URL and paste it here.  Here is an example of what it might look like,<br /><br />http://vimeo.com/12345678', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'url',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Width', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can set the width of your video here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'width',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Height', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can set the height of your video here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'height',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will disable your title from displaying on the video.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '0' => __( 'Disable title on the video', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'title',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Byline', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will disable your byline from displaying on the video.<br /><br />The byline appears right below your title.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '0' => __( 'Disable byline on the video', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'fs',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Portrait', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Checking this will disable the portrait image from displaying on the video.<br /><br />The portrait image appears to the left of the title and byline.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '0' => __( "Disable user's portrait on the video", MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'portrait',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Autoplay', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check to have your video play automatically after it is loaded.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '1' => __( 'Play the video automatically on load', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'autoplay',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Loop', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check to have your video loop after it is done playing.', MYSITE_ADMIN_TEXTDOMAIN ),
						'options' => array( '1' => __( 'Play the video again when it reaches the end', MYSITE_ADMIN_TEXTDOMAIN ) ),
						'id' => 'loop',
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'url' 		=> false,
			'width' 	=> '',
			'height' 	=> '',
			'title'     => '1',
			'byline'    => '1',
			'portrait'  => '1',
			'autoplay'  => '0',
			'loop'      => '0',
		), $atts));
		
		
		if( !$url )
			return __( 'Please enter the url to a Vimeo video.', MYSITE_TEXTDOMAIN );
			
		if ( preg_match( '#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i', $url, $matches ) > 0 )
	        $video_id = $matches[3];
	
	    elseif ( preg_match('/^([a-zA-Z0-9\-\_]+)$/i', $url, $matches ) > 0 )
	        $video_id = $matches[1];
	
		if( !isset( $video_id ) )
			return __( 'There was an error retrieving the Vimeo video ID for the url you entered, please verify that the url is correct.', MYSITE_TEXTDOMAIN );
			
		$width = ( !empty( $width ) ) ? trim(str_replace(' ', '', str_replace('px', '', $width ) ) ) : '560';
		$height = ( !empty( $height ) ) ? trim(str_replace(' ', '', str_replace('px', '', $height ) ) ) : '340';
		
		$_video_id = self::_video_id();
		
		return "<div class='video_frame'><iframe id='vimeo_video_$_video_id' class='vimeo_video' style='height:{$height}px;width:{$width}px' src='http://player.vimeo.com/video/{$video_id}?title={$title}&amp;byline={$byline}&amp;portrait={$portrait}&amp;autoplay={$autoplay}&amp;loop={$loop}&amp;js_api=1&amp;js_swf_id=vimeo_video_$_video_id' width='{$width}' height='{$height}' frameborder='0'></iframe></div>";
		
	}
		
	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods($class);

		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}

		$options = array(
			'name' => __( 'Video', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of video you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'video',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);

		return $options;
	}

}

?>