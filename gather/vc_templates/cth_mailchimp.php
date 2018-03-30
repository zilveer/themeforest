<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $success_msg
 * @var $error_msg
 * @var $layout normal/header
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_MailChimp
 */
$el_class = $success_msg = $error_msg = $layout = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
wp_enqueue_script("gathersubscribe-js", get_template_directory_uri() . "/js/includes/subscribe.min.js", array('jquery','gather-validate-js'), false, true);
//Subscribe Ajax script 
wp_localize_script( 'gathersubscribe-js', 'subscribe_ajax', array(
    'url'        => esc_url(admin_url( 'admin-ajax.php' ) ),
    'site_url'     => esc_url(home_url('/' ) ),
    'theme_url' => get_template_directory_uri(),
    'email_validate' => __("Please enter your email address",'gather'),
    'pl_w' => __('Please wait...','gather'),
) );
?>
<?php if($layout == 'header') :?>
<div class="row <?php echo esc_attr($el_class ); ?>">
    <div class="col-sm-12 col-md-8 col-md-offset-2">
        <form action="<?php echo esc_url(add_query_arg('mailchimp_signup', '1')); ?>" method="post" class="form subscribe-form inverted-form" id="subscribeform">
            <div class="form-group col-sm-12">
                <?php echo wpb_js_remove_wpautop($content,true); ?>
            </div>
            <div class="form-group col-md-7 col-sm-6 col-sm-offset-1 col-md-offset-0">
                <label class="sr-only"><?php _e('Enter address','gather');?></label>
                <input type="email" class="form-control input-lg" placeholder="<?php _e('Enter your email','gather');?>" name="email" id="email" required>
                <div id="js-subscribe-result" class="text-center" data-success-msg="<?php echo esc_attr($success_msg );?>" data-error-msg="<?php echo esc_attr($error_msg );?>"></div>
            </div>
            <?php
                // this prevent automated script for unwanted spam
                if ( function_exists( 'wp_nonce_field' ) ) 
                    wp_nonce_field( 'cth_mailchimp_subscribe_action', 'cth_mailchimp_subscribe_nonce' );
            ?>
            <div class="form-group col-md-5 col-sm-4">
                <button type="submit" class="btn btn-lg btn-default btn-block" id="js-subscribe-btn"><?php _e('Subscribe Now','gather');?></button>
            </div>
        </form>
    </div>
</div>
<div class="header_bottom-bg"></div>
<?php else :?>
<div class="row subscribeform-wrapp <?php echo esc_attr($el_class ); ?>">
    <form action="<?php echo esc_url(add_query_arg('mailchimp_signup', '1')); ?>" method="post" class="form subscribe-form" id="subscribeform">
        <div class="form-group col-md-3 hidden-sm">
            <?php echo wpb_js_remove_wpautop($content,true); ?>
        </div>
        <div class="form-group col-sm-8 col-md-6 wow fadeInRight">
            <label class="sr-only"><?php _e('Enter address','gather');?></label>
            <input type="email" class="form-control input-lg" placeholder="<?php _e('Enter your email','gather');?>" name="email" id="email" required>
            <div id="js-subscribe-result" class="text-center" data-success-msg="<?php echo esc_attr($success_msg );?>" data-error-msg="<?php echo esc_attr($error_msg );?>"></div>
        </div>
        <?php
            // this prevent automated script for unwanted spam
            if ( function_exists( 'wp_nonce_field' ) ) 
                wp_nonce_field( 'cth_mailchimp_subscribe_action', 'cth_mailchimp_subscribe_nonce' );
        ?> 
        <div class="form-group col-sm-4 col-md-3">
            <button type="submit" class="btn btn-lg btn-success btn-block" id="js-subscribe-btn"><?php _e('Subscribe Now →','gather');?></button>
        </div>
    </form>
</div>
<?php endif;?>