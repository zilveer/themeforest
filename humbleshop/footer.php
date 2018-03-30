<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package humbleshop
 */
?>

	</div><!-- #content -->

</div><!-- #page -->

<!-- ====== -->
<!-- FOOTER -->
<!-- ====== -->
<footer id="bottom" class="site-footer" role="contentinfo">
	<div class="container"><div class="site-info row"><div class="col-xs-12">
		<div class="row">
		<?php if ( ! dynamic_sidebar( 'footer' ) ) : ?>
			<div class="col-sm-3">
				<p><strong>Widget Title</strong></p>
				<article>Content</article>
			</div>
			<div class="col-sm-3">
				<p><strong>Widget Title</strong></p>
				<article>Content</article>
			</div>
			<div class="col-sm-3">
				<p><strong>Widget Title</strong></p>
				<article>Content</article>
			</div>
			<div class="col-sm-3">
				<p><strong>Widget Title</strong></p>
				<article>Content</article>
			</div>
		<?php endif; // end sidebar widget area ?>		
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-6 clearfix paymenticon">
			<!-- Payment Method -->
			<?php 
			if ( get_theme_mod('amex') ) { echo '<div class="payment amex"></div>'; }
			if ( get_theme_mod('mastercard') ) { echo '<div class="payment mastercard"></div>'; }
			if ( get_theme_mod('visa') ) { echo '<div class="payment visa"></div>'; }
			if ( get_theme_mod('paypal') ) { echo '<div class="payment paypal"></div>'; }
			if ( get_theme_mod('cirrus') ) { echo '<div class="payment cirrus"></div>'; }
			if ( get_theme_mod('delta') ) { echo '<div class="payment delta"></div>'; }
			if ( get_theme_mod('direct-debit') ) { echo '<div class="payment direct-debit"></div>'; }
			if ( get_theme_mod('discover') ) { echo '<div class="payment discover"></div>'; }
			if ( get_theme_mod('ebay') ) { echo '<div class="payment ebay"></div>'; }
			if ( get_theme_mod('google') ) { echo '<div class="payment google"></div>'; }
			if ( get_theme_mod('maestro') ) { echo '<div class="payment maestro"></div>'; }
			if ( get_theme_mod('moneybookers') ) { echo '<div class="payment moneybookers"></div>'; }
			if ( get_theme_mod('sagepay') ) { echo '<div class="payment sagepay"></div>'; }
			if ( get_theme_mod('solo') ) { echo '<div class="payment solo"></div>'; }
			if ( get_theme_mod('switch') ) { echo '<div class="payment switch"></div>'; }
			if ( get_theme_mod('visaelectron') ) { echo '<div class="payment visaelectron"></div>'; }
			if ( get_theme_mod('twocheckout') ) { echo '<div class="payment twocheckout"></div>'; }
			if ( get_theme_mod('westernunion') ) { echo '<div class="payment westernunion"></div>'; }
			?>
			</div>
			<div class="col-sm-6 promonote">
				<?php echo get_theme_mod( 'footernote' ); ?>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-6 credit">
				<small>
					<?php do_action( 'humbleshop_credits' ); ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">&copy; <?php bloginfo( 'name' ); ?></a> | <span class="site-description"><?php bloginfo( 'description' ); ?></span>
				</small>
			</div>
			<div class="col-sm-6 social">
				<ul class="list-unstyled">
					<?php if (get_theme_mod('facebook')) { echo '<li><a href="'.get_theme_mod('facebook').'" target="_blank"><i class="fa fa-facebook"></i></a></li>'; } ?>
					<?php if (get_theme_mod('twitter')) { echo '<li><a href="'.get_theme_mod('twitter').'" target="_blank"><i class="fa fa-twitter"></i></a></li>'; } ?> 
					<?php if (get_theme_mod('instagram')) { echo '<li><a href="'.get_theme_mod('instagram').'" target="_blank"><i class="fa fa-instagram"></i></a></li>'; } ?> 
					<?php if (get_theme_mod('google-plus')) { echo '<li><a href="'.get_theme_mod('google-plus').'" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; } ?> 
					<?php if (get_theme_mod('pinterest')) { echo '<li><a href="'.get_theme_mod('pinterest').'" target="_blank"><i class="fa fa-pinterest"></i></a></li>'; } ?> 
					<?php if (get_theme_mod('soundcloud')) { echo '<li><a href="'.get_theme_mod('soundcloud').'" target="_blank"><i class="fa fa-soundcloud"></i></a></li>'; } ?>
				</ul>
			</div>
		</div>
	</div></div></div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>