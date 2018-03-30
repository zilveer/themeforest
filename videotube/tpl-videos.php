<?php if( !defined('ABSPATH') ) exit;?>
<?php 
/**
 * Template Name: Main Homepage
 */
?>
<?php get_header();?>
	<?php dynamic_sidebar('mars-featured-videos-sidebar');?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>	
		<div class="row">
			<div class="col-sm-8 main-content">
				<?php dynamic_sidebar('mars-home-videos-sidebar');?>
			</div><!-- /.video-section -->
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>