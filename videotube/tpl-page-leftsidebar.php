<?php if( !defined('ABSPATH') ) exit;?>
<?php 
/**
 * Template Name: Page Left Sidebar
 */
?>
<?php get_header(); ?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>	
		<div class="row">
			<?php get_sidebar();?>
			<div class="col-sm-8 main-content">
				 <div <?php post_class();?>>
					<?php the_post();?>
                    <?php get_template_part('content','page');?>
                </div><!-- /.post -->
				<?php 
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>	
			</div>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>