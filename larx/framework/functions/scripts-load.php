<?php

function th1_load_js() {
    if (!is_admin()){

        // jQuery Plugins

        wp_register_script('bootstrap_js',TH1_PLUGINS. 'bootstrap/js/bootstrap.min.js', array('jquery'),'', true);        
        wp_register_script('moderniz',TH1_PLUGINS. 'moderniz.js', array('jquery'),'', true);
        wp_register_script('sticky',TH1_PLUGINS. 'jquery.sticky.js', array('jquery'),'', true);
        wp_register_script('gmap','//maps.googleapis.com/maps/api/js?v=3.exp', array('jquery'),'', true);
        wp_register_script('bg-animation',TH1_PLUGINS. 'bg-animation.js', array('jquery'),'', true);
        wp_register_script('app',TH1_JS. 'app.js', array('jquery'),'', true);
		
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('bootstrap_js', '', '', '', true);
        wp_enqueue_script('retina',TH1_JS. 'retina.min.js', array('jquery'),'', true);
		
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if (is_plugin_inactive('revslider/revslider.php')) {
			wp_register_script('revolution',TH1_PLUGINS. 'revolution/rs-plugin/js/jquery.themepunch.revolution.min.js', array('jquery'),'', true);
			wp_enqueue_script('revolution', '', '', '', true);
		}
		wp_enqueue_script('moderniz', '', '', '', true);
        wp_enqueue_script('sticky', '', '', '', true);
        
		if(th_theme_data('theme_menu_style') == 'canvas' || get_post_meta(get_the_ID(), '_cmb_menu_style', true) == 'canvas'){
			wp_enqueue_script('mmenu',TH1_PLUGINS. 'jquery.mmenu.min.js', array('jquery'),'', true);
			wp_enqueue_script('canvasmenu',TH1_JS. 'canvasmenu.js', array('jquery'),'', true);
		}
		
		if (is_page_template('template-onepager.php') || is_page_template('template-multipage.php')) {
			wp_enqueue_script('cube',TH1_PLUGINS. 'cube/jquery.cubeportfolio.min.js', array('jquery'),'', true);
			wp_enqueue_script('cubeportfolio',TH1_JS. 'cubeportfolio.js', array('jquery'),'', true);
			wp_enqueue_script('owl',TH1_PLUGINS. 'owl/owl-carousel/owl.carousel.js', array('jquery'),'', true);
			wp_enqueue_script('owlcarousel',TH1_JS. 'owlcarousel.js', array('jquery'),'', true);
			wp_enqueue_script('countdown',TH1_PLUGINS. 'jquery.countdown.min.js', array('jquery'),'', true);
		}

        if(is_singular( 'portfolio' )){
            wp_enqueue_script('owl',TH1_PLUGINS. 'owl/owl-carousel/owl.carousel.js', array('jquery'),'', true);
            wp_enqueue_script('owl-single-potfolio',TH1_JS. 'owl-single-potfolio.js', array('jquery'),'', true);
        }

		if( is_single() ){
			wp_enqueue_script('postshare',TH1_JS. 'postshare.js', array('jquery'),'', true);
		}
		
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)){
			wp_enqueue_script('comment-reply');
		}
		wp_enqueue_script('parallax',TH1_PLUGINS. 'parallax.min.js', array('jquery'),'', true);
		wp_enqueue_script('app', '', '', '', true);
    }
}

add_action('wp_enqueue_scripts', 'th1_load_js');


// Dashboard scripts

function th_admin_scripts() {
    wp_register_script('script1',get_template_directory_uri() . '/framework/theme-options/assets/js/scripts.js', '', '', true);
    wp_enqueue_script('script1', '', '', '', true);
}
add_action( 'admin_enqueue_scripts', 'th_admin_scripts' );

?>