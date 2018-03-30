<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php get_header(); ?>
	<div id="main-container">

		<div class="container <?php if(get_theme_mod( 'gorilla_sidebar_page' )) : ?>sidebar-open clearfix<?php endif; ?>">	
		
			<div id="content">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									
					<?php get_template_part('layout', 'page'); ?>
										
				<?php endwhile; endif; ?>
			</div>
	
			<?php if(get_theme_mod( 'gorilla_sidebar_page' )) : ?><?php get_sidebar(); ?><?php endif; ?>
		
		</div>

	</div>
	
<?php get_footer(); ?>