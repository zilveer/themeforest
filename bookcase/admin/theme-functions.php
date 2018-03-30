<?php

/* These are functions specific to the included option settings and this theme */

/*-----------------------------------------------------------------------------------*/
/* Theme Header Output - wp_head() */
/*-----------------------------------------------------------------------------------*/

// This sets up the layouts and styles selected from the options panel
	
if (!function_exists('optionsframework_wp_head')) {
	function optionsframework_wp_head() { 
		$shortname =  get_option('of_shortname');	
		// This prints out the custom css and specific styling options
		of_head_css(); 
	}
} 

add_action('wp_head', 'optionsframework_wp_head'); 


/*-----------------------------------------------------------------------------------*/
/* Output CSS from standarized options */
/*-----------------------------------------------------------------------------------*/

function of_head_css() {

		$shortname =  get_option('of_shortname'); 
		$output = '';
		
		$custom_css = get_option('of_custom_css');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
	
}
	
/*-----------------------------------------------------------------------------------*/
/* Add Body Classes for Layout
/*-----------------------------------------------------------------------------------*/

// This used to be done through an additional stylesheet call, but it seemed like
// a lot of extra files for something so simple. Adds a body class to indicate sidebar position.

add_filter('body_class','of_body_class');
 
function of_body_class($classes) {
	$shortname =  get_option('of_shortname');
	$layout = get_option($shortname .'_layout');
	if ($layout == '') {
		$layout = 'layout-2cr';
	}
	$classes[] = $layout;
	return $classes;
}

/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function childtheme_favicon() {
		$shortname =  get_option('of_shortname'); 
		if (get_option($shortname . '_custom_favicon') != '') {
	        echo '<link rel="shortcut icon" href="'.  get_option('of_custom_favicon')  .'"/>'."\n";
	    }
		else { ?>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />
<?php }
}

add_action('wp_head', 'childtheme_favicon');

/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function childtheme_analytics(){
	$shortname =  get_option('of_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','childtheme_analytics');



/*-----------------------------------------------------------------------------------*/
/*	New category walker for portfolio filter
/*-----------------------------------------------------------------------------------*/

class Walker_Portfolio_Filter extends Walker_Category {
        /**
         * Outputs a customized list of category links
         * 
         * @param  string  $output   String to output at the end
         * @param  array   $category Stores all category information (slug, id, name, etc.)
         * @param  integer $depth    Depth of categories
         * @param  array   $args     Extracts arguments for function
         * 
         * @return string Outputs customized string
         */
       function start_el(&$output, $category, $depth = 0, $args = array(), $current_object_id = 0) {

      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      $link = '<a href="#" data-value="'.strtolower(preg_replace('/\s+/', '-', $cat_name)).'" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all projects filed under %s', 'framework'), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';
      // $link .= $cat_name . '</a>';
      $link .= $cat_name;
      if(!empty($category->description)) {
         $link .= ' <span>'.$category->description.'</span>';
      }
      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'framework'), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }
         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li class="segment-2"';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}
