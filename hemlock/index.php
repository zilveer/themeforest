<?php get_header(); ?>
	
	<?php if(get_theme_mod( 'sp_featured_slider' ) == true) : ?>
		<?php get_template_part('inc/featured_area/featured'); ?>
	<?php endif; ?>
	
	<div class="container <?php if(get_theme_mod( 'sp_sidebar_home' )) : ?>sp_sidebar<?php endif; ?>">
	
	<div id="main">
	
	<?php if(get_theme_mod( 'sp_home_layout' ) == 'grid') : ?>
	
	<?php if(get_theme_mod( 'sp_grid_title' )) : ?>
	<div class="sp-grid-title">
		
		<h3><?php echo get_theme_mod( 'sp_grid_title' ); ?></h3>
		<span class="sub-title"><?php echo get_theme_mod( 'sp_grid_sub' ); ?></span>
		
	</div>
	<?php endif; ?>
	
	<ul class="sp-grid">
	<?php endif; ?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
		<?php get_template_part('content', get_theme_mod('sp_home_layout')); ?>
			
	<?php endwhile; ?>
	
	<?php if(get_theme_mod( 'sp_home_layout' ) == 'grid') : ?></ul><?php endif; ?>
	
	<?php solopine_pagination(); ?>
	
	<?php endif; ?>
	
	</div>
	
<?php if(get_theme_mod( 'sp_sidebar_home' )) : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>