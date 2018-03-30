<?php
/*
Template Name: No Container
*/

get_header();

get_template_part('title_breadcrumb_bar');

?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<?php the_content();?>
	<?php endwhile; endif;?>

<?php get_footer();