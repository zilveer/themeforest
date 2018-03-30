<?php 
/**
 * JavaScripts In Header
 */
function theme_enqueue_scripts() {
	if((is_admin() && !is_shortcode_preview()) ||'wp-login.php' == basename($_SERVER['PHP_SELF'])){
		return;
	}
	$post_id = theme_get_queried_object_id();
	
	$move_bottom = theme_get_option('advanced','move_bottom');

	wp_register_script( 'jquery-tinyslider', THEME_JS .'/jquery-tinyslider.min.js', array('jquery'),false,$move_bottom);
	wp_register_script( 'tinyslider-init', THEME_JS .'/tinySliderInit.min.js', array('jquery','jquery-tinyslider'),false,$move_bottom);
	
	if( !theme_get_option('advanced','no_fancybox') ){
		wp_enqueue_script( 'jquery-fancybox', THEME_JS .'/jquery.fancybox.min.js', array('jquery'),'2.1.5',$move_bottom);
	}
	
	wp_enqueue_script( 'custom-js', THEME_JS .'/custom.combine.js', array('jquery'),false,$move_bottom);

	wp_register_script( 'jquery-sticker', THEME_JS .'/jquery-sticker.min.js', array('jquery'),'0.6.5',$move_bottom);

	if((is_front_page() && theme_get_option('footer','sticky_footer')) || (theme_get_inherit_option($post_id, '_sticky_footer', 'footer','sticky_footer'))) {
		wp_enqueue_script( 'jquery-stickyfooter', THEME_JS .'/jquery.stickyfooter.min.js', array('jquery-sticker'),'1.0',$move_bottom);
	}
	if(theme_get_option('general','sticky_header')){ 
		wp_enqueue_script( 'jquery-stickyheader', THEME_JS .'/jquery.stickyheader.min.js', array('jquery-sticker'),'1.0',$move_bottom);
	}
	if(theme_get_option('general','sticky_sidebar')){
		wp_enqueue_script( 'jquery-stickysidebar', THEME_JS .'/jquery.stickysidebar.min.js', array('jquery-sticker'),'1.0',$move_bottom);
	}
	
	wp_register_script( 'jquery-carousel', THEME_JS .'/jquery-carousel.min.js', array('jquery'),false,$move_bottom);
	wp_register_script( 'carousel-init', THEME_JS .'/carouselInit.min.js', array('jquery','jquery-carousel'),false,$move_bottom);
	wp_register_script( 'mediaelementjs-scripts', THEME_URI .'/mediaelement/mediaelement-and-player.js', array('jquery'),'2.11.3',$move_bottom);


	wp_register_script( 'cufon-yui', THEME_JS .'/cufon-yui.js', array('jquery'),'1.09i');
	wp_register_script( 'jquery-quicksand', THEME_JS .'/jquery.quicksand.min.js', array('jquery'),'1.3',$move_bottom);
	wp_register_script( 'jquery-easing', THEME_JS . '/jquery.easing.1.3.min.js', array('jquery'),'1.3',$move_bottom);

	wp_register_script( 'gmap-api-loader', THEME_JS .'/gmap-api-loader.js', array('jquery'), '', true);
	wp_register_script( 'jquery-gmap', THEME_JS .'/jquery.gmap.min.js', array('jquery','gmap-api-loader'),'2.1.5', true);
	wp_register_script( 'jquery-tweet', THEME_JS .'/jquery.tweet.min.js', array('jquery'));
	wp_register_script( 'jquery-tools-validator', THEME_JS .'/jquery.tools.validator.min.js', array('jquery'),'1.2.5',$move_bottom);
	wp_register_script( 'jquery-isotope', THEME_JS .'/isotope.pkgd.min.js', array('jquery'), '2.0.0',$move_bottom);

	//slideshow
	//Unleash Accordion Slider
	wp_register_script( 'jquery-unleash', THEME_JS .'/unleash/jquery.unleash.2.min.js', array('jquery','jquery-easing'),'2',$move_bottom);
	wp_register_script( 'unleash-init', THEME_JS . '/unleashSliderInit.min.js',array('jquery-unleash'),false,$move_bottom);
	//Roundabout Slider
	wp_register_script( 'jquery-roundabout-script', THEME_JS .'/roundabout/jquery.roundabout.min.js', array('jquery'),'2.4.2',$move_bottom);
	wp_register_script( 'jquery-roundabout', THEME_JS .'/roundabout/jquery.roundabout-shapes.min.js', array('jquery','jquery-easing','jquery-roundabout-script'),'2.0',$move_bottom);
	wp_register_script( 'roundabout-init', THEME_JS . '/roundSliderInit.min.js',array('jquery-roundabout'),false,$move_bottom);
	//KenBurner Slider
	wp_register_script( 'jquery-kenburner-plugin', THEME_JS .'/kenburner/jquery.themepunch.plugins.min.js', array('jquery'),false,$move_bottom);
	wp_register_script( 'jquery-kenburner', THEME_JS .'/kenburner/jquery.themepunch.kenburn.min.js', array('jquery-kenburner-plugin'),false,$move_bottom);
	wp_register_script( 'ken-init', THEME_JS . '/kenSliderInit.min.js',array('jquery-kenburner'),false,$move_bottom);
	//Nivo Slider
	wp_register_script( 'jquery-nivo', THEME_JS .'/nivo/jquery.nivo.slider.pack.js', array('jquery'),false,$move_bottom);
	wp_register_script( 'nivo-init', THEME_JS . '/nivoSliderInit.min.js',array('jquery-nivo'),false,$move_bottom);

	//Fotorama Slider
	wp_register_script( 'jquery-fotorama', THEME_JS .'/fotorama/fotorama.min.js', array('jquery'),false,$move_bottom);
	wp_register_script( 'fotorama-init', THEME_JS . '/fotoramaSliderInit.min.js',array('jquery-fotorama'),false,$move_bottom);
	
	if ( ! class_exists( 'WooCommerce_Quantity_Increment') && theme_get_option('advanced','woocommerce_spinners'))	{
		wp_register_script( 'theme-quantity-spinner-init', THEME_JS . '/jquery-quantity-increment.min.js', array( 'jquery' ) );
	}

	if ( is_singular() ){
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

function theme_enqueue_styles(){
	if((is_admin() && !is_shortcode_preview()) || 'wp-login.php' == basename($_SERVER['PHP_SELF'])){
		return;
	}
	wp_register_style('mediaelementjs-styles', THEME_URI.'/mediaelement/mediaelementplayer.css', false, false, 'all');
	
	wp_register_style('ken-css', THEME_CSS.'/slideshow-ken.css', false, false, 'all');
	wp_register_style('nivo-css', THEME_CSS.'/slideshow-nivo.css', false, false, 'all');
	wp_register_style('unleash-css', THEME_CSS.'/slideshow-unleash.css', false, false, 'all');
	wp_register_style('roundabout-css', THEME_CSS.'/slideshow-roundabout.css', false, false, 'all');
	wp_register_style('fotorama-css', THEME_CSS.'/slideshow-fotorama.css', false, false, 'all');
	
	if(theme_get_option('advanced','complex_class')){
		wp_enqueue_style('theme-style', THEME_CSS.'/screen_complex.min.css', false, false, 'all');
	}else{
		wp_enqueue_style('theme-style', THEME_CSS.'/screen.min.css', false, false, 'all');
	}


	theme_enqueue_icon_set();
	if(theme_get_option('advanced','responsive') && !is_shortcode_preview()){
		wp_enqueue_style('theme-responsive', THEME_CSS.'/responsive.min.css', false, false, 'all');
	}

	do_action('theme_print_styles');

	if(is_multisite()){
		global $blog_id;
		wp_enqueue_style('theme-skin', THEME_CACHE_URI.'/skin_'.$blog_id.'.css', array('theme-style'), time(), 'all');
	}else{
		wp_enqueue_style('theme-skin', THEME_CACHE_URI.'/skin.css', array('theme-style'), time(), 'all');
	}
}
add_action('wp_print_styles', 'theme_enqueue_styles');

if(theme_get_option('font','cufon_enabled')){
	function theme_add_cufon_script(){
		$fonts = theme_get_option('font','cufon_used');
		if(is_array($fonts)){
			foreach ($fonts as $font){
				if(is_array($font)){
					wp_register_script($font['file_name'], $font['url'], array('cufon-yui'));
					wp_print_scripts($font['file_name']);
				}else{
					if (defined('THEME_CHILD_FONT_DIR')  && defined('THEME_CHILD_FONT_URI')) {
						if (file_exists(THEME_CHILD_FONT_DIR.'/'.$font)) {
							wp_register_script($font, THEME_CHILD_FONT_URI .'/'.$font, array('cufon-yui'));
						}
						else {
							 wp_register_script($font, THEME_FONT_URI .'/'.$font, array('cufon-yui'));
						}
					} else 
					wp_register_script($font, THEME_FONT_URI .'/'.$font, array('cufon-yui'));
					wp_print_scripts($font);
				}
			}
		}
		wp_print_scripts('cufon-yui');
	}
	add_filter('wp_head','theme_add_cufon_script',1);	
}
if(theme_get_option('font','gfont_used')){
	function theme_add_gfont_lib(){
		$http = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
		$fonts = theme_get_option('font','gfont_used');
		if(is_array($fonts)){
			foreach ($fonts as $font){
				$fontname = preg_replace('/\s+/', '-', $font);
				$subsets = theme_get_google_font_subsets($font);
				if(empty($subsets)){
					$subsets = array('latin');
				}
				if(count($subsets) == 1 && $subsets[0] == 'latin'){
					$subsets_str = '';
				}else{
					$subsets_str = '&subset='.implode(',', $subsets);
				}
				wp_enqueue_style('font|'.$fontname,$http.'://fonts.googleapis.com/css?family='.$font.$subsets_str);
			}
		}
	}
	add_action("wp_print_styles", 'theme_add_gfont_lib');
}

function theme_slideshow_header(){
	$type = false;
	$post_id = theme_get_queried_object_id();
	if( is_front_page() || (is_home() && !get_option('page_on_front') && $post_id== 0 )){
		$page= theme_get_option('homepage','home_page');
		if($page){
			if (in_array( get_post_meta($page, '_introduce_text_type', true), array('slideshow', 'custom_slideshow','title_slideshow'))) {
				$type = get_post_meta($page,'__slideshow_type', true);
			}
		}else{
			if (theme_get_option('homepage', 'disable_slideshow')) {
				return;
			}
			$type = theme_get_option('homepage', 'slideshow_type');
		}
	}elseif( is_single() || is_page() || (is_home() && $post_id == get_option('page_for_posts'))){	
		$introduce_type = get_post_meta($post_id, '_introduce_text_type', true);
		if (in_array( $introduce_type, array('slideshow', 'custom_slideshow','title_slideshow'))) {
			$type = get_post_meta($post_id,'__slideshow_type', true);
		}
		$blog_page_id = theme_get_option('blog','blog_page');
		if('default' == $introduce_type && $post_id!=$blog_page_id){
			$show_in_header = theme_get_option('blog','show_in_header');
			if(!$show_in_header){
				$introduce_type = get_post_meta($blog_page_id, '_introduce_text_type', true);
				if('slideshow' == $introduce_type){
					$type = get_post_meta($blog_page_id,'__slideshow_type', true);
				}
			}
		}
	}elseif( is_home() && $post_id== 0 && defined('ICL_SITEPRESS_VERSION')){ //wpml other language's homepage
		$home_page_id = theme_get_option('homepage','home_page');
		$home_page_id = wpml_get_object_id($home_page_id,'page');
			
		$introduce_type = get_post_meta($home_page_id, '_introduce_text_type', true);
		if (in_array( $introduce_type, array('slideshow', 'custom_slideshow','title_slideshow'))) {
			$type = get_post_meta($home_page_id,'__slideshow_type', true);
		}
	}

	if($type != false && $type != 'revslider'){
		require_once (THEME_HELPERS . '/slideshowGenerator.php');
		$slideshowGenerator = new PageSlideshowGenerator;
		$slideshowGenerator->header($type);
	}
}
