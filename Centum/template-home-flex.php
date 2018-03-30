<?php
/**
 * Template Name: Home Page Template with RoyalSlider
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage centum
 * @since centum 1.0
 */

get_header();

get_template_part('slider'); 

while (have_posts()) : the_post(); ?>
<!-- 960 Container -->
<div class="container">
	<div <?php post_class('post home'); ?> id="post-<?php the_ID(); ?>" >
		<?php the_content() ?>
	</div>
	<!-- Post -->
<?php endwhile; // End the loop. Whew.  ?>
<?php get_footer(); ?>