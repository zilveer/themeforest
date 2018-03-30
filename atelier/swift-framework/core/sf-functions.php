<?php

    /*
    *
    *	Swift Framework Functions
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_output_container_open()
    *	sf_output_container_close()
    *	sf_output_container_row_open()
    *	sf_output_container_row_close()
    *	sf_get_post_meta()
    *	sf_get_option()
    *	sf_theme_supports()
    *	sf_global_include_classes()
    *	sf_content_filter()
    *	sf_layerslider_overrides()
    *	sf_widget_area_filter()
	*	sf_get_gshare_count()
    *	sf_get_tweets()
    *	sf_hyperlinks()
    *	sf_twitter_users()
    *	sf_encode_tweet()
    *	sf_latest_tweet()
    *	sf_posts_custom_columns()
    *	sf_list_galleries()
    *	sf_portfolio_related_posts()
    *	sf_has_previous_posts()
    *	sf_has_next_posts()
    *	sf_bwm_filter()
    *	sf_bwm_filter_script()
    *	sf_filter_wp_title()
    *	sf_maintenance_mode()
    *	sf_custom_login_logo()
    *	sf_language_flags()
    *	sf_hex2rgb()
    *	sf_get_comments_number()
    *	sf_get_menus_list()
    *	sf_get_category_list()
    *	sf_get_category_list_key_array()
    *	sf_get_woo_product_filters_array()
    *	sf_add_nofollow_cat()
    *	sf_remove_head_links()
    *	sf_current_page_url()
    *	sf_woocommerce_activated()
    *	sf_wpml_activated()
    *	sf_gravityforms_activated()
    *	sf_gopricing_activated()
    *	sf_gravityforms_list()
    *	sf_gopricing_list()
    *	sf_global_include_classes()
    *	sf_admin_css()
    *   sf_woo_list_parent_categories()
	*   sf_get_woo_product_parent_category_array()
    */

    /* LAYOUT OUTPUT
    ================================================== */
    function sf_output_container_open() {
        echo apply_filters( 'sf_container_open', '<div class="container">' );
    }

    function sf_output_container_close() {
        echo apply_filters( 'sf_container_close', '</div><!-- CLOSE .container -->' );
    }

    function sf_output_container_row_open() {
        echo apply_filters( 'sf_container_row_open', '<div class="container"><div class="row">' );
    }

    function sf_output_container_row_close() {
        echo apply_filters( 'sf_container_row_close', '</div></div><!-- CLOSE .container -->' );
    }


    /* PERFORMANCE FRIENDLY GET META FUNCTION
    ================================================== */
    if ( !function_exists( 'sf_get_post_meta' ) ) {
	    function sf_get_post_meta( $id, $key = "", $single = false ) {

	        $GLOBALS['sf_post_meta'] = isset( $GLOBALS['sf_post_meta'] ) ? $GLOBALS['sf_post_meta'] : array();
	        if ( ! isset( $id ) ) {
	            return;
	        }
	        if ( ! is_array( $id ) ) {
	            if ( ! isset( $GLOBALS['sf_post_meta'][ $id ] ) ) {
	                //$GLOBALS['sf_post_meta'][ $id ] = array();
	                $GLOBALS['sf_post_meta'][ $id ] = get_post_meta( $id );
	            }
	            if ( ! empty( $key ) && isset( $GLOBALS['sf_post_meta'][ $id ][ $key ] ) && ! empty( $GLOBALS['sf_post_meta'][ $id ][ $key ] ) ) {
	                if ( $single ) {
	                    return maybe_unserialize( $GLOBALS['sf_post_meta'][ $id ][ $key ][0] );
	                } else {
	                    return array_map( 'maybe_unserialize', $GLOBALS['sf_post_meta'][ $id ][ $key ] );
	                }
	            }

	            if ( $single ) {
	                return '';
	            } else {
	                return array();
	            }

	        }

	        return get_post_meta( $id, $key, $single );
	    }
    }


    /* PERFORMANCE FRIENDLY GET OPTION FUNCTION
    ================================================== */
    if ( !function_exists( 'sf_get_option' ) ) {
	    function sf_get_option( $key, $default = "" ) {
	        // Original calls
	        //return get_option($key, $default);

	        // Optimised calls
	        if ( isset( $GLOBALS['sf_customizer'][ $key ] ) ) {
	            return $GLOBALS['sf_customizer'][ $key ];
	        } else if ( isset( $default ) ) {
	            return $default;
	        }

	        return '';
	    }
    }


    /* CHECK THEME FEATURE SUPPORT
    ================================================== */
    if ( !function_exists( 'sf_theme_supports' ) ) {
        function sf_theme_supports( $feature ) {
        	$supports = get_theme_support( 'swiftframework' );
        	$supports = $supports[0];
    		if ($supports[ $feature ] == "") {
    			return false;
    		} else {
        		return isset( $supports[ $feature ] );
        	}
        }
    }


    /* EDITOR STYLES
    ================================================== */
    if ( ! function_exists( 'sf_custom_mce_styles' ) ) {
        function sf_custom_mce_styles( $args ) {

            $style_formats = array(
                array( 'title' => 'Impact Text', 'selector' => 'p', 'classes' => 'impact-text' ),
                array( 'title' => 'Impact Text Large', 'selector' => 'p', 'classes' => 'impact-text-large' )
            );

            $args['style_formats'] = json_encode( $style_formats );

            return $args;
        }

        add_filter( 'tiny_mce_before_init', 'sf_custom_mce_styles' );
    }

    if ( ! function_exists( 'sf_mce_add_buttons' ) ) {
        function sf_mce_add_buttons( $buttons ) {
            array_splice( $buttons, 1, 0, 'styleselect' );

            return $buttons;
        }

        add_filter( 'mce_buttons_2', 'sf_mce_add_buttons' );
    }

    function sf_add_editor_styles() {
        add_editor_style( '/css/editor-style.css' );
    }
    add_action( 'init', 'sf_add_editor_styles' );



    /* SHORTCODE GENERATOR SETUP
    ================================================== */
    // Create TinyMCE's editor button & plugin for Swift Framework Shortcodes
    add_action( 'init', 'sf_sc_button' );

    function sf_sc_button() {
        if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
            add_filter( 'mce_external_plugins', 'sf_add_tinymce_plugin' );
            add_filter( 'mce_buttons', 'sf_register_shortcode_button' );
        }
    }

    function sf_register_shortcode_button( $button ) {
        array_push( $button, 'separator', 'swiftframework_shortcodes' );

        return $button;
    }

    function sf_add_tinymce_plugin( $plugins ) {
        $plugins['swiftframework_shortcodes'] = get_template_directory_uri() . '/swift-framework/shortcodes/tinymce.editor.plugin.js';

        return $plugins;
    }


    /* LANGUAGE SPECIFIC POST ID
    ================================================== */
    function sf_post_id( $id, $type = 'post' ) {
        if ( function_exists( 'icl_object_id' ) ) {
            return icl_object_id( $id, $type, true );
        } else {
            return $id;
        }
    }


    /* DYNAMIC GLOBAL INCLUDE CLASSES
    ================================================== */
    function sf_global_include_classes() {

        // INCLUDED FUNCTIONALITY SETUP
        global $post, $sf_has_portfolio, $sf_has_blog, $sf_has_products, $sf_include_maps, $sf_include_isotope, $sf_include_carousel, $sf_include_parallax, $sf_include_infscroll, $sf_has_progress_bar, $sf_has_chart, $sf_has_countdown, $sf_has_imagebanner, $sf_has_team, $sf_has_portfolio_showcase, $sf_has_gallery, $sf_has_galleries, $sf_include_ml_parallax;

        $sf_inc_class = "";

        if ( $sf_has_portfolio ) {
            $sf_inc_class .= "has-portfolio ";
        }
        if ( $sf_has_blog ) {
            $sf_inc_class .= "has-blog ";
        }
        if ( $sf_has_products ) {
            $sf_inc_class .= "has-products ";
        }

        if ( $post ) {
            $content = $post->post_content;
            if ( function_exists( 'has_shortcode' ) && $content != "" ) {
                if ( has_shortcode( $content, 'related_products' ) ||
                	 has_shortcode( $content, 'best_selling_products' ) ||
                	 has_shortcode( $content, 'top_rated_products' ) ||
                	 has_shortcode( $content, 'sale_products' ) ||
                	 has_shortcode( $content, 'recent_products' ) ||
                	 has_shortcode( $content, 'product_attribute' ) ||
                	 has_shortcode( $content, 'product_category' ) ||
                	 has_shortcode( $content, 'featured_products' ) ||
                	 has_shortcode( $content, 'products' ) ||
                	 has_shortcode( $content, 'product_page' ) ||
                	 is_active_widget( false, false, 'woocommerce_top_rated_products', true ) ||
                	 is_active_widget( false, false, 'woocommerce_recently_viewed_products', true ) ||
                	 is_active_widget( false, false, 'woocommerce_recent_reviews', true ) ||
                	 is_active_widget( false, false, 'woocommerce_products', true ) ||
                	 is_active_widget( false, false, 'woocommerce_product_categories', true ) ||
                	 is_active_widget( false, false, 'woocommerce_widget_cart', true )
                	) {
                    $sf_inc_class .= "has-products ";
                    $sf_include_isotope = true;
                }
            }
        }

        if ( $sf_include_maps ) {
            $sf_inc_class .= "has-map ";
        }
        if ( $sf_include_carousel ) {
            $sf_inc_class .= "has-carousel ";
        }
        if ( $sf_include_parallax ) {
            $sf_inc_class .= "has-parallax ";
        }
        if ( $sf_include_ml_parallax ) {
            $sf_inc_class .= "has-ml-parallax ";
        }
        if ( $sf_has_progress_bar ) {
            $sf_inc_class .= "has-progress-bar ";
        }
        if ( $sf_has_chart ) {
            $sf_inc_class .= "has-chart ";
        }
        if ( $sf_has_countdown ) {
            $sf_inc_class .= "has-countdown ";
        }
        if ( $sf_has_imagebanner ) {
            $sf_inc_class .= "has-imagebanner ";
        }
        if ( $sf_has_team ) {
            $sf_inc_class .= "has-team ";
        }
        if ( $sf_has_portfolio_showcase ) {
            $sf_inc_class .= "has-portfolio-showcase ";
        }
        if ( $sf_has_gallery ) {
            $sf_inc_class .= "has-gallery ";
        }
        if ( $sf_has_galleries ) {
            $sf_inc_class .= "has-galleries ";
        }
        if ( $sf_include_infscroll ) {
            $sf_inc_class .= "has-infscroll ";
        }

        global $sf_options;

        $enable_product_zoom = $sf_options['enable_product_zoom'];
        if ( $enable_product_zoom || isset($_GET['product_zoom']) ) {
            $sf_inc_class .= "has-productzoom ";
        }

		if (isset($sf_options['enable_stickysidebars'])) {
			$enable_stickysidebars = $sf_options['enable_stickysidebars'];
			if ($enable_stickysidebars) {
				$sf_inc_class .= "stickysidebars ";
			}
		}

        if ( isset( $sf_options['disable_megamenu'] ) ) {
            $disable_megamenu = $sf_options['disable_megamenu'];
            if ( $disable_megamenu ) {
                $sf_inc_class .= "disable-megamenu ";
            }
        }

        return $sf_inc_class;
    }


	/* CONTENT CHECK FOR SCRIPT REQUIREMENT
    ================================================== */
    if ( ! function_exists( 'sf_savepost_content_script_check' ) ) {
        function sf_savepost_content_script_check( $post_id ) {

			 // Make sure meta is added to the post, not a revision
            if ( $the_post = wp_is_post_revision( $post_id ) ) {
                $post_id = $the_post;
            }

			$post = get_post($post_id);

	        if ( $post ) {

	            $content = $post->post_content;

	            $page_slider = sf_get_post_meta( $post->ID, 'sf_page_slider', true );

	            if ( function_exists( 'has_shortcode' ) ) {

		            // Google Maps Script
	                if ( has_shortcode( $content , 'spb_gmaps' ) || has_shortcode( $content , 'spb_directory' ) || has_shortcode( $content, 'spb_directory_user_listings' ) ) {
						update_post_meta( $post_id , 'sf_page_has_map' , 1 );
	                } else {
		                delete_post_meta( $post_id , 'sf_page_has_map' );
	                }

	                // Go Pricing
	                if ( has_shortcode( $content , 'spb_gopricing' ) || has_shortcode( $content , 'go_pricing' ) ) {
						update_post_meta( $post_id , 'sf_page_has_gopricing' , 1 );
	                } else {
		                delete_post_meta( $post_id , 'sf_page_has_gopricing' );
	                }

	                // Products
	                if ( has_shortcode( $content, 'related_products' ) || has_shortcode( $content, 'best_selling_products' ) || has_shortcode( $content, 'top_rated_products' ) || has_shortcode( $content, 'sale_products' ) || has_shortcode( $content, 'recent_products' ) || has_shortcode( $content, 'product_attribute' ) || has_shortcode( $content, 'product_category' ) || has_shortcode( $content, 'featured_products' ) || has_shortcode( $content, 'products' ) || has_shortcode( $content , 'spb_products' ) || has_shortcode( $content , 'spb_products_mini' ) || has_shortcode( $content , 'sf_addtocart_button' ) ) {
						update_post_meta( $post_id , 'sf_page_has_products' , 1 );
	                } else {
		                delete_post_meta( $post_id , 'sf_page_has_products' );
	                }

					// Swift Slider
					if ( $page_slider == "swift-slider" || has_shortcode( $content, 'swift_slider' ) || has_shortcode( $content, 'spb_swift_slider' ) ) {
						update_post_meta( $post_id , 'sf_page_has_swiftslider' , 1 );
	                } else {
		                delete_post_meta( $post_id , 'sf_page_has_swiftslider' );
	                }

					// Revolution Slider
					if ( $page_slider == "revslider" || has_shortcode( $content, 'rev_slider' ) || has_shortcode( $content, 'spb_slider' ) ) {
						update_post_meta( $post_id , 'sf_page_has_revslider' , 1 );
	                } else {
		                delete_post_meta( $post_id , 'sf_page_has_revslider' );
	                }
	            }
	        }

	    }
		add_action( 'save_post', 'sf_savepost_content_script_check' );
	}


	/* REMOVE PLUGIN SCRIPT IF NOT NEEDED
    ================================================== */
    if ( ! function_exists( 'sf_remove_plugin_scripts' ) ) {
        function sf_remove_plugin_scripts() {

	        global $sf_options;

	        if ( !sf_theme_supports('swift-smartscript') || is_admin() ) {
		        return;
	        }

	        $enable_swift_smartscript = $sf_options['enable_swift_smartscript'];

	        if ( !$enable_swift_smartscript ) {
		        return;
	        }

			global $post;
			$page_has_swiftslider = $page_has_gopricing = false;
			$woo_shop_slider = $sf_options['woo_shop_slider'];
			
			$page_slider = "";

			if ( $post ) {
				$page_has_swiftslider 	= sf_get_post_meta( $post->ID, 'sf_page_has_swiftslider', true );
				$page_slider = sf_get_post_meta( $post->ID, 'sf_page_slider', true );

				$page_has_gopricing     = sf_get_post_meta( $post->ID, 'sf_page_has_gopricing', true );
			}

			// Swift Slider
			if ( function_exists( 'is_shop' ) && is_shop() && $woo_shop_slider == "swift-slider") {
				$page_has_swiftslider = true;
			}
			if ( function_exists( 'is_product_category' ) && is_product_category() && $woo_shop_slider == "swift-slider") {
				$page_has_swiftslider = true;
			}
			if ( is_singular('swift-slider') ) {
				$page_has_swiftslider = true;
			}
			
			if ( !$page_has_swiftslider && $page_slider != "swift-slider" ) {
				wp_dequeue_style( 'swift-slider' );
				wp_dequeue_style( 'swift-slider-min' );
				wp_dequeue_script( 'swift-slider' );
				wp_dequeue_script( 'swift-slider-min' );
			}

			// GoPricing
			if ( sf_gopricing_activated() && !$page_has_gopricing ) {
				wp_dequeue_style( 'go_pricing_styles' );
				wp_dequeue_style( 'go_pricing_jqplugin-mediaelementjs' );
				wp_dequeue_style( 'go_pricing_jqplugin-mediaelementjs-skin' );
				wp_dequeue_script( 'go_pricing_scripts' );
				wp_dequeue_script( 'go_pricing_jqplugin-mediaelementjs' );
			}


	    }
		add_action( 'wp_enqueue_scripts', 'sf_remove_plugin_scripts', 99 );
	}


    /* SHORTCODE FIX
    ================================================== */
    if ( ! function_exists( 'sf_content_filter' ) ) {
        function sf_content_filter( $content ) {
            // array of custom shortcodes requiring the fix
            $block = join( "|", array(
                    "alert",
                    "sf_button",
                    "icon",
                    "sf_iconbox",
                    "sf_imagebanner",
                    "social",
                    "sf_social_share",
                    "highlight",
                    "decorative_ampersand",
                    "blockquote1",
                    "blockquote2",
                    "blockquote3",
                    "pullquote",
                    "one_half",
                    "one_half_last",
                    "one_third",
                    "one_third_last",
                    "two_third",
                    "two_third_last",
                    "one_fourth",
                    "one_fourth_last",
                    "three_fourth",
                    "three_fourth_last",
                    "one_half",
                    "one_half_last",
                    "progress_bar",
                    "chart",
                    "sf_count",
                    "sf_countdown",
                    "sf_tooltip",
                    "sf_modal",
                    "sf_fullscreenvideo",
                    "sf_visibility",
                    "table",
                    "trow",
                    "thcol",
                    "tcol",
                    "list",
                    "list_item",
                    "hr",
                    "accordion",
                    "panel",
                    "tabs",
                    "tab",
                    "sf_supersearch",
                    "gallery",
                    "spb_accordion",
                    "spb_accordion_tab",
                    "spb_blog",
                    "spb_boxed_content",
                    "spb_clients",
                    "spb_codesnippet",
                    "spb_divider",
                    "spb_faqs",
                    "spb_gallery",
                    "spb_googlechart",
                    "spb_gmaps",
                    "spb_latest_tweets",
                    "spb_message",
                    "spb_parallax",
                    "spb_portfolio",
                    "spb_portfolio_carousel",
                    "spb_portfolio_showcase",
                    "spb_posts_carousel",
                    "spb_products",
                    "spb_products_mini",
                    "spb_recent_posts",
                    "spb_slider",
                    "spb_sitemap",
                    "spb_search",
                    "spb_supersearch",
                    "spb_tabs",
                    "spb_tab",
                    "spb_text_block",
                    "spb_team",
                    "spb_testimonial",
                    "spb_testimonial_carousel",
                    "spb_testimonial_slider",
                    "spb_toggle",
                    "spb_tour",
                    "spb_tweets_slider",
                    "spb_video",
                    "spb_blank_spacer",
                    "spb_image",
                    "spb_blog_grid",
                    "spb_promo_bar",
                    "spb_gravityforms",
                    "spb_campaigns",
                    "spb_column",
                    "spb_row",
                    "spb_icon_box",
                    "spb_multilayer_parallax",
                    "spb_multilayer_parallax_layer",
                    "spb_image_banner",
                    "spb_icon_box_grid",
                    "spb_icon_box_grid_element",
                    "spb_section"
                ) );
            // opening tag
            $rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
            // closing tag
            $rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );

            return $rep;
        }

        add_filter( "the_content", "sf_content_filter" );
    }


    /* LAYERSLIDER OVERRIDES
    ================================================== */
    function sf_layerslider_overrides() {
        // Disable auto-updates
        $GLOBALS['lsAutoUpdateBox'] = false;
    }

    add_action( 'layerslider_ready', 'sf_layerslider_overrides' );


    /* FEATURED IMAGE IN RSS FEED
    ================================================== */
    if ( ! function_exists( 'sf_featured_image_rss' ) ) {
        function sf_featured_image_rss( $content ) {
            global $post;
            if ( is_feed() ) {
                if ( has_post_thumbnail( $post->ID ) ) {
                    $output  = get_the_post_thumbnail( $post->ID, 'large', array( 'style' => 'float:right; margin:0 0 10px 10px;' ) );
                    $content = $output . $content;
                }
            }

            return $content;
        }

        add_filter( 'the_content', 'sf_featured_image_rss' );
    }


    /* FEED CONTENT WHEN PB ACTIVE
    ================================================== */
    if ( ! function_exists( 'sf_custom_feed_content' ) ) {
	    function sf_custom_feed_content( $content ) {
	    	global $post;
	    	$pb_status = get_post_meta($post->ID, '_spb_js_status', true);

	    	if ($pb_status == "true") {
	    		$custom_excerpt = get_post_meta( $post->ID, 'sf_custom_excerpt', true );
	    		return $custom_excerpt;
	    	} else {
	        	return $content;
	        }
	    }
	    add_filter( 'the_content_feed', 'sf_custom_feed_content' );
	    add_filter( 'the_excerpt_rss', 'sf_custom_feed_content' );
    }


    /* ATTACHMENT PAGE IMAGE SIZE
    ================================================== */
    if ( ! function_exists( 'sf_alter_attachment_image' ) ) {
        function sf_alter_attachment_image( $p ) {
            return '<p>' . wp_get_attachment_link( 0, 'full', false ) . '</p>';
        }

        add_filter( 'prepend_attachment', 'sf_alter_attachment_image' );
    }


    /* WIDGET AREA FILTER
    ================================================== */
    if ( ! function_exists( 'sf_widget_area_filter' ) ) {
        function sf_widget_area_filter( $options ) {
            $options = array(
                'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                'after_widget'  => '</section>',
                'before_title'  => '<div class="widget-heading clearfix"><h4 class="spb-heading"><span>',
                'after_title'   => '</span></h4></div>',
            );

            return $options;
        }

        add_filter( 'redux_custom_widget_args', 'sf_widget_area_filter' );
    }
    
    /* GET GSHARE COUNT
    ================================================== */
    if ( ! function_exists( 'sf_get_gshare_count' ) ) {
		function sf_get_gshare_count( $url = "" ) {
			if ( function_exists( 'file_get_contents' ) && $url != '' ) {
				
				if ( !filter_var($url, FILTER_VALIDATE_URL) ) {
					return 0;
				}
				
				$url = sprintf('https://plusone.google.com/u/0/_/+1/fastbutton?url=%s', urlencode($url));
				$contents = file_get_contents($url);
				preg_match_all('/{c: (.*?),/', file_get_contents($url), $match, PREG_SET_ORDER);
				return (1 === sizeof($match) && 2 === sizeof($match[0])) ? intval($match[0][1]) : 0;
			} else {
				return 0;
			}
		}
	}
	

    /* TWEET FUNCTIONS
    ================================================== */
    if ( ! function_exists( 'sf_get_tweets' ) ) {
        function sf_get_tweets( $twitterID, $count, $type = "", $item_class = "col-sm-4" ) {

            global $sf_options;
            $enable_twitter_rts = false;
            if ( isset( $sf_options['enable_twitter_rts'] ) ) {
                $enable_twitter_rts = $sf_options['enable_twitter_rts'];
            }

            $content         = "";
            $blog_grid_count = 0;

            if ( function_exists( 'getTweets' ) ) {

                $options = array(
                    'trim_user'       => true,
                    'exclude_replies' => false,
                    'include_rts'     => $enable_twitter_rts
                );

                $tweets = getTweets( $twitterID, $count, $options );

                if ( is_array( $tweets ) ) {

                    if ( isset( $tweets["error"] ) && $tweets["error"] != "" ) {

                        return '<li>' . $tweets["error"] . '</li>';

                    } else {

                        foreach ( $tweets as $tweet ) {

                            if ( $type == "blog-grid" ) {

                                $content .= '<li class="blog-item ' . $item_class . '" data-date="' . strtotime( $tweet['created_at'] ) . '" data-sortid="' . $blog_grid_count . '">';
                                $content .= '<a class="grid-link" href="https://twitter.com/' . $twitterID . '/status/' . $tweet['id_str'] . '" target="_blank"></a>';
                                $content .= '<div class="grid-no-image">';
                                $content .= '<h6>' . __( "Twitter", "swiftframework" ) . '</h6>';

                                $blog_grid_count = $blog_grid_count + 2;

                            } else if ( $type == "blog" ) {

                                $content .= '<li class="blog-item ' . $item_class . '" data-date="' . strtotime( $tweet['created_at'] ) . '">';
                                $content .= '<a class="grid-link" href="https://twitter.com/' . $twitterID . '/status/' . $tweet['id_str'] . '" target="_blank"></a>';
                                $content .= '<div class="details-wrap">';
                                $content .= '<h6>' . __( "Twitter", "swiftframework" ) . '</h6>';

                            } else if ( $type == "blog-fw" ) {

                                $content .= '<li class="blog-item ' . $item_class . '" data-date="' . strtotime( $tweet['created_at'] ) . '">';
                                $content .= '<a class="grid-link" href="https://twitter.com/' . $twitterID . '/status/' . $tweet['id_str'] . '" target="_blank"></a>';
                                $content .= '<div class="details-wrap">';
                                $content .= '<h6>' . __( "Twitter", "swiftframework" ) . '</h6>';

                            } else {

                                $content .= '<li>';

                            }

                            if ( isset( $tweet['text'] ) && $tweet['text'] ) {

                                if ( $type == "blog" || $type == "blog-grid" || $type == "blog-fw" ) {
                                    $content .= '<h2 class="tweet-text">';
                                } else {
                                    $content .= '<div class="tweet-text slide-content-wrap">';
                                }

                                $the_tweet = apply_filters( 'sf_tweet_text', $tweet['text'] );

                                /*
                                Twitter Developer Display Requirements
                                https://dev.twitter.com/terms/display-requirements

                                2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
                                  i. User_mentions must link to the mentioned user's profile.
                                 ii. Hashtags must link to a twitter.com search with the hashtag as the query.
                                iii. Links in Tweet text must be displayed using the display_url
                                     field in the URL entities API response, and link to the original t.co url field.
                                */

                                // i. User_mentions must link to the mentioned user's profile.
                                if ( isset( $tweet['entities']['user_mentions'] ) && is_array( $tweet['entities']['user_mentions'] ) ) {
                                    foreach ( $tweet['entities']['user_mentions'] as $key => $user_mention ) {
                                        $the_tweet = preg_replace(
                                            '/@' . $user_mention['screen_name'] . '/i',
                                            '<a href="http://www.twitter.com/' . $user_mention['screen_name'] . '" target="_blank">@' . $user_mention['screen_name'] . '</a>',
                                            $the_tweet );
                                    }
                                }

                                // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
                                if ( isset( $tweet['entities']['hashtags'] ) && is_array( $tweet['entities']['hashtags'] ) ) {
                                    foreach ( $tweet['entities']['hashtags'] as $key => $hashtag ) {
                                        $the_tweet = preg_replace(
                                            '/#' . $hashtag['text'] . '/i',
                                            '<a href="https://twitter.com/search?q=%23' . $hashtag['text'] . '&amp;src=hash" target="_blank">#' . $hashtag['text'] . '</a>',
                                            $the_tweet );
                                    }
                                }

                                // iii. Links in Tweet text must be displayed using the display_url
                                //      field in the URL entities API response, and link to the original t.co url field.
                                if ( isset( $tweet['entities']['urls'] ) && is_array( $tweet['entities']['urls'] ) ) {
                                    foreach ( $tweet['entities']['urls'] as $key => $link ) {

                                        $link_url = "";

                                        if ( isset( $link['expanded_url'] ) ) {
                                            $link_url = $link['expanded_url'];
                                        } else {
                                            $link_url = $link['url'];
                                        }

                                        $the_tweet = preg_replace(
                                            '`' . $link['url'] . '`',
                                            '<a href="' . $link_url . '" target="_blank">' . $link_url . '</a>',
                                            $the_tweet );
                                    }
                                }

                                // Custom code to link to media
                                if ( isset( $tweet['entities']['media'] ) && is_array( $tweet['entities']['media'] ) ) {
                                    foreach ( $tweet['entities']['media'] as $key => $media ) {

                                        $the_tweet = preg_replace(
                                            '`' . $media['url'] . '`',
                                            '<a href="' . $media['url'] . '" target="_blank">' . $media['url'] . '</a>',
                                            $the_tweet );
                                    }
                                }

                                $content .= $the_tweet;

                                if ( $type == "blog" || $type == "blog-grid" || $type == "blog-fw" ) {
                                    $content .= '</h2>';
                                } else {
                                    $content .= '</div>';
                                }

                                // 3. Tweet Actions
                                //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
                                //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
                                // 4. Tweet Timestamp
                                //    The Tweet timestamp must always be visible and include the time and date. e.g., "3:00 PM - 31 May 12".
                                // 5. Tweet Permalink
                                //    The Tweet timestamp must always be linked to the Tweet permalink.

                                $content .= '<div class="twitter_intents">' . "\n";
                                $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to=' . $tweet['id_str'] . '"><i class="fa-reply"></i></a>' . "\n";
                                $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id=' . $tweet['id_str'] . '"><i class="fa-retweet"></i></a>' . "\n";
                                $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id=' . $tweet['id_str'] . '"><i class="fa-star"></i></a>' . "\n";

                                $date     = strtotime( $tweet['created_at'] ); // retrives the tweets date and time in Unix Epoch terms
                                $blogtime = current_time( 'U' ); // retrives the current browser client date and time in Unix Epoch terms
                                $dago     = human_time_diff( $date, $blogtime ) . ' ' . sprintf( __( 'ago', 'swiftframework' ) ); // calculates and outputs the time past in human readable format
                                $content .= '<a class="timestamp" href="https://twitter.com/' . $twitterID . '/status/' . $tweet['id_str'] . '" target="_blank">' . $dago . '</a>' . "\n";
                                $content .= '<a class="twitter-id" href="http://twitter.com/' . $twitterID . '" target="_blank">@' . $twitterID . '</a>';
                                $content .= '</div>' . "\n";
                            } else {
                                $content .= '<a href="http://twitter.com/' . $twitterID . '" target="_blank">@' . $twitterID . '</a>';
                            }

                            if ( $type == "blog" || $type == "blog-grid" || $type == "blog-fw" ) {
                                $content .= '<data class="date" data-date="' . $date . '" value="' . $date . '">' . $dago . '</data>';
                                $content .= '<div class="author"><span>@' . $twitterID . '</span></div>';
                                $content .= '<div class="tweet-icon"><i class="fa-twitter"></i></div>' . "\n";
                                $content .= '</div>';
                            }

                            $content .= '</li>';
                        }
                    }

                    return $content;

                }
            } else {
                return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
            }

        }
    }

    function sf_hyperlinks( $text ) {
        $text = preg_replace( '/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i', "<a href=\"$1\" class=\"twitter-link\">$1</a>", $text );
        $text = preg_replace( '/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i', "<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text );
        // match name@address
        $text = preg_replace( "/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i", "<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text );
        //mach #trendingtopics. Props to Michael Voigt
        $text = preg_replace( '/([\.|\,|\:|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text );

        return $text;
    }

    function sf_twitter_users( $text ) {
        $text = preg_replace( '/([\.|\,|\:|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text );

        return $text;
    }

    function sf_encode_tweet( $text ) {
        $text = mb_convert_encoding( $text, "HTML-ENTITIES", "UTF-8" );

        return $text;
    }


    /* LATEST TWEET FUNCTION
    ================================================== */
    if ( ! function_exists( 'sf_latest_tweet' ) ) {
        function sf_latest_tweet( $count, $twitterID ) {

            global $sf_options;
            $enable_twitter_rts = false;
            if ( isset( $sf_options['enable_twitter_rts'] ) ) {
                $enable_twitter_rts = $sf_options['enable_twitter_rts'];
            }

            $content = "";

            if ( $twitterID == "" ) {
                return __( "Please provide your Twitter username", "swiftframework" );
            }

            if ( function_exists( 'getTweets' ) ) {

                $options = array(
                    'trim_user'       => true,
                    'exclude_replies' => false,
                    'include_rts'     => $enable_twitter_rts
                );

                $tweets = getTweets( $twitterID, $count, $options );

                if ( is_array( $tweets ) ) {

                    foreach ( $tweets as $tweet ) {

                        $content .= '<li>';

                        if ( is_array( $tweet ) && $tweet['text'] ) {

                            $content .= '<div class="tweet-text">';

                            $the_tweet = apply_filters( 'sf_tweet_text', $tweet['text'] );

                            /*
                            Twitter Developer Display Requirements
                            https://dev.twitter.com/terms/display-requirements

                            2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
                              i. User_mentions must link to the mentioned user's profile.
                             ii. Hashtags must link to a twitter.com search with the hashtag as the query.
                            iii. Links in Tweet text must be displayed using the display_url
                                 field in the URL entities API response, and link to the original t.co url field.
                            */

                            // i. User_mentions must link to the mentioned user's profile.
                            if ( is_array( $tweet['entities']['user_mentions'] ) ) {
                                foreach ( $tweet['entities']['user_mentions'] as $key => $user_mention ) {
                                    $the_tweet = preg_replace(
                                        '/@' . $user_mention['screen_name'] . '/i',
                                        '<a href="http://www.twitter.com/' . $user_mention['screen_name'] . '" target="_blank">@' . $user_mention['screen_name'] . '</a>',
                                        $the_tweet );
                                }
                            }

                            // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
                            if ( is_array( $tweet['entities']['hashtags'] ) ) {
                                foreach ( $tweet['entities']['hashtags'] as $key => $hashtag ) {
                                    $the_tweet = preg_replace(
                                        '/#' . $hashtag['text'] . '/i',
                                        '<a href="https://twitter.com/search?q=%23' . $hashtag['text'] . '&amp;src=hash" target="_blank">#' . $hashtag['text'] . '</a>',
                                        $the_tweet );
                                }
                            }

                            // iii. Links in Tweet text must be displayed using the display_url
                            //      field in the URL entities API response, and link to the original t.co url field.
                            if ( is_array( $tweet['entities']['urls'] ) ) {
                                foreach ( $tweet['entities']['urls'] as $key => $link ) {

                                    $link_url = "";

                                    if ( isset( $link['expanded_url'] ) ) {
                                        $link_url = $link['expanded_url'];
                                    } else {
                                        $link_url = $link['url'];
                                    }

                                    $the_tweet = preg_replace(
                                        '`' . $link['url'] . '`',
                                        '<a href="' . $link_url . '" target="_blank">' . $link_url . '</a>',
                                        $the_tweet );
                                }
                            }

                            // Custom code to link to media
                            if ( isset( $tweet['entities']['media'] ) && is_array( $tweet['entities']['media'] ) ) {
                                foreach ( $tweet['entities']['media'] as $key => $media ) {
                                    $the_tweet = preg_replace(
                                        '`' . $media['url'] . '`',
                                        '<a href="' . $media['url'] . '" target="_blank">' . $media['url'] . '</a>',
                                        $the_tweet );
                                }
                            }

                            $content .= $the_tweet;

                            $content .= '</div>';

                            // 3. Tweet Actions
                            //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
                            //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
                            // 4. Tweet Timestamp
                            //    The Tweet timestamp must always be visible and include the time and date. e.g., "3:00 PM - 31 May 12".
                            // 5. Tweet Permalink
                            //    The Tweet timestamp must always be linked to the Tweet permalink.

                            $content .= '<div class="twitter_intents">' . "\n";
                            $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to=' . $tweet['id_str'] . '"><i class="fa-reply"></i></a>' . "\n";
                            $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id=' . $tweet['id_str'] . '"><i class="fa-retweet"></i></a>' . "\n";
                            $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id=' . $tweet['id_str'] . '"><i class="fa-star"></i></a>' . "\n";

                            $date     = strtotime( $tweet['created_at'] ); // retrives the tweets date and time in Unix Epoch terms
                            $blogtime = current_time( 'U' ); // retrives the current browser client date and time in Unix Epoch terms
                            $dago     = human_time_diff( $date, $blogtime ) . ' ' . sprintf( __( 'ago', 'swiftframework' ) ); // calculates and outputs the time past in human readable format
                            $content .= '<a class="timestamp" href="https://twitter.com/' . $twitterID . '/status/' . $tweet['id_str'] . '" target="_blank">' . $dago . '</a>' . "\n";
                            $content .= '</div>' . "\n";
                        } else {
                            $content .= '<a href="http://twitter.com/' . $twitterID . '" target="_blank">@' . $twitterID . '</a>';
                        }
                        $content .= '</li>';
                    }
                }

                return $content;
            } else {
                return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
            }
        }
    }


    /* GET INSTAGRAMS FUNCTION
    ================================================== */
    if ( ! function_exists( 'sf_get_instagrams' ) ) {
        function sf_get_instagrams() {

            if ( class_exists( 'PhotoTileForInstagramBot' ) ) {

                $bot = new PhotoTileForInstagramBot();

                $optiondetails = $bot->option_defaults();
                $options       = array();
                foreach ( $optiondetails as $opt => $details ) {
                    $options[ $opt ] = $details['default'];
                    if ( isset( $details['short'] ) && isset( $atts[ $details['short'] ] ) ) {
                        $options[ $opt ] = $atts[ $details['short'] ];
                    }
                }
                $id = rand( 100, 1000 );
                $bot->set_private( 'wid', 'id' . $id );
                $bot->set_private( 'options', $options );
                $bot->do_alpine_method( 'update_global_options' );
                $bot->do_alpine_method( 'enqueue_style_and_script' );
                // Do the photo search
                $bot->do_alpine_method( 'photo_retrieval' );

                $return = '<div id="' . $bot->get_private( 'id' ) . '-by-shortcode-' . $id . '" class="AlpinePhotoTiles_inpost_container">';
                $return .= $bot->get_active_result( 'hidden' );
                if ( $bot->check_active_result( 'success' ) ) {
                    if ( 'vertical' == $options['style_option'] ) {
                        $bot->do_alpine_method( 'display_vertical' );
                    } elseif ( 'cascade' == $options['style_option'] ) {
                        $bot->do_alpine_method( 'display_cascade' );
                    } else {
                        $bot->do_alpine_method( 'display_hidden' );
                    }
                    $return .= $bot->get_private( 'output' );
                }
                // If user does not have necessary extensions
                // or error occured before content complete, report such...
                elseif ( $bot->check_active_option( 'general_hide_message' ) ) {
                    $return .= '<!-- Sorry:<br>' . $bot->get_active_result( 'message' ) . '-->';
                } else {
                    $return .= 'Sorry:<br>' . $bot->get_active_result( 'message' );
                }
                $return .= '</div>';

                return $return;
            }
        }
    }


    /* CHECK IF BUDDYPRESS PAGE
    ================================================== */
    function sf_is_buddypress() {
        $bp_component = "";
        if ( function_exists( 'bp_current_component' ) ) {
            $bp_component = bp_current_component();
        }

        return $bp_component;
    }


    /* CHECK IF BBPRESS PAGE
    ================================================== */
    function sf_is_bbpress() {
        $bbpress = false;
        if ( function_exists( 'is_bbpress' ) ) {
            $bbpress = is_bbpress();
        }

        return $bbpress;
    }


    /* CUSTOM POST TYPE COLUMNS
    ================================================== */
    function sf_posts_custom_columns( $column ) {
        global $post;
        switch ( $column ) {
            case "description":
                the_excerpt();
                break;
            case "thumbnail":
                the_post_thumbnail( 'thumbnail' );
                break;
            case "portfolio-category":
                echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' );
                break;
            case "swift-slider-category":
                echo get_the_term_list( $post->ID, 'swift-slider-category', '', ', ', '' );
                break;
            case "spb-section-category":
                echo get_the_term_list( $post->ID, 'spb-section-category', '', ', ', '' );
                break;
            case "gallery-category":
                echo get_the_term_list( $post->ID, 'gallery-category', '', ', ', '' );
                break;
            case "testimonials-category":
                echo get_the_term_list( $post->ID, 'testimonials-category', '', ', ', '' );
                break;
            case "team-category":
                echo get_the_term_list( $post->ID, 'team-category', '', ', ', '' );
                break;
            case "clients-category":
                echo get_the_term_list( $post->ID, 'clients-category', '', ', ', '' );
                break;
            case "directory-category":
                echo get_the_term_list( $post->ID, 'directory-category', '', ', ', '' );
                break;
            case "directory-location":
                echo get_the_term_list( $post->ID, 'directory-location', '', ', ', '' );
                break;
            case "faqs-category":
                echo get_the_term_list( $post->ID, 'faqs-category', '', ', ', '' );
                break;
        }
    }
    add_action( "manage_posts_custom_column", "sf_posts_custom_columns" );
    

    /* GALLERY LIST FUNCTION
    ================================================== */
    if ( ! function_exists( 'sf_list_galleries' ) ) {
        function sf_list_galleries() {
            $galleries_list  = array();
            $galleries_query = new WP_Query( array( 'post_type' => 'galleries', 'posts_per_page' => - 1 ) );
            while ( $galleries_query->have_posts() ) : $galleries_query->the_post();
                $galleries_list[ get_the_title() ] = get_the_ID();
            endwhile;
            wp_reset_query();

            if ( empty( $galleries_list ) ) {
                $galleries_list[] = "No galleries found";
            }

            return $galleries_list;
        }
    }


    /* PORTFOLIO RELATED POSTS
    ================================================== */
    function sf_portfolio_related_posts( $post_id, $item_count = 3 ) {
        $query = new WP_Query();
        $terms = wp_get_object_terms( $post_id, 'portfolio-category' );
        if ( count( $terms ) ) {
        	$post_ids = array();
        	$term_categories = array();
        	
        	foreach ($terms as $term) {
        		$term_categories[] = $term->term_id;
        		$term_objects = get_objects_in_term( $term->term_id, 'portfolio-category' );
        		foreach ($term_objects as $object) {
        			$post_ids[] = $object;
        		}
        	}

            $index = array_search( $post_id, $post_ids );
            if ( $index !== false ) {
                unset( $post_ids[ $index ] );
            }
                                    
            $args  = array(
                'post_type'      => 'portfolio',
                'post__in'	 => $post_ids,
                'posts_per_page' => $item_count
            );
            $query = new WP_Query( $args );
        }

        // Return our results in query form
        return $query;
    }


    /* REVIEW CALCULATION FUNCTIONS
    ================================================== */
    function sf_review_barpercent( $value, $format ) {
       	$barpercentage = $value;
        return $barpercentage;
    }

    function sf_review_value_adjust( $value, $format ) {
    	$adjusted_value = 0;
    	if ($format == "points" && intval($value, 10) > 10) {
    	$adjusted_value = intval($value, 10) / 10;
    	} else {
       	$adjusted_value = $value;
       	}
        return $adjusted_value;
    }

    if ( ! function_exists( 'sf_review_overall' ) ) {
        function sf_review_overall( $arr, $format ) {
            $total = $average = "";
            $count = count( $arr ); //total numbers in array
            if ( $count > 0 ) {
                foreach ( $arr as $value ) {
                	if ( $format == "points" && $value > 10) {
                		$total = $total + ($value / 10); // total value of array numbers
                	} else {
	                    $total = $total + $value; // total value of array numbers
                    }
                }
                $average = floor( ( $total / $count ) ); // get average value
            }

            return $average;
        }
    }


    /* LOADING ANIMATION
    ================================================== */
    if ( ! function_exists( 'sf_loading_animation' ) ) {
        function sf_loading_animation( $id = '', $el_class = "" ) {

            global $sf_options;
            $style = $sf_options['page_transition'];

            if ( $el_class == "preloader" && $style == "loading-bar" ) {
                $style = "circle-bar";
            }

            if ( $style == "loading-bar" ) {
            	return;
            }

            $animation = "";

            if ( $id != "" ) {
                $animation .= '<div id="' . $id . '" class="' . $style . '">';
            } else {
                $animation .= '<div class="' . $style . '">';
            }

            $animation .= '<div class="spinner ' . $el_class . '">';
            if ( $style == "wave" ) {
                $animation .= '<div class="rect1"></div>';
                $animation .= '<div class="rect2"></div>';
                $animation .= '<div class="rect3"></div>';
                $animation .= '<div class="rect4"></div>';
                $animation .= '<div class="rect5"></div>';
            } else if ( $style == "circle-bar" ) {
                $animation .= '<div class="circle"></div>';
            } else if ( $style == "orbit-bars" ) {
                $animation .= '<div></div>';
            } else if ( $style == "circle" ) {
                $animation .= '<div class="spinner-container container1">';
                $animation .= '<div class="circle1"></div>';
                $animation .= '<div class="circle2"></div>';
                $animation .= '<div class="circle3"></div>';
                $animation .= '<div class="circle4"></div>';
                $animation .= '</div>';
                $animation .= '<div class="spinner-container container2">';
                $animation .= '<div class="circle1"></div>';
                $animation .= '<div class="circle2"></div>';
                $animation .= '<div class="circle3"></div>';
                $animation .= '<div class="circle4"></div>';
                $animation .= '</div>';
                $animation .= '<div class="spinner-container container3">';
                $animation .= '<div class="circle1"></div>';
                $animation .= '<div class="circle2"></div>';
                $animation .= '<div class="circle3"></div>';
                $animation .= '<div class="circle4"></div>';
                $animation .= '</div>';
            } else if ( $style == "three-bounce" ) {
                $animation .= '<div class="bounce1"></div>';
                $animation .= '<div class="bounce2"></div>';
                $animation .= '<div class="bounce3"></div>';
            } else if ( $style == "chasing-circle" ) {
	            $animation .= '<svg class="circular" height="50" width="50"><circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" /></svg>';
            }
            $animation .= '</div>';

            $animation .= '</div>';

            return $animation;

        }
    }


    /* NAVIGATION CHECK
    ================================================== */
    //functions tell whether there are previous or next 'pages' from the current page
    //returns 0 if no 'page' exists, returns a number > 0 if 'page' does exist
    //ob_ functions are used to suppress the previous_posts_link() and next_posts_link() from printing their output to the screen
    function sf_has_previous_posts() {
        ob_start();
        previous_posts_link();
        $result = strlen( ob_get_contents() );
        ob_end_clean();

        return $result;
    }

    function sf_has_next_posts() {
        ob_start();
        next_posts_link();
        $result = strlen( ob_get_contents() );
        ob_end_clean();

        return $result;
    }


    /* BETTER WORDPRESS MINIFY FILTER
    ================================================== */
    function sf_bwm_filter( $excluded ) {
        global $is_IE;

        $excluded = array( 'fontawesome', 'ssgizmo' );

        if ( $is_IE ) {
            $excluded = array(
                'bootstrap',
                'sf-main',
                'sf-responsive',
                'fontawesome',
                'ssgizmo',
                'woocommerce_frontend_styles'
            );
        }

        return $excluded;
    }

    add_filter( 'bwp_minify_style_ignore', 'sf_bwm_filter' );

    function sf_bwm_filter_script( $excluded ) {

        global $is_IE;

        $excluded = array();

        if ( $is_IE ) {
            $excluded = array( 'jquery', 'sf-bootstrap-js', 'sf-functions' );
        }

        return $excluded;

    }

    add_filter( 'bwp_minify_script_ignore', 'sf_bwm_filter_script' );


    /* BETTER SEO PAGE TITLE
    ================================================== */
    if ( ! function_exists( 'sf_filter_wp_title' ) ) {
        function sf_filter_wp_title( $title ) {
            global $page, $paged;

            if ( is_feed() ) {
                return $title;
            }

            $site_description = get_bloginfo( 'description' );

            $filtered_title = $title . get_bloginfo( 'name' );
            $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description : '';
            $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'swiftframework' ), max( $paged, $page ) ) : '';

            return $filtered_title;
        }

        add_filter( 'wp_title', 'sf_filter_wp_title' );
    }


    /* MAINTENANCE MODE
    ================================================== */
    if ( ! function_exists( 'sf_maintenance_mode' ) ) {
        function sf_maintenance_mode() {
            global $sf_options;
            $custom_logo        = array();
            $custom_logo_output = $maintenance_mode = "";
            if ( isset( $sf_options['custom_admin_login_logo'] ) ) {
                $custom_logo = $sf_options['custom_admin_login_logo'];
            }
            if ( isset( $custom_logo['url'] ) ) {
                $custom_logo_output = '<img src="' . $custom_logo['url'] . '" alt="maintenance" style="margin: 0 auto; display: block;" />';
            } else {
                $custom_logo_output = '<img src="' . get_template_directory_uri() . '/images/custom-login-logo.png" alt="maintenance" style="margin: 0 auto; display: block;" />';
            }

            if ( isset( $sf_options['enable_maintenance'] ) ) {
                $maintenance_mode = $sf_options['enable_maintenance'];
            } else {
                $maintenance_mode = false;
            }

            if ( $maintenance_mode == 2 ) {

                $holding_page     = __( $sf_options['maintenance_mode_page'], 'swiftframework' );
                $current_page_URL = sf_current_page_url();
                $holding_page_URL = get_permalink( $holding_page );

                if ( $current_page_URL != $holding_page_URL ) {
                    if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
                        wp_redirect( $holding_page_URL );
                        exit;
                    }
                }

            } else if ( $maintenance_mode == 1 ) {
                if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
                    wp_die( $custom_logo_output . '<p style="text-align:center">' . __( 'We are currently in maintenance mode, please check back shortly.', 'swiftframework' ) . '</p>', get_bloginfo( 'name' ) );
                }
            }
        }

        add_action( 'get_header', 'sf_maintenance_mode' );
    }


    /* CUSTOM LOGIN LOGO
    ================================================== */
    if ( ! function_exists( 'sf_custom_login_logo' ) ) {
        function sf_custom_login_logo() {
            global $sf_options;
            $custom_logo = "";
            if ( isset( $sf_options['custom_admin_login_logo']['url'] ) ) {
                $custom_logo = $sf_options['custom_admin_login_logo']['url'];
            }
            if ( $custom_logo ) {
                echo '<style type="text/css">
			    .login h1 a { background-image:url(' . $custom_logo . ') !important; height: 95px!important; width: 100%!important; background-size: auto!important; }
			</style>';
            } else {
                echo '<style type="text/css">
			    .login h1 a { background-image:url(' . get_template_directory_uri() . '/images/custom-login-logo.png) !important; height: 95px!important; width: 100%!important; background-size: auto!important; }
			</style>';
            }
        }

        add_action( 'login_head', 'sf_custom_login_logo' );
    }


    /* LANGUAGE FLAGS
    ================================================== */
    if ( ! function_exists( 'sf_language_flags' ) ) {
	    function sf_language_flags() {

	        $language_output = "";

	        if ( function_exists( 'pll_the_languages' ) ) {
	            $languages = pll_the_languages(array('raw' =>1 ));
	            if ( !empty( $languages ) ) {
	                foreach( $languages as $l ) {
	                    $language_output .= '<li>';
	                    if ( $l['flag'] ) {
	                        if ( !$l['current_lang'] ) {
	                        	$language_output .= '<a href="'.$l['url'].'"><img src="'.$l['flag'].'" height="12" alt="'.$l['slug'].'" width="18" /><span class="language name">'.$l['name'].'</span></a>'."\n";
	                        } else {
	                        	$language_output .= '<div class="current-language"><img src="'.$l['flag'].'" height="12" alt="'.$l['slug'].'" width="18" /><span class="language name">'.$l['name'].'</span></div>'."\n";
	                        }
	                    }
	                    $language_output .= '</li>';
	                 }
	            }
	        } else if ( function_exists( 'icl_get_languages' ) ) {
	        	global $sitepress_settings;
	            $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
	            if ( ! empty( $languages ) ) {
	                foreach ( $languages as $l ) {
	                	$name = $l['translated_name'];
	                	if ( $sitepress_settings['icl_lso_native_lang'] ) {
	                		$name = $l['native_name'];
	                	}
	                    $language_output .= '<li>';
	                    if ( $l['country_flag_url'] ) {
	                        if ( ! $l['active'] ) {
	                            $language_output .= '<a href="' . $l['url'] . '"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" /><span class="language name">' . $name . '</span></a>' . "\n";
	                        } else {
	                            $language_output .= '<div class="current-language"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" /><span class="language name">' . $name . '</span></div>' . "\n";
	                        }
	                    }
	                    $language_output .= '</li>';
	                }
	            }
	        } else {
	            //echo '<li><div>No languages set.</div></li>';
	            $flags_url = get_template_directory_uri() . '/images/flags';
	            $language_output .= '<li><a href="#">DEMO - EXAMPLE PURPOSES</a></li><li><a href="#"><span class="language name">German</span></a></li><li><div class="current-language"><span class="language name">English</span></div></li><li><a href="#"><span class="language name">Spanish</span></a></li><li><a href="#"><span class="language name">French</span></a></li>' . "\n";
	        }

	        return $language_output;
	    }
    }


    /* HEX TO RGB COLOR
    ================================================== */
    if ( ! function_exists( 'sf_hex2rgb' ) ) {
	    function sf_hex2rgb( $colour ) {
	        if ( $colour[0] == '#' ) {
	            $colour = substr( $colour, 1 );
	        }
	        if ( strlen( $colour ) == 6 ) {
	            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	        } elseif ( strlen( $colour ) == 3 ) {
	            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	        } else {
	            return false;
	        }
	        $r = hexdec( $r );
	        $g = hexdec( $g );
	        $b = hexdec( $b );

	        return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	    }
    }


    /* GET COMMENTS COUNT TEXT
    ================================================== */
    function sf_get_comments_number( $post_id ) {
        $num_comments  = get_comments_number( $post_id ); // get_comments_number returns only a numeric value
        $comments_text = "";

        if ( $num_comments == 0 ) {
            $comments_text = __( '0 Comments', 'swiftframework' );
        } elseif ( $num_comments > 1 ) {
            $comments_text = $num_comments . __( ' Comments', 'swiftframework' );
        } else {
            $comments_text = __( '1 Comment', 'swiftframework' );
        }

        return $comments_text;
    }


    /* SET AUTHOR PAGE TO SHOW CAMPAIGNS
    ================================================== */
    function sf_post_author_archive( $query ) {
        if ( class_exists( 'ATCF_Campaigns' ) ) {
            if ( $query->is_author ) {
                $query->set( 'post_type', 'download' );
            }
        }
    }

    add_action( 'pre_get_posts', 'sf_post_author_archive' );


    /* GET USER MENU LIST
    ================================================== */
    function sf_get_menu_list() {

	    if ( !is_admin() ) {
			return;
		}

        $menu_list  = array( '' => '' );
        $user_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

        foreach ( $user_menus as $menu ) {
            $menu_list[ $menu->term_id ] = $menu->name;
        }

        return $menu_list;
    }


    /* GET CUSTOM POST TYPE TAXONOMY LIST
    ================================================== */
    if ( ! function_exists( 'sf_get_category_list' ) ) {
        function sf_get_category_list( $category_name, $filter = 0, $category_child = "", $frontend_display = false ) {

    		if ( !$frontend_display && !is_admin() ) {
    			return;
    		}

    		if ( $category_name == "product-category" ) {
    			$category_name = "product_cat";
    		}

            if ( ! $filter ) {

                $get_category  = get_categories( array( 'taxonomy' => $category_name ) );
                $category_list = array( '0' => 'All' );

                foreach ( $get_category as $category ) {
                    if ( isset( $category->slug ) ) {
                        $category_list[] = $category->slug;
                    }
                }

                return $category_list;

            } else if ( $category_child != "" && $category_child != "All" ) {

                $childcategory = get_term_by( 'slug', $category_child, $category_name );
                $get_category  = get_categories( array(
                        'taxonomy' => $category_name,
                        'child_of' => $childcategory->term_id
                    ) );
                $category_list = array( '0' => 'All' );

                foreach ( $get_category as $category ) {
                    if ( isset( $category->cat_name ) ) {
                        $category_list[] = $category->slug;
                    }
                }

                return $category_list;

            } else {

                $get_category  = get_categories( array( 'taxonomy' => $category_name ) );
                $category_list = array( '0' => 'All' );

                foreach ( $get_category as $category ) {
                    if ( isset( $category->cat_name ) ) {
                        $category_list[] = $category->cat_name;
                    }
                }

                return $category_list;
            }
    	}
    }

    if ( ! function_exists( 'sf_get_category_list_key_array' ) ) {
        function sf_get_category_list_key_array( $category_name ) {

    	    if ( !is_admin() ) {
    			return;
    		}

            $get_category  = get_categories( array( 'taxonomy' => $category_name ) );
            $category_list = array( 'all' => 'All' );

            foreach ( $get_category as $category ) {
                if ( isset( $category->slug ) ) {
                    $category_list[ $category->slug ] = $category->cat_name;
                }
            }

            return $category_list;
        }
    }
    
    if ( ! function_exists( 'sf_get_woo_product_filters_array' ) ) {
        function sf_get_woo_product_filters_array() {

    	    if ( !is_admin() ) {
    			return;
    		}

            global $woocommerce;

            $attribute_array = array();

            $transient_name = 'wc_attribute_taxonomies';

            if ( sf_woocommerce_activated() ) {

                if ( false === ( $attribute_taxonomies = get_transient( $transient_name ) ) ) {
                    global $wpdb;

                    $attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies" );
                    set_transient( $transient_name, $attribute_taxonomies );
                }

                $attribute_taxonomies = apply_filters( 'woocommerce_attribute_taxonomies', $attribute_taxonomies );

                $attribute_array['product_cat'] = __( 'Product Category', 'swiftframework' );
                $attribute_array['price']       = __( 'Price', 'swiftframework' );

                if ( $attribute_taxonomies ) {
                    foreach ( $attribute_taxonomies as $tax ) {
                        $attribute_array[ $tax->attribute_name ] = $tax->attribute_name;
                    }
                }

            }

            return $attribute_array;
        }
    }

    if ( ! function_exists( 'sf_get_woo_product_parent_category_array' ) ) {
    	function sf_get_woo_product_parent_category_array() {

    		if ( !is_admin() ) {
    			return;
    		}

    		$get_category  = get_categories( array( 'taxonomy' => 'product_cat', 'parent' => 0,  'hide_empty' => false ) );

    		$category_list = array( 'All' => 'All' );

    		foreach ( $get_category as $category ) {
    			if ( isset( $category->slug ) ) {
    				$category_list[$category->term_id] = $category->slug;
    			}
    		}

            return $category_list;

        }
    }

    /* POST FILTER
    ================================================== */
    if ( ! function_exists( 'sf_post_filter' ) ) {
        function sf_post_filter( $style = "basic", $post_type = "post", $parent_category = "" ) {

            $filter_output = $tax_terms = "";

			$taxonomy_name = 'category';

			if ( $post_type != "post") {
				$taxonomy_name = $post_type . '-category';
			}

            if ( $parent_category == "" || $parent_category == "All" ) {
                $tax_terms = sf_get_category_list( $taxonomy_name, 1, '', true );
            } else {
                $tax_terms = sf_get_category_list( $taxonomy_name, 1, $parent_category, true );
            }

            $filter_output .= '<div class="filter-wrap clearfix">' . "\n";
            $filter_output .= '<ul class="post-filter-tabs filtering clearfix">' . "\n";
            $filter_output .= '<li class="all selected"><a data-filter="*" href="#"><span class="item-name">' . __( "Show all", "swiftframework" ) . '</span></a></li>' . "\n";
            foreach ( $tax_terms as $tax_term ) {
                $term = get_term_by( 'slug', $tax_term, $taxonomy_name );
                if ( $term ) {
                	$slug = strtolower($term->slug);
                    $filter_output .= '<li><a href="#" title="' . $term->name . '" class="' . $slug . '" data-filter=".' . $slug . '"><span class="item-name">' . $term->name . '</span></a></li>' . "\n";
                } else {
                    $filter_output .= '<li><a href="#" title="' . $tax_term . '" class="' . $tax_term . '" data-filter=".' . $tax_term . '"><span class="item-name">' . $tax_term . '</span></a></li>' . "\n";
                }
            }
            $filter_output .= '</ul></div>' . "\n";

            return $filter_output;
        }
    }


    /* CATEGORY REL FIX
    ================================================== */
    function sf_add_nofollow_cat( $text ) {
        $text = str_replace( 'rel="category tag"', "", $text );

        return $text;
    }

    add_filter( 'the_category', 'sf_add_nofollow_cat' );


    /* GET CURRENT PAGE URL
    ================================================== */
    function sf_current_page_url() {
        $pageURL = 'http';
        $defaultPort = "80";
        if ( isset( $_SERVER["HTTPS"] ) ) {
            if ( $_SERVER["HTTPS"] == "on" ) {
                $pageURL .= "s";
                $defaultPort = "443";
            }
        }
        $pageURL .= "://";
        if ( $_SERVER["SERVER_PORT"] != $defaultPort ) {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        return $pageURL;
    }


    /* CHECK WOOCOMMERCE IS ACTIVE
    ================================================== */
    if ( ! function_exists( 'sf_woocommerce_activated' ) ) {
        function sf_woocommerce_activated() {
            if ( class_exists( 'woocommerce' ) ) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    
    /* CHECK EDD IS ACTIVE
    ================================================== */
    if ( ! function_exists( 'sf_edd_activated' ) ) {
        function sf_edd_activated() {
            if ( class_exists( 'Easy_Digital_Downloads' ) ) {
                return true;
            } else {
                return false;
            }
        }
    }


    /* CHECK WPML IS ACTIVE
    ================================================== */
    if ( ! function_exists( 'sf_wpml_activated' ) ) {
    	function sf_wpml_activated() {
    		if ( function_exists('icl_object_id') ) {
    			return true;
    		} else {
    			return false;
    		}
    	}
    }


    /* CHECK GRAVITY FORMS IS ACTIVE
    ================================================== */
    if ( ! function_exists( 'sf_gravityforms_activated' ) ) {
        function sf_gravityforms_activated() {
            if ( class_exists( 'GFForms' ) ) {
                return true;
            } else {
                return false;
            }
        }
    }


    /* CHECK NINJA FORMS IS ACTIVE
    ================================================== */
    if ( ! function_exists( 'sf_ninjaforms_activated' ) ) {
        function sf_ninjaforms_activated() {
            if ( function_exists( 'ninja_forms_shortcode' ) ) {
                return true;
            } else {
                return false;
            }
        }
    }


    /* CHECK GP PRICING IS ACTIVE
    ================================================== */
    if ( ! function_exists( 'sf_gopricing_activated' ) ) {
        function sf_gopricing_activated() {
            if ( class_exists( 'GW_GoPricing' ) ) {
                return true;
            } else {
                return false;
            }
        }
    }


    /* GET GRAVITY FORMS LIST
    ================================================== */
    if ( ! function_exists( 'sf_gravityforms_list' ) ) {
        function sf_gravityforms_list() {

	        if ( !is_admin() ) {
		        return;
	        }

            $forms       = RGFormsModel::get_forms( null, 'title' );
            $forms_array = array();

            if ( ! empty( $forms ) ) {
                foreach ( $forms as $form ):
                    $forms_array[ $form->id ] = $form->title;
                endforeach;
            }

            return $forms_array;
        }
    }


    /* GET NINJA FORMS LIST
    ================================================== */
    if ( ! function_exists( 'sf_ninjaforms_list' ) ) {
        function sf_ninjaforms_list() {

	        if ( !is_admin() ) {
		        return;
	        }

            $forms       = ninja_forms_get_all_forms();
            $forms_array = array();

            if ( ! empty( $forms ) ) {
                foreach ( $forms as $form ):
                    $forms_array[ $form['id'] ] = $form['data']['form_title'];
                endforeach;
            }

            return $forms_array;
        }
    }


    /* GET GO PRICING TABLES LIST
    ================================================== */
    if ( ! function_exists( 'sf_gopricing_list' ) ) {
        function sf_gopricing_list() {

	        if ( !is_admin() || !defined( 'GW_GO_PREFIX') ) {
		        return;
	        }

            $pricing_tables = get_option( GW_GO_PREFIX . 'tables' );
            $ptables_array  = array();

            if ( ! empty( $pricing_tables ) ) {
                foreach ( $pricing_tables as $pricing_table ) {
                    $ptables_array[ $pricing_table['table-id'] ] = esc_attr( $pricing_table['table-name'] );
                }
            }

            return $ptables_array;
        }
    }

    /* UPLOAD ATTACHMENTS
    ================================================== */
    if ( ! function_exists( 'sf_insert_attachment' ) ) {
        function sf_insert_attachment( $file_handler, $post_id ) {
            // check to make sure its a successful upload
            if ( $_FILES[ $file_handler ]['error'] !== UPLOAD_ERR_OK ) {
                __return_false();
            }

            require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
            require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
            require_once( ABSPATH . "wp-admin" . '/includes/media.php' );

            $attach_id = media_handle_upload( $file_handler, $post_id );

            return $attach_id;
        }
    }

    /* SPB TEMPLATE LIST FUNCTION
    ================================================== */
    if ( ! function_exists( 'sf_list_spb_sections' ) ) {
        function sf_list_spb_sections() {

	        if ( !is_admin() ) {
		        return;
	        }

            $spb_sections_list  = array();
            $spb_sections_query = new WP_Query( array( 'post_type' => 'spb-section', 'posts_per_page' => - 1 ) );
            while ( $spb_sections_query->have_posts() ) : $spb_sections_query->the_post();
                $spb_sections_list[ get_the_title() ] = get_the_ID();
            endwhile;
            wp_reset_query();

            if ( empty( $spb_sections_list ) ) {
                $spb_sections_list[] = "No SPB Templates found";
            }

            return $spb_sections_list;
        }
    }
    
    /* REGISTER FORM
    ================================================== */
    if ( ! function_exists( 'sf_register_form' ) ) {
        function sf_register_form( ) {
    	
    		$form = '';
    		$username = ! empty( $_POST['username'] ) ? esc_attr( $_POST['username'] ) : '';
    		$email =  ! empty( $_POST['email'] ) ? esc_attr( $_POST['email'] ) : '';
    		
			$form .= '<form method="post" class="register">';

			$form .= do_action( 'woocommerce_register_form_start' );

			if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) {

			$form .= '<p class="form-row form-row-wide register-username">';
			$form .= '<input type="text" class="input-text" name="username" id="reg_username" value="' . $username . '" placeholder="' . __( 'Username', 'swiftframework' ) . '" />';
			$form .= '</p>';

			}

			$form .= '<p class="form-row form-row-wide register-email">';
			$form .= '<input type="email" class="input-text" name="email" id="reg_email" value="' . $email . '" placeholder="' . __( 'Email', 'swiftframework' ) . '" />';
			$form .= '</p>';

			if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) {

			$form .= '<p class="form-row form-row-wide register-password">';
			$form .= '<input type="password" class="input-text" name="password" id="reg_password" placeholder="' . __( 'Password', 'swiftframework' ) . '" />';
			$form .= '</p>';
				
			}

			$form .= '<!-- Spam Trap --><div style="' . ( ( is_rtl() ) ? 'right' : 'left' ) . ': -999em; position: absolute;"><label for="trap">' . __( 'Anti-spam', 'swiftframework' ) . '</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>';

			$form .= do_action( 'woocommerce_register_form' );
			$form .= do_action( 'register_form' );

			$form .= '<p class="form-row register-submit">';
			$form .= wp_nonce_field( 'woocommerce-register' );
			$form .= '<input type="submit" class="button" name="register" value="' . __( 'Register', 'swiftframework' ) . '" />';
			$form .= '</p>';

			$form .= do_action( 'woocommerce_register_form_end' );
			
			return $form;
			
		}
	}

    /* ICON LIST
    ================================================== */
    if ( ! function_exists( 'sf_get_icons_list' ) ) {
        function sf_get_icons_list( $type = "", $format = "list" ) {

            // VARIABLES
            $icon_list = $fontawesome = $gizmo_list = $nucleo_interface = $nucleo_general = "";

            // FONT AWESOME
            $fontawesome = array(
	            'f26e' => 'fa-500px', 
	            'f042' => 'fa-adjust', 
	            'f170' => 'fa-adn', 
	            'f037' => 'fa-align-center', 
	            'f039' => 'fa-align-justify', 
	            'f036' => 'fa-align-left', 
	            'f038' => 'fa-align-right', 
	            'f270' => 'fa-amazon', 
	            'f0f9' => 'fa-ambulance', 
	            'f2a3' => 'fa-american-sign-language-interpreting', 
	            'f13d' => 'fa-anchor', 
	            'f17b' => 'fa-android', 
	            'f209' => 'fa-angellist', 
	            'f103' => 'fa-angle-double-down', 
	            'f100' => 'fa-angle-double-left', 
	            'f101' => 'fa-angle-double-right', 
	            'f102' => 'fa-angle-double-up', 
	            'f107' => 'fa-angle-down', 
	            'f104' => 'fa-angle-left', 
	            'f105' => 'fa-angle-right', 
	            'f106' => 'fa-angle-up', 
	            'f179' => 'fa-apple', 
	            'f187' => 'fa-archive', 
	            'f1fe' => 'fa-area-chart', 
	            'f0ab' => 'fa-arrow-circle-down', 
	            'f0a8' => 'fa-arrow-circle-left', 
	            'f01a' => 'fa-arrow-circle-o-down', 
	            'f190' => 'fa-arrow-circle-o-left', 
	            'f18e' => 'fa-arrow-circle-o-right', 
	            'f01b' => 'fa-arrow-circle-o-up', 
	            'f0a9' => 'fa-arrow-circle-right', 
	            'f0aa' => 'fa-arrow-circle-up', 
	            'f063' => 'fa-arrow-down', 
	            'f060' => 'fa-arrow-left', 
	            'f061' => 'fa-arrow-right', 
	            'f062' => 'fa-arrow-up', 
	            'f047' => 'fa-arrows', 
	            'f0b2' => 'fa-arrows-alt', 
	            'f07e' => 'fa-arrows-h', 
	            'f07d' => 'fa-arrows-v', 
	            'f2a3' => 'fa-asl-interpreting', 
	            'f2a2' => 'fa-assistive-listening-systems', 
	            'f069' => 'fa-asterisk', 
	            'f1fa' => 'fa-at', 
	            'f29e' => 'fa-audio-description', 
	            'f1b9' => 'fa-automobile', 
	            'f04a' => 'fa-backward', 
	            'f24e' => 'fa-balance-scale', 
	            'f05e' => 'fa-ban', 
	            'f19c' => 'fa-bank', 
	            'f080' => 'fa-bar-chart', 
	            'f080' => 'fa-bar-chart-o', 
	            'f02a' => 'fa-barcode', 
	            'f0c9' => 'fa-bars', 
	            'f244' => 'fa-battery-0', 
	            'f243' => 'fa-battery-1', 
	            'f242' => 'fa-battery-2', 
	            'f241' => 'fa-battery-3', 
	            'f240' => 'fa-battery-4', 
	            'f244' => 'fa-battery-empty', 
	            'f240' => 'fa-battery-full', 
	            'f242' => 'fa-battery-half', 
	            'f243' => 'fa-battery-quarter', 
	            'f241' => 'fa-battery-three-quarters', 
	            'f236' => 'fa-bed', 
	            'f0fc' => 'fa-beer', 
	            'f1b4' => 'fa-behance', 
	            'f1b5' => 'fa-behance-square', 
	            'f0f3' => 'fa-bell', 
	            'f0a2' => 'fa-bell-o', 
	            'f1f6' => 'fa-bell-slash', 
	            'f1f7' => 'fa-bell-slash-o', 
	            'f206' => 'fa-bicycle', 
	            'f1e5' => 'fa-binoculars', 
	            'f1fd' => 'fa-birthday-cake', 
	            'f171' => 'fa-bitbucket', 
	            'f172' => 'fa-bitbucket-square', 
	            'f15a' => 'fa-bitcoin', 
	            'f27e' => 'fa-black-tie', 
	            'f29d' => 'fa-blind', 
	            'f293' => 'fa-bluetooth', 
	            'f294' => 'fa-bluetooth-b', 
	            'f032' => 'fa-bold', 
	            'f0e7' => 'fa-bolt', 
	            'f1e2' => 'fa-bomb', 
	            'f02d' => 'fa-book', 
	            'f02e' => 'fa-bookmark', 
	            'f097' => 'fa-bookmark-o', 
	            'f2a1' => 'fa-braille', 
	            'f0b1' => 'fa-briefcase', 
	            'f15a' => 'fa-btc', 
	            'f188' => 'fa-bug', 
	            'f1ad' => 'fa-building', 
	            'f0f7' => 'fa-building-o', 
	            'f0a1' => 'fa-bullhorn', 
	            'f140' => 'fa-bullseye', 
	            'f207' => 'fa-bus', 
	            'f20d' => 'fa-buysellads', 
	            'f1ba' => 'fa-cab', 
	            'f1ec' => 'fa-calculator', 
	            'f073' => 'fa-calendar', 
	            'f274' => 'fa-calendar-check-o', 
	            'f272' => 'fa-calendar-minus-o', 
	            'f133' => 'fa-calendar-o', 
	            'f271' => 'fa-calendar-plus-o', 
	            'f273' => 'fa-calendar-times-o', 
	            'f030' => 'fa-camera', 
	            'f083' => 'fa-camera-retro', 
	            'f1b9' => 'fa-car', 
	            'f0d7' => 'fa-caret-down', 
	            'f0d9' => 'fa-caret-left', 
	            'f0da' => 'fa-caret-right', 
	            'f150' => 'fa-caret-square-o-down', 
	            'f191' => 'fa-caret-square-o-left', 
	            'f152' => 'fa-caret-square-o-right', 
	            'f151' => 'fa-caret-square-o-up', 
	            'f0d8' => 'fa-caret-up', 
	            'f218' => 'fa-cart-arrow-down', 
	            'f217' => 'fa-cart-plus', 
	            'f20a' => 'fa-cc', 
	            'f1f3' => 'fa-cc-amex', 
	            'f24c' => 'fa-cc-diners-club', 
	            'f1f2' => 'fa-cc-discover', 
	            'f24b' => 'fa-cc-jcb', 
	            'f1f1' => 'fa-cc-mastercard', 
	            'f1f4' => 'fa-cc-paypal', 
	            'f1f5' => 'fa-cc-stripe', 
	            'f1f0' => 'fa-cc-visa', 
	            'f0a3' => 'fa-certificate', 
	            'f0c1' => 'fa-chain', 
	            'f127' => 'fa-chain-broken', 
	            'f00c' => 'fa-check', 
	            'f058' => 'fa-check-circle', 
	            'f05d' => 'fa-check-circle-o', 
	            'f14a' => 'fa-check-square', 
	            'f046' => 'fa-check-square-o', 
	            'f13a' => 'fa-chevron-circle-down', 
	            'f137' => 'fa-chevron-circle-left', 
	            'f138' => 'fa-chevron-circle-right', 
	            'f139' => 'fa-chevron-circle-up', 
	            'f078' => 'fa-chevron-down', 
	            'f053' => 'fa-chevron-left', 
	            'f054' => 'fa-chevron-right', 
	            'f077' => 'fa-chevron-up', 
	            'f1ae' => 'fa-child', 
	            'f268' => 'fa-chrome', 
	            'f111' => 'fa-circle', 
	            'f10c' => 'fa-circle-o', 
	            'f1ce' => 'fa-circle-o-notch', 
	            'f1db' => 'fa-circle-thin', 
	            'f0ea' => 'fa-clipboard', 
	            'f017' => 'fa-clock-o', 
	            'f24d' => 'fa-clone', 
	            'f00d' => 'fa-close', 
	            'f0c2' => 'fa-cloud', 
	            'f0ed' => 'fa-cloud-download', 
	            'f0ee' => 'fa-cloud-upload', 
	            'f157' => 'fa-cny', 
	            'f121' => 'fa-code', 
	            'f126' => 'fa-code-fork', 
	            'f1cb' => 'fa-codepen', 
	            'f284' => 'fa-codiepie', 
	            'f0f4' => 'fa-coffee', 
	            'f013' => 'fa-cog', 
	            'f085' => 'fa-cogs', 
	            'f0db' => 'fa-columns', 
	            'f075' => 'fa-comment', 
	            'f0e5' => 'fa-comment-o', 
	            'f27a' => 'fa-commenting', 
	            'f27b' => 'fa-commenting-o', 
	            'f086' => 'fa-comments', 
	            'f0e6' => 'fa-comments-o', 
	            'f14e' => 'fa-compass', 
	            'f066' => 'fa-compress', 
	            'f20e' => 'fa-connectdevelop', 
	            'f26d' => 'fa-contao', 
	            'f0c5' => 'fa-copy', 
	            'f1f9' => 'fa-copyright', 
	            'f25e' => 'fa-creative-commons', 
	            'f09d' => 'fa-credit-card', 
	            'f283' => 'fa-credit-card-alt', 
	            'f125' => 'fa-crop', 
	            'f05b' => 'fa-crosshairs', 
	            'f13c' => 'fa-css3', 
	            'f1b2' => 'fa-cube', 
	            'f1b3' => 'fa-cubes', 
	            'f0c4' => 'fa-cut', 
	            'f0f5' => 'fa-cutlery', 
	            'f0e4' => 'fa-dashboard', 
	            'f210' => 'fa-dashcube', 
	            'f1c0' => 'fa-database', 
	            'f2a4' => 'fa-deaf', 
	            'f2a4' => 'fa-deafness', 
	            'f03b' => 'fa-dedent', 
	            'f1a5' => 'fa-delicious', 
	            'f108' => 'fa-desktop', 
	            'f1bd' => 'fa-deviantart', 
	            'f219' => 'fa-diamond', 
	            'f1a6' => 'fa-digg', 
	            'f155' => 'fa-dollar', 
	            'f192' => 'fa-dot-circle-o', 
	            'f019' => 'fa-download', 
	            'f17d' => 'fa-dribbble', 
	            'f16b' => 'fa-dropbox', 
	            'f1a9' => 'fa-drupal', 
	            'f282' => 'fa-edge', 
	            'f044' => 'fa-edit', 
	            'f052' => 'fa-eject', 
	            'f141' => 'fa-ellipsis-h', 
	            'f142' => 'fa-ellipsis-v', 
	            'f1d1' => 'fa-empire', 
	            'f0e0' => 'fa-envelope', 
	            'f003' => 'fa-envelope-o', 
	            'f199' => 'fa-envelope-square', 
	            'f299' => 'fa-envira', 
	            'f12d' => 'fa-eraser', 
	            'f153' => 'fa-eur', 
	            'f153' => 'fa-euro', 
	            'f0ec' => 'fa-exchange', 
	            'f12a' => 'fa-exclamation', 
	            'f06a' => 'fa-exclamation-circle', 
	            'f071' => 'fa-exclamation-triangle', 
	            'f065' => 'fa-expand', 
	            'f23e' => 'fa-expeditedssl', 
	            'f08e' => 'fa-external-link', 
	            'f14c' => 'fa-external-link-square', 
	            'f06e' => 'fa-eye', 
	            'f070' => 'fa-eye-slash', 
	            'f1fb' => 'fa-eyedropper', 
	            'f2b4' => 'fa-fa', 
	            'f09a' => 'fa-facebook', 
	            'f09a' => 'fa-facebook-f', 
	            'f230' => 'fa-facebook-official', 
	            'f082' => 'fa-facebook-square', 
	            'f049' => 'fa-fast-backward', 
	            'f050' => 'fa-fast-forward', 
	            'f1ac' => 'fa-fax', 
	            'f09e' => 'fa-feed', 
	            'f182' => 'fa-female', 
	            'f0fb' => 'fa-fighter-jet', 
	            'f15b' => 'fa-file', 
	            'f1c6' => 'fa-file-archive-o', 
	            'f1c7' => 'fa-file-audio-o', 
	            'f1c9' => 'fa-file-code-o', 
	            'f1c3' => 'fa-file-excel-o', 
	            'f1c5' => 'fa-file-image-o', 
	            'f1c8' => 'fa-file-movie-o', 
	            'f016' => 'fa-file-o', 
	            'f1c1' => 'fa-file-pdf-o', 
	            'f1c5' => 'fa-file-photo-o', 
	            'f1c5' => 'fa-file-picture-o', 
	            'f1c4' => 'fa-file-powerpoint-o', 
	            'f1c7' => 'fa-file-sound-o', 
	            'f15c' => 'fa-file-text', 
	            'f0f6' => 'fa-file-text-o', 
	            'f1c8' => 'fa-file-video-o', 
	            'f1c2' => 'fa-file-word-o', 
	            'f1c6' => 'fa-file-zip-o', 
	            'f0c5' => 'fa-files-o', 
	            'f008' => 'fa-film', 
	            'f0b0' => 'fa-filter', 
	            'f06d' => 'fa-fire', 
	            'f134' => 'fa-fire-extinguisher', 
	            'f269' => 'fa-firefox', 
	            'f2b0' => 'fa-first-order', 
	            'f024' => 'fa-flag', 
	            'f11e' => 'fa-flag-checkered', 
	            'f11d' => 'fa-flag-o', 
	            'f0e7' => 'fa-flash', 
	            'f0c3' => 'fa-flask', 
	            'f16e' => 'fa-flickr', 
	            'f0c7' => 'fa-floppy-o', 
	            'f07b' => 'fa-folder', 
	            'f114' => 'fa-folder-o', 
	            'f07c' => 'fa-folder-open', 
	            'f115' => 'fa-folder-open-o', 
	            'f031' => 'fa-font', 
	            'f2b4' => 'fa-font-awesome', 
	            'f280' => 'fa-fonticons', 
	            'f286' => 'fa-fort-awesome', 
	            'f211' => 'fa-forumbee', 
	            'f04e' => 'fa-forward', 
	            'f180' => 'fa-foursquare', 
	            'f119' => 'fa-frown-o', 
	            'f1e3' => 'fa-futbol-o', 
	            'f11b' => 'fa-gamepad', 
	            'f0e3' => 'fa-gavel', 
	            'f154' => 'fa-gbp', 
	            'f1d1' => 'fa-ge', 
	            'f013' => 'fa-gear', 
	            'f085' => 'fa-gears', 
	            'f22d' => 'fa-genderless', 
	            'f265' => 'fa-get-pocket', 
	            'f260' => 'fa-gg', 
	            'f261' => 'fa-gg-circle', 
	            'f06b' => 'fa-gift', 
	            'f1d3' => 'fa-git', 
	            'f1d2' => 'fa-git-square', 
	            'f09b' => 'fa-github', 
	            'f113' => 'fa-github-alt', 
	            'f092' => 'fa-github-square', 
	            'f296' => 'fa-gitlab', 
	            'f184' => 'fa-gittip', 
	            'f000' => 'fa-glass', 
	            'f2a5' => 'fa-glide', 
	            'f2a6' => 'fa-glide-g', 
	            'f0ac' => 'fa-globe', 
	            'f1a0' => 'fa-google', 
	            'f0d5' => 'fa-google-plus', 
	            'f2b3' => 'fa-google-plus-circle', 
	            'f2b3' => 'fa-google-plus-official', 
	            'f0d4' => 'fa-google-plus-square', 
	            'f1ee' => 'fa-google-wallet', 
	            'f19d' => 'fa-graduation-cap', 
	            'f184' => 'fa-gratipay', 
	            'f0c0' => 'fa-group', 
	            'f0fd' => 'fa-h-square', 
	            'f1d4' => 'fa-hacker-news', 
	            'f255' => 'fa-hand-grab-o', 
	            'f258' => 'fa-hand-lizard-o', 
	            'f0a7' => 'fa-hand-o-down', 
	            'f0a5' => 'fa-hand-o-left', 
	            'f0a4' => 'fa-hand-o-right', 
	            'f0a6' => 'fa-hand-o-up', 
	            'f256' => 'fa-hand-paper-o', 
	            'f25b' => 'fa-hand-peace-o', 
	            'f25a' => 'fa-hand-pointer-o', 
	            'f255' => 'fa-hand-rock-o', 
	            'f257' => 'fa-hand-scissors-o', 
	            'f259' => 'fa-hand-spock-o', 
	            'f256' => 'fa-hand-stop-o', 
	            'f2a4' => 'fa-hard-of-hearing', 
	            'f292' => 'fa-hashtag', 
	            'f0a0' => 'fa-hdd-o', 
	            'f1dc' => 'fa-header', 
	            'f025' => 'fa-headphones', 
	            'f004' => 'fa-heart', 
	            'f08a' => 'fa-heart-o', 
	            'f21e' => 'fa-heartbeat', 
	            'f1da' => 'fa-history', 
	            'f015' => 'fa-home', 
	            'f0f8' => 'fa-hospital-o', 
	            'f236' => 'fa-hotel', 
	            'f254' => 'fa-hourglass', 
	            'f251' => 'fa-hourglass-1', 
	            'f252' => 'fa-hourglass-2', 
	            'f253' => 'fa-hourglass-3', 
	            'f253' => 'fa-hourglass-end', 
	            'f252' => 'fa-hourglass-half', 
	            'f250' => 'fa-hourglass-o', 
	            'f251' => 'fa-hourglass-start', 
	            'f27c' => 'fa-houzz', 
	            'f13b' => 'fa-html5', 
	            'f246' => 'fa-i-cursor', 
	            'f20b' => 'fa-ils', 
	            'f03e' => 'fa-image', 
	            'f01c' => 'fa-inbox', 
	            'f03c' => 'fa-indent', 
	            'f275' => 'fa-industry', 
	            'f129' => 'fa-info', 
	            'f05a' => 'fa-info-circle', 
	            'f156' => 'fa-inr', 
	            'f16d' => 'fa-instagram', 
	            'f19c' => 'fa-institution', 
	            'f26b' => 'fa-internet-explorer', 
	            'f224' => 'fa-intersex', 
	            'f208' => 'fa-ioxhost', 
	            'f033' => 'fa-italic', 
	            'f1aa' => 'fa-joomla', 
	            'f157' => 'fa-jpy', 
	            'f1cc' => 'fa-jsfiddle', 
	            'f084' => 'fa-key', 
	            'f11c' => 'fa-keyboard-o', 
	            'f159' => 'fa-krw', 
	            'f1ab' => 'fa-language', 
	            'f109' => 'fa-laptop', 
	            'f202' => 'fa-lastfm', 
	            'f203' => 'fa-lastfm-square', 
	            'f06c' => 'fa-leaf', 
	            'f212' => 'fa-leanpub', 
	            'f0e3' => 'fa-legal', 
	            'f094' => 'fa-lemon-o', 
	            'f149' => 'fa-level-down', 
	            'f148' => 'fa-level-up', 
	            'f1cd' => 'fa-life-bouy', 
	            'f1cd' => 'fa-life-buoy', 
	            'f1cd' => 'fa-life-ring', 
	            'f1cd' => 'fa-life-saver', 
	            'f0eb' => 'fa-lightbulb-o', 
	            'f201' => 'fa-line-chart', 
	            'f0c1' => 'fa-link', 
	            'f0e1' => 'fa-linkedin', 
	            'f08c' => 'fa-linkedin-square', 
	            'f17c' => 'fa-linux', 
	            'f03a' => 'fa-list', 
	            'f022' => 'fa-list-alt', 
	            'f0cb' => 'fa-list-ol', 
	            'f0ca' => 'fa-list-ul', 
	            'f124' => 'fa-location-arrow', 
	            'f023' => 'fa-lock', 
	            'f175' => 'fa-long-arrow-down', 
	            'f177' => 'fa-long-arrow-left', 
	            'f178' => 'fa-long-arrow-right', 
	            'f176' => 'fa-long-arrow-up', 
	            'f2a8' => 'fa-low-vision', 
	            'f0d0' => 'fa-magic', 
	            'f076' => 'fa-magnet', 
	            'f064' => 'fa-mail-forward', 
	            'f112' => 'fa-mail-reply', 
	            'f122' => 'fa-mail-reply-all', 
	            'f183' => 'fa-male', 
	            'f279' => 'fa-map', 
	            'f041' => 'fa-map-marker', 
	            'f278' => 'fa-map-o', 
	            'f276' => 'fa-map-pin', 
	            'f277' => 'fa-map-signs', 
	            'f222' => 'fa-mars', 
	            'f227' => 'fa-mars-double', 
	            'f229' => 'fa-mars-stroke', 
	            'f22b' => 'fa-mars-stroke-h', 
	            'f22a' => 'fa-mars-stroke-v', 
	            'f136' => 'fa-maxcdn', 
	            'f20c' => 'fa-meanpath', 
	            'f23a' => 'fa-medium', 
	            'f0fa' => 'fa-medkit', 
	            'f11a' => 'fa-meh-o', 
	            'f223' => 'fa-mercury', 
	            'f130' => 'fa-microphone', 
	            'f131' => 'fa-microphone-slash', 
	            'f068' => 'fa-minus', 
	            'f056' => 'fa-minus-circle', 
	            'f146' => 'fa-minus-square', 
	            'f147' => 'fa-minus-square-o', 
	            'f289' => 'fa-mixcloud', 
	            'f10b' => 'fa-mobile', 
	            'f10b' => 'fa-mobile-phone', 
	            'f285' => 'fa-modx', 
	            'f0d6' => 'fa-money', 
	            'f186' => 'fa-moon-o', 
	            'f19d' => 'fa-mortar-board', 
	            'f21c' => 'fa-motorcycle', 
	            'f245' => 'fa-mouse-pointer', 
	            'f001' => 'fa-music', 
	            'f0c9' => 'fa-navicon', 
	            'f22c' => 'fa-neuter', 
	            'f1ea' => 'fa-newspaper-o', 
	            'f247' => 'fa-object-group', 
	            'f248' => 'fa-object-ungroup', 
	            'f263' => 'fa-odnoklassniki', 
	            'f264' => 'fa-odnoklassniki-square', 
	            'f23d' => 'fa-opencart', 
	            'f19b' => 'fa-openid', 
	            'f26a' => 'fa-opera', 
	            'f23c' => 'fa-optin-monster', 
	            'f03b' => 'fa-outdent', 
	            'f18c' => 'fa-pagelines', 
	            'f1fc' => 'fa-paint-brush', 
	            'f1d8' => 'fa-paper-plane', 
	            'f1d9' => 'fa-paper-plane-o', 
	            'f0c6' => 'fa-paperclip', 
	            'f1dd' => 'fa-paragraph', 
	            'f0ea' => 'fa-paste', 
	            'f04c' => 'fa-pause', 
	            'f28b' => 'fa-pause-circle', 
	            'f28c' => 'fa-pause-circle-o', 
	            'f1b0' => 'fa-paw', 
	            'f1ed' => 'fa-paypal', 
	            'f040' => 'fa-pencil', 
	            'f14b' => 'fa-pencil-square', 
	            'f044' => 'fa-pencil-square-o', 
	            'f295' => 'fa-percent', 
	            'f095' => 'fa-phone', 
	            'f098' => 'fa-phone-square', 
	            'f03e' => 'fa-photo', 
	            'f03e' => 'fa-picture-o', 
	            'f200' => 'fa-pie-chart', 
	            'f2ae' => 'fa-pied-piper', 
	            'f1a8' => 'fa-pied-piper-alt', 
	            'f1a7' => 'fa-pied-piper-pp', 
	            'f0d2' => 'fa-pinterest', 
	            'f231' => 'fa-pinterest-p', 
	            'f0d3' => 'fa-pinterest-square', 
	            'f072' => 'fa-plane', 
	            'f04b' => 'fa-play', 
	            'f144' => 'fa-play-circle', 
	            'f01d' => 'fa-play-circle-o', 
	            'f1e6' => 'fa-plug', 
	            'f067' => 'fa-plus', 
	            'f055' => 'fa-plus-circle', 
	            'f0fe' => 'fa-plus-square', 
	            'f196' => 'fa-plus-square-o', 
	            'f011' => 'fa-power-off', 
	            'f02f' => 'fa-print', 
	            'f288' => 'fa-product-hunt', 
	            'f12e' => 'fa-puzzle-piece', 
	            'f1d6' => 'fa-qq', 
	            'f029' => 'fa-qrcode', 
	            'f128' => 'fa-question', 
	            'f059' => 'fa-question-circle', 
	            'f29c' => 'fa-question-circle-o', 
	            'f10d' => 'fa-quote-left', 
	            'f10e' => 'fa-quote-right', 
	            'f1d0' => 'fa-ra', 
	            'f074' => 'fa-random', 
	            'f1d0' => 'fa-rebel', 
	            'f1b8' => 'fa-recycle', 
	            'f1a1' => 'fa-reddit', 
	            'f281' => 'fa-reddit-alien', 
	            'f1a2' => 'fa-reddit-square', 
	            'f021' => 'fa-refresh', 
	            'f25d' => 'fa-registered', 
	            'f00d' => 'fa-remove', 
	            'f18b' => 'fa-renren', 
	            'f0c9' => 'fa-reorder', 
	            'f01e' => 'fa-repeat', 
	            'f112' => 'fa-reply', 
	            'f122' => 'fa-reply-all', 
	            'f1d0' => 'fa-resistance', 
	            'f079' => 'fa-retweet', 
	            'f157' => 'fa-rmb', 
	            'f018' => 'fa-road', 
	            'f135' => 'fa-rocket', 
	            'f0e2' => 'fa-rotate-left', 
	            'f01e' => 'fa-rotate-right', 
	            'f158' => 'fa-rouble', 
	            'f09e' => 'fa-rss', 
	            'f143' => 'fa-rss-square', 
	            'f158' => 'fa-rub', 
	            'f158' => 'fa-ruble', 
	            'f156' => 'fa-rupee', 
	            'f267' => 'fa-safari', 
	            'f0c7' => 'fa-save', 
	            'f0c4' => 'fa-scissors', 
	            'f28a' => 'fa-scribd', 
	            'f002' => 'fa-search', 
	            'f010' => 'fa-search-minus', 
	            'f00e' => 'fa-search-plus', 
	            'f213' => 'fa-sellsy', 
	            'f1d8' => 'fa-send', 
	            'f1d9' => 'fa-send-o', 
	            'f233' => 'fa-server', 
	            'f064' => 'fa-share', 
	            'f1e0' => 'fa-share-alt', 
	            'f1e1' => 'fa-share-alt-square', 
	            'f14d' => 'fa-share-square', 
	            'f045' => 'fa-share-square-o', 
	            'f20b' => 'fa-shekel', 
	            'f20b' => 'fa-sheqel', 
	            'f132' => 'fa-shield', 
	            'f21a' => 'fa-ship', 
	            'f214' => 'fa-shirtsinbulk', 
	            'f290' => 'fa-shopping-bag', 
	            'f291' => 'fa-shopping-basket', 
	            'f07a' => 'fa-shopping-cart', 
	            'f090' => 'fa-sign-in', 
	            'f2a7' => 'fa-sign-language', 
	            'f08b' => 'fa-sign-out', 
	            'f012' => 'fa-signal', 
	            'f2a7' => 'fa-signing', 
	            'f215' => 'fa-simplybuilt', 
	            'f0e8' => 'fa-sitemap', 
	            'f216' => 'fa-skyatlas', 
	            'f17e' => 'fa-skype', 
	            'f198' => 'fa-slack', 
	            'f1de' => 'fa-sliders', 
	            'f1e7' => 'fa-slideshare', 
	            'f118' => 'fa-smile-o', 
	            'f2ab' => 'fa-snapchat', 
	            'f2ac' => 'fa-snapchat-ghost', 
	            'f2ad' => 'fa-snapchat-square', 
	            'f1e3' => 'fa-soccer-ball-o', 
	            'f0dc' => 'fa-sort', 
	            'f15d' => 'fa-sort-alpha-asc', 
	            'f15e' => 'fa-sort-alpha-desc', 
	            'f160' => 'fa-sort-amount-asc', 
	            'f161' => 'fa-sort-amount-desc', 
	            'f0de' => 'fa-sort-asc', 
	            'f0dd' => 'fa-sort-desc', 
	            'f0dd' => 'fa-sort-down', 
	            'f162' => 'fa-sort-numeric-asc', 
	            'f163' => 'fa-sort-numeric-desc', 
	            'f0de' => 'fa-sort-up', 
	            'f1be' => 'fa-soundcloud', 
	            'f197' => 'fa-space-shuttle', 
	            'f110' => 'fa-spinner', 
	            'f1b1' => 'fa-spoon', 
	            'f1bc' => 'fa-spotify', 
	            'f0c8' => 'fa-square', 
	            'f096' => 'fa-square-o', 
	            'f18d' => 'fa-stack-exchange', 
	            'f16c' => 'fa-stack-overflow', 
	            'f005' => 'fa-star', 
	            'f089' => 'fa-star-half', 
	            'f123' => 'fa-star-half-empty', 
	            'f123' => 'fa-star-half-full', 
	            'f123' => 'fa-star-half-o', 
	            'f006' => 'fa-star-o', 
	            'f1b6' => 'fa-steam', 
	            'f1b7' => 'fa-steam-square', 
	            'f048' => 'fa-step-backward', 
	            'f051' => 'fa-step-forward', 
	            'f0f1' => 'fa-stethoscope', 
	            'f249' => 'fa-sticky-note', 
	            'f24a' => 'fa-sticky-note-o', 
	            'f04d' => 'fa-stop', 
	            'f28d' => 'fa-stop-circle', 
	            'f28e' => 'fa-stop-circle-o', 
	            'f21d' => 'fa-street-view', 
	            'f0cc' => 'fa-strikethrough', 
	            'f1a4' => 'fa-stumbleupon', 
	            'f1a3' => 'fa-stumbleupon-circle', 
	            'f12c' => 'fa-subscript', 
	            'f239' => 'fa-subway', 
	            'f0f2' => 'fa-suitcase', 
	            'f185' => 'fa-sun-o', 
	            'f12b' => 'fa-superscript', 
	            'f1cd' => 'fa-support', 
	            'f0ce' => 'fa-table', 
	            'f10a' => 'fa-tablet', 
	            'f0e4' => 'fa-tachometer', 
	            'f02b' => 'fa-tag', 
	            'f02c' => 'fa-tags', 
	            'f0ae' => 'fa-tasks', 
	            'f1ba' => 'fa-taxi', 
	            'f26c' => 'fa-television', 
	            'f1d5' => 'fa-tencent-weibo', 
	            'f120' => 'fa-terminal', 
	            'f034' => 'fa-text-height', 
	            'f035' => 'fa-text-width', 
	            'f00a' => 'fa-th', 
	            'f009' => 'fa-th-large', 
	            'f00b' => 'fa-th-list', 
	            'f2b2' => 'fa-themeisle', 
	            'f08d' => 'fa-thumb-tack', 
	            'f165' => 'fa-thumbs-down', 
	            'f088' => 'fa-thumbs-o-down', 
	            'f087' => 'fa-thumbs-o-up', 
	            'f164' => 'fa-thumbs-up', 
	            'f145' => 'fa-ticket', 
	            'f00d' => 'fa-times', 
	            'f057' => 'fa-times-circle', 
	            'f05c' => 'fa-times-circle-o', 
	            'f043' => 'fa-tint', 
	            'f150' => 'fa-toggle-down', 
	            'f191' => 'fa-toggle-left', 
	            'f204' => 'fa-toggle-off', 
	            'f205' => 'fa-toggle-on', 
	            'f152' => 'fa-toggle-right', 
	            'f151' => 'fa-toggle-up', 
	            'f25c' => 'fa-trademark', 
	            'f238' => 'fa-train', 
	            'f224' => 'fa-transgender', 
	            'f225' => 'fa-transgender-alt', 
	            'f1f8' => 'fa-trash', 
	            'f014' => 'fa-trash-o', 
	            'f1bb' => 'fa-tree', 
	            'f181' => 'fa-trello', 
	            'f262' => 'fa-tripadvisor', 
	            'f091' => 'fa-trophy', 
	            'f0d1' => 'fa-truck', 
	            'f195' => 'fa-try', 
	            'f1e4' => 'fa-tty', 
	            'f173' => 'fa-tumblr', 
	            'f174' => 'fa-tumblr-square', 
	            'f195' => 'fa-turkish-lira', 
	            'f26c' => 'fa-tv', 
	            'f1e8' => 'fa-twitch', 
	            'f099' => 'fa-twitter', 
	            'f081' => 'fa-twitter-square', 
	            'f0e9' => 'fa-umbrella', 
	            'f0cd' => 'fa-underline', 
	            'f0e2' => 'fa-undo', 
	            'f29a' => 'fa-universal-access', 
	            'f19c' => 'fa-university', 
	            'f127' => 'fa-unlink', 
	            'f09c' => 'fa-unlock', 
	            'f13e' => 'fa-unlock-alt', 
	            'f0dc' => 'fa-unsorted', 
	            'f093' => 'fa-upload', 
	            'f287' => 'fa-usb', 
	            'f155' => 'fa-usd', 
	            'f007' => 'fa-user', 
	            'f0f0' => 'fa-user-md', 
	            'f234' => 'fa-user-plus', 
	            'f21b' => 'fa-user-secret', 
	            'f235' => 'fa-user-times', 
	            'f0c0' => 'fa-users', 
	            'f221' => 'fa-venus', 
	            'f226' => 'fa-venus-double', 
	            'f228' => 'fa-venus-mars', 
	            'f237' => 'fa-viacoin', 
	            'f2a9' => 'fa-viadeo', 
	            'f2aa' => 'fa-viadeo-square', 
	            'f03d' => 'fa-video-camera', 
	            'f27d' => 'fa-vimeo', 
	            'f194' => 'fa-vimeo-square', 
	            'f1ca' => 'fa-vine', 
	            'f189' => 'fa-vk', 
	            'f2a0' => 'fa-volume-control-phone', 
	            'f027' => 'fa-volume-down', 
	            'f026' => 'fa-volume-off', 
	            'f028' => 'fa-volume-up', 
	            'f071' => 'fa-warning', 
	            'f1d7' => 'fa-wechat', 
	            'f18a' => 'fa-weibo', 
	            'f1d7' => 'fa-weixin', 
	            'f232' => 'fa-whatsapp', 
	            'f193' => 'fa-wheelchair', 
	            'f29b' => 'fa-wheelchair-alt', 
	            'f1eb' => 'fa-wifi', 
	            'f266' => 'fa-wikipedia-w', 
	            'f17a' => 'fa-windows', 
	            'f159' => 'fa-won', 
	            'f19a' => 'fa-wordpress', 
	            'f297' => 'fa-wpbeginner', 
	            'f298' => 'fa-wpforms', 
	            'f0ad' => 'fa-wrench', 
	            'f168' => 'fa-xing', 
	            'f169' => 'fa-xing-square', 
	            'f23b' => 'fa-y-combinator', 
	            'f1d4' => 'fa-y-combinator-square', 
	            'f19e' => 'fa-yahoo', 
	            'f23b' => 'fa-yc', 
	            'f1d4' => 'fa-yc-square', 
	            'f1e9' => 'fa-yelp', 
	            'f157' => 'fa-yen', 
	            'f2b1' => 'fa-yoast', 
	            'f167' => 'fa-youtube', 
	            'f16a' => 'fa-youtube-play', 
	            'f166' => 'fa-youtube-square', 
            );

            // GIZMO
            $gizmo_list = '<li><i class="ss-cursor"></i><span class="icon-name">ss-cursor</span></li><li><i class="ss-crosshair"></i><span class="icon-name">ss-crosshair</span></li><li><i class="ss-search"></i><span class="icon-name">ss-search</span></li><li><i class="ss-zoomin"></i><span class="icon-name">ss-zoomin</span></li><li><i class="ss-zoomout"></i><span class="icon-name">ss-zoomout</span></li><li><i class="ss-view"></i><span class="icon-name">ss-view</span></li><li><i class="ss-attach"></i><span class="icon-name">ss-attach</span></li><li><i class="ss-link"></i><span class="icon-name">ss-link</span></li><li><i class="ss-unlink"></i><span class="icon-name">ss-unlink</span></li><li><i class="ss-move"></i><span class="icon-name">ss-move</span></li><li><i class="ss-write"></i><span class="icon-name">ss-write</span></li><li><i class="ss-writingdisabled"></i><span class="icon-name">ss-writingdisabled</span></li><li><i class="ss-erase"></i><span class="icon-name">ss-erase</span></li><li><i class="ss-compose"></i><span class="icon-name">ss-compose</span></li><li><i class="ss-lock"></i><span class="icon-name">ss-lock</span></li><li><i class="ss-unlock"></i><span class="icon-name">ss-unlock</span></li><li><i class="ss-key"></i><span class="icon-name">ss-key</span></li><li><i class="ss-backspace"></i><span class="icon-name">ss-backspace</span></li><li><i class="ss-ban"></i><span class="icon-name">ss-ban</span></li><li><i class="ss-smoking"></i><span class="icon-name">ss-smoking</span></li><li><i class="ss-nosmoking"></i><span class="icon-name">ss-nosmoking</span></li><li><i class="ss-trash"></i><span class="icon-name">ss-trash</span></li><li><i class="ss-target"></i><span class="icon-name">ss-target</span></li><li><i class="ss-tag"></i><span class="icon-name">ss-tag</span></li><li><i class="ss-bookmark"></i><span class="icon-name">ss-bookmark</span></li><li><i class="ss-flag"></i><span class="icon-name">ss-flag</span></li><li><i class="ss-like"></i><span class="icon-name">ss-like</span></li><li><i class="ss-dislike"></i><span class="icon-name">ss-dislike</span></li><li><i class="ss-heart"></i><span class="icon-name">ss-heart</span></li><li><i class="ss-star"></i><span class="icon-name">ss-star</span></li><li><i class="ss-sample"></i><span class="icon-name">ss-sample</span></li><li><i class="ss-crop"></i><span class="icon-name">ss-crop</span></li><li><i class="ss-layers"></i><span class="icon-name">ss-layers</span></li><li><i class="ss-layergroup"></i><span class="icon-name">ss-layergroup</span></li><li><i class="ss-pen"></i><span class="icon-name">ss-pen</span></li><li><i class="ss-bezier"></i><span class="icon-name">ss-bezier</span></li><li><i class="ss-pixels"></i><span class="icon-name">ss-pixels</span></li><li><i class="ss-phone"></i><span class="icon-name">ss-phone</span></li><li><i class="ss-phonedisabled"></i><span class="icon-name">ss-phonedisabled</span></li><li><i class="ss-touchtonephone"></i><span class="icon-name">ss-touchtonephone</span></li><li><i class="ss-mail"></i><span class="icon-name">ss-mail</span></li><li><i class="ss-inbox"></i><span class="icon-name">ss-inbox</span></li><li><i class="ss-outbox"></i><span class="icon-name">ss-outbox</span></li><li><i class="ss-chat"></i><span class="icon-name">ss-chat</span></li><li><i class="ss-user"></i><span class="icon-name">ss-user</span></li><li><i class="ss-users"></i><span class="icon-name">ss-users</span></li><li><i class="ss-usergroup"></i><span class="icon-name">ss-usergroup</span></li><li><i class="ss-businessuser"></i><span class="icon-name">ss-businessuser</span></li><li><i class="ss-man"></i><span class="icon-name">ss-man</span></li><li><i class="ss-male"></i><span class="icon-name">ss-male</span></li><li><i class="ss-woman"></i><span class="icon-name">ss-woman</span></li><li><i class="ss-female"></i><span class="icon-name">ss-female</span></li><li><i class="ss-raisedhand"></i><span class="icon-name">ss-raisedhand</span></li><li><i class="ss-hand"></i><span class="icon-name">ss-hand</span></li><li><i class="ss-pointup"></i><span class="icon-name">ss-pointup</span></li><li><i class="ss-pointupright"></i><span class="icon-name">ss-pointupright</span></li><li><i class="ss-pointright"></i><span class="icon-name">ss-pointright</span></li><li><i class="ss-pointdownright"></i><span class="icon-name">ss-pointdownright</span></li><li><i class="ss-pointdown"></i><span class="icon-name">ss-pointdown</span></li><li><i class="ss-pointdownleft"></i><span class="icon-name">ss-pointdownleft</span></li><li><i class="ss-pointleft"></i><span class="icon-name">ss-pointleft</span></li><li><i class="ss-pointupleft"></i><span class="icon-name">ss-pointupleft</span></li><li><i class="ss-cart"></i><span class="icon-name">ss-cart</span></li><li><i class="ss-creditcard"></i><span class="icon-name">ss-creditcard</span></li><li><i class="ss-calculator"></i><span class="icon-name">ss-calculator</span></li><li><i class="ss-barchart"></i><span class="icon-name">ss-barchart</span></li><li><i class="ss-piechart"></i><span class="icon-name">ss-piechart</span></li><li><i class="ss-box"></i><span class="icon-name">ss-box</span></li><li><i class="ss-home"></i><span class="icon-name">ss-home</span></li><li><i class="ss-globe"></i><span class="icon-name">ss-globe</span></li><li><i class="ss-navigate"></i><span class="icon-name">ss-navigate</span></li><li><i class="ss-compass"></i><span class="icon-name">ss-compass</span></li><li><i class="ss-signpost"></i><span class="icon-name">ss-signpost</span></li><li><i class="ss-location"></i><span class="icon-name">ss-location</span></li><li><i class="ss-floppydisk"></i><span class="icon-name">ss-floppydisk</span></li><li><i class="ss-database"></i><span class="icon-name">ss-database</span></li><li><i class="ss-hdd"></i><span class="icon-name">ss-hdd</span></li><li><i class="ss-microchip"></i><span class="icon-name">ss-microchip</span></li><li><i class="ss-music"></i><span class="icon-name">ss-music</span></li><li><i class="ss-headphones"></i><span class="icon-name">ss-headphones</span></li><li><i class="ss-discdrive"></i><span class="icon-name">ss-discdrive</span></li><li><i class="ss-volume"></i><span class="icon-name">ss-volume</span></li><li><i class="ss-lowvolume"></i><span class="icon-name">ss-lowvolume</span></li><li><i class="ss-mediumvolume"></i><span class="icon-name">ss-mediumvolume</span></li><li><i class="ss-highvolume"></i><span class="icon-name">ss-highvolume</span></li><li><i class="ss-airplay"></i><span class="icon-name">ss-airplay</span></li><li><i class="ss-camera"></i><span class="icon-name">ss-camera</span></li><li><i class="ss-picture"></i><span class="icon-name">ss-picture</span></li><li><i class="ss-video"></i><span class="icon-name">ss-video</span></li><li><i class="ss-webcam"></i><span class="icon-name">ss-webcam</span></li><li><i class="ss-film"></i><span class="icon-name">ss-film</span></li><li><i class="ss-playvideo"></i><span class="icon-name">ss-playvideo</span></li><li><i class="ss-videogame"></i><span class="icon-name">ss-videogame</span></li><li><i class="ss-play"></i><span class="icon-name">ss-play</span></li><li><i class="ss-pause"></i><span class="icon-name">ss-pause</span></li><li><i class="ss-stop"></i><span class="icon-name">ss-stop</span></li><li><i class="ss-record"></i><span class="icon-name">ss-record</span></li><li><i class="ss-rewind"></i><span class="icon-name">ss-rewind</span></li><li><i class="ss-fastforward"></i><span class="icon-name">ss-fastforward</span></li><li><i class="ss-skipback"></i><span class="icon-name">ss-skipback</span></li><li><i class="ss-skipforward"></i><span class="icon-name">ss-skipforward</span></li><li><i class="ss-eject"></i><span class="icon-name">ss-eject</span></li><li><i class="ss-repeat"></i><span class="icon-name">ss-repeat</span></li><li><i class="ss-replay"></i><span class="icon-name">ss-replay</span></li><li><i class="ss-shuffle"></i><span class="icon-name">ss-shuffle</span></li><li><i class="ss-index"></i><span class="icon-name">ss-index</span></li><li><i class="ss-storagebox"></i><span class="icon-name">ss-storagebox</span></li><li><i class="ss-book"></i><span class="icon-name">ss-book</span></li><li><i class="ss-notebook"></i><span class="icon-name">ss-notebook</span></li><li><i class="ss-newspaper"></i><span class="icon-name">ss-newspaper</span></li><li><i class="ss-gridlines"></i><span class="icon-name">ss-gridlines</span></li><li><i class="ss-rows"></i><span class="icon-name">ss-rows</span></li><li><i class="ss-columns"></i><span class="icon-name">ss-columns</span></li><li><i class="ss-thumbnails"></i><span class="icon-name">ss-thumbnails</span></li><li><i class="ss-mouse"></i><span class="icon-name">ss-mouse</span></li><li><i class="ss-usb"></i><span class="icon-name">ss-usb</span></li><li><i class="ss-desktop"></i><span class="icon-name">ss-desktop</span></li><li><i class="ss-laptop"></i><span class="icon-name">ss-laptop</span></li><li><i class="ss-tablet"></i><span class="icon-name">ss-tablet</span></li><li><i class="ss-smartphone"></i><span class="icon-name">ss-smartphone</span></li><li><i class="ss-cell"></i><span class="icon-name">ss-cell</span></li><li><i class="ss-battery"></i><span class="icon-name">ss-battery</span></li><li><i class="ss-highbattery"></i><span class="icon-name">ss-highbattery</span></li><li><i class="ss-mediumbattery"></i><span class="icon-name">ss-mediumbattery</span></li><li><i class="ss-lowbattery"></i><span class="icon-name">ss-lowbattery</span></li><li><i class="ss-chargingbattery"></i><span class="icon-name">ss-chargingbattery</span></li><li><i class="ss-lightbulb"></i><span class="icon-name">ss-lightbulb</span></li><li><i class="ss-washer"></i><span class="icon-name">ss-washer</span></li><li><i class="ss-downloadcloud"></i><span class="icon-name">ss-downloadcloud</span></li><li><i class="ss-download"></i><span class="icon-name">ss-download</span></li><li><i class="ss-downloadbox"></i><span class="icon-name">ss-downloadbox</span></li><li><i class="ss-uploadcloud"></i><span class="icon-name">ss-uploadcloud</span></li><li><i class="ss-upload"></i><span class="icon-name">ss-upload</span></li><li><i class="ss-uploadbox"></i><span class="icon-name">ss-uploadbox</span></li><li><i class="ss-fork"></i><span class="icon-name">ss-fork</span></li><li><i class="ss-merge"></i><span class="icon-name">ss-merge</span></li><li><i class="ss-refresh"></i><span class="icon-name">ss-refresh</span></li><li><i class="ss-sync"></i><span class="icon-name">ss-sync</span></li><li><i class="ss-loading"></i><span class="icon-name">ss-loading</span></li><li><i class="ss-file"></i><span class="icon-name">ss-file</span></li><li><i class="ss-files"></i><span class="icon-name">ss-files</span></li><li><i class="ss-addfile"></i><span class="icon-name">ss-addfile</span></li><li><i class="ss-removefile"></i><span class="icon-name">ss-removefile</span></li><li><i class="ss-checkfile"></i><span class="icon-name">ss-checkfile</span></li><li><i class="ss-deletefile"></i><span class="icon-name">ss-deletefile</span></li><li><i class="ss-exe"></i><span class="icon-name">ss-exe</span></li><li><i class="ss-zip"></i><span class="icon-name">ss-zip</span></li><li><i class="ss-doc"></i><span class="icon-name">ss-doc</span></li><li><i class="ss-pdf"></i><span class="icon-name">ss-pdf</span></li><li><i class="ss-jpg"></i><span class="icon-name">ss-jpg</span></li><li><i class="ss-png"></i><span class="icon-name">ss-png</span></li><li><i class="ss-mp3"></i><span class="icon-name">ss-mp3</span></li><li><i class="ss-rar"></i><span class="icon-name">ss-rar</span></li><li><i class="ss-gif"></i><span class="icon-name">ss-gif</span></li><li><i class="ss-folder"></i><span class="icon-name">ss-folder</span></li><li><i class="ss-openfolder"></i><span class="icon-name">ss-openfolder</span></li><li><i class="ss-downloadfolder"></i><span class="icon-name">ss-downloadfolder</span></li><li><i class="ss-uploadfolder"></i><span class="icon-name">ss-uploadfolder</span></li><li><i class="ss-quote"></i><span class="icon-name">ss-quote</span></li><li><i class="ss-unquote"></i><span class="icon-name">ss-unquote</span></li><li><i class="ss-print"></i><span class="icon-name">ss-print</span></li><li><i class="ss-copier"></i><span class="icon-name">ss-copier</span></li><li><i class="ss-fax"></i><span class="icon-name">ss-fax</span></li><li><i class="ss-scanner"></i><span class="icon-name">ss-scanner</span></li><li><i class="ss-printregistration"></i><span class="icon-name">ss-printregistration</span></li><li><i class="ss-shredder"></i><span class="icon-name">ss-shredder</span></li><li><i class="ss-expand"></i><span class="icon-name">ss-expand</span></li><li><i class="ss-contract"></i><span class="icon-name">ss-contract</span></li><li><i class="ss-help"></i><span class="icon-name">ss-help</span></li><li><i class="ss-info"></i><span class="icon-name">ss-info</span></li><li><i class="ss-alert"></i><span class="icon-name">ss-alert</span></li><li><i class="ss-caution"></i><span class="icon-name">ss-caution</span></li><li><i class="ss-logout"></i><span class="icon-name">ss-logout</span></li><li><i class="ss-login"></i><span class="icon-name">ss-login</span></li><li><i class="ss-scaleup"></i><span class="icon-name">ss-scaleup</span></li><li><i class="ss-scaledown"></i><span class="icon-name">ss-scaledown</span></li><li><i class="ss-plus"></i><span class="icon-name">ss-plus</span></li><li><i class="ss-hyphen"></i><span class="icon-name">ss-hyphen</span></li><li><i class="ss-check"></i><span class="icon-name">ss-check</span></li><li><i class="ss-delete"></i><span class="icon-name">ss-delete</span></li><li><i class="ss-notifications"></i><span class="icon-name">ss-notifications</span></li><li><i class="ss-notificationsdisabled"></i><span class="icon-name">ss-notificationsdisabled</span></li><li><i class="ss-clock"></i><span class="icon-name">ss-clock</span></li><li><i class="ss-stopwatch"></i><span class="icon-name">ss-stopwatch</span></li><li><i class="ss-alarmclock"></i><span class="icon-name">ss-alarmclock</span></li><li><i class="ss-egg"></i><span class="icon-name">ss-egg</span></li><li><i class="ss-eggs"></i><span class="icon-name">ss-eggs</span></li><li><i class="ss-cheese"></i><span class="icon-name">ss-cheese</span></li><li><i class="ss-chickenleg"></i><span class="icon-name">ss-chickenleg</span></li><li><i class="ss-pizzapie"></i><span class="icon-name">ss-pizzapie</span></li><li><i class="ss-pizza"></i><span class="icon-name">ss-pizza</span></li><li><i class="ss-cheesepizza"></i><span class="icon-name">ss-cheesepizza</span></li><li><i class="ss-frenchfries"></i><span class="icon-name">ss-frenchfries</span></li><li><i class="ss-apple"></i><span class="icon-name">ss-apple</span></li><li><i class="ss-carrot"></i><span class="icon-name">ss-carrot</span></li><li><i class="ss-broccoli"></i><span class="icon-name">ss-broccoli</span></li><li><i class="ss-cucumber"></i><span class="icon-name">ss-cucumber</span></li><li><i class="ss-orange"></i><span class="icon-name">ss-orange</span></li><li><i class="ss-lemon"></i><span class="icon-name">ss-lemon</span></li><li><i class="ss-onion"></i><span class="icon-name">ss-onion</span></li><li><i class="ss-bellpepper"></i><span class="icon-name">ss-bellpepper</span></li><li><i class="ss-peas"></i><span class="icon-name">ss-peas</span></li><li><i class="ss-grapes"></i><span class="icon-name">ss-grapes</span></li><li><i class="ss-strawberry"></i><span class="icon-name">ss-strawberry</span></li><li><i class="ss-bread"></i><span class="icon-name">ss-bread</span></li><li><i class="ss-mug"></i><span class="icon-name">ss-mug</span></li><li><i class="ss-mugs"></i><span class="icon-name">ss-mugs</span></li><li><i class="ss-espresso"></i><span class="icon-name">ss-espresso</span></li><li><i class="ss-macchiato"></i><span class="icon-name">ss-macchiato</span></li><li><i class="ss-cappucino"></i><span class="icon-name">ss-cappucino</span></li><li><i class="ss-latte"></i><span class="icon-name">ss-latte</span></li><li><i class="ss-icedcoffee"></i><span class="icon-name">ss-icedcoffee</span></li><li><i class="ss-coffeebean"></i><span class="icon-name">ss-coffeebean</span></li><li><i class="ss-coffeemilk"></i><span class="icon-name">ss-coffeemilk</span></li><li><i class="ss-coffeefoam"></i><span class="icon-name">ss-coffeefoam</span></li><li><i class="ss-coffeesugar"></i><span class="icon-name">ss-coffeesugar</span></li><li><i class="ss-sugarpackets"></i><span class="icon-name">ss-sugarpackets</span></li><li><i class="ss-capsule"></i><span class="icon-name">ss-capsule</span></li><li><i class="ss-capsulerecycling"></i><span class="icon-name">ss-capsulerecycling</span></li><li><i class="ss-insertcapsule"></i><span class="icon-name">ss-insertcapsule</span></li><li><i class="ss-tea"></i><span class="icon-name">ss-tea</span></li><li><i class="ss-teabag"></i><span class="icon-name">ss-teabag</span></li><li><i class="ss-jug"></i><span class="icon-name">ss-jug</span></li><li><i class="ss-pitcher"></i><span class="icon-name">ss-pitcher</span></li><li><i class="ss-kettle"></i><span class="icon-name">ss-kettle</span></li><li><i class="ss-wineglass"></i><span class="icon-name">ss-wineglass</span></li><li><i class="ss-sugar"></i><span class="icon-name">ss-sugar</span></li><li><i class="ss-oven"></i><span class="icon-name">ss-oven</span></li><li><i class="ss-stove"></i><span class="icon-name">ss-stove</span></li><li><i class="ss-vent"></i><span class="icon-name">ss-vent</span></li><li><i class="ss-exhaust"></i><span class="icon-name">ss-exhaust</span></li><li><i class="ss-steam"></i><span class="icon-name">ss-steam</span></li><li><i class="ss-dishwasher"></i><span class="icon-name">ss-dishwasher</span></li><li><i class="ss-toaster"></i><span class="icon-name">ss-toaster</span></li><li><i class="ss-microwave"></i><span class="icon-name">ss-microwave</span></li><li><i class="ss-electrickettle"></i><span class="icon-name">ss-electrickettle</span></li><li><i class="ss-refrigerator"></i><span class="icon-name">ss-refrigerator</span></li><li><i class="ss-freezer"></i><span class="icon-name">ss-freezer</span></li><li><i class="ss-utensils"></i><span class="icon-name">ss-utensils</span></li><li><i class="ss-cookingutensils"></i><span class="icon-name">ss-cookingutensils</span></li><li><i class="ss-whisk"></i><span class="icon-name">ss-whisk</span></li><li><i class="ss-pizzacutter"></i><span class="icon-name">ss-pizzacutter</span></li><li><i class="ss-measuringcup"></i><span class="icon-name">ss-measuringcup</span></li><li><i class="ss-colander"></i><span class="icon-name">ss-colander</span></li><li><i class="ss-eggtimer"></i><span class="icon-name">ss-eggtimer</span></li><li><i class="ss-platter"></i><span class="icon-name">ss-platter</span></li><li><i class="ss-plates"></i><span class="icon-name">ss-plates</span></li><li><i class="ss-steamplate"></i><span class="icon-name">ss-steamplate</span></li><li><i class="ss-cups"></i><span class="icon-name">ss-cups</span></li><li><i class="ss-steamglass"></i><span class="icon-name">ss-steamglass</span></li><li><i class="ss-pot"></i><span class="icon-name">ss-pot</span></li><li><i class="ss-steampot"></i><span class="icon-name">ss-steampot</span></li><li><i class="ss-chef"></i><span class="icon-name">ss-chef</span></li><li><i class="ss-weathervane"></i><span class="icon-name">ss-weathervane</span></li><li><i class="ss-thermometer"></i><span class="icon-name">ss-thermometer</span></li><li><i class="ss-thermometerup"></i><span class="icon-name">ss-thermometerup</span></li><li><i class="ss-thermometerdown"></i><span class="icon-name">ss-thermometerdown</span></li><li><i class="ss-droplet"></i><span class="icon-name">ss-droplet</span></li><li><i class="ss-sunrise"></i><span class="icon-name">ss-sunrise</span></li><li><i class="ss-sunset"></i><span class="icon-name">ss-sunset</span></li><li><i class="ss-sun"></i><span class="icon-name">ss-sun</span></li><li><i class="ss-cloud"></i><span class="icon-name">ss-cloud</span></li><li><i class="ss-clouds"></i><span class="icon-name">ss-clouds</span></li><li><i class="ss-partlycloudy"></i><span class="icon-name">ss-partlycloudy</span></li><li><i class="ss-rain"></i><span class="icon-name">ss-rain</span></li><li><i class="ss-rainheavy"></i><span class="icon-name">ss-rainheavy</span></li><li><i class="ss-lightning"></i><span class="icon-name">ss-lightning</span></li><li><i class="ss-thunderstorm"></i><span class="icon-name">ss-thunderstorm</span></li><li><i class="ss-umbrella"></i><span class="icon-name">ss-umbrella</span></li><li><i class="ss-rainumbrella"></i><span class="icon-name">ss-rainumbrella</span></li><li><i class="ss-rainbow"></i><span class="icon-name">ss-rainbow</span></li><li><i class="ss-rainbowclouds"></i><span class="icon-name">ss-rainbowclouds</span></li><li><i class="ss-fog"></i><span class="icon-name">ss-fog</span></li><li><i class="ss-wind"></i><span class="icon-name">ss-wind</span></li><li><i class="ss-tornado"></i><span class="icon-name">ss-tornado</span></li><li><i class="ss-snowflake"></i><span class="icon-name">ss-snowflake</span></li><li><i class="ss-snowcrystal"></i><span class="icon-name">ss-snowcrystal</span></li><li><i class="ss-lightsnow"></i><span class="icon-name">ss-lightsnow</span></li><li><i class="ss-snow"></i><span class="icon-name">ss-snow</span></li><li><i class="ss-heavysnow"></i><span class="icon-name">ss-heavysnow</span></li><li><i class="ss-hail"></i><span class="icon-name">ss-hail</span></li><li><i class="ss-crescentmoon"></i><span class="icon-name">ss-crescentmoon</span></li><li><i class="ss-waxingcrescentmoon"></i><span class="icon-name">ss-waxingcrescentmoon</span></li><li><i class="ss-firstquartermoon"></i><span class="icon-name">ss-firstquartermoon</span></li><li><i class="ss-waxinggibbousmoon"></i><span class="icon-name">ss-waxinggibbousmoon</span></li><li><i class="ss-waninggibbousmoon"></i><span class="icon-name">ss-waninggibbousmoon</span></li><li><i class="ss-lastquartermoon"></i><span class="icon-name">ss-lastquartermoon</span></li><li><i class="ss-waningcrescentmoon"></i><span class="icon-name">ss-waningcrescentmoon</span></li><li><i class="ss-fan"></i><span class="icon-name">ss-fan</span></li><li><i class="ss-bike"></i><span class="icon-name">ss-bike</span></li><li><i class="ss-wheelchair"></i><span class="icon-name">ss-wheelchair</span></li><li><i class="ss-briefcase"></i><span class="icon-name">ss-briefcase</span></li><li><i class="ss-hanger"></i><span class="icon-name">ss-hanger</span></li><li><i class="ss-comb"></i><span class="icon-name">ss-comb</span></li><li><i class="ss-medicalcross"></i><span class="icon-name">ss-medicalcross</span></li><li><i class="ss-up"></i><span class="icon-name">ss-up</span></li><li><i class="ss-upright"></i><span class="icon-name">ss-upright</span></li><li><i class="ss-right"></i><span class="icon-name">ss-right</span></li><li><i class="ss-downright"></i><span class="icon-name">ss-downright</span></li><li><i class="ss-down"></i><span class="icon-name">ss-down</span></li><li><i class="ss-downleft"></i><span class="icon-name">ss-downleft</span></li><li><i class="ss-left"></i><span class="icon-name">ss-left</span></li><li><i class="ss-upleft"></i><span class="icon-name">ss-upleft</span></li><li><i class="ss-navigateup"></i><span class="icon-name">ss-navigateup</span></li><li><i class="ss-navigateright"></i><span class="icon-name">ss-navigateright</span></li><li><i class="ss-navigatedown"></i><span class="icon-name">ss-navigatedown</span></li><li><i class="ss-navigateleft"></i><span class="icon-name">ss-navigateleft</span></li><li><i class="ss-retweet"></i><span class="icon-name">ss-retweet</span></li><li><i class="ss-share"></i><span class="icon-name">ss-share</span></li>';

			// IconMind
			$icon_mind_list = '<li><i class="sf-im-gear"></i><span class="icon-name">sf-im-gear</span></li><li><i class="sf-im-gears"></i><span class="icon-name">sf-im-gears</span></li><li><i class="sf-im-information"></i><span class="icon-name">sf-im-information</span></li><li><i class="sf-im-magnifi-glass-"></i><span class="icon-name">sf-im-magnifi-glass-</span></li><li><i class="sf-im-magnifi-glass"></i><span class="icon-name">sf-im-magnifi-glass</span></li><li><i class="sf-im-magnifi-glass2"></i><span class="icon-name">sf-im-magnifi-glass2</span></li><li><i class="sf-im-preview"></i><span class="icon-name">sf-im-preview</span></li><li><i class="sf-im-pricing"></i><span class="icon-name">sf-im-pricing</span></li><li><i class="sf-im-repair"></i><span class="icon-name">sf-im-repair</span></li><li><i class="sf-im-support"></i><span class="icon-name">sf-im-support</span></li><li><i class="sf-im-user"></i><span class="icon-name">sf-im-user</span></li><li><i class="sf-im-equalizer"></i><span class="icon-name">sf-im-equalizer</span></li><li><i class="sf-im-microphone-2"></i><span class="icon-name">sf-im-microphone-2</span></li><li><i class="sf-im-rock-androll"></i><span class="icon-name">sf-im-rock-androll</span></li><li><i class="sf-im-sound-wave"></i><span class="icon-name">sf-im-sound-wave</span></li><li><i class="sf-im-close-window"></i><span class="icon-name">sf-im-close-window</span></li><li><i class="sf-im-network-window"></i><span class="icon-name">sf-im-network-window</span></li><li><i class="sf-im-settings-window"></i><span class="icon-name">sf-im-settings-window</span></li><li><i class="sf-im-two-windows"></i><span class="icon-name">sf-im-two-windows</span></li><li><i class="sf-im-upload-window"></i><span class="icon-name">sf-im-upload-window</span></li><li><i class="sf-im-url-window"></i><span class="icon-name">sf-im-url-window</span></li><li><i class="sf-im-width-window"></i><span class="icon-name">sf-im-width-window</span></li><li><i class="sf-im-windows-2"></i><span class="icon-name">sf-im-windows-2</span></li><li><i class="sf-im-drop"></i><span class="icon-name">sf-im-drop</span></li><li><i class="sf-im-clapperboard-open"></i><span class="icon-name">sf-im-clapperboard-open</span></li><li><i class="sf-im-video-3"></i><span class="icon-name">sf-im-video-3</span></li><li><i class="sf-im-hand-touch2"></i><span class="icon-name">sf-im-hand-touch2</span></li><li><i class="sf-im-thumb"></i><span class="icon-name">sf-im-thumb</span></li><li><i class="sf-im-clock"></i><span class="icon-name">sf-im-clock</span></li><li><i class="sf-im-watch"></i><span class="icon-name">sf-im-watch</span></li><li><i class="sf-im-normal-text"></i><span class="icon-name">sf-im-normal-text</span></li><li><i class="sf-im-text-box"></i><span class="icon-name">sf-im-text-box</span></li><li><i class="sf-im-text-effect"></i><span class="icon-name">sf-im-text-effect</span></li><li><i class="sf-im-archery-2"></i><span class="icon-name">sf-im-archery-2</span></li><li><i class="sf-im-medal-3"></i><span class="icon-name">sf-im-medal-3</span></li><li><i class="sf-im-skate-shoes"></i><span class="icon-name">sf-im-skate-shoes</span></li><li><i class="sf-im-trophy"></i><span class="icon-name">sf-im-trophy</span></li><li><i class="sf-im-speach-bubbleasking"></i><span class="icon-name">sf-im-speach-bubbleasking</span></li><li><i class="sf-im-speach-bubbledialog"></i><span class="icon-name">sf-im-speach-bubbledialog</span></li><li><i class="sf-im-inifity"></i><span class="icon-name">sf-im-inifity</span></li><li><i class="sf-im-quotes"></i><span class="icon-name">sf-im-quotes</span></li><li><i class="sf-im-ribbon"></i><span class="icon-name">sf-im-ribbon</span></li><li><i class="sf-im-venn-diagram"></i><span class="icon-name">sf-im-venn-diagram</span></li><li><i class="sf-im-car-coins"></i><span class="icon-name">sf-im-car-coins</span></li><li><i class="sf-im-cash-register2"></i><span class="icon-name">sf-im-cash-register2</span></li><li><i class="sf-im-password-shopping"></i><span class="icon-name">sf-im-password-shopping</span></li><li><i class="sf-im-tag-5"></i><span class="icon-name">sf-im-tag-5</span></li><li><i class="sf-im-coding"></i><span class="icon-name">sf-im-coding</span></li><li><i class="sf-im-consulting"></i><span class="icon-name">sf-im-consulting</span></li><li><i class="sf-im-testimonal"></i><span class="icon-name">sf-im-testimonal</span></li><li><i class="sf-im-lock-2"></i><span class="icon-name">sf-im-lock-2</span></li><li><i class="sf-im-unlock-2"></i><span class="icon-name">sf-im-unlock-2</span></li><li><i class="sf-im-atom"></i><span class="icon-name">sf-im-atom</span></li><li><i class="sf-im-chemical"></i><span class="icon-name">sf-im-chemical</span></li><li><i class="sf-im-plaster"></i><span class="icon-name">sf-im-plaster</span></li><li><i class="sf-im-camera-2"></i><span class="icon-name">sf-im-camera-2</span></li><li><i class="sf-im-flash-2"></i><span class="icon-name">sf-im-flash-2</span></li><li><i class="sf-im-photo"></i><span class="icon-name">sf-im-photo</span></li><li><i class="sf-im-photos"></i><span class="icon-name">sf-im-photos</span></li><li><i class="sf-im-sport-mode"></i><span class="icon-name">sf-im-sport-mode</span></li><li><i class="sf-im-business-man"></i><span class="icon-name">sf-im-business-man</span></li><li><i class="sf-im-business-woman"></i><span class="icon-name">sf-im-business-woman</span></li><li><i class="sf-im-speak-2"></i><span class="icon-name">sf-im-speak-2</span></li><li><i class="sf-im-talk-man"></i><span class="icon-name">sf-im-talk-man</span></li><li><i class="sf-im-chair"></i><span class="icon-name">sf-im-chair</span></li><li><i class="sf-im-footprint"></i><span class="icon-name">sf-im-footprint</span></li><li><i class="sf-im-gift-box"></i><span class="icon-name">sf-im-gift-box</span></li><li><i class="sf-im-key"></i><span class="icon-name">sf-im-key</span></li><li><i class="sf-im-light-bulb"></i><span class="icon-name">sf-im-light-bulb</span></li><li><i class="sf-im-luggage-2"></i><span class="icon-name">sf-im-luggage-2</span></li><li><i class="sf-im-paper-plane"></i><span class="icon-name">sf-im-paper-plane</span></li><li><i class="sf-im-environmental-3"></i><span class="icon-name">sf-im-environmental-3</span></li><li><i class="sf-im-compass-4"></i><span class="icon-name">sf-im-compass-4</span></li><li><i class="sf-im-globe"></i><span class="icon-name">sf-im-globe</span></li><li><i class="sf-im-map-marker"></i><span class="icon-name">sf-im-map-marker</span></li><li><i class="sf-im-map2"></i><span class="icon-name">sf-im-map2</span></li><li><i class="sf-im-satelite-2"></i><span class="icon-name">sf-im-satelite-2</span></li><li><i class="sf-im-add"></i><span class="icon-name">sf-im-add</span></li><li><i class="sf-im-close"></i><span class="icon-name">sf-im-close</span></li><li><i class="sf-im-cursor-click2"></i><span class="icon-name">sf-im-cursor-click2</span></li><li><i class="sf-im-download-2"></i><span class="icon-name">sf-im-download-2</span></li><li><i class="sf-im-link"></i><span class="icon-name">sf-im-link</span></li><li><i class="sf-im-upload-2"></i><span class="icon-name">sf-im-upload-2</span></li><li><i class="sf-im-yes"></i><span class="icon-name">sf-im-yes</span></li><li><i class="sf-im-old-camera"></i><span class="icon-name">sf-im-old-camera</span></li><li><i class="sf-im-mouse-4"></i><span class="icon-name">sf-im-mouse-4</span></li><li><i class="sf-im-coffee"></i><span class="icon-name">sf-im-coffee</span></li><li><i class="sf-im-doughnut"></i><span class="icon-name">sf-im-doughnut</span></li><li><i class="sf-im-glass-water"></i><span class="icon-name">sf-im-glass-water</span></li><li><i class="sf-im-hot-dog"></i><span class="icon-name">sf-im-hot-dog</span></li><li><i class="sf-im-juice"></i><span class="icon-name">sf-im-juice</span></li><li><i class="sf-im-pizza-slice"></i><span class="icon-name">sf-im-pizza-slice</span></li><li><i class="sf-im-pizza"></i><span class="icon-name">sf-im-pizza</span></li><li><i class="sf-im-wine-glass"></i><span class="icon-name">sf-im-wine-glass</span></li><li><i class="sf-im-box-open"></i><span class="icon-name">sf-im-box-open</span></li><li><i class="sf-im-box-withfolders"></i><span class="icon-name">sf-im-box-withfolders</span></li><li><i class="sf-im-add-file"></i><span class="icon-name">sf-im-add-file</span></li><li><i class="sf-im-delete-file"></i><span class="icon-name">sf-im-delete-file</span></li><li><i class="sf-im-file-download"></i><span class="icon-name">sf-im-file-download</span></li><li><i class="sf-im-file-horizontaltext"></i><span class="icon-name">sf-im-file-horizontaltext</span></li><li><i class="sf-im-file-link"></i><span class="icon-name">sf-im-file-link</span></li><li><i class="sf-im-file-love"></i><span class="icon-name">sf-im-file-love</span></li><li><i class="sf-im-file-pictures"></i><span class="icon-name">sf-im-file-pictures</span></li><li><i class="sf-im-file-zip"></i><span class="icon-name">sf-im-file-zip</span></li><li><i class="sf-im-files"></i><span class="icon-name">sf-im-files</span></li><li><i class="sf-im-remove-file"></i><span class="icon-name">sf-im-remove-file</span></li><li><i class="sf-im-thumbs-upsmiley"></i><span class="icon-name">sf-im-thumbs-upsmiley</span></li><li><i class="sf-im-letter-open"></i><span class="icon-name">sf-im-letter-open</span></li><li><i class="sf-im-mail"></i><span class="icon-name">sf-im-mail</span></li><li><i class="sf-im-mailbox-full"></i><span class="icon-name">sf-im-mailbox-full</span></li><li><i class="sf-im-notepad"></i><span class="icon-name">sf-im-notepad</span></li><li><i class="sf-im-computer"></i><span class="icon-name">sf-im-computer</span></li><li><i class="sf-im-laptop"></i><span class="icon-name">sf-im-laptop</span></li><li><i class="sf-im-monitor-2"></i><span class="icon-name">sf-im-monitor-2</span></li><li><i class="sf-im-monitor-5"></i><span class="icon-name">sf-im-monitor-5</span></li><li><i class="sf-im-monitor-phone"></i><span class="icon-name">sf-im-monitor-phone</span></li><li><i class="sf-im-phone-2"></i><span class="icon-name">sf-im-phone-2</span></li><li><i class="sf-im-smartphone-4"></i><span class="icon-name">sf-im-smartphone-4</span></li><li><i class="sf-im-tablet-3"></i><span class="icon-name">sf-im-tablet-3</span></li><li><i class="sf-im-aa"></i><span class="icon-name">sf-im-aa</span></li><li><i class="sf-im-brush"></i><span class="icon-name">sf-im-brush</span></li><li><i class="sf-im-fountain-pen"></i><span class="icon-name">sf-im-fountain-pen</span></li><li><i class="sf-im-idea"></i><span class="icon-name">sf-im-idea</span></li><li><i class="sf-im-marker"></i><span class="icon-name">sf-im-marker</span></li><li><i class="sf-im-note"></i><span class="icon-name">sf-im-note</span></li><li><i class="sf-im-pantone"></i><span class="icon-name">sf-im-pantone</span></li><li><i class="sf-im-pencil"></i><span class="icon-name">sf-im-pencil</span></li><li><i class="sf-im-scissor"></i><span class="icon-name">sf-im-scissor</span></li><li><i class="sf-im-vector-3"></i><span class="icon-name">sf-im-vector-3</span></li><li><i class="sf-im-address-book"></i><span class="icon-name">sf-im-address-book</span></li><li><i class="sf-im-megaphone"></i><span class="icon-name">sf-im-megaphone</span></li><li><i class="sf-im-newspaper"></i><span class="icon-name">sf-im-newspaper</span></li><li><i class="sf-im-wifi"></i><span class="icon-name">sf-im-wifi</span></li><li><i class="sf-im-download-fromcloud"></i><span class="icon-name">sf-im-download-fromcloud</span></li><li><i class="sf-im-upload-tocloud"></i><span class="icon-name">sf-im-upload-tocloud</span></li><li><i class="sf-im-blouse"></i><span class="icon-name">sf-im-blouse</span></li><li><i class="sf-im-boot"></i><span class="icon-name">sf-im-boot</span></li><li><i class="sf-im-bow-2"></i><span class="icon-name">sf-im-bow-2</span></li><li><i class="sf-im-bra"></i><span class="icon-name">sf-im-bra</span></li><li><i class="sf-im-cap"></i><span class="icon-name">sf-im-cap</span></li><li><i class="sf-im-coat"></i><span class="icon-name">sf-im-coat</span></li><li><i class="sf-im-dress"></i><span class="icon-name">sf-im-dress</span></li><li><i class="sf-im-hanger"></i><span class="icon-name">sf-im-hanger</span></li><li><i class="sf-im-heels"></i><span class="icon-name">sf-im-heels</span></li><li><i class="sf-im-jacket"></i><span class="icon-name">sf-im-jacket</span></li><li><i class="sf-im-jeans"></i><span class="icon-name">sf-im-jeans</span></li><li><i class="sf-im-shirt"></i><span class="icon-name">sf-im-shirt</span></li><li><i class="sf-im-suit"></i><span class="icon-name">sf-im-suit</span></li><li><i class="sf-im-sunglasses-w3"></i><span class="icon-name">sf-im-sunglasses-w3</span></li><li><i class="sf-im-t-shirt"></i><span class="icon-name">sf-im-t-shirt</span></li><li><i class="sf-im-present"></i><span class="icon-name">sf-im-present</span></li><li><i class="sf-im-tactic"></i><span class="icon-name">sf-im-tactic</span></li><li><i class="sf-im-bar-chart3"></i><span class="icon-name">sf-im-bar-chart3</span></li><li><i class="sf-im-calculator-2"></i><span class="icon-name">sf-im-calculator-2</span></li><li><i class="sf-im-calendar-4"></i><span class="icon-name">sf-im-calendar-4</span></li><li><i class="sf-im-credit-card2"></i><span class="icon-name">sf-im-credit-card2</span></li><li><i class="sf-im-diamond"></i><span class="icon-name">sf-im-diamond</span></li><li><i class="sf-im-financial"></i><span class="icon-name">sf-im-financial</span></li><li><i class="sf-im-handshake"></i><span class="icon-name">sf-im-handshake</span></li><li><i class="sf-im-line-chart4"></i><span class="icon-name">sf-im-line-chart4</span></li><li><i class="sf-im-money-2"></i><span class="icon-name">sf-im-money-2</span></li><li><i class="sf-im-pie-chart3"></i><span class="icon-name">sf-im-pie-chart3</span></li><li><i class="sf-im-home"></i><span class="icon-name">sf-im-home</span></li><li><i class="sf-im-bones"></i><span class="icon-name">sf-im-bones</span></li><li><i class="sf-im-brain"></i><span class="icon-name">sf-im-brain</span></li><li><i class="sf-im-ear"></i><span class="icon-name">sf-im-ear</span></li><li><i class="sf-im-eye-visible"></i><span class="icon-name">sf-im-eye-visible</span></li><li><i class="sf-im-face-style"></i><span class="icon-name">sf-im-face-style</span></li><li><i class="sf-im-fingerprint-2"></i><span class="icon-name">sf-im-fingerprint-2</span></li><li><i class="sf-im-heart"></i><span class="icon-name">sf-im-heart</span></li><li><i class="sf-im-arrow-downincircle"></i><span class="icon-name">sf-im-arrow-downincircle</span></li><li><i class="sf-im-arrow-left"></i><span class="icon-name">sf-im-arrow-left</span></li><li><i class="sf-im-arrow-right"></i><span class="icon-name">sf-im-arrow-right</span></li><li><i class="sf-im-arrow-up"></i><span class="icon-name">sf-im-arrow-up</span></li><li><i class="sf-im-download"></i><span class="icon-name">sf-im-download</span></li><li><i class="sf-im-fit-to"></i><span class="icon-name">sf-im-fit-to</span></li><li><i class="sf-im-full-screen"></i><span class="icon-name">sf-im-full-screen</span></li><li><i class="sf-im-full-screen2"></i><span class="icon-name">sf-im-full-screen2</span></li><li><i class="sf-im-left"></i><span class="icon-name">sf-im-left</span></li><li><i class="sf-im-repeat-2"></i><span class="icon-name">sf-im-repeat-2</span></li><li><i class="sf-im-right"></i><span class="icon-name">sf-im-right</span></li><li><i class="sf-im-up"></i><span class="icon-name">sf-im-up</span></li><li><i class="sf-im-upload"></i><span class="icon-name">sf-im-upload</span></li><li><i class="sf-im-arrow-around"></i><span class="icon-name">sf-im-arrow-around</span></li><li><i class="sf-im-arrow-loop"></i><span class="icon-name">sf-im-arrow-loop</span></li><li><i class="sf-im-arrow-outleft"></i><span class="icon-name">sf-im-arrow-outleft</span></li><li><i class="sf-im-arrow-outright"></i><span class="icon-name">sf-im-arrow-outright</span></li><li><i class="sf-im-arrow-shuffle"></i><span class="icon-name">sf-im-arrow-shuffle</span></li><li><i class="sf-im-maximize"></i><span class="icon-name">sf-im-maximize</span></li><li><i class="sf-im-minimize"></i><span class="icon-name">sf-im-minimize</span></li><li><i class="sf-im-resize"></i><span class="icon-name">sf-im-resize</span></li><li><i class="sf-im-bird"></i><span class="icon-name">sf-im-bird</span></li><li><i class="sf-im-cat"></i><span class="icon-name">sf-im-cat</span></li><li><i class="sf-im-dog"></i><span class="icon-name">sf-im-dog</span></li><li><i class="sf-im-align-center"></i><span class="icon-name">sf-im-align-center</span></li><li><i class="sf-im-align-left"></i><span class="icon-name">sf-im-align-left</span></li><li><i class="sf-im-align-right"></i><span class="icon-name">sf-im-align-right</span></li>';
			
			
			// NUCLEO INTERFACE
			$nucleo_interface = array(
				'e910' => 'sf-icon-audio-player', 
				'e911' => 'sf-icon-video-player', 
				'e95c' => 'sf-icon-fail', 
				'e95d' => 'sf-icon-success', 
				'e960' => 'sf-icon-video-player-fill', 
				'e952' => 'sf-icon-settings', 
				'e912' => 'sf-icon-lightbox', 
				'e951' => 'sf-icon-portfolio', 
				'e913' => 'sf-icon-external-link-big', 
				'e914' => 'sf-icon-text-big', 
				'e95a' => 'sf-icon-video-big', 
				'e956' => 'sf-icon-down-arrow-big', 
				'e955' => 'sf-icon-up-arrow-big', 
				'e954' => 'sf-icon-left-arrow-big', 
				'e915' => 'sf-icon-right-arrow-big', 
				'e916' => 'sf-icon-flags-france', 
				'e917' => 'sf-icon-flags-germany', 
				'e918' => 'sf-icon-flags-greece', 
				'e919' => 'sf-icon-flags-italy', 
				'e91a' => 'sf-icon-flags-japan', 
				'e91b' => 'sf-icon-flags-netherlands', 
				'e91c' => 'icon-russia', 
				'e94b' => 'sf-icon-flags-sweden', 
				'e94c' => 'sf-icon-flags-portugal', 
				'e94d' => 'sf-icon-flags-spain', 
				'e94e' => 'sf-icon-flags-usa', 
				'e94f' => 'sf-icon-flags-uk', 
				'e953' => 'sf-icon-quote-big', 
				'e962' => 'sf-icon-loader', 
				'e964' => 'sf-icon-loader-gap', 
				'e965' => 'sf-icon-dollar', 
				'e966' => 'sf-icon-euro', 
				'e967' => 'sf-icon-pound', 
				'e968' => 'sf-icon-yen', 
				'e961' => 'sf-icon-checkout', 
				'10ffff' => 'sf-icon-variable', 
				'e003' => 'sf-icon-preferences', 
				'e90d' => 'sf-icon-quote', 
				'e900' => 'sf-icon-download', 
				'e901' => 'sf-icon-enlarge', 
				'e902' => 'sf-icon-down-triangle', 
				'e903' => 'sf-icon-up-triangle', 
				'e904' => 'sf-icon-left-arrow', 
				'e905' => 'sf-icon-right-arrow', 
				'e906' => 'sf-icon-left-chevron', 
				'e907' => 'sf-icon-right-chevron', 
				'e908' => 'sf-icon-down-chevron', 
				'e909' => 'sf-icon-up-chevron', 
				'e90a' => 'sf-icon-read-more', 
				'e90b' => 'sf-icon-share', 
				'e0101' => 'sf-icon-node', 
				'e90c' => 'sf-icon-project', 
				'e004' => 'sf-icon-speech', 
				'e90e' => 'sf-icon-archive', 
				'e90f' => 'sf-icon-like', 
				'e91d' => 'sf-icon-pause', 
				'e91e' => 'sf-icon-play', 
				'e91f' => 'sf-icon-image', 
				'e920' => 'sf-icon-gallery', 
				'e921' => 'sf-icon-volume', 
				'e922' => 'sf-icon-audio', 
				'e923' => 'sf-icon-cart', 
				'e924' => 'sf-icon-categories', 
				'e925' => 'sf-icon-tags', 
				'e926' => 'sf-icon-dribbble', 
				'e927' => 'sf-icon-fb', 
				'e928' => 'sf-icon-instagram', 
				'e929' => 'sf-icon-twitter', 
				'e92a' => 'sf-icon-video', 
				'e92b' => 'sf-icon-check', 
				'e92c' => 'sf-icon-subject', 
				'e92d' => 'sf-icon-reply', 
				'e95f' => 'sf-icon-menu-chevron-right', 
				'e92f' => 'sf-icon-quickview', 
				'e005' => 'sf-icon-noview', 
				'e930' => 'sf-icon-filter', 
				'e931' => 'sf-icon-add-big', 
				'e932' => 'sf-icon-remove-big', 
				'e933' => 'sf-icon-trash', 
				'e934' => 'sf-icon-supersearch', 
				'e935' => 'sf-icon-search', 
				'e936' => 'sf-icon-warning', 
				'e937' => 'sf-icon-question', 
				'e938' => 'sf-icon-info', 
				'e939' => 'sf-icon-sort', 
				'e93a' => 'sf-icon-comments', 
				'e93b' => 'sf-icon-wishlist', 
				'e93c' => 'sf-icon-star-fill', 
				'e93d' => 'sf-icon-view-default', 
				'e93e' => 'sf-icon-view-gallery', 
				'e93f' => 'sf-icon-external-link', 
				'e940' => 'sf-icon-menu', 
				'e941' => 'sf-icon-text', 
				'e942' => 'sf-icon-view-list', 
				'e943' => 'sf-icon-add', 
				'e944' => 'sf-icon-delete', 
				'e945' => 'sf-icon-remove', 
				'e946' => 'sf-icon-date', 
				'e947' => 'sf-icon-star-stroke', 
				'e948' => 'sf-icon-half-star', 
				'e949' => 'sf-icon-account', 
				'e94a' => 'sf-icon-name', 
				'e950' => 'sf-icon-sticky-post', 
				'e957' => 'sf-icon-phone', 
				'e958' => 'sf-icon-down-arrow', 
				'e959' => 'sf-icon-up-arrow', 
				'e95b' => 'sf-icon-tick', 
				'e95e' => 'sf-icon-menu-chevron', 
				'e92e' => 'sf-icon-email',
			);
			
			// NUCLEO GENERAL
			$nucleo_general = array(
				'e97d' => 'nucleo-icon-add', 
				'e983' => 'nucleo-icon-alert-help', 
				'e984' => 'nucleo-icon-alert-info', 
				'e99a' => 'nucleo-icon-alert-square', 
				'e982' => 'nucleo-icon-alert-warning', 
				'e957' => 'nucleo-icon-anchor', 
				'e922' => 'nucleo-icon-app', 
				'e985' => 'nucleo-icon-archive', 
				'e934' => 'nucleo-icon-archive-content', 
				'e90f' => 'nucleo-icon-arrow-circle-right', 
				'e907' => 'nucleo-icon-arrow-left', 
				'e908' => 'nucleo-icon-arrow-right', 
				'e90e' => 'nucleo-icon-arrow-square-right', 
				'e909' => 'nucleo-icon-arrow-up', 
				'e975' => 'nucleo-icon-attach', 
				'e913' => 'nucleo-icon-award', 
				'e914' => 'nucleo-icon-badge', 
				'e95c' => 'nucleo-icon-bag', 
				'e95d' => 'nucleo-icon-bag-add', 
				'e95e' => 'nucleo-icon-bag-remove', 
				'e917' => 'nucleo-icon-barchart', 
				'e976' => 'nucleo-icon-bell', 
				'e92f' => 'nucleo-icon-board', 
				'e915' => 'nucleo-icon-briefcase', 
				'e94c' => 'nucleo-icon-brightness', 
				'e923' => 'nucleo-icon-brush', 
				'e916' => 'nucleo-icon-bulb', 
				'e94d' => 'nucleo-icon-camera', 
				'e971' => 'nucleo-icon-capitalize', 
				'e988' => 'nucleo-icon-chat-fill', 
				'e987' => 'nucleo-icon-chat-stroke', 
				'e979' => 'nucleo-icon-check', 
				'e977' => 'nucleo-icon-check-small', 
				'e978' => 'nucleo-icon-check-square', 
				'e919' => 'nucleo-icon-cheque', 
				'e90c' => 'nucleo-icon-chevron-down', 
				'e90a' => 'nucleo-icon-chevron-left', 
				'e90b' => 'nucleo-icon-chevron-right', 
				'e90d' => 'nucleo-icon-chevron-up', 
				'e999' => 'nucleo-icon-clock', 
				'e900' => 'nucleo-icon-cloud-download', 
				'e9a3' => 'nucleo-icon-cloud-fog', 
				'e9a4' => 'nucleo-icon-cloud-hail', 
				'e9a5' => 'nucleo-icon-cloud-light', 
				'e901' => 'nucleo-icon-cloud-upload', 
				'e939' => 'nucleo-icon-coffee', 
				'e924' => 'nucleo-icon-command', 
				'e94e' => 'nucleo-icon-countdown', 
				'e95f' => 'nucleo-icon-credit-card', 
				'e925' => 'nucleo-icon-crop', 
				'e93a' => 'nucleo-icon-cutlery', 
				'e960' => 'nucleo-icon-delivery', 
				'e926' => 'nucleo-icon-design', 
				'e965' => 'nucleo-icon-desktop', 
				'e989' => 'nucleo-icon-disk', 
				'e932' => 'nucleo-icon-dislike', 
				'e91a' => 'nucleo-icon-dollar', 
				'e902' => 'nucleo-icon-download', 
				'e93b' => 'nucleo-icon-drag', 
				'e97a' => 'nucleo-icon-edit-box', 
				'e927' => 'nucleo-icon-eraser', 
				'e91b' => 'nucleo-icon-euro', 
				'e97b' => 'nucleo-icon-eye', 
				'e937' => 'nucleo-icon-file', 
				'e936' => 'nucleo-icon-file-blank', 
				'e938' => 'nucleo-icon-files', 
				'e97c' => 'nucleo-icon-filter', 
				'e945' => 'nucleo-icon-flag', 
				'e944' => 'nucleo-icon-flag-diagonal', 
				'e963' => 'nucleo-icon-flag-finish', 
				'e94f' => 'nucleo-icon-flash', 
				'e935' => 'nucleo-icon-folder', 
				'e950' => 'nucleo-icon-frame', 
				'e903' => 'nucleo-icon-fullscreen', 
				'e93c' => 'nucleo-icon-gestures', 
				'e961' => 'nucleo-icon-gift', 
				'e958' => 'nucleo-icon-globe', 
				'e91f' => 'nucleo-icon-goal', 
				'e949' => 'nucleo-icon-gps', 
				'e98c' => 'nucleo-icon-grid', 
				'e98d' => 'nucleo-icon-grid-small', 
				'e991' => 'nucleo-icon-hamburger', 
				'e966' => 'nucleo-icon-headphones', 
				'e98a' => 'nucleo-icon-heart', 
				'e941' => 'nucleo-icon-heartbeat', 
				'e99b' => 'nucleo-icon-help-square', 
				'e920' => 'nucleo-icon-hierarchy', 
				'e951' => 'nucleo-icon-image', 
				'e99c' => 'nucleo-icon-info-square', 
				'e959' => 'nucleo-icon-key', 
				'e98e' => 'nucleo-icon-lab', 
				'e967' => 'nucleo-icon-laptop', 
				'e952' => 'nucleo-icon-layers', 
				'e933' => 'nucleo-icon-like', 
				'e98f' => 'nucleo-icon-link', 
				'e990' => 'nucleo-icon-link-broken', 
				'e973' => 'nucleo-icon-list-bullet', 
				'e946' => 'nucleo-icon-map', 
				'e92e' => 'nucleo-icon-medal', 
				'e992' => 'nucleo-icon-menu', 
				'e94b' => 'nucleo-icon-mic', 
				'e929' => 'nucleo-icon-mouse', 
				'e969' => 'nucleo-icon-navigation', 
				'e956' => 'nucleo-icon-note', 
				'e92a' => 'nucleo-icon-paint', 
				'e931' => 'nucleo-icon-paper', 
				'e993' => 'nucleo-icon-paragraph', 
				'e92b' => 'nucleo-icon-copy', 
				'e92c' => 'nucleo-icon-pen', 
				'e92d' => 'nucleo-icon-phone', 
				'e918' => 'nucleo-icon-piechart', 
				'e947' => 'nucleo-icon-pin', 
				'e93d' => 'nucleo-icon-pinch', 
				'e953' => 'nucleo-icon-player', 
				'e921' => 'nucleo-icon-plug', 
				'e91c' => 'nucleo-icon-pound', 
				'e96b' => 'nucleo-icon-print', 
				'e942' => 'nucleo-icon-pulse', 
				'e974' => 'nucleo-icon-quote', 
				'e911' => 'nucleo-icon-refresh', 
				'e97e' => 'nucleo-icon-remove', 
				'e93e' => 'nucleo-icon-rotate', 
				'e994' => 'nucleo-icon-share', 
				'e912' => 'nucleo-icon-share-diagnol', 
				'e905' => 'nucleo-icon-share-right', 
				'e904' => 'nucleo-icon-share-up', 
				'e906' => 'nucleo-icon-shuffle', 
				'e986' => 'nucleo-icon-signal', 
				'e995' => 'nucleo-icon-small-add', 
				'e996' => 'nucleo-icon-small-delete', 
				'e997' => 'nucleo-icon-small-remove', 
				'e95a' => 'nucleo-icon-spaceship', 
				'e930' => 'nucleo-icon-speech', 
				'e98b' => 'nucleo-icon-star', 
				'e943' => 'nucleo-icon-steps', 
				'e93f' => 'nucleo-icon-stretch', 
				'e95b' => 'nucleo-icon-support', 
				'e96c' => 'nucleo-icon-tablet', 
				'e96d' => 'nucleo-icon-tablet-reader', 
				'e962' => 'nucleo-icon-tag', 
				'e940' => 'nucleo-icon-tap', 
				'e9a1' => 'nucleo-icon-team', 
				'e972' => 'nucleo-icon-text', 
				'e998' => 'nucleo-icon-tile', 
				'e97f' => 'nucleo-icon-trash', 
				'e96e' => 'nucleo-icon-tv', 
				'e910' => 'nucleo-icon-undo', 
				'e9a2' => 'nucleo-icon-user', 
				'e964' => 'nucleo-icon-user-run', 
				'e99d' => 'nucleo-icon-users-add', 
				'e99e' => 'nucleo-icon-users-badge', 
				'e99f' => 'nucleo-icon-users-circle', 
				'e9a0' => 'nucleo-icon-users-delete', 
				'e954' => 'nucleo-icon-video', 
				'e96f' => 'nucleo-icon-watch', 
				'e970' => 'nucleo-icon-wifi', 
				'e948' => 'nucleo-icon-world', 
				'e91d' => 'nucleo-icon-yen', 
				'e981' => 'nucleo-icon-zoom', 
				'e980' => 'nucleo-icon-zoom-in', 
			);
			
			
            // OUTPUT
            if ( $type == "font-awesome" || $type == "" ) {
                $icon_list .= sf_icon_format_output( $fontawesome, "font-awesome", $format );
            }
            if ( sf_theme_supports('gizmo-icon-font') && ($type == "gizmo" || $type == "") ) {
                $icon_list .= $gizmo_list;
            }
            if ( sf_theme_supports('icon-mind-font') && ($type == "icon-mind" || $type == "") ) {
                $icon_list .= $icon_mind_list;
            }
            if ( sf_theme_supports('nucleo-interface-font') && ($type == "nucleo-interface" || $type == "") ) {
                $icon_list .= sf_icon_format_output( $nucleo_interface, "nucleo-interface", $format );
            }
            if ( sf_theme_supports('nucleo-general-font') && ($type == "nucleo-general" || $type == "") ) {
                $icon_list .= sf_icon_format_output( $nucleo_general, "nucleo-general", $format );
            }
            
//            if ( $type == "fontello" || $type == "" ) {
//	            $fontello_icons = get_option('sf_fontello_icon_codes');
//	            
//	            if ( $fontello_icons ) {
//		            $fontello_list = '';
//			
//		            foreach ( $fontello_icons as $icon) {
//		                $fontello_list .= '<li><i class="icon-' . $icon . '"></i><span class="icon-name">' . $icon . '</span></li>';
//		            }
//		      
//		            $icon_list .= $fontello_list;
//				}
//			}
			
            // APPLY FILTERS
            $icon_list = apply_filters( 'sf_icons_list', $icon_list );

            return $icon_list;
        }
    }
    
    /* ICON FORMAT OUTPUT
    ================================================== */
    if ( ! function_exists( 'sf_icon_format_output' ) ) {
    	function sf_icon_format_output($font_array, $type = "", $format = "list") {
    		
    		$return = "";
    		
    		if ( $format == "list" ) {
    			
    			foreach ( $font_array as $code => $class ) {		
		            $return .= "<li>";
		            $return .= "    <i class='{$class}'></i>";
		            $return .= "	<span class='icon-name'>{$class}</span>";
		            $return .= "</li>";
		        }
    		
    		} else if ( $format == "mega-menu" ) {
    			
    			foreach ( $font_array as $code => $class ) {
		            $code = "&#x" . $code . "";    					    					
		            $return .= "<div class='{$type}'>";
		            $return .= "    <input class='radio' id='{$class}' type='radio' name='settings[icon]' value='{$class}' />";
		            $return .= "    <label rel='{$code}' for='{$class}'></label>";
		            $return .= "</div>";
		        }
    		}
    		
    		return $return;
    	}
    }

	/* ANIMATIONS LIST
	================================================== */
	if ( ! function_exists( 'sf_get_animations_list' ) ) {
		function sf_get_animations_list($return_array = false) {
		    $anim_array = array(
		        __( "None", "swiftframework" )              	=> "none",
		        __( "Fade In", "swiftframework" )            => "fade-in",
		        __( "Fade from Left", "swiftframework" )             	=> "fade-from-left",
		        __( "Fade from Right", "swiftframework" )             	=> "fade-from-right",
		        __( "Fade from Bottom", "swiftframework" )             	=> "fade-from-bottom",
		        __( "Move up", "swiftframework" )             	=> "move-up",
		        __( "Grow", "swiftframework" )              	=> "grow",
		        __( "Helix", "swiftframework" )            	=> "helix",
		        __( "Flip", "swiftframework" )         	=> "flip",
		        __( "Pop up", "swiftframework" )     => "pop-up",
		        __( "Spin", "swiftframework" )     => "spin",
		        __( "Flip-X", "swiftframework" )    => "flip-x",
		        __( "Flip-Y", "swiftframework" )       => "flip-y",
		    );

		    if ( $return_array ) {
		    	return $anim_array;
		    } else {
			    $anim_opts = "";

			    foreach ($anim_array as $anim_name => $anim_class) {
			    	$anim_opts .= 'option value="'.$anim_class.'">'.$anim_name.'</option>';
			    }

			    return $anim_opts;
		    }
		}
	}
	
	
	/* SHORTCODE GENERATOR
	================================================== */
	if ( ! function_exists( 'sf_shortcode_generator' ) ) {
	    function sf_shortcode_generator() {
	        require_once( 'sf-interface.php' );   
	        wp_die();
	    }
	    add_action( 'wp_ajax_sf_shortcode_generator', 'sf_shortcode_generator' );
	    add_action( 'wp_ajax_nopriv_sf_shortcode_generator', 'sf_shortcode_generator' );
	}
	

    /* DIRECTORY FRONT END SUBMISSION
    ================================================== */
    if ( ! function_exists( 'sf_create_directory_item' ) ) {
        function sf_create_directory_item() {

            if ( ! is_admin() ) {
                if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['action'] ) && $_POST['dirtype'] == 'directory' ) {

                    // Do some minor form validation to make sure there is content
                    if ( isset ( $_POST['directory_title'] ) ) {
                        $title = $_POST['directory_title'];
                    }
                    if ( isset ( $_POST['directory_description'] ) ) {
                        $description = $_POST['directory_description'];
                    }

                    $sf_directory_address         = trim( $_POST['sf_directory_address'] );
                    $sf_directory_lat_coord       = trim( $_POST['sf_directory_lat_coord'] );
                    $sf_directory_lng_coord       = trim( $_POST['sf_directory_lng_coord'] );
                    $sf_directory_pin_link        = trim( $_POST['sf_directory_pin_link'] );
                    $sf_directory_pin_button_text = trim( $_POST['sf_directory_pin_button_text'] );

                    // Get the array of selected categories as multiple cats can be selected
                    $category = $_POST['directory-cat'];
                    $location = $_POST['directory-loc'];

                    // Add the content of the form to $post as an array
                    $post    = array(
                        'post_title'   => wp_strip_all_tags( $title ),
                        'post_content' => $description,
                        'post_status'  => 'pending', // Choose: publish, preview, future, etc.
                        'post_type'    => 'directory' // Set the post type based on the IF is post_type X
                    );
                    $post_id = wp_insert_post( $post );  // Pass  the value of $post to WordPress the insert function

                    // Add Custom meta fields
                    add_post_meta( $post_id, 'sf_directory_address', $sf_directory_address );
                    add_post_meta( $post_id, 'sf_directory_lat_coord', $sf_directory_lat_coord );
                    add_post_meta( $post_id, 'sf_directory_lng_coord', $sf_directory_lng_coord );
                    add_post_meta( $post_id, 'sf_directory_pin_link', $sf_directory_pin_link );
                    add_post_meta( $post_id, 'sf_directory_pin_button_text', $sf_directory_pin_button_text );

                    //Add Taxonomy terms(Location/Category)
                    wp_set_object_terms( $post_id, (int) $category, 'directory-category', true );
                    wp_set_object_terms( $post_id, (int) $location, 'directory-location', true );

                    //Proccess Images
                    if ( $_FILES ) {

                        foreach ( $_FILES as $file => $array ) {
                            $newupload = sf_insert_attachment( $file, $post_id );

                            if ( $file == 'pin_image' ) {
                                update_post_meta( $post_id, 'sf_directory_map_pin', $newupload );
                            } else {
                                update_post_meta( $post_id, '_thumbnail_id', $newupload );
                            }
                        }
                    }

                    //Send notification email to admin
                    $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
                    $itemlink = get_edit_post_link( $post_id, "" );
                    $message  = sprintf( __( 'There is a new directory entry pending review, you can view it here:', 'swiftframework' ) . ' %s', $itemlink ) . "\r\n\r\n";

                    @wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] New directory entry pending review.', 'swiftframework' ), $blogname ), $message );

                    //Success Message
                    echo "<h3>" . __( "Thank you for your submission, your entry is pending review.", "swiftframework" ) . "</h3>";
                    exit();

                } else {

                    //Dropdown translation text
                    $choosecatmsg = __( 'Choose a Category', 'swiftframework' );
                    $chooselocmsg = __( 'Choose a Location', 'swiftframework' );

                    //Directory Category
                    $argscat = array(
                        'id'               => 'directory-cat',
                        'name'             => 'directory-cat',
                        'show_option_none' => $choosecatmsg,
                        'tab_index'        => 4,
                        'taxonomy'         => 'directory-category'
                    );

                    //Directory Location
                    $argsloc = array(
                        'id'               => 'directory-loc',
                        'name'             => 'directory-loc',
                        'show_option_none' => $chooselocmsg,
                        'tab_index'        => 4,
                        'taxonomy'         => 'directory-location'
                    );
                    ?>

                    <!--  Front End Form display   -->
                    <div class="directory-submit-wrap">
                        <form id="add-directory-entry" name="add-directory-entry" method="post" action=""
                              enctype="multipart/form-data">
                            <p class="directory-error">
                                <label
                                    class="directory_error_form"><span> <?php _e( "Please fill all the fields", "swiftframework" ); ?></span></label>
                            </p>

                            <!--   Title  -->
                            <p><label for="directory_title"><?php _e( "Title", "swiftframework" ); ?></label><br/>
                                <input type="text" id="directory_title" value="" tabindex="1" size="20"
                                       name="directory_title"/></p>

                            <!--   Description  -->
                            <p><label for="description"><?php _e( "Description", "swiftframework" ); ?></label><br/>
                                <textarea id="directory_description" tabindex="3" name="directory_description" cols="50"
                                          rows="6"></textarea></p>

                            <!--   Directory Category  -->
                            <p>
                                <label for="description"><?php _e( "Category", "swiftframework" ); ?></label>
                                <?php wp_dropdown_categories( $argscat ); ?>
                            </p>

                            <!--   Directory Location  -->
                            <p>
                                <label for="description"><?php _e( "Location", "swiftframework" ); ?></label>
                                <?php wp_dropdown_categories( $argsloc ); ?>
                            </p>

                            <!--   Address  -->
                            <p>
                                <label for="sf_directory_address"><?php _e( "Address", "swiftframework" ); ?></label>
                                <input type="text" value="" tabindex="5" size="16" name="sf_directory_address"
                                       id="sf_directory_address"/>
                                <a href="#" id="sf_directory_calculate_coordinates"
                                   class="read-more-button hide-if-no-js"><?php _e( "Generate Coordinates", "swiftframework" ); ?></a>
                            </p>

                            <!--   Latitude Coordinate  -->
                            <p><label
                                    for="sf_directory_lat_coord"><?php _e( "Latitude Coordinate", "swiftframework" ); ?></label>
                                <input type="text" value="" tabindex="5" size="16" name="sf_directory_lat_coord"
                                       id="sf_directory_lat_coord"/></p>

                            <!--   Longitude Coordinate  -->
                            <p><label
                                    for="sf_directory_lng_coord"><?php _e( "Longitude Coordinate", "swiftframework" ); ?></label>
                                <input type="text" value="" tabindex="5" size="16" name="sf_directory_lng_coord"
                                       id="sf_directory_lng_coord"/></p>

                            <!--   Pin Image  -->
                            <label for="file"><?php _e( "Pin Image", "swiftframework" ); ?></label>

                            <p><input type="file" name="pin_image" id="pin_image"></p>

                            <!--   Directory Featured Image  -->
                            <label for="file"><?php _e( "Featured Image", "swiftframework" ); ?></label>

                            <p><input type="file" name="featured_image" id="featured_image"></p>

                            <!--   Pin Link Button  -->
                            <p><label for="sf_directory_pin_link"><?php _e( "Pin Link", "swiftframework" ); ?></label>
                                <input type="text" value="" tabindex="5" size="16" name="sf_directory_pin_link"
                                       id="sf_directory_pin_link"/></p>

                            <!--   Pin Button Text  -->
                            <p><label
                                    for="sf_directory_pin_button_text"><?php _e( "Pin Button Text", "swiftframework" ); ?></label>
                                <input type="text" value="" tabindex="5" size="16" name="sf_directory_pin_button_text"
                                       id="sf_directory_pin_button_text"/></p>

                            <!--   Post type  -->
                            <input type="hidden" name="dirtype" id="dirtype" value="directory"/>
                            <input type="hidden" name="action" value="postdirectory"/>

                            <p><input type="submit" value="<?php _e( "Create", "swiftframework" ); ?>"
                                      id="directory-submit" name="directory-submit"/></p>
                        </form>
                    </div>


                <?php
                }
            }
        }
    }

    add_action( 'sf_insert_directory', 'sf_create_directory_item' );


    /* ADMIN CUSTOM POST TYPE ICONS
    ================================================== */
    if ( ! function_exists( 'sf_admin_css' ) ) {
        function sf_admin_css() {
            ?>
            <style type="text/css" media="screen">
            
            #cboxContent .menu_icon .icon_selector .font-awesome input.radio ~ label {
            	font-family: 'FontAwesome';
            	font-size: 16px;
            }
            #cboxContent .menu_icon .icon_selector .font-awesome label:before {
            	text-align: center;
            	line-height: 24px;
            }
            #cboxContent .menu_icon .icon_selector .nucleo-interface input.radio ~ label {
            	font-family: 'nucleo-interface';
            	font-size: 16px;
            }
            #cboxContent .menu_icon .icon_selector .nucleo-interface label:before {
            	text-align: center;
            	line-height: 24px;
            }
            #cboxContent .menu_icon .icon_selector .nucleo-general input.radio ~ label {
            	font-family: 'nucleo-general';
            	font-size: 16px;
            }
            #cboxContent .menu_icon .icon_selector .nucleo-general label:before {
            	text-align: center;
            	line-height: 24px;
            }

            #adminmenu #toplevel_page_admin-import-swiftdemo .wp-menu-image img {
                padding: 7px 0 0;
            }

            .sf-plugin-note-wrap {
                padding: 20px;
                background: #fff;
                margin: 20px 0;
                border: 1px solid #e3e3e3;
            }

            .sf-plugin-note-wrap h3 {
                margin-top: 0;
            }

            /* REVSLIDER HIDE ACTIVATION */
            a[name="activateplugin"] + div, a[name="activateplugin"] + div + div, a[name="activateplugin"] + div + div + div, a[name="activateplugin"] + div + div + div + div {
                display: none;
            }

            #redux_demo-preset_bg_image.redux-container-image_select .redux-image-select img {
                width: 50px;
                height: 50px;
                min-height: 50px;
            }

            #toplevel_page_sf_theme_options .wp-menu-image img {
                width: 11px;
                margin-top: -2px;
                margin-left: 3px;
            }

            .toplevel_page_sf_theme_options #adminmenu li#toplevel_page_sf_theme_options.wp-has-current-submenu a.wp-has-current-submenu, .toplevel_page_sf_theme_options #adminmenu #toplevel_page_sf_theme_options .wp-menu-arrow div, .toplevel_page_sf_theme_options #adminmenu #toplevel_page_sf_theme_options .wp-menu-arrow {
                background: #222;
                border-color: #222;
            }

            #wpbody-content {
                min-height: 815px;
            }

            .wp-list-table th#thumbnail, .wp-list-table td.thumbnail {
                width: 80px;
            }

            .wp-list-table td.thumbnail img {
                max-width: 100%;
                height: auto;
            }

            .sf-menu-options {
                clear: both;
                height: auto;
                overflow: hidden;
                margin-bottom: 20px;
            }

            .sf-menu-options h4 {
                margin-top: 20px;
                margin-bottom: 5px;
                border-bottom: 1px solid #e3e3e3;
                margin-right: 15px;
                padding-bottom: 5px;
            }

            .sf-menu-options p label input[type=checkbox] {
                margin-left: 10px;
            }

            .sf-menu-options p label input[type=text] {
                margin-top: 5px;
            }

            .sf-menu-options p label textarea {
                margin-top: 5px;
                width: 100%;
            }

            /* THEME OPTIONS */
            .redux-container {
                position: relative;
            }

            #redux-header h2 {
                color: #666 !important;
            }

            .redux_field_search {
                right: 20px;
                top: 7px;
            }

            .redux-container-custom_font {
            	margin-bottom: 30px;
            }

            .admin-color-fresh #redux-header {
                background: #fff;
                border-color: #ff6666;
            }

            .admin-color-fresh .redux-sidebar .redux-group-menu li.active {
                border-left-color: #ff6666;
            }

            .admin-color-fresh .redux-sidebar .redux-group-menu li.active.hasSubSections a, .admin-color-fresh .redux-sidebar .redux-group-menu li.activeChild.hasSubSections a {
                background: #ff6666;
            }

            .admin-color-fresh .redux-sidebar .redux-group-menu li.active.hasSubSections ul.subsection li a, .admin-color-fresh .redux-sidebar .redux-group-menu li.activeChild.hasSubSections ul.subsection li a {
                padding: 12px 10px;
            }

            .redux-container-image_select ul.redux-image-select li, .redux-container-image_select ul.redux-image-select label {
                width: 50px;
                height: 50px;
                margin: 0 10px 10px 0 !important;
            }

            fieldset[id*="page_layout"] ul.redux-image-select li, fieldset[id*="page_layout"] ul.redux-image-select li label {
                width: 100px;
                height: 100px;
                margin: 0 10px 25px 0 !important;
            }

            fieldset[id*="footer_layout"] ul.redux-image-select li, fieldset[id*="footer_layout"] ul.redux-image-select li label, fieldset[id*="global_banner_layout"] ul.redux-image-select li, fieldset[id*="global_banner_layout"] ul.redux-image-select li label {
                width: 128px;
                height: 60px;
                margin-bottom: 20px!important;
            }

            fieldset[id*="header_layout"] ul.redux-image-select li, fieldset[id*="header_layout"] ul.redux-image-select label {
                width: 98%;
                height: auto;
            }

            fieldset[id*="header_layout"] ul.redux-image-select img {
                height: auto !important;
            }

            fieldset[id*="thumbnail_type"] ul.redux-image-select li {
                width: 30%;
                height: auto;
            }

            fieldset[id*="thumbnail_type"] ul.redux-image-select li label {
                width: 100%;
                height: auto;
            }

            fieldset[id*="thumbnail_type"].redux-container-image_select ul.redux-image-select li img {
                height: auto;
                margin-bottom: 6px;
            }

            .redux-container-image_select ul.redux-image-select li img {
                width: 100%;
                height: 100%;
            }
            
            .redux-container .ui-buttonset .ui-button {
            	height: 34px;
        	    padding: 0 15px;
        	    line-height: 34px;
            }
            
            .redux-container .ui-buttonset .ui-button > span {
            	padding: 0;
            	line-height: 30px;
            }

            .redux_field_th .scheme-buttons {
                margin-top: 20px;
            }

            .redux_field_th .scheme-buttons .save-this-scheme-name {
                margin-right: 8px;
                padding: 6px 8px 5px;
                line-height: 15px;
                border-radius: 2px;
            }

            #sf-export-scheme-name, .delete-this-scheme {
                margin-right: 8px !important;
            }

            #header_left_config_enabled, #header_left_config_disabled, #header_right_config_enabled, #header_right_config_disabled,
            #nav_left_config_enabled, #nav_left_config_disabled, #nav_right_config_enabled, #nav_right_config_disabled {
                width: 90%;
                margin: 0 0 20px 0;
            }

            .redux-container-sorter ul li {
                width: auto;
                float: left;
                margin-right: 10px;
            }

            .redux-container-sorter ul li.placeholder {
                width: 120px;
            }

            /* META BOX CUSTOM */
            .rwmb-field {
            	margin: 10px 0;
            }
            .rwmb-field > h3 {
            	margin: 10px 0;
            	border-bottom: 1px solid #e4e4e4;
            	padding-bottom: 10px !important;
            }
            .rwmb-label label {
            	padding-right: 10px;
            	vertical-align: top;
            }
            .rwmb-checkbox-wrapper .description {
            	display: block;
            	margin: 6px 0 8px;
            }
            .rwmb-input .rwmb-slider {
                background: #f7f7f7;
                border: 1px solid #e3e3e3;
            }
			
			.meta-box-sortables select, .rwmb-input > input, .rwmb-media-view .rwmb-add-media {
				margin-bottom: 5px;
			}
			
            .rwmb-slider.ui-slider-horizontal .ui-slider-range-min {
                background: #fe504f!important;
            }

            .rwmb-slider-value-label {
                vertical-align: 0;
            }

            .rwmb-images img {
                max-width: 150px;
                max-height: 150px;
                width: auto;
                height: auto;
            }

            h2.meta-box-section {
                border-bottom: 1px solid #e4e4e4;
                padding-bottom: 10px !important;
                margin-top: 20px !important;
                font-size: 18px !important;
                color: #444;
            }

            .rwmb-meta-box div:first-child h2.meta-box-section {
                margin-top: 0 !important;
                padding: 10px 0!important;
                margin-bottom: 20px!important;
            }

            /* META BOX TABS */
            
            #sf_meta_box > .inside {
            	margin: 0;
            	padding: 0;
            }
            .sf-meta-tabs-wrap {
                height: auto;
                overflow: hidden;
            }

            .rwmb-meta-box {
                padding: 20px 10px;
            }

            .sf-meta-tabs-wrap.all-hidden {
                display: none;
            }

            #sf-tabbed-meta-boxes {
                position: relative;
                z-index: 1;
                float: right;
                width: 80%;
                border-left: 1px solid #e3e3e3;
            }


            #sf-tabbed-meta-boxes .inside {
                display: block !important;
            }

            #sf-tabbed-meta-boxes > div {
                border-left: 0;
                border-right: 0;
                border-bottom: 0;
                margin-bottom: 0;
                padding-bottom: 20px;
                border-top: 0;
            }
            
            #sf-tabbed-meta-boxes .handlediv, #sf-tabbed-meta-boxes .hndle {
            	display: none!important;
            }

            /*#sf-tabbed-meta-boxes > div.hide-if-js {
                   display: none!important;
            }*/
            #sf-meta-box-tabs {
                margin: 0;
                width: 20%;
                position: relative;
                z-index: 2;
                float: left;
                margin-right: -1px;
            }

            #sf-meta-box-tabs li {
                margin-bottom: -1px;
            }

            #sf-meta-box-tabs li.user-hidden {
                display: none !important;
            }
			
			#sf-meta-box-tabs li:first-child > a {
				border-top: 0;
			}
			
            #sf-meta-box-tabs li > a {
                display: block;
                background: #f7f7f7;
                padding: 12px;
                line-height: 150%;
                border: 1px solid #e5e5e5;
                -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
                box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
                text-decoration: none;
            }

            #sf-meta-box-tabs li > a:hover {
                color: #222;
                background: #fff;
            }

            #sf-meta-box-tabs li > a.active {
                border-right-color: #fff;
                background: #fff;
                box-shadow: none;
            }

            .closed #sf-meta-box-tabs, .closed #sf-tabbed-meta-boxes {
                display: none;
            }

            /* Events plugin fix */
            .wp-admin .rhc-extra-info-cell {
                display: block;
                width: auto;
            }
            </style>

        <?php
        }

        add_action( 'admin_head', 'sf_admin_css' );
    }
?>
