<?php
/* CUSTOM CITYGUIDE FUNCTIONS */
function isCityguideUser($wp_roles = array()){
	$result = false;
	if(count($wp_roles) == 0){
		$wp_user = wp_get_current_user();
		$wp_roles = $wp_user->roles;
	}
	foreach ($wp_roles as $index => $role) {
		if(strpos($role, 'cityguide_') !== false){
			$result = true;
		}
	}
	return $result;
}

function altered_search($query) {
	if($query->is_admin) {
		/* Display posts in admin for current user only */
		$wp_user = wp_get_current_user();
		if(isCityguideUser($wp_user->roles)){
			$query->set('author', $wp_user->data->ID);
		}
	} else {

		if($query->is_main_query()){
			if (isset($_GET['s']) && empty($_GET['s'])){
				$query->is_search = true;
			}

			// if(!empty($_GET['a'])){
			// 	// advanced searching > on

			// 	// > dev note > all search setup here instead of template
			// 	if(!empty($_GET['count'])){
			// 		$query->query_vars['posts_per_page'] = intval($_GET['count']);
			// 	} else {
			// 		// get number from settings
			// 		$themeSettings = aitOptions()->getOptionsByType('theme');
			// 		$query->query_vars['posts_per_page'] =  intval($themeSettings['items']['sortingDefaultCount']);
			// 	}
			// }

			// is woocommerce search
			if(isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'product'){
				return $query;
			}
			$query = apply_filters( 'ait_alter_search_query', $query );

		}
	}
	return $query;
}
add_filter('pre_get_posts', 'altered_search');

function register_portal_user() {

	if(!empty($_REQUEST['ait-action'])){
		if($_REQUEST['ait-action'] == 'register'){
			$redirect = !empty($_POST['redirect_to']) ? $_POST['redirect_to'] : home_url();

			if(!empty($_POST['user_login']) && !empty($_POST['user_email']) && is_email($_POST['user_email'])){
				if(username_exists( $_POST['user_login'] ) == null && email_exists( $_POST['user_email'] ) == false){

					$packages = new ThemePackages();
					$package = $packages->getPackageBySlug($_POST['user_role']);
					$packageOptions = $package->getOptions();
					$paymentPrice = $packageOptions['price'];

					$isFree = $packageOptions['price'] == 0 ? true : false;

					global $wp_version;
					if($isFree){
						// register user automatically
						$user_data = array(
							'user_login'	=> $_POST['user_login'],
							'user_pass'		=> wp_generate_password(),
							'user_email'	=> $_POST['user_email'],
							'role'			=> $_POST['user_role']
							// set the subscriber role
						);
						$user_id = wp_insert_user( $user_data ) ;

						if(class_exists('AitClaimListing')){
							$post_id = intval($_POST['form_post']);
							if(filter_var($_POST['claim_listing'], FILTER_VALIDATE_BOOLEAN, false)){
								AitClaimListing::claimItemListing($user_id, $post_id);
							}
						}

						if(version_compare($wp_version, "4.3",">=")){
							wp_new_user_notification($user_id, null, 'both');
						} else {
							wp_new_user_notification($user_id, $user_data['user_pass']);
						}

						$redirect = $redirect.'/?ait-notification=user-registration-success';

					} else {
						$user_data = array(
							'user_login'	=> $_POST['user_login'],
							'user_pass'		=> wp_generate_password(),
							'user_email'	=> $_POST['user_email'],
							'role'			=> 'subscriber'//$_POST['user_role']
							// set the subscriber role
						);
						$user_id = wp_insert_user( $user_data ) ;

						if(class_exists('AitClaimListing')){
							$post_id = intval($_POST['form_post']);
							if(filter_var($_POST['claim_listing'], FILTER_VALIDATE_BOOLEAN, false)){
								AitClaimListing::claimItemListing($user_id, $post_id);
							}
						}

						if(version_compare($wp_version, "4.3",">=")){
							wp_new_user_notification($user_id, null, 'both');
						} else {
							wp_new_user_notification($user_id, $user_data['user_pass']);
						}

						switch($_POST['user_payment']){
							case "paypal":
								// redirect registering user to payment gate
								// after sucessful payment set the prefered role in the payments.php
								// data parameter for the
								$paymentsGate = home_url()."?ait-payment&";
								$paymentsParams = array(
									'payment-type' => 'paypal',
									//'payment-id' => $paymentId,
									'payment-price' => $paymentPrice,
									'payment-data-user' => $user_id,
									'payment-data-package' => $_POST['user_role'],
									'payment-data-operation' => 'register'
								);
								$redirect = $paymentsGate.str_replace("?","",http_build_query($paymentsParams));
							break;
							case "paypalRecurring":
								// redirect registering user to payment gate
								// after sucessful payment set the prefered role in the payments.php
								// data parameter for the
								$paymentsGate = home_url()."?ait-payment&";
								$paymentsParams = array(
									'payment-type' => 'paypalRecurring',
									//'payment-id' => $paymentId,
									'payment-price' => $paymentPrice,
									'payment-data-user' => $user_id,
									'payment-data-package' => $_POST['user_role'],
									'payment-data-operation' => 'register'
								);
								$redirect = $paymentsGate.str_replace("?","",http_build_query($paymentsParams));
							break;
							case "stripe":
								$paymentsGate = home_url()."?ait-payment&";
								$paymentsParams = array(
									'payment-type' => 'stripe',
									//'payment-id' => $paymentId,
									'payment-price' => $paymentPrice,
									'payment-data-user' => $user_id,
									'payment-data-package' => $_POST['user_role'],
									'payment-data-operation' => 'register'
								);
								$redirect = $paymentsGate.str_replace("?","",http_build_query($paymentsParams));
							break;
							default:
								// bank transfer
								$themeOptions = aitOptions()->getOptionsByType('theme');
								$currency = $themeOptions['payments']['currency'];

								$headers = array(
									'Content-Type: text/html; charset=UTF-8',
								);
								$message = sprintf(str_replace('\n', '\r\n', __("Username: %s \nUser ID: %d \nE-mail: %s \nPackage: %s \nPrice: %s \n","ait-admin")), $_POST['user_login'], $user_id, $_POST['user_email'], $package->getName(), $paymentPrice.' '.$currency);
								wp_mail( get_bloginfo('admin_email'), __('User payment information','ait-admin'), $message, $headers );

								$redirect = $redirect.'/?ait-notification=user-registration-success';
							break;
						}
					}
				} else {
					$redirect = $redirect.'/?ait-notification=user-registration-exists';
				}
			} else {
				$redirect = $redirect.'/?ait-notification=user-registration-error';
			}

			wp_safe_redirect( $redirect );
			exit();
		}
	}
}
add_action('wp', 'register_portal_user');

function update_portal_user() {
	if(!empty($_REQUEST['ait-action'])){

		if($_REQUEST['ait-action'] == 'renew'){
			$redirect = !empty($_POST['redirect_to']) ? $_POST['redirect_to'] : home_url();

			if(isset($_REQUEST['user'])){
				$user = new WP_User($_REQUEST['user']);
				if(isCityguideUser($user->roles)){
					$role = reset($user->roles);
					$packages = new ThemePackages();

					$package = $packages->getPackageBySlug($role);
					$packageOptions = $package->getOptions();
					$paymentPrice = $packageOptions['price'];

					switch($_REQUEST['payment']){
						case "paypal":
							// redirect registering user to payment gate
							// after sucessful payment set the prefered role in the payments.php
							// data parameter for the

							$paymentsGate = home_url('/')."?ait-payment&";
							$paymentsParams = array(
								'payment-type' => 'paypal',
								//'payment-id' => $paymentId,
								'payment-price' => $paymentPrice,
								'payment-data-user' => $user->ID,
								'payment-data-package' => $package->getSlug(),
								'payment-data-operation' => 'renew'
							);
							$redirect = $paymentsGate.str_replace("?","",http_build_query($paymentsParams));
						break;
						case "paypalRecurring":
							// redirect registering user to payment gate
							// after sucessful payment set the prefered role in the payments.php
							// data parameter for the

							$paymentsGate = home_url('/')."?ait-payment&";
							$paymentsParams = array(
								'payment-type' => 'paypalRecurring',
								//'payment-id' => $paymentId,
								'payment-price' => $paymentPrice,
								'payment-data-user' => $user->ID,
								'payment-data-package' => $package->getSlug(),
								'payment-data-operation' => 'renew'
							);
							$redirect = $paymentsGate.str_replace("?","",http_build_query($paymentsParams));
						break;
						case "stripe":
							// redirect registering user to payment gate
							// after sucessful payment set the prefered role in the payments.php
							// data parameter for the

							$paymentsGate = home_url('/')."?ait-payment&";
							$paymentsParams = array(
								'payment-type' => 'stripe',
								//'payment-id' => $paymentId,
								'payment-price' => $paymentPrice,
								'payment-data-user' => $user->ID,
								'payment-data-package' => $package->getSlug(),
								'payment-data-operation' => 'renew'
							);
							$redirect = $paymentsGate.str_replace("?","",http_build_query($paymentsParams));
						break;
						default:
							// bank transfer
							//$message = "User ".$user->data->user_nicename." with ID #".$user->ID." (".$role.") is requesting account renew via Bank Transfer";
							$headers = array(
								'Content-Type: text/html; charset=UTF-8',
							);
							$message = sprintf(__("User %s with ID #%d (%s) is requesting account renew via Bank Transfer","ait-admin"), $user->data->user_nicename, $user->ID, $package->getName());
							wp_mail( get_bloginfo('admin_email'), __('Account renew request','ait-admin'), $message, $headers );
							$redirect .= '?ait-notification=user-account-renew';
						break;
					}
				}
			}

			wp_safe_redirect( $redirect );
			exit();
		}

		if($_REQUEST['ait-action'] == 'upgrade'){
			$redirect = !empty($_POST['redirect_to']) ? $_POST['redirect_to'] : home_url();

			if(isset($_REQUEST['user'])){
				$user = new WP_User($_REQUEST['user']);
				if(isCityguideUser($user->roles)){
					$role = reset($user->roles);
					$packages = new ThemePackages();

					if(isset($_REQUEST['account'])){
						$package = $packages->getPackageBySlug($_REQUEST['account']);
					}
					$oldPackage = $packages->getPackageBySlug($role);

					$packageOptions = $package->getOptions();
					$paymentPrice = $packageOptions['price'];

					switch($_REQUEST['payment']){
						case "paypal":
							// redirect registering user to payment gate
							// after sucessful payment set the prefered role in the payments.php
							// data parameter for the

							$paymentsGate = home_url('/')."?ait-payment&";
							$paymentsParams = array(
								'payment-type' => 'paypal',
								//'payment-id' => $paymentId,
								'payment-price' => $paymentPrice,
								'payment-data-user' => $user->ID,
								'payment-data-package' => $package->getSlug(),
								'payment-data-operation' => 'upgrade'
							);
							$redirect = $paymentsGate.str_replace("?","",http_build_query($paymentsParams));
						break;
						case "paypalRecurring":
							// redirect registering user to payment gate
							// after sucessful payment set the prefered role in the payments.php
							// data parameter for the

							$paymentsGate = home_url('/')."?ait-payment&";
							$paymentsParams = array(
								'payment-type' => 'paypalRecurring',
								//'payment-id' => $paymentId,
								'payment-price' => $paymentPrice,
								'payment-data-user' => $user->ID,
								'payment-data-package' => $package->getSlug(),
								'payment-data-operation' => 'upgrade'
							);
							$redirect = $paymentsGate.str_replace("?","",http_build_query($paymentsParams));
						break;
						case "stripe":
							// redirect registering user to payment gate
							// after sucessful payment set the prefered role in the payments.php
							// data parameter for the

							$paymentsGate = home_url('/')."?ait-payment&";
							$paymentsParams = array(
								'payment-type' => 'stripe',
								//'payment-id' => $paymentId,
								'payment-price' => $paymentPrice,
								'payment-data-user' => $user->ID,
								'payment-data-package' => $package->getSlug(),
								'payment-data-operation' => 'upgrade'
							);
							$redirect = $paymentsGate.str_replace("?","",http_build_query($paymentsParams));
						break;
						default:
							// bank transfer
							//$message = "User ".$user->data->user_nicename." with ID #".$user->ID." (".$role.") is requesting account upgrade to (".$package->getSlug().") via Bank Transfer";
							$headers = array(
								'Content-Type: text/html; charset=UTF-8',
							);
							$message = sprintf(__("User %s with ID #%d (%s) is requesting account upgrade to (%s) via Bank Transfer","ait-admin"), $user->data->user_nicename, $user->ID, $oldPackage->getName(), $package->getName());
							wp_mail( get_bloginfo('admin_email'), __('Account upgrade request', 'ait-admin'), $message, $headers );
							$redirect .= '?ait-notification=user-account-upgrade';
						break;
					}
				}
			}

			wp_safe_redirect( $redirect );
			exit();
		}
	}
}
add_action('after_setup_theme', 'update_portal_user');

function isPointInRadius($radiusInMeters, $cenLat, $cenLng, $lat, $lng) {
	$radiusInMeters = floatval($radiusInMeters);
	$cenLat = floatval($cenLat);
	$cenLng = floatval($cenLng);
	$lat = floatval($lat);
	$lng = floatval($lng);
	$distance = ( 6371 * acos( cos( deg2rad($cenLat) ) * cos( deg2rad( $lat ) ) * cos( deg2rad( $lng ) - deg2rad($cenLng) ) + sin( deg2rad($cenLat) ) * sin( deg2rad( $lat ) ) ) );
	if(floatval($distance*1000) <= $radiusInMeters){
		return true;
	} else {
		return false;
	}
}

function recursiveCategory($categories, $selected, $taxonomy, $separator, $prefixed = false){
	$result = "";
	if(isset($categories['errors'])) return $result; // when ait-toolkit is not active and there is no ait-items taxonomy, get_categories() will return error array
	foreach($categories as $category){
		$value = $prefixed == true ? $taxonomy.'_'.$category->term_id : $category->term_id;
		if($value == $selected){
			$result .= '<option value="'.$value.'" selected>'.$separator.$category->name.'</option>';
		} else {
			$result .= '<option value="'.$value.'">'.$separator.$category->name.'</option>';
		}

		$children = get_categories(array('taxonomy' => $taxonomy, 'hide_empty' => 0, 'parent' => $category->term_id));
		if(!empty($children)){
			$result .= recursiveCategory($children, $selected, $taxonomy, $separator."&nbsp;&nbsp;", $prefixed);
		}
	}
	return $result;
}

function getItems(){
	// check for request params

}
/* CUSTOM CITYGUIDE FUNCTIONS */

function aitPortalNotices() {
	$currentNotice = false;
	$notices = array(
		'item-limit-exceeded' => array(
			"type" => "error",
			"msg" => __('Maximum items for the current package exceeded', 'ait-admin'),
		),
		'event-limit-exceeded' => array(
			"type" => "error",
			"msg" => __('Maximum events for the current package exceeded', 'ait-admin'),
		),
	);
	if(defined("AIT_REVIEWS_ENABLED")){
		$notices['review-approved'] = array(
			"type" => "updated",
			"msg" => __("Rating was approved", "ait-admin"),
		);
	}

	$notices = apply_filters('ait_portal_notices', $notices);

	if(isset($_REQUEST['ait-notice']) && !empty($_REQUEST['ait-notice'])){
		$currentNotice = $_REQUEST['ait-notice'];
	}
	if(isset($notices[$currentNotice])){
	?>
	<div class="<?php echo $notices[$currentNotice]['type']; ?>">
		<p><?php echo $notices[$currentNotice]['msg']; ?></p>
	</div>
	<?php
	}
}
add_action( 'admin_notices', 'aitPortalNotices' );

function aitFrontendNotices(){
	$currentNotice = false;
	$notices = array(
		'user-registration-success' => array(
			"icon"	=> 'fa fa-check-circle',
			"type"	=> "success",
			"msg"	=> __('User successfully registered, email was sent to your email address.', 'ait'),
		),
		'user-registration-exists' => array(
			"icon"	=> 'fa fa-exclamation-circle',
			"type"	=> "warning",
			"msg"	=> __('Username or email already registered', 'ait'),
		),
		'user-registration-error' => array(
			"icon"	=> 'fa fa-times-circle',
			"type"	=> "error",
			"msg"	=> __('There was an error during registration, please check name and email. If the problem persists, please contact website administrator', 'ait'),
		),
		'user-account-renew'  => array(
			"icon"	=> 'fa fa-times-circle',
			"type"	=> "success",
			"msg"	=> __('Administrator was notified about account renew request.', 'ait').' <a href="'.admin_url("profile.php").'">'.__('Back to Admin', 'ait').'</a>',
		),
		'user-account-upgrade'  => array(
			"icon"	=> 'fa fa-times-circle',
			"type"	=> "success",
			"msg"	=> __('Administrator was notified about account upgrade request.', 'ait').' <a href="'.admin_url("profile.php").'">'.__('Back to Admin', 'ait').'</a>',
		),
		'user-login-failed' => array(
			"icon"	=> 'fa fa-times-circle',
			"type"	=> "error",
			"msg"	=> __('System login failed, please check your username and password', 'ait'),
		),
	);

	if(isset($_REQUEST['ait-notification']) && !empty($_REQUEST['ait-notification'])){
		$currentNotice = $_REQUEST['ait-notification'];
	}

	if(isset($notices[$currentNotice])){
	?>
		<div class="frontend-notification <?php echo $notices[$currentNotice]['type']; ?>">
			<div class="grid-main">
				<i class="<?php echo $notices[$currentNotice]['icon']; ?>"></i>
				<span><?php echo $notices[$currentNotice]['msg']; ?></span>
				<i class="fa fa-times"></i>
			</div>
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('.frontend-notification').addClass('shown');

				jQuery('.frontend-notification i.fa-times').on('click', function(){
					jQuery('.frontend-notification').addClass('hidden');
					setTimeout(function(){
						jQuery('.frontend-notification').remove();
					},2000);
				});
			});
			</script>
		</div>
	<?php
	}
}
add_action( 'ait-html-body-begin', 'aitFrontendNotices', 12, 0);

add_action( 'wp_login_failed', 'aitFrontendLoginFail' );  // hook failed login
function aitFrontendLoginFail( $username ) {
	$referrer = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	if ( $referrer && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
		$referrer = add_query_arg('ait-notification', 'user-login-failed', $referrer);
		wp_redirect( $referrer );
		exit;
	}
}


add_filter( "views_edit-ait-item" , 'fixAdminCounts', 10, 1);
add_filter( "views_edit-ait-review" , 'fixAdminCounts', 10, 1);
function fixAdminCounts($views){
	global $current_screen;
	switch( $current_screen->id ) {
		case 'edit-ait-item':
			$views = fixItemsCount( 'ait-item', $views );
			break;
		case 'edit-ait-review':
			$views = fixItemsCount( 'ait-review', $views );
			break;
	}
	return $views;
}

function fixItemsCount($post_type, $views){
	$current_user = wp_get_current_user();
	if(isCityguideUser($current_user->roles)){
		unset($views['mine']);
		// do the counts query
		$query = new WP_Query(array(
			'post_type' => $post_type,
			'author' => $current_user->ID
		));
		$views['all'] = preg_replace( '/\(.+\)/U', '('.count($query->posts).')', $views['all'] );

		$query = new WP_Query(array(
			'post_type' => $post_type,
			'author' => $current_user->ID,
			'post_status' => 'publish'
		));
		$views['publish'] = preg_replace( '/\(.+\)/U', '('.count($query->posts).')', $views['publish'] );

		if(isset($views['draft'])){
			$query = new WP_Query(array(
				'post_type' => $post_type,
				'author' => $current_user->ID,
				'post_status' => 'draft'
			));
			$views['draft'] = preg_replace( '/\(.+\)/U', '('.count($query->posts).')', $views['draft'] );
		}

		if(isset($views['pending'])){
			$query = new WP_Query(array(
				'post_type' => $post_type,
				'author' => $current_user->ID,
				'post_status' => 'pending'
			));
			$views['pending'] = preg_replace( '/\(.+\)/U', '('.count($query->posts).')', $views['pending'] );
		}

		if(isset($views['trash'])){
			$query = new WP_Query(array(
				'post_type' => $post_type,
				'author' => $current_user->ID,
				'post_status' => 'trash'
			));
			$views['trash'] = preg_replace( '/\(.+\)/U', '('.count($query->posts).')', $views['trash'] );
		}

	}
	return $views;
}


function reviewsOrderBy($data = array(), $order = "ASC"){
	// returns sorted query array
	if($order == 'ASC'){
		usort($data, function($a, $b){
			if ($a->rating_mean == $b->rating_mean) {
				return 0;
			}
			return ($a->rating_mean < $b->rating_mean) ? -1 : 1;
		});
	} else {
		usort($data, function($a, $b){
			if ($a->rating_mean == $b->rating_mean) {
				return 0;
			}
			return ($a->rating_mean > $b->rating_mean) ? -1 : 1;
		});
	}

	return $data;
}

add_action( 'admin_print_footer_scripts', 'ensureLatLngVals', 11 );
function ensureLatLngVals(){
	global $post_type;
	$enabled_post_types = array('ait-item');
	if(in_array($post_type, $enabled_post_types)){
		?>
		<script type="text/javascript" id="item-map-fill-coords">
		jQuery(document).ready(function(){
			jQuery('form#post input#publish').addClass('preventDefault');
		});
		jQuery('form#post input#publish').on('click', function(e){
			//var self = this;
			if(jQuery(this).hasClass('preventDefault')){
				e.preventDefault();
				var $mapInputs = jQuery('form#post').find('.ait-opt-map');
				$mapInputs.each(function(){
					var $inputAdr = jQuery(this).find('.ait-opt-maps-address input[type=text]');
					var $inputLat = jQuery(this).find('.ait-opt-maps-latitude input[type=text]');
					var $inputLng = jQuery(this).find('.ait-opt-maps-longitude input[type=text]');
					if($inputAdr.val() != "" && $inputLat.val() == "" && $inputLng.val() == ""){
						// if address is filled up but user forgot to click find
						$inputAdr.parent().find('input[type=button]').trigger('click');
					}
				});
				setTimeout(function(){
					jQuery('form#post input#publish').removeClass('preventDefault');
					jQuery('form#post input#publish').trigger('click');
					//jQuery('form#post')[0].submit();
				}, 500);
			}
		});
		</script>
		<?php
	}
}

/* remove item author from comment notifications on defined post types */
add_filter( 'comment_notification_recipients', 'removeItemAuthorFromCommentNotification', 2, 1000);
add_filter( 'comment_moderation_recipients', 'removeItemAuthorFromCommentNotification', 2, 1000);
function removeItemAuthorFromCommentNotification($emails, $comment_id){
	// get the item from comment_post_ID 
	$comment = get_comment($comment_id);
	$post = get_post($comment->comment_post_ID);
	$user = get_user_by('id', $post->post_author);

	$disabled_post_types = apply_filters('ait-remove-author-from-comment-notification', array('ait-item'));
	if(in_array($post->post_type, $disabled_post_types)){
		foreach($emails as $index => $value){
			if($value == $user->data->user_email){
				unset($emails[$index]);
			}
		}
	}

	return $emails;
}
/* remove item author from comment notifications on defined post types */