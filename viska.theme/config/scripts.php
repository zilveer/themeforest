<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/15/14
 * Time: 1:20 PM
 */

/**
 * Loading scripts
 */
function loading_script()
{
    global $customize;
    $customize_intro = json_decode(urldecode($customize['intro_bg_data']),true);
    $is_customize_mode =  (has_action( 'customize_controls_init' )) ? true : false;
    if(AWE_DEBUG==true)
        $min=".min";
    else
        $min="";
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'jquery-nav', get_template_directory_uri()."/assets/js/jquery.nav.js", array(), null, true );
    wp_enqueue_script( 'jquery-matchHeight', get_template_directory_uri()."/assets/js/jquery.matchHeight-min.js", array(), null, true );
    if(is_page_template('home-page.php') || $is_customize_mode == true )
    {
        wp_enqueue_script('jquery-matchHeight');
        wp_enqueue_script( 'jquery-easing', get_template_directory_uri()."/assets/js/jquery.easing.min.js", array(), null, true );
        wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri()."/assets/js/jquery.fitvids.js", array(), null, true );
        if($customize['porfolio_display']=='expanding')
        {
            wp_enqueue_script( 'ajax-load-project', get_template_directory_uri()."/assets/js/ajax-load-project".$min.".js", array(), null, true );
        }
        if($customize_intro['type'] == 'slider' || $is_customize_mode == true)
        {
            wp_enqueue_script( 'jquery-autosize', get_template_directory_uri()."/assets/js/jquery.superslides.min.js", array(), null, true );
        }
        if($customize['porfolio_display']=='lightbox')
        {
            wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri().'/assets/js/jquery.magnific-popup.min.js', array(), null, true);
        }
        
        
        wp_enqueue_script( 'jquery-countTo', get_template_directory_uri()."/assets/js/jquery.countTo.js", array(), null, true );
        wp_enqueue_script( 'jquery-isotope', get_template_directory_uri()."/assets/js/jquery.isotope.min.js", array(), null, true );
        
        wp_enqueue_script( 'jquery-piechart', get_template_directory_uri()."/assets/js/jquery.easypiechart.min.js", array(), null, true);
        wp_enqueue_script( 'jquery-appear', get_template_directory_uri()."/assets/js/jquery.appear.min.js", array(), null, true );
        
        if($customize_intro['type'] == 'video' || $is_customize_mode == true){
            wp_enqueue_script( 'jquery-YTPlayer', get_template_directory_uri()."/assets/js/jquery.mb.YTPlayer.js", array(), null, true );
        }
        wp_enqueue_script( 'jquery-wow', get_template_directory_uri()."/assets/js/jquery.wow.min.js", array(), null, true );
        wp_enqueue_script( 'google-map', "//maps.google.com/maps/api/js?sensor=false", array(), null, true );

    }
    wp_enqueue_script( 'jquery-sticky', get_template_directory_uri()."/assets/js/jquery.sticky.js", array(), null, true );
    wp_enqueue_script( 'jquery-carousel', get_template_directory_uri()."/assets/js/jquery.owl.carousel.js", array(), null, true );
    wp_enqueue_script( 'jquery-parallax', get_template_directory_uri()."/assets/js/jquery.parallax-1.1.3.js", array(), null, true );
    
    // enqueue blog masonry for blog masonry temaplte
    if(is_page_template('blog-masonry.php')){
        wp_enqueue_script( 'jquery-isotope', get_template_directory_uri()."/assets/js/jquery.isotope.min.js", array(), null, true );
        wp_enqueue_script( 'jquery-infinitescroll', get_template_directory_uri()."/assets/js/jquery.infinitescroll.min.js", array(), null, true );
        wp_enqueue_script( 'blog-masonry', get_template_directory_uri()."/assets/js/blog-masonry.js", array(), null, true );
        wp_localize_script( 'blog-masonry', 'image_loader' , array('url'=>get_template_directory_uri().'/assets/images/loader.gif'));
    }

    
    wp_enqueue_script( 'jquery-rentina', get_template_directory_uri().'/assets/js/retina.min.js', array(), null, true);
    
    //
    if(is_page_template('home-page.php') || $is_customize_mode == true)
    {
        wp_enqueue_script('jquery-home-custom', get_template_directory_uri() .'/assets/js/jquery.homecustom'.$min.'.js', array(), null, true);
    }
    if(!is_page_template('home-page.php')){
        wp_enqueue_script( 'jquery-custom', get_template_directory_uri()."/assets/js/jquery.custom".$min.".js", array(), null, true );
    }
}
add_action('wp_enqueue_scripts', 'loading_script', 100);

/**
 * Loading Style CSS
 */
function loading_style()
{   
    global $customize;
    $options = get_options();
    
    wp_enqueue_style('boostrap', get_template_directory_uri() . '/assets/css/bootstrap.css', false, false);
    wp_enqueue_style('viska-style', get_template_directory_uri() . '/assets/css/style.css', false, false);

    wp_enqueue_style('viska-font', get_template_directory_uri() . '/assets/css/font-awesome-4.2.0/css/font-awesome.min.css', false, false);


    if(!is_page_template('home-page.php') || !is_home()){
        wp_enqueue_style('viska-blog', get_template_directory_uri() . '/assets/css/blog.css', false, false);
        //wp_enqueue_style('viska-blog-reset', get_template_directory_uri(). '/assets/css/cssblog.css', false, false );
    }
    wp_enqueue_style('viska-animate', get_template_directory_uri() . '/assets/css/animate.css', false, false);
    wp_enqueue_style('viska-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', false, false);
    wp_enqueue_style('responsive', get_template_directory_uri() .'/assets/css/responsive.css', false,false);
    $char_color = $customize['style_color'];
    switch($char_color){
        case 'color-blue':
            wp_enqueue_style('awe-color', get_template_directory_uri(). '/assets/css/colors/blue.css',false,false);
            break;
        case 'color-red':
            wp_enqueue_style('awe-color', get_template_directory_uri(). '/assets/css/colors/red.css',false,false);
            break;
        case 'color-cyan':
            wp_enqueue_style('awe-color', get_template_directory_uri(). '/assets/css/colors/cyan.css',false,false);
            break;
        case 'color-purple':
            wp_enqueue_style('awe-color', get_template_directory_uri(). '/assets/css/colors/purple.css',false,false);
            break;               
        case 'color-yellow':
            wp_enqueue_style('awe-color', get_template_directory_uri(). '/assets/css/colors/yellow.css',false,false);
            break;
        case 'color-green':
            wp_enqueue_style('awe-color', get_template_directory_uri(). '/assets/css/colors/green.css',false,false);
            break;
        default:
            wp_enqueue_style('awe-color', get_template_directory_uri(). '/assets/css/colors/viska-color-css.css',false,false);
            break;
    }
    if($customize['porfolio_display'] == 'lightbox'){
        wp_enqueue_style('magnific-popup', get_template_directory_uri().'/assets/css/magnific-popup.css',false,false);
    }
    wp_enqueue_style( 'viska-custom', get_template_directory_uri(). '/assets/css/custom.css',false ,false);
    wp_enqueue_style( 'viska', get_stylesheet_uri() );
}
add_action('wp_enqueue_scripts', 'loading_style', 100);

function loading_font()
{
    echo '<link id="font-frame-css" href="'. ( is_ssl() ? 'https' : 'http' ) .'://fonts.googleapis.com/css?family=Raleway:300,400,700,900" rel="stylesheet" type="text/css">'."\n";
    echo '<link id="font-frame-css-2" href="'. ( is_ssl() ? 'https' : 'http' ) .'://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet" type="text/css">'."\n";
}   

add_action('wp_head','loading_font');