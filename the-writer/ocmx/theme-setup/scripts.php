<?php
function ocmx_add_scripts()
	{
		global $obox_themeid;

		//Add support for 2.9 and 3.0 functions and setup jQuery for theme
		wp_enqueue_script("jquery");
		if(!is_admin() && !(in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) ):

			// Include stylesheets
			wp_register_style( $obox_themeid.'-style', get_bloginfo( 'stylesheet_url' ) );
			wp_enqueue_style( $obox_themeid.'-style', get_bloginfo( 'stylesheet_url' ) );
			wp_enqueue_style( $obox_themeid.'-responsive', get_template_directory_uri().'/responsive.css');
			wp_enqueue_style( $obox_themeid.'-jplayer', get_template_directory_uri().'/ocmx/jplayer.css');
			wp_enqueue_style( $obox_themeid.'-customizer', home_url().'/?stylesheet=custom');


			// Font Inclusion
			wp_register_style( $obox_themeid.'-lato', 'http://fonts.googleapis.com/css?family=Lato:100,400,700,900|Gravitas+One');
			wp_enqueue_style( $obox_themeid.'-lato');

			if( is_home() || is_single() || is_archive() || is_404() || is_search() || ( is_page() && wp_basename( get_page_template() ) == 'blog.php' || wp_basename( get_page_template() ) == 'archives.php' ) ) :
				wp_enqueue_script( $obox_themeid."-wookmark", get_template_directory_uri()."/scripts/wookmark.js", array( "jquery" ) , '', true);
				wp_enqueue_script( $obox_themeid."-imagesloaded", get_template_directory_uri()."/scripts/imagesloaded.js", array( "jquery" ) , '', true);
			endif;

			wp_enqueue_script( $obox_themeid . "-menu", get_template_directory_uri()."/scripts/menu.js", array( "jquery" ) , '', true);
			wp_enqueue_script( $obox_themeid . "-resize", get_template_directory_uri()."/scripts/resize.js", array( "jquery" ) , '', true);
			wp_enqueue_script( $obox_themeid . "-nanoscroller", get_template_directory_uri()."/scripts/nanoscroller.js", array( "jquery" ) , '', true);
			wp_enqueue_script( $obox_themeid . "-jquery", get_template_directory_uri()."/scripts/theme.js", array( "jquery" ) , '', true);
			wp_enqueue_script( $obox_themeid . "-share", get_template_directory_uri()."/scripts/share.js", array( "jquery" ) , '', false);
			if(!is_home()){
				wp_enqueue_script( $obox_themeid . "-fitvid", get_template_directory_uri()."/scripts/fitvids.js", array( "jquery" ) , '', true);
			}

			if( is_home() || is_archive() || is_404() || is_search() || ( is_page() && wp_basename( get_page_template() ) == 'blog.php' || wp_basename( get_page_template() ) == 'archives.php' ) ) :
				wp_enqueue_script( $obox_themeid."-wookmark", get_template_directory_uri()."/scripts/wookmark.js", array( "jquery" ) , '', true);
				wp_enqueue_script( $obox_themeid."-imagesloaded", get_template_directory_uri()."/scripts/imagesloaded.js", array( "jquery" ) , '', true);
			endif;

			if ( is_singular() ) wp_enqueue_script( "comment-reply" );

			//Localization
			wp_localize_script( $obox_themeid."-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );

		else :
			/* Back-end */
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-tabs' );

			wp_enqueue_script( "ajaxupload", get_template_directory_uri()."/scripts/ajaxupload.js", array( "jquery" ) );
			wp_enqueue_script( "ocmx-jquery", get_template_directory_uri()."/scripts/ocmx.js", array( "jquery" ) );
			wp_localize_script( "ocmx-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );
			wp_enqueue_style( 'welcome-page', get_template_directory_uri() . '/ocmx/welcome-page.css');
		endif;

	}

add_action('wp_enqueue_scripts', 'ocmx_add_scripts');
add_action('admin_enqueue_scripts', 'ocmx_add_scripts');


function ocmx_ajax_functions(){
	//AJAX Functions
	add_action( 'wp_ajax_nopriv_ocmx_comment-post', 'ocmx_comment_post'  );
	add_action( 'wp_ajax_ocmx_comment-post', 'ocmx_comment_post' );

	add_action( 'wp_ajax_ocmx_save-options', 'update_ocmx_options');
	add_action( 'wp_ajax_ocmx_reset-options', 'reset_ocmx_options');
	add_action( 'wp_ajax_ocmx_ads-refresh', 'ocmx_ads_refresh' );
	add_action( 'wp_ajax_ocmx_ads-remove', 'ocmx_ads_remove' );
	add_action( 'wp_ajax_ocmx_layout-refresh', 'ocmx_layout_refresh' );
	add_action( 'wp_ajax_ocmx_ajax-upload', 'ocmx_ajax_upload' );
	add_action( 'wp_ajax_ocmx_remove-image', 'ocmx_ajax_remove_image' );
}
add_action('init', 'ocmx_ajax_functions');
