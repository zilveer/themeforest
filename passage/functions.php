<?php

load_theme_textdomain( 'qode', get_template_directory().'/languages' );

add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');

define('QODE_ROOT', get_template_directory_uri());
define('QODE_VAR_PREFIX', 'qode_'); 
include_once('widgets/relate_posts_widget.php');
include_once('includes/shortcodes.php');
include_once('includes/qode-options.php');
include_once('includes/custom-fields.php');
include_once('includes/qode-menu.php');
include_once('includes/qode-custom-sidebar.php');

/* Add css */

if (!function_exists('qode_styles')) {
function qode_styles() {
	global $qode_options_passage;
	global $wp_styles;
	global $qode_toolbar;
	wp_enqueue_style("default_style", QODE_ROOT."/style.css");
	wp_enqueue_style("stylesheet", QODE_ROOT . "/css/stylesheet.min.css");
	
	wp_enqueue_style('ie8-style',QODE_ROOT . '/css/ie8.min.css');
	$wp_styles->add_data( 'ie8-style', 'conditional', 'IE 8');
		
	wp_enqueue_style("style_dynamic", QODE_ROOT."/css/style_dynamic.php");
	
	$responsiveness = "yes";
	if (isset($qode_options_passage['responsiveness'])) $responsiveness = $qode_options_passage['responsiveness'];
	if($responsiveness != "no"):
	wp_enqueue_style("responsive", QODE_ROOT."/css/responsive.min.css");
	wp_enqueue_style("style_dynamic_responsive", QODE_ROOT."/css/style_dynamic_responsive.php");
	endif;
	if(isset($qode_toolbar)):
		wp_enqueue_style("toolbar", QODE_ROOT."/css/toolbar.css");
		wp_enqueue_style("toolbar_colorpicker", QODE_ROOT."/css/admin/colorpicker.css");
	endif;
	
	wp_enqueue_style("custom_css", QODE_ROOT."/css/custom_css.php");

	
	$fonts_array  = array(
						$qode_options_passage['google_fonts'].':200,300,400',
						$qode_options_passage['page_title_google_fonts'].':200,300,400',
						$qode_options_passage['h1_google_fonts'].':200,300,400',
						$qode_options_passage['h2_google_fonts'].':200,300,400',
						$qode_options_passage['h3_google_fonts'].':200,300,400',
						$qode_options_passage['h4_google_fonts'].':200,300,400',
						$qode_options_passage['h5_google_fonts'].':200,300,400',
						$qode_options_passage['h6_google_fonts'].':200,300,400',
						$qode_options_passage['text_google_fonts'].':200,300,400',
						$qode_options_passage['menu_google_fonts'].':200,300,400',
						$qode_options_passage['dropdown_google_fonts'].':200,300,400',
						$qode_options_passage['dropdown_google_fonts_thirdlvl'].':200,300,400',
						$qode_options_passage['button_title_google_fonts'].':200,300,400',
						$qode_options_passage['message_title_google_fonts'].':200,300,400'
						);
	
	$fonts_array=array_diff($fonts_array, array("-1:200,300,400"));
	$google_fonts_string = implode( '|', $fonts_array);
	if(count($fonts_array) > 0) :
		printf("<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300|Source+Sans+Pro:200,300,400|Lato|%s&subset=latin,latin-ext' type='text/css' />\r\n", str_replace(' ', '+', $google_fonts_string));
	else :
		printf("<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300|Source+Sans+Pro:200,300,400|Lato&subset=latin,latin-ext' type='text/css' />\r\n");
	endif;
	
}
}

/* Add js */

if (!function_exists('qode_scripts')) {
function qode_scripts() {
	global $qode_options_passage;
	global $is_IE;
	global $qode_toolbar;
	wp_enqueue_script("jquery");
	wp_enqueue_script("plugins", QODE_ROOT."/js/plugins.js",array(),false,true);
	if ( $is_IE ) {
		wp_enqueue_script("html5", QODE_ROOT."/js/html5.js",array(),false,false);
	}
	if($qode_options_passage['enable_google_map'] == "yes") :
		if(isset($qode_options_passage['google_maps_api_key']) && $qode_options_passage['google_maps_api_key'] != '') {
               $google_maps_api_key = $qode_options_passage['google_maps_api_key'];
               wp_enqueue_script("google_map_api", "https://maps.googleapis.com/maps/api/js?key=" . $google_maps_api_key,array(),false,true);
            }
            else {
               wp_enqueue_script("google_map_api", "https://maps.googleapis.com/maps/api/js",array(),false,true);
            }
	endif;
	wp_enqueue_script("default_dynamic", QODE_ROOT."/js/default_dynamic.php",array(),false,true);
	wp_enqueue_script("default", QODE_ROOT."/js/default.min.js",array(),false,true);
	wp_enqueue_script("custom_js", QODE_ROOT."/js/custom_js.php",array(),false,true);
	global $wp_scripts;
	$wp_scripts->add_data('comment-reply', 'group', 1 );
	if ( is_singular() ) wp_enqueue_script( "comment-reply");
	
	$has_ajax = false;

	if ($qode_options_passage['page_transitions'] != "0")
		$has_ajax = true;
		
	if ($has_ajax) :
		wp_enqueue_script("ajax", QODE_ROOT."/js/ajax.min.js",array(),false,true);
	endif;
	
	if($qode_options_passage['use_recaptcha'] == "yes") :
	wp_enqueue_script("recaptcha_ajax", "http://www.google.com/recaptcha/api/js/recaptcha_ajax.js",array(),false,true);
	endif;
	if(isset($qode_toolbar)):
		wp_enqueue_script("toolbar", QODE_ROOT."/js/toolbar.js",array(),false,true);
		wp_enqueue_script("toolbar_colorpicker", QODE_ROOT."/js/admin/colorpicker.js",array(),false,true);
	endif;
	
	
}
}

add_action('wp_enqueue_scripts', 'qode_styles'); 
add_action('wp_enqueue_scripts', 'qode_scripts');

/* Add admin js and css */

if (!function_exists('qode_admin_jquery')) {
function qode_admin_jquery() {
		wp_enqueue_script('jquery'); 
		wp_enqueue_style('style', QODE_ROOT.'/css/admin/admin-style.css', false, '1.0', 'screen');
		wp_enqueue_style('colorstyle', QODE_ROOT.'/css/admin/colorpicker.css', false, '1.0', 'screen');
		wp_register_script('colorpickerss', QODE_ROOT.'/js/admin/colorpicker.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('colorpickerss'); 
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_register_script('default', QODE_ROOT.'/js/admin/default.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('default'); 
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
	
}
}
add_action('admin_print_scripts', 'qode_admin_jquery');


if (!isset( $content_width )) $content_width = 940;

/* Remove Generator from head */

remove_action('wp_head', 'wp_generator'); 

/* Register Menus */

if (!function_exists('qode_register_menus')) {
function qode_register_menus() {
    register_nav_menus(
        array('top-navigation' => __( 'Top Navigation', 'qode')
		)
		
    );
}
}
add_action( 'init', 'qode_register_menus' ); 

/* Add post thumbnails */

if ( function_exists( 'add_theme_support' ) ) { 

add_theme_support( 'post-thumbnails' );
add_image_size( 'blog-type-1', 480, 269, true );
add_image_size( 'blog-type-2', 1200, 674, true );
add_image_size( 'blog-type-3', 385, 216, true );
add_image_size( 'latest_posts', 375, 210, true );
}

/* Add feedlinks */

add_theme_support( 'automatic-feed-links' );

/* Qode comments */

if (!function_exists('qode_comment')) {
function qode_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>

<li>                        
	<div class="comment">
	  <div class="image"> <?php echo get_avatar($comment, 120); ?> </div>
	  <div class="text">
		<div class="name_holder">
			<span class="name"><?php echo get_comment_author_link(); ?></span>
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		<div class="text_holder" id="comment-<?php echo comment_ID(); ?>">
			<?php comment_text(); ?>
		</div>
		
		</div>
	</div>
                             
                
<?php if ($comment->comment_approved == '0') : ?>
<p><em><?php _e('Your comment is awaiting moderation.', qode); ?></em></p>
<?php endif; ?>                
<?php 
}
}
/* Register Sidebar */

if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Sidebar',
				'id' => 'sidebar',
        'description' => 'Default sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
		register_sidebar(array(
        'name' => 'SidebarPage',
				'id' => 'sidebar_page',
        'description' => 'Sidebar for Page',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
		register_sidebar(array(
        'name' => 'Header right',
				'id' => 'header_right',
				'description' => 'Header right',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ));
		register_sidebar(array(
				'name' => 'Footer column 1',
				'id' => 'footer_column_1',
        'description' => 'Footer column 1',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h6>',
        'after_title' => '</h6>'
    ));
		register_sidebar(array(
				'name' => 'Footer column 2',
				'id' => 'footer_column_2',
        'description' => 'Footer column 2',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h6>',
        'after_title' => '</h6>'
    ));
		register_sidebar(array(
				'name' => 'Footer column 3',
				'id' => 'footer_column_3',
        'description' => 'Footer column 3',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h6>',
        'after_title' => '</h6>'
    ));
		register_sidebar(array(
				'name' => 'Footer column 4',
				'id' => 'footer_column_4',
        'description' => 'Footer column 4',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h6>',
        'after_title' => '</h6>'
    ));
		register_sidebar(array(
        'name' => 'Footer text',
				'id' => 'footer_text',
        'description' => 'Footer text',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
   
}

/* Add class on body for ajax */

if (!function_exists('ajax_classes')) {
function ajax_classes($classes) {
	global $qode_options_passage;
	
	if($qode_options_passage['page_transitions'] === "0") :
		$classes[] = '';
	elseif($qode_options_passage['page_transitions'] === "1") :
		$classes[] = 'ajax_updown';
		$classes[] = 'page_not_loaded';
	elseif($qode_options_passage['page_transitions'] === "2") :
		$classes[] = 'ajax_fade';
		$classes[] = 'page_not_loaded';
	elseif($qode_options_passage['page_transitions'] === "3") :
		$classes[] = 'ajax_updown_fade';
		$classes[] = 'page_not_loaded';
	elseif($qode_options_passage['page_transitions'] === "4") :
		$classes[] = 'ajax_leftright';
		$classes[] = 'page_not_loaded';
	else:
	$classes[] ="";
	endif;

	return $classes;
}
}
add_filter('body_class','ajax_classes');

/* Add class on body for smooth scroll */

if (!function_exists('smooth_class')) {
function smooth_class($classes) {
	global $qode_options_passage;
	
	if(isset($qode_options_passage['smooth_scroll']) && $qode_options_passage['smooth_scroll'] == "yes") :
		$classes[] = 'smooth_scroll';
	else:
	$classes[] ="";
	endif;

	return $classes;
}
}
add_filter('body_class','smooth_class');

/* Add grid class on body */

if (!function_exists('grid_class')) {
function grid_class($classes) {
	global $qode_options_passage;
	
	if($qode_options_passage['grid'] === "large") :
		$classes[] = 'large';
	elseif($qode_options_passage['grid'] === "normal") :
		$classes[] = 'normal';
	elseif($qode_options_passage['grid'] === "small") :
		$classes[] = 'small';
	else:
	$classes[] ="large";
	endif;

	return $classes;
}
}
add_filter('body_class','grid_class');

/* Add shaddow class on body */

if (!function_exists('shadow_class')) {
function shadow_class($classes) {
	global $qode_options_passage;
	
	if(isset($qode_options_passage['content_shadow']) && $qode_options_passage['content_shadow'] == "shadow1") :
		$classes[] = 'shadow1';
	elseif(isset($qode_options_passage['content_shadow']) && $qode_options_passage['content_shadow'] == "shadow2") :
		$classes[] = 'shadow2';
	elseif(isset($qode_options_passage['content_shadow']) && $qode_options_passage['content_shadow'] == "shadow3") :
		$classes[] = 'shadow3';
	else:
		$classes[] ="";
	endif;

	return $classes;
}
}
add_filter('body_class','shadow_class');


/* Excerpt more */

if (!function_exists('qode_excerpt_more')) {
function qode_excerpt_more( $more ) {
    return '...';
}
}
add_filter('excerpt_more', 'qode_excerpt_more');

/* Excerpt lenght */

if (!function_exists('qode_excerpt_length')) {
function qode_excerpt_length( $length ) {
	global $qode_options_passage;
	if($qode_options_passage['number_of_chars']){
		 return $qode_options_passage['number_of_chars'];
	} else {
		return 45;
	}
}
}
add_filter( 'excerpt_length', 'qode_excerpt_length', 999 );

/* Social excerpt lenght */

if (!function_exists('the_excerpt_max_charlength')) {
function the_excerpt_max_charlength($charlength) {
	global $qode_options_passage;
	$via = $qode_options_passage['twitter_via'];
	$excerpt = get_the_excerpt();
	$charlength = 136 - (mb_strlen($via) + $charlength);

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			return mb_substr( $subex, 0, $excut );
		} else {
			return $subex;
		}
	} else {
		return $excerpt;
	}
}
}

/* Create Portfolio post type */

if (!function_exists('create_post_type')) {
function create_post_type() {
	register_post_type( 'portfolio_page',
		array(
			'labels' => array(
				'name' => __( 'Portfolio','qode' ),
				'singular_name' => __( 'Portfolio Item','qode' ),
				'add_item' => __('New Portfolio Item','qode'),
                'add_new_item' => __('Add New Portfolio Item','qode'),
                'edit_item' => __('Edit Portfolio Item','qode')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio_page'),
			'menu_position' => 4,
			'show_ui' => true,
            'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'post-formats', 'page-attributes')
		)
	);
	  flush_rewrite_rules();
}
}
add_action( 'init', 'create_post_type' );

/* Create Portfolio Categories */

add_action( 'init', 'create_portfolio_taxonomies', 0 );
if (!function_exists('create_portfolio_taxonomies')) {
function create_portfolio_taxonomies() 
{
   $labels = array(
    'name' => __( 'Portfolio Categories', 'taxonomy general name' ),
    'singular_name' => __( 'Portfolio Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Portfolio Categories','qode' ),
    'all_items' => __( 'All Portfolio Categories','qode' ),
    'parent_item' => __( 'Parent Portfolio Category','qode' ),
    'parent_item_colon' => __( 'Parent Portfolio Category:','qode' ),
    'edit_item' => __( 'Edit Portfolio Category','qode' ), 
    'update_item' => __( 'Update Portfolio Category','qode' ),
    'add_new_item' => __( 'Add New Portfolio Category','qode' ),
    'new_item_name' => __( 'New Portfolio Category Name','qode' ),
    'menu_name' => __( 'Portfolio Categories','qode' ),
  );     

  register_taxonomy('portfolio_category',array('portfolio_page'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio-category' ),
  ));

}
}

/* Pagination */

if (!function_exists('pagination')) {
function pagination($pages = '', $range = 4, $paged = 1)
{  
	global $qode_options_passage;
     $showitems = $range+1;  
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
		
         echo "<div class='pagination'><ul>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
		echo "<li class='prev'><a href='".get_pagenum_link($paged - 1)."'></a></li>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class='active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
             }
         }
		
         echo "<li class='next'><a href=\"";
		 if($pages > $paged) {
		 echo get_pagenum_link($paged + 1);
		 }
		 else {
			 echo get_pagenum_link($paged);
		 }
		 echo "\"></a></li>";  
		 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</ul></div>\n";
     }
}
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');

/* Empty paragraph fix in shortcode */

if (!function_exists('shortcode_empty_paragraph_fix')) {
function shortcode_empty_paragraph_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

    return $content;
}
}

/* Use slider instead of image for post */

if (!function_exists('slider_blog')) {
function slider_blog($post_id) {
	$sliders = get_post_meta($post_id, "qode_sliders", true);		
	$slider = $sliders[1];
	if($slider) {
		$html .= '<div class="flexslider"><ul class="slides">';
		$i=0;
		while ($slider[$i])
		{
			$slide = $slider[$i];
			
			$href = $slide[link];
			$baseurl = home_url();
			$baseurl = str_replace('http://', '', $baseurl);
			$baseurl = str_replace('www', '', $baseurl);
			$host = parse_url($href, PHP_URL_HOST);
			if($host != $baseurl) {
				$target = 'target="_blank"';
			}
			else {
				$target = 'target="_self"';
			}
			
			$html .= '<li class="slide ' . $slide[imgsize] . '">';
			$html .= '<div class="image"><img src="' . $slide[img] . '" alt="' . $slide[title] . '" /></div>';
			
			$html .= '</li>';
			$i++; 
		}
		$html .= '</ul></div>';
	}
	return $html;
}
}

if (!function_exists('compareSlides')) {
function compareSlides($a, $b)
{
	if (isset($a['ordernumber']) && isset($b['ordernumber'])) {
    if ($a['ordernumber'] == $b['ordernumber']) {
        return 0;
    }
    return ($a['ordernumber'] < $b['ordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if (!function_exists('comparePortfolioImages')) {
function comparePortfolioImages($a, $b)
{
	if (isset($a['portfolioimgordernumber']) && isset($b['portfolioimgordernumber'])) {
    if ($a['portfolioimgordernumber'] == $b['portfolioimgordernumber']) {
        return 0;
    }
    return ($a['portfolioimgordernumber'] < $b['portfolioimgordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if (!function_exists('comparePortfolioOptions')) {
function comparePortfolioOptions($a, $b)
{
	if (isset($a['optionlabelordernumber']) && isset($b['optionlabelordernumber'])) {
    if ($a['optionlabelordernumber'] == $b['optionlabelordernumber']) {
        return 0;
    }
    return ($a['optionlabelordernumber'] < $b['optionlabelordernumber']) ? -1 : 1;
  }
  return 0;
}
}


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
if (!function_exists('my_theme_register_required_plugins')) {
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Revolution Slider Plugin', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		// array(
			// 'name' 		=> 'BuddyPress',
			// 'slug' 		=> 'buddypress',
			// 'required' 	=> false,
		// ),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'passage';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
        'domain'           => 'qode',
        'default_path'     => '',
        'parent_slug' 	   => 'themes.php',
        'capability' 	   => 'edit_theme_options',
        'menu'             => 'install-required-plugins',
        'has_notices'      => true,
        'is_automatic'     => false,
        'message'          => '',
        'strings'          => array(
            'page_title'                      => esc_html__('Install Required Plugins', 'qode'),
            'menu_title'                      => esc_html__('Install Plugins', 'qode'),
            'installing'                      => esc_html__('Installing Plugin: %s', 'qode'),
            'oops'                            => esc_html__('Something went wrong with the plugin API.', 'qode'),
            'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'qode'),
            'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'qode'),
            'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'qode'),
            'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'qode'),
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'qode'),
            'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'qode'),
            'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'qode'),
            'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'qode'),
            'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'qode'),
            'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins', 'qode'),
            'return'                          => esc_html__('Return to Required Plugins Installer', 'qode'),
            'plugin_activated'                => esc_html__('Plugin activated successfully.', 'qode'),
            'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'qode'),
            'nag_type'                        => 'updated'
        )
    );

	tgmpa( $plugins, $config );

}
}


if (!function_exists('hex2rgb')) {
function hex2rgb($hex) {
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
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
}

// register custom sidebars to theme
add_theme_support('qode_sidebar');
if(get_theme_support( 'qode_sidebar' )) new qode_sidebar();

if (!function_exists('isUserMadeSidebar')) {
function isUserMadeSidebar($name){
	
	//this have to be changed depending on theme
	if($name == 'Sidebar'){
		return false;
	}else if($name == 'SidebarPage'){
		return false;
	}else if($name == 'Header Right'){
		return false;
	}else if($name == 'Footer Column 1'){
		return false;
	}else if($name == 'Footer Column 2'){
		return false;
	}else if($name == 'Footer Column 3'){
		return false;
	}else if($name == 'Footer Column 4'){
		return false;
	}else if($name == 'Footer Text'){
		return false;
	}else{
		return true;
	}
	
}
}

?>