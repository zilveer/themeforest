<?php
/**
 * Login Form
 * @version 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( is_user_logged_in() ) {
    return;
}
?>
<form method="post" class="login">

    <?php do_action( 'woocommerce_login_form_start' ); ?>

    <?php if ( $message ) { echo wpautop( wptexturize( $message ) ); } ?>

    <p class="form-row form-row-first">
        <label for="username"><?php _e( 'Username or email', 'yiw' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="username" id="username" />
    </p>

    <p class="form-row form-row-last">
        <label for="password"><?php _e( 'Password', 'yiw' ); ?> <span class="required">*</span></label>
        <input class="input-text" type="password" name="password" id="password" />
    </p>

    <div class="clear"></div>

    <?php do_action( 'woocommerce_login_form' ); ?>

    <p class="form-row">
        <?php wp_nonce_field( 'woocommerce-login' ); ?>
        <input type="submit" class="button" name="login" value="<?php _e( 'Login', 'yiw' ); ?>" />
        <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
        <a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost Password?', 'yiw' ); ?></a>
    </p>

    <div class="clear"></div>

    <?php do_action( 'woocommerce_login_form_end' ); ?>

</form>