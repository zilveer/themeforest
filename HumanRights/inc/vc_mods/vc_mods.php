<?php
/**
 * Mods & Additions for Visual Compressor plugin
 *
 * @package js_composer
 */

/*------------------------------------------------------*/
/* REMOVE ELEMENTS
/*------------------------------------------------------*/

// Remove VC unwanted elements
add_action( 'admin_init', 'wpc_theme_remove_unwanted_vc_elements' );

// Remove VC unwanted elements
function wpc_theme_remove_unwanted_vc_elements() {

	// Array of unwanted elements to remove
	$remove_elements = array(
		'vc_wp_categories',
		'vc_wp_rss',
		'vc_wp_text',
		'vc_wp_meta',
		'vc_wp_recentcomments',
		'vc_wp_tagcloud',
		'vc_wp_archives',
		'vc_wp_calendar',
		'vc_wp_pages',
		'vc_wp_links',
		'vc_wp_posts',
		'vc_wp_search',
		'vc_wp_custommenu',
		'vc_cta_button',
		'vc_cta_button2',
		'vc_facebook',
		'vc_tweetmeme',
		'vc_googleplus',
		'vc_pinterest',
		'vc_flickr',
		'vc_progress_bar',
		'vc_pie',
		'vc_carousel',
		'vc_posts_slider',
		'vc_images_carousel',
		'vc_gallery',
		'vc_toggle'
	);

	// Apply filters for tweaking
	$remove_elements = apply_filters( 'wpc_theme_remove_vc_elements', $remove_elements );

	// Remove VC elements
	if ( is_array( $remove_elements ) ) {
		foreach ( $remove_elements as $remove_element ) {
			vc_remove_element( $remove_element );
		}
	}
}


/*------------------------------------------------------*/
/* ROW
/*------------------------------------------------------*/
vc_remove_param("vc_row", "gap");
vc_remove_param("vc_row", "columns_placement");
vc_remove_param("vc_row", "equal_height");
vc_remove_param("vc_row", "css");
vc_remove_param("vc_row", "font_color");
vc_remove_param("vc_row", "full_width");
vc_remove_param("vc_row", "el_class");
vc_remove_param("vc_row", "el_id");
vc_remove_param("vc_row", "parallax");
vc_remove_param("vc_row", "parallax_image");
vc_remove_param("vc_row", "full_height");
vc_remove_param("vc_row", "video_bg");
vc_remove_param("vc_row", "content_placement");
vc_remove_param("vc_row", "video_bg_url");
vc_remove_param("vc_row", "video_bg_parallax");
vc_remove_param("vc_row", "parallax_speed_video");
vc_remove_param("vc_row", "parallax_speed_bg");

vc_add_param("vc_row", array(
	"type"        => "textfield",
	"class"       => "",
	"heading"     => __("Row ID","js_composer"),
	"param_name"  => "row_id",
	"value"       => "",
	"description" => __("Put your row ID here. This can then be used to target the row with CSS or as an anchor point to scroll to when the relevant link is clicked.","js_composer"),
));

vc_add_param("vc_row", array(
	"type"       => "dropdown",
	"class"      => "",
	"heading"    => __("Row Type","js_composer"),
	"param_name" => "row_type",
	"value"      => array(
		__( "Center Content", "js_composer" )              => "row_center_content",
		__( "Full Width - Center Content", "js_composer" ) => "row_full_center_content",
		__( "Full Width Content", "js_composer" )          => "row_fullwidth_content",
	)
));


vc_add_param("vc_row", array(
	"type"        => "colorpicker",
	"class"       => "",
	"heading"     => __("Background Color","js_composer"),
	"param_name"  => "bg_color",
	"value"       => "",
	"description" => "",
	//"dependency"  => Array('element' => "row_style", 'value' => array('row_bg_color'))
));

vc_add_param("vc_row", array(
	"type"        => "checkbox",
	"class"       => "",
	"heading"     => __("Row Background Meta","js_composer"),
	"value"       => array( __("If you check this option, the row background color will inherit from meta color setting in theme option.","js_composer") => "false" ),
	"param_name"  => "row_meta_color",
	"description" => ""
));

// Backgroud Image : dependency by row_style
vc_add_param("vc_row", array(
	"type"        => "attach_image",
	"class"       => "",
	"heading"     => __("Background Image","js_composer"),
	"param_name"  => "bg_image",
	"value"       => "",
	"description" => "",
));
vc_add_param("vc_row", array(
	"type"       => "dropdown",
	"class"      => "",
	"heading"    => __("Background Position","js_composer"),
	"param_name" => "bg_position",
	"value"      => array(
		__("Left Top", "js_composer")      => "left top",
		__("Left Center", "js_composer")   => "left center",
		__("Left Bottom", "js_composer")   => "left bottom",
		__("Center Top", "js_composer")    => "center top",
		__("Center Center", "js_composer") => "center center",
		__("Center Bottom", "js_composer") => "center bottom",
		__("Right Top", "js_composer")     => "right top",
		__("Right Center", "js_composer")  => "right center",
		__("Right Bottom", "js_composer")  => "right bottom"
	),
));
vc_add_param("vc_row", array(
	"type"       => "dropdown",
	"class"      => "",
	"heading"    => __("Background Repeat", "js_composer"),
	"param_name" => "bg_repeat",
	"value"      => array(
		__("No Repeat", "js_composer") => "no-repeat",
		__("Repeat", "js_composer")    => "repeat"
	),
));

vc_add_param("vc_row", array(
	"type"       => "dropdown",
	"class"      => "",
	"heading"    => __("Background Size", "js_composer"),
	"param_name" => "bg_size",
	"value"      => array(
		__("Inherit", "js_composer") => "inherit",
		__("Cover", "js_composer")   => "cover",
		__("Contain", "js_composer") => "contain"
	),
));


vc_add_param("vc_row", array(
	"type"        => "checkbox",
	"class"       => "",
	"heading"     => __("Enable Parallax Style","js_composer"),
	"value"       => array( __("Enable? (Parallax working with background image).","js_composer") => "false" ),
	"param_name"  => "row_parallax",
	"description" => ""
));


vc_add_param("vc_row", array(
	"type"        => "checkbox",
	"class"       => "",
	"heading"     => __("Video Background","js_composer"),
	"value"       => array( __("Enable Video Background?","js_composer") => "use_video" ),
	"param_name"  => "row_video_bg",
	"description" => ""
));

// Video Background
vc_add_param("vc_row", array(
	"type"        => "textfield",
	"heading"     => __("MP4 File URL", "js_composer"),
	"param_name"  => "bg_video_mp4",
	"value"       => "",
	"description" => __("Enter the URL for your .mp4 video file here to create a video background for this row.", "js_composer"),
	"dependency"  => Array('element' => "row_video_bg", 'value' => array('use_video'))
));
vc_add_param("vc_row", array(
	"type"        => "textfield",
	"heading"     => __("OGV File URL", "js_composer"),
	"param_name"  => "bg_video_ogv",
	"value"       => "",
	"description" => __("Enter the URL for your .ogv video file here to create a video background for this row.", "js_composer"),
	"dependency"  => Array('element' => "row_video_bg", 'value' => array('use_video'))
));
vc_add_param("vc_row", array(
	"type"        => "textfield",
	"heading"     => __("WEBM File URL", "js_composer"),
	"param_name"  => "bg_video_webm",
	"value"       => "",
	"description" => __("Enter the URL for your .webm video file here to create a video background for this row.", "js_composer"),
	"dependency"  => Array('element' => "row_video_bg", 'value' => array('use_video'))
));

vc_add_param("vc_row", array(
	"type"        => "colorpicker",
	"class"       => "",
	"heading"     => __("Background Color Overlay (for Parallax & Video BG)", "js_composer"),
	"value"       => "",
	"param_name"  => "row_color_overlay",
	"description" => "",
));

vc_add_param("vc_row", array(
	"type"       => "dropdown",
	"class"      => "",
	"heading"    => __("Text Color","js_composer"),
	"param_name" => "row_text_color",
	"value"      => array(
		__( "Select", "js_composer" ) => "row_text_select",
		__( "Light", "js_composer" )  => "row_text_light",
		__( "Dark", "js_composer" )   => "row_text_dark",
		__( "Custom", "js_composer" ) => "row_text_custom",
	)
));
vc_add_param("vc_row", array(
	"type"			=> "colorpicker",
	"class"			=> "",
	"heading"		=> __("Custom Text Color","js_composer"),
	"param_name"	=> "row_custom_text_color",
	"value" 		=> "",
	"dependency"  => Array('element' => "row_text_color", 'value' => array('row_text_custom'))
));

vc_add_param("vc_row", array(
	"type"			=> "colorpicker",
	"class"			=> "",
	"heading"		=> __("Border Color","js_composer"),
	"param_name"	=> "border_color",
	"value" 		=> "",
));

vc_add_param("vc_row", array(
	"type"			=> "dropdown",
	"class"			=> "",
	"heading"		=> __("Border Style","js_composer"),
	"param_name"	=> "border_style",
	"value"			=> array(
		__("Solid", "js_composer")	=> 'solid',
		__("Dotted", "js_composer")	=> "dotted",
		__("Dashed", "js_composer")	=> "dashed",
	),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Border Width","js_composer"),
	"param_name"	=> "border_width",
	"value"			=> "",
	"description"	=> __("Your border width. Example: 1px 1px 1px 1px.", "js_composer"),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Margin Top","js_composer"),
	"param_name"	=> "margin_top",
	"value"			=> "",
	"description" 	=> __("Don't include \"px\" in your string. e.g \"50\"", "js_composer"),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Margin Bottom","js_composer"),
	"param_name"	=> "margin_bottom",
	"value"			=> "",
	"description" 	=> __("Don't include \"px\" in your string. e.g \"50\"", "js_composer"),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Margin Left","js_composer"),
	"param_name"	=> "margin_left",
	"value"			=> "",
	"description" 	=> __("Don't include \"px\" in your string. e.g \"50\"", "js_composer"),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Margin Right","js_composer"),
	"param_name"	=> "margin_right",
	"value"			=> "",
	"description" 	=> __("Don't include \"px\" in your string. e.g \"50\"", "js_composer"),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Padding Top","js_composer"),
	"param_name"	=> "padding_top",
	"value"			=> "",
	"description" 	=> __("Don't include \"px\" in your string. e.g \"50\"", "js_composer"),
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Padding Bottom","js_composer"),
	"param_name"	=> "padding_bottom",
	"value"			=> "",
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Padding Left","js_composer"),
	"param_name"	=> "padding_left",
	"value"			=> "",
));

vc_add_param("vc_row", array(
	"type"			=> "textfield",
	"class"			=> "",
	"heading"		=> __("Padding Right","js_composer"),
	"param_name"	=> "padding_right",
	"value"			=> "",
));

vc_add_param("vc_row", array(
	"type"       => "textfield",
	"class"      => "",
	"heading"    => __("Extra Class Name", "js_composer"),
	"param_name" => "class",
	"value"      => "",
	"desc"       => __("This can then be used to target the row with CSS.","js_composer"),
));

/*------------------------------------------------------*/
/* REGISTER PARAM: ICON
/*------------------------------------------------------*/
if ( function_exists('add_shortcode_param')) {
	add_shortcode_param('icon' , 'icon_param_settings');
}

function icon_box_admin_style() {
	wp_enqueue_style('vc-icon-box', get_template_directory_uri() .'/assets/css/vc_icon_box.css', array(), '1.0.0' );
	wp_enqueue_style('vc-fontawesome', get_template_directory_uri() .'/assets/css/font-awesome.min.css', array(), '4.2.0' );
}
add_action('admin_enqueue_scripts', 'icon_box_admin_style');

function icon_param_settings($settings, $value) {
	$dependency = vc_generate_dependencies_attributes($settings);
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type       = isset($settings['type']) ? $settings['type'] : '';
	$class      = isset($settings['class']) ? $settings['class'] : '';
	$icons 		= array("adjust", "anchor", "archive", "arrows", "arrows-h", "arrows-v", "asterisk", "automobile", "ban", "bank", "bar-chart-o", "barcode", "bars", "beer", "bell", "bell-o", "bolt", "bomb", "book", "bookmark", "bookmark-o", "briefcase", "bug", "building", "building-o", "bullhorn", "bullseye", "cab", "calendar", "calendar-o", "camera", "camera-retro", "car", "caret-square-o-down", "caret-square-o-left", "caret-square-o-right", "caret-square-o-up", "certificate", "check", "check-circle", "check-circle-o", "check-square", "check-square-o", "child", "circle", "circle-o", "circle-o-notch", "circle-thin", "clock-o", "cloud", "cloud-download", "cloud-upload", "code", "code-fork", "coffee", "cog", "cogs", "comment", "comment-o", "comments", "comments-o", "compass", "credit-card", "crop", "crosshairs", "cube", "cubes", "cutlery", "dashboard", "database", "desktop", "dot-circle-o", "download", "edit", "ellipsis-h", "ellipsis-v", "envelope", "envelope-o", "envelope-square", "eraser", "exchange", "exclamation", "exclamation-circle", "exclamation-triangle", "external-link", "external-link-square", "eye", "eye-slash", "fax", "female", "fighter-jet", "file-archive-o", "file-audio-o", "file-code-o", "file-excel-o", "file-image-o", "file-movie-o", "file-pdf-o", "file-photo-o", "file-picture-o", "file-powerpoint-o", "file-sound-o", "file-video-o", "file-word-o", "file-zip-o", "film", "filter", "fire", "fire-extinguisher", "flag", "flag-checkered", "flag-o", "flash", "flask", "folder", "folder-o", "folder-open", "folder-open-o", "frown-o", "gamepad", "gavel", "gear", "gears", "gift", "glass", "globe", "graduation-cap", "group", "hdd-o", "headphones", "heart", "heart-o", "history", "home", "image", "inbox", "info", "info-circle", "institution", "key", "keyboard-o", "language", "laptop", "leaf", "legal", "lemon-o", "level-down", "level-up", "life-bouy", "life-ring", "life-saver", "lightbulb-o", "location-arrow", "lock", "magic", "magnet", "mail-forward", "mail-reply", "mail-reply-all", "male", "map-marker", "meh-o", "microphone", "microphone-slash", "minus", "minus-circle", "minus-square", "minus-square-o", "mobile", "mobile-phone", "money", "moon-o", "mortar-board", "music", "navicon", "paper-plane", "paper-plane-o", "paw", "pencil", "pencil-square", "pencil-square-o", "phone", "phone-square", "photo", "picture-o", "plane", "plus", "plus-circle", "plus-square", "plus-square-o", "power-off", "print", "puzzle-piece", "qrcode", "question", "question-circle", "quote-left", "quote-right", "random", "recycle", "refresh", "reorder", "reply", "reply-all", "retweet", "road", "rocket", "rss", "rss-square", "search", "search-minus", "search-plus", "send", "send-o", "share", "share-alt", "share-alt-square", "share-square", "share-square-o", "shield", "shopping-cart", "sign-in", "sign-out", "signal", "sitemap", "sliders", "smile-o", "sort", "sort-alpha-asc", "sort-alpha-desc", "sort-amount-asc", "sort-amount-desc", "sort-asc", "sort-desc", "sort-down", "sort-numeric-asc", "sort-numeric-desc", "sort-up", "space-shuttle", "spinner", "spoon", "square", "square-o", "star", "star-half", "star-half-empty", "star-half-full", "star-half-o", "star-o", "suitcase", "sun-o", "support", "tablet", "tachometer", "tag", "tags", "tasks", "taxi", "terminal", "thumb-tack", "thumbs-down", "thumbs-o-down", "thumbs-o-up", "thumbs-up", "ticket", "times", "times-circle", "times-circle-o", "tint", "toggle-down", "toggle-left", "toggle-right", "toggle-up", "trash-o", "tree", "trophy", "truck", "umbrella", "university", "unlock", "unlock-alt", "unsorted", "upload", "user", "users", "video-camera", "volume-down", "volume-off", "volume-up", "warning", "wheelchair", "wrench", "file", "file-o", "file-text", "file-text-o", "bitcoin", "btc", "cny", "dollar", "eur", "euro", "gbp", "inr", "jpy", "krw", "rmb", "rouble", "rub", "ruble", "rupee", "try", "turkish-lira", "usd", "won", "yen", "align-center", "align-justify", "align-left", "align-right", "bold", "chain", "chain-broken", "clipboard", "columns", "copy", "cut", "dedent", "files-o", "floppy-o", "font", "header", "indent", "italic", "link", "list", "list-alt", "list-ol", "list-ul", "outdent", "paperclip", "paragraph", "paste", "repeat", "rotate-left", "rotate-right", "save", "scissors", "strikethrough", "subscript", "superscript", "table", "text-height", "text-width", "th", "th-large", "th-list", "underline", "undo", "unlink", "angle-double-down", "angle-double-left", "angle-double-right", "angle-double-up", "angle-down", "angle-left", "angle-right", "angle-up", "arrow-circle-down", "arrow-circle-left", "arrow-circle-o-down", "arrow-circle-o-left", "arrow-circle-o-right", "arrow-circle-o-up", "arrow-circle-right", "arrow-circle-up", "arrow-down", "arrow-left", "arrow-right", "arrow-up", "arrows-alt", "caret-down", "caret-left", "caret-right", "caret-up", "chevron-circle-down", "chevron-circle-left", "chevron-circle-right", "chevron-circle-up", "chevron-down", "chevron-left", "chevron-right", "chevron-up", "hand-o-down", "hand-o-left", "hand-o-right", "hand-o-up", "long-arrow-down", "long-arrow-left", "long-arrow-right", "long-arrow-up", "backward", "compress", "eject", "expand", "fast-backward", "fast-forward", "forward", "pause", "play", "play-circle", "play-circle-o", "step-backward", "step-forward", "stop", "youtube-play", "adn", "android", "apple", "behance", "behance-square", "bitbucket", "bitbucket-square", "codepen", "css3", "delicious", "deviantart", "digg", "dribbble", "dropbox", "drupal", "empire", "facebook", "facebook-square", "flickr", "foursquare", "ge", "git", "git-square", "github", "github-alt", "github-square", "gittip", "google", "google-plus", "google-plus-square", "hacker-news", "html5", "instagram", "joomla", "jsfiddle", "linkedin", "linkedin-square", "linux", "maxcdn", "openid", "pagelines", "pied-piper", "pied-piper-alt", "pied-piper-square", "pinterest", "pinterest-square", "qq", "ra", "rebel", "reddit", "reddit-square", "renren", "skype", "slack", "soundcloud", "spotify", "stack-exchange", "stack-overflow", "steam", "steam-square", "stumbleupon", "stumbleupon-circle", "tencent-weibo", "trello", "tumblr", "tumblr-square", "twitter", "twitter-square", "vimeo-square", "vine", "vk", "wechat", "weibo", "weixin", "windows", "wordpress", "xing", "xing-square", "yahoo", "youtube", "youtube-square", "ambulance", "h-square", "hospital-o", "medkit", "stethoscope", "user-md");

	$output =  '<input type="hidden" name="'.$param_name.'" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.'" value="'.$value.'" id="trace"/>
			   <div class="icon-preview"><i class=" fa fa-'.$value.'"></i></div>';
	$output .= '<input class="search" type="text" placeholder="Search" />';
	$output .= '<div id="icon-dropdown" >';
	$output .= '<ul class="icon-list">';
	$icon_number = 1;
	foreach($icons as $icon)
	{
		$selected = ($icon == $value) ? 'class="selected"' : '';
		$id = 'icon-'.$icon_number;
		$output .= '<li '.$selected.' data-icon="'.$icon.'"><i class="icon fa fa-'.$icon.'"></i><label class="icon">'.$icon.'</label></li>';
		$icon_number++;
	}
	$output .='</ul>';
	$output .='</div>';
	$output .= '
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".search").keyup(function(){
		 		var filter = jQuery(this).val(), count = 0;
				jQuery(".icon-list li").each(function(){
					if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
						jQuery(this).fadeOut();
					} else {
						jQuery(this).show();
						count++;
					}
				});
			});
		});
		jQuery("#icon-dropdown li").click(function() {
			jQuery(this).attr("class","selected").siblings().removeAttr("class");
			var icon = jQuery(this).attr("data-icon");
			jQuery("#trace").val(icon);
			jQuery(".icon-preview").html("<i class=\'icon fa fa-"+icon+"\'></i>");
		});
	</script>';
	return $output;
}
