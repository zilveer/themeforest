<?php

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
		header( 'Location: '.admin_url().'themes.php');
	}

global $smof_data;
/* Translation */
load_theme_textdomain( 'rocknrolla', get_template_directory() . '/includes/languages' );
$locale = get_locale();
$wc_posts_perpage = '';
$locale_file = get_template_directory() . "/includes/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);
	
if ( ! isset( $content_width ) )
	$content_width = 1170;	



define('RNR_FUNCTIONS', get_template_directory()  . '/includes');
define('RNR_INDEX_JS', get_template_directory_uri()  . '/js');
define('RNR_INDEX_CSS', get_template_directory_uri()  . '/css');

/** Slightly Modified Options Framework **/
require_once ('admin/index.php');

/* WP 3.1 Post Formats */
add_theme_support( 'post-formats', array('gallery', 'link', 'quote', 'audio', 'video')); 


/* Include Meta Box Framework */
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/includes/metaboxes' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/includes/metaboxes' ) );

require_once RWMB_DIR . 'meta-box.php';

include_once(RNR_FUNCTIONS.'/tgm-plugin-activation/class-tgm-plugin-activation.php'); // Plugin Activation Class
include_once(RNR_FUNCTIONS.'/tgm-plugin-activation/tgm-plugin-activator.php'); // Plugin Activator 
include_once(RNR_FUNCTIONS.'/portfolio-post-type.php'); // Portfolio Post Type
include_once RNR_FUNCTIONS.'/tinymce/rnr-shortcodes.php';
include_once RNR_FUNCTIONS.'/shortcodes.php';
include_once RNR_FUNCTIONS.'/Mobile_Detect.php';
include_once RNR_FUNCTIONS.'/metaboxes.php';
include_once RNR_FUNCTIONS.'/custom-style.php';


/* Include Widgets */
include_once(RNR_FUNCTIONS.'/widgets/embed.php');
include_once(RNR_FUNCTIONS.'/widgets/flickr.php');
include_once(RNR_FUNCTIONS.'/widgets/twitter.php');
include_once(RNR_FUNCTIONS.'/widgets/portfolio.php');


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


add_theme_support( 'woocommerce' );

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

if(!empty($smof_data['rnr_wc_products_perpage'])) { $wc_posts_perpage = $smof_data['rnr_wc_products_perpage']; }

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$wc_posts_perpage.';' ), 20 );


if (is_admin() ){
	function rocknrolla_admin_scripts(){	
		wp_register_script('rnrmetajs', RNR_INDEX_JS .'/admin/init.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('rnrmetajs');
	}
}


if(!is_admin()) {
	add_action('wp_enqueue_scripts', 'rocknrolla_jq_scripts');
}
		function rocknrolla_jq_scripts(){	
		   wp_deregister_script('jquery');
		   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js", false);
		   wp_enqueue_script('jquery');
		}


add_action('admin_enqueue_scripts', 'rocknrolla_admin_scripts');

	if (!is_admin() ){
		function rocknrolla_front_scripts(){		
		
		    global $smof_data;
			
								
			
				  
	        wp_register_script('rnrInit', RNR_INDEX_JS. '/init.js' ,array('jquery'),  TRUE);		
			wp_register_script('rnrQueryLoader', RNR_INDEX_JS .'/jquery.queryloader2.js', array('jquery'),  true);	
			wp_register_script('rnrSmoothScroll', RNR_INDEX_JS .'/SmoothScroll.js', true);	
			wp_register_script('rnrscripts', RNR_INDEX_JS .'/scripts.js', array('jquery'),  true);	
			wp_register_script('rnrPortfolio', RNR_INDEX_JS .'/ajax-portfolio.js', array('jquery'),  true);				
			wp_register_script('shortcodes', RNR_INDEX_JS .'/shortcodes.js', array('jquery'),  true);	
			wp_register_script('rnrSupersized', RNR_INDEX_JS .'/supersized.3.2.7.min.js', array('jquery'),  true);			
			wp_register_script('rnrYoutubeBgVideo', RNR_INDEX_JS .'/jquery.mb.YTPlayer.min.js',  true);
			wp_register_script('rnrVimeoBgVideo', RNR_INDEX_JS .'/okvideo.min.js', array('jquery'),  true);			
		    wp_register_script('gmap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDAUVrR4lqBd_Pvpw6BYTSPibHAe67-3G8&sensor=false&libraries=places', array('jquery'), '2.1', false );  
	        wp_register_script('infoBox', RNR_INDEX_JS .'/infobox.js', array('jquery'), '2.1', false );	
			
										
    		wp_enqueue_script('rnrQueryLoader');
			
    		wp_enqueue_script('rnrInit');	
			
			if($smof_data['rnr_disable_smoothscroll'] == false) {
			  wp_enqueue_script( 'rnrSmoothScroll' ); 
			}
				
			wp_enqueue_script('rnrscripts');
			wp_enqueue_script('rnrPortfolio');
			wp_enqueue_script('shortcodes');
          	wp_enqueue_script('superfish');			
			
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }   	
	   		
			if( ($smof_data['rnr_home_type']=="FullScreen Slider") ) { 
			   wp_enqueue_script('rnrSupersized');
			}	
			
			
			if( ($smof_data['rnr_enable_googlemap']) ) {
				wp_enqueue_script( 'gmap');
				wp_enqueue_script( 'infoBox');
			}
			if( ($smof_data['rnr_home_type']=="Video") ) {
			   if($smof_data['rnr_home_video_type']=="youtube") { 	 
				 wp_enqueue_script('rnrYoutubeBgVideo');	
			   }else if($smof_data['rnr_home_video_type']=="vimeo") { 
				 wp_enqueue_script('rnrVimeoBgVideo');	
			  }	
			}				
	
	}
  add_action('wp_footer', 'rocknrolla_front_scripts'); 





}
/* Register Stylesheets */
function rocknrolla_print_styles() {  	
	if ( !is_admin() ){
		
		global $smof_data;
		wp_register_style( 'rnrSkeleton', RNR_INDEX_CSS. '/skeleton.css', array(), '1', 'all' );	
		wp_register_style( 'rnrWide', RNR_INDEX_CSS. '/1200.css', array(), '1', 'all' );
		wp_register_style( 'rnrSocial', RNR_INDEX_CSS. '/social.css', array(), '1', 'all' );	
		wp_register_style( 'rnrFlexslider', RNR_INDEX_CSS. '/flexslider.css', array(), '1', 'all' );	
		wp_register_style( 'rnrFontawesome', RNR_INDEX_CSS. '/font-awesome.css', array(), '1', 'all' );	
		wp_register_style( 'rnrPrettyPhoto', RNR_INDEX_CSS. '/prettyPhoto.css', array(), '1', 'all' );
		wp_register_style( 'rnrShortcodes', RNR_INDEX_CSS. '/shortcodes.css', array(), '1', 'all' );	
		wp_register_style( 'rnrTheme', RNR_INDEX_CSS. '/theme.css', array(), '1', 'all' );			
		wp_register_style( 'rnrRTL', RNR_INDEX_CSS. '/rtl.css', array(), '1', 'all' );			
		wp_register_style( 'rnrSupersized', RNR_INDEX_CSS. '/supersized.css', array(), '1', 'all' );				
		wp_register_style( 'rnrSupersizedFun', RNR_INDEX_CSS. '/supersized.shutter.css', array(), '1', 'all' );			
		wp_register_style( 'rnrDark', RNR_INDEX_CSS. '/dark.css', array(), '1', 'all' );			
		wp_register_style( 'rnrMedia', RNR_INDEX_CSS. '/media.css', array(), '1', 'all' );
		wp_register_style( 'rnrAnimate', RNR_INDEX_CSS. '/rnr-animate.css', array(), '1', 'all' );
				
      if( $smof_data['rnr_enable_widescreen']) {			
		wp_enqueue_style( 'rnrWide' ); 		
	  } else {
		wp_enqueue_style( 'rnrSkeleton' ); 		  
	  }   	 			

		wp_enqueue_style( 'rnrSocial' ); 	 
		wp_enqueue_style( 'rnrFlexslider' ); 	 
		wp_enqueue_style( 'rnrFontawesome' ); 	 
		wp_enqueue_style( 'rnrPrettyPhoto' );	 
		wp_enqueue_style( 'rnrShortcodes' ); 	 
		wp_enqueue_style( 'shortcodes' ); 
		wp_enqueue_style( 'rnrTheme' );	
		
		if($smof_data['rnr_disable_animation'] == false) {
		  wp_enqueue_style( 'rnrAnimate' ); 
		}		

		if($smof_data['rnr_enable_rtl_layout'] == true) {
			wp_enqueue_style( 'rnrRTL' ); 
		}				
		wp_enqueue_style( 'rnrMedia' ); 
			
		if($smof_data['rnr_home_type']=="FullScreen Slider") { 
		   wp_enqueue_style('rnrSupersized');
		   wp_enqueue_style('rnrSupersizedFun');
		}
		
		if($smof_data['rnr_enable_dark_skin']==true) { 
		   wp_enqueue_style( 'rnrDark' );
		}	
			    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1', 'all' );				
	}  
}
add_action( 'wp_print_styles', 'rocknrolla_print_styles' );











/* Post Thumbnails */
if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );

/* Word Limiter */
function rocknrolla_limit_words($string, $limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $limit));
}

/* Custom Image Sizes */	
//if($smof_data['rnr_enable_widescreen'] == "1") {
	
	  // ULTRA RESPONSIVE 1200PX GRID SIZES

		  add_image_size( 'blog-standard', 770, 330, true );
		  add_image_size( 'span12', 1172, 400, true ); 
		  add_image_size( 'span7', 670, 400, true );		  
		  add_image_size( 'span6', 570, 372, true );		
		  add_image_size( 'span4', 370, 241, true ); 		
		  add_image_size( 'span3', 270, 176, true );	  
		  add_image_size( 'blog-span6', 570, 210, true );		
		  add_image_size( 'blog-span4', 370, 150, true ); 		
		  add_image_size( 'blog-span3', 270, 120, true );			  
		  add_image_size( 'mini', 60, 60, true ); 			


 function ago($time) {
	   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	   $lengths = array("60","60","24","7","4.35","12","10");

	   $now = time();

	       $difference     = $now - $time;
	       $tense         = "ago";

	   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	       $difference /= $lengths[$j];
	   }

	   $difference = round($difference);

	   if($difference != 1) {
	       $periods[$j].= "s";
	   }

	   return "$difference $periods[$j] ago ";
	}
	 
	 
	
/* Comments Function */		
function rocknrolla_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>	
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix"> 	   		
		<div class="avatar"><?php echo get_avatar($comment, $size = '50'); ?></div>	         
		 <div class="comment-text">	         
			 <div class="author">
				<span><?php printf( __( '%s', 'rocknrolla'), get_comment_author_link() ) ?></span>
				<div class="date">
				<?php printf(__('%1$s at %2$s', 'rocknrolla'), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'rocknrolla'),'  ','' ) ?>
				&middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>  </div>  
			 </div>				 
			 <div class="text"><?php comment_text() ?></div>				 
			 <?php if ( $comment->comment_approved == '0' ) : ?>
			 <em><?php _e( 'Your comment is awaiting moderation.', 'rocknrolla' ) ?></em>
			 <br />
			<?php endif; ?>		      	
		</div>	      
   </div>	
<?php }



   
  
/* Pagination Function*/   
function rocknrolla_pagination($pages = '', $range = 4) {
	$showitems = ($range * 2)+1;
	
	global $paged;
	if(empty($paged)) $paged = 1;
	
	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}
	

		echo "<span class='allpages'>" . __('Page', 'rocknrolla') . " ".$paged." " . __('of', 'rocknrolla') . " ".$pages."</span>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; " . __('First', 'rocknrolla') . "</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; " . __('Previous', 'rocknrolla') . "</a>";
		
		for ($i=1; $i <= $pages; $i++) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"next-page\">".$i."</a>";
			}
		}
	
		if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">" . __('Next', 'rocknrolla') . " &rsaquo;</a>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>" . __('Last', 'rocknrolla') . " &raquo;</a>";
	
}
	

/* Add RSS Links to head section */
add_theme_support( 'automatic-feed-links' );
add_filter('widget_text', 'do_shortcode');
add_filter( 'the_content', 'do_shortcode', 11 ); 
/* Add prettyPhoto to content anchor tags */	
add_filter( 'wp_get_attachment_link', 'rocknrolla_custom_prettyphoto');



	function rocknrolla_excerpt_more($more) {
		global $post;
		return '&hellip;<p><a href="'. get_permalink($post->ID) . '" class="read-more-link">' . '' . __('Read More', 'rocknrolla') . ' &rarr;' . '</a></p>';
	}
	add_filter('excerpt_more', 'rocknrolla_excerpt_more');

	
	
	

function rocknrolla_custom_prettyphoto($content) {
	$content = preg_replace("/<a/","<a data-rel=\"prettyPhoto\"",$content,1);
	return $content;
}

  
  register_sidebar(array(
	 'name' => __('Blog Sidebar','rocknrolla' ),
	 'id'   => 'blog-widgets',
	  'description'   => __( 'These are widgets for the Blog page.','rocknrolla' ),
	  'before_widget' => '<div id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>'
  ));  
  
    register_sidebar(array(
	 'name' => __('Woocommerce Sidebar','rocknrolla' ),
	 'id'   => 'woocommerce-widgets',
	  'description'   => __( 'These are widgets for the Woocommerce page.','rocknrolla' ),
	  'before_widget' => '<div id="%1$s" class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h3>',
	  'after_title'   => '</h3>'
  )); 
  


function register_menus() {
	register_nav_menus( array( 'main-menu' => 'Primary Navigation Menu', 
                              'footer-menu' => 'Footer Navigation') );
}
add_action('init', 'register_menus');
 
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $object, $depth = 0, $args = Array() , $current_object_id = 0) {
           
          global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $object->classes ) ? array() : (array) $object->classes;
           $icon_class = $classes[0];
		   $classes = array_slice($classes,1);

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           

           $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
           $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
           $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
          	
          	if( $icon_class != '' ) {
            	$icon_classes = '<i class="'. $icon_class .'"></i>';
		   	}
		   	else{
		   		$icon_classes = '';
		   	}

           if($object->object == 'page')
           {
                $varpost = get_post($object->object_id);                
                $separate_page = get_post_meta($object->object_id, "rnr_separate_page", true);
                $disable_menu = get_post_meta($object->object_id, "rnr_disable_section_from_menu", true);
				$current_page_id = get_option('page_on_front');

                if ( ( $disable_menu != true ) && ( $varpost->ID != $current_page_id ) ) {

                	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

                	if ( $separate_page == true )
	                	$attributes .= ! empty( $object->url ) ? ' href="'   . esc_attr( $object->url ) .'"' : '';
	                else{
	                	if (is_front_page()) 
	                		$attributes .= ' href="#' . $varpost->post_name . '"'; 
	                	else 
	                		$attributes .= ' href="' . home_url('/') . '#' . $varpost->post_name . '"';
	                }	

	                $object_output = $args->before;
		            $object_output .= '<a'. $attributes .'>';
		            $object_output .= $args->link_before . $icon_classes . '<span>' . apply_filters( 'the_title', $object->title, $object->ID ) . '</span>';
		            $object_output .= $args->link_after;
		            $object_output .= '</a>';
		            $object_output .= $args->after;    

		             $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );            	              	
                }
                                         
           }
           else{

           		$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

                $attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) .'"' : '';

	            $object_output = $args->before;
	            $object_output .= '<a'. $attributes .'>';
	            $object_output .= $args->link_before . $icon_classes . '<span>' . apply_filters( 'the_title', $object->title, $object->ID ) . '</span>';
	            $object_output .= $args->link_after;
	            $object_output .= '</a>';
	            $object_output .= $args->after;

	             $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
	        }

           
      }
}

	add_filter( 'posts_orderby', 'sort_query_by_post_in', 10, 2 );
	function sort_query_by_post_in( $sortby, $thequery ) {
		if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
			$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";
		return $sortby;
	}


if(function_exists('icl_get_languages')) {
function language_selector_flags(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        foreach($languages as $l){
            if(!$l['active']) echo '<a href="'.$l['url'].'">';
            echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
            if(!$l['active']) echo '</a>';
        }
    }
}
add_action('wpml_languages_list', 'language_selector_flags');
}

// THIS GIVES US SOME OPTIONS FOR STYLING THE ADMIN AREA
function custom_colors() {
   echo '<style type="text/css">
     i.mce-ico.mce-i-rnrscg:before {
	content: "R";
	font-size: 12px;
	font-weight: bold;
	color: white;
	background: #000000;
	padding: 5px 7px;
	border-radius: 4px;
}
         </style>';
}

add_action('admin_head', 'custom_colors');


if( !function_exists('rnr_add_image_placeholders') ){

	function rnr_add_image_placeholders( $content ) {
		
		if(is_preview() )
			return $content;
		
		/* Don't lazy-load if the content has already been run through previously */
		if ( false !== strpos( $content, 'data-original' ) ) {
			return $content;
		}
		
		$placeholder_image = NULL;
		
		// This is a pretty simple regex, but it works
		$content = preg_replace( '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', sprintf( '<img${1}src="${2}" data-original="${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $placeholder_image ), $content );
		$content = preg_replace('/(<img.*? class=".*?)(".*?>)/', '$1 portfolio-lazyLoad$2', $content);
		
		return $content;
		
	}
	
	add_filter( 'the_content', 'rnr_add_image_placeholders', 99 );
		
}

/*
 * Add a Menu to the Theme Editor for Multisite and Standalone WordPress
 */
function rnr_themeoptions_menu() {
	global $wp_admin_bar;
		if ( !is_user_logged_in() ) { return; }
		if ( !is_super_admin() || !is_admin_bar_showing() ) { return; }
	if ( function_exists('is_multisite') && is_multisite() ) {
		$wp_admin_bar->add_menu( array(
			'id' => 'rnr-theme-options',
			'title' => __('Theme Options'),
			'href' => network_admin_url( 'themes.php?page=optionsframework' ) )
		);
	}else{
		$wp_admin_bar->add_menu( array(
			'id' => 'rnr-theme-options',
			'title' => __('Theme Options'),
			'href' => admin_url( 'themes.php?page=optionsframework' ) )
		);
	}
}
add_action( 'admin_bar_menu', 'rnr_themeoptions_menu', 100 );



function rnr_hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
          return $default; 

	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}

function get_attachment_caption( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}




/*----------------------------------------------------*/
/* ROCKNROLLA POST PAGINATION FUNCTION
/*----------------------------------------------------*/
function paginate() {
global $wp_query, $wp_rewrite;
$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
 
$pagination = array(
    'base' => @add_query_arg('page','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'show_all' => false,
    'type' => 'list',
    'next_text' => '&raquo;',
    'prev_text' => '&laquo;'
    );
 
if( $wp_rewrite->using_permalinks() )
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 'page', get_pagenum_link( 1 ) ) ) . '?page=%#%/', 'paged' );
 
if( !empty($wp_query->query_vars['s']) )
    $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
 
echo paginate_links( $pagination );
}  


