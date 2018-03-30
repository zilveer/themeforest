<?php

if ( ! function_exists( 'wd_tini_account' ) ) {
	function wd_tini_account(){
		/*if ( !wd_is_woocommerce() ) {
			return '';
		}*/
		$is_woocommerce = wd_is_woocommerce();
		$login_url = '#';
		$register_url = '#';
		$profile_url = '#';
		global $woocommerce;
		if( $is_woocommerce ){
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $myaccount_page_id ) {
			  $login_url = esc_url(get_permalink( $myaccount_page_id ));
			  $register_url = $login_url;
			  $profile_url = $login_url;
			}		
		}
		else{
			$login_url = esc_url(wp_login_url());
			$register_url = esc_url(wp_registration_url());
			$profile_url = esc_url(admin_url( 'profile.php' ));
		}
		ob_start();
		
		$_user_logged = is_user_logged_in();
		
		?>
		<?php do_action( 'wd_before_tini_account' ); ?>
		<div class="wd_tini_account_wrapper">
			<div class="wd_tini_account_control">
				<?php if(!$_user_logged):?>
					
					<a class="sign-in-form-control" href="<?php echo $login_url;?>" title="<?php _e('Login','wpdance');?>">
						<span><?php _e('Log in','wpdance');?></span>
					</a>
					<span class="visible-phone login-drop-icon"></span>				
				<?php else:?>		
					<a href="<?php echo $profile_url; ?>" title="<?php _e('My Account','wpdance'); ?>">
						<?php _e('My Account','wpdance'); ?>
					</a>	
				<?php endif;?>
				<?php if( !$_user_logged ):?>
				<div class="regis-account-wrapper">
					<span>&nbsp;<?php _e('/','wpdance');?></span>
					<a class="" href="<?php echo $register_url;?>" title="<?php _e('Create An Account','wpdance');?>">
						<span><?php _e('Sign up','wpdance');?></span>
					</a>	
				</div>
				<?php endif; ?>
			</div>
			<div class="form_drop_down drop_down_container <?php echo $_user_logged ? "hidden" : "";?>">
				<?php 
					if( !$_user_logged ):
				?>
					
					<div class="form_wrapper">				
						<div class="form_wrapper_body">
							<?php    
								$args = array(
									//'redirect' => admin_url()
									'redirect' => $profile_url
									,'form_id' => 'loginform-custom'
									,'label_username' => __( 'Username','wpdance' )
									,'label_password' => __( 'Password','wpdance' )
									,'label_remember' => __( '','wpdance' )
									,'label_log_in' => __( 'Login','wpdance' )
									,'remember' => false
								);
								wp_login_form( $args );
							?>
							<span class="required"><?php _e('* Required','wpdance');?></span>
							<a href="<?php echo esc_url(wp_lostpassword_url()); ?>" title="<?php _e('Forgot Your Password?','wpdance');?>"><?php _e('Forgot Your Password?','wpdance');?></a>
						</div>
						<div class="form_wrapper_footer">
							<span><?php _e('New Customer ?','wpdance');?></span><span><a href="<?php echo $register_url; ?>"><?php _e('Sign up','wpdance');?></a></span>
						</div>
					</div>	
				<?php else: ?>	
					<span class="my_account_wrapper"><a href="<?php echo $profile_url; ?>" title="<?php _e('My Account','wpdance');?>"><?php _e('My Account','wpdance');?></a></span>
					<span class="logout_wrapper"><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e('Logout','wpdance');?>"><?php _e('Logout','wpdance');?></a></span>
				<?php
					endif
				?>
			</div>
		</div>
		
		<?php do_action( 'wd_after_tini_account' ); ?>
<?php
		$tini_account = ob_get_clean();
		return $tini_account;
	}
}

if ( ! function_exists( 'wd_update_tini_account' ) ) {
	function wd_update_tini_account() {
		die($_tini_account_html = wd_tini_account());
	}
}
if( ! function_exists ( 'wd_redirect_login_fail' ) ){
    function wd_redirect_login_fail(){
        $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
        if ( $myaccount_page_id ) {
            $myaccount_page_url = get_permalink( $myaccount_page_id );
            wp_redirect($myaccount_page_url);
        }
    }
}
if( ! function_exists ('wd_redirect_logout') ){
    function wd_redirect_logout(){
        if( isset($_GET['loggedout']) && $_GET['loggedout'] == 'true' ){
            $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $myaccount_page_url = get_permalink( $myaccount_page_id );
                wp_redirect($myaccount_page_url);
            }
        }
    }
}

if( isset($_POST, $_POST['log'], $_POST['pwd']) ){
	add_filter( 'authenticate', 'wd_custom_authenticate_username_password', 30, 3);
}
function wd_custom_authenticate_username_password( $user, $username, $password )
{
    if ( function_exists('is_a') && is_a($user, 'WP_User') ) { return $user; }
    if ( empty($username) || empty($password) )
    {
        $error = new WP_Error();
        $user  = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.','wpdance'));

        return $error;
    }
}

add_action('wp_ajax_update_tini_account', 'wd_update_tini_account');
add_action('wp_ajax_nopriv_update_tini_account', 'wd_update_tini_account');
if( isset($_POST['redirect_to']) && strpos($_POST['redirect_to'],'wp-admin') === false ){
	add_action('wp_login_failed','wd_redirect_login_fail');
}
add_action('init','wd_redirect_logout');

/* Check confirm password - register in account page */
if( !function_exists('wd_check_match_password') ){
	function wd_check_match_password($errors){
		if( isset($_POST['confirm_password'], $_POST['password']) ){
			if( $_POST['confirm_password'] != $_POST['password'] && $_POST['password'] != '' ){
				$errors->add('registration-error', __('Password and confirm password do not match.','wpdance'));
			}
		}
		return $errors;
	}
}

add_filter('woocommerce_process_registration_errors', 'wd_check_match_password', 99999);

/* Check confirm password - register in checkout page */
if( !function_exists('wd_check_match_password_checkout') ){
	function wd_check_match_password_checkout($errors){
		if( isset($_POST['confirm_account_password'], $_POST['account_password']) ){
			if( $_POST['confirm_account_password'] != $_POST['account_password'] && $_POST['account_password'] != '' ){
				$errors->add('registration-error', __('Password and confirm password do not match.','wpdance'));
			}
		}
		return $errors;
	}
}

add_filter('woocommerce_registration_errors', 'wd_check_match_password_checkout', 99999);

?>
