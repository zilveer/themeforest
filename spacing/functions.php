<?php

//
// Spacing Theme Functions
//
// Author: Tauris
// URL: http://themeforest.net/user/Tauris/
//

//
// Localization
//

load_theme_textdomain( 'spacing', get_template_directory().'/lang' );


//
// Custom Image Sizes
//


if ( function_exists( 'add_theme_support' ) ) { 
	
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );

	
	$image_sizes = array(
		'homepage-slider' => array(
			'width' 	=> 980,
			'height' 	=> 360,
			'crop' 		=> true
		),
		'large' => array(
			'width' 	=> 940,
			'height' 	=> '',
			'crop' 		=> false
		),
		'content-size' => array(
			'width' 	=> 700, 		
			'height' 	=> '',
			'crop' 		=> false
		),
		'content-wide' => array(
			'width' 	=> 700, 		
			'height' 	=> 264,
			'crop' 		=> true
		),
		'blog-normal' => array(
			'width' 	=> 580,		
			'height' 	=> '',
			'crop' 		=> false
		),
		'one-half' => array(
			'width' 	=> 460,		
			'height' 	=> 304,
			'crop' 		=> true
		),
		'fullwidth' => array(
			'width' 	=> 940,			
			'height' 	=> 622,
			'crop' 		=> true
		),
	);
	
	foreach( $image_sizes as $size => $atts )
	add_image_size( $size, $atts['width'], $atts['height'], $atts['crop'] );
	
	add_theme_support('automatic-feed-links');
}

//
// Custom Menu
//

add_action('init', 'register_custom_menu');
 
function register_custom_menu() {
register_nav_menu('custom_menu', 'Navigation');
}

// Responsive version

function responsive_select_nav() {
	
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations[ 'custom_menu' ] );
	
	$items = wp_get_nav_menu_items($menu->term_id);
	global $of_option;
	$prefix = "st_"; 
	if($of_option[$prefix.'translate']){	
		$tr_select_page = $of_option[$prefix.'tr_select_page'];
	}else{			
		$tr_select_page = __('Select page:', 'spacing');	
	}
	echo "<select id='page_id' name='page_id'>";
	echo "<option>".$tr_select_page."</option>";
	   foreach ($items as $list){
			  if($list->menu_item_parent != "0"){
			  echo "<option value=".$list->url.">&nbsp; &nbsp;".$list->title."</option>";
			  }
			  else {
			  echo "<option value=".$list->url.">".$list->title."</option>";
			  }
	
	   }
	echo "</select>";
}

// Remove "Page Parent" class from Blog if Portfolio Post

function remove_parent_classes($class)
{
	return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor'  || $class == 'current-menu-item') ? FALSE : TRUE;
}

function add_class_to_wp_nav_menu($classes)
{
     switch (get_post_type())
     {
     	case 'portfolio':
     		$classes = array_filter($classes, "remove_parent_classes");  
			
			// add the current page class to a specific menu item (replace ###).
     		if (in_array('menu-item-61', $classes))
     		{
     		   $classes[] = 'current_page_parent';
         	} 
			 		
     		break;
     }
	return $classes;
}
add_filter('nav_menu_css_class', 'add_class_to_wp_nav_menu');

//
// Breadcrumbs
//

function the_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<li><a href="#">'; // tag before the current crumb
  $after = '</a></li>'; // tag after the current crumb
 
  global $post;
  $homeLink = home_url();
 
  if (is_page_template('template-home.php')) {
 
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div id="breadcrumbs"><div class="container clearfix"><div class="sixteen columns"><ul class="breadcrumb"><li><a class="bread-home" href="' . $homeLink . '"></a></li>';
	
 	$frontpage_id = get_option('page_for_posts');
	$blog_title = '<li><a href="'.get_permalink($frontpage_id).'">'.get_the_title($frontpage_id).'</a></li>';
	  
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
	  echo $blog_title;
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 	
    } elseif ( is_day() ) {
	  echo $blog_title;
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
	  echo $blog_title;
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
	  echo $blog_title;
      echo $before . get_the_time('Y') . $after;
	  
	} elseif (is_home()) {
		echo $blog_title;	
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        global $of_option;
		$parent_url = $of_option['st_recent_work_url'];		
		if($parent_url) { echo '<li><a href="' . get_permalink($parent_url) . '">' . get_the_title($parent_url) . '</a></li>'; }
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
		echo $blog_title;
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
		echo $blog_title;
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);	  
	  
	  echo $blog_title;
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
      echo $before . __('Page', 'spacing') . ' ' . get_query_var('paged') . $after;
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
    }
 
    echo '</ul></div></div></div>';
 
  }
} // end dimox_breadcrumbs()


if ( ! isset( $content_width ) ) $content_width = 980;

//
// Register Sidebars
//

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
        'name' => 'Default Sidebar',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));	
	register_sidebar(array(
        'name' => 'Archives/Search Sidebar',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));	
    register_sidebar(array(
        'name' => 'Footer Column 1',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => 'Footer Column 2',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => 'Footer Column 3',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));
	register_sidebar(array(
        'name' => 'Footer Column 4',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));
	
	$sidebars = get_option( 'sidebarmanager_options');  
  
	if(isset($sidebars['custom_sidebar']) && sizeof($sidebars['custom_sidebar']) > 0)  
	{  
		foreach($sidebars['custom_sidebar'] as $sidebar)  
		{  
			register_sidebar( array(  
				'name' => $sidebar,
				'before_widget' => '<div class="sidebar-widget">',  
				'after_widget' => '</div>',
				'before_title' => '<h5>',
				'after_title' => '</h5>',
			) );  
		}  
	}
	
}


//
// Scripts and Styles
//

function st_custom() {
	if (!is_admin()) 
	{
		wp_register_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js', array('jquery'));
				
		wp_register_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));	
		wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'));	
		wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'));	
		wp_register_script('isotope-config', get_template_directory_uri() . '/js/jquery.isotope-config.js', array('jquery'));	
		wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'));	
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'));
		wp_register_script('contact-form', get_template_directory_uri() . '/js/contact-form.js', array('jquery'));
		
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('custom');
		wp_enqueue_script('easing');		
		wp_enqueue_script('prettyPhoto');		
		
		global $of_option;
		if($of_option['st_header_border']){
			wp_register_script('navigation-border', get_template_directory_uri() . '/js/navigation-border.js', array('jquery'));	
			wp_enqueue_script('navigation-border');	
		}	
	
		wp_register_style('style-dynamic', get_template_directory_uri() . '/style-dynamic.php');
		wp_register_style('skeleton', get_template_directory_uri() . '/css/skeleton.css');		
		wp_register_style('isotope', get_template_directory_uri() . '/css/scripts/isotope.css');
		wp_register_style('flexslider', get_template_directory_uri() . '/css/scripts/flexslider.css');	
		wp_register_style('prettyPhoto', get_template_directory_uri() . '/css/scripts/prettyPhoto.css');	
		
		wp_enqueue_style('style-dynamic');
		wp_enqueue_style('skeleton');
		wp_enqueue_style('flexslider');
		wp_enqueue_style('prettyPhoto');
		
		if($of_option['st_responsive']){
			wp_register_style('skeleton-responsive', get_template_directory_uri() . '/css/skeleton-responsive.css');
    		wp_enqueue_style('skeleton-responsive');
		}
	}
}
add_action('init', 'st_custom');


//
// Specific Page Scripts
//

// Home Page

function st_homepage() {
	if (is_page_template('template-home.php'))
	{
	wp_enqueue_script('flexslider');	
	}	
}
add_action('wp_print_scripts', 'st_homepage');

// Portfolio Page

function st_portfolio() {
	if (is_page_template('template-portfolio.php'))
	{
	wp_enqueue_script('isotope');
	wp_enqueue_script('isotope-config');
	wp_enqueue_style('isotope');
	}	
}
add_action('wp_print_scripts', 'st_portfolio');


// Contact Form

function st_contact() {
	if (is_page_template('template-contact.php'))
	{
	wp_enqueue_script('contact-form');
	}	
}
add_action('wp_print_scripts', 'st_contact');

// Comments Script

function ts_comments() {
	if(is_singular() || is_page())
	wp_enqueue_script( 'comment-reply' );
}
add_action('wp_print_scripts', 'ts_comments');


//
// Shared Metaboxes
//

require_once('functions/shared-metaboxes.php'); 


//
// Clients Functions
//

require_once('functions/clients-functions.php');

//
// Testimonials Functions
//

require_once('functions/testimonials-functions.php');

//
// Portfolio Functions
//

require_once('functions/portfolio-functions.php'); 

 
//
// Slider Functions
//

require_once('functions/slider-functions.php');


//
// Post Gallery
//

function post_gallery($layout) {
	
	global $post,$post_gallery,$of_option;
	$gallery = $post_gallery->the_meta();
	
	if($layout == "sidebar-right" || $layout == "sidebar-left" || $layout !=="fullwidth" && $gallery['gallery_type'] == "image_list"){
		$img_size = "content-size";
	}elseif($layout =="fullwidth" && $gallery['gallery_type'] == "image_list"){
		$img_size = "large";
	}else{
		$img_size = "homepage-slider";
	}
	
	$thumb = get_the_post_thumbnail($post->ID, $img_size, array('alt' => $post->post_title, 'title' => $post->post_title));	
	
	// If Lightbox Gallery
	if($gallery['gallery_type'] == "lightbox"){				

		?>	
        <div class="featured-image-holder">			
		<div class="gallery clearfix" > 
			<a class="opacity-hover" href="<?php $imgurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); echo $imgurl[0]; ?>" rel="gallery[gallery<?php echo $post->ID; ?>]"><?php echo $thumb; ?>
                  <span class="overlay-content">                   
                      <span class="overlay-link-alt"><span class="open-gallery"></span></span>
                  </span>          
            </a>                     
			<?php lightbox_gallery_images(); ?>
			
		</div>
        </div>
		<?php
		
	// If Images List
	}elseif($gallery['gallery_type'] == "image_list"){
		
		echo $thumb;				
		echo '<div class="portfolio-image-list">';				
		if($gallery['docs']){
			foreach ($gallery['docs'] as $image)
			{
				echo '<img src="' . $image['imgurl'] . '" alt>';
			}	
		}								
		echo '</div>';
						
	}else{
		echo '<div class="featured-image-holder">';
		if(!$thumb) { $thumb = get_the_post_thumbnail($post->ID, "", array('alt' => $post->post_title, 'style' => 'width:100%; height:auto;', 'title' => $post->post_title)); }
		echo $thumb;
		echo '</div>';
		
	}
	
}

//
// Post Tags
//

function post_tags(){

	$prefix = "st_"; 
	if($of_option[$prefix.'translate']){	
		$tr_tags = $of_option[$prefix.'tr_tags'];
	}else{			
		$tr_tags = __('Tags', 'spacing');
	}
	$posttags = get_the_tags();
	if ($posttags) {
		echo "<p><span>".$tr_tags."</span>";	
		foreach($posttags as $tag) {	
		  echo '<a href="'. get_tag_link($tag->term_id) .'">'; 
		  echo $tag->name.', ';	 
		  echo "</a>";
		}
  		echo "</p>";
	}	
}

//
// Excerpt
//

function new_excerpt_length($length) {
	return 12;
}
function new_excerpt_more($more) {
	global $post,$of_option;
	$prefix = "st_"; 
	if($of_option[$prefix.'translate']){	
		$tr_read_more = $of_option[$prefix.'tr_read_more'];
	}else{			
		$tr_read_more = __('Read More', 'spacing');	
	}	
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('excerpt_length', 'new_excerpt_length');

//
// Blog pagination || Credits to Kriesi.at
//

function blog_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

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
         echo "<div class='pagination'>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }
         echo "</div>\n";
     }
}

//
// Comment Layout
//

function st_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment-holder clearfix">
    
		<div class="avatar-holder left"> 
            <?php echo get_avatar($comment,$size='48'); ?>
        </div>
        
        <div class="comment-entry"> 
            <div class="comment-meta"> 
            	<span><?php printf('%s', get_comment_author_link()) ?></span> on <span><?php  echo get_comment_date('M d, Y'); ?></span>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'],reply_text => 'Reply'))) ?><?php edit_comment_link(__(' | Edit'),'  ','') ?>
            </div> 
            <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'spacing') ?></em>
         <br />
		<?php endif; ?>
        
        <?php comment_text() ?>       
            
        </div>


<?php
}

//
// Tracking Code
//

if ( function_exists('tracking_code') ) {
  add_action('wp_footer', 'tracking_code');
}

function tracking_code(){
	global $of_option;
	echo $of_option['st_tracking_code'];
}

//
// Shortcodes
//

include get_template_directory() . '/functions/shortcodes.php';

add_filter('the_content', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');

//
// Widgets
//

include get_template_directory() . '/functions/widget-blogpost.php';
include get_template_directory() . '/functions/widget-portfoliopost.php';
include get_template_directory() . '/functions/widget-testimonials.php';
include get_template_directory() . '/functions/widget-flickr.php';
include get_template_directory() . '/functions/widget-vimeo.php';
include get_template_directory() . '/functions/widget-youtube.php';
include get_template_directory() . '/functions/widget-googlemaps.php';

//
// Dashboard Functions
//


function add_sumtips_admin_bar_link() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'theme_options',
	'title' => __('Theme Options', 'spacing_backend'),
	'href' => admin_url( 'admin.php?page=optionsframework'),
	) );
}
add_action('admin_bar_menu', 'add_sumtips_admin_bar_link',35);

require_once ('admin/index.php');

function st_admin_scripts() {	
	wp_register_script('dashboard-jquery', get_template_directory_uri() . '/admin/assets/js/jquery.dashboard.js');
	wp_enqueue_script('dashboard-jquery');
	wp_enqueue_script('thickbox');	
}

function st_admin_styles() {
	wp_register_style('dashboard-styles', get_template_directory_uri() . '/admin/assets/css/dashboard-styles.css');	
	wp_enqueue_style('dashboard-styles');
	wp_enqueue_style('thickbox');
}

if(is_admin()) {
	add_action('admin_print_scripts', 'st_admin_scripts');	
	add_action('admin_print_styles', 'st_admin_styles');
	include get_template_directory() . '/functions/tinymce/tinymce.php';
	include get_template_directory() . '/functions/post-ordering/simple-page-ordering.php';
}