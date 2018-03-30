<?php get_header(); ?>

	<!-- START #not-found -->
	<section id="not-found">
		
		<h1 id="not-found-heading"><img id="not-found-img" src="<?php bloginfo('template_url'); ?>/images/layout/not-found.png" alt="<?php _e( 'Page Not Found', 'onioneye' ); ?>" /></h1>
		
		<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'onioneye' ); ?></p>
		
		<div id="not-found-form">
			<?php get_search_form(); ?>
		</div>
		
	</section>
	<!-- END #not-found -->

<?php get_footer(); ?>