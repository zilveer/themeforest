<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>
	
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
	
	<div class="container <?php if(get_theme_mod( 'sp_sidebar_archive' )) : ?>sp_sidebar<?php endif; ?>">
	
	<div id="main">
	
		<?php if(get_theme_mod( 'sp_archive_layout' ) == 'grid') : ?><ul class="sp-grid"><?php endif; ?>
	
		<?php while (have_posts()) : the_post(); ?>
							
			<?php get_template_part('content', get_theme_mod('sp_archive_layout')); ?>
				
		<?php endwhile; ?>
		
		<?php if(get_theme_mod( 'sp_archive_layout' ) == 'grid') : ?></ul><?php endif; ?>
		
		<?php solopine_pagination(); ?>
		
		<?php endif; ?>
		
	</div>
	
<?php if(get_theme_mod( 'sp_sidebar_archive' )) : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>