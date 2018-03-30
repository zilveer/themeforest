<?php
/**
 * The default template for displaying staff content
 *
 * @package WordPress
 * @subpackage Rive
 */

$m = 0;

// Get paypal parameters
if (TESTENVIRONMENT === TRUE) {
	$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
} else {
	$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
}

// Which payment gateway to use?
$payment_gateway      = get_option('ch_payment_gateway') ? get_option('ch_payment_gateway') : 'paypal';

$paypal_email         = get_option('ch_paypal_email');
$paypal_thankyou      = get_option('ch_paypal_thankyou');
$paypallogo           = get_option('ch_paypallogo') ? get_option('ch_paypallogo') : '';
$paypal_currency_code = get_option('ch_paypal_currency_code');
$currency_sign        = get_option('ch_currency_sign') ? get_option('ch_currency_sign') : '$';

// Authorize.net payment gateway configuration
$auhorize_api_login_id     = get_option('ch_api_login_id') ? get_option('ch_api_login_id') : '';
$authorize_transaction_key = get_option('ch_transaction_key') ? get_option('ch_transaction_key') : '';

if ( !empty($_GET['amount']) ) {
	$amount = $_GET['amount'];
} else {
	$amount = '';
}

?>
<div class="cause-wrapper">
	<?php

	if ( $payment_gateway == 'authorizenet' && !empty($_POST['authorizenet_process']) ) { ?>
		<h1><?php _e( 'Processing...', 'ch' ); ?></h1>
		<?php require_once(CH_HOME . '/authorizenet_submit.php'); ?>
		<div class="clearfix"></div>
	<?php
	} else {

	/* Start the Loop */
	while ( have_posts() ) { the_post();
		global $ch_from_search;
		$show_sep = false;
		$style    = '';
		$clear    = '';

		// Determine staff image size
		if ($ch_from_search) {
			if (LAYOUT == 'sidebar-no' || $ch_from_search) {
				$img_width  = '326';
				$img_height = '245';
			}
			$clear = ' style="float: none;"';
			$style = ' style="width: ' . $img_width . 'px; height: ' . $img_height . 'px;"';
		} else {
			$img_width  = '326';
			$img_height = '245';
			$top_left   = 'style="top: 37%; left: 41%;"';
		}
		?>
		<div class="cause<?php if ( $m == 0 || ( ( $m != 0 ) && $m % 2 == 0 && LAYOUT == 'sidebar-no' ) || ( ( $m != 0 ) && $m % 2 == 0 && LAYOUT != 'sidebar-no' ) ) echo ' no_left_margin'; ?>">
			<?php
			$percents                      = 0;
			$how_many_donations_are_needed = (get_post_meta( get_the_id(), '_how_many_donations_are_needed', true )) ? get_post_meta( get_the_id(), '_how_many_donations_are_needed', true ) : 0;
			$current_fundrainers           = (get_post_meta( get_the_id(), '_fundraisers', true )) ? get_post_meta( get_the_id(), '_fundraisers', true ) : 0;
			$current_donations             = (get_post_meta( get_the_id(), '_donations_so_far', true )) ? get_post_meta( get_the_id(), '_donations_so_far', true ) : 0;
			$custom_paypal_email           = (get_post_meta( get_the_id(), '_custom_paypal_email', true )) ? get_post_meta( get_the_id(), '_custom_paypal_email', true ) : '';

			// If not empty cause specific paypal email then use it instead
			if ( !empty($custom_paypal_email) ) {
				$paypal_email = $custom_paypal_email;
			}

			if ( $how_many_donations_are_needed > 0 ) {
				$percents = number_format( ( $current_donations / $how_many_donations_are_needed ) * 100, 0 );
			}

			// Cause image
			$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'gallery-large');
			if (isset($img[0])) {
				if ( LAYOUT != 'sidebar-no' ) {
					$image_span_size = ' span6';
					$content_span_size = ' span9';
				} else {
					$image_span_size = ' span5';
					$content_span_size = ' span6';
				}
			?>
			<div class="cause-image<?php echo $image_span_size; ?>">
				<a class="size-thumbnail no_thickbox" href="<?php echo get_permalink(); ?>">
					<img src="<?php echo $img[0]; ?> "<?php echo $style; ?> class="image-with-border" alt="" />
					<div class="border" style="width: <?php echo $img_width; ?>px; height: <?php echo $img_height + 4;?>px;">
						<div class="open"></div>
					</div>
				</a>
			</div>
			<?php
			}
			?>
			<div class="cause-content<?php echo $content_span_size; ?>">
				<div class="item-title-bg">
					<h2 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="clearfix"></div>
				</div>
				<div class="cause-text">
					<?php
						the_content();
					?>
				</div>
				<div class="donation-container">
					<div class="donation-button">
						<?php if ( $payment_gateway == 'paypal' ) { ?>
							<form action="<?php echo $paypal_url; ?>" method="post">
								<input type="hidden" name="cmd" value="_donations">
								<input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
								<input type="hidden" name="item_name" value="Donate to the <?php echo get_the_title(); ?> cause">
								<input type="hidden" name="no_shipping" value="0">
								<input type="hidden" name="no_note" value="1">
								<input type="hidden" name="currency_code" value="<?php echo $paypal_currency_code; ?>">
								<input type="hidden" name="return" value="<?php echo get_permalink( $paypal_thankyou ); ?>">
								<input type="hidden" name="notify_url" value="<?php echo home_url(); ?>">
								<input type="hidden" name="image_url" value="<?php echo $paypallogo; ?>">
								<input type="hidden" name="custom" value="<?php echo get_the_ID(); ?>">
								<div class="input-append">
									<input id="appendedPrependedDropdownButton" class="donate-input-text" name="amount" value="<?php echo $amount; ?>" type="text" placeholder="">
									<input type="submit" class="btn btn-primary" type="button" value="<?php _e('DONATE', 'ch'); ?>">
								</div>
							</form>
						<?php } elseif ( $payment_gateway == 'authorizenet' ) {	?>
							<form action="" method="post">
								<input type="hidden" name="item_description" value="Donate to the <?php echo get_the_title(); ?> cause">
								<input type="hidden" name="authorizenet_process" value="process">
								<input type="hidden" name="custom" value="<?php echo get_the_ID(); ?>">
								<input type="hidden" name="return" value="<?php echo get_permalink( $paypal_thankyou ); ?>">
								<div class="input-append">
									<input id="appendedPrependedDropdownButton" class="donate-input-text" name="amount" value="<?php echo $amount; ?>" type="text" placeholder="">
									<input type="submit" class="btn btn-primary" type="button" value="<?php _e('DONATE', 'ch'); ?>">
								</div>
							</form>
						<?php } ?>
					</div>
					<div class="donated-so-far"><?php echo $currency_sign; ?><?php echo $current_donations; ?></div>
					<div class="donated-so-far-percents"><?php echo $percents; ?>%</div>
					<div class="clearfix"></div>
					<div class="progress">
						<div class="bar" style="width: <?php echo $percents; ?>%;"></div>
					</div>
					<div class="clearfix"></div>
					<div class="fundraisers"><?php echo $current_fundrainers; ?> <?php _e( 'fundraisers', 'ch' ); ?></div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div><!--end of cause-->
		<?php
		$m++;

		if ( ( $m != 1 ) && $m % 2 == 0 && LAYOUT == 'sidebar-no' ) {
			echo '
			<div class="clearfix"></div>';
		} elseif ( ( $m != 1 ) && $m % 3 == 0 && LAYOUT != 'sidebar-no' ) {
			echo '
			<div class="clearfix"></div>';
		}
		?>
	<?php }
	}
	?>
	<div class="clearfix"></div>
</div>