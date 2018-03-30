<?php
/*
Template Name: Static Homepage
*/
get_header();
global $unf_options;
get_template_part( 'library/unf/slider');?>

	<div id="content-wrapper" class="row clearfix">
		<?php get_template_part( 'loop', 'home' ); ?>
		<?php get_sidebar('home'); ?>
	</div>

<?php get_footer(); ?>