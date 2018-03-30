<?php
/**
 * Top Bar
 */
?>
<div id="top-bar">
	<div class="wrap">
		<div class="infos-container">
			<?php echo wolf_format_custom_content_output( stripslashes( wolf_get_theme_option( 'top_bar_content' ) ) ); ?>
		</div>

		<?php if ( wolf_get_theme_option( 'top_bar_flags' ) ) wolf_wpml_flags(); ?>

		<?php
			$services = wolf_get_theme_option( 'top_bar_socials_services' );
			if ( $services ) {
				echo wolf_theme_socials( $services, '1x' );
			}
		?>
	</div>
</div>