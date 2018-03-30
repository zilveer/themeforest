<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/24/14
 * Time: 4:39 PM
 */


function zorka_stylesheet(){
    global $zorka_data;

    $min_suffix = defined( 'ZORKA_SCRIPT_DEBUG' ) && ZORKA_SCRIPT_DEBUG ? '' : '.min';
    $url_font_awesome =  get_template_directory_uri() . '/assets/plugins/fonts-awesome/css/font-awesome.min.css';
    if ( isset( $zorka_data['font-awesome'] ) && !empty($zorka_data['font-awesome']) ) {
        $url_font_awesome = $zorka_data['font-awesome'];
    }
	$url_bootstrap_css = get_template_directory_uri() . '/assets/plugins/bootstrap/css/bootstrap.min.css';
	if ( isset( $zorka_data['bootstrap-css'] ) && !empty($zorka_data['bootstrap-css']) ) {
		$url_bootstrap_css = $zorka_data['bootstrap-css'];
	}
	wp_enqueue_style( 'zorka_bootstrap', $url_bootstrap_css, array() );
	//wp_enqueue_style( 'zorka_font_ProximaNova', get_template_directory_uri() . '/assets/css/proximaNova-fonts'.$min_suffix.'.css', array() );
    wp_enqueue_style( 'zorka_awesome', $url_font_awesome, array() );
    wp_enqueue_style( 'zorka_awesome-animation', get_template_directory_uri() . '/assets/plugins/fonts-awesome/css/font-awesome-animation.min.css', array() );
    wp_enqueue_style( 'zorka_Pe-icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css', array() );

    /*google fonts*/
    $google_fonts = array(
    );

    if (isset($zorka_data['body-font']['face-type']) && ($zorka_data['body-font']['face-type'] == '1') &&
        (!in_array($zorka_data['body-font']['face'],$google_fonts)) &&
        ($zorka_data['body-font']['face'] != 'none')){
        $google_fonts[] = $zorka_data['body-font']['face'];
    }

    if (isset($zorka_data['heading-font']['face-type']) && ($zorka_data['heading-font']['face-type'] == '1') &&
        (!in_array($zorka_data['heading-font']['face'],$google_fonts))&&
        ($zorka_data['heading-font']['face'] != 'none')){
        $google_fonts[] = $zorka_data['heading-font']['face'];
    }

    if (isset($zorka_data['h1-font']['face-type']) && ($zorka_data['h1-font']['face-type'] == '1') &&
        (!in_array($zorka_data['h1-font']['face'],$google_fonts))&&
        ($zorka_data['h1-font']['face'] != 'none')){
        $google_fonts[] = $zorka_data['h1-font']['face'];
    }

    if (isset($zorka_data['h2-font']['face-type']) && ($zorka_data['h2-font']['face-type'] == '1') &&
        (!in_array($zorka_data['h2-font']['face'],$google_fonts))&&
        ($zorka_data['h2-font']['face'] != 'none')){
        $google_fonts[] = $zorka_data['h2-font']['face'];
    }

    if (isset($zorka_data['h3-font']['face-type']) && ($zorka_data['h3-font']['face-type'] == '1') &&
        (!in_array($zorka_data['h3-font']['face'],$google_fonts))&&
        ($zorka_data['h3-font']['face'] != 'none')){
        $google_fonts[] = $zorka_data['h3-font']['face'];
    }

    if (isset($zorka_data['h4-font']['face-type']) && ($zorka_data['h4-font']['face-type'] == '1') &&
        (!in_array($zorka_data['h4-font']['face'],$google_fonts))&&
        ($zorka_data['h4-font']['face'] != 'none')){
        $google_fonts[] = $zorka_data['h4-font']['face'];
    }

    if (isset($zorka_data['h5-font']['face-type']) && ($zorka_data['h5-font']['face-type'] == '1') &&
        (!in_array($zorka_data['h5-font']['face'],$google_fonts))&&
        ($zorka_data['h5-font']['face'] != 'none')){
        $google_fonts[] = $zorka_data['h5-font']['face'];
    }

    if (isset($zorka_data['h6-font']['face-type']) && ($zorka_data['h6-font']['face-type'] == '1') &&
        (!in_array($zorka_data['h6-font']['face'],$google_fonts))&&
        ($zorka_data['h6-font']['face'] != 'none')){
        $google_fonts[] = $zorka_data['h6-font']['face'];
    }

    $fonts = '';
    foreach($google_fonts as $google_font)
    {
        $fonts .= str_replace('','+',$google_font) . ':100,300,400,600,700,900,100italic,300italic,400italic,600italic,700italic,900italic|' .$fonts;
    }
    if ($fonts != '')
    {
        $protocol = is_ssl() ? 'https' : 'http';
        wp_enqueue_style('g5plus-google-fonts', $protocol . '://fonts.googleapis.com/css?family=' . substr_replace( $fonts, "", - 1 )  );
    }

    /* plugin owl-carousel */
    wp_enqueue_style('zorka_plugin-owl-carousel',get_template_directory_uri(). '/assets/plugins/owl-carousel/owl.carousel.min.css', array());
    wp_enqueue_style('zorka_plugin-owl-carousel-theme',get_template_directory_uri(). '/assets/plugins/owl-carousel/owl.theme.min.css', array());
    wp_enqueue_style('zorka_plugin-owl-carousel-transitions',get_template_directory_uri(). '/assets/plugins/owl-carousel/owl.transitions.css', array());



    if (!(defined( 'ZORKA_SCRIPT_DEBUG' ) && ZORKA_SCRIPT_DEBUG)) {
        wp_enqueue_style( 'zorka_style-min', get_template_directory_uri() . '/style.min.css');
    }



    //wp_enqueue_style( 'zorka_style', get_stylesheet_uri() );
}
add_action('wp_enqueue_scripts','zorka_stylesheet', 11);


function zorka_script() {
    global $zorka_data;


    $min_suffix = defined( 'ZORKA_SCRIPT_DEBUG' ) && ZORKA_SCRIPT_DEBUG ? '' : '.min';
    $url_bootstrap = get_template_directory_uri() . '/assets/plugins/bootstrap/js/bootstrap.min.js';
    if ( isset( $zorka_data['bootstrap-js'] ) && !empty($zorka_data['bootstrap-js']) ) {
        $url_bootstrap = $zorka_data['bootstrap-js'];
    }
    wp_enqueue_script( 'zorka_bootstrap', $url_bootstrap, array( 'jquery' ), false, true );

    if (is_single()) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script('zorka_plugins',get_template_directory_uri() . '/assets/js/plugins.js', array(), false,true);


    $smooth_page_scroll = isset($zorka_data['smooth-page-scroll']) ? $zorka_data['smooth-page-scroll'] : 0;
    if ($smooth_page_scroll == 1) {
        wp_enqueue_script('zorka_smoothscroll',get_template_directory_uri() . '/assets/plugins/smoothscroll/SmoothScroll'.$min_suffix.'.js', array(), false,true);
    }
    wp_enqueue_script('zorka_app',get_template_directory_uri() . '/assets/js/app'.$min_suffix.'.js',array(), false, true);

	$action = isset($_GET['action']) ? $_GET['action'] : '';
    if (isset($zorka_data['show-panel-selector-style']) && ($zorka_data['show-panel-selector-style'] == '1') && $action != 'yith-woocompare-view-table') {
        wp_enqueue_script('zorka-panel-selector-style',get_template_directory_uri() . '/assets/js/panel-style-selector'.$min_suffix.'.js',array(), false, true);
    }




    // Localize the script with new data
    $translation_array = array(
        'product_compare' => esc_html__('Compare','zorka'),
        'product_wishList' => esc_html__('WishList','zorka'),
        'product_add_to_cart' => esc_html__('Add to cart','zorka'),
        'product_view_cart' => esc_html__('View cart','zorka')
    );
    wp_localize_script( 'zorka_app', 'zorka_constant', $translation_array );

    wp_localize_script('zorka_app' , 'zorka_ajax_url' , get_site_url() . '/wp-admin/admin-ajax.php?activate-multi=true' );
    wp_localize_script('zorka_app' , 'zorka_theme_url' , THEME_URL);
    wp_localize_script('zorka_app' , 'zorka_site_url' , site_url());



}
add_action('wp_enqueue_scripts','zorka_script');

if (is_admin()) {
    /*Register admin script and css*/
    function zorka_admin_stylesheet(){

        wp_enqueue_script('zorka-plugin-select2',get_template_directory_uri() . '/assets/admin/js/jquery.select2/select2.min.js', false, true);
        wp_enqueue_style('zorka-plugin-select2',get_template_directory_uri(). '/assets/admin/js/jquery.select2/select2.css', array());

        wp_enqueue_script('g5plus-media-init',get_template_directory_uri() . '/assets/admin/js/g5plus-media-init.js', false, true);
        wp_enqueue_style( 'g5plus_admin_css', get_template_directory_uri() . '/assets/admin/css/template.css', false, '1.0.0' );
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
    }
    add_action('admin_enqueue_scripts','zorka_admin_stylesheet');
    add_editor_style(get_template_directory_uri() . '/assets/plugins/fonts-awesome/css/font-awesome.min.css');

    /*
	 * Load script and css for icon box control
	 */
    function g5plus_popup_icon_script() {
        wp_register_style( 'g5plus_popup_icon_css', get_template_directory_uri() . '/assets/admin/css/popup-icon.css', false, '1.0.0' );
        wp_enqueue_style( 'g5plus_popup_icon_css' );

        global $zorka_data;

        $url_font_awesome =  get_template_directory_uri() . '/assets/plugins/fonts-awesome/css/font-awesome.min.css';
        if ( isset( $zorka_data['font-awesome'] ) && !empty($zorka_data['font-awesome']) ) {
            $url_font_awesome = $zorka_data['font-awesome'];
        }
        wp_enqueue_style( 'zorka_awesome', $url_font_awesome, array() );
        wp_enqueue_style( 'zorka_Pe-icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css', array() );
        wp_register_script('g5plus_popup_icon_js', get_template_directory_uri() . '/assets/admin/js/popup-icon.js', false, '1.0' );
        wp_enqueue_script( 'g5plus_popup_icon_js' );

        $wnm_custom = array( 'theme_url' => THEME_URL );
        wp_localize_script( 'g5plus_popup_icon_js', 'g5Constant', $wnm_custom );
        wp_localize_script('g5plus_popup_icon_js' , 'zorka_ajax_url' , get_site_url() . '/wp-admin/admin-ajax.php?activate-multi=true' );


    }
    add_action( 'admin_enqueue_scripts', 'g5plus_popup_icon_script' );

}

