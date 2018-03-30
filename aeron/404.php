<?php
/*
Template Name: 404 page
*/

get_header();

get_template_part('title_breadcrumb_bar');

?>

	<section id="page404" class="container">
		<p class="big_404"><?php _e('404', 'ABdev_aeron') ?></p>
		<h2><?php _e('Oops, the Page You are Looking for can not be Found', 'ABdev_aeron') ?></h2>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
			<?php the_content();?>
		<?php endwhile; endif;?>
	</section>

<?php get_footer();