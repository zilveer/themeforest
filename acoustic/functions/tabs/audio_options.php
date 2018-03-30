<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_audio_options', 50);
	if( !function_exists('ci_add_tab_audio_options') ):
		function ci_add_tab_audio_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Audio Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php echo sprintf(__('If you want to use the SoundCloud shortcode you need to download and <a href="%s">install the SoundCloud plugin</a>. Refer to the documentation on how to use it.', 'ci_theme'), 'http://wordpress.org/extend/plugins/soundcloud-shortcode'); ?></p>
	</fieldset>

<?php endif; ?>