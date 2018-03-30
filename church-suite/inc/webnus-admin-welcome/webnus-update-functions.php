<?php

// convert nhp media value to array
add_action( 'after_setup_theme', 'convert_nhp_to_redux', 0 );
function convert_nhp_to_redux() {
	if ( get_option( 'convert_nhp_to_redux' ) == 'done' ) :
		return;
	endif;

	$thm_options		= get_option( 'webnus_options' );
	$meida_options_list	= array(
		'webnus_logo',
		'webnus_transparent_logo',
		'webnus_header_background',
		'webnus_sticky_logo',
		'webnus_favicon',
		'webnus_apple_iphone_icon',
		'webnus_apple_ipad_icon',
		'webnus_admin_login_logo',
		'webnus_footer_logo',
		'webnus_no_image_src',
		'webnus_custom_font1_woff',
		'webnus_custom_font1_ttf',
		'webnus_custom_font1_eot',
		'webnus_custom_font2_woff',
		'webnus_custom_font2_ttf',
		'webnus_custom_font2_eot',
		'webnus_custom_font3_woff',
		'webnus_custom_font3_ttf',
		'webnus_custom_font3_eot',
	);

	foreach ( $meida_options_list as $media_option ) :
		if ( isset( $thm_options[$media_option] ) && !empty( $thm_options[$media_option] ) && !is_array( $thm_options[$media_option] ) ) :
			$thm_options[$media_option] = array( 'url' => $thm_options[$media_option] );
			update_option( 'webnus_options', $thm_options );
		endif;
	endforeach;

	add_option( 'convert_nhp_to_redux', 'done' );
}


// prevent blog and latest from blog fatal error
add_action( 'wp_head', 'redirect_frontend_user_to_admin_panel' );

function redirect_frontend_user_to_admin_panel() {

	if ( get_option( 'major_update_alert' ) == 'done' ) :
		return;
	endif;
	
	if ( is_super_admin() && !is_admin() ) :

		if ( get_option( 'redirect_frontend_user_to_admin_panel' ) == 'done' ) :
			return;
		endif;

		add_option( 'redirect_frontend_user_to_admin_panel', 'done' );

		$theme_name = wp_get_theme()->get( 'Name' );
		wp_redirect( admin_url( 'themes.php?page=' . sanitize_title_with_dashes( $theme_name ) . '-page' ) );

	endif;

}
// delete_option( 'redirect_frontend_user_to_admin_panel' );



// Special message for admin alert
add_action( 'admin_print_scripts', 'major_update_alert', 999 );

function major_update_alert() {

	if ( get_option( 'major_update_alert' ) == 'done' ) :
		return;
	endif;

	if ( is_super_admin() && is_admin() ) :

		global $pagenow;
		if ( $pagenow == 'themes.php' && isset( $_GET['activated'] ) ) :
			return;
		endif;

		$theme_name = wp_get_theme()->get( 'Name' );
		$update_url = admin_url( 'themes.php?page=' . sanitize_title_with_dashes( $theme_name ) . '-page#w-update-notices' );

		echo '
		<script>
			jQuery(document).ready(function() {
				swal({
					type: "success",
					title: "Special message for admin",
					text: "ChurchSuite version 2.0 is a major update. If you have updated your theme from earlier version then click on “I updated the theme“ button otherwise ” I am installing for first time“ click on",
					confirmButtonText: "I am installing for first time",
					cancelButtonText: "I updated the theme",
					closeOnConfirm: true,
					showCancelButton: true,
				}, function(isConfirm) {
					if ( isConfirm != true ) {
						// similar behavior as clicking on a link
						window.location.href = "' . $update_url . '";
					}
				});
			});
		</script>';

		add_option( 'major_update_alert', 'done' );

	endif; // end is_super_admin() && is_admin()

}
// delete_option( 'major_update_alert' );