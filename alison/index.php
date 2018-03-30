<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php get_header(); ?>

	<?php if($gorilla_enable_featured_post_area == true && (is_home() || is_front_page())) :
		do_action( 'gorilla_get_featured_posts' );
	endif; ?>

	<div id="main-container">
	
		<div class="container<?php if($gorilla_sidebar_home) : ?> sidebar-open clearfix<?php endif; ?> <?php echo esc_attr($gorilla_home_layout); ?>-container">
		
			<div id="content">

				<div class="post-list <?php echo esc_attr($gorilla_home_layout); ?>">
				
				<?php if($gorilla_home_layout == 'masonry') : ?>
				<div class="masonry-layout">
				<?php elseif($gorilla_home_layout == 'list') : ?>
				<div class="list-layout">
				<?php endif; ?>
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									
					<?php get_template_part('layout', $gorilla_home_layout); ?>
						
				<?php endwhile; ?>
				
				<?php if($gorilla_home_layout == 'masonry' || $gorilla_home_layout == 'list') : ?></div><?php endif; ?>

				</div>
				
				<?php gorilla_pagination(); ?>
				
				<?php endif; ?>

			</div>

			<?php if($gorilla_sidebar_home) : ?><?php get_sidebar(); ?><?php endif; ?>
		
		</div>
		
	</div>
<?php get_footer(); ?>