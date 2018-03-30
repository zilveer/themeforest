<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


# Base Functionality
function laborator_init()
{
	global $theme_version;
	
	$theme_obj     = wp_get_theme();
	$theme_version = $theme_obj->get( 'Version' );
	
	if ( is_child_theme() ) {
		$template_dir     = basename( get_template_directory() );
		$theme_obj        = wp_get_theme( $template_dir );
		$theme_version    = $theme_obj->get( 'Version' );
	}
	
	# Styles
	wp_register_style('admin-css', THEMEASSETS . 'css/admin/main.css', null, $theme_version);
	wp_register_style('bootstrap', THEMEASSETS . 'css/bootstrap.css', null, null);
	wp_register_style('bootstrap-rtl', THEMEASSETS . 'css/bootstrap-rtl.css', null, null);
	wp_register_style('aurum-main', THEMEASSETS . 'css/aurum.css', null, $theme_version);

	wp_register_style('animate-css', THEMEASSETS . 'css/animate.css', null, null);

	wp_register_style('icons-entypo', THEMEASSETS . 'css/fonts/entypo/css/entyporegular.css', null, null);
	wp_register_style('icons-fontawesome', THEMEASSETS . 'css/fonts/font-awesome/font-awesome.css', null, null);

	wp_register_style('style', get_template_directory_uri() . '/style.css', null, $theme_version);



	# Scripts
	wp_register_script('bootstrap', THEMEASSETS . 'js/bootstrap.min.js', null, null, true);
	wp_register_script('tweenmax', THEMEASSETS . 'js/TweenMax.min.js', null, null, true);
	wp_register_script('joinable', THEMEASSETS . 'js/min/joinable.min.js', null, $theme_version, true);
	wp_register_script('aurum-custom', THEMEASSETS . 'js/aurum-custom.js', null, $theme_version, true);
	wp_register_script('aurum-contact', THEMEASSETS . 'js/aurum-contact.js', null, $theme_version, true);



	# Nivo Lightbox
	wp_register_script('nivo-lightbox', THEMEASSETS . 'js/nivo-lightbox/nivo-lightbox.min.js', null, null, true);
	wp_register_style('nivo-lightbox', THEMEASSETS . 'js/nivo-lightbox/nivo-lightbox.css', null, null);
	wp_register_style('nivo-lightbox-default', THEMEASSETS . 'js/nivo-lightbox/themes/default/default.css', array('nivo-lightbox'), null);

	# Owl Carousel
	if(is_rtl())
	{
		wp_register_script('owl-carousel', THEMEASSETS . 'js/owl-carousel/rtl/owl.carousel.js', null, null, true);
		wp_register_style('owl-carousel', THEMEASSETS . 'js/owl-carousel/rtl/owl.carousel.css', null, null);
	}
	else
	{
		wp_register_script('owl-carousel', THEMEASSETS . 'js/owl-carousel/owl.carousel.min.js', null, null, true);
		wp_register_style('owl-carousel', THEMEASSETS . 'js/owl-carousel/owl.carousel.css', null, null);
	}



	# Owl Carousel 2
	wp_register_script('owl-carousel-2', THEMEASSETS . 'js/owl-carousel-2/owl.carousel.min.js', null, null, true);
	wp_register_style('owl-carousel-2', THEMEASSETS . 'js/owl-carousel-2/assets/owl.carousel.css', null, null);

	# Bootstrap Select
	#wp_register_script('bootstrap-select', THEMEASSETS . 'js/min/bootstrap-select.min.js', null, null, true);

	# Cycle 2
	wp_register_script('cycle-2', THEMEASSETS . 'js/jquery.cycle2.min.js', null, null, true);
	
	# Isotope
	wp_register_script('isotope', THEMEASSETS . 'js/isotope.pkgd.min.js', null, null, true);

	# Google Maps
	$google_api_key = aurum_get_google_api();
	wp_register_script( 'google-maps', '//maps.googleapis.com/maps/api/js?key=' . $google_api_key, null, null, true );

	
	// Google API Key for ACF
	add_filter( 'acf/fields/google_map/api', 'aurum_google_api_key_acf', 10 );

}

// Get Google API Key
function aurum_get_google_api() {
	return apply_filters( 'aurum_google_api_key', get_data( 'google_maps_api' ) );
}

// Get Google API Key Array for ACF
function aurum_google_api_key_acf() {
	$api = array(
		'libraries'   => 'places',
		'key'         => aurum_get_google_api(),
	);

	return $api;
}


# Enqueue Scritps and other stuff
function laborator_wp_enqueue_scripts()
{
	# Styles
	$rtl_include = '';

	wp_enqueue_style(array('icons-entypo', 'icons-fontawesome', 'bootstrap', 'aurum-main', 'style'));


	if(is_rtl())
	{
		wp_enqueue_style(array('bootstrap-rtl'));
	}

	# Custom Skin
	if(get_data('use_custom_skin'))
	{
		wp_enqueue_style('custom-skin', site_url('?custom-skin'), null, null);
	}


	# Scripts
	wp_enqueue_script(array('jquery', 'bootstrap', 'tweenmax', 'joinable'));
}


# Print scripts in the header
function laborator_wp_print_scripts()
{
?>
<script type="text/javascript">
var ajaxurl = ajaxurl || '<?php echo esc_attr( admin_url("admin-ajax.php") ); ?>';
<?php if ( defined( 'ICL_LANGUAGE_CODE' ) ) : ?>
var lang = <?php echo json_encode( ICL_LANGUAGE_CODE ); ?>;
<?php endif; ?>
</script>
<?php
}


# After Setup Theme
function laborator_after_setup_theme()
{
	# Theme Support
	add_theme_support('menus');
	add_theme_support('widgets');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_theme_support('featured-image');
	add_theme_support('woocommerce');


	# Theme Textdomain
	load_theme_textdomain(TD, get_template_directory() . '/languages');


	# Custom Post Types

		# Testimonials Post type
		register_post_type( 'testimonial',
			array(
				'labels' => array(
					'name'          => __( 'Testimonials', 'aurum'),
					'singular_name' => __( 'Testimonial', 'aurum')
				),
				'public' => true,
				'has_archive' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
				'menu_icon' => 'dashicons-testimonial'
			)
		);


	# Register Menus
	register_nav_menus(
		array(
			'main-menu'      => 'Main Menu',
			'secondary-menu' => 'Secondary Menu',
			'mobile-menu'    => 'Mobile Menu',
		)
	);


	# Gallery Boxes
	new GalleryBox('post_slider_images', array('title' => 'Post Slider Images', 'post_types' => array('post')));
}



# Laborator Menu Page
function laborator_menu_page()
{
	add_menu_page('Laborator', 'Laborator', 'edit_theme_options', 'laborator_options', 'laborator_main_page');

	if(lab_get('page') == 'laborator_options')
	{
		wp_redirect( admin_url('themes.php?page=theme-options') );
	}
}


# Redirect to Theme Options
function laborator_options()
{
	wp_redirect( admin_url('themes.php?page=theme-options') );
}


# Documentation Page iFrame
function laborator_menu_documentation()
{
	add_submenu_page('laborator_options', 'Documentation', 'Help', 'edit_theme_options', 'laborator_docs', 'laborator_documentation_page');
}

function laborator_documentation_page()
{
	add_thickbox();
?>
<div class="wrap">
	<h2>Documentation</h2>

	<p>You can read full theme documentation by clicking the button below:</p>

	<p>
		<a href="//documentation.laborator.co/item/aurum/?theme-inline=true" class="button button-primary" id="lab_read_docs">Read Documentation</a>
	</p>


	<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#lab_read_docs").click(function(ev)
		{
			ev.preventDefault();

			var href = $(this).attr('href');

			tb_show('Theme Documentation' , href + '?TB_iframe=1&width=1280&height=650');
		});
	});
	</script>

	<style>
		.lab-faq-links {

		}

		.lab-faq-links li {
			margin-top: 18px;
			background: #FFF;
			border: 1px solid #E0E0E0;
			padding: 0;
		}
		
		.lab-faq-links li > strong {
			display: block;
			padding: 10px 15px;
			background: rgba(238,238,238,0.6);
		}
	
		.lab-faq-links li:target {
			-webkit-animation: blink 1s 3;
			-moz-animation: blink 1s 3;
			-o-animation: blink 1s 3;
			animation: blink 1s 3;
		}

		.lab-faq-links li pre {
			font-size: 13px;
			max-width: 100%;
			word-break: break-word;
			padding: 10px 15px;
			padding-top: 5px;
		}

		.lab-faq-links .warn {
			display: block;
			font-family: Arial, Helvetica, sans-serif;
			border: 1px solid #999;
			padding: 10px;
			font-size: 12px;
			text-transform: uppercase;
		}		
		
		@-webkit-keyframes blink {
		    0% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 0);
		    }
		
		    50% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 1);
		    }
		    
		    100% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 0);
		    }
		}
		
		@keyframes blink {
		    0% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 0);
		    }
		
		    50% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 1);
		    }
		    
		    100% {
				box-shadow: 0px 0px 0px 10px rgba(255, 255, 0, 0);
		    }
		}
	</style>

	<br />
	<h3>Frequently Asked Questions</h3>
	<hr />

	<ul class="lab-faq-links">
		<li id="update-theme">

			<strong>How do I update the theme?</strong>

			<pre>1. Go to Envato Toolkit link in the menu (firstly activate it <a href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>">here</a> if you haven't already).

2. There you type your username i.e. <strong>EnvatoUsername</strong> and your <strong>Secret API Key</strong> that can be found on &quot;My Settings&quot; page on ThemeForest,
   example: <a href="http://drops.laborator.co/1cTZb" target="_blank">http://drops.laborator.co/1cTZb</a>.

3. To check for theme updates click on <strong>Envato Toolkit</strong> and choose Themes tab. 
   View this screenshot to see when the new update is available: <a href="http://drops.laborator.co/141DA" target="_blank">http://drops.laborator.co/141DA</a>.</pre>
		</li>

		<li id="update-visual-composer">

			<strong>How to update premium plugins that are bundled with the theme?</strong>

			<pre>Each time new theme update is available, we will include latest versions of premium plugins that are bundled with the theme.

To have latest version of premium plugins you need also to have the latest version of Aurum theme as well.

When new update is available for any of theme bundled plugins you will receive a notification that tells you need to update a specific plugin/s. 
Click this link <a href="http://drops.laborator.co/12DUv" target="_blank">http://drops.laborator.co/12DUv</a> to see how this notification popup looks like.

Then click <strong>Update</strong> for each plugin separately or check them all and choose Update from the dropdown and click apply. 
This screenshot <a href="http://drops.laborator.co/17J6H" target="_blank">http://drops.laborator.co/17J6H</a> will describe how to update plugins.

It may happen sometimes that after you update any plugin, <strong>Activate</strong> link to appear below that plugin, just ignore it because it is already activated.

<strong class="warn">Important Note: You don't have to buy these plugins, they are bundled with the theme</strong></pre>
		</li>

		<li id="regenerate-thumbnails">

			<strong>Regenerate Thumbnails</strong>

			<pre>If your thumbnails are not correctly cropped, you can regenerate them by following these steps:

1. Go to Plugins > Add New

2. Search for "<strong>Regenerate Thumbnails</strong>" (created by <strong>Viper007Bond</strong>)

3. Install and activate that plugin.

4. Go to Tools > Regen. Thumbnails

5. Click "Regenerate All Thumbnails" button and let the process to finish till it reaches 100 percent.</pre>
		</li>

		<li id="flush-rewrite-rules">

			<strong>Flush Rewrite Rules</strong>

			<pre>If it happens to get <strong>404 Page not found</strong> error on some pages/posts that already exist, then you need to flush rewrite rules in order to fix this issue (this works in most cases).

To do apply <strong>rewrite rules flush</strong> follow these steps:

1. Go to <a href="<?php echo admin_url( 'options-permalink.php' ); ?>" target="_blank">Settings &gt; Permalinks</a>

2. Click "Save Changes" button.

That's all, check those pages to see if its fixed.</pre>
		</li>
	</ul>
</div>
<?php
}


# Admin Enqueue
function laborator_admin_enqueue_scripts()
{
	wp_enqueue_style('admin-css');
}



# Admin Print Styles
function laborator_admin_print_styles()
{
?>
<style>

#toplevel_page_laborator_options .wp-menu-image {
	background: url(<?php echo get_template_directory_uri(); ?>/assets/images/laborator-icon.png) no-repeat 11px 8px !important;
	background-size: 16px !important;
}

#toplevel_page_laborator_options .wp-menu-image:before {
	display: none;
}

#toplevel_page_laborator_options .wp-menu-image img {
	display: none;
}

#toplevel_page_laborator_options:hover .wp-menu-image, #toplevel_page_laborator_options.wp-has-current-submenu .wp-menu-image {
	background-position: 11px -24px !important;
}

</style>
<?php
}



function laborator_wp_head()
{
	laborator_load_font_style();
?>

	<!--[if lt IE 9]>
	<script src="<?php echo THEMEASSETS; ?>js/ie8-responsive-file-warning.js"></script>
	<![endif]-->

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

<?php
}


function laborator_wp_footer()
{
	# Custom.js
	wp_enqueue_script('aurum-custom');

	# Tracking Code
	echo get_data('google_analytics');

	# Page Generation Speed
	#echo '<!-- Generated in ' . (microtime(true) - STIME) . ' seconds -->';
}



# Fav Icon
function laborator_favicon()
{
	$favicon_image = get_data('favicon_image');
	$apple_touch_icon = get_data('apple_touch_icon');

	if($favicon_image || $apple_touch_icon)
	{
		$favicon_image = str_replace( array( 'http:', 'https:' ), '', $favicon_image );
		$apple_touch_icon = str_replace( array( 'http:', 'https:' ), '', $apple_touch_icon );
	?>
	<!-- Favicons -->
	<?php if($favicon_image): ?>
	<link rel="shortcut icon" href="<?php echo $favicon_image; ?>">
	<?php endif; ?>
	<?php if($apple_touch_icon): ?>
	<link rel="apple-touch-icon-precomposed" href="<?php echo $apple_touch_icon; ?>">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $apple_touch_icon; ?>">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $apple_touch_icon; ?>">
	<?php endif; ?>
	<?php
	}
}



# Widgets Init
function laborator_widgets_init()
{
	# Blog Sidebar
	$blog_sidebar = array(
		'id' => 'blog_sidebar',
		'name' => 'Blog Widgets',

		'before_widget' => '<div class="sidebar-entry %2$s %1$s">',
		'after_widget' => '</div>',

		'before_title' => '<h3 class="sidebar-entry-title">',
		'after_title' => '</h3>'
	);

	register_sidebar($blog_sidebar);


	# Footer Sidebar
	$footer_sidebar_column = 'col-md-2 col-sm-4';

	switch(get_data('footer_widgets_columns'))
	{
		case "two":
			$footer_sidebar_column = 'col-sm-6';
			break;

		case "three":
			$footer_sidebar_column = 'col-sm-4';
			break;

		case "four":
			$footer_sidebar_column = 'col-sm-3';
			break;
	}

	$footer_sidebar = array(
		'id' => 'footer_sidebar',
		'name' => 'Footer Widgets',

		'before_widget' =>
			'<div class="'.$footer_sidebar_column.'">'
				. '<div class="sidebar %2$s %1$s">',

		'after_widget' =>
			'</div>' .
		'</div>',

		'before_title' => '<h3>',
		'after_title' => '</h3>'
	);

	register_sidebar($footer_sidebar);


	# Shop Footer Sidebar
	$shop_footer_sidebar_column = 'col-md-2 col-sm-4';

	switch(get_data('shop_sidebar_footer_columns'))
	{
		case 2:
			$shop_footer_sidebar_column = 'col-sm-6';
			break;

		case 3:
			$shop_footer_sidebar_column = 'col-sm-4';
			break;

		case 4:
			$shop_footer_sidebar_column = 'col-md-3 col-sm-6';
			break;
	}

	$shop_footer_sidebar = array(
		'id' => 'shop_footer_sidebar',
		'name' => 'Shop Footer Widgets',

		'before_widget' =>
			'<div class="'.$shop_footer_sidebar_column.'">'
				. '<div class="sidebar-entry %2$s %1$s">',

		'after_widget' =>
			'</div>' .
		'</div>',

		'before_title' => '<h3 class="sidebar-entry-title">',
		'after_title' => '</h3>'
	);

	register_sidebar($shop_footer_sidebar);


	# Shop Sidebar
	$shop_sidebar = array(
		'id' => 'shop_sidebar',
		'name' => 'Shop Widgets',

		'before_widget' => '<div class="sidebar-entry %2$s %1$s">',
		'after_widget' => '</div>',

		'before_title' => '<h3 class="sidebar-entry-title">',
		'after_title' => '</h3>'
	);

	register_sidebar($shop_sidebar);


	# Shop Single Sidebar
	$shop_single_sidebar = array(
		'id' => 'shop_single_sidebar',
		'name' => 'Shop Single Widgets',
		'description' => 'The Widgets you put here will be shown only when viewing single product page. If there are no widgets in here, "Shop Widgets" will be shown instead.',

		'before_widget' => '<div class="sidebar-entry %2$s %1$s">',
		'after_widget' => '</div>',

		'before_title' => '<h3 class="sidebar-entry-title">',
		'after_title' => '</h3>'
	);

	register_sidebar($shop_single_sidebar);
}




# Contact Form
add_action('wp_ajax_lab_req_contact_token', 'lab_req_contact_token');
add_action('wp_ajax_nopriv_lab_req_contact_token', 'lab_req_contact_token');

add_action('wp_ajax_lab_contact_form', 'lab_contact_form');
add_action('wp_ajax_nopriv_lab_contact_form', 'lab_contact_form');

function lab_req_contact_token()
{
	$name      = post('name');
	$subject   = post('subject');
	$email     = post('email');
	$message   = post('message');

	$hash = md5($name . $email . $message);

	$nonce = wp_create_nonce('cf_' . $hash);

	die("{$hash}_{$nonce}");
}

function lab_contact_form()
{
	$resp = array('errors' => true);

	$id        = post('id');

	$name      = post('name');
	$subject   = post('subject');
	$email     = post('email');
	$message   = post('message');

	$hash      = '';
	$nonce = '';

	foreach($_POST as $key => $val)
	{
		if(strlen($key) == 32)
		{
			$hash = "cf_{$key}";
			$nonce = $val;
		}
	}

	if(wp_verify_nonce($nonce, $hash) || defined( 'LAB_NO_CONTACT_TOKEN' ))
	{
		$admin_email = get_option('admin_email');
		$ip = $_SERVER['REMOTE_ADDR'];

		if($id)
		{
			$custom_receiver = get_post_meta($id, 'email_notifications', true);

			if(is_email($custom_receiver))
				$admin_email = $custom_receiver;
		}

		$email_subject = "[" . get_bloginfo("name") . "] ";
		$email_subject .= __( 'New contact form message submitted.', 'aurum' );
		
		$email_message = __( 'New message has been submitted on your website contact form. IP Address:', 'aurum' );
		
		$email_message .= " {$ip}\n\n=====\n\n";

		$fields = array( 'name', 'email', 'subject', 'message' );
		
		__( 'Name', 'aurum' );
		__( 'Email', 'aurum' );
		__( 'Subject', 'aurum' );
		__( 'Message', 'aurum' );

		foreach($fields as $key)
		{
			$val = post($key);

			$field_label = isset($field_names[$key]) ? $field_names[$key] : ucfirst($key);

			$email_message .= "{$field_label}:\n" . ($val ? $val : '/') . "\n\n";
		}

		$email_message .= "=====\n\n";
		
		$email_message .= __( 'This email has been automatically sent from Contact Form.', 'aurum' );

		$headers = array();

		if($email)
		{
			$headers[] = "Reply-To: {$name} <{$email}>";
		}

		wp_mail($admin_email, $email_subject, $email_message, $headers);

		$resp['errors'] = false;
	}

	echo json_encode($resp);

	die();
}



# VC Theme Setup
add_action('vc_before_init', 'laborator_vc_set_as_theme');

function laborator_vc_set_as_theme()
{
	require THEMEDIR . 'inc/lib/visual-composer/config.php';

	vc_set_default_editor_post_types( array( 'page' ) );
	vc_set_as_theme( true );
}


# Visual Composer Mapping
add_action('vc_before_mapping', 'laborator_vc_mapping');

function laborator_vc_mapping()
{
	#$dir = THEMEDIR . '/vc-shortcodes/';
	#vc_set_shortcodes_templates_dir($dir);

	include_once THEMEDIR . 'inc/lib/visual-composer/map.php';
}




# Third party plugins
add_action('tgmpa_register', 'aurum_plugins');

function aurum_plugins()
{
	$plugins = array(

		array(
			'name'               => 'Visual Composer',
			'slug'               => 'js_composer',
			'source'             => get_template_directory() . '/inc/thirdparty-plugins/js_composer.zip',
			'required'           => false,
			'version'            => '4.12.1',
		),

		array(
			'name'               => 'Layer Slider',
			'slug'               => 'LayerSlider',
			'source'             => get_template_directory() . '/inc/thirdparty-plugins/layersliderwp-5.6.10.installable.zip',
			'required'           => false,
			'version'            => '5.6.10',
		),

		array(
			'name'               => 'Envato Market (Theme Updater)',
			'slug'               => 'envato-market',
			'source'    		 => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required'           => false
		),

		array(
			'name'               => 'Advanced Custom Fields',
			'slug'               => 'advanced-custom-fields',
			'required'           => false,
		),

		array(
			'name'               => 'ACF - Field Type: Repeater',
			'slug'               => 'acf-repeater',
			'source'             => get_template_directory() . '/inc/thirdparty-plugins/acf-repeater.zip',
			'required'           => false,
		),

		array(
			'name'               => 'WooCommerce',
			'slug'               => 'woocommerce',
			'required'           => false,
		),

	);

	$config = array(
		'default_path'    => '',
		'menu'            => 'tgmpa-install-plugins',
		'has_notices'     => true,
		'dismissable'     => true,
		'dismiss_msg'     => '',
		'is_automatic'    => false,
		'message'         => '',
	);

	tgmpa( $plugins, $config );
}



# Remove greensock from LayerSlider because it causes theme incompatibility issues
add_action('wp_enqueue_scripts', 'layerslider_remove_greensock');

function layerslider_remove_greensock()
{
	wp_dequeue_script('greensock');
}



# Remove VC Elements
function lab_vc_remove_woocommerce()
{
	$active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
	
    if(in_array('woocommerce/woocommerce.php', $active_plugins))
    {
	    vc_remove_element('recent_products');
	    vc_remove_element('featured_products');
	    vc_remove_element('products');
	    vc_remove_element('sale_products');
	    vc_remove_element('best_selling_products');
	    vc_remove_element('top_rated_products');
    }
}

add_action('vc_build_admin_page', 'lab_vc_remove_woocommerce', 11);
add_action('vc_load_shortcode', 'lab_vc_remove_woocommerce', 11);


# Custom Skin
if(isset($_GET['custom-skin']))
{
	header("Content-type: text/css; charset: UTF-8");
	echo get_option('aurum_skin_custom_css');
	exit;
}


# Theme Options Link in Admin Bar
add_action('admin_bar_menu', 'modify_admin_bar', 10000);
add_action('admin_print_styles', 'mab_admin_print_styles');
add_action('wp_print_styles', 'mab_admin_print_styles');

function modify_admin_bar($wp_admin_bar)
{
	list( $plugin_updates, $updates_notification ) = aurum_get_plugin_updates_requires();

	$icon = '<i class="wp-menu-image dashicons-before dashicons-admin-generic laborator-admin-bar-menu"></i>';
	
	$wp_admin_bar->add_menu(array(
		'id'      => 'laborator-options',
		'title'   => $icon . wp_get_theme(),
		'href'    => is_admin() ? home_url() : admin_url('themes.php?page=theme-options'),
		'meta'	  => array('target' => is_admin() ? '_blank' : '_self')
	));
	
	$wp_admin_bar->add_menu(array(
		'parent'  => 'laborator-options',
		'id'      => 'laborator-options-sub',
		'title'   => 'Theme Options',
		'href'    => admin_url('themes.php?page=theme-options')
	));
		
	if ( $plugin_updates > 0 ) {
		$wp_admin_bar->add_menu( array( 
			'parent'  => 'laborator-options',
			'id'      => 'install-plugins',
			'title'   => 'Update Plugins' . $updates_notification,
			'href'    => admin_url( 'themes.php?page=tgmpa-install-plugins' )
		) );
	}
	
	$wp_admin_bar->add_menu(array(
		'parent'  => 'laborator-options',
		'id'      => 'laborator-custom-css',
		'title'   => 'Custom CSS',
		'href'    => admin_url('admin.php?page=laborator_custom_css')
	));
	
	$wp_admin_bar->add_menu(array(
		'parent'  => 'laborator-options',
		'id'      => 'laborator-demo-content-importer',
		'title'   => 'Demo Content',
		'href'    => admin_url('admin.php?page=laborator_demo_content_installer')
	));
	
	$wp_admin_bar->add_menu(array(
		'parent'  => 'laborator-options',
		'id'      => 'laborator-help',
		'title'   => 'Theme Help',
		'href'    => admin_url('admin.php?page=laborator_docs')
	));
	
	$wp_admin_bar->add_menu(array(
		'parent'  => 'laborator-options',
		'id'      => 'laborator-themes',
		'title'   => 'Browse Our Themes',
		'href'    => 'http://themeforest.net/user/Laborator/portfolio?ref=Laborator',
		'meta'	  => array('target' => '_blank')
	));
}



function aurum_get_plugin_updates_requires() {
	global $tgmpa;
	
	// Plugin Updates Notification
	$plugin_updates = 0;
	$updates_notification = '';
	
	if ( $tgmpa instanceof TGM_Plugin_Activation && ! $tgmpa->is_tgmpa_complete() ) {
		// Plugins
		$plugins = $tgmpa->plugins;
		
		foreach ( $tgmpa->plugins as $slug => $plugin ) {
			if ( $tgmpa->is_plugin_active( $slug ) && true == $tgmpa->does_plugin_have_update( $slug ) ) {
				$plugin_updates++;
			}
		}
	}
	
	if ( $plugin_updates > 0 ) {
		$updates_notification = " <span class=\"lab-update-badge\">{$plugin_updates}</span>";
	}
	
	return array( $plugin_updates, $updates_notification );
}



// Plugin Updates Admin Menu Link
function laborator_menu_page_plugin_updates() {
	
	// Updates Notification
	list( $plugin_updates, $updates_notification ) = aurum_get_plugin_updates_requires();
	
	if ( $plugin_updates > 0 ) {
		add_submenu_page( 'laborator_options', 'Update Plugins', 'Update Plugins' . $updates_notification, 'edit_theme_options', 'tgmpa-install-plugins', 'laborator_null_function' ); 
	}
}

add_action( 'admin_menu', 'laborator_menu_page_plugin_updates' );

function mab_admin_print_styles()
{
?>
<style>
	
.laborator-admin-bar-menu {
	position: relative !important;
	display: inline-block;
	width: 16px !important;
	height: 16px !important;
	background: url(<?php echo get_template_directory_uri(); ?>/assets/images/laborator-icon.png) no-repeat 0px 0px !important;
	background-size: 16px !important;
	margin-right: 8px !important;
	top: 3px !important;
}

#wp-admin-bar-laborator-options:hover .laborator-admin-bar-menu {
	background-position: 0 -32px !important;
}

.laborator-admin-bar-menu:before {
	display: none !important;
}

#toplevel_page_laborator_options .wp-menu-image {
	background: url(<?php echo get_template_directory_uri(); ?>/assets/images/laborator-icon.png) no-repeat 11px 8px !important;
	background-size: 16px !important;
}

#toplevel_page_laborator_options .wp-menu-image:before {
	display: none;
}

#toplevel_page_laborator_options .wp-menu-image img {
	display: none;
}

#toplevel_page_laborator_options:hover .wp-menu-image, #toplevel_page_laborator_options.wp-has-current-submenu .wp-menu-image {
	background-position: 11px -24px !important;
}

</style>
<?php
}



// Page Custom CSS
add_action( 'template_redirect', 'laborator_custom_page_css_wp' );
add_action( 'get_footer', 'laborator_custom_page_css' );

function laborator_custom_page_css_wp() {
	if ( is_singular() ) {
		$page_custom_css = get_field( 'page_custom_css' );
		
		if ( trim( $page_custom_css ) ) {
			$post_id = get_the_id();
			$page_custom_css = str_replace( '.post-ID', ".page-id-{$post_id}", $page_custom_css );
			
			define( "PAGE_CUSTOM_CSS", $page_custom_css );
		}
	}
}

function laborator_custom_page_css() {
	if ( is_singular() && defined( "PAGE_CUSTOM_CSS" ) ) {
		echo '<style>' . PAGE_CUSTOM_CSS . '</style>';
	}
}


// Open Graph Meta
function aurum_wp_head_open_graph_meta() {
	global $post;
	
	// Only show if open graph meta is allowed
	if ( ! apply_filters( 'aurum_open_graph_meta', true ) ) {
		return;
	}
	
	// Do not show open graph meta on single posts
	if ( ! is_singular() ) {
		return;
	}

	$featured_image = $post_thumb_id = '';
	
	if ( has_post_thumbnail( $post->ID ) ) {
		$post_thumb_id = get_post_thumbnail_id( $post->ID );
		$featured_image = wp_get_attachment_image_src( $post_thumb_id, 'original' );
	}
	
	// Excerpt, clean styles
	$excerpt = aurum_clean_excerpt( get_the_excerpt(), true );

	?>

	<meta property="og:type" content="article"/>
	<meta property="og:title" content="<?php echo esc_attr( get_the_title() ); ?>"/>
	<meta property="og:url" content="<?php echo esc_url( get_permalink() ); ?>"/>
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
	<meta property="og:description" content="<?php echo esc_attr( $excerpt ); ?>"/>

	<?php if ( is_array( $featured_image ) ) : ?>
	<meta property="og:image" content="<?php echo $featured_image[0]; ?>"/>
	<link itemprop="image" href="<?php echo $featured_image[0]; ?>" />
	
		<?php if ( apply_filters( 'aurum_meta_google_thumbnail', true ) ) : $thumb = wp_get_attachment_image_src( $post_thumb_id, 'thumbnail' ); ?>
		<!--
		  <PageMap>
		    <DataObject type="thumbnail">
		      <Attribute name="src" value="<?php echo $thumb[0]; ?>"/>
		      <Attribute name="width" value="<?php echo $thumb[1]; ?>"/>
		      <Attribute name="height" value="<?php echo $thumb[2]; ?>"/>
		    </DataObject>
		  </PageMap>
		-->
		<?php endif; ?>
	
	<?php endif;
}

add_action( 'wp_head', 'aurum_wp_head_open_graph_meta', 5 );