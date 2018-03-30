<?php
/*
	Template Name: Blog: Split Column
*/
?>
<?php get_header(); ?>
<?php flow_elated_get_title(); ?>

<?php 

$slider_position = flow_elated_get_blog_slider_position();

if($slider_position !== 'above_content'){
	get_template_part('slider');
}

?>
	<div class="eltd-container">
		<?php do_action('flow_elated_after_container_open'); ?>
		<div class="eltd-container-inner">
			<?php flow_elated_get_blog('split-column'); ?>
		</div>
		<?php do_action('flow_elated_before_container_close'); ?>
	</div>
<?php get_footer(); ?>