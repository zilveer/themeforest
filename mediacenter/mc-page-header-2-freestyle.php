<?php
/*
Template Name: Header 2 : Free Style Page
*/
global $header_style;
$header_style = 'header-style-2';

get_header(); ?>

<div id="main-content" class="main-content">

	<?php while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content(); ?>
		<?php mc_init_structured_data(); ?>
	</div><!-- #post-<?php the_ID(); ?> -->
	<?php endwhile; ?>

</div><!-- #main-content -->

<?php 
get_footer();