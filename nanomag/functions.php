<?php
if (!function_exists('optionsframework_init')) {
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/option/');
    require_once get_template_directory() . '/inc/option/options-framework.php';
}

if ( function_exists( 'aq_page_builder_config' ) ){
if(!defined('HOME_PATH_BUILDER')) define( 'HOME_PATH_BUILDER', get_template_directory() . '/inc/new_builder/');
//some default blocks
require_once(HOME_PATH_BUILDER . 'home_three_columns_post.php');
require_once(HOME_PATH_BUILDER . 'home_slider.php');
require_once(HOME_PATH_BUILDER . 'home_carousel.php');
require_once(HOME_PATH_BUILDER . 'home_carousel_2col.php');
require_once(HOME_PATH_BUILDER . 'home_main_post_below_grid_small.php');
require_once(HOME_PATH_BUILDER . 'home_main_post_below_grid_medium.php');
require_once(HOME_PATH_BUILDER . 'home_large_main_post_below_list.php');
require_once(HOME_PATH_BUILDER . 'home_large_3main_post_below_list.php');
require_once(HOME_PATH_BUILDER . 'home_post_list_1columns.php');
require_once(HOME_PATH_BUILDER . 'home_list_medium.php');
require_once(HOME_PATH_BUILDER . 'home_list_medium_load_more.php');
require_once(HOME_PATH_BUILDER . 'home_grid_medium_load_more.php');
require_once(HOME_PATH_BUILDER . 'home_grid_medium.php');
require_once(HOME_PATH_BUILDER . 'home_grid_small.php');
require_once(HOME_PATH_BUILDER . 'home_two_columns_post.php');
require_once(HOME_PATH_BUILDER . 'home_two_columns_post_list.php');
require_once(HOME_PATH_BUILDER . 'home_main_post_right_list.php');
require_once(HOME_PATH_BUILDER . 'home_main_post_right_list_scroll.php');
require_once(HOME_PATH_BUILDER . 'home_main_post_right_list_text.php');



//register default blocks
aq_register_block('home_post_grid_small');
aq_register_block('home_post_slider');
aq_register_block('home_carousel_post');
aq_register_block('home_carousel_post_2col');
aq_register_block('home_post_three_columns');
aq_register_block('home_post_right_list');
aq_register_block('home_main_post_right_list_scroll');
aq_register_block('home_post_right_list_text');
aq_register_block('home_post_below_list');
aq_register_block('home_post_below_grid_medium');
aq_register_block('home_large_post_below_list');
aq_register_block('home_large_3main_post_below_list');
aq_register_block('home_post_list_1columns');
aq_register_block('home_post_list_medium');
aq_register_block('home_post_list_medium_load_more');
aq_register_block('home_post_grid_medium_load_more');
aq_register_block('home_post_grid_medium');
aq_register_block('home_post_two_columns');
aq_register_block('home_post_two_columns_list');
}




//Category metadata
require_once("inc/addon/Tax-meta-class/Tax-meta-class.php");
if (is_admin()){
  //configure your meta box
  $config = array(
    'id' => 'demo_meta_box',          // meta box id, unique per meta box
    'title' => 'Demo Meta Box',          // meta box title
    'pages' => array('category'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),            // list of meta fields (can be added by field arrays)
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
//Initiate your meta box
  $my_meta =  new Tax_Meta_Class($config);
    //Category color
    $my_meta->addColor('jellywp_color', array('name'=> esc_attr__('Category color ','nanomag')));
    $my_meta->Finish();
}

//Category span
add_filter('wp_list_categories', 'jelly_cat_count_span');
function jelly_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>', $links);
  $links = str_replace(')', '</span>', $links);
  return $links;
}

//Mobile Menu id
add_filter('nav_menu_item_id', 'jelly_my_css_attributes_filter', 100, 1);
function jelly_my_css_attributes_filter($var) {
  return is_array($var) ? array() : '';
}

//GET TITLE COLOR
function jelly_categorys_title_color($id, $type="category", $echo=true) {
 	if($type == "category" && $id!="popular" && $id!="latest") {
		$my_meta = new Tax_Meta_Class('');
		$titleColor = $my_meta->get_tax_meta($id, 'jellywp_color');
		$my_meta->Finish();
	}else if ($type=="page") {
		$titleColor = "#".get_post_meta($id, "jellywp_color",true); 
	}

	
	if($echo!=false) {
		echo $titleColor;
	}else{
		return $titleColor;
	}
}

// Filter wp_title
function jelly_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    $title .= get_bloginfo( 'name' );

    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( esc_attr__( 'Page %s', 'nanomag' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'jelly_wp_title', 10, 2 );

// max content width
if ( ! isset( $content_width ) ){ $content_width = 960; }

//register menu
function jellywp_register_menu() {
    register_nav_menus(
            array(
                'Main_Menu' => 'Main menu',
                'Footer_Menu' => 'Footer menu'
            )
    );
}
add_action('init', 'jellywp_register_menu');
add_filter( 'widget_text', 'do_shortcode' );
add_theme_support('post-thumbnails');
add_theme_support( 'automatic-feed-links' );
add_theme_support( "title-tag" );

// Post thumbnail support
if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	add_image_size('slider-large', 1140, 540, true);
	add_image_size('slider-normal', 670, 470, true);
	add_image_size('slider-small', 240, 140, true);
	add_image_size('feature-grid', 250, 242, true);
	add_image_size('small-grid', 171, 108, true);
	add_image_size('medium-feature', 400, 260, true);
	add_image_size('small-feature', 100, 75, true);
	add_image_size('slider-feature', 735, 400, true);
}

// Author contact info
function jelly_extra_contact_info($contactmethods) {
$contactmethods['rss'] = 'Rss feed';
$contactmethods['linkedin'] = 'Linkedin';
$contactmethods['pinterest'] = 'Pinterest';
$contactmethods['devianart'] = 'Devianart';
$contactmethods['dribble'] = 'Dribble';
$contactmethods['behance'] = 'Behance';
$contactmethods['youtube'] = 'Youtube';
$contactmethods['instagram'] = 'Instagram';
$contactmethods['twitter'] = 'Twitter';
$contactmethods['googleplus'] = 'Googleplus';
$contactmethods['facebook'] = 'Facebook';
return $contactmethods;
}
add_filter('user_contactmethods', 'jelly_extra_contact_info');

// Register sidebar 
function jelly_sidebar_register() {
    register_sidebar(array(
        'name' => esc_attr__('General Sidebar', 'nanomag'),
        'id' => 'general-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '<div class="margin-bottom"></div></div>',
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    ));
 
    register_sidebar(array(
        'name' => esc_attr__('Header sidebar', 'nanomag'),
        'id' => 'banner-sidebar',
        'before_widget' => '',
        'after_widget' => "",
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    ));

    register_sidebar(array(
        'name' => esc_attr__('woocommerce sidebar', 'nanomag'),
        'id' => 'woocommerce-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));	

    register_sidebar(array(
        'name' => esc_attr__('bbpress sidebar', 'nanomag'),
        'id' => 'bbpress-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));	

    register_sidebar(array(
        'name' => esc_attr__('Footer1 Sidebar', 'nanomag'),
        'id' => 'footer1-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    ));

    register_sidebar(array(
        'name' => esc_attr__('Footer2 Sidebar', 'nanomag'),
        'id' => 'footer2-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    ));

    register_sidebar(array(
        'name' => esc_attr__('Footer3 Sidebar', 'nanomag'),
        'id' => 'footer3-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2>',
        'after_title' => '</h2></div>',
    )); 
}
add_action('init', 'jelly_sidebar_register');

// Load language
function jelly_setup_language(){
    load_theme_textdomain('nanomag', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'jelly_setup_language');

// Sidebar home
function jelly_sidebar_homepage_show(){
echo '<div class="four columns content_display_col3" id="sidebar">';
if(isset($GLOBALS['sbg_sidebar'][0])){
$custom_sidebar = $GLOBALS['sbg_sidebar'][0];
				foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				}
				if($custom_sidebar) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}
}								
echo '</div>';
}

// Sidebar page
function jelly_sidebar_page_general_show() {
echo '<div class="four columns content_display_col3" id="sidebar">';
if(isset($GLOBALS['sbg_sidebar'][0])){
					$custom_sidebar = $GLOBALS['sbg_sidebar'][0];
					
					$page_sidebar = of_get_option('page_sidebar','');	
					if(!empty($page_sidebar)) {
						$custom_sidebar = $page_sidebar;
					}
				
					foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $dyn_side = $sidebar['id'];
						}
					} 
				}			

				if(isset($dyn_side)) {
					
					if (is_active_sidebar($dyn_side)) { dynamic_sidebar($dyn_side);}
	
				} else{
					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar'); }
				}
echo '</div>';						
}

// Sidebar general
function jelly_sidebar_post_general_show() {
echo '<div class="four columns content_display_col3" id="sidebar">';
if(isset($GLOBALS['sbg_sidebar'][0])){
					$custom_sidebar = $GLOBALS['sbg_sidebar'][0];
					
					$post_sidebar = of_get_option('post_sidebar','');	
					if(!empty($post_sidebar)) {
						$custom_sidebar = $post_sidebar;
					}
				
					foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $dyn_side = $sidebar['id'];
						}
					} 
				}			

				if(isset($dyn_side)) {
					
					if (is_active_sidebar($dyn_side)) { dynamic_sidebar($dyn_side);}
	
				} else{
					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar'); }
				}
echo '</div>';						
}

// Sidebar archive
function jelly_sidebar_archive_general_show() {
echo '<div class="four columns content_display_col3" id="sidebar">';
$archive_sidebar = of_get_option('archive_sidebar','');	
				$custom_sidebar ='';
				if(!empty($archive_sidebar)) {	$custom_sidebar = $archive_sidebar;	};				
				
				foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				} 
				
				if(!empty($custom_sidebar)) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}
echo '</div>';						
}

// Other Sidebar
function jelly_other_sidebar_general_show() {
echo '<div class="four columns content_display_col3" id="sidebar">';
 $ge_sidebar = '';
				if(is_category() ) {
						
						$category = get_the_category();						
						
						$cn_sidebar ='';
						foreach($category as $ca_id) {
							if(empty($cn_sidebar)) { $cn_sidebar = of_get_option('cat_'.$ca_id->term_id);}															
						}
						
						if(empty($cn_sidebar)) {
							$ge_sidebar = of_get_option('category_sidebar','');
						} else { $ge_sidebar = $cn_sidebar; }
						
						
					}else if(is_tag() ) {
						
						$tags = get_the_tags();						
						
						$cn_sidebar ='';
						foreach($tags as $tg_id) {
							if(empty($cn_sidebar)) { $cn_sidebar = of_get_option('tag_'.$tg_id->term_id);}								
						}
						 
						if(empty($cn_sidebar)) {
							$ge_sidebar = of_get_option('tag_sidebar','');
						} else { $ge_sidebar = $cn_sidebar; }
					}

					
					
					
				$custom_sidebar ='';
				if(!empty($ge_sidebar)) {	$custom_sidebar = $ge_sidebar;	};				
				
				foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				} 
				
				if(!empty($custom_sidebar)) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}
echo '</div>';						
}


// Post meta single
function jelly_single_post_meta($post_id) {                     
                               echo'<p class="post-meta meta-main-img">';
                                 if(of_get_option('disable_post_author') !=1){echo '<span class="vcard post-author single_meta_user meta-user"><span class="fn">'; echo get_avatar(get_the_author_meta('user_email'), 90); echo '<span class="author_link">By '; the_author_posts_link(); echo'</span></span></span>';}
                              if(of_get_option('disable_post_date') !=1){ echo '<span class="post-date updated">'.get_the_date('M d, Y, H:i a').'</span>';}
                             if(of_get_option('disable_post_comment_meta') !=1){ echo '<span class="meta-comment">'; echo comments_popup_link(__('<i class="fa fa-comment-o"></i>0', 'nanomag'), __('<i class="fa fa-comment-o"></i> 1', 'nanomag'), __('<i class="fa fa-comment-o"></i>%', 'nanomag')).'</span>'; }
                                     echo'</p>';	
}

function jelly_slider_post_meta($post_id) {                     
                               echo'<p class="post-meta meta-main-img">';
                                 if(of_get_option('disable_post_author') !=1){echo '<span class="vcard post-author single_meta meta-user"><span class="fn">'; echo get_avatar(get_the_author_meta('user_email'), 90); echo the_author_posts_link().'</span></span>';}
                              if(of_get_option('disable_post_date') !=1){ echo '<span class="post-date updated"><i class="fa fa-clock-o"></i>'.get_the_date('M d, Y').'</span>';}
                              if(of_get_option('disable_post_category') !=1){ echo '<span class="meta-cat"><i class="fa fa-folder-o"></i>'; echo the_category(', ').'</span>';}
                             if(of_get_option('disable_post_comment_meta') !=1){ echo '<span class="meta-comment">'; echo comments_popup_link(__('<i class="fa fa-comment-o"></i>0', 'nanomag'), __('<i class="fa fa-comment-o"></i> 1', 'nanomag'), __('<i class="fa fa-comment-o"></i>%', 'nanomag')).'</span>'; }
                                     echo'</p>';	
}

// Post meta main post
function jelly_post_meta_main($post_id) {
							
                               echo'<p class="post-meta meta-main-img">';
                               if(of_get_option('disable_post_author') !=1){ echo '<span class="post-author">'; echo get_avatar(get_the_author_meta('user_email'), 16); echo the_author_posts_link().'</span>';}
								if(of_get_option('disable_post_date') !=1){echo '<span class="post-date"><i class="fa fa-clock-o"></i>'.get_the_date('M d, Y').'</span>';}
								  if(of_get_option('disable_post_comment_meta') !=1){ echo '<span class="meta-comment">'; echo comments_popup_link(__('<i class="fa fa-comment-o"></i>0', 'nanomag'), __('<i class="fa fa-comment-o"></i> 1', 'nanomag'), __('<i class="fa fa-comment-o"></i>%', 'nanomag')).'</span>';}
                                     echo'</p>';	
}

// Post meta list post
function jelly_post_meta($post_id) {
							
                               echo'<p class="post-meta meta-main-img">';
                               if(of_get_option('disable_post_author') !=1){ echo '<span class="post-author">'; echo get_avatar(get_the_author_meta('user_email'), 16); echo the_author_posts_link().'</span>';}
								if(of_get_option('disable_post_date') !=1){echo '<span class="post-date"><i class="fa fa-clock-o"></i>'.get_the_date('M d, Y').'</span>';}
								     echo'</p>';	
}

// Post meta footer
function jelly_post_meta_footer($post_id) {
						echo '<div class="footer_meta">';	
                         echo '<a href="'; echo the_permalink();echo'" class="footer_meta_readmore">'.__('Read more', 'nanomag').'</a>';     
						 if(of_get_option('disable_post_comment_meta') !=1){ echo '<span class="meta-commentd">'; echo comments_popup_link(__('<i class="fa fa-comment-o"></i>0 Comment', 'nanomag'), __('<i class="fa fa-comment-o"></i>1 Comment', 'nanomag'), __('<i class="fa fa-comment-o"></i>% Comment', 'nanomag')).'</span>';}
                         echo '</div>';           	
}


// Breadcrumbs
function jelly_breadcrumbs_options() {
 
  $delimiter = '<i class="fa fa-angle-right"></i>';
  $home = __( 'Home', 'nanomag');
  $before = '<span class="current">';
  $after = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div class="breadcrumbs_options">';
 
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . esc_attr__( '', 'nanomag' ) . single_cat_title('', false) . '' . $after;
 
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
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search()) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . esc_attr__( 'Search results for ', 'nanomag' ) . get_search_query() . '' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . esc_attr__( 'Posts tagged ', 'nanomag' ) . single_tag_title('', false) . '' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . esc_attr__( 'Articles posted by ', 'nanomag' ) . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . esc_attr__( 'Error 404', 'nanomag' ) . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo esc_attr__('Page', 'nanomag') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}

//count review
function jelly_total_score_post($post_id) {
   $review_value1 = get_post_custom_values('review_option1jellywp_slider', $post_id);
   $review_value2 = get_post_custom_values('review_option2jellywp_slider', $post_id);
   $review_value3 = get_post_custom_values('review_option3jellywp_slider', $post_id);
   $review_value4 = get_post_custom_values('review_option4jellywp_slider', $post_id);
   $review_value5 = get_post_custom_values('review_option5jellywp_slider', $post_id);
   $total_review= $review_value1[0] + $review_value2[0] + $review_value3[0] + $review_value4[0] + $review_value5[0];
  if($total_review != 0){
	 return $total_review;
	}
	else{
	return 0;	
	}
}

function jelly_post_like_meta() {
echo '<div class="love_this_post_meta">'.getPostLikeLink(get_the_ID()).'</div>';
}
//count review large
function jelly_total_score_post_front($post_id) {
   $review_value1 = get_post_custom_values('review_option1jellywp_slider', $post_id);
   $review_value2 = get_post_custom_values('review_option2jellywp_slider', $post_id);
   $review_value3 = get_post_custom_values('review_option3jellywp_slider', $post_id);
   $review_value4 = get_post_custom_values('review_option4jellywp_slider', $post_id);
   $review_value5 = get_post_custom_values('review_option5jellywp_slider', $post_id);
   $total_review = $review_value1[0] + $review_value2[0] + $review_value3[0] + $review_value4[0] + $review_value5[0];
  $sum_review= round($total_review /5 ,1);
  if($sum_review != 0){if(of_get_option('disable_post_review') !=1){
  	$score_large = ($total_review * 10) /5;
  	$score_large = $score_large/ 10;
return '<div class="review_circle_large">
<input disabled class="post_review_bar" data-thickness=".2" data-fgColor="#f4b711" data-width="60" data-max="10" readonly value="'.$score_large.'">
</div>';
	}}
	else{
	}
}

//count review small
function jelly_total_score_post_front_small_circle($post_id) {
   $review_value1 = get_post_custom_values('review_option1jellywp_slider', $post_id);
   $review_value2 = get_post_custom_values('review_option2jellywp_slider', $post_id);
   $review_value3 = get_post_custom_values('review_option3jellywp_slider', $post_id);
   $review_value4 = get_post_custom_values('review_option4jellywp_slider', $post_id);
   $review_value5 = get_post_custom_values('review_option5jellywp_slider', $post_id);
   $total_review = $review_value1[0] + $review_value2[0] + $review_value3[0] + $review_value4[0] + $review_value5[0];
  $sum_review= round($total_review /5 ,1);
  if($sum_review != 0){if(of_get_option('disable_post_review') !=1){
  	$score_large = ($total_review * 10) /5;
  	$score_large = $score_large/ 10;
return '<div class="review_circle_large_small">
<input disabled class="post_review_bar" data-thickness=".2" data-fgColor="#f4b711" data-width="40" data-max="10" readonly value="'.$score_large.'">
</div>';
	}}
	else{
	}
}

//count review small
function jelly_total_score_post_front_small($post_id) {
   $review_value1 = get_post_custom_values('review_option1jellywp_slider', $post_id);
   $review_value2 = get_post_custom_values('review_option2jellywp_slider', $post_id);
   $review_value3 = get_post_custom_values('review_option3jellywp_slider', $post_id);
   $review_value4 = get_post_custom_values('review_option4jellywp_slider', $post_id);
   $review_value5 = get_post_custom_values('review_option5jellywp_slider', $post_id);
   $total_review = $review_value1[0] + $review_value2[0] + $review_value3[0] + $review_value4[0] + $review_value5[0];
  $sum_review= round($total_review /5 ,1);
  if($sum_review != 0){if(of_get_option('disable_post_review') !=1){
  	$score_large = ($total_review * 10) /5;
  	$score_large = $score_large / 10;
return '<div class="review_star_small"><i class="icon-star"></i><span class="number">'.$score_large.'</span></div>';
	}}
	else{
	}
}

//count review small
function jelly_total_score_post_front_small_list($post_id) {
   $review_value1 = get_post_custom_values('review_option1jellywp_slider', $post_id);
   $review_value2 = get_post_custom_values('review_option2jellywp_slider', $post_id);
   $review_value3 = get_post_custom_values('review_option3jellywp_slider', $post_id);
   $review_value4 = get_post_custom_values('review_option4jellywp_slider', $post_id);
   $review_value5 = get_post_custom_values('review_option5jellywp_slider', $post_id);
   $total_review = $review_value1[0] + $review_value2[0] + $review_value3[0] + $review_value4[0] + $review_value5[0];
  $sum_review= round($total_review /5 ,1);
  if($sum_review != 0){if(of_get_option('disable_post_review') !=1){
  	$score_large = ($total_review * 10) /5;
  	$score_large = $score_large / 10;
return '<div class="review_star_small_list"><i class="icon-star"></i><span class="number">'.$score_large.'</span></div>';
	}}
	else{
	}
}

//Embed video url
function jelly_embed_video_url($video_url, $video_width = 500, $video_height = 300){
		if( empty($video_width) && empty($video_height) ){ $video_width = 500; $video_height = 300;}
		if(strpos($video_url,'youtube')){jelly_youtube_url($video_url, $video_width, $video_height);}
		else if(strpos($video_url,'youtu.be')){jelly_youtube_url($video_url, $video_width, $video_height, 'youtu.be');}
		else if(strpos($video_url,'vimeo')){jelly_vimeo_url($video_url, $video_width, $video_height);}
}

//Youtube url
function jelly_youtube_url($video_url, $video_width = 500, $video_height = 300, $video_type = 'youtube', $return = false){
		if( $video_type == 'youtube' ){preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$video_url,$video_id);}
		else{preg_match('/youtu.be\/([^\\?\\&]+)/', $video_url,$video_id);}
		$video_attr = "";
		if( strpos($video_url, 'autoplay=1') > 0 ) $video_attr = "&autoplay=1";
		if( strpos($video_url, 'rel=0') > 0 ) $video_attr = $video_attr . "&rel=0";
		if( !$return ){echo '<iframe src="http://www.youtube.com/embed/' . $video_id[1] . '?wmode=transparent' . $video_attr . '" width="' . $video_width . '" height="' . $video_height . '" ></iframe>';}
		else{return '<iframe src="http://www.youtube.com/embed/' . $video_id[1] . '?wmode=transparent' . $video_attr . '" width="' . $video_width . '" height="' . $video_height . '" ></iframe>';}
	}

//Vimeo url
function jelly_vimeo_url($video_url, $video_width = 500, $video_height = 300, $return = false){
		preg_match('/https?:\/\/vimeo.com\/(\d+)$/', $video_url, $video_id);
		if( !$return ){echo '<iframe src="http://player.vimeo.com/video/' . $video_id[1] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $video_width . '" height="' . $video_height . '"></iframe>';}
		else{return '<iframe src="http://player.vimeo.com/video/' . $video_id[1] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $video_width . '" height="' . $video_height . '"></iframe>';}
}
	

// Comment single post
if ( ! function_exists( 'jelly_comment' ) ) :
function jelly_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'nanomag'); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_attr__( '(Edit)', 'nanomag'), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						
						( $comment->user_id === $post->post_author ) ? '<span> ' . esc_attr__( 'Post author', 'nanomag') . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
					
						sprintf( esc_attr__( '%1$s at %2$s', 'nanomag'), get_comment_date(), get_comment_time() )
					);
				?>
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'nanomag'); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( esc_attr__( 'Edit', 'nanomag'), '<p class="edit-link">', '</p>' ); ?>
			</section>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_attr__( 'Reply', 'nanomag'), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</article>
	<?php
		break;
	endswitch; 
}
endif;
?>
<?php add_filter('next_posts_link_attributes', 'jelly_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'jelly_posts_link_attributes');
function jelly_posts_link_attributes() {
return 'class="page"';
}
if ( ! function_exists( 'jelly_pagination' ) ) {
function jelly_pagination($pages = '', $range = 2){
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
				echo get_previous_posts_link( esc_attr__('Previous Page', 'nanomag') );
		         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link(1)."'>&laquo;</a>";
		         if($paged > 1 && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		         for ($i=1; $i <= $pages; $i++)
		         {
		             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		             {
		                 echo ($paged == $i)? "<span class='current box'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive box' >".$i."</a>";
		             }
		         }

		         if ($paged < $pages && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
		         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='box' href='".get_pagenum_link($pages)."'>&raquo;</a>";
				echo get_next_posts_link( esc_attr__('Next Page', 'nanomag'));
		        echo "</div>\n";
		     }
		}
}

// Post format	 
add_theme_support( 'post-formats', array('gallery', 'quote', 'video', 'audio' ) );
function jelly_post_type()
{
    if(has_post_format('quote')){
        $post_type_icon = '<span class="overlay_icon fa fa-quote-left"></span>';
    }elseif(has_post_format('gallery')){
        $post_type_icon = '<span class="overlay_icon fa fa-camera-retro"></span>';
    }elseif(has_post_format('video')){
         $post_type_icon = '<span class="overlay_icon fa fa-play-circle-o"></span>';
    }elseif(has_post_format('audio')){
         $post_type_icon = '<span class="overlay_icon fa fa-volume-up"></span>';
    }else{
        $post_type_icon ='';
    } 
    return $post_type_icon;    
}

//widget
require_once get_template_directory().'/inc/widget/comments.php';
require_once get_template_directory().'/inc/widget/tab.php';
require_once get_template_directory().'/inc/widget/tab-post.php';
require_once get_template_directory().'/inc/widget/tab-post-large.php';
require_once get_template_directory().'/inc/widget/facebook.php';
require_once get_template_directory().'/inc/widget/flickr.php';
require_once get_template_directory().'/inc/widget/ads300x250.php';
require_once get_template_directory().'/inc/widget/ads728x90.php';
require_once get_template_directory().'/inc/widget/ads160x600.php';
require_once get_template_directory().'/inc/widget/popular.php';  
require_once get_template_directory().'/inc/widget/recent_main_list.php';
require_once get_template_directory().'/inc/widget/recent_list.php';
require_once get_template_directory().'/inc/widget/recent-large.php';
require_once get_template_directory().'/inc/widget/recent-large-overlay.php';
require_once get_template_directory().'/inc/widget/carousel.php';
require_once get_template_directory().'/inc/widget/subscribe_box.php';
require_once get_template_directory().'/inc/widget/social_icons.php';
require_once get_template_directory().'/inc/widget/video-widget.php';
require_once get_template_directory().'/inc/widget/about-us.php';
require_once get_template_directory().'/inc/widget/recent_main_list_white.php';

//Metabox  need active
require_once get_template_directory() . '/inc/addon/meta-box/meta-box.php';
//post like
require_once get_template_directory() . '/inc/addon/post-like.php';
require_once get_template_directory() . '/inc/addon/view-post-counter.php';
//rating
require get_template_directory() . '/inc/addon/user-rating.php';
//sidebar
require_once get_template_directory() . '/inc/addon/sidebar_generator.php';
//mega menu post
require_once get_template_directory() . '/inc/addon/menu_option.php';
// TGM
require_once get_template_directory() . '/inc/addon/tgm-plugin-activation/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/addon/tgm-plugin-activation/required_plugins.php';

// Excerpt carousel post
function jelly_carousel_excerpt($text){
$chars_limit = 100;
$chars_text = strlen($text);
$text = $text." ";
$text = substr($text,0,$chars_limit);
$text = substr($text,0,strrpos($text,' '));
if ($chars_text > $chars_limit){$text = $text."...";}
return $text;
}

// Excerpt main post
function jelly_post_excerpt($text){
$chars_limit = 90;
$chars_text = strlen($text);
$text = $text." ";
$text = substr($text,0,$chars_limit);
$text = substr($text,0,strrpos($text,' '));
if ($chars_text > $chars_limit){$text = $text."...";}
return $text;
}	

// Excerpt list post
function jelly_post_list_excerpt($text){
$chars_limit = 170;
$chars_text = strlen($text);
$text = $text." ";
$text = substr($text,0,$chars_limit);
$text = substr($text,0,strrpos($text,' '));
if ($chars_text > $chars_limit){$text = $text."...";}
return $text;
}

//Woocommerce
if (!function_exists('loop_columns')) {  
    function loop_columns() {  
        return 3;
    }  
}  
add_filter('loop_shop_columns', 'loop_columns'); 
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'jellywp_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'jellywp_theme_wrapper_end', 10);

function jellywp_theme_wrapper_start() {
    echo '<div class="container main-content">';
}

function jellywp_theme_wrapper_end() {
    echo '</div>';
}

add_theme_support( 'woocommerce' );		


// bbpress

function vw_filter_bbp_breadcrumb( $args ) {
	$my_args = array(
		'before'          => '<div class="bbp-breadcrumb header-font"><p>',
		'after'           => '</p></div>',
	);

	$args = wp_parse_args( $my_args, $args );
	return $args;
}

add_filter( 'bbp_before_get_breadcrumb_parse_args', 'vw_filter_bbp_breadcrumb' );

function bm_bbp_no_breadcrumb ($param) {

return true;

}

add_filter ('bbp_no_breadcrumb', 'bm_bbp_no_breadcrumb');



//Google font
function nanomag_fonts() {
 
    $google_font = '';
    $heading_font = of_get_option('heading_title_google_font');
	$body_font = of_get_option('body_font');
    $menu_font = of_get_option('menu_title_google_font');
    $title_google_font = of_get_option('title_google_font');

    
    $subsets  = 'latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese';  
    $google_font = add_query_arg( array(
            'family' => urlencode ( $heading_font['face'] . ':300,400,600,700,800,900,400italic,700italic,900italic|' . $body_font['face'] . ':300,400,600,700,800,900,400italic,700italic,900italic|' . $menu_font['face'] . ':300,400,600,700,800,900,400italic,700italic,900italic|' . $title_google_font['face'] . ':300,400,600,700,800,900,400italic,700italic,900italic|'),
            'subset' => urlencode ( $subsets ),
        ), '//fonts.googleapis.com/css' );
    return $google_font;
}

function nanomag_font_scripts() {
    wp_enqueue_style( 'nanomag_fonts_url', nanomag_fonts(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'nanomag_font_scripts' );


// Add html5
function jelly_add_html5 () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->
    ';
}
add_action('wp_head', 'jelly_add_html5');	  

// Enqueue style
function jelly_enqueue_style() {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', false, '1.6' );
	wp_enqueue_style( 'gumby', get_template_directory_uri().'/css/gumby.css', false, '1.6' ); 
	wp_enqueue_style( 'carousel', get_template_directory_uri().'/css/owl.carousel.css', false, '1.6' ); 
	wp_enqueue_style( 'owl_theme', get_template_directory_uri().'/css/owl.theme.css', false, '1.6' );
	wp_enqueue_style( 'mediaelementplayer', get_template_directory_uri().'/css/mediaelementplayer.css', false, '1.6' ); 
	wp_enqueue_style( 'nanomag_style', get_template_directory_uri().'/style.css', false, '1.6' );
	wp_enqueue_style( 'nanomag_responsive', get_template_directory_uri().'/css/responsive.css', false, '1.6' ); 
	wp_enqueue_style( 'nanomag_custom-style', get_template_directory_uri().'/custom_style.php', false, '1.6' ); 
}

// Enqueue script
function jelly_enqueue_script() {
	wp_enqueue_script( 'marquee', get_template_directory_uri().'/js/marquee.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri().'/js/owl.carousel.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'pageslide', get_template_directory_uri().'/js/jquery.pageslide.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'masonry', get_template_directory_uri().'/js/jquery.masonry.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'mediaelement-and-player', get_template_directory_uri().'/js/mediaelement-and-player.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'fluidvids', get_template_directory_uri().'/js/fluidvids.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'stickit', get_template_directory_uri().'/js/jquery.stickit.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'infinitescroll', get_template_directory_uri().'/js/jquery.infinitescroll.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'slimscroll', get_template_directory_uri().'/js/jquery.slimscroll.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'knob', get_template_directory_uri().'/js/jquery.knob.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'bxslider', get_template_directory_uri().'/js/jquery.bxslider.min.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'user-rating', get_template_directory_uri().'/js/user-rating.js', array('jquery'), '1.6', true );
	wp_enqueue_script( 'nanomag_custom', get_template_directory_uri().'/js/custom.js', array('jquery'), '1.6', true );
	
}
add_action( 'wp_enqueue_scripts', 'jelly_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'jelly_enqueue_script' );
?>