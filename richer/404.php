<?php get_header(); ?>

<?php get_template_part( 'framework/inc/titlebar' ); ?>

<div id="page-wrap" class="container">

	<div id="content" class="sixteen columns">
			
		<article class="post">

			<div class="entry" id="error-404">
				
				<h2 class="error-404">404</h2>
				<?php _e("Sorry, but we couldn't find the page you were looking for. Please check to make sure you've typed URL correctly. You may also want to search for what you are looking for.", 'richer') ?>
				<br /><br />
				<?php get_template_part('searchform');?>
				<span align="center"><a href="<?php echo esc_url(home_url()); ?>" target="_self" class="button"><?php _e("Go To Home Page", 'richer') ?></a></span>

			</div>

		</article>
		
	</div> <!-- end content -->

</div> <!-- end page-wrap -->
	
<?php get_footer(); ?>
