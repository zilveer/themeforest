<?php
/**
 * The template for displaying the footer.
 *
 * @package smartfood
 */
?>

<section id="footer-booking">
	<div class="container-fluid">
		<div class="row clearfix">
			<div class="col-md-3 col-sm-12 col-xs-12 column" id="booking-about" data-bg="<?php echo esc_url(tdp_option('footer_booking_bg', false,'url'));?>">
				
				<div class="footer-overlay"></div>
				<div class="footer-about">
					<?php if(tdp_option('display_logo_in_footer')) { 
						tdp_logo(false);
					} ?>

					<?php if(tdp_option('footer_about_title')) : ?>
					<h2><?php echo esc_attr( do_shortcode( tdp_option('footer_about_title') ) );?></h2>
					<?php endif; ?>

					<p><?php echo wp_kses( tdp_option('footer_about'), array(
						    'a' => array(
						        'href' => array(),
						        'title' => array()
						    ),
						    'br' => array(),
						    'p' => array(),
						    'em' => array(),
						    'strong' => array(),
					) ); ?></p>

					<?php the_widget( 'TDP_Social_Icons', array('title' => __('Connect with us', 'smartfood')) ); ?>

					<div class="copyright-notice">
						<p><?php echo wp_kses( tdp_option('copyright_notice'), array(
							    'a' => array(
							        'href' => array(),
							        'title' => array()
							    ),
							    'br' => array(),
							    'em' => array(),
							    'strong' => array(),
						) ); ?></p>
					</div>

				</div>

			</div>

			<div class="col-md-3 col-sm-12 col-xs-12 column" id="booking-widgets-area">
				<?php dynamic_sidebar( 'footer_booking_widget_area' ); ?>
			</div>

			<div class="col-md-6 col-sm-12 col-xs-12 column" id="booking-area">
				<?php the_widget( 'WPRM_Booking_Form', array('title' => __('Make A Reservation', 'smartfood')) ); ?>
			</div>

		</div>
	</div>
</section>