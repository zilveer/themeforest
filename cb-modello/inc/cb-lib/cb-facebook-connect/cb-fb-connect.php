<?php
/*
 * Faceebook login based on Nextend Facebook Connect
 *
Plugin Name: Nextend Facebook Connect
Plugin URI: http://nextendweb.com/
Description: This plugins helps you create Facebook login and register buttons. The login and register process only takes one click.
Version: 1.4.59
Author: Roland Soos
License: GPL2
*/

/*  Copyright 2012  Roland Soos - Nextend  (email : roland@nextendweb.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/*
* Add login to loginform.
*/
function cb_fb_button_loginform() {

if (!is_user_logged_in ()) {
    if (get_option('cb5_fb_appid') && get_option('cb5_fb_secret')){
        global $pagenow;
        if ('wp-login.php' == $pagenow)
            //echo '<div class="facebook_login"><a href="'.cb_fb_login_url(). (isset($_GET['redirect_to']) ? '&redirect=' . $_GET['redirect_to'] : '') . '" title="Login with Facebook" rel="nofollow"><img src="'.WP_THEME_URL.'/img/f_login.gif" /></a></div>';
            echo '';
        else
            echo '<div class="facebook_login"><a href="'.cb_fb_login_url(). '&redirect=' . get_permalink() . '" title="Login with Facebook" rel="nofollow"><img src="'.WP_THEME_URL.'/img/f_login.gif" /></a></div>';
    }
    }

}
function cb_fb_button_loginform_return() {

    if (!is_user_logged_in ()) {
        if (get_option('cb5_fb_appid') && get_option('cb5_fb_secret')){
            global $pagenow;
            if ('wp-login.php' == $pagenow)
                return '<a href="'.cb_fb_login_url(). (isset($_GET['redirect_to']) ? '&redirect=' . $_GET['redirect_to'] : '') . '" title="Login with Facebook" rel="nofollow" class="fb_link"><img src="'.WP_THEME_URL.'/img/f_login.gif" /></a>';
            else
                return '<a href="'.cb_fb_login_url(). '&redirect=' . get_permalink() . '" title="Login with Facebook" rel="nofollow" class="fb_link"><img src="'.WP_THEME_URL.'/img/f_login.gif" /></a>';
        }
    }


}
//add_action('register_form', 'cb_fb_button_loginform');
//add_action('login_form', 'cb_fb_button_loginform');
add_action('bp_sidebar_login_form', 'cb_fb_button_loginform');
add_filter('get_avatar', 'cb_fb_insert_avatar', 5, 5);

function cb_fb_insert_avatar($avatar = '', $id_or_email, $size = 96, $default = '', $alt = false) {

    $id = 0;
    if (is_numeric($id_or_email)) {
        $id = $id_or_email;
    } else if (is_string($id_or_email)) {
        $u = get_user_by('email', $id_or_email);
        $id = $u->id;
    } else if (is_object($id_or_email)) {
        $id = $id_or_email->user_id;
    }
    if ($id == 0) return $avatar;
    $pic = get_user_meta($id, 'cb_fb_profile_picture', true);
    if (!$pic || $pic == '') return $avatar;
    $avatar = preg_replace('/src=("|\').*?("|\')/i', 'src=\'' . $pic . '\'', $avatar);
    return $avatar;
}

add_filter('bp_core_fetch_avatar', 'cb_fb_bp_insert_avatar', 3, 5);

function cb_fb_bp_insert_avatar($avatar = '', $params, $id) {
    if(!is_numeric($id) || strpos($avatar, 'gravatar') === false) return $avatar;
    $pic = get_user_meta($id, 'cb_fb_profile_picture', true);
    if (!$pic || $pic == '') return $avatar;
    $avatar = preg_replace('/src=("|\').*?("|\')/i', 'src=\'' . $pic . '\'', $avatar);
    return $avatar;
}


global $wpdb;
$table_name = $wpdb->prefix . 'cb_social_users';
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    $sql = "CREATE TABLE $table_name (
    `ID` int(11) NOT NULL,
    `type` varchar(20) NOT NULL,
    `identifier` varchar(100) NOT NULL,
    KEY `ID` (`ID`,`type`)
  );";
    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

if(!function_exists('cb_uniqid')){
    function cb_uniqid(){
        if(isset($_COOKIE['cb_uniqid'])){
            if(get_site_transient('n_'.$_COOKIE['cb_uniqid']) !== false){
                return $_COOKIE['cb_uniqid'];
            }
        }
        $_COOKIE['cb_uniqid'] = uniqid('cb', true);
        setcookie('cb_uniqid', $_COOKIE['cb_uniqid'], time() + 3600, '/');
        set_site_transient('n_'.$_COOKIE['cb_uniqid'], 1, 3600);

        return $_COOKIE['cb_uniqid'];
    }
}







function cb_fb_add_query_var() {

global $wp;
//$wp->add_query_var('editProfileRedirect');
$wp->add_query_var('cbloginFacebook');
// $wp->add_query_var('loginFacebookdoauth');
}
add_filter('init', 'cb_fb_add_query_var');

function cb_fb_login_compat() {

global $wp;
if ($wp->request == 'cbloginFacebook' || isset($wp->query_vars['cbloginFacebook'])) {
cb_fb_login_action();
}
}
add_action('parse_request', 'cb_fb_login_compat');

/*
For login page
*/

function cb_fb_login() {

if (isset($_REQUEST['cbloginFacebook']) && $_REQUEST['cbloginFacebook'] == '1') {
cb_fb_login_action();
}
}
add_action('login_init', 'cb_fb_login');


function cb_fb_login_action() {

global $wp, $wpdb, $new_cb_fb_settings;
if (isset($_GET['action']) && $_GET['action'] == 'unlink') {
$user_info = wp_get_current_user();
if ($user_info->ID) {
$wpdb->query($wpdb->prepare('DELETE FROM ' . $wpdb->prefix . 'cb_social_users
WHERE ID = %d
AND type = \'fb\'', $user_info->ID));
set_site_transient($user_info->ID.'_new_fb_admin_notice',__('Your Facebook profile is successfully unlinked from your account.', 'cb-modello'), 3600);
}
cb_fb_redirect();
}
    if(!class_exists('Facebook')){
        require(dirname(__FILE__).'/sdk/facebook.php');
    }

    $settings = maybe_unserialize(get_option('cb_fb_connect'));

    $facebook = new Facebook(array(
        'appId' => get_option('cb5_fb_appid'),
        'secret' => get_option('cb5_fb_secret'),
    ));


$user = $facebook->getUser();
if ($user && is_user_logged_in() && cb_fb_is_user_connected()) {
cb_fb_redirect();
} elseif ($user) {

// Register or Login
try {

// Proceed knowing you have a logged in user who's authenticated.
$user_profile = $facebook->api('/me');
$ID = $wpdb->get_var($wpdb->prepare('
SELECT ID FROM ' . $wpdb->prefix . 'cb_social_users WHERE type = "fb" AND identifier = "%d"
', $user_profile['id']));
if (!get_user_by('id', $ID)) {
$wpdb->query($wpdb->prepare('
DELETE FROM ' . $wpdb->prefix . 'cb_social_users WHERE ID = "%d"
', $ID));
$ID = null;
}
if (!is_user_logged_in()) {
if ($ID == NULL) { // Register

if (!isset($user_profile['email'])) $user_profile['email'] = $user_profile['username'] . '@facebook.com';
$ID = email_exists($user_profile['email']);
if ($ID == false) { // Real register
$random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);
if (!isset($new_cb_fb_settings['fb_user_prefix'])) $new_cb_fb_settings['fb_user_prefix'] = 'fb.';
$sanitized_user_login = sanitize_user($new_cb_fb_settings['fb_user_prefix'] . $user_profile['username']);
if (!validate_username($sanitized_user_login)) {
$sanitized_user_login = sanitize_user('fb.' . $user_profile['id']);
}
$defaul_user_name = $sanitized_user_login;
$i = 1;
while (username_exists($sanitized_user_login)) {
$sanitized_user_login = $defaul_user_name . $i;
$i++;
}
$ID = wp_create_user($sanitized_user_login, $random_password, $user_profile['email']);
if (!is_wp_error($ID)) {
wp_new_user_notification($ID, $random_password);
$user_info = get_userdata($ID);
wp_update_user(array(
'ID' => $ID,
'display_name' => $user_profile['name'],
'first_name' => $user_profile['first_name'],
'last_name' => $user_profile['last_name']
));


} else {
return;
}
}
if ($ID) {
$wpdb->insert($wpdb->prefix . 'cb_social_users', array(
'ID' => $ID,
'type' => 'fb',
'identifier' => $user_profile['id']
) , array(
'%d',
'%s',
'%s'
));
}
}
if ($ID) { // Login

$secure_cookie = is_ssl();
$secure_cookie = apply_filters('secure_signon_cookie', $secure_cookie, array());
global $auth_secure_cookie; // XXX ugly hack to pass this to wp_authenticate_cookie

$auth_secure_cookie = $secure_cookie;
wp_set_auth_cookie($ID, true, $secure_cookie);
$user_info = get_userdata($ID);
update_user_meta($ID, 'cb_fb_profile_picture', 'https://graph.facebook.com/' . $user_profile['id'] . '/picture?type=large');
do_action('wp_login', $user_info->user_login, $user_info);
update_user_meta($ID, 'cb_fb_user_access_token', $facebook->getAccessToken());

}
} else {
$current_user = wp_get_current_user();
if ($current_user->ID == $ID) {

// It was a simple login

} elseif ($ID === NULL) { // Let's connect the accout to the current user!

$wpdb->insert($wpdb->prefix . 'cb_social_users', array(
'ID' => $current_user->ID,
'type' => 'fb',
'identifier' => $user_profile['id']
) , array(
'%d',
'%s',
'%s'
));
update_user_meta($current_user->ID, 'cb_fb_user_access_token', $facebook->getAccessToken());

$user_info = wp_get_current_user();
set_site_transient($user_info->ID.'_new_fb_admin_notice',__('Your Facebook profile is successfully linked with your account. Now you can sign in with Facebook easily.', 'cb-modello'), 3600);
} else {
$user_info = wp_get_current_user();
set_site_transient($user_info->ID.'_new_fb_admin_notice',__('This Facebook profile is already linked with other account. Linking process failed!', 'cb-modello'), 3600);
}
}
cb_fb_redirect();
}
catch(FacebookApiException $e) {
echo 'Caught exception: ', $e->getMessage() , "\n";

//echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
$user = null;
}
exit;
} else if(!isset($_GET['code'])){
$scope = apply_filters('cb_fb_scope', 'email');
$loginUrl = $facebook->getLoginUrl(array(
'scope' => $scope
));

if (isset($_GET['redirect'])) {
set_site_transient( cb_uniqid().'_fb_r', $_GET['redirect'], 3600);
}
$redirect = get_site_transient( cb_uniqid().'_fb_r');
if ($redirect == '' || $redirect == cb_fb_login_url()) {
set_site_transient( cb_uniqid().'_fb_r', site_url(), 3600);
}

header('Location: ' . $loginUrl);
exit;
}else{
echo "Login error!";
exit;
}

}

function cb_fb_redirect() {

    $redirect = get_site_transient( cb_uniqid().'_fb_r');

    if (!$redirect || $redirect == '' || $redirect == cb_fb_login_url()) {
        if (isset($_GET['redirect'])) {
            $redirect = $_GET['redirect'];
        } else {
            $redirect = site_url();
        }
    }
    header('LOCATION: ' . $redirect);
    delete_site_transient( cb_uniqid().'_fb_r');
    exit;
}

function cb_fb_login_url() {

    return site_url('wp-login.php') . '?cbloginFacebook=1';
}

/*
Is the current user connected the Facebook profile?
*/

function cb_fb_is_user_connected() {

    global $wpdb;
    $current_user = wp_get_current_user();
    $ID = $wpdb->get_var($wpdb->prepare('
    SELECT identifier FROM ' . $wpdb->prefix . 'cb_social_users WHERE type = "fb" AND ID = "%d"
  ', $current_user->ID));
    if ($ID === NULL) return false;
    return $ID;
}