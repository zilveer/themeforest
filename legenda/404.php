<?php 
	get_header();
?>

<?php et_page_heading(); ?>

<div class="container">
	<div class="page-content page-404">
		<div class="row-fluid">
			<div class="span12">
				<h1 class="largest">404</h1>
				<h1><?php _e('Oops! Page not found', ETHEME_DOMAIN) ?></h1>
				<p><?php _e('Sorry, but the page you are looking for is not found. Please, make sure you have typed the current URL.', ETHEME_DOMAIN) ?> </p>
				<a href="<?php echo home_url(); ?>" class="button medium"><?php _e('Go to home page', ETHEME_DOMAIN); ?></a>
			</div>
		</div>


	</div>
</div>

	
<?php
	get_footer();
?>