<?php
add_action('init', 'ci_register_theme_styles');
if( !function_exists('ci_register_theme_styles') ):
function ci_register_theme_styles()
{
	//
	// Register all front-end and admin styles here. 
	// There is no need to register them conditionally, as the enqueueing can be conditional.
	//
	wp_register_style( 'google-font-patua-one', '//fonts.googleapis.com/css?family=Patua+One' );
	wp_register_style( 'normalize', get_child_or_parent_file_uri( '/css/normalize.css' ) );
	wp_register_style( 'foundation', get_child_or_parent_file_uri( '/css/foundation.min.css' ) );
	wp_register_style( 'flexslider', get_child_or_parent_file_uri( '/css/flexslider.css' ) );
	wp_register_style( 'woocommerce_prettyPhoto_css', get_child_or_parent_file_uri( '/css/prettyPhoto.css' ) );
	wp_register_style( 'jquery-ui-style', get_child_or_parent_file_uri( '/css/jquery-ui.css' ), array(), '1.10.4' );
	wp_register_style( 'jquery-ui-timepicker', get_child_or_parent_file_uri( '/css/jquery-ui-timepicker-addon.css' ) );

	wp_register_style( 'ci-style', get_stylesheet_uri(), array(
		'google-font-patua-one',
		'normalize',
		'foundation',
		'woocommerce_prettyPhoto_css'
	), CI_THEME_VERSION, 'screen' );

	wp_register_style( 'ci-color-scheme', get_child_or_parent_file_uri( '/colors/' . ci_setting( 'stylesheet' ) ) );

	wp_register_style( 'ci-repeating-fields', get_child_or_parent_file_uri( '/css/repeating-fields.css' ) );
	wp_register_style( 'ci-post-edit-screens', get_child_or_parent_file_uri( '/css/post_edit_screens.css' ), array( 'ci-repeating-fields' ) );

}
endif;


add_action('wp_enqueue_scripts', 'ci_enqueue_theme_styles');
if( !function_exists('ci_enqueue_theme_styles') ):
function ci_enqueue_theme_styles()
{
	//
	// Enqueue all (or most) front-end styles here.
	//

	wp_enqueue_style('ci-style');
	
	wp_enqueue_style('flexslider');	
	wp_enqueue_style('ci-color-scheme');
	wp_enqueue_style('wp-mediaelement');

}
endif;


if( !function_exists('ci_enqueue_admin_theme_styles') ):
add_action('admin_enqueue_scripts','ci_enqueue_admin_theme_styles');
function ci_enqueue_admin_theme_styles() 
{
	global $pagenow, $typenow;

	//
	// Enqueue here styles that are to be loaded on all admin pages.
	//

	if(is_admin() and $pagenow=='themes.php' and isset($_GET['page']) and $_GET['page']=='ci_panel.php')
	{
		//
		// Enqueue here styles that are to be loaded only on CSSIgniter Settings panel.
		//

	}

}
endif;
?>