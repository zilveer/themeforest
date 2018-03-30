<?php

/*---------------------------------------------------------------------------*/
/* Theme Common :: Setup + Actions
/*---------------------------------------------------------------------------*/

// Add admin actions
add_action( 'admin_enqueue_scripts', 'wpbandit_post_formats_script');
add_action( 'admin_bar_menu', 'air_admin_bar_menu', 100 );
add_action( 'admin_head', 'air_admin_bar' );

// Add theme actions
add_action( 'wp_head', 'air_admin_bar' );
add_action( 'wp_head', 'wpbandit_head' );
add_action( 'wp_head', 'wpbandit_seo' );
add_action( 'wp_footer', 'wpbandit_footer' );

// Remove WP generator meta tag
remove_action( 'wp_head', 'wp_generator' );


/*---------------------------------------------------------------------------*/
/* Theme Common :: Functions
/*---------------------------------------------------------------------------*/

/**
	Post formats script
**/
function wpbandit_post_formats_script($hook) {
	// Only load on posts, pages
	if ( !in_array($hook, array('post.php','post-new.php')) )
		return;
	// post-formats.js
	wp_enqueue_script('wpbandit-post-formats',
		AIR_ASSETS .'/post-formats.js',
		array('jquery'), '1.0');
}

/**
	Head
**/
function wpbandit_head() {
	// Favicon
	if ( Air::get_option('favicon') )
		echo '<link rel="shortcut icon" href="'.
			Air::get_option('favicon').'">'."\n";
	// Analytics script
	if ( Air::get_option('analytics-script') ) {
		if ( 'header' === Air::get_option('analytics-location') ) {
			echo Air::get_option('analytics-script')."\n";
		}
	}
}

/**
	SEO
**/
function wpbandit_seo() {
	// Disable SEO Module
	if ( class_exists('All_in_One_SEO_Pack') ||
			Air::get_option('seo-disable') )
		return;

	// Home Page Meta
	if ( is_front_page() ) {
		// Meta description
		if ( Air::get_option('seo-home-meta-description') ) {
			echo '<meta name="description" content="'.
				Air::get_option('seo-home-meta-description').'">'."\n";
		}
		// Meta keywords
		if ( Air::get_option('seo-home-meta-keywords') ) {
			echo '<meta name="keywords" content="'.
				Air::get_option('seo-home-meta-keywords').'">'."\n";
		}
	}

	// SEO Default Robot Attributes
	$seo_robot_atts = array(
		'name'		=> 'robots',
		'content'	=> array()
	);

	// SEO - Author
	if ( is_author() ) {
		// noindex, noarchive, nofollow
		$noindex = Air::get_option('seo-noindex-author');
		$noarchive = Air::get_option('seo-noarchive-author');
		$nofollow = Air::get_option('seo-nofollow-author');
		if ( $noindex ) { $seo_robot_atts['content'][] = 'noindex'; }
		if ( $noarchive ) { $seo_robot_atts['content'][] = 'noarchive'; }
		if ( $nofollow ) { $seo_robot_atts['content'][] = 'nofollow'; }
	}

	// SEO - Category
	if ( is_category() ) {
		// noindex, noarchive, nofollow
		$noindex = Air::get_option('seo-noindex-category');
		$noarchive = Air::get_option('seo-noarchive-category');
		$nofollow = Air::get_option('seo-nofollow-category');
		if ( $noindex ) { $seo_robot_atts['content'][] = 'noindex'; }
		if ( $noarchive ) { $seo_robot_atts['content'][] = 'noarchive'; }
		if ( $nofollow ) { $seo_robot_atts['content'][] = 'nofollow'; }
	}

	// SEO - Date
	if ( is_date() ) {
		// noindex, noarchive, nofollow
		$noindex = Air::get_option('seo-noindex-date');
		$noarchive = Air::get_option('seo-noarchive-date');
		$nofollow = Air::get_option('seo-nofollow-date');
		if ( $noindex ) { $seo_robot_atts['content'][] = 'noindex'; }
		if ( $noarchive ) { $seo_robot_atts['content'][] = 'noarchive'; }
		if ( $nofollow ) { $seo_robot_atts['content'][] = 'nofollow'; }
	}

	// SEO - Tags
	if ( is_tag() ) {
		// noindex, noarchive, nofollow
		$noindex = Air::get_option('seo-noindex-tag');
		$noarchive = Air::get_option('seo-noarchive-tag');
		$nofollow = Air::get_option('seo-nofollow-tag');
		if ( $noindex ) { $seo_robot_atts['content'][] = 'noindex'; }
		if ( $noarchive ) { $seo_robot_atts['content'][] = 'noarchive'; }
		if ( $nofollow ) { $seo_robot_atts['content'][] = 'nofollow'; }
	}

	// SEO - noodp, noydir
	$noodp = Air::get_option('seo-noodp');
	$noydir = Air::get_option('seo-noydir');
	if ( $noodp ) { $seo_robot_atts['content'][] = 'noodp'; }
	if ( $noydir ) { $seo_robot_atts['content'][] = 'noydir'; }

	// SEO Robot Meta Tags
	if ( $seo_robot_atts['content'] ) {
		$seo_robot_atts['content'] = implode(',',$seo_robot_atts['content']);
		echo '<meta'.air_attrs($seo_robot_atts).'>'."\n";
	}
}

/**
	Footer
**/
function wpbandit_footer() {
	// Analytics script
	if ( Air::get_option('analytics-script') ) {
		if ( 'footer' === Air::get_option('analytics-location') ) {
			echo Air::get_option('analytics-script')."\n";
		}
	}
}

/**
	Create images table
**/
function wpbandit_create_images_table() {
	global $wpdb;
	$table_name='wpbandit_images';
	// Create dynamic images table if it doesn't exist
	if ( !$wpdb->get_var("show tables like '".$table_name."'") ) {
		$sql = "CREATE TABLE  ".$table_name." (
						image_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
						post_id bigint(20) unsigned NOT NULL,
						image_file varchar(255) DEFAULT '' NOT NULL,
						UNIQUE KEY image_id (image_id)
						) CHARSET=utf8;";
		require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);
	}
}


/*---------------------------------------------------------------------------*/
/* Theme Common :: Template Functions
/*---------------------------------------------------------------------------*/

/**
	Limit words
**/
function wpb_limit_words($str,$limit,$sep='...') {
	$str = strip_tags($str);
	$str = explode(' ', $str);
	$str = implode(' ', array_slice($str,0,$limit));
	return $str.$sep;
}

/**
	Limit characters
**/
function wpb_limit_characters($str,$limit,$sep='...') {
	if(mb_strlen($str) > $limit ) {
		$str = mb_substr($str,0,($limit - 4));
		$words = explode(' ', $str);
		$cut = - (mb_strlen($words[count($words)-1]));
		$str = ($cut < 0)?mb_substr($str,0,$cut-1):$str;
		return $str.$sep;
	} else {
		return $str;
	}
}

/**
	Get theme option
**/
function wpb_option($key,$default=FALSE) {
	return Air::get_option($key,$default);
}

/**
	Site Name
**/
function wpb_site_name($args=array()) {
	// Default attributes
	$defaults = array(
		'id'		=> 'logo',
		'tag-home'	=> 'h1',
		'tag'		=> 'p'
	);

	// Parse arguments
	$atts = wp_parse_args($args,$defaults);

	// Set tag
	$tag = (is_front_page() || is_home())?$atts['tag-home']:$atts['tag'];

	// Text or image ?
	if ( Air::get_option('custom-logo') ) {
		$logo = '<img src="'.Air::get_option('custom-logo').'" alt="'.get_bloginfo('name').'">';
	} else {
		$logo = get_bloginfo('name');
	}

	// Build link
	$link = '<a href="'.home_url('/').'" rel="home">'.$logo.'</a>';

	// Unset attributes
	unset($atts['tag']);
	unset($atts['tag-home']);
	
	// Set site name
	$sitename = '<'.$tag.air_attrs($atts).'>'.$link.'</'.$tag.'>'."\n";

	// Return site name
	return apply_filters('wpbandit_site_name', $sitename);
}

/**
	Site Description
**/
function wpb_site_desc($args=array()) {
	// Is tagline disabled ?
	if ( Air::get_option('disable-tagline') )
		return;
	
	// Default attributes
	$defaults = array(
		'id' => 'tagline',
	);

	// Parse arguments
	$atts = wp_parse_args($args,$defaults);
	
	// Set site description
	$sitedesc = '<p'.air_attrs($atts).'>'.get_bloginfo('description').'</p>';

	// Return site description
	return apply_filters('wpbandit_site_desc', $sitedesc);
}

/**
	Setup metadata
**/
function wpb_metadata() {
	// Global $post variable
	global $post;
	// Set metadata
	Air::set_metadata(get_metadata('post', $post->ID));
}

/**
	Reset metadata
**/
function wpb_reset_metadata() {
	Air::reset_metadata();
}

/**
	Get meta value
**/
function wpb_meta($key,$default=FALSE) {
	return Air::get_meta($key,$default);
}

/**
	Get sidebar
**/
function wpb_sidebar() {
	// Default sidebar
	$sidebar = 'sidebar-default';

	// Set sidebar based on page
	if ( is_front_page() && air_sidebar::get_option('sidebar-front-page') )
		$sidebar = air_sidebar::get_option('sidebar-front-page');
	if ( is_home() && air_sidebar::get_option('sidebar-home') )
		$sidebar = air_sidebar::get_option('sidebar-home');
	if ( is_single() && air_sidebar::get_option('sidebar-single') )
		$sidebar = air_sidebar::get_option('sidebar-single');
	if ( is_archive() && air_sidebar::get_option('sidebar-archive')  )
		$sidebar = air_sidebar::get_option('sidebar-archive');
	if ( is_search() && air_sidebar::get_option('sidebar-search') )
		$sidebar = air_sidebar::get_option('sidebar-search');
	if ( is_404() && air_sidebar::get_option('sidebar-404') )
		$sidebar = air_sidebar::get_option('sidebar-404');
	if ( is_page() && air_sidebar::get_option('sidebar-page') )
		$sidebar = air_sidebar::get_option('sidebar-page');


	// Check for page/post specific sidebar
	if ( is_page() || is_single() ) {
		// Reset post data
		wp_reset_postdata();
		global $post;
		// Get meta
		$meta = get_post_meta($post->ID,'_sidebar',TRUE);
		if ( $meta ) { $sidebar = $meta; }
	}

	// Return sidebar
	return $sidebar;
}

/**
	Get content format
**/
function wpb_content_format() {
	// Default format
	$content = 'content';

	// Set format based on page
	if ( is_home() )
		$content = Air::get_option('post-content-home')?'content':'excerpt';
	if ( is_archive() )
		$content = Air::get_option('post-content-archive')?'content':'excerpt';
	if ( is_search() )
		$content = Air::get_option('post-content-search')?'content':'excerpt';

	// Return content format
	return $content;
}

/**
	Get images attached to post
**/
function wpb_post_images($args=array()) {
	// Global post variable
	global $post;

	// Default attributes
	$defaults = array(
		'numberposts'		=> -1,
		'order'				=> 'ASC',
		'orderby'			=> 'menu_order',
		'post_mime_type'	=> 'image',
		'post_parent'		=>  $post->ID,
		'post_type'			=> 'attachment',
	);

	// Parse arguments
	$args = wp_parse_args($args,$defaults);

	// Return images
	return get_posts($args);
}

/**
	Show post navigation?
**/
function wpb_show_post_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}

/**
	Comments enabled?
**/
function wpb_comments_enabled() {
	// Get option based on page
	if ( is_page() )
		$option = Air::get_option('comments-pages-disable');
	if ( is_single() )
		$option = Air::get_option('comments-posts-disable');

	# Return option
	return ('1' === $option)?FALSE:TRUE;
}

/**
	Footer text
**/
function wpb_footer_text() {
	// Default
	$txt = '&copy; Copyright '.date('Y').' '.get_bloginfo('site_name').'. 
	<span>'.Air::get('theme-name').' Theme by <a href="http://wpbandit.com" target="_blank">WPBandit</a>.</span>';
	// Return footer text
	return Air::get_option('footer-text',$txt);
}

/**
	Resize images dynamically using wp built in functions
	Victor Teixeira

	Example use:

	<?php 
	$thumb = get_post_thumbnail_id(); 
	$image = vt_resize( $thumb, '', 140, 110, true );
	?>
	<img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />

	@param int $attach_id
	@param string $img_url
	@param int $width
	@param int $height
	@param bool $crop
	@return array
**/
function wpb_vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
	// this is an attachment, so we have the ID
	if ( $attach_id ) {
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id );
	// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		$file_path = parse_url( $img_url );
		$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
		//$file_path = ltrim( $file_path['path'], '/' );
		//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
		$orig_size = getimagesize( $file_path );
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	}

	$file_info = pathinfo( $file_path );
	$extension = '.'. $file_info['extension'];

	// the image path without the extension
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {
		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {
			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			return $vt_image;
		}
		// $crop = false
		if ( $crop == false ) {
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			
			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size[0],
					'height' => $proportional_size[1]
				);
				return $vt_image;
			}
		}
		// no cache files - let's finally resize it
		$new_img_path = image_resize( $file_path, $width, $height, $crop );
		$new_img_size = getimagesize( $new_img_path );
		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
		// resized output
		$vt_image = array (
			'url' => $new_img,
			'width' => $new_img_size[0],
			'height' => $new_img_size[1]
		);
		return $vt_image;
	}
	// default output - without resizing
	$vt_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	return $vt_image;
}

/**
	Dynamic Image Resizing
**/
function wpb_dynamic_resize($attach_id=null,$img_url=null,$width,$height,$crop=false) {
	// Resize image
	$dynamic_image = wpb_vt_resize($attach_id,$img_url,$width,$height,$crop);
	// Get upload dir and URL
	$upload_dir = wp_upload_dir();
	$upload_url = $upload_dir['baseurl'];
	// Get image path
	$image = split($upload_url,$dynamic_image['url']);
	// Check if in DB
	global $wpdb;
	$result = $wpdb->get_row("SELECT * FROM wpbandit_images WHERE image_file = '$image[1]' ", ARRAY_A);
	// If no result, enter into DB
	if ( !$result ) {
		$wpdb->insert('wpbandit_images',
			array(
				'post_id'		=> $attach_id,
				'image_file'	=> $image[1]
			)
		);
	}
	return $dynamic_image;
}

/**
	Convert hexadecimal to rgb
**/
function wpb_hex2rgb($hex,$array=FALSE) {
	$hex = str_replace("#", "", $hex);

	if ( strlen($hex) == 3 ) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}

	$rgb = array($r, $g, $b);
	if ( !$array ) { $rgb = implode(",", $rgb); } // separated values by commas
	return $rgb; // returns an array with the rgb values
}


/*---------------------------------------------------------------------------*/
/* Theme Common :: Filters
/*---------------------------------------------------------------------------*/

/**
	WP Title
**/
function wpbandit_wp_title($title) {
	// Do not filter title if SEO plugin installed
	if ( class_exists('All_in_One_SEO_Pack') || 
			Air::get_option('seo-disable') )
		return $title;

	// Set title for home page
	if ( is_front_page() ) {
		$title = Air::get_option('seo-home-title',$title);
	}

	// Append site name to the title
	if ( !is_front_page() && Air::get_option('seo-title-append-sitename') ) {
		// Get separator
		$sep = Air::get_option('seo-title-separator','|');

		// Append separator and site name to title
		$title .= ' ' . $sep . ' ' . get_bloginfo('name');
	}

	// Return title
	return $title;
}
add_filter('wp_title','wpbandit_wp_title');

/**
	Style loader tag
	- remove text attribute for stylesheet link element
**/
function wpbandit_style_loader_tag($src) {
    return str_replace("type='text/css'", '', $src);
}
add_filter('style_loader_tag', 'wpbandit_style_loader_tag');

/**
	Feed Link
**/
function wpbandit_feed_link($output,$feed) {
	// Do not redirect comments feed
	if ( 'comments-rss2' === $feed )
		return $output;
	// Return feed url
	return Air::get_option('feed-url',$output);
}
add_filter('feed_link','wpbandit_feed_link',10,2);

/**
	Post Template
**/
function wpbandit_post_template($template) {
	global $post;
	$file = get_post_meta($post->ID, '_wp_post_template', TRUE);
	if ( $file && is_file(get_template_directory() . '/' . $file) )
		$template = get_template_directory() . '/' . $file;
	return $template;
}
add_filter('single_template','wpbandit_post_template');

/**
	Content More
**/
function wpbandit_the_content_more_link($more_link,$more_link_text) {
	// Set replacement text
	$text = Air::get_option('read-more',$more_link_text);
	// Return more link
	return str_replace($more_link_text, $text, $more_link);
}
add_filter('the_content_more_link','wpbandit_the_content_more_link',10,2);

/**
	Excerpt More
**/
function wpbandit_excerpt_more($more) {
	return Air::get_option('excerpt-more',$more);
}
add_filter('excerpt_more','wpbandit_excerpt_more');

/**
	Excerpt Length
**/
function wpbandit_excerpt_length($length) {
	return Air::get_option('excerpt-length',$length);
}
add_filter('excerpt_length','wpbandit_excerpt_length',999);

/**
	Fix empty tags in shortcodes
**/
function wpbandit_shortcode_empty_tags_fix($content) {
	$array = array (
		'<p>['		=> '[', 
		']</p>'		=> ']', 
		']<br />'	=> ']'
	);
	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content','wpbandit_shortcode_empty_tags_fix');

/**
	Add shortcode support to text widget
**/
add_filter('widget_text','do_shortcode');

/**
	Add embed support to wpb video widget
**/
$wp_embed = new WP_Embed;
add_filter('wpb_widget_video_url', array($wp_embed,'run_shortcode'), 8);
add_filter('wpb_widget_video_url', array($wp_embed,'autoembed'), 8); 

/**
	Add wmode transparent to media embeds
**/
function wpbandit_video_wmode_transparent($html, $url, $attr) {
	if ( strpos( $html, "<embed src=" ) !== false ) {
		$html = str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html);
	} elseif ( strpos ($html, 'feature=oembed') !== false ) {
		$html = str_replace('feature=oembed', 'feature=oembed&wmode=opaque', $html);
	}
	return $html;
}
add_filter('embed_oembed_html','wpbandit_video_wmode_transparent',10,3);
