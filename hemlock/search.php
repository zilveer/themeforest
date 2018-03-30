<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>
	
	<div class="archive-box">
		
		<span><?php _e( 'Search results for', 'solopine' ); ?></span>
		<h1><?php printf( __( '%s', 'solopine' ), get_search_query() ); ?></h1>
		
	</div>
	
	<div class="container <?php if(get_theme_mod( 'sp_sidebar_archive' )) : ?>sp_sidebar<?php endif; ?>">
	
		<div id="main">
	
		<?php if(get_theme_mod( 'sp_archive_layout' ) == 'grid') : ?><ul class="sp-grid"><?php endif; ?>
	
		<?php while (have_posts()) : the_post(); ?>
							
			<?php get_template_part('content', get_theme_mod('sp_archive_layout')); ?>
				
		<?php endwhile; ?>
		
		<?php if(get_theme_mod( 'sp_archive_layout' ) == 'grid') : ?></ul><?php endif; ?>
		
		<?php solopine_pagination(); ?>
		
		</div>
		
	<?php else : ?>
		
		<div class="archive-box">
	
			<span><?php _e( 'Search results for', 'solopine' ); ?></span>
			<h1><?php printf( __( '%s', 'solopine' ), get_search_query() ); ?></h1>
			
		</div>
		
		<div class="container <?php if(get_theme_mod( 'sp_sidebar_archive' )) : ?>sp_sidebar<?php endif; ?>">
			
			<div id="main">
			
				<p class="nothing"><?php _e( 'Sorry, no posts were found. Try searching for something else.', 'solopine' ); ?></p>
			
			</div>
		
	<?php endif; ?>

<?php if(get_theme_mod( 'sp_sidebar_archive' )) : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>