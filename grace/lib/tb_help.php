<?php
// help functions

// default value
function tb_default($value, $default) {
	if (isset($value)) {
		return $value;
	} else {
		return $default;
	}
}

// return style
function tb_return_style($style) {
	if ($style == 'normal' || $style == 'bold') echo 'font-weight:' . $style . ';';			
	if ($style == 'normal') echo 'font-style:' . $style . ';';			
	if ($style == 'italic') echo 'font-style:' . $style . ';';			
	if ($style == 'bold-italic') {
		echo 'font-weight: bold;';
		echo 'font-style: italic;';
	}
	
	return FALSE;
}

// Get custom made sidebars
function tb_get_custom_sidebars($nosidebar = 0, $options = 0) {
	global $wp_registered_sidebars;
	
	$custom_sidebars_option = get_option('sbg_sidebars');
	
	$returnArray = array();
	
	if ($options) {		
		foreach($wp_registered_sidebars as $sidebar) {
			$returnArray[$sidebar['id']] = ucwords($sidebar['name']);
		}				
	} else {
		if (!$nosidebar) {
			$returnArray[] = array( 'name' => 'Please choose', 'value' => '0' );	
		} else {
			$returnArray[] = array( 'name' => 'Just a basic info...', 'value' => '0' );
		}
		
		
		foreach($wp_registered_sidebars as $sidebar) {
			$returnArray[] = array( 'name' => ucwords($sidebar['name']), 'value' => $sidebar['id'] );
		}		
	}
	
	
	return $returnArray;
	
}

// Get Pages (default type: page; change it if you want to pull some other type of content)
function tb_get_pages($type = "page", $area = 'cf') {
	$tbPagesQ = get_posts(array(
		'post_type' => $type,
		'posts_per_page' => '-1',
		'orderby' => 'title',
		'order' => 'ASC'
	));
	
	$tbPages = array();
	
	if ($area == 'cf') {
		$tbPages[] = array('name' => 'Please choose...', 'value' => 0);
		
		foreach ($tbPagesQ as $tbPage) {
			$tbPages[] = array(
				'name'	=>	$tbPage->post_title,
				'value'	=>	$tbPage->ID
			);
		}		
	} else {
		$tbPages[0] = 'Please choose...';
		
		foreach ($tbPagesQ as $tbPage) {
			$tbPages[$tbPage->ID] = $tbPage->post_title;
		}		
	}
	
	return $tbPages;
}

// Get Categories (default type: category;)
function tb_get_categories($type = "category", $area = 'cf') {
	$tbCategoriesQ = get_categories(array(
		'taxonomy' => $type,
		'hide_empty' => 0,
		'orderby' => 'name',
		'order' => 'ASC'
	));
	
	$tbCategories = array();
	
	if ($area == 'cf') {
		$tbCategories[] = array('name' => 'Please choose...', 'value' => 0);
		
		foreach ($tbCategoriesQ as $tbCategory) {
			$tbCategories[] = array(
				'name'	=>	$tbCategory->name,
				'value'	=>	$tbCategory->term_id
			);
		}		
	} else {
		$tbCategories[0] = 'Please choose...';
		
		foreach ($tbCategoriesQ as $tbCategory) {
			$tbCategories[$tbCategory->term_id] = $tbCategory->name;
		}		
	}
	
	return $tbCategories;
}

// Get Menu Name/Slug.
// http://www.andrewgail.com/getting-a-menu-name-in-wordpress/
function ag_get_theme_menu( $theme_location ) {
	if( ! $theme_location ) return false;
 
	$theme_locations = get_nav_menu_locations();
	if( ! isset( $theme_locations[$theme_location] ) ) return false;
 
	$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
	if( ! $menu_obj ) $menu_obj = false;
 
	return $menu_obj;
}

function ag_get_theme_menu_name( $theme_location ) {
	if( ! $theme_location ) return false;
 
	$menu_obj = ag_get_theme_menu( $theme_location );
	if( ! $menu_obj ) return false;
 
	if( ! isset( $menu_obj->name ) ) return false;
 
	return $menu_obj->name;
}

function ag_get_theme_menu_slug( $theme_location ) {
	if( ! $theme_location ) return false;
 
	$menu_obj = ag_get_theme_menu( $theme_location );
	if( ! $menu_obj ) return false;
 
	if( ! isset( $menu_obj->slug ) ) return false;
 
	return $menu_obj->slug;
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

// include all (or specific extension) files from a folder
function tb_include_files($folder, $extension = 'php') {

	$folder = PARENT_DIR . $folder;
	
	if ($handle = opendir($folder)) {
		while (false !== ($file = readdir($handle))) {
			if ($extension != 'all') {
				if (strpos($file, $extension)) {
					$includeFile = $folder . $file;
					include $includeFile;
				}
			} else {
				$includeFile = $folder . $file;
				include $includeFile;
			}
		}
	
		closedir($handle);
		
		return TRUE;
	} else {
		return FALSE;
	}
}

// use files from folder
function tb_use_files($folder) {

	$folderURL = PARENT_URL . $folder;
	$folder = PARENT_DIR . $folder;
	

	if ($handle = opendir($folder)) {
		$tb_return = array();
	
		while (false !== ($file = readdir($handle))) {
			if (($file == ".") || ($file == "..")) continue;
		
			$fileNiceName = ucwords(str_replace(array('_', '-'), ' ', substr($file, 0, strlen($file) - 4)));
			$tb_return[$folderURL . $file] = $fileNiceName;
		}
	
		closedir($handle);
		
		return $tb_return;
	} else {
		return FALSE;
	}
}

// output social profile button
function tb_social_button($href, $type) {
	if ($type == 'email') {
		$href = 'mailto:' . $href;
		$icon = 'icon-mail';
		return '<a href="' . $href . '" class="widget-icon"><span class="' . $icon . '" aria-hidden="true"></span></a>';
	} elseif ($type == 'phone') {
		$icon = 'icon-' . $type;
		return '<a class="contactInfo" id="phoneNumbersTrigger"><span class="' . $icon . '" aria-hidden="true"></span></a>';
	} else {
		$href = esc_url($href);
		$icon = 'icon-' . $type;
		return '<a href="' . $href . '" class="widget-icon"><span class="' . $icon . '" aria-hidden="true"></span></a>';
	}	
}

// google map
function tb_google_map($url, $type = 'm', $zoom = 12, $height = 200) {
	if ($url) {
		$iframe = '<iframe width="100%" height="' . $height . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $url . '&amp;t=' . $type . '&amp;z=' . $zoom . '&amp;output=embed"></iframe>';
		return $iframe;
	} else {
		return FALSE;
	}
}


// Max words
function tb_max_words($string, $number) {  
	$text = strip_tags($string);  
	$words = preg_split("/\s+/", $text, $number + 1);  
	if (count($words) > $number) { unset($words[$number]); }  
	$output = join(' ', $words);  
	
	return $output;  
}

// Get image path
if (!function_exists('get_image_path'))  {
function get_image_path() {
	global $post;
	$id = get_post_thumbnail_id();
	
	// check to see if NextGen Gallery is present
	if(stripos($id,'ngg-') !== false && class_exists('nggdb')){
		$nggImage = nggdb::find_image(str_replace('ngg-','',$id));
		$thumbnail = array(
		$nggImage->imageURL,
		$nggImage->width,
		$nggImage->height
	);
	// otherwise, just get the wp thumbnail
	} else {
		$thumbnail = wp_get_attachment_image_src($id,'full', true);
	}
	
	$theimage = $thumbnail[0];
	return $theimage;
}
}

/************************************************************************************/
/* ADJUST BRIGHTNESS
/************************************************************************************/
function adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Format the hex color string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));  
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#'.$r_hex.$g_hex.$b_hex;
}

/************************************************************************************/
/* REVOLUTION SLIDER
/************************************************************************************/
function tb_get_rev_sliders() {
	global $wpdb;
	
	$dbprefix = $wpdb->prefix;
	$rstable = $dbprefix . 'revslider_sliders';
	
	$revSliders = array();
	
	$revSliders[] = array('name' => 'Choose slider', 'value' => 0);
	
	$qRevSliders = $wpdb->get_results("SELECT title, alias FROM $rstable ORDER BY title");
	
	foreach ($qRevSliders as $slider) {
		$revSliders[] = array(
			'name' 	=> $slider->title,
			'value'	=> $slider->alias
		);
	}
	
	return $revSliders;
}

function tb_get_rev_slider_settings($alias) {
	global $wpdb;
	
	$dbprefix = $wpdb->prefix;
	$rstable = $dbprefix . 'revslider_sliders';
	
	$results = $wpdb->get_results("SELECT params FROM $rstable WHERE alias = '$alias'");
	
	$slider = $results[0];
	$params = $slider->params;
	
	$decode_params = json_decode($params);
	
	return $decode_params;
}

?>