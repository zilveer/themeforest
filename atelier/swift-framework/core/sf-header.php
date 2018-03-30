<?php
    /*
    *
    *	Header Functions
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_framework_check()
    *	sf_site_loading()
    *	sf_header_wrap()
    *	sf_header()
    *	sf_header_aux()
    *	sf_logo()
    *	sf_main_menu()
    *	sf_mobile_cart()
    *	sf_mobile_header()
    *	sf_mobile_menu()
    *	sf_woo_links()
    * 	sf_get_cart()
    *	sf_get_wishlist()
    *	sf_get_account()
    *	sf_ajaxsearch()
    *	sf_overlay_menu()
    *   sf_add_to_wishlist()
    */

    /* SWIFT FRAMEWORK CHECK
    ================================================== */
    if ( ! function_exists( 'sf_framework_check' ) ) {
        function sf_framework_check() {

        	if ( class_exists( 'SwiftFramework' ) || !( current_user_can('editor') || current_user_can('administrator') ) ) {
        		return;
        	}

            echo '<div class="swift-framework-notice">';
            echo '<h3>Please install/activate the Swift Framework plugin.</h3>';
            echo '<p>If you have not installed the plugin, please go to Appearance > Install Plugins</p>';
            echo '</div>';
        }
        add_action( 'sf_before_page_container', 'sf_framework_check', 0 );
    }
    
    /* REDUX CHECK
    ================================================== */
    if ( ! function_exists( 'sf_redux_check' ) ) {
        function sf_redux_check() {

        	if ( class_exists( 'ReduxFramework' ) || !( current_user_can('editor') || current_user_can('administrator') ) ) {
        		return;
        	}

            echo '<div class="swift-framework-notice">';
            echo '<h3>Please install/activate the Redux Framework plugin.</h3>';
            echo '<p>If you have not installed the plugin, please go to Appearance > Install Plugins</p>';
            echo '</div>';
        }
        add_action( 'sf_before_page_container', 'sf_redux_check', 5 );
    }


    /* SITE LOADING
    ================================================== */
    if ( ! function_exists( 'sf_site_loading' ) ) {
        function sf_site_loading() {
            echo sf_loading_animation( 'site-loading' );
        }

        add_action( 'sf_before_page_container', 'sf_site_loading', 5 );
    }


    /* HEADER WRAP
    ================================================== */
    if ( ! function_exists( 'sf_header_wrap' )) {
	    function sf_header_wrap($header_layout) {
		    global $post, $sf_options;

		    $page_classes     = sf_page_classes();
		    $header_layout    = $page_classes['header-layout'];
		    $page_header_type = "standard";

		    if ( is_page() && $post ) {
		        $page_header_type = sf_get_post_meta( $post->ID, 'sf_page_header_type', true );
		    } else if ( is_singular( 'post' ) && $post ) {
		        $post_header_type = sf_get_post_meta( $post->ID, 'sf_page_header_type', true );
		        $fw_media_display = sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
		        $page_title_style = sf_get_post_meta( $post->ID, 'sf_page_title_style', true );
		        if ( $page_title_style == "fancy" || $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media" ) {
		            $page_header_type = $post_header_type;
		        }
		    }  else if (is_singular('portfolio') && $post) {
				$port_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
				$fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
				$page_title = sf_get_post_meta($post->ID, 'sf_page_title', true);
				$page_title_style = sf_get_post_meta($post->ID, 'sf_page_title_style', true);
				if ($page_title_style == "fancy" || !$page_title) {
					$page_header_type = $port_header_type;
				}
			}

		    $fullwidth_header    = $sf_options['fullwidth_header'];
		    $enable_tb           = $sf_options['enable_tb'];
		    $tb_left_config      = $sf_options['tb_left_config'];
		    $tb_right_config     = $sf_options['tb_right_config'];
		    $tb_left_text = __($sf_options['tb_left_text'], 'swiftframework');
			$tb_right_text = __($sf_options['tb_right_text'], 'swiftframework');
			$enable_sticky_tb = false;
			if ( isset( $sf_options['enable_sticky_topbar'] ) ) {
				$enable_sticky_tb = $sf_options['enable_sticky_topbar'];	
			}
		    $header_left_config  = __($sf_options['header_left_config'], 'swiftframework');
		    $header_right_config = __($sf_options['header_right_config'], 'swiftframework');
			
		    if ( ( $page_header_type == "naked-light" || $page_header_type == "naked-dark" ) && ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
		        $header_layout = apply_filters( 'sf_naked_default_header', "header-1" );
		        $enable_tb     = false;
		    }

		    $tb_left_output = $tb_right_output = "";
		    if ( $tb_left_config == "social" ) {
		        $tb_left_output .= do_shortcode( '[social]' ) . "\n";
		    } else if ( $tb_left_config == "aux-links" ) {
		        $tb_left_output .= sf_aux_links( 'tb-menu', true, 'header-1' ) . "\n";
		    } else if ( $tb_left_config == "menu" ) {
		        $tb_left_output .= sf_top_bar_menu() . "\n";
		    } else if ($tb_left_config == "cart-wishlist") {
			    $tb_left_output .= '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">'. "\n";
			    $tb_left_output .= sf_get_cart();
			    $tb_left_output .= sf_get_wishlist();
			    $tb_left_output .= '</ul></nav></div>'. "\n";
		    } else {
		        $tb_left_output .= '<div class="tb-text">' . do_shortcode( $tb_left_text ) . '</div>' . "\n";
		    }

		    if ( $tb_right_config == "social" ) {
		        $tb_right_output .= do_shortcode( '[social]' ) . "\n";
		    } else if ( $tb_right_config == "aux-links" ) {
		        $tb_right_output .= sf_aux_links( 'tb-menu', true, 'header-1' ) . "\n";
		    } else if ( $tb_right_config == "menu" ) {
		        $tb_right_output .= sf_top_bar_menu() . "\n";
		    } else if ($tb_right_config == "cart-wishlist") {
			    $tb_right_output .= '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">'. "\n";
			    $tb_right_output .= sf_get_cart();
			    $tb_right_output .= sf_get_wishlist();
			    $tb_right_output .= '</ul></nav></div>'. "\n";
		    } else {
		        $tb_right_output .= '<div class="tb-text">' . do_shortcode( $tb_right_text ) . '</div>' . "\n";
		    }
		    
		    $top_bar_class = "";
		    if ($enable_sticky_tb) {
		    	$top_bar_class = "sticky-top-bar";
		    }
		?>
		<?php if ($enable_tb) { ?>
		<!--// TOP BAR //-->
		<div id="top-bar" class="<?php echo $top_bar_class; ?>">
		<?php if ($fullwidth_header) { ?>
		<div class="container fw-header">
		    <?php } else { ?>
		    <div class="container">
		        <?php } ?>
		        <div class="col-sm-6 tb-left"><?php echo $tb_left_output; ?></div>
		        <div class="col-sm-6 tb-right"><?php echo $tb_right_output; ?></div>
		    </div>
		</div>
		<?php } ?>

		<!--// HEADER //-->
		<div class="header-wrap <?php echo esc_attr($page_classes['header-wrap']); ?> page-header-<?php echo esc_attr($page_header_type); ?>">
			
			<?php do_action('sf_before_header_section'); ?>
			
		    <div id="header-section" class="<?php echo esc_attr($header_layout); ?> <?php echo esc_attr($page_classes['logo']); ?>">
		    	<?php do_action('sf_header_section_start'); ?>
		        <?php echo sf_header( $header_layout ); ?>
		        <?php do_action('sf_header_section_end'); ?>
		    </div>
		    
		    <?php do_action('sf_after_header_section'); ?>

		    <?php
		        // Overlay Menu
		        if ( $header_left_config == "overlay-menu" || $header_right_config == "overlay-menu" ) {
		            echo sf_overlay_menu();
		        }
		    ?>

		    <?php
		        // Contact Slideout
		        if ( $header_left_config == "contact" || $header_right_config == "contact" ) {
		            echo sf_contact_slideout();
		        }
		    ?>

		</div>

		<?php
	    }
	    add_action( 'sf_container_start', 'sf_header_wrap', 20 );
    }


    /* HEADER
    ================================================== */
    if ( ! function_exists( 'sf_header' ) ) {
        function sf_header( $header_layout ) {
			
			$header = "";
			
			$header .= do_action('sf_before_header_layout');
			
            // Get layout and return output
            $header .= sf_get_header_layout( $header_layout );
            
            $header .= do_action('sf_after_header_layout');
            
            return $header;

        }
    }


    /* HEADER AUX
    ================================================== */
    if ( ! function_exists( 'sf_header_aux' ) ) {
        function sf_header_aux( $aux ) {

            global $sf_options;
			$page_classes       = sf_page_classes();
			
            $show_cart           = $sf_options['show_cart'];
            $show_wishlist       = $sf_options['show_wishlist'];
            $header_layout      = $page_classes['header-layout'];
            $header_left_config  = __($sf_options['header_left_config'], 'swiftframework');
            $header_right_config = __($sf_options['header_right_config'], 'swiftframework');
            $header_left_text    = __( $sf_options['header_left_text'], 'swiftframework' );
            $header_right_text   = __( $sf_options['header_right_text'], 'swiftframework' );
            $fullwidth_header    = $sf_options['fullwidth_header'];
            $contact_icon        = apply_filters( 'sf_header_contact_icon', '<i class="ss-mail"></i>' );

            if ( $aux == "left" ) {
                $header_left_output = "";
                if ( $header_left_config == "social" ) {
                    $header_left_output .= do_shortcode( '[social]' ) . "\n";
                } else if ( $header_left_config == "aux-links" ) {
                    $header_left_output .= sf_aux_links( 'header-menu', true, $header_layout ) . "\n";
                } else if ( $header_left_config == "overlay-menu" ) {
                    $header_left_output .= '<a href="#" class="overlay-menu-link"><span>' . __( "Menu", "swiftframework" ) . '</span></a>' . "\n";
                } else if ( $header_left_config == "contact" ) {
                    $header_left_output .= '<a href="#" class="contact-menu-link">' . $contact_icon . '</a>' . "\n";
                } else if ( $header_left_config == "currency-switcher" ) {
                	$aux_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
                	$aux_output .= sf_get_currency_switcher();
                	$aux_output .= '</ul></nav></div>'. "\n";
                } else if ( $header_left_config == "search" ) {
                    $header_left_output .= '<nav class="std-menu">' . "\n";
                    $header_left_output .= '<ul class="menu">' . "\n";
                    $header_left_output .= sf_get_search( 'aux' );
                    $header_left_output .= '</ul>' . "\n";
                    $header_left_output .= '</nav>' . "\n";
                } else {
                    $header_left_output .= '<div class="text">' . do_shortcode( $header_left_text ) . '</div>' . "\n";
                }

                return $header_left_output;
            } else if ( $aux == "right" ) {
                $header_right_output = "";
                if ( $header_right_config == "social" ) {
                    $header_right_output .= do_shortcode( '[social]' ) . "\n";
                } else if ( $header_right_config == "aux-links" ) {
                    $header_right_output .= sf_aux_links( 'header-menu', true, $header_layout ) . "\n";
                } else if ( $header_right_config == "overlay-menu" ) {
                    $header_right_output .= '<a href="#" class="overlay-menu-link"><span>' . __( "Menu", "swiftframework" ) . '</span></a>' . "\n";
                } else if ( $header_right_config == "contact" ) {
                    $header_right_output .= '<a href="#" class="contact-menu-link">' . $contact_icon . '</a>' . "\n";
                } else if ( $header_right_config == "currency-switcher") {
                	$aux_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
                	$aux_output .= sf_get_currency_switcher();
                	$aux_output .= '</ul></nav></div>'. "\n";
                } else if ( $header_right_config == "search" ) {
                    $header_right_output .= '<nav class="std-menu">' . "\n";
                    $header_right_output .= '<ul class="menu">' . "\n";
                    $header_right_output .= sf_get_search( 'aux' );
                    $header_right_output .= '</li>' . "\n";
                    $header_right_output .= '</ul>' . "\n";
                    $header_right_output .= '</nav>' . "\n";
                } else {
                    $header_right_output .= '<div class="text">' . do_shortcode( $header_right_text ) . '</div>' . "\n";
                }

                return $header_right_output;
            }
        }
    }


    /* LOGO
    ================================================== */
    if ( ! function_exists( 'sf_logo' ) ) {
        function sf_logo( $logo_class, $logo_id = "logo" ) {

            //VARIABLES
            global $post, $sf_options;
            $show_cart = false;
            $sticky_header_transparent = false;
            if ( isset($sf_options['show_cart']) ) {
            $show_cart            = $sf_options['show_cart'];
            }
            $logo        = $retina_logo = $light_logo = $dark_logo = $alt_logo = array();
            $header_type = "standard";
            $page_header_alt_logo = false;

            if ( $post && !is_search() ) {
                $header_type = sf_get_post_meta( $post->ID, 'sf_page_header_type', true );
                $page_header_alt_logo = sf_get_post_meta( $post->ID, 'sf_page_header_alt_logo', true );
                $sticky_header_transparent = sf_get_post_meta( $post->ID, 'sf_sticky_header_transparent', true );
            }
            
            // Shop page check
            $shop_page = false;
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            if ( $shop_page ) {
                if ( isset($sf_options['woo_page_header']) ) {
                    $header_type = $sf_options['woo_page_header'];
                }
            }

            // Standard Logo
            if ( isset( $sf_options['logo_upload'] ) ) {
                $logo = $sf_options['logo_upload'];
            }

            // Retina Logo
            if ( isset( $sf_options['retina_logo_upload'] ) ) {
                $retina_logo = $sf_options['retina_logo_upload'];
            }

            // Light Logo
            if ( isset( $sf_options['light_logo_upload'] ) ) {
                $light_logo = $sf_options['light_logo_upload'];
            }
            if ( isset( $light_logo['url'] ) && $light_logo['url'] != "" && ( $header_type == "naked-light" || $header_type == "naked-dark" || $sticky_header_transparent ) ) {
                $logo_class .= " has-light-logo";
            }

            // Dark Logo
            if ( isset( $sf_options['dark_logo_upload'] ) ) {
                $dark_logo = $sf_options['dark_logo_upload'];
            }
            if ( isset( $dark_logo['url'] ) && $dark_logo['url'] != "" && ( $header_type == "naked-light" || $header_type == "naked-dark" || $sticky_header_transparent ) ) {
                $logo_class .= " has-dark-logo";
            }

            // Alt Logo
            if ( isset( $sf_options['alt_logo_upload'] ) && $page_header_alt_logo ) {
                $alt_logo = $sf_options['alt_logo_upload'];
            }


            if ( isset( $retina_logo['url'] ) && $retina_logo['url'] == "" && $logo['url'] != "" ) {
                $retina_logo['url'] = $logo['url'];
            }
            if ( isset( $logo['url'] ) && $logo['url'] != "" ) {
                $logo_class .= " has-img";
            } else {
                $logo_class .= " no-img";
            }
            $logo_output         = "";
            $logo_alt            = get_bloginfo( 'name' );
            $logo_tagline        = get_bloginfo( 'description' );
            $logo_link_url       = apply_filters( 'sf_logo_link_url', home_url() );
            $enable_logo_tagline = false;
            if ( isset( $sf_options['enable_logo_tagline'] ) ) {
                $enable_logo_tagline = $sf_options['enable_logo_tagline'];
            }
            
            // Animation
            $logo_anim = "";
            if ( isset( $sf_options['logo_hover_anim'] ) ) {
                $logo_anim = $sf_options['logo_hover_anim'];
            }


            /* LOGO OUTPUT
            ================================================== */
            $logo_output .= '<div id="' . $logo_id . '" class="' . $logo_class . ' clearfix" data-anim="' . $logo_anim . '">' . "\n";
            $logo_output .= '<a href="' . $logo_link_url . '">' . "\n";

            if ( $logo_id == "mobile-logo" && sf_theme_supports('mobile-logo-override') ) {

	            $mobile_logo = $mobile_retina_logo = "";

	            if ( isset( $sf_options['mobile_logo_upload'] ) ) {
					$mobile_logo = $sf_options['mobile_logo_upload'];
				}
				if ( isset( $sf_options['mobile_retina_logo_upload'] ) ) {
					$mobile_retina_logo = $sf_options['mobile_retina_logo_upload'];
				}

				// Standard Mobile Logo
	            if ( isset( $mobile_logo['url'] ) && $mobile_logo['url'] != "" ) {
	                $logo_output .= '<img class="standard" src="' . $mobile_logo['url'] . '" alt="' . $logo_alt . '" height="' . $mobile_logo['height'] . '" width="' . $mobile_logo['width'] . '" />' . "\n";
	            } else if ( isset( $logo['url'] ) && $logo['url'] != "" ) {
	                $logo_output .= '<img class="standard" src="' . $logo['url'] . '" alt="' . $logo_alt . '" height="' . $logo['height'] . '" width="' . $logo['width'] . '" />' . "\n";
	            }

	            // Retina Logo
	            if ( isset( $mobile_retina_logo['url'] ) && $mobile_retina_logo['url'] != "" ) {
	                $logo_height = intval( $mobile_retina_logo['height'], 10 ) / 2;
	                $logo_width  = intval( $mobile_retina_logo['width'], 10 ) / 2;
	                $logo_output .= '<img class="retina" src="' . $mobile_retina_logo['url'] . '" alt="' . $logo_alt . '" height="' . $logo_height . '" width="' . $logo_width . '" />' . "\n";
	            } else if ( isset( $retina_logo['url'] ) && $retina_logo['url'] != "" ) {
	                $logo_height = intval( $retina_logo['height'], 10 ) / 2;
	                $logo_width  = intval( $retina_logo['width'], 10 ) / 2;
	                $logo_output .= '<img class="retina" src="' . $retina_logo['url'] . '" alt="' . $logo_alt . '" height="' . $logo_height . '" width="' . $logo_width . '" />' . "\n";
	            }

	            // Alt Logo
	            if ( isset( $alt_logo['url'] ) && $alt_logo['url'] != "" && $page_header_alt_logo ) {
	                $logo_output .= '<img class="alt-logo" src="' . $alt_logo['url'] . '" alt="' . $logo_alt . '" height="' . $alt_logo['height'] . '" width="' . $alt_logo['width'] . '" />' . "\n";
	            }

	            // Text Logo
	            $logo_output .= '<div class="text-logo">';
	            if ( ! isset( $logo['url'] ) || $logo['url'] == "" ) {
	                $logo_output .= '<h1 class="logo-h1 standard">' . $logo_alt . '</h1>' . "\n";
	            }
	            if ( ! isset( $retina_logo['url'] ) || $retina_logo['url'] == "" ) {
	                $logo_output .= '<h1 class="logo-h1 retina">' . $logo_alt . '</h1>' . "\n";
	            }
	            if ( $enable_logo_tagline && $logo_tagline != "" ) {
	                $logo_output .= '<h2 class="logo-h2">' . $logo_tagline . '</h1>' . "\n";
	            }
	            $logo_output .= '</div>' . "\n";

            } else {

		        // Standard Logo
	            if ( isset( $logo['url'] ) && $logo['url'] != "" ) {
	                $logo_output .= '<img class="standard" src="' . $logo['url'] . '" alt="' . $logo_alt . '" height="' . $logo['height'] . '" width="' . $logo['width'] . '" />' . "\n";
	            }

	            // Retina Logo
	            if ( isset( $retina_logo['url'] ) && $retina_logo['url'] != "" ) {
	                $logo_height = intval( $retina_logo['height'], 10 ) / 2;
	                $logo_width  = intval( $retina_logo['width'], 10 ) / 2;
	                $logo_output .= '<img class="retina" src="' . $retina_logo['url'] . '" alt="' . $logo_alt . '" height="' . $logo_height . '" width="' . $logo_width . '" />' . "\n";
	            }

	            // Light Logo
	            if ( isset( $light_logo['url'] ) && $light_logo['url'] != "" && ( $header_type == "naked-light" || $header_type == "naked-dark" || $sticky_header_transparent ) ) {
	                $logo_output .= '<img class="light-logo" src="' . $light_logo['url'] . '" alt="' . $logo_alt . '" height="' . $light_logo['height'] . '" width="' . $light_logo['width'] . '" />' . "\n";
	            }

	            // Dark Logo
	            if ( isset( $dark_logo['url'] ) && $dark_logo['url'] != "" && ( $header_type == "naked-light" || $header_type == "naked-dark" || $sticky_header_transparent ) ) {
	                $logo_output .= '<img class="dark-logo" src="' . $dark_logo['url'] . '" alt="' . $logo_alt . '" height="' . $dark_logo['height'] . '" width="' . $dark_logo['width'] . '" />' . "\n";
	            }

	            // Alt Logo
	            if ( isset( $alt_logo['url'] ) && $alt_logo['url'] != "" && $page_header_alt_logo ) {
	                $logo_output .= '<img class="alt-logo" src="' . $alt_logo['url'] . '" alt="' . $logo_alt . '" height="' . $alt_logo['height'] . '" width="' . $alt_logo['width'] . '" />' . "\n";
	            }

	            // Text Logo
	            $logo_output .= '<div class="text-logo">';
	            if ( ! isset( $logo['url'] ) || $logo['url'] == "" ) {
	                $logo_output .= '<h1 class="logo-h1 standard">' . $logo_alt . '</h1>' . "\n";
	            }
	            if ( ! isset( $retina_logo['url'] ) || $retina_logo['url'] == "" ) {
	                $logo_output .= '<h1 class="logo-h1 retina">' . $logo_alt . '</h1>' . "\n";
	            }
	            if ( $enable_logo_tagline && $logo_tagline != "" ) {
	                $logo_output .= '<h2 class="logo-h2">' . $logo_tagline . '</h1>' . "\n";
	            }
	            $logo_output .= '</div>' . "\n";

            }

            $logo_output .= '</a>' . "\n";
            $logo_output .= '</div>' . "\n";


            // LOGO RETURN
            return $logo_output;
        }
    }

    /* TOP BAR MENU
    ================================================== */
    if ( ! function_exists( 'sf_top_bar_menu' ) ) {
        function sf_top_bar_menu() {

            $tb_menu_args = array(
                'echo'           => false,
                'theme_location' => 'top_bar_menu',
                'walker'         => new sf_alt_menu_walker,
                'fallback_cb'    => '',
            );

            // MENU OUTPUT
            $tb_menu_output = '<nav class="std-menu clearfix">' . "\n";

            if ( function_exists( 'wp_nav_menu' ) ) {
                if ( has_nav_menu( 'top_bar_menu' ) ) {
                    $tb_menu_output .= wp_nav_menu( $tb_menu_args );
                } else {
                    $tb_menu_output .= '<div class="no-menu">' . __( "Please assign a menu to the Top Bar Menu in Appearance > Menus", "swiftframework" ) . '</div>';
                }
            }
            $tb_menu_output .= '</nav>' . "\n";

            return $tb_menu_output;
        }
    }

    /* MENU
    ================================================== */
    if ( ! function_exists( 'sf_main_menu' ) ) {
        function sf_main_menu( $id, $layout = "" ) {

            // VARIABLES
            global $sf_options, $post;

			$show_cart = false;
			if ( isset($sf_options['show_cart']) ) {
			$show_cart            = $sf_options['show_cart'];
			}
            $show_wishlist        = $sf_options['show_wishlist'];
            $header_search_type   = $sf_options['header_search_type'];
            $vertical_header_text = __( $sf_options['vertical_header_text'], 'swiftframework' );
            $page_menu            = $menu_output = $menu_full_output = $menu_with_search_output = $menu_float_output = $menu_vert_output = "";

            if ( $post && !is_search() ) {
                $page_menu = sf_get_post_meta( $post->ID, 'sf_page_menu', true );
            }
            $main_menu_args = array(
                'echo'           => false,
                'theme_location' => 'main_navigation',
                'walker'         => new sf_mega_menu_walker,
                'fallback_cb'    => '',
                'menu'           => $page_menu
            );


            // MENU OUTPUT
            $menu_output .= '<nav id="' . $id . '" class="std-menu clearfix">' . "\n";

            if ( function_exists( 'wp_nav_menu' ) ) {
                if ( has_nav_menu( 'main_navigation' ) ) {
                    $menu_output .= wp_nav_menu( $main_menu_args );
                } else {
                    $menu_output .= '<div class="no-menu">' . __( "Please assign a menu to the Main Menu in Appearance > Menus", "swiftframework" ) . '</div>';
                }
            }
            $menu_output .= '</nav>' . "\n";


            // FULL WIDTH MENU OUTPUT
            if ( $layout == "full" ) {

                $menu_full_output .= '<div class="container">' . "\n";
                $menu_full_output .= '<div class="row">' . "\n";
                $menu_full_output .= '<div class="menu-left">' . "\n";
                $menu_full_output .= $menu_output . "\n";
                $menu_full_output .= '</div>' . "\n";
                $menu_full_output .= '<div class="menu-right">' . "\n";
                $menu_full_output .= '<nav class="std-menu">' . "\n";
                $menu_full_output .= '<ul class="menu">' . "\n";
                $menu_full_output .= sf_get_search( $header_search_type );
                if ( $show_cart ) {
                    $menu_full_output .= sf_get_cart();
                }
                if ( class_exists( 'YITH_WCWL_UI' ) && $show_wishlist ) {
                    $menu_full_output .= sf_get_wishlist();
                }
                $menu_full_output .= '</ul>' . "\n";
                $menu_full_output .= '</nav>' . "\n";
                $menu_full_output .= '</div>' . "\n";
                $menu_full_output .= '</div>' . "\n";
                $menu_full_output .= '</div>' . "\n";

                $menu_output = $menu_full_output;			
				
            } else if ( $layout == "with-search" ) {

                $menu_with_search_output .= '<nav class="search-nav std-menu">' . "\n";
                $menu_with_search_output .= '<ul class="menu">' . "\n";
                $menu_with_search_output .= sf_get_search( $header_search_type );
                $menu_with_search_output .= '</ul>' . "\n";
                $menu_with_search_output .= '</nav>' . "\n";
                $menu_with_search_output .= $menu_output . "\n";

                $menu_output = $menu_with_search_output;

            } else if ( $layout == "float" || $layout == "float-2" ) {

                $menu_float_output .= '<div class="float-menu container">' . "\n";
                $menu_float_output .= $menu_output . "\n";
                if ( $layout == "float-2" ) {
                    $menu_float_output .= '<nav class="std-menu float-alt-menu">' . "\n";
                    $menu_float_output .= '<ul class="menu">' . "\n";
                    $menu_float_output .= sf_get_search( $header_search_type );
                    if ( $show_cart ) {
                        $menu_float_output .= sf_get_cart();
                    }
                    if ( class_exists( 'YITH_WCWL_UI' ) && $show_wishlist ) {
                        $menu_float_output .= sf_get_wishlist();
                    }
                    $menu_float_output .= '</ul>' . "\n";
                    $menu_float_output .= '</nav>' . "\n";
                }
                $menu_float_output .= '</div>' . "\n";

                $menu_output = $menu_float_output;

            } else if ( $layout == "vertical" ) {

                $menu_vert_output .= $menu_output . "\n";
                $menu_vert_output .= '<div class="vertical-menu-bottom">' . "\n";
                $menu_vert_output .= sf_header_aux('right');
                $menu_vert_output .= '<div class="copyright">' . do_shortcode( stripslashes( $vertical_header_text ) ) . '</div>' . "\n";
                $menu_vert_output .= '</div>' . "\n";

                $menu_output = $menu_vert_output;
            }

            // MENU RETURN
            return $menu_output;
        }
    }


    /* MOBILE HEADER
    ================================================== */
    if ( ! function_exists( 'sf_mobile_header' ) ) {
        function sf_mobile_header() {

            global $woocommerce, $sf_options;

            $mobile_header_layout = $sf_options['mobile_header_layout'];
            $mobile_top_text      = __( $sf_options['mobile_top_text'], 'swiftframework' );
            $mobile_menu_icon     = apply_filters( 'sf_mobile_menu_icon', '<span class="menu-bars"></span>' );
            $mobile_cart_icon     = apply_filters( 'sf_mobile_cart_icon', '<i class="ss-cart"></i>' );
            $mobile_show_cart     = $sf_options['mobile_show_cart'];

			$mobile_header_class = "";
            $mobile_header_output = "";
			
			if ( sf_theme_supports('hamburger-css') ) {
				$mobile_menu_type        = "slideout";
				$hamburger_class = 'hamburger--3dx';
				if ( isset( $sf_options['mobile_menu_type'] ) ) {
				    $mobile_menu_type = $sf_options['mobile_menu_type'];
				}
				if ( $mobile_menu_type == "overlay" ) {
					$hamburger_class = 'hamburger--3dy';
				}
				
				$mobile_menu_link = '<button class="hamburger mobile-menu-link '.$hamburger_class.'" type="button">
				  <span class="hamburger-box">
				    <span class="hamburger-inner"></span>
				  </span>
				</button>';
			} else {
				$mobile_menu_link = '<a href="#" class="mobile-menu-link menu-bars-link">' . $mobile_menu_icon . '</a>';
			}
			
            $mobile_cart_link = '<a href="#" class="mobile-cart-link">' . $mobile_cart_icon . '</a>';

			if ( sf_theme_opts_name() == "sf_atelier_options" || sf_theme_opts_name() == "sf_uplift_options" ) {
				$mobile_cart_link = '<nav class="std-menu float-alt-menu">' . "\n";
                $mobile_cart_link .= '<ul class="menu">' . "\n";
				$mobile_cart_link .= sf_get_cart();
				$mobile_cart_link .= '</ul>' . "\n";
                $mobile_cart_link .= '</nav>' . "\n";
			}

            if ( $mobile_top_text != "" ) {
                $mobile_header_output .= '<div id="mobile-top-text">' . do_shortcode( $mobile_top_text ) . '</div>';
            }

            $mobile_header_output .= '<header id="mobile-header" class="mobile-' . $mobile_header_layout . ' clearfix">' . "\n";

            if ( $mobile_header_layout == "right-logo" ) {
                $mobile_header_output .= '<div class="mobile-header-opts">';
                $mobile_header_output .= $mobile_menu_link . "\n";
                if ( $mobile_show_cart && $woocommerce != "" ) {
                    $mobile_header_output .= $mobile_cart_link . "\n";
                }
                $mobile_header_output .= '</div>';
                $mobile_header_output .= sf_logo( 'logo-right', 'mobile-logo' );
            } else if ( $mobile_header_layout == "center-logo" ) {
                $mobile_header_output .= '<div class="mobile-header-opts opts-left">';
                $mobile_header_output .= $mobile_menu_link . "\n";
                $mobile_header_output .= '</div>';
                $mobile_header_output .= sf_logo( 'logo-center', 'mobile-logo' );
                $mobile_header_output .= '<div class="mobile-header-opts opts-right">';
                if ( $mobile_show_cart && $woocommerce != "" ) {
                    $mobile_header_output .= $mobile_cart_link . "\n";
                }
                $mobile_header_output .= '</div>';
            } else if ( $mobile_header_layout == "center-logo-alt" ) {
                $mobile_header_output .= '<div class="mobile-header-opts opts-left">';
                if ( $mobile_show_cart && $woocommerce != "" ) {
                    $mobile_header_output .= $mobile_cart_link . "\n";
                }
                $mobile_header_output .= '</div>';
                $mobile_header_output .= sf_logo( 'logo-center', 'mobile-logo' );
                $mobile_header_output .= '<div class="mobile-header-opts opts-right">';
                $mobile_header_output .= $mobile_menu_link . "\n";
                $mobile_header_output .= '</div>';
            } else {
                $mobile_header_output .= sf_logo( 'logo-left', 'mobile-logo' );
                $mobile_header_output .= '<div class="mobile-header-opts">';
                $mobile_header_output .= $mobile_menu_link . "\n";
                if ( $mobile_show_cart && $woocommerce != "" ) {
                    $mobile_header_output .= $mobile_cart_link . "\n";
                }
                $mobile_header_output .= '</div>';
            }
            $mobile_header_output .= '</header>' . "\n";

            echo $mobile_header_output;
        }

        add_action( 'sf_container_start', 'sf_mobile_header', 10 );
    }


    /* MOBILE MENU
    ================================================== */
    if ( ! function_exists( 'sf_mobile_menu' ) ) {
        function sf_mobile_menu() {

            global $post, $sf_options;
			
			$header_search_pt = $sf_options['header_search_pt'];
			$mobile_header_layout = $sf_options['mobile_header_layout'];
            $mobile_show_translation = $sf_options['mobile_show_translation'];
            $mobile_show_search      = $sf_options['mobile_show_search'];
            $mobile_menu_type        = "slideout";
            $fs_close_icon = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
            if ( isset( $sf_options['mobile_menu_type'] ) ) {
                $mobile_menu_type = $sf_options['mobile_menu_type'];
            }
            $page_menu = "";

            if ( $post && !is_search() ) {
                $page_menu = sf_get_post_meta( $post->ID, 'sf_page_menu', true );
            }

            $mobile_menu_args = array(
                'echo'           => false,
                'theme_location' => 'mobile_menu',
                'walker'         => new sf_alt_menu_walker,
                'fallback_cb'    => '',
                'menu'			 => $page_menu
            );

            $mobile_menu_output = "";

            if ( $mobile_header_layout == "left-logo" || $mobile_header_layout == "center-logo-alt" ) {
            	$mobile_menu_output .= '<div id="mobile-menu-wrap" class="menu-is-right">' . "\n";
            } else {
            	$mobile_menu_output .= '<div id="mobile-menu-wrap" class="menu-is-left">' . "\n";
            }

            if ( $mobile_menu_type == "overlay" ) {
                $mobile_menu_output .= '<a href="#" class="mobile-overlay-close">'.$fs_close_icon.'</a>';
            }

            if ( $mobile_show_translation && ( function_exists( 'pll_the_languages' ) || function_exists( 'icl_get_languages' ) ) ) {
                $mobile_menu_output .= '<ul class="mobile-language-select">' . sf_language_flags() . '</ul>' . "\n";
            }
            if ( $mobile_show_search ) {
                $mobile_menu_output .= '<form method="get" class="mobile-search-form" action="' . home_url() . '/"><input type="text" placeholder="' . __( "Enter text to search", "swiftframework" ) . '" name="s" autocomplete="off" />';
                if ( $header_search_pt != "any" ) {
                    $mobile_menu_output .= '<input type="hidden" name="post_type" value="' . $header_search_pt . '" />';
                }
                $mobile_menu_output .= '</form>' . "\n";
            }
            $mobile_menu_output .= '<nav id="mobile-menu" class="clearfix">' . "\n";

            if ( function_exists( 'wp_nav_menu' ) ) {
                $mobile_menu_output .= wp_nav_menu( $mobile_menu_args );
            }

            $mobile_menu_output .= '</nav>' . "\n";
            $mobile_menu_output .= '</div>' . "\n";

            echo $mobile_menu_output;
        }

        add_action( 'sf_before_page_container', 'sf_mobile_menu', 10 );
    }

    /* MOBILE MENU
    ================================================== */
    if ( ! function_exists( 'sf_mobile_cart' ) ) {
        function sf_mobile_cart() {

            global $woocommerce, $sf_options;

			$mobile_header_layout = $sf_options['mobile_header_layout'];
            $mobile_show_cart    = $sf_options['mobile_show_cart'];
            $mobile_show_account = $sf_options['mobile_show_account'];
            $login_url           = wp_login_url();
            $logout_url          = wp_logout_url( home_url() );
            $my_account_link     = get_admin_url();
            $myaccount_page_id   = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $my_account_link = get_permalink( $myaccount_page_id );
                $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
                $login_url       = get_permalink( $myaccount_page_id );
                if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                    $login_url  = str_replace( 'http:', 'https:', $login_url );
                }
            }
            $login_url        = apply_filters( 'sf_header_login_url', $login_url );
            $my_account_link  = apply_filters( 'sf_header_myaccount_url', $my_account_link );
            $fs_close_icon    = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
            $mobile_menu_type = "slideout";
            if ( isset( $sf_options['mobile_menu_type'] ) ) {
                $mobile_menu_type = $sf_options['mobile_menu_type'];
            }

            $mobile_cart_output = "";

            if ( $mobile_show_cart && $woocommerce ) {
	            if ( $mobile_header_layout == "left-logo" || $mobile_header_layout == "center-logo-alt" ) {
	            	$mobile_cart_output .= '<div id="mobile-cart-wrap" class="cart-is-left">' . "\n";
	            } else {
	            	$mobile_cart_output .= '<div id="mobile-cart-wrap" class="cart-is-right">' . "\n";
	            }

                if ( $mobile_menu_type == "overlay" ) {
                    $mobile_cart_output .= '<a href="#" class="mobile-overlay-close">'.$fs_close_icon.'</a>';
                }

                $mobile_cart_output .= '<ul>' . "\n";
                $mobile_cart_output .= sf_get_cart();
                $mobile_cart_output .= '</ul>' . "\n";
                if ( $mobile_show_account ) {
                    $mobile_cart_output .= '<ul class="mobile-cart-menu">' . "\n";
                    if ( is_user_logged_in() ) {
                        $mobile_cart_output .= '<li><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", "swiftframework" ) . '</a></li>' . "\n";
                        $mobile_cart_output .= '<li><a href="' . $logout_url . '">' . __( "Sign Out", "swiftframework" ) . '</a></li>' . "\n";
                    } else {
                        $mobile_cart_output .= '<li><a href="' . $login_url . '">' . __( "Login", "swiftframework" ) . '</a></li>' . "\n";
                    }
                    $mobile_cart_output .= '</ul>' . "\n";
                }
                $mobile_cart_output .= '</div>' . "\n";
                echo $mobile_cart_output;
            }
        }

        add_action( 'sf_before_page_container', 'sf_mobile_cart', 20 );
    }


    /* WOO LINKS
    ================================================== */
    if ( ! function_exists( 'sf_woo_links' ) ) {
        function sf_woo_links( $position = "", $config = "" ) {

            // VARIABLES
            global $sf_options;

            $tb_search_text   = $sf_options['tb_search_text'];
            $woo_links_output = $ss_enable = "";
			$supersearch_icon = apply_filters('sf_header_supersearch_icon', '<i class="ss-zoomin"></i>');

            if ( isset( $sf_options['ss_enable'] ) ) {
                $ss_enable = $sf_options['ss_enable'];
            } else {
                $ss_enable = true;
            }

            // WOO LINKS OUTPUT
            $woo_links_output .= '<nav class="' . $position . '">' . "\n";
            $woo_links_output .= '<ul class="menu">' . "\n";
            if ( is_user_logged_in() ) {
                $current_user = wp_get_current_user();
                get_currentuserinfo();
                $woo_links_output .= '<li class="tb-welcome">' . __( "Welcome", "swiftframework" ) . " " . $current_user->display_name . '</li>' . "\n";
            } else {
                $woo_links_output .= '<li class="tb-welcome">' . __( "Welcome", "swiftframework" ) . '</li>' . "\n";
            }
            if ( $ss_enable ) {
                if ( $position == "top-menu" ) {
                    $woo_links_output .= '<li class="tb-woo-custom clearfix"><a class="swift-search-link" href="#">'.$supersearch_icon.'<span>' . do_shortcode( $tb_search_text ) . '</span></a></li>' . "\n";
                } else {
                    $woo_links_output .= '<li class="hs-woo-custom clearfix"><a class="swift-search-link" href="#">'.$supersearch_icon.'<span>' . do_shortcode( $tb_search_text ) . '</span></a></li>' . "\n";
                }
            }
            $woo_links_output .= '</ul>' . "\n";
            $woo_links_output .= '</nav>' . "\n";

            // RETURN
            return $woo_links_output;
        }
    }


    /* AUX LINKS
    ================================================== */
    if ( ! function_exists( 'sf_aux_links' ) ) {
        function sf_aux_links( $position, $alt_version = false, $header_version = "" ) {

            // VARIABLES
            $login_url         = wp_login_url();
            $logout_url        = wp_logout_url( home_url() );
            $my_account_link   = get_admin_url();
            $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $my_account_link = get_permalink( $myaccount_page_id );
                $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
                $login_url       = get_permalink( $myaccount_page_id );
                if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                    $login_url  = str_replace( 'http:', 'https:', $login_url );
                }
            }
            $login_url       = apply_filters( 'sf_header_login_url', $login_url );
            $my_account_link = apply_filters( 'sf_header_myaccount_url', $my_account_link );

            global $sf_options;

            $show_sub         = $sf_options['show_sub'];
            $show_translation = $sf_options['show_translation'];
            $sub_code         = __( $sf_options['sub_code'], 'swiftframework' );
            $show_account     = $sf_options['show_account'];
            $show_cart = $show_wishlist = false;
            if ( isset($sf_options['show_cart']) ) {
            $show_cart            = $sf_options['show_cart'];
            }
            if ( isset($sf_options['show_wishlist']) ) {
            $show_wishlist            = $sf_options['show_wishlist'];
            }
            $ss_enable        = $sf_options['ss_enable'];
            $aux_links_output = $ss_enable = "";


            // LINKS + SEARCH OUTPUT
            $aux_links_output .= '<nav class="std-menu ' . $position . '">' . "\n";
            $aux_links_output .= '<ul class="menu">' . "\n";
            if ( $show_account ) {
                if ( is_user_logged_in() ) {
                    $aux_links_output .= '<li><a href="' . $logout_url . '">' . __( "Sign Out", "swiftframework" ) . '</a></li>' . "\n";
                    $aux_links_output .= '<li><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", "swiftframework" ) . '</a></li>' . "\n";
                } else {
                    $aux_links_output .= '<li><a href="' . $login_url . '">' . __( "Login", "swiftframework" ) . '</a></li>' . "\n";
                }
            }
            if ( $show_sub ) {
                $aux_links_output .= '<li class="parent"><a href="#">' . __( "Subscribe", "swiftframework" ) . '</a>' . "\n";
                $aux_links_output .= '<ul class="sub-menu">' . "\n";
                $aux_links_output .= '<li><div class="header-subscribe clearfix">' . "\n";
                $aux_links_output .= do_shortcode( $sub_code ) . "\n";
                $aux_links_output .= '</div></li>' . "\n";
                $aux_links_output .= '</ul>' . "\n";
                $aux_links_output .= '</li>' . "\n";
            }
            if ( $show_translation ) {
                $aux_links_output .= '<li class="parent aux-languages"><a href="#">' . __( "Language", "swiftframework" ) . '</a>' . "\n";
                $aux_links_output .= '<ul class="header-languages sub-menu">' . "\n";
                if ( function_exists( 'sf_language_flags' ) ) {
                    $aux_links_output .= sf_language_flags();
                }
                $aux_links_output .= '</ul>' . "\n";
                $aux_links_output .= '</li>' . "\n";
            }
            if ( $header_version != "header-1" ) {
                if ( $show_cart ) {
                    $aux_links_output .= sf_get_cart();
                }
                if ( class_exists( 'YITH_WCWL_UI' ) && $show_wishlist ) {
                    $aux_links_output .= sf_get_wishlist();
                }
            }
            $aux_links_output .= '</ul>' . "\n";
            $aux_links_output .= '</nav>' . "\n";

            // RETURN
            return $aux_links_output;
        }
    }


    /* SEARCH DROPDOWN
    ================================================== */
    if ( ! function_exists( 'sf_get_search' ) ) {
        function sf_get_search( $type ) {

            if ( $type == "search-off" ) {
                return;
            }

            global $sf_options;

            $header_search_pt = $sf_options['header_search_pt'];
            $ajax_url         = admin_url( 'admin-ajax.php' );
            $search_icon 	  = apply_filters( 'sf_header_search_icon' , '<i class="ss-search"></i>' );

            $search_output = "";

            $search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link-alt">'.$search_icon.'</a>' . "\n";
            $search_output .= '<div class="ajax-search-wrap" data-ajaxurl="' . $ajax_url . '"><div class="ajax-loading"></div><form method="get" class="ajax-search-form" action="' . home_url() . '/">';
            if ( $header_search_pt != "any" ) {
                $search_output .= '<input type="hidden" name="post_type" value="' . $header_search_pt . '" />';
            }
            $search_output .= '<input type="text" placeholder="' . __( "Search", "swiftframework" ) . '" name="s" autocomplete="off" /></form><div class="ajax-search-results"></div></div>' . "\n";
            $search_output .= '</li>' . "\n";

            return $search_output;
        }
    }


    /* CART DROPDOWN
    ================================================== */
    if ( ! function_exists( 'sf_get_cart' ) ) {
        function sf_get_cart() {

            $cart_output = "";

            // Check if WooCommerce is active
            if ( sf_woocommerce_activated() ) {

                global $woocommerce, $sf_options;

                $show_cart_count = false;
                if ( isset( $sf_options['show_cart_count'] ) ) {
                    $show_cart_count = $sf_options['show_cart_count'];
                }
				
				if ( sf_theme_opts_name() == "sf_atelier_options" ) {
					$cart_total = '<span class="menu-item-title">' . __( "Cart" , "swiftframework" ) . '</span>';
				} else {
					$cart_total =  WC()->cart->get_cart_total();
				}
				
                $cart_count          = $woocommerce->cart->cart_contents_count;
                $cart_count_text     = sf_product_items_text( $cart_count );
                $cart_count_text_alt = sf_product_items_text( $cart_count, true );
				$view_cart_icon 	 = apply_filters( 'sf_view_cart_icon', '<i class="ss-view"></i>' );
				$checkout_icon 	 	 = apply_filters( 'sf_checkout_icon', '<i class="ss-creditcard"></i>' );
				$go_to_shop_icon  	 = apply_filters( 'sf_go_to_shop_icon', '<i class="ss-cart"></i>' );

                if ( $show_cart_count ) {
                    $cart_output .= '<li class="parent shopping-bag-item"><a class="cart-contents" href="' . $woocommerce->cart->get_cart_url() . '" title="' . __( "View your shopping cart", "swiftframework" ) . '">'. apply_filters( 'sf_header_cart_icon', '<i class="ss-cart"></i>' ) . '<span class="cart-text">' . __( "Cart", "swiftframework" ) . '</span>' . $cart_total . '<span class="num-items cart-count-enabled">' . $cart_count_text_alt . '</span></a>';
                } else {
                    $cart_output .= '<li class="parent shopping-bag-item"><a class="cart-contents" href="' . $woocommerce->cart->get_cart_url() . '" title="' . __( "View your shopping cart", "swiftframework" ) . '">'. apply_filters( 'sf_header_cart_icon', '<i class="ss-cart"></i>' ) . '<span class="cart-text">' . __( "Cart", "swiftframework" ) . '</span>' . $cart_total . '<span class="num-items">' . $cart_count_text_alt . '</span></a>';
                }
                $cart_output .= '<ul class="sub-menu">';
                $cart_output .= '<li>';

                $cart_output .= '<div class="shopping-bag" data-empty-bag-txt="' . __( 'Your cart is empty.', 'swiftframework' ) . '" data-singular-item-txt="' . __( 'item in the cart', 'swiftframework' ) . '" data-multiple-item-txt="' . __( 'items in the cart', 'swiftframework' ) .'">';

                $cart_output .= '<div class="loading-overlay"><i class="sf-icon-loader"></i></div>';

                if ( $cart_count != "0" ) {

                    $cart_output .= '<div class="bag-header">' . $cart_count_text . ' ' . __( 'in the cart', 'swiftframework' ) . '</div>';

                    $cart_output .= '<div class="bag-contents">';

                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

                        $_product     		 = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        
						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						
							$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							$product_title       = $_product->get_title();
							$product_short_title = ( strlen( $product_title ) > 25 ) ? substr( $product_title, 0, 22 ) . '...' : $product_title;
							
                            $cart_output .= '<div class="bag-product clearfix product-id-' . $cart_item['product_id'] . '">';
                            $cart_output .= '<figure><a class="bag-product-img" href="' . get_permalink( $cart_item['product_id'] ) . '">' . $_product->get_image() . '</a></figure>';
                            $cart_output .= '<div class="bag-product-details">';
                            $cart_output .= '<div class="bag-product-title"><a href="' . get_permalink( $cart_item['product_id'] ) . '">' . apply_filters( 'woocommerce_cart_widget_product_title', $product_short_title, $_product ) . '</a></div>';
                            $cart_output .= '<div class="bag-product-price">' . __( "Unit Price:", 'swiftframework' ) . '
	                        ' . $product_price . '</div>';
                            $cart_output .= '<div class="bag-product-quantity">' . __( 'Quantity:', 'swiftframework' ) . ' ' . apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ) . '</div>';
                            $cart_output .= '</div>';
                            $cart_output .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                            							'<a href="%s" class="remove remove-product" title="%s" data-ajaxurl="'.admin_url( 'admin-ajax.php' ).'" data-product-qty="'. $cart_item['quantity'] .'"  data-product-id="%s" data-product_sku="%s">&times;</a>',
                            							esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                            							__( 'Remove this item', 'swiftframework' ),
                            							esc_attr( $product_id ),
                            							esc_attr( $_product->get_sku() )
                            						), $cart_item_key );
                            $cart_output .= '</div>';
                        }
                    }

                    $cart_output .= '</div>';

                    if ( sf_theme_opts_name() == "sf_atelier_options" || sf_theme_opts_name() == "sf_uplift_options" ) {

	                    $cart_output .= '<div class="bag-total">';
	                    if ( class_exists( 'Woocommerce_German_Market' ) ) {
	                    $cart_output .= '<span class="total-title">' . __( "Total incl. tax", "swiftframework" ) . '</span>';
	                    } else {
	                    $cart_output .= '<span class="total-title">' . __( "Total", "swiftframework" ) . '</span>';
	                    }
	                    $cart_output .= '<span class="total-amount">' .  WC()->cart->get_cart_total() . '</span>';
	                    $cart_output .= '</div>';

                    }

                    $cart_output .= '<div class="bag-buttons">';

                    $cart_output .= '<a class="sf-button standard sf-icon-reveal bag-button" href="' . esc_url( $woocommerce->cart->get_cart_url() ) . '">'.$view_cart_icon.'<span class="text">' . __( 'View cart', 'swiftframework' ) . '</span></a>';

                    $cart_output .= '<a class="sf-button standard sf-icon-reveal checkout-button" href="' . esc_url( $woocommerce->cart->get_checkout_url() ) . '">'.$checkout_icon.'<span class="text">' . __( 'Checkout', 'swiftframework' ) . '</span></a>';

                    $cart_output .= '</div>';

                } else {

                    $cart_output .= '<div class="bag-empty">' . __( 'Your cart is empty.', 'swiftframework' ) . '</div>';

                }

                $cart_output .= '</div>';
                $cart_output .= '</li>';
                $cart_output .= '</ul>';
                $cart_output .= '</li>';
                
            } else if ( sf_edd_activated() ) {
            
            	global $sf_options;
            	
                $show_cart_count = false;
                if ( isset( $sf_options['show_cart_count'] ) ) {
                    $show_cart_count = $sf_options['show_cart_count'];
                }
				
				if ( sf_theme_opts_name() == "sf_atelier_options" ) {
					$cart_total = '<span class="menu-item-title">' . __( "Cart" , "swiftframework" ) . '</span>';
				} else {
					$cart_total =  html_entity_decode( edd_currency_filter( edd_format_amount( edd_get_cart_total() ) ), ENT_COMPAT, 'UTF-8' );
				}
				
				$cart_items    = edd_get_cart_contents();
				$cart_quantity = edd_get_cart_quantity();				
                $cart_count_text     = sf_product_items_text( $cart_quantity );
                $cart_count_text_alt = sf_product_items_text( $cart_quantity, true );
                $cart_url = "";
                $checkout_url = edd_get_checkout_uri();
				$view_cart_icon 	 = apply_filters( 'sf_view_cart_icon', '<i class="ss-view"></i>' );
				$checkout_icon 	 	 = apply_filters( 'sf_checkout_icon', '<i class="ss-creditcard"></i>' );
				$go_to_shop_icon  	 = apply_filters( 'sf_go_to_shop_icon', '<i class="ss-cart"></i>' );

                if ( $show_cart_count ) {
                    $cart_output .= '<li class="parent shopping-bag-item edd-shopping-bag-item"><a class="edd-cart-contents" href="' . $cart_url . '" title="' . __( "View your shopping cart", "swiftframework" ) . '">'. apply_filters( 'sf_header_cart_icon', '<i class="ss-cart"></i>' ) . '<span class="cart-text">' . __( "Cart", "swiftframework" ) . '</span>' . $cart_total . '<span class="num-items cart-count-enabled">' . $cart_count_text_alt . '</span></a>';
                } else {
                    $cart_output .= '<li class="parent shopping-bag-item edd-shopping-bag-item"><a class="edd-cart-contents" href="' . $cart_url . '" title="' . __( "View your shopping cart", "swiftframework" ) . '">'. apply_filters( 'sf_header_cart_icon', '<i class="ss-cart"></i>' ) . '<span class="cart-text">' . __( "Cart", "swiftframework" ) . '</span>' . $cart_total . '<span class="num-items">' . $cart_count_text_alt . '</span></a>';
                }
                $cart_output .= '<ul class="sub-menu">';
                $cart_output .= '<li>';

                $cart_output .= '<div class="shopping-bag" data-empty-bag-txt="' . __( 'Your cart is empty.', 'swiftframework' ) . '" data-singular-item-txt="' . __( 'item in the cart', 'swiftframework' ) . '" data-multiple-item-txt="' . __( 'items in the cart', 'swiftframework' ) .'">';
            	
            	
	            	// get cart widget
	            	ob_start();
	            	the_widget( 'edd_cart_widget' );
	            	$widget = ob_get_contents();
	            	ob_end_clean();
	            		
	            	$cart_output .= $widget;
            	            	          
                $cart_output .= '</div>';
                $cart_output .= '</li>';
                $cart_output .= '</ul>';
                $cart_output .= '</li>';
            
            }

            return $cart_output;
        }
    }


    /* WISHLIST DROPDOWN
    ================================================== */
    if ( ! function_exists( 'sf_get_wishlist' ) ) {
        function sf_get_wishlist() {

            global $wpdb, $yith_wcwl, $woocommerce;

            if ( ! $yith_wcwl || ! $woocommerce ) {
                return;
            }

            $wishlist_output = "";

            if ( is_user_logged_in() ) {
                $user_id = get_current_user_id();
            }

            $wishlist_icon = apply_filters( 'sf_view_wishlist_icon', '<i class="ss-star"></i>' );

            $count = array();

            if ( is_user_logged_in() ) {
                $count = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) as `cnt` FROM `' . YITH_WCWL_TABLE . '` WHERE `user_id` = %d', $user_id ), ARRAY_A );
                $count = $count[0]['cnt'];
            } else{
                $count[0]['cnt'] = count( yith_getcookie( 'yith_wcwl_products' ) );
                $count           = $count[0]['cnt'];
            }

            if ( is_array( $count ) ) {
                $count = 0;
            }

            if ( sf_theme_opts_name() == "sf_atelier_options" || sf_theme_opts_name() == "sf_uplift_options" ) {
				$wishlist_output .= '<li class="parent wishlist-item"><a class="wishlist-link" href="' . $yith_wcwl->get_wishlist_url() . '" title="' . __( "View your wishlist", "swiftframework" ) . '"><span class="menu-item-title">' . __( "Wishlist", "swiftframework" ) . '</span> ' . apply_filters( 'sf_wishlist_menu_icon', '<i class="ss-star"></i>' ) . '<span class="count">' . $count . '</span><span class="star"></span></a>';
            } else {
	            $wishlist_output .= '<li class="parent wishlist-item"><a class="wishlist-link" href="' . $yith_wcwl->get_wishlist_url() . '" title="' . __( "View your wishlist", "swiftframework" ) . '">' . apply_filters( 'sf_wishlist_menu_icon', '<i class="ss-star"></i>' ) . '<span class="count">' . $count . '</span><span class="star"></span></a>';
            }
            $wishlist_output .= '<ul class="sub-menu">';
            $wishlist_output .= '<li>';
            $wishlist_output .= '<div class="wishlist-bag">';

            $current_page = 1;
            $limit_sql    = '';
            $count_limit  = 0;

            if ( is_user_logged_in() ) {
                $wishlist = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = %s" . $limit_sql, $user_id ), ARRAY_A );
            } else {
                $wishlist = yith_getcookie( 'yith_wcwl_products' );
            }

            $wishlist_output .= '<div class="bag-contents">';

            $wishlist_output .= do_action( 'yith_wcwl_before_wishlist' );

            if ( count( $wishlist ) > 0 ) :

                foreach ( $wishlist as $values ) :

                    if ( $count_limit < 3 ) {

                        if ( ! is_user_logged_in() ) {
                            if ( isset( $values['add-to-wishlist'] ) && is_numeric( $values['add-to-wishlist'] ) ) {
                                $values['prod_id'] = $values['add-to-wishlist'];
                                $values['ID']      = $values['add-to-wishlist'];
                            } else {
                            	if ( isset($values['product_id'] )){
								   $values['prod_id'] = $values['product_id'];
                                   $values['ID']      = $values['product_id'];	
								}else{
									 $values['ID']      = $values['prod_id'];	
								}
                                
                            }
                        }

                        $product_obj = get_product( $values['prod_id'] );

                        if ( $product_obj !== false && $product_obj->exists() ) :

                            $wishlist_output .= '<div id="wishlist-' . $values['ID'] . '" class="bag-product clearfix prod-' .  $values['prod_id'] . '">';

                            if ( has_post_thumbnail( $product_obj->id ) ) {
                                $image_link = wp_get_attachment_url( get_post_thumbnail_id( $product_obj->id ) );
                                $image      = wp_get_attachment_image_src( get_post_thumbnail_id( $product_obj->id ), 'thumbnail' );

                                if ( $image ) {
                                    $wishlist_output .= '<figure><a class="bag-product-img" href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ) . '"><img itemprop="image" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" /></a></figure>';
                                }
                            }

                            $wishlist_output .= '<div class="bag-product-details">';
                            $wishlist_output .= '<div class="bag-product-title"><a href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ) . '">' . apply_filters( 'woocommerce_in_cartproduct_obj_title', $product_obj->get_title(), $product_obj ) . '</a></div>';

                            if ( get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' ) {
                                $wishlist_output .= '<div class="bag-product-price">' . apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price_excluding_tax() ), $values, '' ) . '</div>';
                            } else {
                                $wishlist_output .= '<div class="bag-product-price">' . apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price() ), $values, '' ) . '</div>';
                            }
                            $wishlist_output .= '</div>';
                            $wishlist_output .= '</div>';

                        endif;

                        $count_limit ++;
                    }

                endforeach;

            else :
                $wishlist_output .= '<div class="wishlist-empty">' . __( 'Your wishlist is empty.', 'swiftframework' ) . '</div>';
            endif;

            $wishlist_output .= '</div>';

            if ( count( $wishlist ) > 0 ) {
				$wishlist_output .= '<div class="bag-buttons">';
			} else {
				$wishlist_output .= '<div class="bag-buttons no-items">';
			}
            $wishlist_output .= '<a class="sf-button standard sf-icon-reveal wishlist-button" href="' . $yith_wcwl->get_wishlist_url() . '">'.$wishlist_icon.'<span class="text">' . __( 'View Wishlist', 'swiftframework' ) . '</span></a>';

            $wishlist_output .= '</div>';

            $wishlist_output .= '</div>';
            $wishlist_output .= '</li>';
            $wishlist_output .= '</ul>';
            $wishlist_output .= '</li>';

            return $wishlist_output;
        }
    }

	/* CURRENCY DROPDOWN
	================================================== */
	if ( ! function_exists( 'sf_get_currency_switcher' ) ) {
	    function sf_get_currency_switcher() {
	    	$currency_switch_output = "";
	    	if ( class_exists('WCML_Multi_Currency') ) {
	    		$currency_code = get_option('woocommerce_currency');
	    		$currency_switch_output .= '<li class="parent currency-switch-item">';
	    		$currency_switch_output .= '<span class="current-currency">' . get_woocommerce_currency_symbol() . '</span>';
	    		$currency_switch_output .= do_shortcode('[currency_switcher switcher_style="list" format="%code% (%symbol%)"]');
	    		$currency_switch_output .= '</li>';
	    		return $currency_switch_output;
	    	} else {
	    		$currency_switch_output = '<li><span class="current-currency">&times;</span><ul class="sub-menu"><li><span>WPML + WooCommerce Multilingual plugins are required for this functionality.</span></li></ul></li>';
	    		return $currency_switch_output;
	    	}
	    }
	}

    /* ACCOUNT
    ================================================== */
    if ( ! function_exists( 'sf_get_account' ) ) {
        function sf_get_account( $aux = "" ) {

        	// VARIABLES
            $login_url         = wp_login_url();
            $logout_url        = wp_logout_url( home_url() );
            $my_account_link   = get_admin_url();
            $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $my_account_link = get_permalink( $myaccount_page_id );
                $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
                $login_url       = get_permalink( $myaccount_page_id );
                if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                    $login_url  = str_replace( 'http:', 'https:', $login_url );
                }
            }
            $login_url       = apply_filters( 'sf_header_login_url', $login_url );
            $register_url	 = apply_filters( 'sf_header_register_url', wp_registration_url() );
            $my_account_link = apply_filters( 'sf_header_myaccount_url', $my_account_link );

			if ( get_option( 'woocommerce_enable_myaccount_registration' ) && $myaccount_page_id ) {
				$register_url = apply_filters( 'sf_header_register_url', $my_account_link );
			}

            global $sf_options;

            $show_sub         = $sf_options['show_sub'];
            $show_translation = false;
            if ( isset($sf_options['show_translation']) ) {
            	$show_translation = $sf_options['show_translation'];
            }
            $sub_code         = __( $sf_options['sub_code'], 'swiftframework' );
            $account_output = "";


            // LINKS + SEARCH OUTPUT
            $account_output .= '<nav class="std-menu">' . "\n";
            $account_output .= '<ul class="menu">' . "\n";
            $account_output .= '<li class="parent account-item">' . "\n";
            
            if ( $aux == "aux-text" ) {
            	$account_output .= '<a href="#">' . __( "My Account", "swiftframework" ) . '</a>' . "\n";  
            } else {
				$account_output .= '<a href="#"><i class="sf-icon-account"></i></a>' . "\n";            
            }
            
			$account_output .= '<ul class="sub-menu">' . "\n";
            if ( is_user_logged_in() ) {
                $account_output .= '<li class="menu-item"><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", "swiftframework" ) . '</a></li>' . "\n";
                $account_output .= '<li class="menu-item"><a href="' . $logout_url . '">' . __( "Sign Out", "swiftframework" ) . '</a></li>' . "\n";
            } else {
                $account_output .= '<li class="menu-item"><a href="' . $login_url . '">' . __( "Login", "swiftframework" ) . '</a></li>' . "\n";
                $account_output .= '<li class="menu-item"><a href="' . $register_url . '">' . __( "Sign Up", "swiftframework" ) . '</a></li>' . "\n";
            }
            if ( $show_sub && $sub_code != "" ) {
                $account_output .= '<li class="parent"><a href="#">' . __( "Subscribe", "swiftframework" ) . '</a>' . "\n";
                $account_output .= '<ul class="sub-menu">' . "\n";
                $account_output .= '<li><div class="header-subscribe clearfix">' . "\n";
                $account_output .= do_shortcode( $sub_code ) . "\n";
                $account_output .= '</div></li>' . "\n";
                $account_output .= '</ul>' . "\n";
                $account_output .= '</li>' . "\n";
            }
            if ( $show_translation ) {
                $account_output .= '<li class="parent aux-languages"><a href="#">' . __( "Language", "swiftframework" ) . '</a>' . "\n";
                $account_output .= '<ul class="header-languages sub-menu">' . "\n";
                if ( function_exists( 'sf_language_flags' ) ) {
                    $account_output .= sf_language_flags();
                }
                $account_output .= '</ul>' . "\n";
                $account_output .= '</li>' . "\n";
            }
            $account_output .= '</ul>' . "\n";
            $account_output .= '</li>' . "\n";
            $account_output .= '</ul>' . "\n";
            $account_output .= '</nav>' . "\n";

            // RETURN
            return $account_output;

        }
    }
	
	
	/* LANGUAGE
    ================================================== */
    if ( ! function_exists( 'sf_get_language_aux' ) ) {
        function sf_get_language_aux( $aux = "" ) {

            $language_output = "";

            $language_output .= '<nav class="std-menu">' . "\n";
            $language_output .= '<ul class="menu">' . "\n";
            $language_output .= '<li class="parent language-item">' . "\n";
            
            if ( $aux == "aux-text" ) {
            	$language_output .= '<a href="#">' . __( "Language", "swiftframework" ) . '</a>' . "\n";  
            } else {
				$language_output .= '<a href="#"><i class="sf-icon-uk"></i></a>' . "\n";            
            }
            
            $language_output .= '<ul class="header-languages sub-menu">' . "\n";
            if ( function_exists( 'sf_language_flags' ) ) {
                $language_output .= sf_language_flags();
            }
            $language_output .= '</ul>' . "\n";
            $language_output .= '</li>' . "\n";
            $language_output .= '</ul>' . "\n";
            $language_output .= '</nav>' . "\n";

            // RETURN
            return $language_output;
        }
    }
    

    /* AJAX SEARCH
    ================================================== */
    if ( ! function_exists( 'sf_ajaxsearch' ) ) {
        function sf_ajaxsearch() {
            global $sf_options;
            $page_classes       = sf_page_classes();
            $header_layout      = $page_classes['header-layout'];
            $header_search_type = $sf_options['header_search_type'];
            $header_search_pt   = $sf_options['header_search_pt'];
            $remove_dates  = $sf_options['remove_dates'];
            $search_term        = trim( $_POST['s'] );
            $search_query_args  = array(
                's'                => $search_term,
                'post_type'        => $header_search_pt,
                'post_status'      => 'publish',
                'suppress_filters' => false,
                'numberposts'      => - 1
            );
            $search_query_args  = http_build_query( $search_query_args );
            $search_results     = get_posts( $search_query_args );
            $count              = count( $search_results );
            $shown_results      = 5;

            if ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) {
                $shown_results = 2;
            }

            if ( $header_search_type == "fs-search-on" ) {
                $shown_results = 20;
            }

            $search_results_ouput = "";

            if ( ! empty( $search_results ) ) {

                $sorted_posts = $post_type = array();

                foreach ( $search_results as $search_result ) {
                    $sorted_posts[ $search_result->post_type ][] = $search_result;
                    // Check we don't already have this post type in the post_type array
                    if ( empty( $post_type[ $search_result->post_type ] ) ) {
                        // Add the post type object to the post_type array
                        $post_type[ $search_result->post_type ] = get_post_type_object( $search_result->post_type );
                    }
                }

                $i = 0;
                foreach ( $sorted_posts as $key => $type ) {
                    $search_results_ouput .= '<div class="search-result-pt">';
                    if ( isset( $post_type[ $key ]->labels->name ) ) {
                        $search_results_ouput .= "<h6>" . $post_type[ $key ]->labels->name . "</h6>";
                    } else if ( isset( $key ) ) {
                        $search_results_ouput .= "<h6>" . $key . "</h6>";
                    } else {
                        $search_results_ouput .= "<h6>" . __( "Other", "swiftframework" ) . "</h6>";
                    }

                    foreach ( $type as $post ) {

                        $img_icon = "";

                        $post_format = get_post_format( $post->ID );
                        if ( $post_format == "" ) {
                            $post_format = 'standard';
                        }
                        $post_type = get_post_type( $post );
                    	$product = array();
                    
                    	if ( $post_type == "product" ) {
                    	    $product = new WC_Product( $post->ID );
                    	    if (!$product->is_visible()) {
                    	    	return;
                    	    }
                    	}

                        if ( $post_type == "post" ) {
                            if ( $post_format == "quote" || $post_format == "status" ) {
                                $img_icon = "ss-quote";
                            } else if ( $post_format == "image" ) {
                                $img_icon = "ss-picture";
                            } else if ( $post_format == "chat" ) {
                                $img_icon = "ss-chat";
                            } else if ( $post_format == "audio" ) {
                                $img_icon = "ss-music";
                            } else if ( $post_format == "video" ) {
                                $img_icon = "ss-video";
                            } else if ( $post_format == "link" ) {
                                $img_icon = "ss-link";
                            } else {
                                $img_icon = "ss-pen";
                            }
                        } else if ( $post_type == "product" ) {
                            $img_icon = "ss-cart";
                        } else if ( $post_type == "portfolio" ) {
                            $img_icon = "ss-picture";
                        } else if ( $post_type == "team" ) {
                            $img_icon = "ss-user";
                        } else if ( $post_type == "galleries" ) {
                            $img_icon = "ss-picture";
                        } else {
                            $img_icon = "ss-file";
                        }

                        $post_title     = get_the_title( $post->ID );
                        $post_date      = get_the_date();
                        $post_permalink = get_permalink( $post->ID );

                        $image = get_the_post_thumbnail( $post->ID, 'thumbnail' );

                        $search_results_ouput .= '<div class="search-result">';
                        
                        $search_results_ouput .= '<a href="'.$post_permalink.'" class="search-result-link"></a>';

                        if ( $image ) {
                            $search_results_ouput .= '<div class="search-item-img"><a href="' . $post_permalink . '">' . $image . '</div>';
                        } else {
                            $search_results_ouput .= '<div class="search-item-img"><a href="' . $post_permalink . '" class="img-holder"><i class="' . $img_icon . '"></i></a></div>';
                        }

                        $search_results_ouput .= '<div class="search-item-content">';
                        $search_results_ouput .= '<h5><a href="' . $post_permalink . '">' . $post_title . '</a></h5>';
                        if ( $post_type == "product" ) {
                            $search_results_ouput .= $product->get_price_html();
                        } else if (!$remove_dates) {
                            $search_results_ouput .= '<time>' . $post_date . '</time>';
                        }
                        $search_results_ouput .= '</div>';

                        $search_results_ouput .= '</div>';

                        $i ++;
                        if ( $i == $shown_results ) {
                            break;
                        }
                    }

                    $search_results_ouput .= '</div>';
                    if ( $i == $shown_results ) {
                        break;
                    }
                }

                if ( $count > 1 ) {
                	$search_link = get_search_link( $search_term );
                	
                	if (strpos($search_link,'?') !== false) {
                		$search_link .= '&post_type='. $header_search_pt;
                	} else {
                		$search_link .= '?post_type='. $header_search_pt;
                	}
                    $search_results_ouput .= '<a href="' . $search_link . '" class="all-results">' . sprintf( __( "View all %d results", "swiftframework" ), $count ) . '</a>';
                }

            } else {

                $search_results_ouput .= '<div class="no-search-results">';
                $search_results_ouput .= '<h6>' . __( "No results", "swiftframework" ) . '</h6>';
                $search_results_ouput .= '<p>' . __( "No search results could be found, please try another query.", "swiftframework" ) . '</p>';
                $search_results_ouput .= '</div>';

            }

            echo $search_results_ouput;
            die();
        }

        add_action( 'wp_ajax_sf_ajaxsearch', 'sf_ajaxsearch' );
        add_action( 'wp_ajax_nopriv_sf_ajaxsearch', 'sf_ajaxsearch' );
    }


    /* OVERLAY MENU
    ================================================== */
    if ( ! function_exists( 'sf_overlay_menu' ) ) {
        function sf_overlay_menu() {

			global $post;

            $overlayMenu = $page_menu = "";

            if ( $post && !is_search() ) {
                $page_menu = sf_get_post_meta( $post->ID, 'sf_page_menu', true );
            }

            $overlay_menu_args = array(
                'echo'           => false,
                'theme_location' => 'overlay_menu',
                'fallback_cb'    => '',
                'menu'			 => $page_menu
            );

            $overlayMenu .= '<div id="overlay-menu">';
            $overlayMenu .= '<nav>';
            if ( function_exists( 'wp_nav_menu' ) ) {
                $overlayMenu .= wp_nav_menu( $overlay_menu_args );
            }
            $overlayMenu .= '</nav>';
            $overlayMenu .= '</div>';


            return $overlayMenu;
        }
    }


    /* CONTACT SLIDEOUT
    ================================================== */
    if ( ! function_exists( 'sf_contact_slideout' ) ) {
        function sf_contact_slideout() {

            global $sf_options;

            $contact_slideout_page = __( $sf_options['contact_slideout_page'], 'swiftframework' );

            $contact_slideout = "";

            $contact_slideout .= '<div id="contact-slideout">';
            $contact_slideout .= '<div class="container">';
            if ( $contact_slideout_page ) {
                $page    = get_post( $contact_slideout_page );
                $content = apply_filters( 'the_content', $page->post_content );
                $contact_slideout .= $content;
            } else {
                $contact_slideout .= __( "Please select a page for the Contact Slideout in Theme Options > Header Options", "swiftframework" );
            }
            $contact_slideout .= '</div>';
            $contact_slideout .= '</div>';

            return $contact_slideout;
        }
    }


	 /* WISHLIST PRODUCT HTML
    ================================================== */
    if ( ! function_exists( 'sf_get_wishlist_product' ) ) {
        function sf_get_wishlist_product($product_id) {
        	 global $yith_wcwl;
			 $wishlist_output = "";
             $product_obj = get_product( $product_id );

             $wishlist_icon = apply_filters( 'sf_view_wishlist_icon', '<i class="ss-star"></i>' );

             if ( $product_obj !== false && $product_obj->exists() ) {

                  $wishlist_output .= '<div id="wishlist-' . $product_id . '" class="bag-product clearfix">';

                  if ( has_post_thumbnail( $product_obj->id ) ) {
                      $image_link = wp_get_attachment_url( get_post_thumbnail_id( $product_obj->id ) );
                      $image      = wp_get_attachment_image_src( get_post_thumbnail_id( $product_obj->id ), 'thumbnail' );

                      if ( $image ) {
                          $wishlist_output .= '<figure><a class="bag-product-img" href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $product_obj->id  ) ) ) . '"><img itemprop="image" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" /></a></figure>';
                                }
                            }

                            $wishlist_output .= '<div class="bag-product-details">';
                            $wishlist_output .= '<div class="bag-product-title"><a href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $product_obj->id ) ) ) . '">' . apply_filters( 'woocommerce_in_cartproduct_obj_title', $product_obj->get_title(), $product_obj ) . '</a></div>';

                            if ( get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' ) {
                                $wishlist_output .= '<div class="bag-product-price">' . apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price_excluding_tax() ), '' ) . '</div>';
                            } else {
                                $wishlist_output .= '<div class="bag-product-price">' . apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price() ), '' ) . '</div>';
                            }
                            $wishlist_output .= '</div>';
                            $wishlist_output .= '</div>';

                        }

			return $wishlist_output;


			}

	}


	 /* WISHLIST UPDATE
    ================================================== */
    if ( ! function_exists( 'sf_add_to_wishlist' ) ) {
        function sf_add_to_wishlist() {

        	if ( ! empty( $_REQUEST['product_id'] ) ) {
                $product_id = $_REQUEST['product_id'];
            }

            $wishlist_itens = array();
           	$wishlist_itens['wishlist_output'] = sf_get_wishlist_product($product_id);

            echo json_encode( $wishlist_itens );
            die();

		}
		add_action( 'wp_ajax_sf_add_to_wishlist', 'sf_add_to_wishlist' );
	    add_action( 'wp_ajax_nopriv_sf_add_to_wishlist', 'sf_add_to_wishlist' );
	}


	/* GLOBAL HEADER BANNER
    ================================================== */
    if ( ! function_exists( 'sf_header_banner_bar' ) ) {
        function sf_header_banner_bar() {
            global $sf_options, $post;
			$enable_global_banner = false;

			if ( isset($sf_options['enable_global_banner']) ) {
            	$enable_global_banner  = $sf_options['enable_global_banner'];
            }

            if ( $enable_global_banner ) {
            	$gb_layout 			= $sf_options['global_banner_layout'];
            	$fullwidth_header   = $sf_options['fullwidth_header'];

                ?>
                <!--// OPEN #sf-header-banner //-->
                <?php if ( $fullwidth_header ) { ?>
	            <div id="sf-header-banner" class="banner-fw-header clearfix">
                <?php } else { ?>
                <div id="sf-header-banner" class="clearfix">
				<?php } ?>

                	<div class="container">

                		<div id="sf-banner-widgets" class="row clearfix">
                            <?php if ( $gb_layout == "gb-1" ) { ?>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-4' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-2" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-3" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-4" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-5" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-6" ) { ?>

                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-7" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-8" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else { ?>

                                <div class="col-sm-12">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>

                                </div>
                            <?php } ?>

                		</div>

                	</div>

                    <!--// CLOSE #sf-header-banner //-->
                </div>
            <?php
            }

        }

        add_action( 'sf_container_start', 'sf_header_banner_bar', 30 );
    }

?>
