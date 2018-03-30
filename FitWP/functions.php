<?php


/*
* Include OptionTree plugin for theme options.
*/

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_true' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

global $options;
$options = get_option('option_tree');

/**
 * Required: include OptionTree.
 */
include_once( get_template_directory() . '/option-tree/ot-loader.php' );

// Breadcrumb

function my_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo '">HOME';
	
		echo "</a>";
		if (is_category() || is_single()) {
			the_category(' ');
			if (is_single()) {
			
			echo '<span>';	the_title();echo '</span>';
			}
		} elseif (is_page()) {
			echo '<span>';the_title();'</span>';
		}
	}
}
// Page Navigation

function kriesi_pagination($pages = '', $range = 2)
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
         echo "<ul class='pagination sixteen columns clearfix'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='button-small grey rounded3' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<a class='button-small-theme rounded3' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class='button-small-theme rounded3 current' style='background: #352C22;'>".$i."</span></li>":"<li><a class='button-small grey rounded3' href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a class='button-small-theme rounded3' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a class='button-small-theme rounded3' href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         echo "</ul>\n";
     }
}

// Custom menu 


add_theme_support('nav-menus');

register_nav_menu('main_menu', 'Main Menu');

function display_home2() {
    echo '<ul class="nav clearfix sf-menu sf-js-enabled sf-shadow">
		';
    wp_list_pages('title_li=&depth=3');
    echo '</nav>';
}

class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<span class="title">';
           $append = '</span>';
           $description  = ! empty( $item->description ) ? '<span class="description">'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}



// Post Thumbnails

  add_theme_support( 'post-thumbnails' ); 
 
add_theme_support('automatic-feed-links');
// Ready for theme localisation
load_theme_textdomain('localization');

include("includes/metaboxes/metaboxes.php");
require_once TEMPLATEPATH . '/includes/comment-list.php';

/* ==OTHER FUNCTION === */

function ddTimthumb($img, $width, $height) {

    return get_template_directory_uri() . '/includes/timthumb.php?q=100&amp;zc=1&amp;src=' . $img . '&amp;w=' . $width . '&amp;h=' . $height;
}


// Registering our sidebar


if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Home Horizontal Widget',
'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
}


if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Pages',
'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}




if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Single Classes',
'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}
if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Single Trainers',
'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}

if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Single Blog Post',
'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}


if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Blog',
'before_widget' => '<li class="widget"><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}


if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Widgetized Module',
'before_widget' => '<li class="one-third column widget"><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}


if (function_exists('register_sidebar')) {
register_sidebar(array(
'name' => 'Footer',
'before_widget' => '<li class="widget one-third column"><div id="%1$s" class="%2$s">',
'after_widget' => '</div></li>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
}



// Set custom query + Take it off + Related Post

function dd_set_query($custom_query=null) { global $wp_query, $wp_query_old, $post, $orig_post;

	$wp_query_old = $wp_query;

	$wp_query = $custom_query;

	$orig_post = $post;

}

function dd_restore_query() {  global $wp_query, $wp_query_old, $post, $orig_post;

	$wp_query = $wp_query_old;

	$post = $orig_post;

	setup_postdata($post);

}



include('includes/cpt-classes.php');
include('includes/cpt-trainers.php');
include('includes/theme-options.php');





function fitstyles()
{

	// Register the style like this for a theme:
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/stylesheets/prettyPhoto.css', array(), '20120208', 'all' );
        wp_register_style( 'superfish', get_template_directory_uri() . '/stylesheets/superfish.css', array(), '20120208', 'all' );
        wp_register_style( 'flexslider', get_template_directory_uri() . '/stylesheets/flexslider.css', array(), '20120208', 'all' );
        wp_register_style( 'btn', get_template_directory_uri() . '/stylesheets/btn.css', array(), '20120208', 'all' );
        wp_register_style( 'skeleton', get_template_directory_uri() . '/stylesheets/skeleton.css', array(), '20120208', 'all' );
            wp_register_style( 'base', get_template_directory_uri() . '/stylesheets/base.css', array(), '20120208', 'all' );

  
	
                                                
                                                  //enqueues our scripts. let's enqueue jquery first to just make sure its loaded first in any case

     wp_enqueue_style( 'prettyPhoto' ); 
       wp_enqueue_style( 'superfish' ); 
         wp_enqueue_style( 'flexslider' ); 
           wp_enqueue_style( 'btn' ); 
             wp_enqueue_style( 'skeleton' ); 
                     wp_enqueue_style( 'base' ); 

  wp_enqueue_style( 'dd-social-icons', get_template_directory_uri() . '/stylesheets/social-icons.css');

    
}
add_action( 'wp_enqueue_scripts', 'fitstyles' );


function cdfScripts() {

 
    wp_register_script('script', get_template_directory_uri() . '/js/script.js');

    wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js');
  
    wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js');
 
    wp_register_script('easing', get_template_directory_uri() . '/js/hoverIntent.js');
    
    wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js');
    
        wp_register_script('iso', get_template_directory_uri() . '/js/jquery.isotope.min.js');
    
    //enqueues our scripts. let's enqueue jquery first to just make sure its loaded first in any case

    wp_enqueue_script('jquery');
    wp_enqueue_script('script');

    wp_enqueue_script('prettyPhoto');

    wp_enqueue_script('hoverIntent');
    wp_enqueue_script('superfish');
    wp_enqueue_script('flexslider');
     wp_enqueue_script('iso');

  
  
}

add_action('wp_enqueue_scripts', 'cdfScripts');

add_post_type_support( 'post_classes', 'excerpt' );
add_post_type_support( 'post_trainers', 'excerpt' );



include("includes/widget-classes.php");
include("includes/widget-trainers.php");
include("includes/widget-news.php");

include_once("includes/tgn-meta-boxes.php");

//Google Maps Shortcode
function fn_googleMaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => ''
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed"></iframe>';
}
add_shortcode("googlemap", "fn_googleMaps");


