<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>
	
	<div class="archive-box">
		
		<span><?php _e( 'Browsing Category', 'solopine' ); ?></span>
		<h1><?php printf( __( '%s', 'solopine' ), single_cat_title( '', false ) ); ?></h1>
		
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
		
		<span><?php _e( 'Browsing Category', 'solopine' ); ?></span>
		<h1><?php printf( __( '%s', 'solopine' ), single_cat_title( '', false ) ); ?></h1>
		
		</div>
		
		<div class="container <?php if(get_theme_mod( 'sp_sidebar_archive' )) : ?>sp_sidebar<?php endif; ?>">
		
		<div id="main">
		
			<article class="post">
			
				<p><?php _e( 'Sorry, there is no posts in this category yet.', 'solopine' ); ?></p>
				
			</article>
			
		</div>
	
	<?php endif; ?>
	
<?php if(get_theme_mod( 'sp_sidebar_archive' )) : ?><?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>