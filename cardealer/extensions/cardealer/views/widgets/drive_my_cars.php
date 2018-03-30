<?php
if (!defined('ABSPATH')) die('No direct access allowed');

if (isset($GLOBALS['current_page']) && $GLOBALS['current_page'] === 'user-cars') {
	global $current_user;
	get_currentuserinfo();
	?>

	<div class="widget widget_drive_cars">
		<div class="boxed-widget">
			<?php /*if ($instance['title'] != '') { ?>
        <h3 class="widget-head"><?php echo $instance['title']; ?></h3>
    <?php }*/
			?>

			<h3 class="widget-title"><?php _e('Howdy', 'cardealer'); ?> <?php echo $current_user->display_name; ?></h3>

			<?php
			$upgrade_page_link = TMM_Helper::get_permalink_by_lang( TMM::get_option('upgrade_status_page', TMM_APP_CARDEALER_PREFIX) );
			$user_profile_page = TMM_Helper::get_permalink_by_lang( TMM::get_option('user_profile_page', TMM_APP_CARDEALER_PREFIX) );
			$user_cars_page = TMM_Helper::get_permalink_by_lang( TMM::get_option('user_cars_page', TMM_APP_CARDEALER_PREFIX) );
			$user_add_new_car = TMM_Helper::get_permalink_by_lang( TMM::get_option('user_add_new_car', TMM_APP_CARDEALER_PREFIX) );
			?>

			<section class="boxed-entry clearfix">

				<?php if (!empty($instance['show_links'])) { ?>
				<ul class="users_links">

					<?php if (!empty($user_profile_page)) { ?>
						<li>
							<a href="<?php echo $user_profile_page ?>"><?php _e("My profile", 'cardealer') ?></a>
						</li>
					<?php } ?>

					<?php if (!empty($user_cars_page)) { ?>
						<li>
							<a href="<?php echo $user_cars_page ?>"><?php _e("My Cars", 'cardealer') ?></a>
						</li>
					<?php } ?>

					<?php if (!empty($user_add_new_car)) { ?>
						<li>
							<a href="<?php echo $user_add_new_car ?>"><?php _e("Add new car", 'cardealer') ?></a>
						</li>
					<?php } ?>

					<?php if (!empty($upgrade_page_link)) { ?>
						<li>
							<a type="button orange" href="<?php echo $upgrade_page_link; ?>"><?php _e('Upgrade Status', 'cardealer'); ?></a>
						</li>
					<?php } ?>

				</ul>
				<?php } ?>

				<?php if (!empty($instance['show_quick_statistic'])) { ?>

				<?php if (!user_can(get_current_user_id(), 'manage_options')) { ?>

					<?php $options = TMM_Cardealer_User::get_default_user_role_options(get_current_user_id());
					if (!isset($options['max_cars'])) {
						$options['max_cars'] = 0;
					}
					?>

					<div class="section-options clearfix">

						<div class="option-third">

							<h6><?php _e('File space (MB)', 'cardealer'); ?>:</h6>
							<?php
							$user_file_space = TMM_Ext_PostType_Car::get_user_file_space(get_current_user_id());
							$free_size_left = size_format( wp_convert_hr_to_bytes( $user_file_space['size_left'] ), 2 );
							?>

							<ul class="list clearfix">
								<li class=""><?php _e('Total', 'cardealer'); ?>:
									<span><?php echo size_format( wp_convert_hr_to_bytes( $user_file_space['user_file_max_space'] ), 2 ); ?></span>
								</li>
								<li class=""><?php _e('Used', 'cardealer'); ?>:
									<span><?php echo size_format( wp_convert_hr_to_bytes( $user_file_space['user_file_space'] ), 2 ); ?></span>
								</li>
								<li class=""><?php _e('Free', 'cardealer'); ?>:
									<span><?php echo $free_size_left > 0 ? $free_size_left : '0'; ?></span>
								</li>
							</ul>

						</div>

						<div class="option-third">

							<h6><?php _e('Quick statistic', 'cardealer'); ?>:</h6>
							<?php
							$user_post_count = TMM_Cardealer_User::count_users_cars(get_current_user_id());
							$free_cars_left = $options['max_cars'] - $user_post_count;
							?>

							<ul class="list clearfix">
								<li class=""><?php _e('Total', 'cardealer'); ?>:
									<span><?php echo $options['max_cars']; ?></span></li>
								<li class=""><?php _e('Used', 'cardealer'); ?>:
									<span><?php echo $user_post_count; ?></span></li>
								<li class=""><?php _e('Free', 'cardealer'); ?>:
									<span><?php echo($free_cars_left > 0 ? $free_cars_left : '0'); ?></span></li>
							</ul>

						</div>

						<div class="option-third">

							<h6><?php _e('Featured statuses left', 'cardealer'); ?>:</h6>

							<ul class="list clearfix">
								<li class=""><?php _e('Free', 'cardealer'); ?>:
									<span><?php echo TMM_Cardealer_User::get_user_free_features_count(get_current_user_id()) ?></span>
								</li>
								<li class=""><?php _e('Activated', 'cardealer'); ?>:
									<span><?php echo TMM_Cardealer_User::get_user_activated_features_count(get_current_user_id()) ?></span>
								</li>
							</ul>
							<?php
							$features_packets = TMM_Cardealer_User::get_features_packets();
							if (!empty($features_packets) && !empty($upgrade_page_link)) {
								?>
								<ul class="list clearfix">
									<li class=""><a class="button orange" href="<?php echo $upgrade_page_link; ?>#featured_block"><?php _e('Get More', 'cardealer'); ?></a></li>
								</ul>
							<?php
							}
							?>
						</div>
					</div>

				<?php } else { ?>

					<div class="option-third">
						<h6><?php _e('Quick statistic', 'cardealer'); ?>:</h6>
						<?php
						$user_post_count = TMM_Cardealer_User::count_users_cars(get_current_user_id());
						?>

						<ul class="list clearfix">
							<li class=""><?php _e('Total', 'cardealer'); ?>:
								<span><?php echo $user_post_count; ?></span></li>
							<li class=""><?php _e('Featured', 'cardealer'); ?>:
								<span><?php echo TMM_Cardealer_User::get_user_activated_features_count(get_current_user_id()) ?></span>
							</li>
						</ul>
					</div>

				<?php } ?>

				<?php } ?>

				<?php if (!empty($instance['show_dealer_status'])) { ?>
				
				<div class="option-third">
					<h6><?php _e('Dealer status:', 'cardealer'); ?></h6>
					<ul class="list clearfix">

						<?php
						if (!user_can(get_current_user_id(), 'manage_options')) {
							$expires_date = TMM_Cardealer_User::get_user_packet_exp_date(get_current_user_id());
							$expires_str = '';

							if ($expires_date > 0) {		
								$now = time();
								$time_diff = $expires_date - $now;

								if($time_diff > 0){
									if( ($time_diff/60/60) < 1 && wp_next_scheduled('enduser_packet_cars_sheduler') ){
										$expires_date = wp_next_scheduled('enduser_packet_cars_sheduler');
									}
									$expires_str = human_time_diff( $now, $expires_date ) . ' left';
								}
							}
							?>
							<li class="">
								<?php
								_e($options['name'], 'cardealer');
								if ($expires_str !== '') {
									_e(' (' . $expires_str . ')', 'cardealer');
								}
								?>
							</li>
						<?php
						} else {
							?>
							<li class=""><?php _e('Super Dealer (continuous lifetime)', 'cardealer'); ?></li>
						<?php
						}
						?>

					</ul>
				</div>

				<?php } ?>

				<?php if (!empty($instance['show_loan_rate'])) {
					$dealer_loan_rate = get_user_meta(get_current_user_id(), 'cardealer_loan_rate', 1);
					?>

				<div class="option-third">
					<h6><?php _e('Your loan rate:', 'cardealer'); ?></h6>
					<ul class="list clearfix">
						<li class="">
							<input type="text" value="<?php echo $dealer_loan_rate ?>" style="width: 75%;" />
							<a id="set_dealer_loan_rate" class="button orange" href="#" style="float: right;"><?php _e('Set', 'cardealer'); ?></a>
						</li>

					</ul>
				</div>

				<?php } ?>

				<div class="clear"></div>

			</section>
		</div>
	</div>

<?php } ?>