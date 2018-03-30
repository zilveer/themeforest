<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php flow_elated_get_title(); ?>
<?php get_template_part('slider'); ?>
<?php 
$single_template = flow_elated_options()->getOptionValue('blog_single_full_width');

	if($single_template == 'grid'){ ?>

		<div class="eltd-container">
			<div class="eltd-container-inner">

	<?php } elseif($single_template == 'full-width'){ ?>

		<div class="eltd-full-width">
			<div class="eltd-full-width-inner clearfix">

	<?php } ?>

			<?php flow_elated_get_blog_single(); ?>
				
		</div>

		<?php do_action('flow_elated_before_container_close'); ?>

		</div>
			
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>