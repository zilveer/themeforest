<?php
/** dt_theme_get_option()
 * Objective:
 *		To get my theme options stored in database by the thme option page at back end.
 **/
function dt_theme_option($key1, $key2 = '') {
	$options = get_option ( IAMD_THEME_SETTINGS );
	$output = NULL;

	if (is_array ( $options )) {

		if (array_key_exists ( $key1, $options )) {
			$output = $options [$key1];
			if (is_array ( $output ) && ! empty ( $key2 )) {
				$output = (array_key_exists ( $key2, $output ) && (! empty ( $output [$key2] ))) ? $output [$key2] : NULL;
			}
		} else {
			$output = $output;
		}
	}
	return $output;
}
// # --- **** dt_theme_option() *** --- ###

/**
 * dt_theme_default_option()
 * Objective:
 * To return my theme default options to store in database.
 */
function dt_theme_default_option() {
	$general = array (
			"logo" => "true",
			"breadcrumb-delimiter" => "default",
			"enable-favicon" => "true",
			"disable-page-comment" => "true",
			"disable-style-picker" => "on",
			"disable-custom-scroll" => "on",			
			"show-sociables" => "on",
			"show-footer" => "on",
			"footer-columns" => "4",
			"show-copyrighttext" => "on",
			"top-bar-phoneno" => "888-654-3210",
			"copyright-text" => '&copy; Copyright - Kids Zone - by<a href="http://themeforest.net/user/designthemes" title=""> Design Themes </a>'
	);

	$integration = array (
			"post-googleplus-layout" => "small",
			"post-googleplus-lang" => "en_GB",
			"post-twitter-layout" => "vertical",
			"post-fb_like-layout" => "box_count",
			"post-fb_like-color-scheme" => "light",
			"post-digg-layout" => "medium",
			"post-stumbleupon-layout" => "5",
			"post-linkedin-layout" => "2",
			"page-pintrest-layout" => "none",
			"page-googleplus-layout" => "small",
			"page-googleplus-lang" => "en_GB",
			"page-twitter-layout" => "vertical",
			"page-fb_like-layout" => "box_count",
			"page-fb_like-color-scheme" => "light",
			"page-digg-layout" => "medium",
			"page-stumbleupon-layout" => "5",
			"page-linkedin-layout" => "2",
			"page-pintrest-layout" => "none"
	);

	$specialty = array (
			"global-page-layout" => "content-full-width",
			"archives-layout" => "with-left-sidebar",
			"search-layout" => "with-left-sidebar",
			"404-layout" => "content-full-width",
			"404-message" => "<h2>The page you are looking for is not here!</h2><p>Sorry, the post you are looking for is not available. Maybe you want to perform a search?</p>"
	);

	$appearance = array (
			"H1-font" => "",
			"H2-font" => "",
			"H3-font" => "",
			"H4-font" => "",
			"H5-font" => "",
			"H6-font" => "",
			"menu-font" => "",
			"body-font" => "",
			"skin" => "ferngreen",
			"header_type" =>"header1",
			"layout" => "wide",
			"header-bg-type" => "bg-none",
			"body-bg-type" => "bg-none",
			"footer-bg-type" => "bg-none",
			"bg-type" => "bg-none",
			"boxed-layout-pattern" => "pattern11.png",
			"boxed-layout-pattern-repeat" => "repeat"
	);

	$mobile = array (
			"is-theme-responsive" => "true"
	);

	$seo = array (
			"title-delimiter" => "|",
			"post-title-format" => array (
					"blog_title",
					"post_title"
			),
			"page-title-format" => array (
					"blog_title",
					"post_title"
			),
			"archive-page-title-format" => array (
					"blog_title",
					"date"
			),
			"category-page-title-format" => array (
					"blog_title",
					"category_title"
			),
			"tag-page-title-format" => array (
					"blog_title",
					"tag"
			),
			"search-page-title-format" => array (
					"blog_title",
					"search"
			),
			"404-page-title-format" => array (
					"blog_title"
			)
	);

	$social = array (
			'social-1' => array( 'icon' => 'fa-facebook', 'link' => '#'),
			'social-2' => array( 'icon' => 'fa-twitter', 'link' => '#'),
			'social-3' => array( 'icon' => 'fa-flickr', 'link' => '#'),
			'social-4' => array( 'icon' => 'fa-youtube', 'link' => '#'),
			'social-5' => array( 'icon' => 'fa-pinterest', 'link' => '#'));

	$pagebuilder = array (
		'post-types' => array( 'page' => 'page' ),
		'enable-pagebuilder' => false
	);

	$data = array (
			"general" => $general,
			"specialty" => $specialty,
			"integration" => $integration,
			"appearance" => $appearance,
			"seo" => $seo,
			"mobile" => $mobile,
			"social" => $social,
			"pagebuilder" => $pagebuilder
	);
	return $data;
}
// # --- **** dt_theme_default_option() *** --- ###

/** dt_theme_adminpanel_tooltip()
 * Objective:
 *		To place tooltip content in thme option page at back end.
 * args:
 *		1. $tooltip = content which is shown as tooltip
 **/
function dt_theme_adminpanel_tooltip($tooltip) {
	$output = "<div class='bpanel-option-help'>\n";
	$output .= "<a href='' title=''> <img src='" . IAMD_FW_URL . "theme_options/images/help.png' alt='' title='' /> </a>\n";
	$output .= "\r<div class='bpanel-option-help-tooltip'>\n";
	$output .= $tooltip;
	$output .= "\r</div>\n";
	$output .= "</div>\n";
	echo $output;
}
// # --- **** dt_theme_adminpanel_tooltip() *** --- ###

/**
 * dt_theme_adminpanel_image_preview()
 * Objective:
 * To place tooltip content in thme option page at back end.
 * args:
 * 1. $src = image source
 * 2. $backend = true - to get images placed in framework ? false - to get images stored in theme/images folder
 */
function dt_theme_adminpanel_image_preview($src, $backend = true, $default = "no-image.jpg") {
	$default = ($backend) ? IAMD_FW_URL . "theme_options/images/" . $default : IAMD_BASE_URL . "images/" . $default;
	$src = ! empty ( $src ) ? $src : $default;
	$output = "<div class='bpanel-option-help'>\n";
	$output .= "<a href='' title='' class='a_image_preivew'> <img src='" . IAMD_FW_URL . "theme_options/images/image-preview.png' alt='' title='' /> </a>\n";
	$output .= "\r<div class='bpanel-option-help-tooltip imagepreview'>\n";
	$output .= "\r<img src='{$src}' data-default='{$default}'/>";
	$output .= "\r</div>\n";
	$output .= "</div>\n";
	echo $output;
}
// # --- **** dt_theme_adminpanel_image_preview() *** --- ###

/**
 * dt_theme_pagelist()
 * Objective:
 * To create dropdown box with list of pages.
 * args:
 * 1. $id = page id
 * 2. $selected = ( true / false)
 */
function dt_theme_postlist($id, $selected, $class = "mytheme_select") {
	global $post;
	$args = array (
			'numberposts' => - 1 
	);
	
	$name = explode ( ",", $id );
	if (count ( $name ) > 1) {
		$name = "[{$name[0]}][{$name[1]}]";
	} else {
		$name = "[{$name[0]}]";
	}
	$name = ($class == "multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";
	$output = "<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>" . __ ( 'Select Post', 'iamd_text_domain' ) . "</option>";
	$posts = get_posts ( $args );
	foreach ( $posts as $post ) :
		$id = esc_attr ( $post->ID );
		$title = esc_html ( $post->post_title );
		$output .= "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
	endforeach
	;
	$output .= "</select>\n";
	echo $output;
}
// # --- **** dt_theme_postlist() *** --- ###

/**
 * dt_theme_productlist()
 * Objective:
 * To create dropdown box with list of products.
 * args:
 * 1. $id = page id
 * 2. $selected = ( true / false)
 */
function dt_theme_productlist($id, $selected, $class = "mytheme_select") {
	global $post;
	$args = array (
			'numberposts' => - 1,
			'post_type' => 'product' 
	);
	
	$name = explode ( ",", $id );
	if (count ( $name ) > 1) {
		$name = "[{$name[0]}][{$name[1]}]";
	} else {
		$name = "[{$name[0]}]";
	}
	$name = ($class == "multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";
	$output = "<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>" . __ ( 'Select Product', 'iamd_text_domain' ) . "</option>";
	$posts = get_posts ( $args );
	foreach ( $posts as $post ) :
		$id = esc_attr ( $post->ID );
		$title = esc_html ( $post->post_title );
		$output .= "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
	endforeach
	;
	$output .= "</select>\n";
	echo $output;
}
// # --- **** dt_theme_productlist() *** --- ###

function dt_theme_product_taxonomy_list($id, $selected = '', $class = "mytheme_select", $taxonomy) {
	$name = explode ( ",", $id );
	if (count ( $name ) > 1) {
		$name = "[{$name[0]}][{$name[1]}]";
	} else {
		$name = "[{$name[0]}]";
	}
	$name = ($class == "multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";
	$output = "<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>" . __ ( 'Select', 'iamd_text_domain' ) . "</option>";
	$cats = get_categories ( "taxonomy={$taxonomy}&hide_empty=0" );
	
	foreach ( $cats as $cat ) :
		$id = esc_attr ( $cat->term_id );
		$title = esc_html ( $cat->name );
		$output .= "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
	endforeach
	;
	$output .= "</select>\n";
	
	return $output;
}

/**
 * dt_theme_pagelist()
 * Objective:
 * To create dropdown box with list of pages.
 * args:
 * 1. $id = page id
 * 2. $selected = ( true / false)
 */
function dt_theme_pagelist($id, $selected, $class = "mytheme_select") {
	$name = explode ( ",", $id );
	if (count ( $name ) > 1) {
		$name = "[{$name[0]}][{$name[1]}]";
	} else {
		$name = "[{$name[0]}]";
	}
	$name = ($class == "multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";
	$output = "<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>" . __ ( 'Select Page', 'iamd_text_domain' ) . "</option>";
	$pages = get_pages ( 'title_li=&orderby=name' );
	foreach ( $pages as $page ) :
		$id = esc_attr ( $page->ID );
		$title = esc_html ( $page->post_title );
		$output .= "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
	endforeach
	;
	$output .= "</select>\n";
	echo $output;
}
// # --- **** dt_theme_pagelist() *** --- ###

/**
 * dt_theme_categorylist()
 * Objective:
 * To create dropdown box with list of categories.
 * args:
 * 1. $id = dropdown id
 * 2. $selected = ( true / false)
 * 3. $class = default class
 */
function dt_theme_categorylist($id, $selected = '', $class = "mytheme_select") {
	$name = explode ( ",", $id );
	if (count ( $name ) > 1) {
		$name = "[{$name[0]}][{$name[1]}]";
	} else {
		$name = "[{$name[0]}]";
	}
	$name = ($class == "multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";
	$output = "<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>" . __ ( 'Select Category', 'iamd_text_domain' ) . "</option>";
	$cats = get_categories ( 'orderby=name&hide_empty=0' );
	foreach ( $cats as $cat ) :
		$id = esc_attr ( $cat->term_id );
		$title = esc_html ( $cat->name );
		$output .= "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
	endforeach
	;
	$output .= "</select>\n";
	return $output;
}

// # --- **** dt_theme_gallery_categorylist() *** --- ###
function dt_theme_gallery_categorylist($id, $selected = '', $class = "mytheme_select") {
	$name = explode ( ",", $id );
	if (count ( $name ) > 1) {
		$name = "[{$name[0]}][{$name[1]}]";
	} else {
		$name = "[{$name[0]}]";
	}
	$name = ($class == "multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";
	$output = "<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>" . __ ( 'Select Category', 'iamd_text_domain' ) . "</option>";
	$cats = get_categories ( 'taxonomy=gallery_entries&hide_empty=0' );
	foreach ( $cats as $cat ) :
		@$id = esc_attr ( $cat->term_id );
		@$title = esc_html ( $cat->name );
		@$output .= "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
	endforeach
	;
	$output .= "</select>\n";
	return $output;
}

/**
 * dt_theme_listImage()
 * Args:
 * 1.
 * $dir = location of the folder from which you wnat to get images
 * Objective:
 * Returns an array that contains icon names located at $dir.
 */
function dt_theme_listImage($dir) {

	$sociables = array ();
	$icon_types = array (
			'jpg',
			'jpeg',
			'gif',
			'png' 
	);
	
	if (is_dir ( $dir )) {
		$handle = opendir ( $dir );
		while ( false !== ($dirname = readdir ( $handle )) ) {
			
			if ($dirname != "." && $dirname != "..") {
				$parts = explode ( '.', $dirname );
				$ext = strtolower ( $parts [count ( $parts ) - 1] );
				
				if (in_array ( $ext, $icon_types )) {
					$option = $parts [count ( $parts ) - 2];
					$sociables [$dirname] = str_replace ( ' ', '', $option );
				}
			}
		}
		closedir ( $handle );
	}
	
	return $sociables;
}
// # --- **** dt_theme_listImage() *** --- ###

//Starting list of social image
function dt_theme_listSocial() {
	$sociables = array('fa-dribbble' => 'Dribble', 'fa-flickr' => 'Flickr', 'fa-github' => 'GitHub', 'fa-pinterest' => 'Pinterest', 'fa-stack-overflow' => 'Stack Overflow', 'fa-twitter' => 'Twitter', 'fa-youtube' => 'YouTube', 'fa-android' => 'Android', 'fa-dropbox' => 'Dropbox', 'fa-instagram' => 'Instagram', 'fa-windows' => 'Windows', 'fa-apple' => 'Apple', 'fa-facebook' => 'Facebook', 'fa-google-plus' => 'Google Plus', 'fa-linkedin' => 'LinkedIn', 'fa-skype' => 'Skype', 'fa-tumblr' => 'Tumblr', 'fa-vimeo-square' => 'Vimeo');
	
	return $sociables;
}
//End list of social image

/**
 * dt_theme_sociables_selection()
 * Objective:
 * Returns selection box.
 */
function dt_theme_sociables_selection($name = '', $selected = "") {
	$sociables = dt_theme_listSocial();
	$name = ! empty ( $name ) ? "name='mytheme[social][{$name}][icon]'" : '';
	$out = "<select class='social-select' {$name}>"; // ame attribute will be added to this by jQuery menuAdd()
	foreach ( $sociables as $key => $value ) :
		$s = selected ( $key, $selected, false );
		$v = ucwords ( $value );
		$out .= "<option value='{$key}' {$s} >{$v}</option>";
	endforeach
	;
	$out .= "</select>";
	return $out;
}
// # --- **** dt_theme_sociables_selection() *** --- ###

/**
 * dt_theme_admin_color_picker()
 * Objective:
 * Outputs the wordpress default color picker.
 * Args:
 * 1.Label
 * 2.Name
 * 3.Value - stored in db
 * 4.Tooltip
 */
function dt_theme_admin_color_picker($label, $name, $value, $tooltip = NULL) {
	global $wp_version;
	
	$output = "<div class='bpanel-option-set'>\n";
	if (! empty ( $label )) :
		$output .= "<label>{$label}</label>";
		$output .= "<div class='clear'></div>";
	
	endif;
	
	if (( float ) $wp_version >= 3.5) :
		$output .= "<input type='text' class='my-color-field medium' name='{$name}' value='{$value}' />";
	 else :
		$output .= "<input type='text' class='medium color_picker_element' name='{$name}' value='{$value}' />";
		$output .= "<div class='color_picker'></div>";
	endif;
	echo $output;
	if ($tooltip != NULL) :
		dt_theme_adminpanel_tooltip ( $tooltip );
	
	endif;
	echo "</div>\n";
}
// # --- **** dt_theme_admin_color_picker() *** --- ###

/**
 * dt_theme_admin_fonts()
 * Objective:
 * Outputs the fonts selection box.
 */
function dt_theme_admin_fonts($label, $name, $selctedFont) {
	global $dt_google_fonts;
	$f = IAMD_SAMPLE_FONT;
	$css = (! empty ( $selctedFont )) ? 'style="font-family:' . $selctedFont . ';"' : '';
	$output = "<div class='mytheme-font-preview' {$css}>{$f}</div>";
	$output .= "<label>{$label}</label>";
	$output .= "<div class='clear'></div>";
	$output .= "<select class='mytheme-font-family-selector' name='{$name}'>";
	$output .= "<option value=''>" . __ ( "Select", 'iamd_text_domain' ) . "</option>";
	foreach ( $dt_google_fonts as $fonts ) :
		$rs = selected ( $fonts, $selctedFont, false );
		$output .= "<option value='{$fonts}' {$rs}>{$fonts}</option>";
	endforeach
	;
	$output .= "</select>";
	echo $output;
}
// # --- **** dt_theme_admin_fonts() *** --- ###

/**
 * dt_theme_admin_jqueryuislider()
 * Objective:
 * Outputs the jQurey UI Slider.
 */
function dt_theme_admin_jqueryuislider($label, $id = '', $value = '', $px = "px") {
	$div_value = (! empty ( $value ) && ($px == "px")) ? $value . "px" : $value;
	$output = "<label>{$label}</label>";
	$output .= "<div class='clear'></div>";
	$output .= "<div id='{$id}' class='mytheme-slider' data-for='{$px}'></div>";
	$output .= "<input type='hidden' class='' name='{$id}' value='{$value}'/>";
	$output .= "<div class='mytheme-slider-txt'>{$div_value}</div>";
	echo $output;
}
// # --- **** dt_theme_admin_jqueryuislider() *** --- ###

/**
 * getFolders()
 * Objective:
 */
function getFolders($directory, $starting_with = "", $sorting_order = 0) {
	if (! is_dir ( $directory ))
		return false;
	$dirs = array ();
	$handle = opendir ( $directory );
	while ( false !== ($dirname = readdir ( $handle )) ) {
		if ($dirname != "." && $dirname != ".." && is_dir ( $directory . "/" . $dirname )) {
			if ($starting_with == "")
				$dirs [] = $dirname;
			else {
				$filter = strstr ( $dirname, $starting_with );
				if ($filter !== false)
					$dirs [] = $dirname;
			}
		}
	}
	
	closedir ( $handle );
	
	if ($sorting_order == 1) {
		rsort ( $dirs );
	} else {
		sort ( $dirs );
	}
	return $dirs;
}
// # --- **** getFolders() *** --- ###

/**
 * dt_theme_switch()
 * Objective:
 * Outputs the switch control at the backend.
 */
function dt_theme_switch($label, $parent, $name) {
	$checked = ("true" == dt_theme_option ( $parent, $name )) ? ' checked="checked"' : '';
	$switchclass = ("true" == dt_theme_option ( $parent, $name )) ? 'checkbox-switch-on' : 'checkbox-switch-off';
	$out = "<div data-for='mytheme-{$parent}-{$name}' class='checkbox-switch {$switchclass}'></div>";
	$out .= "<input id='mytheme-{$parent}-{$name}' class='hidden' name='mytheme[{$parent}][{$name}]' type='checkbox' value='true' {$checked} />";
	echo $out;
}
// # --- **** dt_theme_switch() *** --- ###

/**
 * dt_theme_switch()
 * Objective:
 * Outputs the switch control at the backend.
 */
function dt_theme_switch_page($label, $name, $value, $datafor = NULL) {
	$checked = ("true" == $value) ? ' checked="checked"' : '';
	$switchclass = ("true" == $value) ? 'checkbox-switch-on' : 'checkbox-switch-off';
	$datafor = ($datafor == NULL) ? $name : $datafor;
	$out = "<label>{$label}</label>";
	$out .= '<div class="clear"></div>';
	$out .= "<div data-for='{$datafor}' class='checkbox-switch {$switchclass}'></div>";
	$out .= "<input id='{$datafor}' class='hidden' name='{$name}' type='checkbox' value='true' {$checked} />";
	
	echo $out;
}
// # --- **** dt_theme_switch() *** --- ###

/**
 * dt_theme_bgtypes()
 * Objective:
 * Outputs the <select></select> control at the backend.
 */
function dt_theme_bgtypes($name, $parent, $child) {
	$args = array (
			"bg-patterns" => __ ( "Pattern", 'iamd_text_domain' ),
			"bg-custom" => __ ( "Custom Background", 'iamd_text_domain' ),
			"bg-none" => __ ( "None", 'iamd_text_domain' ) 
	);
	$out = '<div class="bpanel-option-set">';
	$out .= "<label>" . __ ( "Background Type", 'iamd_text_domain' ) . "</label>";
	$out .= "<div class='clear'></div>";
	$out .= "<select class='bg-type' name='{$name}'>";
	foreach ( $args as $k => $v ) :
		$rs = selected ( $k, dt_theme_option ( $parent, $child ), false );
		$out .= "<option value='{$k}' {$rs}>{$v}</option>";
	endforeach
	;
	$out .= "</select>";
	$out .= '</div>';
	echo $out;
}
### --- ****  dt_theme_bgtypes() *** --- ###

function dt_theme_standard_font($label, $name, $selectedFont ){
	$fonts = array("Arial","Verdana, Geneva","Trebuchet","Georgia","Times New Roman","Tahoma, Geneva","Palatino","Helvetica");
	$output = "<label>{$label}</label>";
	$output .= "<div class='clear'></div>";
	$output .= "<select class='mytheme-select' name='{$name}'>";
	$output .= "<option value=''>" . __ ( "Select", 'iamd_text_domain' ) . "</option>";
	foreach ( $fonts as $font ) {
		$rs = selected ( $font, $selectedFont, false );
		$output .= "<option value='{$font}' {$rs}>{$font}</option>";
	}
	$output .= "</select>";
	echo $output;
}

function dt_theme_standard_font_style($label, $name, $selectedFontStyle) {
	$styles = array("Normal","Italic","Bold","Bold Italic");
	$output = "<label>{$label}</label>";
	$output .= "<div class='clear'></div>";
	$output .= "<select class='mytheme-select' name='{$name}'>";
	$output .= "<option value=''>" . __ ( "Select", 'iamd_text_domain' ) . "</option>";
	foreach ( $styles as $style ) {
		$rs = selected ( $style, $selectedFontStyle, false );
		$output .= "<option value='{$style}' {$rs}>{$style}</option>";
	}
	$output .= "</select>";
	echo $output;
}

function dt_theme_custom_widgetarea_list( $id, $selected = "", $class="mytheme_select") {
	$name = explode ( ",", $id );
	if (count ( $name ) > 1) {
		$name = "[{$name[0]}][{$name[1]}]";
	} else {
		$name = "[{$name[0]}]";
	}

	$name = ($class == "multidropdown") ? "mytheme{$name}[]" : "mytheme{$name}";

	$widgets = dt_theme_option('widgetarea','custom');
    $widgets = is_array($widgets) ? array_unique($widgets) : array();
    $widgets = array_filter($widgets);

	$output = "<select name='{$name}' class='{$class}'>";
	$output .= "<option value=''>" . __ ( 'Select Widget Area', 'iamd_text_domain' ) . "</option>";
	foreach( $widgets as $widget){
		$id = mb_convert_case($widget, MB_CASE_LOWER, "UTF-8");
    	$id = str_replace(" ", "-", $id);
    	$output .= "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$widget}</option>";
	}
	$output .= "</select>\n";
	return $output;
}