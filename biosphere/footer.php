<?php
/**
 * The template for displaying the footer.
 */

global $dd_sn;
global $dd_paypal_url;

?>

		</section><!-- #main -->

		<footer id="footer">

			<?php if ( ot_get_option( $dd_sn . 'footer_banner', 'enabled' ) == 'enabled' ) : ?>

				<div id="footer-banner" data-bg-image="<?php echo ot_get_option( $dd_sn . 'footer_banner_img', 'none' ); ?>">

					<div id="footer-banner-inner" class="container">

						<?php if ( ot_get_option( $dd_sn . 'footer_banner_title' ) ) : ?>
							<h2 id="footer-banner-title"><?php echo ot_get_option( $dd_sn . 'footer_banner_title' ); ?></h2>
						<?php endif; ?>

						<?php if ( ot_get_option( $dd_sn . 'footer_banner_descr' ) ) : ?>
							<div id="footer-banner-description"><?php echo ot_get_option( $dd_sn . 'footer_banner_descr' ); ?></div>
						<?php endif; ?>

						<?php if ( ot_get_option( $dd_sn . 'footer_banner_button_link' ) ) : ?>
							<a href="<?php echo ot_get_option( $dd_sn . 'footer_banner_button_link' ); ?>" class="dd-button <?php echo ot_get_option( $dd_sn . 'footer_banner_button_color', 'green' ); ?> big"><?php echo ot_get_option( $dd_sn . 'footer_banner_button_text', 'MAKE A DONATION NOW' ); ?></a>
						<?php endif; ?>

					</div><!-- #footer-banner-inner -->

				</div><!-- #footer-banner -->

			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>

				<div id="footer-main">

					<div id="footer-primary-inner" class="container clearfix">

						<?php if ( ! dynamic_sidebar( 'sidebar-footer' ) ) : ?>

							<!-- No widgets -->

						<?php endif; ?>

					</div><!-- #footer-primary-inner -->

				</div><!-- #footer-primary -->

			<?php endif; ?>

			<div id="footer-colors">
				<?php dd_multicol_colors(); ?>
			</div><!-- footer-colors -->

		</footer><!-- #footer -->

	</div><!-- #page-container -->

	<?php if ( is_singular( 'dd_causes' ) ) : ?>

		<?php

			$lb_title = false;
			$lb_desc = false;

			if ( get_post_meta( get_the_ID(), $dd_sn . 'donate_lightbox_title', true ) ) {
				$lb_title = get_post_meta( get_the_ID(), $dd_sn . 'donate_lightbox_title', true );
			}

			if ( get_post_meta( get_the_ID(), $dd_sn . 'donate_lightbox_desc', true ) ) {
				$lb_desc = get_post_meta( get_the_ID(), $dd_sn . 'donate_lightbox_desc', true );
			}

			if ( ! $lb_title ) {
				$lb_title = ot_get_option( $dd_sn . 'donate_overlay_title', false );
			}

			if ( ! $lb_title ) {
				$lb_title = 'Change in Theme Options or on the cause edit page';
			}

			if ( ! $lb_desc ) {
				$lb_desc = ot_get_option( $dd_sn . 'donate_overlay_description', false );
			}

			if ( ! $lb_desc ) {
				$lb_desc = 'Change in Theme Options or on the cause edit page';
			}

			/**
	 		 * Translation Sync
			 */

			$cause_id = get_the_ID();
			
			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

				global $dd_lang_curr;
				global $dd_lang_default;

				if ( $dd_lang_curr != $dd_lang_default ) {

					$cause_id = icl_object_id( get_the_ID(), 'dd_causes', true, $dd_lang_default );

				}

			}

		?>

		<div id="lb-overlay-donate" class="lb-overlay">

			<div class="lb-overlay-inner">

				<div class="lb-overlay-title"><?php echo $lb_title; ?></div>

				<div class="lb-overlay-descr"><?php echo $lb_desc; ?></div>

				<div class="lb-overlay-form">

					<form action="<?php echo $dd_paypal_url; ?>" method="post">

						<div class="lb-overlay-form-amount">
							
								<input name="amount" type="number" value="<?php echo ot_get_option( $dd_sn . 'donation_default_amount', '50' ); ?>" min="1" />
								<input type="hidden" name="cmd" value="_xclick">
								<input type="hidden" name="business" value="<?php echo ot_get_option( $dd_sn . 'paypal_email' ); ?>">
								<input type="hidden" name="item_name" value="<?php echo get_the_title( get_the_ID() ); ?>">
								<input type="hidden" name="item_number" value="<?php echo $cause_id; ?>">
								<input type="hidden" name="currency_code" value="<?php echo ot_get_option( $dd_sn . 'paypal_currency', 'USD' ); ?>">		
								<input type="hidden" name="return" value="<?php echo add_query_arg( 'processed', 'yes', get_permalink( get_the_ID() ) ); ?>">		
								<input type="hidden" name="notify_url" value="<?php echo get_template_directory_uri(); ?>/inc/ipn.php">

								<span class="lb-overlay-form-amount-ccode"><?php echo ot_get_option( $dd_sn . 'paypal_currency_char', '$' ); ?></span>
								<span class="lb-overlay-form-amount-cname"><?php echo ot_get_option( $dd_sn . 'paypal_currency', 'USD' ); ?></span>

						</div><!-- .lb-overlay-form-amount -->

						<div class="lb-overlay-form-submit">

							<a href="#"><?php _e( 'DONATE VIA PAYPAL', 'dd_string' ); ?></a>

						</div><!-- .lb-overlay-form-submit -->

					</form>

				</div><!-- .lb-overlay-form -->

			</div><!-- .lb-overlay-inner -->

		</div><!-- .lb-overlay -->

	<?php endif; ?>

	<div id="lb-overlay-sign-in" class="lb-overlay">

		<div class="lb-overlay-inner">

			<div class="lb-overlay-title"><?php echo ot_get_option( $dd_sn . 'signin_overlay_title', 'Change this in Theme Options' ); ?></div>

			<div class="lb-overlay-descr"><?php echo ot_get_option( $dd_sn . 'signin_overlay_description', 'Change this in Theme Options' ); ?></div>

			<div class="lb-overlay-form">

				<form method="post" id="dd-login-submit-form">

					<?php if ( isset( $_GET['dslc_login_u_error'] ) || isset( $_GET['dslc_login_p_error'] ) ) : ?>

						<div class="lb-overlay-form-errors">
							<ul>
								<?php if ( isset( $_GET['dslc_login_u_error'] ) && $_GET['dslc_login_u_error'] == 'notset' ) : ?>
									<li><?php _e( 'No username was supplied.', 'dd_string' ); ?></li>
								<?php endif; ?>
								<?php if ( isset( $_GET['dslc_login_u_error'] ) && $_GET['dslc_login_u_error'] == 'wrong' ) : ?>
									<li><?php _e( 'The user does not exist.', 'dd_string' ); ?></li>
								<?php endif; ?>
								<?php if ( isset( $_GET['dslc_login_p_error'] ) && $_GET['dslc_login_p_error'] == 'notset' ) : ?>
									<li><?php _e( 'No password was supplied.', 'dd_string' ); ?></li>
								<?php endif; ?>
								<?php if ( isset( $_GET['dslc_login_p_error'] ) && $_GET['dslc_login_p_error'] == 'wrong' ) : ?>
									<li><?php _e( 'Wrong password.', 'dd_string' ); ?></li>
								<?php endif; ?>
							</ul>
						</div>

					<?php endif; ?> 

					<div class="lb-overlay-form-user">
						<input type="text" value="" name="dd_login_user" placeholder="<?php _e( 'USERNAME', 'dd_string' ); ?>">
					</div><!-- .lb-overlay-form-user -->

					<div class="lb-overlay-form-pass">
						<input type="password" value="" name="dd_login_pass" placeholder="<?php _e( 'PASSWORD', 'dd_string' ); ?>">
					</div><!-- .lb-overlay-form-pass -->

					<div class="lb-overlay-form-submit">

						<a href="#" class="dd-login-submit-hook"><?php _e( 'SIGN IN', 'dd_string' ); ?></a>
						<input type="submit" id="dd-login-submit">

					</div><!-- .lb-overlay-form-submit -->

					<input type="hidden" name="dd_login_redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
					<input type="hidden" name="dd_login_nonce" value="<?php echo wp_create_nonce('dd_login_nonce'); ?>"/>

				</form>

			</div><!-- .lb-overlay-form -->

		</div><!-- .lb-overlay-inner -->

	</div><!-- #lb-overlay-sign-in -->

	<?php wp_footer(); ?>

	<?php echo ot_get_option( $dd_sn . 'analytics', ''); ?>

</body>
</html>