<?php

$geode_theme_data = wp_get_theme(get_option('template'));
$geode_theme_version = $geode_theme_data->Version;  
$geode_theme_base = get_option('template');

$geode_api_url = 'http://www.pixedelic.com/api/';

if ( ! isset( $content_width ) )
    $content_width = get_option('pix_style_layout_width') - 200;

/**
* Load localization files
*/
$geode_languages = ABSPATH . 'wp-content/geode-includes/languages';
if ( is_dir($geode_languages) ) {
	load_theme_textdomain( 'geode', $geode_languages );
	$locale = get_locale();
	$locale_file = $geode_languages . "/$locale.php";
} else {
	load_theme_textdomain( 'geode', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
}
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

if ( !function_exists('geode_register_required_plugins')) :
/**
* Required plugins
* @since Geode 1.7.6
*/
add_action( 'tgmpa_register', 'geode_register_required_plugins' );
function geode_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'PixGridder Pro',
			'slug'     				=> 'pixgridder-pro',
			'source'   				=> get_stylesheet_directory() . '/functions/plugins/pixgridder-pro.zip',
			'required' 				=> true,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'Shortcodelic',
			'slug'     				=> 'shortcodelic',
			'source'   				=> get_stylesheet_directory() . '/functions/plugins/shortcodelic.zip',
			'required' 				=> true,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'Shortcodelic Addons',
			'slug'     				=> 'shortcodelic-addons',
			'source'   				=> get_stylesheet_directory() . '/functions/plugins/shortcodelic-addons.zip',
			'required' 				=> true,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'PixMenu',
			'slug'     				=> 'pixmenu',
			'source'   				=> get_stylesheet_directory() . '/functions/plugins/pixmenu.zip',
			'required' 				=> true,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'Indeed My Team',
			'slug'     				=> 'indeed-my-team',
			'source'   				=> get_stylesheet_directory() . '/functions/plugins/indeed-my-team.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'Indeed My Testimonials',
			'slug'     				=> 'indeed-my-testimonials',
			'source'   				=> get_stylesheet_directory() . '/functions/plugins/indeed-my-testimonials.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Really Simple CAPTCHA',
			'slug' 		=> 'really-simple-captcha',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Contact Form 7 Honeypot',
			'slug' 		=> 'contact-form-7-honeypot',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Black Studio TinyMCE Widget',
			'slug' 		=> 'black-studio-tinymce-widget',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Remove Widget Titles',
			'slug' 		=> 'remove-widget-titles',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Widget Importer & Exporter',
			'slug' 		=> 'widget-importer-exporter',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'WooCommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'YITH WooCommerce Wishlist',
			'slug' 		=> 'yith-woocommerce-wishlist',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'YITH WooCommerce Compare',
			'slug' 		=> 'yith-woocommerce-compare',
			'required' 	=> false,
		)

	);

	$config = array(
		'id'           => 'geode',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );

}
endif;

if ( !function_exists('register_geode_menus')) :
/**
* Register menu locations
* @since Geode 1.0
*/
add_action( 'init', 'register_geode_menus' );
function register_geode_menus() {
	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'geode' ),
			'mobile' => __( 'Mobile menu', 'geode' )
		)
	);
}
endif;

if ( !function_exists('pix_mime_types')) :
/**
* Allow SVGs
* @since Geode 1.0
*/
add_filter( 'upload_mimes', 'pix_mime_types' );
function pix_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
endif;

if ( !function_exists('pix_widgets_init')) :
/**
* Default sidebars
* @since Geode 1.0
*/
add_action( 'widgets_init', 'pix_widgets_init' );
function pix_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Geode default sidebar', 'geode' ),
		'id' => 'geode_default_sidebar',
		'description' => 'A default sidebar for Geode pages and posts',
		'before_widget' => '<div data-id="%1$s" class="pix_widget ' . apply_filters('geode_fx_onscroll','') . ' cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	) );

	register_sidebar( array(
		'name' => __( 'Geode default sidebar 2', 'geode' ),
		'id' => 'geode_default_sidebar_2',
		'description' => 'A default sidebar for double sidebar templates',
		'before_widget' => '<div data-id="%1$s" class="pix_widget ' . apply_filters('geode_fx_onscroll','') .' cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	) );

	unregister_sidebar('sidebar-1');

}
endif;

if ( !function_exists('geode_compile_css_ajax')) :
/**
* The css compiler via AJAX.
* @since Geode 1.0
*/
add_action( 'wp_ajax_css_compile_ajax', 'geode_compile_css_ajax' );
function geode_compile_css_ajax() {

	WP_Filesystem();
	global $wp_filesystem, $blog_id;

	if ( is_multisite() && $blog_id > 1 ) {
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir['basedir'] .'/geode/';
		if (!is_dir($dir))
			@mkdir($dir);
		
		$css_file = $dir . 'css_compiled.css';
	} else {
		$css_file = get_template_directory().'/css/css_compiled.css';
	}

	$target_file = get_template_directory().'/css/css_compiler.php';

	ob_start();
	require($target_file);
	$css = ob_get_clean();

	$wp_filesystem->put_contents( $css_file, $css, FS_CHMOD_FILE );

    die();
}
endif;

if ( !function_exists('geode_compile_css_inline')) :
/**
 * Compile CSS inline.
 * @since Geode 1.0
 */
function geode_compile_css_inline() {

	$target_file = get_template_directory().'/css/css_compiler.php';
	ob_start();
	require($target_file);
	$css = ob_get_clean();
	return $css;

}
endif;

if ( !function_exists('update_google_font_ajax')) :
/**
 * Font list updater.
 * @since Geode 1.0
 */
add_action('wp_ajax_update_google_font_list', 'update_google_font_ajax');
function update_google_font_ajax() {

	$dir = WP_CONTENT_DIR .'/geode-includes/';
	if (!is_dir($dir))
		@mkdir($dir);
	
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	WP_Filesystem();
	global $wp_filesystem;

	if ( get_option('pix_content_google_api_key')!='' ) {
		$request_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key='.get_option('pix_content_google_api_key');
	} else {
		$request_url = 'http://www.pixedelic.com/api/google-fonts.php';
	}

	if (is_dir($dir))
		$font_list = $dir.'google-fonts.json';
	else
		$font_list = get_template_directory().'/font/google-fonts.json';

	$raw_response = wp_remote_get($request_url);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
		$body = $raw_response['body'];
		$wp_filesystem->put_contents( $font_list, $body, FS_CHMOD_FILE );
	}

    die();
}
endif;

if ( !function_exists('geode_load_font_variants')) :
/**
 * Font selector field updates.
 * @since Geode 1.0
 */
add_action('wp_ajax_load_font_variants', 'geode_load_font_variants');
function geode_load_font_variants() {

	$family = isset($_POST['family']) ? $_POST['family'] : '';
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$selected = isset($_POST['selected']) ? $_POST['selected'] : '';
    $selected_font = get_option('pix_style_fonts_w_variants'); ?>
	<?php _e('Font variant','geode'); ?>:
    <span class="for_select">
        <select id="<?php echo $name; ?>" name="<?php echo $name; ?>">
            <?php
                foreach ( $selected_font[$family]['variants'] as $fontvariant )
                { ?>
                <option value="<?php echo $fontvariant; ?>" <?php selected($selected,$fontvariant); ?>><?php echo $fontvariant; ?></option>
                <?php }
            ?>
        </select>
    </span>
<?php

    die();
}
endif;

if ( !function_exists('geode_load_font_subsets')) :
/**
 * Load font subsets via AJAX.
 * @since Geode 1.0
 */
add_action('wp_ajax_load_font_subsets', 'geode_load_font_subsets');
function geode_load_font_subsets() {

	$family = $_POST['family'];
	$name = $_POST['name'];
	$selected = $_POST['selected'];
    $selected_font = get_option('pix_style_fonts_w_variants'); ?>
	<?php _e('Font subset','geode'); ?>:
    <span class="for_select">
        <select id="<?php echo $name; ?>" name="<?php echo $name; ?>">
            <?php
                foreach ( $selected_font[$family]['subsets'] as $fontsubsets )
                { ?>
                <option value="<?php echo $fontsubsets; ?>" <?php selected($selected,$fontsubsets); ?>><?php echo $fontsubsets; ?></option>
                <?php }
            ?>
        </select>
    </span>
<?php

    die();
}
endif;

if ( !function_exists('geode_fx_onscroll')) :
/**
 * Add an effect on scroll if PixGridder is active.
 * @since Geode 1.0
 */
add_filter( 'geode_fx_onscroll', 'geode_fx_onscroll' );
function geode_fx_onscroll() {
    return get_option('pix_style_fx_onscroll');
}
endif;

if ( !function_exists('geode_fx_title')) :
/**
 * Add an effect on scroll if PixGridder is active (for top elements like titles).
 * @since Geode 1.0
 */
add_filter( 'geode_fx_title', 'geode_fx_title' );
function geode_fx_title() {
    return get_option('pix_style_fx_title');
}
endif;

if ( !function_exists('geode_after_setup_theme')) :
/**
 * Miscellaneuos
 * @since Geode 1.6.7
 */
add_action( 'after_setup_theme', 'geode_after_setup_theme', 11 );
function geode_after_setup_theme()
{
	/*add_theme_support( 'infinite-scroll', array(
	    'type'           => 'click',
	    'container'      => 'content-append',
	    'wrapper'        => false
	) );*/
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'status', 'video', 'audio', 'chat', 'link', 'image', 'quote' ) );
	set_post_thumbnail_size( 75, 75, true );
	update_option( 'thumbnail_size_h', 75 );
	update_option( 'thumbnail_size_w', 75 );
}
endif;

if ( !function_exists('geode_after_setup_theme')) :
/**
 * Miscellaneuos
 * @since Geode 1.0
 */
add_action( 'after_setup_theme', 'geode_after_setup_theme', 11 );
function geode_after_setup_theme()
{
	add_theme_support( 'infinite-scroll', array(
	    'type'           => 'click',
	    'container'      => 'content'
	) );
	add_theme_support( 'html5' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'status', 'video', 'audio', 'chat', 'link', 'image', 'quote' ) );
	set_post_thumbnail_size( 75, 75, true );
	update_option( 'thumbnail_size_h', 75 );
	update_option( 'thumbnail_size_w', 75 );
}
endif;

if ( !function_exists('geode_current_post_type')) :
/**
 * Get the current post type
 * @since Geode 1.0
 */
function geode_current_post_type() {
    global $post, $typenow, $current_screen;

    // Check to see if a post object exists
    if ($post && $post->post_type)
        return $post->post_type;

    // Check if the current type is set
    elseif ($typenow)
        return $typenow;

    // Check to see if the current screen is set
    elseif ($current_screen && $current_screen->post_type)
        return $current_screen->post_type;

    // Finally make a last ditch effort to check the URL query for type
    elseif (isset($_REQUEST['post_type']))
        return sanitize_key($_REQUEST['post_type']);

    return null;
}
endif;

if ( !function_exists('geode_portfolio_post_format')) :
/**
 * Add post formats to Portfolio post type
 * @since Geode 1.0
 */
add_action( 'load-post.php','geode_portfolio_post_format' );
add_action( 'load-post-new.php','geode_portfolio_post_format' );
function geode_portfolio_post_format() {
    if ( 'portfolio' == geode_current_post_type() )
        add_theme_support( 'post-formats', array( 'video', 'gallery' ) );
}
endif;

if ( function_exists( 'add_image_size' ) ) : 
/**
 * List of thumbnail sizes
 * @since Geode 1.0
 */
	add_image_size('geode_thumb', 33, 33, true);
	add_image_size('geode_card', 150, 150, true);
	add_image_size('geode_small', 200, 0, true);
	add_image_size('geode_inter', 560, 0, true);
	add_image_size('geode_medium', 840, 0, true);
	add_image_size('geode_large', 1120, 0, true);
endif;

if ( !function_exists( 'geode_image_size_select' ) ) : 
/**
 * Additional options to the media uploader select box
 * @since Geode 1.0
 */
add_filter('image_size_names_choose', 'geode_image_size_select');
function geode_image_size_select($sizes) {
    $addsizes = array(
        'geode_thumb' => __( 'Mini preview', 'geode' ),
        'geode_card' => __( 'Card', 'geode' ),
        'geode_small' => __( 'Thumb', 'geode' ),
        'geode_inter' => __( 'Small', 'geode' ),
        'geode_medium' => __( 'Medium', 'geode' ),
        'geode_large' => __( 'Large', 'geode' ),
        'full' => __( 'Full', 'geode' )
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}
endif;
 
if ( !function_exists( 'geode_filter_image_sizes' ) ) : 
/**
 * Remove default options from the media uploader select box
 * @since Geode 1.0
 */
add_filter('intermediate_image_sizes_advanced', 'geode_filter_image_sizes');
function geode_filter_image_sizes( $sizes) {
	unset( $sizes['medium']);
	unset( $sizes['large']);

	return $sizes;
}
endif;

if ( !function_exists( 'geode_responsive_wp_caption' ) ) : 
/**
 * Responsive wp-caption
 * @since Geode 1.0
 */
add_filter( 'img_caption_shortcode', 'geode_responsive_wp_caption', 10, 3 );
function geode_responsive_wp_caption( $val, $attr, $content = null ) {
	extract( shortcode_atts( array(
		'id' => '',
		'align' => '',
		'width' => '',
		'caption' => ''
		), $attr
	) );
	
	if ( 1 > (int) $width || empty( $caption ) )
		return $val;
 
	$new_caption = sprintf( '<div id="%1$s" class="wp-caption %2$s" style="max-width:100%%!important;height:auto;width:%3$dpx;">%4$s<p class="wp-caption-text">%5$s</p></div>',
		esc_attr( $id ),
		esc_attr( $align ),
		( 10 + (int) $width ),
		do_shortcode( $content ),
		$caption
	);
	return $new_caption;
}
endif;

if ( !function_exists( 'geode_post_thumbnail' ) ) : 
/**
 * Return the post thumbnails as background of <img> (less cropped images, more space on the server saved)
 * @since Geode 1.0
 */
function geode_post_thumbnail($id = null, $bg_size = null, $sizes = array(1120,490), $attr = null, $data = false ) {

	$id = ( $id == null ) ? get_post_thumbnail_id() : $id;
	$bg_size = ( $bg_size == null ) ? 'large' : $bg_size;
	$thumb = wp_get_attachment_image_src($id, $bg_size );	
	$width = $sizes[0];
	$height = $sizes[1];
	$gcd = geode_gcd($width,$height);
	$dims = ( ($width/$gcd) != 1 && ($height/$gcd) != 1) ? '-'.($width/$gcd).'x'.($height/$gcd) : '';
	if ( $width!=0 && $height!=0) {
		$bg_size = $sizes;
		if ( $data==true ) {
			$new_attr = array(
			    'src' => $thumb[0],
			    'data-blank' => get_template_directory_uri().'/images/blank'.$dims.'.png',
			    'style' => 'background-image:url('.$thumb[0].')',
			    'data-src' => $thumb[0]
			);
		} else {
			$new_attr = array(
			    'src' => get_template_directory_uri().'/images/blank'.$dims.'.png',
			    'data-blank' => get_template_directory_uri().'/images/blank'.$dims.'.png',
			    'style' => 'background-image:url('.$thumb[0].')',
			    'data-src' => $thumb[0]
			);
		}	
		$attr = is_array($attr) ? array_merge($attr, $new_attr) : $new_attr;
	}
	if (isset($attr['class'])) {
		$attr['class'] .= ' geode_post_thumbnail';
	} else {
		$attr['class'] = ' geode_post_thumbnail';
	}
	if ( get_post_type($id)=='attachment' ) {
		return wp_get_attachment_image($id, $bg_size, '', $attr);		
	} else {
		return get_the_post_thumbnail($id, $bg_size, $attr);
	}
}
endif;

if ( !function_exists( 'geode_gcd' ) ) : 
/**
 * Great common denominator
 * @since Geode 1.0
 */
function geode_gcd($x, $y) {

	$x = abs($x);
	$y = abs($y);

	if ( $x + $y == 0 ) {
		return "0";
	} else {
		while( $x > 0 ) {
	  		$z = $x;
	  		$x = $y % $x;
	  		$y = $z;
	  	}
		return $z;
	}
}
endif;

if ( !function_exists('geode_get_the_widget') ) :
/**
 * Return the widget
 * @since Geode 1.0
 */
function geode_get_the_widget( $widget, $instance = '', $args = '' ){
	ob_start();
	the_widget($widget, $instance, $args);
	return ob_get_clean();
}
endif;


if ( !function_exists( 'geode_col_extra_height' ) ) : 
/**
* Increase height for PixGridder column on UI
* @since Geode 1.0
*/
add_filter('pixgridder_col_extra_height', 'geode_col_extra_height', 1);
function geode_col_extra_height(){
    return '730';
}
endif;


/**
* Remove styles from tinyMCE editor
* @since Geode 1.0
*/
remove_editor_styles();

if ( !function_exists( 'geode_builder_extra_fields' ) ) : 
/**
* Add fields to PixGridder builder for rows
* @since Geode 1.0
*/
add_filter('pixgridder_row_extra_fields_2', 'geode_builder_extra_fields', 1);
function geode_builder_extra_fields(){ ?>
    <label><?php _e( 'Select a type', 'geode' ); ?>:</label>
    <label class="for_select hidden">
        <span class="for_select">
            <select data-extra="true">
                <option value=""><?php _e('none', 'geode'); ?></option>
                <option value="fullwidth"><?php _e('fullwidth', 'geode'); ?></option>
                <option value="fullscreen"><?php _e('fullscreen', 'geode'); ?></option>
                <option value="text-box"><?php _e('text-box', 'geode'); ?></option>
            </select>
        </span>
    </label>

    <div class="clear"></div>

<?php }
endif;


if ( !function_exists( 'geode_cols_extra_fields2' ) ) : 
/**
* Add fields to PixGridder builder for columns
* @since Geode 1.0
*/
add_filter('pixg_col_extra_fields2', 'geode_cols_extra_fields2', 1);
function geode_cols_extra_fields2(){ ?>

    <div class="clear"></div>

    <label><?php _e('Padding, in percentage (leave empty for the default value)','geode'); ?>:</label>
    <div class="slider_div percent">
        <input data-style="padding" data-unit="%" type="text" value="">
        <div class="slider_cursor"></div>
    </div><!-- .slider_div -->
    <br>

    <div class="clear"></div>

    <label><?php _e('Padding top (if different from the general one)','pixgridder'); ?>:</label>
    <div class="slider_div grid">
        <input data-style="padding-top" data-unit="%!important" type="text" value="">
        <div class="slider_cursor"></div>
    </div><!-- .slider_div -->
    <br>

    <div class="clear"></div>

    <label><?php _e('Padding bottom (if different from the general one)','pixgridder'); ?>:</label>
    <div class="slider_div grid">
        <input data-style="padding-bottom" data-unit="%!important" type="text" value="">
        <div class="slider_cursor"></div>
    </div><!-- .slider_div -->
    <br>

<?php }
endif;


if ( !function_exists( 'geode_cols_extra_fields' ) ) : 
/**
* Add fields to PixGridder builder for columns
* @since Geode 1.0
*/
add_filter('pixg_col_extra_fields', 'geode_cols_extra_fields', 1);
function geode_cols_extra_fields(){ ?>

    <div class="clear"></div>

    <label><?php _e( 'Background color', 'geode' ); ?>:</label>
    <div class="pix_color_picker">
        <input data-style="background-color" type="text" value="">
        <a class="pix_button" href="#"></a>
        <div class="colorpicker"></div>
        <i class="scicon-elusive-cancel"></i>
    </div>

    <div class="clear"></div>

    <label><?php _e('Padding right (if different from the general one)','pixgridder'); ?>:</label>
    <div class="slider_div grid">
        <input data-style="padding-right" data-unit="%!important" type="text" value="">
        <div class="slider_cursor"></div>
    </div><!-- .slider_div -->
    <br>

    <div class="clear"></div>

    <label><?php _e('Padding left (if different from the general one)','pixgridder'); ?>:</label>
    <div class="slider_div grid">
        <input data-style="padding-left" data-unit="%!important" type="text" value="">
        <div class="slider_cursor"></div>
    </div><!-- .slider_div -->
    <br>

<?php }
endif;


if ( !function_exists( 'geode_builder_col_classes' ) ) : 
/**
* PixGridder row classes
* @since Geode 1.0
*/
add_filter('pixgridder_colClassArr', 'geode_builder_col_classes');
function geode_builder_col_classes(){
	return '["hide_small", "show_small", "hide_medium", "show_medium", "no_margin", "padding-box", "overflow_hidden", "height_100"]';
}
endif;


if ( !function_exists( 'geode_builder_row_classes' ) ) : 
/**
* PixGridder row classes
* @since Geode 1.0
*/
add_filter('pixgridder_rowClassArr', 'geode_builder_row_classes');
function geode_builder_row_classes(){
	return '["hide_small", "show_small", "hide_medium", "show_medium", "first-slideshow", "overflow_hidden", "arrowed-top", "arrowed-bottom", "quote-section"]';
}
endif;


if ( !function_exists( 'geode_builder_filter_colors' ) ) : 
/**
* PixGridder row classes
* @since Geode 1.0
*/
add_filter('pixgridder_featuredColors', 'geode_builder_filter_colors');
function geode_builder_filter_colors(){
	return '[
	"'.get_option('pix_style_page_bg_color').'",
	"'.get_option('pix_style_body_color').'",
	"'.get_option('pix_style_input_bg').'",
	"'.get_option('pix_style_border_color').'",
	"'.get_option('pix_style_featured_color').'",
	"'.get_option('pix_style_featured_color_alt').'"
]';
}
endif;


if ( !function_exists( 'geode_remove_pg_filters' ) ) : 
/**
* Remove some PixGridder filters and hooks
* @since Geode 1.0
*/
add_action('init', 'geode_remove_pg_filters');
function geode_remove_pg_filters() {
	global $pixGridder;
	remove_action( 'wp_head', array( $pixGridder, 'filter_content' ) );
	remove_filter( 'the_content', array( $pixGridder, 'filter_content' ), 100 );
}
endif;


if ( !function_exists( 'geode_admin_styles' ) ) : 
/**
* Enqueue backend styles
* @since Geode 1.7.3
*/
add_action('admin_enqueue_scripts', 'geode_admin_styles');
function geode_admin_styles() {
	global $pagenow;
	wp_enqueue_style( 'shortcodelic-fontello', get_template_directory_uri().'/css/shortcodelic-fontello.css' );
	if ('admin.php' == $pagenow && isset($_GET['page']) && $_GET['page']=='admin_interface') {
		wp_enqueue_style('farbtastic' );
		wp_enqueue_style('wp-jquery-ui-dialog');
		wp_enqueue_style('google-open-sans', get_template_directory_uri().'/functions/css/open_sans.css', false, '1.0', 'all');
		wp_enqueue_style('codemirror', get_template_directory_uri().'/functions/css/codemirror.css', false, '1.0', 'all');
		wp_enqueue_style('codemirror-skin', get_template_directory_uri().'/functions/css/codemirror-skin.css', false, '1.0', 'all');
		wp_enqueue_style('geode-admin', get_template_directory_uri().'/functions/css/geode_admin.css', false, '1.0', 'all');
	}
	if ('post.php' == $pagenow || 'post-new.php' == $pagenow || 'term.php' == $pagenow || 'edit-tags.php' == $pagenow) {
		wp_dequeue_style('jquery-ui-style');
		wp_enqueue_style('farbtastic' );
		wp_enqueue_style('geode-tabs', get_template_directory_uri().'/functions/css/pix_meta.css', false, '1.0', 'all');
	}

}
endif;

if ( !function_exists( 'geode_admin_enqueue_scripts' ) ) : 
/**
* Enqueue backend scripts
* @since Geode 1.7.3
*/
add_action('admin_enqueue_scripts', 'geode_admin_enqueue_scripts');
function geode_admin_enqueue_scripts() {
	global $pagenow;
	if(isset($_GET['page']) && $_GET['page']=='admin_interface'){
		wp_register_script('pix-modernizr', get_template_directory_uri().'/scripts/modernizr.pix.js', false, '1.0', false);
		if ( ! did_action( 'wp_enqueue_media' ) ) {
		    wp_enqueue_media();
		}
		wp_register_script('jquery-easing', get_template_directory_uri().'/scripts/jquery.easing.1.3.js', array('jquery'), '1.3', false);
		wp_register_script('codemirror', get_template_directory_uri().'/functions/scripts/codemirror.js', array('jquery'), false, false);
		wp_register_script('codemirror-css', get_template_directory_uri().'/functions/scripts/css.js', array('jquery'), false, false);
		wp_register_script('codemirror-javascript', get_template_directory_uri().'/functions/scripts/javascript.js', array('jquery'), false, false);
		wp_register_script('codemirror-javascript', get_template_directory_uri().'/functions/scripts/javascript.js', array('jquery'), false, false);
		wp_register_script('codemirror-activeline', get_template_directory_uri().'/functions/scripts/active-line.js', array('jquery'), false, false);
		wp_register_script('codemirror-markselection', get_template_directory_uri().'/functions/scripts/mark-selection.js', array('jquery'), false, false);
		wp_register_script('bootstrap-filestyle', get_template_directory_uri().'/functions/scripts/bootstrap-filestyle.js', array('jquery'), '1.0.3', false);
		$array_dep = array('pix-modernizr','jquery','jquery-touch-punch','farbtastic','jquery-ui-dialog','jquery-ui-sortable','jquery-ui-draggable','jquery-ui-droppable','jquery-ui-slider','jquery-easing','codemirror','codemirror-css','codemirror-javascript','codemirror-activeline','codemirror-markselection','bootstrap-filestyle');
		if(get_option('pix_style_enable_google_fonts')=='true') {
		    wp_register_script('google-font', 'https://www.google.com/jsapi', array(), false, false);
		    array_unshift($array_dep, 'google-font');
		}
		wp_enqueue_script('pix-admin', get_template_directory_uri().'/functions/scripts/pix_admin.js', $array_dep);
	}
	if ('post.php' == $pagenow || 'post-new.php' == $pagenow || 'term.php' == $pagenow || 'edit-tags.php' == $pagenow) {
		if ( ! did_action( 'wp_enqueue_media' ) ) {
		    wp_enqueue_media();
		}
		wp_enqueue_script('pix-meta', get_template_directory_uri().'/functions/scripts/pix_meta.js', array('farbtastic','jquery-ui-tabs','jquery-ui-slider'));
	}
}
endif;

if ( !function_exists( 'geode_login_enqueue_scripts' ) ) : 
/**
* Enqueue login scripts
* @since Geode 1.0
*/
add_action( 'login_enqueue_scripts', 'geode_login_enqueue_scripts' );
function geode_login_enqueue_scripts(){
	echo '<style type="text/css" media="screen">';
	echo '#login h1 a{background: url('.get_option('pix_content_login_logo').') top center no-repeat!important; background-size: 326px auto!important; width: 326px!important; height:200px!important; background-position:center!important;';
	echo '</style>';
}
endif;

if ( !function_exists( 'geode_admin_vars' ) ) : 
/**
* Print javascript variable on admin head
* @since Geode 1.0
*/
add_action('admin_head', 'geode_admin_vars');
function geode_admin_vars() {
	global $pagenow;
	$upload_dir = wp_upload_dir();
	$nonce = wp_create_nonce( 'pix_sidebar' );		
	$out = '<script type="text/javascript">
	//<![CDATA[
	var pix_theme_dir = "'.get_template_directory_uri().'", 
		pix_upload_dir = "'.$upload_dir['baseurl'].'",
		pix_sidebar_nonce = "' .$nonce. '",
		pix_general_fontsize = "' .get_option('pix_style_body_fontsize'). '",
		pix_general_subset = "'.get_option('pix_style_body_fontsubset').'";
	//]]>
</script>
<style>
div.ict_column.column_three table tbody tr:nth-child(2) {
	display: none;
}
</style>';
	echo $out;
}
endif;

if ( !function_exists( 'geode_ajax_get_thumb' ) ) : 
/**
* Get thumbnail src via AJAX
* @since Geode 1.0
*/
add_action( 'wp_ajax_geode_get_thumb', 'geode_ajax_get_thumb' );
function geode_ajax_get_thumb() {

    $attachment_id = $_POST['content'];
    $attachment_bg = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
    echo $attachment_bg[0];

	die();
}	
endif;

if ( !function_exists('pix_AddThumbColumn') ) :
/**
* Add a columns for the post thumbnails to the list of post on backend
* @since Geode 1.0
*/
function pix_AddThumbColumn($cols) { 

	global $typenow;
	if ( empty( $typenow ) && !empty( $_GET['post'] ) ) {
		$post = get_post( $_GET['post'] );
		$typenow = $post->post_type;
	} elseif ( empty( $typenow ) && !empty( $_GET['post_type'] ) ) {
		$typenow = $_GET['post_type'];
	}
	
	$cols['thumbnail'] = __('Thumbnail', 'geode'); 
	if ( $typenow == 'portfolio' ) {
		$cols['portfolio_category'] = __('Category','geode'); 
		$cols['portfolio_tag'] = __('Tags','geode'); 
	}
	return $cols;
}
endif;

if ( !function_exists('pix_AddThumbValue') ) :
/**
* Add the post thumbnails to the list of post on backend
* @since Geode 1.0
*/
function pix_AddThumbValue($column_name) {
	global $post;
	
	$post_id = $post->ID;
	
	$width = (int) 75;
	$height = (int) 75;
	

	global $typenow;
	if ( empty( $typenow ) && !empty( $_GET['post'] ) ) {
		$post = get_post( $_GET['post'] );
		$typenow = $post->post_type;
	} elseif ( empty( $typenow ) && !empty( $_GET['post_type'] ) ) {
		$typenow = $_GET['post_type'];
	}

	switch ( $column_name ) {
		case 'thumbnail':
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
			if ($thumbnail_id)
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			elseif ($attachments) {
				foreach ( $attachments as $attachment_id => $attachment ) {
					$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
				}
			}
				if ( isset($thumb) && $thumb ) {
					echo $thumb;
				} else {
					echo __('None', 'geode');
				}
			break;
	
		/*case 'description':
			echo pix_get_the_excerpt($length=15);
			break;*/

		case 'portfolio_category':
			$_taxonomy = 'portfolio_category';
			$categories = get_the_terms( $post_id, $_taxonomy );
			if ( !empty( $categories ) ) {
				$out = array();
				foreach ( $categories as $c )
					$out[] = "<a href='edit.php?portfolio_categories=$c->term_id&post_type=portfolio'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
				echo join( ', ', $out );
			}
			else {
				_e('Uncategorized', 'geode');
			}
			break;

		case 'portfolio_tag':
			$_taxonomy = 'portfolio_tag';
			$categories = get_the_terms( $post_id, $_taxonomy );
			if ( !empty( $categories ) ) {
				$out = array();
				foreach ( $categories as $c )
					$out[] = "<a href='edit.php?portfolio_tags=$c->term_id&post_type=portfolio'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
				echo join( ', ', $out );
			}
			else {
				_e('No tags', 'geode');
			}
			break;
	}
}

add_filter( 'manage_posts_columns', 'pix_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'pix_AddThumbValue', 100, 2 );
add_filter( 'manage_page_posts_columns', 'pix_AddThumbColumn' );
add_action( 'manage_page_posts_custom_column', 'pix_AddThumbValue', 100, 2 );
endif;

if ( !function_exists('geode_scripts_styles') ) :
/**
* Enqueue scripts and styles
* @since Geode 1.5.2
*/
add_action( 'wp_enqueue_scripts', 'geode_scripts_styles', 10 );
function geode_scripts_styles() {
	global $geode_theme_version;

	/*SCRIPTS*/
	wp_register_script( 'pix-modernizr', get_template_directory_uri().'/scripts/modernizr.pix.js', array(), '2.6.3', false );
	wp_register_script( 'jquery-easing', get_template_directory_uri().'/scripts/jquery.easing.1.3.js', array('jquery'), '1.3', true );
	wp_register_script( 'jquery-isotope', get_template_directory_uri().'/scripts/jquery.isotope.min.js', array('jquery'), '2.1.0', true );
	wp_register_script( 'imagesloaded', get_template_directory_uri().'/scripts/imagesloaded.pkgd.min.js', array('jquery'), '3.1.8', true );
	wp_deregister_script( 'jquery-colorbox' );
	wp_register_script( 'jquery-mousewheel', get_template_directory_uri().'/scripts/jquery.mousewheel.min.js', array('jquery'), '3.1.11', true );
	wp_register_script( 'jquery-colorbox', get_template_directory_uri().'/scripts/jquery.colorbox-min.js', array('jquery'), '1.6.4', true );
	wp_register_script( 'jquery-cycle2', get_template_directory_uri().'/scripts/jquery.cycle2.min.js', array('jquery'), '20131022', true );
	wp_register_script( 'jquery-svginject', get_template_directory_uri().'/scripts/jquery.svginject.js', array('jquery'), $geode_theme_version, true );
	wp_register_script( 'bootstrap-filestyle', get_template_directory_uri().'/functions/scripts/bootstrap-filestyle.js', array('jquery'), '1.0.3', true );
	wp_register_script( 'geode-owl-carousel', get_template_directory_uri().'/scripts/owl.carousel.min.js', array('jquery'), '2.0.0-beta.2.4 7', true );
	wp_register_script( 'jquery-bxslider', get_template_directory_uri().'/scripts/jquery.bxslider.min.js', array('jquery'), '4.1.2', true );
	$array_dep = array('jquery','jquery-touch-punch','pix-modernizr','jquery-easing','jquery-ui-slider','jquery-ui-datepicker','jquery-isotope','jquery-mousewheel','imagesloaded','jquery-cycle2','jquery-svginject','wp-mediaelement','geode-owl-carousel','jquery-bxslider');
	if ( get_option('pix_style_enable_colorbox')=='true' ) {
		$array_dep[] = 'jquery-colorbox';
	}
	if ( get_option('pix_style_enable_filestyle')=='true' ) {
		$array_dep[] = 'bootstrap-filestyle';
	}
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (is_plugin_active('shortcodelic/shortcodelic.php')) {
		wp_enqueue_script( 'shortcodelic-tooltips' );
		wp_enqueue_script( 'shortcodelic-tabs' );
		wp_enqueue_script( 'shortcodelic-carousel' );
		wp_enqueue_script( 'shortcodelic-slideshine' );
	}
	wp_register_script( 'geode-plugins', get_template_directory_uri().'/scripts/plugins.js', $array_dep, $geode_theme_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_deregister_script( 'shortcodelic-bxslider' );
	wp_deregister_script( 'shortcodelic-carousel' );
	wp_dequeue_script( 'shortcodelic-carousel' );
	wp_enqueue_script( 'geode-scrips', get_template_directory_uri().'/scripts/geode.js', array('geode-plugins'), $geode_theme_version, true );

	/*STYLES*/
	wp_dequeue_style( 'contact-form-7' );
	wp_dequeue_style( 'jquery-colorbox' );
	wp_dequeue_style( 'pif-styles' );

	wp_enqueue_style( 'wp-jquery-ui' );
	wp_enqueue_style( 'wp-mediaelement' );
	wp_enqueue_style( 'shortcodelic-fontello', get_template_directory_uri().'/css/shortcodelic-fontello.css' );
	wp_enqueue_style( 'geode-style', get_stylesheet_uri() );
	if ( get_option('pix_content_css_inline')!='true' ) {
		global $blog_id;

		if ( is_multisite() && $blog_id > 1 ) {
			$upload_dir = wp_upload_dir();
			$dir = $upload_dir['baseurl'] .'/geode/';
			$css_file = $dir . 'css_compiled.css';
		} else {
			$css_file = get_template_directory_uri().'/css/css_compiled.css';
		}
		wp_enqueue_style( 'geode-compiled', $css_file );
	} else {
		$compile_style = geode_compile_css_inline();
		$compile_style = str_replace(array("\r", "\n", "\t"), '', $compile_style);
		wp_add_inline_style( 'geode-style', $compile_style );
	}

	if (is_plugin_active('shortcodelic/shortcodelic.php')) {
		wp_enqueue_style( 'shortcodelic-tooltipster' );
		wp_enqueue_style( 'shortcodelic-tabs' );
		wp_enqueue_style( 'shortcodelic-carousel' );
		wp_enqueue_style( 'shortcodelic-slideshine' );
	}

}
endif;

/**
* Remove WooCompare Widget
*/
if ( !function_exists('geode_unregister_widget') ) :
add_action('widgets_init','geode_unregister_widget',10);
function geode_unregister_widget() {
	unregister_widget( 'YITH_Woocompare_Widget' );
}
endif;

/**
* Add classes to the body on frontend
*/
if ( !function_exists('geode_extra_classes') ) :
add_filter('body_class','geode_extra_classes');
function geode_extra_classes($classes) {
	global $post;
	$classes[] = 'header-fixed';
	if(get_option('pix_style_layout_style')=='boxed') { $classes[] = 'layout-boxed'; } else { $classes[] = 'layout-fullwidth'; }
	if(get_option('pix_style_header_style')=='centered') $classes[] = 'header-centered'; 
	if(get_option('pix_style_sticky_header')=='true') $classes[] = 'sticky-header'; 
	if(get_option('pix_style_header_scroll')!='true') $classes[] = 'headerLetmebe'; 
	if(get_option('pix_style_header_hover')!='true') $classes[] = 'headerNotHover'; 
	if(get_option('pix_style_nav_icons')=='centered') $classes[] = 'iconCentered'; 
	if(get_option('pix_style_nav_icons')!='centered') $classes[] = 'iconFloating'; 
	if(get_option('pix_style_query_loader')!='0') $classes[] = 'domLoading'; 
	if(get_option('pix_style_wide_header')!='0') $classes[] = 'wide-header';
	if(get_option('pix_style_disable_product_zoom')!='0') $classes[] = 'no-zoom';
	if(get_option('pix_style_woo_quick_view')!='0') $classes[] = 'quick-view';
	if ( 
		get_option('pix_style_page_margin_top')=='0' &&
		get_option('pix_style_page_margin_right')=='0' &&
		get_option('pix_style_page_margin_bottom')=='0' &&
		get_option('pix_style_page_margin_left')=='0'
	)
		$classes[] = 'layout-noframed'; 

	ob_start();
	dynamic_sidebar( strtolower(apply_filters('geode_primary_sidebar','geode_default_sidebar')));
	$sidebar = ob_get_clean();

	if ( !($post && get_post_type()=='portfolio' && get_post_meta( $post->ID, 'pix_sidebar_content', true )=='on') &&  $sidebar=='' ) {
		$classes[] = 'layout-nosidebar'; 
	}

	$classes[] = 'frame-shadow-'.get_option('pix_style_frameborders_shadow_position');
	return $classes;
}
endif;

if ( !function_exists('geode_admin_bar_css') ) :
/**
* Custom admin bar CSS
* @since Geode 1.0
*/
add_theme_support( 'admin-bar', array( 'callback' => 'geode_admin_bar_css' ) );
function geode_admin_bar_css($side){ ?>
<style type="text/css" media="screen">  
    html { margin-top: 32px !important; }
    * html body { margin-top: 32px !important; }
    @media screen and ( max-width: 782px ) {
        html { margin-top: 46px !important; }
        * html body { margin-top: 46px !important; }
    }
    @media screen and ( max-width: 600px ) {
        html { margin-top: 0 !important; }
        * html body { margin-top: 0 !important; }
        #page { margin-top: 46px !important; }
        /*#above_header, #wrap_header { top: 0 !important;}*/
    }
</style>
<?php }
endif;

/**
* Allow the use of shortcodes into the text widget
* @since Geode 1.0
*/
add_filter('widget_text', 'do_shortcode');

if ( !function_exists('geode_topbar_elems') ) :
/**
* Display the elements on the "above bar" on frontend
* @since Geode 1.0
*/
function geode_topbar_elems($side,$exclude_arr=array(),$out=''){

	$end_out = '';

	if ( $side == 'mobile' ) {
		$side_mom = 'mobile';
		$side = 'left';
		$out = '<div id="above_header_drop_down">';
	}
	if ( $side == 'right' && $out != '' ) {
		$end_out = '</div><!-- .test -->';
	}

    $pix_geode_array_top_icon = get_option('pix_geode_array_top'.$side.'_icon_'); 

    $i = 0;

    if ( isset($pix_geode_array_top_icon[$i]) && $pix_geode_array_top_icon[$i]!='' ) {
        while($i<count($pix_geode_array_top_icon)) {
        	if(isset($pix_geode_array_top_icon[$i]['exclude']) && $pix_geode_array_top_icon[$i]['exclude']=='true' && ( (isset($side_mom) && $side_mom == 'mobile') || $end_out != '')) {
        		$exclude_arr[$i] = $side;
        	} else {
	        	$out .= geode_topbar_loop($i,$side);
	        }
            $i++;
        }
    }

	if ( isset($side_mom) && $side_mom == 'mobile' ) {
		$side_mom = '';
		geode_topbar_elems('right', $exclude_arr, $out);
	} else {

		if ( $end_out!='' ) {
			echo '<div class="top_bar top_bar_drop_down">
	<a href="#"></a>
</div>';
		}

		if ( count($exclude_arr) > 0 ) {
			foreach ($exclude_arr as $key => $value) {
				echo geode_topbar_loop($key, $value);
			}
		}

		if ( $end_out!='' ) {
		    echo $out.$end_out;
		} else {
			echo $out;
		}
	}

}
endif;

if ( !function_exists('geode_topbar_loop') ) :
/**
* Loop content for top bars
* @since Geode 1.6.9
*/
function geode_topbar_loop($i,$side) {
    $pix_geode_array_top_icon = get_option('pix_geode_array_top'.$side.'_icon_'); 
	$out = "<div class=\"top_bar top_bar-$side-$i\"";
    if(isset($pix_geode_array_top_icon[$i]['exclude']) && $pix_geode_array_top_icon[$i]['exclude']=='true') {
    	$out .=  ' data-exclude="true"';
    }
    if(isset($pix_geode_array_top_icon[$i]['color']) && $pix_geode_array_top_icon[$i]['color']!='' && $pix_geode_array_top_icon[$i]['color']!=get_option('pix_style_topbar_color')) {
    	$out .= ' style="color:'.stripslashes($pix_geode_array_top_icon[$i]['color']).'"';
    }
	$out .= '>';
    if(isset($pix_geode_array_top_icon[$i]['link']) && $pix_geode_array_top_icon[$i]['link']!='') {
    	$out .= "<a class=\"top_bar_link\" href=\"".stripslashes($pix_geode_array_top_icon[$i]['link'])."\"";
        if(isset($pix_geode_array_top_icon[$i]['target'])) {
        	$out .= ' target="'.stripslashes($pix_geode_array_top_icon[$i]['target']).'"';
        }
        $out .= '>';
    }
    if(isset($pix_geode_array_top_icon[$i]['icon']) && $pix_geode_array_top_icon[$i]['icon']!='') {
    	$out .=  '<i class="'.stripslashes($pix_geode_array_top_icon[$i]['icon']).'"></i>';
    }
    if(isset($pix_geode_array_top_icon[$i]['text'])) {
		ob_start();
		do_shortcode(stripslashes($pix_geode_array_top_icon[$i]['text']));
		$text =  ob_get_clean();
		if ( $text=='' ) $text = do_shortcode(stripslashes($pix_geode_array_top_icon[$i]['text']));
		$out .= $text;
    }
    if(isset($pix_geode_array_top_icon[$i]['link']) && $pix_geode_array_top_icon[$i]['link']!='') {
    	$out .= '</a>';
    }
    if(isset($pix_geode_array_top_icon[$i]['sidebar']) && $pix_geode_array_top_icon[$i]['sidebar']!='') {
		ob_start();
		dynamic_sidebar(strtolower($pix_geode_array_top_icon[$i]['sidebar']));
		$sidebar = ob_get_clean();
		if ($sidebar) {
			$sidebar = preg_replace('/<h6([^>]*)>(.*?)<\/h6>/i', '<span class="h6"$1>$2</span>', $sidebar);
		    $out .= '<div class="above_header_inside">'.$sidebar.'</div>';
		}
    }
	$out .= '</div>';
	return $out;
}
endif;

if ( !function_exists('geode_favicon') ) :
/**
* Print some javascript variables on wp_head()
* @since Geode 1.0
*/
add_action('wp_head', 'geode_favicon');
function geode_favicon() {
	if (get_option('pix_content_favicon')!='') {
		$img = get_option('pix_content_favicon');
		$type = wp_check_filetype( $img ); 
		$ico = '<link rel="shortcut icon" type="' . $type['type'] . '" href="'. $img .'">'."\n";
		echo $ico;
	}
}
endif;

if ( !function_exists('geode_detect_browser') ) :
/**
* Detect browser via PHP
* @since Geode 1.0
*/
add_filter('body_class', 'geode_detect_browser');
function geode_detect_browser( $classes ) {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if($is_lynx) $classes[] = 'lynx';
    elseif($is_gecko) $classes[] = 'gecko';
    elseif($is_opera) $classes[] = 'opera';
    elseif($is_NS4) $classes[] = 'ns4';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE) {
            $classes[] = 'ie';
            if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
            $classes[] = 'ie'.$browser_version[1];
    } else $classes[] = 'unknown';
    if($is_iphone) $classes[] = 'iphone';
    if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
         $classes[] = 'osx';
   } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
         $classes[] = 'linux';
   } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
         $classes[] = 'windows';
   }

    return $classes;
}
endif;

if ( !function_exists('geode_front_vars') ) :
/**
* Print some javascript variables on wp_head()
* @since Geode 1.6.6.p
*/
add_action('wp_head', 'geode_front_vars');
function geode_front_vars() {
	global $wp_scripts;
	$out = '<script type="text/javascript">
	//<![CDATA['."\n";
	if (pix_is_woocommerce_active()) {
		$piw_woo_script = " var pix_woo_scripts = [";
		if (isset($wp_scripts->registered['wc-add-to-cart']))
			$piw_woo_script .= "'".$wp_scripts->registered['wc-add-to-cart']->src."',";
		if (isset($wp_scripts->registered['wc-single-product']))
			$piw_woo_script .= "'".$wp_scripts->registered['wc-single-product']->src."',";
		if (isset($wp_scripts->registered['jquery-blockui']))
			$piw_woo_script .= "'".$wp_scripts->registered['jquery-blockui']->src."',";
		if (isset($wp_scripts->registered['woocommerce']))
			$piw_woo_script .= "'".$wp_scripts->registered['woocommerce']->src."',";
		if (isset($wp_scripts->registered['wc-cart-fragments']))
			$piw_woo_script .= "'".$wp_scripts->registered['wc-cart-fragments']->src."',";
		if (isset($wp_scripts->registered['wc-add-to-cart-variation']))
			$piw_woo_script .= "'".$wp_scripts->registered['wc-add-to-cart-variation']->src."',";
		$out .= rtrim($piw_woo_script,',');
		$out .= "];";
	}
	if ( get_option('pix_style_enable_colorbox')=='true' ) {
		$out .= 'var pix_style_enable_colorbox = true;';
	}
	if ( get_option('pix_style_enable_filestyle')=='true' ) {
		$out .= 'var pix_style_enable_filestyle = true;';
	}
	if ( get_option('pix_style_enable_customselect')=='true' ) {
		$out .= 'var pix_style_enable_customselect = true;';
	}
	$out .= 'var geode_featured_color = "'.get_option('pix_style_featured_color').'",';
	$out .= 'geode_break_menu = "'.get_option('pix_style_nav_mobile_size').'",';
	$out .= 'geode_theme_dir = "'.get_template_directory_uri().'",';
	$out .= 'geode_select_not_custom = "'. apply_filters('geode_select_not_custom', '[multiple], .hasCustomSelect, #rating, .country_select, .state_select') .'";';
	$out .= "\n".(stripslashes(get_option('pix_style_header')))."\n";
	$out .= '//]]>
</script>';
	echo $out;
}
endif;

if ( !function_exists('geode_demo_panel') ) :
/**
* Print some javascript variables on wp_head()
* @since Geode 1.0
*/
add_action('wp_footer', 'geode_demo_panel');
function geode_demo_panel() {
	if ( get_option('pix_style_demo_panel') == 'true' ) { ?>
		<div id="geode-demo-panel">
			<a class="toggle" href="#"></a>
			<h6><?php _e('Style switcher','geode'); ?></h6>
			<div class="demo-content">
				<form class="demo-layout-form">
					<?php _e('Layout','geode'); ?>
					<select name="demo-layout" class="demo-layout">
						<option value="fullscreen"><?php _e('fullscreen','geode'); ?></option>
						<option value="boxed"><?php _e('boxed','geode'); ?></option>
						<option value="framed"><?php _e('framed','geode'); ?></option>
					</select>
					<small><em><?php _e('(from the admin panel you can set a different border width for the framed layout)','geode'); ?></em></small>
					<br>
					<?php _e('Header','geode'); ?>
					<select name="demo-header" class="demo-header">
						<option value="floating"><?php _e('floating','geode'); ?></option>
						<option value="centered"><?php _e('centered','geode'); ?></option>
					</select>
					<select name="demo-header-sticky" class="demo-header-sticky">
						<option value="sticky"><?php _e('sticky','geode'); ?></option>
						<option value="not-sticky"><?php _e('not-sticky','geode'); ?></option>
					</select>
					<br>
					<select name="demo-header-wide" class="demo-header-wide">
						<option value="wide"><?php _e('wide','geode'); ?></option>
						<option value="boxed"><?php _e('boxed','geode'); ?></option>
					</select>
					<br>
					<?php _e('Navigation icons','geode'); ?>
					<select name="demo-icons" class="demo-icons">
						<option value="floating"><?php _e('floating','geode'); ?></option>
						<option value="centered"><?php _e('centered','geode'); ?></option>
					</select>
					<?php apply_filters('geode_extra_demo_fields',''); ?>
					<a href="#" class="pix_button reset">Reset</a>
				</form>
			</div><!-- demo-content -->
		</div><!-- #geode-demo-panel -->
	<?php }
}
endif;

if ( !function_exists('geode_footer_scripts') ) :
/**
* Print some javascript variables on wp_head()
* @since Geode 1.0
*/
add_action('wp_footer', 'geode_footer_scripts');
function geode_footer_scripts() {
	$out = '<script type="text/javascript">
	//<![CDATA[';
	$out .= "\n".(stripslashes(get_option('pix_style_footer')))."\n";
	$out .= '//]]>
</script>';
	echo $out;
}
endif;

if ( ! function_exists( 'geode_wp_list_pages_nav' ) ) :
/**
 * Customize wp_list_pages() output for Geode main menu
 * @since Geode 1.0
 */
function geode_wp_list_pages_nav( $args ) {
	$args['echo'] = 0;
	$args['title_li'] = '';
	$args = http_build_query($args);
    $pages = wp_list_pages($args);
    $ul = '<ul';
    $ulEnd = '</ul>';
    $li = '<li';
    $liEnd = '</li>';
    $divUl = '<div role="list"';
    $divLi = '<div role="listitem"';
    $divEnd = '</div>';
    $pages = str_replace($ul, $divUl, $pages);
    $pages = str_replace($ulEnd, $divEnd, $pages);
    $pages = str_replace($li, $divLi, $pages);
    $pages = str_replace($liEnd, $divEnd, $pages);
    $pages = preg_replace('/<div role=[\'|"]listitem[\'|"](.*?)><a (.*?)>(.*?)<\/a>/', '<div role="listitem"$1><span></span><a $2><span>$3</span></a>', $pages);
    echo $pages;
}
endif;

if ( !function_exists('geode_post_nav') ) :
/**
* Post navigation
* @since Geode 1.0
*/
add_action( 'wp_footer', 'geode_post_nav' );
function geode_post_nav() {
	if ( !is_single() )
		return;
	global $query_string;
	$posts = query_posts($query_string); if ( have_posts() ) : while ( have_posts() ) : the_post();
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links cf">
			<?php
			if ( is_attachment() ) :
				previous_post_link();
			else : ?>
			<?php if (get_previous_post_link()!='') { ?>
				<div class="alignleft">
					<?php previous_post_link($format='%link'); ?>
				</div>
			<?php } ?>
			<?php if (get_next_post_link()!='') { ?>
			<div class="alignright">
				<?php next_post_link($format='%link'); ?>
			</div>
			<?php } ?>
			<?php endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php endwhile; endif;
}
endif;

if ( !function_exists('geode_comment_form') ) :
/**
* Comment form
* @since Geode 1.0
*/
add_filter('comment_form_default_fields', 'geode_comment_form');
function geode_comment_form($args = array()) {
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$commenter = wp_get_current_commenter();
	$html5 = 'html5' === $args['format'];
	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="comment-author">' .
		            '<input id="comment-author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="'. __('Name', 'geode') . ($req ? ' *' : '') .'">' .
		            '</label></p>',
		'email'  => '<p class="comment-form-email"><label for="comment-email">' .
		            '<input id="comment-email" name="email" ' . ( $html5 ? 'type="email" pattern=""' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="'. __('Email', 'geode') . ($req ? ' *' : '') .'">' .
		            '</label></p>',
		'url'    => '<p class="comment-form-url"><label for="comment-url">' .
		            '<input id="comment-url" name="url" ' . ( $html5 ? 'type="url" pattern=""' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '"  placeholder="'. __('Website', 'geode') .'">' .
		            '</label></p>',
	);
	return $fields;

}
endif;

if ( ! function_exists( 'geode_comment_form_defaults' ) ) :
/**
* Comment form default values
* @since Geode 1.0
*/
add_filter('comment_form_defaults', 'geode_comment_form_defaults');
function geode_comment_form_defaults($defaults) {
	global $post;
	$post_id = $post->ID;
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$req = get_option( 'require_name_email' );
	$defaults[ 'comment_field' ] = '<p class="comment-form-comment"><label for="comment"><textarea id="comment" name="comment" aria-required="true" placeholder="'. _x( 'Comment', 'noun', 'geode' ) .'"></textarea></label></p>';
    $defaults[ 'comment_notes_after' ] = '<small class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'geode' ), ' <pre>' . allowed_tags() . '</pre>' ) . '</small>';
	$defaults[ 'must_log_in' ] = '<small class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'geode' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</small>';
	$defaults[ 'logged_in_as' ] = '<small class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'geode' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</small>';
	$defaults[ 'comment_notes_before' ] = '<small class="comment-notes">' . __( 'Your email address will not be published.', 'geode' ) .'</small>';
    return $defaults;
}
endif;

if ( ! function_exists( 'geode_comment_reply_link' ) ) :
/**
* Comment reply link
* @since Geode 1.0
*/
add_filter('comment_reply_link', 'geode_comment_reply_link', 420, 4);
function geode_comment_reply_link($link, $args, $comment, $post){
	return preg_replace('/onclick=\'return addComment.moveForm\((.+?)\)\'/', 'onclick=\'geode_hide_reply(this); return addComment.moveForm($1);\'', $link);
}
endif;

if ( ! function_exists( 'pix_font_set' ) ) :
/**
* Print the font sets to load them from Google
* @since Geode 1.0
*/
function pix_font_set(){
	$families = get_option('pix_style_fonts_w_variants');
	$fonts = array();
	/*general font*/
	$body_font = get_option('pix_style_body_fontfamily');
	if ( $body_font!='' ) {
		$fonts[$body_font]['variants'] = isset($families[$body_font]['variants']) ? $families[$body_font]['variants'] : array();
		$fonts[$body_font]['subset'] = get_option('pix_style_body_fontsubset');
	}
	$alternative_font = get_option('pix_style_alternative_fontfamily');
	if ( $alternative_font!='' ) {
		$fonts[$alternative_font]['variants'] = isset($families[$alternative_font]['variants']) ? $families[$alternative_font]['variants'] : array();
		$fonts[$alternative_font]['subset'] = get_option('pix_style_alternative_fontsubset');
	}
	$single_font = get_option('pix_style_single_fontfamily');
	if ( $single_font!='' ) {
		$fonts[$single_font]['variants'] = isset($families[$single_font]['variants']) ? $families[$single_font]['variants'] : array();
		$fonts[$single_font]['subset'] = get_option('pix_style_single_fontsubset');
	}
	$sitetitle_font = get_option('pix_style_sitetitle_fontfamily');
	if ( $sitetitle_font!='' ) {
		if ( !isset($fonts[$sitetitle_font]['variants']) ) $fonts[$sitetitle_font]['variants'] = array();
		array_push($fonts[$sitetitle_font]['variants'], get_option('pix_style_sitetitle_fontvariant'));
	}
	$sitedescription_font = get_option('pix_style_sitedescription_fontfamily');
	if ( $sitedescription_font!='' ) {
		if ( !isset($fonts[$sitedescription_font]['variants']) ) $fonts[$sitedescription_font]['variants'] = array();
		array_push($fonts[$sitedescription_font]['variants'], get_option('pix_style_sitedescription_fontvariant'));
	}
	$firstmenu_font = get_option('pix_style_nav_fontfamily');
	if ( $firstmenu_font!='' ) {
		if ( !isset($fonts[$firstmenu_font]['variants']) ) $fonts[$firstmenu_font]['variants'] = array();
		array_push($fonts[$firstmenu_font]['variants'], get_option('pix_style_nav_fontvariant'));
	}
	$secondmenu_font = get_option('pix_style_nav2nd_fontfamily');
	if ( $secondmenu_font!='' ) {
		if ( !isset($fonts[$secondmenu_font]['variants']) ) $fonts[$secondmenu_font]['variants'] = array();
		array_push($fonts[$secondmenu_font]['variants'], get_option('pix_style_nav2nd_fontvariant'));
	}
	$h1_font = get_option('pix_style_h1_fontfamily');
	if ( $h1_font!='' ) {
		if ( !isset($fonts[$h1_font]['variants']) )
			$fonts[$h1_font]['variants'] = array();
		if ( !in_array(get_option('pix_style_h1_fontvariant'), $fonts[$h1_font]['variants']) )
			array_push($fonts[$h1_font]['variants'], get_option('pix_style_h1_fontvariant'));
	}
	$h2_font = get_option('pix_style_h2_fontfamily');
	if ( $h2_font!='' ) {
		if ( !isset($fonts[$h2_font]['variants']) )
			$fonts[$h2_font]['variants'] = array();
		if ( !in_array(get_option('pix_style_h2_fontvariant'), $fonts[$h2_font]['variants']) )
			array_push($fonts[$h2_font]['variants'], get_option('pix_style_h2_fontvariant'));
	}
	$h3_font = get_option('pix_style_h3_fontfamily');
	if ( $h3_font!='' ) {
		if ( !isset($fonts[$h3_font]['variants']) )
			$fonts[$h3_font]['variants'] = array();
		if ( !in_array(get_option('pix_style_h3_fontvariant'), $fonts[$h3_font]['variants']) )
			array_push($fonts[$h3_font]['variants'], get_option('pix_style_h3_fontvariant'));
	}
	$h4_font = get_option('pix_style_h4_fontfamily');
	if ( $h4_font!='' ) {
		if ( !isset($fonts[$h4_font]['variants']) )
			$fonts[$h4_font]['variants'] = array();
		if ( !in_array(get_option('pix_style_h4_fontvariant'), $fonts[$h4_font]['variants']) )
			array_push($fonts[$h4_font]['variants'], get_option('pix_style_h4_fontvariant'));
	}
	$h5_font = get_option('pix_style_h5_fontfamily');
	if ( $h5_font!='' ) {
		if ( !isset($fonts[$h5_font]['variants']) )
			$fonts[$h5_font]['variants'] = array();
		if ( !in_array(get_option('pix_style_h5_fontvariant'), $fonts[$h5_font]['variants']) ) 
			array_push($fonts[$h5_font]['variants'], get_option('pix_style_h5_fontvariant'));
	}
	$h6_font = get_option('pix_style_h6_fontfamily');
	if ( $h6_font!='' ) {
		if ( !isset($fonts[$h6_font]['variants']) )
			$fonts[$h6_font]['variants'] = array();
		if ( !in_array(get_option('pix_style_h6_fontvariant'), $fonts[$h6_font]['variants']) )
			array_push($fonts[$h6_font]['variants'], get_option('pix_style_h6_fontvariant'));
	}
	//$site_font = '"Merriweather:400,300,300italic,400italic,700,700italic,900,900italic:latin",';
	$site_font = '';
	foreach($fonts as $font => $vars) {
		$site_font .= '"'.str_replace(' ','+',$font);;
		$site_font .= ':';
		$site_font .= str_replace('regular','400',implode(array_unique($vars['variants']),','));
		$site_font .= ':';
		$site_font .= get_option('pix_style_body_fontsubset').'",';
	}
	return $site_font;

}
endif;

if ( ! function_exists( 'geode_extra_boxes_options' ) ) :
/**
* Extra Shortcodelic buttons
* @since Geode 1.0
*/
add_filter('add_shortcodelic_boxes_options', 'geode_extra_boxes_options');
function geode_extra_boxes_options(){
	$boxes = array('default' => 'default', 'blank' => 'blank', 'success' => 'success', 'error' => 'error');
	return $boxes;
}
endif;

if ( ! function_exists( 'geode_extra_buttons_options' ) ) :
/**
* Extra Shortcodelic buttons
* @since Geode 1.0
*/
add_filter('add_shortcodelic_buttons_options', 'geode_extra_buttons_options');
function geode_extra_buttons_options(){
	$buttons = array('default' => 'default', 'default2' => 'default2', 'footer' => 'footer', 'footer2' => 'footer2', 'top_sliding' => 'top_sliding', 'top_sliding2' => 'top_sliding2');
	return $buttons;
}
endif;

if ( ! function_exists( 'shortcodelic_hide_interface_panels' ) ) :
/**
* Hide panels from Shortcodelic and Pixgridder admin
* @since Geode 1.0
*/
add_filter('shortcodelic_display_slideshows', 'shortcodelic_pixgridder_hide_interface_panels');
add_filter('shortcodelic_display_tabs', 'shortcodelic_pixgridder_hide_interface_panels');
//add_filter('shortcodelic_display_tables', 'shortcodelic_pixgridder_hide_interface_panels');
add_filter('shortcodelic_display_carousels', 'shortcodelic_pixgridder_hide_interface_panels');
//add_filter('shortcodelic_display_tooltips', 'shortcodelic_pixgridder_hide_interface_panels');
add_filter('shortcodelic_display_progress', 'shortcodelic_pixgridder_hide_interface_panels');
add_filter('pixgridder_display_settings', 'shortcodelic_pixgridder_hide_interface_panels');
add_filter('pixgridder_display_rules', 'shortcodelic_pixgridder_hide_interface_panels');
add_filter('pixgridder_display_cssselector', 'shortcodelic_pixgridder_hide_interface_panels');
add_filter('pixgridder_display_padding', 'shortcodelic_pixgridder_hide_interface_panels');
function shortcodelic_pixgridder_hide_interface_panels(){
	return false;
}
endif;

if ( ! function_exists( 'geode_more_js_iframe' ) ) :
/**
* Add scripts to slideshow preview
* @since Geode 1.0
*/
add_filter('shortcodelic_more_js_iframe', 'geode_more_js_iframe');
function geode_more_js_iframe(){
	return '<script src="https://www.google.com/jsapi"></script>
<script src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("webfont", "1");
	WebFontConfig = {
	    google: { 
			families: [ '.pix_font_set().' ]
		 }
	};
</script>';
}
endif;

if ( ! function_exists( 'geode_gallery_data_rel' ) ) :
/**
* Link slideshine gallery to ColorBox
* @since Geode 1.0
*/
add_filter('shortcodelic_slideshine_gallery_atts', 'geode_gallery_data_rel');
function geode_gallery_data_rel(){
	global $post;
	if ( $post )
		$title = ' data-title="'.$post->post_title.'"';
	if (is_tax('portfolio_category') || is_post_type_archive('portfolio') || is_tax('portfolio_tag')) {
		return 'data-rel="gal"'.$title;
	}
}
endif;

if ( ! function_exists( 'geode_extra_boxes' ) ) :
/**
* Add default message boxes to Shortcodelic
* @since Geode 1.0
*/
add_filter('shortcodelic_extra_boxes_styles', 'geode_extra_boxes', 1);
function geode_extra_boxes(){ ?>
    <div class="pix_columns cf">
        <h4 class="section_title active"><span><?php _e('Default','geode'); ?></span></h4>

        <div class="admin-section-toggle visible">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_box_default_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_box_default_color" name="pix_style_box_default_color" type="text" value="<?php echo get_option('pix_style_box_default_color'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_box_default_background"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_box_default_background" name="pix_style_box_default_background" type="text" value="<?php echo get_option('pix_style_box_default_background'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_box_default_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_box_default_borderradius'); ?>" name="pix_style_box_default_borderradius" id="pix_style_box_default_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_box_default_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_box_default_bordercolor" name="pix_style_box_default_bordercolor" type="text" value="<?php echo get_option('pix_style_box_default_bordercolor'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_box_default_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_box_default_borderwidth'); ?>" name="pix_style_box_default_borderwidth" id="pix_style_box_default_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

               <label for="pix_style_box_default_style"><?php _e( 'Custom styles', 'geode' ); ?>:</label>
                <textarea name="pix_style_box_default_style" id="pix_style_box_default_style" class="codemirror"><?php echo get_option('pix_style_box_default_style'); ?></textarea>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Success','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_box_success_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_box_success_color" name="pix_style_box_success_color" type="text" value="<?php echo get_option('pix_style_box_success_color'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_box_success_background"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_box_success_background" name="pix_style_box_success_background" type="text" value="<?php echo get_option('pix_style_box_success_background'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_box_success_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_box_success_borderradius'); ?>" name="pix_style_box_success_borderradius" id="pix_style_box_success_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_box_success_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_box_success_bordercolor" name="pix_style_box_success_bordercolor" type="text" value="<?php echo get_option('pix_style_box_success_bordercolor'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_box_success_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_box_success_borderwidth'); ?>" name="pix_style_box_success_borderwidth" id="pix_style_box_success_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

               <label for="pix_style_box_success_style"><?php _e( 'Custom styles', 'geode' ); ?>:</label>
                <textarea name="pix_style_box_success_style" id="pix_style_box_success_style" class="codemirror"><?php echo get_option('pix_style_box_success_style'); ?></textarea>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Error','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_box_error_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_box_error_color" name="pix_style_box_error_color" type="text" value="<?php echo get_option('pix_style_box_error_color'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_box_error_background"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_box_error_background" name="pix_style_box_error_background" type="text" value="<?php echo get_option('pix_style_box_error_background'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_box_error_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_box_error_borderradius'); ?>" name="pix_style_box_error_borderradius" id="pix_style_box_error_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_box_error_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_box_error_bordercolor" name="pix_style_box_error_bordercolor" type="text" value="<?php echo get_option('pix_style_box_error_bordercolor'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_box_error_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_box_error_borderwidth'); ?>" name="pix_style_box_error_borderwidth" id="pix_style_box_error_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

               <label for="pix_style_box_error_style"><?php _e( 'Custom styles', 'geode' ); ?>:</label>
                <textarea name="pix_style_box_error_style" id="pix_style_box_error_style" class="codemirror"><?php echo get_option('pix_style_box_error_style'); ?></textarea>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Default on footer','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_footer_box_default_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_footer_box_default_color" name="pix_style_footer_box_default_color" type="text" value="<?php echo get_option('pix_style_footer_box_default_color'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_footer_box_default_background"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_footer_box_default_background" name="pix_style_footer_box_default_background" type="text" value="<?php echo get_option('pix_style_footer_box_default_background'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_footer_box_default_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_footer_box_default_borderradius'); ?>" name="pix_style_footer_box_default_borderradius" id="pix_style_footer_box_default_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_footer_box_default_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_footer_box_default_bordercolor" name="pix_style_footer_box_default_bordercolor" type="text" value="<?php echo get_option('pix_style_footer_box_default_bordercolor'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_footer_box_default_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_footer_box_default_borderwidth'); ?>" name="pix_style_footer_box_default_borderwidth" id="pix_style_footer_box_default_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

               <label for="pix_style_footer_box_default_style"><?php _e( 'Custom styles', 'geode' ); ?>:</label>
                <textarea name="pix_style_footer_box_default_style" id="pix_style_footer_box_default_style" class="codemirror"><?php echo get_option('pix_style_footer_box_default_style'); ?></textarea>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Success on footer','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_footer_box_success_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_footer_box_success_color" name="pix_style_footer_box_success_color" type="text" value="<?php echo get_option('pix_style_footer_box_success_color'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_footer_box_success_background"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_footer_box_success_background" name="pix_style_footer_box_success_background" type="text" value="<?php echo get_option('pix_style_footer_box_success_background'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_footer_box_success_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_footer_box_success_borderradius'); ?>" name="pix_style_footer_box_success_borderradius" id="pix_style_footer_box_success_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_footer_box_success_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_footer_box_success_bordercolor" name="pix_style_footer_box_success_bordercolor" type="text" value="<?php echo get_option('pix_style_footer_box_success_bordercolor'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_footer_box_success_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_footer_box_success_borderwidth'); ?>" name="pix_style_footer_box_success_borderwidth" id="pix_style_footer_box_success_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

               <label for="pix_style_footer_box_success_style"><?php _e( 'Custom styles', 'geode' ); ?>:</label>
                <textarea name="pix_style_footer_box_success_style" id="pix_style_footer_box_success_style" class="codemirror"><?php echo get_option('pix_style_footer_box_success_style'); ?></textarea>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Error on footer','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_footer_box_error_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_footer_box_error_color" name="pix_style_footer_box_error_color" type="text" value="<?php echo get_option('pix_style_footer_box_error_color'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_footer_box_error_background"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_footer_box_error_background" name="pix_style_footer_box_error_background" type="text" value="<?php echo get_option('pix_style_footer_box_error_background'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_footer_box_error_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_footer_box_error_borderradius'); ?>" name="pix_style_footer_box_error_borderradius" id="pix_style_footer_box_error_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_footer_box_error_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_footer_box_error_bordercolor" name="pix_style_footer_box_error_bordercolor" type="text" value="<?php echo get_option('pix_style_footer_box_error_bordercolor'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_footer_box_error_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_footer_box_error_borderwidth'); ?>" name="pix_style_footer_box_error_borderwidth" id="pix_style_footer_box_error_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

               <label for="pix_style_footer_box_error_style"><?php _e( 'Custom styles', 'geode' ); ?>:</label>
                <textarea name="pix_style_footer_box_error_style" id="pix_style_footer_box_error_style" class="codemirror"><?php echo get_option('pix_style_footer_box_error_style'); ?></textarea>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Default on top sliding bar','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_topsliding_box_default_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_topsliding_box_default_color" name="pix_style_topsliding_box_default_color" type="text" value="<?php echo get_option('pix_style_topsliding_box_default_color'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_topsliding_box_default_background"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_topsliding_box_default_background" name="pix_style_topsliding_box_default_background" type="text" value="<?php echo get_option('pix_style_topsliding_box_default_background'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_topsliding_box_default_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_topsliding_box_default_borderradius'); ?>" name="pix_style_topsliding_box_default_borderradius" id="pix_style_topsliding_box_default_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_topsliding_box_default_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_topsliding_box_default_bordercolor" name="pix_style_topsliding_box_default_bordercolor" type="text" value="<?php echo get_option('pix_style_topsliding_box_default_bordercolor'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_topsliding_box_default_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_topsliding_box_default_borderwidth'); ?>" name="pix_style_topsliding_box_default_borderwidth" id="pix_style_topsliding_box_default_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

               <label for="pix_style_topsliding_box_default_style"><?php _e( 'Custom styles', 'geode' ); ?>:</label>
                <textarea name="pix_style_topsliding_box_default_style" id="pix_style_topsliding_box_default_style" class="codemirror"><?php echo get_option('pix_style_topsliding_box_default_style'); ?></textarea>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Success on top sliding bar','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_topsliding_box_success_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_topsliding_box_success_color" name="pix_style_topsliding_box_success_color" type="text" value="<?php echo get_option('pix_style_topsliding_box_success_color'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_topsliding_box_success_background"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_topsliding_box_success_background" name="pix_style_topsliding_box_success_background" type="text" value="<?php echo get_option('pix_style_topsliding_box_success_background'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_topsliding_box_success_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_topsliding_box_success_borderradius'); ?>" name="pix_style_topsliding_box_success_borderradius" id="pix_style_topsliding_box_success_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_topsliding_box_success_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_topsliding_box_success_bordercolor" name="pix_style_topsliding_box_success_bordercolor" type="text" value="<?php echo get_option('pix_style_topsliding_box_success_bordercolor'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_topsliding_box_success_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_topsliding_box_success_borderwidth'); ?>" name="pix_style_topsliding_box_success_borderwidth" id="pix_style_topsliding_box_success_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

               <label for="pix_style_topsliding_box_success_style"><?php _e( 'Custom styles', 'geode' ); ?>:</label>
                <textarea name="pix_style_topsliding_box_success_style" id="pix_style_topsliding_box_success_style" class="codemirror"><?php echo get_option('pix_style_topsliding_box_success_style'); ?></textarea>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Error on top sliding bar','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_topsliding_box_error_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_topsliding_box_error_color" name="pix_style_topsliding_box_error_color" type="text" value="<?php echo get_option('pix_style_topsliding_box_error_color'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_topsliding_box_error_background"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_topsliding_box_error_background" name="pix_style_topsliding_box_error_background" type="text" value="<?php echo get_option('pix_style_topsliding_box_error_background'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_topsliding_box_error_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_topsliding_box_error_borderradius'); ?>" name="pix_style_topsliding_box_error_borderradius" id="pix_style_topsliding_box_error_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_topsliding_box_error_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_topsliding_box_error_bordercolor" name="pix_style_topsliding_box_error_bordercolor" type="text" value="<?php echo get_option('pix_style_topsliding_box_error_bordercolor'); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_topsliding_box_error_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo get_option('pix_style_topsliding_box_error_borderwidth'); ?>" name="pix_style_topsliding_box_error_borderwidth" id="pix_style_topsliding_box_error_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

               <label for="pix_style_topsliding_box_error_style"><?php _e( 'Custom styles', 'geode' ); ?>:</label>
                <textarea name="pix_style_topsliding_box_error_style" id="pix_style_topsliding_box_error_style" class="codemirror"><?php echo get_option('pix_style_topsliding_box_error_style'); ?></textarea>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->
    </div><!-- .pix_columns -->

<?php }
endif;

if ( ! function_exists( 'geode_extra_buttons' ) ) :
/**
* Add default buttons to Shortcodelic
* @since Geode 1.0
*/
add_filter('shortcodelic_extra_button_styles', 'geode_extra_buttons', 1);
function geode_extra_buttons(){ ?>
    <div class="pix_columns cf">
        <h4 class="section_title active"><span><?php _e('Default','geode'); ?></span></h4>

        <div class="admin-section-toggle visible">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_button_default_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default_color" name="pix_style_button_default_color" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default_color')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default_bg"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default_bg" name="pix_style_button_default_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default_bg')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default_texthover"><?php _e('Text color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default_texthover" name="pix_style_button_default_texthover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default_texthover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default_bghover"><?php _e('Background color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default_bghover" name="pix_style_button_default_bghover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default_bghover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_default_borderradius')); ?>" name="pix_style_button_default_borderradius" id="pix_style_button_default_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_button_default_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default_bordercolor" name="pix_style_button_default_bordercolor" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default_bordercolor')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_default_borderwidth')); ?>" name="pix_style_button_default_borderwidth" id="pix_style_button_default_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

                <label for="pix_style_button_default_bordercolorhover"><?php _e('Border color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default_bordercolorhover" name="pix_style_button_default_bordercolorhover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default_bordercolorhover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label class="for_select" for="pix_style_button_default_fx"><?php _e('Effect on hover','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_default_fx" id="pix_style_button_default_fx">
                            <option value="" <?php selected(get_option('pix_style_button_default_fx'), ''); ?>><?php _e('default','geode'); ?></option>
                            <option value="expand" <?php selected(get_option('pix_style_button_default_fx'), 'expand'); ?>><?php _e('expand color','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

                <label class="for_select" for="pix_style_button_default_icon"><?php _e('Icons','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_default_icon" id="pix_style_button_default_icon">
                            <option value="" <?php selected(get_option('pix_style_button_default_icon'), ''); ?>><?php _e('just show','geode'); ?></option>
                            <option value="hover" <?php selected(get_option('pix_style_button_default_icon'), 'hover'); ?>><?php _e('show on hover only','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Default 2','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_button_default2_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default2_color" name="pix_style_button_default2_color" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default2_color')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default2_bg"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default2_bg" name="pix_style_button_default2_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default2_bg')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default2_texthover"><?php _e('Text color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default2_texthover" name="pix_style_button_default2_texthover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default2_texthover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default2_bghover"><?php _e('Background color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default2_bghover" name="pix_style_button_default2_bghover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default2_bghover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default2_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_default2_borderradius')); ?>" name="pix_style_button_default2_borderradius" id="pix_style_button_default2_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_button_default2_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default2_bordercolor" name="pix_style_button_default2_bordercolor" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default2_bordercolor')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_default2_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_default2_borderwidth')); ?>" name="pix_style_button_default2_borderwidth" id="pix_style_button_default2_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

                <label for="pix_style_button_default2_bordercolorhover"><?php _e('Border color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_default2_bordercolorhover" name="pix_style_button_default2_bordercolorhover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_default2_bordercolorhover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label class="for_select" for="pix_style_button_default2_fx"><?php _e('Effect on hover','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_default2_fx" id="pix_style_button_default2_fx">
                            <option value="" <?php selected(get_option('pix_style_button_default2_fx'), ''); ?>><?php _e('default','geode'); ?></option>
                            <option value="expand" <?php selected(get_option('pix_style_button_default2_fx'), 'expand'); ?>><?php _e('expand color','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

                <label class="for_select" for="pix_style_button_default2_icon"><?php _e('Icons','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_default2_icon" id="pix_style_button_default2_icon">
                            <option value="" <?php selected(get_option('pix_style_button_default2_icon'), ''); ?>><?php _e('just show','geode'); ?></option>
                            <option value="hover" <?php selected(get_option('pix_style_button_default2_icon'), 'hover'); ?>><?php _e('show on hover only','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->
        <h4 class="section_title"><span><?php _e('Footer default','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_button_footer_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer_color" name="pix_style_button_footer_color" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer_color')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer_bg"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer_bg" name="pix_style_button_footer_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer_bg')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer_texthover"><?php _e('Text color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer_texthover" name="pix_style_button_footer_texthover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer_texthover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer_bghover"><?php _e('Background color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer_bghover" name="pix_style_button_footer_bghover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer_bghover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer_borderradius')); ?>" name="pix_style_button_footer_borderradius" id="pix_style_button_footer_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_button_footer_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer_bordercolor" name="pix_style_button_footer_bordercolor" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer_bordercolor')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer_borderwidth')); ?>" name="pix_style_button_footer_borderwidth" id="pix_style_button_footer_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

                <label for="pix_style_button_footer_bordercolorhover"><?php _e('Border color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer_bordercolorhover" name="pix_style_button_footer_bordercolorhover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer_bordercolorhover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label class="for_select" for="pix_style_button_footer_fx"><?php _e('Effect on hover','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_footer_fx" id="pix_style_button_footer_fx">
                            <option value="" <?php selected(get_option('pix_style_button_footer_fx'), ''); ?>><?php _e('default','geode'); ?></option>
                            <option value="expand" <?php selected(get_option('pix_style_button_footer_fx'), 'expand'); ?>><?php _e('expand color','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

                <label class="for_select" for="pix_style_button_footer_icon"><?php _e('Icons','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_footer_icon" id="pix_style_button_footer_icon">
                            <option value="" <?php selected(get_option('pix_style_button_footer_icon'), ''); ?>><?php _e('just show','geode'); ?></option>
                            <option value="hover" <?php selected(get_option('pix_style_button_footer_icon'), 'hover'); ?>><?php _e('show on hover only','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Footer default 2','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_button_footer2_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer2_color" name="pix_style_button_footer2_color" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer2_color')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer2_bg"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer2_bg" name="pix_style_button_footer2_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer2_bg')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer2_texthover"><?php _e('Text color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer2_texthover" name="pix_style_button_footer2_texthover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer2_texthover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer2_bghover"><?php _e('Background color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer2_bghover" name="pix_style_button_footer2_bghover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer2_bghover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer2_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer2_borderradius')); ?>" name="pix_style_button_footer2_borderradius" id="pix_style_button_footer2_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_button_footer2_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer2_bordercolor" name="pix_style_button_footer2_bordercolor" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer2_bordercolor')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_footer2_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer2_borderwidth')); ?>" name="pix_style_button_footer2_borderwidth" id="pix_style_button_footer2_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

                <label for="pix_style_button_footer2_bordercolorhover"><?php _e('Border color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_footer2_bordercolorhover" name="pix_style_button_footer2_bordercolorhover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_footer2_bordercolorhover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label class="for_select" for="pix_style_button_footer2_fx"><?php _e('Effect on hover','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_footer2_fx" id="pix_style_button_footer2_fx">
                            <option value="" <?php selected(get_option('pix_style_button_footer2_fx'), ''); ?>><?php _e('default','geode'); ?></option>
                            <option value="expand" <?php selected(get_option('pix_style_button_footer2_fx'), 'expand'); ?>><?php _e('expand color','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

                <label class="for_select" for="pix_style_button_footer2_icon"><?php _e('Icons','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_footer2_icon" id="pix_style_button_footer2_icon">
                            <option value="" <?php selected(get_option('pix_style_button_footer2_icon'), ''); ?>><?php _e('just show','geode'); ?></option>
                            <option value="hover" <?php selected(get_option('pix_style_button_footer2_icon'), 'hover'); ?>><?php _e('show on hover only','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->
        <h4 class="section_title"><span><?php _e('Top sliding bar default','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_button_top_sliding_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding_color" name="pix_style_button_top_sliding_color" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding_color')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding_bg"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding_bg" name="pix_style_button_top_sliding_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding_bg')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding_texthover"><?php _e('Text color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding_texthover" name="pix_style_button_top_sliding_texthover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding_texthover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding_bghover"><?php _e('Background color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding_bghover" name="pix_style_button_top_sliding_bghover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding_bghover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding_borderradius')); ?>" name="pix_style_button_top_sliding_borderradius" id="pix_style_button_top_sliding_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_button_top_sliding_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding_bordercolor" name="pix_style_button_top_sliding_bordercolor" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding_bordercolor')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding_borderwidth')); ?>" name="pix_style_button_top_sliding_borderwidth" id="pix_style_button_top_sliding_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

                <label for="pix_style_button_top_sliding_bordercolorhover"><?php _e('Border color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding_bordercolorhover" name="pix_style_button_top_sliding_bordercolorhover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding_bordercolorhover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label class="for_select" for="pix_style_button_top_sliding_fx"><?php _e('Effect on hover','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_top_sliding_fx" id="pix_style_button_top_sliding_fx">
                            <option value="" <?php selected(get_option('pix_style_button_top_sliding_fx'), ''); ?>><?php _e('default','geode'); ?></option>
                            <option value="expand" <?php selected(get_option('pix_style_button_top_sliding_fx'), 'expand'); ?>><?php _e('expand color','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

                <label class="for_select" for="pix_style_button_top_sliding_icon"><?php _e('Icons','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_top_sliding_icon" id="pix_style_button_top_sliding_icon">
                            <option value="" <?php selected(get_option('pix_style_button_top_sliding_icon'), ''); ?>><?php _e('just show','geode'); ?></option>
                            <option value="hover" <?php selected(get_option('pix_style_button_top_sliding_icon'), 'hover'); ?>><?php _e('show on hover only','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->

        <h4 class="section_title"><span><?php _e('Top sliding bar default 2','geode'); ?></span></h4>

        <div class="admin-section-toggle">
            <div class="pix_column_divider alignleft"></div><!-- .pix_column_divider -->
            <div class="pix_column alignleft">

                <label for="pix_style_button_top_sliding2_color"><?php _e('Text color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding2_color" name="pix_style_button_top_sliding2_color" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding2_color')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding2_bg"><?php _e('Background color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding2_bg" name="pix_style_button_top_sliding2_bg" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding2_bg')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding2_texthover"><?php _e('Text color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding2_texthover" name="pix_style_button_top_sliding2_texthover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding2_texthover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding2_bghover"><?php _e('Background color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding2_bghover" name="pix_style_button_top_sliding2_bghover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding2_bghover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding2_borderradius"><?php _e( 'Border radius', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding2_borderradius')); ?>" name="pix_style_button_top_sliding2_borderradius" id="pix_style_button_top_sliding2_borderradius">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

            </div><!-- .pix_column.first -->
            <div class="pix_column alignright">

                <label for="pix_style_button_top_sliding2_bordercolor"><?php _e('Border color','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding2_bordercolor" name="pix_style_button_top_sliding2_bordercolor" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding2_bordercolor')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label for="pix_style_button_top_sliding2_borderwidth"><?php _e( 'Border width', 'geode' ); ?>:</label>
                <div class="slider_div stroke">
                    <input type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding2_borderwidth')); ?>" name="pix_style_button_top_sliding2_borderwidth" id="pix_style_button_top_sliding2_borderwidth">
                    <div class="slider_cursor"></div>
                </div><!-- .slider_div -->
                <br>

                <label for="pix_style_button_top_sliding2_bordercolorhover"><?php _e('Border color on hover state','geode'); ?>:</label>
                <div class="pix_color_picker">
                    <input id="pix_style_button_top_sliding2_bordercolorhover" name="pix_style_button_top_sliding2_bordercolorhover" type="text" value="<?php echo esc_attr(get_option('pix_style_button_top_sliding2_bordercolorhover')); ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-elusive-cancel"></i>
                </div>
                <br>

                <label class="for_select" for="pix_style_button_top_sliding2_fx"><?php _e('Effect on hover','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_top_sliding2_fx" id="pix_style_button_top_sliding2_fx">
                            <option value="" <?php selected(get_option('pix_style_button_top_sliding2_fx'), ''); ?>><?php _e('default','geode'); ?></option>
                            <option value="expand" <?php selected(get_option('pix_style_button_top_sliding2_fx'), 'expand'); ?>><?php _e('expand color','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

                <label class="for_select" for="pix_style_button_top_sliding2_icon"><?php _e('Icons','geode'); ?>:
                    <span class="for_select">
                        <select name="pix_style_button_top_sliding2_icon" id="pix_style_button_top_sliding2_icon">
                            <option value="" <?php selected(get_option('pix_style_button_top_sliding2_icon'), ''); ?>><?php _e('just show','geode'); ?></option>
                            <option value="hover" <?php selected(get_option('pix_style_button_top_sliding2_icon'), 'hover'); ?>><?php _e('show on hover only','geode'); ?></option>
                        </select>
                    </span>
                </label>
                <br>

            </div><!-- .pix_column.second -->

        </div><!-- .admin-section-toggle -->
    </div><!-- .pix_columns -->
<?php }
endif;

if ( ! function_exists( 'geode_get_page_template' ) ) :
/**
* Get the page template
* @since Geode 1.0
*/
function geode_get_page_template($page=null) {
	global $post;
	if ( pix_is_woocommerce() ) {
		if ( is_shop() ) {
			$id_shop = woocommerce_get_page_id('shop');
			$page_template = get_post_meta( $id_shop, '_wp_page_template', true );
			$page_template = $page_template == '' ? get_option('pix_style_product_template') : $page_template;
		} elseif ( pix_is_product() ) {
			$page_template = get_post_meta( $post->ID, 'pix_page_template_select', true );
			$page_template = $page_template == '' ? get_option('pix_style_product_template') : $page_template;
		} elseif ( is_tax() ) {
			$t_slug = get_query_var( 'term' ).'_'.get_query_var( 'taxonomy' );
			$term_meta = get_option( "taxonomy_$t_slug" );
			$page_template = esc_attr( $term_meta['template'] );
			$page_template = $page_template == '' ? get_option('pix_style_woo_template') : $page_template;
		}
	} elseif ( is_tax('portfolio_category') || is_tax('portfolio_tag') || is_post_type_archive('portfolio') || is_category() || is_archive() ) {
		if (is_tax('portfolio_category') || is_tax('portfolio_tag') || is_post_type_archive('portfolio'))
			$page_template = get_option('pix_style_portfolio_template');
		else
			$page_template = get_option('pix_style_archive_template');

		if ( is_category() ) {
			global $cat;
			$id = $cat;
			$term = get_category($id);
			$t_slug = $term->slug.'_category';
			$term_meta = get_option( "taxonomy_$t_slug" );
			$page_template = isset( $term_meta['template'] ) && $term_meta['template']!='' ? esc_attr( $term_meta['template'] ) : $page_template;
		} else {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if ( $term )
				$id = $term->term_id;
			if ( isset($id) ) {
				$term = get_term_by('id',$id, get_query_var( 'taxonomy' ) );
				$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
				$term_meta = get_option( "taxonomy_$t_slug" );
				$page_template = isset( $term_meta['template'] ) && $term_meta['template']!='' ? esc_attr( $term_meta['template'] ) : $page_template;
			}
		}

	} elseif ( is_home() && get_option('pix_content_latest_post_page')!='' ) {
		$page_template = get_post_meta( get_option('pix_content_latest_post_page'), '_wp_page_template', true );
	} elseif ( is_search() && get_option('pix_content_search_page')!='' ) {
		$page_template = get_post_meta( get_option('pix_content_search_page'), '_wp_page_template', true );
	} elseif ( is_singular('post') ) {
		$page_template = get_post_meta( $post->ID, 'pix_page_template_select', true );
		$page_template = $page_template == '' ? get_option('pix_style_single_template') : $page_template;
	} elseif ( is_singular('portfolio') ) {
		$page_template = get_post_meta( $post->ID, 'pix_page_template_select', true );
		$page_template = $page_template == '' ? get_option('pix_style_single_portfolio_template') : $page_template;
	} elseif ( is_singular('team') ) {
		$page_template = 'templates/wide-page.php';
	} elseif ( is_page() ) {
		$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
	}
	if ( $page==null ) {
		return (!isset($page_template) || $page_template == '') ? 'default' : $page_template;
	} else {
		return $page == $page_template;
	}
}
endif;

if ( ! function_exists( 'pix_attachment_meta_by_url' ) ) :
/**
* Get the attachment ID by url
* @since Geode 1.0
*/
function pix_attachment_meta_by_url( $image_src ) {

    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);

    if($id != null){
    	$array = wp_get_attachment_metadata($id);
    	if (is_array($array)) {
			$meta['width'] = $array['width'];
			$meta['height'] = $array['height'];
		} else {
			$meta['width'] = '';
			$meta['height'] = '';
		}
    } else {
        $image_src = basename ( $image_src );
        $q2 = "SELECT post_id FROM {$wpdb->postmeta}  WHERE meta_key = '_wp_attachment_metadata' AND meta_value LIKE '%$image_src%'";
        $id = $wpdb->get_var($q2);
	    $array = wp_get_attachment_metadata($id);
	    if ( isset($array['sizes']) ) {
		    foreach ($array['sizes'] as $key => $value) {
		    	if ( in_array($image_src, $value) ) {
		    		$meta['width'] = $value['width'];
		    		$meta['height'] = $value['height'];
		    		break;
		    	}
		    }
		}
    }

    $meta['id'] = $id;

    return $meta;

}
endif;

if ( ! function_exists( 'geode_get_scroll_down' ) ) :
/**
* Display the scroll down button
* @since Geode 1.0
*/
function geode_get_scroll_down(){
	global $post;
	if (!$post)
		return;
	if ( pix_is_woocommerce() && is_shop() ) {
		$id = woocommerce_get_page_id('shop');
	} else {
		$id = $post->ID;
	}
	if ( get_post_meta( $id, 'pix_enable_scroll_down', true )=='on' ) {
		return '<a href="#" id="scroll-down"></a>';
	} else {
		return;
	}
}
endif;

if ( ! function_exists( 'geode_setCustomBgImg' ) ) :
/**
* Display the body fullscreen image background
* @since Geode 1.6.7
*/
add_action( 'wp_head', 'geode_setCustomBgImg' );
function geode_setCustomBgImg(){
	global $post;
	/* ID */
	if ( is_category() ) {
		global $cat;
		$id = $cat;
		$term = get_category($id);
		$t_slug = $term->slug.'_category';
		$term_meta = get_option( "taxonomy_$t_slug" );
	} elseif ( isset(get_queried_object()->term_id) || isset(get_queried_object()->ID) ) {
	    $id = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : '';
		$tax = get_query_var( 'taxonomy' );
		$t_slug = get_queried_object()->slug.'_'.$tax;
		$term_meta = get_option( "taxonomy_$t_slug" );
	    $id = isset(get_queried_object()->ID) ? get_queried_object()->ID : $id;
	} elseif ( pix_is_woocommerce() && is_shop() ) {
		$id = woocommerce_get_page_id('shop');
	} else {
		if ( !$post )
			return;
		if ( $post && $post->ID == get_option('pix_content_latest_post_page') ) {
			$id = get_option('pix_content_latest_post_page');
		} else {
			return;
		}
	}

	/* BG */
	$bg_type = '';
    if ( isset( $term_meta['bg'] ) && $term_meta['bg']!='' ) {
		$bg_type = esc_attr( $term_meta['bg'] );
		$bg_img = wp_get_attachment_image_src ( esc_attr( $term_meta['bg_id'] ), esc_attr( $term_meta['bg_size'] ) );
	    $bg_img = $bg_img[0];
    } elseif ( (is_tax('portfolio_category') || is_tax('portfolio_tag') || is_post_type_archive('portfolio')) && get_option('pix_style_portfolio_list_bg') ) {
	    $bg_type = get_option('pix_style_portfolio_list_bg');
	    $bg_img = get_option('pix_style_portfolio_list_bg_img');
	} elseif ( ( is_home() || is_page() || (pix_is_woocommerce() && is_shop())) && get_post_meta( $id, 'pix_page_bg', true )!='' ) {
	    $bg_type = get_post_meta( $id, 'pix_page_bg', true );
	    $bg_img = wp_get_attachment_image_src( get_post_meta( $id, 'pix_page_bg_id', true ), get_post_meta( $id, 'pix_page_bg_size', true ) );
	    $bg_img = $bg_img[0];
	} elseif ( is_singular() && !is_singular('portfolio') && !pix_is_product() ) {
	    $bg_type = get_post_meta( $id, 'pix_page_bg', true ) != '' ? get_post_meta( $id, 'pix_page_bg', true ) : get_option('pix_style_single_bg');
	    $bg_img = get_post_meta( $id, 'pix_page_bg_id', true ) != '' ? 
	    	wp_get_attachment_image_src( get_post_meta( $id, 'pix_page_bg_id', true ), get_post_meta( $id, 'pix_page_bg_size', true ) ) : 
	    	get_option('pix_style_single_bg_img');
	    $bg_img = is_array($bg_img) ? $bg_img[0] : $bg_img;
	} elseif ( is_singular('portfolio') ) {
	    $bg_type = get_post_meta( $id, 'pix_page_bg', true ) != '' ? get_post_meta( $id, 'pix_page_bg', true ) : get_option('pix_style_single_portfolio_bg');
	    $bg_img = get_post_meta( $id, 'pix_page_bg_id', true ) != '' ? 
	    	wp_get_attachment_image_src( get_post_meta( $id, 'pix_page_bg_id', true ), get_post_meta( $id, 'pix_page_bg_size', true ) ) : 
	    	get_option('pix_style_single_portfolio_bg_img');
	    $bg_img = is_array($bg_img) ? $bg_img[0] : $bg_img;
	} elseif ( pix_is_woocommerce() && pix_is_product() ) {
	    $bg_type = get_post_meta( $id, 'pix_page_bg', true ) != '' ? get_post_meta( $id, 'pix_page_bg', true ) : get_option('pix_style_product_bg');
	    $bg_img = get_post_meta( $id, 'pix_page_bg_id', true ) != '' ? 
	    	wp_get_attachment_image_src( get_post_meta( $id, 'pix_page_bg_id', true ), get_post_meta( $id, 'pix_page_bg_size', true ) ) : 
	    	get_option('pix_style_product_bg_img');
	    $bg_img = is_array($bg_img) ? $bg_img[0] : $bg_img;
	} elseif ( pix_is_woocommerce() && get_option( 'pix_style_woo_list_bg' ) != '' ) {
	    $bg_type = get_option( 'pix_style_woo_list_bg' );
	    $bg_img = get_option( 'pix_style_woo_list_bg_img' );
	}

	/* COLOR */
    if ( isset( $term_meta['title_color'] ) && $term_meta['title_color']!='' ) {
		$color = esc_attr( $term_meta['title_color'] );
    } elseif ( ( is_tax('portfolio_category') || is_tax('portfolio_tag') ) && get_option('pix_style_portfolio_title_color')!='' ) {
		$color = get_option('pix_style_portfolio_title_color');
	} elseif ( ( is_home() || is_page() || (pix_is_woocommerce() && is_shop())) && get_post_meta( $id, 'pix_color_title', true )!='' ) {
		$color = get_post_meta( $id, 'pix_color_title', true );
	} elseif ( is_singular() && !is_singular('portfolio') && !pix_is_product() ) {
		$color = get_post_meta( $id, 'pix_color_title', true ) != '' ? get_post_meta( $id, 'pix_color_title', true ) : get_option('pix_style_single_color');
	} elseif ( is_singular('portfolio') ) {
		$color = get_post_meta( $id, 'pix_color_title', true ) != '' ? get_post_meta( $id, 'pix_color_title', true ) : get_option('pix_style_single_portfolio_color');
	} elseif ( pix_is_woocommerce() && pix_is_product() ) {
		$color = get_post_meta( $id, 'pix_color_title', true ) != '' ? get_post_meta( $id, 'pix_color_title', true ) : get_option('pix_style_product_color');
	} elseif ( pix_is_woocommerce() && get_option( 'pix_style_woo_title_color' ) != '' ) {
		$color = get_option( 'pix_style_woo_title_color' );
	}

	if ( isset( $color ) && $color != '' ) {
		$css_color = "header.entry-header .entry-title, nav#breadcrumbs {
	color: $color;
}
header.entry-header .entry-title {
	border-color: $color;
}";
	} else {
		$css_color = '';
	}

    if ( $bg_type=='image' ) {
	    echo "<style>
	body {
		background-attachment: fixed;
		background-size: cover;
		background-repeat: no-repeat;
	}
	#bgBody {
		background-image: url($bg_img);
		background-size: cover;
		background-repeat: no-repeat;
	}".
	$css_color
	."
</style>";
    } elseif ( $bg_type=='video' || $bg_type=='googlemap' || $bg_type=='none' ) {
	    echo "<style>
	#bgBody {
		background-image: none;
	}".
	$css_color
	."
</style>";
    } else {
	    echo "<style>
	".
	$css_color
	."
</style>";
    }
}
endif;

if ( ! function_exists( 'geode_set_transpar_header_body_class' ) ) :
/**
* Display the body fullscreen background (not image)
* @since Geode 1.7.4.2
*/
add_filter( 'body_class', 'geode_set_transpar_header_body_class' );
function geode_set_transpar_header_body_class($classes){
	global $post;

	if ( is_single() || is_page() || (pix_is_woocommerce() && is_shop()) && ( !is_category() && ! ( isset(get_queried_object()->term_id) ) )  ) {
    	$post_id = $post->ID;
    	if ( (pix_is_woocommerce() && is_shop()) )
    		$post_id = woocommerce_get_page_id('shop');

	    $transpar = get_post_meta( $post_id, 'pix_transparent_header', true );
	    if ( $transpar == 'on' )
	    	$classes[] = 'transparent-header';
	} else {
		if ( is_category() ) {
			global $cat;
			$id = $cat;
			$term = get_category($id);
			$t_slug = $term->slug.'_category';
			$term_meta = get_option( "taxonomy_$t_slug" );

		    if ( isset( $term_meta['transparent_header'] ) && $term_meta['transparent_header']!='' ) {
		    	$classes[] = 'transparent-header';
			}

		} elseif ( isset(get_queried_object()->term_id) || isset(get_queried_object()->ID) ) {
		    $id = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : '';
			$tax = get_query_var( 'taxonomy' );
			$t_slug = get_queried_object()->slug.'_'.$tax;
			$term_meta = get_option( "taxonomy_$t_slug" );
		    $id = isset(get_queried_object()->ID) ? get_queried_object()->ID : $id;

		    if ( isset( $term_meta['transparent_header'] ) && $term_meta['transparent_header']!='' ) {
		    	$classes[] = 'transparent-header';
			}

		}
	}

    return $classes;
}
endif;

if ( ! function_exists( 'geode_logo_transparent' ) ) :
/**
* Display the body fullscreen background (not image)
* @since Geode 1.0
*/
add_filter( 'geode_logo_transparent', 'geode_logo_transparent' );
function geode_logo_transparent(){
	global $post;
    if ( is_single() || is_page() || (pix_is_woocommerce() && is_shop()) && ( !is_category() && ! ( isset(get_queried_object()->term_id) ) )  ) {
    	$post_id = $post->ID;
    	if ( (pix_is_woocommerce() && is_shop()) )
    		$post_id = woocommerce_get_page_id('shop');

		$logo_transp_id = get_post_meta( $post_id, 'pix_alt_logo_id', true );
		$logo_transp_size = get_post_meta( $post_id, 'pix_alt_logo_size', true );
		if ( isset($logo_transp_id) && $logo_transp_id != '' ) {
			return $logo_transp = wp_get_attachment_image( $logo_transp_id, $logo_transp_size, false, array('class' => "geode-transparent-logo") );
		}
	} else {
		if ( is_category() ) {
			global $cat;
			$id = $cat;
			$term = get_category($id);
			$t_slug = $term->slug.'_category';
			$term_meta = get_option( "taxonomy_$t_slug" );

			$logo_transp_id = $term_meta['transparent_header_logo_id'];
			$logo_transp_size = $term_meta['transparent_header_logo_size'];;
			if ( isset($logo_transp_id) && $logo_transp_id != '' ) {
				return $logo_transp = wp_get_attachment_image( $logo_transp_id, $logo_transp_size, false, array('class' => "geode-transparent-logo") );
			}

		} elseif ( isset(get_queried_object()->term_id) || isset(get_queried_object()->ID) ) {
		    $id = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : '';
			$tax = get_query_var( 'taxonomy' );
			$t_slug = get_queried_object()->slug.'_'.$tax;
			$term_meta = get_option( "taxonomy_$t_slug" );
		    $id = isset(get_queried_object()->ID) ? get_queried_object()->ID : $id;

			$logo_transp_id = $term_meta['transparent_header_logo_id'];
			$logo_transp_size = $term_meta['transparent_header_logo_size'];;
			if ( isset($logo_transp_id) && $logo_transp_id != '' ) {
				return $logo_transp = wp_get_attachment_image( $logo_transp_id, $logo_transp_size, false, array('class' => "geode-transparent-logo") );
			}

		}
	}
}
endif;


if ( ! function_exists( 'geode_set_transpar_header' ) ) :
/**
* Display the body fullscreen background (not image)
* @since Geode 1.7.4.1
*/
add_action( 'wp_head', 'geode_set_transpar_header' );
function geode_set_transpar_header(){
	global $post;

	if ( ( is_single() || is_page() || (pix_is_woocommerce() && is_shop()) || $post ) && ( !is_category() && ! ( isset(get_queried_object()->term_id) ) ) ) {

		$post_id = $post->ID;

		if ( (pix_is_woocommerce() && is_shop()) )
			$post_id = woocommerce_get_page_id('shop');

	    $transpar = get_post_meta( $post_id, 'pix_transparent_header', true );
	    $color = get_post_meta( $post_id, 'pix_color_header', true );
	    $logo_id = get_post_meta( $post_id, 'pix_alt_logo_id', true );
	    $logo_size = get_post_meta( $post_id, 'pix_alt_logo_size', true );

    } else {

     	if ( is_category() ) {
			global $cat;
			$id = $cat;
			$term = get_category($id);
			$t_slug = $term->slug.'_category';
			$term_meta = get_option( "taxonomy_$t_slug" );

		    if ( isset( $term_meta['transparent_header'] ) && $term_meta['transparent_header']!='' ) {
		    	$transpar = 'on';
			}
		    if ( isset( $term_meta['transparent_header_color'] ) && $term_meta['transparent_header_color']!='' ) {
		    	$color = $term_meta['transparent_header_color'];
			}
		    if ( isset( $term_meta['transparent_header_logo_id'] ) && $term_meta['transparent_header_logo_id']!='' ) {
		    	$logo_id = $term_meta['transparent_header_logo_id'];
			}
		    if ( isset( $term_meta['transparent_header_logo_size'] ) && $term_meta['transparent_header_logo_size']!='' ) {
		    	$logo_size = $term_meta['transparent_header_logo_size'];
			}

		} elseif ( isset(get_queried_object()->term_id) || isset(get_queried_object()->ID) ) {
		    $id = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : '';
			$tax = get_query_var( 'taxonomy' );
			$t_slug = get_queried_object()->slug.'_'.$tax;
			$term_meta = get_option( "taxonomy_$t_slug" );
		    $id = isset(get_queried_object()->ID) ? get_queried_object()->ID : $id;

		    if ( isset( $term_meta['transparent_header'] ) && $term_meta['transparent_header']!='' ) {
		    	$transpar = 'on';
			}
		    if ( isset( $term_meta['transparent_header_color'] ) && $term_meta['transparent_header_color']!='' ) {
		    	$color = $term_meta['transparent_header_color'];
			}
		    if ( isset( $term_meta['transparent_header_logo_id'] ) && $term_meta['transparent_header_logo_id']!='' ) {
		    	$logo_id = $term_meta['transparent_header_logo_id'];
			}
		    if ( isset( $term_meta['transparent_header_logo_size'] ) && $term_meta['transparent_header_logo_size']!='' ) {
		    	$logo_size = $term_meta['transparent_header_logo_size'];
			}
		} else {
	    	return;
		}

    }

    if ( $transpar == 'on' ) {
    	$css = '<style>';

    	$css .= 'body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #above_header,
    	body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #above_header,
    	body.transparent-header:not(.headerQuickHover):not(.mobHeaderHover):not(.headerHover) #header_affix-sticky-wrapper:not(.is-sticky) #wrap_header,
    	body.transparent-header:not(.headerQuickHover):not(.mobHeaderHover):not(.headerHover) #page > #header_affix #wrap_header {
    		background-color: transparent;
    	}';
    	$css .= 'body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #above_header,
    	body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #above_header,
    	body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #wrap_header,
    	body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #wrap_header {
    		color: '.$color.';
    	}
    	body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #above_header .top_bar_drop_down a:before,
    	body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #above_header .top_bar_drop_down a:before,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #above_header .top_bar_drop_down a:after,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #above_header .top_bar_drop_down a:after {
		    background: '.$color.';
		}
    	body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #wrap_header,
    	body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #wrap_header {
		    -webkit-box-shadow: 0 1px 0 rgba('.pix_hex2rgbcompiled($color).',0);
		    box-shadow: 0 1px 0 rgba('.pix_hex2rgbcompiled($color).',0);
		}';
		if ( geode_logo_transparent()!='' ) {
			$css .= 'body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) header#masthead .home-link h1 img,
			body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix header#masthead .home-link h1 img,
			body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) header#masthead .home-link h1 svg,
			body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix header#masthead .home-link h1 svg {
				opacity: 0;
			}
			body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) header#masthead .home-link h1 img.geode-transparent-logo,
			body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix header#masthead .home-link h1 img.geode-transparent-logo,
			body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) header#masthead .home-link h1 svg.geode-transparent-logo,
			body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix header#masthead .home-link h1 svg.geode-transparent-logo {
				opacity: 1;
			}';
		}
		$css .= 'body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #above_header:after,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #above_header:after {
		    background-color: '.$color.';
		    opacity: .25;
		}
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #above_header .top_bar .amount_appended,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #above_header .top_bar .amount_appended,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #navbar .amount_appended,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #navbar .amount_appended {
			background: transparent!important;
			border-color: '.$color.';
			color: '.$color.';
		}
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) header#masthead .home-link,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix header#masthead .home-link {
			background: transparent;
		}
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) header#masthead .home-link h1.site-title,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix header#masthead .home-link h1.site-title {
    		color: '.$color.'!important;
		}
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover).header-centered #header_affix-sticky-wrapper:not(.is-sticky) header#masthead #navbar,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover).header-centered #page > #header_affix header#masthead #navbar {
		    background-color: transparent;
		    border-top-color: transparent!important;
		}
    	/*body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover).header-centered #header_affix-sticky-wrapper:not(.is-sticky) header#masthead #navbar:after,
    	body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover).header-centered #page > #header_affix header#masthead #navbar:after {
		    background-color: '.$color.';
		    opacity: .25;
		}*/
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) header#masthead #navbar > nav > div > div[role="list"] > div[role="listitem"] > a,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix header#masthead #navbar > nav > div > div[role="list"] > div[role="listitem"] > a {
    		color: '.$color.';
		}
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) header#masthead #navbar > nav > div > div[role="list"] > div[role="listitem"].current-menu-item > span:after,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix header#masthead #navbar > nav > div > div[role="list"] > div[role="listitem"].current-menu-item > span:after {
			background-color: '.$color.';
		}
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #navbar #expand-menu .burger,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #navbar #expand-menu .burger,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #navbar #expand-menu .burger:before,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #navbar #expand-menu .burger:before,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #header_affix-sticky-wrapper:not(.is-sticky) #navbar #expand-menu .burger:after,
		body.transparent-header:not(.headerQuickHover):not(.headerHover):not(.mobHeaderHover) #page > #header_affix #navbar #expand-menu .burger:after {
			background: '.$color.';
		}';
    	$css .= '</style>';

	    echo geode_min_css($css);
    }


}
endif;

if ( ! function_exists( 'geode_setCustomBgPage' ) ) :
/**
* Display the body fullscreen background (not image)
* @since Geode 1.0
*/
add_action( 'pix_page_bg', 'geode_setCustomBgPage' );
function geode_setCustomBgPage(){
	global $post;

    if ( !$post )
    	return;

	if ( pix_is_woocommerce() && is_shop() ) {
		$id = woocommerce_get_page_id('shop');
	} else {
		$id = $post->ID;
	}
    $bg_type = get_post_meta( $id, 'pix_page_bg', true );
    $bg_video = '';

    if ( $bg_type=='video' ) {
    	if ( get_post_meta( $id, 'pix_page_bg_mp4', true )!='' ) {
			$bg_video .= "<source type='video/mp4' src='".get_post_meta( $id, 'pix_page_bg_mp4', true )."'>";	
    	}
    	if ( get_post_meta( $id, 'pix_page_bg_ogg', true )!='' ) {
			$bg_video .= "<source type='video/ogg' src='".get_post_meta( $id, 'pix_page_bg_ogg', true )."'>";	
    	}
    	if ( get_post_meta( $id, 'pix_page_bg_webm', true )!='' ) {
			$bg_video .= "<source type='video/webm' src='".get_post_meta( $id, 'pix_page_bg_webm', true )."'>";	
    	}
	    
	    echo "<video id='pix_page_video' class='pix_section_video pix_video' data-autoplay='true' data-loop='true' data-volume='0.0' data-fullsize='true'>$bg_video</video>";
    } elseif ( $bg_type=='googlemap' ) {
	    echo do_shortcode(html_entity_decode(get_post_meta( $id, 'pix_page_bg_gmap', true )));
    }
}
endif;

if ( ! function_exists( 'geode_setCustomBgTitle' ) ) :
/**
* Display the title background
* @since Geode 1.7.5
*/
add_action( 'pix_title_bg', 'geode_setCustomBgTitle' );
function geode_setCustomBgTitle(){
	global $post;
	if ( is_category() ) {
		global $cat;
		$id = $cat;
		$term = get_category($id);
		$t_slug = $term->slug.'_category';
		$term_meta = get_option( "taxonomy_$t_slug" );
	} elseif ( isset(get_queried_object()->term_id) || isset(get_queried_object()->ID) ) {
	    $id = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : '';
		$tax = get_query_var( 'taxonomy' );
		$t_slug = get_queried_object()->slug.'_'.$tax;
		$term_meta = get_option( "taxonomy_$t_slug" );
	    $id = isset(get_queried_object()->ID) ? get_queried_object()->ID : $id;
	} elseif ( pix_is_woocommerce() && is_shop() ) {
		$id = woocommerce_get_page_id('shop');
	} else {
		if ( !$post )
			return;
		if ( $post && $post->ID == get_option('pix_content_latest_post_page') ) {
			$id = get_option('pix_content_latest_post_page');
		} else {
			return;
		}
	}

	if ( get_option('pix_style_bg_title_img')!='' ) {
	    $bg_type = 'image';
		$bg_img = get_option('pix_style_bg_title_img');
	}

    if ( isset( $term_meta['bg_title'] ) && $term_meta['bg_title']!='' ) {
	    $bg_type = esc_attr( $term_meta['bg_title'] );
		$bg_img = wp_get_attachment_image_src ( esc_attr( $term_meta['bg_title_id'] ), esc_attr( $term_meta['bg_title_size'] ) );
	    $bg_img = $bg_img[0];	
    } elseif ( (is_tax('portfolio_category') || is_post_type_archive('portfolio') || is_tax('portfolio_tag')) && get_option('pix_style_portfolio_list_bg_title') ) {
	    $bg_type = get_option('pix_style_portfolio_list_bg_title');
	    $bg_img = get_option('pix_style_portfolio_list_bg_title_img');
	} elseif ( ( is_home() || is_page() || (pix_is_woocommerce() && is_shop())) && get_post_meta( $id, 'pix_title_bg', true )!='' ) {
	    $bg_type = get_post_meta( $id, 'pix_title_bg', true );
	    $bg_img = wp_get_attachment_image_src( get_post_meta( $id, 'pix_title_bg_id', true ), get_post_meta( $id, 'pix_title_bg_size', true ) );
	    $bg_img = $bg_img[0];	
	} elseif ( is_singular() && !is_singular('portfolio') && !pix_is_product() && !is_page() ) {
	    $bg_type = get_post_meta( $id, 'pix_title_bg', true ) != '' ? get_post_meta( $id, 'pix_title_bg', true ) : get_option('pix_style_single_bg_title');
	    $bg_img = get_post_meta( $id, 'pix_title_bg_id', true ) != '' ? 
	    	wp_get_attachment_image_src( get_post_meta( $id, 'pix_title_bg_id', true ), get_post_meta( $id, 'pix_title_bg_size', true ) ) : 
	    	get_option('pix_style_single_bg_title_img');
	    $bg_img = is_array($bg_img) ? $bg_img[0] : $bg_img;
	} elseif ( is_singular('portfolio') ) {
	    $bg_type = get_post_meta( $id, 'pix_title_bg', true ) != '' ? get_post_meta( $id, 'pix_title_bg', true ) : get_option('pix_style_single_portfolio_bg_title');
	    $bg_img = get_post_meta( $id, 'pix_title_bg_id', true ) != '' ? 
	    	wp_get_attachment_image_src( get_post_meta( $id, 'pix_title_bg_id', true ), get_post_meta( $id, 'pix_title_bg_size', true ) ) : 
	    	get_option('pix_style_single_portfolio_bg_title_img');
	    $bg_img = is_array($bg_img) ? $bg_img[0] : $bg_img;
	} elseif ( pix_is_woocommerce() && pix_is_product() ) {
	    $bg_type = get_post_meta( $id, 'pix_title_bg', true ) != '' ? get_post_meta( $id, 'pix_title_bg', true ) : get_option('pix_style_product_bg_title');
	    $bg_img = get_post_meta( $id, 'pix_title_bg_id', true ) != '' ? 
	    	wp_get_attachment_image_src( get_post_meta( $id, 'pix_title_bg_id', true ), get_post_meta( $id, 'pix_title_bg_size', true ) ) : 
	    	get_option('pix_style_product_bg_title_img');
	    $bg_img = is_array($bg_img) ? $bg_img[0] : $bg_img;
	} elseif ( pix_is_woocommerce() && get_option( 'pix_style_woo_list_bg_title' ) != '' ) {
	    $bg_type = get_option( 'pix_style_woo_list_bg_title' );
	    $bg_img = get_option( 'pix_style_woo_list_bg_title_img' );
	}
    $bg_video = '';


	if ( !isset($bg_type) )
		return;

    if ( $bg_type=='image' ) {
	    echo "<div id='bgTitle' style='background-image:url($bg_img)' " . apply_filters("bgTitle","data-pix-ratio='0.35'") . "></div>";
    } elseif ( $bg_type=='video' ) {
    	if ( get_post_meta( $id, 'pix_title_bg_mp4', true )!='' ) {
			$bg_video .= "<source type='video/mp4' src='".get_post_meta( $id, 'pix_title_bg_mp4', true )."'>";	
    	}
    	if ( get_post_meta( $id, 'pix_title_bg_ogg', true )!='' ) {
			$bg_video .= "<source type='video/ogg' src='".get_post_meta( $id, 'pix_title_bg_ogg', true )."'>";	
    	}
    	if ( get_post_meta( $id, 'pix_title_bg_webm', true )!='' ) {
			$bg_video .= "<source type='video/webm' src='".get_post_meta( $id, 'pix_title_bg_webm', true )."'>";	
    	}
	    
		if ( get_post_meta( $id, 'pix_title_bg_id', true )!='' ) {
		    $bg_img = wp_get_attachment_image_src( get_post_meta( $id, 'pix_title_bg_id', true ), get_post_meta( $id, 'pix_title_bg_size', true ) );
		    $bg_img = $bg_img[0];
		    echo "<div id='bgTitle' style='background-image:url(" . esc_url( $bg_img ) . "' " . apply_filters("bgTitle","data-pix-ratio='0.35'") . " data-bg='" . esc_url( $bg_img ) . "'></div>";
		}

	    echo "<video id='pix_title_video' class='pix_title_video pix_section_video pix_video' data-autoplay='true' data-loop='true' data-volume='0.0' data-fullsize='true'>$bg_video</video>";
    } elseif ( $bg_type=='googlemap' ) {
	    echo do_shortcode(html_entity_decode(get_post_meta( $id, 'pix_title_bg_gmap', true )));
    }
}
endif;

if ( ! function_exists( 'pix_hide_title' ) ) :
/**
* Hide the title
* @since Geode 1.0
*/
function pix_hide_title(){
	global $post;

    if ( !$post )
    	return;

	if ( pix_is_woocommerce() && is_shop() ) {
		$id = woocommerce_get_page_id('shop');
	} else {
		$id = $post->ID;
	}
    $hide_title = get_post_meta( $id, 'pix_hide_title', true );
    if ( $hide_title=='on' ) {
    	return true;
    } else {
	    return false;
    }
}
endif;

if ( ! function_exists( 'geode_search_form' ) ) :
/**
 * Customize search form.
 * @since Geode 1.0
 */
function geode_search_form( $form ) {
	$search_query = isset($_GET['nf']) ? $_GET['nf'] : get_search_query();
    $form = '<form role="search" method="get" class="search-form cf" action="' . esc_url( home_url( '/' ) ) . '">';
    if ( is_rtl() ) {
    	$form .= '<button type="submit" data-id="searchsubmit"><i class="scicon-awesome-search"></i></button>
    	<label>
    	<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'geode' ) . '" value="' . $search_query . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'geode' ) . '">
    </label>';
    } else {
    	$form .= '<label>
    	<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'geode' ) . '" value="' . $search_query . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'geode' ) . '">
    </label>
    <button type="submit" data-id="searchsubmit"><i class="scicon-awesome-search"></i></button>';
    }
    $form .= '</form>';

    return $form;
}
add_filter( 'get_search_form', 'geode_search_form' );
endif;

if ( ! function_exists( 'geode_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 * @since Geode 1.0
 */
function geode_posted_on($data='') {
	$out = '';
	if ( 'post' == get_post_type() ) {
		if ( ($data=='' || $data=='date') && is_single() ) {
			$out .= "<span class='entry-date'><a href='".esc_url( get_permalink() )."' rel='bookmark'><time class='entry-date' datetime='".esc_attr( get_the_date( "c" ) )."'>".esc_html( get_the_date() )."</time></a></span>"; 

		} elseif ( ($data=='' || $data=='date') && !is_single() ) {
			$out .= "<a href='".esc_url( get_permalink() )."' rel='bookmark'>".geode_pretty_posted_on()."</a>";

		} elseif ( $data=='meta' ) {
			$out .= "<span class='author vcard'><a class='url fn n' href='".esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) )."' rel='author'>".__(sprintf("%s",get_the_author()),"geode")."</a></span>\n
<span class='category-list alignright'>".get_the_category_list( __( ', ', 'geode' ) )."</span>";

		} elseif ( $data=='category' ) {
			$out .= "<span class='category-list'>".get_the_category_list( ', ' )."</span>";
		}
	} elseif ( 'portfolio' == get_post_type() ) {
		if ( $data=='category' ) 
			$out .= "<span class='category-list'>".get_the_term_list( get_the_id(), 'portfolio_category', '', ', ', '' )."</span>";
	}
	echo $out;
}
endif;

if ( ! function_exists( 'geode_pretty_posted_on' ) ) :
/**
 * Prints pretty post date.
 * @since Geode 1.0
 */
function geode_pretty_posted_on() {
	$post_date = the_date( 'Y-m-d','','', false );
	$month_ago = date( "Y-m-d", mktime(0,0,0,date("m")-1, date("d"), date("Y")) );
	$post_date = sprintf( __( '%1$s ago', 'geode' ), human_time_diff( get_the_time('U'), current_time('timestamp') ) );
	$out = sprintf( __( '<time class="entry-date" datetime="%1$s">%2$s</time>', 'geode' ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( $post_date )
	);
	return $out;

}
endif;

if ( ! function_exists( 'geode_is_related' ) ) :
/**
 * Conditional tag: if you are inside a "related items" loop.
 * @since Geode 1.0
 */
function geode_is_related() {
    global $wp_query;
    if ( property_exists($wp_query, 'geode_is_related') )
	    return $wp_query->geode_is_related;
	else
		return false;
}
endif;

if ( ! function_exists( 'geode_related_posts' ) ) :
/**
 * Print the related posts below the single post.
 * @since Geode 1.5.2
 */
function geode_related_posts() {
    global $post, $wp_query;

    $go_on = apply_filters('geode_related_items_enabled', true);

    if ( !$go_on )
    	return;

    $slides = apply_filters('geode_related_columns', '3');

    $wp_query->geode_is_related = true;

    $orig_post = $post;
    $original_single = $wp_query->is_single;
    $wp_query->is_single = false;
    $post_type = get_post_type($post);
    $original_query_archive = $wp_query->is_archive;
    $wp_query->is_archive = true;

    if ( $post_type == 'portfolio' ) {
    	$tags = wp_get_object_terms( $post->ID, 'portfolio_tag', array('fields' => 'ids') );
	    $original_query = $wp_query->is_post_type_archive;
	    $wp_query->is_post_type_archive = 'portfolio';
	} else {
		$tags = wp_get_post_tags( $post->ID );
	}

    $count = 0;

    $post_array = array();

    if ($tags) {
    	$tag_ids = array();  
	    foreach($tags as $tag) $tag_ids[] = $tag->term_id; 

    	$args = array(
            'post_type' => $post_type,
            'post__not_in' => array($orig_post->ID),
            'posts_per_page'=> -1,
            'ignore_sticky_posts' => 1,
	        'posts_per_page'=> apply_filters('geode_related_ppp', get_option('posts_per_page')),
	        'orderby' => 'rand'
        );
        if ( $post_type == 'portfolio' ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_tag',
				'field'    => 'term_id',
				'terms'    => $tags
				)
			) ;           	
        } else {
			$args['tag__in'] = $tag_ids;
        }

	    $query_related = new wp_query( $args );

        if( $query_related->have_posts() ) { ?>
	        <div class="row" id="related-items-section">
		        <div class="row-inside">
		        	<h3 id="related-items-title"><?php _e('Related items', 'geode'); ?></h3>
		        	<div class="archive-list related-list related-columns-<?php echo $slides; ?> geode-carousel" data-opts='{"mode":"horizontal","timeout":"7000","speed":"750","autoplay":"false","hover":"true","play_pause":"false","prev_next":"true","bullets":"false","minslides":"<?php echo $slides; ?>","maxslides":"<?php echo $slides; ?>","slidemargin":"20"}'>
					<?php while ( $query_related->have_posts() ) : $query_related->the_post();
			            if ( $post_type == 'portfolio' ) {
							get_template_part( 'portfolio/content', get_post_format() );
						} else {
							get_template_part( 'content', get_post_format() );
						}
					endwhile; ?>
		        	</div><!-- .archive-list.related-list.geode-carousel -->
		        </div><!-- .row-inside -->
	        </div><!-- .row#related-items-section -->
        <?php }
    }

    wp_reset_query();
    $wp_query->is_single = $original_single;
    $wp_query->is_archive = $original_query_archive;
    $post = $orig_post;
}
endif;

if ( ! function_exists( 'geode_related_columns' ) ) :
/**
 * Set the number of related items columns.
 * @since Geode 1.0
 */
add_filter( 'geode_related_columns', 'geode_related_columns' );
function geode_related_columns() {
	global $post;
	$layout = geode_get_page_template();

	switch ($layout) {
		case 'templates/wide-page.php':
		case 'templates/front-page.php':
	    	$columns = '4';	
			break;
		case 'templates/double-side-page.php':
	    	$columns = '2';	
			break;
		case 'default':
		default:
	    	$columns = '3';	
			break;
	}
    return $columns;
}
endif;

if ( ! function_exists( 'geode_pagenavi_infinite_filter' ) ) :
/**
 * Fx on infinite scroll button
 * @since Geode 1.1.0
 */
function geode_pagenavi_infinite_filter() {
	return 'class="pix_button more_infinite_button ' . apply_filters('geode_fx_onscroll','') . '"';
}
endif;

if ( ! function_exists( 'geode_pagenavi' ) ) :
/**
 * Print the pagination numbers for the archive etc.
 * @since Geode 1.0
 */
function geode_pagenavi($infinite=false) {
	global $wp_query;

	$infinite = !$infinite ? apply_filters('geode_pagenavi_infinite',$infinite) : $infinite;

	if ( $wp_query->max_num_pages <= 1 )
		return;
?>
<div class='geode_pagination'>
<?php if ( $infinite!='infinite' ) {
	echo paginate_links( apply_filters( 'geode_pagination_args', array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text' 	=> '&larr;',
		'next_text' 	=> '&rarr;',
		'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
	) ) );
} else {
	add_filter( 'next_posts_link_attributes', 'geode_pagenavi_infinite_filter' );

	if (get_next_posts_link()) echo get_next_posts_link( sprintf(__('%sMore items','geode'), '<i class="scicon-entypo-plus"></i>') );
} ?>
</div><!-- .geode_pagination -->
<?php }
endif;

if ( ! function_exists( 'geode_filter_more_infinite' ) ) :
/**
 * Filter the pagination numbers to display the infinite button
 * @since Geode 1.0
 */
add_filter('geode_pagenavi_infinite', 'geode_filter_more_infinite');
function geode_filter_more_infinite() {
	global $shortcodelic_blog;
	$pagination = '';
	if ( is_category() ) {
		global $cat;
		$id = $cat;
		$term = get_category($id);
		$t_slug = $term->slug.'_category';
		$term_meta = get_option( "taxonomy_$t_slug" );
		$pagination = isset($term_meta['pagination']) && esc_attr( $term_meta['pagination'] ) != '' ? esc_attr( $term_meta['pagination'] ) : $pagination;
	} elseif ( isset(get_queried_object()->term_id) ) {
	    $id = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : '';
		$term = get_term_by('id',$id, get_query_var( 'taxonomy' ) );
		$t_slug = $term->slug;
		if ( is_category() )
			$t_slug = $term->slug.'_category';
		$term_meta = get_option( "taxonomy_$t_slug" );
		$pagination = isset($term_meta['pagination']) && esc_attr( $term_meta['pagination'] ) != '' ? esc_attr( $term_meta['pagination'] ) : $pagination;
	} elseif ( is_home() && !isset($shortcodelic_blog) ) {
		$pagination = get_option('pix_style_latest_post_page_pagination');
	}
	if ( $pagination=='' ) {
		if ( is_post_type_archive('portfolio') || is_tax('portfolio_category') || is_tax('portfolio_tag')  ) {
			$pagination = get_option( 'pix_style_portfolio_list_pagination' );
		} elseif ( pix_is_woocommerce() ) {
			$pagination = false;
		} else {
			$pagination = false;
		}
	}
	return $pagination;
}
endif;

if ( ! function_exists( 'geode_comment_classes' ) ) :
/**
 * Add a class to each comment.
 * @since Geode 1.0
 */
function geode_comment_classes( $classes ) {
	if (!pix_is_woocommerce()) {
		$classes[] = apply_filters('geode_fx_onscroll','');
	}
	return $classes;
}
add_filter( 'comment_class' , 'geode_comment_classes' );
endif;

if ( ! function_exists( 'geode_comment_form_wrap_start' ) ) :
/**
 * Wrap the comment form into a div (start).
 * @since Geode 1.0
 */
add_action( 'comment_form_before' , 'geode_comment_form_wrap_start' );
function geode_comment_form_wrap_start() {
	$jetpack_active_modules = get_option('jetpack_active_modules');
	if ( class_exists( 'Jetpack', false ) && $jetpack_active_modules && in_array( 'comments', $jetpack_active_modules ) ) {
	    return;
	}
	if (!pix_is_woocommerce()) {
		echo '<div class="' . apply_filters('geode_fx_onscroll','') . '">';
	}
}
endif;

if ( ! function_exists( 'geode_comment_form_wrap_end' ) ) :
/**
 * Wrap the comment form into a div (end).
 * @since Geode 1.0
 */
add_action( 'comment_form_after' , 'geode_comment_form_wrap_end' );
function geode_comment_form_wrap_end() {
	$jetpack_active_modules = get_option('jetpack_active_modules');
	if ( class_exists( 'Jetpack', false ) && $jetpack_active_modules && in_array( 'comments', $jetpack_active_modules ) ) {
	    return;
	}
	if (!pix_is_woocommerce()) {
		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'geode_remove_more_link' ) ) :
/**
 * Remove or edit more link.
 * @since Geode 1.0
 */
add_filter( 'the_content_more_link', 'geode_remove_more_link' );
function geode_remove_more_link() {
	global $post;

	if (!$post)
		return;

	return '<p><a href="'.get_permalink($post->ID).'" class="buttonelic read-more-link">'.__('View more', 'geode').'</a></p>';
}
endif;

if ( ! function_exists( 'geode_query_order_for_loops' ) ) :
/**
 * Set order and orderby if necessary
 * @since Geode 1.0
 */
add_filter('pre_get_posts','geode_query_order_for_loops');
function geode_query_order_for_loops( $query ) {
	global $shortcodelic_loop, $shortcodelic_blog;
    if ( (is_tax('portfolio_category') || is_post_type_archive('portfolio') || is_tax('portfolio_tag') ) && get_option('pix_style_portfolio_list_orderby')!='' && $shortcodelic_loop!=true ) {
    	$query->set( 'orderby', get_option('pix_style_portfolio_list_orderby') );
    }
    if ( (is_tax('portfolio_category') || is_post_type_archive('portfolio') || is_tax('portfolio_tag') ) && get_option('pix_style_portfolio_list_order')!='' && $shortcodelic_loop!=true ) {
    	$query->set( 'order', get_option('pix_style_portfolio_list_order') );
    }
    if ( is_home() && get_option('pix_style_latest_post_page_orderby')!='' && $shortcodelic_blog!=true ) {
    	$query->set( 'orderby', get_option('pix_style_latest_post_page_orderby') );
    }
    if ( is_home() && get_option('pix_style_latest_post_page_order')!='' && $shortcodelic_blog!=true ) {
    	$query->set( 'order', get_option('pix_style_latest_post_page_order') );
    }
    if ( (is_category() || ( is_archive() && get_post_type()=='post' )) && get_option('pix_style_archive_orderby')!='' && $shortcodelic_blog!=true ) {
    	$query->set( 'orderby', get_option('pix_style_archive_orderby') );
    }
    if ( (is_category() || ( is_archive() && get_post_type()=='post' )) && get_option('pix_style_archive_order')!='' && $shortcodelic_blog!=true ) {
    	$query->set( 'order', get_option('pix_style_archive_order') );
    }
}
endif;

if ( ! function_exists( 'geode_hide_pages' ) ) :
/**
 * Redirects to section pages.
 * @since Geode 1.0
 */
add_action( 'wp' , 'geode_hide_pages' );
function geode_hide_pages() {
	global $post, $wp_query;
	if ( get_permalink( get_option('pix_content_404_page') ) == '' )
		return;

	if ( $wp_query->is_404 && get_option('pix_content_404_page')!='' && !is_admin() ) {
		wp_redirect( get_permalink( get_option('pix_content_404_page') ) ); exit;
	}
	if ( $wp_query->is_search && !have_posts() && !is_admin() ) {
		$search_query = get_search_query();
		$link = isset($search_query) && $search_query!='' 
			? esc_url_raw( add_query_arg( 'nf', $search_query, get_permalink( get_option('pix_content_404_page') ) ) ) 
			: esc_url_raw( get_permalink( get_option('pix_content_404_page') ) );
		wp_redirect( $link ); exit;
	}
    if ( !$post )
    	return;
	if ( $post->ID == get_option('pix_content_latest_post_page') && get_option('show_on_front')=='posts' && !is_admin() ) {
		$wp_query->set_404();
		status_header(404);
		wp_redirect( get_permalink( get_option('pix_content_404_page') ) ); exit;
	}
	if ( $post->ID == get_option('pix_content_footer_page') && !is_admin() ) {
		$wp_query->set_404();
		status_header(404);
		wp_redirect( get_permalink( get_option('pix_content_404_page') ) ); exit;
	}
	if ( $post->ID == get_option('pix_content_top_sliding_page') && !is_admin() ) {
		$wp_query->set_404();
		status_header(404);
		wp_redirect( get_permalink( get_option('pix_content_404_page') ) ); exit;
	}
}
endif;

if ( ! function_exists( 'geode_hide_pages_on_search_results' ) ) :
/**
 * Hide pages used as sections.
 * @since Geode 1.0
 */
add_filter('pre_get_posts','geode_hide_pages_on_search_results');
function geode_hide_pages_on_search_results($query) {
	if ( $query->is_search && !$query->is_admin ) {
		$query->set( 'post__not_in' , array( 
			get_option('pix_content_404_page'),
			get_option('pix_content_footer_page'),
			get_option('pix_content_top_sliding_page'),
			get_option('pix_content_search_page')
		) );
	}
	return $query;
}
endif;

if ( ! function_exists( 'geode_remove_from_wp_list_pages' ) ) :
/**
 * Hide pages from wp_list_pages().
 * @since Geode 1.0
 */
add_filter('wp_list_pages_excludes', 'geode_remove_from_wp_list_pages');
function geode_remove_from_wp_list_pages($pages) {
	if ( !is_admin() ) {
		$pages = array( 
			get_option('pix_content_404_page'),
			get_option('pix_content_footer_page'),
			get_option('pix_content_top_sliding_page'),
			get_option('pix_content_search_page')
		);
	}
	if ( get_option('show_on_front')=='posts' && !is_admin() ) {
		$pages[] = get_option('pix_content_latest_post_page');
	}
	return $pages;
}
endif;

if ( ! function_exists( 'geode_remove_widget_title' ) ) :
/**
 * Search icon on nav menu.
 * @since Geode 1.0
 */
add_filter( 'widget_title', 'geode_remove_widget_title' );
function geode_remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '!' )
		return;
	else 
		return ( $widget_title );
}
endif;

if ( ! function_exists( 'geode_menu_woo_icon' ) ) :
/**
 * Search icon on nav menu.
 * @since Geode 1.6.3
 */
add_filter('geode_menu_on_end', 'geode_menu_woo_icon');
function geode_menu_woo_icon($icon) {
	global $woocommerce;
	if ( get_option('pix_content_menu_woo_field')=='true' && pix_is_woocommerce_active() ) {
		$instance['title'] = '!';
		$icon .= '<div role="listitem" class="menu-item menu-woo-icon-item menu-added-icon-item">
	<span></span>
	<a href="' . esc_url( $woocommerce->cart->get_cart_url() ) . '">
		<span>
			' . apply_filters('geode_menu_woo_icon_i', '<i class="'.get_option('pix_style_menu_woo_icon').'"></i>') .'&nbsp;
		</span>
	</a>
	<div role="list" class="children"><div role="listitem" id="menu-item-woo"><div id="geode-woo-menu" class="pix_widget cf widget_shopping_cart">
		'.geode_get_the_widget( 'WC_Widget_Cart', $instance ).'
	</div></div></div>
</div>';
		return $icon;
	}
}
endif;

if ( ! function_exists( 'geode_menu_search_icon' ) ) :
/**
 * Search icon on nav menu.
 * @since Geode 1.4.0
 */
add_filter('geode_menu_on_end', 'geode_menu_search_icon');
function geode_menu_search_icon($icon) {
	if ( get_option('pix_content_menu_search_field')=='true' ) {
		$search_query = isset($_GET['nf']) ? $_GET['nf'] : get_search_query();

		$posts_types = '';
		$array_type = '';
		$pix_style_post_type_search = get_option('pix_style_post_type_search');
		if ( is_array($pix_style_post_type_search) && !empty($pix_style_post_type_search) ) {
            foreach ( $pix_style_post_type_search as $post_type => $value ) {
                if ( $value!='0' ) {
                	$array_type[] = $value;
                }
            }
			if ( is_array($array_type) && !empty($array_type) && $array_type!='' ) {
				$posts_types = '<input type="hidden" value="' . implode(',',$array_type) .'" name="post_type">';
			}
		}

	    $form = '<form role="search" method="get" class="search-form cf" action="' . esc_url( home_url( '/' ) ) . '">';
	    if ( is_rtl() ) {
	    	$form .= '<button type="submit" data-id="searchsubmit"><i class="scicon-awesome-search"></i></button>
	    	<label>
	    	<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'geode' ) . '" value="' . $search_query . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'geode' ) . '">
	    </label>';
	    } else {
	    	$form .= '<label>
	    	<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'geode' ) . '" value="' . $search_query . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'geode' ) . '">
	    </label>
	    <button type="submit" data-id="searchsubmit"><i class="scicon-awesome-search"></i></button>';
	    }
	    $form .= $posts_types;
	    $form .= '</form>';

		$icon .= '<div role="listitem" class="menu-item menu-search-icon-item menu-added-icon-item">
	<span></span>
	<a href="#">
		<span>
			' . apply_filters('geode_menu_search_icon_i', '<i class="'.get_option('pix_style_menu_search_icon').'"></i>') .'&nbsp;
		</span>
	</a>
	<div role="list" class="children"><div role="listitem" id="menu-item-search"><div id="geode-search-menu" class="pix_widget cf widget_search">
		'.$form.'
	</div></div></div>
</div>';
	}
	return $icon;
}
endif;

if ( ! function_exists( 'geode_mobile_menu_woo_field' ) ) :
/**
 * Search icon on nav menu.
 * @since Geode 1.0
 */
add_filter('geode_mobile_menu_before', 'geode_mobile_menu_woo_field');
function geode_mobile_menu_woo_field($icon) {
	if ( get_option('pix_content_menu_woo_field')=='true' && pix_is_woocommerce_active() ) {
		$instance['title'] = '!';
		$icon .= '<div role="listitem" class="menu-item menu-woo-icon-item menu-added-icon-item">
	<span></span>
	<a href="#">
		<span>
			' . apply_filters('geode_menu_woo_icon_i', '<i class="'.get_option('pix_style_menu_woo_icon').'"></i>') .'&nbsp;
		</span>
	</a>
	<div role="list" class="children"><div role="listitem" id="menu-item-woo"><div id="geode-woo-menu" class="pix_widget cf widget_shopping_cart">
		'.geode_get_the_widget( 'WC_Widget_Cart', $instance ).'
	</div></div></div>
</div>';
		return $icon;
	}
}
endif;

if ( ! function_exists( 'geode_mobile_menu_search_field' ) ) :
/**
 * Search icon on nav menu.
 * @since Geode 1.0
 */
add_filter('geode_mobile_menu_on_end', 'geode_mobile_menu_search_field');
function geode_mobile_menu_search_field($icon) {
	if ( get_option('pix_content_menu_search_field')=='true' ) {
		$search_query = isset($_GET['nf']) ? $_GET['nf'] : get_search_query();
	    $form = '<form role="search" method="get" class="search-form cf pix_widget alignleft" action="' . esc_url( home_url( '/' ) ) . '">';
	    if ( is_rtl() ) {
	    	$form .= '<button type="submit" data-id="searchsubmit"><i class="scicon-awesome-search"></i></button>
	    	<label>
	    	<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'geode' ) . '" value="' . $search_query . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'geode' ) . '">
	    </label>';
	    } else {
	    	$form .= '<label>
	    	<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'geode' ) . '" value="' . $search_query . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'geode' ) . '">
	    </label>
	    <button type="submit" data-id="searchsubmit"><i class="scicon-awesome-search"></i></button>';
	    }
	    $form .= '</form>';

		$icon .= '<div role="listitem" class="menu-search-icon-item cf">
	<span></span>
	'.$form.'
	</div>';
	}
	return $icon;
}
endif;

if ( ! function_exists( 'geode_sitepress_icon' ) ) :
/**
 * Display an icon for the language switcher on the menu.
 * @since Geode 1.0
 */
add_filter('pixmenu_sitepress_icon','geode_sitepress_icon');
function geode_sitepress_icon(){
	return '<i class="scicon-streamline-earth-globe-streamline pix_icon_menu"></i>';
}
endif;

if ( ! function_exists( 'geode_sitepress_classes' ) ) :
/**
 * Display an icon for the language switcher on the menu.
 * @since Geode 1.0
 */
add_filter('pixmenu_sitepress_classes','geode_sitepress_classes');
function geode_sitepress_classes(){
	return ' with-icon';
}
endif;

if ( ! function_exists( 'geode_tag_cloud_widget' ) ) :
/**
 * Fix the font-size of the tag cloud widget.
 * @since Geode 1.0
 */
add_filter( 'widget_tag_cloud_args', 'geode_tag_cloud_widget' );
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'geode_tag_cloud_widget' );
function geode_tag_cloud_widget($args) {
	$args['largest'] = 0.825;
	$args['smallest'] = 0.825;
	$args['unit'] = 'em';
	$args['separator'] = '';
	return $args;
}
endif;

if ( ! function_exists( 'geode_check_gridder' ) ) :
/**
 * Check if PixGridder is active for a particular post.
 * @since Geode 1.0
 */
function geode_check_gridder($id) {

	if ( class_exists('PixGridder') ) {
		$pixgridder = new PixGridder();
		return $pixgridder->check_active($id);
	} else {
		return false;
	}
}
endif;

if ( ! function_exists( 'geode_pregmatch_gallery' ) ) :
/**
 * Manage content text on post format gallery.
 * @since Geode 1.0
 */
function geode_pregmatch_gallery($matches) {
    return $matches[1];
}
endif;

if ( ! function_exists( 'geode_remove_from_post_format' ) ) :
/**
 * Filter content for different post formats.
 * @since Geode 1.0
 */
add_filter( 'the_content', 'geode_remove_from_post_format', 7 );
function geode_remove_from_post_format($content) {
	global $post;

	if ( !$post )
	    return $content;

	$content = preg_replace('/\[video(.+?)\]\[\/video\]/', '[shortcodelic-video$1]', $content);
	if ( get_post_format($post->ID)=='gallery' && !has_post_thumbnail($post->ID) ) {
    	$content = preg_replace('/\[gallery(.+?)\]/', '', $content, 1);
    } elseif ( get_post_format($post->ID)=='video' && !has_post_thumbnail($post->ID) ) {
		require_once( ABSPATH . WPINC . '/class-oembed.php' );
		$wp_oembed = _wp_oembed_get_object();
		$providers = $wp_oembed->providers;
		$video = '';
		$pos_embed = false;
		$pos_shortcode = strpos($content, '[shortcodelic-video');
		foreach ( $providers as $matchmask => $data ) {
			list( $providerurl, $regex ) = $data;
			if ( !$regex ) {
				$matchmask = '#' . str_replace( '___wildcard___', '(.+)', preg_quote( str_replace( '*', '___wildcard___', $matchmask ), '#' ) ) . '#i';
				$matchmask = preg_replace( '|^#http\\\://|', '#https?\://', $matchmask );
			}

			if ( preg_match( $matchmask, $content ) ) {
				preg_match($matchmask, $content, $video);
				$pos_embed = strpos($content, $video[0]);
				break;
			}
		}
		if ( ($pos_embed !== false && $pos_shortcode !== false && $pos_embed < $pos_shortcode) || ($pos_shortcode === false && $pos_embed !== false) ) {
			$content = preg_replace($matchmask, '', $content, 1);
		} elseif ( ($pos_embed !== false && $pos_shortcode !== false && $pos_shortcode < $pos_embed) || ($pos_embed === false && $pos_shortcode !== false)  ) {
			$content = preg_replace('/\[shortcodelic-video(.+?)\]/', '', $content, 1);
		}
    } elseif ( get_post_format($post->ID)=='audio' && !has_post_thumbnail($post->ID) ) {
    	$content = preg_replace('/\[audio(.+?)\]\[\/audio\]/', '', $content, 1);
    } 

    return $content;
}
endif;

if ( ! function_exists( 'geode_display_post_format_on_top' ) ) :
/**
 * Move the featured content on top in some cases
 * @since Geode 1.0
 */
function geode_display_post_format_on_top($lb=false) {
	global $more; $old_more = $more;
	require_once( ABSPATH . WPINC . '/class-oembed.php' );
	$wp_oembed = _wp_oembed_get_object();
	$providers = $wp_oembed->providers;
	$more = 1;
	$the_content = get_the_content();
	$more = $old_more;
	$the_content = preg_replace('/\[video(.+?)\]\[\/video\]/', '[shortcodelic-video$1]', $the_content);
	$video = '';
	$pos_embed = false;
	$pos_shortcode = strpos($the_content, '[shortcodelic-video');
	$size = apply_filters('geode_get_video_size', geode_get_thumb_size());

	foreach ( $providers as $matchmask => $data ) {
		list( $providerurl, $regex ) = $data;

		// Turn the asterisk-type provider URLs into regex
		if ( !$regex ) {
			$matchmask = '#' . str_replace( '___wildcard___', '(.+)', preg_quote( str_replace( '*', '___wildcard___', $matchmask ), '#' ) ) . '#i';
			$matchmask = preg_replace( '|^#http\\\://|', '#https?\://', $matchmask );
		}

		if ( preg_match( $matchmask, $the_content ) ) {
			preg_match($matchmask, $the_content, $video);
			$pos_embed = strpos($the_content, $video[0]);
			break;
		}
	}
	if ( ($pos_embed !== false && $pos_shortcode !== false && $pos_embed < $pos_shortcode) || ($pos_shortcode === false && $pos_embed !== false) ) {
		$return = wp_oembed_get($video[0]);

	    if ( isset($size['height']) && $size['height']!=0 && isset($size['width']) && $size['width']!=0 && $lb==false ) {
		    $height_pattern = "/height=\"[0-9]*\"/";
		    $return = preg_replace($height_pattern, "height='".$size['height']."'", $return);

		    $width_pattern = "/width=\"[0-9]*\"/";
		    $return = preg_replace($width_pattern, "width='".$size['width']."'", $return);
		}
		if ( $lb==true ) {
			preg_match("/src=\"(.+?)\"/", $return, $src);
			$return = $src[1];
		}

	    return $return;

	} elseif ( ($pos_embed !== false && $pos_shortcode !== false && $pos_shortcode < $pos_embed) || ($pos_embed === false && $pos_shortcode !== false)  ) {
		preg_match('/\[shortcodelic-video(.+?)\]/', $the_content, $video);
		$video = do_shortcode($video[0]);

		switch ( $size['ratio'] ) {
			case '16:9':
				$ratio = '-16x9';
				break;
			case '4:3':
				$ratio = '-4x3';
				break;
			default:
				$ratio = '';
				break;
		}

	    if ( $size['height']!=0 && $size['width']!=0 && $lb==false ) {
		    return '<div class="sc-wrap-video-resp"><img src="'.get_template_directory_uri().'/images/blank'.$ratio.'.png" height="'.$size['height'].'" width="'.$size['width'].'">'.$video.'</div>';			
		} else {
		    return $video;			
		}

	}

}
endif;

if ( ! function_exists( 'geode_video_th_size' ) ) :
/**
 * Set the sizes and ratio of the videos in some cases
 * @since Geode 1.0
 */
add_filter('geode_get_video_size','geode_video_th_size');
function geode_video_th_size(){
	$ratio = geode_get_thumb_size();
	if ( $ratio['ratio'] == 'standard' )
		return 'standard';
	else
		return geode_get_thumb_size();
}
endif;

if ( ! function_exists( 'geode_main_class' ) ) :
/**
 * Set the class according with the template used
 * @since Geode 1.0
 */
add_filter('geode_main_class','geode_main_class');
function geode_main_class($classes){
	if ( geode_get_page_template()=='templates/wide-page.php' || geode_get_page_template()=='templates/front-page.php'  ) {
		$classes .= ' wide-template';
	}
	return $classes;
}
endif;

if ( ! function_exists( 'geode_blog_layout_class' ) ) :
/**
 * Set the class according with the layout used
 * @since Geode 1.0
 */
add_filter('geode_main_class','geode_blog_layout_class');
function geode_blog_layout_class($classes){
	global $shortcodelic_loop, $shortcodelic_blog;
	$columns = '';
	if ( is_category() ) {
		global $cat;
		$id = $cat;
		$term = get_category($id);
		$t_slug = $term->slug.'_category';
		$term_meta = get_option( "taxonomy_$t_slug" );
		$grid = get_option( 'pix_style_archive_layout' );
		$grid = isset( $term_meta['layout'] ) && $term_meta['layout']!='' ? esc_attr( $term_meta['layout'] ) : $grid; 
	}
	
	if ( is_home() && get_option('pix_style_latest_post_page_layout')=='masonry' && !isset($shortcodelic_blog) ) {
		$columns = get_option('pix_style_latest_post_page_columns');
	} elseif ( isset($shortcodelic_blog['columns']) && $shortcodelic_blog['layout']=='masonry' ) {
		$columns = $shortcodelic_blog['columns'];
	} elseif ( is_category() ) {
		$columns = isset( $term_meta['columns'] ) && $term_meta['columns']!='' ? $term_meta['columns'] : get_option('pix_style_archive_columns');
		$columns = $grid == 'masonry' ? $columns : '';
	} elseif ( is_archive() && !is_category() && get_post_type()=='post' && get_option('pix_style_archive_layout') != '' ) {
		$columns = get_option('pix_style_archive_columns');
	}

	if ( $columns!='' ) 
		$classes .= ' cf grid-blog blog-columns-'.$columns;
	return $classes;
}
endif;

if ( ! function_exists( 'geode_excerpt_length' ) ) :
/**
 * Excerpt length
 * @since Geode 1.0
 */
add_filter( 'excerpt_length', 'geode_excerpt_length', 999 );
function geode_excerpt_length( $length ) {
	return apply_filters('geode_excerpt_length',38);
}
endif;

if ( ! function_exists( 'geode_post_class_effect' ) ) :
/**
 * Add effects on scrolling to the posts on loop.
 * @since Geode 1.0
 */
add_filter( 'post_class', 'geode_post_class_effect' );
function geode_post_class_effect($classes) {
	global $post;

	if ( !is_single() && !is_page() && !is_admin() )
		$classes[] = apply_filters('geode_fx_onscroll','');
	        
	return $classes;
}
endif;

if ( ! function_exists( 'geode_remove_share_from_audio' ) ) :
/**
 * Fixed an issue with Sharedaddy and Jetpack open graph and audio shortcode.
 * @since Geode 1.0
 */
add_action( 'wp', 'geode_remove_share_from_audio' );
function geode_remove_share_from_audio() {
	global $post;

	if (!$post)
		return;

	$content = $post->post_content;
	if ( preg_match('/\[audio(.+?)\]\[\/audio\]/', $content ) ) {
		remove_filter( 'jetpack_open_graph_tags', 'wpcom_twitter_cards_tags' );
	}	        
}
endif;

if ( ! function_exists( 'geode_remove_share_from_related' ) ) :
/**
 * Remove share buttons from related posts.
 * @since Geode 1.0
 */
add_action( 'loop_start', 'geode_remove_share_from_related' );
function geode_remove_share_from_related() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
endif;

if ( ! function_exists( 'geode_append_sharedaddy' ) ) :
/**
 * Workaround for Sharedaddy (Jetpack).
 * @since Geode 1.0
 */
add_action( 'the_content', 'geode_append_sharedaddy' );
function geode_append_sharedaddy($content) {
	if ( !geode_is_related() ) {
		if ( function_exists( 'sharing_display' ) ) {
			$content .= sharing_display( '', false );
		}

		if ( class_exists( 'Jetpack_Likes' ) ) {
		    $custom_likes = new Jetpack_Likes;
		    $content .= $custom_likes->post_likes( '' );
		}
	}

	return $content;
}
endif; 

if ( ! function_exists( 'geode_tax_add_meta_field' ) ) :
/**
 * Add template field to taxonomies.
 * @since Geode 1.0
 */
add_action( 'category_add_form_fields', 'geode_tax_add_meta_field' );
add_action( 'product_cat_add_form_fields', 'geode_tax_add_meta_field' );
add_action( 'portfolio_category_add_form_fields', 'geode_tax_add_meta_field' );
function geode_tax_add_meta_field() {

	global $pagenow;
	$tax = $_GET['taxonomy']; ?>
	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[template]"><?php _e( 'Template', 'geode' ); ?></label>
		<select name="<?php echo $tax; ?>[template]" id="<?php echo $tax; ?>[template]">
			<option value=""><?php _e( 'Inherit', 'geode' ); ?></option>
			<option value="default"><?php _e( 'Default Template', 'geode' ); ?></option>
			<option value="templates/double-side-page.php"><?php _e( 'Double sidebar Page Template', 'geode' ); ?></option>
			<option value="templates/wide-page.php"><?php _e( 'Wide Page Template', 'geode' ); ?></option>
			<?php if ( $tax == 'portfolio_category' ) : ?>
			<option value="templates/full-width-page.php"><?php _e( 'Full width Page Template', 'geode' ); ?></option>
			<?php endif; ?>
		</select>
	</div>

	<?php if ( $tax == 'category' ) : ?>
	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[layout]"><?php _e( 'Layout', 'geode' ); ?></label>
		<select name="<?php echo $tax; ?>[layout]" id="<?php echo $tax; ?>[layout]">
			<option value=""><?php _e( 'Inherit', 'geode' ); ?></option>
            <option value="standard"><?php _e( 'Standard blog', 'geode' ); ?></option>
            <option value="masonry"><?php _e( 'Masonry grid (original ratio)', 'geode' ); ?></option>
		</select>
	</div>
	<?php else : ?>
	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[layout]"><?php _e( 'Layout', 'geode' ); ?></label>
		<select name="<?php echo $tax; ?>[layout]" id="<?php echo $tax; ?>[layout]">
			<option value=""><?php _e( 'Inherit', 'geode' ); ?></option>
            <option value="1:1"><?php _e( 'Grid of square thumbs', 'geode' ); ?></option>
            <option value="4:3"><?php _e( 'Grid of 4:3 thumbs', 'geode' ); ?></option>
            <option value="16:9"><?php _e( 'Grid of 16:9 thumbs', 'geode' ); ?></option>
            <option value="grid"><?php _e( 'Grid of original ratio thumbs', 'geode' ); ?></option>
            <option value="masonry"><?php _e( 'Masonry grid (original ratio)', 'geode' ); ?></option>
		</select>
	</div>
	<?php endif; ?>

	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[sidebar]"><?php _e( 'Sidebar (primary)', 'geode' ); ?></label>
		<select name="<?php echo $tax; ?>[sidebar]" id="<?php echo $tax; ?>[sidebar]">
			<option value=""><?php _e( 'Default', 'geode' ); ?></option>
            <?php
                $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                foreach ($get_sidebar_options as $sideb) {
                    echo '<option value="'.ucwords( $sideb['id'] ).'">'.ucwords( $sideb['name'] ).'</option>';
                }
            ?>
		</select>
		<p class="description"><?php _e( 'Select a sidebar','geode' ); ?></p>
	</div>

	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[sidebar2]"><?php _e( 'Sidebar (secondary)', 'geode' ); ?></label>
		<select name="<?php echo $tax; ?>[sidebar2]" id="<?php echo $tax; ?>[sidebar2]">
			<option value=""><?php _e( 'Default', 'geode' ); ?></option>
            <?php
                $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                foreach ($get_sidebar_options as $sideb) {
                    echo '<option value="'.ucwords( $sideb['id'] ).'">'.ucwords( $sideb['name'] ).'</option>';
                }
            ?>
		</select>
		<p class="description"><?php _e( 'Select the secondary sidebar','geode' ); ?></p>
	</div>

	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[columns]"><?php _e( 'Grid', 'geode' ); ?></label>
		<select name="<?php echo $tax; ?>[columns]" id="<?php echo $tax; ?>[columns]">
			<option value=""><?php _e( 'default', 'geode' ); ?></option>
			<option value="2"><?php _e( '2 columns', 'geode' ); ?></option>
			<option value="3"><?php _e( '3 columns', 'geode' ); ?></option>
			<option value="4"><?php _e( '4 columns', 'geode' ); ?></option>
			<option value="5"><?php _e( '5 columns', 'geode' ); ?></option>
			<option value="6"><?php _e( '6 columns', 'geode' ); ?></option>
		</select>
		<?php if ( $tax == 'category' ) : ?>
			<p class="description"><?php _e( 'Pay attention: it works with standard layout only and too many columns could create layout problems with narrow templates','geode' ); ?></p>
		<?php else : ?>
			<p class="description"><?php _e( 'Pay attention: too many columns could create layout problems with narrow templates','geode' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( $tax == 'portfolio_category' ) : ?>
	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[textpos]"><?php _e( 'Text position', 'geode' ); ?></label>
		<select name="<?php echo $tax; ?>[textpos]" id="<?php echo $tax; ?>[textpos]">
			<option value=""><?php _e( 'default', 'geode' ); ?></option>
			<option value="below"><?php _e( 'below', 'geode' ); ?></option>
			<option value="fancy"><?php _e( 'fancy', 'geode' ); ?></option>
		</select>
	</div>

	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[link]"><?php _e( 'Link to...', 'geode' ); ?></label>
		<select name="<?php echo $tax; ?>[link]" id="<?php echo $tax; ?>[link]">
			<option value=""><?php _e( 'default', 'geode' ); ?></option>
            <option value="none"><?php _e( 'None', 'geode' ); ?></option>
            <option value="post"><?php _e( 'Post', 'geode' ); ?></option>
            <option value="image"><?php _e( 'Image (with ColorBox if active)', 'geode' ); ?></option>
            <option value="both"><?php _e( 'Both', 'geode' ); ?></option>
		</select>
	</div>
	<?php endif; ?>

	<?php if ( $tax != 'product_cat' ) : ?>
	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[gutter]"><?php _e('Gutter (%)', 'geode'); ?>:</label>
		<div class="slider_div gutter">
			<input id="<?php echo $tax; ?>[gutter]" name="<?php echo $tax; ?>[gutter]" type="text">
			<div class="slider_cursor"></div>
		</div><!-- .slider_div -->
		<p class="description"><?php _e( 'Leave blank to inherit the default value','geode' ); ?></p>
	</div>
	<?php endif; ?>

	<?php if ( $tax == 'portfolio_category' || $tax == 'category' ) : ?>
	<div class="form-field pix_meta_boxes">
		<label for="<?php echo $tax; ?>[pagination]"><?php _e( 'Pagination', 'geode' ); ?></label>
		<select name="<?php echo $tax; ?>[pagination]" id="<?php echo $tax; ?>[link]">
			<option value=""><?php _e( 'default', 'geode' ); ?></option>
            <option value="numbers"><?php _e( 'Numbers', 'geode' ); ?></option>
            <option value="infinite"><?php _e( 'Infinite button', 'geode' ); ?></option>
		</select>
	</div>
	<?php endif; ?>

	<div class="form-field pix_meta_boxes">
        <label for="<?php echo $tax; ?>[transparent_header]"><?php _e('Transparent header','geode'); ?></label>
        <select name="<?php echo $tax; ?>[transparent_header]" id="<?php echo $tax; ?>[transparent_header]">
            <option value=""><?php _e('regular header','geode'); ?></option>
            <option value="transparent"><?php _e('transparent header','geode'); ?></option>
        </select>
	</div>

	<div class="form-field pix_meta_boxes">
        <label for="<?php echo $tax; ?>[transparent_header_color]"><?php _e('Transparent header color','geode'); ?></label>
	    <div class="pix_color_picker">
	        <input  id="<?php echo $tax; ?>[transparent_header_color]" type="text" value="" name="<?php echo $tax; ?>[transparent_header_color]" >
	        <a class="pix_button" href="#"></a>
	        <div class="colorpicker"></div>
	        <i class="scicon-iconic-cancel"></i>
	    </div>
	    <p class="description"><?php _e('Leave blank to use the default color set among the theme options','geode'); ?></p>
	</div>

	<div class="form-field pix_meta_boxes">
        <label for="<?php echo $tax; ?>[transparent_header_logo_id]"><?php _e('Transparent header logo','geode'); ?></label>
        <div class="pix_upload upload_image">
            <input type="hidden" data-type="id" name="<?php echo $tax; ?>[transparent_header_logo_id]" value="">
            <input type="hidden" data-type="size" name="<?php echo $tax; ?>[transparent_header_logo_size]" value="">
            <span class="img_preview"></span>
            <span class="pix_set_img_links">
                <a class="pix_button" href="#"><?php _e('Set an image','geode'); ?></a><br>
                <a class="pix_remove_img" href="#"><?php _e('Remove the image','geode'); ?></a>
            </span>
        </div>
	</div>

	<div class="form-field pix_meta_boxes">
        <label for="<?php echo $tax; ?>[bg]"><?php _e('Background','geode'); ?></label>
        <select name="<?php echo $tax; ?>[bg]" id="<?php echo $tax; ?>[bg]">
            <option value=""><?php _e('default','geode'); ?></option>
            <option value="none"><?php _e('none','geode'); ?></option>
            <option value="image"><?php _e('fixed image','geode'); ?></option>
        </select>
	</div>

	<div class="form-field pix_meta_boxes">
        <label for="<?php echo $tax; ?>[bg_id]"><?php _e('Background image','geode'); ?></label>
        <div class="pix_upload upload_image">
            <input type="hidden" data-type="id" name="<?php echo $tax; ?>[bg_id]" value="">
            <input type="hidden" data-type="size" name="<?php echo $tax; ?>[bg_size]" value="">
            <span class="img_preview"></span>
            <span class="pix_set_img_links">
                <a class="pix_button" href="#"><?php _e('Set an image','geode'); ?></a><br>
                <a class="pix_remove_img" href="#"><?php _e('Remove the image','geode'); ?></a>
            </span>
        </div>

	<div class="form-field pix_meta_boxes">
        <label for="<?php echo $tax; ?>[bg_title]"><?php _e('Background of the title section','geode'); ?></label>
        <select name="<?php echo $tax; ?>[bg_title]" id="<?php echo $tax; ?>[bg_title]">
            <option value=""><?php _e('default','geode'); ?></option>
            <option value="none"><?php _e('none','geode'); ?></option>
            <option value="image"><?php _e('fixed image','geode'); ?></option>
        </select>
	</div>

	<div class="form-field pix_meta_boxes">
        <label for="<?php echo $tax; ?>[bg_title_id]"><?php _e('Background image of the title section','geode'); ?></label>
        <div class="pix_upload upload_image">
            <input type="hidden" data-type="id" name="<?php echo $tax; ?>[bg_title_id]" value="">
            <input type="hidden" data-type="size" name="<?php echo $tax; ?>[bg_title_size]" value="">
            <span class="img_preview"></span>
            <span class="pix_set_img_links">
                <a class="pix_button" href="#"><?php _e('Set an image','geode'); ?></a><br>
                <a class="pix_remove_img" href="#"><?php _e('Remove the image','geode'); ?></a>
            </span>
        </div>
	</div>

	<div class="form-field pix_meta_boxes">
        <label for="<?php echo $tax; ?>[title_color]"><?php _e('Text color of the title section','geode'); ?></label>
	    <div class="pix_color_picker">
	        <input  id="<?php echo $tax; ?>[title_color]" type="text" value="" name="<?php echo $tax; ?>[title_color]" >
	        <a class="pix_button" href="#"></a>
	        <div class="colorpicker"></div>
	        <i class="scicon-iconic-cancel"></i>
	    </div>
	    <p class="description"><?php _e('Leave blank to use the default color set among the theme options','geode'); ?></p>
	</div>
	<input type="hidden" value="<?php echo $tax; ?>" name="geode_tax_hidden">
<?php }
endif;

if ( ! function_exists( 'geode_tax_edit_meta_field' ) ) :
/**
 * Edit template field for taxonomies.
 * @since Geode 1.0
 */
add_action( 'category_edit_form_fields', 'geode_tax_edit_meta_field', 10, 2 );
add_action( 'product_cat_edit_form_fields', 'geode_tax_edit_meta_field', 10, 2 );
add_action( 'portfolio_category_edit_form_fields', 'geode_tax_edit_meta_field', 10, 2 );
function geode_tax_edit_meta_field($term) {

	$tax = $term->taxonomy;
	$t_id = $term->slug.'_'.$tax;
	$term_meta = get_option( "taxonomy_$t_id" );
	$template = isset( $term_meta['template'] ) ? esc_attr( $term_meta['template'] ) : '';
	$layout = isset( $term_meta['layout'] ) ? esc_attr( $term_meta['layout'] ) : '';
	$sidebar = isset( $term_meta['sidebar'] ) ? esc_attr( $term_meta['sidebar'] ) : '';
	$sidebar2 = isset( $term_meta['sidebar2'] ) ? esc_attr( $term_meta['sidebar2'] ) : '';
	$columns = isset( $term_meta['columns'] ) ? esc_attr( $term_meta['columns'] ) : '';
	$textpos = isset( $term_meta['textpos'] ) ? esc_attr( $term_meta['textpos'] ) : '';
	$gutter = isset( $term_meta['gutter'] ) ? esc_attr( $term_meta['gutter'] ) : '';
	$link = isset( $term_meta['link'] ) ? esc_attr( $term_meta['link'] ) : '';
	$pagination = isset( $term_meta['pagination'] ) ? esc_attr( $term_meta['pagination'] ) : '';
	$transparent_header = isset( $term_meta['transparent_header'] ) ? esc_attr( $term_meta['transparent_header'] ) : '';
	$transparent_header_color = isset( $term_meta['transparent_header_color'] ) ? esc_attr( $term_meta['transparent_header_color'] ) : '';
	$transparent_header_logo_id = isset( $term_meta['transparent_header_logo_id'] ) ? esc_attr( $term_meta['transparent_header_logo_id'] ) : '';
	$transparent_header_logo_size = isset( $term_meta['transparent_header_logo_size'] ) ? esc_attr( $term_meta['transparent_header_logo_size'] ) : '';
	$bg = isset( $term_meta['bg'] ) ? esc_attr( $term_meta['bg'] ) : '';
	$bg_id = isset( $term_meta['bg_id'] ) ? esc_attr( $term_meta['bg_id'] ) : '';
	$bg_size = isset( $term_meta['bg_size'] ) ? esc_attr( $term_meta['bg_size'] ) : '';
	$bg_title = isset( $term_meta['bg_title'] ) ? esc_attr( $term_meta['bg_title'] ) : '';
	$bg_title_id = isset( $term_meta['bg_title_id'] ) ? esc_attr( $term_meta['bg_title_id'] ) : '';
	$bg_title_size = isset( $term_meta['bg_title_size'] ) ? esc_attr( $term_meta['bg_title_size'] ) : '';
	$title_color = isset( $term_meta['title_color'] ) ? esc_attr( $term_meta['title_color'] ) : ''; ?>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[template]"><?php _e( 'Template', 'geode' ); ?></label></th>
		<td>
			<select name="<?php echo $tax; ?>[template]" id="<?php echo $tax; ?>[template]">
				<option value="" <?php selected('',$template); ?>><?php _e( 'Inherit', 'geode' ); ?></option>
				<option value="default" <?php selected('default',$template); ?>><?php _e( 'Default Template', 'geode' ); ?></option>
				<option value="templates/double-side-page.php" <?php selected('templates/double-side-page.php',$template); ?>><?php _e( 'Double sidebar Page Template', 'geode' ); ?></option>
				<option value="templates/wide-page.php" <?php selected('templates/wide-page.php',$template); ?>><?php _e( 'Wide Page Template', 'geode' ); ?></option>
				<?php if ( $tax == 'portfolio_category' ) : ?>
				<option value="templates/full-width-page.php" <?php selected('templates/full-width-page.php',$template); ?>><?php _e( 'Full width Page Template', 'geode' ); ?></option>
				<?php endif; ?>
			</select>
		</td>
	</tr>

	<?php if ( $tax == 'category' ) : ?>
	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[layout]"><?php _e( 'Layout', 'geode' ); ?></label></th>
		<td>
			<select name="<?php echo $tax; ?>[layout]" id="<?php echo $tax; ?>[layout]">
				<option value="" <?php selected('',$layout); ?>><?php _e( 'Inherit', 'geode' ); ?></option>
	            <option value="standard" <?php selected('standard',$layout); ?>><?php _e( 'Standard blog', 'geode' ); ?></option>
	            <option value="masonry" <?php selected('masonry',$layout); ?>><?php _e( 'Masonry grid', 'geode' ); ?></option>
			</select>
		</td>
	</tr>
	<?php else : ?>
	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[layout]"><?php _e( 'Layout', 'geode' ); ?></label></th>
		<td>
			<select name="<?php echo $tax; ?>[layout]" id="<?php echo $tax; ?>[layout]">
				<option value="" <?php selected('',$layout); ?>><?php _e( 'Inherit', 'geode' ); ?></option>
	            <option value="1:1" <?php selected('1:1',$layout); ?>><?php _e( 'Grid of square thumbs', 'geode' ); ?></option>
	            <option value="4:3" <?php selected('4:3',$layout); ?>><?php _e( 'Grid of 4:3 thumbs', 'geode' ); ?></option>
	            <option value="16:9" <?php selected('16:9',$layout); ?>><?php _e( 'Grid of 16:9 thumbs', 'geode' ); ?></option>
	            <option value="grid" <?php selected('grid',$layout); ?>><?php _e( 'Grid of original ratio thumbs', 'geode' ); ?></option>
	            <option value="masonry" <?php selected('masonry',$layout); ?>><?php _e( 'Masonry grid (original ratio)', 'geode' ); ?></option>
			</select>
		</td>
	</tr>
	<?php endif; ?>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[sidebar]"><?php _e( 'Sidebar (primary)', 'geode' ); ?></label></th>
		<td>
			<select name="<?php echo $tax; ?>[sidebar]" id="<?php echo $tax; ?>[sidebar]">
				<option value="" <?php selected('',$sidebar); ?>><?php _e( 'Default', 'geode' ); ?></option>
                <?php
                    $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                    foreach ($get_sidebar_options as $sideb) {
                        echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(ucwords( $sideb['id'] ),$sidebar) .'>'.ucwords( $sideb['name'] ).'</option>';
                    }
                ?>
			</select>
			<p class="description"><?php _e( 'Select a sidebar','geode' ); ?></p>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[sidebar2]"><?php _e( 'Sidebar (secondary)', 'geode' ); ?></label></th>
		<td>
			<select name="<?php echo $tax; ?>[sidebar2]" id="<?php echo $tax; ?>[sidebar2]">
				<option value="" <?php selected('',$sidebar2); ?>><?php _e( 'Default', 'geode' ); ?></option>
                <?php
                    $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];
                    foreach ($get_sidebar_options as $sideb) {
                        echo '<option value="'.ucwords( $sideb['id'] ).'" '.selected(ucwords( $sideb['id'] ),$sidebar2) .'>'.ucwords( $sideb['name'] ).'</option>';
                    }
                ?>
			</select>
			<p class="description"><?php _e( 'Select the secondary sidebar','geode' ); ?></p>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[columns]"><?php _e( 'Grid', 'geode' ); ?></label></th>
		<td>
			<select name="<?php echo $tax; ?>[columns]" id="<?php echo $tax; ?>[columns]">
				<option value="" <?php selected('',$columns); ?>>default</option>
				<option value="2" <?php selected('2',$columns); ?>><?php _e( '2 columns', 'geode' ); ?></option>
				<option value="3" <?php selected('3',$columns); ?>><?php _e( '3 columns', 'geode' ); ?></option>
				<option value="4" <?php selected('4',$columns); ?>><?php _e( '4 columns', 'geode' ); ?></option>
				<option value="5" <?php selected('5',$columns); ?>><?php _e( '5 columns', 'geode' ); ?></option>
				<option value="6" <?php selected('6',$columns); ?>><?php _e( '6 columns', 'geode' ); ?></option>
			</select>
			<?php if ( $tax == 'category' ) : ?>
				<p class="description"><?php _e( 'Pay attention: it works with standard layout only and too many columns could create layout problems with narrow templates','geode' ); ?></p>
			<?php else : ?>
				<p class="description"><?php _e( 'Pay attention: too many columns could create layout problems with narrow templates','geode' ); ?></p>
			<?php endif; ?>
		</td>
	</tr>

	<?php if ( $tax == 'portfolio_category' ) : ?>
	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[textpos]"><?php _e( 'Text position', 'geode' ); ?></label>:</label></th>
		<td>
			<select name="<?php echo $tax; ?>[textpos]" id="<?php echo $tax; ?>[textpos]">
				<option value="" <?php selected('',$textpos); ?>><?php _e( 'default', 'geode' ); ?></option>
				<option value="below" <?php selected('below',$textpos); ?>><?php _e( 'below', 'geode' ); ?></option>
				<option value="fancy" <?php selected('fancy',$textpos); ?>><?php _e( 'fancy', 'geode' ); ?></option>
			</select>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[link]"><?php _e( 'Link to...', 'geode' ); ?></label></th>
		<td class="slider_div gutter">
			<select name="<?php echo $tax; ?>[link]" id="<?php echo $tax; ?>[link]">
				<option value="" <?php selected('',$link); ?>><?php _e( 'default', 'geode' ); ?></option>
	            <option value="none" <?php selected('none',$link); ?>><?php _e( 'None', 'geode' ); ?></option>
	            <option value="post" <?php selected('post',$link); ?>><?php _e( 'Post', 'geode' ); ?></option>
	            <option value="image" <?php selected('image',$link); ?>><?php _e( 'Image (with ColorBox if active)', 'geode' ); ?></option>
	            <option value="both" <?php selected('both',$link); ?>><?php _e( 'Both', 'geode' ); ?></option>
			</select>
		</td><!-- .slider_div -->
	</tr>

	<?php endif; ?>

	<?php if ( $tax != 'product_cat' ) : ?>
	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[gutter]"><?php _e('Gutter (%)', 'geode'); ?>:</label></th>
		<td class="slider_div gutter">
			<input id="<?php echo $tax; ?>[gutter]" name="<?php echo $tax; ?>[gutter]" type="text" value="<?php echo $gutter; ?>">
			<div class="slider_cursor"></div>
		</td><!-- .slider_div -->
		<p class="description"><?php _e( 'Leave blank to inherit the default value','geode' ); ?></p>
	</tr>
	<?php endif; ?>

	<?php if ( $tax == 'portfolio_category' || $tax == 'category' ) : ?>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[pagination]"><?php _e( 'Pagination', 'geode' ); ?></label></th>
		<td class="slider_div gutter">
			<select name="<?php echo $tax; ?>[pagination]" id="<?php echo $tax; ?>[pagination]">
				<option value="" <?php selected('',$pagination); ?>><?php _e( 'default', 'geode' ); ?></option>
	            <option value="numbers" <?php selected('numbers',$pagination); ?>><?php _e( 'Numbers', 'geode' ); ?></option>
	            <option value="infinite" <?php selected('infinite',$pagination); ?>><?php _e( 'Infinite button', 'geode' ); ?></option>
			</select>
		</td><!-- .slider_div -->
	</tr>
	<?php endif; ?>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[bg]"><?php _e( 'Background', 'geode' ); ?></label></th>
		<td>
	        <select name="<?php echo $tax; ?>[bg]" id="<?php echo $tax; ?>[bg]">
	            <option value="" <?php selected('',$bg); ?>><?php _e('default','geode'); ?></option>
	            <option value="none" <?php selected('none',$bg); ?>><?php _e('none','geode'); ?></option>
	            <option value="image" <?php selected('image',$bg); ?>><?php _e('fixed image','geode'); ?></option>
	        </select>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
        <th scope="row" valign="top"><label for="<?php echo $tax; ?>[transparent_header]"><?php _e('Transparent header','geode'); ?></label>
		<td>
	        <select name="<?php echo $tax; ?>[transparent_header]" id="<?php echo $tax; ?>[transparent_header]">
	            <option value="" <?php selected('',$transparent_header); ?>><?php _e('regular header','geode'); ?></option>
	            <option value="transparent" <?php selected('transparent',$transparent_header); ?>><?php _e('transparent header','geode'); ?></option>
	        </select>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
        <th scope="row" valign="top"><label for="<?php echo $tax; ?>[transparent_header_color]"><?php _e('Transparent header color','geode'); ?></label></th>
		<td>
		    <div class="pix_color_picker">
		        <input  id="<?php echo $tax; ?>[transparent_header_color]" type="text" value="<?php echo $transparent_header_color; ?>" name="<?php echo $tax; ?>[transparent_header_color]" >
		        <a class="pix_button" href="#"></a>
		        <div class="colorpicker"></div>
		        <i class="scicon-iconic-cancel"></i>
		    </div>
		    <p class="description"><?php _e('Leave blank to use the default color set among the theme options','geode'); ?></p>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
        <th scope="row" valign="top"><label for="<?php echo $tax; ?>[transparent_header_logo_id]"><?php _e('Transparent header logo','geode'); ?></label></th>
		<td>
	        <div class="pix_upload upload_image">
	            <input type="hidden" data-type="id" name="<?php echo $tax; ?>[transparent_header_logo_id]" value="<?php echo $transparent_header_logo_id; ?>">
	            <input type="hidden" data-type="size" name="<?php echo $tax; ?>[transparent_header_logo_size]" value="<?php echo $transparent_header_logo_size; ?>">
	            <span class="img_preview"></span>
	            <span class="pix_set_img_links">
	                <a class="pix_button" href="#"><?php _e('Set an image','geode'); ?></a><br>
	                <a class="pix_remove_img" href="#"><?php _e('Remove the image','geode'); ?></a>
	            </span>
	        </div>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[bg_id]"><?php _e('Background image','geode'); ?></label></th>
		<td>
	        <div class="pix_upload upload_image">
	            <input type="hidden" data-type="id" name="<?php echo $tax; ?>[bg_id]" value="<?php echo $bg_id; ?>">
	            <input type="hidden" data-type="size" name="<?php echo $tax; ?>[bg_size]" value="<?php echo $bg_size; ?>">
	            <span class="img_preview"></span>
	            <span class="pix_set_img_links">
	                <a class="pix_button" href="#"><?php _e('Set an image','geode'); ?></a><br>
	                <a class="pix_remove_img" href="#"><?php _e('Remove the image','geode'); ?></a>
	            </span>
	        </div>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[bg_title]"><?php _e( 'Background of the title section', 'geode' ); ?></label></th>
		<td>
	        <select name="<?php echo $tax; ?>[bg_title]" id="<?php echo $tax; ?>[bg_title]">
	            <option value="" <?php selected('',$bg_title); ?>><?php _e('default','geode'); ?></option>
	            <option value="none" <?php selected('none',$bg_title); ?>><?php _e('none','geode'); ?></option>
	            <option value="image" <?php selected('image',$bg_title); ?>><?php _e('fixed image','geode'); ?></option>
	        </select>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[bg_title_id]"><?php _e('Background image of the title section','geode'); ?></label></th>
		<td>
	        <div class="pix_upload upload_image">
	            <input type="hidden" data-type="id" name="<?php echo $tax; ?>[bg_title_id]" value="<?php echo $bg_title_id; ?>">
	            <input type="hidden" data-type="size" name="<?php echo $tax; ?>[bg_title_size]" value="<?php echo $bg_title_size; ?>">
	            <span class="img_preview"></span>
	            <span class="pix_set_img_links">
	                <a class="pix_button" href="#"><?php _e('Set an image','geode'); ?></a><br>
	                <a class="pix_remove_img" href="#"><?php _e('Remove the image','geode'); ?></a>
	            </span>
	        </div>
		</td>
	</tr>

	<tr class="form-field pix_meta_boxes">
		<th scope="row" valign="top"><label for="<?php echo $tax; ?>[title_color]"><?php _e('Text color of the title section','geode'); ?></label></th>
		<td>
		    <div class="pix_color_picker">
		        <input  id="<?php echo $tax; ?>[title_color]" type="text" value="<?php echo $title_color; ?>" name="<?php echo $tax; ?>[title_color]" >
		        <a class="pix_button" href="#"></a>
		        <div class="colorpicker"></div>
		        <i class="scicon-iconic-cancel"></i>
		    </div>
		    <p class="description"><?php _e('Leave blank to use the default color set among the theme options','geode'); ?></p>
		</td>
	</tr>

	<input type="hidden" value="<?php echo $tax; ?>" name="geode_tax_hidden">
<?php
}
endif;

if ( ! function_exists( 'geode_save_tax_custom_meta' ) ) :
/**
 * Save template field for taxonomies.
 * @since Geode 1.0
 */
add_action( 'edited_category', 'geode_save_tax_custom_meta', 10, 2 );  
add_action( 'create_category', 'geode_save_tax_custom_meta', 10, 2 );

add_action( 'edited_product_cat', 'geode_save_tax_custom_meta', 10, 2 );  
add_action( 'create_product_cat', 'geode_save_tax_custom_meta', 10, 2 );

add_action( 'edited_portfolio_category', 'geode_save_tax_custom_meta', 10, 2 );  
add_action( 'create_portfolio_category', 'geode_save_tax_custom_meta', 10, 2 );
function geode_save_tax_custom_meta( $term_id ) {
	$tax_name = 'geode_tax_hidden';
	if ( isset( $_POST[$tax_name] ) ) {
		$tax = $_POST[$tax_name];
		if ( isset( $_POST[$tax] ) ) {
			$term = get_term_by('id',$term_id,$tax);
			$t_slug = $term->slug.'_'.$tax;
			$term_meta = get_option( "taxonomy_$t_slug" );
			if ( is_array($_POST[$tax]) ) {
				$cat_keys = array_keys( $_POST[$tax] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST[$tax][$key] ) ) {
						$term_meta[$key] = $_POST[$tax][$key];
					}
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_slug", $term_meta );
		}
	}  
}
endif;

if ( ! function_exists( 'geode_sidebar' ) ) :
/**
 * Get the right sidebar according with its position.
 * @since Geode 1.4.0
 */
function geode_sidebar($pos) {

	global $post;

	$template = geode_get_page_template();

    switch ($template) {
    	case 'templates/double-side-page.php':
			if ( $pos != apply_filters('geode_sidebar_position', get_option('pix_style_main_sidebar_position')) ) {
				get_sidebar('extra');
			} else {
				get_sidebar();
			}
    		break;
    	default:
    		get_sidebar();
    		break;
    }
}
endif;

if ( ! function_exists( 'geode_dynamic_primary' ) ) :
/**
 * Display the primary dynamic sidebar.
 * @since Geode 1.4.0
 */
add_filter('geode_primary_sidebar','geode_dynamic_primary');
function geode_dynamic_primary() {
	/* ID */
	if ( is_category() ) {
		global $cat;
		$id = $cat;
		$term = get_category($id);
		$t_slug = $term->slug.'_category';
		$term_meta = get_option( "taxonomy_$t_slug" );
	} elseif ( get_query_var( 'term' )!='' ) {
		$t_slug = get_query_var( 'term' ).'_'.get_query_var( 'taxonomy' );
		$term_meta = get_option( "taxonomy_$t_slug" );
		$term = get_term_by('slug',get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$id = $term->term_id;
	    $id = isset(get_queried_object()->ID) ? get_queried_object()->ID : $id;
	} elseif ( pix_is_woocommerce() && is_shop() ) {
		$id = woocommerce_get_page_id('shop');
	} elseif ( isset( get_queried_object()->ID ) ) {
		$id = get_queried_object()->ID;
	}

	$sidebars = '';


	/* SIDEBAR */
    if ( isset( $term_meta['sidebar'] ) && $term_meta['sidebar']!='' ) {
		$sidebar = esc_attr( $term_meta['sidebar'] );
    } elseif ( (is_tax('portfolio_category') || is_post_type_archive('portfolio') || is_tax('portfolio_tag') ) && get_option('pix_content_portfolio_list_sidebar')!='' && !is_singular() ) {
	    $sidebar = get_option('pix_content_portfolio_list_sidebar');
    } elseif ( ( is_page() || (pix_is_woocommerce() && is_shop())) && get_post_meta( $id, 'pix_sidebar_select', true )!='' ) {
	    $sidebar = get_post_meta( $id, 'pix_sidebar_select', true );
	} elseif ( is_home() && get_option('pix_content_latest_post_page')!='' ) {
	    $sidebar = get_post_meta( get_option('pix_content_latest_post_page'), 'pix_sidebar_select', true );
	} elseif ( is_search() && get_option('pix_content_search_page')!='' ) {
	    $sidebar = get_post_meta( get_option('pix_content_search_page'), 'pix_sidebar_select', true );
	} elseif ( is_singular('post') ) {
	    $sidebar = get_post_meta( $id, 'pix_sidebar_select', true )=='' ? get_option( 'pix_content_single_sidebar' ) : get_post_meta( $id, 'pix_sidebar_select', true );
	} elseif ( is_singular('portfolio') ) {
	    $sidebar = get_post_meta( $id, 'pix_sidebar_select', true )=='' ? get_option( 'pix_content_single_portfolio_sidebar' ) : get_post_meta( $id, 'pix_sidebar_select', true );
	    $sidebar = $sidebar == '' ? get_option( 'pix_content_portfolio_list_sidebar' ) : $sidebar;
	} elseif ( pix_is_woocommerce() && !pix_is_product() && !is_shop() && get_option( 'pix_content_woo_list_sidebar' ) != '' ) {
	    $sidebar = get_option( 'pix_content_woo_list_sidebar' );
	} elseif ( pix_is_woocommerce() && pix_is_product() ) {
	    $sidebar = get_post_meta( $id, 'pix_sidebar_select', true )=='' ? get_option( 'pix_content_product_sidebar' ) : get_post_meta( $id, 'pix_sidebar_select', true );
	    $sidebar = $sidebar == '' ? get_option( 'pix_content_woo_list_sidebar' ) : $sidebar;
	} else {
	    $sidebar = get_option( 'pix_content_primary_sidebar' );
	}
	//if ( $sidebar == '' ) $sidebar = get_option( 'pix_content_primary_sidebar' );

	return strtolower($sidebar);

}
endif;

if ( ! function_exists( 'geode_dynamic_secondary' ) ) :
/**
 * Display the secondary dynamic sidebar.
 * @since Geode 1.6.9
 */
add_filter('geode_secondary_sidebar','geode_dynamic_secondary');
function geode_dynamic_secondary() {
	if ( is_category() ) {
		global $cat;
		$id = $cat;
		$term = get_category($id);
		$t_slug = $term->slug.'_category';
		$term_meta = get_option( "taxonomy_$t_slug" );
	} elseif ( get_query_var( 'term' )!='' ) {
		$t_slug = get_query_var( 'term' ).'_'.get_query_var( 'taxonomy' );
		$term_meta = get_option( "taxonomy_$t_slug" );
		$term = get_term_by('slug',get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$id = $term->term_id;
	    $id = isset(get_queried_object()->ID) ? get_queried_object()->ID : $id;
	} elseif ( pix_is_woocommerce() && is_shop() ) {
		$id = woocommerce_get_page_id('shop');
	} elseif ( isset( get_queried_object()->ID ) ) {
		$id = get_queried_object()->ID;
	}
	$sidebars = '';

	/* SIDEBAR */
    if ( isset(get_queried_object()->term_id) && isset( $term_meta['sidebar2'] ) && $term_meta['sidebar2']!='' ) {
		$sidebar = esc_attr( $term_meta['sidebar2'] );
    } elseif ( (is_tax('portfolio_category') || is_post_type_archive('portfolio') || is_tax('portfolio_tag') ) && get_option('pix_content_portfolio_list_sidebar_2')!='' ) {
	    $sidebar = get_option('pix_content_portfolio_list_sidebar_2');
    } elseif ( ( is_page() || (pix_is_woocommerce() && is_shop())) && get_post_meta( $id, 'pix_sidebar_select_2', true )!='' ) {
	    $sidebar = get_post_meta( $id, 'pix_sidebar_select_2', true );
	} elseif ( is_home() && get_option('pix_content_latest_post_page')!='' ) {
	    $sidebar = get_post_meta( get_option('pix_content_latest_post_page'), 'pix_sidebar_select_2', true );
	} elseif ( is_search() && get_option('pix_content_search_page')!='' ) {
	    $sidebar = get_post_meta( get_option('pix_content_search_page'), 'pix_sidebar_select_2', true );
	} elseif ( is_singular('post') ) {
	    $sidebar = get_post_meta( $id, 'pix_sidebar_select_2', true )=='' ? get_option( 'pix_content_single_sidebar_2' ) : get_post_meta( $id, 'pix_sidebar_select_2', true );
	} elseif ( is_singular('portfolio') ) {
	    $sidebar = get_post_meta( $id, 'pix_sidebar_select_2', true )=='' ? get_option( 'pix_content_single_portfolio_sidebar_2' ) : get_post_meta( $id, 'pix_sidebar_select_2', true );
	    $sidebar = $sidebar == '' ? get_option( 'pix_content_portfolio_list_sidebar_2' ) : $sidebar;
	} elseif ( pix_is_woocommerce() && pix_is_product() && get_option( 'pix_content_product_sidebar_2' )!='' ) {
	    $sidebar = get_option( 'pix_content_product_sidebar_2' );
	} elseif ( pix_is_woocommerce() && !pix_is_product() && !is_shop() && get_option( 'pix_content_woo_list_sidebar' ) != '' ) {
	    $sidebar = get_option( 'pix_content_woo_list_sidebar_2' );
	} else {
	    $sidebar = get_option( 'pix_content_secondary_sidebar' );
	}
	//if ( $sidebar == '' ) $sidebar = get_option( 'pix_content_secondary_sidebar' );

	return strtolower($sidebar);

}
endif;

if ( ! function_exists( 'geode_remove_protocol' ) ) :
/**
 * Remove protocol from URLs.
 * @since Geode 1.0
 */
function geode_remove_protocol($url){
	if ( is_array($url) )
		return $url;
	$disallowed = array('http:', 'https:');
	foreach($disallowed as $d) {
		if(strpos($url, $d) === 0) {
			return str_replace($d, '', $url);
		}
	}
	return $url;
}
endif;

if ( ! function_exists( 'pix_hex2rgbcompiled' ) ) :
/**
 * Turn HEX colors to RGB.
 * @since Geode 1.0
 */
function pix_hex2rgbcompiled($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb[0].','.$rgb[1].','.$rgb[2];
}
endif;

if ( ! function_exists( 'geode_additional_templates' ) ) :
/**
 * Locate additional templates.
 * @since Geode 1.0
 */
add_filter('template_include', 'geode_additional_templates', 99 );
function geode_additional_templates($template) {
	global $post;
	$layout = geode_get_page_template();

	if ( post_password_required($post) ) {
		$template = locate_template( 'templates/password-required.php' );
	    return $template;
	}

    if ( is_singular( 'post' ) ) {
    	switch ($layout) {
    		case 'templates/wide-page.php':
		    	$single = 'templates/single-wide.php';	
    			break;
    		case 'templates/double-side-page.php':
		    	$single = 'templates/single-double-side.php';	
    			break;
    		case 'default':
    		default:
		    	$single = 'single.php';	
    			break;
    	}
        $template = locate_template( $single );
	} elseif ( is_singular( 'portfolio' ) ) {
    	switch ($layout) {
    		case 'templates/wide-page.php':
		    	$single = 'single-wide-portfolio.php';	
    			break;
    		case 'templates/double-side-page.php':
		    	$single = 'single-double-side-portfolio.php';	
    			break;
    		case 'default':
    		default:
		    	$single = 'single-portfolio.php';	
    			break;
    	}
        $template = locate_template( 'portfolio/'.$single );
	} elseif ( is_singular( 'team' ) ) {
        $template = locate_template( 'single-team.php' );
	} elseif ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) {
    	switch ($layout) {
    		case 'templates/wide-page.php':
		    	$archive = 'archive-wide-portfolio.php';	
    			break;
    		case 'templates/double-side-page.php':
		    	$archive = 'archive-double-side-portfolio.php';	
    			break;
    		case 'templates/full-width-page.php':
		    	$archive = 'archive-fullwidth-portfolio.php';	
    			break;
    		case 'default':
    		default:
		    	$archive = 'archive-portfolio.php';	
    			break;
    	}
        $template = locate_template( 'portfolio/'.$archive );
    }

    return $template;
}
endif;

if ( ! function_exists( 'geode_loop_product_data' ) ) :
/**
 * Display grids as masonry in particular circumstances.
 * @since Geode 1.0
 */
add_filter('geode_loop_product_data','geode_loop_product_data');
function geode_loop_product_data(){
	global $post, $shortcode_layout;


	if ( pix_is_woocommerce() ) {
		if ( is_shop() ) {
			$grid = get_option('pix_style_shop_list_template');
		} elseif ( is_tax() ) {
		    $id = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : '';
			$term = get_term_by('id',$id, get_query_var( 'taxonomy' ) );
			$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
			$term_meta = get_option( "taxonomy_$t_slug" );
			$grid = isset($term_meta['layout']) ? esc_attr( $term_meta['layout'] ) : get_option('pix_style_shop_list_template');
			$grid = $grid == '' ? get_option('pix_style_woo_list_layout') : $grid;
		} else {
			$grid = get_option('pix_style_woo_list_template');
		}
	} elseif ( is_tax('portfolio_category') || is_tax('portfolio_tag') || is_post_type_archive('portfolio') || is_category() ) {
		if ( is_category() ) {
			global $cat;
			$id = $cat;
			$term = get_category($id);
			$t_slug = $term->slug.'_category';
			$term_meta = get_option( "taxonomy_$t_slug" );
		} else {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if ( $term )
				$id = $term->term_id;
			if ( isset($id) ) {
				$term = get_term_by('id',$id, get_query_var( 'taxonomy' ) );
				$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
				$term_meta = get_option( "taxonomy_$t_slug" );
			}
		}
		if ( is_tax('portfolio_category') || is_tax('portfolio_tag') || is_post_type_archive('portfolio') )
			$grid = get_option( 'pix_style_portfolio_list_layout' );
		else 
			$grid = get_option( 'pix_style_archive_layout' );
		$grid = isset( $term_meta['layout'] ) && $term_meta['layout']!='' ? esc_attr( $term_meta['layout'] ) : $grid; 
	} elseif ( is_post_type_archive('portfolio') || is_tax('portfolio_tag') ) {
		$grid = get_option( 'pix_style_portfolio_list_layout' );
	} elseif ( !empty($shortcode_layout) ) {
		$grid = $shortcode_layout;		
	}

	if ( isset($grid) && $grid == 'masonry' ) {
		echo ' data-grid="masonry"';
	}
}
endif;

if ( ! function_exists( 'geode_loop_category_data' ) ) :
/**
 * Category layout filter.
 * @since Geode 1.4.1
 */
add_filter('geode_loop_category_data','geode_loop_category_data');
function geode_loop_category_data(){
	global $post, $shortcode_layout;

	if ( is_category() ) {
		global $cat;
		$id = $cat;
		$term = get_category($id);
		$t_slug = $term->slug.'_category';
		$term_meta = get_option( "taxonomy_$t_slug" );

		$grid = get_option( 'pix_style_archive_layout' );
		$grid = isset( $term_meta['layout'] ) && $term_meta['layout']!='' ? esc_attr( $term_meta['layout'] ) : $grid; 
	} elseif ( is_home() ) {
		$grid = get_option( 'pix_style_latest_post_page_layout' );
	}

	if ( isset($grid) && $grid == 'masonry' ) {
		return $grid;
	}
}
endif;

if ( ! function_exists( 'geode_portfolio_body_class' ) ) :
/**
 * Body class on portfolio post type.
 * @since Geode 1.0
 */
add_filter( 'body_class', 'geode_portfolio_body_class' );
function geode_portfolio_body_class($classes) {
	global $shortcodelic_loop;
	if ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_category' ) || is_tax('portfolio_tag') ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if ($term ) {
			$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
			$term_meta = get_option( "taxonomy_$t_slug" );
		}
		$columns = isset( $term_meta['columns'] ) && $term_meta['columns']!='' ? esc_attr( $term_meta['columns'] ) : get_option( 'pix_style_portfolio_list_columns' );
		$classes[] = 'sc-layout';
		$classes[] = 'sc-columns-'.apply_filters('geode_portfolio_columns_body_class',$columns);
	} elseif ( is_single() || is_page() ) {
		$content = get_the_content();
		if (strpos($content,'[shortcodelic-portfolio') !== false) {
			$classes[] = 'sc-layout';
		}
	}
	return $classes;
}
endif;

if ( ! function_exists( 'geode_get_thumb_size' ) ) :
/**
 * Get thumb sizes.
 * @since Geode 1.0
 */
function geode_get_thumb_size($cols=null) {
	global $shortcodelic_loop, $shortcodelic_blog, $shortcodelic_blog_masonry, $shortcodelic_widget;
	$page_template = geode_get_page_template();
	if ( $shortcodelic_widget===true  ) {
		$page_template = 'widget';
	}
	if ( $shortcodelic_loop===true  ) {
		global $columns, $ratio;
	} elseif ( isset(get_queried_object()->term_id) ) {
		if (is_tax('portfolio_category') || is_tax('portfolio_tag') || is_post_type_archive('portfolio') ) {
			$ratio = get_option('pix_style_portfolio_list_layout');
			$columns = get_option('pix_style_portfolio_list_columns');
		} else {
			$ratio = get_option('pix_style_archive_layout');
			$columns = $ratio == 'standard' ? 1 : get_option('pix_style_archive_columns');
		}
		if ( is_category() ) {
			global $cat;
			$id = $cat;
			$term = get_category($id);
			$t_slug = $term->slug.'_category';
			$term_meta = get_option( "taxonomy_$t_slug" );
		} else {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if ( $term )
				$id = $term->term_id;
			$term = get_term_by('id',$id, get_query_var( 'taxonomy' ) );
			$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
			$term_meta = get_option( "taxonomy_$t_slug" );
		}
		$columns = isset($term_meta['columns']) && esc_attr( $term_meta['columns'] ) != '' ? esc_attr( $term_meta['columns'] ) : $columns;
		$ratio = isset($term_meta['layout']) && esc_attr( $term_meta['layout'] ) != '' ? esc_attr( $term_meta['layout'] ) : $ratio;
		$columns = $ratio == 'standard' ? 1 : $columns;
	} elseif ( geode_is_related() ) {
		$ratio = apply_filters('geode_related_ratio', '4:3');
		$columns = apply_filters('geode_related_columns', '3');
	} elseif ( is_post_type_archive('portfolio') || is_tax('portfolio_tag') ) {
		$ratio = get_option('pix_style_portfolio_list_layout');
		$columns = get_option( 'pix_style_portfolio_list_columns' );
	} elseif ( is_home() && !isset($shortcodelic_blog) ) {
		$ratio = get_option('pix_style_latest_post_page_layout');
		$columns = $ratio == 'standard' ? 1 : get_option('pix_style_latest_post_page_columns');
	} elseif ( isset($shortcodelic_blog) ) {
		global $columns, $ratio;
	} else {
		$ratio = 'auto';
		$columns = 1;
	}

	switch ($page_template) {
		case 'widget':
			$width = 559;
			break;
		case 'templates/wide-page.php':
			$width = 1120;
			break;
		case 'templates/double-side-page.php':
			$width = 560;
			break;
		default:
			$width = 840;
			break;
	}

	if ( is_search() ) $width = 559;

	if (isset($cols) || $cols==null)
		$cols = $columns;

	if ( ($width/$cols)<=560 ) {
		$size = 'geode_inter';
	} elseif ( ($width/$cols)>560 && ($width/$cols)<=840 ) {
		$size = 'geode_medium';
	} else {
		$size = 'geode_large';
	}

	if ( is_search() || $shortcodelic_widget===true ) {
		$size = 'geode_small';
	}

	switch ($ratio) {
		case '1:1':
			$return = array(1120,1120,$ratio);
			break;
		case '4:3':
			$return = array(1120,840,$ratio);
			break;
		case '16:9':
			$return = array(1120,630,$ratio);
			break;
		case 'standard':
			$return = array(1120,490,$ratio);
			break;
		default:
			$return = array(1120,0,'');
			break;
	}

	if ( is_search() ) {
		$return = array(200, 150, '4:3');
	}

    return array('width' => $return[0], 'height' => $return[1], 'ratio' => $return[2], 'size' => $size);
}
endif;

if ( ! function_exists( 'geode_print_thumb' ) ) :
/**
 * Print the thumbnail if available.
 * @since Geode 1.0
 */
add_filter('geode_print_thumb', 'geode_print_thumb');
function geode_print_thumb($columns=null) {
	$th_size = apply_filters('geode_get_thumb_size', geode_get_thumb_size($columns));
	if ( has_post_thumbnail() )
		return geode_post_thumbnail( null, $th_size['size'], array($th_size['width'],$th_size['height']), array( 'class' => 'wp-post-image' ) );
	elseif ( pix_is_woocommerce_active() && wc_placeholder_img_src() )
		return wc_placeholder_img( $th_size['size'] );
}
endif;

if ( ! function_exists( 'geode_grid_gutter' ) ) :
/**
 * Set the pixgridder gutter.
 * @since Geode 1.0
 */
add_action( 'wp_head', 'geode_grid_gutter' );
function geode_grid_gutter(){
	if ( is_tax('portfolio_category') ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if ( $term ) {
			$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
			$term_meta = get_option( "taxonomy_$t_slug" );
		}
		$gutter = isset( $term_meta['gutter'] ) && $term_meta['gutter']!='' ? esc_attr( $term_meta['gutter'] ) : get_option( 'pix_style_portfolio_list_gutter' );
		$gutter_2 = $gutter/2;
		$selector = '.sc-layout #page #main .sc-grid';

		if ( isset( $gutter ) && $gutter != 0 && $gutter != '' ) {
			echo "<style>
		$selector {
			margin-left: -{$gutter}%;
			margin-right: 0;
		}
		.layout-fullwidth$selector {
			margin-left: 0;
			margin-right: $gutter%;
		}
		$selector article.hentry {
			margin: $gutter_2% 0;
			padding-left: $gutter%;
		}
	</style>";
		}
	} elseif ( is_post_type_archive('portfolio') || is_tax('portfolio_tag') ) {
		$gutter = get_option( 'pix_style_portfolio_list_gutter' );
		$gutter_2 = $gutter/2;
		$selector = '.sc-layout #page #main .sc-grid';

		if ( isset( $gutter ) && $gutter != '' ) {
			echo "<style>
		$selector {
			margin-left: -{$gutter}%;
		}
		.layout-fullwidth$selector {
			margin-left: 0;
			margin-right: $gutter%;
		}
		$selector article.hentry {
			margin: $gutter_2% 0;
			padding-left: $gutter%;
		}
	</style>";
		}
	} elseif ( is_home() || is_archive() ) {
		if ( is_category() ) {
			global $cat;
			$id = $cat;
			$term = get_term_by('id',$id, get_query_var( 'taxonomy' ) );
			$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
			$term_meta = get_option( "taxonomy_$t_slug" );
			$gutter = isset( $term_meta['gutter'] ) && $term_meta['gutter']!='' ? esc_attr( $term_meta['gutter'] ) : get_option( 'pix_style_archive_gutter' );
		} elseif ( is_home() ) {
			$gutter = get_option( 'pix_style_latest_post_page_gutter' );
		}
		$gutter = isset($gutter) ? $gutter : get_option( 'pix_style_archive_gutter' );
		$margin_bottom = $gutter > 0 ? "$gutter%" : "-1px";
		$margin_right = $gutter > 0 ? "-1px" : "-2px";
		$selector = '#page #main .grid-blog .blog-isotope-grid';

		if ( isset( $gutter ) && $gutter != '' ) {
			echo "<style>
		$selector {
			margin-left: -{$gutter}%;
		}
		$selector article.hentry {
			margin: 0 -1px $margin_bottom 0;
			padding-left: $gutter%;
		}
		@media (min-width: 1025px) {
			$selector article.hentry:first-child {
				margin-right: $margin_right;
			}
		}
		@media (max-width: 1024px) {
			$selector article.hentry:first-child {
				margin-right: -1px;
			}
		}
	</style>";
		}
	}
}
endif;

if ( ! function_exists( 'geode_portfolio_fancy' ) ) :
/**
 * Return the portfolio grid style.
 * @since Geode 1.0
 */
function geode_portfolio_fancy(){
	global $shortcodelic_loop;
	if ( $shortcodelic_loop===true && !geode_is_related() ) {
		global $textpos;
		if ( $textpos == 'fancy' )
			return $textpos;
		else
			return 'below';
	} elseif ( (is_tax() || is_archive()) && !geode_is_related() ) {
		if ( is_category() ) {
			global $cat;
			$id = $cat;
		} else {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if ( $term )
				$id = $term->term_id;
		}
		if ( isset($id) ) {
			$term = get_term_by('id',$id, get_query_var( 'taxonomy' ) );
			$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
			$term_meta = get_option( "taxonomy_$t_slug" );
		}
		$textpos = isset( $term_meta['textpos'] ) && $term_meta['textpos'] ? esc_attr( $term_meta['textpos'] ) : get_option('pix_style_portfolio_text_position');
		if ( $textpos == 'fancy' )
			return $textpos;
		else
			return 'below';
	} else {
		return;
	}
}
endif;

if ( ! function_exists( 'geode_portfolio_post' ) ) :
/**
 * Add class to the portfolio posts.
 * @since Geode 1.0
 */
add_filter( 'post_class', 'geode_portfolio_post' );
function geode_portfolio_post($classes){

	if ( is_admin() )
		return $classes;

	global $shortcodelic_loop;
	$class = '';
	if ( $shortcodelic_loop===true && !geode_is_related() ) {
		global $textpos;
		if ( $textpos == 'fancy' )
			$class = $textpos;
		else
			$class = 'below';
	} elseif ( (is_tax() || is_archive()) && !geode_is_related() ) {
		if ( is_category() ) {
			global $cat;
			$id = $cat;
		} else {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if ( $term )
				$id = $term->term_id;
		}
		if ( isset($id) ) {
			$term = get_term_by('id',$id, get_query_var( 'taxonomy' ) );
			$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
			$term_meta = get_option( "taxonomy_$t_slug" );
		}
		$textpos = isset( $term_meta['textpos'] ) && $term_meta['textpos'] ? esc_attr( $term_meta['textpos'] ) : get_option('pix_style_portfolio_text_position');
		if ( $textpos == 'fancy' )
			$class = $textpos;
		else
			$class = 'below';
	}
	if ( $class!='' )
		$class = 'post-portfolio-'.$class;

	$classes[] = $class;

	return $classes;
}
endif;

if ( ! function_exists( 'geode_portfolio_linkto' ) ) :
/**
 * Get the links for the portfolio items in loop.
 * @since Geode 1.0
 */
function geode_portfolio_linkto(){
	global $shortcodelic_loop;
	if ( $shortcodelic_loop===true ) {
		global $linkto;
		return $linkto;
	} elseif ( is_tax() || is_archive() ) {
		if ( is_category() ) {
			global $cat;
			$id = $cat;
		} else {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if ( $term )
				$id = $term->term_id;
		}
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if ( isset($id) ) {
			$term = get_term_by('id',$id, get_query_var( 'taxonomy' ) );
			$t_slug = $term->slug.'_'.get_query_var( 'taxonomy' );
			$term_meta = get_option( "taxonomy_$t_slug" );
		}
		$link = isset( $term_meta['link'] ) && $term_meta['link'] ? esc_attr( $term_meta['link'] ) : get_option('pix_style_portfolio_list_link');
		return $link;
	} else {
		return;
	}
}
endif;

if ( ! function_exists( 'geode_portfolio_filter' ) ) :
/**
 * Portfolio filters by tag and categories.
 * @since Geode 1.0
 */
function geode_portfolio_filter($cat_filter=true, $tag_filter=true) {

	$out = '';
	$outend = '';

	global $query_string;
	parse_str($query_string, $portfolio_query);
	$portfolio_query = new WP_Query( $portfolio_query );
    $cat_array = array();
    $cat_array2 = array();

    $tag_array = array();
    $tag_array2 = array();

	if ( $portfolio_query->have_posts() ) : 
		while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
        $terms_tags = get_the_terms( get_the_id(), 'portfolio_tag' );
        if($terms_tags){
            foreach( $terms_tags as $term ) {
                if(!in_array($term->slug,$tag_array)){
                    $tag_array[] = $term->slug;
                }
                if(!in_array($term->name,$tag_array2)){
                    $tag_array2[] = $term->name;
                }
                unset($term);
            }
        }

		$cat = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if ( $cat )
			$cur_cat = $cat->name;
		else
			$cur_cat = __('All','geode');
        $terms_cats = get_the_terms( get_the_id(), 'portfolio_category' );
        if($terms_cats){
            foreach( $terms_cats as $term ) {
            	if ( $term->name != $cur_cat ) {
	                if(!in_array($term->slug,$cat_array)){
	                    $cat_array[] = $term->slug;
	                }
	                if(!in_array($term->name,$cat_array2)){
	                    $cat_array2[] = $term->name;
	                }
	                unset($term);
	            }
            }
        }
	endwhile;

    if( $cat_filter==true && count($cat_array)!=0 && count($cat_array2)!=0 && (is_post_type_archive('portfolio') || is_single() || is_page() ) ) {
	    $cat_array3 = pix_array_combine($cat_array, $cat_array2);
	    asort($cat_array3);
	    $out .= '<div class="sc-portfolio-filter sc-filter-categories">'.
	    '<strong>'.__('Categories', 'geode').': </strong>'.
	    '<a href="#" data-filter-cat="all" class="selected">'.$cur_cat.'</a>';
	    foreach( $cat_array3 as $key => $value ) {
	        $out .= '<span class="sc-filter-separator">&bull;</span><a href="#" data-filter-cat="'.$key.'">'.$value.'</a>';
	    }
	    $out .= '</div><!-- .sc-portfolio-filter.sc-filter-categories -->';
	}

    if( $cat_filter==true && count($cat_array)!=0 && count($cat_array2)!=0 &&  $tag_filter==true && count($tag_array)!=0 && count($tag_array2)!=0 && is_post_type_archive('portfolio') ) {
    	$out .= '<div class="clear"></div>';
    }

    if( $tag_filter==true && count($tag_array)!=0 && count($tag_array2)!=0 ) {
	    $tag_array3 = pix_array_combine($tag_array, $tag_array2);
	    asort($tag_array3);
	    $out .= '<div class="sc-portfolio-filter sc-filter-tags">'.
	    '<strong>'.__('Tags', 'geode').': </strong>'.
	    '<a href="#" data-filter-tag="all" class="selected">'.__('All','geode').'</a>';
	    foreach( $tag_array3 as $key => $value ) {
	        $out .= '<span class="sc-filter-separator">&bull;</span><a href="#" data-filter-tag="'.$key.'">'.$value.'</a>';
	    }
	    $out .= '</div><!-- .sc-portfolio-filter.sc-filter-tags -->';
	}

    endif;
	wp_reset_postdata();

    if ( $out != '' ) {
    	return '<div class="sc-portfolio-filters">' . $out . '</div><!-- .sc-portfolio-filters -->';
    }

}
endif;

if ( ! function_exists( 'get_the_term_list_breadcrumbs' ) ) :
/**
 * Breadcrumbs.
 * @since Geode 1.0
 */
function get_the_term_list_breadcrumbs( $id = 0, $taxonomy, $before = '', $sep = '', $after = '', $breadcrumb_sep = ' &rarr; ' ) {
	$terms = get_the_terms( $id, $taxonomy );
 
	if ( is_wp_error( $terms ) )
		return $terms;
 
	if ( empty( $terms ) )
		return false;
 
	foreach ( $terms as $term ) {
		$link = get_term_link( $term, $taxonomy );
		if ( is_wp_error( $link ) )
			return $link;
		
		// Find parents
		$names = array();
		$ancestors = get_ancestors( $term->term_id, $taxonomy );
		if ( count( $ancestors ) > 0 ) {
			foreach ( $ancestors as $anc ) {
				$t = get_term( $anc, $taxonomy );
				$names[] = $t->name;
			}
		}
		$names[] = $term->name;
		$link_text = implode( $breadcrumb_sep, $names );
		
		$term_links[] = '<a href="' . $link . '" rel="tag">' . $link_text . '</a>';
	}
 
	$term_links = apply_filters( "term_links-$taxonomy", $term_links );
 
	return $before . join( $sep, $term_links ) . $after;
}
endif;

if ( ! function_exists( 'pix_array_combine' ) ) :
/**
 * Array combine little hacked.
 * @since Geode 1.0
 */
function pix_array_combine($arr1, $arr2) {
    $count = min(count($arr1), count($arr2));
    return array_combine(array_slice($arr1, 0, $count), array_slice($arr2, 0, $count));
}
endif;

if ( ! function_exists( 'geode_min_css' ) ) :
/**
 * Minify CSS files.
 * @since Geode 1.0
 */
function geode_min_css($code) {
    $code = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code);
    $code = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $code);
    $code = str_replace('{ ', '{', $code);
    $code = str_replace(' }', '}', $code);
    $code = str_replace('; ', ';', $code);
    return $code;
}
endif;

if ( ! function_exists( 'geode_wp_title_for_home' ) ) :
/**
 * wp_title on custom home page.
 * @since Geode 1.0
 */
add_filter( 'wp_title', 'geode_wp_title_for_home' );
function geode_wp_title_for_home( $title )
{
	if( empty( $title ) && ( is_home() || is_front_page() ) ) {
		return get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
	}
	return $title;
}
endif;

if ( ! function_exists( 'geode_darken_color' ) ) :
/**
 * Darken HEX colors.
 * @since Geode 1.0
 */
function geode_darken_color($color){
 
	if($color=='' || $color=='transparent') {
		return 'transparent';        
	} else {
		$hex = str_replace('#', '', $color);
		$new_hex = '';
		
		$base['R'] = hexdec($hex{0}.$hex{1});
		$base['G'] = hexdec($hex{2}.$hex{3});
		$base['B'] = hexdec($hex{4}.$hex{5});
		$i = 0;
		
		foreach ($base as $k => $v) {
			switch ($i) {
				case 0:
					$dif = 5;
					break;
				default:
					$dif = 50;
					break;
			}
			$amount = $v / 100;
			$amount = round($amount * $dif);
			$new_decimal = $v - $amount;

			$new_hex_component = dechex($new_decimal);
			if(strlen($new_hex_component) < 2)
					{ $new_hex_component = "0".$new_hex_component; }
			$new_hex .= $new_hex_component;
			$i++;
		}
		if (strlen($new_hex) > 6){ $new_hex = '000000'; }
				
		return '#'.$new_hex;    
	}
}
endif;

if ( ! function_exists( 'geode_build_query' ) ) :
/**
 * Workaround for 404 page from search results.
 * @since Geode 1.0
 */
function geode_build_query( $query ){
    $query_array = array();
    foreach( $query as $key => $key_value ){
        $query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
    }
    return implode( '&', $query_array );
}
endif;

if ( ! function_exists( 'geode_wpcf7_get_default_template' ) ) :
/**
 * Contact form 7 default template.
 * @since Geode 1.0
 */
add_filter( 'wpcf7_default_template', 'geode_wpcf7_get_default_template', 10, 2 );
add_filter( 'wpcf7_messages', 'geode_wpcf7_messages' );
function geode_wpcf7_get_default_template( $template, $prop = 'form' ) {
	if ( 'form' == $prop )
		$template = geode_wpcf7_default_form_template();
	elseif ( 'mail' == $prop )
		$template = geode_wpcf7_default_mail_template();
	elseif ( 'mail_2' == $prop )
		$template = geode_wpcf7_default_mail_2_template();
	elseif ( 'messages' == $prop && function_exists('wpcf7_default_messages_template') )
		$template = wpcf7_default_messages_template();
	elseif ( 'messages' == $prop && !function_exists('wpcf7_default_messages_template') )
		$template = WPCF7_ContactFormTemplate::messages();
	else
		$template = null;

	return $template;
}

function geode_wpcf7_default_form_template() {
	$template =
		__( 'Your Name', 'contact-form-7' ) . "*\n"
		. '[text* your-name]' . "\n\n"
		. __( 'Your Email', 'contact-form-7' ) . "*\n"
		. '[email* your-email]' . "\n\n"
		. __( 'Your Message', 'contact-form-7' ) . "*\n"
		. '[textarea your-message]' . "\n\n"
		. '[submit "' . __( 'Send', 'contact-form-7' ) . '"]';
	return $template;
}

function geode_wpcf7_default_mail_template() {
	$subject = sprintf( __( 'Email from "%s"', 'geode' ), get_bloginfo('name') );
	$sender = '[your-name] <[your-email]>';
	$body = sprintf( __( 'From: %s', 'contact-form-7' ), '[your-name] <[your-email]>' ) . "\n"
		. sprintf( __( 'Subject: %s', 'contact-form-7' ), $subject ) . "\n\n"
		. __( 'Message Body:', 'contact-form-7' ) . "\n" . '[your-message]' . "\n\n" . '--' . "\n"
		. sprintf( __( 'This e-mail was sent from a contact form on %1$s (%2$s)', 'contact-form-7' ),
			get_bloginfo( 'name' ), home_url() );
	$recipient = get_option( 'admin_email' );
	$additional_headers = '';
	$attachments = '';
	$use_html = 0;
	return compact( 'subject', 'sender', 'body', 'recipient', 'additional_headers', 'attachments', 'use_html' );
}

function geode_wpcf7_default_mail_2_template() {
	$subject = sprintf( __( 'Email from "%s"', 'geode' ), get_bloginfo('name') );
	$sender = '[your-name] <[your-email]>';
	$body = sprintf( __( 'From: %s', 'contact-form-7' ), '[your-name] <[your-email]>' ) . "\n"
		. sprintf( __( 'Subject: %s', 'contact-form-7' ), $subject ) . "\n\n"
		. __( 'Message Body:', 'contact-form-7' ) . "\n" . '[your-message]' . "\n\n" . '--' . "\n"
		. sprintf( __( 'This e-mail was sent from a contact form on %1$s (%2$s)', 'contact-form-7' ),
			get_bloginfo( 'name' ), home_url() );
	$recipient = get_option( 'admin_email' );
	$additional_headers = '';
	$attachments = '';
	$use_html = 0;
	return compact( 'active', 'subject', 'sender', 'body', 'recipient', 'additional_headers', 'attachments', 'use_html' );
}

add_filter( 'wpcf7_is_date','geode_wpcf7_remove_date_validation' );
function geode_wpcf7_remove_date_validation($date) {
	return true;
}


function geode_wpcf7_messages() {
	$messages = array(
		'mail_sent_ok' => array(
			'description' => __( "Sender's message was sent successfully", 'geode' ),
			'default' => __( 'Your message was sent successfully. Thanks', 'geode' )
		),

		'mail_sent_ng' => array(
			'description' => __( "Sender's message was failed to send", 'geode' ),
			'default' => __( 'Failed to send your message. Please try later', 'geode' )
		),

		'validation_error' => array(
			'description' => __( "Validation errors occurred", 'geode' ),
			'default' => __( 'Validation errors occurred', 'geode' )
		),

		'spam' => array(
			'description' => __( "Submission was referred to as spam", 'geode' ),
			'default' => __( 'Failed to send your message. Please try later', 'geode' )
		),

		'accept_terms' => array(
			'description' => __( "There are terms that the sender must accept", 'geode' ),
			'default' => __( 'Please accept the terms to proceed', 'geode' )
		),

		'invalid_required' => array(
			'description' => __( "There is a field that the sender must fill in", 'geode' ),
			'default' => __( 'Please fill the required field', 'geode' )
		)
	);
	return $messages;
}
endif;

if ( ! function_exists( 'geode_filter_type_range_wpcf7' ) ) :
/**
 * Styling some inputs and WPCF7.
 * @since Geode 1.0
 */
add_filter( 'the_content', 'geode_filter_type_range_wpcf7', 20 );
function geode_filter_type_range_wpcf7($content){
	$range = '<span class="slider_div percent">
	<input$1type="text"$2>
	<span class="slider_cursor"></span>
</span><!-- .slider_div -->';
	$content = preg_replace("/<input(.*)type=[\"']?range[\"']([^>]+?)>/iU", $range, $content);
	$content = preg_replace("/<input(.*)type=[\"']?date[\"']([^>]+?)>/iU", '<input$1type="text"$2>', $content);
	$content = preg_replace("/<p><div/iU", '<div', $content);
	$content = preg_replace("/<\/div><\/p>/iU", '</div>', $content);
	return $content;
}
endif;

if ( ! function_exists( 'geode_import_insert_post' ) ) :
/**
 * Check the title of imported posts to set demo content.
 * @since Geode 1.0
 */
add_action( 'wp_import_insert_post', 'geode_import_insert_post', 10, 4);
function geode_import_insert_post($post_id, $original_post_ID, $postdata, $post) {
	$post_exists = post_exists('Welcome to Geode');
	if ( $post_exists )
		wp_delete_post( $post_exists );
	if ( $post['post_title'] == 'Home page [demo]' ) {
		update_option('show_on_front','page');
		update_option('page_on_front',$post_id);
	}
	if ( $post['post_title'] == 'Blog [demo]' ) {
		update_option('show_on_front','page');
		update_option('page_for_posts',$post_id);
	}
	if ( $post['post_title'] == 'Footer [demo]' )
		update_option('pix_content_footer_page',$post_id);
	if ( $post['post_title'] == 'Top sliding bar [demo]' )
		update_option('pix_content_top_sliding_page',$post_id);
	if ( $post['post_title'] == 'Page not found [demo]' )
		update_option('pix_content_404_page',$post_id);
	if ( $post['post_title'] == 'Search results [demo]' )
		update_option('pix_content_search_page',$post_id);
	if ( $post['post_title'] == 'Shop [demo]' )
		update_option('woocommerce_shop_page_id',$post_id);
}
endif;

if ( ! function_exists( 'pix_import_export' ) ) :
/**
 * Import/xport admin panel.
 * @since Geode 1.0
 */
function pix_import_export($file, $set) {
	$current_user = wp_get_current_user();
	$upload_dir = wp_upload_dir();
	
	$fcontents = file_get_contents($file);
	$fcontents = str_replace("%pix_upload_dir%", $upload_dir['baseurl'], $fcontents);
	$fcontents = str_replace("%pix_theme_dir%", get_template_directory_uri(), $fcontents);
	$fcontents = explode('[option_name]',$fcontents);
	
	for($i=1; $i<=(sizeof ($fcontents)-1); $i++) {
		$arr = explode("[option_value]", $fcontents[$i]);

		$arr_1 = maybe_unserialize($arr[1]);
		//echo $arr[0].': '.$arr_1.'<br>';
		
		if ( $set == 'import_skin_style' ) {

			if ( (preg_match("/pix_style_/", $arr[0]) && $arr[0] != 'pix_style_custom_css') || preg_match("/shortcodelic_/", $arr[0]) || preg_match("/pixgridder_/", $arr[0]) ) {
				update_option($arr[0], $arr_1);
			} elseif ( $arr[0] == 'pix_style_custom_css' ) {
				if ( get_option( 'pix_style_custom_css' ) != $arr[1] && $arr[1] != '' ) {
					$prev_customstyles = get_option ( 'pix_style_custom_css' ).PHP_EOL.'/*Imported styles on '.date("Y-m-d").' (start)*/'.PHP_EOL.$arr[1].PHP_EOL.'/*Imported styles on '.date("Y-m-d").' (end)*/';
					update_option ( 'pix_style_custom_css',$prev_customstyles );
				}
			}
				
		} elseif ( $set == 'import_skin_content' ) {

			if ( preg_match("/pix_geode_array/", $arr[0]) ) {
				delete_option($arr[0]);
				add_option($arr[0], $arr_1);
			} elseif ( preg_match("/pix_content_/", $arr[0]) ) {
				update_option($arr[0], $arr_1);
			} elseif ( preg_match("/\[sidebar_name\]/", $arr[0]) ) {
				$sidebar_generator_pix = new sidebar_generator_pix(); 
			    $sidebars = $sidebar_generator_pix->get_sidebars();
				$sidebar_name = str_replace(array("\n","\r","\t"),'',$arr_1);
				$sidebar_id = $sidebar_generator_pix->name_to_class($sidebar_name);
				if($sidebar_id == '' ){
					$options_sidebar = $sidebars;
				} else {
					if(isset($sidebars[$sidebar_id])){

					}
					if ( is_array($sidebars) ) {
						$new_sidebar_gen[$sidebar_id] = $sidebar_id;
						$options_sidebar = array_merge($sidebars, (array) $new_sidebar_gen);	
					} else{
						$options_sidebar[$sidebar_id] = $sidebar_id;
					}		
				}
				update_option( 'pix_sidebar_generator', $options_sidebar);
			}
				
		} else {
			
			return false;
			
		}
		$i+1;
	}

	geode_compile_css();
	@unlink($file);
		
}
endif;

/**
 * Shortcodelic-Addons filters.
 * @since Geode 1.0
 */
add_filter('scadd_2_columns_th','scadd_big');
add_filter('scadd_3_columns_th','scadd_big');
add_filter('scadd_4_columns_th','scadd_big');
add_filter('scadd_5_columns_th','scadd_big');
add_filter('scadd_6_columns_th','scadd_big');
add_filter('scadd_7_columns_th','scadd_big');
add_filter('scadd_8_columns_th','scadd_big');
function scadd_big( $size ) {
    $size = 'large';
    return $size;
}
add_filter('scadd_2-masonry_columns_th','scadd_big_nat');
add_filter('scadd_3-masonry_columns_th','scadd_big_nat');
add_filter('scadd_4-masonry_columns_th','scadd_big_nat');
add_filter('scadd_5-masonry_columns_th','scadd_big_nat');
add_filter('scadd_6-masonry_columns_th','scadd_big_nat');
add_filter('scadd_7-masonry_columns_th','scadd_big_nat');
add_filter('scadd_8-masonry_columns_th','scadd_big_nat');
function scadd_big_nat( $size ) {
    $size = 'large-nat';
    return $size;
}

add_filter('sc_addons_itemID','sc_addons_itemID');
add_filter('pixmenu_itemID','sc_addons_itemID');
function sc_addons_itemID() {
    return '8181066';
}
add_filter('sc_addons_username','sc_addons_username');
add_filter('pixmenu_username','sc_addons_username');
function sc_addons_username() {
    return get_option('pix_content_geode_user_name');
}
add_filter('sc_addons_licensekey','sc_addons_licensekey');
add_filter('pixmenu_licensekey','sc_addons_licensekey');
function sc_addons_licensekey() {
    return get_option('pix_content_geode_license_key');
}


if ( ! function_exists( 'geode_check_license' ) ) :
/**
 * Check ThemeForest license
 * @since Geode 1.0
 */
function geode_check_license($context) {

	$request_url = 'http://www.pixedelic.com/api/products/geode.php';

	$request_string = array(
		'body' => array(
			'action' => 'check_geode_license', 
			'id' => '8181066',
			'username' => $_REQUEST['pix_content_geode_user_name'],
			'license' => $_REQUEST['pix_content_geode_license_key']
		)
	);
	
	$raw_response = wp_remote_post($request_url, $request_string);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
		$body = addslashes($raw_response['body']);
		if( stripos($body,'perfect')!=false ) { ?>
<script type="text/javascript">
/* <![CDATA[ */
var geode_check_license = 'true',
geode_check_message = '<?php echo $body; ?>';
/* ]]> */
</script>
		<?php } else { ?>
<script type="text/javascript">
/* <![CDATA[ */
var geode_check_license = 'false',
geode_check_message = '<?php echo $body; ?>';
/* ]]> */
</script>
		<?php }
	}
	
}
endif;

if ( ! function_exists( 'geode_check_for_update' ) ) :
/**
 * Check for Geode updates
 * @since Geode 1.0
 */
add_filter('pre_set_site_transient_update_themes', 'geode_check_for_update');
function geode_check_for_update($checked_data) {
	global $wp_version, $geode_theme_version, $geode_theme_base, $geode_api_url;

	$args = array(
		'dir' => $geode_theme_base,
		'slug' => $geode_theme_base,
		'version' => $geode_theme_version,
		'id' => '8181066',
		'user' => get_option('pix_content_geode_user_name'),
		'license' => get_option('pix_content_geode_license_key')
	);
	// Start checking for an update
	$send_for_check = array(
		'body' => array(
			'action' => 'theme_update', 
			'request' => serialize($args),
			'api-key' => md5(home_url())
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
	);
	$raw_response = wp_remote_post($geode_api_url, $send_for_check);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);

	// Feed the update data into WP updater
	if (!empty($response)) 
		$checked_data->response[$geode_theme_base] = $response;

	return $checked_data;
}
endif;

if ( ! function_exists( 'geode_api_call' ) ) :
/**
 * Update if update is available
 * @since Geode 1.0
 */
add_filter('themes_api', 'geode_api_call', 10, 3);
function geode_api_call($def, $action, $args) {
	global $geode_theme_base, $geode_theme_version, $geode_api_url;

	if ($args->slug != $geode_theme_base)
		return false;

	// Get the current version

	$args->version = $geode_theme_version;
	$request_string = prepare_request($action, $args);
	$request = wp_remote_post($geode_api_url, $request_string);

	if (is_wp_error($request)) {
		$res = new WP_Error('themes_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);

		if ($res === false)
			$res = new WP_Error('themes_api_failed', __('An unknown error occurred', 'geode'), $request['body']);
	}

	return $res;
}
endif;


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( ! function_exists( 'geode_check_for_testimonials_plugin_update' ) && is_plugin_active('indeed-my-testimonials/indeed-my-testimonials.php') ) :
/**
 * Check for testimonial plugin update available
 * @since Geode 1.0
 */
add_filter( 'pre_set_site_transient_update_plugins', 'geode_check_for_testimonials_plugin_update' );
function geode_check_for_testimonials_plugin_update($checked_data) {

	global $wp_version, $geode_api_url;

	if (empty($checked_data->checked))
		return $checked_data;

	$args = array(
		'dir' => sanitize_title( 'Indeed my testimonials' ),
		'slug' => 'indeed-my-testimonials',
		'version' => $checked_data->checked[ 'indeed-my-testimonials/indeed-my-testimonials.php' ],
		'id' => apply_filters('sc_addons_itemID',''),
		'user' => apply_filters('sc_addons_username',''),
		'license' => apply_filters('sc_addons_licensekey','')
	);

	$request_string = array(
			'body' => array(
				'action' => 'basic_check', 
				'request' => serialize($args),
				'api-key' => md5(home_url())
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
		);
	
	$raw_response = wp_remote_post($geode_api_url, $request_string);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);

	if (is_object($response) && !empty($response)) // Feed the update data into WP updater
		$checked_data->response[ 'indeed-my-testimonials/indeed-my-testimonials.php' ] = $response;
	
	return $checked_data;
}
endif;

if ( ! function_exists( 'geode_testimonials_plugin_api_call' ) && is_plugin_active('indeed-my-testimonials/indeed-my-testimonials.php') ) :
/**
 * Update testimonial plugin if possible
 * @since Geode 1.0
 */
add_filter( 'plugins_api', 'geode_testimonials_plugin_api_call', 10, 3);
function geode_testimonials_plugin_api_call($def, $action, $args) {

	global $wp_version, $geode_api_url;
			
	if (!isset($args->slug) || ($args->slug != 'indeed-my-testimonials'))
		return false;
	
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[ 'indeed-my-testimonials/indeed-my-testimonials.php' ];
	$args->version = $current_version;
	
	$request_string = array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(home_url())
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
		);
	
	$request = wp_remote_post($geode_api_url, $request_string);

	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);

		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred', 'geode'), $request['body']);
	}
	
	return $res;
}
endif;

if ( ! function_exists( 'geode_check_for_team_plugin_update' ) && is_plugin_active('indeed-my-team/indeed-my-team.php') ) :
/**
 * Check for testimonial plugin update available
 * @since Geode 1.0
 */
add_filter( 'pre_set_site_transient_update_plugins', 'geode_check_for_team_plugin_update' );
function geode_check_for_team_plugin_update($checked_data) {

	global $wp_version, $geode_api_url;

	if (empty($checked_data->checked))
		return $checked_data;
	
	$args = array(
		'dir' => sanitize_title( 'Indeed my team' ),
		'slug' => 'indeed-my-team',
		'version' => $checked_data->checked[ 'indeed-my-team/indeed-my-team.php' ],
		'id' => apply_filters('sc_addons_itemID',''),
		'user' => apply_filters('sc_addons_username',''),
		'license' => apply_filters('sc_addons_licensekey','')
	);

	$request_string = array(
			'body' => array(
				'action' => 'basic_check', 
				'request' => serialize($args),
				'api-key' => md5(home_url())
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
		);
	
	$raw_response = wp_remote_post($geode_api_url, $request_string);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);

	if (is_object($response) && !empty($response)) // Feed the update data into WP updater
		$checked_data->response[ 'indeed-my-team/indeed-my-team.php' ] = $response;
	
	return $checked_data;
}
endif;

if ( ! function_exists( 'geode_team_plugin_api_call' ) && is_plugin_active('indeed-my-team/indeed-my-team.php') ) :
/**
 * Update testimonial plugin if possible
 * @since Geode 1.0
 */
add_filter( 'plugins_api', 'geode_team_plugin_api_call', 10, 3);
function geode_team_plugin_api_call($def, $action, $args) {

	global $wp_version, $geode_api_url;
			
	if (!isset($args->slug) || ($args->slug != 'indeed-my-team'))
		return false;
	
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[ 'indeed-my-team/indeed-my-team.php' ];
	$args->version = $current_version;
	
	$request_string = array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(home_url())
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
		);
	
	$request = wp_remote_post($geode_api_url, $request_string);

	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);

		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred', 'geode'), $request['body']);
	}
	
	return $res;
}
endif;

if ( !class_exists('Geode_Walker') ) :
class Geode_Walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query, $megamenu, $column_width;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		
		$item_id = esc_attr( $item->ID );
		$a_class = get_post_meta( $item_id, '_pix_title_item', true);
		
		$fonts_include = get_template_directory() . '/functions/lib/admin/fonticon_generator.php';

		if ($depth==0) {
			
			if ( get_post_meta( $item_id, '_pix_megamenu_item', true ) == '1' ) {
			
				$classes[] = 'menu-item-' . $item->ID;
		
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names .= ' pix_megamenu';
				if ( get_post_meta( $item_id, '_pix_labeltext_item', true ) == true ) { $item->title = '&nbsp;'; $class_names .= ' no-text'; }
				if ( get_post_meta( $item_id, '_pix_icon_item', true )!='' ) $class_names .= ' with-icon'; 
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$output .= $indent . '<div role="listitem"' . $id . $value . $class_names .'>';
	
				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

				$item_output = $args->before;
				if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
					$item_output .= '<span></span><a'. $attributes .'><span>';
				else
					$item_output .= '<div class="pix-menu-no-link">';
				$item_icon = get_post_meta( $item_id, '_pix_icon_item', true )!='' ? ' class="'.get_post_meta( $item_id, '_pix_icon_item', true ).' pix_icon_menu"' : '';
				$item_output .= file_exists($fonts_include) && $item_icon!='' ? '<i'.$item_icon.'></i>' : '';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				/*if ( $item->description != '' ) {
					$item_output .= '<span class="pix_menu_desc">' . $item->description . '</span>';
				}*/
				//$item_output .= '<span>' . get_post_meta( $item_id, '_pix_column_item', true) . '</span>';
				if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
					$item_output .= '</span></a>';
				else
					$item_output .= '</div>';
				$item_output .= $args->after;
		
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
				$output .= $indent . '<div class="pixmenu-wrap-level"><div class="pixmenu-wrap-row">';
				$megamenu = 1;
				
			} else {
				
				$classes[] = 'menu-item-' . $item->ID;
		
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				if ( get_post_meta( $item_id, '_pix_labeltext_item', true ) == true ) { $item->title = ''; $class_names .= ' no-text'; }
				if ( get_post_meta( $item_id, '_pix_icon_item', true )!='' ) $class_names .= ' with-icon'; 
				$class_names = ' class="' . esc_attr( $class_names ) . '"';


				$output .= $indent . '<div role="listitem"' . $id . $value . $class_names .'>';
	
				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ! empty( $a_class )     	   ? ' class="'   . $a_class .'"' : '';
		
				$item_output = isset($args->before) ? $args->before : '';
				if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
					$item_output .= '<span></span><a'. $attributes .'><span>';
				else
					$item_output .= '<div class="pix-menu-no-link">';
				$item_icon = get_post_meta( $item_id, '_pix_icon_item', true )!='' ? ' class="'.get_post_meta( $item_id, '_pix_icon_item', true ).' pix_icon_menu"' : '';
				$item_output .= file_exists($fonts_include) && $item_icon!='' ? '<i'.$item_icon.'></i>' : '';
				$item_output .= isset($args->link_before) ? $args->link_before : '';
				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= isset($args->link_after) ? $args->link_after : '';
				/*if ( $item->description != '' ) {
					$item_output .= '<span class="pix_menu_desc">' . $item->description . '</span>';
				}*/
				//$item_output .= '<span>' . get_post_meta( $item_id, '_pix_column_item', true) . '</span>';
				if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
					$item_output .= '</span></a>';
				else
					$item_output .= '</div>';
				$item_output .= isset($args->after) ? $args->after : '';
		
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
				$megamenu = 0;
				
			}

		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'column' && $depth==1) {
			
			$column_width = get_post_meta( $item_id, '_pix_width_item', true );
			
			$output .= $indent . '<div role="list" class="alignleft">';
			
		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'row' && $depth==1) {
			
			$column_width = '';

			$output .= $indent . '</div><div class="mega_clear"><div></div></div><div class="pixmenu-wrap-row">';

		} else {
			
			if( $depth>1 && $megamenu == 1 ) {
				
				$output .= $indent . '<div role="listitem"' . $id . $value . ' class="pix_megamenu_'. $column_width .'_col">';
				
			} else {
				
				$output .= $indent . '<div role="listitem"' . $id . $value . $class_names .'>';
				
			}
	
				$item_output = $args->before;
				$item_output .= $args->after;
		
				if ( get_post_meta( $item_id, '_pix_labeltext_item', true ) == true ) { $item->title = ''; $class_names .= ' no-text'; }
				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ! empty( $a_class )     	   ? ' class="'   . $a_class .'"' : '';
		
				if(get_post_meta( $item_id, '_pix_sidebar_item', true) != ''){

					ob_start();
					dynamic_sidebar(strtolower(get_post_meta( $item_id, '_pix_sidebar_item', true)));
					$sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
					if ($sidebar) {
					    $item_output = $sidebar;
					}

				} else {

					$item_output = $args->before;
					if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
						$item_output .= '<span></span><a'. $attributes .'>';
					else
						$item_output .= '<div class="pix-menu-no-link '.$a_class.'">';

					if(get_post_meta( $item_id, '_pix_image_item', true) != ''){
						$item_output .= '<span class="pix_desc_image cf"><img src="'.get_post_meta( $item_id, '_pix_image_item', true).'" alt=""></span>';
					}

					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

					if ( $item->description != '' ) {
						if ( get_post_meta( $item_id, '_pix_labeltext_item', true ) != true)
							$item_output .= '<br>';
						$item_output .= '<small>' . $item->description . '</small>';
					}

					if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
						$item_output .= '</a>';
					else
						$item_output .= '</div>';
					$item_output .= $args->after;

				}
								
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
			

	}
	
	
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		global $wp_query, $megamenu;
		$item_id = esc_attr( $item->ID );
		
		if (get_post_meta( $item_id, '_pix_megamenu_item', true) == '1' && $depth==0) {
			
			$output .= "</div></div></div>";
			$megamenu = 0;

		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'column' && $depth==1) {
			
			$output .= "</div>";

		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'row' && $depth==1) {
			
			$output .= "";

		}  else {

			$output .= "</div>";
		
		}
	}


	function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $megamenu;
		if(($megamenu==1 && $depth==0) || ($megamenu==1 && $depth==1)){
			$output .= '';
		} else {
			$output .= "<div role='list' class='children'>";
		}
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		global $megamenu;
		if(($megamenu==1 && $depth==0) || ($megamenu==1 && $depth==1)){
			$output .= '';
		} else {
			$output .= "</div>";
		}
	}
}
endif;

/***************************************************/

if ( !class_exists('Geode_Walker_Mobile') ) :
class Geode_Walker_Mobile extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query, $megamenu, $column_width;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		
		$item_id = esc_attr( $item->ID );
		$a_class = get_post_meta( $item_id, '_pix_title_item', true);
		
		$fonts_include = get_template_directory() . '/functions/lib/admin/fonticon_generator.php';

		if ($depth==0) {
							
			$classes[] = 'menu-item-' . $item->ID;
	
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			if ( get_post_meta( $item_id, '_pix_labeltext_item', true ) == true ) { $item->title = ''; $class_names .= ' no-text'; }
			if ( get_post_meta( $item_id, '_pix_icon_item', true )!='' ) $class_names .= ' with-icon'; 
			$class_names = ' class="' . esc_attr( $class_names ) . '"';


			$output .= $indent . '<div role="listitem"' . $id . $value . $class_names .'>'."\n";

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$attributes .= ! empty( $a_class )     	   ? ' class="'   . $a_class .'"' : '';
	
			$item_output = isset($args->before) ? $args->before : '';
			if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
				$item_output .= '<span></span><a'. $attributes .'><span>'."\n";
			else
				$item_output .= '<div class="pix-menu-no-link">'."\n";
			$item_icon = get_post_meta( $item_id, '_pix_icon_item', true )!='' ? ' class="'.get_post_meta( $item_id, '_pix_icon_item', true ).' pix_icon_menu"' : '';
			$item_output .= file_exists($fonts_include) && $item_icon!='' ? '<i'.$item_icon.'></i>' : '';
			$item_output .= isset($args->link_before) ? $args->link_before : '';
			$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= isset($args->link_after) ? $args->link_after : '';
			/*if ( $item->description != '' ) {
				$item_output .= '<span class="pix_menu_desc">' . $item->description . '</span>';
			}*/
			//$item_output .= '<span>' . get_post_meta( $item_id, '_pix_column_item', true) . '</span>';
			if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
				$item_output .= '</span></a>'."\n";
			else
				$item_output .= '</div>'."\n";
			$item_output .= isset($args->after) ? $args->after : '';
	
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

			if ( get_post_meta( $item_id, '_pix_megamenu_item', true ) == '1' ) {

				$megamenu = 1;
				
			} else {

				$megamenu = 0;
				
			}

		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'column' && $depth==1) {
			
			$output .= '';
			
		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'row' && $depth==1) {
			
			$output .= '';

		} else {
			
			$output .= $indent . '<div role="listitem"' . $id . $value . $class_names .'>'."\n";
				
			$item_output = $args->before;
			$item_output .= $args->after;
	
			if ( get_post_meta( $item_id, '_pix_labeltext_item', true ) == true ) { $item->title = ''; $class_names .= ' no-text'; }
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$attributes .= ! empty( $a_class )     	   ? ' class="'   . $a_class .'"' : '';
	
			if(get_post_meta( $item_id, '_pix_sidebar_item', true) != ''){

				ob_start();
				dynamic_sidebar(strtolower(get_post_meta( $item_id, '_pix_sidebar_item', true)));
				$sidebar = ob_get_clean();  // get the contents of the buffer and turn it off.
				if ($sidebar) {
				    $item_output = $sidebar."\n";
				}

			} else {

				$item_output = $args->before;
				if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
					$item_output .= '<span></span><a'. $attributes .'>'."\n";
				else
					$item_output .= '<div class="pix-menu-no-link ' . $a_class . '">'."\n";

				if(get_post_meta( $item_id, '_pix_image_item', true) != ''){
					$item_output .= '<span class="pix_desc_image cf"><img src="'.get_post_meta( $item_id, '_pix_image_item', true).'" alt=""></span>'."\n";
				}

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after."\n";

				if ( $item->description != '' ) {
					if ( get_post_meta( $item_id, '_pix_labeltext_item', true ) != true)
						$item_output .= '<br>'."\n";
					$item_output .= '<small>' . $item->description . '</small>'."\n";
				}

				if ( get_post_meta( $item_id, '_pix_labellink_item', true ) != true )
					$item_output .= '</a>'."\n";
				else
					$item_output .= '</div>'."\n";
				$item_output .= $args->after."\n";

			}
							
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
			

	}
	
	
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		global $wp_query, $megamenu;
		$item_id = esc_attr( $item->ID );
		
		if (get_post_meta( $item_id, '_pix_megamenu_item', true) == '1' && $depth==0) {
			
			$megamenu = 0;

		}

		if (get_post_meta( $item_id, '_pix_column_item', true) == 'column' && $depth==1) {
			
			$output .= "";

		} elseif (get_post_meta( $item_id, '_pix_column_item', true) == 'row' && $depth==1) {
			
			$output .= "";

		}  else {

			$output .= "</div>"."\n";
		
		}
	}
 
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $megamenu;
		if(($megamenu==1 && $depth==0)){
			$output .= '';
		} else {
			$output .= "<div role='list' class='children'>"."\n";
		}
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		global $megamenu;
		if(($megamenu==1 && $depth==0)){
			$output .= '';
		} else {
			$output .= "</div>"."\n";
		}
	}
}
endif;

if ( ! function_exists( 'geode_set_portfolio_base' ) ) :
/**
 * Portfolio breadcumbr link
 * @since Geode 1.4.0
 */
add_filter( 'geode_portfolio_base', 'geode_set_portfolio_base');
function geode_set_portfolio_base($link) {

	if ( is_tax( 'portfolio_tag' ) || is_tax( 'portfolio_category' ) || is_singular('portfolio') ) {

		$post_type = get_post_type_object( get_post_type() );

		if ( get_option('pix_style_portfolio_page_base')!='' ) {
			$link = esc_url(get_permalink(get_option('pix_style_portfolio_page_base')));
		}

	}

	return $link;
	
}
endif;
if ( ! function_exists( 'geode_set_portfolio_base_name' ) ) :
/**
 * Portfolio breadcrumb title
 * @since Geode 1.4.0
 */
add_filter( 'geode_portfolio_base_name', 'geode_set_portfolio_base_name');
function geode_set_portfolio_base_name($title) {

	if ( is_tax( 'portfolio_tag' ) || is_tax( 'portfolio_category' ) || is_singular('portfolio') ) {

		if ( get_option('pix_style_portfolio_page_base')!='' ) {
			$title = get_the_title(get_option('pix_style_portfolio_page_base'));
		}

	}

	return $title;
	
}
endif;

if ( !function_exists('geode_remove_thumb')) :
/**
 * Hides thumbnails in some cases
 * @since Geode 1.5.0
 */
add_filter('geode_print_thumb', 'geode_remove_thumb');
function geode_remove_thumb($thumbnail){
	global $post;

	if (!$post)
		return;

	$hide = get_post_meta( $post->ID, 'pix_hide_featured_image', true );
	if ( is_single() && $hide=='on' )
		return '';
	else
		return $thumbnail;
}
endif;

if ( !function_exists('geode_custom_woo_ppp')) :
/**
 * Custom WC posts per page
 * @since Geode 1.5.4
 */
add_filter( 'loop_shop_per_page', 'geode_custom_woo_ppp', 20 );
function geode_custom_woo_ppp($cols){
	if ( get_option('pix_style_woo_ppp')!='' )
		return get_option('pix_style_woo_ppp');
}
endif;

if ( !function_exists('prepare_request')) :
/**
 * Custom WC posts per page
 * @since Geode 1.6.5
 */
function prepare_request( $action, $args ) {
	global $wp_version;
	
	return array(
		'body' => array(
			'action' => $action, 
			'request' => serialize($args),
			'api-key' => md5(home_url())
		),
		'user-agent' => 'WordPress/'. $wp_version .'; '. home_url()
	);	
}
endif;

add_filter( 'wp_get_attachment_image_attributes', 'geode_filter_gallery_img_atts', 10, 2 );
if ( !function_exists('geode_filter_gallery_img_atts')) :
/**
 * Custom WC posts per page
 * @since Geode 1.6.9.p
 */
function geode_filter_gallery_img_atts( $atts, $attachment ) {
    if ( isset($atts['srcset']) )
    	unset($atts['srcset']);

    return $atts;
}
endif;

add_action( 'loop_start', 'geode_fix_sharedaddy_footer' );
if ( ! function_exists( 'geode_fix_sharedaddy_footer' ) ) :
/**
 * Remove Sharedaddy from footer
 * @since Geode 1.7.4
 */
function geode_fix_sharedaddy_footer() {
	global $post;

	if ( !$post )
		return;

	$footer_id = get_option( 'pix_content_footer_page' );

	if ( $post->ID == $footer_id ) {
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
	}

}
endif; //geode_fix_sharedaddy_footer