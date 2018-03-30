<?php
/*
Template Name: Blog: Expanding Tiles
*/
?>
<?php get_header(); ?>
	<div class="eltd-full-width">
		<?php do_action('flow_elated_after_container_open'); ?>
		<div class="eltd-full-width-inner">
			<?php flow_elated_get_blog('expanding-tiles'); ?>
		</div>
		<?php do_action('flow_elated_before_container_close'); ?>
	</div>
<?php get_footer(); ?>