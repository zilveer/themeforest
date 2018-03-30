<?php
/**
 * Theme options > General Options  > Mailchimp options
 */

$admin_options[] = array (
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( 'MAILCHIMP OPTIONS', 'zn_framework' ),
    "description" => __( 'The options below are related to Mailchimp (Online email marketing) platform integration in Kallyas. ', 'zn_framework' ),
    "id"          => "info_title12",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);

$admin_options[] = array (
	'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( "Mailchimp API KEY", 'zn_framework' ),
    "description" => __( "Paste your mailchimp api key that will be used by the mailchimp widget.", 'zn_framework' ),
    "id"          => "mailchimp_api",
    "std"         => '',
    "type"        => "textarea"
);

$admin_options[] = array (
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( "Secure Connection", 'zn_framework' ),
    "description" => __( "In rare cases this needs to be enabled. MailChimp's API does supporting connecting via SSL for those worried about Man-in-the-Middle attacks/data collection. To use it in the MCAPI wrapper, simply enable this.", 'zn_framework' ),
    "id"          => "mailchimp_secure",
    "std"         => "no",
    "value"         => "yes",
    "type"        => "toggle2"
);

$mailchimp_api = zget_option( 'mailchimp_api', 'general_options' );

if(!empty($mailchimp_api)) {

    include_once( THEME_BASE . '/template_helpers/widgets/mailchimp/MCAPI.class.php' );
    $api_key = $mailchimp_api;

    $mcapi = new MCAPI( $api_key );

    if(zget_option( 'mailchimp_secure', 'general_options', false, 'no' ) == 'yes'){
        $mcapi->useSecure(true);
    }

    $mailchimp_status = '<strong>Refresh to see result!</strong><br><br>';
    $retval = $mcapi->lists();

    $status = '<span style="color:red;">Not Connected!</span>';

    if ($mcapi->errorCode){
        $mailchimp_status .= "Unable to load lists()<br>";
        $mailchimp_status .= "Code: ".$mcapi->errorCode."<br>";

        $errormsg = $mcapi->errorMessage;
        $errorSearch = !empty($errormsg) ? '(<a href="https://www.google.com/search?q='.urlencode($errormsg).'" target="_blank" title="Click to open Google search results about this error.">Search error on Google</a>)' : '';

        $mailchimp_status .= "Msg: ".$errormsg.' '.$errorSearch.' <br>';
        $status = '<span style="color:red;">Not Connected!</span>';
    } else {
        $status = '<span style="color:green;">Connected!</span>';

        $mailchimp_status .= "Lists that matched: ".$retval['total']."<br>";
        $mailchimp_status .= "Lists returned: ".sizeof($retval['data'])."<br><br>";

        foreach ($retval['data'] as $list){
            $mailchimp_status .= "Id: ".$list['id']." - ".$list['name']."<br>";
            $mailchimp_status .= "Web_id: ".$list['web_id']."<br>";
            $mailchimp_status .= "\tSub: ".$list['stats']['member_count']."<br>";
            $mailchimp_status .= "\tUnsub: ".$list['stats']['unsubscribe_count']."<br>";
            $mailchimp_status .= "\tCleaned: ".$list['stats']['cleaned_count']."<br><br>";
        }
    }

    $admin_options[] = array (
        'slug'        => 'mailchimp_options',
        'parent'      => 'general_options',
        "name"        => 'Status - '.$status,
        "description" => $mailchimp_status,
        'type'  => 'zn_title',
        'id'    => 'zn_error_notice',
        'class' => 'zn_full'
    );

}


$admin_options[] = array (
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "mco_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#4zt7-E985Xw', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options'
));
$admin_options[] = zn_options_doc_link_option( 'http://support.hogash.com/documentation/configure-mailchimp/', array(
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'mailchimp_options',
    'parent'      => 'general_options',
));
