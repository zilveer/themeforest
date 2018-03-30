<?php
if ( ! isset( $style ) ) {
    $style = 'light';
}
$style = $style . '-login';

if ( ! isset( $before_input ) ) {
    $before_input = '';
}
?>

<div class="kleo-login-wrap <?php echo esc_attr( $style );?>"> <!--add .dark-login for the dark version-->
    
    <div class="login-shadow-wrapper">

        <div class="before-login-form-wrapper"><?php do_action( 'kleo_before_login_form' );?></div>
           
        <div class="login-form-wrapper">
            <div class="kleo-pop-title-wrap">
                <h3 class="kleo-pop-title"><?php esc_html_e( "Log in with your credentials", "buddyapp" ); ?></h3>
            </div>

            <?php if ( $before_input != '' ) { ?>
                <div class="login-demo-info">
                    <p><?php echo wp_kses_post($before_input); ?></p>
                </div>
            <?php } ?>

            <form action="<?php echo wp_login_url( apply_filters( 'kleo_modal_login_redirect', home_url('wp-login.php') ) ); ?>" name="login_form" method="post" class="sq-login-form kleo-form-signin">
                <?php wp_nonce_field( 'kleo-ajax-login-nonce', 'security-login' ); ?>
                
                <span class="login-input-wrapper">
                    <input type="text" class="form-control login-field username" required name="log" value="">
                    <label class="login-label">
                        <span class="login-label-content"><?php esc_html_e( "Username", 'buddyapp' );?></span>
                    </label>
                </span>
                
                <span class="login-input-wrapper">
                    <input type="password" class="form-control login-field" required name="pwd" value="">
                    <label class="login-label">
                        <span class="login-label-content"><?php esc_html_e( "Password", 'buddyapp' );?></span>
                    </label>
                </span>
                
                <div class="kleo-result kleo-login-result"></div>
                <button class="btn btn-lg btn-default btn-block login-button" type="submit"><?php esc_html_e( "Sign in", "buddyapp" ); ?></button>
                
                <div class="fancy-checkbox">
                    <input name="rememberme" type="checkbox" value="forever">
                    <label></label>
                    <span><?php esc_html_e( "Remember me", "buddyapp" ); ?></span>
                    <a href="#kleo-lostpass-modal" class="show-lostpass kleo-other-action"><?php esc_html_e( 'Lost your password?', 'buddyapp' );?></a>
                </div>
                <span class="clearfix"></span>
            
                <?php do_action('kleo_after_login_form');?>
            
            </form>
        </div>

        <?php if( get_option( 'users_can_register' ) ) : ?>

            <div class="login-create-account-wrapper">

                <div class="kleo-register-link"><?php esc_html_e( "Don't have an account yet?", "buddyapp"); ?>
                    <a href="<?php if (function_exists('bp_is_active')) bp_signup_page(); else echo esc_url( home_url() ) . "/wp-login.php?action=register"; ?>" class="new-account">
                        <?php esc_html_e( "Create an account", "buddyapp" ); ?>
                    </a>
                </div>

            </div>

        <?php endif; ?>
        
    </div>

</div>




