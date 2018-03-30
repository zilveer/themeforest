<?php 
/**
 * page.php
 *
 * The template for displaying all regular pages.
 */
?>

<?php get_header(); ?>

<!--Page main wrapper-->
<div id="main-content"> 
	<div class="page-wrapper regular-page">
		<div class="container">

			<?php if (ot_get_option('show_breadcrumbs','on') == 'on'): ?>
			<!-- breadcrumbs -->
			<ol class="breadcrumb">
				<?php if(function_exists('the_owlab_breadcrumbs')) the_owlab_breadcrumbs(); ?>
			</ol>
			<!--/ breadcrumbs -->
			<?php endif; ?>

			<?php while( have_posts() ) : the_post(); ?>
				
				<!-- page title -->	
				<h2 class="section-title double-title">
					<?php the_title(); ?>
				</h2>
				<!--/ page title -->

				<?php the_content(); ?>

				<?php wp_link_pages(); ?>

				<?php //comments_template(); ?>
			
			<?php endwhile; ?>
			<hr/>
			<a class="back-to-top" href="#"></a>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--/Page main wrapper-->

<?php get_footer(); ?>