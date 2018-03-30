<?php 

get_header(); ?>

<article class="classic single noBorder">
	<header>
		<h3 class="errorCode">404</h3>
		<h2><?php _e( 'we are sorry', 'bt_theme' ); ?><br><?php _e( 'page not found', 'bt_theme' ); ?></h2>
	</header>
	<div class="articleBody txt-center">
		<a href="/" class="btn chubby"><?php _e( 'Back to homepage', 'bt_theme' ); ?></a>
		<figure class="plug" role="presentation" aria-hidden="true">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/gfx/plug.png' ) ;?>" alt="error 404">
		</figure>
	</div><!-- /articleBody -->
</article><!-- /classic -->

<?php get_footer();