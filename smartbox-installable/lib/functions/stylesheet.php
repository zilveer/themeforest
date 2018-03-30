<?php
function designare_styles(){

	 if (!is_admin()){
	 	wp_enqueue_style('css1', DESIGNARE_CSS_PATH .'skeleton.css');
		wp_enqueue_style('css5', DESIGNARE_CSS_PATH .'camera.css');
		wp_enqueue_style('css16', DESIGNARE_CSS_PATH .'skin.css');
		wp_enqueue_style('css8', DESIGNARE_CSS_PATH .'flexslider.css');
		wp_enqueue_style('css11', DESIGNARE_CSS_PATH .'blog.css');
		wp_enqueue_style('css14', DESIGNARE_CSS_PATH .'prettyPhoto.css');
		if (get_option(DESIGNARE_SHORTNAME."_disable_responsive") === "off")
			wp_enqueue_style('css15', DESIGNARE_CSS_PATH .'resize.css');
		wp_enqueue_style('css19', DESIGNARE_CSS_PATH .'font-awesome.min.css');
		wp_enqueue_style('css21', DESIGNARE_CSS_PATH .'retina.css');
		wp_enqueue_style('css22', DESIGNARE_CSS_PATH .'animate.css');
		wp_enqueue_style('css23', DESIGNARE_CSS_PATH .'component.css');
		
		if (strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE')){
			wp_enqueue_style('IE', DESIGNARE_CSS_PATH .'IE.css');	
		}
		
		wp_enqueue_style('css12', get_template_directory_uri().'/editor-style.css');

	}
}
add_action('wp_enqueue_scripts', 'designare_styles', 11);
?>