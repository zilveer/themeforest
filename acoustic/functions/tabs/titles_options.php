<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_titles_options', 60);
	if( !function_exists('ci_add_tab_titles_options') ):
		function ci_add_tab_titles_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Section titles', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	$ci_defaults['title_discography']		= 'Discography';
	$ci_defaults['title_videos']			= 'Videos';
	$ci_defaults['title_galleries']			= 'Galleries';
	$ci_defaults['title_artists']			= 'Artists';
	$ci_defaults['title_blog']				= 'From the blog';
	$ci_defaults['title_events']			= 'Events';

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the title of the Discography Section', 'ci_theme'); ?></p>
		<?php ci_panel_input('title_discography', __('Discography section title', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the title of the Videos Section', 'ci_theme'); ?></p>
		<?php ci_panel_input('title_videos', __('Videos section title', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the title of the Galleries Section', 'ci_theme'); ?></p>
		<?php ci_panel_input('title_galleries', __('Galleries section title', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the title of the Artists Section', 'ci_theme'); ?></p>
		<?php ci_panel_input('title_artists', __('Artists section title', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the title of the Blog Section', 'ci_theme'); ?></p>
		<?php ci_panel_input('title_blog', __('Blog section title', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the title of the Events Section', 'ci_theme'); ?></p>
		<?php ci_panel_input('title_events', __('Events section title', 'ci_theme')); ?>
	</fieldset>

<?php endif; ?>