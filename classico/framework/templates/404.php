<?php 
	get_header();
?>

<?php do_action( 'et_page_heading' ); ?>

<div class="container">
	<div class="page-content page-404">
		<div class="row">
			<div class="col-md-12">
				<h1 class="largest">404</h1>
				<h1><?php _e('Oops! Page not found', ET_DOMAIN) ?></h1>
				<hr class="horizontal-break">
				<p><?php _e('Sorry, but the page you are looking for is not found. Please, make sure you have typed the current URL.', ET_DOMAIN) ?> </p>
				<?php get_search_form( true ); ?>
				<a href="<?php echo home_url(); ?>" class="button medium"><?php _e('Go to home page', ET_DOMAIN); ?></a>
			</div>
		</div>


	</div>
</div>

	
<?php
	get_footer();
?>