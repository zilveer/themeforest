<?php
/**
 *
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
function cththemes_gather_theme_memPop() {
    $id = (int)$_GET['id'];

    // setup your query to get what you want
    $args = array(
        'post_type' => 'member',
        'post__in' => (array)$id,
        //'is'=> $id,
    );
    $member = new WP_Query($args);

    // initialsise your output
    $output = '<div id="custom-content" class="white-popup-block"><div class="team-modal"><a href="#" class="popup-modal-dismiss"><i class="fa fa-compress"></i></a>';
    // the Loop
    while ($member->have_posts()) : $member->the_post();

        $output .= do_shortcode(get_the_content( ) );

    endwhile;

    $output .= '</div></div>';
    // Reset Query
    wp_reset_postdata();


    echo wp_kses_post($output );

    wp_die( );

}
add_action('wp_ajax_memPop', 'cththemes_gather_theme_memPop');
add_action('wp_ajax_nopriv_memPop', 'cththemes_gather_theme_memPop'); // not really needed

add_action('wp_ajax_nopriv_cth_mailchimp_subscribe', 'cththemes_gather_theme_mailchimp_subscribe_callback');
add_action('wp_ajax_cth_mailchimp_subscribe', 'cththemes_gather_theme_mailchimp_subscribe_callback');

/*
 *  @desc   Register user
*/
require_once get_template_directory().'/inc/classes/Drewm/CTHMailChimp.php';
function cththemes_gather_theme_mailchimp_subscribe_callback() {
    global $cththemes_options;

    

    $output = array();
    $output['success'] = 2;
    $nonce = $_POST['cth_mailchimp_subscribe_nonce'];
    //$cth_captcha_code = esc_sql($_POST['cth_captcha_code']); 
    
    if (!wp_verify_nonce($nonce, 'cth_mailchimp_subscribe_action')) 
        die('<p class="error">Security checked!, Cheatn huh?</p>');

    /*
     * ------------------------------------
     * Mailchimp Email Configuration
     * ------------------------------------
     */
    // $MailChimp = new \Drewm\CTH_MailChimp($cththemes_options['mailchimp_api']);
    $MailChimp = new CTH_MailChimp($cththemes_options['mailchimp_api']);
    $result = $MailChimp->call('lists/subscribe', array(
        'id'                => $cththemes_options['mailchimp_list_id'],
        'email'             => array('email'=> $_POST['email']),
        'merge_vars'        => array('FNAME'=>'', 'LNAME'=>''),
        'double_optin'      => true,
        'update_existing'   => false,
        'replace_interests' => false,
        'send_welcome'      => false,
    ));
    
    if(isset($result->error)){
        echo esc_html($result->error );
    }else{
        echo 'success';
    }

    die;
}