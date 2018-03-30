<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 6:16 PM
 */
/*================================================
LOAD STYLESHEETS
================================================== */
if (!function_exists('g5plus_enqueue_styles')) {
	function g5plus_enqueue_styles() {
		$g5plus_options = &G5Plus_Global::get_options();
		$min_suffix = (isset($g5plus_options['enable_minifile_css']) && $g5plus_options['enable_minifile_css'] == 1) ? '.min' :  '';

		/*font-awesome*/
		$url_font_awesome = G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css';
		if (isset($g5plus_options['cdn_font_awesome']) && !empty($g5plus_options['cdn_font_awesome'])) {
			$url_font_awesome = $g5plus_options['cdn_font_awesome'];
		}
		wp_enqueue_style('font-awesome', $url_font_awesome, array());
		wp_enqueue_style('font-awesome-animation', G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome-animation.min.css', array());

		/*bootstrap*/
		$url_bootstrap = G5PLUS_THEME_URL . 'assets/plugins/bootstrap/css/bootstrap.min.css';
		if (isset($g5plus_options['cdn_bootstrap_css']) && !empty($g5plus_options['cdn_bootstrap_css'])) {
			$url_bootstrap = $g5plus_options['cdn_bootstrap_css'];
		}
		wp_enqueue_style('bootstrap', $url_bootstrap, array());

		/*owl-carousel*/
		wp_enqueue_style('owl-carousel', G5PLUS_THEME_URL . 'assets/plugins/owl-carousel/assets/owl.carousel'.$min_suffix.'.css', array());

		/*prettyPhoto*/
		wp_enqueue_style('prettyPhoto', G5PLUS_THEME_URL . 'assets/plugins/prettyPhoto/css/prettyPhoto'.$min_suffix.'.css', array());

		/*peffect_scrollbar*/
		wp_enqueue_style('peffect-scrollbar', G5PLUS_THEME_URL . 'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css', array());

		/*slick*/
		wp_enqueue_style('slick', G5PLUS_THEME_URL . 'assets/plugins/slick/css/slick'.$min_suffix.'.css', array());



		if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
			wp_enqueue_style('g5plus_framework_style', G5PLUS_THEME_URL . 'style'.$min_suffix.'.css');
		}

		$enable_rtl_mode = '0';
		if (isset($g5plus_options['enable_rtl_mode'])) {
			$enable_rtl_mode =  $g5plus_options['enable_rtl_mode'];
		}

		if (is_rtl() || $enable_rtl_mode == '1' || isset($_GET['RTL'])) {
			wp_enqueue_style('g5plus_framework_rtl', G5PLUS_THEME_URL . 'assets/css/rtl'.$min_suffix.'.css');
		}
	}
	add_action('wp_enqueue_scripts', 'g5plus_enqueue_styles',11);
}

if (!function_exists('custom_font_styles')) {
    function custom_font_styles()
    {
	    $g5plus_options = &G5Plus_Global::get_options();
        $custom_font_css = '';

        for($i=1;$i<=2;$i++){
            $src = array();
            $custom_font = $g5plus_options['custom_font_'.$i.'_name'];
            if(isset($custom_font) && $custom_font!=''){
                if(isset($g5plus_options['custom_font_'.$i.'_eot'])){
                    $eot =  $g5plus_options['custom_font_'.$i.'_eot']['url'];
                    $src[] = "url('$eot?#iefix') format('embedded-opentype')";;
                }
                if(isset($g5plus_options['custom_font_'.$i.'_ttf'])){
                    $ttf = $g5plus_options['custom_font_'.$i.'_ttf']['url'];
                    $src[] =  "url('$ttf') format('truetype')";
                }
                if(isset($g5plus_options['custom_font_'.$i.'_woff'])){
                    $woff = $g5plus_options['custom_font_'.$i.'_woff']['url'];
                    $src[] = "url('$woff') format('woff')";
                }
                if(isset($g5plus_options['custom_font_'.$i.'_svg'])){
                    $svg = $g5plus_options['custom_font_'.$i.'_svg']['url'];
                    $src[] = "url('$svg?#svgFontName') format('svg')";
                }
                if($src){
                    $custom_font_css .= "@font-face { ";
                    $custom_font_css .= "font-family: '$custom_font'; ";
                    $custom_font_css .= "src: " . implode(", ", $src) . "; }" . "\r\n";
                }
            }
        }
        if($custom_font_css!=''){
            echo sprintf('<style>%s</style>',$custom_font_css);
        }
    }
    add_action('wp_head', 'custom_font_styles', 100);
    add_action('admin_head', 'custom_font_styles', 100);
}

/*================================================
LOAD SCRIPTS
================================================== */
if (!function_exists('g5plus_enqueue_script')) {
	function g5plus_enqueue_script() {
		$g5plus_options = &G5Plus_Global::get_options();
		$min_suffix = (isset($g5plus_options['enable_minifile_js']) && $g5plus_options['enable_minifile_js'] == 1) ? '.min' :  '';

		/*bootstrap*/
		$url_bootstrap = G5PLUS_THEME_URL . 'assets/plugins/bootstrap/js/bootstrap.min.js';
		if (isset($g5plus_options['cdn_bootstrap_js']) && !empty($g5plus_options['cdn_bootstrap_js'])) {
			$url_bootstrap = $g5plus_options['cdn_bootstrap_js'];
		}
		wp_enqueue_script('bootstrap', $url_bootstrap, array('jquery'), false, true);

		if (is_single()) {
			wp_enqueue_script('comment-reply');
		}

		/*plugins*/
		wp_enqueue_script('g5plus_framework_plugins', G5PLUS_THEME_URL . 'assets/js/plugin'.$min_suffix.'.js', array(), false, true);

		/*smooth-scroll*/
		if ( isset($g5plus_options['smooth_scroll']) && ($g5plus_options['smooth_scroll'] == 1)) {
			wp_enqueue_script('smooth-scroll', G5PLUS_THEME_URL . 'assets/plugins/smoothscroll/SmoothScroll' . $min_suffix . '.js', array(), false, true);
		}

		wp_enqueue_script( 'jquery-jPlayer', G5PLUS_THEME_URL . 'assets/plugins/jquery.jPlayer/jquery.jplayer.min.js', array(), '', true );

		/*slick*/
		wp_enqueue_script('slick', G5PLUS_THEME_URL . 'assets/plugins/slick/js/slick' . $min_suffix . '.js', array(), false, true);

		wp_enqueue_script('g5plus_framework_app', G5PLUS_THEME_URL . 'assets/js/main' . $min_suffix . '.js', array(), false, true);

		wp_localize_script('g5plus_framework_app', 'g5plus_framework_ajax_url', get_site_url() . '/wp-admin/admin-ajax.php?activate-multi=true');
		wp_localize_script('g5plus_framework_app', 'g5plus_framework_theme_url', G5PLUS_THEME_URL);
		wp_localize_script('g5plus_framework_app', 'g5plus_framework_site_url', site_url());

	}
	add_action('wp_enqueue_scripts', 'g5plus_enqueue_script');
}

/* CUSTOM CSS OUTPUT
	================================================== */
if(!function_exists('g5plus_enqueue_custom_css')){
    function g5plus_enqueue_custom_css() {
	    $g5plus_options = &G5Plus_Global::get_options();
        $custom_css = $g5plus_options['custom_css'];
        if ( $custom_css ) {
	        echo '<style id="g5plus_custom_style" type="text/css"></style>';
            echo sprintf('<style type="text/css">%s %s</style>',"\n",$custom_css);
        }
    }
    add_action( 'wp_head', 'g5plus_enqueue_custom_css' );
}

/* CUSTOM JS OUTPUT
	================================================== */
if(!function_exists('g5plus_enqueue_custom_script')){
    function g5plus_enqueue_custom_script() {
	    $g5plus_options = &G5Plus_Global::get_options();
        $custom_js = $g5plus_options['custom_js'];
        if ( $custom_js ) {
            echo sprintf('<script type="text/javascript">%s</script>',$custom_js);
        }
    }
    add_action( 'wp_footer', 'g5plus_enqueue_custom_script' );
}
