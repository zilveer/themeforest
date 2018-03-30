<?php
/*
Author: Theme Luxe
Author URI: http://themeluxe.com

*/



/* ---------------------------------------------------------------------- */
/*	QS Core
/* ---------------------------------------------------------------------- */

define( 'QS_BASE_DIR', get_template_directory() . '/' );
define( 'QS_BASE_URL', get_template_directory_uri() . '/' );

require_once('library/framework.php');        // Core functions 
require_once('library/custom-post-type.php'); // Custom Post Types
require_once('library/meta-box/class.php');   // Meta Boxes for custom page settings
require_once('library/update-notifier.php');  // Update notifier
require_once('library/meta_boxes.php');
require_once('shortcodes.php');			      // User shortcodes

// Theme Options Framework
if ( !function_exists( 'optionsframework_init' ) ) {

	define( 'OPTIONS_FRAMEWORK_DIRECTORY', QS_BASE_URL . 'library/admin/' );

	require_once( QS_BASE_DIR . 'library/admin/options-framework.php' );
}

// Disable WP admin bar to avoid header issues
add_filter('show_admin_bar', '__return_false');
// Add post formats for blog and portfolio items
add_theme_support('post-formats', array( 'aside', 'gallery', 'link', 'quote', 'video'));

// Set content width
if ( ! isset( $content_width ) ) $content_width = 960;

/* ---------------------------------------------------------------------- */
/*	Thumbnail image sizes
/* ---------------------------------------------------------------------- */

function wp_rpt_activation_hook() {
	if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 590, 210, true ); // default Post Thumbnail dimensions 
			add_image_size('blog', 630, 230, true); 
			add_image_size( 'portfolio3c', 320, 240, true );  
			add_image_size( 'portfolio4c', 240, 180, true );  
			add_image_size( 'portfolio5c', 192, 144, true );  
			add_image_size('team', 180, 180, true);
	}
}
add_action('after_setup_theme', 'wp_rpt_activation_hook');


/* ---------------------------------------------------------------------- */
/*	Active sidebars 
/* ---------------------------------------------------------------------- */

function qs_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
    	'id' => 'footer1',
    	'name' => 'Footer 1',
    	'description' => 'The first footer widget area.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'id' => 'footer2',
    	'name' => 'Footer 2',
    	'description' => 'The second footer widget area.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'id' => 'footer3',
    	'name' => 'Footer 3',
    	'description' => 'The third footer widget area.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Sidebar 2',
    	'description' => 'The second (secondary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
}

add_action( 'widgets_init', 'qs_register_sidebars' );


/* ---------------------------------------------------------------------- */
/*	Comments layout
/* ---------------------------------------------------------------------- */

function qs_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php echo get_avatar($comment,$size='32'); ?>
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><?php comment_time('F jS, Y'); ?></time>
				<?php edit_comment_link(__('(Edit)', 'qs_framework'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="help">
          			<p><?php _e('Your comment is awaiting moderation.', 'qs_framework') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} 

add_filter('comment_form', 'qs_comment_form');

function qs_comment_form()
{
    echo '<div class="comment-status" ></div>';
}



/* ---------------------------------------------------------------------- */
/*	Search Form Layout
/* ---------------------------------------------------------------------- */

function qs_search($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search the Site..." />
    <!--<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />-->
    </form>';
    return $form;
} 
add_filter( 'get_search_form', 'qs_search' );



/* ---------------------------------------------------------------------- */
/*	AJAX Search Loop
/* ---------------------------------------------------------------------- */

function qs_ajax_searchloop() {
?>
            	<div class="row">				
                
                <?php $search_url = esc_attr(get_search_query()); echo $search_url; ?>
                
                <h1 class="archive-title"><span>Search Results for::</span> <?php echo esc_attr(get_search_query()); ?></h1>
				



				<section class="eight columns clearfix" role="main">
                
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						

					
						
						
								<?php // check if the post has a Post Thumbnail assigned to it.
                                if ( has_post_thumbnail() ) {     
								                      
									$thumb_id = get_post_thumbnail_id( $post->ID );
									$image = wp_get_attachment_image_src( $thumb_id,'full' );
									     	$prettyphoto_enabled = of_get_option('qs_blog_prettyphoto');
											if( $prettyphoto_enabled == '1') :
                                        		echo '<a rel="prettyPhoto" href="'.$image[0].'" >';
											endif; 
											
									the_post_thumbnail('blog-image');
											if( $prettyphoto_enabled == '1') :
												echo '</a>';
											endif;

                                } ?>
                                
                            <div class="meta three columns">
                                <time datetime="<?php echo the_time('Y-m-j'); ?>" ><span class="day"><?php the_time('j'); ?></span><span class="month"><?php the_time('M'); ?> '<?php the_time('y'); ?></span></time>
                                <span class="post-author"><?php _e("By", "qs_framework"); ?> <?php the_author_posts_link(); ?> </span>
                                <?php the_tags('<p class="tags">', '<br />', '</p>'); ?>
                            </div>	
                            
                    	<section class="post-content nine columns last">                                        
                             <header>
                             
                                
                                    <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                    
    
                            
                            </header> <!-- end article header -->
                        
						
                        
							<?php the_content('Read More'); ?>
					
						</section> <!-- end article section -->
						
						<footer>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>

					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "qs_framework")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "qs_framework")) ?></li>
							</ul>
						</nav>
					<?php } ?>
								
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1>No Results Found</h1>
					    </header>
					    <section class="post_content">
					    	<p>Sorry, but the requested resource was not found on this site.</p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</section> <!-- end #main -->

    			
                <div class="four columns last">
					<?php get_sidebar(); // sidebar 1 ?>
                </div>
    
    			</div><!-- end .row -->  
    

			<?php 
		

}


/* ---------------------------------------------------------------------- */
/*	Enqueue Javascript Files
/* ---------------------------------------------------------------------- */
function theme_queue_js(){
  if (!is_admin()){
    if (comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
  }
}
add_action('get_header', 'theme_queue_js');


function qs_load_css() {

    wp_register_style( 'normalize', QS_BASE_URL . '/library/css/normalize.css', null, false );
    wp_register_style( 'quickstep', QS_BASE_URL . '/style.css', null, false );
	wp_register_style( 'prettyphoto', QS_BASE_URL . '/css/prettyPhoto.css', null, false );
	wp_register_style( 'flexslider', QS_BASE_URL . '/css/flexslider.css', null, false );
	wp_register_style( 'foundation', QS_BASE_URL . '/css/foundation.css', null, false );
	wp_register_style( 'flexnav', QS_BASE_URL . '/css/flexnav.css', null, false );
	wp_register_style( 'socialicons', QS_BASE_URL . '/css/social_foundicons.css', null, false );
	wp_register_style( 'socialicons_ie7', QS_BASE_URL . '/css/social_foundicons_ie7.css', null, false );
	wp_register_style( 'flexnav_ie8', QS_BASE_URL . '/css/flexnav_ie8.css', null, false );

    wp_enqueue_style( 'normalize' );
    wp_enqueue_style( 'quickstep' );
	wp_enqueue_style( 'prettyphoto' );
	wp_enqueue_style( 'flexslider' );
	wp_enqueue_style( 'foundation' );
	wp_enqueue_style( 'flexnav' );
	wp_enqueue_style( 'socialicons' );
	
	global $is_IE;

    if ($is_IE ) {

		if ( ! function_exists( 'wp_check_browser_version' ) )
			include_once( ABSPATH . 'wp-admin/includes/dashboard.php' );
	
		// IE version conditional enqueue
		$response = wp_check_browser_version();
		if ( 0 > version_compare( intval( $response['version'] ) , 8 ) )
			wp_enqueue_style( 'socialicons_ie7' );
		if ( 0 > version_compare( intval( $response['version'] ) , 9 ) )
			wp_enqueue_style( 'flexnav_ie8' );
	}
	
}
add_action('wp_enqueue_scripts', 'qs_load_css');

function qs_custom_css() {
    require_once 'css/customcss.php';
}
add_action('wp_head', 'qs_custom_css');

function qs_load_js() {
	
	wp_register_script( 'scrollto', QS_BASE_URL . '/js/jquery.scrollTo.js', array('jquery'), false, true );
	wp_register_script( 'easing', QS_BASE_URL . '/js/jquery.easing.1.3.js', array('jquery'), false, true );
	wp_register_script( 'showloading', QS_BASE_URL . '/js/jquery.showLoading.js', array('jquery'), false, true );
	wp_register_script( 'prettyphoto', QS_BASE_URL . '/js/jquery.prettyPhoto.js', array('jquery'), false, true );
	wp_register_script( 'flexslider', QS_BASE_URL . '/js/jquery.flexslider.js', array('jquery'), false, true );
	wp_register_script( 'flexnav', QS_BASE_URL . '/js/jquery.flexnav.js', array('jquery'), false, true );
	wp_register_script( 'isotope', QS_BASE_URL . '/js/jquery.isotope.min.js', array('jquery'), false, true );
        wp_register_script( 'viewport', QS_BASE_URL . '/js/jquery.viewport.mini.js', array('jquery'), false, true );
	
	wp_enqueue_script('scrollto');
	wp_enqueue_script('easing');
	wp_enqueue_script('showloading');
	wp_enqueue_script('prettyphoto');
	wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('flexslider');
	wp_enqueue_script('flexnav');
	wp_enqueue_script('isotope');
        wp_enqueue_script('viewport');

}
add_action( 'wp_enqueue_scripts', 'qs_load_js' );



/* ---------------------------------------------------------------------- */
/*	QS Theme Navigation
/* ---------------------------------------------------------------------- */

add_action( 'init', 'register_my_menus' );

function register_my_menus() {
register_nav_menus(
array(
'primary' => __( 'Primary Navigation', 'qs_framework' ),
)
);
}

function theme_nav() {
?>
		
		<div class="menu">
		<ul class="sf-menu sf-js-enabled" id="nav">
			<!--<li <?php //if ( is_home() || is_front_page() ) { echo "class=current_page_item"; } ?>><a rel="home" href="#home">Home</a></li>-->
			<?php 
			$args = array(
			'child_of' => 0,
			'sort_order' => 'ASC',
			'sort_column' => 'menu_order',
			'hierarchical' => 1,
			'post_type' => 'page',
			'post_status' => 'publish',
			'parent' => '0'
			); 
			  
			  $pages = get_pages($args); 
			  foreach ( $pages as $page ) { 
			  
				  // Get the child pages for sub menu
				  $child_page_pages = get_pages('hierarchical=0&sort_column=menu_order&parent='.$page->ID);
				  
				  if (qs_get_meta('qs_page_remove', $page->ID)) { continue; }
				  
				  if (count($child_page_pages)==0) {
			  ?>
			  			
			  					<li class="page_item"><a href="<?php echo get_page_link( $page->ID ) ?>" data-name="<?php echo $page->post_name; ?>" data-slide="container-<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></a></li>
			 			
            <?php 
			  	  }
				  else {
			
						echo '<li class="page_item item-with-ul"><a href="'.get_page_link( $page->ID ).'" data-name="'.$page->post_name.'" data-slide="container-'. $page->ID .'">'.$page->post_title.'</a>';
						echo '<ul class="children">';	
					  
					    foreach ($child_page_pages as $child_page) { ?>
                        
                        <?php if (qs_get_meta('qs_page_remove', $child_page->ID)) { continue; } ?>
                        <li class="page_item"><a href="<?php echo get_page_link( $child_page->ID ) ?>" data-name="<?php echo $page->post_name; ?>" data-slide="container-<?php echo $child_page->ID; ?>"><?php echo $child_page->post_title; ?></a></li>
            
			<?php 
						} 
						
						echo '</ul></li>';
			  	  }
			 }	
			?>
			
		</ul>
		</div>

<?php }
class qs_walker extends Walker_Nav_Menu {
    
          function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("", $depth);
             $output .= "<ul class=\"children\">";
          }
      
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
                $pageid = get_post_meta( $item->ID, '_menu_item_object_id', true );
                $page = get_post($pageid);
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ' data-name="'.$page->post_name.'" data-slide="container-' . $pageid .'"';
                $attributes .= $class_names;
                $attributes .= ! empty( $item->target )        ? ' target="'   . esc_attr( $item->target        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
		if($depth != 0) {
			$description = $append = $prepend = "";
		}
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
    
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
 
                if ( !$element )
                        return;
 
                $id_field = $this->db_fields['id'];
 
                //display this element
                if ( is_array( $args[0] ) )
                        $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
               
                //Adds the 'parent' class to the current item if it has children               
                if( ! empty( $children_elements[$element->$id_field] ) )
                        array_push($element->classes,'item-with-ul');
               
                $cb_args = array_merge( array(&$output, $element, $depth), $args);
               
                call_user_func_array(array(&$this, 'start_el'), $cb_args);
 
                $id = $element->$id_field;
 
                // descend only when the depth is right and there are childrens for this element
                if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
 
                        foreach( $children_elements[ $id ] as $child ){
 
                                if ( !isset($newlevel) ) {
                                        $newlevel = true;
                                        //start the child delimiter
                                        $cb_args = array_merge( array(&$output, $depth), $args);
                                        call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                                }
                                $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
                        }
                        unset( $children_elements[ $id ] );
                }
 
                if ( isset($newlevel) && $newlevel ){
                        //end the child delimiter
                        $cb_args = array_merge( array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
                }
 
                //end this element
                $cb_args = array_merge( array(&$output, $element, $depth), $args);
                call_user_func_array(array(&$this, 'end_el'), $cb_args);
        }
}


/* ---------------------------------------------------------------------- */
/*	Get Meta Box
/* ---------------------------------------------------------------------- */

if ( !function_exists('qs_get_meta') ) {

	function qs_get_meta( $key, $post_id = null ) {

		global $wp_query;

		$post_id = $post_id ? $post_id : $wp_query->get_queried_object()->ID;

		return get_post_meta( $post_id, $key, true );

	}

}
	
/* ---------------------------------------------------------------------- */
/*	Get Google Fonts from Server
/* ---------------------------------------------------------------------- */	
if (!function_exists('qs_google_fonts') ) {
	

	function qs_google_fonts() {

		// Some settings
		$fonts_url  = 'http://themeluxe.com/google-fonts.php';
		$fonts_file = QS_BASE_DIR . 'cache/google_fonts.txt';
		$cache_time = 1296000; // 15 days

		$last_downloaded = @file_exists( $fonts_file ) ? @filemtime( $fonts_file ) : 0;

		// Make sure curl is enabled
		if( is_callable('curl_init') && ini_get('allow_url_fopen') ) {

			// Update only once a week
			if( time() - $cache_time > $last_downloaded ) {


				// Fetch fonts
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $fonts_url );
				curl_setopt( $ch, CURLOPT_HEADER, 0 );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				$data = curl_exec( $ch );
				curl_close( $ch );

				// Update cache file
				$file = fopen( $fonts_file , 'w');
				fwrite( $file, $data );
				fclose( $file );

			}

		}

		$data = file_get_contents($fonts_file);
		$data = json_decode($data,true);
		
		$fonts_array = array() ;	
		$items = $data['items'];
	
		foreach ($items as $item) {
			 
			 $variants = array();
			 $subsets = array(); 
			  
			$key = str_replace(' ', '+', $item['family']);
			
				foreach ($item['variants'] as $variant) {
					array_push($variants, $variant);
				}
				foreach ($item['subsets'] as $subset) {
					array_push($subsets, $subset);
				}
				
				
			$key .= ':'.implode(',', $variants);
			$key .= '&subset='. implode(',', $subsets);
			
			$fonts_array[$key] = $item['family'];
		}
			
		return $fonts_array;

	}
	
}



/* ---------------------------------------------------------------------- */
/*	Plugin Activation
/* ---------------------------------------------------------------------- */

require_once dirname( __FILE__ ) . '/library/class-tgm-plugin-activation.php';

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
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Twitter Widget Pro', // The plugin name
			'slug'     				=> 'twitter-widget-pro', // The plugin slug (typically the folder name)
			'source'   				=> QS_BASE_URL . '/library/plugins/twitter-widget-pro.2.3.11.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'source'   				=> QS_BASE_URL . '/library/plugins/contact-form-7.3.3.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)

	);



	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'qs_framework',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'qs_framework' ),
			'menu_title'                       			=> __( 'Install Plugins', 'qs_framework' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'qs_framework' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'qs_framework' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'qs_framework' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'qs_framework' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'qs_framework' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

?>