<?php
/*-------------------------------------------------------
  Add Exist Shortcodes To Visual Composer
--------------------------------------------------------*/
if ( function_exists( 'vc_map')){
	
	require_once($vc_path."simplekey_feature.php");
	require_once($vc_path."simplekey_quote.php");
	require_once($vc_path."simplekey_pricing.php");
	require_once($vc_path."simplekey_member.php");
	require_once($vc_path."simplekey_portfolios.php");
	require_once($vc_path."simplekey_post_list.php");
	require_once($vc_path."simplekey_blog.php");
	require_once($vc_path."simplekey_blog_grid.php");
	require_once($vc_path."simplekey_comment.php");
	require_once($vc_path."simplekey_headline.php");
	require_once($vc_path."simplekey_social.php");
	
	/*Remove exist shortcode*/
	vc_remove_element("vc_teaser_grid");
	vc_remove_element("vc_posts_grid");
	//vc_remove_element("vc_pie");
	vc_remove_element("vc_cta_button");
	vc_remove_element("vc_cta_button2");
	vc_remove_element("vc_images_carousel"); 
	vc_remove_element("vc_video");
	 
	
	/*Load custom CSS*/
	if(!is_admin()){add_action('wp_footer', 'vc_custom_css');}
	function vc_custom_css(){
	   wp_enqueue_style("vc-custom", get_template_directory_uri()."/vc_extends/vc_custom.css", false, null, "all");
	}
	
	/*Override the new template folder*/
	$dir = get_stylesheet_directory() . '/vc_extends/';
	vc_set_template_dir($dir);
}
	
/*------Visual Composer's CSS animation---------*/
function custom_css_animation($css_animation){
	$vc_css='';
	if($css_animation<>''){
	    $vc_css=' wpb_animate_when_almost_visible wpb_'.$css_animation;
	}else{
	  $vc_css='';
	}
	return $vc_css;
}
?>