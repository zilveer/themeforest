<?php

	/*
	*	CrunchPress Videos Item Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Nasir Hayat
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print product related item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/


	function print_image_thumbnail( $post_id, $item_size ){
	
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			
			if( !empty($thumbnail)){
		        echo '<a href="' . get_permalink() . '"><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a>';
			}
			elseif (empty($thumbnail)){
				$item_size_arr= explode('x',$item_size);
				$item_size_new_h=$item_size_arr[1];
				$item_size_new_w=$item_size_arr[0];
				echo '<img style="width:'. $item_size_new_w .'px; height:'. $item_size_new_h .'px; " src="' .CP_THEME_PATH_URL.'/images/nothumb.png" width="'. $item_size_new_w .'px" height="'. $item_size_new_h .'px" alt="no image"/>';
			}
			
	}
	
function short_number($n, $decimals = 2, $suffix = '') {
	if(!$suffix)
		$suffix = 'K,M,B';
	$suffix = explode(',', $suffix);

    if ($n < 1000) { // any number less than a Thousand
        $shorted = number_format($n);
    } elseif ($n < 1000000) { // any number less than a million
        $shorted = number_format($n/1000, $decimals).$suffix[0];
    } elseif ($n < 1000000000) { // any number less than a billion
        $shorted = number_format($n/1000000, $decimals).$suffix[1];
    } else { // at least a billion
        $shorted = number_format($n/1000000000, $decimals).$suffix[2];
    }

    return $shorted;
}

/**
 * Get post stats(views/comments/likes)
 *
 * @since deTube 1.0
 */
function cp_get_post_stats($pid = '') {
	global $post;
	if(!$pid)
		$pid = $post->ID;
	if(!$pid)
		return;
	
	$views = sprintf(__('%s ', 'cp'), '<p class="count">'.cp_get_post_views($pid).'</p>');
	$comments = sprintf(__('%s ', 'cp'), '<p class="count">'.get_comments_number($pid).'</p>');
	$likes = sprintf(__('%s ', 'cp'), '<p class="count" data-pid="'.$pid.'">'.cp_get_post_likes($pid).'</p>');
	
	$liked = cp_is_user_liked_post($pid) ? ' liked': '';
				
	$stats = '<ul><li><a><i class="fa fa-eye"></i>'.$views.'</a></li>';
	$stats .= '<li><a><i class="fa fa-comment-o"></i>'.$comments.'</a></li>';
	$stats .= '<li><a><i class="fa fa-thumbs-o-up"></i>'.$likes.'</a></li>';
	$stats .= '</ul>';
	return $stats;
}


/**
 * Get post views by 'WP Postviews' plugin
 */
function cp_get_post_views($post_id = '') {
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
		
	$views = get_post_meta($post_id, 'views', true);
	$views = absint($views);
	//$views = number_format_i18n($views);
	$views = short_number($views);
	
	return $views;
}

function cp_video($post_id, $item_size) {
	$autoplay = false;

	$file = get_post_meta($post_id, 'post-option-inside-thumbnail-video-file', true);
	$files = !empty($file) ? explode("\n", $file) : array();
	$url = trim(get_post_meta($post_id, 'post-option-inside-thumbnail-video-url', true));
	$code = trim(get_post_meta($post_id, 'post-option-inside-thumbnail-video-code', true));
	
	
	
	
	// Automatic Youtube Video Post plugin
	//$tern_wp_youtube_video = get_post_meta($post_id, '_tern_wp_youtube_video', true);
	
	// Define RELATIVE_PATH for Flowplayer in Ajax Call
	if (!defined('RELATIVE_PATH') && defined('DOING_AJAX') && DOING_AJAX)
		define('RELATIVE_PATH', plugins_url().'/fv-wordpress-flowplayer');
	
	if(!empty($code)) {

		$video = do_shortcode($code);
		$video = apply_filters('cp_video_filter', $video);
		$video = extend_video_html($video, $item_size);
		
		if(has_shortcode($code, 'fvplayer') || has_shortcode($code, 'flowplayer'))
			wp_ajax_flowplayer_script();
		
		echo $video;
	} 
	elseif(!empty($url)) {
		$url = trim($url);
		$video = '';
		$youtube_player = '';
		// Youtube List
		if(preg_match('/http:\/\/www.youtube.com\/embed\/(.*)?list=(.*)/', $url)) {
			$video = '<iframe width="'.$item_width.'" height="'.$item_height.'" src="'.$url.'" frameborder="0" autoplay="0" allowfullscreen></iframe>';
		} 
		// Youtube Player
		elseif(strpos($url, 'youtube.com') !== false && !empty($youtube_player)) {
			$args = array(
				'files' => array($url),
				'poster' => $poster,
				'autoplay' => $autoplay
			);
			cp_player($youtube_player, $args);
		} 
		// WordPress Embeds
		else {
			global $wp_embed, $item_size ;
			$orig_wp_embed = $wp_embed;
			
			$wp_embed->post_ID = $post_id;
			$video = $wp_embed->autoembed($url);
			
			if(trim($video) == $url) {
				$wp_embed->usecache = false;
				$video = $wp_embed->autoembed($url);
			}
			
			$wp_embed->usecache = $orig_wp_embed->usecache;
			$wp_embed->post_ID = $orig_wp_embed->post_ID;
		}
		
		$video = extend_video_html($video, $autoplay, $item_size);

		echo $video;
	} 
	elseif(!empty($files)) {
		$poster	= get_post_meta($post_id, 'cp_video_poster', true);
		if(empty($poster) && has_post_thumbnail($post_id) && $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'custom-large'))
			$poster = $thumb[0];
			
		$player = get_option('cp_default_player');
		$player = !empty($player['video_file']) ? $player['video_file'] : 'mediaelement';
		
		$args = array(
			'files' => $files,
			'poster' => $poster,
			'autoplay' => $autoplay
		);
		cp_player($player, $args);
	}
	elseif(!empty($tern_wp_youtube_video) && function_exists('tern_wp_youtube_video')) {
		// TODO: Add Custom Player Support 
		global $post;
		$post = get_post($post_id);
		$youtube_player = '';
		
		if(!empty($youtube_player)) {
			$v = get_post_meta($post->ID,'_tern_wp_youtube_video',true);
			$youtube_video_link = 'http://www.youtube.com/watch?v='.$v;
			
			$args = array(
				'files' => array($youtube_video_link),
				'poster' => $poster,
				'autoplay' => $autoplay
			);
			cp_player($youtube_player, $args);
		} else {
			$video = tern_wp_youtube_video(false);
		}
		
		$video = extend_video_html($video, $autoplay, $item_size );
		echo $video;
	}
}

function cp_player($player = '', $args = array()) {
	
	$autoplay=false;
	
	if(empty($player) || empty($args['files']))
		return;
	
	$defaults = array(
		'files' => array(),
		'poster' => '',
		'autoplay' => false
	);
	$args = wp_parse_args($args, $defaults);
	
	extract($args);
	
	/* WordPress Native Player: MediaElement */
	if($player == 'mediaelement') {
		$atts = array();
		foreach($files as $file) {
			$file = trim($file);
			
			if(strpos($file, 'youtube.com') !== false)
				$atts['youtube'] = $file;
			else {
				$type = wp_check_filetype($file, wp_get_mime_types());
				$atts[$type['ext']] = $file;
			}
		}
			
		echo wp_video_shortcode($atts);
	} 
		
	/* JWPlayer */
	elseif($player == 'jwplayer') {
		$options = array(
			'file' => trim($files[0]), // JWPlayer WordPress Plugin doesn't support multiple codecs
			'image' => $poster
		);
		$atts = arr2atts($options);
		$jwplayer_shortcode = '[jwplayer'.$atts.']';
		echo apply_filters('cp_video_filter', $jwplayer_shortcode);
	}
		
	/* FlowPlayer */
	elseif($player == 'flowplayer') {
		$atts = array(
			'splash' => $poster
		);
		foreach($files as $key => $file) {
			// $type = wp_check_filetype(trim($file), wp_get_mime_types());
			$att = ($key == 0) ? 'src' : 'src'.$key;
			$atts[$att] = $file;
		}
		echo flowplayer_content_handle($atts, '', '');
		wp_ajax_flowplayer_script();
	}
		
	/* jPlayer */
	elseif($player == 'jplayer') {
		echo cp_jplayer(array(
			'src' => $files,
			'poster' => $poster,
			'type' => 'video',
			'autoplay' => $autoplay
		));
	}
}

/**
 * Determines if the specified post is a video post.
 *
 * @package deTube
 * @since 1.1
 *
 * @param int|object $post The post to check. If not supplied, defaults to the current post if used in the loop.
 * @return bool|int False if not a video, ID of video post otherwise.
 */
function is_video($post = null){
	$post = get_post($post);
	if(!$post)
		return false;
	
	// Back compat, if the post has any video field, it also is a video. 
	$video_file = get_post_meta($post->ID, 'post-option-inside-thumbnail-video-file', true);
	$video_url = get_post_meta($post->ID, 'post-option-inside-thumbnail-video-url', true);
	$video_code = get_post_meta($post->ID, 'post-option-inside-thumbnail-video-code', true);
	// Post meta by Automatic Youtube Video Post plugin
	$tern_wp_youtube_video = get_post_meta($post->ID, '_tern_wp_youtube_video', true);
	if(!empty($video_code) || !empty($video_url) || !empty($video_file) || (!empty($tern_wp_youtube_video) && function_exists('tern_wp_youtube_video')))
		return $post->ID;
	
	return has_post_format('video', $post);
}

/**
 * Add extra parameters to video url to control video
 * Fix iframe z-index bug and Make video Autoplay
 *
 * @since 1.0
 */
function extend_video_html($html, $item_size, $autoplay = false, $wmode = 'opaque' ) {

	$replace = false;
	
	preg_match('/src=[\"|\']([^ ]*)[\"|\']/', $html, $matches);
	
	if(isset($matches[1])) {
		$url = $matches[1];
		
		// Vimeo
		if(strpos($url, 'vimeo.com')) {
			// Remove the title, byline, portrait on Vimeo video
			$url = add_query_arg(array('title'=>0,'byline'=>0,'portrait'=>0), $url);
			
			// Set autoplay
			if($autoplay)
				$url = add_query_arg('autoplay', '0', $url);
				
			$replace = true;
		}
			
		// Youtube
		if(strpos($url, 'youtube.com')) {
			// Set autoplay
			if($autoplay)
				$url = add_query_arg('autoplay', '0', $url);
		
			// Add wmode
			if($wmode)
				$url = add_query_arg('wmode', $wmode, $url);
			
			// Disabled suggested videos on YouTube video when the video finishes
			$url = add_query_arg(array('rel'=>0), $url);
			// Remove top info bar
			$url = add_query_arg(array('showinfo'=>0), $url);
			// Remove YouTube Logo
			$url = add_query_arg(array('modestbranding'=>0), $url);
			// Remove YouTube video annotations
			// $url = add_query_arg('iv_load_policy', 3, $url);
			
			$replace = true;
		}
		global  $item_size;
		
		if($replace) {
			$url = esc_attr($url);	
			$html = preg_replace('/src=[\"|\']([^ ]*)[\"|\']/', 'width="100%" height="100%" src="'.$url.'"', $html);
		}
	}
	
	return $html;
}

/**
 * Ajax inline video action for list large view
 *
 * @since 1.0
 */
add_action( 'wp_ajax_nopriv_ajax-video', 'cp_ajax_video' );
add_action( 'wp_ajax_ajax-video', 'cp_ajax_video');
function cp_ajax_video() {
	if(!isset($_REQUEST['action']) || !isset($_REQUEST['id']) || $_REQUEST['action'] != 'ajax-video')
		return false;

	$post_id = $_REQUEST['id'];

	cp_video($post_id, true);
	
	die();
}

/*
 * Reinit MediaElement for Ajax calls
 * 
 * @since deTube 1.4
 */
add_filter( 'wp_video_shortcode', 'wp_ajax_mediaelement_script', 11, 5);
function wp_ajax_mediaelement_script($html, $atts, $video, $post_id, $library) {
	if(!defined('DOING_AJAX') || !DOING_AJAX || $library !== 'mediaelement')
		return $html;

	$html .= "
	<script type='text/javascript'>
	(function ($) {
		// add mime-type aliases to MediaElement plugin support
		mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');
		mejs.plugins.silverlight[0].types.push('audio/x-ms-wma');

		$(function () {
			var settings = {};

			if ( typeof _wpmejsSettings !== 'undefined' )
				settings.pluginPath = _wpmejsSettings.pluginPath;

			$('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer( settings );
		});
	}(jQuery));
	</script>
	";
	
	return $html;
}

/*
 * Output Flowplayer script for use it later in ajax
 * 
 * @since deTube 1.4
 */
function wp_ajax_flowplayer_script(){
	if(!defined('DOING_AJAX') || !DOING_AJAX)
		return;

	echo '
	<script type="text/javascript">
		(function ($) {
			$(function(){typeof $.fn.flowplayer=="function"&&$("video").parent(".flowplayer").flowplayer()});
		}(jQuery));
	</script>
	';
	
	flowplayer_display_scripts();
}

/*
 * Add a classname to <div> element which wrapped
 * wp video shortcode, so we can use it later 
 * 
 * @since deTube 1.4
 */
add_filter( 'wp_video_shortcode', 'wp_video_shortcode_wrapper', 10, 5);
function wp_video_shortcode_wrapper($html, $atts, $video, $post_id, $library) {
	$class = 'wp-video-shortcode-wrapper';
	if($library === 'mediaelement')
		$class .= ' meplayer';
	$html = str_replace('<div style="', '<div class="'.$class.'" style="', $html);
	
	return $html;
}

/*== Add Youtube support to [video] shortcode */

/**
 * Add youtbue format to the list of WP-supported video formats
 *
 * @since deTube 1.4
 */
add_filter( 'wp_video_extensions', 'add_youtube_extension' );
function add_youtube_extension($exts) {
	$exts[] = 'youtube';
	
	return $exts;
}

/**
 * Add youtbue mime type
 *
 * @since deTube 1.4
 */
add_filter( 'mime_types', 'add_youtube_mime_type');
function add_youtube_mime_type($types){
	$types['youtube'] = 'video/youtube';
	
	return $types;
}

/**
 * Add youtube ext
 *
 * @since deTube 1.4
 */
add_filter( "shortcode_atts_video", 'add_youtube_ext', 10, 3 );
function add_youtube_ext($out, $pairs, $atts) {
	if(strpos($out['src'], 'youtube.com') !== false)
		$out['src'] .= '.youtube';
	if(!empty($out['youtube']))
		$out['youtube'] .= '.youtube';

	return $out;
}

/**
 * Remove youtube ext
 *
 * @since deTube 1.4
 */
add_filter( 'wp_video_shortcode', 'remove_youtube_ext', 10, 5);
function remove_youtube_ext($html, $atts, $video, $post_id, $library) {
	$html = str_replace('.youtube"', '"', $html);
	$html = str_replace('.youtube</a>', '</a>', $html);
	
	return $html;
}

// add_filter( 'wp_mediaelement_fallback', 'youtube_fallback', 10, 2);
function youtube_fallback($html, $url) {
	if(strpos($url, 'youtube.com') !== false)
		$html = '<iframe>';
		
	return $html; 
}

/**
 * Get Video Thumbnail URL
 *
 * @param string $size Optional. Image size. Defaults to 'custom-medium';.
 */ 
function cp_thumb_url($size = 'custom-medium', $default = '', $post_id = null, $echo = false){
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
	if(!$size)
		$size == 'custom-medium';
	
	/* Check if this video has a feature image */
	if(has_post_thumbnail() && $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size))
		$thumb_url = $thumb[0];

	/* If no feature image, try to get thumbnail by "Video Thumbnails" plugin */
	if(empty($thumb_url) && function_exists('get_video_thumbnail')) {
		$video_thumbnail = get_video_thumbnail($post_id);
		if(!is_wp_error($video_thumbnail))
			$thumb_url = $video_thumbnail;
	}

	/* If this is a video by jplayer, try to get thumbnail from video_posts */
	if(empty($thumb_url) && $poster = get_post_meta($post_id, 'cp_video_poster', true))
		$thumb_url = $poster;
	
	/* If still no image or is wp error, define default image */
	if(empty($thumb_url) || is_wp_error($thumb_url)) {
		if($default === false || $default === 0)
			return false;
		
		$thumb_url = !empty($default) ? $default : get_template_directory_uri().'/images/nothumb.png';
	}
		
	if($echo)
		echo $thumb_url;
	else
		return $thumb_url;
} 

function cp_thumb_html($size = 'custom-medium', $default = '', $post_id = null, $echo = true) {
	global $post;
	
	if(!$post_id)
		$post_id = $post->ID;
	if(!$size)
		$size == 'custom-medium';
	
	// Get thumb url
	$thumb_url = cp_thumb_url($size, $default, $post_id, false);

	$html = '
	<div class="thumb">
		<a class="clip-link" data-id="'.$post->ID.'" title="'.esc_attr(get_the_title($post_id)).'" href="'.get_permalink($post_id).'">
			<span class="clip">
				<img src="'.$thumb_url.'" alt="'.esc_attr(get_the_title($post_id)).'" /><span class="vertical-align"></span>
			</span>
							
			<span class="overlay"></span>
		</a>
	</div>';
	
	if($echo)
		echo $html;
	else
		return $html;
} 


function print_latest_videos ( $item_xml ) {
$latest_video_header = find_xml_value($item_xml, 'latest-video-header');		
 ?>
<!--LATEST VIDEOS SECTION START-->

  <section class="video-section">
      <header>
        <?php if (!empty($latest_video_header)) { echo '<div class="video-heading">'; echo '<h2>'.$latest_video_header.'</h2>'; echo '</div>'; } ?>
      </header>
  <div class="latest-vidios"> 
    
    <!--VIDEO FIGURE START-->
    
    <?php 
	    global $post, $wp_query, $paged, $sidebar;
		
		$latest_video_fetch = find_xml_value($item_xml, 'latest-video-fetch');
		$latest_video_fetch_cat = find_xml_value($item_xml, 'latest-video-cat');
		$latest_video_fetch_cat = ( $latest_video_fetch_cat == 'All' )? '': $latest_video_fetch_cat;
		
		wp_reset_query();
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		$args = array(
		'posts_per_page'=>$latest_video_fetch, 
						'paged'=>$paged,
						'category_name'=>$latest_video_fetch_cat,
						'post_type'=>'post',
		'tax_query' => array(
				array( 'taxonomy' => 'post_format',
					  'field' => 'slug',
					  'terms' => array('post-format-video'),
					  )
				)
		);
					
		$latest_video = new WP_Query();  // Main blog query
		$latest_video->query( $args );
				
	    while ( $latest_video->have_posts() ) { $latest_video->the_post(); ?>
	  
        <figure class="video-container">
          <?php                                 
                                                $thumbnail_id = get_post_thumbnail_id();
                                                $thumbnail = wp_get_attachment_image_src( $thumbnail_id , '400x255' );
                                                $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
                                                $image_type ="Lightbox to Picture";
                                                echo '<a href="' . get_permalink() . '">';
                                                    echo '<img  src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>'; 
                                                echo '</a>';
          ?>
          <div class="play"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play.png" alt=""></a></div>
          <figcaption>
            <?php    echo '<a href="'.get_permalink().'">';
                     $text =  get_the_title();
                     $newtext = wordwrap('<h2>'.$text, 20, "</h2><div class='clearfix'></div><h3>", "");
                     echo ''. $newtext .'</h3>'; 
					 echo '</a>';
                 ?>
          </figcaption>
        </figure>
    <?php } ?>
    <!--VIDEO FIGURE END--> 
    
  </div>
</section>

<!--LATEST VIDEOS SECTION START-->
<?php } 
function print_category_videos ( $item_xml ){
	    $category_video_header = find_xml_value($item_xml, 'category-video-header-title');  ?>
		
	 
<!--FEATURED VIDEOS SECTION START-->

<div class="span12">
<article>
  <header class="header-style">
    <?php if (!empty($category_video_header)) {  echo '<h2 class="h-style">'.$category_video_header.'</h2>';  } ?>
  </header>
  
  <div class="widget-bg">
    <ul class="mycarousel jcarousel-skin-tango videos">
      
      <!--LIST ITEMS START-->
      <?php 
				global $post, $wp_query, $paged, $sidebar;
				
				if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
				}
				
				$category_video_fetch = find_xml_value($item_xml, 'latest-video-fetch');
				$category_video_cat = find_xml_value($item_xml, 'category-video-cat');
				$category_video_cat = ( $category_video_cat == 'All' )? '': $category_video_cat;
				$num_excerpt = '70';
				wp_reset_query();
				
				$args = array(
				'posts_per_page'=>$category_video_fetch, 
							  'paged'=>$paged,
							  'category_name'=>$category_video_cat,
							  'post_type'=>'post',
				'tax_query' => array(
						array( 'taxonomy' => 'post_format',
							   'field' => 'slug',
							   'terms' => array('post-format-video'),
							  )
						)
				);
					
				$category_video = new WP_Query();  // Main blog query
			    $category_video->query( $args );
				
				while ( $category_video->have_posts() ) { $category_video->the_post(); ?>
                  <li>
                    <figure>
                      <div class="thumb"> <a href="<?php get_permalink(); ?>">
                        <?php 
                                                        $thumbnail_id = get_post_thumbnail_id();
                                                        $thumbnail = wp_get_attachment_image_src( $thumbnail_id , '234x183' );
                                                        $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
                                                        $image_type ="Lightbox to Picture";
                                                        echo '<a href="' . get_permalink() . '">';
                                                            echo '<img  src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>'; 
                                                        echo '</a>';
                                ?>
                        </a>
                        <div class="play"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play.png" alt=""></a></div>
                      </div>
                      <figcaption>
                        <h5><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></h5>
                        <p><?php echo mb_substr( get_the_excerpt(), 0, $num_excerpt ) ; ?>...</p>
                        <ul class="views">
                          <li><?php echo get_the_date(); ?></li>
                          <li><i class="fa fa-comments"></i>
                            <?php comments_popup_link( __('0','cp_front_end'), __('1','cp_front_end'), __('%','cp_front_end'), '',__('Comments are off','cp_front_end') );?>
                          </li>
                          <li><i class="fa fa-eye"></i>
                            <?php if(function_exists('the_views')) { the_views(); } ?>
                          </li>
                        </ul>
                      </figcaption>
                    </figure>
                  </li>
      
      <!--LIST ITEMS END-->
      <?php } ?>
    </ul>
  </div>
</article>
<article>
  <div class="widget-bg">
    <div class="small-thumbs category-post">
      <ul>
        <!--LIST ITEMS START-->
        <?php 
				global $post, $wp_query, $paged, $sidebar;
				
				$category_video_list_fetch = find_xml_value($item_xml, 'category-video-cat-list-fetch');
				$category_video_cat_1 = find_xml_value($item_xml, 'category-video-cat-1');
				$category_video_cat_1 = ( $category_video_cat_1 == 'All' )? '': $category_video_cat_1;
				
				wp_reset_query();
				
				if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
				}
				
				$category_video_cat_1 = ( $category_video_cat_1 == 'All' )? '': $category_video_cat_1;
				
				$args = array(
				'posts_per_page'=>$category_video_list_fetch, 
								'paged'=>$paged,
								'category_name'=>$category_video_cat_1,
								'post_type'=>'post',
				'tax_query' => array(
						array( 'taxonomy' => 'post_format',
							  'field' => 'slug',
							  'terms' => array('post-format-video'),
							  )
						)
				);
					
				$category_video_cat_1 = new WP_Query();  // Main blog query
			    $category_video_cat_1->query( $args );
				
				 while ( $category_video_cat_1->have_posts() ) { $category_video_cat_1->the_post();;		?>
                <li>
                  <figure>
                    <div class="thumb"><?php $item_size = '100x66';
                       echo '<a href="'.get_permalink().'">'; 
					   		  $post_id = get_the_ID();
							  print_image_thumbnail( $post_id, $item_size ); echo '</a>'; ?>
                      <div class="play"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play2.png" alt=""></a></div>
                    </div>
                    <figcaption>
                      <p><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></p>
                      <p class="color"><?php echo get_the_date(); ?></p>
                    </figcaption>
                  </figure>
                </li>
        <?php } ?>
        <!--LIST ITEMS END-->
        
      </ul>
      <ul>
        <!--LIST ITEMS START-->
        <?php 
		
				global $post, $wp_query, $paged, $sidebar;
				
				$category_video_list_fetch = find_xml_value($item_xml, 'category-video-cat-list-fetch');
				$category_video_cat_2 = find_xml_value($item_xml, 'category-video-cat-2');
				$category_video_cat_2 = ( $category_video_cat_2 == 'All' )? '': $category_video_cat_2;
				wp_reset_query();
				
				if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
				}
				
			    $args = array(
				'posts_per_page'=>$category_video_list_fetch, 
							   'paged'=>$paged,
							   'category_name'=>$category_video_cat_2,
							   'post_type'=>'post',
				'tax_query' => array(
						array( 'taxonomy' => 'post_format',
							   'field' => 'slug',
							   'terms' => array('post-format-video'),
							  )
						)
				);
					
		    	$category_video_cat_2 = new WP_Query();  
				$category_video_cat_2->query( $args );
				 while ( $category_video_cat_2->have_posts() ) { $category_video_cat_2->the_post();	?>
                
				<li>
				  <figure>
					<div class="thumb"><?php $item_size = '100x66';
					  echo '<a href="'.get_permalink().'">'; 
					  		$post_id = get_the_ID();
							print_image_thumbnail( $post_id, $item_size ); echo '</a>'; ?>
					  <div class="play"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play2.png" alt=""></a></div>
					</div>
					<figcaption>
					  <p><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></p>
					  <p class="color"><?php echo get_the_date(); ?></p>
					</figcaption>
				  </figure>
				</li>
            
        <?php } ?>
        <!--LIST ITEMS END-->
        
      </ul>
      <ul>
        <!--LIST ITEMS START-->
        <?php 
				global $post, $wp_query, $paged, $sidebar;
				
				$category_video_list_fetch = find_xml_value($item_xml, 'category-video-cat-list-fetch');
				$category_video_cat_3 = find_xml_value($item_xml, 'category-video-cat-3');
				$category_video_cat_3 = ( $category_video_cat_3 == 'All' )? '': $category_video_cat_3;
				
				wp_reset_query();
				
				if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
				}
				
				$args = array(
				'posts_per_page'=>$category_video_list_fetch, 
								'paged'=>$paged,
								'category_name'=>$category_video_cat_3,
								'post_type'=>'post',
				'tax_query' => array(
						array( 'taxonomy' => 'post_format',
							  'field' => 'slug',
							  'terms' => array('post-format-video'),
							  )
						)
				 );
				
				$category_video = new WP_Query(); 
				$category_video->query( $args );
				
			    while ( $category_video->have_posts() ) { $category_video->the_post(); ?>
                <li>
                  <figure>
                    <div class="thumb"> 
					 <?php $item_size = '100x66';
                            echo '<a href="'.get_permalink().'">';
                               		$post_id = get_the_ID();
									print_image_thumbnail( $post_id, $item_size );
                            echo '</a>'; ?>
                      <div class="play"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play2.png" alt=""></a></div>
                    </div>
                    <figcaption>
                      <p><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></p>
                      <p class="color"><?php echo get_the_date(); ?></p>
                    </figcaption>
                  </figure>
                </li>
        		<?php } ?>
        <!--LIST ITEMS END-->
        
      </ul>
    </div>
  </div>
</article>

<!--FEATURED VIDEOS SECTION END-->
<?php }
function print_featured_videos( $item_xml ){ 
		$featured_video_header = find_xml_value($item_xml, 'featured-video-header');
		$featured_videos_style = find_xml_value($item_xml, 'Featured-Videos-style');
		$featured_video_fetch = find_xml_value($item_xml, 'featured-video-fetch');
		$featured_video_fetch_cat = find_xml_value($item_xml, 'featured-video-cat');
		$featured_video_fetch_cat = ( $featured_video_fetch_cat == 'All' )? '': $featured_video_fetch_cat;
		
		wp_reset_query();
				
				if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
				}
				
				$args = array(
				'posts_per_page'=>$featured_video_fetch, 
								'paged'=>$paged,
								'category_name'=>$featured_video_fetch_cat,
								'post_type'=>'post',
				'tax_query' => array(
						array( 'taxonomy' => 'post_format',
							  'field' => 'slug',
							  'terms' => array('post-format-video'),
							  
							  )
						)
				 );
				
				$featured_video = new WP_Query(); 
				$featured_video = new WP_Query ( $args );
			
				if ($featured_videos_style == "Slider" ) {	?>
				<div class="blog-post">
				  <header class="header-style">
					<?php if (!empty($featured_video_header)) {  echo '<h2 class="h-style">'.$featured_video_header.'</h2>';  } ?>
				  </header>
				  <div class="widget-bg">
					<ul class="mycarousel jcarousel-skin-tango">
					  
					  <?php  while ( $featured_video->have_posts() ) { $featured_video->the_post(); ?>
					  
					  <!--LIST ITEMS START-->
					  
					  <li>
						<div class="blog">
						  <div class="thumb">
							<?php $item_size = '746x443';
												  $post_id = get_the_ID();
												   $item_size_arr= explode('x',$item_size); $item_height=$item_size_arr[1]; $item_width=$item_size_arr[0];	
													 echo '<div id="video">';
														echo '<div class="screen fluid-width-video-wrapper" style="height:'.$item_height.'px; width:'.$item_width.'px;">';
														 cp_video($post_id, $item_size);
														echo '</div><!-- end .screen -->';
													echo '</div><!-- end #video-->'; 
										 ?>
						  </div>
						  <div class="text">
							<h2><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></h2>
							<p> <?php echo  mb_substr( get_the_excerpt(), 0, '300' ) ;	?>... </p>
							<?php print_post_meta(); ?>
						  </div>
						</div>
					  </li>
      
      <!--LIST ITEMS END-->
      
      <?php } ?>
      <!--LIST ITEMS END-->
      
    </ul>
  </div>
</div>
<?php } else { ?>
<div class="widget popular-videos-widget">
  <header class="header-style">
	    <?php if (!empty($featured_video_header)) { echo '<h2 class="h-style">'.$featured_video_header.'</h2>'; } ?>
  </header>
  <div class="widget-bg">
    <div class="papuler-video">
      <?php 
			  	wp_reset_query();
				
				if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
				}
				$featured_video_fetch_cat = ( $featured_video_fetch_cat == 'All' )? '': $featured_video_fetch_cat;
				$args = array(
				'posts_per_page'=>1, 
								'paged'=>$paged,
								'category_name'=>$featured_video_fetch_cat,
								'post_type'=>'post',
				'tax_query' => array(
						array( 'taxonomy' => 'post_format',
							  'field' => 'slug',
							  'terms' => array('post-format-video'),
							  )
						)
				 );
				
				$featured_video = new WP_Query(); 
				$featured_video->query( $args );
				
			    while ( $featured_video->have_posts() ) { $featured_video->the_post();
				  ?>
                  <figure>
                      <div class="thumb">
                             <?php  $item_size = '371x163';
                                    echo '<a href="'.get_permalink().'">';
                                        $post_id = get_the_ID();
										print_image_thumbnail( $post_id, $item_size );
                                    echo '</a>'; ?>
                      </div>
                    <figcaption>
                      <h3><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></h3>
                      <ul class="views">
                        <li><?php echo get_the_date(); ?></li>
                        <li><i class="fa fa-comments"></i>
                          <?php comments_popup_link( __('0','cp_front_end'), __('1','cp_front_end'), __('%','cp_front_end'), '',__('Comments are off','cp_front_end') );?>
                        </li>
                        <li><i class="fa fa-eye"></i>
                          <?php if(function_exists('the_views')) { the_views(); } ?>
                        </li>
                      </ul>
                    </figcaption>
                  </figure>
              </div>
         <?php } ?>
         <div class="small-thumbs">
         <ul>
			<?php
                    wp_reset_query();
                    
                    if(empty($paged)){
                        $paged = (get_query_var('page')) ? get_query_var('page') : 1; 
                    }
                    $featured_video_fetch_cat = ( $featured_video_fetch_cat == 'All' )? '': $featured_video_fetch_cat;
                    $args = array(
                    'posts_per_page'=>$featured_video_fetch, 
                                    'paged'=>$paged,
                                    'category_name'=>$featured_video_fetch_cat,
                                    'post_type'=>'post',
									'offset'=> 1 ,
                    'tax_query' => array(
                            array( 'taxonomy' => 'post_format',
                                  'field' => 'slug',
                                  'terms' => array('post-format-video'),
                                  )
                            )
                     );
                    
                    $featured_video = new WP_Query(); 
                    $featured_video->query( $args );
                    
                    while ( $featured_video->have_posts() ) { $featured_video->the_post();	?>
                   <!--LIST ITEMS START-->
                    <li>
                     <figure>
                       <div class="thumb">
					    <?php 
                            $item_size = '100x66';
                            echo '<a href="'.get_permalink().'">';
								  $post_id = get_the_ID();
								  print_image_thumbnail( $post_id, $item_size );  echo '</a>'; ?>
					       <div class="play"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play2.png" alt=""></a></div>
                        </div>
                        <figcaption>
                          <h5><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></h5>
                          <p><?php echo  mb_substr( get_the_excerpt(), 0, '40' ) ;	?>...</p>
                          <p class="color"><?php echo get_the_date(); ?></p>
                        </figcaption>
                      </figure>
                    </li>
                   <!--LIST ITEMS END-->
        <?php } ?>
      </ul>
     </div>
    </div>
   </div>
<?php } ?>
<?php }
function print_top_videos ( $item_xml ){
	$top_video_header_title = find_xml_value($item_xml, 'top-video-header-title');  
    $top_video_name = find_xml_value($item_xml, 'top-video-name'); ?>
<!--VIDEOS SECTION START-->

<section class="video-section top-pic">
               <header>
                 <div class="video-heading">
                    <?php if (!empty($top_video_header_title)) {  echo '<h2>'.$top_video_header_title.'</h2>';  } ?>
                 </div>
               </header>
  				<?php wp_reset_query();
				
				if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
				}
				$args = array(
				'name'=>$top_video_name,
				'post_type'=>'post',
				'posts_per_page' => 1, 
				'paged'=>$paged,
				'post_type'=>'post',
				'tax_query' => array(
						array( 'taxonomy' => 'post_format',
							  'field' => 'slug',
							  'terms' => array('post-format-video'),
							  )
						)
				 );
				
				$top_video = new WP_Query(); 
				$top_video->query( $args );
				
			    while ( $top_video->have_posts() ) { $top_video->the_post(); ?>
                                        
                <figure class="video-container">
                                    <?php 
											$item_size = '1170x470';
											echo '<a href="'.get_permalink().'">';
												  $post_id = get_the_ID();
												  print_image_thumbnail( $post_id, $item_size );
											echo '</a>';
										?>
					<ul class="pick-social">
                          <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                          <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="#" class="play"><i class="fa fa-play-circle"></i></a></li>
					</ul>
					<figcaption>
						 <?php 
                         $text =  get_the_title();
                                     $newtext = wordwrap('<h2>'.$text, 20, "</h2><div class='clearfix'></div><h3>", "");
                                     echo ''. $newtext .'</h3>'; 
                         ?>
					</figcaption>
                </figure>
  <?php } ?>
</section>

<?php } 
function print_search_widget ($item_xml){
	 	 $search_widget_header_title = find_xml_value($item_xml, 'search-widget-header-title');  ?>

        <!--SEARCH WIDGET START-->
        <div class="widget search-widget">
          <header class="header-style">
            <?php if (!empty($search_widget_header_title)) { echo '<h2 class="h-style">'.$search_widget_header_title.'</h2>';  } ?>
          </header>
          <div class="widget-bg">
            <form method="get" action="<?php echo home_url(); ?>/" class="form-search">
                <input class="input-medium search-query" type="text" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" />
                <button type="submit" id="searchsubmit" value="Submit" class="hover-style">Search</button>
            </form>        
          </div>
        </div>
       <!--SEARCH WIDGET END-->

<?php }
function print_social_media_widget ( $item_xml ){ 
   	 $social_media_header_title = find_xml_value($item_xml, 'social-media-header-title'); ?>

        <!--SOCIAL WIDGET START-->
        <div class="widget social-widget">
          <header class="header-style">
              <?php if (!empty($social_media_header_title)) {  echo '<h2 class="h-style">'.$social_media_header_title.'</h2>'; } ?>
          </header>
          <div class="widget-bg">
                <ul>
                    <?php foreach(array("facebook", "youtube", "twitter", "rss", "google-plus", "pinterest") as $network) :
                                $networklink = find_xml_value($item_xml, 'social-media-'.$network );  ?>
								<?php if (!empty($networklink)) : ?>
                                <li>
                                    <a rel="external"  title="" data-toggle="tooltip" href="<?php echo $networklink; ?>" data-original-title="<?php echo $network;  ?>">
                                        <?php echo '<img src="' .CP_THEME_PATH_URL.'/images/'. strtolower($network).'.png "/>'; ?>
                                    </a>
                                </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
          </div>
        </div>
        <!--SOCIAL WIDGET END-->

<?php } function print_footer_slider ( $item_xml ){
	      $footer_slider_item_fetch = get_option(THEME_NAME_S.'_footer_slider_item_fetch','6');
		  $footer_slider_heading = get_option(THEME_NAME_S.'_footer_slider_heading','FEATURED VIDEO GALLERY');
		  $footer_video_fetch_cat = 'All';
	 ?>

<article class="v-gallery">
      <?php if (!empty($footer_slider_heading)) {  echo '<h5>'.$footer_slider_heading.'</h5>'; } ?>
      <ul class="mycarousel jcarousel-skin-tango row">
        
        <?php  	wp_reset_query();
				
				if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
				}
				$footer_video_fetch_cat = ( $footer_video_fetch_cat == 'All' )? '': $footer_video_fetch_cat;
				$args = array(
				            	'posts_per_page'=>$footer_slider_item_fetch, 
								'paged'=>$paged,
								'category_name'=>$footer_video_fetch_cat,
								'post_type'=>'post',
				'tax_query' => array(
						array( 'taxonomy' => 'post_format',
							  'field' => 'slug',
							  'terms' => array('post-format-video'),
							  )
						)
				 );
				
				$footer_video = new WP_Query(); 
				$footer_video->query( $args );
				
			    while ( $footer_video->have_posts() ) { $footer_video->the_post();
				
				?>
       			 <!--LIST ITEMS START-->
                <li class="span3">
                  <figure>
                       <div class="thumb">
                              <?php 
                                    $item_size = '85x85';
                                    echo '<a href="'.get_permalink().'">'; $post_id = get_the_ID();
									print_image_thumbnail( $post_id, $item_size );  echo '</a>'; ?>
                        </div>
                       <figcaption>
                         <p class="color"><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></p>
                      <p><?php echo get_the_date(); ?></p>
                    </figcaption>
                  </figure>
                 </li>
       			 <!--LIST ITEMS END--> 
        <?php } ?>
        
      </ul>
    </article>
<?php }	
function print_videos_tab_widget ( $item_xml ){ 
  $tab_item_numb = find_xml_value($item_xml, 'vidoes-tab-limit');  
  $instance = array();
  $instance['title'] = '';
  $instance['show_num'] = $tab_item_numb;
  the_widget( 'tab_widget', $instance );
?> 
<!--SOCIAL WIDGET END-->
<?php }
							
function print_video_slider ( $item_xml, $video_slider_category, $video_slider_fetch, $video_slider_type ){  ?>
<section class="banner <?php if ($video_slider_type == "Half Slider") { echo "img-less"; }?>">
  <div class="container">
    <div id="slider" class="flexslider">
      <ul class="slides <?php if ($video_slider_type == "Half Slider") { echo "no-img"; }?>">
      <?php 
	            wp_reset_query();
	            if(empty($paged)){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
				}
				 $video_slider_category = ( $video_slider_category == 'All' )? '': $video_slider_category;
                 $args = array(
				            	'posts_per_page'=>$video_slider_fetch, 
								'paged'=>$paged,
								'category_name'=>$video_slider_category,
								'post_type'=>'post',
				'tax_query' => array(
						array( 'taxonomy' => 'post_format',
							  'field' => 'slug',
							  'terms' => array('post-format-video'),
							  )
						)
				 );
				 	
				$video_slide = new WP_Query();  // Main blog query
		    	$video_slide->query( $args );
				
				 while ( $video_slide->have_posts() ) { $video_slide->the_post();		?>
                  <li> 
					   <?php $item_size = '1170x470';
                             $post_id = get_the_ID();
							 $item_size_arr= explode('x',$item_size); $item_height=$item_size_arr[1]; $item_width=$item_size_arr[0];	
							 echo '<div id="video">';
								echo '<div class="screen fluid-width-video-wrapper" style="height:'.$item_height.'px; width:'.$item_width.'px;">';
								 cp_video($post_id, $item_size);
								echo '</div><!-- end .screen -->';
							echo '</div><!-- end #video-->'; 
		
							/* print_image_thumbnail( $post_id, $item_size );*/ ?>
                       <div class="caption resize">
                        <?php  $text =  get_the_title();
                                     $newtext = wordwrap('<h2>'.$text, 20, "</h2><div class='clearfix'></div><h4>", "");
                                     echo ''. $newtext .'</h4>'; ?>	 
                      </div>
       		      </li>
    		 <?php } ?>
   			   </ul>
    		</div>
                <div id="carousel" class="flexslider">
                  <ul class="slides">
                   <?php wp_reset_query();
				            $video_slider_category = ( $video_slider_category == 'All' )? '': $video_slider_category;
                            $args = array(
                            'posts_per_page'=>$video_slider_fetch, 
                                            'paged'=>$paged,
                                            'category_name'=>$video_slider_category,
                                            'post_type'=>'post',
                                'tax_query' => array(
                                     array( 'taxonomy' => 'post_format',
                                            'field' => 'slug',
                                            'terms' => array('post-format-video'),
                                          )
                                    )
                            );
                            $video_slider = new WP_Query();  // Main blog query
                            $video_slider->query( $args );
                             while ( $video_slider->have_posts() ) { $video_slider->the_post();	?>
                             <li> 
                            <?php $item_size = '182x89';
							      $post_id = get_the_ID();
								  print_image_thumbnail( $post_id, $item_size ); ?>
                                <div class="caption">  <a href="<?php echo get_permalink(); ?> "><?php echo  mb_substr( get_the_title(), 0, '10' ) ;	?> </a> </div>
                             </li>
                    <?php } ?>
                  </ul>
                </div>
             </div>
           </section>
<?php }												
	
// Print products
	function print_videos($item_xml){
		
		if( function_exists('woocommerce_get_template_part')) {
		wp_reset_query();
		global $paged;
		global $sidebar;
		global $port_div_size_num_class;
		global $class_to_num;
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// get the item class and size from array
		$port_size = find_xml_value($item_xml, 'item-size');
		
		$item_class = $port_div_size_num_class[$port_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size2'];
		}else{
			$item_size = $port_div_size_num_class[$port_size]['size3'];
		}
		
		$port_div_size_min_hight = array(
			"1/4" => array("class"=>"four columns", "size"=>"161", "size2"=>"90", "size3"=>"130"), 
			"1/3" => array("class"=>"one-third column", "size"=>"185", "size2"=>"120", "size3"=>"130"), 
			"1/2" => array("class"=>"eight columns", "size"=>"290", "size2"=>"195", "size3"=>"130"), 
			"1/1" => array("class"=>"sixteen columns", "size"=>"225", "size2"=>"x182", "size3"=>"292"));
		
		if( $sidebar == "no-sidebar" ){
			$min_size = $port_div_size_min_hight[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$min_size = $port_div_size_min_hight[$port_size]['size2'];
		}else{
			$min_size = $port_div_size_min_hight[$port_size]['size3'];
		}
		
		// get the portfolio meta value
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category_val = ( $category == 'All' )? '': $category;
		
		$filterable = find_xml_value($item_xml, 'filterable');
		$filter_class = '';
		// portfolio header
		if(!empty($header)){
			echo '<div class="product-header-wrapper"><h3 class="product-header-title title-color cp-title">' . $header . '</h3></div>';
		} 
		
		$porduct_item_style = find_xml_value($item_xml,'product-style');
	
		// category list for filter
		if( $filterable == "Yes" && $porduct_item_style == "STYLE 1") {
			$category_lists = get_category_list('category', $category_val);
			$is_first = 'active';
			echo'<div class="filter-nav">';
			$view_all_product = find_xml_value($item_xml, 'view-all-product');
			if($view_all_product != 'No'){
				$view_all_product_link = get_permalink( get_page_by_title( $view_all_product ) );
			echo '<a class="view-all" href="' . $view_all_product_link . '">' . __('View All','cp_front_end') . '</a>';
			}
			
			echo '<ul id="product-item-filter">';
			foreach($category_lists as $category_list){
				
				$category_term = get_term_by( 'name', $category_list , 'category');
				if( !empty( $category_term ) ){
					$category_slug = $category_term->slug;
				}else{
					$category_slug = 'all';
				}
				echo '<li><a href="#" class="' . $is_first . '" data-value="' . $category_slug . '">' . $category_list . '</a>  </li>';
				
				$is_first  = '';
			}
		    echo "</ul>";
			echo'</div>';
		    echo '<div class="clearfix"></div>';
		}
		
		// start fetching database
		global $post, $wp_query;
		
		if( !empty($category_val) ){
			$category_term = get_term_by( 'name', $category_val , 'category');
			$category_val = $category_term->slug;
		}
		
		$post_temp = query_posts(array('post_type'=>'product', 'paged'=>$paged, 
			'category'=>$category_val, 'posts_per_page'=>$num_fetch));

		// get the portfolio size
		$port_wrapper_size = $class_to_num[find_xml_value($item_xml, 'size')];
		$port_current_size = 0;
		
		
							echo '<section id="product-item-holder" class="product-item-holder">';
							
							    $porduct_item_style = find_xml_value($item_xml,'product-style');
												
								while( have_posts() ){
								the_post();				
														
								// get the category for filter
								$item_categories = get_the_terms( $post->ID, 'category' );
								$category_slug = " ";
								if( !empty($item_categories) ){
									foreach( $item_categories as $item_category ){
										$category_slug = $category_slug . $item_category->slug . ' ';
									}
												
								// start printing data
								 echo '<figure class="' . $item_class . $category_slug . ' product-item mt0">';  
										// start printing data
										$thumbnail_types = "Image";
										if( $thumbnail_types == "Image" ){
											$image_type = "Lightbox to Current Thumbnail";
											$image_type = empty($image_type)? "Link to Current Post": $image_type; 
											$thumbnail_id = get_post_thumbnail_id();
											$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size_new );
											$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
											$image_type ="Lightbox to Picture";
											if($image_type == "Lightbox to Picture" ){
												$hover_thumb = "hover-link";
												$permalink = get_permalink();	
												
											}		
										}
										$product_title= get_the_title();
										$title_length = get_option(THEME_NAME_S.'_products_page_title_length');					 
										$short_title = substr($product_title,0,$title_length);
										echo '<div class="product-thumbnail-context">';
										echo '<div class="product-item-container">';
										echo '<div class="product-thumbnail-image">';
												echo '<img  src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>'; 
												echo '<div class="product-item-context">';
												echo '<h2 class="product-thumbnail-title port-title-color cp-title"><a href="' . get_permalink() . '">' . $product_title. '</a></h2>';
												echo '<div class="product-price">';
												do_action( 'woocommerce_after_shop_loop_item_title' );
												echo '</div>';
												echo '</div>';
												echo '</div>'; //portfolio thumbnail image	
										
										echo '<div class="product-thumbnail-content">';	
												echo '<span class="product_cart">'. do_action( 'woocommerce_after_shop_loop_item' ).'</span>';
												echo '<span class="details-button"><a href="' . $permalink . '" ' . $pretty_photo . ' class="cp-button" title="' . get_the_title() . '">Item Details</a></span>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
									   woocommerce_show_product_loop_sale_flash();
										do_action( 'woocommerce_show_product_loop_sale_flash');
										do_action( 'woocommerce_before_shop_loop_item' );
										
								 echo '</figure>';
							  }
							}
		echo "</section>";
		
		echo '<div class="clearfix"></div>';
		if ($porduct_item_style == "STYLE 1") {
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination(); }
		}
		} else{ 
		       echo'<div class="message-box-wrapper red mr10">';
			   echo'<div class="message-box-title">Missing Woo Commerce Plugin</div>';
			   echo'<div class="message-box-content">Please install Woo Commerce Plugin</div>';
			   echo'</div>';
 	          } 
  	    }