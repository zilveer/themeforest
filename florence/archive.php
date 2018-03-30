<?php get_header(); ?>
	
	<div class="container">
	
		<div id="content">
		
			<div id="main" <?php if(get_theme_mod('sp_archive_layout') == 'full' || get_theme_mod('sp_archive_layout') == 'grid-full' || get_theme_mod('sp_archive_layout') == 'list-full') : ?>class="fullwidth"<?php else : ?>class="regular"<?php endif; ?>>
			
				<div class="archive-box">
	
					<?php
						if ( is_day() ) :
							echo _e( '<span>Daily Archives</span>', 'solopine' );
							printf( __( '<h1>%s</h1>', 'solopine' ), get_the_date() );

						elseif ( is_month() ) :
							echo _e( '<span>Monthly Archives</span>', 'solopine' );
							printf( __( '<h1>%s</h1>', 'solopine' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'solopine' ) ) );

						elseif ( is_year() ) :
							echo _e( '<span>Yearly Archives</span>', 'solopine' );
							printf( __( '<h1>%s</h1>', 'solopine' ), get_the_date( _x( 'Y', 'yearly archives date format', 'solopine' ) ) );

						else :
							_e( '<h1>Archives</h1>', 'solopine' );

						endif;
					?>
					
				</div>

				<?php if(get_theme_mod('sp_archive_layout') == 'grid' || get_theme_mod('sp_archive_layout') == 'grid-full') : ?><ul class="grid-layout"><?php endif; ?>
					
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
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