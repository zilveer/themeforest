<?php
/*
Template Name: Full width
*/

get_header();

get_template_part('title_breadcrumb_bar'); 

?>
	<section>
		<div class="container">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
				<?php the_content();?>
			<?php endwhile; endif;?>

		</div>
	</section>

<?php get_footer();