<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $woocommerce;
if(!isset($woocommerce)) return ;

if ( ! class_exists( 'yit_woocommerce_login' ) ) :

    /**
     * Yit Woocommerce Login Class
     *
     * @since 2.0.0
     */
    class yit_woocommerce_login extends WP_Widget {

        function __construct() {
            $widget_ops  = array(
                'classname'   => 'yit-woocommerce-login',
                'description' => __( 'Display Login Menu in the header of the page. Note: the widget can be used only in the header.', 'yit' )
            );
            $control_ops = array( 'id_base' => 'yit-woocommerce-login' );
            WP_Widget::__construct( 'yit-woocommerce-login', __( 'YIT Wooocommerce Login', 'yit' ), $widget_ops, $control_ops );
        }

        function widget( $args, $instance ) {
            extract( $args );

            $show_logged_out  = isset( $instance['show_logged_out'] ) ? $instance['show_logged_out'] : 'yes';
            $show_logged_out_submenu  = isset( $instance['show_logged_out_submenu'] ) ? $instance['show_logged_out_submenu'] : 'yes';
            $title_logged_out = isset( $instance['title_logged_out'] ) ? $instance['title_logged_out'] : '';
            $show_logged_in   = isset( $instance['show_logged_in'] ) ? $instance['show_logged_in'] : 'yes';
            $nav_menu         = isset( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : '';


            $logged_in = false;
            if ( is_user_logged_in() && $show_logged_in == 'yes' ) {
                $logged_in = true;

                $current_user = wp_get_current_user();

                $user_name= yit_get_welcome_user_name($current_user);

                ?>
                <!-- START LOGGED IN NAVIGATION -->
                <div id="welcome-menu" class="nav dropdown">
                    <ul>
                    <li class="menu-item dropdown"><a href="#"><span class="welcome_username"><?php echo apply_filters( 'yit_welcome_login_label', __('Welcome, ', 'yit') ) . apply_filters( 'yit_welcome_username', $user_name ) ?></span> </a>
                    <?php
                    include_once( YIT_THEME_ASSETS_PATH . '/lib/Walker_Nav_Menu_Div.php' );
                    $nav_args = array(
                        'menu'       => $nav_menu,
                        'container'  => 'div',
                        'container_class' => 'submenu',
                        'menu_class' => 'sub-menu clearfix',
                        'depth'      => 1,
                        'walker'     => new YIT_Walker_Nav_Menu_Div()
                    );

                    wp_nav_menu( $nav_args );
                    ?></li>
                        </ul>

                </div>
                <!-- END LOGGED IN  NAVIGATION -->

            <?php
            }
            elseif ( $show_logged_out == 'yes' ) {

                global $post;

                if( isset( $post ) && is_page( $post ) && get_option('woocommerce_myaccount_page_id') ==  $post->ID ) {
                    return;
                }
                
                $enabled_registration = get_option( 'woocommerce_enable_myaccount_registration' );
                $enabled_registration_class = ( $enabled_registration === 'yes' ) ? 'with_registration' : '';

                $profile_link = is_shop_installed() ? get_permalink( wc_get_page_id( 'myaccount' ) ) : wp_login_url();

                if( function_exists( 'icl_translate' ) ) {
                    $title_logged_out = icl_translate( 'Widgets', 'widget_woocommerce_login_title_logged_out' . sanitize_title( $title_logged_out ), $title_logged_out );
                }

                ?>
                <div id="welcome-menu-login" class="nav">
                    <ul id="menu-welcome-login">
                        <li class="menu-item login-menu">
                            <a href="<?php echo esc_url( $profile_link ) ?>"><?php echo $title_logged_out ?><span class="sf-sub-indicator"> +</span></a>

                            <?php if($show_logged_out_submenu == 'yes'): ?>

                            <div class="submenu clearfix" style="display: none;">
                                <div class="clearfix login-box <?php echo $enabled_registration_class ?>">
                                    <div id="customer_login">
                                    <div class="customer-login-box customer-login-box1">
                                        <h4><?php _e( 'Login', 'yit' ); ?></h4>
                                            <form method="post" class="login">
                                                <?php do_action( 'woocommerce_login_form_start' ); ?>
                                                <div class="form-group">
                                                    <label for="username"><?php _e( 'Username or email address', 'yit' ); ?> <span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password"><?php _e( 'Password', 'yit' ); ?> <span class="required">*</span></label>
                                                    <input class="form-control" type="password" name="password" id="password" />
                                                </div>
                                                <?php do_action( 'woocommerce_login_form' ); ?>
                                                <div class="form-group">
                                                    <?php wp_nonce_field( 'woocommerce-login' ); ?>
                                                    <input type="submit" class="button button-login" name="login" value="<?php _e( 'Login', 'yit' ); ?>" />
                                                    <p class="lost_password">
                                                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost password?', 'yit' ); ?></a>
                                                    </p>
                                                   <!-- <label for="rememberme" class="inline">
                                                        <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'yit' ); ?>
                                                    </label> -->
                                                </div>
                                                <div class="form-group">
                                                    <?php if( defined('NEW_FB_LOGIN') && NEW_FB_LOGIN == 1 && function_exists('new_fb_sign_button') ): ?>
                                                        <div class="fb-connect">

                                                            <div class="btn-fb-login">
                                                                <a href="<?php echo new_fb_login_url() ?>&redirect=<?php echo site_url() ?>/" onclick="window.location = '<?php echo home_url() ?>/wp-login.php?loginFacebook=1&redirect=<?php echo site_url() ?>/'; return false;"><?php echo do_shortcode('[icon icon_size="16" color="inherit" icon_type="theme-icon" icon_theme="facebook"]') ?>Login  with  Facebook</a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

												<?php do_action( 'woocommerce_login_form_end' ); ?>

                                            </form>
                                    </div>
                                        <?php if ( $enabled_registration === 'yes' ) : ?>


                                        <div class="customer-login-box customer-login-box2">

                                            <?php
                                            if(function_exists('wc_print_notices') && (!is_woocommerce() && !is_account_page() && !is_lost_password_page())):?>
                                                <?php wc_print_notices(); ?>
                                            <?php endif; ?>

                                            <h4><?php _e( 'First time here? Create your account', 'yit' ); ?></h4>

                                            <form method="post" class="register" id="login-form">
                                                <?php do_action( 'woocommerce_register_form_start' ); ?>
                                                <?php if ( get_option( 'woocommerce_registration_generate_username' ) === 'no' ) : ?>
                                                    <div class="form-group">
                                                        <label for="reg_username"><?php _e( 'Username', 'yit' ); ?> <span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) esc_attr( $_POST['username'] ); ?>" />
                                                    </div>
                                                <?php endif; ?>

                                                <div class="form-group">
                                                    <label for="reg_email"><?php _e( 'Email address', 'yit' ); ?> <span class="required">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) esc_attr( $_POST['email'] ); ?>" />
                                                </div>

                                                <div class="form-group">
                                                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                                                        <p class="form-row form-row-wide">
                                                            <label for="reg_password"><?php _e( 'Password', 'yit' ); ?> <span class="required">*</span></label>
                                                            <input type="password" class="form-control" name="password" id="reg_password"  />
                                                        </p>

                                                    <?php endif; ?>


                                                </div>


                                                <!-- Spam Trap -->
                                                <div style="<?php echo (is_rtl() ? 'right:-999em' : 'left:-999em'); ?>; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'yit' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

                                                <?php class_exists( 'YITH_Vendors_Frontend_Premium' ) && remove_action( 'woocommerce_register_form', array( YITH_Vendors()->frontend,'register_form' ) ); ?>
                                                <?php do_action( 'woocommerce_register_form' ); ?>
                                                <?php do_action( 'register_form' ); ?>
                                                <?php class_exists( 'YITH_Vendors_Frontend_Premium' ) && add_action( 'woocommerce_register_form', array( YITH_Vendors()->frontend,'register_form' ) ); ?>

                                                <div class="form-group">
                                                    <?php wp_nonce_field( 'woocommerce-register' ); ?>
                                                    <input type="submit" class="button button-register" name="register" value="<?php _e( 'Register &#xffeb;', 'yit' ); ?>" />
                                                </div>

                                                <?php do_action( 'woocommerce_register_form_end' ); ?>

                                            </form>

                                        </div>

                                    </div>
                                <?php endif; ?>
                                </div>

                            </div>

                            <?php endif; ?>

                        </li>
                    </ul>
                </div>
            <?php
            }

        }

        function form( $instance ) {

            $defaults = array(
                'show_logged_out'  => 'yes',
                'title_logged_out' => __( 'Login/Register', 'yit' ),
                'show_logged_in'   => 'yes',
                'nav_menu'         => '',
                'show_logged_out_submenu'   => 'yes',
            );

            $instance = wp_parse_args( (array) $instance, $defaults );
            $menus    = wp_get_nav_menus( array( 'orderby' => 'name' ) );

            ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'show_logged_out' ); ?>"><?php _e( 'Show Logged Out Menu', 'yit' ) ?>:
                    <select id="<?php echo $this->get_field_id( 'show_logged_out' ); ?>" name="<?php echo $this->get_field_name( 'show_logged_out' ); ?>">
                        <option value="yes" <?php selected( $instance['show_logged_out'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                        <option value="no" <?php selected( $instance['show_logged_out'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'show_logged_out_submenu' ); ?>"><?php _e( 'Show Logged Out Dropdwon Menu', 'yit' ) ?>:
                    <select id="<?php echo $this->get_field_id( 'show_logged_out_submenu' ); ?>" name="<?php echo $this->get_field_name( 'show_logged_out_submenu' ); ?>">
                        <option value="yes" <?php selected( $instance['show_logged_out_submenu'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                        <option value="no" <?php selected( $instance['show_logged_out_submenu'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                    </select>
                </label>
            </p>


            <p>
                <label for="<?php echo $this->get_field_id( 'title_logged_out' ); ?>"><?php _e( 'Title Logged Out', 'yit' ) ?>:
                    <input type="text" id="<?php echo $this->get_field_id( 'title_logged_out' ); ?>" name="<?php echo $this->get_field_name( 'title_logged_out' ); ?>" value="<?php echo $instance['title_logged_out']; ?>" class="widefat" />
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'show_logged_in' ); ?>"><?php _e( 'Show Logged In Menu', 'yit' ) ?>:
                    <select id="<?php echo $this->get_field_id( 'show_logged_in' ); ?>" name="<?php echo $this->get_field_name( 'show_logged_in' ); ?>">
                        <option value="yes" <?php selected( $instance['show_logged_in'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                        <option value="no" <?php selected( $instance['show_logged_in'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                    </select>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Logged In Menu:', 'yit' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
                    <?php
                    foreach ( $menus as $menu ) {
                        echo '<option value="' . $menu->term_id . '"'
                            . selected( $instance['nav_menu'], $menu->term_id, false )
                            . '>' . $menu->name . '</option>';
                    }
                    ?>
                </select>
            </p>
        <?php

        }

        function update( $new_instance, $old_instance ) {
            $instance                     = $old_instance;
            $instance['title_logged_out'] = strip_tags( $new_instance['title_logged_out'] );
            $instance['show_logged_out']  = $new_instance['show_logged_out'];
            $instance['show_logged_in']   = $new_instance['show_logged_in'];
            $instance['nav_menu']         = $new_instance['nav_menu'];
            $instance['show_logged_out_submenu']   = $new_instance['show_logged_out_submenu'];

            return $instance;
        }


    }

endif;
