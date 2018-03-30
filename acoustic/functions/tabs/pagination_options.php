<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_pagination_options', 70);
	if( !function_exists('ci_add_tab_pagination_options') ):
		function ci_add_tab_pagination_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Pagination Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	$ci_defaults['artists_per_page'] = '16';
	$ci_defaults['discography_per_page'] = '16';
	$ci_defaults['galleries_per_page'] = '16';
	$ci_defaults['video_per_page'] = '16';
	$ci_defaults['products_per_page'] = '16';

	add_action('pre_get_posts', 'ci_theme_change_post_type_archives_per_page');
	if( !function_exists('ci_theme_change_post_type_archives_per_page') ):
	function ci_theme_change_post_type_archives_per_page($query)
	{
		if( !is_admin() and $query->is_main_query() )
		{
			if ( is_post_type_archive('cpt_discography') or is_tax('section') )
				$query->set('posts_per_page', intval(ci_setting('discography_per_page')));

			if ( is_post_type_archive('cpt_artists') or is_tax('artist-category') )
				$query->set('posts_per_page', intval(ci_setting('artists_per_page')));

			if ( is_post_type_archive('cpt_galleries') )
				$query->set('posts_per_page', intval(ci_setting('galleries_per_page')));

			if ( is_post_type_archive('cpt_videos') )
				$query->set('posts_per_page', intval(ci_setting('video_per_page')));

		}
	}
	endif;

?>
<?php else: ?>
	
	<fieldset class="set">
		<p class="guide"><?php _e('Set the number of artists per page on the listing page', 'ci_theme'); ?></p>
		<?php ci_panel_input('artists_per_page', __('Number of artists per page', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the number of albums per page on the listing page', 'ci_theme'); ?></p>
		<?php ci_panel_input('discography_per_page', __('Number of albums per page', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the number of galleriess per page on the listing page', 'ci_theme'); ?></p>
		<?php ci_panel_input('galleries_per_page', __('Number of Galleries per page', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the number of videos per page on the listing page', 'ci_theme'); ?></p>
		<?php ci_panel_input('video_per_page', __('Number of videos per page', 'ci_theme')); ?>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Set the number of products per page on your shop listing page', 'ci_theme'); ?></p>
		<?php ci_panel_input('products_per_page', __('Number of products per page', 'ci_theme')); ?>
	</fieldset>

<?php endif; ?>
