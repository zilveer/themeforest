<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_event_options', 100);
	if( !function_exists('ci_add_tab_event_options') ):
		function ci_add_tab_event_options($tabs)
		{
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Event Options', 'ci_theme');
			return $tabs;
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	$ci_defaults['events_map_show'] = 'enabled';
	$ci_defaults['events_past'] = 'enabled';
	$ci_defaults['events_url_buttons_new_win'] = '';
	$ci_defaults['events_pagination'] = '';
	$ci_defaults['events_new_win'] = '';

?>
<?php else: ?>

	<fieldset class="set">
		<legend><?php _e('Events page', 'ci_theme'); ?></legend>
		<p class="guide"><?php _e('Control what (and how) is being shown in the Events page template.', 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('events_map_show', 'enabled', __('Show events map', 'ci_theme')); ?>
		<?php ci_panel_checkbox('events_past', 'enabled', __('Show past events', 'ci_theme')); ?>
		<?php ci_panel_checkbox('events_pagination', 'enabled', __('Paginate past events', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<legend><?php _e('Event buttons', 'ci_theme'); ?></legend>
		<p class="guide"><?php _e('Control how the Event buttons behave.', 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('events_url_buttons_new_win', 'enabled', __('Open "Buy" and "Watch" button links in a new window', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<legend><?php _e('Single Events', 'ci_theme'); ?></legend>
		<p class="guide"><?php _e('Control how the single Events pages behave.', 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('events_new_win', 'on', __('Open single Events in a new window', 'ci_theme')); ?>
	</fieldset>

<?php endif; ?>