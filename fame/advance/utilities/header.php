<?php
/*
 * Gets logo image and check for HIGH DPI cookie
 */
if(!function_exists('a13_header_logo')){
    function a13_header_logo() {
        global $apollo13;
        $img_logo = $apollo13->get_option( 'appearance', 'logo_type' ) === 'image';
        $html = '<a'.($img_logo? '' : ' class="text-logo"').' id="logo" href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">';
        if($img_logo){
            $style = $temp ="";
            $src = $apollo13->get_option( 'appearance', 'logo_image' );
            $screen_type = isset($_COOKIE["a13_screen_size"])? $_COOKIE["a13_screen_size"] : 'normal';

            if($screen_type === 'high'){
                $temp = $apollo13->get_option( 'appearance', 'logo_image_high_dpi' );
                if(strlen($temp)){
                    $src = $temp;
                    $style = explode('|', $apollo13->get_option( 'appearance', 'logo_image_high_dpi_sizes' ));
                    //we compare dimensions to set one to auto, so on mobile it will shrink proper
                    $width = ceil(intval($style[0])/2);
                    $height = ceil(intval($style[1])/2);
                    if($width>$height){
                        $height = 'auto';
                        $width .= 'px';
                    }
                    else{
                        $width = 'auto';
                        $height .= 'px';
                    }

                    //we prepare inline style
                    $style = 'width:'.$width.';height:'.$height.';';
                }
            }
            $html .= '<img src="'.esc_url($src).'" style="'.$style.'" alt="'. esc_attr( get_bloginfo( 'name', 'display' ) ).'" />';
        }
        else{
            $html .= $apollo13->get_option( 'appearance', 'logo_text' );
        }

        $html .= '</a>';

        echo $html;
    }
}


/*
 * Header search form
 */
if(!function_exists('a13_header_search')){
    function a13_header_search() {
        echo
            '<div class="search-container">'.
            '<div class="search">'.
            '<span class="fa fa-search open action"></span>';
        get_search_form();
        echo
            '<span class="fa fa-times close action"></span>'.
            '</div>'.
            '</div>';
    }
}


/*
 * Header cart
 */
if(!function_exists('a13_header_wc_cart')){
    function a13_header_wc_cart() {
        global $woocommerce;

        if (a13_is_woocommerce_activated()) {
            $container_classes = 'wc-header-cart';
            $cart_is_empty = $woocommerce->cart->cart_contents_count === 0;
            if($cart_is_empty){
                $container_classes .= ' empty-cart';
            }
            ?>
        <div id="wc-header-cart" class="<?php echo $container_classes; ?>" data-wc-empty="<?php esc_attr_e( __( 'No products in the cart.', 'woocommerce' )); ?>" data-wc-items="<?php esc_attr_e(sprintf(__( '<span class="number">%d</span> product(s) in your cart', 'fame' ), $woocommerce->cart->cart_contents_count )); ?>">
            <?php a13_wc_mini_cart(); ?>
        </div>
        <?php
        }
    }
}


/**
 * Currency switcher
 */
if(!function_exists('a13_wc_currency_switcher')){
    function a13_wc_currency_switcher( $atts = array() ){
        global $sitepress,$woocommerce_wpml;

        $settings = $woocommerce_wpml->get_settings();

        //multi currency enabled?
        if($settings['enable_multi_currency'] != WCML_MULTI_CURRENCIES_INDEPENDENT){
            return;
        }

        $format = isset($settings['wcml_curr_template']) && $settings['wcml_curr_template'] != '' ? $settings['wcml_curr_template']:'%name% (%symbol%) - %code%';
        $wc_currencies = get_woocommerce_currencies();
        $currencies = $settings['currencies_order'];
        $WCML_Multi_Currency_Support = $woocommerce_wpml->multi_currency_support;
        $current = $WCML_Multi_Currency_Support->get_client_currency();
        $current_html = '';
        $arrow_html = '<i class="fa fa-caret-down"></i></a>';
        $list_html = '';
        $counter = 0; //counts number of currencies for current language

        foreach($currencies as $currency){
            if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
                $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                    array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                if($currency == $current){
                    $current_html = '<a href="#" rel="'.$currency.'" class="with-arr">'.$currency_format.'';
                }
                else{
                    $list_html .= '<li rel="'.$currency.'"><a href="#">'.$currency_format.'</a></li>';
                }

                $counter++;
            }
        }

        $list_html = '<ul class="wcml_currency_switcher">'.$list_html.'</ul>';

        if($counter>1){
            echo '<li>'.$current_html.$arrow_html.'</a>'.$list_html.'</li>';
        }
        else{
            echo '<li>'.$current_html.'</a></li>';
        }

    }
}


/*
 * Header top bar
 */
if(!function_exists('a13_header_top_bar')){
    function a13_header_top_bar() {
        global $apollo13;
        $wpml_active        = defined( 'ICL_SITEPRESS_VERSION');
        $wc_active          = a13_is_woocommerce_activated();
        $wcml_active        = defined('WCML_VERSION');
        $wishlist_active    = a13_is_wishlist_active();
        $right_options_menu = $apollo13->get_option( 'appearance', 'top_bar_right_options' );

        $msg_cookie_string = $apollo13->get_option( 'appearance', 'top_bar_new_message' );
        $is_cookie_for_cookies_msg_set = isset($_COOKIE["a13_tb_cookies_msg"]);
        $is_cookie_for_main_msg_set = isset($_COOKIE["a13_tb_main_msg_".$msg_cookie_string]);

        $top_bar_msg        = $apollo13->get_option( 'appearance', 'header_top_message' ) === 'on';
        $top_bar_title      = $apollo13->get_option( 'appearance', 'top_bar_title' );
        $top_bar_text       = do_shortcode($apollo13->get_option( 'appearance', 'top_bar_text' ));
        $top_bar_msg_show   = !$is_cookie_for_main_msg_set && ($apollo13->get_option( 'appearance', 'top_bar_msg_visible' ) === '1');

        $cookie_msg         = $apollo13->get_option( 'appearance', 'header_top_cookie' ) === 'on';
        $cookie_text        = do_shortcode($apollo13->get_option( 'appearance', 'top_bar_cookie_text' ));

        ?>
    <div class="top-bar-container">
        <div class="top-bar">
            <?php if(!$is_cookie_for_cookies_msg_set && $cookie_msg): ?>
            <div class="msg cookie-msg visible">
                <?php echo '<div class="msg_text">'.$cookie_text.'</div>'; ?>
                <a href="#" class="fa fa-times-circle  message-close"></a>
            </div>
            <?php endif; ?>

            <?php if($top_bar_msg): ?>
            <div class="msg top-bar-msg<?php echo $top_bar_msg_show? ' visible' : ''; ?>">
                <?php echo '<div class="msg_text">'.$top_bar_text.'</div>'; ?>
                <a href="#" class="fa fa-times-circle message-close"></a>
            </div>
            <?php endif; ?>

            <?php if($top_bar_msg || $wpml_active || $wc_active): ?>
            <div class="options">
                <div class="part1">
                    <ul>

                    <?php if($top_bar_msg): ?>
                    <li><a href="#" class="message-opener special with-arr<?php echo $top_bar_msg_show? ' active' : ''; ?>"><?php if(strlen($top_bar_title)){ echo $top_bar_title; } ?><i class="fa fa-caret-up"></i></a></li>
                    <?php endif; ?>

                    <?php
                    if($wpml_active){
                        //language switcher
                        $languages = icl_get_languages('skip_missing=0&orderby=name&order=ASC');
                        $lang_html = '<ul>';
                        $selected_lang = '';
                        $current_lang_code = ICL_LANGUAGE_CODE;

                        //build languages list
                        foreach($languages as $lang){
                            if($current_lang_code === $lang['language_code']){
                                $selected_lang = '<a href="'.$lang['url'].'">'.$lang['native_name'].'<i class="fa fa-caret-down"></i></a>';
                            }
                            else{
                                $lang_html .= '<li><a href="'.$lang['url'].'" title="'.$lang['translated_name'].'">'.$lang['native_name'].'</a></li>';
                            }
                        }

                        $lang_html .= '</ul>';

                        echo '<li>'.$selected_lang.$lang_html.'</li>';


                        //currency switcher
                        if($wc_active && $wcml_active){
                            a13_wc_currency_switcher();
                        }
                    }
                    ?>

                    </ul>
                </div>
                <div class="part2">

                    <?php if($wc_active && $right_options_menu === 'woo'): ?>
                    <ul>

                        <?php if(is_user_logged_in()): ?>
                        <li>
                            <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>" class="with-arr"><?php _e( 'My Account', 'fame' ); ?><i class="fa fa-caret-down"></i></a>
                            <ul>
                                <li><a href="<?php echo wc_customer_edit_account_url(); ?>"><?php _e('Edit account', 'fame' ); ?></a></li>
                                <li><a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>"><?php _e( 'Sign out', 'fame' ); ?></a></li>
                            </ul>
                        </li>

                        <?php else: ?>
                        <li><a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>" class="with-arr"><?php _e( 'Sign in', 'fame' ); ?></a></li>
                        <li><a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a></li>

                        <?php endif; ?>

                        <?php
                        if($wishlist_active){
                            $wishlist_number = (int)yith_wcwl_count_products();

                            echo '<li><a href="'.get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ).'"'
                                .' class="wishlist'.($wishlist_number === 0? '' : ' special').'">'
                                .__( 'Wishlist', 'fame' ).'<i class="fa fa-star"></i>'
                                .'<span class="number">'.($wishlist_number === 0? '' : $wishlist_number).'</span>'
                                .'</a></li>';
                        }
                        ?>

                    </ul>
                    <?php else: ?>
                    <?php
                    if ( has_nav_menu( 'top-bar-menu' ) ){
                        //place for 1-4 links
                        wp_nav_menu( array(
                            'container'       => false,
                            'link_before'     => '',
                            'link_after'      => '',
                            'depth'           => 0,
                            'menu_class'      => 'top-bar-menu',
                            'theme_location'  => 'top-bar-menu',
                            'walker'          => new A13_top_bar_menu_walker
                            )
                        );
                    }?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    }
}


/*
 * Displays header menu
 */
if(!function_exists('a13_header_menu')){
    function a13_header_menu(){
        /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.
         * The menu assigned to the primary position is the one used.
         * If none is assigned, the menu with the lowest ID is used.
         */
        ?>
        <div class="menu-container">
        <?php
        if ( has_nav_menu( 'header-menu' ) ):
            wp_nav_menu( array(
                    'container'       => false,
                    'link_before'     => '<span>',
                    'link_after'      => '</span>',
                    'menu_class'      => 'top-menu',
                    'theme_location'  => 'header-menu',
                    'walker'          => new A13_menu_walker)
            );
        else:
            echo '<ul class="top-menu">';
            wp_list_pages(
                array(
                    'link_before'     => '<span>',
                    'link_after'      => '</span>',
                    'title_li' 		  => ''
                )
            );
            echo '</ul>';
        endif;
        ?>
        </div>
    <?php
    }
}