<?php get_header(); ?>
	
	<div class="container">
	
		<div id="content">
		
			<div id="main" <?php if(get_theme_mod('sp_archive_layout') == 'full' || get_theme_mod('sp_archive_layout') == 'grid-full' || get_theme_mod('sp_archive_layout') == 'list-full') : ?>class="fullwidth"<?php else : ?>class="regular"<?php endif; ?>>
			
				<div class="archive-box">
					
					<span><?php _e( 'All Posts By', 'solopine' ); ?></span>
					<h1><?php the_post(); echo get_the_author(); ?></h1>
					
				</div>

				<?php if(get_theme_mod('sp_archive_layout') == 'grid' || get_theme_mod('sp_archive_layout') == 'grid-full') : ?><ul class="grid-layout"><?php endif; ?>
					
				<?php rewind_posts(); if (have_posts()) : while (have_posts()) : the_post(); ?>
						
					<?php if(get_theme_mod('sp_archive_layout') == 'grid' || get_theme_mod('sp_archive_layout') == 'grid-full') : ?>
						<?php get_template_part('content', 'grid'); ?>
					<?php elseif(get_theme_mod('sp_archive_layout') == 'list' || get_theme_mod('sp_archive_layout') == 'list-full') : ?>
						<?php get_template_part('content', 'list'); ?>
					<?php else : ?>
						<?php get_template_part('content'); ?>
					<?php endif; ?>
						
				<?php endwhile; ?>

				<?php if(get_theme_mod('sp_archive_layout') == 'grid' || get_theme_mod('sp_archive_layout') == 'grid-full') : ?></ul><?php endif; ?>
				
				<?php solopine_pagination(); ?>
				
				<?php endif; ?>
			
			</div>
	
<?php if(get_theme_mod('sp_archive_layout') == 'full' || get_theme_mod('sp_archive_layout') == 'grid-full' || get_theme_mod('sp_archive_layout') == 'list-full') : else : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>