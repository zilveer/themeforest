<?php
//=========================================
// Enqueue all Evential CSS
//=========================================	
function evential_all_default_style()
{
	wp_enqueue_style( 'style', get_stylesheet_uri());
    wp_enqueue_style('prettyPhoto-css', get_template_directory_uri().'/css/bootstrap.css');
    wp_enqueue_style('jui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-darkness/jquery-ui.css');
    wp_enqueue_style('flexslider-css', get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style('awesome-css', get_template_directory_uri().'/css/jquery.countdown.css');
    wp_enqueue_style('popup-css', get_template_directory_uri().'/css/magnific-popup.css');
    wp_enqueue_style('flipCard-css', get_template_directory_uri().'/css/flipCard.css');
    wp_enqueue_style('carousel-css', get_template_directory_uri().'/css/owl.carousel.css');
    wp_enqueue_style('owl-css', get_template_directory_uri().'/css/owl.theme.css');
    wp_enqueue_style('theme-css', get_template_directory_uri().'/css/main.css');
    wp_enqueue_style('green-css', get_template_directory_uri().'/css/green.css');
    wp_enqueue_style('color-css', get_template_directory_uri().'/css/theme.css');
}

// Google Font //
function evential_google_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'mytheme-roboto', "$protocol://fonts.googleapis.com/css?family=Economica:400,700" );}

// Editor Style //

function evential_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}

//=========================================
// Enqueue all Evential JS
//=========================================
function evential_all_default_script()
{
	wp_enqueue_script('modernizr-js', get_template_directory_uri().'/js/modernizr.custom.00695.js', array( 'jquery' ), '', true);
	wp_enqueue_script('gmap-js', 'https://maps.google.com/maps/api/js?sensor=false', array( 'modernizr-js' ), '', true );
	wp_enqueue_script('uis-js', 'https://code.jquery.com/ui/1.11.2/jquery-ui.js', array( 'gmap-js' ), '', true );
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array( 'uis-js' ), '', true );
	wp_enqueue_script('countdown-js', get_template_directory_uri().'/js/jquery.countdown.js', array( 'bootstrap-js' ), '', true );
	wp_enqueue_script('carousel-js', get_template_directory_uri().'/js/owl.carousel.min.js', array( 'countdown-js' ), '', true );
	wp_enqueue_script('magnific-js', get_template_directory_uri().'/js/jquery.magnific-popup.min.js', array( 'carousel-js' ), '', true );
	wp_enqueue_script('countTo-js', get_template_directory_uri().'/js/jquery.countTo.js', array( 'magnific-js' ), '', true );
	wp_enqueue_script('flipCard-js', get_template_directory_uri().'/js/flipCard.js', array( 'countTo-js' ), '', true );
	wp_enqueue_script('stellar-js', get_template_directory_uri().'/js/jquery.stellar.min.js', array( 'flipCard-js' ), '', true );
	wp_enqueue_script('scroll-js', get_template_directory_uri().'/js/smooth-scroll.js', array( 'stellar-js' ), '', true );
	wp_enqueue_script('nicescroll-js', get_template_directory_uri().'/js/jquery.nicescroll.min.js', array( 'scroll-js' ), '', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
    }
}