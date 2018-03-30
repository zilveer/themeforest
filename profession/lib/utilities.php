<?php

// retrieves the attachment ID from the file URL
function get_image_id($image_url) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$attachment = $wpdb->get_col ( $wpdb->prepare ( "SELECT ID FROM " . $prefix . "posts" . " WHERE guid='" . $image_url . "';") );
	
	if(count($attachment))
		return $attachment[0];
	else
		return -1;
}

function theme_before_header() {
	// initialize hook
	do_action('theme_before_header');
}

//Return theme option
function opt($option, $default = ''){
	$opt = get_option(OPTIONS_KEY);
	
	if(!isset($opt[$option]))
		return $default;

	return stripslashes($opt[$option]);
}

//Echo theme option
function eopt($option, $default = ''){
	echo opt($option, $default);
}

//format attr
function format_attr($name, $val)
{
	return $name . '="'. $val . '" ';
}

//format standard attrs
function format_std_attrs(array $params) {
	$attrs =  '';
	$keys = array_keys($params);
	
	foreach ($keys as $key)
	{
		if($key != 'id' && $key != 'class' && 
		   $key != 'style' && $key != 'src' && 
		   $key != 'href' && $key != 'alt' && 
		   $key != 'type')
		   continue;

		$attrs .= format_attr($key, $params[$key]);
	}
	
	return $attrs;
}

//Returns a html image tag string
function img(array $params){

	if(!isset($params['file']))
		throw new Exception('file parameter is missing.');
	
	$params['src'] = THEME_IMAGES_URI . '/' . $params['file'];
	
	$tag = '<img ' . format_std_attrs($params) . '/>';
	
	echo $tag;
}

//Returns a html script tag string
function js(array $params){
	echo get_js($params);
}

function get_js(array $params){
	
	if(!isset($params['file']))
		throw new Exception('file parameter is missing.');
	
	$params['type'] = 'text/javascript';
	$params['src'] = THEME_JS_URI . '/' . $params['file'];
	
	return '<script ' . format_std_attrs($params) . '></script>';
}

//name of your function
function px_name_of_your_function($defaults) {
	$defaults['title_reply'] = __( 'Leave a reply', TEXTDOMAIN );
	return $defaults;
}
add_filter('comment_form_defaults', 'px_name_of_your_function');

//  Custom Login Logo 
function px_login_logo() {

	$login_logo = ( opt('wp_login_logo') ? opt('wp_login_logo') : THEME_ADMIN_URI . '/img/wp_login_logo.png' );
    echo '<style type="text/css"> h1 a { background: url(' . $login_logo . ') center no-repeat !important; width:302px !important; height:67px !important; } </style>';
}
add_action('login_head', 'px_login_logo');

// load comment scripts only on single pages
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}

// Register nav
function px_register_menu() {
	register_nav_menu( 'primary-nav', __( 'Primary Navigation', TEXTDOMAIN ) );
}
add_action( 'init', 'px_register_menu' );

//Returns Portfolio Post type 
function px_get_url_type( $url, $type = false ) {
	if ( preg_match( '/.(jpe?g|png|gif)$/', $url ) ) {
		$type = 'image';
	}
	elseif ( preg_match( '/youtube\.com\/watch\?v=[^&]+/', $url ) ) {
		$type = 'youtube';
	}
	elseif ( preg_match( '/vimeo\.com\/[0-9]+/i', $url ) ) {
		$type = 'vimeo';
	}
	elseif ( preg_match( '/.(webm|mp4|ogv)$/', $url ) ) {
		$type = 'video';
	}
	elseif ( preg_match( '/.(mp3)$/', $url ) ) {
		$type = 'audio';
	}
	else {
		$type = 'page';
	}
	return $type;
}


//   Filter on titles  //
function px_filter( $string ) {
	return mb_strtoupper( $string, 'UTF-8' );
}


//   Social Icon   //
function px_social_link($optKey, $text, $class)
{
	if(opt($optKey) != '')
	{?>
	<li class="<?php echo $class; ?>"><a target="_blank"  href="<?php eopt($optKey); ?>"></a></li>
<?php 
	}
}


//   Add blog Post detail Images  //
function px_blog_detail_slide($imageName) {
	$meta = get_post_meta(get_the_ID(), $imageName, true);
	if($meta == '') return false;
?>
    <li class="slide"><img src="<?php echo $meta; ?>" alt="<?php the_title(); ?>"></li>

	<?php
	
	return true;
}

// Portfolio Detail  Slider 
function px_portfolio_slide($imageName) {

	$meta = get_post_meta(get_the_ID(), $imageName, true);
	if( $meta == '') return false;
	?>
		<li><img src="<?php echo $meta; ?>" alt="<?php the_title(); ?>"></li>
	<?php
	
	return true;
}

//   Post Expert Function  //
function px_trim_excerpt( $text='' ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $excerpt_length = apply_filters('excerpt_length', 30);
    $excerpt_more = '<a class="moretag" href="'. get_permalink(get_the_ID()) . '">'.__( 'Read More...', TEXTDOMAIN ).'</a>';
    return wp_trim_words( $text, $excerpt_length, $excerpt_more );
}
add_filter('wp_trim_excerpt', 'px_trim_excerpt');

// Add specific CSS class by filter
function px_body_vertical($vertical_page) {
	// add 'class-name' to the $vertical_page array
	if ( opt('vertical_template') == 1 ) 
		$vertical_page[] = 'vertical-page';
	// return the $vertical_page array
	return $vertical_page;
}
add_filter('body_class','px_body_vertical');

// Register Required Plugins
include_once(THEME_LIB . '/tinymce/class-tgm-plugin-activation.php');
function px_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'LayerSlider', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=>  THEME_LIB . '/tinymce/plugins/LayerSlider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
        //Contact Form 7
        array(
            'name' 		=> 'Contact Form 7',
            'slug' 		=> 'contact-form-7',
            'required' 	=> false,
        ),
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'Red_Sky';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'px_register_required_plugins');



add_filter( 'manage_posts_columns', 'revealid_add_id_column', 5 );
add_action( 'manage_posts_custom_column', 'revealid_id_column_content', 5, 2 );


function revealid_add_id_column( $columns ) {
   $columns['revealid_id'] = 'ID';
   return $columns;
}

function revealid_id_column_content( $column, $id ) {
  if( 'revealid_id' == $column ) {
    echo $id;
  }
}