<?php
if ( !function_exists('wp_get_current_user') ) :
    function wp_get_current_user() {
        global $current_user;

        get_currentuserinfo();

        return $current_user;
    }
endif;

if ( !function_exists('get_currentuserinfo') ) :
    /**
     * Populate global variables with information about the currently logged in user.
     *
     * Will set the current user, if the current user is not set. The current user
     * will be set to the logged in person. If no user is logged in, then it will
     * set the current user to 0, which is invalid and won't have any permissions.
     *
     * @since 0.71
     * @uses $current_user Checks if the current user is set
     * @uses wp_validate_auth_cookie() Retrieves current logged in user.
     *
     * @return bool|null False on XMLRPC Request and invalid auth cookie. Null when current user set
     */
    function get_currentuserinfo() {
        global $current_user;

        if ( ! empty( $current_user ) ) {
            if ( $current_user instanceof WP_User )
                return;

            // Upgrade stdClass to WP_User
            if ( is_object( $current_user ) && isset( $current_user->ID ) ) {
                $cur_id = $current_user->ID;
                $current_user = null;
                wp_set_current_user( $cur_id );
                return;
            }

            // $current_user has a junk value. Force to WP_User with ID 0.
            $current_user = null;
            wp_set_current_user( 0 );
            return false;
        }

        if ( defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ) {
            wp_set_current_user( 0 );
            return false;
        }

        if ( ! $user = wp_validate_auth_cookie() ) {
            if ( is_blog_admin() || is_network_admin() || empty( $_COOKIE[LOGGED_IN_COOKIE] ) || !$user = wp_validate_auth_cookie( $_COOKIE[LOGGED_IN_COOKIE], 'logged_in' ) ) {
                wp_set_current_user( 0 );
                return false;
            }
        }

        wp_set_current_user( $user );
    }
endif;

if ( !function_exists('get_userdata') ) :
    /**
     * Retrieve user info by user ID.
     *
     * @since 0.71
     *
     * @param int $user_id User ID
     * @return WP_User|bool WP_User object on success, false on failure.
     */
    function get_userdata( $user_id ) {
        return get_user_by( 'id', $user_id );
    }
endif;

if ( !function_exists('get_user_by') ) :
    /**
     * Retrieve user info by a given field
     *
     * @since 2.8.0
     *
     * @param string $field The field to retrieve the user with. id | slug | email | login
     * @param int|string $value A value for $field. A user ID, slug, email address, or login name.
     * @return WP_User|bool WP_User object on success, false on failure.
     */
    function get_user_by( $field, $value ) {
        $userdata = WP_User::get_data_by( $field, $value );

        if ( !$userdata )
            return false;

        $user = new WP_User;
        $user->init( $userdata );

        return $user;
    }
endif;
?>