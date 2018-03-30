<?php
// Custom fields for WP write panel
global $obox_meta, $obox_custom_css_meta, $post;
$obox_custom_css_meta = array(
		"custom_css" => array (
			"name"		=> "custom_css",
			"default"	=> "",
			"label"		=> "Custom CSS",
			"desc"		=> "Input custom CSS for use with this post / page",
			"input_type"	=> "textarea"
			)
		);
$obox_meta = array(
		"header_image" => array (
			"name"		=> "header_image",
			"default"	=> "",
			"default_colour" => "ffffff",
			"label"		=> "Header Background",
			"desc"		=> "Select a background for your post header (at least 1920px by 520px)",
			"input_type"	=> "background"
		),
		"header_title_color" => array (
			"name"		=> "header_title_color",
			"default"	=> "",
			"label"		=> __("Post Title Color", 'ocmx'),
			"desc"		=> __("Select a text colour for your post title.", 'ocmx'),
			"input_type"	=> "color"
		),
		"header_text_shadow" => array (
			"name"		=> "post_text_shadow",
			"default"	=> "no",
			"label"		=> __("Title & Excerpt Text Shadow ", 'ocmx'),
			"desc"		=> __("Enable or disable text shadows on the post titles, meta and excerpts in list pages.", 'ocmx'),
			"input_type"	=> "radio",
			"options"	=> array( 'Yes' => 'yes', 'No' => 'no' )
		),
		"video" => array (
			"name"			=> "video_link",
			"default" 		=> "",
			"label"			=> __("Video Link", 'ocmx'),
			"desc"			=> __("Provide your video link instead of the embed code and we'll use <a href='http://codex.wordpress.org/Embeds' target='_blank'>oEmbed</a> to translate that into a video.",'ocmx'),
			"input_type"		=> "text"
		),
		"embed" => array (
			"name"			=> "main_video",
			"default" 		=> "",
			"label" 		=> __("Embed Code",'ocmx'),
			"desc"      	=> __("Input the embed code of your video here.",'ocmx'),
			"input_type"  	=> "textarea"
		),
		"hostedvideo" => array (
			"name"			=> "video_hosted",
			"default" 		=> "",
			"label" 		=> __("Self Hosted Video Formats: .MP4 or .MPV",'ocmx'),
			"desc"      	=> __("Please paste in your self hosted video link. To upload videos <a href='".get_bloginfo("url")."/wp-admin/media-new.php'>click here</a>",'ocmx'),
			"input_type"  	=> "text"
		),
		"hostedvideo_ogv" => array (
			"name"			=> "video_hosted_ogv",
			"default" 		=> "",
			"label" 		=> __("Self Hosted Video Formats: .OGV (for non HTML5 browsers)",'ocmx'),
			"desc"      	=> __("Please paste in your self hosted video link. To upload videos <a href='".get_bloginfo("url")."/wp-admin/media-new.php'>click here</a>",'ocmx'),
			"input_type"  	=> "text"
		)
	);

function create_meta_box_ui() {
	global $post, $obox_meta;
	post_meta_panel($post->ID, $obox_meta);
}

function create_custom_css_meta_box_ui() {
	global $post, $obox_custom_css_meta;
	post_meta_panel($post->ID, $obox_custom_css_meta);
}
function insert_obox_metabox($pID) {
	global $post, $obox_meta, $obox_custom_css_meta, $meta_added;
	if(!isset($meta_added)) {
		post_meta_update($pID, $obox_meta);
		post_meta_update($pID, $obox_custom_css_meta);
	}
	$meta_added = 1;
}
if(function_exists("ocmx_change_metatype")) {}

function add_obox_meta_box() {
	if (function_exists('add_meta_box') ) {
		add_meta_box('obox-css-meta-box','Custom CSS','create_custom_css_meta_box_ui','post','normal','high');
		add_meta_box('obox-css-meta-box','Custom CSS','create_custom_css_meta_box_ui','page','normal','high');
		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','post','normal','high');
		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','page','normal','high');
	}
}

function my_page_excerpt_meta_box() {
	add_meta_box( 'postexcerpt', __('Excerpt','ocmx'), 'post_excerpt_meta_box', 'page', 'normal', 'core' );
}

add_action('admin_menu', 'add_obox_meta_box');
add_action('admin_menu', 'my_page_excerpt_meta_box');
add_action('admin_head', 'ocmx_change_metatype');
add_action('save_post', 'insert_obox_metabox');
add_action('publish_post', 'insert_obox_metabox');  ?>