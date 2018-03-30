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
		
		<?php
			if ( is_day() ) :
				echo '<h1 class="page-introduce-title">'.__( 'Daily Archives for', 'alison' ).' <strong>'.get_the_date().'</strong></h1>';

			elseif ( is_month() ) :
				echo '<h1 class="page-introduce-title">'.__( 'Monthly Archives for', 'alison' ).' <strong>'.get_the_date( _x( 'F Y', 'monthly archives date format', 'alison' ) ).'</strong></h1>';

			elseif ( is_year() ) :
				echo '<h1 class="page-introduce-title">'.__( 'Yearly Archives for', 'alison' ).' <strong>'.get_the_date( _x( 'Y', 'yearly archives date format', 'alison' ) ).'</strong></h1>';

			else :
				echo '<h1 class="page-introduce-title">'.__( 'Archives', 'alison' ).'</h1>';

			endif;
		?>
		
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