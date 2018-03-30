<?php
/**
 * VideoTube Common Functions
 *
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;

if( !function_exists('mars_get_thumbnail_image') ){
	function mars_get_thumbnail_image( $post_id ) {
		global $videotube;
		$post_status = $videotube['submit_status'] ? $videotube['submit_status'] : 'pending';
		if( $post_status == 'publish' && get_post_type( $post_id ) == 'video' && function_exists( 'get_video_thumbnail' ) ){
			get_video_thumbnail($post_id);
		}
	}
	add_action('mars_save_post', 'mars_get_thumbnail_image', 9999, 1);
}
if( !function_exists('get_google_apikey') ){
	function get_google_apikey(){
		global $videotube;
		$google_apikey = isset( $videotube['google-api-key'] ) ? trim( $videotube['google-api-key'] ) : null;
		return $google_apikey;
	}
}
if( !function_exists('mars_get_user_role') ){
	function mars_get_user_role( $user_id ) {
		if( !$user_id ){
			return;
		}
		$user = new WP_User( $user_id );
		if( isset( $user->roles[0] ) ){
			return $user->roles[0];	
		}
		else{
			return null;
		}
	}
}
if( !function_exists('mars_get_post_data') ){
	function mars_get_post_data( $post_id ) {
		return get_post( $post_id );
	}
}
if( !function_exists('mars_socials_url') ){
	function mars_socials_url() {
		return array(
			'facebook'		=>	esc_html__( 'Facebook','mars'),
			'twitter'		=>	esc_html__('twitter','mars'),
			'google-plus'	=>	esc_html__('Google Plus','mars'),
			'instagram'		=>	esc_html__('Instagram','mars'),
			'linkedin'		=>	esc_html__('Linkedin','mars'),
			'tumblr'		=>	esc_html__('Tumblr','mars'),
			'youtube'		=>	esc_html__('Youtube','mars'),
			'vimeo-square'	=>	esc_html__('Vimeo','mars'),
			'snapchat'		=>	esc_html__('Snapchat','mars')				
		);
	}
}

if( !function_exists('post_orderby_options') ){
	function post_orderby_options( $post_type='post' ) {
		$orderby = array(
			'ID'	=>	__('Order by Post ID','mars'),
			'author'	=>	__('Order by author','mars'),
			'title'	=>	__('Order by title','mars'),
			'name'	=>	__('Order by Post name (Post slug)','mars'),
			'date'	=>	__('Order by date','mars'),
			'modified'	=>	__('Order by last modified date','mars'),
			'rand'	=>	__('Order by Random','mars'),
			'comment_count'	=>	__('Order by number of comments','mars')	
		);
		if( $post_type == 'video' ){
			$orderby['views']	=	__('Order by Views','mars');
			$orderby['likes']	=	__('Order by Likes','mars');
		}
		return $orderby;
	}
}

if( !function_exists('mars_theme_comment_style') ){
	function mars_theme_comment_style( $comment, $args, $depth ){
		error_reporting(0);
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		?>
		<li <?php comment_class();?> id="comment-<?php print $comment->comment_ID;?>">
			<div class="the-comment">
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mars' ); ?></p>
				<?php endif; ?>			
				<div class="avatar"><?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?></div>
				<div class="comment-content">
					<?php if( !$comment->user_id || $comment->user_id == 0 ):?>
						<span class="author"><a href="<?php print get_comment_author_url();?>"><?php print $comment->comment_author;?></a> <small><?php printf( __('%s ago','mars') , human_time_diff( get_comment_time('U'), current_time('timestamp') ) );?></small></span>
					<?php else:?>
						<span class="author"><a href="<?php print get_author_posts_url( $comment->user_id );?>"><?php print $comment->comment_author;?></a> <small><?php printf( __('%s ago','mars') , human_time_diff( get_comment_time('U'), current_time('timestamp') ) );?></small></span>
					<?php endif;?>
					
					<?php comment_text() ?>
					<?php 
						
						print get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<i class="fa fa-reply"></i> ' . esc_html__( 'Reply', 'mars' ) )), $comment->comment_ID);
					
					?>
					<?php if( current_user_can('add_users') ):?>
						<a href="<?php print get_edit_comment_link( $comment->comment_ID );?>" class="edit"><i class="fa fa-edit"></i> <?php _e('Edit','mars');?></a>
					<?php endif;?>
				</div>
			</div>		
		<?php 
	}
}

function mars_replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link reply", $class);
    return $class;
}
add_filter('comment_reply_link', 'mars_replace_reply_link_class');
 if( !function_exists('mars_get_post_authorID') ){
 	function mars_get_post_authorID($post_id) {
 		if( !$post_id )
 			return false;
 		$post = get_post($post_id);
 		return $post->post_author;
 	}
 }
if( !function_exists('mars_wp_nav_menu_args') ){
	function mars_wp_nav_menu_args( $args = '' ) {
		$args['container'] = false;
		return $args;
	}
	add_filter( 'wp_nav_menu_args', 'mars_wp_nav_menu_args' );	
}
if( !class_exists('Mars_Walker_Nav_Menu') ){
	class Mars_Walker_Nav_Menu extends Walker_Nav_Menu {
	   function start_lvl(&$output, $depth = 0, $args = array()) {
	      $output .= "\n<ul class=\"dropdown-menu\">\n";
	   }
	   function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	       $item_html = '';
	       parent::start_el($item_html, $item, $depth, $args);
	
	       if ( $item->is_dropdown && $depth === 0 ) {
	       		if( wp_is_mobile() ){
	       			$item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $item_html );
	       		}
	       		else{
	       			$item_html = str_replace( '<a', '<a', $item_html );
	       		}
	           $item_html = str_replace( '</a>', ' <b class="caret"></b></a>', $item_html );
	       }
	       $output .= $item_html;
	    }
	    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
	        if ( $element->current )
	        $element->classes[] = 'active';
	
	        $element->is_dropdown = !empty( $children_elements[$element->ID] );
	
	        if ( $element->is_dropdown ) {
	            if ( $depth === 0 ) {
	                $element->classes[] = 'dropdown';
	            } elseif ( $depth === 1 ) {
	                // Extra level of dropdown menu, 
	                // as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
	                $element->classes[] = 'dropdown-submenu';
	            }
	        }
	    	parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	    }
	}	
}
if( !function_exists('mars_add_parent_css') ){
	function mars_add_parent_css($classes, $item){
	     global  $dd_depth, $dd_children;
	     $classes[] = 'depth'.$dd_depth;
	     if($dd_children)
	         $classes[] = 'dropdown';
	    return $classes;
	}
	add_filter('nav_menu_css_class','mars_add_parent_css',10,2);	
}
if( !function_exists('mars_resave_real_video') ){
	function mars_resave_real_video($post_id) {
		if( get_post_type($post_id) =='video' ){
			$video_url = get_post_meta($post_id,'video_url',true);
			if( trim( $video_url ) != '' ){
				$video_data = mars_get_remote_videoid($video_url);
				if( !empty( $video_data ) ){
					foreach ( $video_data as $key=>$value ){
						update_post_meta($post_id, 'real_video_'. $key, $value);
					}
				}
			}
		}
		return $post_id;
	}
	//add_action('save_post', 'mars_resave_real_video', 100,1);
	//add_action('mars_save_post', 'mars_resave_real_video', 110, 1);
}
if( !function_exists('mars_get_remote_videoid') ){
	function mars_get_remote_videoid($url) {
		$video_id = NULL;
		if( !$url )
			return;
		if( !function_exists('parse_url') )
			return;
		$string = parse_url($url);
		$host = $string['host'];
		
		if( $host == 'vimeo.com' || $host =='www.vimeo.com' ){
			$video_id = substr($string['path'], 1);
		}
		if( $host == 'youtube.com' || $host =='www.youtube.com' ){
			parse_str( parse_url( $url, PHP_URL_QUERY ), $array_of_vars );
			$video_id = $array_of_vars['v'];			
		}
		return array(
			'id'	=>	$video_id,
			'source'	=>	$host
		);
	}
}

if( !function_exists( 'marstheme_youtube_autoplay' ) ){
	function marstheme_youtube_autoplay( $html, $url, $args ) {
		global $videotube;
		if ( ( strpos($url, 'youtube') !== FALSE || strpos($url, 'youtu.be') !== FALSE ) && $videotube['autoplay'] == 1) {
			return str_replace("?feature=oembed", "?feature=oembed&autoplay=1", $html);
		}
		return $html;
	}
	add_filter( 'oembed_result', 'marstheme_youtube_autoplay', 20, 3);
	add_filter( 'embed_oembed_html', 'marstheme_youtube_autoplay', 10, 3 );
}

if( !function_exists( 'marstheme_fully_video_responsive' ) ){
	/**
	 * @param unknown_type $html
	 * @param unknown_type $url
	 * @param unknown_type $args
	 * @return unknown
	 */
	function marstheme_fully_video_responsive( $html, $url, $args ) {
		
		if( ( is_single() || is_page() ) && is_main_query() ){

			$html = '<div class="'. apply_filters( 'aspect_ratio' , 'embed-responsive embed-responsive-16by9') .'">'. $html .'</div>';
		}
		return $html;
	}
	add_filter('embed_oembed_html', 'marstheme_fully_video_responsive', 30, 3 );
}

if( ! function_exists( 'mars_instagram_aspect_ratio' ) ){
	/**
	 * @param unknown_type $aspect_ratio
	 * @return unknown|string
	 */
	function mars_instagram_aspect_ratio( $aspect_ratio ) {
		$url = $host = '';
		// Get the object from post meta.
		$object = get_post_meta( get_the_ID(), 'video_url', true );

		if( empty( $object ) ){
			return $aspect_ratio;
		}

		$url = parse_url( $object );

		if( isset( $url['host'] ) && ! empty( $url['host'] ) ){
			$host = preg_replace('/^www\./', '', $url['host'] );
		}

		if( isset( $host ) && ! empty( $host ) ){
			if( in_array( $host , array( 'instagram.com', 'twitter.com' ) ) ){
				$aspect_ratio = 'embed-responsive-' . esc_attr( $host );
			}
		}

		if ( preg_match('/twitter.com/', $object ) ){
			$aspect_ratio = 'embed-responsive-twitter';
		}

		return $aspect_ratio;
	}
	add_filter( 'aspect_ratio' , 'mars_instagram_aspect_ratio', 100, 1 );
}

if( !function_exists('videoframe') ){
	function videoframe() {
		global $post,$videotube;
		$frame = null;
		$settings = array();
		$layout = get_post_meta($post->ID,'layout',true) ? get_post_meta($post->ID,'layout',true) : apply_filters( 'mars_video_single_layout' , 'small') ;
		if( $layout == 'large' ){
			### Fullwidth Video
			$settings = array(
				'width'	=>	1140,
				'height'	=>	641,
			);
		}
		else{
			### Right sidebar Video
			$settings = array(
				'width'	=>	750,
				'height'	=>	442
			);
		}
		$settings['autoplay'] = "true";
		$video_url = get_post_meta($post->ID,'video_url',true);
		if( $video_url ){
			if( function_exists( 'wp_oembed_get' ) ){
				$frame .= wp_oembed_get($video_url, $settings);
			}
		}
		elseif( get_post_meta($post->ID,'video_frame',true) !='' ){
			### The Frame.
			$frame .= get_post_meta($post->ID,'video_frame',true);
		}
		elseif( get_post_meta($post->ID,'video_file',true) !='' ){
			$autoplay = ( $videotube['autoplay'] == 1 ) ? 'autoplay="on"' : null;
			$video_file_url = wp_get_attachment_url( get_post_meta($post->ID,'video_file',true) );
			$frame .= '[video '.$autoplay.' '.$settings.' src="'.$video_file_url.'"][/video]';
		}
		return $frame;
	}
	add_filter('videoframe', 'videoframe', 10);
}

if( !function_exists('mars_orderblock_videos') ){
	function mars_orderblock_videos() {
		$order = isset( $_REQUEST['order_post'] ) ?  trim($_REQUEST['order_post']) : null;
		$sort_array = array(
			'latest'	=>	__('Latest','mars'),
			'viewed'	=>	__('Viewed','mars'),
			'liked'	=>	__('Liked','mars'),
			'comments'	=>	__('Comments','mars')
		);
		$block = '<div class="section-nav"><ul class="sorting"><li class="sort-text">'.__('Sort by:','mars').'</li>';
			foreach ( $sort_array as $key=>$value ){
				$active = ( $order == $key ) ? 'class="active"' : null;
				if( is_search() ){
					$block .= '<li '.$active.'><a href="'. esc_url( add_query_arg( array( 's'=> rawurlencode( get_search_query() ), 'order_post' => $key ) ) ) .'">'.$value.'</a></li>';
				}
				else{
					$block .= '<li '.$active.'><a href="'.esc_url( add_query_arg( array( 'order_post' => $key ) ) ).'">'.$value.'</a></li>';
				}
			}
		$block .= '</ul></div>';
		print $block;
	}
	add_action('mars_orderblock_videos', 'mars_orderblock_videos');
}

if( !function_exists('mars_orderquery_videos') ){
	function mars_orderquery_videos( $query ) {
		$order = isset( $_REQUEST['order_post'] ) ? trim( $_REQUEST['order_post'] ) : null;
		if( $query->is_home() ||  $query->is_search || is_tax() || is_archive() && !is_admin() ){
			if( $query->is_main_query() ){
				switch ( $order ) {
					case 'comments':
						$query->set( 'orderby', 'comment_count' );
					break;
					case 'viewed':
						$query->set( 'meta_key','count_viewed' );
						$query->set( 'orderby', 'meta_value_num' );
					break;
					case 'liked':
						$query->set( 'meta_key','like_key' );
						$query->set( 'orderby', 'meta_value_num' );
					break;
				}
			}
			$query->set( 'order', 'DESC' );
		}
	}
	add_action('pre_get_posts', 'mars_orderquery_videos');
}

if( !function_exists('mars_get_count_viewed') ){
	function mars_get_count_viewed() {
		global $post;
		if( isset( $post->ID ) && function_exists( 'stats_get_csv' ) ){
			
			if( get_transient( 'postviews_' . $post->ID ) !== false ){
				return get_transient( 'postviews_' . $post->ID );
			}
			
			$random = mt_rand( 9999, 999999999 ); // hack to break cache bug
		
			$args = array(
				'days' => $random,
				'post_id' => $post->ID,
			);
		
			$stats = stats_get_csv( 'postviews', $args );
			$views = ( isset( $stats['0']['views'] ) &&  $stats['0']['views'] > 0 ) ? $stats['0']['views'] : 0;
			$views = (int)$views;
			if( $views > 0 ){
				// save transient.
				// 1/2 day.
				set_transient( 'postviews_' . $post->ID , $views, 60*60*1*6 );
			}
			return $views;
		}
		return get_post_meta( $post->ID,'count_viewed',true );
	}
}


if( !function_exists('mars_update_post_view') ){
	function mars_update_post_view() {
		global $post;
	    if(!isset($_SESSION)){ session_start();} 
	    
	    if( is_single() ){
	    	if( function_exists( 'stats_get_csv' ) ){
	    		$view = mars_get_count_viewed();
	    		if( isset( $view ) && $view > 0 ){
	    			update_post_meta( $post->ID, 'count_viewed', $view );
	    		}	
	    	}
	    	else{
	    		if( isset( $_SESSION['count_viewed'] ) ){
	    			if( in_array( $post->ID, $_SESSION['count_viewed'] ) ){
	    				return;
	    			}
	    		}
	    		$current_viewed = mars_get_count_viewed();
	    		update_post_meta($post->ID, 'count_viewed', $current_viewed + 1);
	    		$_SESSION['count_viewed'][] = $post->ID;	    		
	    	}
	    }
	}
	add_action('wp', 'mars_update_post_view');
}

if( !function_exists('mars_add_1firstlike') ){
	function mars_add_1firstlike( $post_id ) {
		if( get_post_type( $post_id ) =='video' ){
			$likes = mars_get_like_count( $post_id );
			if( $likes == 0 || !$likes ){
				update_post_meta($post_id, 'like_key', 1);
			}
		}
	}
	add_action('save_post', 'mars_add_1firstlike', 9999, 1);
}
//---------------------------------------- like and dislike button ------------------------------------------
if( !function_exists('mars_get_like_count') ){
	function mars_get_like_count($post_id) {
		return get_post_meta($post_id, 'like_key',true) ? get_post_meta($post_id, 'like_key',true)  : 0;
	}	
}
if( !function_exists('mars_get_dislike_count') ){
	function mars_get_dislike_count($post_id) {
		return get_post_meta($post_id, 'dislike_key',true) ? get_post_meta($post_id, 'dislike_key',true)  : 0;
	}	
}
//---------------------------------------- like and dislike button ------------------------------------------

if( !function_exists('mars_get_current_postterm') ){
	function mars_get_current_postterm($post_id, $taxonomy){
		$terms = wp_get_post_terms($post_id,$taxonomy, array("fields" => "ids"));
		return $terms;
	}
}

if( !function_exists('mars_get_socials_count') ){
	function mars_get_socials_count($key) {
		$count = 0;
		switch ($key) {			
			case 'subscriber':
				$result = count_users();
				$count = isset( $result['avail_roles'][$key] ) ? $result['avail_roles'][$key] : 0;
			break;
		}
		return !empty( $count ) ? $count : 0;
	}
}
if(!function_exists('mars_get_editor')){
	function mars_get_editor($content, $id, $name, $display_media = false) {
		ob_start();
		$settings = array(
			'textarea_name' => $name,
			'media_buttons' => $display_media,
			'textarea_rows'	=>	5,
			'quicktags'	=>	false
		);
		// Echo the editor to the buffer
		wp_editor($content,$id, $settings);
		// Store the contents of the buffer in a variable
		$editor_contents = ob_get_clean();
		$editor_contents = str_ireplace("<br>","", $editor_contents);
		// Return the content you want to the calling function
		return $editor_contents;
	}
}

if( !function_exists('mars_custom_css') ){
	function mars_custom_css() {
		global $videotube;
		$css = NULL;
		if( isset( $videotube['custom_css'] ) && trim( $videotube['custom_css'] ) != '' ){
			$css = '<style>'.$videotube['custom_css'].'</style>';
		}
		print $css;
	}
	add_action('wp_head', 'mars_custom_css');
}

if( !function_exists('mars_custom_css_on_mobile') ){
	function mars_custom_css_on_mobile() {
		global $videotube;
		$css = NULL;
		if( isset( $videotube['custom_css_mobile'] ) && trim( $videotube['custom_css_mobile'] ) != '' && wp_is_mobile() ){
			$css = '<style>'.$videotube['custom_css_mobile'].'</style>';
		}
		print $css;
	}
	add_action('wp_head', 'mars_custom_css_on_mobile');
}

if( !function_exists('mars_custom_js') ){
	function mars_custom_js() {
		global $videotube;
		$js = NULL;
		if( isset( $videotube['custom_js'] ) && trim( $videotube['custom_js'] ) != '' ){
			$js .= '<script>jQuery(document).ready(function(){'.$videotube['custom_js'].'});</script>';
		}
		print $js;
	}
	add_action('wp_footer', 'mars_custom_js');
}

if( !function_exists('mars_custom_js_on_mobile') ){
	function mars_custom_js_on_mobile() {
		global $videotube;
		$js = NULL;
		if( isset( $videotube['custom_js_mobile'] ) && trim( $videotube['custom_js_mobile'] ) != '' && wp_is_mobile() ){
			$js .= '<script>jQuery(document).ready(function(){'.$videotube['custom_js_mobile'].'});</script>';
		}
		print $js;
	}
	add_action('wp_footer', 'mars_custom_js_on_mobile');
}

if( !function_exists('mars_special_nav_class') ){
	function mars_special_nav_class($classes, $item){
	     if( in_array('current-menu-item', $classes) ){
	     	$classes[] = 'active ';
	     }
	     return $classes;
	}	
}
add_filter('nav_menu_css_class' , 'mars_special_nav_class' , 10 , 2);

if( !function_exists( 'mars_get_user_postcount' ) ){
	function mars_get_user_postcount( $user_id, $post_type="video" ) {
		return count_user_posts( $user_id , $post_type  );
	}
}
if( !function_exists( 'mars_get_user_metacount' ) ){
	function mars_get_user_metacount( $user_id, $key ) {
		global $wpdb;
		
		if( false === ( $query = get_transient( $user_id . 'meta_count' . $key ) ) ){
			$query = $wpdb->get_var( $wpdb->prepare(
					"
					SELECT sum(meta_value)
					FROM $wpdb->postmeta LEFT JOIN $wpdb->posts ON ( $wpdb->postmeta.post_id = $wpdb->posts.ID )
					LEFT JOIN $wpdb->users ON ( $wpdb->posts.post_author = $wpdb->users.ID )
					WHERE meta_key = %s
					AND $wpdb->users.ID = %s
					AND $wpdb->posts.post_status = %s
					AND $wpdb->posts.post_type = %s
					",
					$key,
					$user_id,
					'publish',
					'video'
			) );
			
			if( (int)$query > 0 ){
				set_transient( $user_id . 'meta_count' . $key , $query, 600);
			} 
		}
		return (int)$query > 0 ? number_format_i18n($query) : 0; 
	}
}
if( !function_exists( 'mars_viaudiofile_format' ) ){
	function mars_viaudiofile_format() {
		$allowed_formats = array(
			'asf',
			'asx',
			'wmv',
			'wmx',
			'wm',
			'avi',
			'divx',
			'flv',
			'mov',
			'qt',
			'mpeg',
			'mpg',
			'mpe',
			'mp4',
			'm4v',
			'ogv',
			'webm',
			'mkv',
			'mp3',
			'm4a',
			'm4b',
			'ra',
			'ram',
			'wav',
			'ogg',
			'oga',
			'mid',
			'midi',
			'wma',
			'wax',
			'mka'
		);
		return apply_filters( 'mars_viaudiofile_format/filetypes' , $allowed_formats);
	}
}
if( !function_exists( 'mars_imagefile_format' ) ){
	function mars_imagefile_format() {
		return apply_filters( 'mars_imagefile_format/filetypes' , array('jpg','jpeg','png','gif'));
	}
}
if( !function_exists( 'mars_check_file_allowed' ) ){
	function mars_check_file_allowed( $file, $type = 'video' ){
		$bool = false;
		if( $type == 'video' ){
			$mimes = mars_viaudiofile_format();
		}
		else{
			$mimes = mars_imagefile_format();
		}
		$filetype = wp_check_filetype($file['name'], null);
		
		$ext = isset( $filetype ) ? strtolower( $filetype['ext'] ) : '';
		
		if( in_array( $ext , $mimes) ){
			$bool = true;
		}

		return $bool;
	}
}
if( !function_exists( 'mars_check_file_size_allowed' ) ){
	function mars_check_file_size_allowed( $file, $type = 'video' ){
		global $videotube;
		if( !$file )
			return false;
		if( $type == 'video' ){
			$filesize = isset( $videotube['videosize'] ) ? (int)$videotube['videosize'] : 10;	
		}
		else{
			$filesize = isset( $videotube['imagesize'] ) ? (int)$videotube['imagesize'] : 2;
		}
		if( $filesize == -1 ){
			return true;
		}
		$byte_limit = mars_convert_mb_to_b( $filesize );
		if( $file["size"] > $byte_limit ){
			return false;
		}
		return true;
	}
}

if( !function_exists( 'mars_convert_mb_to_b' ) ){
	function mars_convert_mb_to_b( $megabyte ) {
		if( !$megabyte || $megabyte == 0 )
			return 0;
		return (int)$megabyte * 1048576;
	}
}

if( !function_exists( 'mars_insert_attachment' ) ){
	function mars_insert_attachment($file_handler, $post_id, $setthumb='false', $post_meta = '') {
		// check to make sure its a successful upload
		if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
	
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	
		$attach_id = media_handle_upload( $file_handler, $post_id );
	
		if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
		if(!$setthumb && $post_meta!=''){
			update_post_meta($post_id, $post_meta, array( $attach_id ));
		}
		return $attach_id;
	}
}
if( !function_exists( 'mars_videolayout' ) ){
	function mars_videolayout() {
		return array( 
			'small'	=>	__('Small','mars'),
			'large'	=>	__('Large','mars')
		);
	}
}
if( !function_exists( 'bootstrap_link_pages' ) ){
	/**
	 * Link Pages
	 * @author toscha
	 * @link http://wordpress.stackexchange.com/questions/14406/how-to-style-current-page-number-wp-link-pages
	 * @param  array $args
	 * @return void
	 * Modification of wp_link_pages() with an extra element to highlight the current page.
	 */
	function bootstrap_link_pages( $args = array () ) {
	    $defaults = array(
	        'before'      => '<p>' . __('Pages:','mars'),
	        'after'       => '</p>',
	        'before_link' => '',
	        'after_link'  => '',
	        'current_before' => '',
	        'current_after' => '',
	        'link_before' => '',
	        'link_after'  => '',
	        'pagelink'    => '%',
	        'echo'        => 1
	    );
	 
	    $r = wp_parse_args( $args, $defaults );
	    $r = apply_filters( 'wp_link_pages_args', $r );
	    extract( $r, EXTR_SKIP );
	 
	    global $page, $numpages, $multipage, $more, $pagenow;
	 
	    if ( ! $multipage )
	    {
	        return;
	    }
	 
	    $output = $before;
	 
	    for ( $i = 1; $i < ( $numpages + 1 ); $i++ )
	    {
	        $j       = str_replace( '%', $i, $pagelink );
	        $output .= ' ';
	 
	        if ( $i != $page || ( ! $more && 1 == $page ) )
	        {
	            $output .= "{$before_link}" . _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>{$after_link}";
	        }
	        else
	        {
	            $output .= "{$current_before}{$link_before}<a>{$j}</a>{$link_after}{$current_after}";
	        }
	    }
	 
	    print $output . $after;
	}	
}

if ( ! function_exists( 'mars_pagination' ) ){
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function mars_pagination( $query = null ) {
		// Don't print empty markup if there's only one page.
		global $wp_query;
		if( empty( $query ) )
			$query = $wp_query;
		if ( $query->max_num_pages < 2 ) {
			return;
		}
		if( is_front_page() ){
			$paged        = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
		}
		else{
			$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		}

		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
		
		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 3,
			'type'	=>	'array',
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_next'    => true,
			'prev_text' => !is_rtl() ? __( '&larr; Previous ', 'mars' ) : __( ' &rarr; Previous', 'mars' ),
			'next_text' => !is_rtl() ? __( 'Next &rarr;', 'mars' ) : __( 'Next &larr;', 'mars' )
		) );

		if ( is_array( $links ) ) :
            echo '<ul class="pagination">';
            foreach ( $links as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul>';
		endif;
		
	}
	add_action('mars_pagination', 'mars_pagination', 10, 1);
}

if( !function_exists( 'mars_get_video_category_array' ) ){
	function mars_get_video_category_array( $taxonomy ){
		$terms_array = array();
		if( !taxonomy_exists( $taxonomy ) )
			return;
		$args = array(
			'orderby'       => 'name',
			'order'         => 'ASC',
			'hide_empty'    => true,
			'exclude'       => array(),
			'exclude_tree'  => array(),
			'include'       => array(),
			'fields'        => 'all',
			'hierarchical'  => true,
			'child_of'      => 0,
			'pad_counts'    => false,
			'cache_domain'  => 'core'
		);
		$terms = get_terms( $taxonomy, $args );
		if ( !empty( $terms ) && !is_wp_error( $terms ) ){
			foreach ( $terms as $term ) {
				$terms_array[ $term->name ]	=	$term->term_id;
			}
		}
		return $terms_array;
	}
}

if( !function_exists( 'mars_get_columns' ) ){
	/**
	 * @return mixed
	 */
	function mars_get_columns() {
		$default = 3;
		$columns = apply_filters( 'mars_layout_columns' , $default);
		$real_columns = ( 12%$columns == 0 ) ? 12/$columns : $default;
		return $real_columns;
	}
}

if( !function_exists( 'mars_add_breadcrumbs' ) ){
	function mars_add_breadcrumbs() {
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
	}
	add_action( 'videotube_before_video_title' , 'mars_add_breadcrumbs', 10);
}

if( !function_exists( 'mars_convert_columns_to_thumbnail_size' ) ){
	/**
	 * get the thumbnail size.
	 * @param int $columns
	 * return string of the thumbnail size, defined in functions.php.
	 */
	function mars_convert_columns_to_thumbnail_size() {
		$columns =  mars_get_columns();
		$size = 'video-lastest';
		switch ( $columns ) {
			// 1 columns, fullwidth
			case '12':
				$size = 'blog-large-thumb';
			break;
			
			case '6':
				$size = 'video-featured';
			break;			
			
			case '4':
				//$size = 'blog-large-thumb';
				// using the default size.
			break;	

			case '3':
				$size = 'video-featured';
			break;			
				
			case '2':
				//$size = 'blog-large-thumb';
			break;
				
		}
		return apply_filters( 'video_thumbnail_size' , $size);
	}
}

if( !function_exists( 'mars_add_styles' ) ){
	/**
	 * Add style
	 * @param array $styles
	 * @return mixed
	 */
	function mars_add_styles( $styles ) {
		$styles = array(
			'default'	=>	__('Default','mars'),
			get_template_directory_uri() . '/assets/style/blue.css' =>	__('Blue','mars'),
			get_template_directory_uri() . '/assets/style/splash-orange.css' =>	__('Splash Orange','mars'),
			get_template_directory_uri() . '/assets/style/orange.css' =>	__('Orange','mars'),
			get_template_directory_uri() . '/assets/style/wood.css' =>	__('Wood','mars'),
			get_template_directory_uri() . '/assets/style/splash-red.css' =>	__('Splash Red','mars'),
			get_template_directory_uri() . '/assets/style/green.css' =>	__('Green','mars'),
			'custom'	=>	__('Custom','mars')
		);
		return apply_filters( 'mars_add_styles' , $styles);
	}
	add_filter( 'mars_get_styles' , 'mars_add_styles', 10, 1);
}
if( !function_exists( 'videotube_add_video_feed' ) ){
	function videotube_add_video_feed($qv) {
		global $videotube;
		if (isset($qv['feed']) && !isset($qv['post_type']) && $videotube['video_feed'] == 1)
			$qv['post_type'] = array('post', 'video');
		return $qv;
	}
	add_filter('request', 'videotube_add_video_feed');
}


if( !function_exists( 'mars_hide_post_content_password_required' ) ){
	function mars_hide_post_content_password_required( $the_content ) {
		global $post;
		if( is_single() && post_password_required( $post ) && get_post_type( $post ) == 'video' ){
			return;
		}
		return $the_content;
	}
	add_action( 'the_content' , 'mars_hide_post_content_password_required', 100, 1);
}

if( !function_exists( 'mars_set_the_aspect_ratio' ) ){
	function mars_set_the_aspect_ratio( $class ) {
		global $videotube;
		if( isset( $videotube['aspect_ratio'] ) && $videotube['aspect_ratio'] != '16by9' ){
			return 'embed-responsive embed-responsive-4by3';
		}
		return $class;
	}
	add_filter( 'aspect_ratio' , 'mars_set_the_aspect_ratio', 10, 1);
}

if( function_exists( 'vc_set_as_theme' ) ){
	vc_set_as_theme( apply_filters( 'marstheme_vc_set_as_theme' , true) );
}