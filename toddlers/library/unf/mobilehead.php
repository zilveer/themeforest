<?php global $unf_options; ?>
<div id="mobile-topbar" class="visible-xs navbar-fixed-top">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-navbar-collapse">
		<span class="sr-only"><?php _e("Toggle navigation", "toddlers");?></span>
		<span class="icon-menu-1"></span>
	</button>

	<?php
	if (!empty($unf_options['unf_contactnumber'] )) {
	?>
		<a class="callbutton button" href="tel:<?php echo esc_attr($unf_options['unf_contactnumber']); ?>">
			<span class="sr-only"><?php _e("Call Us", "toddlers");?></span>
			<span class="icon-phone"></span>
		</a>
	<?php } ?>

	<?php
	if (!empty($unf_options['unf_googlemapsaddress'] )) {
	?>
		<a class="mapbutton button" href="<?php echo esc_url($unf_options['unf_googlemapsaddress']); ?>" target="_blank">
			<span class="sr-only"><?php _e("Find Us", "toddlers");?></span>
			<span class="icon-map"></span>
		</a>
	<?php } ?>


	<div class="collapse navbar-collapse" id="mobile-navbar-collapse">
		<?php unf_mobile_menu(); ?>
	</div>
</div>
<?php if ( !empty( $unf_options['unf_mobile_logo']['url']) ) {?>
<div class="mobile-logo visible-xs">
	<a href="<?php echo site_url(); ?>">
		<img src="<?php echo esc_url($unf_options['unf_mobile_logo']['url']);?>" data-no-retina alt="<?php bloginfo( 'name' ); ?>" class="thesitelogo">
	</a>
</div>
<?php } else { ?>
	<div class="mobile-nologo visible-xs">
		<a href="<?php echo site_url(); ?>">
			<?php if( !empty($unf_options['unf_reg_logo']['url'])){?>
			<img src="<?php echo esc_url($unf_options['unf_reg_logo']['url'])?>" data-no-retina alt="<?php bloginfo( 'name' ); ?>">
			<?php } else { ?>
			<img src="<?php echo get_template_directory_uri(); ?>/library/img/mobile-logo.png" data-no-retina alt="<?php bloginfo( 'name' ); ?>">
			<?php } ?>
		</a>
	</div>
<?php } ?>