<?php
	/*
	*
	*	WooCommerce Functions & Hooks
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/
	
	/* BASIC FILTER HOOKS
	================================================== */ 
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
	
	/* Add Shipping Calculator to after cart action */
	add_action( 'woocommerce_after_cart_table', 'woocommerce_shipping_calculator', 10 );
	
	/* Remove totals from cart collaterals */
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
	
	/* WOOCOMMERCE CONTENT FUNCTIONS
	================================================== */
	function sf_product_thumb_image_html($html) {
		$html = '<li>'.$html.'</li>';
		return $html;
	}
	add_filter('woocommerce_single_product_image_thumbnail_html', 'sf_product_thumb_image_html');
	
	
	/* WOOCOMMERCE CONTENT FUNCTIONS
	================================================== */ 
	function sf_get_product_stars() {
		
		$stars_output = "";
		
	    global $wpdb;
	    global $post;
	    $count = $wpdb->get_var("
		    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		    WHERE meta_key = 'rating'
		    AND comment_post_ID = $post->ID
		    AND comment_approved = '1'
		    AND meta_value > 0
		");
		
		$rating = $wpdb->get_var("
		    SELECT SUM(meta_value) FROM $wpdb->commentmeta
		    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		    WHERE meta_key = 'rating'
		    AND comment_post_ID = $post->ID
		    AND comment_approved = '1'
		");
		
		if ( $count > 0 ) {
		
		    $average = number_format($rating / $count, 2);
		
		    $stars_output .= '<div class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
		
		    $stars_output .= '<span class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'swiftframework'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> </span></span>';
		
		    $stars_output .= '</div>';
		}
		
		return $stars_output;
	}
	
	function sf_is_out_of_stock() {
	    global $post;
	    $post_id = $post->ID;
	    $stock_status = sf_get_post_meta($post_id, '_stock_status',true);
	    
	    if ($stock_status == 'outofstock') {
	    return true;
	    } else {
	    return false;
	    }
	}
	
	function sf_product_items_text($count) {
			
		$product_item_text = "";
		
    	if ( $count > 1 ) {
        	$product_item_text = str_replace('%', number_format_i18n($count), __('% items', 'swiftframework'));
        } elseif ( $count == 0 ) {
        	$product_item_text = __('0 items', 'swiftframework');
        } else {
        	$product_item_text = __('1 item', 'swiftframework');
        }
        
        return $product_item_text;
        
	}
	
	
	/* REMOVE WOOCOMMERCE PRETTYPHOTO STYLES/SCRIPTS
    ================================================== */
    function sf_remove_woo_lightbox_js() {
    	if ( ! class_exists( 'WC_Quick_View' ) ) {
	        wp_dequeue_script( 'prettyPhoto' );
	        wp_dequeue_script( 'prettyPhoto-init' );
	    }
    }

    add_action( 'wp_enqueue_scripts', 'sf_remove_woo_lightbox_js', 99 );

    function sf_remove_woo_lightbox_css() {
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    }

    add_action( 'wp_enqueue_styles', 'sf_remove_woo_lightbox_css', 99 );
    
	
	/* ADD TO CART HEADER RELOAD
	================================================== */ 
	if (!function_exists('sf_woo_header_add_to_cart_fragment')) {
		function sf_woo_header_add_to_cart_fragment( $fragments ) {
			global $woocommerce;
			
			ob_start();
			
			$cart_total = WC()->cart->get_cart_total();
			$cart_count = $woocommerce->cart->cart_contents_count;
			$cart_count_text = sf_product_items_text($cart_count);
			$price_display_suffix  = get_option( 'woocommerce_price_display_suffix' );
			
			$options = get_option('sf_dante_options');				
			$show_cart_count = false;
			if (isset($options['show_cart_count'])) {
				$show_cart_count = $options['show_cart_count'];
			}	
			?>	
			
			<li class="parent shopping-bag-item">
				<?php if ($show_cart_count) { ?>
				<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'swiftframework'); ?>"><i class="ss-cart"></i><?php echo $woocommerce->cart->get_cart_total(); ?> (<?php echo $cart_count; ?>)</a>
				<?php } else { ?>
				<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'swiftframework'); ?>"><i class="ss-cart"></i><?php echo $woocommerce->cart->get_cart_total(); ?></a>
				<?php }  ?>
				<ul class="sub-menu">     
					<li>                                      
						<div class="shopping-bag">
			 				
							<?php if ( $cart_count != "0" ) { ?>
							
								<div class="bag-header"><?php echo $cart_count_text; ?> <?php _e('in the shopping bag', 'swiftframework'); ?></div>
								
								<div class="bag-contents">
									
									<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { ?>
								    	
								    	<?php
									        $_product     		 = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
									        $price 				 = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									        $product_title       = $_product->get_title();
									        $product_short_title = ( strlen( $product_title ) > 25 ) ? substr( $product_title, 0, 22 ) . '...' : $product_title;
								        ?>
								                                          
								        <?php if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) { ?>                                            
								        
								        	<div class="bag-product clearfix">   	
							            	
								            	<figure><a class="bag-product-img" href="<?php echo get_permalink($cart_item['product_id']); ?>"><?php echo $_product->get_image(); ?></a></figure>                   
									            
									            <div class="bag-product-details">
									           		<div class="bag-product-title">
									           			<a href="<?php echo get_permalink($cart_item['product_id']); ?>">
									           				<?php echo apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product); ?></a>
									           		</div>
									            	<div class="bag-product-price"><?php _e("Unit Price:", "swiftframework"); ?> <?php echo $price; ?></div>
									            	<div class="bag-product-quantity"><?php _e('Quantity:', 'swiftframework'); ?> <?php echo $cart_item['quantity']; ?></div>
									            	<?php if ( $price_display_suffix ) { ?>
									            		<small class="woocommerce-price-suffix"><?php echo $price_display_suffix; ?></small>
									            	<?php } ?>
									            </div>
									            	
									            <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'swiftframework') ), $cart_item_key ); ?>
									            
									    	</div>
								    	
								    	<?php } ?>
								    	
								    <?php } ?>
							    
							    </div>
							    
							    <div class="bag-buttons">
							    
							    	<a class="sf-button standard sf-icon-reveal bag-button" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><i class="ss-view"></i><span class="text"><?php _e('View shopping bag', 'swiftframework'); ?></span></a>
							    
							    	<a class="sf-button standard sf-icon-reveal checkout-button" href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>"><i class="ss-creditcard"></i><span class="text"><?php _e('Proceed to checkout', 'swiftframework'); ?></span></a>
							                    
								</div>
				
							<?php } else { ?>
									
								<div class="bag-header"><?php _e("0 items in the shopping bag", "swiftframework"); ?></div>
									
								<div class="bag-empty"><?php _e('Unfortunately, your shopping bag is empty.','swiftframework'); ?></div>                                   
														
								<div class="bag-buttons">
									
									<?php
										$shop_page_url = "";
										if ( version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0 ) {
											$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
										} else {
											$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
										}
									?>
									
									<a class="sf-button standard sf-icon-reveal checkout-button" href="<?php echo esc_url( $shop_page_url ); ?>"><i class="ss-cart"></i><span class="text"><?php _e('Go to the shop', 'swiftframework'); ?></span></a>
																            	                
								</div>
									
							<?php } ?>
				
							</div>
						</li>                                                                                                    
					</ul>                                                                                                          
				</li>
				
			<?php
			
			$fragments['.shopping-bag-item'] = ob_get_clean();
			
			return $fragments;
			
		}
		add_filter('add_to_cart_fragments', 'sf_woo_header_add_to_cart_fragment'); 
	}
	
	/* WISHLIST BUTTON
	================================================== */
	if (!function_exists('sf_wishlist_button')) {
		function sf_wishlist_button() {

			global $product, $yith_wcwl;

			if ( class_exists( 'YITH_WCWL_UI' ) )  {
				
				$product_type = $product->product_type;			
				
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
				
				$classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';

				$html  = '<div class="yith-wcwl-add-to-wishlist">';
				    $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

				    $html .= $exists ? ' hide" style="display:none;"' : ' show"';

				    $html .= '><a href="' . htmlspecialchars($yith_wcwl->get_addtowishlist_url()) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' ><i class="fa-star"></i></a>';
				    $html .= '</div>';

				$html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><span class="feedback">' . __( 'Product added to wishlist.', 'swiftframework' ) . '</span> <a href="' . $url . '"><i class="fa-check"></i></a></div>';
				$html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . $url . '"><i class="fa-check"></i></a></div>';
				$html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

				$html .= '</div>';

				return $html;

			}

		}
	}



	/* WISHLIST BUTTON
	================================================== */ 
	/*
	if (!function_exists('sf_wishlist_button')) {
		function sf_wishlist_button() {
		
			global $product, $yith_wcwl; 
			
			if ( class_exists( 'YITH_WCWL_UI' ) )  {
				$url = $yith_wcwl->get_wishlist_url();
				$product_type = $product->product_type;
				$exists = $yith_wcwl->is_product_in_wishlist( $product->id );
				
				$classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';
				
				$html = '<div class="yith-wcwl-add-to-wishlist">'; 
				    $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row
				    
				    $html .= $exists ? ' hide" style="display:none;"' : ' show"';
				    
				    $html .= '><a href="' . htmlspecialchars($yith_wcwl->get_addtowishlist_url()) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' ><i class="ss-star"></i></a>';
				    $html .= '</div>';
				
				$html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><span class="feedback">' . __( 'Product added to wishlist.', 'swiftframework' ) . '</span> <a href="' . $url . '"><i class="fa-check"></i></a></div>';
				$html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . $url . '"><i class="fa-check"></i></a></div>';
				$html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';
				
				$html .= '</div>';
				
				return $html;
			}
		}
	}
	
	*/
	/* SHOW PRODUCTS COUNT URL PARAMETER
	================================================== */ 
	if (isset($_GET['layout'])) {
		$page_layout = $_GET['layout'];
	}
	if ( !function_exists('sf_product_shop_count') ) {
		function sf_product_shop_count() {
			$default_count = 24;

			$count = isset($_GET['show_products']) ? $_GET['show_products'] : $default_count;

			if ($count === 'all') {
				$count = -1;
			}
			else if ( ! is_numeric($count)) {
				$count = $default_count;
			}

			return $count;
		}	
	}
	add_filter( 'loop_shop_per_page', 'sf_product_shop_count');

	
	/* SINGLE PRODUCT
	================================================== */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	remove_action( 'woocommerce_product_tabs', 'woocommerce_product_description_tab', 10 );
	remove_action( 'woocommerce_product_tab_panels', 'woocommerce_product_description_panel', 10 );
	
	$options = get_option('sf_dante_options');
	if (isset($options['enable_default_tabs'])) {
		$enable_default_tabs = $options['enable_default_tabs'];
	} else {
		$enable_default_tabs = false;
	}
	
	if ($enable_default_tabs) {	
	add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 35);	
	} else {
	add_action( 'woocommerce_single_product_summary', 'sf_product_accordion', 35);	
	}
	add_action( 'woocommerce_single_product_summary', 'sf_product_share', 45);
	
	
	/* PRODUCT ACCORDION
	================================================== */ 
	if (!function_exists('sf_product_accordion')) {
		function sf_product_accordion() {
			global $woocommerce, $product, $post;
			
			$options = get_option('sf_dante_options');
			if (isset($options['enable_pb_product_pages'])) {
				$enable_pb_product_pages = $options['enable_pb_product_pages'];
			} else {
				$enable_pb_product_pages = false;
			}
			
			$product_description = sf_get_post_meta($post->ID, 'sf_product_description', true);
		?>
			<div class="panel-group" id="product-accordion">
							
				<div class="panel panel-default">
					<div class="panel-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#product-accordion" href="#product-desc">
							<?php _e("Description", "swiftframework"); ?>
						</a>
			    	</div>
			    	<div id="product-desc" class="accordion-body collapse in">
			      		<div class="accordion-inner" itemprop="description">
			      			<?php 
			      				if ($enable_pb_product_pages) {
			       					echo do_shortcode(sf_add_formatting($product_description));
			       				} else {
			       					the_content();
			       				}
			       			?>
			      		</div>
			  		</div>
				</div>
							
				<div class="panel">
					<div class="panel-heading">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#product-accordion" href="#additional-information">
							<?php _e("Additional Information", "swiftframework"); ?>
						</a>
					</div>
					<div id="additional-information" class="accordion-body collapse">
				  		<div class="accordion-inner">
				   			<?php $product->list_attributes(); ?>
				  		</div>
					</div>
				</div>
				<?php if ( comments_open() ) : ?>
				<div class="panel">
					<div class="panel-heading">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#product-accordion" href="#reviews">
							<?php _e("Reviews", "swiftframework"); ?> (<?php echo comments_number( '0', '1', '%' ); ?>)
						</a>
					</div>
					<div id="reviews" class="accordion-body collapse">
				  		<div class="accordion-inner">			   						   			
				   			<?php comments_template(); ?>
				  		</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		<?php 
		}
	}
	
	
	/* WOO PRODUCT SHARE
	================================================== */ 
	if (!function_exists('sf_product_share')) {
		function sf_product_share() {
			global $post;
			$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
		?>
			<div class="product-share clearfix">
				<span><?php _e("Share", "swiftframework"); ?></span>
				<ul class="social-icons">
				    <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="product_share_facebook" onclick="javascript:window.open(this.href,
				      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i class="fa-facebook"></i><i class="fa-facebook"></i></a></li>
				    <li class="twitter"><a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo urlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href,
				      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" class="product_share_twitter"><i class="fa-twitter"></i><i class="fa-twitter"></i></a></li>   
				    <li class="googleplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
				      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa-google-plus"></i><i class="fa-google-plus"></i></a></li>
				    <li class="pinterest"><a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $src[0]; ?>&description=<?php the_title(); ?>" onclick="javascript:window.open(this.href,
				      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=750');return false;" class="product_share_pinterest"><i class="fa-pinterest"></i><i class="fa-pinterest"></i></a></li>
				    <li class="mail"><a href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(apply_filters( 'woocommerce_short_description', $post->post_excerpt )); ?> <?php the_permalink(); ?>" class="product_share_email"><i class="ss-mail"></i><i class="ss-mail"></i></a></li>
				</ul>  
			</div> 
		<?php }
	}
	
	
	/* WOO HELP BAR
	================================================== */ 
	if (!function_exists('sf_woo_help_bar')) {
		function sf_woo_help_bar() {
			$options = get_option('sf_dante_options');
			
			$help_bar_text = __($options['help_bar_text'], 'swiftframework');
			$email_modal = __($options['email_modal'], 'swiftframework');
			$shipping_modal = __($options['shipping_modal'], 'swiftframework');
			$returns_modal = __($options['returns_modal'], 'swiftframework');
			$faqs_modal = __($options['faqs_modal'], 'swiftframework');
		?>
			<div class="help-bar clearfix">
				<span><?php echo do_shortcode($help_bar_text); ?></span>
				<ul>
				    <li><a href="#email-form" class="inline" data-toggle="modal"><?php apply_filters('sf_woo_help_email_link', _e("Email customer care", "swiftframework")); ?></a></li>
				    <li><a href="#shipping-information" class="inline" data-toggle="modal"><?php apply_filters('sf_woo_help_shipping_link', _e("Shipping information", "swiftframework")); ?></a></li>
				    <li><a href="#returns-exchange" class="inline" data-toggle="modal"><?php apply_filters('sf_woo_help_returns_link', _e("Returns & exchange", "swiftframework")); ?></a></li>
				    <li><a href="#faqs" class="inline" data-toggle="modal"><?php apply_filters('sf_woo_help_faqs_link', _e("F.A.Q.'s", "swiftframework")); ?></a></li>
				</ul>
			</div>
			
			<div id="email-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="email-form-modal" aria-hidden="true">
				<div class="modal-dialog">
				    <div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="ss-delete"></i></button>
							<h3 id="email-form-modal"><?php apply_filters('sf_woo_help_email_title', _e("Email customer care", "swiftframework")); ?></h3>
						</div>
						<div class="modal-body">
							<?php echo do_shortcode($email_modal); ?>
						</div>
					</div>
				</div>
			</div>
			
			<div id="shipping-information" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="shipping-modal" aria-hidden="true">
				<div class="modal-dialog">
				    <div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="ss-delete"></i></button>
							<h3 id="shipping-modal"><?php apply_filters('sf_woo_help_shipping_title', _e("Shipping information", "swiftframework")); ?></h3>
						</div>
						<div class="modal-body">	
							<?php echo do_shortcode($shipping_modal); ?>
						</div>
					</div>
				</div>
			</div>
			
			<div id="returns-exchange" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="returns-modal" aria-hidden="true">
				<div class="modal-dialog">
				    <div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="ss-delete"></i></button>
							<h3 id="returns-modal"><?php apply_filters('sf_woo_help_returns_title', _e("Returns & exchange", "swiftframework")); ?></h3>
						</div>
						<div class="modal-body">					
						<?php echo do_shortcode($returns_modal); ?>
							</div>
					</div>
				</div>
			</div>
			
			<div id="faqs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="faqs-modal" aria-hidden="true">
				<div class="modal-dialog">
				    <div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="ss-delete"></i></button>
							<h3 id="faqs-modal"><?php apply_filters('sf_woo_help_faqs_title', _e("F.A.Q.'s", "swiftframework")); ?></h3>
						</div>
						<div class="modal-body">
							<?php echo do_shortcode($faqs_modal); ?>
						</div>
					</div>
				</div>
			</div>
			
		<?php }
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
		?>
		<div class="variations_button">
			<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
			<?php 
				$button_text = '<i class="ss-cart"></i>' . apply_filters('single_add_to_cart_text', __("Add to shopping bag", "swiftframework"), $product->product_type);
			?>	
			<button type="submit" data-product_id="<?php echo esc_attr($product->id); ?>" data-quantity="1" data-default_text="<?php echo esc_attr($product->single_add_to_cart_text()); ?>" data-default_icon="sf-icon-add-to-cart" data-loading_text="<?php echo esc_attr($loading_text); ?>" data-added_text="<?php echo esc_attr($added_text); ?>" class="single_add_to_cart_button button alt"><span><?php echo $button_text; ?></span></button>
			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />
			<?php echo sf_wishlist_button(); ?>
		</div>
		<?php
	}
	add_action( 'woocommerce_single_variation', 'sf_single_variation_add_to_cart_button', 20 );
?>