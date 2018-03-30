<?php get_header(); ?>
	
<?php
	$sidebar_config = sf_get_post_meta($post->ID, 'sf_sidebar_config', true);
	if (isset($_GET['sidebar'])) {
		$sidebar_config = $_GET['sidebar'];
	}
	$pb_fw_mode = true;
	$pb_active = sf_get_post_meta($post->ID, '_spb_js_status', true);
	$vc_enabled = get_post_meta($post->ID, '_wpb_vc_js_status', true);
	
	if ( $vc_enabled ) {
		$pb_fw_mode = false;
	}
	
	if ( $vc_enabled && $pb_active == "true" ) {
		$pb_fw_mode = true;
	}
	
	if ($sidebar_config != "no-sidebars" || $pb_active != "true" || post_password_required() ) {
		$pb_fw_mode = false;
	}
	
	if ( sf_theme_supports('swift-smartsidebar') && $post && !is_search() ) {
		$sidebar_progress_menu = sf_get_post_meta( $post->ID, 'sf_sidebar_progress_menu', true );
		
		if ( $sidebar_progress_menu == "left-sidebar" || $sidebar_progress_menu == "right-sidebar" ) {
			$pb_fw_mode = false;
		}
	}
			
?>

<?php 
	// Check if page should be enabled in full width mode
	if (!$pb_fw_mode) { ?>
	<div class="container">
<?php } ?>

	<?php sf_base_layout('page'); ?>
	
<?php 
	// Check if page should be enabled in full width mode
	if (!$pb_fw_mode) { ?>
	</div>
<?php } ?>

<?php get_footer(); ?>