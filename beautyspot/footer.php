<?php if ( lsvr_get_field( 'enable_bottom_panel', true, true ) ) : ?>
<?php // BOTTOM PANEL
get_sidebar( 'bottom' ); // Load sidebar-bottom.php template. ?>
<?php endif; ?>

<?php if ( lsvr_get_field( 'enable_footer', true, true ) ) : ?>
<!-- FOOTER : begin -->
<footer id="footer">
	<div class="container">

		<?php if ( lsvr_get_field( 'enable_twitter_feed', false, true ) && lsvr_get_field( 'twitter_feed_username' ) !== '' ) : ?>
		<!-- FOOTER TWITTER : begin -->
		<div class="footer-twitter<?php if ( lsvr_get_field( 'twitter_feed_paginated', true, true ) ) { echo ' m-paginated'; } ?>"
			data-id="<?php echo lsvr_get_field( 'twitter_feed_username' ); ?>"
			data-interval="<?php echo lsvr_get_field( 'twitter_feed_autoplay_speed', '0' ); ?>"
			data-seconds-ago="<?php _e( '%d seconds ago', 'beautyspot' ); ?>"
			data-minutes-ago="<?php _e( '%d minutes ago', 'beautyspot' ); ?>"
			data-hours-ago="<?php _e( '%d hours ago', 'beautyspot' ); ?>"
			data-days-ago="<?php _e( 'approximately %d days ago', 'beautyspot' ); ?>"
			data-months-ago="<?php _e( 'approximately %d months ago', 'beautyspot' ); ?>"
			data-years-ago="<?php _e( 'approximately %d years ago', 'beautyspot' ); ?>">
			<div class="footer-twitter-inner">
				<i class="ico fa fa-twitter"></i>
				<h4 class="twitter-title"><a href="<?php echo esc_url( 'https://twitter.com/' . lsvr_get_field( 'twitter_feed_username' ) ); ?>"><?php echo lsvr_get_field( 'twitter_feed_title', 'Twitter Feed' ); ?></a></h4>
				<div class="twitter-feed">
					<span class="c-loading-anim"><span></span></span>
				</div>
			</div>
		</div>
		<!-- FOOTER TWITTER : end -->
		<?php endif; ?>

		<!-- FOOTER BOTTOM : begin -->
		<div class="footer-bottom">

			<?php // FOOTER MENU
			get_template_part( 'menu', 'footer' ); ?>

			<?php $footer_text = lsvr_get_field( 'footer_text', '&copy; ' ); ?>
			<?php if ( $footer_text !== ''  ) : ?>
			<!-- FOOTER TEXT : begin -->
			<div class="footer-text">
				<?php echo wpautop( $footer_text ); ?>
			</div>
			<!-- FOOTER TEXT : end -->
			<?php endif; ?>

		</div>
		<!-- FOOTER BOTTOM : end -->

	</div>
</footer>
<!-- FOOTER : end -->
<?php endif; ?>

</div>
<!-- WRAPPER : end -->

<?php if ( lsvr_get_field( 'resform_shortcode' ) !== '' ) : ?>
<!-- RESERVATION FORM : begin -->
<div id="reservation-form" class="c-modal" style="display: none;">
	<div class="modal-loading"><span class="c-loading-anim"><span></span></span></div>
	<div class="modal-box" style="display: none;">
		<button class="modal-close" type="button"><i class="fa fa-times"></i></button>
		<div class="modal-box-inner various-content"><?php echo do_shortcode( lsvr_get_field( 'resform_shortcode' ) ); ?></div>
	</div>
</div>
<!-- RESERVATION FORM : end -->
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>