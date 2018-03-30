<?php
/**
 *  Extera hooks for filters and actions for the theme
 * 
 * @package toranj
 * @author owwwlab
 */

/**
 * ----------------------------------------------------------------------------------------
 * disable and enable wordpress featurs
 * ----------------------------------------------------------------------------------------
 */

// Hide admin bar
//add_filter('show_admin_bar', '__return_false');



/**
 * ----------------------------------------------------------------------------------------
 * Process Page titles and make them double lined based on vertical line
 * ----------------------------------------------------------------------------------------
 */

function owlab_split_title($title, $id = null) {

	if ( is_admin() )
		return $title;
	
    $separator = htmlentities('|');
    $lines = explode( $separator , $title);
    if (count($lines)>1){

    	$first_part = $lines[0];
	    $the_rest="";
	    foreach($lines as $key=>$value){
	    	if ($key != 0){
	    		$the_rest.=$value;
	    	}
	    }
	    
    	if (ot_get_option('blog_index_layout')=='minimal' && is_home()){
    		return "$first_part<span>$the_rest</span>";
    	}else{
			return "<span class='second-part'>$first_part</span>$the_rest";
    	}
	    
	}
	return $title;
}
add_filter('the_title', 'owlab_split_title', 10, 2);



/**
 * ----------------------------------------------------------------------------------------
 * Add classes to prev and next posts links
 * ----------------------------------------------------------------------------------------
 */

add_filter('next_posts_link_attributes', 'owlab_posts_link_attributes_prev');
add_filter('previous_posts_link_attributes', 'owlab_posts_link_attributes_next');

function owlab_posts_link_attributes_prev() {
    return 'class="prev-post btn btn-lg btn-simple pull-right"';
}
function owlab_posts_link_attributes_next() {
    return 'class="prev-post btn btn-lg btn-simple"';
}




/**
 * ----------------------------------------------------------------------------------------
 * Change post thumbnail image marckup
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'owlab_remove_width_attribute' ) ) {
	function owlab_remove_width_attribute( $html ){
		$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   		return $html;
	}
	add_filter( 'post_thumbnail_html', 'owlab_remove_width_attribute', 10 );
	add_filter( 'image_send_to_editor', 'owlab_remove_width_attribute', 10 );
}


/**
 * ----------------------------------------------------------------------------------------
 * add body classes for fixed and dark sidebar
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_body_class_add') ){
	function owlab_body_class_add($classes){
		
		if ( !function_exists('ot_get_option'))
			return $classes;

		if ( ot_get_option('dark_sidebar') == 'on' ){
			$classes[] = 'dark-sidebar';
		}

		if ( ot_get_option('fixed_sidebar') == 'on' ){
			$classes[] = 'show-sidebar';
		}
		
		return $classes;
	}
	add_action( 'body_class', 'owlab_body_class_add'); 

}



/**
 * ----------------------------------------------------------------------------------------
 * we want to get all the posts
 * ----------------------------------------------------------------------------------------
 */

if ( ! function_exists('owlab_custom_get_posts') ){

	add_filter( 'pre_get_posts', 'owlab_custom_get_posts' );

	function owlab_custom_get_posts( $query ) {

		$post_types = array('owlabgal','owlabpfl','owlabbulkg');
		
		if ( ! is_admin() ){
			if( is_tax( 'owlabgal_album' ) || is_post_type_archive( $post_types ) || is_tax("owlabpfl_group") || is_tax('owlabbulkg_category') ) { 

				$query->query_vars['posts_per_page'] = -1;
				//$query->query_vars['orderby'] = 'menu_order';
				//$query->query_vars['order'] = 'ASC';

			}
		}

	    return $query;
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Add logout link to woocommerce menu
 * ----------------------------------------------------------------------------------------
 */
function owlab_add_login_logout_link( $items, $args  ) {
	if( $args->theme_location == 'woocommerce-menu-logged-in' ) {
	        $loginoutlink = wp_loginout('index.php', false);
	        $items .= '<li>'. $loginoutlink .'</li>';
			return $items;
	    }
	    return $items;
}
add_filter( 'wp_nav_menu_items', 'owlab_add_login_logout_link', 10, 2 );

/**
 * ----------------------------------------------------------------------------------------
 * add <span> to categories widget
 * ----------------------------------------------------------------------------------------
 */

function owlab_add_span_cat_count($links) {
	$links = str_replace('</a> (', '</a> <span>(', $links);
	$links = str_replace(')', ')</span>', $links);
	return $links;
}
add_filter('wp_list_categories', 'owlab_add_span_cat_count');


function owlab_archive_count_no_brackets($links) {
$links = str_replace('</a>&nbsp;(', '</a><span>(', $links);
$links = str_replace(')', ')</span>', $links);
return $links;
}
add_filter('get_archives_link', 'owlab_archive_count_no_brackets');

/**
 * ----------------------------------------------------------------------------------------
 * add post type archives to menu selection
 * from: http://stackoverflow.com/questions/20879401/how-to-add-custom-post-type-archive-to-men
 * ----------------------------------------------------------------------------------------
 */
add_action('admin_head-nav-menus.php', 'wpclean_add_metabox_menu_posttype_archive');

function wpclean_add_metabox_menu_posttype_archive() {
	add_meta_box('wpclean-metabox-nav-menu-posttype', __('Post type Archives','toranj'), 'wpclean_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}

function wpclean_metabox_menu_posttype_archive() {
	$post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');

	if ($post_types) :
	    $items = array();
	    $loop_index = 999999;

	    foreach ($post_types as $post_type) {
	        $item = new stdClass();
	        $loop_index++;

	        $item->object_id = $loop_index;
	        $item->db_id = 0;
	        $item->object = 'post_type_' . $post_type->query_var;
	        $item->menu_item_parent = 0;
	        $item->type = 'custom';
	        $item->title = $post_type->labels->name;
	        $item->url = get_post_type_archive_link($post_type->query_var);
	        $item->target = '';
	        $item->attr_title = '';
	        $item->classes = array();
	        $item->xfn = '';

	        $items[] = $item;
	    }

	    $walker = new Walker_Nav_Menu_Checklist(array());

	    echo '<div id="posttype-archive" class="posttypediv">';
	    echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
	    echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
	    echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
	    echo '</ul>';
	    echo '</div>';
	    echo '</div>';

	    echo '<p class="button-controls">';
	    echo '<span class="add-to-menu">';
	    echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
	    echo '<span class="spinner"></span>';
	    echo '</span>';
	    echo '</p>';

	endif;
}


/**
 * ----------------------------------------------------------------------------------------
 * add sharing to the page 
 * ----------------------------------------------------------------------------------------
 */

function owlab_add_sharing($return=false) {
	
	//check if we have the option tree
	if ( !function_exists('ot_get_option')) return;

	//check if it is enabled
	if ( ot_get_option('enable_social_sharing','off') == 'off') return;

	//get the sharing media
	$websites = ot_get_option('sharing_social_medias',array());


	$links = array();
	foreach ($websites as $site) :
		
		$media = isset($site['sharing_websites']) ? $site['sharing_websites'] : '';

		switch ($media) {
			case 'facebook':
				$pre_link = 'https://www.facebook.com/sharer/sharer.php?u={url}&t={title}';
				break;
			case 'twitter':
				$pre_link = 'https://twitter.com/share?url={url}';
				break;
			case 'google-plus':
				$pre_link = 'https://plus.google.com/share?url={url}';
				break;
			case 'digg':
				$pre_link = 'http://digg.com/submit?url={url}';
				break;
			case 'pinterest':
				$pre_link = 'https://pinterest.com/pin/create/bookmarklet/?media={img}&url={url}';
				break;
			case 'linkedin':
				$pre_link = 'http://www.linkedin.com/shareArticle?url={url}&title={title}';
				break;
			case 'buffer':
				$pre_link = 'http://bufferapp.com/add?text={title}&url={url}';
				break;
			case 'tumblr':
				$pre_link = 'http://www.tumblr.com/share/link?url={url}&name={title}';
				break;
			case 'reddit':
				$pre_link = 'http://reddit.com/submit?url={url}&title={title}';
				break;
			case 'stumbleUpon':
				$pre_link = 'http://www.stumbleupon.com/submit?url={url}&title={title}';
				break;
			case 'delicious':
				$pre_link = 'https://delicious.com/save?v=5&provider=&noui&jump=close&url={url}&title={title}';
				break;
			default:
				$pre_link = '';
				break;
		}
		
		if ($pre_link != '')
			$this_link = '<li><a class="sharing-link share-'.$media.'" href="'.$pre_link.'" target="_blank">'.$site['title'].'</a></li>';
		
		$links[] = $this_link; 
	endforeach; 

	$output = '<a id="social-sharing-trigger" href="#"><i class="fa fa-share-alt"></i></a>'; 
	$output .= '<div id="social-sharing"><a class="share-close"><i class="fa fa-close"></i></a>';
	$output .= '<div class="vcenter-wrapper"><div class="vcenter">';
	$output .= '<div class="sharing-icon"><i class="fa fa-share-alt"></i></div>';
	$output .= '<ul>'.implode( '', $links).'</ul>';
	$output .='</div></div></div>';

	if ($return)
		return $output;
	else
		echo $output;
	
}

add_action('owlab_after_content','owlab_add_sharing');


/**
 * ----------------------------------------------------------------------------------------
 * Style titles for protected and private 
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists('toranj_change_protected_title_prefix') ){
	function toranj_change_protected_title_prefix() {
	    return "<span class='toranj-protected'>".__('Protected').':</span> %s';
	}
}
add_filter('protected_title_format', 'toranj_change_protected_title_prefix');

if ( !function_exists('toranj_change_private_title_prefix')){
	function toranj_change_private_title_prefix() {
	    return "<span class='toranj-protected'>".__('Private').':</span> %s';
	}
}
add_filter('private_title_format', 'toranj_change_private_title_prefix');



