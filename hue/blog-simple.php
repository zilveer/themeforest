<?php
/*
	Template Name: Blog: Simple
*/
?>
<?php get_header(); ?>
<?php hue_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>
	<div class="mkd-container">
		<?php do_action('hue_mikado_after_container_open'); ?>
		<?php the_content(); ?>
		<?php do_action('hue_mikado_page_after_content'); ?>
		<div class="mkd-container-inner" >
			<?php hue_mikado_get_blog('simple'); ?>
		</div>
		<?php do_action('hue_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>