<?php
/*
Template Name: Left Sidebar
*/

get_header();

get_template_part('title_breadcrumb_bar'); 

?>
	
	<section>
		<div class="container">

			<div class="row">

				<div class="span9 content_with_left_sidebar right">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
						<?php the_content();?>
					<?php endwhile; endif;?>
				</div><!-- end span8 main-content -->
				
				<aside class="span3 sidebar sidebar_left">
					<?php get_sidebar(); ?>
				</aside><!-- end span4 sidebar -->

			</div><!-- end row -->

		</div>
	</section>

<?php get_footer();