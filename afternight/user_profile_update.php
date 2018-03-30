<?php

/* Get user info. */
global $current_user, $wp_roles;
get_currentuserinfo();

/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' );

/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' && ( !defined('IS_FOR_DEMO' ) || get_the_author_meta( 'user_login', $current_user->ID ) != 'demo') ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) { 
        if ( $_POST['pass1'] == $_POST['pass2'] ){
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
		}else{
			$error = __('The passwords you entered do not match.  Your password was not updated.', 'cosmotheme');
		}
	}
    if ( (!empty($_POST['pass1'] ) && empty( $_POST['pass2'] ) ) || (empty($_POST['pass1'] ) && !empty( $_POST['pass2'] )) ) { 
        $error = __('The passwords you entered do not match.  Your password was not updated.', 'cosmotheme');
    }

    /* Update user information. */
    if ( !empty( $_POST['url'] ) ){  
        update_user_meta( $current_user->ID, 'user_url', esc_url( $_POST['url'] ) );
	}else{
		delete_user_meta( $current_user->ID, 'user_url');
	}	
    if ( !empty( $_POST['email'] ) )
        update_user_meta( $current_user->ID, 'user_email', esc_attr( $_POST['email'] ) );
    if ( !empty( $_POST['first-name'] ) ) {
         update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) ); 
	}
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
	
	if ( !empty( $_POST['avatar_id'] )  && $_POST['avatar_id'] != get_user_meta($current_user->ID, 'custom_avatar', true) && empty( $_POST['remove_avatar'])){ 
		update_user_meta( $current_user->ID, 'custom_avatar', esc_attr( $_POST['avatar_id'] ) );
	}elseif( !empty( $_POST['remove_avatar']) && $_POST['remove_avatar'] == 1){
		update_user_meta( $current_user->ID, 'custom_avatar', '-1' );
	}
    /* Redirect so the page will show updated info. */
   // if ( !$error ) {
		$redirect_url   = get_permalink();
				if(isset($error) && $error != ''){  
					$msg        = array( 'error' => "true" );
				}else{	
					$msg        = array( 'success' => "true" );	
				}
                $_url    = add_query_arg( $msg , $redirect_url );

        wp_redirect( $_url );
        exit;
   // }
}
?>