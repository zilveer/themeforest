<?php
//error_reporting(E_ALL & ~E_NOTICE); //don't care about php notices

function it_enqueue_scripts() {
	wp_enqueue_script("jquery");
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-effects-core');
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_scripts' );

global $oswcPostTypes;

//function to get template parts
function oswc_get_template_part($template_part) {
do_action( 'oswc_get_template_part' );
if ( file_exists( TEMPLATEPATH . '/inc/' . $template_part . '.php') )
	load_template( TEMPLATEPATH . '/inc/' . $template_part . '.php');
}

// Add RSS links to <head> section
if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
    //WP Auto Feed Links
}

// This theme allows users to set a custom background
if(function_exists('add_theme_support')) {
    add_theme_support('custom-background');
}

// Returns page ID from page slug
function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}
// Returns permalink for the specified review type
function oswc_review_permalink($reviewtype) {
$reviewargs = array('post_type' => 'page', 'meta_key' => 'Review Type', 'meta_value' => $reviewtype);
	query_posts ( $reviewargs );
    if (have_posts()) : while (have_posts()) : the_post();
		$morelink = get_permalink();
	endwhile; endif;	
	wp_reset_query();
	return $morelink;
}
// determine the topmost parent of a term
function get_term_top_most_parent($term_id, $taxonomy){
    // start from the current term
    $parent  = get_term_by( 'id', $term_id, $taxonomy);
	if($parent->parent) {
		// climb up the hierarchy until we reach a term with parent = '0'
		while ($parent->parent != '0'){
			$term_id = $parent->parent;
	
			$parent  = get_term_by( 'id', $term_id, $taxonomy);
		}
	}
    return $parent;
}

//include reviews in archives, sliders, and widgets
//without this code, only "post" post types will display in the Latest Slider and many other areas of the theme
//if(!is_admin() && is_main_query()) {
if(!is_admin()) {	
	add_filter('pre_get_posts', 'query_post_type');
	function query_post_type($query) {
	  //get review types
	  global $oswcPostTypes;	
	  if(empty($query->query_vars['suppress_filters'])) {
		$post_type = get_query_var('post_type');	
		//********************************
		//BEGIN OLD MADE 1.x FUNCTION CODE
		//********************************	
		//exclude special post types from plugins, such as "forum" and "topic" for bbpress, or "product" for WooCommerce
		/*if($post_type!='forum' && $post_type!='topic') { 	
			if($post_type) {
				$post_type = $post_type;
				$query->set('post_type',$post_type);
				echo("post type1=".$post_type);
				return $query;		
			} elseif(!is_page() && !is_preview() && !is_attachment() && !is_search()) {
				echo("post type2=".$post_type);
				$post_type = array('post');
				foreach($oswcPostTypes->postTypes as $postType){
					array_push($post_type, $postType->id);
				}
				$query->set('post_type',$post_type);
				return $query;				
			}
		}*/
		//********************************
		//END OLD MADE 1.x FUNCTION CODE
		//********************************	
		if(!$post_type && !is_page() && !is_preview() && !is_attachment() && !is_search()) {	
			$post_type = array('post');
			foreach($oswcPostTypes->postTypes as $postType){
				array_push($post_type, $postType->id);
			}
			$query->set('post_type',$post_type);
			//the returned array contains the "post" post type and all of the user-defined review types
			return $query;				
		}
	  }
	}
}
//add reviews to the archives tab
add_filter( 'getarchives_where' , 'ucc_getarchives_where_filter' , 10 , 2 ); 
function ucc_getarchives_where_filter( $where , $r ) { 
	$args = array( 'public' => true , '_builtin' => false ); $output = 'names'; $operator = 'and';
	$post_types = get_post_types( $args , $output , $operator ); $post_types = array_merge( $post_types , array( 'post' ) ); $post_types = "'" . implode( "' , '" , $post_types ) . "'";
	return str_replace( "post_type = 'post'" , "post_type IN ( $post_types )" , $where );
}

//get rid of hentry from post class (screws up google rich snippets)
function remove_hentry( $classes ) {
	$classes = array_diff($classes, array('hentry'));
	return $classes;
}
add_filter('post_class', 'remove_hentry');

// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

 // setup custom menu functionality
function register_my_menus() {
  register_nav_menus(
	array( 'top-menu' => __( 'Top Menu','made' ), 'main-menu' => __( 'Main Menu','made' ), 'sub-menu' => __( 'Sub Menu','made' ), 'footer-menu' => __( 'Footer Menu','made' ))
  );
}
add_action( 'init', 'register_my_menus' );

//add custom css class to specific menu items
add_filter('nav_menu_css_class' , 'current_type_nav_class' , 10 , 2);
function current_type_nav_class($classes, $item){
	$post_type = str_replace('os_','',get_post_type());
	if((is_single() || is_tax()) && $item->attr_title == $post_type){
		$classes[] = "current_page_ancestor";
	}
	//var_dump($item);		
	return $classes;
}

//get tags for the current post but exclude template tags
function oswc_get_tags($postid, $separator) {
	global $oswc_front, $oswc_misc;
	$tag_list = '';
	$oswc_featured_tag = $oswc_front['featured_tag'];
	$oswc_spotlight_tags = $oswc_front['spotlight_tags'];
	$oswc_trending_tag = $oswc_front['trending_tags'];
	$oswc_latest_tag = $oswc_misc['latest_tag'];
	$oswc_dontmiss_tag = $oswc_misc['dontmiss_tag'];
	$tags = wp_get_post_tags($postid); //get all tag objects for this post
	$count=0;
	$tagcount=0;
	foreach($tags as $tag){	 //this first loop gets number of tags for this post after excluding template tags
		if(strtolower($tag->name)!=strtolower($oswc_featured_tag) && strtolower($tag->name)!=strtolower($oswc_spotlight_tags) && strtolower($tag->name)!=strtolower($oswc_trending_tag) && strtolower($tag->name)!=strtolower($oswc_latest_tag) && strtolower($tag->name)!=strtolower($oswc_dontmiss_tag)) {
			$tagcount++;
		}
	}
	foreach($tags as $tag){	//this is the loop that actually displays the tag list
		if(strtolower($tag->name)!=strtolower($oswc_featured_tag) && strtolower($tag->name)!=strtolower($oswc_spotlight_tags) && strtolower($tag->name)!=strtolower($oswc_trending_tag) && strtolower($tag->name)!=strtolower($oswc_latest_tag) && strtolower($tag->name)!=strtolower($oswc_dontmiss_tag)) {
			$count++;			
			$tag_link = get_tag_link($tag->term_id);
			$tag_list .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
			$tag_list .= "{$tag->name}</a>";
			if($count<$tagcount) {
				$tag_list .= $separator; //add the separator if this is not the last tag
			}
		}							
	}
	return $tag_list;
}

// add shortcode buttons to the tinyMCE editor row 3
function add_button_3() {
   if ( current_user_can('edit_posts') )
   {
     add_filter('mce_external_plugins', 'add_plugin_3');
     add_filter('mce_buttons_3', 'register_button_3');
   }
}
// add shortcode buttons to the tinyMCE editor row 4
function add_button_4() {
   if ( current_user_can('edit_posts') )
   {
     add_filter('mce_external_plugins', 'add_plugin_4');
     add_filter('mce_buttons_4', 'register_button_4');
   }
}
//setup array of shortcode buttons to add
function register_button_3($buttons) {
   array_push($buttons, "dropcap", "divider", "quote", "pullquoteleft", "pullquoteright", "togglesimple", "togglebox", "tabs", "slider", "signoff");  
   return $buttons;
}
//setup array of shortcode buttons to add
function register_button_4($buttons) {
   array_push($buttons, "boxes", "columns", "smallbuttons", "largebuttons", "lists");  
   return $buttons;
}
//setup array for tinyMCE editor interface
function add_plugin_3($plugin_array) {
   $plugin_array['lists'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['signoff'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['dropcap'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['divider'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['quote'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['pullquoteleft'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['pullquoteright'] = get_template_directory_uri().'/js/customcodes.js';   
   $plugin_array['togglesimple'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['togglebox'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['tabs'] = get_template_directory_uri().'/js/customcodes.js'; 
   $plugin_array['slider'] = get_template_directory_uri().'/js/customcodes.js'; 
   return $plugin_array;
}
//setup array for tinyMCE editor interface
function add_plugin_4($plugin_array) {
   $plugin_array['boxes'] = get_template_directory_uri().'/js/customcodes.js';   
   $plugin_array['columns'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['smallbuttons'] = get_template_directory_uri().'/js/customcodes.js';
   $plugin_array['largebuttons'] = get_template_directory_uri().'/js/customcodes.js';
   return $plugin_array;
}
add_action('init', 'add_button_3'); // add the add_button function to the page init
add_action('init', 'add_button_4'); // add the add_button function to the page init

//used for displaying top level custom taxonomies
function removeChildren($var) {
	return $var->parent == 0;
}
function getValues($arr) {
	$str = '';
	foreach($arr as $item) {
		if(mb_strlen($str)>0) $str.=',';
		$str.=$item->name;
	}
	return $str;
}

//get a category id from a category name
function get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}
//get a tag id from a tag name
function get_tag_id($tag_name){
	$term = get_term_by('name', $tag_name, 'post_tag');
	return $term->term_id;
}

//add thumbnail support
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 160, 160, true ); // default post thumbnails		
	add_image_size( 'latest', 163, 109, true );	
	add_image_size( 'featured-full', 1000, 550, true );	
	add_image_size( 'featured-small', 650, 360, true );	
	add_image_size( 'footer-thumbnail', 40, 40, true );	
	add_image_size( 'spotlight', 300, 170, true );
	add_image_size( 'spotlight-small', 230, 135, true );
	add_image_size( 'loop-large', 630, 350, true );	
	add_image_size( 'loop-large-full', 960, 450, true );
	add_image_size( 'trending', 105, 70, true );
	add_image_size( 'widget-thumbnail', 70, 70, true );
	add_image_size( 'single', 625 );
	add_image_size( 'single-medium', 300 );
	add_image_size( 'single-small', 180 );
	add_image_size( 'single-full', 960 );
	add_image_size( 'single-review', 350 );
	add_image_size( 'related', 110, 70, true );
}

//get fallback categories
function fallback_categories() {	
	echo "<ul>";
	$menu = wp_list_categories('title_li=&depth=0&echo=0');
	$menu = preg_replace('/title=\"(.*?)\"/','',$menu);
	echo $menu;
	echo "</ul>";
}

//get fallback footer menu
function fallback_footer_menu() {	
	echo "<ul>";
	$menu = wp_list_pages('title_li=&depth=1&echo=0');
	$menu = preg_replace('/title=\"(.*?)\"/','',$menu);
	echo $menu;
	echo "</ul>";
}

// If more than one page exists, return TRUE
function show_posts_nav($total_comments) {    
	$page_comments = get_option('page_comments');
	$comments_per_page = get_option('comments_per_page');
	if ($page_comments && ($total_comments>$comments_per_page)) {
		return true;
	} else {
		return false;
	}
}

//debugging purposes to trace and print the redirects done by wordpress
//add_filter( 'wp_redirect', 'wpse12721_wp_redirect' );
function wpse12721_wp_redirect( $location )
{
    // Get a backtrace of who called us
    debug_print_backtrace();
    // Cancel the redirect
    return false;
}

//get the review type based on page custom meta field
function oswc_get_review_meta($postid) {
	//try every reasonble conceivable variation that the user my enter to make this as user friendly as possible
	$postTypeName = get_post_meta($postid, "Review Type", $single = true);
	if(empty($postTypeName)){
		$postTypeName = get_post_meta($postid, "review type", $single = true);
		if(empty($postTypeName)){
			$postTypeName = get_post_meta($postid, "reviewtype", $single = true);
			if(empty($postTypeName)){
				$postTypeName = get_post_meta($postid, "Reviewtype", $single = true);
				if(empty($postTypeName)){
					$postTypeName = get_post_meta($postid, "ReviewType", $single = true);
					if(empty($postTypeName)){
						$postTypeName = get_post_meta($postid, "Review type", $single = true);
						if(empty($postTypeName)){
							$postTypeName = get_post_meta($postid, "review Type", $single = true);
							if(empty($postTypeName)){
								$postTypeName = get_post_meta($postid, "Post Type", $single = true);
								if(empty($postTypeName)){
									$postTypeName = get_post_meta($postid, "post type", $single = true);
									if(empty($postTypeName)){
										$postTypeName = get_post_meta($postid, "review_type", $single = true);
										if(empty($postTypeName)){
											$postTypeName = get_post_meta($postid, "Review_Type", $single = true);
											if(empty($postTypeName)){
												$postTypeName = get_post_meta($postid, "Review_type", $single = true);
												if(empty($postTypeName)){
													$postTypeName = get_post_meta($postid, "review-type", $single = true);
													if(empty($postTypeName)){
														$postTypeName = get_post_meta($postid, "Review-Type", $single = true);
														if(empty($postTypeName)){
															$postTypeName = get_post_meta($postid, "Review-type", $single = true);
															if(empty($postTypeName)){
																$postTypeName = get_post_meta($postid, "post_type", $single = true);
																if(empty($postTypeName)){
																	$postTypeName = get_post_meta($postid, "Post_Type", $single = true);
																	if(empty($postTypeName)){
																		$postTypeName = get_post_meta($postid, "Post_type", $single = true);
																		if(empty($postTypeName)){
																			$postTypeName = get_post_meta($postid, "post-type", $single = true);
																			if(empty($postTypeName)){
																				$postTypeName = get_post_meta($postid, "Post-Type", $single = true);
																				if(empty($postTypeName)){
																					$postTypeName = get_post_meta($postid, "Post-type", $single = true);
																					if(empty($postTypeName)){
																						$postTypeName = get_post_meta($postid, "Reviews Type", $single = true);
																						if(empty($postTypeName)){
																							$postTypeName = get_post_meta($postid, "reviews type", $single = true);
																							if(empty($postTypeName)){
																								$postTypeName = get_post_meta($postid, "Reviews type", $single = true);
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	return $postTypeName;
}

//get regular length excerpts
function oswc_standard_excerpt() {
	$excerpt = get_the_excerpt();		
	if (mb_strlen($excerpt)>230) {
		$excerpt = mb_substr($excerpt, 0, 227) . "...";
	}
	echo $excerpt;
}

//get long length excerpts
function oswc_long_excerpt() {
	$excerpt = strip_tags(get_the_content());		
	if (mb_strlen($excerpt)>950) {
		$excerpt = mb_substr($excerpt, 0, 947) . "...";
	}
	echo $excerpt;
}

//get excerpt for featured slider
function oswc_featured_excerpt() {
	$excerpt = get_the_excerpt();		
	if (mb_strlen($excerpt)>270) {
		$excerpt = mb_substr($excerpt, 0, 267) . "...";
	}
	echo $excerpt;
}

//get excerpt for search results
function oswc_search_excerpt() {
	$excerpt = get_the_excerpt();		
	if (mb_strlen($excerpt)>310) {
		$excerpt = mb_substr($excerpt, 0, 307) . "...";
	}
	echo $excerpt;
}

//feed pagination
function pagination($pages = '', $range = 3)
{
 $showitems = ($range * 2)+1;  

 global $paged;
 if(is_page_template('template-home.php') && is_front_page()) {
	 $paged = (get_query_var('page')); //use the page var instead of paged (paged does not work on home page templates - WP error)
 }
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
	 echo "<div class=\"pagination-wrapper\"><div class=\"pagination\">";
	 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
	 if($paged > 1 && $showitems < $pages) echo "<a rel='prev' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

	 for ($i=1; $i <= $pages; $i++)
	 {
		 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		 {
			 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
		 }
	 }

	 if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";
	 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a rel='next' href='".get_pagenum_link($pages)."'>&raquo;</a>";
	 echo "</div><br class=\"clearer\" /></div>\n";
 }
}

//authors	
add_action('show_user_profile', 'wpsplash_extraProfileFields');
add_action('edit_user_profile', 'wpsplash_extraProfileFields');
add_action('personal_options_update', 'wpsplash_saveExtraProfileFields');
add_action('edit_user_profile_update', 'wpsplash_saveExtraProfileFields');

function wpsplash_saveExtraProfileFields($userID) {

	if (!current_user_can('edit_user', $userID)) {
		return false;
	}

	update_user_meta($userID, 'twitter', $_POST['twitter']);
	update_user_meta($userID, 'facebook', $_POST['facebook']);
	update_user_meta($userID, 'googleplus', $_POST['googleplus']);
	update_user_meta($userID, 'linkedin', $_POST['linkedin']);
	update_user_meta($userID, 'digg', $_POST['digg']);
	update_user_meta($userID, 'flickr', $_POST['flickr']);
	update_user_meta($userID, 'youtube', $_POST['youtube']);
}

function wpsplash_extraProfileFields($user)
{
?>
	<h3><?php _e( 'Connect Information', 'made' ); ?></h3>

	<table class='form-table'>
		<tr>
			<th><label for='twitter'><?php _e( 'Twitter', 'made' ); ?></label></th>
			<td>
				<input type='text' name='twitter' id='twitter' value='<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Enter your Twitter username.', 'made' ); ?> http://www.twitter.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='facebook'><?php _e( 'Facebook', 'made' ); ?></label></th>
			<td>
				<input type='text' name='facebook' id='facebook' value='<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Enter your Facebook username/alias.', 'made' ); ?> http://www.facebook.com/<strong>username</strong></span>
			</td>
		</tr>
        <tr>
			<th><label for='googleplus'><?php _e( 'Google Plus', 'made' ); ?></label></th>
			<td>
				<input type='text' name='googleplus' id='googleplus' value='<?php echo esc_attr(get_the_author_meta('googleplus', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Enter your Google Plus account ID.', 'made' ); ?> http://plus.google.com/<strong>account ID</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='linkedin'><?php _e( 'LinkedIn', 'made' ); ?></label></th>
			<td>
				<input type='text' name='linkedin' id='linkedin' value='<?php echo esc_attr(get_the_author_meta('linkedin', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Enter your LinkedIn username.', 'made' ); ?> http://www.linkedin.com/in/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='digg'><?php _e( 'Digg', 'made' ); ?></label></th>
			<td>
				<input type='text' name='digg' id='digg' value='<?php echo esc_attr(get_the_author_meta('digg', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Enter your Digg username.', 'made' ); ?> http://digg.com/users/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='flickr'><?php _e( 'Flickr', 'made' ); ?></label></th>
			<td>
				<input type='text' name='flickr' id='flickr' value='<?php echo esc_attr(get_the_author_meta('flickr', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Enter your flickr username.', 'made' ); ?> http://www.flickr.com/photos/<strong>username</strong>/</span>
			</td>
		</tr>
        <tr>
			<th><label for='youtube'><?php _e( 'YouTube', 'made' ); ?></label></th>
			<td>
				<input type='text' name='youtube' id='youtube' value='<?php echo esc_attr(get_the_author_meta('youtube', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Enter your YouTube username.', 'made' ); ?> http://www.youtube.com/user/<strong>username</strong>/</span>
			</td>
		</tr>
	</table>
<?php }

//comments styling
function made_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="li-comment-<?php comment_ID() ?>">
		
		<div id="comment-<?php comment_ID(); ?>">
        
        	<div class="author-image">
        
        		<?php echo get_avatar($comment,50); ?>
                
            </div>
            
            <div class="comment-wrapper">
            	
                <div class="comment-arrow">&nbsp;</div>
            
            	<div class="comment-inner">
            
                    <div class="comment-author">             
                    
                        <?php printf(__('%s','made'), get_comment_author_link()) ?>
                        
                    </div>
                    
                    <div class="comment-meta">
                    
                        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s','made'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','made'),'  ','') ?>
                        
                    </div>
                    
                    <?php if( $commentrating = get_comment_meta( get_comment_ID() , 'user_rating', true ) ) { ?>
                    
                    	<?php //get the review type 
						global $oswcPostTypes;
						$thiscomment = get_comment(get_comment_ID());
						$postTypeId = get_post_type($thiscomment->comment_post_ID);						
						$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
						$userRatingsEnabled=$reviewType->user_ratings_enabled;
						if($userRatingsEnabled) {
						?>
						
							<div class="rating-wrapper small"><?php oswc_get_rating($commentrating, $reviewType); ?></div>
                            
                        <?php } ?>
						
					<?php } ?>
                    
                    <br class="clearer" />
                    
                    <?php if ($comment->comment_approved == '0') : ?>
                    
                        <div class="comment-moderation">
                            <?php _e('Your comment is awaiting moderation.','made') ?>                               
                        </div>
                        
                    <?php endif; ?>
                    
                    <div class="comment-text">
                    
                        <?php comment_text() ?>
                        
                    </div>
                    
					<?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>
                    
                    	<?php //_e('You must','made'); ?>&nbsp;<a href="<?php //echo wp_login_url(); ?>" title="<?php //_e('log in','made'); ?>"><?php //_e('log in','made'); ?></a>&nbsp;<?php //_e('to post a comment','made'); ?>                        
                        
                    <?php } else { ?>
                    
                        <div class="reply">
                    
                            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                            
                        </div>
                    
                    <?php } ?>    
                                    
                    <br class="clearer" />
                    
                </div>
                
                <br class="clearer" />
                
            </div>
            
            <br class="clearer" />
            
		</div>
<?php }

//open comment author's links in new windows
function get_comment_author_link_new() {

	$url = get_comment_author_url();
	$author = get_comment_author();

	if (empty( $url ) || 'http://' == $url)

		$return = $author;

	else

		$return = "<a href='$url' rel='external nofollow' class='url' target='_blank'>$author</a>";

	return $return;
}
add_filter('get_comment_author_link', 'get_comment_author_link_new');

//display an ad in a post
function oswc_ad($ads, $cols, $postcount, $adcount, $layout) {
	//get theme options
	global $oswc_ads;	
	//set theme options
	$oswc_ad_num = $oswc_ads['ad_num'];
	$oswc_ad_increment = $oswc_ads['ad_increment'];
	$oswc_ad_offset = $oswc_ads['ad_offset'];
		
	if($oswc_ad_num!=0) { // display ads in the loop
                
		if($postcount==$oswc_ad_offset+1) { // the first ad to display ?>
    
            <div class="ad-panel post-panel<?php if($layout=="B") { ?> layout-b<?php } elseif($layout=="C") { ?> layout-c<?php } ?><?php if($postcount % $cols == 0) { ?> right<?php } ?>">
        
                <?php $adcount++; ?>
                    
                <?php echo do_shortcode($ads[$adcount]); ?>
                
            </div>
            
            <?php if ($postcount % $cols == 0) { // new line every x panels ?>
            
                <br class="clearer non-responsive" />
        
            <?php } ?>
            
            <?php if ($postcount % 2 == 0) { // responsive designs will only have one or two max panels, so clearing every 2 works for both cases  ?>
                                        
                <div class="clear-responsive">&nbsp;</div>
        
            <?php } ?>
            
            <?php $postcount++;
            
        } elseif ((($postcount-$oswc_ad_offset-1) % ($oswc_ad_increment)==0) && ($postcount>$oswc_ad_offset) && ($oswc_ad_num>$adcount)) { // incremented ads ?>
        
            <div class="ad-panel post-panel<?php if($layout=="B") { ?> layout-b<?php } elseif($layout=="C") { ?> layout-c<?php } ?><?php if($postcount % $cols == 0) { ?> right<?php } ?>">
        
                <?php $adcount++; ?>
                    
                <?php echo do_shortcode($ads[$adcount]); ?>
                
            </div>
            
            <?php if ($postcount % $cols == 0) { // new line every x panels ?>
            
                <br class="clearer non-responsive" />
        
            <?php } ?>
            
            <?php if ($postcount % 2 == 0) { // responsive designs will only have one or two max panels, so clearing every 2 works for both cases  ?>
                                    
                <div class="clear-responsive">&nbsp;</div>
        
            <?php } ?>
            
            <?php $postcount++;
        
    	}    
	} // end if display ads in the loop	
	$counts=array($postcount,$adcount);
	return $counts;
}

//disable wpautop and wptexturize for column shortcodes
function oswc_formatter($content) {
	$new_content = '';

	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {

			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {

			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}
// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
// Before displaying for viewing, apply this function
add_filter('the_content', 'oswc_formatter', 99);
add_filter('widget_text', 'oswc_formatter', 99);

//Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
//@ini_set('pcre.backtrack_limit', 500000);

//enable reviews in RSS feed
function myfeed_request($qv) {
	global $oswcPostTypes;
	if (isset($qv['feed']) && !isset($qv['post_type'])) {
		$arr = array('post');
		foreach($oswcPostTypes->postTypes as $postType) {
			array_push($arr,$postType->id);
		}
		$qv['post_type'] = $arr;
		return $qv;
	}
}
//add_filter('request', 'myfeed_request');

//add shortcode functionality to non-standard elements
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

//save user rating to meta fields
add_action('comment_post', 'saveCommentRating');
function saveCommentRating($comment_id) {
	if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') ) {

		//get the user's ip address
		$ip=$_SERVER['REMOTE_ADDR'];
		
		//get the rating from the comment form
		$rating=wp_filter_nohtml_kses($_POST['rating']);
		
		//get the post info and meta value
		global $post, $oswcPostTypes;
		$meta = get_post_meta($post->ID, "user_rating", $single = true);
		if($meta=="") $addmeta=false;
		
		//see if user ratings are enabled for this review type
		$postTypeId = get_post_type($post->ID);						
		$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);	
		$userRatingsEnabled = $reviewType->user_ratings_enabled;
		if($userRatingsEnabled) {
		
			//add rating to the comment meta for display in comment list
			add_comment_meta( $comment_id, 'user_rating', $rating );
				
			//now add it to the post meta so it can be combined with "comment-less ratings" later
			//use comma to delimit rating from ip and semicolon to delimit user ratings
			$meta.=$rating.','.$ip.";";
			
			//figure out whether to add or update meta field
			if($addmeta) {
				//add meta field
				add_post_meta($post->ID, 'user_rating', $meta);
			} else { 
				//update meta field
				update_post_meta($post->ID, 'user_rating', $meta);
			}
			
		}
	}
}

// Add custom meta (ratings) fields to the default comment form
// Default comment form includes name, email address and website URL
// Default comment form elements are hidden when user is logged in
add_filter('comment_form_default_fields', 'custom_fields');
function custom_fields($fields) {

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields[ 'author' ] = '<div class="comment-form-author"><div class="label"><label for="author">' . __( 'Name','made' ) . '</label> ' . ( $req ? '<span class="required">(' . __( 'required', 'made' ) . ')</span>' : '' ) .
							'</div><div class="input-wrapper"><div class="shadow"><div class="icon"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" /></div></div></div></div>';

		$fields[ 'email' ] = '<div class="comment-form-email"><div class="label"><label for="email">' . __( 'Email','made' ) . '</label> ' . ( $req ? '<span class="required">(' . __( 'required', 'made' ) . ')</span>' : '' ) .
							'</div><div class="input-wrapper"><div class="shadow"><div class="icon"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /></div></div></div></div>';

		$fields[ 'url' ] = '<div class="comment-form-url"><div class="label"><label for="url">' . __( 'Website','made' ) . '</label>' .
							'</div><div class="input-wrapper"><div class="shadow"><div class="icon"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div></div><br class="clearer" />';

	return $fields;
}

// Add fields after default fields above the comment box, always visible
add_action( 'comment_form_logged_in_after', 'additional_fields' );
add_action( 'comment_form_after_fields', 'additional_fields' );

function additional_fields () {
	
	global $post, $oswcPostTypes;
	$meta = get_post_meta($post->ID, "user_rating", $single = true);
	//get the review type 					
	$postTypeId = get_post_type($post->ID);						
	$reviewType = $oswcPostTypes->get_type_by_id($postTypeId);
	$rating_type = $reviewType->rating_type;
	$userRatingsEnabled = $reviewType->user_ratings_enabled;
	if($userRatingsEnabled) {
		//get the ip address			
		$ip=$_SERVER['REMOTE_ADDR'];
		if(strpos($meta,$ip) === false) {
			
			echo '<div class="comment_rating_label label"><label for="rating">'. __('My Rating','made') . '</label></div>';
			
			echo '<div class="comment_rating"><select id="rating" name="rating"><option value="">---------</option>';
		
			switch ($rating_type) {
				case "stars":
					for( $i=5; $i >= 0; $i-=.5 )
						echo '<option value="'. $i .'"/>'. $i .'</option>';
					break;
				case "number":
					for( $i=10; $i >= 1; $i-=1 )
						echo '<option value="'. $i .'"/>'. $i .'</option>';
					break;				
				case "percentage":
					for( $i=100; $i >= 0; $i-=1 )
						echo '<option value="'. $i .'"/>'. $i .'</option>';
					break;
				case "letter":
					echo '<option value="A+"/>A+</option>';
					echo '<option value="A"/>A</option>';
					echo '<option value="A-"/>A-</option>';
					echo '<option value="B+"/>B+</option>';
					echo '<option value="B"/>B</option>';
					echo '<option value="B-"/>B-</option>';
					echo '<option value="C+"/>C+</option>';
					echo '<option value="C"/>C</option>';
					echo '<option value="C-"/>C-</option>';
					echo '<option value="D+"/>D+</option>';
					echo '<option value="D"/>D</option>';
					echo '<option value="D-"/>D-</option>';
					echo '<option value="F+"/>F+</option>';
					echo '<option value="F"/>F</option>';
					break;			
			}
			
			echo '</select></div><br class="clearer" />';
	
		}
	}
}

?>