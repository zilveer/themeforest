<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $woocommerce;
?>

<div class="welcome_username">
    <div class="welcome">
        <?php
        $logged_in = false;
        if( is_user_logged_in() ) {
            $logged_in = true;

            $current_user = wp_get_current_user();

            $user_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
            if( $user_name == ' ' ) {
                $user_name = $current_user->user_login;
            }

            $user_name = _e('Welcome, ', 'yit') . apply_filters( 'yit_welcome_username', $user_name );

            $profile_link = is_shop_installed() ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : get_edit_profile_url($current_user->ID);
        } else {
            $user_name = __('Login / Register', 'yit');
            $profile_link = is_shop_installed() ? get_permalink( get_option('woocommerce_myaccount_page_id') ) : wp_login_url();
        }
        ?>
        <a href="<?php echo $profile_link ?>"><?php echo $user_name ?> <span class="sf-sub-indicator"> +</span></a>
    </div>
    <div class="welcome_menu hidden-phone">

        <div class="welcome_menu_inner">
            <?php if( !$logged_in ): ?>
                <?php if( is_shop_installed() && is_shop_enabled() ): global $woocommerce; ?>
                    <form method="post" action="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ?>" class="group">
                        <input type="text" name="username" id="header_username" placeholder="<?php _e('Username', 'yit') ?>" />
                        <input type="password" name="password" id="header_password" placeholder="<?php _e('Password', 'yit') ?>" />

                        <?php
                        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '<' ) ) {
                            $woocommerce->nonce_field('login', 'login');
                        }
                        else{
                            wp_nonce_field('woocommerce-login');
                        }
                        ?>
                        <input type="submit" class="button" value="<?php _e( 'Login', 'yit' ) ?>" name="login" />

                        <a class="lost_password" href="<?php
                        $lost_password_page_url = function_exists( 'wp_lostpassword_url' ) ? wp_lostpassword_url() : get_permalink( woocommerce_get_page_id( 'lost_password' ) );
                        if ( $lost_password_page_url )
                            echo esc_url( $lost_password_page_url );
                        else
                            echo esc_url( wp_lostpassword_url( home_url() ) );
                        ?>"><?php _e( 'Lost password?', 'yit' ); ?></a>


                        <?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
                            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ?>" class="create_account"><?php echo apply_filters( 'yit_header_welcome_register_label', __('Create Account', 'yit')) ?></a>
                        <?php endif ?>
                    </form>
                <?php else : ?>
                    <form method="post" action="<?php echo wp_login_url( yit_curPageURL() ); ?>" class="group">
                        <input type="text" name="log" id="header_username" placeholder="<?php _e('Username', 'yit') ?>" />
                        <input type="password" name="pwd" id="header_password" placeholder="<?php _e('Password', 'yit') ?>" />

                        <input type="submit" class="button" value="<?php _e( 'Login', 'yit' ) ?>" name="wp-submit" />
                        <input type="hidden" value="<?php echo yit_curPageURL(); ?>" name="redirect_to" />
                        <input type="hidden" value="1" name="testcookie" />

                        <a class="lost_password" href="<?php echo wp_login_url(); ?>?action=lostpassword" title="<?php _e('Password Lost and Found', 'yit') ?>">
                            <?php _e( 'Lost password?', 'yit' ) ?>
                        </a>

                        <?php if (get_option('users_can_register')) : ?>
                            <a href="<?php echo site_url('wp-login.php?registration=disabled') ?>" class="create_account"><?php echo apply_filters( 'yit_header_welcome_register_label', __('Create Account', 'yit')) ?></a>
                        <?php endif ?>
                    </form>
                <?php endif ?>
            <?php endif ?>

        </div>
    </div>
</div>