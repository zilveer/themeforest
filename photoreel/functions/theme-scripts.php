<?php
if ( ! is_admin() ) { add_action( 'wp_print_scripts', 'themnific_add_javascript' ); }

if ( ! function_exists( 'themnific_add_javascript' ) ) {
	function themnific_add_javascript() {

		// Load Common scripts	
		wp_enqueue_script('jquery');
		wp_enqueue_script('css3-mediaqueries', get_template_directory_uri().'/js/css3-mediaqueries.js');
		wp_enqueue_script('superfish', get_template_directory_uri().'/js/superfish.js','','', true);
		wp_enqueue_script('jquery.hoverIntent.minified', get_template_directory_uri().'/js/jquery.hoverIntent.minified.js','','', true);
		wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js','','', true);
		wp_enqueue_script('ownScript', get_template_directory_uri() .'/js/ownScript.js','','', true);
		

		// Homepage Slider scripts		
		if (get_option('themnific_slider_dis') <> "true") { 
			if ( is_page_template('homepage.php') || is_home()) { 
				wp_enqueue_script('jquery.flexslider-min', get_template_directory_uri() .'/js/jquery.flexslider-min.js','','', true);
				wp_enqueue_script('jquery.flexslider.main.start', get_template_directory_uri() .'/js/jquery.flexslider.main.start.js','','', true);
				
			} 
		}
		
		// Single Slider scripts		
		if ( is_singular() || is_home()) { 
			wp_enqueue_script('jquery.flexslider-min', get_template_directory_uri() .'/js/jquery.flexslider-min.js','','', true);
			wp_enqueue_script('jquery.flexslider.single.start', get_template_directory_uri() .'/js/jquery.flexslider.single.start.js','','', true);
		} 
		
		
		// Quicksand scripts
		if ( is_page_template('template-portfolio.php') || is_page_template('template-portfolio-4col.php')|| is_page_template('template-portfolio-2col.php')) { 
			wp_enqueue_script('quicksand', get_template_directory_uri() . '/js/jquery.quicksand.js','','', true);
			wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js','','', true);
			wp_enqueue_script('quicksand.custom', get_template_directory_uri() . '/js/jquery.quicksand.custom.js','','', true);
		} 
		
		if ( is_singular()){
			wp_enqueue_script( 'comment-reply' );	
		}
		
	}
}
?>