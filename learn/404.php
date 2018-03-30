<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
get_header(); ?>

<section class="page404">
	<div class="container">
    	<div class="sixteen columns">
			<div class="text-center">
				<h1><?php echo esc_html__('404', 'learn'); ?></h1>
				<div class="content_404">
				<?php echo wp_kses( __( 'The page you are looking for no longer exists. <br>Perhaps you can return back to the sites homepage see you can find what you are looking for.', 'learn' ), wp_kses_allowed_html('post')); ?>
				</div>

				<div class="blog-link dark"><a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Back To Home', 'learn'); ?></a></div>
			</div>
       </div> 	
    </div><!-- end container -->
</section><!-- end postwrapper -->

<?php get_footer(); ?>
