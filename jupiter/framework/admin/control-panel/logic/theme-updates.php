<?php

// Clear theme check new version transient
set_transient('mk_jupiter_theme_version', null);

$mk_artbees_products = new mk_artbees_products();

$updates  = new Mk_Wp_Theme_Update();
$releases = $updates->get_release_note();

$is_latest_version = $updates->check_latest_version();
?>
 <div class="control-panel-holder">

<?php echo mk_get_control_panel_view('header', true, array('page_slug' => 'theme-updates')); ?>

<div class="cp-pane">
	<?php if ($mk_artbees_products->is_verified_artbees_customer(false)) { ?>
	<div class="cp-update-box">
			<div class="cp-update-box-title"><?php _e("Theme Update", "mk_framework"); ?></div>
			<div class="cp-update-box-inner">
				<?php if(!empty($is_latest_version)) { ?>
					<span class="cp-update-box-version"><?php echo $releases->post_title; ?></span>
					<span class="cp-update-box-release-date"><?php echo mysql2date( 'j F Y', $releases->post_date ); ?></span>
					<div class="cp-update-box-content"><?php echo $releases->post_content; ?></div>
					<a class="cp-button large blue" href="<?php echo $updates->get_theme_update_url(); ?>"><?php _e("Update Now", "mk_framework"); ?></a>
				<?php } else { ?>	
					<p><?php _e("You have the latest version of Jupiter WordPress Theme. ", "mk_framework"); ?></p>
				<?php } ?>
			</div>	
	</div>

	<?php
	} else {
		echo mk_get_control_panel_view('register-product-popup', true, 
			array('message' => sprintf( __( 'You need to register your product for automatic theme & plugin updates.<br> <a target="_blank" href="%s">Learn how to register</a>', 'mk_framework' ), 'https://artbees.net/themes/docs/how-to-register-theme/' ) )); 
	}
	?>
	
</div>
</div>
