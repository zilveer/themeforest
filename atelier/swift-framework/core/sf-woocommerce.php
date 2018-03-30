<?php
    /*
    *
    *	WooCommerce Functions & Hooks
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    /* FILTER HOOKS
    ================================================== */
    /* Remove default content wrapper output */
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

    /* Remove default WooCommerce breadcrumbs */
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

    /* Move rating output */
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );

    /* Remove default thumbnail output */
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

    /* Remove default sale flash output */
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

	/* Add Shipping Calculator to after cart action */
	add_action( 'woocommerce_after_cart_table', 'woocommerce_shipping_calculator', 10 );

	/* Remove totals from cart collaterals */
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
	
	/* Remove default product item link */
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	
	/* Remove review meta */
	remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );
	
	/* WooCommerce Additional Variation Images */	
	function variation_swap_main_image_class() {
		return '#product-img-slider ul.slides';
	}
	add_filter( 'wc_additional_variation_images_main_images_class', 'variation_swap_main_image_class' );
	
	
	function variation_swap_gallery_image_class() {
		return '#product-img-slider ul.slides';
	}
	add_filter( 'wc_additional_variation_images_gallery_images_class', 'variation_swap_gallery_image_class' );
	
	add_filter( 'wc_additional_variation_images_custom_swap', '__return_true' );
	add_filter( 'wc_additional_variation_images_custom_reset_swap', '__return_true' );
	add_filter( 'wc_additional_variation_images_custom_original_swap', '__return_true' );
	add_filter( 'wc_additional_variation_images_get_first_image', '__return_true' );
	
	
	/* REMOVE UNESSECARY WOOCOMMERCE SCRIPTS
    ================================================== */
	if ( ! function_exists( 'sf_remove_woo_scripts' ) ) {
		function sf_remove_woo_scripts() {

			global $post;

			if ( !sf_theme_supports('swift-smartscript') || is_admin() ) {
		        return;
	        }
			
			// Page Content Meta
			$page_has_products = false;
			if ( $post ) {
				$page_has_products = sf_get_post_meta( $post->ID, 'sf_page_has_products', true );
			}
			if ( is_active_widget( false, false, 'woocommerce_top_rated_products', true ) ||
				 is_active_widget( false, false, 'woocommerce_recently_viewed_products', true ) ||
				 is_active_widget( false, false, 'woocommerce_recent_reviews', true ) ||
				 is_active_widget( false, false, 'woocommerce_products', true ) ||
				 is_active_widget( false, false, 'woocommerce_product_categories', true ) ||
				 is_active_widget( false, false, 'woocommerce_widget_cart', true )
			) {
				$page_has_products = true;
			}


			// Check page for WoooCommerce content
			$body_class = get_body_class();

			if ( !in_array( 'woocommerce' , $body_class ) && !in_array( 'woocommerce-cart' , $body_class ) && !in_array( 'woocommerce-checkout' , $body_class ) && !$page_has_products ) {

				// WooCommerce Scripts
				wp_dequeue_script( 'jquery-blockui' );
				wp_dequeue_script( 'jquery-cookie' );
				wp_dequeue_script( 'woocommerce' );
				wp_dequeue_script( 'wc-add-to-cart' );
				wp_dequeue_script( 'wc-cart-fragments' );
				wp_dequeue_script( 'wc-add-to-cart-variation' );

				// Yith Wishlist
				if ( !defined( 'YITH_WCWL_PREMIUM' ) ) {
					wp_dequeue_script( 'jquery-yith-wcwl' );
				}

			}

			if ( in_array( 'woocommerce-cart' , $body_class ) ) {

				// WooCommerce Scripts
				wp_dequeue_script( 'wc-add-to-cart-variation' );

				// Yith Wishlist
				if ( !defined( 'YITH_WCWL_PREMIUM' ) ) {
					wp_dequeue_script( 'jquery-yith-wcwl' );
				}

			}

			if ( in_array( 'woocommerce-checkout' , $body_class ) ) {

				// WooCommerce Scripts
				wp_dequeue_script( 'wc-add-to-cart' );
				wp_dequeue_script( 'wc-cart-fragments' );
				wp_dequeue_script( 'wc-add-to-cart-variation' );

				// JCK Quickview
				wp_dequeue_style( 'jckqv-minstyles' );
				wp_dequeue_style( 'jckqv-styles' );
				wp_dequeue_script( 'jckqv-script' );

				// Yith Wishlist
				wp_dequeue_script( 'jquery-yith-wcwl' );
			}

			// WooCommerce Scripts / Styles
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );

		}
		add_action( 'wp_enqueue_scripts', 'sf_remove_woo_scripts', 99 );
	}
	

	/* ADJUST BREADCRUMB OUTPUT
    ================================================== */
    if ( ! function_exists( 'sf_woo_breadcrumb_opts' ) ) {
		function sf_woo_breadcrumb_opts() {

			return array(
				'delimiter'   => '<span class="seperator">></span>',
				'wrap_before' => '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
				'wrap_after'  => '</nav>',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'swiftframework' )
			);

		}
		add_filter ( 'woocommerce_breadcrumb_defaults' , 'sf_woo_breadcrumb_opts' );
	}


    /* ADJUST DESCRIPTION OUTPUT
    ================================================== */
    if ( ! function_exists( 'woocommerce_taxonomy_archive_description' ) ) {
        function woocommerce_taxonomy_archive_description() {
        	
        	if ( sf_theme_supports( 'page-heading-woo-description' ) ) {
        		global $sf_options;
        		$page_title_style = $sf_options['woo_page_heading_style'];
        		if ( $page_title_style != "standard" ) {
        			return;
        		}
        	}
        	
            if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {
                $description = apply_filters( 'the_content', term_description() );
                if ( $description ) {
                    echo '<div class="term-description container">' . $description . '</div>';
                }
            }
        }
    }


    /* ADD PRICE TO PRODUCT ACTIONS
    ================================================== */
    function sf_product_actions_price() {
    	global $product;
    	echo '<a class="price-link" href="'.get_permalink( $product->id ).'">';
        wc_get_template( 'loop/price.php' );
    	echo '</a>';
    }
    add_action( 'woocommerce_after_shop_loop_item', 'sf_product_actions_price', 0 );


    /* PRODUCT BADGE
    ================================================== */
    if ( ! function_exists( 'sf_woo_product_badge' ) ) {
	    function sf_woo_product_badge() {
	    	global $product, $post, $sf_options;
	    	$postdate 		= get_the_time( 'Y-m-d' );			// Post date
	    	$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
	    	$newness 		= $sf_options['new_badge']; 	// Newness in days
	    ?>
		    <div class="badge-wrap">
			    <?php

			    	if ( sf_is_out_of_stock() ) {

			    		echo apply_filters( 'woocommerce_sold_out_flash', '<span class="out-of-stock-badge">' . __( 'Sold out', 'swiftframework' ) . '</span>', $post, $product);

			    	} else if ($product->is_on_sale()) {

			    		echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale', 'swiftframework' ).'</span>', $post, $product);

			    	} else if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {

			    		// If the product was published within the newness time frame display the new badge
			    		echo '<span class="wc-new-badge">' . __( 'New', 'swiftframework' ) . '</span>';

			    	} else if ( $product->get_price() != "" && $product->get_price() == 0 ) {
			    		echo '<span class="free-badge">' . __( 'Free', 'swiftframework' ) . '</span>';

			    	}
			    ?>
		    </div>
	    <?php }
	}


    /* ADD HERO IMAGE TO PRODUCT CATEGORY
    ================================================== */
    function sf_product_cat_add_hero_image() {
    	// this will add the custom meta field to the add new term page
    	?>
    	<div class="form-field">
			<label><?php _e( 'Hero Image', 'swiftframework' ); ?></label>
			<div id="product_cat_hero" style="float:left;margin-right:10px;"><img style="height: auto!important;margin: 10px 0;" src="<?php echo wc_placeholder_img_src(); ?>" width="300px" height="300px" /></div>
			<div style="line-height:40px;">
				<input type="hidden" id="product_cat_hero_id" name="product_cat_hero_id" />
				<button type="button" class="upload_hero_button button"><?php _e( 'Upload/Add image', 'swiftframework' ); ?></button>
				<button type="button" class="remove_hero_button button"><?php _e( 'Remove image', 'swiftframework' ); ?></button>
				<p><?php _e( 'This image is used for the hero image on product category pages.', 'swiftframework' ); ?></p>
			</div>
			<script type="text/javascript">

				 // Only show the "remove image" button when needed
				 if ( ! jQuery('#product_cat_hero_id').val() )
					 jQuery('.remove_hero_button').hide();

				// Uploading files
				var file_frame;

				jQuery(document).on( 'click', '.upload_hero_button', function( event ){

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( 'Choose an image', 'swiftframework' ); ?>',
						button: {
							text: '<?php _e( 'Use image', 'swiftframework' ); ?>',
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						attachment = file_frame.state().get('selection').first().toJSON();

						jQuery('#product_cat_hero_id').val( attachment.id );
						jQuery('#product_cat_hero img').attr('src', attachment.url );
						jQuery('.remove_hero_button').show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery(document).on( 'click', '.remove_hero_button', function( event ){
					jQuery('#product_cat_hero img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
					jQuery('#product_cat_hero_id').val('');
					jQuery('.remove_hero_button').hide();
					return false;
				});

			</script>
			<div class="clear"></div>
		</div>
    <?php
    }
    add_action( 'product_cat_add_form_fields', 'sf_product_cat_add_hero_image', 10, 2 );

    function sf_product_cat_edit_hero_image($term) {

    	$image 			= '';
    	$hero_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'hero_id', true ) );
    	if ( $hero_id )
    		$image = wp_get_attachment_url( $hero_id, 'medium' );
    	else
    		$image = wc_placeholder_img_src();

    	?>
    	<tr class="form-field">
			<th scope="row" valign="top"><label><?php _e( 'Hero Image', 'swiftframework' ); ?></label></th>
			<td>
				<div id="product_cat_hero" style="float:left;margin-right:10px;"><img style="height: auto!important;" src="<?php echo esc_url($image); ?>" width="300px" height="300px" /></div>
				<div style="line-height:40px;">
					<input type="hidden" id="product_cat_hero_id" name="product_cat_hero_id" value="<?php echo $hero_id; ?>" />
					<button type="submit" class="upload_hero_button button"><?php _e( 'Upload/Add image', 'swiftframework' ); ?></button>
					<button type="submit" class="remove_hero_button button"><?php _e( 'Remove image', 'swiftframework' ); ?></button>
					<p><?php _e( 'This image is used for the hero image on product category pages.', 'swiftframework' ); ?></p>
				</div>
				<script type="text/javascript">

					// Uploading files
					var file_frame_hero;

					jQuery(document).on( 'click', '.upload_hero_button', function( event ){

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame_hero ) {
							file_frame_hero.open();
							return;
						}

						// Create the media frame.
						file_frame_hero = wp.media.frames.downloadable_file = wp.media({
							title: '<?php _e( 'Choose an image', 'swiftframework' ); ?>',
							button: {
								text: '<?php _e( 'Use image', 'swiftframework' ); ?>',
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame_hero.on( 'select', function() {
							attachment = file_frame_hero.state().get('selection').first().toJSON();

							jQuery('#product_cat_hero_id').val( attachment.id );
							jQuery('#product_cat_hero img').attr('src', attachment.url );
							jQuery('.remove_hero_button').show();
						});

						// Finally, open the modal.
						file_frame_hero.open();
					});

					jQuery(document).on( 'click', '.remove_hero_button', function( event ){
						jQuery('#product_cat_hero img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
						jQuery('#product_cat_hero_id').val('');
						jQuery('.remove_hero_button').hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</td>
		</tr>
    <?php
    }
    add_action( 'product_cat_edit_form_fields', 'sf_product_cat_edit_hero_image', 10, 2 );


	/* SAVE EXTRA TAXONOMY FIELDS
	================================================== */
	function sf_product_cat_save_hero_image( $term_id, $tt_id, $taxonomy ) {
		if ( isset( $_POST['product_cat_hero_id'] ) ) {
			update_woocommerce_term_meta( $term_id, 'hero_id', absint( $_POST['product_cat_hero_id'] ) );
		}
	}
	add_action( 'created_term', 'sf_product_cat_save_hero_image', 10, 3 );
	add_action( 'edit_term', 'sf_product_cat_save_hero_image', 10, 3 );


    /* REMOVE WOOCOMMERCE PRETTYPHOTO STYLES/SCRIPTS
    ================================================== */
    function sf_remove_woo_lightbox_js() {
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
    }

    add_action( 'wp_enqueue_scripts', 'sf_remove_woo_lightbox_js', 99 );

    function sf_remove_woo_lightbox_css() {
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    }

    add_action( 'wp_enqueue_styles', 'sf_remove_woo_lightbox_css', 99 );


    /* REMOVE META BOX ON WC SHOP PAGE
    ================================================== */
    function sf_check_shop_page() {
        $screen = get_current_screen();
        if ( sf_woocommerce_activated() && $screen->post_type == 'page' ) {
            $wc_shop_id      = wc_get_page_id( 'shop' );
            $current_page_id = 0;

            if ( isset( $_GET['post'] ) ) {
                $current_page_id = $_GET['post'];
            }

            if ( $wc_shop_id == $current_page_id ) {
                echo '<style>.sf-meta-tabs-wrap {display: none!important;}</style>';
            }
        }
    }
    add_action( 'current_screen', 'sf_check_shop_page', 10 );


    /* WOOCOMMERCE COMMENT TITLE FIELD
    ================================================== */
	function sf_comments_additional_field() {

		echo '<p class="comment-form-title">'.
		'<label for="title">' . __( 'Title', 'swiftframework' ) . '</label>'.
		'<input id="title" name="title" placeholder="' . __( 'Title', 'swiftframework' ) . '" type="text" size="30" /></p>';

	}
    add_action( 'comment_form_logged_in_after', 'sf_comments_additional_field' );
	add_action( 'comment_form_after_fields', 'sf_comments_additional_field' );


	function save_comment_meta_data( $comment_id ) {

		if ( ( isset( $_POST['title'] ) ) && ( $_POST['title'] != '') ) {
			$title = wp_filter_nohtml_kses($_POST['title']);
			add_comment_meta( $comment_id, 'title', $title );
		}

	}
	add_action( 'comment_post', 'save_comment_meta_data' );

	function sf_extend_comment_add_meta_box() {
		add_meta_box( 'title', __( 'Comment Metadata', 'swiftframework' ), 'sf_extend_comment_meta_box', 'comment', 'normal', 'high' );
	}
	add_action( 'add_meta_boxes_comment', 'sf_extend_comment_add_meta_box' );

	function sf_extend_comment_meta_box( $comment ) {
		$title = get_comment_meta( $comment->comment_ID, 'title', true );
		wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
		?>
		<p>
		<label for="title"><?php _e( 'Title', 'swiftframework' ); ?></label>
		<input type="text" name="title" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
		</p>
		<?php
	}

	function sf_extend_comment_edit_metafields( $comment_id ) {
		if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;

		if ( ( isset( $_POST['title'] ) ) && ( $_POST['title'] != '') ):
		$title = wp_filter_nohtml_kses($_POST['title']);
		update_comment_meta( $comment_id, 'title', $title );
		else :
		delete_comment_meta( $comment_id, 'title');
		endif;
	}
	add_action( 'edit_comment', 'sf_extend_comment_edit_metafields' );



    /* WOOCOMMERCE CONTENT FUNCTIONS
    ================================================== */
    function sf_get_product_stars() {

        $stars_output = "";

        global $wpdb;
        global $post;
        $count = $wpdb->get_var( "
		    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		    WHERE meta_key = 'rating'
		    AND comment_post_ID = $post->ID
		    AND comment_approved = '1'
		    AND meta_value > 0
		" );

        $rating = $wpdb->get_var( "
		    SELECT SUM(meta_value) FROM $wpdb->commentmeta
		    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		    WHERE meta_key = 'rating'
		    AND comment_post_ID = $post->ID
		    AND comment_approved = '1'
		" );

        if ( $count > 0 ) {
            $average = number_format( $rating / $count, 2 );
            $stars_output .= '<div class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
            $stars_output .= '<span class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'swiftframework' ), $average ) . '"><span style="width:' . ( $average * 16 ) . 'px"><span itemprop="ratingValue" class="rating">' . $average . '</span> </span></span>';
            $stars_output .= '</div>';
        }

        return $stars_output;
    }

    function sf_is_out_of_stock() {
        global $post;
        $post_id      = $post->ID;
        $stock_status = sf_get_post_meta( $post_id, '_stock_status', true );
        if ( $stock_status == 'outofstock' ) {
            return true;
        } else {
            return false;
        }
    }

    if ( ! function_exists( 'sf_product_items_text' ) ) {
        function sf_product_items_text( $count, $alt = false ) {
            $product_item_text = "";

            if ( $alt == true ) {
                return number_format_i18n( $count );
            } else {
                if ( $count > 1 ) {
                    $product_item_text = str_replace( '%', number_format_i18n( $count ), __( '% items', 'swiftframework' ) );
                } elseif ( $count == 0 ) {
                    $product_item_text = __( '0 items', 'swiftframework' );
                } else {
                    $product_item_text = __( '1 item', 'swiftframework' );
                }

                return $product_item_text;
            }
        }
    }


    /* ADD TO CART HEADER RELOAD
    ================================================== */
    if ( ! function_exists( 'sf_woo_header_add_to_cart_fragment' ) ) {
        function sf_woo_header_add_to_cart_fragment( $fragments ) {
            global $woocommerce, $sf_options;

            ob_start();

            $show_cart_count = false;
            if ( isset( $sf_options['show_cart_count'] ) ) {
                $show_cart_count = $sf_options['show_cart_count'];
            }

			if ( sf_theme_opts_name() == "sf_atelier_options" ) {
				$cart_total = '<span class="menu-item-title">' . __( "Cart" , "swiftframework" ) . '</span>';
			} else {
				$cart_total = WC()->cart->get_cart_total();
			}
            $cart_count          = $woocommerce->cart->cart_contents_count;
            $cart_count_text     = sf_product_items_text( $cart_count );
            $cart_count_text_alt = sf_product_items_text( $cart_count, true );
            $view_cart_icon 	 = apply_filters( 'sf_view_cart_icon', '<i class="ss-view"></i>' );
            $checkout_icon 	 	 = apply_filters( 'sf_checkout_icon', '<i class="ss-creditcard"></i>' );
            $go_to_shop_icon  	 = apply_filters( 'sf_go_to_shop_icon', '<i class="ss-cart"></i>' );
            $extra_class		 = "";
            
            if ( $cart_count != "0" ) {
            	$extra_class .= "cart-not-empty ";
            }
            
            ?>

            <li class="parent shopping-bag-item <?php echo $extra_class; ?>">

                <?php if ( $show_cart_count ) { ?>

                    <a class="cart-contents" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"
                       title="<?php _e( 'View your shopping cart', 'swiftframework' ); ?>">
                       <?php echo apply_filters( 'sf_header_cart_icon', '<i class="ss-cart"></i>' ); ?><span class="cart-text"><?php _e( "Cart", "swiftframework" ); ?></span><?php echo $cart_total; ?><span class="num-items cart-count-enabled"><?php echo $cart_count_text_alt; ?></span></a>

                <?php } else { ?>

                    <a class="cart-contents" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"
                       title="<?php _e( 'View your shopping cart', 'swiftframework' ); ?>"><?php echo apply_filters( 'sf_header_cart_icon', '<i class="ss-cart"></i>' ); ?><span class="cart-text"><?php _e( "Cart", "swiftframework" ); ?></span><?php echo $cart_total; ?><span class="num-items"><?php echo $cart_count_text_alt; ?></span></a>

                <?php } ?>

                <ul class="sub-menu">
                    <li>

                        <div class="shopping-bag" data-empty-bag-txt="<?php _e( 'Your cart is empty.', 'swiftframework' ); ?>" data-singular-item-txt="<?php _e( 'item in the cart', 'swiftframework' ); ?>" data-multiple-item-txt="<?php _e( 'items in the cart', 'swiftframework' ); ?>">

                          <div class="loading-overlay"><i class="sf-icon-loader"></i></div>

                            <?php if ( $cart_count != "0" ) { ?>

                                <div
                                    class="bag-header"><?php echo $cart_count_text; ?> <?php _e( 'in the cart', 'swiftframework' ); ?></div>

                                <div class="bag-contents">

                                    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { ?>
                                    
                                        <?php
                                        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                        ?>

                                        <?php  
										
										$variation_id_class = '';
										
                                        if ( $cart_item['variation_id'] > 0 )
                                             $variation_id_class = ' product-var-id-' .  $cart_item['variation_id']; 
										 
                                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                        	
                                        	$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                    						$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    						$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                    						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    						$product_title       = $_product->get_title();
                    						$product_short_title = ( strlen( $product_title ) > 25 ) ? substr( $product_title, 0, 22 ) . '...' : $product_title;
                                        ?>

                                            	<div class="bag-product clearfix  product-id-<?php echo $cart_item['product_id']; ?>">

                                                <figure>
                                                	<a class="bag-product-img" href="<?php echo esc_url( $product_permalink ); ?>">
                                                    	<?php echo $_product->get_image(); ?>
                                                    </a>
                                                </figure>

                                                <div class="bag-product-details">
                                                    <div class="bag-product-title">
                                                        <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
                                                            <?php echo apply_filters( 'woocommerce_cart_widget_product_title', $product_title, $_product ); ?></a>
                                                    </div>
                                                    <div
                                                        class="bag-product-price"><?php _e( "Unit Price:", 'swiftframework' ); ?> <?php echo $product_price; ?></div>
                                                    <div
                                                        class="bag-product-quantity"><?php _e( 'Quantity:', 'swiftframework' ); ?> <?php echo $cart_item['quantity']; ?></div>
                                                </div>

												<?php
												echo  apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                            							'<a href="%s" class="remove remove-product" title="%s" data-ajaxurl="'.admin_url( 'admin-ajax.php' ).'" data-product-qty="'. $cart_item['quantity'] .'"  data-product-id="%s" data-product_sku="%s">&times;</a>',
                            							esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                            							__( 'Remove this item', 'swiftframework' ),
                            							esc_attr( $product_id ),
                            							esc_attr( $_product->get_sku() )
                            						), $cart_item_key );
												?>
 
                                            </div>

                                        <?php } ?>

                                    <?php } ?>

                                </div>

                                <?php if ( sf_theme_opts_name() == "sf_atelier_options" || sf_theme_opts_name() == "sf_uplift_options" ) { ?>

				                    <div class="bag-total">
				                    	<?php if ( class_exists( 'Woocommerce_German_Market' ) ) { ?>
					                    <span class="total-title"><?php _e( "Total incl. tax", "swiftframework" ); ?></span>
					                    <?php } else { ?>
					                    <span class="total-title"><?php _e( "Total", "swiftframework" ); ?></span>
					                    <?php } ?>
										<span class="total-amount"><?php echo WC()->cart->get_cart_total(); ?></span>
				                    </div>

			                    <?php } ?>

                                <div class="bag-buttons">

                                    <a class="sf-button standard sf-icon-reveal bag-button" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">
                                    	<?php echo $view_cart_icon; ?>
                                   		<span class="text"><?php _e( 'View cart', 'swiftframework' ); ?></span>
                                   	</a>

                                    <a class="sf-button standard sf-icon-reveal checkout-button" href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>">
                                    	<?php echo $checkout_icon; ?>
                                    	<span class="text"><?php _e( 'Checkout', 'swiftframework' ); ?></span>
                                    </a>

                                </div>

                            <?php } else { ?>

                                <div class="bag-empty"><?php _e( 'Your cart is empty.', 'swiftframework' ); ?></div>

                            <?php } ?>

                        </div>
                    </li>
                </ul>
            </li>

            <?php

            $fragments['.shopping-bag-item'] = ob_get_clean();

            return $fragments;

        }

        add_filter( 'add_to_cart_fragments', 'sf_woo_header_add_to_cart_fragment' );
    }


    /* WISHLIST BUTTON
    ================================================== */
    if ( ! function_exists( 'sf_wishlist_button' ) ) {
        function sf_wishlist_button($extra_class = "") {

            global $product, $yith_wcwl;

            if ( class_exists( 'YITH_WCWL_UI' ) ) {
                $product_type = $product->product_type;
              	$tooltip      = __("Add to wishlist", "swiftframework");

				//Check Wishlist version
				if ( version_compare( get_option('yith_wcwl_version'), "2.0" ) >= 0 ) {
					$url = YITH_WCWL()->get_wishlist_url();
	        		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

					if ( ! empty( $default_wishlists ) ) {
		        		$default_wishlist = $default_wishlists[0]['ID'];
	        		}
	        		else {
		        		$default_wishlist = false;
	        		}

					$exists = YITH_WCWL()->is_product_in_wishlist( $product->id , $default_wishlist);
				}
				else {
					$url = $yith_wcwl->get_wishlist_url();
					$exists = $yith_wcwl->is_product_in_wishlist( $product->id );
				}

				if ( $exists ) {
					$tooltip  = __("View wishlist", "swiftframework");
				}

                $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';
				
				$html = '<div class="yith-wcwl-divide"></div>';
                $html .= '<div class="yith-wcwl-add-to-wishlist '.$extra_class.'" data-toggle="tooltip" data-placement="top" title="'.$tooltip.'">';
                $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

                $html .= $exists ? ' hide" style="display:none;"' : ' show"';
				$html .= '><a href="' . htmlspecialchars( $yith_wcwl->get_addtowishlist_url() ) . '" rel="nofollow" data-ajaxurl="' . admin_url( 'admin-ajax.php' ). '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' >';

                $html .= apply_filters('sf_add_to_wishlist_icon', '<i class="ss-star"></i>');
                $html .= '</a></div>';

                $html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><span class="feedback">' . __( 'Product added to wishlist.', 'swiftframework' ) . '</span> <a href="' . $url . '" rel="nofollow">';
                $html .= apply_filters('sf_added_to_wishlist_icon', '<i class="fa-check"></i>');
                $html .= '</a></div>';
                $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . $url . '">';
                $html .= apply_filters('sf_added_to_wishlist_icon', '<i class="fa-check"></i>');
                $html .= '</a></div>';
                $html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

                $html .= '</div>';

                return $html;
            }
        }

        add_action( 'woocommerce_after_add_to_cart_button', 'sf_wishlist_button', 10 );
    }


    /* SHOW PRODUCTS COUNT URL PARAMETER
    ================================================== */
    if ( !function_exists('sf_product_shop_count') ) {
		function sf_product_shop_count() {
			$options           = get_option( sf_theme_opts_name() );
			$default_count = $products_per_page = $options['products_per_page'];;

			$count = isset($_GET['show_products']) ? $_GET['show_products'] : $default_count;

			if ( $count === 'all' ) {
				$count = -1;
			} else if ( !is_numeric($count) ) {
				$count = $default_count;
			}

			return $count;
		}	
	}
	add_filter( 'loop_shop_per_page', 'sf_product_shop_count');   
	
    
    /* CROSS SELLS COLUMNS
    ================================================== */
    add_filter( 'woocommerce_cross_sells_columns', create_function( '$cross_sells_cols', 'return 4;' ) );
   

    /* SHOP LAYOUT OPTIONS
    ================================================== */
   	if ( ! function_exists( 'sf_shop_layout_opts' ) ) {
   	    function sf_shop_layout_opts() {

   	    	global $sf_options;
   	    	$product_multi_masonry = $sf_options['product_multi_masonry'];
   			$product_display_type = $sf_options['product_display_type'];
   			if (isset($_GET['product_display'])) {
   				$product_display_type = $_GET['product_display'];
			}
   	    	if ( $product_multi_masonry || !sf_theme_supports('product-layout-opts') ) {
   	    		return;
   	    	}

   	    ?>
   	    	<div class="shop-layout-opts" data-display-type="<?php echo $product_display_type; ?>">
   	    		<a href="#" class="layout-opt" data-layout="standard" title="<?php _e("Standard Layout", "swiftframework"); ?>"><i class="sf-icon-atelier-shop-standard"></i></a>
   	    		<a href="#" class="layout-opt" data-layout="list" title="<?php _e("List Layout", "swiftframework"); ?>"><i class="sf-icon-atelier-shop-list"></i></a>
   	    		<a href="#" class="layout-opt" data-layout="grid" title="<?php _e("Grid Layout", "swiftframework"); ?>"><i class="sf-icon-atelier-shop-grid"></i></a>
   	    	</div>
   	    <?php }
    	add_action( 'woocommerce_before_shop_loop', 'sf_shop_layout_opts', 10 );
    }


    /* MOBILE SHOP LAYOUT OPTIONS
    ================================================== */
    if ( ! function_exists( 'sf_shop_layout_opts_mobile' ) ) {
   	    function sf_shop_layout_opts_mobile() {

   	    	global $sf_options, $woocommerce, $wp_query;
   	    	$product_multi_masonry = $sf_options['product_multi_masonry'];
   			$product_display_type = $sf_options['product_display_type'];
   			if (isset($_GET['product_display'])) {
   				$product_display_type = $_GET['product_display'];
			}

   	    	if ( $product_multi_masonry || !sf_theme_supports('product-layout-opts') && !sf_theme_supports( 'mobile-shop-filters' ) ) {
   	    		return;
   	    	}

   	    ?>
   	    	<div class="shop-layout-opts" data-display-type="<?php echo $product_display_type; ?>">
   	    		<a href="#" class="layout-opt" data-layout="solo" title="<?php _e("Solo Layout", "swiftframework"); ?>"><i class="sf-icon-atelier-shop-solo"></i></a>
   	    		<a href="#" class="layout-opt" data-layout="list" title="<?php _e("List Layout", "swiftframework"); ?>"><i class="sf-icon-atelier-shop-list"></i></a>
   	    		<a href="#" class="layout-opt" data-layout="grid" title="<?php _e("Grid Layout", "swiftframework"); ?>"><i class="sf-icon-atelier-shop-standard"></i></a>
   	    	</div>

   	    	<p class="woocommerce-result-count">
		        <?php
		            $paged    = max( 1, $wp_query->get( 'paged' ) );
		            $per_page = $wp_query->get( 'posts_per_page' );
		            $total    = $wp_query->found_posts;
		            $first    = ( $per_page * $paged ) - $per_page + 1;
		            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

		            if ( 1 == $total ) {
		                echo __( '1 product', 'swiftframework' );
		            } elseif ( $total <= $per_page ) {
		                printf( __( '%d products', 'swiftframework' ), $total );
		            } else {
		                printf( __( '%1$d-%2$d of %3$d products', 'swiftframework' ), $first, $last, $total );
		            }
		        ?>
		    </p>

   	    <?php }
    	add_action( 'sf_mobile_before_shop_loop_details', 'sf_shop_layout_opts_mobile', 10 );
    }


	/* MOBILE SHOP FILTERS
    ================================================== */
    if ( ! function_exists( 'sf_mobile_filters_link' ) ) {
		function sf_mobile_filters_link() {
			if ( !sf_theme_supports( 'mobile-shop-filters' ) ) {
			    return;
		    }
			echo '<a href="#" class="sf-mobile-shop-filters-link">' . __( "Filters" , "swiftframework" ) . '</a>';
		}
		add_action( 'woocommerce_before_shop_loop', 'sf_mobile_filters_link', 0 );
	}
    if ( ! function_exists( 'sf_mobile_shop_filters' ) ) {
	    function sf_mobile_shop_filters() {

		    if ( !sf_theme_supports( 'mobile-shop-filters' ) ) {
			    return;
		    }

			?>

			<div class="sf-mobile-shop-filters row">
				<?php if ( function_exists( 'dynamic_sidebar' ) && sf_is_sidebar_active( 'mobile-woocommerce-filters' ) ) { ?>
                    <?php dynamic_sidebar( 'mobile-woocommerce-filters' ); ?>
                <?php } else { ?>
                	<h5 class="no-widgets container"><?php _e( "Please add widgets to the WooCommerce Filters widget area in Appearance > Widgets", "swiftframework" ); ?></h5>
                <?php } ?>
			</div>

			<?php

		}
		add_action( 'sf_mobile_before_shop_loop_filters', 'sf_mobile_shop_filters', 10 );
	}


    /* SINGLE PRODUCT
    ================================================== */
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    remove_action( 'woocommerce_product_tabs', 'woocommerce_product_description_tab', 10 );
    remove_action( 'woocommerce_product_tab_panels', 'woocommerce_product_description_panel', 10 );

	if ( sf_theme_supports( 'product-summary-tabs' ) ) {
	    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 35 );
	}

	
	/* WOO SINGLE PRODUCT PRICE/RATING
	================================================== */
	if ( ! function_exists( 'sf_product_price_rating' ) ) {
	    function sf_product_price_rating() {
	    	global $post, $product, $sf_catalog_mode, $wpdb;
	   	    ?>
			<div class="product-price-wrap clearfix">
				<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

					<h3 class="price"><?php echo $product->get_price_html(); ?></h3>
					
					<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
					<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />

					<?php if (!$sf_catalog_mode) { ?><link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" /><?php } ?>

				</div>
				
				<?php if ( 'open' == $post->comment_status && $rating_html = $product->get_rating_html() ) : ?>
					<?php echo $rating_html; ?>
				 <?php endif; ?>
				
			</div>
			<?php
		}
		add_action( 'woocommerce_single_product_summary', 'sf_product_price_rating', 10 );
	}


    /* WOO PRODUCT SHORT DESCRIPTION
    ================================================== */
    if ( ! function_exists( 'sf_product_short' ) ) {
        function sf_product_short() {
            global $post;
            $product_short_description = sf_get_post_meta( $post->ID, 'sf_product_short_description', true );
            if ( $product_short_description == "" ) {
                $product_short_description = $post->post_excerpt;
            }
            if ( substr( $product_short_description, 0, 4 ) === '[spb' ) {
                $product_short_description = "";
            }

            if ( $product_short_description != "" ) {
                ?>
                <div class="product-short" class="entry-summary">
                    <?php echo do_shortcode( sf_add_formatting( $product_short_description ) ); ?>
                </div>
            <?php
            }
        }

        add_action( 'woocommerce_single_product_summary', 'sf_product_short', 20 );
    }


    /* WOO PRODUCT SHARE
    ================================================== */
    if ( ! function_exists( 'sf_product_share' ) ) {
        function sf_product_share() {
            global $post;
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );
            ?>
            <div class="article-share product-share" data-buttontext="<?php _e( "Share this", "swiftframework" ); ?>"
                 data-image="<?php echo esc_url($image[0]); ?>"><share-button class="share-button"></share-button></div>
        <?php
        }

        add_action( 'woocommerce_single_product_summary', 'sf_product_share', 45 );
    }
    
    
    /* WOO PRODUCT PAGE BUILDER CONTENT
    ================================================== */
    if ( ! function_exists( 'sf_woo_product_page_builder_content' ) ) {
	    function sf_woo_product_page_builder_content() {
		?>
			<div id="product-display-area" class="clearfix">
				<?php the_content(); ?>		
			</div>
		<?php }
	}
	

    /* WOO PRODUCT META
    ================================================== */
    if ( ! function_exists( 'sf_product_meta' ) ) {
        function sf_product_meta() {
            global $sf_options;
            $modal_delete_icon = apply_filters( 'sf_close_icon', '<i class="ss-delete"></i>' );
            ?>
            <div class="meta-row clearfix">
                <span class="need-help"><?php _e( "Need Help?", "swiftframework" ); ?> <a href="#email-form"
                                                                                          class="inline accent"
                                                                                          data-toggle="modal"><?php _e( "Contact Us", "swiftframework" ); ?></a></span>
                <span class="leave-feedback"><a href="#feedback-form" class="inline accent"
                                                data-toggle="modal"><?php _e( "Leave Feedback", "swiftframework" ); ?></a></span>
            </div>
            <div id="email-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="email-form-modal"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
                            <h3 id="email-form-modal"><?php _e( "Contact Us", "swiftframework" ); ?></h3>
                        </div>
                        <div class="modal-body">
                            <?php echo do_shortcode( $sf_options['email_modal'] ); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="feedback-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="feedback-form-modal"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
                            <h3 id="feedback-form-modal"><?php _e( "Leave Feedback", "swiftframework" ); ?></h3>
                        </div>
                        <div class="modal-body">
                            <?php echo do_shortcode( $sf_options['feedback_modal'] ); ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }

        add_action( 'woocommerce_product_meta_start', 'sf_product_meta', 10 );
    }


    /* WOO HELP BAR
    ================================================== */
    if ( ! function_exists( 'sf_woo_help_bar' ) ) {
        function sf_woo_help_bar() {
            global $sf_options;

            $help_bar_text  = __( $sf_options['help_bar_text'], 'swiftframework' );
            $email_modal    = __( $sf_options['email_modal'], 'swiftframework' );
            $shipping_modal = __( $sf_options['shipping_modal'], 'swiftframework' );
            $returns_modal  = __( $sf_options['returns_modal'], 'swiftframework' );
            $faqs_modal     = __( $sf_options['faqs_modal'], 'swiftframework' );

            $modal_delete_icon = apply_filters( 'sf_close_icon', '<i class="ss-delete"></i>' );
            ?>
            <div class="help-bar clearfix">
                <span><?php echo do_shortcode( $help_bar_text ); ?></span>
                <ul>
                    <?php if ( $email_modal != "" ) { ?>
                        <li><a href="#email-form" class="inline"
                               data-toggle="modal"><?php _e( "Email customer care", "swiftframework" ); ?></a></li>
                    <?php } ?>
                    <?php if ( $shipping_modal != "" ) { ?>
                        <li><a href="#shipping-information" class="inline"
                               data-toggle="modal"><?php _e( "Shipping information", "swiftframework" ); ?></a></li>
                    <?php } ?>
                    <?php if ( $returns_modal != "" ) { ?>
                        <li><a href="#returns-exchange" class="inline"
                               data-toggle="modal"><?php _e( "Returns & exchange", "swiftframework" ); ?></a></li>
                    <?php } ?>
                    <?php if ( $faqs_modal != "" ) { ?>
                        <li><a href="#faqs" class="inline"
                               data-toggle="modal"><?php _e( "F.A.Q.'s", "swiftframework" ); ?></a></li>
                    <?php } ?>
                </ul>
            </div>

            <?php if ( $email_modal != "" ) { ?>
                <div id="email-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="email-form-modal"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
                                <h3 id="email-form-modal"><?php _e( "Email customer care", "swiftframework" ); ?></h3>
                            </div>
                            <div class="modal-body">
                                <?php echo do_shortcode( $email_modal ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ( $shipping_modal != "" ) { ?>
                <div id="shipping-information" class="modal fade" tabindex="-1" role="dialog"
                     aria-labelledby="shipping-modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
                                <h3 id="shipping-modal"><?php _e( "Shipping information", "swiftframework" ); ?></h3>
                            </div>
                            <div class="modal-body">
                                <?php echo do_shortcode( $shipping_modal ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ( $returns_modal != "" ) { ?>
                <div id="returns-exchange" class="modal fade" tabindex="-1" role="dialog"
                     aria-labelledby="returns-modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
                                <h3 id="returns-modal"><?php _e( "Returns & exchange", "swiftframework" ); ?></h3>
                            </div>
                            <div class="modal-body">
                                <?php echo do_shortcode( $returns_modal ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ( $faqs_modal != "" ) { ?>
                <div id="faqs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="faqs-modal"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
                                <h3 id="faqs-modal"><?php _e( "F.A.Q.'s", "swiftframework" ); ?></h3>
                            </div>
                            <div class="modal-body">
                                <?php echo do_shortcode( $faqs_modal ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        <?php
        }
    }

	/* WOO REMOVE PRODUCT FROM CART
    ================================================== */
	if ( ! function_exists('sf_cart_product_remove')){
		function sf_cart_product_remove() {

    		global $wpdb, $woocommerce;

			$id = 0; 
			$variation_id = 0;
			

            if ( ! empty( $_REQUEST['product_id'] ) ) {
                $id = $_REQUEST['product_id'];
            }
            
            if ( ! empty( $_REQUEST['variation_id'] ) ) {
                $variation_id = $_REQUEST['variation_id'];
            }
                                                
            $cart = $woocommerce->cart;
            
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            	
            	    if ( ($cart_item['product_id'] == $id && $variation_id <= 0) || ($cart_item['variation_id'] == $variation_id && $variation_id > 0 ) ){
            	   		$cart->set_quantity($cart_item_key,0);	
					}           
		
            }
            if ( $woocommerce->tax_display_cart == 'excl' ) {
				$totalamount  = wc_price($woocommerce->cart->get_total());
			} else {
				$totalamount  = wc_price($woocommerce->cart->cart_contents_total + $woocommerce->cart->tax_total);
			} 	
   			
   			echo $totalamount;

			die();
    	}

    	add_action( 'wp_ajax_sf_cart_product_remove', 'sf_cart_product_remove' );
		add_action( 'wp_ajax_nopriv_sf_cart_product_remove', 'sf_cart_product_remove' );
	}


	/* WOO SHIPPING CALC BEFORE
	================================================== */
	if ( ! function_exists('sf_cart_shipping_calc_before')){
		function sf_cart_shipping_calc_before() {
			echo '<div class="shipping-calc-wrap">';
			echo '<h4 class="lined-heading">'.__( 'Shipping Calculator', 'swiftframework' ).'</h4>';
		}
		add_action( 'woocommerce_before_shipping_calculator', 'sf_cart_shipping_calc_before' );
	}


	/* WOO SHIPPING CALC AFTER
	================================================== */
	if ( ! function_exists('sf_cart_shipping_calc_after')){
		function sf_cart_shipping_calc_after() {
			echo '</div>';
		}
		add_action( 'woocommerce_after_shipping_calculator', 'sf_cart_shipping_calc_after' );
	}
	
	
	/* WOO VARIATION ADD TO CART BUTTON
	================================================== */
	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
	function sf_single_variation_add_to_cart_button() {
		global $product;
		$loading_text = __( 'Adding...', 'swiftframework' );
		$added_text = __( 'Item added', 'swiftframework' );
		$icon_class = apply_filters( 'sf_add_to_cart_icon_class', 'sf-icon-add-to-cart' );
		?>
		<div class="variations_button">
			<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
			<button type="submit" data-product_id="<?php echo esc_attr($product->id); ?>" data-quantity="1" data-default_text="<?php echo esc_attr($product->single_add_to_cart_text()); ?>" data-default_icon="<?php echo $icon_class; ?>" data-loading_text="<?php echo esc_attr($loading_text); ?>" data-added_text="<?php echo esc_attr($added_text); ?>" class="single_add_to_cart_button button alt"><i class="<?php echo $icon_class; ?>"></i><span><?php echo esc_attr($product->single_add_to_cart_text()); ?></span></button>
			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />
			<?php echo sf_wishlist_button(); ?>
		</div>
		<?php
	}
	add_action( 'woocommerce_single_variation', 'sf_single_variation_add_to_cart_button', 20 );
	
	
	/* WOO GET CATEGORY DESC
	================================================== */
	function sf_woo_get_product_category_description ($category, $return = false) {
		$cat_id        =    $category->term_id;
		$prod_term    =    get_term($cat_id,'product_cat');
		$description=    $prod_term->description;
		
		if ( $return ) {
			return $description;
		} else {
			echo $description;
		}
	}
