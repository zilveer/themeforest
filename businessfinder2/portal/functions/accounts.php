<?php
function aitInitCheckPackageUserExpirations(){
	if( !wp_next_scheduled( 'ait_check_package_user_expirations' ) ) {
		wp_schedule_event( time(), 'daily', 'ait_check_package_user_expirations' );
	}
}
add_action( 'wp', 'aitInitCheckPackageUserExpirations' );

function aitCheckPackageUserExpirations(){
	// daily check for expiration of users
	// -> iterate through all registered users
	// -> send mail if the user package is about to expire
	$themeOptions = aitOptions()->getOptionsByType('theme');
	$notification = array(
		"enabled" => $themeOptions['packages']['expirationNotificationEnable'],
		"time" => $themeOptions['packages']['expirationNotificationTime'],
		"subject" => AitLangs::getCurrentLocaleText($themeOptions['packages']['expirationNotificationSubject']),
		"message" => AitLangs::getCurrentLocaleText($themeOptions['packages']['expirationNotificationMessage']),
	);
	$packages = new ThemePackages();
	foreach(get_users() as $user){
		// do the loop only for users with package type role
		$role = reset($user->roles);
		if(isThemeUserRole($role)){
			$packageOptions = $packages->getPackageBySlug($role)->getOptions();
			if($packageOptions['expirationLimit'] != 0){
				$daysLeft = aitGetPackageUserDaysLeft($user->data->ID, $packageOptions['expirationLimit']);
				if($daysLeft <= 0){
					aitSetPackageUserExpired($user->data->ID);
					wp_mail( $user->data->user_email, __("CityGuide: Account Disabled", 'ait-admin'), "" );	// tu to chce link do admina, pripadne rovno na review accountu
				} elseif ($notification['enabled'] && $daysLeft == $notification['time']) {
					// used keywords {username}, {daysleft}
					$notification['message'] = str_replace("{username}", $user->data->display_name, $notification['message']);
					$notification['message'] = str_replace("{daysleft}", $daysLeft, $notification['message']);
					wp_mail( $user->data->user_email, "Cityguide: ".$notification['subject'], $notification['message'] );
				} else {
					// nothing here
					//wp_mail( $user->data->user_email, "CityGuide: Cron Run", "Nothing Done" );
				}
			}
		}
	}
}
add_action( 'ait_check_package_user_expirations', 'aitCheckPackageUserExpirations' );

function aitGetPackageUserDaysLeft($userId, $packageExpirationDays){
	// check how many days till user account expires
	// userId must be a user with "cityguide_" user role
	// return days | 0 -> expired
	$result = 0;
	$user_meta = get_user_meta( $userId, 'package_activation_time', false );
	$user_meta = reset($user_meta);

	$time_package_seconds = $packageExpirationDays * 60 * 60 * 24;					// in seconds

	$time_current = time();															// in seconds
	$time_user = $user_meta['time']; 												// in seconds

	$time_diff_seconds = $time_package_seconds - ($time_current - $time_user);		// in seconds
	$time_diff_days = ceil($time_diff_seconds / 60 / 60 / 24);						// in days

	return $time_diff_days;
}

function aitSetPackageUserActivationTime($userId, $role){
	if(isThemeUserRole($role)){
		update_user_meta( $userId, 'package_activation_time', array( 'role' => $role, 'time' => time() ) );
		update_user_meta( $userId, 'package_name', $role );
	}

}
add_action('set_user_role', 'aitSetPackageUserActivationTime',1,2);

function aitSetPackageUserExpired($userId){
	// set the account to inactive state
	// -> set role to subscriber
	// -> disable all posts by this author -> set them to draft
	global $wpdb;
	$user = new WP_User($userId);
	$user->set_role('subscriber');
	$wpdb->query($wpdb->prepare( "UPDATE $wpdb->posts SET post_status = 'draft' WHERE post_author = %d AND post_status = 'publish'", intval($userId)) );
}

function aitSetPackageUserRenewed($userId, $role){
	// set the account to active state
	// -> set role to package role
	// -> disable all posts by this author -> set them to published
	global $wpdb;
	$user = new WP_User($userId);
	//if(isThemeUserRole($role)){
	//	update_user_meta( $userId, 'package_activation_time', array( 'role' => $role, 'time' => time() ) );
	//} else {
		$user->set_role($role);
	//}
	$wpdb->query($wpdb->prepare( "UPDATE $wpdb->posts SET post_status = 'publish' WHERE post_author = %d AND post_status = 'draft'", intval($userId)) );
}

// limit package items
function aitCheckItemsLimit() {
	global $pagenow, $current_user;
	if($pagenow == 'post-new.php'){
		if(!empty($_REQUEST['post_type']) && $_REQUEST['post_type'] == "ait-item"){
			$role = reset($current_user->roles);
			if(isThemeUserRole($role)){
				$avalaible_packages = new ThemePackages();
				$package_options = $avalaible_packages->getPackageBySlug($role)->getOptions();
				if(intval($package_options['maxItems']) > 0){
					$query = new WP_Query(array('post_type' => "ait-item", 'author' => $current_user->ID));
					if(count($query->posts) >= intval($package_options['maxItems'])){
						wp_redirect( admin_url( 'edit.php?post_type=ait-item&ait-notice=item-limit-exceeded' ) ); exit;
					}
				} else {
					// cannot add item
					wp_redirect( admin_url( 'edit.php?post_type=ait-item&ait-notice=item-limit-exceeded' ) ); exit;
				}
			}
		}
	}
}
add_action( "admin_init", 'aitCheckItemsLimit' );

function aitCheckUntrashedItemsLimit($postId){
	global $current_user;
	$post = get_post($postId);
	if(isset($post)){
		if('ait-item' == $post->post_type) {
			$role = reset($current_user->roles);
			if(isThemeUserRole($role)){
				$avalaible_packages = new ThemePackages();
				$package_options = $avalaible_packages->getPackageBySlug($role)->getOptions();
				if(intval($package_options['maxItems']) > 0){
					$query = new WP_Query(array('post_type' => "ait-item", 'author' => $current_user->ID));
					if(count($query->posts) >= intval($package_options['maxItems'])){
						wp_redirect( admin_url( 'edit.php?post_type=ait-item&ait-notice=item-limit-exceeded' ) ); exit;
					}
				} else {
					// cannot add item
					wp_redirect( admin_url( 'edit.php?post_type=ait-item&ait-notice=item-limit-exceeded' ) ); exit;
				}
			}
		}
	}
}
add_action( 'untrash_post','aitCheckUntrashedItemsLimit');

// limit package events
function aitCheckEventsLimit() {
	global $pagenow, $current_user;
	if($pagenow == 'post-new.php'){
		if(!empty($_REQUEST['post_type']) && $_REQUEST['post_type'] == "ait-event-pro"){
			$role = reset($current_user->roles);
			if(isThemeUserRole($role)){
				$avalaible_packages = new ThemePackages();
				$package_options = $avalaible_packages->getPackageBySlug($role)->getOptions();

				if(intval($package_options['maxEvents']) > 0){
					$query = new WP_Query(array('post_type' => "ait-event-pro", 'author' => $current_user->ID));
					if(count($query->posts) >= intval($package_options['maxEvents'])){
						wp_redirect( admin_url( 'edit.php?post_type=ait-event-pro&ait-notice=event-limit-exceeded' ) ); exit;
					}
				} else {
					// cannot add event
					wp_redirect( admin_url( 'edit.php?post_type=ait-event-pro&ait-notice=event-limit-exceeded' ) ); exit;
				}
			}
		}
	}
}
add_action( "admin_init", 'aitCheckEventsLimit' );

function aitCheckUntrashedEventsLimit($postId){
	global $current_user;
	$post = get_post($postId);
	if(isset($post)){
		if('ait-event-pro' == $post->post_type) {
			$role = reset($current_user->roles);
			if(isThemeUserRole($role)){
				$avalaible_packages = new ThemePackages();
				$package_options = $avalaible_packages->getPackageBySlug($role)->getOptions();
				if(intval($package_options['maxEvents']) > 0){
					$query = new WP_Query(array('post_type' => "ait-event-pro", 'author' => $current_user->ID));
					if(count($query->posts) >= intval($package_options['maxEvents'])){
						wp_redirect( admin_url( 'edit.php?post_type=ait-event-pro&ait-notice=event-limit-exceeded' ) ); exit;
					}
				} else {
					// cannot add item
					wp_redirect( admin_url( 'edit.php?post_type=ait-event-pro&ait-notice=event-limit-exceeded' ) ); exit;
				}
			}
		}
	}
}
add_action( 'untrash_post','aitCheckUntrashedEventsLimit');


function showUserAccountInformation($user){
	$themeOptions = aitOptions()->getOptionsByType('theme');
	$themeConfig = aitConfig()->getFullConfig('theme');
	$packages = new ThemePackages();
	$role = reset($user->roles);

	$paymentGates = $themeOptions['payments'];
	unset($paymentGates['currency']);
	$paymentGatesConfig = $themeConfig['payments']['@options'][1];
	$paymentGatesInstalled = array();
	$paymentGatesEnabled = array();

	foreach($paymentGates as $name => $value){
		if($paymentGatesConfig[$name]['controller'] == "none" || class_exists($paymentGatesConfig[$name]['controller'])){
			$paymentGatesInstalled[$name] = $value;
		}
	}

	foreach ($paymentGatesInstalled as $name => $value) {
		if((bool)$value == true){
			$paymentGatesEnabled[$name] = $value;
		}
	}

	if(isThemeUserRole($role)){
		$packageOptions = $packages->getPackageBySlug($role)->getOptions();
		$daysLeft = 0;
		if($packageOptions['expirationLimit'] != 0){
			$daysLeft = aitGetPackageUserDaysLeft($user->data->ID, $packageOptions['expirationLimit']);
		}
		/*$payment = null;
		if(class_exists('AitPaypal')){
			$paypal = AitPaypal::getInstance();
			$cls = explode('-', $packageOptions['payment']);
			$clsid = $cls[2];
			$payment = $paypal->payments[$clsid];
		}*/
		// single -> pay
		// recurring -> update
		//if($payment != null){
			// plugin is active


		?>
		<h3><?php _e('Account', 'ait-admin') ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="account_type"><?php _e('Type', 'ait-admin') ?></label></th>
				<td><input type="text" name="account_type" value="<?php echo $packages->getPackageBySlug($role)->getName() ?>" class="regular-text" disabled="disabled" /></td>
			</tr>

			<tr>
				<th><label for="account_expiration"><?php _e('Expiration in days', 'ait-admin') ?></label></th>
				<td><input type="text" name="account_expiration" value="<?php echo $daysLeft ?>" class="regular-text" disabled="disabled" /></td>
			</tr>

			<?php if(count($paymentGatesEnabled) > 0){ ?>
			<tr>
				<th><label for="account_renew_payment"><?php _e('Payment type', 'ait-admin') ?></label></th>
				<td>
					<select name="account_renew_payment">
						<?php foreach ($paymentGatesEnabled as $name => $value) {
							if((bool)$value == true){ ?>
								<option value="<?php echo $name; ?>"><?php echo $paymentGatesConfig[$name]['label']?></option>
							<?php }
						}?>
					</select>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php

		//if($daysLeft <= $themeOptions->packages->expirationNotificationTime){
			?>
			<p style="margin-bottom: 40px;">
				<input type="submit" name="user-renew" data-form-url="<?php echo admin_url('/profile.php?ait-action=renew&user='.$user->ID)?>" value="<?php _e('Renew Account', 'ait-admin') ?>" class="user-submit button button-primary" />
				<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('select[name=account_renew_payment]').trigger('change');
				});
				jQuery('select[name=account_renew_payment]').on('change', function(){
					jQuery('input[name=user-renew]').attr('data-form-payment', jQuery(this).val());
				});

				jQuery('input[name=user-renew]').on('click', function(e){
					e.preventDefault();
					var payment = jQuery(this).attr('data-form-payment');
					var url = jQuery(this).attr('data-form-url')+"&payment="+payment;
					window.location.replace(url);
				})
				</script>
			</p>
			<?php
				//}

		//}

		$themeOptions = aitOptions()->getOptionsByType('theme');
		$upgradablePackages = array();
		$currentPackage = $packages->getPackageBySlug($role);
		$currentPackageOptions = $currentPackage->getOptions();
		foreach (getThemeUserRoles() as $key => $value){
			$package = $packages->getPackageBySlug($key);
			$packageOptions = $package->getOptions();
			if($packageOptions['price'] > $currentPackageOptions['price']){
				array_push($upgradablePackages, $package);
			}
		}

		if(count($upgradablePackages) > 0){
		// ACCOUNT UPGRADE
		?>
		<h3><?php _e('Upgrade Account', 'ait-admin') ?></h3>

		<table class="form-table">

			<tr>
				<th><label for="account_upgrade_type"><?php _e('Account type', 'ait-admin') ?></label></th>
				<td>
					<select name="account_upgrade_type">
						<?php foreach ($upgradablePackages as $package) {
							$packageOptions = $package->getOptions();
							$isFree = $packageOptions['price'] == 0 ? "true" : "false";
							echo '<option value="'.$package->getSlug().'" data-isfree="'.$isFree.'">'.$package->getName().' ('.$packageOptions['price'].' '.$themeOptions['payments']['currency'].')</option>';
						}?>
					</select>
				</td>
			</tr>

			<?php if(count($paymentGatesEnabled) > 0){ ?>
			<tr>
				<th><label for="account_upgrade_payment"><?php _e('Payment type', 'ait-admin') ?></label></th>
				<td>
					<select name="account_upgrade_payment">
						<?php foreach ($paymentGatesEnabled as $name => $value) {
							if((bool)$value == true){ ?>
								<option value="<?php echo $name; ?>"><?php echo $paymentGatesConfig[$name]['label']?></option>
							<?php }
						}?>
					</select>
				</td>
			</tr>
			<?php } ?>

		</table>

		<p style="margin-bottom: 40px;">
			<input type="submit" name="user-upgrade" data-form-url="<?php echo admin_url('/profile.php?ait-action=upgrade&user='.$user->ID)?>" value="<?php _e('Upgrade Account', 'ait-admin') ?>" class="user-submit button button-primary" />
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('select[name=account_upgrade_payment]').trigger('change');
				jQuery('select[name=account_upgrade_type]').trigger('change');
			});
			jQuery('select[name=account_upgrade_payment]').on('change', function(){
				jQuery('input[name=user-upgrade]').attr('data-form-payment', jQuery(this).val());
			});
			jQuery('select[name=account_upgrade_type]').on('change', function(){
				jQuery('input[name=user-upgrade]').attr('data-form-account', jQuery(this).val());
			});

			jQuery('input[name=user-upgrade]').on('click', function(e){
				e.preventDefault();
				var payment = jQuery(this).attr('data-form-payment');
				var account = jQuery(this).attr('data-form-account');
				var url = jQuery(this).attr('data-form-url')+"&payment="+payment+"&account="+account;

				window.location.replace(url);
			})
			</script>
		</p>
		<?php
		}
	}

	if($role == 'subscriber'){
		
		$prevRoleSlug = get_user_meta( $user->ID, 'package_name', true );
		if($prevRoleSlug != ""){
		
		?><h3><?php _e('Account', 'ait-admin') ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="account_type"><?php _e('Type', 'ait-admin') ?></label></th>
				<td><input type="text" name="account_type" value="<?php echo $packages->getPackageBySlug($prevRoleSlug)->getName() ?>" class="regular-text" disabled="disabled" /></td>
			</tr>

			<tr>
				<th><label for="account_expiration"><?php _e('Expiration in days', 'ait-admin') ?></label></th>
				<td><input type="text" name="account_expiration" value="<?php echo __('expired', 'ait-admin') ?>" class="regular-text" disabled="disabled" /></td>
			</tr>

			<?php if(count($paymentGatesEnabled) > 0){ ?>
			<tr>
				<th><label for="account_renew_payment"><?php _e('Payment type', 'ait-admin') ?></label></th>
				<td>
					<select name="account_renew_payment">
						<?php foreach ($paymentGatesEnabled as $name => $value) {
							if((bool)$value == true){ ?>
								<option value="<?php echo $name; ?>"><?php echo $paymentGatesConfig[$name]['label']?></option>
							<?php }
						}?>
					</select>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php

		?>
		<p style="margin-bottom: 40px;">
			<input type="submit" name="user-renew" data-form-url="<?php echo admin_url('/profile.php?ait-action=renew&user='.$user->ID)?>" value="<?php _e('Renew Account', 'ait-admin') ?>" class="user-submit button button-primary" />
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('select[name=account_renew_payment]').trigger('change');
			});
			jQuery('select[name=account_renew_payment]').on('change', function(){
				jQuery('input[name=user-renew]').attr('data-form-payment', jQuery(this).val());
			});

			jQuery('input[name=user-renew]').on('click', function(e){
				e.preventDefault();
				var payment = jQuery(this).attr('data-form-payment');
				var url = jQuery(this).attr('data-form-url')+"&payment="+payment;
				window.location.replace(url);
			})
			</script>
		</p>
		<?php
		}
	}
}
add_action( 'show_user_profile', 'showUserAccountInformation' );
add_action( 'edit_user_profile', 'showUserAccountInformation' );

function getCityguideUserPackage($user){
	$result = false;
	foreach ($user->roles as $index => $role) {
		if(strpos($role, 'cityguide_') !== false){
			$result = $role;
		}
	}
	return $result;
}

/*function checkFeaturedItem($post_id, $post, $update){
	$user = wp_get_current_user();
	if(isCityguideUser($user->roles)){
		$packages = new ThemePackages();
		$user_package = getCityguideUserPackage($user);
		if($user_package != false){
			$package = $packages->getPackageBySlug($user_package);
			$options = $package->getOptions();
			if($options['featured'] == true){
				update_post_meta($post_id, '_ait-item_item-featured', true);
			} else {
				update_post_meta($post_id, '_ait-item_item-featured', false);
			}
		}
	}
}
add_action('save_post', 'checkFeaturedItem', 12, 3);*/

function reviewUpdatedPost($post_id, $post, $update){
	if($update){
		if($post->post_status == "trash"){
			// post is going to be trashed, no action needed
		} else {
			// post is updating
			$user = wp_get_current_user();
			if(isCityguideUser($user->roles)){
				$packages = new ThemePackages();
				$user_package = getCityguideUserPackage($user);
				if($user_package != false){
					$package = $packages->getPackageBySlug($user_package);
					$options = $package->getOptions();
					if($options['adminApproveEdit'] == true){
						// set post status pending and send email
						remove_action('save_post', 'reviewUpdatedPost', 13, 3);

						wp_update_post( array("ID" => $post_id, 'post_status' => 'pending'));

						add_action('save_post', 'reviewUpdatedPost', 13, 3);

						$message = "Post <a href='".get_permalink($post_id)."'>#".$post_id."</a> was updated and awaiting your moderation.";
						$message = sprintf(__("Post <a href='%s'>#%d</a> was updated and awaiting your moderation.",'ait-admin'), get_permalink($post_id), $post_id);

						$headers = array(
							'Content-Type: text/html; charset=UTF-8',
						);

						wp_mail( get_bloginfo('admin_email'), __('Post ready for review', 'ait-admin'), $message, $headers);

					}
				}
			}
		}
	}
}
add_action('save_post', 'reviewUpdatedPost', 13, 3);