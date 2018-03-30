<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * Theme MiEvent v.1.0
 * Created By Multia-Studio
 * @ http://multia.in
 */

get_header(); ?>

<div class="main-content content-wrapper">
	<div class="container">
		<!-- Heading -->
		<section class="page-heading">
			<h1 class="h1-72 not-found"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'mtheme' ); ?></h1>
		</section>
		<!-- /Heading -->
			
		<div class="posts-listing">
		
			<h3 class="not-found"><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.','mtheme'); ?></h3>
			
		</div>
		
	</div><!-- #row -->
	
</div><!-- #main-content -->

<?php get_footer();