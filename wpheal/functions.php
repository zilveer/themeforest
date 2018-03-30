<?php

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );

/**
 * Theme Options
 */
include_once( 'includes/theme-options.php' );

// Loading JS scripts and CSS style
add_action( 'wp_enqueue_scripts','heal_load_files' );

function heal_load_files() {
	// register script 
	wp_register_script( 'nivo-slider', get_template_directory_uri() . '/js/nivo-slider.js', array('jquery'), '3.0.1', false);
	wp_register_script( 'bx-slider', get_template_directory_uri() . '/js/bxslider.js', array('jquery'), '3.0', false);
	wp_register_script( 'jflickr-feed', get_template_directory_uri() . '/js/jflickrfeed.js', array('jquery'), '3.0', false);
	wp_register_script( 'lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '0.5', false);
	
	// register style
	wp_register_style( 'nivo-slider-css', get_template_directory_uri() . '/css/nivo-slider.css' ); 
	wp_register_style( 'jquery-ui-css', get_template_directory_uri() . '/css/jquery-ui.css' ); 
	wp_register_style( 'lightbox-css', get_template_directory_uri() . '/css/lightbox.css' ); 
	
	if ( is_home() ) {
		wp_enqueue_script( 'nivo-slider' );
		wp_enqueue_script( 'bx-slider' );
		wp_enqueue_style( 'nivo-slider-css' );
	}
	
	if ( is_page_template('gallery.php') || is_page_template('gallery-sidebar.php') || is_page_template('gallery-without-text.php') ) {
		wp_enqueue_script( 'lightbox' );
		wp_enqueue_style( 'lightbox-css' );
	}
	
	wp_enqueue_script( 'jflickr-feed' );
	wp_enqueue_script( 'jquery-ui-accordion' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_style ( 'jquery-ui-css' ); 
} 

// Custom Post Type "Gallery"
add_action( 'init', 'create_my_post_types' );

add_theme_support( 'woocommerce' );

function create_my_post_types() {
	register_post_type( 'gallery', 
		array(
			'labels' => array(
				'name' => 'Gallery',
				'singular_name' => 'Gallery'
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'menu_icon' => get_stylesheet_directory_uri() . '/images/media-button.png'
		)
	);
	register_post_type( 'slider', 
		array(
			'labels' => array(
				'name' => 'Slides' ,
				'singular_name' => 'Slides',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Slide',
				'edit' => 'Edit Slide',
				'edit_item' => 'Edit Slide',
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'menu_icon' => get_stylesheet_directory_uri() . '/images/media-button.png'
		)
	);
}

// Heal Breadcrumbs
function heal_breadcrumbs() {
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = home_url();
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      
      echo ' '.$delimiter . ' Page' . ' ' . get_query_var('paged');
     
    }
 
    echo '</div>';
 
  }
} 

//Set content width
if ( ! isset( $content_width ) ) $content_width = 980;

//Format top menu output for mobile
class mobile_walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth){
      $indent = str_repeat("\t", $depth);
    }
    function end_lvl(&$output, $depth){
      $indent = str_repeat("\t", $depth);
    }
	
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		$class_names = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
 
		//check if current page is selected page and add selected value to select element  
		  $selc = '';
		  $curr_class = 'current-menu-item';
		  $is_current = strpos($class_names, $curr_class);
		  if($is_current === false){
	 		  $selc = "";
		  } else {
	 		  $selc = "selected ";
		  }
 
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
		$sel_val =  ' value="'   . esc_attr( $item->url        ) .'"';
 
		//check if the menu is a submenu
		switch ($depth){
		  case 0:
			   $dp = "";
			   break;
		  case 1:
			   $dp = "--";
			   break;
		  case 2:
			   $dp = "---";
			   break;
		  case 3:
			   $dp = "----";
			   break;
		  case 4:
			   $dp = "-----";
			   break;
		  default:
			   $dp = "";
		}
		$output .= $indent . '<option'. $sel_val . $id . $value . $class_names . $selc . '>'.$dp;
		$item_output = $args->before;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
 
	function end_el(&$output, $item, $depth) {
		$output .= "</option>\n";
	}
}

// Add metabox 
add_action( 'add_meta_boxes', 'heal_meta_box_add' );  
add_action( 'save_post', 'metabox1_save' ); 
add_action( 'save_post', 'metabox2_save' ); 

function heal_meta_box_add() {  
    add_meta_box( 'metabox1', 'Description', 'metabox1_rendering', 'page', 'normal', 'high' );  
	add_meta_box( 'metabox2', 'Metabox', 'metabox2_rendering', 'slider', 'normal', 'high' ); 
}  

function metabox1_rendering($page) {
	$values = get_post_custom( $page->ID );
	$text = isset( $values['page_description'] ) ? esc_attr( $values['page_description'][0] ) : ''; 
	$check = isset( $values['breadcrumb'] ) ? esc_attr( $values['breadcrumb'][0] ) : '';  

    wp_nonce_field( 'metabox1_nonce', 'metabox1_nonce' ); 
?>
	<p><label for="page_description">Page description (leave this field blank if you don't want to show description on that page)</label><br />
    <p><textarea rows="5" cols="90" name="page_description" id="page_description"><?php echo $text ?></textarea></p></p>
	<p><div>Does breadcrumb should shows?</div>
	<p><input type="radio" id="breadcrumb_yes" name="breadcrumb" value="Yes" <?php checked( $check, 'Yes' ); ?> />
	<label for="breadcrumb_yes">Yes</label>
	<input type="radio" id="breadcrumb_no" name="breadcrumb" value="No" <?php checked( $check, 'No' ); ?> />
	<label for="breadcrumb_no">No</label></p></p>
<?php }

function metabox1_save($page) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;  
    if( !isset( $_POST['metabox1_nonce'] ) || !wp_verify_nonce( $_POST['metabox1_nonce'], 'metabox1_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
        
    if( isset( $_POST['page_description'] ) )  
        update_post_meta( $page, 'page_description', esc_attr( $_POST['page_description']) );    
          
    if( isset( $_POST['breadcrumb'] ) ) 
		update_post_meta( $page, 'breadcrumb', esc_attr( $_POST['breadcrumb']) );  
}


function metabox2_rendering($page) {
	$values = get_post_custom( $page->ID );
	$title = isset( $values['title'] ) ? esc_attr( $values['title'][0] ) : '';  
	$slideLink = isset( $values['slide_link'] ) ? esc_attr( $values['slide_link'][0] ) : ''; 
	
	
    wp_nonce_field( 'metabox2_nonce', 'metabox2_nonce' ); 
	
?>
	<p><div>Does title of slide should shows?</div>
	<p><input type="radio" id="title_yes" name="title" value="Yes" <?php checked( $title, 'Yes' ); ?> />
	<label for="title_yes">Yes</label>
	<input type="radio" id="title_no" name="title" value="No" <?php checked( $title, 'No' ); ?> />
	<label for="title_no">No</label></p></p>
	<p><div>Add link to slide (this will work only if previous option set to No)</div>
	<p><textarea rows="1" cols="80" name="slide_link"><?php echo $slideLink ?></textarea></p></p>
	
<?php }

function metabox2_save($page) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;  
    if( !isset( $_POST['metabox2_nonce'] ) || !wp_verify_nonce( $_POST['metabox2_nonce'], 'metabox2_nonce' ) ) return; 
    if( !current_user_can( 'edit_post' ) ) return;  
        
    if( isset( $_POST['title'] ) ) 
        update_post_meta( $page, 'title', esc_attr( $_POST['title']) );    
          
    if( isset( $_POST['slide_link'] ) ) 
		update_post_meta( $page, 'slide_link', esc_attr( $_POST['slide_link']) );  
}



// Custom excerpt (used at home page)
function heal_excerpt($num) {
	global $post;
    $limit = $num+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt)."... <a class='excerpt-link' href='" .get_permalink($post->ID) ."'>Read more</a>";
    echo $excerpt;
}

//Add pagination
function heal_pagination($pages = '', $range = 2) {  
     $showitems = $range+1;  

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
         echo "<div class='pagenavi'>";
		 echo "<span class='pages'>&#8201;Page ".$paged." of ".$pages."&#8201;</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&#8201;&laquo;&#8201;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>&#8201;".$i."&#8201;</span>":"<a href='".get_pagenum_link($i)."'>&#8201;".$i."&#8201;</a>";
             }
         } 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&#8201;&raquo;&#8201;</a>";
         echo "</div>\n";
     }
}

// Create Blog Navigation Widget
class blog_navigation_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'blog_navigation',
			'Blog Navigation',
			array( 'description' => 'Navigation link for blog page' )
		);
	}
	
	function widget($args, $instance) {
		extract( $args );	
		$title = $instance['title'];
	
		echo $before_widget;
		
		if ($title) {
			echo $before_title . $title . $after_title;
		}
 
		echo "<ul id=\"blog-categories\">";
		
		$category1 = get_category_by_slug('slider');	
		wp_list_categories( array( 'orderby' => 'name', 'show_count' => '1', 'title_li' => '', 'exclude' => $category1->cat_ID ) ); 

		echo "</ul>";
		echo $after_widget;
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['link_count'] = strip_tags($new_instance['link_count']);
		return $instance;
    }
	
	function form($instance) { 
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		}
		else {
			$title = '';
		}
		if (isset($instance['link_count'])) {
			$link_count = esc_attr($instance['link_count']);
		}
		else {
			$link_count = '';
		}
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php
	}

}

// Create About Us widget
class about_us_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'about_us',
			'About Us',
			array( 'description' => 'Display some information about your company' )
		);
	}
	
	function widget($args, $instance) {
		extract( $args );
		
		$title = $instance['title'];
		$text = $instance['text'];
		
		echo $before_widget;
		
		if ($title) {
			echo $before_title . $title . $after_title;
		}
		
		if ($text) {
			echo "<div id=\"aboutus-sidebar\">".$text."</div>";
		}
		
		echo $after_widget;
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = wp_kses($new_instance['text'], array('p' => array(), 'div' => array(), 'img' => array( 'src' => array() ), 'a' => array( 'href' => array() ), 'br' => array()));
		return $instance;
    }
	
	function form($instance) { 
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		}
		else {
			$title = '';
		}
		if (isset($instance['text'])) {
			$text = wp_kses($instance['text'], array('p' => array(), 'div' => array(), 'img' => array( 'src' => array() ), 'a' => array( 'href' => array() ), 'br' => array()));
		}
		else {
			$text = '';
		}
    ?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php echo 'About us text:'; ?></label>
        <textarea class="widefat" rows="10" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text"><?php echo $text; ?></textarea>
    </p>
    <?php
	}

}

// Create Archive Widget
class archives_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'archives',
			'Archives',
			array( 'description' => 'Display archives link' )
		);
	}
	
	function widget($args, $instance) {
		global $template;
		
		extract( $args );
		
		$title = $instance['title'];
		$link_count = $instance['link_count'];
		
		if ($link_count == '') $link_count = 5;
		
		echo $before_widget;
		
		if ($title) {
			echo $before_title . $title . $after_title;
		} else {
			echo $before_title . 'Archive' . $after_title;
		}
	
		echo "<ul id=\"archives\">\n";	
		wp_get_archives(array( 'echo' => 1, 'limit' => $link_count ));
		echo "</ul>\n";
		
		echo $after_widget;
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['link_count'] = strip_tags($new_instance['link_count']);
		return $instance;
    }
	
	function form($instance) { 
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		}
		else {
			$title = '';
		}
		if (isset($instance['link_count'])) {
			$link_count = esc_attr($instance['link_count']);
		}
		else {
			$link_count = '';
		}
    ?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('link_count'); ?>"><?php echo 'Number of link to display:'; ?></label>
        <input style="width:70px" id="<?php echo $this->get_field_id('link_count'); ?>" name="<?php echo $this->get_field_name('link_count'); ?>" type="text" value="<?php echo $link_count; ?>" />
    </p>
    <?php
	}

}

// Create Flickr Widget
class flickr_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'flickr',
			'Flickr Feed',
			array( 'description' => 'Display flickr feed' )
		);
	}
	
	function widget($args, $instance) {
		extract( $args );
		
		$title = $instance['title'];
		$user_id = $instance['user_id'];
		$image_count = $instance['image_count'];
		
		echo $before_widget;
		
		if ($title) {
			echo $before_title . $title . $after_title;
		}
		
		if ($image_count == '') $image_count = 6;
		
		?>
		
		<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				//Flickr Feed
				$('#flickr-feed').jflickrfeed({
					limit:<?php echo $image_count; ?>,
					qstrings:{ id: '<?php echo $user_id; ?>' },
					itemTemplate: 
						'<li>' +
						'<a href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a>' +
						'</li>',
				});
				
				$('#flickr-feed li:last-child').css({display:"none"});
				
			});
		})( jQuery );
		</script>
		
		<?php
		
		echo "<ul id=\"flickr-feed\"></ul>";
		
		echo $after_widget;
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image_count'] = strip_tags($new_instance['image_count']);
		$instance['user_id'] = strip_tags($new_instance['user_id']);
		return $instance;
    }
	
	function form($instance) { 
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		}
		else {
			$title = '';
		}
		if (isset($instance['image_count'])) {
			$image_count = esc_attr($instance['image_count']);
		}	
		else {
			$image_count = '';
		}
		if (isset($instance['user_id'])) {
			$user_id = esc_attr($instance['user_id']);
		}
		else {
			$user_id = '';
		}
	?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('user_id'); ?>"><?php echo 'Flickr user name ID :'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('user_id'); ?>" name="<?php echo $this->get_field_name('user_id'); ?>" type="text" value="<?php echo $user_id; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('image_count'); ?>"><?php echo 'Number of image to display:'; ?></label>
        <input style="width:70px" id="<?php echo $this->get_field_id('image_count'); ?>" name="<?php echo $this->get_field_name('image_count'); ?>" type="text" value="<?php echo $image_count; ?>" />
    </p>
    <?php
	}

}

// Create Contact Widget
class contact_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'contact',
			'Contact',
			array( 'description' => 'Display contact information' )
		);
	}
	
	function widget($args, $instance) {
		extract( $args );
		
		$title = $instance['title'];
		$text = $instance['text'];
		$telephone = $instance['telephone'];
		$email = $instance['email'];
		$skype = $instance['skype'];
	
		echo $before_widget;
		
		if ($title) {
			echo $before_title . $title . $after_title;
		}
		
		if (isset($text)) echo "<p id=\"pre-method-text\">".$text."</p>";
		
		if ( ($telephone != '') || ($email != '') || ($skype != '') ) {
			echo "<ul id=\"contact-method\">";
				if ($telephone != '') {
					echo "<li id=\"contact-telephone\">(telephone:) <br /> <span>".$telephone."</li>";
				}
				if ($email != '') {
					echo "<li id=\"contact-email\">(email:) <br /> <span>".$email."</li>";
				}
				if ($skype != '') {
					echo "<li id=\"contact-skype\">(email:) <br /> <span>".$skype."</li>";
				}
			echo "</ul>";
		}
		
		echo $after_widget;
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['telephone'] = strip_tags($new_instance['telephone']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['skype'] = strip_tags($new_instance['skype']);
		return $instance;
    }
	
	function form($instance) {
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		} else {
			$title = '';
		}
		if (isset($instance['text'])) {
			$text = esc_attr($instance['text']);
		} else {
			$text = '';
		}
		if (isset($instance['telephone'])) {
			$telephone = esc_attr($instance['telephone']);
		} else {
			$telephone = '';
		}
		if (isset($instance['email'])) {
			$email = esc_attr($instance['email']);
		} else {
			$email = '';
		}
		if (isset($instance['skype'])) {
			$skype = esc_attr($instance['skype']);
		} else {
			$skype ='';
		}
		
    ?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php echo 'Text:'; ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('telephone'); ?>"><?php echo 'Telephone:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('telephone'); ?>" name="<?php echo $this->get_field_name('telephone'); ?>" type="text" value="<?php echo $telephone; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('email'); ?>"><?php echo 'Email:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('skype'); ?>"><?php echo 'Skype:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo $skype; ?>" />
    </p>
    <?php
	}

}

// Create Last Posts Widget
class last_posts_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'last_posts',
			'Last posts',
			array( 'description' => 'Display latest post from blog' )
		);
	}
	
	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$post_count = $instance['post_count'];
		if ($post_count == '') $post_count = 5;
		
		echo $before_widget;
		
		if ($title) {
			echo $before_title . $title . $after_title;
		}
		
		echo "<ul id=\"blog-post-sidebar\">";
		
		query_posts( array( 'post_type' => 'post', 'posts_per_page' => $post_count ) );
		if ( have_posts() ): while ( have_posts() ) : the_post(); 
		?>
		
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br /><span>by <?php the_author() ?></span></li>
		
		<?php
		endwhile;endif;
		echo "</ul>";
		
		echo $after_widget;
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		return $instance;
    }
	
	function form($instance) { 
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		} else {
			$title = '';
		}
		if (isset($instance['post_count'])) {
			$post_count = esc_attr($instance['post_count']);
		} else {
			$post_count = '';
		}
    ?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('post_count'); ?>"><?php echo 'Number of post to display:'; ?></label>
        <input style="width:70px" id="<?php echo $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>" type="text" value="<?php echo $post_count; ?>" />
    </p>
    <?php
	}

}

// Create Footer Contact Widget
class footer_contact_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'footer_contact_widget',
			'Footer Contact Widget',
			array( 'description' => 'Display contact information in footer section' )
		);
	}
	
	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$footerFormUrl = $instance['footer_form_url'];
		$footerEmail = $instance['footer_email'];
		$footerTelephone = $instance['footer_telephone'];
		$footerSkype = $instance['footer_skype'];
		$footerAddress = $instance['footer_address'];
		$showFooterLogo = $instance['show_footer_logo'];
		
		echo "<div class='six columns' id='mail-subscribe-wrap'>";
		
		if ($title) {
			echo "<div id='twitter-feed-header'>" . $title . "</div>";
		}
		
		if ($footerFormUrl) {
			echo "<div id='mail-subscribe-text'>Subscribe to our email newsletter for interesting information and news, sent out every month.</div>";
			echo "<div id='mc_embed_signup'>";
			echo "<form action=" . $footerFormUrl . " method='post' id='mc-embedded-subscribe-form' name='mc-embedded-subscribe-form' class='validate' target='_blank' novalidate>";
			echo "<div class='mc-field-group'><input type='email' value='' name='EMAIL' class='email' id='mce-EMAIL' placeholder='email address' required></div>";
			echo "<input type='submit' value='Subscribe' name='subscribe' id='mc-embedded-subscribe'></form></div>";
		}
		
		if ($footerEmail || $footerTelephone || $footerSkype || $footerAddress) {
			echo "<div id='footer-contact'>";
			
			if ($footerEmail) { 
				echo "<div id='footer-mail'>Email: <b>" . $footerEmail . "</b></div>";
			}
		
			if ($footerTelephone != '') { 
				echo "<div id='footer-telephone'>Telephone: <b>" . $footerTelephone . "</b></div>";
			} 
		
			if ($footerSkype != '') { 
				echo "<div id='footer-skype'>Skype: <b>" . $footerSkype . "</b></div>";
			} 
		
			if ($footerAddress != '') { 
				echo "<div id='footer-address'>Address: <b>".$footerAddress."</b><div style='clear:both'></div></div>";
			}
					
			echo "</div>";
		}
			
		if ($showFooterLogo == "on") {
			$footerLogo = ot_get_option('footer_logo');
			echo "<div id='footer-logo-wrap'><img src='". get_template_directory_uri() . "/" . $footerLogo . "' alt='Footer Logo' /></div>";
		}
			
		echo "</div>";
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['footer_form_url'] = strip_tags($new_instance['footer_form_url']);
		$instance['footer_email'] = strip_tags($new_instance['footer_email']);
		$instance['footer_telephone'] = strip_tags($new_instance['footer_telephone']);
		$instance['footer_skype'] = strip_tags($new_instance['footer_skype']);
		$instance['footer_address'] = strip_tags($new_instance['footer_address']);
		$instance['show_footer_logo'] = $new_instance['show_footer_logo'];
		return $instance;
    }
	
	function form($instance) { 
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		} else {
			$title = '';
		}
		if (isset($instance['footer_form_url'])) {
			$footerFormUrl = esc_attr($instance['footer_form_url']);
		} else {
			$footerFormUrl = '';
		}
		if (isset($instance['footer_email'])) {
			$footerEmail = esc_attr($instance['footer_email']);
		} else {
			$footerEmail = '';
		}
		if (isset($instance['footer_telephone'])) {
			$footerTelephone = esc_attr($instance['footer_telephone']);
		} else {
			$footerTelephone = '';
		}
		if (isset($instance['footer_skype'])) {
			$footerSkype = esc_attr($instance['footer_skype']);
		} else {
			$footerSkype = '';
		}
		if (isset($instance['footer_address'])) {
			$footerAddress = esc_attr($instance['footer_address']);
		} else {
			$footerAddress = '';
		}
		if (isset($instance['show_footer_logo'])) {
			$showFooterLogo = esc_attr($instance['show_footer_logo']);
		} else {
			$showFooterLogo = '';
		}
    ?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('footer_form_url'); ?>"><?php echo 'Form url (Enter here URL on mailchimp subscribe form.):'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('footer_form_url'); ?>" name="<?php echo $this->get_field_name('footer_form_url'); ?>" type="text" value="<?php echo $footerFormUrl; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('footer_email'); ?>"><?php echo 'Enter email:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('footer_email'); ?>" name="<?php echo $this->get_field_name('footer_email'); ?>" type="text" value="<?php echo $footerEmail; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('footer_telephone'); ?>"><?php echo 'Enter telephone:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('footer_telephone'); ?>" name="<?php echo $this->get_field_name('footer_telephone'); ?>" type="text" value="<?php echo $footerTelephone; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('footer_skype'); ?>"><?php echo 'Enter skype:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('footer_skype'); ?>" name="<?php echo $this->get_field_name('footer_skype'); ?>" type="text" value="<?php echo $footerSkype; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('footer_address'); ?>"><?php echo 'Enter address:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('footer_address'); ?>" name="<?php echo $this->get_field_name('footer_address'); ?>" type="text" value="<?php echo $footerAddress; ?>" />
    </p>
	 
	<p>  
		<input class="checkbox" type="checkbox" <?php checked( $showFooterLogo, "on" ); ?> id="<?php echo $this->get_field_id( 'show_footer_logo' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_logo' ); ?>" />   
		<label for="<?php echo $this->get_field_id( 'show_footer_logo' ); ?>"><?php echo 'Display footer logo image?'; ?></label>  
	</p> 
    <?php
	}

}


// Create Twitter Footer Widget
class twitter_footer_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'twitter_footer_widget',
			'Twitter Footer Widget',
			array( 'description' => 'Display twitter feed in footer section' )
		);
	}
	
	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$twitter_footer_username = $instance['twitter_footer_username'];
		$twitter_footer_count = $instance['twitter_footer_count'];
		
		echo $before_widget;
		
		echo "<div class='five columns' id='tweet-feed-wrap'>";
		
		if ($title) {
			echo "<div id='twitter-feed-header'>" . $title . "</div>";
		}
		
	
				
		echo "<div id='twitter-feed'></div>";
		
		?>
		<script type="text/javascript">
		(function($) {
			$(document).ready(function () {
 
				var displaylimit = <?php echo $twitter_footer_count ?>;
				var showdirecttweets = true;
				var showretweets = true;
				var showtweetlinks = true;
				var showprofilepic = true;
 
				$.getJSON('<?php echo get_template_directory_uri() ?>/get-tweets.php',{"twitterusername": "<?php echo $twitter_footer_username; ?>", "displaylimit": <?php echo $twitter_footer_count ?>},
				function(feeds) {
					var feedHTML = '';
					var displayCounter = 1;
					for (var i=0; i<feeds.length; i++) {
						var tweetscreenname = feeds[i].user.name;
						var tweetusername = feeds[i].user.screen_name;
						var profileimage = feeds[i].user.profile_image_url_https;
						var status = feeds[i].text;
						var isaretweet = false;
						var isdirect = false;
						var tweetid = feeds[i].id_str;
 
						//If the tweet has been retweeted, get the profile pic of the tweeter
						if(typeof feeds[i].retweeted_status != 'undefined'){
							profileimage = feeds[i].retweeted_status.user.profile_image_url_https;
							tweetscreenname = feeds[i].retweeted_status.user.name;
							tweetusername = feeds[i].retweeted_status.user.screen_name;
							tweetid = feeds[i].retweeted_status.id_str
							isaretweet = true;
						};
 
						//Check to see if the tweet is a direct message
						if (feeds[i].text.substr(0,1) == "@") {
							isdirect = true;
						}
 
						if (((showretweets == true) || ((isaretweet == false) && (showretweets == false))) && ((showdirecttweets == true) || ((showdirecttweets == false) && (isdirect == false)))) {
							if ((feeds[i].text.length > 1) && (displayCounter <= displaylimit)) {
								if (showtweetlinks == true) {
									status = addlinks(status);
								}
								feedHTML += '<div class="twitterRow">';
								feedHTML += '<div class="twitter-text"><p><span class="tweetprofilelink"><strong><a href="https://twitter.com/'+tweetusername+'" >'+tweetscreenname+'</a></strong> <a href="https://twitter.com/'+tweetusername+'" >@'+tweetusername+'</a></span><br/>'+status+'</p></div>';
								feedHTML += '</div>';
								displayCounter++;
							}
						}
					}
 
					$('#twitter-feed').html(feedHTML);
				});
 
				//Function modified from Stack Overflow
				function addlinks(data) {
					//Add link to all http:// links within tweets
					data = data.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
						return '<a href="'+url+'" >'+url+'</a>';
					});
 
					//Add link to @usernames used within tweets
					data = data.replace(/\B@([_a-z0-9]+)/ig, function(reply) {
						return '<a href="http://twitter.com/'+reply.substring(1)+'" style="font-weight:lighter;" >'+reply.charAt(0)+reply.substring(1)+'</a>';
					});
					return data;
				}
 
				function relative_time(time_value) {
					var values = time_value.split(" ");
					time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
					var parsed_date = Date.parse(time_value);
					var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
					var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
					var shortdate = time_value.substr(4,2) + " " + time_value.substr(0,3);
					delta = delta + (relative_to.getTimezoneOffset() * 60);
 
					if (delta < 60) {
						return '1m';
					} else if(delta < 120) {
						return '1m';
					} else if(delta < (60*60)) {
						return (parseInt(delta / 60)).toString() + 'm';
					} else if(delta < (120*60)) {
						return '1h';
					} else if(delta < (24*60*60)) {
						return (parseInt(delta / 3600)).toString() + 'h';
					} else if(delta < (48*60*60)) {
						//return '1 day';
						return shortdate;
					} else {
						return shortdate;
					}
				}
 
			});
		})( jQuery );
		</script>
		
		<?php
		
		echo $after_widget;
		
		echo "</div>";
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_footer_username'] = strip_tags($new_instance['twitter_footer_username']);
		$instance['twitter_footer_count'] = strip_tags($new_instance['twitter_footer_count']);
		return $instance;
    }
	
	function form($instance) { 
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		}
		else {
			$title = '';
		}
		if (isset($instance['twitter_footer_username'])) {
			$twitter_footer_username = esc_attr($instance['twitter_footer_username']);
		}	
		else {
			$twitter_footer_username = '';
		}
		if (isset($instance['twitter_footer_count'])) {
			$twitter_footer_count = esc_attr($instance['twitter_footer_count']);
		}
		else {
			$twitter_footer_count = '';
		}
	?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('twitter_footer_username'); ?>"><?php echo 'Twitter username :'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('twitter_footer_username'); ?>" name="<?php echo $this->get_field_name('twitter_footer_username'); ?>" type="text" value="<?php echo $twitter_footer_username; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('twitter_footer_count'); ?>"><?php echo 'Number of tweet to display:'; ?></label>
        <input style="width:70px" id="<?php echo $this->get_field_id('twitter_footer_count'); ?>" name="<?php echo $this->get_field_name('twitter_footer_count'); ?>" type="text" value="<?php echo $twitter_footer_count; ?>" />
    </p>
    <?php
	}

}

// Create Footer Testimonials Widget
class footer_testimonials_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'footer_testimonials_widget',
			'Footer Testimonials Widget',
			array( 'description' => 'Display custumer testimonials in footer section' )
		);
	}
	
	function widget($args, $instance) {
		extract( $args );
		
		$title = $instance['title'];
		$testimonials_text1 = $instance['testimonials_text1'];
		$testimonials_author1 = $instance['testimonials_author1'];
		$testimonials_text2 = $instance['testimonials_text2'];
		$testimonials_author2 = $instance['testimonials_author2'];
		$testimonials_text3 = $instance['testimonials_text3'];
		$testimonials_author3 = $instance['testimonials_author3'];
		$testimonials_text4 = $instance['testimonials_text4'];
		$testimonials_author4 = $instance['testimonials_author4'];
		
		echo $before_widget;
		
		echo "<div class='five columns' id='testimonials'>";
		
		if ($title) {
			echo "<div id='twitter-feed-header'>" . $title . "</div>";
		}
		
		if ($testimonials_text1) { 
			echo "<div class='testimonials-wrap'>" . $testimonials_text1 . "<div class='testimonials-author'>" . $testimonials_author1 . "</div></div>" ;
		} 
		
		if ($testimonials_text2) { 
			echo "<div class='testimonials-wrap'>" . $testimonials_text2 . "<div class='testimonials-author'>" . $testimonials_author2 . "</div></div>" ;
		} 
		
		if ($testimonials_text3) { 
			echo "<div class='testimonials-wrap'>". $testimonials_text3. "<div class='testimonials-author'>" . $testimonials_author3 . "</div></div>" ;
		} 
		
		if ($testimonials_text4) { 
			echo "<div class='testimonials-wrap'>". $testimonials_text4. "<div class='testimonials-author'>" . $testimonials_author4 . "</div></div>" ;
		} 
				
		echo "<div id='twitter-feed'></div>" . $after_widget. "</div>";
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['testimonials_text1'] = strip_tags($new_instance['testimonials_text1']);
		$instance['testimonials_author1'] = strip_tags($new_instance['testimonials_author1']);
		$instance['testimonials_text2'] = strip_tags($new_instance['testimonials_text2']);
		$instance['testimonials_author2'] = strip_tags($new_instance['testimonials_author2']);
		$instance['testimonials_text3'] = strip_tags($new_instance['testimonials_text3']);
		$instance['testimonials_author3'] = strip_tags($new_instance['testimonials_author3']);
		$instance['testimonials_text4'] = strip_tags($new_instance['testimonials_text4']);
		$instance['testimonials_author4'] = strip_tags($new_instance['testimonials_author4']);
		return $instance;
    }
	
	function form($instance) { 
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		} else {
			$title = '';
		}
		if (isset($instance['testimonials_text1'])) {
			$testimonials_text1 = esc_attr($instance['testimonials_text1']);
		} else {
			$testimonials_text1 = '';
		}
		if (isset($instance['testimonials_author1'])) {
			$testimonials_author1 = esc_attr($instance['testimonials_author1']);
		} else {
			$testimonials_author1 = '';
		}
		if (isset($instance['testimonials_text2'])) {
			$testimonials_text2 = esc_attr($instance['testimonials_text2']);
		} else {
			$testimonials_text2 = '';
		}
		if (isset($instance['testimonials_author2'])) {
			$testimonials_author2 = esc_attr($instance['testimonials_author2']);
		} else {
			$testimonials_author2 = '';
		}
		if (isset($instance['testimonials_text3'])) {
			$testimonials_text3 = esc_attr($instance['testimonials_text3']);
		} else {
			$testimonials_text3 = '';
		}
		if (isset($instance['testimonials_author3'])) {
			$testimonials_author3 = esc_attr($instance['testimonials_author3']);
		} else {
			$testimonials_author3 = '';
		}
		if (isset($instance['testimonials_text4'])) {
			$testimonials_text4 = esc_attr($instance['testimonials_text4']);
		} else {
			$testimonials_text4 = '';
		}
		if (isset($instance['testimonials_author4'])) {
			$testimonials_author4 = esc_attr($instance['testimonials_author4']);
		} else {
			$testimonials_author4 = '';
		}
	?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('testimonials_text1'); ?>"><?php echo 'User testimonials 1 :'; ?></label>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('testimonials_text1'); ?>" name="<?php echo $this->get_field_name('testimonials_text1'); ?>"><?php echo $testimonials_text1; ?></textarea>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('testimonials_author1'); ?>"><?php echo 'Testimonials author 1:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('testimonials_author1'); ?>" name="<?php echo $this->get_field_name('testimonials_author1'); ?>" type="text" value="<?php echo $testimonials_author1; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('testimonials_text2'); ?>"><?php echo 'User testimonials 2 :'; ?></label>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('testimonials_text2'); ?>" name="<?php echo $this->get_field_name('testimonials_text2'); ?>"><?php echo $testimonials_text2; ?></textarea>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('testimonials_author2'); ?>"><?php echo 'Testimonials author 2:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('testimonials_author2'); ?>" name="<?php echo $this->get_field_name('testimonials_author2'); ?>" type="text" value="<?php echo $testimonials_author2; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('testimonials_text3'); ?>"><?php echo 'User testimonials 3 :'; ?></label>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('testimonials_text3'); ?>" name="<?php echo $this->get_field_name('testimonials_text3'); ?>"><?php echo $testimonials_text3; ?></textarea>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('testimonials_author3'); ?>"><?php echo 'Testimonials author 3:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('testimonials_author3'); ?>" name="<?php echo $this->get_field_name('testimonials_author3'); ?>" type="text" value="<?php echo $testimonials_author3; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('testimonials_text4'); ?>"><?php echo 'User testimonials 4 :'; ?></label>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('testimonials_text4'); ?>" name="<?php echo $this->get_field_name('testimonials_text4'); ?>"><?php echo $testimonials_text4; ?></textarea>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('testimonials_author4'); ?>"><?php echo 'Testimonials author 4:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('testimonials_author4'); ?>" name="<?php echo $this->get_field_name('testimonials_author4'); ?>" type="text" value="<?php echo $testimonials_author4; ?>" />
    </p>
    <?php
	}

}

/// Create Footer Testimonials Widget
class footer_text_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
	 		'footer_text_widget',
			'Footer Text Widget',
			array( 'description' => 'Display text in footer section' )
		);
	}
	
	function widget($args, $instance) {
		extract( $args );
		
		$title = $instance['title'];
		$footer_text_block = $instance['footer_text_block'];
		
		echo $before_widget;
		
		echo "<div class='five columns' id='testimonials'>";
		
		if ($title) {
			echo "<div id='twitter-feed-header'>" . $title . "</div>";
		}
		
		if ($footer_text_block) { 
			echo "<div style='font-size:1.1em;'>" . $footer_text_block . "</div>";
		} 
		
		echo $after_widget;
		
		echo "</div>";
		
    }

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['footer_text_block'] = strip_tags($new_instance['footer_text_block'],"<b><div><br>");
		return $instance;
    }
	
	function form($instance) { 
		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		} else {
			$title = '';
		}
		if (isset($instance['footer_text_block'])) {
			$footer_text_block = esc_attr($instance['footer_text_block']);
		} else {
			$footer_text_block = '';
		}
	?>
	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Title:'; ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('footer_text_block'); ?>"><?php echo 'Footer text :'; ?></label>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('footer_text_block'); ?>" name="<?php echo $this->get_field_name('footer_text_block'); ?>"><?php echo $footer_text_block; ?></textarea>
    </p>
   
    <?php
	}

}

// Register Heal Widgets
add_action('widgets_init', create_function('', 'return register_widget("blog_navigation_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("about_us_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("archives_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("flickr_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("contact_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("last_posts_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("footer_contact_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("twitter_footer_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("footer_testimonials_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("footer_text_widget");'));


// Unregister default WP Widgets
function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('WP_Widget_Text');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);
	
// Add sidebar 
if ( function_exists ('register_sidebar')) { 
	
	register_sidebar( array(
		'id'          => 'blog_sidebar',
		'name'        => 'Blog Sidebar',
		'description' => 'This sidebar displayed at blog page.',
		'before_title' => "<div class='sidebar-header'>",
		'after_title' => "</div>",
		'before_widget' => "",
		'after_widget' => ""
	) ); 
	
	register_sidebar( array(
		'id'          => 'gallery_sidebar',
		'name'        => 'Gallery Sidebar',
		'description' => 'This sidebar displayed at the gallery.',
		'before_title' => "<div class='sidebar-header'>",
		'after_title' => "</div>",
		'before_widget' => "",
		'after_widget' => ""
	) );
	
	register_sidebar( array(
		'id'          => 'contact_sidebar',
		'name'        => 'Contact Sidebar',
		'description' => 'This sidebar displayed at contact page.',
		'before_title' => "<div class='sidebar-header'>",
		'after_title' => "</div>",
		'before_widget' => "",
		'after_widget' => ""
	) );

	register_sidebar( array(
		'id'          => 'page_sidebar',
		'name'        => 'Page Sidebar',
		'description' => 'This sidebar displayed at all page except contact, blog and gallery.',
		'before_title' => "<div class='sidebar-header'>",
		'after_title' => "</div>",
		'before_widget' => "",
		'after_widget' => ""
	) );
	
	register_sidebar( array(
		'id'          => 'footer_section',
		'name'        => 'Footer Section',
		'description' => 'This section displayed at footer.',
		'before_widget' => "",
		'after_widget' => ""
	) );
} 

// Add post thumbnails support and automatic feed links
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' ); 
	add_theme_support('automatic-feed-links');

}

// Add image size
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'blog-fullwidth', 910, 300, true);
	add_image_size( 'blog-normal', 650, 230, true);
	add_image_size( 'gallery', 250, 167, true);
	add_image_size( 'main-from-blog', 250, 130, true);
	add_image_size( 'gallery-full', 1024, 683, true);
}

// Function for displaying comments
if ( ! function_exists( 'display_comment' ) ) {
	function display_comment( $comment, $args, $depth ) {
		$referer_page = wp_get_referer();
		$referer_page = explode("?",$referer_page);
		$referer_page = explode("=",$referer_page[1]);				
		$template = get_post_meta( $referer_page[1], '_wp_page_template', true );
		
		$GLOBALS['comment'] = $comment;
		global $postNumber;
		?>
		<div class="comment-wrap <?php if ( $template == 'blog-fullwidth.php' ) echo 'comment-fullwidth' ?>">			
			<div class="avatar-wrap">
				<?php echo get_avatar($comment, 80); ?>
			</div>			
			<div class="comment-text-wrap">
				<div class="comments-author">
					<?php 
						comment_author_link(); 
						echo "&nbsp;&nbsp;"; 
					?> 
				</div>
				<div class="comments-date">
							<?php comment_date(); echo " at "; comment_time() ?> 
				</div>
				<div class="comments-texts">
					<?php comment_text(); ?> 
				</div>
			</div>
		<div style="clear:both"></div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
					<br />
				<?php endif;
	}
}

// For fixing bug with pagination at archive and category page
add_action( 'pre_get_posts',  'set_posts_per_page'  );
function set_posts_per_page( $query ) {
  global $wp_the_query;
  if ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_archive() ) ) {
    $query->set( 'posts_per_page', 1 );
  }
  return $query;
}

// For add home page link to Navigation Menu
function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );

// Disable auto inserting p in editor
remove_filter ('the_content', 'wpautop'); 

// Remove "Links" from admin
add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
	remove_menu_page('link-manager.php');
}
// Shortcodes 

//[code]
function code_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => ' ',
	), $atts ) );
	if ($align == "left") $align = "float-left";
	if ($align == "right") $align = "float-right";
	if ($align == "none") $align = "without-align";
	
	return "<div class='code-wrap ".$align."'>".esc_attr($content)."</div>";
}
add_shortcode( 'code', 'code_func' );

//[image]
function image_func( $atts, $content=null ){
	extract( shortcode_atts( array(
		'align' => ' ',
		'alt' => ' ',
		'src' => ''
	), $atts ) );
	if ($align=='left') $align='left-align-image'; if ($align=='right') $align='right-align-image';
	
	return "<img src='".$src."' alt='".$alt."' class='".$align."' />";
}
add_shortcode( 'image', 'image_func' );

//[clear]
function clear_func( $atts ){
	return "<div class='clear'></div>";
}
add_shortcode( 'clear', 'clear_func' );

//[quote]
function quote_func( $atts, $content=null ){
	extract( shortcode_atts( array(
		'align' => ' ',
	), $atts ) );
	if ($align == ' ') {
		return "<div class='quote'>".$content."</div>";
	}
	if ($align == 'left') {
		return "<div class='quote-align-left'>".$content."</div>";
	}
	if ($align == 'right') {
		return "<div class='quote-align-right'>".$content."</div>";
	}
}
add_shortcode( 'quote', 'quote_func' );
add_filter( 'the_content', 'wpautop' , 12);

//[dropcap]
function dropcap_func( $atts, $content=null ){
	return "<div class='dropcap'>".$content."</div>";
}
add_shortcode( 'dropcap', 'dropcap_func' );

//[divider]
function divider_func( $atts ){
	return "<div class='divider'></div>";
}
add_shortcode( 'divider', 'divider_func' );

//[footer_divider]
function footer_divider_func( $atts ){
	return "<div class='footer-divider2'></div>";
}
add_shortcode( 'footer_divider', 'footer_divider_func' );

//[two_columns]
function two_columns_func( $atts, $content = null ){
	return "<div class='two-columns'>".$content."</div>";
}
add_shortcode( 'two_columns', 'two_columns_func' );

//[two_columns_last]
function two_columns_last_func( $atts, $content = null ){
	return "<div class='two-columns last'>".$content."</div>";
}
add_shortcode( 'two_columns_last', 'two_columns_last_func' );

//[three_columns]
function three_columns_func( $atts, $content = null ){
	return "<div class='three-columns'>".$content."</div>";
}
add_shortcode( 'three_columns', 'three_columns_func' );

//[three_columns_last]
function three_columns_last_func( $atts, $content = null ){
	return "<div class='three-columns last'>".$content."</div>";
}
add_shortcode( 'three_columns_last', 'three_columns_last_func' );

//[four_columns]
function four_columns_func( $atts, $content = null ){
	return "<div class='four-columns'>".$content."</div>";
}
add_shortcode( 'four_columns', 'four_columns_func' );

//[four_columns_last]
function four_columns_last_func( $atts, $content = null ){
	return "<div class='four-columns last'>".$content."</div>";
}
add_shortcode( 'four_columns_last', 'four_columns_last_func' );

//[button]
function button_func( $atts, $content = null ){
	extract( shortcode_atts( array(
		'color' => 'orange',
		'href' => '#'
	), $atts ) );
	return "<a href='".$href."' class='button ".$color."'>".$content."</a>";
}
add_shortcode( 'button', 'button_func' );

//[accordion]
function accordion_func( $atts, $content = null ){
	return "<div class='accordion'>".do_shortcode($content)."</div>";
}
add_shortcode( 'accordion', 'accordion_func' );

//[accordion_section]
function accordion_section_func( $atts, $content = null ){
	extract( shortcode_atts( array(
		'title' => 'Section Title',
	), $atts ) );
	return "<h3><a href='#'>".$title."</a></h3><div>".$content."</div>";
}
add_shortcode( 'accordion_section', 'accordion_section_func' );

//[tabs]
function tabs_func( $atts, $content = null ){
	$GLOBALS['tab_count'] = 0;
	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ){
		$z=1;
		foreach( $GLOBALS['tabs'] as $tab ){
			$tabs[] = '<li><a href="#tabs-'.$z.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div id="tabs-'.$z.'">'.$tab['content'].'</div>';
			$z++;
		}
		$return = "<div class='tabs'>\n".'<ul>'.implode( "\n", $tabs ).'</ul>'."\n".implode( "\n", $panes )."\n</div>";
	}
	return $return;
}
add_shortcode( 'tabs', 'tabs_func' );

//[tab]
function tab_func( $atts, $content = null ){
	extract(shortcode_atts(array(
	'title' => 'Tab Title'
	), $atts));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => $title, 'content' =>  $content );
	$GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'tab_func' );

//[info]
function info_func( $atts, $content = null ){
	return "<div class='info'>".$content."</div>";
}
add_shortcode( 'info', 'info_func' );

//[success]
function success_func( $atts, $content = null ){
	return "<div class='success'>".$content."</div>";
}
add_shortcode( 'success', 'success_func' );

//[error]
function error_func( $atts, $content = null ){
	return "<div class='alert'>".$content."</div>";
}
add_shortcode( 'error', 'error_func' );

//[warning]
function warning_func( $atts, $content = null ){
	return "<div class='warning'>".$content."</div>";
}
add_shortcode( 'warning', 'warning_func' );

add_filter( 'the_content', 'wpautop' , 12);

?>