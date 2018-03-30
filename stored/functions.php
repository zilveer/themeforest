<?php

// Theme Prefix: dcs_

/* ========================================= Constants ========================================= */

if(!defined('DCS_THEME_DIR')) {
	define('DCS_THEME_DIR', dirname(__FILE__));
}

/* ========================================= File Includes ========================================= */

include(DCS_THEME_DIR . '/includes/scripts.php');

if ( class_exists('Cart66_Cloud') ) {
	include(DCS_THEME_DIR . '/cart66-cloud/functions.php');
}

/* ========================================= General Things We Need ========================================= */

add_editor_style(); // Adds CSS to the editor to match the front end of the site.
add_theme_support('automatic-feed-links');
if ( ! isset( $content_width ) ) $content_width = 690; // This is the max width of the content, thus the max width of large images that are uploaded.
require_once(dirname(__FILE__) . "/includes/support/support.php"); // Load support tab

// Load Language File
load_theme_textdomain( 'designcrumbs', get_template_directory() .'/languages' );
$locale = get_locale();
$locale_file = get_template_directory() .'/languages/$locale.php';
if ( is_readable($locale_file) )
	require_once($locale_file);

// Check for Options Framework Plugin
of_check();
function of_check() {
	if ( !function_exists('of_get_option') ) {
		add_action('admin_notices', 'of_check_notice');
	}
}

// The Admin Notice
function of_check_notice() { ?>
	<div class='updated fade'>
		<p><?php _e('The Options Framework plugin is required for this theme to function properly.', 'designcrumbs'); ?> <a href="<?php echo network_admin_url('plugin-install.php?tab=plugin-information&plugin=options-framework&TB_iframe=true&width=640&height=517'); ?>" class="thickbox onclick"><?php _e('Install now.', 'designcrumbs'); ?></a></p>
	</div>
<?php }

// Check for Cart66
cart66_check();
function cart66_check() {
	if (( !class_exists('Cart66') ) && ( !class_exists('Cart66_Cloud') )) {
		add_action('admin_notices', 'cart66_check_notice');
	}
}

// The Admin Notice
function cart66_check_notice() {
	if (of_get_option('affiliate_mode') == 'no') { ?>
		<div class='updated fade'>
			<p><?php _e('The Cart66 plugin is required for this theme to function properly.', 'designcrumbs'); ?>
				<a href=" http://cart66.hurricane.io/hdpsky" target="_blank" ><?php _e('Get Cart66 Pro or Cloud', 'designcrumbs'); ?></a>
				- <em><?php _e('Install a Cart66 plugin or enable Affiliate Mode in the Theme Options to remove this alert.', 'designcrumbs'); ?></em></p>
		</div>
	<?php } // end affiliate_mode check
}

/* =================================== Options Framework =================================== */

if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = 'false') {

	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}

	if ( !empty($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}

/* Toggles options on and off on click */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	// adds support tab
	jQuery(".embed-themes").html("<iframe width='770' height='390' src='http://themes.designcrumbs.com/iframe/index.html'></iframe>");

	// affiliate mode checks
	jQuery('#stored-cloud-affiliate_mode-yes').click(function() {
  		jQuery('#section-cart_link').fadeOut(400);
  		jQuery('#section-member_login').fadeOut(400);
  		jQuery('#section-account_link').fadeOut(400);
	});

	jQuery('#stored-cloud-affiliate_mode-no').click(function() {
  		jQuery('#section-cart_link').fadeIn(400);
  		jQuery('#section-member_login').fadeIn(400);
  		jQuery('#section-account_link').fadeIn(400);
	});

	if (jQuery('#stored-cloud-affiliate_mode-yes').is(':checked')) {
		jQuery('#section-cart_link').hide();
  		jQuery('#section-member_login').hide();
  		jQuery('#section-account_link').hide();
	};

});
</script>

<?php
}

/* Removes the code stripping */

add_action('admin_init','optionscheck_change_santiziation', 100);

function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'of_sanitize_textarea_custom' );
}

function of_sanitize_textarea_custom($input) {
    global $allowedposttags;
        $of_custom_allowedtags["embed"] = array(
			"src" => array(),
			"type" => array(),
			"allowfullscreen" => array(),
			"allowscriptaccess" => array(),
			"height" => array(),
			"width" => array()
		);
		$of_custom_allowedtags["script"] = array(
			"type" => array()
		);
		$of_custom_allowedtags["iframe"] = array(
			"height" => array(),
			"width" => array(),
			"src" => array(),
			"frameborder" => array(),
			"allowfullscreen" => array()
		);
		$of_custom_allowedtags["object"] = array(
			"height" => array(),
			"width" => array()
		);
		$of_custom_allowedtags["param"] = array(
			"name" => array(),
			"value" => array()
		);

	$of_custom_allowedtags = array_merge($of_custom_allowedtags, $allowedposttags);
	$output = wp_kses( $input, $of_custom_allowedtags);
	return $output;
}

/* =================================== Hook Into Cart66 Dialog Box =================================== */

function dcs_product_popup(){
	return array('products');
}
add_filter('cart66_add_popup_screens', 'dcs_product_popup');

/* ========================================= Remove the Default Cart66 CSS ========================================= */

add_action( 'wp_print_styles', 'deregister_cart66_css', 100 );

function deregister_cart66_css() {
	wp_deregister_style( 'cart66-css' );
}

/* =================================== Add Fancybox to linked Images =================================== */

function dcs_lightbox_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
	$classes = 'lightbox'; // separated by spaces, e.g. 'img image-link'

	// check if there are already classes assigned to the anchor
	if ( preg_match('/<a.*? class=".*?">/', $html) ) {
		$html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
	} else {
		$html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
	}
	return $html;
}
add_filter('image_send_to_editor','dcs_lightbox_class',10,8);

/* =================================== Add Menus =================================== */

add_theme_support( 'menus' );

register_nav_menus( array(
	'primary' => __( 'Main Menu', 'stored' ),
	'secondary' => __( 'Footer Menu', 'stored' ),
) );

/* ========================================= Featured Images ========================================= */

add_theme_support( 'post-thumbnails' ); /* ===== ADDS FEATURED IMAGE TO PAGES ===== */
add_image_size( 'slide_image', 500, 500, false ); /* ===== SETS FEATURED IMAGE SIZE  ===== */
add_image_size( 'slide_thumb', 240, 200, true ); /* ===== SETS FEATURED IMAGE SIZE  ===== */
add_image_size( 'product_med', 200, 215, false ); /* ===== SETS FEATURED IMAGE SIZE  ===== */
add_image_size( 'product_main', 280, 9999, false ); /* ===== SETS FEATURED IMAGE SIZE  ===== */
add_image_size( 'product_mini_gallery', 80, 80, true ); /* ===== SETS FEATURED IMAGE SIZE  ===== */
add_image_size( 'blog_image_lg', 690, 290, true ); /* ===== SETS FEATURED IMAGE SIZE  ===== */
add_image_size( 'blog_image_sm', 240, 190, true ); /* ===== SETS FEATURED IMAGE SIZE  ===== */
add_image_size( 'archive_image', 46, 46, true ); /* ===== SETS FEATURED IMAGE SIZE  ===== */

/* =================================== Add Slides Post Type =================================== */

if ( !class_exists('Cart66_Cloud') ) { // if not using Cart66 Cloud

	register_post_type('products', array(
		'label' => __('Products', 'designcrumbs'),
		'singular_label' => __('Product', 'designcrumbs'),
		'public' => true,
		'show_ui' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => true,
		'has_archive' => false,
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'comments',
				'revisions',)
		));

	// create categories and tags for products
	add_action( 'init', 'create_product_taxonomies', 0 );
	function create_product_taxonomies() {
	
		$labels = array(
			'name' => __( 'Product Types', 'designcrumbs' ),
			'singular_name' => __( 'Product Type', 'designcrumbs' ),
			'search_items' =>  __( 'Search Product Types', 'designcrumbs' ),
			'all_items' => __( 'All Product Types', 'designcrumbs' ),
			'parent_item' => __( 'Parent Product Type', 'designcrumbs' ),
			'parent_item_colon' => __( 'Parent Product Type:', 'designcrumbs' ),
			'edit_item' => __( 'Edit Product Types', 'designcrumbs' ),
			'update_item' => __( 'Update Product Types', 'designcrumbs' ),
			'add_new_item' => __( 'Add New Product Types', 'designcrumbs' ),
			'new_item_name' => __( 'New Product Types Name', 'designcrumbs' ),
		);
	
		register_taxonomy( 'types', array( 'products' ), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'types' ),
		));
	
		$labels = array(
			'name' => __( 'Product Tags', 'designcrumbs' ),
			'singular_name' => __( 'Product Tag', 'designcrumbs' ),
			'search_items' =>  __( 'Search Product Tags', 'designcrumbs' ),
			'popular_items' => __( 'Popular Product Tags', 'designcrumbs' ),
			'all_items' => __( 'All Product Tags', 'designcrumbs' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Product Tag', 'designcrumbs' ),
			'update_item' => __( 'Update Product Tag', 'designcrumbs' ),
			'add_new_item' => __( 'Add New Product Tag', 'designcrumbs' ),
			'new_item_name' => __( 'New Product Tag', 'designcrumbs' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'designcrumbs' ),
			'add_or_remove_items' => __( 'Add or remove tags', 'designcrumbs' ),
			'choose_from_most_used' => __( 'Choose from the most used product tags', 'designcrumbs' )
		);
		register_taxonomy( 'product_tags', array( 'products' ), array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'product_tags' ),
		));
	
	}

}

register_post_type('slides', array(
	'label' => __('Slides', 'designcrumbs'),
	'singular_label' => __('Slide', 'designcrumbs'),
	'public' => true,
	'show_ui' => true,
	'_builtin' => false,
	'_edit_link' => 'post.php?post=%d',
	'capability_type' => 'post',
	'hierarchical' => false,
	'has_archive' => false,
	'supports' => array(
			'title',
			'editor',
			'thumbnail',)
	)
);

/* ====================================================== Meta Boxes ====================================================== */

add_filter( 'cmb_meta_boxes', 'dcs_metaboxes' );
function dcs_metaboxes( array $meta_boxes ) {

	$prefix = '_dc_';

	// slides
	$meta_boxes[] = array(
	    'id' => 'dc_slides',
	    'title' => __('Slide Details', 'designcrumbs'),
	    'pages' => array('slides'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
	    'fields' => array(
	        array(
		        'name' => __('Product Price', 'designcrumbs'),
		        'desc' => __('Include the dollar sign.', 'designcrumbs'),
		        'id' => $prefix . 'slide_price',
		        'type' => 'text'
		    ),
	        array(
		        'name' => __('Button Link', 'designcrumbs'),
		        'desc' => __('Enter the entire URL including the http:// to where you would like the button to link. Leaving this blank with not display a button.', 'designcrumbs'),
		        'id' => $prefix . 'button_link',
		        'type' => 'text'
		    ),
		    array(
		        'name' => __('Button Text', 'designcrumbs'),
		        'desc' => __('What do you want the button to say? Keep it short!', 'designcrumbs'),
		        'id' => $prefix . 'button_text',
		        'type' => 'text'
		    ),
	    )
	);

	if (of_get_option('affiliate_mode') == 'no') { // check if affiliate_mode is off

		// products
		$meta_boxes[] = array(
		    'id' => 'dc_products',
		    'title' => __('Product Details', 'designcrumbs'),
		    'pages' => array('products'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
		    'fields' => array(
		        array(
			        'name' => __('Product Price', 'designcrumbs'),
			        'desc' => __('Include the dollar sign. <em>This does not affect the price set in Cart66. This is solely for the lists of products.</em>', 'designcrumbs'),
			        'id' => $prefix . 'price',
			        'type' => 'text'
			    ),
		    )
		);

	} else { // else if affiliate mode is on

		// products
		$meta_boxes[] = array(
		    'id' => 'dc_products',
		    'title' => __('Product Details', 'designcrumbs'),
		    'pages' => array('products'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
		    'fields' => array(
		        array(
			        'name' => __('Product Price', 'designcrumbs'),
			        'desc' => __('Include the dollar sign.', 'designcrumbs'),
			        'id' => $prefix . 'price',
			        'type' => 'text'
			    ),
			    array(
			        'name' => __('Additional Details', 'designcrumbs'),
			        'desc' => __('Any extra info to go between the price and buy now button.', 'designcrumbs'),
			        'id' => $prefix . 'aff_info',
			        'type' => 'text'
			    ),
			    array(
			        'name' => __('Affiliate Link', 'designcrumbs'),
			        'desc' => __('The entire url to where the Buy Now button should link to. Make sure to include the http://', 'designcrumbs'),
			        'id' => $prefix . 'aff_link',
			        'type' => 'text'
			    ),
		    )
		);

	}

	return $meta_boxes;
}

add_action( 'init', 'dcs_initialize_cmb_meta_boxes', 9999 );
function dcs_initialize_cmb_meta_boxes() {


	if ( ! class_exists( 'cmb_Meta_Box' ) && !defined( 'CC_VERSION_NUMBER' ) ) {
		require_once 'lib/metabox/init.php';
	}

}

/* =================================== Limit number of products on product archives =================================== */

add_filter('pre_get_posts', 'Per_category_basis');

function Per_category_basis($query){
    if ($query->is_tax('types')) {
        // category named 'books' show 12 posts
        if (is_tax('types')){
            $query->set('posts_per_page', stripslashes(of_get_option('products_total')));
        }
    }
    if ($query->is_tax('product_tags')) {
        // category named 'books' show 12 posts
        if (is_tax('product_tags')){
            $query->set('posts_per_page', stripslashes(of_get_option('products_total')));
        }
    }
    return $query;

}

/* =================================== The Excerpt =================================== */

function improved_trim_excerpt($text) {
        global $post;
        if ( '' == $text ) {
                $text = get_the_content('');
                $text = apply_filters('the_content', $text);
                $text = str_replace('\]\]\>', ']]&gt;', $text);
                $text = strip_tags($text, '<p>');
                $excerpt_length = 50;
                $words = explode(' ', $text, $excerpt_length + 1);
                if (count($words)> $excerpt_length) {
                        array_pop($words);
                        array_push($words, '...');
                        $text = implode(' ', $words);
                }
        }
        return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

/* ========================================= Sidebars ========================================= */

if ( function_exists('register_sidebars') )
	register_sidebar(array(
		'name' => __('Home_Page', 'designcrumbs'),
		'id' => 'Home_Page',
		'description' => __('Widgets for the home page. These widgets will auto resize to fit the area, so use as many as you like.', 'designcrumbs'),
		'before_widget' => '<div class="home_widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Overall_Sidebar', 'designcrumbs'),
		'id' => 'Overall_Sidebar',
		'description' => __('These widgets will show up on every page and post.', 'designcrumbs'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	register_sidebar(array(
		'name' => __('Pages_Sidebar', 'designcrumbs'),
		'id' => 'Pages_Sidebar',
		'description' => __('These widgets will show up only on pages.', 'designcrumbs'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));
	register_sidebar(array(
		'name' => __('Blog_Sidebar', 'designcrumbs'),
		'id' => 'Pages_Sidebar',
		'description' => __('These widgets will show up in the blog and on blog posts.', 'designcrumbs'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>'
	));

/* =================================== Count How Many Widgets are in a Sidebar =================================== */

function count_sidebar_widgets( $sidebar_id, $echo = true ) {
    $the_sidebars = wp_get_sidebars_widgets();
    if( !isset( $the_sidebars[$sidebar_id] ) )
        return __( 'Invalid sidebar ID', 'designcrumbs' );
    if( $echo )
        echo count( $the_sidebars[$sidebar_id] );
    else
        return count( $the_sidebars[$sidebar_id] );
}

// To call it on the front end - count_sidebar_widgets( 'some-sidebar-id' );

/* =================================== User Extras =================================== */

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3><?php _e('Extra profile information', 'designcrumbs'); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="twitter"><?php _e('Twitter', 'designcrumbs'); ?></label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your Twitter username without the @.', 'designcrumbs'); ?></span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
}

function my_author_box() { ?>
			<div class="about_the_author">
				<?php echo get_avatar( get_the_author_meta('email'), '70' ); ?>
				<div class="author_info">
					<div class="author_title"><?php _e('This post was written by', 'designcrumbs'); ?> <?php the_author_posts_link(); ?>
					</div>
					<div class="author_about">
					<?php the_author_meta( 'description' ); ?>
					</div>
					<?php if (get_the_author_meta('twitter') != '' || get_the_author_meta('url') != '' ) { ?>
					<div class="author_links">
						<?php if (get_the_author_meta('twitter') != '' ) { ?>
						<a href="http://twitter.com/<?php the_author_meta('twitter'); ?>" title="<?php _e('My Twitter', 'designcrumbs'); ?>"><?php _e('My Twitter', 'designcrumbs'); ?> &raquo;</a>
						<?php } if (get_the_author_meta('url') != '' ) { ?>
						<a href="<?php the_author_meta('url'); ?>" title="<?php _e('My Website', 'designcrumbs'); ?>"><?php _e('My Website', 'designcrumbs'); ?> &raquo;</a>
						<?php } ?>
					<div class="clear"></div>
					</div>
					<?php } // End check for twitter & url ?>
				</div>
				<div class="clear"></div>
			</div>
	<?php
}

/* =================================== Specific User Widget =================================== */

class featured_user_widget extends WP_Widget {

		//function to set up widget in admin
		function featured_user_widget() {

				$widget_ops = array( 'classname' => 'featured-user',
				'description' => __('A widget that will display a specified user\'s gravatar, display name, bio, and link to their author post archive.', 'designcrumbs') );

				$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'featured-user' );
				parent::__construct( 'featured-user', __('Featured User', 'designcrumbs'), $widget_ops, $control_ops );

		}


		//function to echo out widget on sidebar
		function widget( $args, $instance ) {
		extract( $args );

				$title = $instance['title'];

				echo $before_widget;
				echo "<div class='featured_user'>";

				// if user written title echo out
				if ( $title ){
				echo $before_title . $title . $after_title;
				}
			    //don't touch this!
				$userid = $instance['user_id'];

				//user information array
				//refer to http://codex.wordpress.org/Function_Reference/get_userdata
				$userinfo = get_userdata($userid);

				//user meta data
				//refer to http://codex.wordpress.org/Function_Reference/get_user_meta
				$userbio = get_user_meta($userid,'description',true);

				//user post url
				//refer to http://codex.wordpress.org/Function_Reference/get_author_posts_url
				$userposturl = get_author_posts_url($userid);

				?>

				<!--Now we print out speciifc user informations to screen!-->
				<div class='specific_user'>
				<a href='<?php echo $userposturl; ?>' title='<?php echo $userinfo->display_name; ?>'>
				<?php echo get_avatar($userid,58); ?>
				</a>
				<strong>
				<a href='<?php echo $userposturl; ?>' title='<?php echo $userinfo->display_name; ?>' class='featured_user_name'>
				<?php echo $userinfo->display_name; ?>
				</a></strong>
				<?php echo $userbio; ?>
				<div class="clear"></div>
				</div>
				<!--end-->

				<?php

				echo '</div>';
				echo $after_widget;

		 }//end of function widget



		//function to update widget setting
		function update( $new_instance, $old_instance ) {

				$instance = $old_instance;
				$instance['title'] = strip_tags( $new_instance['title'] );
				$instance['user_id'] = strip_tags( $new_instance['user_id'] );
				return $instance;

		}//end of function update


		//function to create Widget Admin form
		function form($instance) {

				$instance = wp_parse_args( (array) $instance, array( 'title' => '','user_id' => '') );

				$instance['title'] = $instance['title'];
				$instance['user_id'] = $instance['user_id'];

				?>

				<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'designcrumbs'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>"
				 type="text" value="<?php echo $instance['title']; ?>" />
				</p>

				<p>
				<label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e('Select User:', 'designcrumbs'); ?></label>
				<select id="<?php echo $this->get_field_id( 'user_id' );?>" name="<?php echo $this->get_field_name( 'user_id' );?>" class="widefat" style="width:100%;">

				<?php
				$instance = $instance['user_id'];
				$option_list = user_get_users_list_option($instance);
				echo $option_list;
				?>
				</select>

				</p>


				<?php

	      }//end of function form($instance)

}//end of  Class

//function to get all users
function user_get_users_list_option($instance){
$output = '';
global $wpdb;
$users = $wpdb->get_results("SELECT display_name, ID FROM $wpdb->users");
	foreach($users as $u){
    $uname = $u->display_name;
    $uid = $u->ID;
    $output .="<option value='$uid'";
    if($instance == $uid){
    $output.= 'selected="selected"';
    }
    $output.= ">$uname</option>";
	}
return $output;
}

register_widget('featured_user_widget');

/* =================================== Recent Posts Widget =================================== */

class WP_stored_Widget_Recent_Posts extends WP_Widget {

    function WP_stored_Widget_Recent_Posts() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( 'Displays a grid of thumbnails of your latest products.', 'designcrumbs') );
        parent::__construct('my-recent-posts', __('New Products', 'designcrumbs'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('widget_my_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( isset($cache[$args['widget_id']]) ) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('New Products', 'designcrumbs') : $instance['title'], $instance, $this->id_base);
        if ( !$number = (int) $instance['number'] )
            $number = 9;
        else if ( $number < 1 )
            $number = 1;
        else if ( $number > 15 )
            $number = 15;

		if (of_get_option('affiliate_mode') != 'no' || ! defined( 'CC_VERSION_NUMBER' ) ) { // if affiliate mode is on
	        $r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'post_type' => 'products'));
	    } else {
		    $r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'post_type' => 'cc_product'));
	    }
        if ($r->have_posts()) :
?>
        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <div id="recent_products">
        <?php  while ($r->have_posts()) : $r->the_post(); ?>
        	<?php if (has_post_thumbnail()) { ?>
        	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'archive_image', array( 'alt' => get_the_title()) ); ?>
			</a>
			<?php } ?>
        <?php endwhile; ?>
        	<div class="clear"></div>
        </div>
        <?php echo $after_widget; ?>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_my_recent_posts', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {
        wp_cache_delete('widget_my_recent_posts', 'widget');
    }

    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
            $number = 5;
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"<?php _e('Title:', 'designcrumbs'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'designcrumbs'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
    }
}

register_widget('WP_stored_Widget_Recent_Posts');

/* ====================================================== COMMENTS ====================================================== */

function custom_comment($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID( ); ?>">
<div class="the_comment">
<?php if(function_exists('get_avatar')) { echo get_avatar($comment, '50'); } ?>
<div class="the_comment_author"><?php comment_author_link() ?></div>
<small class="commentmetadata">
<?php comment_date('F d, Y') ?> <?php _e('at', 'designcrumbs'); ?> <?php comment_date('g:i a') ?><?php edit_comment_link( __('Edit', 'designcrumbs'),' &nbsp;|&nbsp; ',''); ?>
</small>
<div class="clear"></div>
<?php if ($comment->comment_approved == '0') : //message if comment is held for moderation ?>
<br><em><?php _e('Your comment is awaiting moderation.', 'designcrumbs'); ?>.</em><br>
<?php endif; ?>
	<div class="the_comment_text"><?php comment_text() ?></div>
<div class="reply">
<?php echo comment_reply_link(array('reply_text' => __('Reply', 'designcrumbs'), 'depth' => $depth, 'max_depth' => $args['max_depth']));  ?>
</div>
</div>
<?php } ?>
<?php function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID( ); ?>">
     <?php _e('Trackback from', 'designcrumbs'); ?> <em><?php comment_author_link() ?></em>
<br /><small><?php comment_date('l, j F, Y') ?></small>
<br /><?php comment_text() ?>
     <?php edit_comment_link( __('Edit', 'designcrumbs'),'<br /> &nbsp;|&nbsp; ',''); ?>
<?php }

/***************************************
 * Cart66 Cloud 2.0
 **************************************/
remove_filter( 'the_content', 'cc_filter_product_single' );

function str_split_unicode($str, $l = 0) {
	if ($l > 0) {
		$ret = array();
		$len = mb_strlen($str, "UTF-H");
		for ($i = 0; $i < $len; $i += $l) {
			$ret[] = mb_substr($str, $i, $l, "UTF-8");
		}
		return $ret;
	}
	return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

function split_money($string) {
  $money = new stdClass;
  $money->currency = '';
  $money->dollar = '';
  $money->decimal = '';
  $money->cents = '';

  $chars = str_split_unicode($string);
  $length = count($chars);
  $i = 0;

  // Look for currency symbol
  if(!is_numeric($chars[$i])) {
    $money->currency = $chars[$i];
    $i++;
  }

  if ( isset( $chars[$i] ) ) {
	  // Collect the dollar amount
	  while(is_numeric($chars[$i])) {
	    $money->dollar .= $chars[$i];
	    $i++;
	  }
 }

  if ( isset( $chars[$i] ) ) {
	  // Collect the decimal separator
	  $money->decimal = $chars[$i];
	  $i++;
  }

  if ( isset( $chars[$i] ) ) {
	  // Collect the cents
	  while($i < $length) {
	    $money->cents .= $chars[$i];
	    $i++;
	  }
	}

  return $money;
}

function dc_cart_total() {
	if(class_exists('CC_Cart')) {
		$item_count = CC::cart_item_count();
	}
	if(empty($item_count)) {
		$item_count = 0;
	}
	return $item_count;
}

function dc_ajax_cart_update() {
	if(class_exists('CC_Cart')) {
		$item_count = CC::cart_item_count();
		echo $item_count;
	}
	die();
}
add_action('wp_ajax_nopriv_dc_ajax_cart_update', 'dc_ajax_cart_update');
add_action('wp_ajax_dc_ajax_cart_update', 'dc_ajax_cart_update');

function apply_money_styles($price) {
	$money = split_money($price);
	$css = '<span class="Cart66CurrencySymbol Cart66CurrencySymbolbefore">' . $money->currency . '</span>';
	$css .= '<span class="Cart66PreDecimal">' . $money->dollar . '</span>';
	$css .= '<span class="Cart66DecimalSep">' . $money->decimal . '</span>';
	$css .= '<span class="Cart66PostDecimal">' . $money->cents . '</span>';
	return $css;
}

/* =================================== Hide the Cart66 Cloud Shortcodes on Product Pages =================================== */

add_action('admin_head', 'dcs_hide_cc_shortcode');

function dcs_hide_cc_shortcode() {
	global $post;
	$post_type = get_post_type($post);
	if($post_type == 'cc_product') {
		echo '<style>
		#cc_product_shortcodes {
			display:none;
		}
		</style>';
	}
}