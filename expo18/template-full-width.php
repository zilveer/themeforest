<?php
/*
Template Name: Full-width Page
*/

get_header(); ?>

	<div class="container-col-full-width">
  	<h1 class="main-h1"><?php the_title(); ?></h1>

		<!-- Content -->
		<?php echo get_option(OM_THEME_PREFIX . 'code_after_page_h1'); ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<?php the_content(); ?>
			</div>
			
		<?php endwhile; ?>
		
		<?php echo get_option(OM_THEME_PREFIX . 'code_after_page_content'); ?>
		
		<?php wp_link_pages(array('before' => '<div class="navigation-pages"><span>'.__('Pages:', 'om_theme').'</span>', 'after' => '</div>', 'next_or_number' => 'number')); ?>
		
		<!-- /Content -->

		<?php if(get_option(OM_THEME_PREFIX . 'hide_comments_pages') != 'true') : ?>
			<?php comments_template('',true); ?>
		<?php endif; ?>			
	</div>

<?php get_footer(); ?>