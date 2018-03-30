<?php
add_action( 'init', 'mom_mailchimp_subscribe_init' );
function mom_mailchimp_subscribe_init() {
	// add scripts
        wp_register_script( 'mom_mailchimp_submit', get_template_directory_uri().'/framework/ajax/mailchimp.js',  array('jquery'),'1.0',true);
	wp_localize_script( 'mom_mailchimp_submit', 'momMailchimp', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' ),
		'success' => __('check your email to complete subscription','theme'),
		'error' => __('Email invalid or already subscribed', 'theme'),
		)
	);
        wp_enqueue_script('mom_mailchimp_submit');
	
        // ajax Action
        add_action( 'wp_ajax_mom_mailchimp', 'mom_mailchimp_subscribe' );  
        add_action( 'wp_ajax_nopriv_mom_mailchimp', 'mom_mailchimp_subscribe');
}

function mom_mailchimp_subscribe () {
// stay away from bad guys 
$nonce = $_POST['nonce'];
$list_id = $_POST['list_id'];
if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
die ( 'Nope!' );
$api_key = mom_option('mailchimp_api_key');
if ($api_key != '') {
require(MOM_FW . '/inc/mailchimp/Mailchimp.php');
$Mailchimp = new Mailchimp( $api_key );
$Mailchimp_Lists = new Mailchimp_Lists( $Mailchimp );
if (isset($_POST['email'])) {
$subscriber = $Mailchimp_Lists->subscribe( $list_id, array( 'email' => htmlentities($_POST['email']) ) );
if ( ! empty( $subscriber['leid'] ) ) {
echo "success";
}
else
{
echo "fail";
}
}
}
exit();
}