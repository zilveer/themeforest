<?php

/* Registration
-------------------------------------------------------------------------------------------------------------------*/

add_action( 'woocommerce_register_form', 'register_form' );
add_filter( 'woocommerce_new_customer_data', 'user_role_data' );

function user_role_data( $data ) {
    if ( ! isset( $_POST[ 'reg_role' ] ) ) {
        return $data;
    }

    $role = esc_attr( $_POST[ 'reg_role' ] );
    $whitelist = get_roles();

    if ( ! in_array( $role, array_keys( $whitelist ) ) ) {
        return $data;
    }

    $data[ 'role' ] = $role;

    return $data;
}

function get_roles() {

    global $wp_roles;

    // get all roles
    $roles = $wp_roles->roles;

    // roles to remove
    $remove = apply_filters( 'jobseek_removed_roles', array( 'administrator', 'editor', 'author', 'contributor', 'shop_manager' ) );

    // remove
    foreach ( $remove as $role ) {
        unset( $roles[ $role ] );
    }

    $values = array_keys( $roles );
    $labels = wp_list_pluck( $roles, 'name' );

    $roles = array_combine( $values, $labels );

    return $roles;

}

function register_form() {

    $default = get_theme_mod( 'default_role' );
    $roles = get_theme_mod( 'enabled_roles', array('employer', 'candidate') );
    $labels = get_roles();

    if ( empty( $roles ) ) {
        return;
    }

    if ( 1 == count( $roles ) ) {
        echo '<input type="hidden" value="' . esc_attr( $roles[0] ) . '" name="reg_role" />';
        return;
    }

    $options = array();

    foreach ( $roles as $value ) {
        // in case things get out of sync
        if ( ! isset( $labels[ $value ] ) ) {
            continue;
        }

        $label = apply_filters( 'jobseek_registration_role_' . $value, $labels[ $value ] );
        $options[] = '<option value="' . $value . '"' . selected( $default, $value, false ) . '>' . esc_attr( $label ) . '</option>';

    }

    $options = implode( '', $options ); ?>

    <p class="form-row form-row-wide">
        <label for="reg_role"><?php _e( 'Register as', 'jobseek' ); ?></label>
        <select name="reg_role" class="postform"><?php echo $options; ?></select>
    </p>
<?php
}

/* Redirect users to custom URL based on their role after login
-------------------------------------------------------------------------------------------------------------------*/

if( !function_exists('wc_custom_user_redirect') ) {
    function wc_custom_user_redirect( $redirect, $user ) {
        // Get the first of all the roles assigned to the user
        $role = $user->roles[0];
        $dashboard = admin_url();
        $myaccount = get_permalink( wc_get_page_id( 'myaccount' ) );
        $emplouer_dashboard = get_permalink( get_page_by_path( 'emplouer_dashboard' ) );
        $candidate_dashboard = get_permalink( get_page_by_path( 'candidate_dashboard' ) );
        if( $role == 'administrator' ) {
            //Redirect administrators to the dashboard
            $redirect = $dashboard;
        } elseif ( $role == 'shop-manager' ) {
            //Redirect shop managers to the dashboard
            $redirect = $dashboard;
        } elseif ( $role == 'editor' ) {
            //Redirect editors to the dashboard
            $redirect = $dashboard;
        } elseif ( $role == 'author' ) {
            //Redirect authors to the dashboard
            $redirect = $dashboard;
        } elseif ( $role == 'customer' || $role == 'subscriber' ) {
            //Redirect customers and subscribers to the "My Account" page
            $redirect = $myaccount;
        } elseif ( $role == 'employer' ) {
            //Redirect employer to the "Employer Dashboard" page
            if(get_option( 'job_manager_job_dashboard_page_id')) { 
                $redirect  = get_permalink(get_option( 'job_manager_job_dashboard_page_id')); 
            } else {
                $redirect = home_url();
            }; 
        } elseif ( $role == 'candidate' ) {
            //Redirect candidate to the "Candidate Dashboard" page
            if(get_option( 'resume_manager_candidate_dashboard_page_id')) { 
                $redirect = get_permalink(get_option( 'resume_manager_candidate_dashboard_page_id')); 
            } else {
                $redirect = home_url();
            };
        } else {
            //Redirect any other role to the previous visited page or, if not available, to the home
            $redirect = wp_get_referer() ? wp_get_referer() : home_url();
        }
        return $redirect;
    }
}

add_filter( 'woocommerce_login_redirect', 'wc_custom_user_redirect', 10, 2 );