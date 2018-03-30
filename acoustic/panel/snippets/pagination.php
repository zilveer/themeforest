<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	
	// In existing installations, this option will be empty. ci_pagination() will fall back to
	// the way it worked, i.e. WP-PageNavi if available, or PrevNext links if not.
	// See ci_pagination() in /panel/generic.php for more details.
	$ci_defaults['pagination_method'] = 'paginate_links';

?>
<?php else: ?>

	<fieldset id="ci-panel-excerpt" class="set">
		<legend><?php _e('Pagination', 'ci_theme'); ?></legend>
		<p class="guide"><?php _e('Select how you want pagination links to be displayed. You can display the traditional "Previous" and "Next" links, or the recommended, numbered links.', 'ci_theme'); ?></p>
		<label><?php _e('Select the pagination method to use:', 'ci_theme'); ?></label>
		<?php ci_panel_radio('pagination_method', 'paginate_links', 'paginate_links', __('Numbered pagination.', 'ci_theme')); ?>
		<?php ci_panel_radio('pagination_method', 'prevnext', 'prevnext', __('"Previous - Next" links.', 'ci_theme')); ?>
		
		<?php if(function_exists('wp_pagenavi')): ?>

			<?php if( get_ci_theme_support('wp_pagenavi') == false ): ?>
				<p class="guide mt10"><?php _e("The theme has detected that you have installed the <strong>WP-PageNavi</strong> plugin. Although the theme doesn't provide appropriate styles for it, you can still use it without editing any files, by selecting the option below. However, you might need to configure and/or style it on your own.", 'ci_theme'); ?></p>
			<?php endif; ?>

			<?php ci_panel_radio('pagination_method', 'wp_pagenavi', 'wp_pagenavi', __('WP-PageNavi plugin.', 'ci_theme')); ?>
		<?php endif; ?>
	</fieldset>

<?php endif; ?>