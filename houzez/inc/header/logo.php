<?php
global $post;
$fave_main_menu_trans = get_post_meta( $post->ID, 'fave_main_menu_trans', true );
$splash_logo = houzez_option( 'custom_logo_splash', false, 'url' );
$custom_logo = houzez_option( 'custom_logo', false, 'url' );
$splash_logolink_type = houzez_option('splash-logolink-type');
$splash_logolink = houzez_option('splash-logolink');

if( empty( $custom_logo ) ) {
	$custom_logo = get_template_directory_uri() . '/images/logo/logo-houzez-white.png';
}

if( is_page_template( 'template/template-splash.php' ) ) {
	if($splash_logolink_type == 'custom') {
		$splash_logo_link = $splash_logolink;
	} else {
		$splash_logo_link = home_url( '/' );
	}
} else {
	$splash_logo_link = home_url( '/' );
}

?>

<?php if ( is_page_template( 'template/template-splash.php' ) || $fave_main_menu_trans == 'yes' ) { ?>
	<a href="<?php echo esc_url( $splash_logo_link ); ?>">
		<?php if( !empty( $splash_logo ) ) { ?>
			<img src="<?php echo esc_url( $splash_logo ); ?>" alt="logo">
		<?php } ?>
	</a>
<?php } else { ?>

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php if( !empty( $custom_logo ) ) { ?>
			<img src="<?php echo esc_url( $custom_logo ); ?>" alt="logo">
		<?php } ?>
	</a>
<?php } ?>
