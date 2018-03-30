<?php


/*------------------------------------*\ 
	External Modules/Files
\*------------------------------------*/
require_once( get_template_directory().'/admin/tgm/plugins.php');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


/*------------------------------------*\
*  Options Panel
*
*  Options Panel Included in to the Webbu Aura Mobile Theme Core Elements plugin
*  Because if you use this theme with your existing theme you can see theme controls.
*
*/


global $webbumobile_option; // Get options from options panel.

function AuraIssetControl($field, $field2, $default){
	global $webbumobile_option;
	
	if($field2 == ''){
		if(isset($webbumobile_option[''.$field.'']) == NULL or $webbumobile_option[''.$field.''] == ""){$output = $default;}else{$output = $webbumobile_option[''.$field.''];}
	}else{
		if(isset($webbumobile_option[''.$field.''][''.$field2.'']) == NULL or $webbumobile_option[''.$field.''][''.$field2.''] == ""){$output = $default;}else{$output = $webbumobile_option[''.$field.''][''.$field2.''];}
	}
	return $output;
}

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');
	
	// Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    //add_image_size('custom-size', 600, 450, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('aurat2d', get_template_directory() . '/languages');
	
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

function aurah_header_scripts()
{		
		global $webbumobile_option;
    
    	wp_enqueue_script('jquery'); 		
    	
    	wp_register_script('conditionizr', get_template_directory_uri() .'/js/conditionizr.min.js', array('jquery'), '2.2.0',true); 
        wp_enqueue_script('conditionizr'); 
        
        wp_register_script('modernizr', get_template_directory_uri() .'/js/modernizr.min.js', array('jquery'), '2.6.2',true); 
        wp_enqueue_script('modernizr'); 
		
		wp_register_script('classie-aura', get_template_directory_uri() .'/js/classie.js', array('jquery'), '1.0',true); 
        wp_enqueue_script('classie-aura');
		
		wp_register_script('iscroll-aura', get_template_directory_uri() .'/js/iscroll.js', array('jquery'), '1.0',true); 
        wp_enqueue_script('iscroll-aura');
		
		$general_ioswebapp = $webbumobile_option['general_ioswebapp'];
		
		if( $general_ioswebapp == 1 ){
			wp_register_script('wmf-webapp', get_template_directory_uri() . '/js/webapp.js', array('jquery'), '1.0.0',true); 
       		wp_enqueue_script('wmf-webapp');
		}
		
		$general_autoopenstart = $webbumobile_option['general_autoopenstart'];
		if ($general_autoopenstart == 1) {
			if (is_front_page()) {
				$autoopen_homepage = 'yes';
			}else{
				$autoopen_homepage = 'no';
			}
			
		}else{
			$autoopen_homepage = 'no';
		}

		wp_register_script('theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', array('jquery'), '1.0.0',true); 
        wp_enqueue_script('theme-scripts'); 

      
        wp_localize_script( 'theme-scripts', 'aura_theme_scripts', array( 
			'autoopenhome' => $autoopen_homepage,
			
		));
				
		$general_swipe = $webbumobile_option['general_swipe'];
		if( $general_swipe == 1 ){
			wp_register_script('hammer-aura', get_template_directory_uri() .'/js/hammer.min.js', array('jquery'), '1.0.6',true); 
        	wp_enqueue_script('hammer-aura');
		} 
		
}


/*------------------------------------*\
	Add2Home
\*------------------------------------*/
$iossettings_add2home = $webbumobile_option['iossettings_add2home'];

if($iossettings_add2home == 1){
	
	function add_add2home_config () {
		if (!is_admin()) {
			global $webbumobile_option;
			if(is_front_page() || is_home()){
			wp_register_script('add2home', get_template_directory_uri() . '/js/add2home.js', array('jquery'), '1.0.0', true); 
       		wp_enqueue_script('add2home'); 
			wp_register_style('add2homec', get_template_directory_uri() . '/css/add2home.css', array(), '1.0', 'all');
    		wp_enqueue_style('add2homec'); 
			echo '
			<script type="text/javascript">
			var addToHomeConfig = {
				returningVisitor: '.$webbumobile_option[ 'iossettings_returningvisitor'].',
				touchIcon: '.$webbumobile_option[ 'iossettings_touchicon'].',
				startDelay: '.$webbumobile_option[ 'iossettings_startdelay'].',			
				lifespan: '.$webbumobile_option[ 'iossettings_lifespan'].',					
			};
			</script>
			';
			}
		}
	}
	add_action('wp_footer', 'add_add2home_config',0);
}

/*------------------------------------*\
	Google Analytic
\*------------------------------------*/
$googleanalytics_code = AuraIssetControl('googleanalytics_code','','');
if( $googleanalytics_code != "" ){
	// Add Analytic code
	function add_analytic_code () {
		if (!is_admin()) {
			global $webbumobile_option;
			echo $webbumobile_option[ 'googleanalytics_code'];
		}
	}
	add_action('wp_footer', 'add_analytic_code',80);
}


/*------------------------------------*\
	Modernizr Hook
\*------------------------------------*/
$general_loading = $webbumobile_option[ 'general_loading'];

if($general_loading == 1){
	function add_modernizrhook_code () {
		if (!is_admin()) {
			echo '
			<script>
			!function(){
				// configure legacy, retina, touch requirements @ conditionizr.com
				conditionizr()
			}()
			</script>';
		}
	}
	add_action('wp_footer', 'add_modernizrhook_code',100);
}

/*------------------------------------*\
	MENU Hook
\*------------------------------------*/
//Aura Menus
function register_aurah_menu_theme()
{
    register_nav_menus(array( 
		'aura-main-menu' => __('Aura Mobile Main Menu', 'aurat2d'),
    ));
}


function auramobilehex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }

   return $r.','.$g.','.$b;
}


function aurabackgroundopacity($color, $opacity){	
	$output = '';
	$output .= 'background: rgb('.$color .');background: rgba('.$color .','.$opacity .')';
	return $output;
}

function auraborderopacity($color, $opacity){	
	global $webbumobile_option; // Get options from options panel.

	$type = AuraIssetControl('menudefaults_bordertype','border-style','solid');
	$borderwidth = AuraIssetControl('menudefaults_bordertype','border-top','3px');
	
	$output = '';
	$output .= 'border: '.$borderwidth.' '.$type.' rgb('.$color .'); border: '.$borderwidth.' '.$type.' rgba('.$color .','.$opacity .');';
	return $output;
}


//Main Menu
function add_auramainmenu_code () {
	if (!is_admin()) {

		$menu_name = 'aura-main-menu';

		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	
		$menu_items = wp_get_nav_menu_items($menu->term_id);
	
		$menu_list = '<div id="three-columns" class="grid-auracontainer">';
		$menu_list .= '<ul class="webbumobilegrid columns-3">';
		foreach ( (array) $menu_items as $key => $menu_item ) {
			$title = $menu_item->attr_title;
			$name = $menu_item->title;
			$url = $menu_item->url;
			$ID = $menu_item->ID;
			$_menu_item_iconvalued = $menu_item->_menu_item_iconvalued;
			$_menu_item_iconbgcolor = $menu_item->_menu_item_iconbgcolor;
			$_menu_item_iconbgopacity = $menu_item->_menu_item_iconbgopacity;
			$_menu_item_iconbordercolor = $menu_item->_menu_item_iconbordercolor;
			$_menu_item_iconborderopacity = $menu_item->_menu_item_iconborderopacity;
			$_menu_item_icontextcolor = $menu_item->_menu_item_icontextcolor;
			$_menu_item_uploadicon = $menu_item->_menu_item_uploadicon;


			if($_menu_item_uploadicon == ''){
				$menu_list .= '		<li><a href="'.$url.'"><div class="aura-menu-icon auratile3" style="'.aurabackgroundopacity(auramobilehex2rgb($_menu_item_iconbgcolor), $_menu_item_iconbgopacity).'; '.auraborderopacity(auramobilehex2rgb($_menu_item_iconbordercolor), $_menu_item_iconborderopacity).'"><i class="icon icon-'.$_menu_item_iconvalued.'" style="color:'.$_menu_item_icontextcolor.'"></i><span class="aura-menu-icon-text">'.$name.'</span></div></a></li>';		
			}else{
				$menu_list .= '		<li><a href="'.$url.'"><div class="aura-menu-icon auratile3" style="'.aurabackgroundopacity(auramobilehex2rgb($_menu_item_iconbgcolor), $_menu_item_iconbgopacity).'; '.auraborderopacity(auramobilehex2rgb($_menu_item_iconbordercolor), $_menu_item_iconborderopacity).'"><div class="aura-menu-bgclass" style="background-image: url('.$_menu_item_uploadicon.');"></div><span class="aura-menu-icon-text">'.$name.'</span></div></a></li>';	
			}
			
		}
		$menu_list .= '</ul>';
		$menu_list .= '</div>';
		
		}
		
		if(!empty($menu_list)){
		echo $menu_list;
		}
	}
}


/*------------------------------------*\
	Loading Hook
\*------------------------------------*/
function add_loadinghook_code () {
	if (!is_admin()) {
		echo '
		<script>
		(function($) {
		  "use strict";

			$(document).ready(function() {
				setTimeout(function() {
					  $(".wmfloadingani").css("display","none");
				}, 1000);
			});
			
		})(jQuery);
		</script>';
	}
}
add_action('wp_footer', 'add_loadinghook_code',200);



function aurat2d_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); 
    
    wp_register_style('theme-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('theme-style');
			
	wp_register_style('theme-settings', get_template_directory_uri() . '/css/theme-css.php', array(), '1.0', 'all');
	wp_enqueue_style('theme-settings'); 
	
	if(!is_plugin_active('wmfshortcodes/index.php')) {
	  wp_register_style('fontawsesome_css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.2.1', 'all');
	  wp_enqueue_style('fontawsesome_css'); 
    }
	
	if(!is_plugin_active('wmfshortcodes/index.php') && !is_plugin_active('wmfframework/index.php')) {
	  wp_register_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.0', 'all');
	  wp_enqueue_style('bootstrap_css'); 
    }
	
	
		  
}

if(!is_plugin_active('wmfshortcodes/index.php')) {
	// Font awesome IE7 fix
	function aurah_add_fontawesome_fix () {
		if (!is_admin()) {
			echo '<!--[if lt IE 7]>';
			echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/font-awesome-ie7.min.css">';
			echo '<![endif]-->';
		}
	}
	add_action('wp_head', 'aurah_add_fontawesome_fix');
}

// Mobili ie fix
function aurah_add_ie_fix () {
	if (!is_admin()) {
		echo '<!--[if IE 9]>';
		echo '<script src="'.get_template_directory_uri().'/js/ie9fix.js"></script>';
		echo '<![endif]-->';
	}
}
add_action('wp_head', 'aurah_add_ie_fix');


function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
	// Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Aura Widget Area', 'aurat2d'),
        'description' => __('Aura Widget Area', 'aurat2d'),
        'id' => 'aura-widget-area',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3><div class="widgetheader">',
        'after_title' => '</div></h3>'
    ));

}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function aurawp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
		'type' => 'list',
    ));
}


// Create the Custom Excerpts callback
function aurawp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    $output = do_shortcode(get_the_content('' . __('Read more', 'aurat2d') . ''));
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = $output;
    echo $output;
	
}


function aurah_blank_view_article($more)
{
    global $post;
    $output = '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'aurat2d') . '</a>';
	return $output;
}
add_filter('excerpt_more', 'aurah_blank_view_article');


// Remove 'text/css' from our enqueued stylesheet
function aurah_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function aurat2dgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function aurat2dcomments($comment, $args, $depth)
{
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
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard"><i class='icon icon-user'></i> 
	<?php //if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'aurat2d') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><i class='icon icon-calendar'></i> <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s', 'aurat2d'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'aurat2d'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply wmfbtn wmfbtn-default wmfbtn-xs">
    
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }


/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('wp_enqueue_scripts', 'aurah_header_scripts'); // Add Custom Scripts to wp_head
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'aurat2d_styles'); // Add Theme Stylesheet
add_action('init', 'register_aurah_menu_theme');
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'aurawp_pagination'); // Add our HTML5 Pagination


// Add Filters
add_filter('avatar_defaults', 'aurat2dgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('style_loader_tag', 'aurah_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

?>
