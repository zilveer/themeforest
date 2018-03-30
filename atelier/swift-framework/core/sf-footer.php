<?php
    /*
    *
    *	Footer Functions
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_footer_promo()
    *	sf_footer_widgets()
    *	sf_footer_copyright()
    *	sf_one_page_nav()
    *	sf_back_to_top()
    *	sf_fw_video_area()
    *	sf_inf_scroll_params()
    *	sf_included()
    *	sf_option_parameters()
    *	sf_countdown_shortcode_locale()
    *	sf_loveit_locale()
    *
    */

    /* NEWSLETTER/SUBSCRIBE BAR
    ================================================== */
    if ( ! function_exists( 'sf_newsletter_bar' ) ) {
        function sf_newsletter_bar() {
            global $sf_options, $post;
			$enable_newsletter_sub_bar = $enable_newsletter_bar_page = false;

			if ( isset($sf_options['enable_newsletter_sub_bar']) ) {
            	$enable_newsletter_sub_bar  = $sf_options['enable_newsletter_sub_bar'];
            }

			if ( is_page() && $post ) {
            	$enable_newsletter_bar_page = sf_get_post_meta($post->ID, 'sf_enable_newsletter_bar', true);
			}
			
			if ( isset($sf_options['enable_newsletter_sub_bar_globally']) ) {
				$enable_newsletter_bar_page  = $sf_options['enable_newsletter_sub_bar_globally'];
			}

            if ( ( $enable_newsletter_sub_bar && ( is_home() || is_front_page() ) ) || $enable_newsletter_bar_page ) {
            	$sub_bar_text 				= __( $sf_options['sub_bar_text'], "swiftframework" );
            	$sub_bar_code 				= __( $sf_options['sub_bar_code'], "swiftframework" );
            	$fullwidth_header    		= $sf_options['fullwidth_header'];
                $page_layout             = $sf_options['page_layout'];
                if ( isset( $_GET['layout'] ) ) {
                    $page_layout = $_GET['layout'];
                }
                ?>
                <!--// OPEN #sf-newsletter-bar //-->
                <div id="sf-newsletter-bar">

                	<?php if ( !$fullwidth_header || $page_layout == "boxed" ) { ?>
                	<div class="container">
                	<?php } ?>
                		<h3 class="sub-text"><?php echo esc_attr($sub_bar_text); ?></h3>
                		<div class="sub-code"><?php echo do_shortcode($sub_bar_code); ?></div>
                		<a href="#" class="sub-close"><i class="sf-icon-close"></i></a>

                	<?php if ( !$fullwidth_header || $page_layout == "boxed" ) { ?>
                	</div>
                	<?php } ?>

                    <!--// CLOSE #sf-newsletter-bar //-->
                </div>
            <?php
            }

        }

        add_action( 'sf_after_page_container', 'sf_newsletter_bar', 30 );
    }


    /* FOOTER PROMO
    ================================================== */
    if ( ! function_exists( 'sf_footer_promo' ) ) {
        function sf_footer_promo() {
            global $sf_options;

			$footer_promo_bar_text_size = "";
			$footer_promo_bar_button_type = "drop-shadow";

            $enable_footer_promo_bar        = $sf_options['enable_footer_promo_bar'];
            $footer_promo_bar_type          = $sf_options['footer_promo_bar_type'];
            $footer_promo_bar_text          = __( $sf_options['footer_promo_bar_text'], "swiftframework" );
            $footer_promo_bar_button_color  = $sf_options['footer_promo_bar_button_color'];
            $footer_promo_bar_button_text   = __( $sf_options['footer_promo_bar_button_text'], "swiftframework" );
            $footer_promo_bar_button_link   = __( $sf_options['footer_promo_bar_button_link'], "swiftframework" );
            $footer_promo_bar_button_target = $sf_options['footer_promo_bar_button_target'];

			if ( isset($sf_options['footer_promo_bar_text_size']) ) {
				$footer_promo_bar_text_size	    = $sf_options['footer_promo_bar_text_size'];
			}
			if ( isset($sf_options['footer_promo_bar_button_type']) ) {
				$footer_promo_bar_button_type	    = $sf_options['footer_promo_bar_button_type'];
			}

            if ( $enable_footer_promo_bar ) {
                ?>
                <!--// OPEN #base-promo //-->
                <div id="base-promo" class="sf-promo-bar promo-<?php echo $footer_promo_bar_type; ?>">
                    <?php if ( $footer_promo_bar_type == "button" ) { ?>
                        <p class="<?php echo $footer_promo_bar_text_size; ?>"><?php echo esc_attr($footer_promo_bar_text); ?></p>
                        <a href="<?php echo esc_url($footer_promo_bar_button_link); ?>"
                           target="<?php echo $footer_promo_bar_button_target; ?>"
                           class="sf-button <?php echo $footer_promo_bar_button_type; ?> <?php echo $footer_promo_bar_button_color; ?>"><?php echo esc_attr($footer_promo_bar_button_text); ?></a>
                    <?php } else if ( $footer_promo_bar_type == "arrow" ) { ?>
                        <a href="<?php echo esc_url($footer_promo_bar_button_link); ?>"
                           target="<?php echo $footer_promo_bar_button_target; ?>"><?php echo esc_attr($footer_promo_bar_text); ?>
                            <?php echo apply_filters( 'sf_next_icon', '<i class="ss-navigateright"></i>' ); ?></a>
                    <?php } else { ?>
                        <a href="<?php echo esc_url($footer_promo_bar_button_link); ?>"
                           target="<?php echo $footer_promo_bar_button_target; ?>" class="<?php echo $footer_promo_bar_text_size; ?>"><?php echo esc_attr($footer_promo_bar_text); ?></a>
                    <?php } ?>
                    <!--// CLOSE #base-promo //-->
                </div>
            <?php
            }

        }

        add_action( 'sf_main_container_end', 'sf_footer_promo', 20 );
    }


    /* FOOTER WIDGET AREA
    ================================================== */
    if ( ! function_exists( 'sf_footer_widgets' ) ) {
        function sf_footer_widgets() {
            global $sf_options;

            $enable_footer         = $sf_options['enable_footer'];
            $enable_footer_divider = $sf_options['enable_footer_divider'];
            $footer_config         = $sf_options['footer_layout'];
            $footer_class          = "";
            if ( $enable_footer_divider ) {
                $footer_class = "footer-divider";
            }

            if ( $enable_footer ) {
                ?>
                <!--// OPEN #footer //-->
                <footer id="footer" class="<?php echo $footer_class; ?>">
                    <div class="container">
                        <div id="footer-widgets" class="row clearfix">
                            <?php if ( $footer_config == "footer-1" ) { ?>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-4' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-2" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-3" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-4" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-5" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-6" ) { ?>

                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-7" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-8" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else { ?>

                                <div class="col-sm-12">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>

                                </div>
                            <?php } ?>

                        </div>
                    </div>

                    <?php do_action( 'sf_footer_wrap_after' ); ?>

                    <!--// CLOSE #footer //-->
                </footer>
            <?php
            }

        }

        add_action( 'sf_footer_wrap_content', 'sf_footer_widgets', 10 );
    }


    /* FOOTER COPYRIGHT
    ================================================== */
    if ( ! function_exists( 'sf_footer_copyright' ) ) {
        function sf_footer_copyright() {
            global $sf_options;

            $enable_copyright         = $sf_options['enable_copyright'];
            $enable_copyright_divider = $sf_options['enable_copyright_divider'];
            $copyright_right          = $sf_options['copyright_right'];
            $show_backlink            = $sf_options['show_backlink'];
            $copyright_text           = __( $sf_options['footer_copyright_text'], 'swiftframework' );
            $copyright_text_right     = __( $sf_options['footer_copyright_text_right'], 'swiftframework' );
            $swiftideas_backlink      = $copyright_class = "";

            if ( $enable_copyright_divider ) {
                $copyright_class = "copyright-divider";
            }

            if ( $show_backlink ) {
                $swiftideas_backlink = apply_filters( "swiftideas_link", " <a href='http://www.swiftideas.com' rel='nofollow'>Premium WordPress Themes by Swift Ideas</a>" );
            }

            if ( $enable_copyright ) {
                ?>

                <!--// OPEN #copyright //-->
                <footer id="copyright" class="<?php echo esc_attr($copyright_class); ?>">
                    <div class="container">
                        <div
                            class="text-left"><?php echo do_shortcode( stripslashes( $copyright_text ) ); ?><?php echo $swiftideas_backlink; ?></div>
                        <?php if ( $copyright_right == "menu" ) { ?>
                            <nav class="footer-menu std-menu">
                                <?php
                                    $footer_menu_args = array(
                                        'echo'           => true,
                                        'theme_location' => 'footer_menu',
                                        'walker'         => new sf_alt_menu_walker,
                                        'fallback_cb'    => ''
                                    );
                                    wp_nav_menu( $footer_menu_args );
                                ?>
                            </nav>
                        <?php } else { ?>
                            <div
                                class="text-right"><?php echo do_shortcode( stripslashes( $copyright_text_right ) ); ?></div>
                        <?php } ?>
                    </div>
                    <!--// CLOSE #copyright //-->
                </footer>

            <?php
            }

        }

        add_action( 'sf_footer_wrap_content', 'sf_footer_copyright', 20 );
    }

    /* ONE PAGE NAV
    ================================================== */
    if ( ! function_exists( 'sf_one_page_nav' ) ) {
        function sf_one_page_nav() {
            global $enable_one_page_nav, $sf_options;
            $onepagenav_type = $sf_options['onepagenav_type'];
            if ( $enable_one_page_nav ) {
                ?>
                <!--// ONE PAGE NAV //-->
                <div id="one-page-nav" class="opn-<?php echo esc_attr($onepagenav_type); ?>"></div>
            <?php
            }
        }

        add_action( 'sf_main_container_end', 'sf_one_page_nav', 30 );
    }


    /* BACK TO TOP
    ================================================== */
    if ( ! function_exists( 'sf_back_to_top' ) ) {
        function sf_back_to_top() {
            global $sf_options;
            $enable_backtotop = $sf_options['enable_backtotop'];
            $back_to_top_icon = apply_filters( 'sf_back_to_top_icon', '<i class="ss-navigateup"></i>' );
            if ( $enable_backtotop ) {
                ?>
                <!--// BACK TO TOP //-->
                <div id="back-to-top" class="animate-top"><?php echo $back_to_top_icon; ?></div>
            <?php
            }
        }

        add_action( 'sf_after_page_container', 'sf_back_to_top', 20 );
    }


    /* FULL WIDTH VIDEO AREA
    ================================================== */
    if ( ! function_exists( 'sf_fw_video_area' ) ) {
        function sf_fw_video_area() {
        	$fs_close_icon = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
            ?>
            <!--// FULL WIDTH VIDEO //-->
            <div class="fw-video-area">
                <div class="fw-video-close"><?php echo $fs_close_icon; ?></div>
                <div class="fw-video-wrap"></div>
            </div>
            <div class="fw-video-spacer"></div>
        <?php
        }

        add_action( 'sf_after_page_container', 'sf_fw_video_area', 30 );
    }


    /* BACK TO TOP
    ================================================== */
    if ( ! function_exists( 'sf_inf_scroll_params' ) ) {
        function sf_inf_scroll_params() {
            global $sf_include_infscroll;
            if ( $sf_include_infscroll ) {
                ?>
                <!--// INFINITE SCROLL PARAMS //-->
                <div id="inf-scroll-params"
                     data-loadingimage="<?php echo get_template_directory_uri(); ?>/images/loader.gif"
                     data-msgtext="<?php _e( "Loading...", "swiftframework" );
                     ?>" data-finishedmsg="<?php _e( "All items loaded", "swiftframework" ); ?>"></div>
            <?php
            }
        }

        add_action( 'sf_after_page_container', 'sf_inf_scroll_params', 40 );
    }


    /* FRAMEWORK INLCUDES
    ================================================== */
    if ( ! function_exists( 'sf_included' ) ) {
        function sf_included() {
            ?>
            <!--// FRAMEWORK INCLUDES //-->
            <div id="sf-included" class="<?php echo sf_global_include_classes(); ?>"></div>
        <?php
        }

        add_action( 'sf_after_page_container', 'sf_included', 50 );
    }

    /* PLUGIN OPTION PARAMS
    ================================================== */
    if ( ! function_exists( 'sf_option_parameters' ) ) {
        function sf_option_parameters() {
            global $sf_options;
            $slider_slideshowSpeed    = $sf_options['slider_slideshowSpeed'];
            $slider_animationSpeed    = $sf_options['slider_animationSpeed'];
            $slider_autoplay          = $sf_options['slider_autoplay'];
            $slider_loop 			  = false;
            if ( isset($sf_options['slider_loop']) ) {
            	$slider_loop          	  = $sf_options['slider_loop'];
            }
            $carousel_paginationSpeed = $sf_options['carousel_paginationSpeed'];
            $carousel_slideSpeed      = $sf_options['carousel_slideSpeed'];
            $carousel_autoplay        = $sf_options['carousel_autoplay'];
            $carousel_pagination      = $sf_options['carousel_pagination'];
            $lightbox_nav             = $sf_options['lightbox_nav'];
            $lightbox_thumbs          = $sf_options['lightbox_thumbs'];
            $lightbox_skin            = $sf_options['lightbox_skin'];
            $lightbox_sharing         = $sf_options['lightbox_sharing'];
            $product_zoom_type        = $sf_options['product_zoom_type'];
            $product_slider_thumbs_pos = "bottom";
            $vertical_product_slider_height = "700";
            if ( isset( $sf_options['product_slider_thumbs_pos'] ) ) {
           		$product_slider_thumbs_pos = $sf_options['product_slider_thumbs_pos'];
            }
            if ( isset( $sf_options['vertical_product_slider_height'] ) ) {
            	$vertical_product_slider_height = $sf_options['vertical_product_slider_height'];
            }
            $quickview_text			  = __("Quickview", "swiftframework");
            $cart_notification = "";
            if ( isset ($sf_options['cart_notification']) ) {
            	$cart_notification        = $sf_options['cart_notification'];
            }
            ?>
            <div id="sf-option-params" data-slider-slidespeed="<?php echo esc_attr($slider_slideshowSpeed); ?>"
                 data-slider-animspeed="<?php echo esc_attr($slider_animationSpeed); ?>"
                 data-slider-autoplay="<?php echo esc_attr($slider_autoplay); ?>"
                 data-slider-loop="<?php echo esc_attr($slider_loop); ?>"
                 data-carousel-pagespeed="<?php echo esc_attr($carousel_paginationSpeed); ?>"
                 data-carousel-slidespeed="<?php echo esc_attr($carousel_slideSpeed); ?>"
                 data-carousel-autoplay="<?php echo esc_attr($carousel_autoplay); ?>"
                 data-carousel-pagination="<?php echo esc_attr($carousel_pagination); ?>"
                 data-lightbox-nav="<?php echo esc_attr($lightbox_nav); ?>"
	             data-lightbox-thumbs="<?php echo esc_attr($lightbox_thumbs); ?>"
                 data-lightbox-skin="<?php echo esc_attr($lightbox_skin); ?>"
                 data-lightbox-sharing="<?php echo esc_attr($lightbox_sharing); ?>"
                 data-product-zoom-type="<?php echo esc_attr($product_zoom_type); ?>"
                 data-product-slider-thumbs-pos="<?php echo esc_attr($product_slider_thumbs_pos); ?>"
                 data-product-slider-vert-height="<?php echo esc_attr($vertical_product_slider_height); ?>"
                 data-quickview-text="<?php echo esc_attr($quickview_text); ?>"
	             data-cart-notification="<?php echo esc_attr($cart_notification); ?>"
	             data-username-placeholder="<?php _e( "Username", "swiftframework" ); ?>"
	             data-email-placeholder="<?php _e( "Email", "swiftframework" ); ?>"
	             data-password-placeholder="<?php _e( "Password", "swiftframework" ); ?>"
	             data-username-or-email-placeholder="<?php _e( "Username or email address", "swiftframework" ); ?>"
	             data-order-id-placeholder="<?php _e( "Order ID", "swiftframework" ); ?>"
	             data-billing-email-placeholder="<?php _e( "Billing Email", "swiftframework" ); ?>"></div>

        <?php
        }
        add_action( 'sf_after_page_container', 'sf_option_parameters', 60 );
    }


    /* COUNTDOWN SHORTCODE LOCALE
    ================================================== */
    if ( ! function_exists( 'sf_countdown_shortcode_locale' ) ) {
        function sf_countdown_shortcode_locale() {
            global $sf_has_countdown;
            if ( $sf_has_countdown ) {
                ?>
                <div id="countdown-locale" data-label_year="<?php _e( 'Year', 'swiftframework' ); ?>"
                     data-label_years="<?php _e( 'Years', 'swiftframework' ); ?>"
                     data-label_month="<?php _e( 'Month', 'swiftframework' ); ?>"
                     data-label_months="<?php _e( 'Months', 'swiftframework' ); ?>"
                     data-label_weeks="<?php _e( 'Weeks', 'swiftframework' ); ?>"
                     data-label_week="<?php _e( 'Week', 'swiftframework' ); ?>"
                     data-label_days="<?php _e( 'Days', 'swiftframework' ); ?>"
                     data-label_day="<?php _e( 'Day', 'swiftframework' ); ?>"
                     data-label_hours="<?php _e( 'Hours', 'swiftframework' ); ?>"
                     data-label_hour="<?php _e( 'Hour', 'swiftframework' ); ?>"
                     data-label_mins="<?php _e( 'Mins', 'swiftframework' ); ?>"
                     data-label_min="<?php _e( 'Min', 'swiftframework' ); ?>"
                     data-label_secs="<?php _e( 'Secs', 'swiftframework' ); ?>"
                     data-label_sec="<?php _e( 'Sec', 'swiftframework' ); ?>"></div>
            <?php
            }
        }

        add_action( 'sf_after_page_container', 'sf_countdown_shortcode_locale', 70 );
    }


    /* LOVE IT LOCALE
    ================================================== */
    if ( ! function_exists( 'sf_loveit_locale' ) ) {
        function sf_loveit_locale() {
            $ajax_url              = admin_url( 'admin-ajax.php' );
            $nonce                 = wp_create_nonce( 'love-it-nonce' );
            $already_loved_message = __( 'You have already loved this item.', 'swiftframework' );
            $error_message         = __( 'Sorry, there was a problem processing your request.', 'swiftframework' );
            $logged_in             = is_user_logged_in() ? 'true' : 'false';

            ?>
            <div id="loveit-locale" data-ajaxurl="<?php echo esc_url($ajax_url); ?>" data-nonce="<?php echo $nonce; ?>"
                 data-alreadyloved="<?php echo esc_attr($already_loved_message); ?>" data-error="<?php echo esc_attr($error_message); ?>"
                 data-loggedin="<?php echo esc_attr($logged_in); ?>"></div>
        <?php
        }

        add_action( 'sf_after_page_container', 'sf_loveit_locale', 80 );
    }

?>