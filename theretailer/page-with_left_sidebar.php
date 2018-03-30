<?php
/*
Template Name: Page with Left Sidebar
*/
?>

<?php get_header(); ?>

<div class="global_content_wrapper">

<div class="container_12 with_sidebar sidebar_left">

    <div class="grid_8 push_4">

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
        
	</div>

	<div class="grid_4 pull_8">
    
		<div class="gbtr_aside_column">
			<?php 
			get_sidebar();
			?>
        </div>
        
    </div>

</div>

</div>

<?php get_template_part("light_footer"); ?>
<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>