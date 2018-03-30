<?php

/**
 * Dynamic style
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 2.0
 */
if (!class_exists('jwStyle')) {

    class jwStyle {

        var $cssFilePath = null;
        var $filename_min = null;
        var $css_path = null;

        function __construct() {
            $this->css_path = THEME_DIR . '/css/';

            $id = get_current_blog_id();

            $this->cssFilePath = $this->css_path . 'custom-styles-' . $id . '.css';
            $this->cssFilePath_min = $this->css_path . 'custom-styles-' . $id . '.min.css';
            add_action('wp_head', array(&$this, 'get_inline'));
        }

        /**
         * get_static
         * Get static css always when reload wp_admin
         * @since: 2
         */
        public function get_static() {

            global $wp_filesystem;

            $css = '';
            $css_min = '';

            $css .= self::get_custom_category_colors();
            $css_min = $css;

            // Remove space after colons
            $css_min = str_replace(': ', ':', $css_min);
            // Remove whitespace
            $css_min = str_replace(array("\r" . PHP_EOL, "\r", "" . PHP_EOL, "\t"), '', $css_min);
            if (!defined('FS_METHOD')) {
                define('FS_METHOD', 'direct');
            }

            WP_Filesystem(null);

            if (file_exists($this->cssFilePath)) {

                $cssFileContent = $wp_filesystem->get_contents($this->cssFilePath);

                if (!is_writable($this->css_path)) {
                    $this->error_write_folder();
                }

                if (is_writable($this->cssFilePath)) {

                    if ($cssFileContent != $css) {

                        $wp_filesystem->put_contents($this->cssFilePath, $css);
                        $wp_filesystem->put_contents($this->cssFilePath_min, $css_min);

                        return true;
                    }
                } else {
                    $this->error_write_file();
                    add_action('admin_notices', array(&$this, 'error_write_file'));
                    return false;
                }
            } else {
                // file missing, save it
                if (is_writable($this->css_path)) {
                    $wp_filesystem->put_contents($this->cssFilePath, $css);
                    $wp_filesystem->put_contents($this->cssFilePath_min, $css_min);

                    return true;
                } else {
                    $this->error_write_file();
                    add_action('admin_notices', array(&$this, 'error_write_folder'));
                    return false;
                }
            }
        }

        public function check_is_writeable() {
            if (is_writable($this->css_path)) {
                add_action('admin_notices', array(&$this, 'error_write_folder'));
                return true;
            } else if (is_writable($this->cssFilePath)) {
                add_action('admin_notices', array(&$this, 'error_write_file'));
                return true;
            } else {
                return false;
            }
        }

        public function error_write_folder() {
            echo '<div id="message" class="updated below-h2"><p><strong>The css folder "' . get_template_directory() . '/css" is not writeable.</strong></p></div>';
        }

        public function error_write_file() {
            echo '<div id="message" class="updated below-h2"><p><strong>The css file "' . get_template_directory() . '/css/custom-styles.css" is not writeable.</strong></p></div>';
        }

        private function get_custom_category_colors() {

            $css = "";

            $background_color = jwOpt::get_option('body_background_color', '#ccc');
            $background_box_color = jwOpt::get_option('body_box_background_color', '#fff');

            $template_color_1 = jwOpt::get_option('template_color_1', '#5E6060');
            $template_color_2 = jwOpt::get_option('template_color_2', '#C1C2C4');
            $template_color_3 = jwOpt::get_option('template_color_3', '#CA181F');
            $template_color_1_rgb = jwStyle::hex2rgb($template_color_1);
            $template_color_2_rgb = jwStyle::hex2rgb($template_color_2);
            $template_color_3_rgb = jwStyle::hex2rgb($template_color_3);

            $top_bar_backgroundcolor = jwOpt::get_option('top_bar_backgroundcolor', '#5E6060');
            $top_bar_fontcolor = jwOpt::get_option('top_bar_fontcolor', '#C1C2C4');
            $top_bar_fontcolor_active = jwOpt::get_option('top_bar_fontcolor_active', '#FFFFFF');
            $logo_bar_backgroundcolor = jwOpt::get_option('logo_bar_backgroundcolor', '#FFFFFF');

            $menu_bar_backgroundcolor = jwOpt::get_option('menu_bar_backgroundcolor', '#ffffff');
            $menu_bar_bordercolor = jwOpt::get_option('menu_bar_bordercolor', '#c1c2c4');
            $menu_bar_font_color = jwOpt::get_option('menu_bar_font_color', '#000000');
            $menu_bar_fontactive_color = jwOpt::get_option('menu_bar_fontactive_color', '#c54747');

            $mobile_menu_bar_backgroundcolor = jwOpt::get_option('mobile_menu_bar_backgroundcolor', jwOpt::get_option('menu_bar_backgroundcolor', '#fafafa'));
            $mobile_menu_bar_font_color = jwOpt::get_option('mobile_menu_bar_font_color', jwOpt::get_option('menu_bar_font_colo', '#00475B'));
            $mobile_menu_bar_fontactive_color = jwOpt::get_option('mobile_menu_bar_fontactive_color', jwOpt::get_option('menu_bar_fontactive_color', '#c94732'));

            $menu_bar_submenu_background_color = jwOpt::get_option('menu_bar_submenu_background_color', '#FBFBFB');
            $menu_bar_submenu_font_color = jwOpt::get_option('menu_bar_submenu_font_color', '#000000');
            $menu_bar_submenu_fontactive_color = jwOpt::get_option('menu_bar_submenu_fontactive_color', '#ffffff');
            $menu_bar_submenu_background_active_color = jwOpt::get_option('menu_bar_submenu_background_active_color', '#c54747');

            $footer_background_color = jwOpt::get_option('footer_background_color', '#5e605f');
            $footer_top_border_color = jwOpt::get_option('footer_top_border_color', '#5e605f');
            $footer_color_1 = jwOpt::get_option('footer_color_1', '#5e605f');
            $footer_color_2 = jwOpt::get_option('footer_color_2', '#5e605f');
            $footer_color_3 = jwOpt::get_option('footer_color_3', '#5e605f');
            $footer_font_color = jwOpt::get_option('footer_font_color', '#ffffff');
            $footer_link_color = jwOpt::get_option('footer_link_color', '#ffffff');
            $footer_link_hover_color = jwOpt::get_option('footer_link_hover_color', '#ff0000');
            $featured_footer_color = jwOpt::get_option('featured_footer_background_color', '#fafafa');

            $page_title_background_color = jwOpt::get_option('page_title_background_color', '#f0f0f1');
            $page_title_font_color = jwOpt::get_option('page_title_font_color', '#464646');
            $page_title_link_color = jwOpt::get_option('page_title_link_color', '#464646');
            $page_title_link_hover_color = jwOpt::get_option('page_title_link_hover_color', '#c11120');

            $font_color = jwOpt::get_option('body_main_font_color', '#000');
            $font_alternative_color = jwOpt::get_option('body_main_alternative_font_color', '#fff');
            $font_link_color = jwOpt::get_option('body_main_color_link', '#494949');
            $font_link_hover_color = jwOpt::get_option('body_main_color_link_hover', '#000');
            $font_sticky_color = jwOpt::get_option('body_sticky_font_color', '#0084A8');

            $post_title_font_color = jwOpt::get_option('post_title_font_color', '#5e605f');
            $post_font_color = jwOpt::get_option('post_font_color', '#000000');
            $post_font_link = jwOpt::get_option('post_font_link', '#5e605f');
            $post_font_link_hover = jwOpt::get_option('post_font_link_hover', '#c11120');

            $product_title_font_color = jwOpt::get_option('product_title_font_color', '#5e605f');
            $product_font_color = jwOpt::get_option('product_font_color', '#000000');
            $product_font_link = jwOpt::get_option('product_font_link', '#5e605f');
            $product_font_link_hover = jwOpt::get_option('product_font_link_hover', '#c11120');
            $product_addtocart_background_color = jwOpt::get_option('product_addtocart_background_color', '#c11120');
            $product_addtocart_font_color = jwOpt::get_option('product_addtocart_font_color', '#ffffff');

            $woo_featured_background_color = jwOpt::get_option('woo_featured_background_color', '#bf1824');
            $woo_featured_font_color = jwOpt::get_option('woo_featured_font_color', '#ffffff');
            $woo_sale_background_color = jwOpt::get_option('woo_sale_background_color', '#bf1824');
            $woo_sale_font_color = jwOpt::get_option('woo_sale_font_color', '#ffffff');
            $woo_new_background_color = jwOpt::get_option('woo_new_background_color', '#188ebf');
            $woo_new_font_color = jwOpt::get_option('woo_new_font_color', '#ffffff');
            $woo_soldout_background_color = jwOpt::get_option('woo_soldout_background_color', '#c1c2c4');
            $woo_soldout_font_color = jwOpt::get_option('woo_soldout_font_color', '#ffffff');
            $woo_categories_opacity = jwOpt::get_option('woo_categories_opacity', '90');

            $message_background_color = jwOpt::get_option('message_background_color', '#8FAE1B');
            $message_font_color = jwOpt::get_option('message_font_color', '#ffffff');
            $messageinfo_background_color = jwOpt::get_option('messageinfo_background_color', '#1E85BE');
            $messageinfo_font_color = jwOpt::get_option('messageinfo_font_color', '#ffffff');
            $messagewarning_background_color = jwOpt::get_option('messagewarning_background_color', '#B81C23');
            $messagewarning_font_color = jwOpt::get_option('messagewarning_font_color', '#ffffff');
            $messageerror_background_color = jwOpt::get_option('messageerror_background_color', '#B81C23');
            $messageerror_font_color = jwOpt::get_option('messageerror_font_color', '#ffffff');

            $comments_background_color = jwOpt::get_option('comments_background_color', '#FBFBFB');
            $comments_font_color = jwOpt::get_option('comments_font_color', '#000000');
            $comments_link_color = jwOpt::get_option('comments_link_color', '#5e605f');
            $comments_link_hover_color = jwOpt::get_option('comments_link_hover_color', '#c11120');

            /* LOGO ************************************************************** */
            $template_logo = jwOpt::get_option('custom_logo', '');
            if (strlen($template_logo) == 0) {
                $template_logo = THEME_URI . '/images/logo/logo.png';
            }
            $size = false;
            if (strlen($template_logo) > 0) {
                $size = @getimagesize($template_logo);
            }
            $menuheight = $size[1];
            if ($size && jwOpt::get_option('logo_retina_ready', '1')) {
                $css .= ".header-logo img {width: " . $size[0] / 2 . "px;}" . PHP_EOL;
                $menuheight = $size[1] / 2;
            }
            if($size && jwOpt::get_option('menu_bar_fix', '0') == 2) {
                $css .= ".jaw-logo-scrollable.row-menu-bar-fixed-on .top-bar.top-bar-jw ul.top-nav > li > a {height: " . $menuheight . "px;}" . PHP_EOL;
            }
            /* END LOGO ********************************************************** */

            /* FONT SETTING ***************************************************** */
            // Font style
            $title_font = jwOpt::get_option('title_font', 'Lato');
            $title_font_size = jwOpt::get_option('big_title_font_size', '24');
            $footer_title_font_size = jwOpt::get_option('footer_big_title_font_size', '22');

            if (preg_match('/(.*?):.*/', $title_font, $matches)) {
                $title_font = $matches[1];
            }
            $font = explode('&', $title_font);
            $title_font = $font[0];
            $title_font = str_replace('+', ' ', $title_font);

            $text_font = jwOpt::get_option('text_font', array('face' => 'Open Sans', 'size' => '14px'));

            if (preg_match('/(.*?):.*/', $text_font['face'], $matches)) {
                $text_font['face'] = $matches[1];
            }
            $font = explode('&', $text_font['face']);
            $text_font['face'] = $font[0];

            $fonts = array("Arial", "Helvetica");

            if (!in_array($title_font, $fonts)) {
                $css .= "h1, h2, h3, h4, h5, h6," . PHP_EOL
                        . ".section-big," . PHP_EOL
                        . ".section-woo," . PHP_EOL
                        . ".row .woocommerce .box .price," . PHP_EOL
                        . ".timeTo-counter," . PHP_EOL
                        . ".widget.woocommerce ul li a," . PHP_EOL
                        . ".ctv_section .textarea," . PHP_EOL
                        . ".row .woocommerce .box .price," . PHP_EOL
                        . "#comments h3,"
                        . ".content-team .content-box h2, "
                        . ".woocommerce .product-style-2 .box .addtowishlist a," . PHP_EOL
                        . " ul.top-nav li," . PHP_EOL
                        . " .main-menu .top-bar-jw li.menu-item," . PHP_EOL
                        . ".font-size.title{font-family: '" . $title_font . "';}" . PHP_EOL;
            }
            if (!in_array($text_font['face'], $fonts)) {
                $css .= "body {font-family: '" . $text_font['face'] . "'}" . PHP_EOL;
                $css .= ".flexbox body {font-family: '" . $text_font['face'] . "'}" . PHP_EOL; //support for compare
                $css .= ".content-small .content-box h2 {font-family: '" . $text_font['face'] . "'}" . PHP_EOL;
                $css .= ".widget_product_categories ul.product-categories li a," . PHP_EOL
                        . ".widget.woocommerce.widget_product_categories ul.product-categories li a," . PHP_EOL
                        . ".font-size.paragraph {font-family: '" . $text_font['face'] . "'}" . PHP_EOL;
            }

            $css .= ".totop-button{background:" . $template_color_1 . ";color:" . $template_color_3 . ";border:1px solid " . $template_color_3 . ";}";
            // Font size
            // Font color
            $css .= "body {font-size: " . $text_font['size'] . "}" . PHP_EOL;
            $css .= ".woocommerce #main .widget_price_filter .price_slider_amount,"
                    . ".woocommerce-page #main .widget_price_filter .price_slider_amount,.post-meta-catagory {font-size: " . $text_font['size'] . "}" . PHP_EOL;
            $css .= "body,.carousel-caption,label {color: " . $font_color . "}" . PHP_EOL;
            $css .= "a,.widget_calendar table td#prev a,.widget_calendar table td#next a {color: " . $font_link_color . "}" . PHP_EOL;
            $css .= "a:hover,a:active, a.active, a:focus,.widget_calendar table td#prev a:hover,.widget_calendar table td#next a:hover {color: " . $font_link_hover_color . "}" . PHP_EOL;

            $css .= "article.sticky h2 a{color: " . $font_sticky_color . "}" . PHP_EOL;
            $css .= "article.sticky h2 a:hover,article.sticky h2 a:focus,article.sticky h2 a:active{color: " . $font_link_hover_color . "}" . PHP_EOL;

            // Post font color
            $css .= ".single-post article.post .entry-content {color: " . $post_font_color . "}" . PHP_EOL;
            $css .= ".single-post article.post h1.entry-title {color: " . $post_title_font_color . "}" . PHP_EOL;
            $css .= ".single-post article.post .entry-content a {color: " . $post_font_link . "}" . PHP_EOL;
            $css .= ".single-post article.post .entry-content a:hover {color: " . $post_font_link_hover . "}" . PHP_EOL;
            $css .= ".single-post article.post .entry-content .meta {color: " . $font_color . "}" . PHP_EOL;
            $css .= ".single-post article.post .entry-content .meta a {color: " . $font_link_color . "}" . PHP_EOL;
            $css .= ".single-post article.post .entry-content .meta a:hover {color: " . $font_link_hover_color . "}" . PHP_EOL;

            // post meta data
            $css .= ".single-post .blog-meta-info-top li.post-meta-post-icon,"
                    . ".single-post .blog-meta-info-top li.post-meta-category,"
                    . ".single-post .blog-meta-info-top li.post-meta-author-date {border-right: 1px solid " . $post_font_link . "}" . PHP_EOL;
            $css .= ".single-post .blog-meta-info-top li.post-meta-post-icon i {color: " . $post_font_link . "}" . PHP_EOL;

            $css .= ".blog-meta-info-top li.post-meta-post-icon,"
                    . ".blog-meta-info-top li.post-meta-category,"
                    . ".blog-meta-info-top li.post-meta-author-date {border-right: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".blog-meta-info-top li.post-meta-post-icon i {color: " . $font_link_color . "}" . PHP_EOL;

            $css .= ".blog-meta-info .post-meta-catagory {border-right: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            $css .= ".woocommerce div.product .entry-summary span.price,"
                    . " .woocommerce-page div.product .entry-summary span.price,"
                    . " .woocommerce #content div.product .entry-summary span.price,"
                    . " .woocommerce #content div.product .entry-summary span.woo_save,"
                    . " .woocommerce-page #content div.product .entry-summary span.price,"
                    . " .woocommerce div.product .entry-summary p.price,"
                    . " .woocommerce-page div.product .entry-summary p.price,"
                    . " .woocommerce #content div.product .entry-summary p.price,"
                    . " .woocommerce .product-style-20 .box .price,"
                    . " .woocommerce-page #content div.product .entry-summary p.price {color: " . $template_color_1 . "}" . PHP_EOL;

            $css .= ".woocommerce div.product .entry-summary .addtowishlist .icon-plus-circle2,"
                    . ".woocommerce div.product .entry-summary .comparebutton .icon-plus-circle2 {color: " . $product_font_link . "}" . PHP_EOL;

            $css .= ".woocommerce .row div.product div.images img,"
                    . " .woocommerce-page .row div.product div.images img,"
                    . " .woocommerce #content .row div.product div.images img,"
                    . " .woocommerce-page #content .row div.product div.images img {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            $css .= ".woocommerce .woocommerce-message a.button,"
                    . ".woocommerce-page .woocommerce-message a.button,"
                    . ".woocommerce .woocommerce-message button.button,"
                    . ".woocommerce-page .woocommerce-message button.button,"
                    . ".woocommerce .woocommerce-message input.button,"
                    . ".woocommerce-page .woocommerce-message input.button,"
                    . ".woocommerce #respond .woocommerce-message input#submit,"
                    . ".woocommerce-page #respond .woocommerce-message input#submit,"
                    . ".woocommerce #content .woocommerce-message input.button,"
                    . ".woocommerce-page #content .woocommerce-message input.button {color: " . $product_addtocart_font_color . ";border: 1px solid " . $product_addtocart_font_color . ";}" . PHP_EOL;

            $css .= ".yith-woocompare-widget a.compare,"
                    . ".yith-woocompare-widget a.clear-all{background: " . $template_color_1 . ";color: " . $font_alternative_color . "}";
            $css .= ".yith-woocompare-widget .products-list > li {border-bottom: 1px solid " . $template_color_2 . ";}" . PHP_EOL;
            $css .= ".widget.yith-woocompare-widget ul.products-list a.remove {color:" . $font_link_color . " ;}" . PHP_EOL;
            $css .= ".widget.yith-woocompare-widget ul.products-list a.remove:hover {color:" . $font_link_hover_color . ";}" . PHP_EOL;

            $woo_product_thumbnails_columns = jwOpt::get_option('woo_product_thumbnails_columns', 3);
            $width_thumbnail = 100 / $woo_product_thumbnails_columns - (3.8 * ($woo_product_thumbnails_columns - 1) / $woo_product_thumbnails_columns);
            $css .= ".woocommerce #content div.product div.thumbnails a, "
                    . ".woocommerce div.product div.thumbnails a, "
                    . ".woocommerce-page #content div.product div.thumbnails a, "
                    . ".woocommerce-page div.product div.thumbnails a{width:" . $width_thumbnail . "%;}";
            // Wishlist 
            $css .= ".woocommerce-page #content table.shop_table.cart.wishlist_table .product-add-to-cart a.add_to_cart.button {background: " . $product_addtocart_background_color . ";color: " . $product_addtocart_font_color . "}" . PHP_EOL;
            $css .= ".woocommerce-page .yith-wcwl-share li a.facebook:before,"
                    . ".woocommerce-page .yith-wcwl-share li a.twitter:before,"
                    . ".woocommerce-page .yith-wcwl-share li a.pinterest:before,"
                    . ".woocommerce-page .yith-wcwl-share li a.email:before,"
                    . ".woocommerce-page .yith-wcwl-share li a.googleplus:before {color: " . $template_color_2 . "}" . PHP_EOL;

            // Compare plugin
            $css .= "table.compare-list .add-to-cart td a {background-color: " . $product_addtocart_background_color . ";color: " . $product_addtocart_font_color . "}" . PHP_EOL;

            // Shopping cart
            $css .= ".woocommerce-page #content .product-quantity .quantity .plus," . PHP_EOL
                    . ".woocommerce-page #content .product-quantity .quantity .minus {" . PHP_EOL
                    . "border: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".woocommerce-page #content .product-quantity .quantity.buttons_added .input-text {border-top: 1px solid " . $template_color_2 . ";border-bottom: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".woocommerce-page #content .product-quantity .quantity .input-text  {border: 1px solid " . $template_color_2 . ";}" . PHP_EOL;
            $css .= ".woocommerce-page #content .woocommerce a.button.alt,"
                    . "#content .woocommerce .woocommerce button.button.alt,"
                    . ".woocommerce-page #content .woocommerce button.button.alt,"
                    . "#content .woocommerce .woocommerce input.button.alt,"
                    . ".woocommerce-page #content .woocommerce input.button.alt,"
                    . ".woocommerce #respond .woocommerce input#submit.alt,"
                    . ".woocommerce-page #respond .woocommerce input#submit.alt,"
                    . ".woocommerce #content .woocommerce input.button.alt,"
                    . ".woocommerce-page #content .woocommerce input.button.alt {background-color: " . $product_addtocart_background_color . ";color: " . $product_addtocart_font_color . "}" . PHP_EOL;
            $css .= ".woocommerce-page #content .woocommerce a.button.alt:hover,"
                    . "#content .woocommerce .woocommerce button.button.alt:hover,"
                    . ".woocommerce-page #content .woocommerce button.button.alt:hover,"
                    . "#content .woocommerce .woocommerce input.button.alt:hover,"
                    . ".woocommerce-page #content .woocommerce input.button.alt:hover,"
                    . ".woocommerce #respond .woocommerce input#submit.alt:hover,"
                    . ".woocommerce-page #respond .woocommerce input#submit.alt:hover,"
                    . ".woocommerce #content .woocommerce input.button.alt:hover,"
                    . ".woocommerce-page #content .woocommerce input.button.alt:hover,"
                    . " #content .woocommerce button.button:hover, "
                    . ".woocommerce-page #content button.button:hover {background-color: " . $product_addtocart_background_color . ";color: " . $product_addtocart_font_color . "}" . PHP_EOL;

            $css .= "#content .woocommerce-page a.button,"
                    . "#content .woocommerce button.button,"
                    . ".woocommerce-page #content button.button,"
                    . "#content .woocommerce input.button,"
                    . ".woocommerce-page .woocommerce input.button,"
                    . ".woocommerce #respond .woocommerce input#submit,"
                    . ".woocommerce-page #respond .woocommerce input#submit,"
                    . ".woocommerce #content .woocommerce input.button,"
                    . ".woocommerce-page #content .woocommerce input.button {background-color: " . $template_color_2 . ";color:#000000;}" . PHP_EOL;

            $css .= "#content .woocommerce-page a.button:hover,"
                    . "#content .woocommerce input.button:hover,"
                    . ".woocommerce-page .woocommerce input.button:hover,"
                    . ".woocommerce #respond .woocommerce input#submit:hover,"
                    . ".woocommerce-page #respond .woocommerce input#submit:hover,"
                    . ".woocommerce #content .woocommerce input.button:hover,"
                    . ".woocommerce-page #content .woocommerce input.button:hover {background-color: " . $template_color_2 . ";color:#000000;}" . PHP_EOL;

            $css .= ".selectricWrapper .selectric .button{background-color:" . $background_box_color . " !important;color:" . $template_color_2 . " !important ;}";
            $css .= ".selectricWrapper .selectric .label{background-color:" . $background_box_color . " !important;color:" . $product_font_color . " !important ;}";
            $css .= ".selectricWrapper.selectricOpen .selectric .label{background-color:" . $template_color_3 . " !important;color:" . $product_font_color . " !important ;}";
            $css .= ".selectricWrapper.selectricOpen .selectricItems li{background-color:" . $background_box_color . " !important;color:" . $product_font_color . " !important ;}";
            $css .= ".selectricWrapper.selectricOpen .selectricItems li.selected{background-color:" . $template_color_3 . " !important;}";
            $css .= ".selectricWrapper .selectric{background:" . $template_color_3 . " !important;border:1px solid " . $template_color_2 . ";}";

            $css .= ".woocommerce .widget_layered_nav ul li.chosen a, .woocommerce-page .widget_layered_nav ul li.chosen a{color: " . $font_link_color . " !important;}";
            $css .= ".woocommerce .widget_layered_nav ul li.chosen a:hover, .woocommerce-page .widget_layered_nav ul li.chosen a:hover{color: " . $font_link_hover_color . " !important;}";

            $css .= ".cart_totals.calculated_shipping .cart-subtotal,"
                    . ".cart_totals.calculated_shipping .total {background-color: " . $template_color_2 . ";color:" . $template_color_3 . "}" . PHP_EOL;
            $css .= "#order_review .shop_table tr.cart-subtotal,"
                    . "#order_review .shop_table tr.total {background-color: " . $template_color_2 . ";}" . PHP_EOL;
            $css .= "#content .woocommerce #payment {background-color: " . $template_color_3 . ";}" . PHP_EOL;
            $css .= "#content .woocommerce #payment div.payment_box {background-color: " . $template_color_2 . "; color: ' . $font_alternative_color . ';}" . PHP_EOL;
            $css .= "#content .woocommerce #payment div.payment_box:after,"
                    . " .woocommerce-page #content #payment div.payment_box:after {border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) " . $template_color_2 . ";}" . PHP_EOL;

            //WOO product categories
            $css .= '.woocommerce .product-category .category-info{background: ' . $template_color_3 . ';background:rgba(' . $template_color_3_rgb[0] . ',' . $template_color_3_rgb[1] . ',' . $template_color_3_rgb[2] . ',' . ($woo_categories_opacity / 100) . ');filter: alpha(opacity=' . ($woo_categories_opacity) . ');color:' . $template_color_1 . ';}';
            $css .= '.woocommerce .product-category:hover .category-info{background-color:' . $template_color_1 . ';color:' . $template_color_3 . ';}';
            $css .= "#content .shop_table.order_details tfoot tr:nth-child(odd) {background-color: " . $template_color_2 . ";}" . PHP_EOL;

            // Total Shipping
            $css .= ".shipping_calculator select.country_to_state," . PHP_EOL
                    . ".shipping_calculator input.input-text {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            // Checkout
            $css .= "#customer_detail s input,#customer_details textarea {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            //Change  address
            $css .= ".woocommerce input,.woocommerce textarea {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;


            // reviews
            $css .= ".woocommerce .woocommerce-tabs #reviews #comments ol.commentlist li:before,"
                    . ".woocommerce-page .woocommerce-tabs #reviews #comments ol.commentlist li:before {color: " . $template_color_2 . "}" . PHP_EOL;

            $css .= ".woocommerce .woocommerce-tabs #reviews #comments ol.commentlist li .comment-text,"
                    . ".woocommerce-page .woocommerce-tabs #reviews #comments ol.commentlist li .comment-text {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            // Product font color
            $css .= ".single-product div.product .entry-summary,.variations label {color: " . $product_font_color . "}" . PHP_EOL;
            $css .= ".single-product div.product .entry-summary h1.entry-title {color: " . $product_title_font_color . "}" . PHP_EOL;
            $css .= ".woocommerce #content .woocommerce.product.compare-button a.compare.button {color: " . $product_font_link . "}" . PHP_EOL;
            $css .= ".single-product div.product .entry-summary a {color: " . $product_font_link . "}" . PHP_EOL;
            $css .= ".single-product div.product .entry-summary a:hover {color: " . $product_font_link_hover . "}" . PHP_EOL;

            $css .= ".single-product div.product .entry-summary .socialshare-icon li a {color: " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".single-product div.product .entry-summary .socialshare-icon li a.link-facebook:hover {color: #3B5998}" . PHP_EOL;
            $css .= ".single-product div.product .entry-summary .socialshare-icon li a.link-twitter:hover {color: #00B6F1}" . PHP_EOL;
            $css .= ".single-product div.product .entry-summary .socialshare-icon li a.link-google:hover {color: #DD4B38}" . PHP_EOL;
            $css .= ".single-product div.product .entry-summary .socialshare-icon li a.link-pinterest:hover {color: #CB2027}" . PHP_EOL;
            $css .= ".single-product div.product .entry-summary .socialshare-icon li a.link-email:hover {color: " . $font_link_hover_color . "}" . PHP_EOL;

            /* END FONT SETTING ************************************************* */

            /* TEMPLATE COLOR *************************************************** */

            // Background patern
            $bg_images_url = get_template_directory_uri() . '/images/bg_texture/';

            // Background image
            $background_banner_img = '';
            if (jwOpt::get_option('background_banner_show', '0') == '1') {
                $background_banner_img = jwOpt::get_option('background_banner', '');
            }
            $background_img = '';
            if (strlen($background_banner_img) > 0) {
                $background_img = $background_banner_img;
            } else {
                $background_img = jwOpt::get_option('background_image', '');
            }
            $bg_img_texture = substr(jwOpt::get_option('background_texture', $bg_images_url . 'none.png'), -8);
            if (strlen($background_img) > 0) {
                $css .= "body, body.custom-background  {background: url(\"" . $background_img . "\") no-repeat fixed 50% 0 " . jwOpt::get_option('body_background_color', '#F1F4ED') . " !important;}" . PHP_EOL;
            } else if (jwOpt::get_option('background_texture', $bg_images_url . 'none.png') != $bg_images_url . 'none.png' && jwOpt::get_option('background_image', '') == '' && $bg_img_texture != 'none.png' && jwOpt::get_option('background_texture', $bg_images_url . 'none.png') != 'no folder') {
                $css .= "body, body.custom-background  {background: url(\"" . jwOpt::get_option('background_texture', $bg_images_url . 'lil_fiber.png') . "\") repeat scroll 0 0 " . jwOpt::get_option('body_background_color', '#F1F4ED') . " !important;}" . PHP_EOL;
            } else if (jwOpt::get_option('background_texture', $bg_images_url . 'none.png') == $bg_images_url . 'none.png' || $bg_img_texture == 'none.png') {
                $css .= "body, body.custom-background {background-color: " . $background_color . " !important;}" . PHP_EOL;
            }

            // Background color
            $css .= ".container, .divider-center-text {background-color: " . $background_box_color . "}" . PHP_EOL;
            $css .= ".post-box .jaw-portfolio.gallery .carousel-control,"
                    . "#content article.content.format-gallery .jaw-gallery .carousel-control {background-color: " . $background_box_color . "}" . PHP_EOL;
            $css .= ".paralax .woocommerce .box,"
                    . ".comments-block .one-comment .comment-dot-border {background-color: " . $background_box_color . "}" . PHP_EOL;
            $css .= ".comments-block .one-comment .comment-dot {background-color: " . $template_color_1 . ";}" . PHP_EOL;
            $css .= ".comments-block .one-comment .comment-arrow:before {color: " . $template_color_3 . "}" . PHP_EOL;

            // TIMEto  =========================================================            
            $css .= ".timeTo-counter.boxed .timeTo .counter {background-color: " . $template_color_3 . ";border: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            /* Top Bar Color **************************************************** */
            // Top Bar Color     
            $css .= ".row-fullwidth .page-top.fullwidth-block {background: none repeat scroll 0 0 " . $top_bar_backgroundcolor . "}" . PHP_EOL;
            $css .= ".top-bar-1-left .top-bar-icon," . PHP_EOL
                    . ".top-bar-1-right .icon-arrow-down-gs," . PHP_EOL
                    . ".top-bar-1-right a span," . PHP_EOL
                    . ".page-top .top-bar-login-content a {color: " . $top_bar_fontcolor . ";}" . PHP_EOL;

            $css .= ".row-fullwidth .page-top," . PHP_EOL
                    . ".top-bar-1-right a span.topbar-wishlist-count," . PHP_EOL
                    . " .top-bar-1-right a span.amount," . PHP_EOL
                    . ".top-bar-1-right a," . PHP_EOL
                    . ".top-bar-1-right a:hover," . PHP_EOL
                    . ".top-bar-1-right a:focus {color: " . $top_bar_fontcolor_active . ";}" . PHP_EOL;
            $css .= ".top-bar-login-form {border-top: 0px solid " . $background_box_color . "; color: " . $top_bar_fontcolor . "}" . PHP_EOL;
            $css .= ".top-bar-login-form input {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            $css .= ".top-bar-login-form .login-submit #wp-submit{background: " . $template_color_1 . ";color: " . $font_alternative_color . ";}" . PHP_EOL;
            $css .= ".top-bar-login-form .login-submit #wp-submit:hover {background: " . $template_color_1 . ";color: " . $font_alternative_color . ";}" . PHP_EOL;

            $css .= ".page-top .top-bar-login-form .regiter-button a.btnregiter{background: " . $template_color_1 . ";color: " . $font_alternative_color . ";}" . PHP_EOL;
            $css .= ".page-top .top-bar-login-form .regiter-button a.btnregiter:hover {background: " . $template_color_1 . ";color: " . $font_alternative_color . ";}" . PHP_EOL;


            $css .= ".top-bar-1-right a.btnregiter {background: " . $menu_bar_bordercolor . ";color: " . $menu_bar_submenu_font_color . ";}" . PHP_EOL;
            $css .= ".top-bar-1-right a.btnregiter:hover {background: " . $menu_bar_submenu_background_active_color . ";color: " . $menu_bar_submenu_fontactive_color . ";}" . PHP_EOL;


            /* End Top Bar Color ************************************************ */

            // LOGIN shortcode *************************************************** */
            $css .= "#jaw_login .login input.input, .registration-form-wrapper #jaw-registration-form  input[type=\"text\"]  {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= "#jaw_login .login #wp-submit, .registration-form-wrapper #jaw-registration-form input.reg-submit {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= "#jaw_login .login #wp-submit:hover, .registration-form-wrapper #jaw-registration-form input.reg-submit:hover {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= "#jaw_login .login #wp-submit:focus, .registration-form-wrapper #jaw-registration-form input.reg-submit:focus {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= "#jaw_login .login .reg-submit {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= "#jaw_login .login .reg-submit :hover {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= "#jaw_login .login .reg-submit :focus {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;


            // Fullwidth Color
            $css .= ".row-fullwidth .fullwidth-block {background: none repeat scroll 0 0 " . $template_color_2 . "}" . PHP_EOL;

            // Logo Bar Color
            $css .= ".row-fullwidth .fullwidth-block.header-small-content {background: none repeat scroll 0 0 " . $logo_bar_backgroundcolor . ";}" . PHP_EOL;

            // Menu Bar Color
            $css .= ".row-fullwidth .fullwidth-block.small-menu.main-menu, #header .small-menu .jaw-menu-bar,"
                    . ".row-fullwidth .fullwidth-block.big-menu.main-menu, #header .big-menu .jaw-menu-bar {background: none repeat scroll 0 0 " . $menu_bar_backgroundcolor . ";}" . PHP_EOL;

            $css .= "#header .big-menu.row-menu-border {border-bottom: 1px solid " . $menu_bar_bordercolor . ";border-top: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;

            $css .= "ul.top-nav-mobile li.jaw-menu-item-depth-0 {border-bottom: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= "ul.top-nav-mobile li:last-child {border-bottom: 0px solid " . $menu_bar_bordercolor . " !important;}" . PHP_EOL;
            $css .= "ul.top-nav-mobile li ul {border-left: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;

            $css .= "ul.top-nav-mobile li.jaw-menu-item-has-widgets ul {border-left: 0px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;

            // CTA
            $css .= ".row-border-solid .ctv_section," . PHP_EOL
                    . ".row-border-solid .ctv_section," . PHP_EOL
                    . ".row-border-solid .ctv_section"
                    . "{border-color: #a5a6a6}" . PHP_EOL;
            $css .= ".cta-icon-link,.cta-icon-link:hover,.cta-icon-link:focus {color: " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".accordion .panel-title a:before {color: " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".accordion .panel-title a:hover:before,.accordion .panel-title a:focus:before {color: " . $font_link_hover_color . "}" . PHP_EOL;

            $css .= ".author_desc,.comments-block .one-comment {background: none repeat scroll 0 0 " . $template_color_3 . "}" . PHP_EOL;
            $css .= ".author_desc div.author_arrow,.comments-block .one-comment .comment-arrow {border-right-color: " . $template_color_3 . "}" . PHP_EOL;
            $css .= ".author_desc div.author_arrow_border,.comments-block .one-comment .comment-arrow-border {border-right-color: " . $template_color_1 . "}" . PHP_EOL;
            $css .= ".author_arrow {color: " . $template_color_3 . "}" . PHP_EOL;

            // Page Title
            $css .= ".row-fullwidth .page-title .fullwidth-block {background-color: " . $page_title_background_color . ";color: " . $page_title_font_color . "}" . PHP_EOL;
            $css .= ".row-fullwidth .page-title .fullwidth-block a,.breadcrumb a:after, .breadcrumb span {color: " . $page_title_link_color . "}" . PHP_EOL;
            $css .= ".row-fullwidth .page-title .fullwidth-block a:hover {color: " . $page_title_link_hover_color . "}" . PHP_EOL;

            //TABs
            $css .= ".jaw-tabs.colored .nav-tabs {background-color: " . $template_color_3 . ";color: " . $font_color . "}" . PHP_EOL;
            $css .= ".jaw-tabs.colored .nav-tabs > li.active > a {border-color: " . $template_color_2 . ";border-top-color: " . $template_color_1 . ";background:" . $background_box_color . "}" . PHP_EOL;
            $css .= ".jaw-tabs.colored .nav-tabs > li > a {border-color: " . $background_box_color . ";}" . PHP_EOL;

            $css .= ".woocommerce div.product .woocommerce-tabs ul.tabs {background-color: " . $template_color_3 . ";color: " . $font_color . "}" . PHP_EOL;
            $css .= ".woocommerce div.product .woocommerce-tabs ul.tabs > li.active > a{border-color: " . $template_color_2 . ";border-top-color: " . $template_color_1 . ";background:" . $background_box_color . "}" . PHP_EOL;
            $css .= ".woocommerce div.product .woocommerce-tabs ul.tabs > li > a{border-color: " . $background_box_color . ";}" . PHP_EOL;

            $css .= ".jaw-tabs .nav-tabs > li.active > a{border-color: " . $template_color_2 . ";border-bottom-color: " . $background_box_color . ";}" . PHP_EOL;

            //carousel, gallery - sipky
            //$css .= ".carousel-control span{background: " . $background_box_color . ";}". PHP_EOL;
            // Accordion
            $css .= ".accordion .panel-acc i {color: " . $template_color_2 . "}" . PHP_EOL;

            // Comments
            $css .= ".comment-item {background: none repeat scroll 0 0 " . $comments_background_color . ";}" . PHP_EOL;
            $css .= ".box_arrow span {color: " . $comments_background_color . "}" . PHP_EOL;
            $css .= "#respond #commentform .form-submit,"
                    . "#respond #commentform .form-submit #submit {background: none repeat scroll 0 0 " . $comments_background_color . ";}" . PHP_EOL;
            $css .= ".comment-item {color: " . $comments_font_color . "}" . PHP_EOL;
            $css .= ".comment-item a {color: " . $comments_link_color . "}" . PHP_EOL;
            $css .= ".comment-item a:hover,.comment-item a:hover {color: " . $comments_link_hover_color . "}" . PHP_EOL;
            $css .= "#commentform input, #commentform textarea {border: 1px solid " . $comments_background_color . "}" . PHP_EOL;

            // Woocommerce
            $css .= ".woocommerce .product-style-1 .box h2," . PHP_EOL
                    . ".woocommerce .product-style-1 .box h2 a," . PHP_EOL
                    . ".woocommerce .product-style-1 .box .price," . PHP_EOL
                    . ".woocommerce .product-style-11 .box h2," . PHP_EOL
                    . ".woocommerce .product-style-11 .box h2 a," . PHP_EOL
                    . ".woocommerce .product-style-11 .box .price," . PHP_EOL
                    . ".woocommerce .product-style-20 .product-box-buttons," . PHP_EOL
                    . ".woocommerce .product-style-20 .product-box-buttons a," . PHP_EOL
                    . ".woocommerce .product-style-0 .box .addtocart a.button:hover,"
                    . "#content .woocommerce .product-style-1 .box .addtocart a.add_to_cart_button.post_name.button.product_type_simple," . PHP_EOL
                    . "#content .woocommerce .product-style-11 .box .addtocart a," . PHP_EOL
                    . "#content .woocommerce .product-style-11 .box .addtocart a:hover"
                    . " {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . ";}" . PHP_EOL;

            $css .= ".woocommerce .product-style-1.featured .box h2,"
                    . ".woocommerce .product-style-1.featured .box h2 a,"
                    . ".woocommerce .product-style-11.featured .box h2,"
                    . ".woocommerce .product-style-11.featured .box h2 a"
                    . " {background-color: " . $woo_featured_background_color . ";color: " . $woo_featured_font_color . "}" . PHP_EOL;

            $css .= "#content .woocommerce .product-style-2 .box .addtocart a.add_to_cart_button.post_name.button.product_type_simple,"
                    . "#content .woocommerce .product-style-2 .box .addtocart a.post_name.button.product_type_external,"
                    . "#content .woocommerce .product-style-2 .box .addtowishlist .icon-plus-circle2 {background: none;color:" . $font_link_color . "}" . PHP_EOL;
            $css .= "#content .woocommerce .product-style-2 .box .addtocart a.add_to_cart_button.post_name.button.product_type_simple:hover {color: " . $font_link_hover_color . "}" . PHP_EOL;
            $css .= "#content .woocommerce .product-style-2 .box:hover .addtocart a.add_to_cart_button.post_name.button.product_type_simple {color: " . $font_link_hover_color . "}" . PHP_EOL;
            $css .= "#content .woocommerce .product-style-2 .box:hover .addtocart a.post_name.button.product_type_externa {color: " . $font_link_hover_color . "}" . PHP_EOL;
            $css .= "#content .woocommerce .product-style-2 .box:hover .product_type_variable {color: " . $font_link_hover_color . "}" . PHP_EOL;
            $css .= "#content .woocommerce .product-style-2 .button.product_type_variable {color: " . $font_link_color . ";background:" . $background_box_color . ";}" . PHP_EOL;
            $css .= "#content .woocommerce .product-style-2 .box:hover .addtowishlist,"
                    . "#content .woocommerce .product-style-2 .box:hover .addtowishlist .icon-plus-circle2 {color: " . $font_link_hover_color . "}" . PHP_EOL;

            $css .= "#content .woocommerce .product-style-3 .box .addtocart a.add_to_cart_button.post_name.button.product_type_simple {background: none repeat scroll 0 0 #5E6060;color:" . $font_alternative_color . "}" . PHP_EOL;
            $css .= "#content .woocommerce .product-style-3 .box .addtocart a.add_to_cart_button.post_name.button.product_type_simple:hover {background: none repeat scroll 0 0 " . $template_color_1 . ";color:" . $font_alternative_color . "}" . PHP_EOL;
            $css .= "#content .woocommerce .product-style-3 .box:hover .addtocart a.add_to_cart_button.post_name.button.product_type_simple {background: none repeat scroll 0 0 " . $template_color_1 . ";color:" . $font_alternative_color . "}" . PHP_EOL;

            $css .= ".woocommerce #content .woocommerce.product.compare-button a.compare.button {background: none;}" . PHP_EOL;
            $css .= ".woocommerce #content .woocommerce.product.compare-button a.compare.button:hover {color: " . $font_link_hover_color . ";}" . PHP_EOL;

            $css .= ".woocommerce .product-style-3 .box," . PHP_EOL
                    . "woocommerce .product-style-2 .box"
                    . " {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            $css .= ".woocommerce .product-style-2 .box:hover," . PHP_EOL
                    . ".woocommerce .product-style-3 .box:hover," . PHP_EOL
                    . ".woocommerce .product-style-10:hover .image"
                    . " {border: 1px solid " . $template_color_1 . "}" . PHP_EOL;

            $css .= ".woocommerce .product-style-2 .box," . PHP_EOL
                    . ".woocommerce .product-style-3 .box"
                    . " {border: 1px solid " . $template_color_2 . ";}" . PHP_EOL;

            $css .= ".woocommerce .product-style-1:hover .box," . PHP_EOL
                    . ".woocommerce .product-style-11:hover .box"
                    . "{border: 1px solid " . $template_color_1 . "}" . PHP_EOL;

            $css .= ".woocommerce .product-style-2:hover .box," . PHP_EOL
                    . ".woocommerce .product-style-3:hover .box"
                    . " {border: 1px solid " . $template_color_1 . "}" . PHP_EOL;

            $css .= ".woocommerce .product-style-0 .box:hover .addtocart a.button," . PHP_EOL
                    . ".woocommerce .product-style-3 .box:hover .addtocart a.post_name," . PHP_EOL
                    . ".row .woocommerce .product-style-3:hover .addtocart a.button," . PHP_EOL
                    . ".woocommerce .product-style-1 .product-box-buttons" . PHP_EOL
                    . " {background: " . $template_color_1 . "}" . PHP_EOL;

            $css .= ".woocommerce .box:hover a.added_to_cart {color: " . $template_color_1 . ";}" . PHP_EOL;

            $css .= ".woocommerce .product-style-2 .box:hover a.button," . PHP_EOL
                    . ".woocommerce .product-style-2 .box:hover a.post_name," . PHP_EOL
                    . ".woocommerce .product-style-2 .box:hover a.add_to_wishlist," . PHP_EOL
                    . ".woocommerce .product-style-2 .box:hover .addtowishlist a," . PHP_EOL
                    . ".woocommerce .product-style-2 .box:hover .addtowishlist"
                    . " {color: " . $font_link_hover_color . "}" . PHP_EOL;

            $css .= ".woocommerce #content .product-style-2 .box a.button{color: " . $font_link_color . ";background:" . $background_box_color . ";}";
            $css .= ".woocommerce #content .product-style-2 .box:hover a.button{color: " . $font_link_hover_color . "}";

            $css .= ".row .woocommerce .box  span.onsale,"
                    . ".woocommerce-page #content span.onsale {background-color: " . $woo_sale_background_color . "; color: " . $woo_sale_font_color . "}" . PHP_EOL;

            $css .= ".row .woocommerce .box  span.wc-new-badge,"
                    . ".woocommerce-page #content span.wc-new-badge {background-color: " . $woo_new_background_color . "; color: " . $woo_new_font_color . "}" . PHP_EOL;

            $css .= ".featured-bar {background-color: " . $woo_featured_background_color . ";color: " . $woo_featured_font_color . "}" . PHP_EOL;

            $woo_soldout_background_color_rgb = jwStyle::hex2rgb($woo_soldout_background_color);
            $woo_soldout_background_color_rgb = 'rgba(' . $woo_soldout_background_color_rgb[0] . ',' . $woo_soldout_background_color_rgb[1] . ',' . $woo_soldout_background_color_rgb[2] . ',0.7)';
            $css .= ".row .woocommerce .box span.soldout,"
                    . ".woocommerce-page #content span.soldout {background-color: " . $woo_soldout_background_color . ";background-color: " . $woo_soldout_background_color_rgb . "; color: " . $woo_soldout_font_color . "}" . PHP_EOL;

            $css .= ".woocommerce #container #content div.product .woocommerce-tabs ul.tabs li.active {border-top: 3px solid " . $template_color_1 . "}" . PHP_EOL;
            $css .= "#respond #commentform .form-submit, #respond #commentform .form-submit #submit {background-color: " . $comments_background_color . "}" . PHP_EOL;
            $css .= "#commentform input,#commentform .comment-form-comment textarea {border: 1px solid " . $comments_background_color . "}" . PHP_EOL;

            $css .= ".woocommerce #main .widget_price_filter .price_slider_wrapper .ui-widget-content,"
                    . ".woocommerce-page #main .widget_price_filter .price_slider_wrapper .ui-widget-content,"
                    . ".woocommerce #main .widget_price_filter .ui-slider .ui-slider-range,"
                    . ".woocommerce-page #main .widget_price_filter .ui-slider .ui-slider-range,"
                    . "#jaw-menu .widget_price_filter .ui-slider .ui-slider-range,"
                    . "#jaw-menu .widget_price_filter .price_slider_wrapper .ui-widget-content {background: none " . $template_color_2 . " repeat scroll 0 0}" . PHP_EOL;
            $css.= ".woocommerce #main .widget_price_filter .ui-slider .ui-slider-handle,"
                    . ".woocommerce-page #main .widget_price_filter .ui-slider .ui-slider-handle,"
                    . "#jaw-menu .widget_price_filter .ui-slider .ui-slider-handle {background-color: " . $template_color_1 . "}" . PHP_EOL;

            $css .= ".woocommerce #main .widget_layered_nav_filters ul li a {background-color: " . $template_color_1 . "; color: " . $font_alternative_color . "}" . PHP_EOL;

            $css .= ".woocommerce #main #content input.button,"
                    . " .woocommerce #main #respond input#submit,"
                    . " .woocommerce #main a.button, .woocommerce button.button,"
                    . " .woocommerce #main input.button,"
                    . " .woocommerce-page #main #content input.button,"
                    . " .woocommerce-page #main #respond input#submit,"
                    . " .woocommerce-page #main a.button,"
                    . " .woocommerce-page #main button.button,"
                    . " .woocommerce-page #main input.button,"
                    . " .woocommerce-page #main .order a.button:hover,"
                    . "#jaw-menu button.button,"
                    . "#jaw-menu input.button,"
                    . "#jaw-menu ul.top-nav .widget_shopping_cart .buttons a,"
                    . "#jaw-menu ul.top-nav .widget_shopping_cart .buttons a:hover,"
                    . "#content .woocommerce .return-to-shop .button.wc-backward,"
                    . "#content .woocommerce .return-to-shop .button.wc-backward:hover,"
                    . "#jaw-menu ul.top-nav .widget_shopping_cart .buttons a:focus,"
                    . ".woocommerce #main #content .order .order-actions .button.view {background: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;

            $css .= '.woocommerce table.shop_table .cart-subtotal > th,
                #content .shop_table.order_details tfoot tr:nth-child(2n+1),
                .woocommerce table.shop_table .cart-subtotal > td,
                .woocommerce #payment .payment_box.payment_method_bacs > p,
                .woocommerce #payment div.payment_box p:last-child, .woocommerce-page #payment div.payment_box p{color: ' . $font_alternative_color . ';}';

            // Newsletter ====================================================================
            $css .= ".widget_wysija_cont .wysija-submit {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= ".widget_wysija_cont .wysija-submit:hover {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= ".widget_wysija_cont .wysija-submit:focus {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;

            //BTN
            $css .= ".btn{background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= ".btn:hover{background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= ".btn:focus{background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;

            //Portfolio        
            $css .= ".portfolio .featured .wrapper{background: " . 'rgba(' . $template_color_2_rgb[0] . ',' . $template_color_2_rgb[1] . ',' . $template_color_2_rgb[2] . ', 0.9)' . "; }" . PHP_EOL;
            $css .= ".portfolio .featured .wrapper .wrapper_icon{color: " . $template_color_1 . "}" . PHP_EOL;
            $css .= ".portfolio .featured .wrapper a{color: " . $template_color_1 . "}" . PHP_EOL;

            // Section names
            $css .= ".section-box, .section-line {border-bottom: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".section-header .section-name {background-color: " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".section-big {color: " . $template_color_1 . ";border-bottom: 1px solid " . $template_color_1 . ";font-size:" . $title_font_size . "px;}" . PHP_EOL;
            $css .= ".section-big-wrapper {border-bottom: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".section-woo {color: " . $template_color_1 . ";border-bottom: 2px solid " . $template_color_1 . "}" . PHP_EOL;
            $css .= ".section-woo-wrapper {border-bottom: 2px solid " . $template_color_2 . ";border-top: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            $css .= ".woo-orderby-form-list-title {color: " . $template_color_2 . ";}" . PHP_EOL;
            $css .= ".woo-orderby-form-list-title:hover {color: " . $template_color_1 . ";}" . PHP_EOL;
            $css .= ".woo-orderby-form-list {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".woo-orderby-form-list {border-top: 1px solid " . $background_box_color . ";}" . PHP_EOL;
            $css .= ".woo-orderby-form:hover .woo-orderby-form-list-title {color: " . $template_color_1 . ";}" . PHP_EOL;

            $css .= "ul.items-sortby-list li a:hover {color: " . $template_color_1 . "}" . PHP_EOL;
            $css .= ".woo-orderby-form:hover {border-top:1px solid " . $template_color_1 . ";border-left:1px solid " . $template_color_2 . ";border-right:1px solid " . $template_color_2 . ";}" . PHP_EOL;

            $css .= "a.post-type-video-icon,a.post-type-video-icon:focus,.carousel-control,.carousel-control:focus {opacity:1;color: " . $template_color_2 . "}" . PHP_EOL;
            $css .= "a.post-type-video-icon:hover,.carousel-control:hover {opacity:1;color: " . $template_color_1 . "}" . PHP_EOL;

            //Category top bar
            $css .= ".category-bar .woo-orderby-form, " . PHP_EOL
                    . ".category-bar .woo-orderby-form:hover {border: 1px solid " . $template_color_2 . ";}" . PHP_EOL;
            $css .= ".category-bar .woo-orderby-form-list {border-top: 1px solid " . $template_color_2 . ";}" . PHP_EOL;
            $css .= ".category-bar .woocommerce-result-count {color: " . $template_color_2 . ";}" . PHP_EOL;

            // PAGINATION
            $css .= ".page-numbers  li  .page-numbers {border-color: " . $template_color_2 . "; color:" . $template_color_2 . ";}" . PHP_EOL;
            $css .= ".page-numbers  li  .page-numbers.current {border-color: " . $template_color_1 . "; color:" . $template_color_1 . ";}" . PHP_EOL;

            //MOREBUTTON
            $css .= ".pagination.infinitemore{border-top: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".pagination.infinitemore .text,#infscr-loading{background:" . $background_box_color . "; color:" . $template_color_2 . ";}" . PHP_EOL;

            // POST PAGINATION
            $css .= "#page-nav a > span.post_page {border-color: " . $template_color_2 . "; color:" . $template_color_2 . ";}" . PHP_EOL;
            $css .= "#page-nav span.post_page {border-color: " . $template_color_1 . "; color:" . $template_color_1 . ";}" . PHP_EOL;
            $css .= "#page-nav a:hover > span.post_page {border-color: " . $template_color_1 . "; color:" . $template_color_1 . ";}" . PHP_EOL;

            // Social widget
            $css .= ".social-icons, .social a {color: " . $template_color_2 . "}" . PHP_EOL;

            //review
            $css .= ".woocommerce-page #content.product-content .panel #comments a.button {background: " . $page_title_background_color . ";color: " . $page_title_font_color . ";}" . PHP_EOL;
            $css .= ".woocommerce-page #content.product-content .panel #comments a.button:hover {background: " . $menu_bar_submenu_background_active_color . ";color: " . $menu_bar_submenu_fontactive_color . ";}" . PHP_EOL;

            // Twitter widget
            $css .= "ul.jw-tweets-widgets-tweets {border-left: 2px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= "ul.jw-tweets-widgets-tweets li .jw-tweets-widgets-icon {background-color: " . $background_box_color . "}" . PHP_EOL;

            // Menu  & Top bar menus     
            $css .= ".top-bar-woo-cart .top-bar-cart-content.woocommerce .buttons .button{background: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= "#header .small-menu.row-menu-border {border-color: " . $menu_bar_bordercolor . "}" . PHP_EOL;
            $css .= "#jaw-menu ul.top-nav ul.sub-menu, .top-bar-cart-content, .top-bar-login-form {background-color: " . $menu_bar_submenu_background_color . "}" . PHP_EOL;
            $css .= ".top-bar-login-form .menu li {background: " . $menu_bar_submenu_background_color . "}" . PHP_EOL;
            $css .= "#jaw-menu ul.top-nav ul.sub-menu li a, " . PHP_EOL
                    . ".top-bar-woo-cart .top-bar-cart-content.woocommerce .product_list_widget > li, " . PHP_EOL
                    . ".top-bar-woo-cart .top-bar-cart-content.woocommerce .product_list_widget > li a, " . PHP_EOL
                    . ".top-bar-woo-cart .top-bar-cart-content.woocommerce .total, " . PHP_EOL
                    . ".top-bar-login-form .menu li a {color: " . $menu_bar_submenu_font_color . "}" . PHP_EOL;

            $css .= "#jaw-menu ul.top-nav > li a {color: " . $menu_bar_font_color . "}" . PHP_EOL;

            $css .= "#jaw-menu ul.top-nav > li.current-menu-item a,"
                    . "#jaw-menu ul.top-nav > li.current-page-parent a,"
                    . "#jaw-menu ul.top-nav > li.current-menu-parent a,"
                    . "#jaw-menu ul.top-nav > li:hover a {color: " . $menu_bar_fontactive_color . "}" . PHP_EOL;

            $css .= "#jaw-menu ul.top-nav ul.sub-menu li a:hover," . PHP_EOL
                    . "#jaw-menu ul.top-nav > li a:focus {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;

            $css .= ".home #jaw-menu ul.top-nav > li.current-menu-item > a,"
                    . ".home #jaw-menu ul.top-nav > li.current-page-parent > a,"
                    . ".home #jaw-menu ul.top-nav > li.current-menu-parent > a {color: " . $menu_bar_font_color . "}" . PHP_EOL;

            $css .= "#jaw-menu ul.top-nav > li > a:hover," . PHP_EOL
                    . "#jaw-menu ul.top-nav > li > a:focus {color: " . $menu_bar_fontactive_color . ";}" . PHP_EOL;

            $css .= "ul.top-nav > li.jaw-menu-item-dropdown ul.sub-menu > li:hover {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;
            $css .= ".top-bar-woo-cart .top-bar-cart-content.woocommerce .buttons .button:hover {color: " . $menu_bar_fontactive_color . "}" . PHP_EOL;

            $css .= ".top-bar-login-form .menu li:hover a {color: " . $menu_bar_fontactive_color . "}" . PHP_EOL;

            $css .= "#jaw-menu ul.top-nav > li.jaw-menu-item-dropdown ul.sub-menu > li:hover > a," . PHP_EOL;
            $css .= "#jaw-menu ul.top-nav > li.jaw-menu-item-dropdown ul.sub-menu > li > a:hover {color: " . $menu_bar_submenu_fontactive_color . ";}" . PHP_EOL;
            $css .= ".top-bar-woo-cart .top-bar-cart-content.woocommerce .buttons .button:focus, " . PHP_EOL
                    . ".top-bar-woo-cart .top-bar-cart-content.woocommerce .buttons .button:hover {color: " . $font_alternative_color . ";}" . PHP_EOL;
            $css .= "ul.top-nav li.jaw-menu-item-dropdown > ul.sub-menu > li, .top-bar-woo-cart .top-bar-cart-content.woocommerce .product_list_widget > li {border-bottom: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= "#header .small-menu ul.top-nav > li > ul.sub-menu, ul.top-nav ul.sub-menu li ul.sub-menu {border-top: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= "ul.top-nav li.jaw-menu-item-fullwidth ul.sub-menu > li ul.sub-menu > li , " . PHP_EOL
                    . ".top-bar-login-form .menu li {border-bottom: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;

            $css .= "ul.top-nav > li > ul.sub-menu {border-bottom: 3px solid " . $template_color_1 . "}" . PHP_EOL;

            $css .= "#jaw-menu ul.jw-tweets-widgets-tweets li .jw-tweets-widgets-icon {background-color: " . $menu_bar_submenu_background_color . "}" . PHP_EOL;
            $css .= "#jaw-menu ul.jw-tweets-widgets-tweets li a {color: #00B6F1 !important;}" . PHP_EOL;

            $css .= ".sub-menu.widget-sub-menu h3 {border-bottom: 1px solid " . $menu_bar_bordercolor . "}" . PHP_EOL;

            $css .= ".sub-menu.widget-sub-menu #rating-widget .rating-widget-row {border-bottom: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= ".sub-menu.widget-sub-menu .widget.tab_post_widget .tab-content .tab-post-row {border-bottom: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;


            // Template menu
            $css .= "#header .top-bar ul.menu ul.sub-menu {background-color: " . $menu_bar_submenu_background_color . "}" . PHP_EOL;
            $css .= "#header .top-bar ul.menu > li > ul.sub-menu {border-bottom: 3px solid " . $template_color_1 . "}" . PHP_EOL;
            $css .= "#header .small-menu ul.menu > li > ul.sub-menu {border-top: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= "#header .big-menu ul.menu > li > ul.sub-menu {border-top: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= "#header .top-bar ul.menu li.menu-item-has-children > ul.sub-menu > li {border-bottom: 1px solid " . $menu_bar_bordercolor . "}" . PHP_EOL;


            // Single post
            $css .= ".jw-rating {background: " . $template_color_3 . "}" . PHP_EOL;
            $css .= ".jw-rating .jw-rating-row{border-bottom: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            $css .= "#content article.content.format-gallery .carousel-control{background-color: " . $background_box_color . "}" . PHP_EOL;

            // rating
            $css .= ".post-box #admin_info {background: " . $template_color_3 . "}" . PHP_EOL;
            $css .= ".post-box #admin_info h3 {border-bottom: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".jw-rating-row-title {background:" . $template_color_1 . "}" . PHP_EOL;
            $css .= ".jw-rating-row-overall-box {background:" . $template_color_1 . "}" . PHP_EOL;
            $css .= ".jaw-rating-row-desc{background:" . $template_color_3 . "}" . PHP_EOL;

            // Author page
            $css .= "#admin_info {background: " . $template_color_3 . "}" . PHP_EOL;
            $css .= ".about_author .author_name  {border-bottom: 1px solid " . $template_color_2 . " }" . PHP_EOL;

            //Share post
            $css .= ".post-box .share_post .share_hearline {}" . PHP_EOL;

            // Product Page
            $css .= ".woocommerce div.product .entry-summary form.cart .variations select,"
                    . ".woocommerce-page div.product .entry-summary form.cart .variations select,"
                    . ".woocommerce #content div.product .entry-summary form.cart .variations select,"
                    . ".woocommerce-page #content div.product .entry-summary form.cart .variations select {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;



            $css .= ".woocommerce div.product .entry-summary form.cart .button,"
                    . ".woocommerce-page div.product .entry-summary form.cart .button,"
                    . ".woocommerce #content div.product .entry-summary form.cart .button,"
                    . ".woocommerce-page #content div.product .entry-summary form.cart .button,"
                    . ".woocommerce-page #content div.product .entry-summary .add-request-quote-button,"
                    . ".woocommerce #content div.product .entry-summary .bundle_form .button {background-color: " . $product_addtocart_background_color . ";color: " . $product_addtocart_font_color . "}" . PHP_EOL;
            $css .= ".woocommerce div.product .entry-summary .bundle_form .button,"
                    . ".woocommerce-page div.product .entry-summary .bundle_form .button,"
                    . ".woocommerce #content div.product .entry-summary .bundle_form .button,"
                    . ".woocommerce-page #content div.product .entry-summary .bundle_form .button {background-color: " . $product_addtocart_background_color . ";color: " . $product_addtocart_font_color . "}" . PHP_EOL;

            // Woocomerce message
            $css .= "#content .woocommerce-message:before {color: " . $message_font_color . "}" . PHP_EOL;
            $css .= "#content .woocommerce-error:before {color: " . $messageerror_font_color . "}" . PHP_EOL;
            $css .= "#content .woocommerce-info:before {color: " . $messageinfo_font_color . "}" . PHP_EOL;

            $css .= "#content .woocommerce-message {background-color: " . $message_background_color . ";color: " . $message_font_color . ";}" . PHP_EOL;
            $css .= "#content .woocommerce-error {background-color: " . $messageerror_background_color . ";color: " . $messageerror_font_color . ";}" . PHP_EOL;
            $css .= "#content .woocommerce-info {background-color: " . $messageinfo_background_color . ";color: " . $messageinfo_font_color . ";}" . PHP_EOL;
            $css .= "#content .woocommerce-message a {color: " . $message_font_color . ";}" . PHP_EOL;
            $css .= "#content .woocommerce-error a {color: " . $messageerror_font_color . ";}" . PHP_EOL;
            $css .= "#content .woocommerce-info a {color: " . $messageinfo_font_color . ";}" . PHP_EOL;

            $css .= ".woocommerce #content .entry-summary .quantity .plus,"
                    . ".woocommerce #content .entry-summary .quantity .minus {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".woocommerce #content .entry-summary .quantity.buttons_added .input-text  {border-top: 1px solid " . $template_color_2 . ";border-bottom: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".woocommerce #content .entry-summary .quantity .input-text  {border: 1px solid " . $template_color_2 . ";}" . PHP_EOL;

            $css .= ".product_meta span.sku_wrapper,"
                    . ".product_meta span.posted_in,"
                    . ".product_meta span.tagged_as {border-top: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            $css .= ".woocommerce #main .widget_shopping_cart .widget_shopping_cart_content .buttons a.button,"
                    . "#main .widget_shopping_cart .widget_shopping_cart_content .buttons a.button {background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;

            // Messages
            $css .= ".panel-success > .panel-heading {background-color: " . $message_background_color . ";color: " . $message_font_color . "}" . PHP_EOL;
            $css .= ".panel-info > .panel-heading {background-color: " . $messageinfo_background_color . ";color: " . $messageinfo_font_color . "}" . PHP_EOL;
            $css .= ".panel-warning > .panel-heading {background-color: " . $messagewarning_background_color . ";color: " . $messagewarning_font_color . "}" . PHP_EOL;
            $css .= ".panel-danger > .panel-heading {background-color: " . $messageerror_background_color . ";color: " . $messageerror_font_color . "}" . PHP_EOL;


            // Contact form
            $css .= ".wpcf7 input,.wpcf7 textarea {border: 1px solid " . $template_color_2 . ";}" . PHP_EOL;
            $css .= ".wpcf7 input.wpcf7-submit {border: 0px;background-color: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= ".wpcf7 input.wpcf7-submit:hover {background-color: " . $template_color_1 . "}" . PHP_EOL;
            $css .= "#content span.wpcf7-not-valid-tip {background-color: " . $messageerror_background_color . ";border-color: " . $messageerror_background_color . ";color: " . $messageerror_font_color . "}" . PHP_EOL;
            $css .= "#content div.wpcf7-validation-errors {background-color: " . $messagewarning_background_color . ";border-color: " . $messagewarning_background_color . ";color: " . $messagewarning_font_color . "}" . PHP_EOL;
            $css .= "#content div.wpcf7-mail-sent-ok {background-color: " . $message_background_color . ";border-color: " . $message_background_color . ";color: " . $message_font_color . "}" . PHP_EOL;

            //newsletter
            $css .= ".widget_wysija_cont input {border: 1px solid " . $template_color_2 . ";}" . PHP_EOL;

            //iframe
            $css .= "iframe {border: 1px solid " . $template_color_2 . ";}" . PHP_EOL;

            // Widget menu
            $css .= ".widget_nav_menu ul.menu > li {background-color: " . $menu_bar_submenu_background_color . ";border-bottom: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= ".widget_nav_menu ul.menu > li > a:hover {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;
            $css .= ".widget_nav_menu ul.menu > li.active-item .widget-menu-dropdown {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;
            $css .= ".widget_nav_menu ul.menu > li.active-item > a {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;
            $css .= ".widget_nav_menu ul.menu > li ul li span, .widget-menu-dropdown {color: " . $menu_bar_bordercolor . "}" . PHP_EOL;
            $css .= ".widget_nav_menu ul.menu > li.current-menu-item a,"
                    . ".widget_nav_menu ul.menu > li.current-menu-item .widget-menu-dropdown {color: " . $menu_bar_fontactive_color . "}" . PHP_EOL;

            $css .= ".jw_login_widget ul.menu > li {background-color: " . $menu_bar_submenu_background_color . ";border-bottom: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= ".jw_login_widget ul.menu > li > a:hover {;color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;
            $css .= ".jw_login_widget ul.menu > li.active-item .widget-menu-dropdown {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;
            $css .= ".jw_login_widget ul.menu > li.active-item > a {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;
            $css .= ".jw_login_widget ul.menu > li ul.sub-menu {background-color: " . $background_box_color . "}" . PHP_EOL;
            $css .= ".jw_login_widget ul.menu > li ul li span, .widget-menu-dropdown {color: " . $menu_bar_bordercolor . "}" . PHP_EOL;

            $css .= "#jaw-menu ul.top-nav ul.sub-menu .widget_nav_menu ul.menu li a {color: " . $menu_bar_submenu_font_color . "}" . PHP_EOL;
            $css .= "#jaw-menu ul.top-nav ul.sub-menu .widget_nav_menu ul.menu li.active-item > a," . PHP_EOL
                    . "#jaw-menu ul.top-nav ul.sub-menu .widget_product_categories ul li.active-item > a," . PHP_EOL
                    . "#jaw-menu ul.top-nav ul.sub-menu .widget_categories ul li.active-item > a {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;

            $css .= "#jaw-menu ul.top-nav ul.sub-menu .widget_nav_menu ul.menu li > ul.sub-menu > li a:hover {color: " . $menu_bar_fontactive_color . "}" . PHP_EOL;


            // WIDGET eCommerce  
            $css .= ".jaw_ecommerce_widget .top-bar-cart-content.woocommerce .buttons .button{background: " . $template_color_1 . ";color: " . $font_alternative_color . "}" . PHP_EOL;
            $css .= ".jaw_ecommerce_widget .top-bar-cart-content.woocommerce .product_list_widget > li, " . PHP_EOL
                    . ".jaw_ecommerce_widget .top-bar-cart-content.woocommerce .product_list_widget > li a, " . PHP_EOL
                    . ".jaw_ecommerce_widget .top-bar-cart-content.woocommerce .total {color: " . $menu_bar_submenu_font_color . "}" . PHP_EOL;
            $css .= ".jaw_ecommerce_widget .top-bar-cart-content.woocommerce .buttons .button:hover {color: " . $menu_bar_fontactive_color . "}" . PHP_EOL;
            $css .= ".jaw_ecommerce_widget .top-bar-cart-content.woocommerce .buttons .button:focus, " . PHP_EOL
                    . ".jaw_ecommerce_widget .top-bar-cart-content.woocommerce .buttons .button:hover {color: " . $font_alternative_color . ";}" . PHP_EOL;
            $css .= ".jaw_ecommerce_widget .top-bar-login-form .regiter-button a.btnregiter{background: " . $template_color_1 . ";color: " . $font_alternative_color . ";}" . PHP_EOL;
            $css .= ".jaw_ecommerce_widget .top-bar-login-form .regiter-button a.btnregiter:hover {background: " . $template_color_1 . ";color: " . $font_alternative_color . ";}" . PHP_EOL;


            // Posts category
            $css .= ".widget_categories > ul > li {background-color: " . $menu_bar_submenu_background_color . ";border-bottom: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= ".widget_categories ul > li ul.children {background-color: " . $background_box_color . "}" . PHP_EOL;
            $css .= ".widget_categories ul > li.active-item {color: " . $menu_bar_submenu_fontactive_color . ";}" . PHP_EOL;
            $css .= ".widget_categories ul > li.active-item ul li {color: " . $font_link_color . ";}" . PHP_EOL;
            $css .= ".widget_categories ul > li.active-item > a," . PHP_EOL
                    . ".widget_categories ul > li.active-item > div.widget-menu-dropdown {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;

            // Product category
            $css .= ".widget_product_categories ul.product-categories > li {background-color: " . $menu_bar_submenu_background_color . ";border-bottom: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;
            $css .= ".widget_product_categories ul.product-categories > li ul.children {background-color: " . $background_box_color . "}" . PHP_EOL;
            $css .= "#jaw-menu .widget_product_categories ul.product-categories > li ul.children {background-color: " . $menu_bar_submenu_background_color . "}" . PHP_EOL;
            $css .= ".widget_product_categories ul.product-categories > li.active-item > a," . PHP_EOL
                    . ".widget_product_categories ul.product-categories > li.active-item > span.count," . PHP_EOL
                    . ".widget_product_categories ul.product-categories > li.active-item > div.widget-menu-dropdown {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;
            $css .= ".widget_product_categories ul.product-categories > li.current-cat > a,"
                    . ".widget_product_categories ul.product-categories > li.current-cat > span.count,"
                    . ".widget_product_categories ul.product-categories > li.current-cat > .widget-menu-dropdown,"
                    . "#jaw-menu .widget_product_categories ul.product-categories > li.current-cat > a,"
                    . "#jaw-menu .widget_product_categories ul.product-categories > li.current-cat > span.count,"
                    . "#jaw-menu .widget_product_categories ul.product-categories > li.current-cat > .widget-menu-dropdown {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;

            $css .= ".widget_product_categories ul.product-categories > li > .children li:hover > a,"
                    . ".widget_product_categories ul.product-categories > li > .children li:hover span.count,"
                    . ".widget_product_categories ul.product-categories > li > .children li:hover > .widget-menu-dropdown,"
                    . "#jaw-menu .widget_product_categories ul.product-categories > li > .children li:hover > a,"
                    . "#jaw-menu .widget_product_categories ul.product-categories > li > .children li:hover span.count,"
                    . "#jaw-menu .widget_product_categories ul.product-categories > li > .children li:hover > .widget-menu-dropdown {color: " . $menu_bar_submenu_fontactive_color . "}" . PHP_EOL;


            // Pages
            $css .= ".widget_pages ul li {border-bottom: 1px solid " . $menu_bar_bordercolor . "}" . PHP_EOL;
            $css .= ".widget_pages ul li ul.children li:first-child {border-top: 1px solid " . $menu_bar_bordercolor . "}" . PHP_EOL;

            // Archive
            $css .= ".widget_archive ul li,.widget_meta ul li {border-bottom: 1px solid " . $menu_bar_bordercolor . "}" . PHP_EOL;

            // Calendar
            $css .= ".widget_calendar table,.widget_calendar table td,.widget_calendar table th {border: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".widget_calendar table th {background-color: " . $template_color_3 . "}" . PHP_EOL;
            $css .= ".widget_calendar table td a,.widget_calendar table td a:hover {color: " . $template_color_1 . "}" . PHP_EOL;

            // Tag cloud
            $css .= ".tagcloud a {font-family: " . $title_font . ";color: " . $template_color_2 . ";border: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= ".tagcloud a:hover {color: " . $template_color_1 . ";border: 1px solid " . $template_color_1 . "}" . PHP_EOL;
            $css .= "#jaw-menu ul.top-nav ul.sub-menu li .tagcloud a {font-family: " . $title_font . ";color: " . $template_color_2 . ";border: 1px solid " . $template_color_2 . "}" . PHP_EOL;
            $css .= "#jaw-menu ul.top-nav ul.sub-menu li .tagcloud a:hover {color: " . $template_color_1 . ";border: 1px solid " . $template_color_1 . "}" . PHP_EOL;

            // Woocommerce widgets
            $css .= ".widget.woocommerce ul.cart_list li,"
                    . ".woocommerce-page ul.cart_list li,"
                    . ".widget.woocommerce ul.product_list_widget li,"
                    . ".woocommerce-page ul.product_list_widget li {border-bottom: 1px solid " . $template_color_2 . "}" . PHP_EOL;

            // Rating
            $rating_style_color = jwOpt::get_option('rating_style_color', '#C11120');
            $rating_style_background_color = jwOpt::get_option('rating_style_background_color', '#C1C2C4');
            $css .= ".jw-rating-area,.woocommerce #comments .star-rating:before, .woocommerce-page #comments .star-rating:before {color: " . $rating_style_background_color . "}" . PHP_EOL;
            $css .= ".jw-ratig-background {color: " . $rating_style_color . "}" . PHP_EOL;

            $css .= ".comment-form-rating .stars a:hover {color: " . $rating_style_color . "}" . PHP_EOL;

            $css .= ".woocommerce .star-rating span, .woocommerce-page .star-rating span {color: " . $rating_style_color . "}" . PHP_EOL;
            $css .= ".woocommerce .star-rating:before, .woocommerce-page .star-rating:before {color: " . $template_color_2 . "}" . PHP_EOL;

            // Cusotm logo margin
            $margin_top = jwOpt::get_option('custom_logo_margin_top', '32');
            $margin_left = jwOpt::get_option('custom_logo_margin_left', '0');
            $margin_bottom = jwOpt::get_option('custom_logo_margin_bottom', '5');

            $css .= "#header .header-small-content .header-logo h1 {margin-top: " . $margin_top . "px;margin-left: " . $margin_left . "px;margin-bottom: " . $margin_bottom . "px;}" . PHP_EOL;
            $css .= "#header .header-small-content .header-logo p {margin-top: " . $margin_top . "px;margin-left: " . $margin_left . "px;margin-bottom: " . $margin_bottom . "px;}" . PHP_EOL;
            $css .= "#header .big-menu .header-logo h1 {margin-top: " . $margin_top . "px;margin-left: " . $margin_left . "px;margin-bottom: " . $margin_bottom . "px;}" . PHP_EOL;
            $css .= "#header .big-menu .header-logo p {margin-top: " . $margin_top . "px;margin-left: " . $margin_left . "px;margin-bottom: " . $margin_bottom . "px;}" . PHP_EOL;
            $css .= "#header .big-menu ul.top-nav > li.current-menu-item > .jaw-menu-href-title,"
                    . ".home #header .big-menu #jaw-menu ul.top-nav > li.current-menu-item > a {color: " . $menu_bar_fontactive_color . "}" . PHP_EOL;
            $css .= "#header .big-menu ul.top-nav ul.sub-menu li.no-dropdown:hover  a span {color: " . $menu_bar_fontactive_color . "}" . PHP_EOL;
            $css .= "#header .big-menu ul.top-nav ul.sub-menu li.has-dropdown:hover > a span {color: " . $menu_bar_fontactive_color . "}" . PHP_EOL;

            // Footer
            $css .= "#footer {background-color: " . $footer_background_color . ";}" . PHP_EOL;
            $css .= "#footer .fullwidth-block {background-color: " . $footer_background_color . ";border-top: 1px solid " . $footer_top_border_color . "}" . PHP_EOL;
            $css .= "#footer .section-box, #footer .section-line {border-bottom: 1px solid " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .section-header .section-name {background-color: " . $footer_color_2 . "}" . PHP_EOL;
            $css .= "#footer {color: " . $footer_font_color . "}" . PHP_EOL;
            $css .= "#footer a, #footer a:focus {color: " . $footer_link_color . "}" . PHP_EOL;
            $css .= "#footer a:hover {color: " . $footer_link_hover_color . "}" . PHP_EOL;
            $css .= "#footer ul.jw-tweets-widgets-tweets li .jw-tweets-widgets-icon {background-color: " . $footer_background_color . "}" . PHP_EOL;
            $css .= "#footer ul.jw-tweets-widgets-tweets {border-left: 2px solid " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .social-icons, #footer .social a {color: " . $footer_color_2 . "}" . PHP_EOL;
            $css .= "#footer .date > span {color: " . $footer_color_2 . "}" . PHP_EOL;
            $css .= "#footer .widget_calendar table th {background-color: " . $footer_color_2 . "}" . PHP_EOL;

            $css .= "#footer ul.menu > li > ul.sub-menu li:hover > a,"
                    . "#footer ul.menu > li > ul.sub-menu li:hover > .widget-menu-dropdown span {color:" . $footer_link_hover_color . "}" . PHP_EOL;

            $css .= "#footer .widget.woocommerce ul.cart_list li, #footer .woocommerce-page ul.cart_list li, #footer .widget.woocommerce ul.product_list_widget li, #footer .woocommerce-page ul.product_list_widget li {border-bottom: 1px solid " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .widget_archive ul li, #footer .widget_meta ul li {border-bottom: 1px solid " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .widget_archive ul li a {color: " . $footer_color_2 . "}" . PHP_EOL;
            $css .= "#footer .widget_archive ul li a:hover,"
                    . "#footer .widget_archive ul li a:focus {color: " . $footer_link_hover_color . "}" . PHP_EOL;

            $css .= "#footer .widget_pages ul li {border-bottom: 1px solid " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .widget_pages ul li ul.children li:first-child {border-top: 0px solid " . $footer_color_2 . ";}" . PHP_EOL;

            $css .= "#footer .widget_categories > ul > li {background-color: " . $footer_background_color . ";border-bottom: 1px solid " . $footer_color_2 . ";color: " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .widget_categories > ul > li a {color: " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .widget_categories > ul > li.active-item {color: " . $footer_link_hover_color . ";}" . PHP_EOL;
            $css .= "#footer .widget_categories > ul > li.active-item span {color: " . $footer_link_hover_color . ";}" . PHP_EOL;
            $css .= "#footer .widget_categories > ul > li.active-item a {color: " . $footer_link_hover_color . ";}" . PHP_EOL;

            $css .= "#footer .widget_nav_menu ul.menu > li {background-color: " . $footer_background_color . ";border-bottom: 1px solid " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .widget_nav_menu ul.menu a {color: " . $footer_color_2 . "}" . PHP_EOL;
            $css .= "#footer .widget_nav_menu ul.menu > li ul li span, #footer .widget-menu-dropdown {color: " . $footer_color_2 . ";}" . PHP_EOL;

            $css .= "#footer .widget_product_categories ul.product-categories > li {background-color: " . $footer_background_color . ";border-bottom: 1px solid " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .widget_product_categories ul.product-categories > li a {color: " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .widget_product_categories ul.product-categories > li.active-item > a,"
                    . "#footer .widget_product_categories ul.product-categories > li.active-item > .widget-menu-dropdown {color: " . $footer_link_hover_color . ";}" . PHP_EOL;
            $css .= "#footer .widget_product_categories ul.product-categories > li ul.children li:hover * {color: " . $footer_link_hover_color . "}" . PHP_EOL;

            $css .= "#footer .widget_nav_menu ul.menu > li.active-item .widget-menu-dropdown {color: " . $footer_link_hover_color . "}" . PHP_EOL;
            $css .= "#footer .widget_nav_menu ul.menu > li.active-item > a {background-color: " . $footer_background_color . ";color: " . $footer_link_hover_color . "}" . PHP_EOL;

            $css .= "#footer .section-big {border-bottom: 1px solid " . $footer_color_1 . ";color: " . $footer_color_1 . ";font-size:" . $footer_title_font_size . "px}" . PHP_EOL;
            $css .= "#footer .section-big-wrapper {border-bottom: 1px solid " . $footer_color_2 . ";}" . PHP_EOL;

            $css .= "#footer .jw_login_widget ul.menu > li {background-color: " . $footer_background_color . ";border-bottom-color: " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .jw_login_widget ul.menu > li a {color: " . $footer_color_2 . "}" . PHP_EOL;
            $css .= "#footer .jw_login_widget ul.menu > li:hover * {color: " . $footer_link_hover_color . "}" . PHP_EOL;

            $css .= "#footer .nav-tabs > li.active > a," . PHP_EOL
                    . "#footer .nav-tabs > li.active > a:hover," . PHP_EOL
                    . "#footer .nav-tabs > li.active > a:focus {border-color: " . $footer_color_2 . " " . $footer_color_2 . " transparent " . $footer_color_2 . ";background-color: " . $footer_background_color . "}" . PHP_EOL;
            $css .= "#footer .jaw-tabs.colored .nav-tabs > li > a {border-color: " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .jaw-tabs.colored .nav-tabs {background-color:" . $footer_color_3 . ";}" . PHP_EOL;
            $css .= "#footer .nav-tabs {border-bottom: 1px solid " . $footer_color_3 . ";}" . PHP_EOL;
            $css .= "#footer .nav > li > a:hover,"
                    . "#footer .nav > li > a:focus {background-color: " . $footer_color_3 . ";border-bottom-color: " . $footer_color_2 . "}" . PHP_EOL;

            $css .= "#footer .yith-woocompare-widget a.compare,"
                    . "#footer .yith-woocompare-widget a.clear-all {background-color: " . $footer_color_2 . ";color: " . $footer_link_color . "}" . PHP_EOL;

            $css .= ".woocommerce #footer .widget_shopping_cart .widget_shopping_cart_content .buttons a.button,"
                    . "#footer .widget_shopping_cart .widget_shopping_cart_content .buttons a.button {background-color: " . $footer_color_2 . ";color: " . $footer_link_color . "}" . PHP_EOL;

            $css .= "#footer .widget_product_categories ul.product-categories > li ul.children {background-color: " . $footer_background_color . "}" . PHP_EOL;

            $css .= "#footer .widget_pages ul li a {color: " . $footer_color_2 . ";}" . PHP_EOL;
            $css .= "#footer .widget_pages ul li a:hover, #footer .widget_pages ul li a:focus {color: " . $footer_link_hover_color . ";}" . PHP_EOL;

            $css .= "#footer .tagcloud a {border-color: " . $footer_link_color . "}" . PHP_EOL;
            $css .= "#footer .tagcloud a:hover {color: " . $footer_link_hover_color . ";border-color: " . $footer_link_hover_color . "}" . PHP_EOL;

            $css .= "#footer .widget_wysija .wysija-paragraph label{color: " . $footer_color_1 . ";}" . PHP_EOL;
            $css .= "#footer .widget_wysija_cont .wysija-submit {background-color: " . $footer_color_2 . ";}" . PHP_EOL;


            $css .= "#footer .latestpostwidget-content a {font-family: " . $text_font['face'] . ";font-size: " . $text_font['size'] . ";}" . PHP_EOL;

            // featured footer Color
            $css .= ".row-fullwidth .featured-footer-content {background: none repeat scroll 0 0 " . $featured_footer_color . "}" . PHP_EOL;



            // Mobile menu - select
            $css .= ".mobile-menu-selectbox select {border: 1px solid " . $menu_bar_bordercolor . ";}" . PHP_EOL;

            //  MOBILE MENU - full
            $css .= '@media only screen and (max-width: 767px) {';

            $css .= ".row-fullwidth .fullwidth-block.small-menu.main-menu, #header .small-menu .jaw-menu-bar,"
                    . ".row-fullwidth .fullwidth-block.big-menu.main-menu, #header .big-menu .jaw-menu-bar, "
                    . "#jaw-mobile-menu .widget_product_categories ul.product-categories > li {background: none repeat scroll 0 0 " . $mobile_menu_bar_backgroundcolor . ";}" . PHP_EOL;

            $css .= '}';
            $css .= "#jaw-mobile-menu ul.top-nav-mobile ul.sub-menu li .tagcloud a {color: " . $mobile_menu_bar_font_color . ";border: 1px solid " . $mobile_menu_bar_font_color . "}" . PHP_EOL;
            $css .= "#jaw-mobile-menu ul.top-nav-mobile ul.sub-menu li .tagcloud a:hover {color: " . $mobile_menu_bar_fontactive_color . ";border: 1px solid " . $mobile_menu_bar_fontactive_color . "}" . PHP_EOL;

            $css .= "#jaw-mobile-menu ul.top-nav-mobile a:hover, "
                    . "#jaw-mobile-menu ul.top-nav-mobile a:active, "
                    . "#jaw-mobile-menu ul.top-nav-mobile a.active, "
                    . "#jaw-mobile-menu ul.top-nav-mobile a:focus, "
                    . "#jaw-mobile-menu ul.top-nav-mobile .widget_calendar table td#prev a:hover, "
                    . "#jaw-mobile-menu ul.top-nav-mobile .widget_calendar table td#next a:hover{color: " . $mobile_menu_bar_fontactive_color . "}";

            $css .= "#jaw-mobile-menu ul.top-nav-mobile ul.sub-menu li a,"
                    . "#jaw-mobile-menu ul.top-nav-mobile ul.sub-menu li {color: " . $mobile_menu_bar_font_color . "}" . PHP_EOL;

            $css .= "#jaw-mobile-menu ul.top-nav-mobile > li.current-page-parent a,"
                    . "#jaw-mobile-menu ul.top-nav-mobile li.current-page-parent a,"
                    . "#jaw-mobile-menu ul.top-nav-mobile > li:hover a,"
                    . "#jaw-mobile-menu .widget_product_categories ul.product-categories > li.active-item > a,"
                    . "#jaw-mobile-menu .widget_product_categories ul.product-categories > li.active-item > div.widget-menu-dropdown,"
                    . "#jaw-mobile-menu .widget_product_categories ul.product-categories > li.active-item > span.count {color: " . $mobile_menu_bar_fontactive_color . "}" . PHP_EOL;

            $css .= "#jaw-mobile-menu ul.top-nav-mobile ul.sub-menu li a:hover{color: " . $mobile_menu_bar_fontactive_color . "}" . PHP_EOL;

            $css .= "#jaw-mobile-menu ul.top-nav-mobile > li a {color: " . $mobile_menu_bar_font_color . "}" . PHP_EOL;


            /* END TEMPLATE COLOR *********************************************** */

            return $css;
        }

        public static function generate_background_banner_link() {
            if (jwOpt::get_option('background_banner_show', '0') == '1') {

                $link_right = jwOpt::get_option('background_banner_link_right', 'http://');
                $link_left = jwOpt::get_option('background_banner_link_left', 'http://');

                $link_right_width = jwOpt::get_option('background_banner_link_width_right', 0);
                $link_left_width = jwOpt::get_option('background_banner_link_width_left', 0);

                $target = jwOpt::get_option(' background_banner_target', '_blank');

                if (strlen($link_left) > 0 && $link_left != 'http://') {
                    if ($link_left_width > 0) {
                        echo '<a target="' . $target . '" style="width: ' . $link_left_width . 'px" class="background_banner_link left" href="' . $link_left . '"></a>';
                    } else {
                        echo '<a target="' . $target . '" class="background_banner_link left" href="' . $link_left . '"></a>';
                    }
                }
                if (strlen($link_right) > 0 && $link_right != 'http://') {
                    if ($link_right_width > 0) {
                        echo '<a target="' . $target . '" style="width: ' . $link_right_width . 'px" class="background_banner_link right" href="' . $link_right . '"></a>';
                    } else {
                        echo '<a target="' . $target . '" class="background_banner_link right" href="' . $link_right . '"></a>';
                    }
                }
            }
        }

        public function get_inline() {
            // inline for page
            $css = '';

            $css .= jwOpt::get_option('custom_css', '');
            echo PHP_EOL;
            echo '<!--Custom CSS-->' . PHP_EOL;
            echo '<style>' . $css . '</style>' . PHP_EOL;
        }

        public static function hex2rgb($hex) {
            $hex = str_replace("#", "", $hex);

            if (strlen($hex) == 3) {
                $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
                $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
                $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
            } else {
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
            }
            $rgb = array($r, $g, $b);
            //return implode(",", $rgb); // returns the rgb values separated by commas
            return $rgb; // returns an array with the rgb values
        }

    }

}
