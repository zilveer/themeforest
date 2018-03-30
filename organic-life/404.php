<?php get_header('alternative'); 
/*
*Template Name: 404 Page Template
*/
?>

<div class="content-404">
	<img src="<?php echo get_template_directory_uri().'/images/404.png' ?>" alt="">
	<h1><?php  _e( '404','themeum');?> </h1>
	<h2><?php  _e( 'Page not found', 'themeum' ); ?></h2>
	<a class="btn btn-lg" href="<?php echo site_url(); ?>"><?php _e( 'Back to Homepage', 'themeum' ); ?></a>
</div>

<?php get_footer('alternative'); ?>
