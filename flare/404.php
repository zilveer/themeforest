<?php
/**
 * The Template for displaying 404 pages (Not Found).
 *
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'precontent' ); ?>

<div id="content" class="<?php echo btp_content_get_class(); ?>">
	<div id="content-inner">		
		<div class="grid" id="error404">
			<div class="c-one-third">
				<h3><?php _e( 'Search Our Website', 'btp_theme' ); ?></h3>
				<?php get_search_form(); ?>
			</div>
			
			<div class="c-one-third">
				<h3><?php _e( 'Report a Problem', 'btp_theme' ); ?></h3>
				<p><?php printf( __( 'Please write some descriptive information about your problem, and email our <a href="mailto:%s">webmaster</a>.', 'btp_theme' ), antispambot( get_option( 'admin_email' ), true ) ); ?></p>
			</div>
			
			<div class="c-one-third">
				<h3><?php _e( 'Back to the Homepage', 'btp_theme' ); ?></h3>
				<p><?php printf( __( 'You can also <a href="%s">go back to the homepage</a> and start browsing from there.', 'btp_theme' ), home_url() ); ?></p>				
			</div>
		</div><!-- .grid -->
		
	</div><!-- #content-inner -->
	<div class="background"><div></div></div>
</div><!-- #content -->
<?php get_footer(); ?>