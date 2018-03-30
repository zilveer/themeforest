<?php

class PGL_Asset {
	static function init() {
		add_action( 'wp_enqueue_scripts', array( 'PGL_Asset', 'enqueu_head' ) );
		if ( is_admin() ) {
			add_action('init', array('PGL_Asset', 'admin_enqueue_head'));
		}
	}

	static function admin_enqueue_head() {
		if(is_admin()) {
			add_editor_style(PGL_URI_CSS . 'editor.css');
		}
	}


	static function enqueu_head() {
		global $post;
		global $blog_id;
		global $pgl_options;
        $skin = $pgl_options->option('theme_skin');

		//bootstrap
		wp_enqueue_script( 'modernizr', PGL_URI . 'assets/js/modernizr.min.js');
		wp_enqueue_script( 'webfonts', PGL_URI . 'assets/js/webfonts.js');
		wp_enqueue_script( 'bootstrap', PGL_URI . 'assets/js/bootstrap.min.js', array('jquery'), '3.0.0' );
		wp_enqueue_style( 'bootstrap', PGL_URI_CSS . 'bootstrap.min.css', null, '3.0.0' );
		wp_enqueue_style( 'base', PGL_URI_CSS . 'base.css', array('bootstrap'), '2.3.2' );
		wp_enqueue_style( 'responsive', PGL_URI_CSS . 'responsive.css', array('bootstrap'), '2.3.2' );
        if($skin){
	        if($skin=="custom" && is_multisite()){
		        wp_enqueue_style( 'theme-'.$skin , PGL_URI_CSS . 'skins/'.$skin.$blog_id.'.css', array(), '3.0.0' );
	        }else{
                wp_enqueue_style( 'theme-'.$skin , PGL_URI_CSS . 'skins/'.$skin.'.css', array(), '3.0.0' );
	        }
        }else{
            wp_enqueue_style( 'theme-skin', PGL_URI_CSS . 'skins/default.css', array(), '3.0.0' );
        }


		//push menu
        wp_enqueue_script( 'jq-pushy', PGL_URI_JS . 'pushy/pushy.min.js' );
		wp_enqueue_script('jquery-mixitup', PGL_URI_JS . 'mixitup/jquery.mixitup.min.js', array(
				'jquery'
			), '2.0', TRUE);

		wp_enqueue_script('jq-masonry', PGL_URI_JS . 'masonry.pkgd.min.js', array(
				'jquery'
			), '3.1.2', TRUE);
		//main js
		wp_enqueue_script( _PREFIX_ . 'waypoints', PGL_URI_JS . 'waypoints.min.js', array( 'jquery' ), '2.0.3', TRUE );
		wp_enqueue_script( _PREFIX_ . 'selectnav-js', PGL_URI_JS . 'selectnav.js', array( 'jquery' ), '0.1', TRUE );
		wp_enqueue_script( _PREFIX_ . 'main-js', PGL_URI_JS . 'main.js', array( 'jquery' ), '1.0', TRUE );
		if ( $pgl_options->option( 'use_default_image' ) ) {
			wp_enqueue_script( 'holderjs', PGL_URI_JS . 'holder.min.js', array(), '1.9', TRUE );
		}
		// include flexslider script if this is
		if ( is_single() && $post->post_type == 'estate' ) {
			wp_enqueue_script( 'owl-carousel', PGL_URI_JS . 'owl.carousel.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'owl-carousel-estate', PGL_URI_JS . 'owl.estate.single.js', array( 'jquery', 'owl-carousel' ), '1.0' );
			wp_enqueue_style( 'owl-carousel', PGL_URI_CSS . 'owl.carousel.css' );
			wp_enqueue_style( 'owl-transitions', PGL_URI_CSS . 'owl.transitions.css' );
            wp_enqueue_script( 'nivo-lightbox', PGL_URI_JS . 'nivo-lightbox/nivo-lightbox.min.js', array( 'jquery' ) );
            wp_enqueue_style( 'nivo-lightbox', PGL_URI_JS . 'nivo-lightbox/nivo-lightbox.css' );
			wp_enqueue_style( 'nivo-lightbox-default', PGL_URI_JS . 'nivo-lightbox/themes/default/default.css' );
		}
	}
}