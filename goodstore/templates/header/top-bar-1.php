<?php global $woocommerce, $yith_wcwl; ?>

<?php
//Vypocitavani sirky prave a leve casti topbaru - kdyz chce nekdo do leva vic textu, tak si vypne nakou kraviny nalevo - a oblast pro text se mu zvetsi
$right_area = 0;
if (jwOpt::get_option('top_bar_login_button', '0') == '1') {
    $right_area = $right_area + 2;
}
if (jwOpt::get_option('top_bar_wishllist', '1') == '1') {
    $right_area = $right_area + 2;
}
if (jwOpt::get_option('top_bar_compare', '0') == '1') {
    $right_area = $right_area + 2;
}
if (jwOpt::get_option('top_bar_cart', 'off') == 'woo') {
    $right_area = $right_area + 3;
}
if (jwOpt::get_option('top_bar_search', '1') == '1') {
    $right_area = $right_area + 3;
}
if($right_area > 9){
    $right_area = 9;
}

$left_area = 12 - $right_area;

$show_left_area = 'hide-mobiles';
if (jwOpt::get_option('top_bar_login_button', '0') == '0' && jwOpt::get_option('top_bar_wishllist', '1') == '0' && jwOpt::get_option('top_bar_cart', 'off') == 'off' && jwOpt::get_option('top_bar_search', '1') == '0') {
    $show_left_area = 'show-mobiles';
}
?>
<div class="col-lg-<?php echo $left_area . ' ' . $show_left_area; ?>  top-bar-1-left">
    <?php $icon = jwOpt::get_option('top_bar_span_icon', ''); ?>
    <?php if ($icon != '') { ?>
        <span class="top-bar-icon <?php echo $icon; ?>"></span>
    <?php } ?>
    <?php $text = jwOpt::get_option('top_bar_span_text', ''); ?>
    <?php if ($text != '') { ?>    
        <span><?php echo do_shortcode($text); ?></span>
    <?php } ?>
</div>
<div class="col-lg-<?php echo $right_area; ?> top-bar-1-right">
    <ul>
        <?php if (jwOpt::get_option('top_bar_login_button', '0') == '1') { ?>
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
                    $text = __('Login', 'jawtemplates');
                }
                ?>
                <a href="<?php echo $myaccount_page_url; ?>">
                    <span class="topbar-title-icon icon-user"></span>
                    <span class="topbar-title-text">                        
                        <?php echo $text; ?>
                    </span>
                    <span class="icon-arrow-down-gs"></span>    
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
        <?php if (class_exists('YITH_Woocompare') && class_exists('WooCommerce')) { ?>
            <?php if (jwOpt::get_option('top_bar_compare', '0') == '1') { ?>
                <li class="compare-contents">
                    <?php echo jaw_get_template_part('compare', array('header', 'top_bar')); ?>
                </li>
            <?php } ?>
        <?php } ?>
        
        
        <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php') && class_exists('WooCommerce')) { ?>
            <?php if (jwOpt::get_option('top_bar_wishllist', '1') == '1') { ?>
                <li class="wishlist-contents">
                    <?php echo jaw_get_template_part('wishlist', array('header', 'top_bar')); ?>
                </li>
            <?php } ?>
        <?php } ?>

        <?php if (class_exists('WooCommerce')) { ?>
            <?php if (jwOpt::get_option('top_bar_cart', 'off') == 'woo') { ?>
                <li class="top-bar-woo-cart" aria-haspopup="true">
                    <?php echo jaw_get_template_part('woo_cart', array('header', 'top_bar')); ?>
                </li>
            <?php } ?>
        <?php } ?>



        <?php if (jwOpt::get_option('top_bar_search', '1') == '1') { ?>    
            <li>
                <?php
                if (jwOpt::get_option('top_bar_search_type', 'wordpress') == 'woo' && class_exists('WooCommerce')) {
                    get_product_search_form();
                } else {
                    get_search_form();
                }
                ?>
            </li>
        <?php } ?>    
    </ul>
</div>