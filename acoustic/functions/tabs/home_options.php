<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_homepage_options', 20);
	if( !function_exists('ci_add_tab_homepage_options') ):
		function ci_add_tab_homepage_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Homepage Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['slider_show']		= 'enabled';
	$ci_defaults['slider_auto']		= 'enabled';
	$ci_defaults['slider-no'] 		= '5';
	$ci_defaults['news-no'] 		= '5';
	$ci_defaults['news-cat'] 		= '';
	$ci_defaults['latest_media'] 	= 'enabled';
	//$ci_defaults['homepage-page-id'] = '';

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Display Latest Media section?', 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('latest_media', 'enabled', __('Show Latest Media', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Control whether you want to display the slider on the homepage.', 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('slider_show', 'enabled', __('Show slider on homepage', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Control whether you want the slider to move to the next slide automatically. If you have videos in the slider, disable it.', 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('slider_auto', 'enabled', __('Automatic slider on homepage?', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('You can set the number of items that will be displayed in the slider.', 'ci_theme'); ?></p>
		<?php ci_panel_input('slider-no', __('Number of items on slider', 'ci_theme')); ?>
	</fieldset>

	<?php /*
	<fieldset class="set">
		<p class="guide"><?php _e('Instead of displaying news on the homepage, you can display the content of a page.', 'ci_theme'); ?></p>
		<?php wp_dropdown_pages(array(
			'selected'=>$ci['homepage-page-id'],
			'name'=>THEME_OPTIONS.'[homepage-page-id]',
			'show_option_none' => __('Select a page','ci_theme'),
			'option_none_value' => ''
		)); ?>
	</fieldset>
	*/ ?>

	<fieldset class="set">
		<p class="guide"><?php _e('You can set the number of items that will be displayed in the news section.', 'ci_theme'); ?></p>
		<?php ci_panel_input('news-no', __('Number of items on news section', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Include the following categories from the homepage news. Enter the category IDs seperated by comma like this 4,5,8,10.', 'ci_theme'); ?></p>
		<?php ci_panel_input('news-cat', __('Categories IDs', 'ci_theme')); ?>
	</fieldset>

<?php endif; ?>