<?php
/**
 * Road Themes functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */

//Require plugins
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

function road_register_required_plugins() {

    $plugins = array(
		array(
            'name'               => 'RoadThemes Helper',
            'slug'               => 'roadthemes-helper',
            'source'             => get_stylesheet_directory() . '/plugins/roadthemes-helper.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),
		array(
            'name'               => 'Mega Main Menu',
            'slug'               => 'mega_main_menu',
            'source'             => 'http://demo.roadthemes.com/plugins/mega_main_menu.zip',
            'required'           => true,
            'external_url'       => '',
        ),
		array(
            'name'               => 'Revolution Slider',
            'slug'               => 'revslider',
            'source'             => 'http://demo.roadthemes.com/plugins/revslider.zip',
            'required'           => true,
            'external_url'       => '',
        ),
        array(
            'name'               => 'Visual Composer',
            'slug'               => 'js_composer',
            'source'             => 'http://demo.roadthemes.com/plugins/js_composer.zip',
            'required'           => true,
            'external_url'       => '',
        ),
		
        // Plugins from the WordPress Plugin Repository.
		array(
            'name'               => 'Redux Framework',
            'slug'               => 'redux-framework',
            'required'           => true,
			'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
		array(
            'name'      => 'MailPoet Newsletters',
            'slug'      => 'wysija-newsletters',
            'required'  => true,
        ),
		array(
            'name'      => 'Rotating Tweets',
            'slug'      => 'rotatingtweets',
            'required'  => true,
        ),
		array(
            'name'      => 'Shortcodes Ultimate',
            'slug'      => 'shortcodes-ultimate',
            'required'  => true,
        ),
		array(
            'name'      => 'Simple Local Avatars',
            'slug'      => 'simple-local-avatars',
            'required'  => false,
        ),
		array(
            'name'      => 'Testimonials',
            'slug'      => 'testimonials-by-woothemes',
            'required'  => true,
        ),
		array(
            'name'      => 'TinyMCE Advanced',
            'slug'      => 'tinymce-advanced',
            'required'  => false,
        ),
		array(
            'name'      => 'Widget Importer & Exporter',
            'slug'      => 'widget-importer-exporter',
            'required'  => false,
        ),
		array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => true,
        ),
		array(
            'name'      => 'YITH WooCommerce Compare',
            'slug'      => 'yith-woocommerce-compare',
            'required'  => true,
        ),
		array(
            'name'      => 'YITH WooCommerce Wishlist',
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => true,
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'road_register_required_plugins' ); 
 
//Init the Redux Framework
if ( class_exists( 'ReduxFramework' ) && !isset( $redux_demo ) && file_exists( get_template_directory().'/theme-config.php' ) ) {
    require_once( get_template_directory().'/theme-config.php' );
}

//Add Woocommerce support
add_theme_support( 'woocommerce' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

//Override woocommerce widgets
function road_override_woocommerce_widgets() {
	//Show mini cart on all pages
	if ( class_exists( 'WC_Widget_Cart' ) ) {
		unregister_widget( 'WC_Widget_Cart' ); 
		include_once( 'woocommerce/class-wc-widget-cart.php' );
		register_widget( 'Custom_WC_Widget_Cart' );
	}
}
add_action( 'widgets_init', 'road_override_woocommerce_widgets', 15 );

//Change price html
function road_woo_price_html( $price, $product ){

	if($product->product_type=="variable") {
		if($product->get_variation_sale_price() && $product->get_variation_regular_price()!=$product->get_variation_sale_price()){
			$rprice = $product->get_variation_regular_price();
			$sprice = $product->get_variation_sale_price();
			
			return '<span class="special-price">'.( ( is_numeric( $sprice ) ) ? woocommerce_price( $sprice ) : $sprice ) .'</span><span class="old-price">'. ( ( is_numeric( $rprice ) ) ? woocommerce_price( $rprice ) : $rprice ) .'</span>';
		} else {
			$rprice = $product->get_variation_regular_price();
			return '<span class="special-price">' . ( ( is_numeric( $rprice ) ) ? woocommerce_price( $rprice ) : $rprice ) . '</span>';
		}
	}
    if ( $product->price > 0 ) {
		if ( $product->price && isset( $product->regular_price ) && ( $product->price!=$product->regular_price )) {
        $rprice = $product->regular_price;
        $sprice = $product->price;
        return '<span class="special-price">'.( ( is_numeric( $sprice ) ) ? woocommerce_price( $sprice ) : $sprice ) .'</span><span class="old-price">'. ( ( is_numeric( $rprice ) ) ? woocommerce_price( $rprice ) : $rprice ) .'</span>';
		} else {
        $sprice = $product->price;
        return '<span class="special-price">' . ( ( is_numeric( $sprice ) ) ? woocommerce_price( $sprice ) : $sprice ) . '</span>';
		}
	} else {
		return '<span class="special-price">0</span>';
	}
}
add_filter( 'woocommerce_get_price_html', 'road_woo_price_html', 100, 2 );

// Add image to category description
function road_woocommerce_category_image() {
	if ( is_product_category() ){
		global $wp_query;
		
		$cat = $wp_query->get_queried_object();
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image = wp_get_attachment_url( $thumbnail_id );
		
		if ( $image ) {
			echo '<p class="category-image-desc"><img src="' . esc_url($image) . '" alt="" /></p>';
		}
	}
}
add_action( 'woocommerce_archive_description', 'road_woocommerce_category_image', 2 );

// Change products per page
function road_woo_change_per_page() {
	global $road_opt;
	
	return $road_opt['product_per_page'];
}
add_filter( 'loop_shop_per_page', 'road_woo_change_per_page', 20 );

//Limit number of products by shortcode [products]
add_filter( 'woocommerce_shortcode_products_query', 'road_woocommerce_shortcode_limit' );
function road_woocommerce_shortcode_limit( $args ) {
	global $road_opt, $road_productsfound;
	
	$road_productsfound = new WP_Query($args);
	$road_productsfound = $road_productsfound->post_count;
	
	return $args;
}

//Change number of related products on product page. Set your own value for 'posts_per_page'
function road_woo_related_products_limit( $args ) {
	global $product, $road_opt;
	$args['posts_per_page'] = $road_opt['related_amount'];

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'road_woo_related_products_limit' );

//move message to top
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
add_action( 'woocommerce_show_message', 'wc_print_notices', 10 );

//remove cart total under cross sell
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

//Single product organize
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );

//Display stock status on product page
function road_product_stock_status(){
	global $product;
	?>
	<div class="stock-status">
		<?php if($product->is_in_stock()){ ?>
			<p><?php _e('In stock', 'roadthemes');?></p>
		<?php } else { ?>
			<p><?php _e('Out of stock', 'roadthemes');?></p>
		<?php } ?>
	</div>
	<?php
}
add_action( 'woocommerce_single_product_summary', 'road_product_stock_status', 15 );


//Project organize
remove_action( 'projects_before_single_project_summary', 'projects_template_single_title', 10 );
add_action( 'projects_single_project_summary', 'projects_template_single_title', 5 );
remove_action( 'projects_before_single_project_summary', 'projects_template_single_short_description', 20 );
remove_action( 'projects_before_single_project_summary', 'projects_template_single_gallery', 40 );
add_action( 'projects_single_project_gallery', 'projects_template_single_gallery', 40 );
//projects list
remove_action( 'projects_loop_item', 'projects_template_loop_project_title', 20 );

//Change search form
function road_search_form( $form ) {
	if(get_search_query()!=''){
		$search_str = get_search_query();
	} else {
		$search_str = __( 'Search...', 'roadthemes' );
	}
	
	$form = '<form role="search" method="get" id="blogsearchform" class="searchform" action="' . esc_url(home_url( '/' ) ). '" >
	<div class="form-input">
		<input class="input_text" type="text" value="'.esc_attr($search_str).'" name="s" id="search_input" />
		<button class="button" type="submit" id="blogsearchsubmit"><i class="fa fa-search"></i></button>
		<input type="hidden" name="post_type" value="post" />
		</div>
	</form>';
	$form .= '<script type="text/javascript">';
	$form .= 'jQuery(document).ready(function(){
		jQuery("#search_input").focus(function(){
			if(jQuery(this).val()=="'.__( 'Search...', 'roadthemes' ).'"){
				jQuery(this).val("");
			}
		});
		jQuery("#search_input").focusout(function(){
			if(jQuery(this).val()==""){
				jQuery(this).val("'.__( 'Search...', 'roadthemes' ).'");
			}
		});
		jQuery("#blogsearchsubmit").click(function(){
			if(jQuery("#search_input").val()=="'.__( 'Search...', 'roadthemes' ).'" || jQuery("#search_input").val()==""){
				jQuery("#search_input").focus();
				return false;
			}
		});
	});';
	$form .= '</script>';
	return $form;
}
add_filter( 'get_search_form', 'road_search_form' );

//Change woocommerce search form
function road_woo_search_form( $form ) {
	global $wpdb;
	
	if(get_search_query()!=''){
		$search_str = get_search_query();
	} else {
		$search_str = __( 'Search product...', 'roadthemes' );
	}
	
	$form = '<form role="search" method="get" id="searchform" action="'.esc_url( home_url( '/'  ) ).'">';
		$form .= '<div>';
			$form .= '<input type="text" value="'.esc_attr($search_str).'" name="s" id="ws" placeholder="" />';
			$form .= '<button class="btn btn-primary" type="submit" id="wsearchsubmit"><i class="fa fa-search"></i></button>';
			$form .= '<input type="hidden" name="post_type" value="product" />';
		$form .= '</div>';
	$form .= '</form>';
	$form .= '<script type="text/javascript">';
	$form .= 'jQuery(document).ready(function(){
		jQuery("#ws").focus(function(){
			if(jQuery(this).val()=="'.__( 'Search product...', 'roadthemes' ).'"){
				jQuery(this).val("");
			}
		});
		jQuery("#ws").focusout(function(){
			if(jQuery(this).val()==""){
				jQuery(this).val("'.__( 'Search product...', 'roadthemes' ).'");
			}
		});
		jQuery("#wsearchsubmit").click(function(){
			if(jQuery("#ws").val()=="'.__( 'Search product...', 'roadthemes' ).'" || jQuery("#ws").val()==""){
				jQuery("#ws").focus();
				return false;
			}
		});
	});';
	$form .= '</script>';
	return $form;
}
add_filter( 'get_product_search_form', 'road_woo_search_form' );

// Replaces the excerpt "more" text by a link
function road_new_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'road_new_excerpt_more');

//Change excerpt length
function road_change_excerpt_length( $length ) {
	global $road_opt;
	
	if(isset($road_opt['excerpt_length'])){
		return $road_opt['excerpt_length'];
	}
	
	return 22;
}
add_filter( 'excerpt_length', 'road_change_excerpt_length', 999 );

//Add 'first, last' class to menu
function road_first_and_last_menu_class($items) {
	$items[1]->classes[] = 'first';
	$items[count($items)]->classes[] = 'last';
	return $items;
}
add_filter('wp_nav_menu_objects', 'road_first_and_last_menu_class');

//Add first, last class to widgets
function road_widget_first_last_class($params) {
    global $my_widget_num;
	
	$class = '';
	
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= ' widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= ' widget-last ';
	}
	
    $params[0]['before_widget'] = str_replace('first_last', ' '.$class.' ', $params[0]['before_widget']);
	
    return $params;
}
add_filter('dynamic_sidebar_params', 'road_widget_first_last_class');

//Change mega menu widget from div to li tag
function road_mega_menu_widget_change($params) {
	
	$sidebar_id = $params[0]['id'];
	
	$pos = strpos($sidebar_id, '_menu_widgets_area_');
	
	if ( !$pos == false ) {
		$params[0]['before_widget'] = '<li class="widget_menu">'.$params[0]['before_widget'];
		$params[0]['after_widget'] = $params[0]['after_widget'].'</li>';
    }
	
    return $params;
}
add_filter('dynamic_sidebar_params', 'road_mega_menu_widget_change');

// Push sidebar widget content into a div
function road_put_widget_content( $params ) {
    global $wp_registered_widgets;

	if( $params[0]['id']=='sidebar-category' ){
		$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
		$settings = $settings_getter->get_settings();
		$settings = $settings[ $params[1]['number'] ];
		
		if($params[0]['widget_name']=="Text" && isset($settings['title']) && $settings['text']=="") { // if text widget and no content => don't push content
			return $params;
		}
		if( isset($settings['title']) && $settings['title']!='' ){
			$params[0][ 'after_title' ] .= '<div class="widget_content">';
			$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
		} else {
			$params[0][ 'before_widget' ] .= '<div class="widget_content">';
			$params[0][ 'after_widget' ] = '</div>'.$params[0][ 'after_widget' ];
		}
	}
	
	return $params;
}
add_filter( 'dynamic_sidebar_params', 'road_put_widget_content' );

//Add breadcrumbs
function road_breadcrumb() {
	global $post, $road_opt;
	
	$brseparator = '<span class="separator">/</span>';
    if (!is_home()) {
		echo '<div class="breadcrumbs">';
		
        echo '<a href="';
        echo home_url();
        echo '">';
        echo 'Home';
        echo '</a>'.$brseparator;
        if (is_category() || is_single()) {
            the_category($brseparator);
            if (is_single()) {
                echo $brseparator;
                the_title();
            }
        } elseif (is_page()) {
            if($post->post_parent){
				$anc = get_post_ancestors( $post->ID );
				$title = get_the_title();
				foreach ( $anc as $ancestor ) {
					$output = '<a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a>'.$brseparator;
				}
				echo $output;
				echo '<span title="'.$title.'"> '.$title.'</span>';
			} else {
				echo '<span> '.get_the_title().'</span>';
			}
        }
		elseif (is_tag()) {single_tag_title();}
		elseif (is_day()) {echo"<span>Archive for "; the_time('F jS, Y'); echo'</span>';}
		elseif (is_month()) {echo"<span>Archive for "; the_time('F, Y'); echo'</span>';}
		elseif (is_year()) {echo"<span>Archive for "; the_time('Y'); echo'</span>';}
		elseif (is_author()) {echo"<span>Author Archive"; echo'</span>';}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>Blog Archives"; echo'</span>';}
		elseif (is_search()) {echo"<span>Search Results"; echo'</span>';}
		
		echo '</div>';
	} else {
		echo '<div class="breadcrumbs">';
		
        echo '<a href="';
        echo home_url();
        echo '">';
        echo 'Home';
        echo '</a>'.$brseparator;
		
		if(isset($road_opt['blog_header_text']) && $road_opt['blog_header_text']!=""){
			echo esc_html($road_opt['blog_header_text']);
		} else {
			echo 'Blog';
		}
		
		echo '</div>';
	}
}
function roadlimitStringByWord ($string, $maxlength, $suffix = '') {

	if(function_exists( 'mb_strlen' )) {
		// use multibyte functions by Iysov
		if(mb_strlen( $string )<=$maxlength) return $string;
		$string = mb_substr( $string, 0, $maxlength );
		$index = mb_strrpos( $string, ' ' );
		if($index === FALSE) {
			return $string;
		} else {
			return mb_substr( $string, 0, $index ).$suffix;
		}
	} else { // original code here
		if(strlen( $string )<=$maxlength) return $string;
		$string = substr( $string, 0, $maxlength );
		$index = strrpos( $string, ' ' );
		if($index === FALSE) {
			return $string;
		} else {
			return substr( $string, 0, $index ).$suffix;
		}
	}
}

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Road Themes setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Road Themes supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Road Themes 1.0
 */
function road_setup() {
	/*
	 * Makes Road Themes available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Road Themes, use a find and replace
	 * to change 'roadthemes' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'roadthemes', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );

	// Register menus
	register_nav_menu( 'primary', __( 'Primary Menu', 'roadthemes' ) );
	register_nav_menu( 'mobilemenu', __( 'Mobile Menu', 'roadthemes' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 1170, 9999 ); // Unlimited height, soft crop
	add_image_size( 'category-thumb', 800, 600, true ); // (cropped)
	add_image_size( 'post-thumb', 570, 350, true ); // (cropped)
	add_image_size( 'post-thumbwide', 370, 245, true ); // (cropped)
}
add_action( 'after_setup_theme', 'road_setup' );


/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Road Themes 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function road_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'roadthemes' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'roadthemes' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since Road Themes 1.0
 */
function road_scripts_styles() {
	global $wp_styles, $wp_scripts, $road_opt;
	
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	*/
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	// Add Bootstrap JavaScript
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.2.0', true );
	
	// Add Slick files
	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick/slick.min.js', array('jquery'), '1.3.15', true );
	wp_enqueue_style( 'slick-style', get_template_directory_uri() . '/js/slick/slick.css', array(), '1.3.15' );
	
	// Add OwlCarousel files
	/* wp_enqueue_style( 'olwcarousel-style', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array(), '1.3.2' );
	wp_enqueue_style( 'olwcarousel-theme', get_template_directory_uri() . '/js/owl-carousel/owl.theme.css', array(), '1.3.2' );
	wp_enqueue_script( 'olwcarousel-js', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array('jquery'), '1.3.2', true ); */
	
	// Add Chosen js files
	wp_enqueue_script( 'chosen-js', get_template_directory_uri() . '/js/chosen/chosen.jquery.min.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'chosenproto-js', get_template_directory_uri() . '/js/chosen/chosen.proto.min.js', array('jquery'), '1.3.0', true );
	wp_enqueue_style( 'chosen-style', get_template_directory_uri() . '/js/chosen/chosen.min.css', array(), '1.3.0' );
	
	// Add parallax script files
	
	// Add Fancybox
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true );
	wp_enqueue_script( 'fancybox-buttons', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-buttons.js', array('jquery'), '1.0.5', true );
	wp_enqueue_script( 'fancybox-media', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-media.js', array('jquery'), '1.0.6', true );
	wp_enqueue_script( 'fancybox-thumbs', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-thumbs.js', array('jquery'), '1.0.7', true );
	wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css', array(), '2.1.5' );
	wp_enqueue_style( 'fancybox-buttons', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-buttons.css', array(), '1.0.5' );
	wp_enqueue_style( 'fancybox-thumbs', get_template_directory_uri() . '/js/fancybox/helpers/jquery.fancybox-thumbs.css', array(), '1.0.7' );
	
	//Superfish
	wp_enqueue_script( 'superfish-js', get_template_directory_uri() . '/js/superfish/superfish.min.js', array('jquery'), '1.3.15', true );
	
	//Add Twitter js
	wp_enqueue_script( 'twitter-js', 'http://platform.twitter.com/widgets.js', array('jquery'), '', true );
	
	//Add Shuffle js
	wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/modernizr.custom.min.js', array('jquery'), '2.6.2', true );
	wp_enqueue_script( 'shuffle-js', get_template_directory_uri() . '/js/jquery.shuffle.min.js', array('jquery'), '3.0.0', true );

	//Add mousewheel
	wp_enqueue_script( 'mousewheel-js', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'), '3.1.12', true );
	
	// Add jQuery countdown file
	wp_enqueue_script( 'countdown-js', get_template_directory_uri() . '/js/jquery.countdown.min.js', array('jquery'), '2.0.4', true );
	
	// Add theme.js file
	wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '20140826', true );

	$font_url = road_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'roadthemes-fonts', esc_url_raw( $font_url ), array(), null );

	// Loads our main stylesheet.
	wp_enqueue_style( 'roadthemes-style', get_stylesheet_uri() );

	// Load fontawesome css
	wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.2.0' );
	
	// Load bootstrap css
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.2.0' );
	
	// Compile Less to CSS
	$previewpreset = (isset($_REQUEST['preset']) ? $_REQUEST['preset'] : null);
		//get preset from url (only for demo/preview)
	if($previewpreset){
		$_SESSION["preset"] = $previewpreset;
	}
	if(!isset($_SESSION["preset"])){
		$_SESSION["preset"] = 1;
	}
	if($_SESSION["preset"] != 1) {
		$presetopt = $_SESSION["preset"];
	} else { /* if no preset varialbe found in url, use from theme options */
		$presetopt = $road_opt['preset_option'];
	}
	if(!isset($presetopt)) $presetopt = 1; /* in case first time install theme, no options found */
	
	if($road_opt['enable_less']){
		$themevariables = array(
			'heading_font'=> $road_opt['headingfont']['font-family'],
			'menu_font'=> $road_opt['menufont']['font-family'],
			'body_font'=> $road_opt['bodyfont']['font-family'],
			'heading_color'=> $road_opt['headingfont']['color'],
			'menu_color'=> $road_opt['menufont']['color'],
			'text_color'=> $road_opt['bodyfont']['color'],
			'primary_color' => $road_opt['primary_color'],
			'secondary_color' => $road_opt['secondary_color'],
			'sale_color' => $road_opt['sale_color'],
			'saletext_color' => $road_opt['saletext_color'],
			'rate_color' => $road_opt['rate_color'],
		);
		switch ($presetopt) {
			case 2:
				$themevariables['primary_color'] = '#f57d65';
			break;
		}
		if(function_exists('compileLessFile')){
			compileLessFile('theme.less', 'theme'.$presetopt.'.css', $themevariables);
			compileLessFile('ie.less', 'ie'.$presetopt.'.css', $themevariables);
		}
	}
	
	// Load main theme css style
	wp_enqueue_style( 'roadthemes-css', get_template_directory_uri() . '/css/theme'.$presetopt.'.css', array(), '1.0.0' );
	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'roadthemes-ie', get_template_directory_uri() . '/css/ie'.$presetopt.'.css', array( 'roadthemes-style' ), '20121010' );
	$wp_styles->add_data( 'roadthemes-ie', 'conditional', 'lte IE 9' );
	
	if($road_opt['enable_sswitcher']){
	// Add styleswitcher.js file
	wp_enqueue_script( 'styleswitcher-js', get_template_directory_uri() . '/js/styleswitcher.js', array(), '20140826', false );
	// Load styleswitcher css style
	wp_enqueue_style( 'styleswitcher-css', get_template_directory_uri() . '/css/styleswitcher.css', array(), '1.0.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'road_scripts_styles' );

//add custom css, sharing code to header
function road_custom_code_header() {
	global $road_opt;

	if ( isset($road_opt['custom_css']) && $road_opt['custom_css']!='') { ?>
		<style><?php echo esc_html($road_opt['custom_css']); ?></style>
	<?php }
}
add_action( 'wp_head', 'road_custom_code_header');


//Include
if ( !class_exists( 'road_widgets' ) && file_exists( get_template_directory().'/include/roadwidgets.php' ) ) {
    require_once( get_template_directory().'/include/roadwidgets.php' );
}
if ( file_exists( get_template_directory().'/include/styleswitcher.php' ) ) {
    require_once( get_template_directory().'/include/styleswitcher.php' );
}
if ( file_exists( get_template_directory().'/include/wooajax.php' ) ) {
    require_once( get_template_directory().'/include/wooajax.php' );
}
if ( file_exists( get_template_directory().'/include/shortcodes.php' ) ) {
    require_once( get_template_directory().'/include/shortcodes.php' );
}

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses road_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Road Themes 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function road_mce_css( $mce_css ) {
	$font_url = road_get_font_url();

	if ( empty( $font_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'road_mce_css' );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Road Themes 1.0
 */
function road_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'road_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Road Themes 1.0
 */
function road_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'roadthemes' ),
		'id' => 'sidebar-1',
		'description' => __( 'Sidebar on blog page', 'roadthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Category Sidebar', 'roadthemes' ),
		'id' => 'sidebar-category',
		'description' => __( 'Sidebar on product category page', 'roadthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Pages Sidebar', 'roadthemes' ),
		'id' => 'sidebar-page',
		'description' => __( 'Sidebar on content pages', 'roadthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
}
add_action( 'widgets_init', 'road_widgets_init' );

if ( ! function_exists( 'road_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Road Themes 1.0
 */
function road_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'roadthemes' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'roadthemes' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'roadthemes' ) ); ?></div>
		</nav>
	<?php endif;
}
endif;

if ( ! function_exists( 'road_pagination' ) ) :
/* Pagination */
function road_pagination() {
	global $wp_query;

	$big = 999999999; // need an unlikely integer
	
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'prev_text'    => __('Previous', 'roadthemes'),
		'next_text'    =>__('Next', 'roadthemes'),
	) );
}
endif;

if ( ! function_exists( 'road_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own road_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Road Themes 1.0
 */
function road_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'roadthemes' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'roadthemes' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 50 ); ?>
			</div>
			<div class="comment-info">
				<header class="comment-meta comment-author vcard">
					<?php
						
						printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'roadthemes' ) . '</span>' : ''
						);
						printf( '<time datetime="%1$s">%2$s</time>',
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'roadthemes' ), get_comment_date(), get_comment_time() )
						);
					?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'roadthemes' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
				</header><!-- .comment-meta -->
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'roadthemes' ); ?></p>
				<?php endif; ?>

				<section class="comment-content comment">
					<?php comment_text(); ?>
					<?php edit_comment_link( __( 'Edit', 'roadthemes' ), '<p class="edit-link">', '</p>' ); ?>
				</section><!-- .comment-content -->
			</div>
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;


if ( ! function_exists( 'before_comment_fields' ) &&  ! function_exists( 'after_comment_fields' )) :
//Change comment form
function road_before_comment_fields() {
	echo '<div class="comment-input">';
}
add_action('comment_form_before_fields', 'road_before_comment_fields');

function road_after_comment_fields() {
	echo '</div>';
}
add_action('comment_form_after_fields', 'road_after_comment_fields');

endif;

if ( ! function_exists( 'road_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own road_entry_meta() to override in a child theme.
 *
 * @since Road Themes 1.0
 */
function road_entry_meta() {
	
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'roadthemes' ) );

	$num_comments = (int)get_comments_number();
	$write_comments = '';
	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __('0 comments', 'roadthemes');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' comments', 'roadthemes');
		} else {
			$comments = __('1 comment', 'roadthemes');
		}
		$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	}
	
	$post_date = get_the_date('H:i A F j, Y');

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'roadthemes' ), get_the_author() ) ),
		get_the_author()
	);
	
	$utility_text = __( 'Posted by %1$s %2$s %3$s', 'roadthemes' );

	printf( $utility_text, $author, $post_date, $write_comments);
}
endif;

function road_entry_meta_small() {
	
	// Translators: used between list items, there is a space after the comma.
	$post_date = get_the_date('d M');

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'roadthemes' ), get_the_author() ) ),
		get_the_author()
	);
	
	$utility_text = __( '<i class="fa fa-clock-o"></i>%1$s / Posted by %2$s', 'roadthemes' );

	printf( $utility_text, $post_date, $author );
	
}

function road_entry_comments() {
	
	$date = sprintf( '<time class="entry-date" datetime="%3$s">%4$s</time>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$num_comments = (int)get_comments_number();
	$write_comments = '';
	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __('<span>0</span> comments', 'roadthemes');
		} elseif ( $num_comments > 1 ) {
			$comments = '<span>'.$num_comments .'</span>'. __(' comments', 'roadthemes');
		} else {
			$comments = __('<span>1</span> comment', 'roadthemes');
		}
		$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	}
	
	$utility_text = __( '%1$s', 'roadthemes' );
	
	printf( $utility_text, $write_comments );
}

function road_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'road_post_intro_section',
			__( 'Post featured content', 'roadthemes' ),
			'road_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'road_add_meta_box' );

function road_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'road_meta_box', 'road_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_road_meta_value_key', true );

	echo '<label for="road_post_intro">';
	_e( 'This content will be used to replace the featured image, use shortcode here', 'roadthemes' );
	echo '</label><br />';
	//echo '<textarea id="road_post_intro" name="road_post_intro" rows="5" cols="50" />' . esc_attr( $value ) . '</textarea>';
	wp_editor( $value, 'road_post_intro', $settings = array() );
	
	
}

function road_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['road_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['road_meta_box_nonce'], 'road_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['road_post_intro'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['road_post_intro'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_road_meta_value_key', $my_data );
}
add_action( 'save_post', 'road_save_meta_box_data' );

/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Road Themes 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function road_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'road_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Road Themes 1.0
 */
function road_customize_preview_js() {
	wp_enqueue_script( 'roadthemes-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}
add_action( 'customize_preview_init', 'road_customize_preview_js' );