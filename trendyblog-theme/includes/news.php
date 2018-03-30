<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();


	$counter = new df_custom_counter; 
	$counter->reset_count(1);




	
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php get_template_part(THEME_SINGLE."page-title"); ?>
	<?php
		if(is_author()) {
			get_template_part(THEME_SINGLE."about-author");
		}
	?>
        <!-- Row -->
        <div class="row">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php get_template_part(THEME_LOOP."post"); ?>
				<?php 
					$counter = new df_custom_counter; 
					$counter->plus_one(); 
				?>
			<?php endwhile; else: ?>
				<?php get_template_part(THEME_LOOP."no-post"); ?>
			<?php endif; ?>
		</div>
	<?php customized_nav_btns($paged, $wp_query->max_num_pages); ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
