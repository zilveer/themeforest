<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 01/04/16
 * Time: 5:11 PM
 */
$terms_conditions = houzez_option('login_terms_condition');
$facebook_login = houzez_option('facebook_login');
$yahoo_login = houzez_option('yahoo_login');
$google_login = houzez_option('google_login');
$enable_password = houzez_option('enable_password');
$user_show_roles = houzez_option('user_show_roles');

$allowed_html_array = array(
    'a' => array(
        'href' => array(),
        'title' => array()
    )
);
?>
<div class="tab-content">
    <div class="tab-pane fade in active">
        <div id="houzez_messages" class="houzez_messages message"></div>
        <form>
            <div class="form-group field-group">
                <div class="input-user input-icon">
                    <input id="login_username" name="username" placeholder="<?php esc_html_e('Username','houzez'); ?>" type="text" />
                </div>
                <div class="input-pass input-icon">
                    <input id="password" name="password" placeholder="<?php esc_html_e('Password','houzez'); ?>" type="password" />
                </div>
            </div>
            <div class="forget-block clearfix">
                <div class="form-group pull-left">
                    <div class="checkbox">
                        <label>
                            <input name="remember" id="remember" type="checkbox">
                            <?php esc_html_e( 'Remember me', 'houzez' ); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group pull-right">
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#pop-reset-pass"><?php esc_html_e( 'Lost your password?', 'houzez' ); ?></a>
                </div>
            </div>

            <?php wp_nonce_field( 'houzez_login_nonce', 'houzez_login_security' ); ?>
            <input type="hidden" name="action" id="login_action" value="houzez_login">
            <button type="submit" class="fave-login-button btn btn-primary btn-block"><?php esc_html_e('Login','houzez');?></button>
        </form>
        <?php if( $facebook_login != 'no' || $google_login != 'no' || $yahoo_login != 'no' ) { ?>
            <hr>
            <?php if( $facebook_login != 'no' ) { ?>
                <button class="facebook-login btn btn-social btn-bg-facebook btn-block"><i class="fa fa-facebook"></i> <?php esc_html_e( 'login with facebook', 'houzez' ); ?></button>
            <?php } ?>
            <?php if( $yahoo_login != 'no' ) { ?>
                <button class="yahoo-login btn btn-social btn-bg-yahoo btn-block"><i class="fa fa-yahoo"></i> <?php esc_html_e( 'login with yahoo', 'houzez' ); ?></button>
            <?php } ?>
            <?php if( $google_login != 'no' ) { ?>
                <button class="google-login btn btn-social btn-bg-google-plus btn-block"><i class="fa fa-google-plus"></i> <?php esc_html_e( 'login with google', 'houzez' ); ?></button>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="tab-pane fade">
        <?php if( get_option('users_can_register') ) { ?>
        <div id="houzez_messages_register" class="houzez_messages_register message"></div>
        <form>
            <div class="form-group field-group">
                <div class="input-user input-icon">
                    <input id="register_username" name="username" type="text" placeholder="<?php esc_html_e('Username','houzez'); ?>" />
                </div>
                <div class="input-email input-icon">
                    <input id="useremail" name="useremail" type="email" placeholder="<?php esc_html_e('Email','houzez'); ?>" />
                </div>

                <?php if( $enable_password == 'yes' ) { ?>
                    <div class="input-pass input-icon">
                        <input id="register_pass" name="register_pass" placeholder="<?php esc_html_e('Password','houzez'); ?>" type="password" />
                    </div>
                    <div class="input-pass input-icon">
                        <input id="register_pass_retype" name="register_pass_retype" placeholder="<?php esc_html_e('Retype Password','houzez'); ?>" type="password" />
                    </div>
                <?php } ?>

            </div>
            <div class="form-group">
                <?php if ( $user_show_roles != 0 ) : ?>
                    <select name="role" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                        <option value="houzez_buyer"> <?php esc_html_e('Buyer', 'houzez'); ?> </option>
                        <option value="houzez_agent"> <?php esc_html_e('Seller( Agent )', 'houzez'); ?> </option>
                    </select>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input name="term_condition" id="term_condition" type="checkbox">
                        <?php echo sprintf( wp_kses(__( 'I agree with your <a href="%s">Terms & Conditions</a>', 'houzez' ), $allowed_html_array), get_permalink($terms_conditions) ); ?>
                    </label>
                </div>
            </div>
            <?php wp_nonce_field( 'houzez_register_nonce', 'houzez_register_security' ); ?>
            <input type="hidden" name="action" value="houzez_register" id="register_action">
            <button type="submit" class="fave-register-button btn btn-primary btn-block"><?php esc_html_e('Register','houzez');?></button>
        </form>
        <?php } else {
            esc_html_e('User registration is disabled in this demo.', 'houzez');
        } ?>
    </div>

</div>
