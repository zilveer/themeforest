<?php
/**
 * The template for displaying 404 pages (Not Found).
 */
$class = wolf_get_theme_option( '404_bg' ) ? ' content-light-font' : '';
get_header(); ?>
	<div id="primary" class="content-area entry-content full-height">
		<div id="content" class="site-content table" role="main">
			<article id="post-0" class="post error404 not-found text-center table-cell <?php echo esc_attr( $class ); ?>">
				<div class="wrap">
					<h1>:(</h1>
					<h2 class="fittext" data-max-font-size="72"><?php _e( '404 Page not found !', 'wolf' ); ?></h2>
					<p><?php _e( 'You\'ve tried to reach a page that doesn\'t exist or has moved.', 'wolf' ); ?></p>
					<p><a href="<?php echo home_url(); ?>/" class="back-home in-site">&larr; <?php _e( 'back home', 'wolf' ); ?></a></p>
				</div>
			</article><!-- article#post-0 -->
		</div><!-- #content .site-content-->
	</div><!-- #primary .content-area -->
<?php
get_footer();
?>