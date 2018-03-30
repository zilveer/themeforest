<?php

if (!is_user_logged_in()) { // Display WordPress login form:
    $args = array(
        'echo' => true,
        'form_id' => 'loginform',
        'label_username' => __('Username', 'jawtemplates'),
        'label_password' => __('Password', 'jawtemplates'),
        'label_remember' => __('Remember Me', 'jawtemplates'),
        'label_log_in' => __('Log In', 'jawtemplates'),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => NULL,
        'value_remember' => false);
    if (jwOpt::get_option('top_bar_login_pageid', '') != '') {
        $args['redirect'] = get_permalink(jwOpt::get_option('top_bar_login_pageid', ''));
    }
    wp_login_form($args);
} else { // If logged in:
    if (!class_exists('WooCommerce')) {

        echo '<div class="usericon">';

        global $userdata, $user_identity;
        get_currentuserinfo();
        echo get_avatar($userdata->ID, 75);

        echo '</div>';
        echo '<div class="user-info">';
        _e('You are logged in as ', 'jawtemplates');
        echo '<strong>' . $user_identity . '</strong>';
        echo '</div>';
        echo '<div class="clear"></div>';
        wp_loginout(home_url()); // Display "Log Out" link.
        echo " | ";
        wp_register('', ''); // Display "Site Admin" link.
    } else {

        if (has_nav_menu('my_account')) {

            wp_nav_menu(array(
                'theme_location' => 'my_account',
                'menu_class' => 'menu',
                'depth' => 0,
            ));
            if (jwOpt::get_option('top_bar_logout', '0') == '1') {
                $logoutLink = '';
                if (jwOpt::get_option('top_bar_logout_pageid', '') != '') {
                    $logoutLink = get_permalink(jwOpt::get_option('top_bar_logout_pageid', ''));
                }
                echo '<ul class="menu">';
                echo '<li><a href="' . wp_logout_url($logoutLink) . '">' . __('Logout', 'jawtemplates') . '</a></li>';
                echo '</ul>';
            }
        } else {
            echo "Define your 'My Account' navigation in Apperance -> Menus";
        }
    }
}