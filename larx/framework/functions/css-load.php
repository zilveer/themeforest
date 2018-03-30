<?php

function th1_load_css() {
    if (!is_admin()){
		
		$protocol = is_ssl() ? 'https' : 'http';

        // Web Fonts

        wp_register_style('opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700", true);
        wp_register_style('raleway', "$protocol://fonts.googleapis.com/css?family=Raleway:400,100,300,500,700", true);

        wp_enqueue_style('opensans');
        wp_enqueue_style('raleway');

        // Css Global Compulsory

        wp_register_style('bootstrap', TH1_PLUGINS . 'bootstrap/css/bootstrap.min.css');

        wp_enqueue_style('bootstrap');

        // Css Implementing Plugins

        wp_register_style('font-awesome', TH1_PLUGINS . 'font-awesome/css/font-awesome.min.css');                        

        wp_enqueue_style('font-awesome');

        // Canvas menu
		if(th_theme_data('theme_menu_style') == 'canvas' || get_post_meta(get_the_ID(), '_cmb_menu_style', true) == 'canvas'){
			wp_enqueue_style('mmenu', TH1_PLUGINS . 'jquery.mmenu.css');
		}

        // OWL and CUBE link where is used (onepager and multipage)
		if (is_page_template('template-onepager.php') || is_page_template('template-multipage.php')) {
			wp_enqueue_style('owl-carousel', TH1_PLUGINS . 'owl/owl-carousel/owl.carousel.css');
			wp_enqueue_style('owl-theme', TH1_PLUGINS . 'owl/owl-carousel/owl.theme.css');
			wp_enqueue_style('cube', TH1_PLUGINS . 'cube/cubeportfolio.min.css');
		}

        // Portfolio OWL carouser
        if(is_singular( 'portfolio' )){
            wp_enqueue_style('owl-carousel', TH1_PLUGINS . 'owl/owl-carousel/owl.carousel.css');
            wp_enqueue_style('owl-theme', TH1_PLUGINS . 'owl/owl-carousel/owl.theme.css');
        }
		
        // Css Theme

        wp_register_style('main', TH1_CSS . 'main.css');
        wp_register_style('theme-styles', get_template_directory_uri() . '/style.css');

        wp_enqueue_style('main');
        wp_enqueue_style('theme-styles');
		
		// RTL Layout 
		if(th_theme_data('enable_rtl_layout') == 1){
			wp_enqueue_style('rtl-css', TH1_CSS . 'rtl.css');
			wp_enqueue_style('bootstrap-rtl', '//cdn.rawgit.com/morteza/bootstrap-rtl/master/dist/cdnjs/3.3.1/css/bootstrap-rtl.min.css');
		}

        // Dark Version
		if (is_page_template('template-onepager.php') || is_page_template('template-multipage.php') || is_single('single-portfolio') || is_page()) {
			$cmb_theme_style = get_post_meta(get_the_ID(), '_cmb_theme_style', true);
			if($cmb_theme_style == 'default'){
				$theme_style=th_theme_data('theme_style');
				if($theme_style == 'dark'){
					 wp_enqueue_style('main-dark-css', TH1_CSS . 'black.css');
				}
			}else{
				$theme_style=$cmb_theme_style;
				if($theme_style == 'dark'){
					wp_enqueue_style('main-dark-css', TH1_CSS . 'black.css');
				}
			}
		}else{
			$theme_style=th_theme_data('theme_style');
            if($theme_style == 'dark'){
                wp_enqueue_style('main-dark-css', TH1_CSS . 'black.css');
            }
		}

        // Custom colors
		$th_select_stylesheet=th_theme_data('th_select_stylesheet',''); // Stylesheet select
		if ( $th_select_stylesheet != '' && $th_select_stylesheet !== 'default.css'){
			wp_enqueue_style('main-color-theme', TH1_CSS . 'colors/'.$th_select_stylesheet);
		}
		
		$th_custom_color=th_theme_data('th_custom_color',''); // Stylesheet select
		$th_custom_hover_color=th_theme_data('th_custom_hover_color',''); // Stylesheet select
        $th_custom_nav_color=th_theme_data('th_custom_nav_color',''); // Stylesheet select
        $th_custom_nav_hover_color=th_theme_data('th_custom_nav_hover_color',''); // Stylesheet select
		if ( $th_custom_color != '' || $th_custom_hover_color !== '' || $th_custom_nav_color !== '' || $th_custom_nav_hover_color !== ''){
			wp_enqueue_style('style-dynamic', TH1_CSS . 'style-dynamic.php');
		}

    }
}

add_action('wp_enqueue_scripts', 'th1_load_css');


// Dashboard styles

function th_admin_styles() {
    wp_enqueue_style('th-admin', get_template_directory_uri() . '/framework/theme-options/assets/css/th-admin.css');
    wp_register_style('font-awesome', TH1_PLUGINS . 'font-awesome/css/font-awesome.min.css');

    wp_enqueue_style('font-awesome');
    wp_enqueue_style('th-admin');
}

add_action( 'admin_enqueue_scripts', 'th_admin_styles' );
?>