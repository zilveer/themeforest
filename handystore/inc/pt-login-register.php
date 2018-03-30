<?php

/* Enqueue scripts & styles */
function pt_login_scripts() {

	wp_enqueue_script( 'validate-script', get_template_directory_uri(). '/js/validate.js', array('jquery'), '1.12.0', true );
	wp_enqueue_script( 'ajax-auth-script', get_template_directory_uri(). '/js/ajax-auth-script.js', array('jquery'), '1.0', true );

  wp_localize_script( 'ajax-auth-script', 'ajax_auth_object', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'loadingmessage' => __('Sending user info, please wait...', 'plumtree')
  ));

  // Enable the user with no privileges to run ajax_login() in AJAX
  add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
	// Enable the user with no privileges to run ajax_register() in AJAX
	add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'pt_login_scripts');
}

function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
  	// Call auth_user_login
		auth_user_login($_POST['username'], $_POST['password'], __('Login', 'plumtree'));

    die();
}

function registration_handle($username, $email, $password, $become_vendor, $terms) {
    $errors = new WP_Error();
    if ( get_user_by( 'login', $username ) ) {
        $errors->add( 'login_exists', __('This username is already registered.', 'plumtree') );
    }
    if ( get_user_by( 'email', $email ) ) {
        $errors->add( 'email_exists', __('This email address is already registered.', 'plumtree') );
    }
    if ( class_exists('WCV_Vendors') && class_exists( 'WooCommerce' ) && $become_vendor == 1 ) {
        $terms_page = WC_Vendors::$pv_options->get_option( 'terms_to_apply_page' );
        if ( $terms_page && $terms_page!='' && $terms=='' ) {
            $errors->add( 'must_accept_terms', __('You must accept the terms and conditions to become a vendor.', 'plumtree') );
        }
    }
    $err_var = $errors->get_error_codes();
    if ( ! empty( $err_var ) )
        return $errors;
}

function ajax_register(){
    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-register-nonce', 'security' );

    // Check for errors before creating new user
    $user_check = registration_handle($_POST['username'],$_POST['email'],$_POST['password'],$_POST['become_vendor'],$_POST['accept_terms']);
    if ( is_wp_error($user_check) ){
        $error  = $user_check->get_error_codes() ;

        if(in_array('login_exists', $error))
            echo json_encode(array('loggedin'=>false, 'message'=> ($user_check->get_error_message('login_exists'))));
        elseif(in_array('email_exists',$error))
            echo json_encode(array('loggedin'=>false, 'message'=> ($user_check->get_error_message('email_exists'))));
        elseif(in_array('must_accept_terms',$error))
        echo json_encode(array('loggedin'=>false, 'message'=> ($user_check->get_error_message('must_accept_terms'))));
    } else {
    		// Nonce is checked, get the POST data and sign user on
        $info = array();
        $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
        $info['user_pass'] = sanitize_text_field($_POST['password']);
        $info['user_email'] = sanitize_email( $_POST['email']);

    		// Register the user
        $user_register = wp_insert_user( $info );

				$become_a_vendor = false;
        if ( class_exists('WC_Vendors') && $_POST[ 'become_vendor' ] == 1 ) {
						$become_a_vendor = true;
        }

				// Notify admin and user about Registration
    		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

		    $message  = sprintf( esc_html__('New user registration on your site %s:', 'plumtree'), $blogname) . "\r\n\r\n";
		    $message .= sprintf( esc_html__('Username: %s', 'plumtree'), $info['user_login'] ) . "\r\n\r\n";
		    $message .= sprintf( esc_html__('Email: %s', 'plumtree'), $info['user_email'] ) . "\r\n";

    		@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration', 'plumtree'), $blogname), $message);

				$message  = esc_html__('Hi there,', 'plumtree') . "\r\n\r\n";
        $message .= sprintf(esc_html__("Welcome to %s! Here's how to log in:", 'plumtree'), $blogname) . "\r\n\r\n";
        $message .= wp_login_url() . "\r\n";
        $message .= sprintf(esc_html__('Username: %s', 'plumtree'), $info['user_login']) . "\r\n";
        $message .= sprintf(esc_html__('Password: %s', 'plumtree'), $info['user_pass']) . "\r\n\r\n";
        $message .= sprintf(esc_html__('If you have any problems, please contact me at %s.', 'plumtree'), get_option('admin_email')) . "\r\n\r\n";
        $message .= esc_html__('This is an automatically generated email, please do not reply!', 'plumtree');

        wp_mail($info['user_email'], sprintf(esc_html__('[%s] Your username and password', 'plumtree'), $blogname), $message);

    		// Login to new account
        auth_user_login($info['nickname'], $info['user_pass'], __('Registration', 'plumtree'), $become_a_vendor);
    }
    die();
}

function auth_user_login($user_login, $password, $login, $become_a_vendor)
{
	$info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = true;

	$user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
			echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.', 'plumtree')));
    } else {
			wp_set_current_user($user_signon->ID);
			$redirect_url = get_home_url();
			if ( class_exists( 'Woocommerce' ) ) {
				$redirect_url = get_permalink( get_option('woocommerce_myaccount_page_id') );
			}
			if ( class_exists( 'WC_Vendors') && $become_a_vendor == true ) {
				$redirect_url = get_permalink( WC_Vendors::$pv_options->get_option( 'vendor_dashboard_page' ) );
			}
			if ( class_exists( 'WCVendors_Pro') && $become_a_vendor == true ) {
				$redirect_url = get_permalink( WCVendors_Pro::get_option( 'dashboard_page_id' ) );
			}
      echo json_encode(array('loggedin'=>true, 'redirect_url'=>$redirect_url, 'message'=>$login.__(' successful, redirecting...', 'plumtree')));
    }

	die();
}
