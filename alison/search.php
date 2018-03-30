<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php get_header(); ?>
	
	<div class="archive-title-area search-page">

		<div class="format-icon">
			<i class="elegant elegant-layers"></i>
		</div>
		<h1 class="page-introduce-title"><?php _e( 'Search results for', 'alison' ); ?> <span class="search-query"><?php echo get_search_query(); ?></span></h1>
		
	</div>
	<div id="main-container">

			<?php if (have_posts()) : ?>
			<div class="container <?php echo esc_attr(get_theme_mod( 'gorilla_archive_layout','full' )); ?>-container">

				<div id="content">

					<div class="post-list <?php echo esc_attr(get_theme_mod( 'gorilla_archive_layout','full' )); ?>">	

					<?php if(get_theme_mod( 'gorilla_archive_layout' ) == 'masonry') : ?>
					<div class="masonry-layout">
					<?php elseif(get_theme_mod( 'gorilla_archive_layout' ) == 'list') : ?>
					<div class="list-layout">
					<?php endif; ?>
				
					<?php while (have_posts()) : the_post(); ?>
										
						<?php get_template_part('layout', get_theme_mod('gorilla_archive_layout','full')); ?>
							
					<?php endwhile; ?>

					<?php if(get_theme_mod( 'gorilla_archive_layout' ) == 'masonry' || get_theme_mod( 'gorilla_archive_layout' ) == 'list') : ?></div><?php endif; ?>

					</div>
					
					<?php gorilla_pagination(); ?>
				</div>
			</div>

			<?php else : ?>
			<div class="container">
				<div id="content" class="post">

					<div class="entry-content">
						<h2><?php _e( "We Can't Find Anything For", 'alison' ); ?> <span class="search-query"><?php echo get_search_query(); ?></span></h2>
						<p><?php _e( "Would You Like To Do More Search?", 'alison' ); ?></p>
					</div><!-- .entry-content -->	

					<div class="inline-search-wrapper">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
				
			<?php endif; ?>
			
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>