<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $gorilla_sidebar_posts;

?>

<?php get_header(); ?>
	
	<div id="main-container">

		<div class="container <?php if($gorilla_sidebar_posts) : ?>sidebar-open clearfix<?php endif; ?>">	
		
			<div id="content">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
										
					<?php get_template_part('layout','full'); ?>
										
				<?php endwhile; endif; ?>
			</div>
	
			<?php if($gorilla_sidebar_posts) : ?><?php get_sidebar(); ?><?php endif; ?>
		
		</div>

	</div>

<?php get_footer(); ?>