<div class="kleo-login-wrap">

    <div class="login-form-wrapper">
       
        <div class="kleo-pop-title-wrap alternate-color">
            <h3 class="kleo-pop-title"><?php esc_html_e( "Forgot your details?", "buddyapp" ); ?></h3>
        </div>
        
        <?php do_action( 'kleo_before_lostpass_form' );?>
        
        <form name="forgot_form" action="<?php echo home_url('wp-login.php');?>" method="post" class="sq-forgot-form kleo-form-signin">
            <?php wp_nonce_field( 'kleo-ajax-lost-pass-nonce', 'security-lost-pass' ); ?>
            
            <span class="login-input-wrapper">
                <input type="text" id="forgot-email" required name="email" class="form-control login-field">
                <label class="login-label">
                    <span class="login-label-content"><?php esc_html_e("Username or Email",'buddyapp');?></span>
                </label>
            </span>
            
            <div class="kleo-lost-result kleo-result"></div>
            
            <button class="btn btn-lg btn-default btn-block login-button" type="submit"><?php esc_html_e( "Reset Password", "buddyapp" ); ?></button>
            
            <a href="#kleo-login-modal" class="show-login kleo-other-action"><?php esc_html_e( 'I remember my details', 'buddyapp' );?></a>
            
        </form>
        
    </div>

</div>

