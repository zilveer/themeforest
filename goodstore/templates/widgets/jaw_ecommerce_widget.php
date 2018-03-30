<?php global $woocommerce, $yith_wcwl; ?>
<?php
$instance = jaw_template_get_var('instance');
?>

<ul>
    <?php if (isset($instance['login_show']) && $instance['login_show'] == '1') { ?>
        <li class="top-bar-login-content" aria-haspopup="true">
            <?php
            $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
            $myaccount_page_url = '';
            if ($myaccount_page_id) {
                $myaccount_page_url = get_permalink($myaccount_page_id);
            }
            if (is_user_logged_in()) {
                $text = __('My account', 'jawtemplates');
            } else {
                $text = __('Log in', 'jawtemplates');
            }
            ?>
            <a href="<?php echo $myaccount_page_url; ?>">
                <span class="topbar-title-icon icon-user-icon2"></span>
                <span class="topbar-title-text">                        
                    <?php echo $text; ?>
                </span>  
            </a>
            <?php
            $class = '';
            if (class_exists('WooCommerce') && is_user_logged_in()) {
                $class = 'woo-menu';
            }
            ?>
            <div class="top-bar-login-form <?php echo $class; ?>">
                <?php echo jaw_get_template_part('login', array('header', 'top_bar')); ?>
                <?php if (get_option('users_can_register') && !is_user_logged_in()) : ?>
                    <p class="regiter-button">
                        <?php
                        if (class_exists('WooCommerce') && get_option('woocommerce_enable_myaccount_registration') == 'yes') {
                            $register_link = get_permalink($myaccount_page_id);
                        } else {
                            $register_link = esc_url(wp_registration_url());
                        }
                        ?>
                        <?php echo apply_filters('register', sprintf('<a class="btnregiter" href="%s">%s</a>', $register_link, __('Register', 'jawtemplates'))); ?>
                    </p>
                <?php endif; ?>
            </div>                
        </li>
    <?php } ?>
    <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php') && class_exists('WooCommerce')) { ?>
        <?php if (isset($instance['wishlist_show']) && $instance['wishlist_show'] == '1') { ?>
            <li class="wishlist-contents">
                <a  href="<?php echo $yith_wcwl->get_wishlist_url(); ?>">
                    <span class="topbar-title-icon icon-wishlist-icon"></span>
                    <span class="topbar-title-text">
                        <?php _e('Wishlist', 'jawtemplates'); ?>
                    </span>
                </a>
            </li>
        <?php } ?>
    <?php } ?>

    <?php if (class_exists('WooCommerce')) { ?>
        <?php if (isset($instance['cart_show']) && $instance['cart_show'] == '1') { ?>
            <li class="woo-bar-woo-cart woocommerce-page " aria-haspopup="true">
                <?php echo jaw_get_template_part('woo_cart', array('widgets', 'ecommerce_widget')); ?>
            </li>
        <?php } ?>
    <?php } ?>

</ul>
