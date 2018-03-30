<?php
/*
Template Name: Home Page
*/

get_header(); ?>

<div class="container-col-full-width">

	<?php get_template_part('includes/homepage-slider'); ?>
	
	<?php
	the_post();
	the_content();
	?>

</div>

<?php get_footer(); ?>