<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php get_header(); ?>
	
	<?php if (have_posts()) : ?>
	
	<div class="archive-title-area">
		
		<div class="format-icon">
			<i class="elegant elegant-layers"></i>
		</div>
		<h1 class="page-introduce-title"><?php printf( __( 'Posts for <strong>%s</strong> Category', 'alison' ), single_cat_title( '', false ) ); ?></h1>
		
	</div>
	
	
	
	<div id="main-container">

		<div class="container <?php if(get_theme_mod( 'gorilla_sidebar_archive' )) : ?>sidebar-open clearfix<?php endif; ?> <?php echo esc_attr(get_theme_mod( 'gorilla_archive_layout','full' )); ?>-container">

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
				
				<?php endif; ?>

			</div>
			
			<?php if(get_theme_mod( 'gorilla_sidebar_archive' )) : ?><?php get_sidebar(); ?><?php endif; ?>

		</div>
		
	</div>
	
<?php get_footer(); ?>