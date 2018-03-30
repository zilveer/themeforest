<?php

// Help functions

// login page
include('tb_login.php');

// enqueue
include('tb_enqueue.php');

// comments
include('tb_comments.php');

// Get Pages (default type: page; change it if you want to pull some other type of content)
function tb_get_pages($type = "page") {
	$tbPages = get_posts(array(
		'post_type' => $type,
		'posts_per_page' => '-1',
		'orderby' => 'title',
		'order' => 'ASC'
	));
	
	return $tbPages;
}

// Get Categories (default type: category; change it if you want to pull some other taxonomy)
function tb_get_categories($type = "category") {
	$tbCategories = get_categories(array(
		'taxonomy' => $type,
		'hide_empty' => 0,
		'orderby' => 'name',
		'order' => 'ASC'
	));
	
	return $tbCategories;
}

// Get description
function tb_get_description($id) {
	$desc = get_post_meta($id, '_description', true);
	if (!$desc) {
		$item = get_post($id);
		$desc = tb_max_words(stripslashes(strip_tags(strip_shortcodes($item->post_content))), 30);
	}
	
	return $desc;
}

// Get Logo (default position: header; other value: footer)
function tb_get_logo($position = 'header') {
	
	$optionValue = 'tb_logo';
	$defaultValue = DEFAULT_LOGO;
	
	if ($position == 'landing') {
		$optionValue = 'tb_footer_logo';
		$defaultValue = DEFAULT_LANDING_LOGO;
	}
	
	$logo = get_option($optionValue);
	
	if (!trim($logo)) {$logo = $defaultValue;}
	
	return $logo;
}

// Get thumbnail (dimension can be string value: thumbnail, medium, large, ...; or int value: it will be used for square image)
function tb_get_thumbnail($id, $dimension = array(50, 50), $class = '', $default = '') {	
	if ($class) {
		$postThumbnail = get_the_post_thumbnail($id, $dimension, array('class' => $class, 'title' => ''));
	} else {
		$postThumbnail = get_the_post_thumbnail($id, $dimension, array('title' => ''));
	}
	
	if (!$postThumbnail && $default) {$postThumbnail = '<img src="' . $default . '" alt="' . get_bloginfo('name') . ' thumbnail">';}
	
	return $postThumbnail;
}

// Get copyright
function tb_copyright() {
	$defaultCopyright = DEFAULT_COPYRIGHT;
	$copyright = get_option('tb_footer_copyright');
	
	if (!trim($copyright)) {$copyright = $defaultCopyright;}
	
	$copyright = stripslashes($copyright);
	
	return $copyright;
}

// default navigation function
function tb_default_navigation()
{
	$homeClass = "";
	if (is_home()){$homeClass = "class='current-menu-item'";} 
	
	echo '<ul class="navigation">';
	echo '<li ' . $homeClass . '><a href="' . home_url() . '" title="' . get_option('blogname') . '">Home</a></li>';
	wp_list_pages('title_li=');
	echo '</ul>';
}

// Max words
function tb_max_words($string, $number) {  
	$text = strip_tags($string);  
	$words = preg_split("/\s+/", $text, $number + 1);  
	if (count($words) > $number) { unset($words[$number]); }  
	$output = join(' ', $words);  
	
	return $output;  
} 

// Get link
function tb_write_link($option) {
	if ($option) {
		echo get_permalink(get_option($option));
	} else {
		return FALSE;
	}
}

// Output shortcode
function tb_write_shortcode($shortcode) {
	echo do_shortcode($shortcode);
}

// Excerpt
function tb_excerpt_length() {
	return 50;
}
add_filter('excerpt_length', 'tb_excerpt_length');

// Excerpt more
function tb_excerpt_more() {
	return "... ";
}
add_filter('excerpt_more', 'tb_excerpt_more');

// Backgrounds
function tb_write_bckg($position = 'header') {
	if ($position == 'navigation') {
		$bckg = get_option('tb_navigation_bckg', DEFAULT_NAVIGATION_BCKG);
	} elseif ($position == 'buttons') {
		$bckg = get_option('tb_button_style', DEFAULT_BUTTONS);
	} elseif ($position == 'buttonsExtra') {
		$bckg = 'extra-' . get_option('tb_button_extra_style', DEFAULT_BUTTONS_EXTRA);
	} elseif ($position == 'sidebar') {
		$bckg = 'sidebar-' . get_option('tb_sidebar_style', DEFAULT_SIDEBAR_BCKG);
	} elseif ($position == 'landing') {
		$headerColor = get_option('tb_landing_bgcolor', DEFAULT_LANDING_BGCOLOR);
		$headerImage = get_option('tb_landing_bckg_image', DEFAULT_LANDING_BCKG_IMAGE);
		$bckg = 'style="background-image: url(\'' . $headerImage . '\'); background-color: ' . $headerColor . ';"';
	} else {
		$headerColor = get_option('tb_header_bckg_color', DEFAULT_HEADER_BCKG_COLOR);
		$headerImage = get_option('tb_header_bckg_image', DEFAULT_HEADER_BCKG_IMAGE);
		$bckg = 'style="background-image: url(\'' . $headerImage . '\'); background-color: ' . $headerColor . ';"';
	}
	
	
	echo $bckg;
}

// Main Image
function tb_get_main_image($imageID = 0, $shadow = 'default') {
	if ($imageID) {
		$imageSrc = wp_get_attachment_image_src($imageID, 'full');
		
		if ($imageSrc) {
			$mainImage = $imageSrc[0];
		} else {
			$mainImage = get_option('tb_main_bckg_image', DEFAULT_MAIN_BCKG_IMAGE);
		}
	} else {
		$mainImage = get_option('tb_main_bckg_image', DEFAULT_MAIN_BCKG_IMAGE);
	}
	
	if ($shadow == 'default') {
		$shadow = get_option('tb_main_bckg_shadow', DEFAULT_MAIN_BCKG_SHADOW);
	}
	
	$return = array();
	
	$return['mainImage'] = $mainImage;
	$return['mainShadow'] = $shadow;
	
	return $return;
}

// Sidebar position
function tb_get_sidebar_position($sidebar = 'default') {
	if ($sidebar != 'leftSidebar' && $sidebar != 'rightSidebar') $sidebar = get_option('tb_sidebar_position', DEFAULT_SIDEBAR_POSITION);
	
	return $sidebar;
}

// get date (yyyy-mm-dd)
function tb_get_date($date) {
	$dateArray = explode('-', $date);
	
	$return = array();
	$return['year'] = $dateArray[0];
	$return['month'] = $dateArray[1];
	$return['monthshort'] = date('M', mktime(0, 0, 0, $dateArray[1]));
	$return['monthname'] = date('F', mktime(0, 0, 0, $dateArray[1]));
	$return['day'] = $dateArray[2];
	$return['sufix'] = date('S', mktime(0, 0, 0, $dateArray[1], $dateArray[2]));
	
	return $return;
}

// get all php files from a folder
function tb_include_files($folder) {

	$folder = get_template_directory() . $folder;
	$tbIncludeFilesReturn = array();
	
	if ($handle = opendir($folder)) {
		while (false !== ($file = readdir($handle))) {
			if (strpos($file, 'php')) {
				$includeFile = $folder . $file;
				include $includeFile;
			}
		}
	
		closedir($handle);
		
		return $tbIncludeFilesReturn;
	}
}

// is shortcode registered
function is_shortcode_defined($shortcode) {
    global $shortcode_tags;
	
    if(isset($shortcode_tags[$shortcode])) {
		return TRUE;
	} else {
		return FALSE;
	}        
}

// get youtube id
// http://stackoverflow.com/questions/9594943/regex-pattern-to-get-the-youtube-video-id-from-any-youtube-url
function tb_get_youtube_id($url) {
	if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
		$values = $id[1];
	} else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
	 	$values = $id[1];
	} else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
	 	$values = $id[1];
	} else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
	 	$values = $id[1];
	} else {   
		$values = FALSE;
	}
	
	return $values;
}

// get youtube thumbnail
function tb_get_youtube_thumb($id) {
	return "http://img.youtube.com/vi/$id/hqdefault.jpg";
}

// get vimeo id
// http://stackoverflow.com/questions/10488943/easy-way-to-get-vimeo-id-from-a-vimeo-url
function tb_get_vimeo_id($url) {
	if (preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $url, $id)) {
		$values = $id[1];
	} else {
		$values = FALSE;
	}
	
	return $values;
}

// get vimeo thumbnail
// http://stackoverflow.com/questions/1361149/get-img-thumbnails-from-vimeo
function tb_get_vimeo_thumb($id) {
    $data = file_get_contents("http://vimeo.com/api/v2/video/$id.json");
    $data = json_decode($data);

	return $data[0]->thumbnail_large;
}

?>