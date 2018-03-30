<?php
ob_start();

require_once ('admin/index.php');
load_theme_textdomain( THEMENAME, get_template_directory().'/languages');
// Register Navigation
add_action('init', 'cshero_register_menu');
add_theme_support( 'woocommerce' );
add_filter('widget_text', 'do_shortcode');
/*
 * Css
 */
add_action( 'wp_enqueue_scripts', 			'cshero_css' );
/*
 * Js
 */
add_action( 'wp_enqueue_scripts', 			'cshero_js' );
/*
 * Header
 */
add_action( 'wp_head', 						'cshero_favicon' );
/*
 * VC Template
 */
if(function_exists("vc_set_shortcodes_templates_dir")){
	vc_set_shortcodes_templates_dir(get_stylesheet_directory()."/vc_templates/");
}
/*
* TGM
*/
require_once(ADMIN_PATH . 'tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once(ADMIN_PATH . 'tgm-plugin-activation/plugin-options.php');

function cshero_register_menu(){
    register_nav_menu('main_navigation', __('Main Navigation',THEMENAME));
    register_nav_menu('top_navigation', __('Top Navigation',THEMENAME));
    register_nav_menu('left_navigation', __('Left Navigation',THEMENAME));
    register_nav_menu('right_navigation', __('Right Navigation',THEMENAME));
    register_nav_menu('404_pages', __('404 Useful Pages',THEMENAME));
    register_nav_menu('sticky_navigation', __('Sticky Header Navigation',THEMENAME));
}
/*
 * Favicon
 */
function cshero_favicon(){
	global $smof_data;
	$icon = get_stylesheet_directory_uri()."/favicon.ico";
	if(!empty($smof_data['favicon']['url'])){
		$icon = $smof_data['favicon']['url'];
	}
	echo '<link type="image/x-icon" href="'.esc_url($icon).'" rel="shortcut icon">';
}
/** Generate Dynamic Css */
add_action('cshero_generate_dynamic', 'cshero_generate_dynamic_css',10,1);

function cshero_generate_dynamic_css(){
    global $smof_data;
    if(count($smof_data) > 1){
        $css_dir = get_template_directory() . '/framework/dynamic/'; // Shorten code, save 1 call
        ob_start(); // Capture all output (output buffering)

        require($css_dir . 'dynamic.main.php'); // Generate CSS

        $css = ob_get_clean(); // Get generated CSS (output buffering)
        file_put_contents(get_template_directory().'/css/' . 'dynamic.css', $css, LOCK_EX); // Save it
    }
}
do_action('cshero_generate_dynamic');
function cshero_css(){
	global $smof_data;

	/* register */
	wp_register_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css',array(), '3.2.0');
	wp_register_style('colorbox', get_template_directory_uri().'/css/colorbox.css', array(), '1.5.10');
	wp_register_style('font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', array(), '4.1.0');
	wp_register_style('font-ionicons', get_template_directory_uri().'/css/ionicons.min.css', array(), '2.0.0');
	wp_register_style('font-strokeicon-help', get_template_directory_uri().'/css/helper.css', array(), '1.5.2');
	wp_register_style('font-strokeicon', get_template_directory_uri().'/css/pe-icon-7-stroke.css', array(), '1.5.2');
	wp_register_style('widget_cart_search_scripts', get_template_directory_uri() . '/framework/widgets/widgets.css');
	/* load base style */
	wp_enqueue_style( 'bootstrap' );
	if ($smof_data["use_font_awesome"] == '1') {
		wp_enqueue_style( 'font-awesome' );
	}
	if ($smof_data["use_font_ionicons"] == '1') {
	    wp_enqueue_style( 'font-ionicons' );
	}
	if ($smof_data["use_font_pestroke"] == '1') {
	    wp_enqueue_style( 'font-strokeicon-help' );
	    wp_enqueue_style( 'font-strokeicon' );
	}
	wp_enqueue_style( 'animate-elements', get_template_directory_uri() . "/css/cs-animate-elements.css", array(), '1.0.0');
	if(class_exists('WooCommerce')){
		wp_enqueue_style( 'woocommerce', get_template_directory_uri() . "/css/woocommerce.css", array(), '1.0.0');
	}
	/*end prefix*/
	wp_enqueue_style( 'style', get_template_directory_uri() . "/style.css", array(), '1.0.0');

    if(cshero_getHeader()=='v4'){
        wp_enqueue_style('headerleft', get_template_directory_uri().'/css/headerleft.css',array(), '1.0');
    }
    wp_enqueue_style('dynamic-main',get_template_directory_uri().'/css/dynamic.css');

}
/*
 * Cshero JS
 */
function cshero_js(){
	global $smof_data;
	/* register */
	wp_register_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js',array(), '3.2.0');
	wp_register_script( 'jquery-easing', get_template_directory_uri().'/js/jquery.easing.min.js',array(), '1.3.1', true);
	wp_register_script( 'jquery-colorbox', get_template_directory_uri() . '/js/jquery.colorbox.min.js', array(), '1.5.10',true);
	wp_register_script( 'masonry-pkgd', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), '3.1.5',true);
	wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', 'jquery', '1.0', TRUE);
	wp_register_script('jm-bxslider', get_template_directory_uri() . '/js/jquery.jm-bxslider.js', 'jquery', '1.0', TRUE);
	if($smof_data['smooth_scroll'] == '1'){
        wp_register_script( 'smoothscroll', get_template_directory_uri().'/js/cs-smoothscroll.min.js', 'jquery', '1.0', TRUE);
        wp_enqueue_script( 'smoothscroll' );
    }
    wp_register_script('widget_cart_search_scripts', get_template_directory_uri() . '/framework/widgets/widgets.js', 'jquery', '1.0', TRUE);
	/* load base script */
	wp_enqueue_script("jquery");
	wp_enqueue_script( 'bootstrap');

	wp_deregister_script( 'jquery-cookie' );
	wp_enqueue_script( 'parallax', get_template_directory_uri().'/js/cs_parallax.js', 'jquery', '1.0', TRUE);
	wp_enqueue_script( 'jquery-cookie', get_template_directory_uri().'/js/jquery_cookie.min.js', 'jquery', '1.0', TRUE);

    wp_enqueue_script( 'megamenu', get_template_directory_uri().'/js/megamenu.js',array(), '1.0.0', 'jquery', '1.0', TRUE);
    wp_enqueue_script( 'mousewheel', get_template_directory_uri().'/js/jquery.mousewheel.min.js',array(), '1.0.0', true);
    wp_enqueue_script( 'main', get_template_directory_uri().'/js/main.js',array(), '1.0.0',true);

    $show_sticky_header = $smof_data['header_sticky'];
    if(is_page()){
        if(get_post_meta(get_the_ID(), 'cs_show_sticky_header', true) == 'show'){
            $show_sticky_header = '1';
        }
        if(get_post_meta(get_the_ID(), 'cs_onepage', true)){
            $onepage_speed = get_post_meta(get_the_ID(), 'cs_onepage_speed', true) ? get_post_meta(get_the_ID(), 'cs_onepage_speed', true) :'750';
            $onepage_offset = get_post_meta(get_the_ID(), 'cs_onepage_offset', true) ? get_post_meta(get_the_ID(), 'cs_onepage_offset', true) :'0';
            $onepage_easing = get_post_meta(get_the_ID(), 'cs_onepage_easing', true) ? get_post_meta(get_the_ID(), 'cs_onepage_easing', true) :'jswing';

            wp_enqueue_script( 'jquery-easing' );
            wp_enqueue_script( 'jquery-nav', get_template_directory_uri().'/js/jquery.nav.js',array(), '3.0.0',true);
            wp_register_script( 'custom-nav', get_template_directory_uri().'/js/custom-nav.js',array(), '1.0.0',true);
            wp_localize_script( 'custom-nav', 'one_page', array('scrollSpeed'=>$onepage_speed, 'scrollOffset'=>$onepage_offset, 'easing'=>$onepage_easing) );
            wp_enqueue_script( 'custom-nav' );
        }
    }
    
    if(class_exists('WooCommerce') && is_woocommerce()){
        wp_enqueue_script('bxslider');
    }
    
	if($show_sticky_header == '1'){
		wp_enqueue_script( 'sticky', get_template_directory_uri().'/js/sticky.js',array(), '1.0.0',true);
	}
    if( $smof_data['page_loader'] == '1'){
        wp_enqueue_script( 'pageloading', get_template_directory_uri().'/js/pageloading.js', 'jquery', '1.0', TRUE);
        wp_enqueue_script( 'pageloading-greensock', get_template_directory_uri().'/js/greensock/minified/TweenMax.min.js');
        wp_enqueue_script( 'pageloading-greensock2', get_template_directory_uri().'/js/greensock/minified/plugins/DrawSVGPlugin.min.js');
    }
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        // enqueue the javascript that performs in-link comment reply fanciness
        wp_enqueue_script( 'comment-reply' );
    }
}

/**
 * Load admin ajax url.
 */
function cshero_ajax_url_wp_head() {
    echo '<script type="text/javascript"> var ajaxurl = "'.admin_url('admin-ajax.php').'"; </script>';
}
add_action( 'wp_head', 'cshero_ajax_url_wp_head');

/*
 * Cshero CSS
 */
function cshero_getCSSite(){
    $blog = explode('/', home_url());
    $name=$blog[count($blog)-1];
    if(get_option('cs-body-class','-1')!='-1'){
        $name=get_option('cs-body-class');
    }
    if(strstr($name,'cms_piero')){
    	update_option('cs-body-class',$name);
    }
    else{
    	$name='cms_piero';
    }
    return $name;
}
/*
* Modify default widget search form
*/

function cshero_search_form_modify( $html ) {
	return str_replace( 'type="text"', 'type="text" placeholder="Search..."', $html );
}
add_filter( 'get_search_form', 'cshero_search_form_modify' );

/**
 * minimize CSS styles
 *
 * @since 1.1.0
 */
function cshero_compressCss($buffer){

    /* remove comments */
    $buffer = preg_replace("!/\*[^*]*\*+([^/][^*]*\*+)*/!", "", $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace("	", " ", $buffer); //replace tab with space
    $arr = array("\r\n", "\r", "\n", "\t", "  ", "    ", "    ");
    $rep = array("", "", "", "", " ", " ", " ");
    $buffer = str_replace($arr, $rep, $buffer);
    /* remove whitespaces around {}:, */
    $buffer = preg_replace("/\s*([\{\}:,])\s*/", "$1", $buffer);
    /* remove last ; */
    $buffer = str_replace(';}', "}", $buffer);

    return $buffer;
}

if ( is_singular() ){ wp_enqueue_script( "comment-reply" );}
#-----------------------------------------------------------------#
# Content Width
# T_add
#-----------------------------------------------------------------#
if (!isset( $content_width )) $content_width = '669px';
#-----------------------------------------------------------------#
# Load Header
# T_add
#-----------------------------------------------------------------#
add_action( 'wp_head', 'cshero_header_custom_css' );
function cshero_header_custom_css(){
	global $smof_data,$header_setings,$post;
	$id = 0;
	$pageHeader = '';
	if(!empty($post)){
	    $pageHeader = get_post_meta($post->ID, 'cs_page_header', true);
	};
	if(empty($pageHeader) || $pageHeader=='0'){
		if($smof_data["header_layout"]!='custom'){
			return;
		}else{
			$id=(int)str_replace('cs-header-', '', $smof_data["cs-header-id"]);
		}
	}
	else{
		if(!strstr($pageHeader,'cs-header-')){
			return;
		}else{
			$id=(int)str_replace('cs-header-', '', $pageHeader);
		}
	}
	if ( $id ) {
		$shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
		if ( ! empty( $shortcodes_custom_css ) ) {
			echo '<style type="text/css" data-type="vc_shortcodes-custom-css-2">';
			echo $shortcodes_custom_css;
			echo '</style>';
		}
	}
}
function cshero_header(){
	global $smof_data,$header_setings,$post;
	if($header_setings->header_fixed!='1'){
		$header_setings->header_fixed = get_post_meta(get_the_ID(),'cs_header_fixed_top',true);
	}
	$pageHeader = '';
	if(!empty($post)){
	    $pageHeader = get_post_meta($post->ID, 'cs_page_header', true);
	}
	if(empty($pageHeader) || $pageHeader=='0'){
		if($smof_data["header_layout"]!='custom'){
			get_template_part('framework/headers/header',$smof_data["header_layout"]);
		} else{
			?>
			<header id="cshero-header" class="cshero-header cs-header-custom<?php if($header_setings->header_fixed == '1'){ echo ' transparentFixed';} ?>">
			<?php
			echo do_shortcode(get_post(str_replace('cs-header-', '', $smof_data["cs-header-id"]))->post_content);
			get_template_part('framework/headers/sticky-header');
			?>
			</header>
			<?php
		}
	}
	else{
		if(strstr($pageHeader,'cs-header-')){

			?>
			<header id="cshero-header" class="cshero-header cs-header-custom<?php if($header_setings->header_fixed == '1'){ echo ' transparentFixed';} ?>">
			<?php
			echo do_shortcode(get_post(str_replace('cs-header-', '', $pageHeader))->post_content);
			get_template_part('framework/headers/sticky-header');
			?>
			</header>
			<?php
		}
		else{
			get_template_part('framework/headers/header',$pageHeader);
		}
	}

}
function cshero_getHeader(){
	global $smof_data,$header_setings,$post;

	$pageHeader = '';
	if(!empty($post)){
	    $pageHeader = get_post_meta($post->ID, 'cs_page_header', true);
	}
	if(empty($pageHeader) || $pageHeader=='0'){
		if($smof_data["header_layout"]!='custom'){
			return $smof_data["header_layout"];
		} else{
			return $smof_data["cs-header-id"];
		}
	}
	else{
		return $pageHeader;
	}
}
/*social share list*/
function cshero_socials_share($url,$image='',$title='',$comment_link=''){
	ob_start();
	?>
	<div class="post-share">
		<span class="">Share</span>
		<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($url);?>"><span class="share-box"><i class="fa fa-facebook"></i></span></a>
		<a target="_blank" href="https://twitter.com/home?status=<?php echo urlencode(__('Check out this article',THEMENAME));?>:%20<?php echo urlencode($title);?>%20-%20<?php echo urlencode($url);?>"><span class="share-box"><i class="fa fa-twitter"></i></span></a>
		<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode($url);?>&amp;media=<?php echo urlencode($image);?>&amp;description=<?php echo urlencode($title);?>"><span class="share-box"><i class="fa fa-pinterest"></i></span></a>
		<a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($url);?>"><span class="share-box"><i class="fa fa-google-plus"></i></span></a>
		<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode($url);?>&amp;title=<?php echo urlencode($title);?>"><span class="share-box"><i class="fa fa-linkedin"></i></span></a>
		<?php if($comment_link!=''){
			?><a href="<?php echo esc_url($comment_link);?>"><span class="share-box"><i class="fa fa-comment"></i></span></a><?php
		}?>
	</div>
	<?php
	return ob_get_clean();
}
#-----------------------------------------------------------------#
# Load footer
# T_add
#-----------------------------------------------------------------#
function cshero_footer(){
	global $smof_data;
	switch ($smof_data["footer_layout"]){
		case 'f1':
			get_template_part('framework/footer/footer-v1');
			break;
		case 'f2':
			get_template_part('framework/footer/footer-v2');
		break;
	}
}
add_theme_support( "title-tag" );
add_theme_support( 'custom-header');
add_theme_support( 'custom-background');
add_theme_support('woocommerce');
// Default RSS feed links
add_theme_support('automatic-feed-links');
// Post Formats
add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat'));
#-----------------------------------------------------------------#
# Add post thumbnail functionality
# T_add
#-----------------------------------------------------------------#
add_theme_support('post-thumbnails');
add_image_size('related-img', 180, 138, true);
add_image_size('portfolio-one', 540, 272, true);
add_image_size('portfolio-two', 460, 295, true);
add_image_size('portfolio-three', 300, 214, true);
add_image_size('portfolio-four', 220, 161, true);
add_image_size('portfolio-full', 940, 400, true);
add_image_size('recent-posts', 700, 441, true);
add_image_size('recent-works-thumbnail', 66, 66, true);
add_image_size( 'masonry-thumb', 500 );

// Register widgetized locations
if(function_exists('register_sidebar')) {
	register_sidebar(array(
	'name' => 'Blog Sidebar',
	'id' => 'cshero-blog-sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="heading"><h3 class="wg-title"><span>',
	'after_title' => '</span></h3></div>',
	));
	register_sidebar(array(
	'name' => 'Sidebar Left',
	'id' => 'cshero-widget-left',
	'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
	'after_widget' => '<div style="clear:both;"></div></div>',
	'before_title' => '<h3 class="wg-title"><span>',
	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
	'name' => 'Sidebar Right',
	'id' => 'cshero-widget-right',
	'before_widget' => '<div id="%1$s" class="header-top-widget-col right-widget-wrap %2$s">',
	'after_widget' => '<div style="clear:both;"></div></div>',
	'before_title' => '<h3 class="wg-title"><span>',
	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
	'name' => 'Sidebar Hidden Menu',
	'id' => 'cshero-widget-hidden-menu',
	'before_widget' => '<div id="%1$s" class="hidden-menu-widget-col %2$s">',
	'after_widget' => '<div style="clear:both;"></div></div>',
	'before_title' => '<h3 class="wg-title"><span>',
	'after_title' => '</span></h3>',
	));
    register_sidebar(array(
        'name' => 'Header Top Widget 1',
        'id' => 'cshero-header-top-widget-1',
        'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Top Widget 2',
        'id' => 'cshero-header-top-widget-2',
        'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Top 2 Widget 1',
        'id' => 'cshero-header-top2-widget-1',
        'before_widget' => '<div id="%1$s" class="header-top-widget2-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Top 2 Widget 2',
        'id' => 'cshero-header-top2-widget-2',
        'before_widget' => '<div id="%1$s" class="header-top-widget2-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Content Widget 1',
        'id' => 'cshero-header-content-widget-1',
        'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Content Widget 2',
        'id' => 'cshero-header-content-widget-2',
        'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Fixed Left/Right Content Widget',
        'id' => 'cshero-header-fixed-content-widget',
        'before_widget' => '<div id="%1$s" class="header-fixed-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom Widget 1',
        'id' => 'cshero-bottom-widget-1',
        'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom Widget 2',
        'id' => 'cshero-bottom-widget-2',
        'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom Widget 3',
        'id' => 'cshero-bottom-widget-3',
        'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom Widget 4',
        'id' => 'cshero-bottom-widget-4',
        'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
	register_sidebar(array(
    	'name' => 'Footer Widget 1',
    	'id' => 'cshero-footer-widget-1',
    	'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Widget 2',
    	'id' => 'cshero-footer-widget-2',
    	'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Widget 3',
    	'id' => 'cshero-footer-widget-3',
    	'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Widget 4',
    	'id' => 'cshero-footer-widget-4',
    	'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Bottom Widget 1',
    	'id' => 'cshero-slidingbar-bottom-widget-1',
    	'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Bottom Widget 2',
    	'id' => 'cshero-slidingbar-bottom-widget-2',
    	'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
    register_sidebar(array(
        'name' => 'Newsletter',
        'id' => 'cshero-slidingbar-newsletter',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
    register_sidebar(array(
        'name' => 'Woocommerce Sidebar',
        'id' => 'woocommerce_sidebar',
        'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Woocommerce Full Width',
        'id' => 'woocommerce_wg_full_width',
        'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
	register_sidebar(array(
        'name' => 'Megamenu Sidebar 1',
        'id' => 'megamenu_sidebar1',
        'before_widget' => '<div class="slidingbar-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
    ));
	register_sidebar(array(
        'name' => 'Megamenu Sidebar 2',
        'id' => 'megamenu_sidebar2',
        'before_widget' => '<div class="slidingbar-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
    ));
	register_sidebar(array(
        'name' => 'Megamenu Sidebar 3',
        'id' => 'megamenu_sidebar3',
        'before_widget' => '<div class="slidingbar-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
    	'name' => 'Debug',
    	'id' => 'cshero-debug-widget',
    	'before_widget' => '<div id="%1$s" class="debug-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'Widget In Content',
		'id' => 'cshero-widget-in-content',
		'before_widget' => '<div class="widget-in-content %2$s">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'Search Widget Area',
		'id' => 'cshero-search-area',
		'before_widget' => '<div class="widget-in-content %2$s">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	));
}
#-----------------------------------------------------------------#
# register widget footer bottom
#-----------------------------------------------------------------#
function cshero_sidebar_header_top(){
	global $smof_data;
	if($smof_data['header_top_widgets']){
		for ($i = 1 ; $i <= (int)$smof_data['header_top_widgets_columns']; $i++){
			echo "<div class='header-top-".$i." ".esc_attr($smof_data['header_top_widgets_'.$i.''])."'>";
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Top Widget $i")):
			endif;
			echo "</div>";
		}
	}
}
#-----------------------------------------------------------------#
# register widget footer top
#-----------------------------------------------------------------#
function cshero_sidebar_footer_top(){
	global $smof_data;
	if($smof_data['footer_top_widgets']){
		for ($i = 1 ; $i <= (int)$smof_data['footer_top_widgets_columns']; $i++){
			echo "<div class='footer-top-".$i." ".esc_attr($smof_data['footer_top_widgets_'.$i.''])."'>";
			dynamic_sidebar("cshero-footer-widget-$i");
			echo "</div>";
		}
	}
}
#-----------------------------------------------------------------#
# register widget footer bottom
# T_add
#-----------------------------------------------------------------#
function cshero_sidebar_footer_bottom(){
	global $smof_data;
	if($smof_data['footer_bottom_widgets']){
	 for ($i = 1 ; $i <= (int)$smof_data['footer_bottom_widgets_columns']; $i++){
	 	echo "<div class='footer-bottom-".$i." ".esc_attr($smof_data['footer_bottom_widgets_'.$i.''])."'>";
	 	dynamic_sidebar("cshero-slidingbar-bottom-widget-$i");
	 	echo "</div>";
		}
	}
}
if(!function_exists('cshero_generetor_blog_layout')){
	function cshero_generetor_blog_layout() {
		global $smof_data,$cat;
		$layout = new stdClass();
		$layout->blog = 'col-md-12';
		$layout->left_col = null;
		$layout->right_col = null;
		$layout->class = '';
		$cat_data = get_option("category_".$cat);
		$category_layout = $smof_data['blog_layout'];

		if(is_category() && !empty($cat_data)){
			if($cat_data['category_layout'] && $cat_data['category_layout'] != 'default'){
				$category_layout = $cat_data['category_layout'];
			}
		}
		$main = 'col-xs-12 col-sm-9 col-md-9 col-lg-9';
		$sidebar_col = 'col-xs-12 col-sm-3 col-md-3 col-lg-3';

		if($category_layout){
			if ( is_active_sidebar( 'cshero-blog-sidebar' ) && $category_layout == 'left-fixed' ){
				$layout->blog = $main;
				$layout->left_col = $sidebar_col;
				$layout->right_col = null;
				$layout->class = ' sidebar-active-left';
			} elseif (is_active_sidebar( 'cshero-blog-sidebar' ) && $category_layout == 'right-fixed'){
				$layout->blog = $main;
				$layout->left_col = null;
				$layout->right_col = $sidebar_col;
				$layout->class = ' sidebar-active-right';
			} else {
				$layout->blog = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				$layout->left_col = null;
				$layout->right_col = null;
			}
		}
		return $layout;
	}
}
/*
 * Layout Control
*/
function cshero_generetor_layout() {
	global $smof_data,$post;
	/* Layout */
	$layout = new stdClass();
	$layout->blog = 'col-md-12';
	$layout->left1_col = null;
	$layout->left1_sidebar = null;
	$layout->right1_col = null;
	$layout->right1_sidebar = null;
	$layout->class = null;

	$sidebar_left = 'cshero-widget-left';
	$sidebar_right = 'cshero-widget-right';

	$main = 'col-xs-12 col-sm-9 col-md-9 col-lg-9';
	$sidebar_col = 'col-xs-12 col-sm-3 col-md-3 col-lg-3';
	/* Type */
	$option = null;
	if (is_page()){
	    $page_full = get_post_meta($post->ID,'cs_layout',true);
	    $page_layout = get_post_meta($post->ID,'cs_page_layout',true);
	    $page_sidebar_left = get_post_meta($post->ID,'cs_sidebar_left',true);
	    $page_sidebar_right = get_post_meta($post->ID,'cs_sidebar_right',true);
	    if($page_layout != ''){
	        $smof_data["page_layout"] = $page_layout;
	        if($page_sidebar_left){
	            $sidebar_left = $page_sidebar_left;
	        }
	        if($page_sidebar_right){
	            $sidebar_right = $page_sidebar_right;
	        }
	    } else {
	        //$sidebar_left = '';
	        //$sidebar_right = '';
	    }
		$option = $smof_data["page_layout"];
	} elseif (is_single()) {
		$option = $smof_data["post_layout"];
	} elseif (is_archive()){
		$option = $smof_data["blog_layout"];
	}
	switch ($option){
		case 'full-fixed':
			$layout->blog = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
			break;
		case 'right-fixed':
		    if(is_active_sidebar( $sidebar_right )){
    			$layout->blog = $main;
    			$layout->right1_col = $sidebar_col;
    			$layout->right1_sidebar = $sidebar_right;
    			$layout->class = ' sidebar-active-right';
		    }
			break;
		case 'left-fixed':
		    if(is_active_sidebar( $sidebar_left )){
    			$layout->blog = $main;
    			$layout->left1_col = $sidebar_col;
    			$layout->left1_sidebar = $sidebar_left;
    			$layout->class = ' sidebar-active-left';
		    }
			break;
	}
	return $layout;
}
/*
 * Calculator Collum Bootstrap 3
 */
function cshero_calculator_collum($collum = 2) {
	switch ($collum){
		case 1:
			return 'col-md-12';
			break;
		case 2:
			return 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
			break;
		case 3:
			return 'col-xs-12 col-sm-4 col-md-4 col-lg-4';
			break;
		case 4:
			return 'col-xs-12 col-sm-3 col-md-3 col-lg-3';
			break;
	}
}
/*
 * Setting for Header
 */
if(!function_exists('cshero_generetor_header_setting')){
	function cshero_generetor_header_setting(){
		global $smof_data,$post;

		$header_setings = new stdClass();
		$header_setings->body_class = 'csbody';
		$header_setings->header_fixed = '0';
		$header_setings->top_padding = '';
		$header_setings->top2_padding = '';

		if(is_page() && get_post_meta($post->ID, 'cs_header_setting', true) == 'custom'){
			$header_setings->header_fixed = get_post_meta($post->ID, 'cs_header_fixed_top', true);

			if($header_setings->header_fixed == '1'){
				$header_setings->body_class = 'csbody body_header_fixed';
			}else{
				$header_setings->body_class = 'csbody body_header_normal';
			}
		} else {
			$header_setings->header_fixed = $smof_data['header_fixed_top'];

			if($header_setings->header_fixed == '1'){
				$header_setings->body_class = 'csbody body_header_fixed';
			} else {
				$header_setings->body_class = 'csbody body_header_normal';
			}
		}
		/* Top Padding */
		if($smof_data["header_top_padding"]){
			$header_setings->top_padding = cshero_build_style(array('padding:'.$smof_data['header_top_padding'].';'));
		}

		if($smof_data["header_top2_padding"]){
			$header_setings->top2_padding = cshero_build_style(array('padding:'.$smof_data['header_top2_padding'].';'));
		}

		return $header_setings;
	}
}
/*
 * Build Style
 */
if(!function_exists('cshero_build_style')){
	function cshero_build_style($arr = array()){
		$return = '';
		if(count($arr) > 0){
			$return = 'style="';
			$return .= implode(' ', $arr);
			$return .= '"';
		}
		return $return;
	}
}
/** Inline style */
if(!function_exists('cshero_inline_style')){
    function cshero_inline_style($params = array()){
        if(count($params) > 0){
            $styles = ' style="';
            foreach ($params as $key => $param){
                if(!empty($param)){
                    $styles .= $key.':'.$param.';';
                }
            }
            $styles .= '"';
            echo $styles;
        }
    }
}
/*
 * Limit Words
 */
if (!function_exists('cshero_string_limit_words')) {
	function cshero_string_limit_words($string, $word_limit) {
		$words = explode(' ', $string, ($word_limit + 1));
		if (count($words) > $word_limit) {
			array_pop($words);
		}
		return implode(' ', $words)."";
	}
}
/*
 * Check posts full content or show read more.
 */
if(!function_exists('cshero_posts_full_content')){
	function cshero_posts_full_content(){
		global $smof_data;
		if($smof_data['blog_full_content'] == '1'){
			return '1';
		} elseif (is_archive() && $smof_data['show_full_content'] == '1'){
			return '1';
		} elseif (is_search()){
		    switch ($smof_data['search_view']){
		        case 'Excerpt':
		            return '2';
		            break;
		        case 'Read More':
		            return '1';
		            break;
		        default:
		            return '2';
		            break;
		    }
		} else {
			return '0';
		}
	}
}
/*
 * Max Charlength
 */
if (!function_exists('cshero_content_max_charlength')) {
	function cshero_content_max_charlength($excerpt, $charlength) {
		$charlength++;
		if (mb_strlen($excerpt) > $charlength) {
			$subex = mb_substr($excerpt, 0, $charlength - 5);
			$exwords = explode(' ', $subex);
			$excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
			if ($excut < 0) {
				echo mb_substr($subex, 0, $excut);
			} else {
				echo $subex;
			}
			echo '';
		} else {
			echo $excerpt;
		}
	}
}
/*
 * Get Icon Post Type
 */
if (!function_exists('cshero_get_icon_post_type')){
	function cshero_get_icon_post_type(){
		switch (get_post_format()){
			case 'chat':
				return 'fa fa-thumb-tack';
				break;
			case 'gallery':
				return 'fa fa-camera-retro';
				break;
			case 'link':
				return 'fa fa-link';
				break;
			case 'image':
				return 'fa fa-picture-o';
				break;
			case 'quote':
				return 'fa fa-quote-left';
				break;
			case 'video':
				return 'fa fa-youtube-play';
				break;
			case 'audio':
				return 'fa fa-volume-up';
				break;
			default:
				return 'fa fa-file-text-o';
		}
	}
}
function cshero_breadcrumb() {
    global $smof_data, $post;
    if(class_exists('bbPress') && is_bbpress()){
        echo bbp_get_breadcrumb(array('home_text'=>$smof_data['breacrumb_home_prefix'],'sep_before'=>'','sep_after'=>'','sep'=>' '));
    } elseif (class_exists('Woocommerce') && is_woocommerce()){
        echo woocommerce_breadcrumb();
    } else {
        echo '<ul class="breadcrumbs">';
        if ( !is_front_page() ) {
            echo '<li><a href="';
            echo home_url();
            echo '">'.$smof_data['breacrumb_home_prefix'];
            echo "</a></li>";
        }        
        $params['link_none'] = '';
        $separator = '';        
        if (is_category()) {
            $category = get_the_category();
            $ID = $category[0]->cat_ID;
            echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ? '' : '<li>'.$cat_parents.'</li>';
        }       
        if (is_tax()) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $link = get_term_link( $term );
            	
            if ( is_wp_error( $link ) ) {
                echo sprintf('<li>%s</li>', $term->name );
            } else {
                echo sprintf('<li><a href="%s" title="%s">%s</a></li>', $link, $term->name, $term->name );
            }
        }       
        if(is_page() && !is_front_page()) {
            $parents = array();
            $parent_id = $post->post_parent;
            while ( $parent_id ) :
            $page = get_page( $parent_id );
            if ( $params["link_none"] )
                $parents[]  = get_the_title( $page->ID );
            else
                $parents[]  = '<li><a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>' . $separator;
            $parent_id  = $page->post_parent;
            endwhile;
            $parents = array_reverse( $parents );
            echo join( '', $parents );
            echo '<li>'.get_the_title().'</li>';
        }
        
        if(is_single()) {
            $categories_1 = get_the_category($post->ID);
            if($categories_1):
            foreach($categories_1 as $cat_1):
            $cat_1_ids[] = $cat_1->term_id;
            endforeach;
            $cat_1_line = implode(',', $cat_1_ids);
            endif;
            if( isset( $cat_1_line ) && $cat_1_line ) {
                $categories = get_categories(array(
                    'include' => $cat_1_line,
                    'orderby' => 'id'
                ));
                if ( $categories ) :
                foreach ( $categories as $cat ) :
                $cats[] = '<li><a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '">' . $cat->name . '</a></li>';
                endforeach;
                echo join( '', $cats );
                endif;
            }
            echo '<li>'.get_the_title().'</li>';
        }
        if( is_tag() ){ echo '<li>'."Tag: ".single_tag_title('',FALSE).'</li>'; }
        if( is_search() ){ echo '<li>'.__("Search", THEMENAME).'</li>'; }
        if( is_year() ){ echo '<li>'.get_the_time('Y').'</li>'; }
        
        if( is_404() ) {
            echo '<li>'.__("404 - Page not Found", THEMENAME).'</li>';
        }        
        if( is_archive() && is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
            echo '<li>'. $title .'</li>';
        }       
        echo "</ul>";
    }
}
// Display 12 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 ); 

/** page title */
function cshero_page_title_render() {
    if (is_page() && get_post_meta(get_the_ID(), 'cs_page_title_custom_text', true) != ""){
        echo esc_attr(get_post_meta(get_the_ID(), 'cs_page_title_custom_text', true));
    } else {
        if (!is_archive()){
            if(is_search()){
                printf( __( 'Search Results for: %s', THEMENAME ), '<span>' . get_search_query() . '</span>' );
            } elseif (is_404()){
                _e( '404', THEMENAME);
            } else {
                the_title();
            }
        } else {
            if ( is_category() ) :
            single_cat_title();
            elseif ( is_tag() ) :
            single_tag_title();
            elseif ( is_author() ) :
            printf( __( 'Author: %s', THEMENAME ), '<span class="vcard">' . get_the_author() . '</span>' );
            elseif ( is_day() ) :
            printf( __( 'Day: %s', THEMENAME ), '<span>' . get_the_date() . '</span>' );
            elseif ( is_month() ) :
            printf( __( 'Month: %s', THEMENAME ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', THEMENAME ) ) . '</span>' );
            elseif ( is_year() ) :
            printf( __( 'Year: %s', THEMENAME ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', THEMENAME ) ) . '</span>' );
            elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            _e( 'Asides', THEMENAME );
            elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            _e( 'Galleries', THEMENAME);
            elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            _e( 'Images', THEMENAME);
            elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            _e( 'Videos', THEMENAME );
            elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            _e( 'Quotes', THEMENAME );
            elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            _e( 'Links', THEMENAME );
            elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            _e( 'Statuses', THEMENAME );
            elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            _e( 'Audios', THEMENAME );
            elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            _e( 'Chats', THEMENAME );
            elseif (class_exists('Woocommerce') && is_woocommerce()):
                woocommerce_page_title();
            elseif (class_exists('bbPress') && is_bbpress()):
                _e('Forums', THEMENAME);
            elseif (class_exists('TPS') && is_tps()):
                if ( isset( $wp_query->query_vars['tps_category'] ) || isset( $wp_query->query_vars['tps_tag'] ) ):
                    $term_id = get_queried_object()->term_id;
                    $this_cat;
                    if ( isset( $wp_query->query_vars['tps_category'] ) ) {
                        $this_cat = get_term( $term_id, 'tps_category' );
                    } else {
                        $this_cat = get_term( $term_id, 'tps_tag' );
                    }
                    echo $this_cat->name;
                else:
                    $post_type = get_post_type_object( get_post_type() );
                    echo $post_type->labels->singular_name;
                endif;
            else :
                $post_type = get_post_type_object( get_post_type() );
			    echo $post_type->labels->singular_name;
            endif;
        }
    }
}
/*
 * Get Options Show Comments
*/
if (!function_exists('cshero_show_comments')){
	function cshero_show_comments($type = 'page'){
		global $smof_data;
		$defualt = '1'; $custom = '1';
		/* custom config */
		if ( comments_open() || '0' != get_comments_number() ){
			$custom = '1';
		} else {
			$custom = '0';
		}
		/* get admin options */
		switch ($type){
			case 'page':
				$defualt = $smof_data["show_comments_page"];
				break;
			case 'post':
				$defualt = $smof_data["show_comments_post"];
				break;
		}
		/* return */
		return $defualt;
	}
}
/*
 * Custom Title Widgets
 */
if (!function_exists('cshero_custom_title_widget')){
	function cshero_custom_title_widget($title){
		if ($title){
			$title = explode(' ',strip_tags($title));
			if (is_array($title)){
				if (count($title) > 0){
					$title[0] = "<span class='title-line'>".$title[0]."</span>";
				}
			}
			$title = implode(' ', $title);
		}
		return $title;
	}
}
/*
 * Post gallery
 */
if (!function_exists('cshero_grab_ids_from_gallery')) {
	function cshero_grab_ids_from_gallery() {
		global $post;
		$gallery = cshero_get_shortcode_from_content('gallery');
        $object =new stdClass();
        $object->columns = '3';
        $object->link = 'post';
        $object->ids = array();
        if($gallery){
        	$object = cshero_extra_shortcode('gallery', $gallery, $object);
        }
		return $object;
	}
}
/*
 * Extra shortcode
 */
if(!function_exists('cshero_extra_shortcode')){
	function cshero_extra_shortcode($name, $shortcode, $object) {
		if ($shortcode && is_object($object)) {
			$attrs = str_replace(array('[',']','"',$name),null, $shortcode);
			$attrs = explode(' ', $attrs);
			if(is_array($attrs)){
				foreach ($attrs as $attr){
					$_attr = explode('=', $attr);
					if(count($_attr) == 2){
						if($_attr[0] == 'ids'){
							$object->$_attr[0] = explode(',',$_attr[1]);
						} else {
							$object->$_attr[0] = $_attr[1];
						}
					}
				}
			}
		}
		return $object;
	}
}
/*
 * Get Shortcode From Content
 */
if(!function_exists('cshero_get_shortcode_from_content')){
	function cshero_get_shortcode_from_content($param) {
		global $post;
		$pattern = get_shortcode_regex();
		$content = $post->post_content;
		if (preg_match_all( '/'. $pattern .'/s', $content, $matches )
		&& array_key_exists( 2, $matches )
		&& in_array($param, $matches[2])){
			$key = array_search($param,$matches[2]);
			return $matches[0][$key];
		}
	}
}
/*
 * Default 404 page
 */
if(!function_exists('cshero_404_page_default')){
    function cshero_404_page_default(){
        global $smof_data;
        ob_start();
        ?>
        <!-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 error_image">
        		   <img alt="" src="<?php if($smof_data['404_image']){ echo esc_url($smof_data['404_image']); } else { echo esc_url($smof_data['logo']); } ?>">
        		</div> -->
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 error_content">
			   <div class="error-body">
			   		<h1><?php _e('404 Page not found', THEMENAME); ?></h1>
			       <span><?php _e('Whoops, sorry, this page does not exist.', THEMENAME); ?></span>
			   </div>
			</div>
		</div>
        <?php
        echo ob_get_clean();
    }
}

/**
 * Default tunoff plugins on CMS.
 * @param $params | array options.
 */
if(!function_exists('cscore_plugins_support')){
    function cscore_plugins_support($params = array(), $support = '0') {
        foreach ($params as $param){
            update_option($param, $support);
        }
    }
}
/*
 * Convert HEX to GRBA
*/
if(!function_exists('HexToRGB')){
    function HexToRGB($hex,$opacity = 1) {
    	$hex = str_replace("#",null, $hex);
    	$color = array();
    	if(strlen($hex) == 3) {
    		$color['r'] = hexdec(substr($hex,0,1).substr($hex,0,1));
    		$color['g'] = hexdec(substr($hex,1,1).substr($hex,1,1));
    		$color['b'] = hexdec(substr($hex,2,1).substr($hex,2,1));
    		$color['a'] = $opacity;
    	}
    	else if(strlen($hex) == 6) {
    		$color['r'] = hexdec(substr($hex, 0, 2));
    		$color['g'] = hexdec(substr($hex, 2, 2));
    		$color['b'] = hexdec(substr($hex, 4, 2));
    		$color['a'] = $opacity;
    	}
    	$color = "rgba(".implode(', ', $color).")";
    	return $color;
    }
}
//convert dates to readable format
if (!function_exists('tp_relative_time')) {

    function tp_relative_time($a) {
        //get current timestampt
        $b = strtotime("now");
        //get timestamp when tweet created
        $c = strtotime($a);
        //get difference
        $d = $b - $c;
        //calculate different time values
        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;

        if (is_numeric($d) && $d > 0) {
            //if less then 3 seconds
            if ($d < 3)
                return "right now";
            //if less then minute
            if ($d < $minute)
                return floor($d) . " seconds ago";
            //if less then 2 minutes
            if ($d < $minute * 2)
                return "about 1 minute ago";
            //if less then hour
            if ($d < $hour)
                return floor($d / $minute) . " minutes ago";
            //if less then 2 hours
            if ($d < $hour * 2)
                return "about 1 hour ago";
            //if less then day
            if ($d < $day)
                return floor($d / $hour) . " hours ago";
            //if more then day, but less then 2 days
            if ($d > $day && $d < $day * 2)
                return "yesterday";
            //if less then year
            if ($d < $day * 365)
                return floor($d / $day) . " days ago";
            //else return more than a year
            return "over a year ago";
        }
    }

}
/**
 * Function for Framework
 */
require get_template_directory().'/framework/functions.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/* Woo commerce function */
if(class_exists('Woocommerce')){
	global $smof_data;
	$smof_data['woo_number_products'] = isset($smof_data['woo_number_products'])?$smof_data['woo_number_products']:3;
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$smof_data['woo_number_products'].';' ), 20 );
    require get_template_directory() . '/woocommerce/wc-template-function.php';
    require get_template_directory() . '/woocommerce/wc-template-hooks.php';
}
/* sample data */
add_action( 'admin_enqueue_scripts', 			'cshero_sample' );
function cshero_sample(){
	wp_enqueue_script('sample',get_template_directory_uri().'/admin/assets/js/sample.js');
	wp_enqueue_style('sample-css',get_template_directory_uri().'/admin/assets/css/sample.css');
}
add_action( 'wp_ajax_sample', 'prefix_ajax_sanple' );

function prefix_ajax_sanple(){
    locate_template(array('admin/sample/cs_importer.php'), true, true);
    installSample();
}

/* Custom Comment style */
function cshero_custom_form($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		
	</div>
	<div class="comment-meta-wrap">
		<?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.',THEMENAME ); ?></em>
			<br />
		<?php endif; ?>
		
		<div class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					//printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); 
					echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago';
				?>
			</a>
				<?php edit_comment_link( __( '(Edit)',THEMENAME ), '  ', '' );
			?>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</div>
		<?php comment_text(); ?>
	</div>
	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}
 
/**
 * Woo loadmore Ajax.
 * 
 * ajax loadmore product by Woo.
 * @return html.
 * @author Fox
 * @version 1.0.0
 */

add_action('wp_ajax_cshero_woo_loadmore','cshero_woo_loadmore_callback');
add_action('wp_ajax_nopriv_cshero_woo_loadmore','cshero_woo_loadmore_callback');

function cshero_woo_loadmore_callback(){
    
    global $wp_query, $smof_data;
    
    $paged = isset($_REQUEST['paged']) ? $_REQUEST['paged'] : null;
    
    $category_name = isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';
    
    $ordering_args = WC()->query->get_catalog_ordering_args();
    
    $args = array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'posts_per_page'      => isset($smof_data['woo_number_products']) ? $smof_data['woo_number_products'] : 9 ,
        'paged'               => $paged,
        'tax_query' 			=> array(
            array(
                'taxonomy' 		=> 'product_cat',
                'terms' 		=> $category_name,
                'field' 		=> 'slug',
            )
        ),
        'orderby' 				=> $ordering_args['orderby'],
        'order' 				=> $ordering_args['order'],
    );
    
    $products = new WP_Query($args);
    
    if ( $products->have_posts() ) :

		while ( $products->have_posts() ) : $products->the_post();

			wc_get_template_part( 'content', 'product' );

		endwhile; // end of the loop.

	endif;
    
    wp_reset_postdata();
    
    exit();
}
/**
 * Set home page.
 * 
 * get home title and update options.
 * 
 * @return Home page title.
 * @author FOX
 */
function theme_framework_set_home_page(){
    
    $home_page = 'Home 1';
    
    $page = get_page_by_title($home_page);
    
    if(!isset($page->ID))
        return ;
    	
    update_option('show_on_front', 'page');
    update_option('page_on_front', $page->ID);
}

add_action('cms_import_finish', 'theme_framework_set_home_page');

/**
 * Set menu locations.
 * 
 * get locations and menu name and update options.
 * 
 * @return string[]
 * @author FOX
 */
function theme_framework_set_menu_location(){
    
    $setting = array(
        'Menu Left' => 'left_navigation',
        'Main Menu' => 'main_navigation',
    	'Menu Right' => 'right_navigation',
    );
    
    $navs = wp_get_nav_menus();
    
    $new_setting = array();
    
    foreach ($navs as $nav){
        
        if(!isset($setting[$nav->name]))
            continue;
        
        $id = $nav->term_id;
        $location = $setting[$nav->name];
        
        $new_setting[$location] = $id;
    }
    
    set_theme_mod('nav_menu_locations', $new_setting);
}

add_action('cms_import_finish', 'theme_framework_set_menu_location');