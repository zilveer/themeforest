<?php get_header(); ?>

		<!-- HOOK: ABOVE SLIDER -->
		<?php get_template_part('inc/hooks/hook_above_slider'); ?>

		<!-- SLIDER -->
		<?php get_template_part('inc/templates/template_slider'); ?>
		
		<!-- HOOK: BELOW SLIDER -->
		<?php get_template_part('inc/hooks/hook_below_slider'); ?>

		<!-- FILTER MENU -->
		<?php get_template_part('inc/templates/template_filter_menu'); ?>
		
		<!-- HOOK: BELOW FILTER MENU -->
		<?php get_template_part('inc/hooks/hook_below_filter_menu'); ?>

		<!-- BEGIN MAIN -->
 		<div id="main">
		</div>

		<!-- BEGIN LOAD MORE -->
		<div class="load-more">
			<div id="ajax_loading_zone"></div>
			<span class='load_more'><?php _e('Load More', 'loc_inspire'); ?></span>
			<span class='no_more'><?php _e('No More Posts', 'loc_inspire'); ?></span>
		</div>

		<!-- HOOK: ABOVE FOOTER -->
		<?php get_template_part('inc/hooks/hook_above_footer'); ?>


<?php get_footer(); ?>
