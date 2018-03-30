<?php if (!defined('ABSPATH')) die('No direct access allowed');
/*
  Template Name: Account Status Upgrade
 */


if (!is_user_logged_in()) {
	$redirect_to = get_permalink( TMM::get_option('user_login_page', TMM_APP_CARDEALER_PREFIX) );
	if (TMM::get_option('upgrade_status_page', TMM_APP_CARDEALER_PREFIX)) {
		$redirect_to .= '?redirect=' . urlencode( get_permalink( TMM::get_option('upgrade_status_page', TMM_APP_CARDEALER_PREFIX) ) );
	}
	wp_redirect($redirect_to, 302);
	return;
}

get_header();
$user_id = get_current_user_id();
$user_role = TMM_Cardealer_User::get_default_user_role_options($user_id);
$roles = TMM_Cardealer_User::get_user_roles();
global $post;

$count = count($roles);
$col_class = 'col-md-3';

if ($count === 1) {
	$col_class = 'col-md-12';
} else if ($count === 2) {
	$col_class = 'col-md-6';
} else if ($count === 3) {
	$col_class = 'col-md-4';
} else if ($count === 4) {
	$col_class = 'col-md-3';
} else if ($count === 6) {
	$col_class = 'col-md-2';
}
?>

<?php get_template_part('content', 'header'); ?>

<?php if (!empty($roles) && count($roles) > 1): ?>

	<section class="pricing-table <?php echo $count ?> row">

		<?php foreach ($roles as $key => $role) : ?>

			<?php
			$is_current_role = false;
			if ($user_role['key'] == $key) {
				$is_current_role = true;
			}
			?>

			<div class="<?php echo $col_class; ?><?php if ($is_current_role): ?> featured<?php endif; ?>">

				<header class="pricing-header">
					<h2 class="title"><?php echo $role['name'] ?></h2>
				</header>
				<!--/ .header -->

				<div class="heading">

					<dl>
						<?php if (TMM::get_option( 'car_price_symbol_pos', TMM_APP_CARDEALER_PREFIX ) === 'left') { ?>
							<dt>
								<span class="currency"><?php echo TMM_Ext_Car_Dealer::$default_currency['symbol']; ?></span>
							</dt>
						<?php } ?>

						<?php $split_price = explode('.', $role['packet_price']); ?>

						<?php foreach ($split_price as $k => $text) : ?>
							<dd>
								<?php if ($k == 0) { ?>
									<span
										class="int <?php if (strlen($text) > 2 && strlen($text) < 4): ?>size-medium<?php elseif (strlen($text) > 3): ?> size-small<?php endif; ?>"><?php echo $text ?></span>
								<?php } else { ?>
									<span data-month=""
										  class="sup <?php if (strlen($text) == 3): ?>size-medium<?php endif; ?>"><?php echo $text ?></span>
								<?php } ?>
							</dd>
						<?php endforeach; ?>

						<?php if (TMM::get_option( 'car_price_symbol_pos', TMM_APP_CARDEALER_PREFIX ) === 'right') { ?>
							<dt>
								<span class="currency"><?php echo TMM_Ext_Car_Dealer::$default_currency['symbol']; ?></span>
							</dt>
						<?php } ?>
					</dl>
					<?php do_action('tmm_paypal_default_currency', $role['packet_price']); ?>

				</div>
				<!--/ .price-->

				<ul class="features">
					<li><span><?php _e('Max Cars', 'cardealer'); ?>: <?php echo $role['max_cars']; ?></span></li>
					<li><span><?php _e('Disk Storage', 'cardealer'); ?>
							: <?php echo $role['max_images_size']; ?> <?php _e('MB', 'cardealer'); ?></span></li>
					<li><span><?php _e('Featured Cars', 'cardealer'); ?>
							: <?php echo $role['features_cars_count']; ?></span></li>
					<li><span><?php _e('Account Life Time', 'cardealer'); ?>
							: <?php echo($role['life_period'] > 0 ? $role['life_period'] : '&#8734;'); ?> <?php _e('days', 'cardealer'); ?></span>
					</li>
				</ul>
				<!-- .features -->

				<footer class="footer">
					<?php
					$is_free = false;
					if ($split_price[0] == 0 && (!isset( $split_price[1]) || $split_price[1] == 0 )) {
						$is_free = true;
					}
					if ($is_free) {
						?>
						<h3><?php _e('Free Plan', 'cardealer'); ?></h3>
					<?php
					} else if (!$is_free && !$is_current_role) {
						echo do_shortcode('[paypal packet_id="' . $key . '" button_style="checkout"]');
					} else {
						?>
						<div style="height: 26px;"></div>
					<?php
					}
					?>
				</footer>
				<!--/.footer -->

			</div>

		<?php endforeach; ?>
	</section>

<?php endif; ?>

<?php
$features_packets = TMM_Cardealer_User::get_features_packets();

$count = count($features_packets);
$col_class = 'col-md-3';

if ($count === 1) {
	$col_class = 'col-md-12';
} else if ($count === 2) {
	$col_class = 'col-md-6';
} else if ($count === 3) {
	$col_class = 'col-md-4';
} else if ($count === 4) {
	$col_class = 'col-md-3';
} else if ($count === 6) {
	$col_class = 'col-md-2';
}
?>

<?php if (!empty($features_packets)): ?>
	<div id="featured_block">

		<h3 class="section-title"><?php _e('Featured Cars Bundles', 'cardealer'); ?></h3>

		<section class="pricing-table <?php echo $count ?> row">
			<?php foreach ($features_packets as $key => $packet) : ?>

				<div class="<?php echo $col_class; ?><?php if ($packet['featured'] == 1): ?> featured<?php endif; ?>">

					<header class="pricing-header">
						<h2 class="title"><?php echo $packet['name'] ?></h2>
					</header>
					<!--/ .header -->

					<div class="heading">

						<dl>
							<?php if (TMM::get_option( 'car_price_symbol_pos', TMM_APP_CARDEALER_PREFIX ) === 'left') { ?>
							<dt>
								<span class="currency"><?php echo TMM_Ext_Car_Dealer::$default_currency['symbol']; ?></span>
							</dt>
							<?php } ?>

							<?php $split_price = explode('.', $packet['packet_price']); ?>

							<?php foreach ($split_price as $k => $text) : ?>
								<dd>
									<?php if ($k < 1): ?>
										<span
											class="int <?php if (strlen($text) > 2 && strlen($text) < 4): ?>size-medium<?php elseif (strlen($text) > 3): ?> size-small<?php endif; ?>"><?php echo $text ?></span>
									<?php else: ?>
										<span data-month=""
											  class="sup <?php if (strlen($text) == 3): ?>size-medium<?php endif; ?>"><?php echo $text ?></span>
									<?php endif; ?>
								</dd>
							<?php endforeach; ?>

							<?php if (TMM::get_option( 'car_price_symbol_pos', TMM_APP_CARDEALER_PREFIX ) === 'right') { ?>
							<dt>
								<span class="currency"><?php echo TMM_Ext_Car_Dealer::$default_currency['symbol']; ?></span>
							</dt>
							<?php } ?>
						</dl>
						<?php do_action('tmm_paypal_default_currency', $packet['packet_price']); ?>

					</div>
					<!--/ .price-->

					<ul class="features">
						<li><span><?php _e('Count', 'cardealer'); ?>: <?php echo $packet['count']; ?></span></li>
						<li><span><?php _e('Life Time', 'cardealer'); ?>
								: <?php echo($packet['life_period'] > 0 ? $packet['life_period'] : '&#8734;'); ?> <?php _e('days', 'cardealer'); ?></span>
						</li>
					</ul>
					<!-- .features -->

					<footer class="footer">
						<?php echo do_shortcode('[paypal packet_id="' . $key . '" button_style="checkout"]'); ?>
					</footer>
					<!--/.footer -->


				</div>

			<?php endforeach; ?>
		</section>

	</div>
<?php endif; ?>
<?php get_footer(); ?>

