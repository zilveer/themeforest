<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	//$ci_defaults['ci_show_dashboard_rss'] = '';
	$ci_defaults['ci_show_generator_tag'] = 'on';

?>
<?php else: ?>


	<fieldset id="ci-panel-site-other" class="set">
		<legend><?php _e('Other options', 'ci_theme'); ?></legend>
		<?php
			/*
			if( !CI_WHITELABEL && apply_filters('ci_show_dashboard_rss', true) ) {
				ci_panel_checkbox( 'ci_show_dashboard_rss', 'off', __( 'Hide CSSIgniter News Widget from the Dashboard', 'ci_theme' ) );
			}
			*/
		?>

		<p class="guide"><?php _e( "The Meta Generator tag is a piece of information added in the head of the generated HTML code that states the theme name and the developer of the theme. While it is not visible to your site's visitors, it does help us gather usage statistics.", 'ci_theme' ); ?></p>
		<?php
			if( !CI_WHITELABEL && apply_filters('ci_show_generator_tag', true) ) {
				ci_panel_checkbox( 'ci_show_generator_tag', 'on', __( 'Echo a Meta Generator tag (invisible in the website).', 'ci_theme' ) );
			}
		?>
	</fieldset>

<?php endif; ?>