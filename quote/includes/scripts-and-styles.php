<?php 

//==========================================================
// ===  SCRIPTS AND STYLES
//==========================================================
if( ! function_exists('distinctivethemes_scripts') ){

// adding scripts
    add_action('wp_enqueue_scripts', 'distinctivethemes_scripts');

    function distinctivethemes_scripts() {

    // Javascripts
        wp_enqueue_script('quote-bootstrap-js',   get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'));
        wp_enqueue_script('quote-googlemap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCWDPCiH080dNCTYC-uprmLOn2mt2BMSUk&amp;sensor=true', array( 'jquery' ), '', true );
        wp_enqueue_script('quote-plugins',        get_template_directory_uri() . '/assets/js/plugins.js');
        wp_enqueue_script('quote-main-js',        get_template_directory_uri() . '/assets/js/init.js');

    // Stylesheet
        wp_enqueue_style('quote-bootstrap-min',   get_template_directory_uri() . '/assets/css/bootstrap.css');
        wp_enqueue_style('quote-animate',         get_template_directory_uri() . '/assets/css/animate.css');
        wp_enqueue_style('quote-fontawesome',     get_template_directory_uri() . '/assets/css/font-awesome.min.css');
        wp_enqueue_style('quote-pe-icons',        get_template_directory_uri() . '/assets/css/pe-icons.css');    
        wp_enqueue_style('quote-style',           get_template_directory_uri() . '/style.css');
    }
}

//==========================================================
// === LOAD OUR FONT
//==========================================================
function distinctivethemes_quote_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'quote-lato', "$protocol://fonts.googleapis.com/css?family=Lato:300,400,700'" );
    wp_enqueue_style( 'quote-cabin', "$protocol://fonts.googleapis.com/css?family=Cabin:300,400,700,900'" );
}

add_action( 'wp_enqueue_scripts', 'distinctivethemes_quote_fonts' );

?>