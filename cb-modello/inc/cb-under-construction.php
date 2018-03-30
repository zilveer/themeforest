<?php
$result['message'] ='';
if(isset($_POST['action']) && $_POST['action']=='mailchimp_subscribe'){


    $data = $_POST;

    if (isset($data['email']))$email = $data['email'];
    if (isset($data['fname']))$fname = $data['fname'];else $fname='';
    if (isset($data['sname']))$sname = $data['sname'];else $sname='';
    if (isset($data['mailchimp_list']))$mailchimp_list = $data['mailchimp_list'];

    $result['success'] = false;
    $result['message']= __('Error', 'cb-modello');


    if($email=='' || ! is_email($email)){
        $result['success'] = false;
        $result['message'] = __('Correct email address', 'cb-modello');


    }

    if($mailchimp_list==''){
        $result['success'] = false;
        $result['message'] = __('Mailchimp list isn\'t set','cb-modello');

    }

    if (!class_exists('MailChimp')) require_once(get_template_directory() . '/inc/cb-lib/mailchimp-api-master/MailChimp.class.php');
    $MailChimp = new MailChimp(get_option('cb5_mailchimp_key'));
    $mailresult = $MailChimp->call('lists/subscribe', array(
        'id'                => $mailchimp_list,
        'email'             => array('email'=>$email),
        'merge_vars'        => array('FNAME'=>$fname, 'LNAME'=>$sname),
        'double_optin'      => false,
        'update_existing'   => true,
        'replace_interests' => false,
        'send_welcome'      => false,
    ));
    if(isset($mailresult['email'])){

        $result['success'] = true;
        $result['message'] = __('Correctly added to mail list','cb-modello');


    }
    if(isset($mailresult['status'])&& $mailresult['status']=='error'){
        $result['success'] = false;
        $result['message'] = $mailresult['error'];


    }



}
require_once('cb-shortcodes.php');

$post_id= '';
if(isset($post->ID)) $post_id = $post->ID;
$cb_header_options=cb_get_header_options($post_id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php _e('Under Construction','cb-modello');?>&nbsp;|&nbsp;<?php bloginfo('name'); ?></title>
    <?php
    if($cb_header_options['favi']!=''){?><link rel="shortcut icon" type="image/png" href="<?php echo $cb_header_options['favi']; ?>" />
    <?php } else { ?><link rel="shortcut icon" type="image/png" href="<?php echo WP_THEME_URL; ?>/img/favicon.ico" /><?php } ?>

    <link rel="stylesheet" type="text/css" href="<?php echo WP_THEME_URL; ?>/css/under_construction.css" media="screen" />
    <link rel="stylesheet" href="<?php echo WP_THEME_URL; ?>/inc/assets/css/jquery.countdown.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?php echo WP_THEME_URL; ?>/inc/assets/js/jquery.plugin.min.js"></script>
    <script src="<?php echo WP_THEME_URL; ?>/inc/assets/js/jquery.countdown.min.js"></script>
	<link rel='stylesheet' id='1-css'  href='http://fonts.googleapis.com/css?family=Raleway%3A400%2C500%2C600%2C700&#038;ver=1.0' type='text/css' media='screen' />

</head>

<body style="<?php if(get_option('cb5_under_bg')) echo 'background:'.get_option('cb5_under_bg').';';if(get_option('cb5_under_bg_image')) echo 'background:url('.get_option('cb5_under_bg_image').');background-size:100%;';?>" >

<?php $tint=get_option('cb5_under_tint'); 
if($tint!='no'&&$tint!=''){
if($tint=='skin') { echo '<div class="tint_skin"></div>'; } 
if($tint=='bdark'){ echo '<div class="tint_bdark"></div>'; } 
if($tint=='blight') { echo '<div class="tint_blight"></div>'; }
if($tint=='wdark') { echo '<div class="tint_wdark"></div>'; }
if($tint=='wlight') {echo '<div class="tint_wlight"></div>'; }
if($tint=='tblack') { echo '<div class="tint_tblack"></div>'; }
if($tint=='twhite') { echo '<div class="tint_twhite"></div>'; }
}?>

<div id="under-content">
    <div class="logo">
        <?php if($cb_header_options['show_logo']=='yes'||$cb_header_options['upload_logo']=='') { ?>
            <h1><a href="<?php echo esc_url(home_url()); ?>/"><?php echo $cb_header_options['cb5_logo_text']; ?><?php if($cb_header_options['cb5_logo_text']=='') echo get_bloginfo('name'); ?></a></h1>
            <p class="blog-description"><?php echo $cb_header_options['cb5_logo_slogan']; ?></p>
        <?php } else { if($cb_header_options['ht_bg_image_url']!='') $cb_header_options['upload_logo']=$cb_header_options['ht_bg_image_url']; ?>
            <a href="<?php echo esc_url(home_url()); ?>/"><img src="<?php echo $cb_header_options['upload_logo'];?>" alt="<?php echo $cb_header_options['logo_text']; ?>"/></a>
        <?php } ?>
    </div>
    <h1><?php _e('UNDER CONSTRUCTION','cb-modello');?></h1>
    <h3><?php _e('Come back later.','cb-modello');?></h3><?php  $under_start=get_option('cb5_under_start'); if ($under_start!=''){
        $under_start_array=explode(' ',$under_start);

        $date=explode('/',$under_start_array[0]);
        $time=explode(':',$under_start_array[1]);
        $year = $date[0];
        $month=$date[1];
        $day = $date[2];
        $h= $time[0];
        $min =  $time[1];
        ?>

        <p class="start"><?php _e('We start from','cb-modello');?> <span><?php echo $under_start;?></span></p>
        <div id="defaultCountdown"></div>
        <script>
            $(function () {

                $('#defaultCountdown').countdown({until:new Date(<?php echo $year;?>,<?php echo $month-1;?>,<?php echo $day;?>,<?php echo $h;?>,<?php echo $min;?>)});

            });
        </script> <?php }

    $under_mailchimp=get_option('cb5_under_mailchimp');
    if ($under_mailchimp!=''){
        echo '<div id="mailchimp"><div id="mailchimp_message">'. $result['message'].'</div>';
        $output = '[mailchimp maillist="'.$under_mailchimp.'" button="'.__('Notify me','cb-modello').'" ][/mailchimp]';
        echo apply_filters( 'the_content',do_shortcode($output));
        echo '</div>';
    }
    ?>
</div>
</body>

</html>
