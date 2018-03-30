<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/theme-wooocommerce.php
 * @file	 	1.0
 *
 *	1. Pagination
 *  2. Horizontal layout
 *  3. Breadcrumb
 *  4. Single product
 *  5. Cart
 *  6. CSS/JS
 *  7. Checkout
 *  8. Order confirmation
 *  9. View order
 *	10.My account
 *	11.Widgets
 *	12.Shortcodes
 *	13.Various
 *
 */
?>
<?php
/**
 * ------------------------------------------------------------------------
 * 1.	Pagination
 * ------------------------------------------------------------------------
 */
	remove_action('woocommerce_pagination','woocommerce_pagination', 10);
	add_action('woocommerce_pagination','custom_pagination_wrap_start',5);
	add_action('woocommerce_pagination','page_navi',10);
	add_action('woocommerce_pagination','custom_pagination_wrap_mid',15);
	add_action('woocommerce_pagination','custom_pagination_wrap_end',25);
	if ( ! function_exists( 'custom_pagination_wrap_start' ) ) {
		function custom_pagination_wrap_start() {
			echo '<div class="row container shop-pagination"><div class="six columns">';
		}
	}
	if ( ! function_exists( 'custom_pagination_wrap_mid' ) ) {
		function custom_pagination_wrap_mid() {
			echo '</div><div class="six columns">';
		}
	}
	if ( ! function_exists( 'custom_pagination_wrap_end' ) ) {
		function custom_pagination_wrap_end() {
			echo '</div></div>';
		}
	}

/**
 * ------------------------------------------------------------------------
 * 2.	Horizontal layout
 * ------------------------------------------------------------------------
 */
	if($data[$prefix."woocommerce_layout_main"]=="horizontal") {
		remove_action('woocommerce_pagination','custom_pagination_wrap_start',5);
		remove_action('woocommerce_pagination','custom_pagination_wrap_mid',15);
		function woocommerce_pagination_before() {
			echo '<div class="row container"><div class="twelve columns">';
		}
		add_action('woocommerce_pagination','woocommerce_pagination_before',5);
		if ( ! function_exists( 'custom_filter_sidebar_horz' ) ) {
			add_action( 'custom_after_archive_description', 'custom_filter_sidebar_horz', 10 );
			function custom_filter_sidebar_horz() {
				?>
					<div class="clear spacer"></div>

					<div class="store_filter_sidebar horizontal twelve columns clearfix" role="complementary">
						<div class="six columns">
							<?php
								the_widget('WooCommerce_Widget_Price_Filter', array('title'=>'Price Filter'), array('before_title'=>'<h6><span>', 'after_title'=>'</span></h6>'));
							?>
						</div>
						<div class="six columns end">
							<?php
							remove_action('woocommerce_pagination','woocommerce_catalog_ordering', 20);
							add_action('custom_filter_sidebar_horz_module','woocommerce_catalog_ordering',10);
							do_action('custom_filter_sidebar_horz_module');
							//do_action('custom_filter_sidebar');
							?>
						</div>
					</div>
					<div class="clear"></div>
				<?php
			}
		}
	}

/**
 * ------------------------------------------------------------------------
 * 3.	Breadcrumb
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_breadcrumb' ) ) {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
		add_action( 'woocommerce_before_main_content', 'custom_breadcrumb', 9 );
		function custom_breadcrumb( $args = array() ) {

			$defaults = array(
				'delimiter'  => ' &rsaquo; ',
				'wrap_before'  => '<div class="breadcrumb-wrap"><div id="breadcrumb" itemprop="breadcrumb" class="row container clearfix"><div class="twelve columns clearfix" >',
				'wrap_after' => '</div></div></div>',
				'before'   => '',
				'after'   => '',
				'home'    => null
			);

			$args = wp_parse_args( $args, $defaults  );

			woocommerce_get_template( 'shop/breadcrumb.php', $args );
		}
	}

/**
 * ------------------------------------------------------------------------
 * 4.	Single product
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_shop_loop_item_wrapper' ) ) {
		add_action( 'woocommerce_before_shop_loop_item', 'custom_shop_loop_item_wrapper', 10 );
		function custom_shop_loop_item_wrapper() {
			echo '<div class="product_wrapper text-center">';
		}
	}

	if ( ! function_exists( 'custom_shop_loop_item_wrapper_end' ) ) {
		add_action( 'woocommerce_after_shop_loop_item', 'custom_shop_loop_item_wrapper_end', 11 );
		function custom_shop_loop_item_wrapper_end() {
			echo '</div>';
		}
	}

	if ( ! function_exists( 'custom_template_loop_product_thumbnail' ) ) {
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
		add_action( 'woocommerce_before_shop_loop_item_title', 'custom_template_loop_product_thumbnail', 10 );
		function custom_template_loop_product_thumbnail() {
			global $data, $prefix, $post;
			echo '<div class="thumb_wrapper">';
			if($data[$prefix."woocommerce_layout_style"]=="fitrows" && $data[$prefix."woocommerce_layout_fitrows_crop"]=="1") {
				$thumb = featured_image_link_relatedp($post->ID);
				echo '<img src="'.$thumb.'" alt="'.get_the_title().'" title="'.get_the_title().'" width="400" height="400" />';
			} else {
				echo woocommerce_get_product_thumbnail();
			}
			echo '</div>';
		}
	}

	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',9);
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart',10);
	function woocommerce_after_shop_loop_item_title_before() {
		echo '<div class="price_cart_wrapper">';
	}
	function woocommerce_after_shop_loop_item_title_after() {
		echo '</div>';
	}
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_before', 8);
	add_action( 'woocommerce_after_shop_loop_item_title','woocommerce_after_shop_loop_item_title_after', 11);

	add_action( 'custom_before_main_content_single', 'custom_breadcrumb', 10, 0 );
	add_action( 'custom_before_main_content_single', 'custom_output_content_wrapper_single', 10 );
	if ( ! function_exists( 'custom_output_content_wrapper_single' ) ) {
		function custom_output_content_wrapper_single() {
			woocommerce_get_template( 'shop/wrapper-single-start.php' );
		}
	}

	if ( ! function_exists( 'custom_output_content_wrapper_single_end' ) ) {
		add_action( 'custom_after_main_content_single', 'custom_output_content_wrapper_single_end', 10 );
		function custom_output_content_wrapper_single_end() {
			woocommerce_get_template( 'shop/wrapper-single-end.php' );
		}
	}

	remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
	add_action('woocommerce_before_single_product_summary','woocommerce_template_single_title',8);


	remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
	add_action('woocommerce_single_product_summary','woocommerce_show_product_sale_flash',15);

	remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_images',20);
	function woocommerce_single_product_summary_before() {
		echo '<div class="row container">';
	}
	function woocommerce_single_product_summary_before_two() {
		echo '<div class="summary five columns clearfix">';
	}
	function woocommerce_single_product_summary_after() {
		echo '</div></div>';
	}
	function woocommerce_single_product_summary_after_two() {
		echo '</div></div></div>';
	}
	add_action('woocommerce_single_product_summary','woocommerce_single_product_summary_before',5);
	add_action('woocommerce_single_product_summary','woocommerce_show_product_images',6);
	add_action('woocommerce_single_product_summary','woocommerce_single_product_summary_before_two',7);
	add_action('woocommerce_single_product_summary','woocommerce_single_product_summary_after',60);
	add_action('woocommerce_after_single_product_summary','woocommerce_single_product_summary_after_two',5);

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	if($data[$prefix."woocommerce_product_related"]=="1" || $data[$prefix."woocommerce_product_maylike"]=="1") {
		if ( ! function_exists( 'custom_related_wrapper' ) ) {
			add_action('woocommerce_after_single_product_summary','custom_related_wrapper',10);
			function custom_related_wrapper() {
				woocommerce_get_template( 'shop/wrapper-related-start.php' );
			}
		}

		add_action('custom_related_section_upsell','woocommerce_upsell_display',10);
		add_action( 'custom_related_section_products', 'custom_output_related_products', 20 );
		if ( ! function_exists( 'custom_output_related_products' ) ) {
			function custom_output_related_products() {
				global $data, $prefix;
				woocommerce_related_products( $data[$prefix."woocommerce_product_related_count"],2  );
			}
		}
	}

	if($data[$prefix."woocommerce_product_meta_cat_tag"]!="1") {
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
	}
	if($data[$prefix."woocommerce_product_meta_share"]!="1" || $data[$prefix."woocommerce_product_meta_share_method"]=="Zilla-Share") {
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);
	}
	if($data[$prefix."woocommerce_product_meta_share_method"]=="Zilla-Share") {
		if(plugin_is_active('zilla-likes/zilla-share.php')=="activated") {
			add_action('woocommerce_single_product_summary','zilla_share',50);
		}
	}
	if($data[$prefix."woocommerce_product_meta_likes"]=="1") {
		if(plugin_is_active('zilla-likes/zilla-likes.php')=="activated") {
			add_action('woocommerce_before_single_product_summary','zilla_likes',9);
		}
	}

/**
 * ------------------------------------------------------------------------
 * 5.	Cart
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_form_field' ) ) {
		function custom_form_field( $key, $args, $value = '',$login  ) {
			global $woocommerce;

			$defaults = array(
				'type' => 'text',
				'label' => '',
				'placeholder' => '',
				'required' => false,
				'class' => array() ,
				'label_class' => array() ,
				'return' => false,
				'options' => array()
			);

			$args = wp_parse_args( $args, $defaults  );

			if ( ( isset( $args['clear'] ) && $args['clear'] ) ) $after = '<div class="clear"></div>'; else $after = '';

			$required = ( $args['required']  ) ? ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>' : '';

			$field = '';

			switch ( $args['type'] ) {
			case "country" :
				if(in_array('form-row-first',$args['class'] )) {
					$field = '<div class="row"><div class="six columns">';
				} elseif(in_array('form-row-last',$args['class'] )) {
					$field = '</div><div class="six columns">';
				}

				$field .='<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required  . '</label><select name="' . $key . '" id="' . $key . '" class="country_to_state ' . implode( ' ', $args['class'] ) .'">
							<option value="">'.__( 'Select a country&hellip;', 'woocommerce' ) .'</option>';

				foreach ( $woocommerce->countries->get_allowed_countries() as $ckey => $cvalue ) {
					$field .= '<option value="' . $ckey . '" '.selected( $value, $ckey, false ) .'>'.$cvalue .'</option>';
				}

				$field .= '</select><noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . __('Update country', 'woocommerce') . '" /></noscript>';

				$field .= $after;

				if(in_array('form-row-last',$args['class'] )) {
					$field .= '</div></div>';
				}

				break;
			case "state" :

				/* Get Country */
				$country_key = $key == 'billing_state'? 'billing_country' : 'shipping_country';

				if ( isset( $_POST[ $country_key ] ) ) {
					$current_cc = woocommerce_clean( $_POST[ $country_key ] );
				} elseif ( is_user_logged_in() ) {
					$current_cc = get_user_meta( get_current_user_id() , $country_key, true );
				} elseif ( $country_key == 'billing_country' ) {
					$current_cc = apply_filters('default_checkout_country', ($woocommerce->customer->get_country()) ? $woocommerce->customer->get_country() : $woocommerce->countries->get_base_country());
				} else {
					$current_cc 	= apply_filters('default_checkout_country', ($woocommerce->customer->get_shipping_country()) ? $woocommerce->customer->get_shipping_country() : $woocommerce->countries->get_base_country());
				}

				$states = $woocommerce->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {
					if(in_array('form-row-first',$args['class'] )) {
						$field = '<div class="row"><div class="six columns">';
					} elseif(in_array('form-row-last',$args['class'] )) {
						$field = '</div><div class="six columns">';
					}

					$field = '<p style="display:none"><label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label><input type="hidden" class="hidden" name="' . $key  . '" id="' . $key . '" value="" /></p>' . $after;

					if(in_array('form-row-last',$args['class'] )) {
						$field .= '</div></div>';
					}

				} elseif ( is_array( $states ) ) {
					if(in_array('form-row-first',$args['class'] )) {
						$field = '<div class="row"><div class="six columns">';
					} elseif(in_array('form-row-last',$args['class'] )) {
						$field = '</div><div class="six columns">';
					}

					$field .= '<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label><select name="' . $key . '" id="' . $key . '" class="state_select">
						<option value="">'.__( 'Select a state&hellip;', 'woocommerce' ) .'</option>';

					foreach ( $states as $ckey => $cvalue )
						$field .= '<option value="' . $ckey . '" '.selected( $value, $ckey, false ) .'>'.$cvalue.'</option>';

					$field .= '</select>' . $after;

					if(in_array('form-row-last',$args['class'] )) {
						$field .= '</div></div>';
					}

				} else {
					if(in_array('form-row-first',$args['class'] )) {
						$field = '<div class="row"><div class="six columns">';
					} elseif(in_array('form-row-last',$args['class'] )) {
						$field = '</div><div class="six columns">';
					}

					$field .= '<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label><input type="text" class="input-text" value="' . $value . '"  placeholder="' . $args['placeholder'] . '" name="' . $key . '" id="' . $key . '" />'.$after;

					if(in_array('form-row-last',$args['class'] )) {
						$field .= '</div></div>';
					}

				}

				break;
			case "textarea" :
				if(in_array('form-row-first',$args['class'] )) {
					$field = '<div class="row"><div class="six columns">';
				} elseif(in_array('form-row-last',$args['class'] )) {
					$field = '<div class="six columns">';
				}

				$field .='<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required  . '</label><textarea name="' . $key . '" class="input-text" id="' . $key . '" placeholder="' . $args['placeholder'] . '">'. esc_textarea( $value  ) .'</textarea>'.$after;

				if(in_array('form-row-last',$args['class'] )) {
					$field .= '</div></div>';
				}

				break;
			case "checkbox" :
				if(in_array('form-row-first',$args['class'] )) {
					$field = '<div class="row"><div class="six columns">';
				} elseif(in_array('form-row-last',$args['class'] )) {
					$field = '</div><div class="six columns">';
				}

				$field .='<input type="' . $args['type'] . '" class="input-checkbox" name="' . $key . '" id="' . $key . '" value="1" '.checked( $value, 1, false ) .' /><label for="' . $key . '" class="checkbox ' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>'.$after;

				if(in_array('form-row-last',$args['class'] )) {
					$field .= '</div></div>';
				}

				break;
			case "password" :
				if(in_array('form-row-first',$args['class'] )) {
					$field = '<div class="row"><div class="six columns">';
				} elseif(in_array('form-row-last',$args['class'] )) {
					$field = '</div><div class="six columns">';
				}

				$field .='<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label><input type="password" class="input-text" name="' . $key . '" id="' . $key . '" placeholder="' . $args['placeholder'] . '" value="'. $value.'" />'.$after;

				if(in_array('form-row-last',$args['class'] )) {
					$field .= '</div></div>';
				}

				break;
			case "text" :
				if(in_array('form-row-first',$args['class'] )) {
					$field = '<div class="row"><div class="six columns">';
				} elseif(in_array('form-row-last',$args['class'] )) {
					$field = '</div><div class="six columns">';
				}

				$field .='<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';
				$class_add="";
				if($login=="login") {
					$field .='<div class="row collapse"><div class="mobile-one one column"><div class="gravatar"><div class="prefix"></div></div></div><div class="mobile-three eleven columns">';
					$class_add = "gravatar-email";
				}
				$field .='<input type="text" class="input-text '.$class_add.'" name="' . $key . '" id="' . $key . '" placeholder="' . $args['placeholder'] . '" value="'. $value.'" />'.$after;
				if($login=="login") {
					$field .='</div></div>';
				}

				if(in_array('form-row-last',$args['class'] )) {
					$field .= '</div></div>';
				}

				break;
			case "select" :
				if(in_array('form-row-first',$args['class'] )) {
					$field = '<div class="row"><div class="six columns">';
				} elseif(in_array('form-row-last',$args['class'] )) {
					$field = '</div><div class="six columns">';
				}

				$options = '';

				if ( ! empty( $args['options'] ) )
					foreach ( $args['options'] as $option_key => $option_text )
						$options .= '<option value="' . $option_key . '" '. selected( $value, $option_key, false ) . '>' . $option_text .'</option>';

					//$field = '<p class="form-row ' . implode( ' ', $args['class'] ) .'" id="' . $key . '_field">';
					$field .='<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>
						<select name="' . $key . '" id="' . $key . '" class="select">
							' . $options . '
						</select>';
					$field .= $after;

				if(in_array('form-row-last',$args['class'] )) {
					$field .= '</div></div>';
				}

				break;
			default :

				$field = apply_filters( 'woocommerce_form_field_' . $args['type'], '', $key, $args, $value  );

				break;
			}

			if ( $args['return'] ) return $field; else echo $field;
		}
	}

	if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) {
		add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
		function woocommerce_header_add_to_cart_fragment( $fragments ) {
			global $woocommerce;

			ob_start();

			?>
				<?php global $woocommerce; ?>
				<?php if (sizeof($woocommerce->cart->cart_contents)>0) { ?>
		    		<li class="cart-header has-dropdown">
						<a class="cart-contents" href="#" title="<?php _e('View your shopping cart', 'prostore-theme'); ?>"><em class="icon-basket"></em> <?php echo sprintf(_n('%d', $woocommerce->cart->cart_contents_count));?> /  <?php echo $woocommerce->cart->get_cart_total(); ?></a>
						<ul class="mini-cart dropdown">
							<?php
								echo '<li class="divider first"></li>';
								foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
									$_product = $values['data'];
									if ( $_product->exists() && $values['quantity'] > 0 ) {
										echo '<li class="item">';
										if ( ! $_product->is_visible() || ( $_product instanceof WC_Product_Variation && ! $_product->parent_is_visible() ) )
											echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
										else
											echo '<dl>';
												echo '<dt>';
													printf('<a href="%s"><strong>%s (%s)</strong></a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ), $values['quantity']);
												echo '</dt>';
												echo '<dd class="text-right">';
													$amount =  apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
													printf('<a href="%s"><strong>%s</strong></a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $amount );
												echo '</dd>';
												echo '<div class="clear"></div>';
											echo '</dl>';

										echo '</li>';
										echo '<li class="divider"></li>';

									}
								}
							?>
							<li class="text-center footer">
								<a class="cart-contents button success" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'prostore-theme'); ?>" class="button">View cart</a>

								<a href="<?php echo $woocommerce->cart->get_checkout_url()?>" title="<?php _e('Checkout','prostore-theme') ?>" class="button"><?php _e('Checkout','prostore-theme') ?></a>
							</li>
						</ul>
		    		</li>
		    	<?php } ?>
		    	<?php

			$fragments['li.cart-header'] = ob_get_clean();

			return $fragments;

		}
	}

/**
 * ------------------------------------------------------------------------
 * 6.	CSS/JS
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'child_manage_woo_styles' ) ) {
		define( 'WOOCOMMERCE_USE_CSS', false );
		function child_manage_woo_styles() {

			wp_dequeue_script( 'fancybox' );
			wp_dequeue_style('woocommerce_fancybox_styles');

			wp_dequeue_script( 'wc-checkout' );
			wp_register_script( 'wc-custom-checkout', get_template_directory_uri() . '/woocommerce/checkout.js', 'jQuery', '1.0', true);
			wp_enqueue_script( 'wc-custom-checkout' );

			wp_dequeue_script( 'wc-cart' );
			wp_register_script( 'wc-custom-cart', get_template_directory_uri() . '/woocommerce/cart.js', 'jQuery', '1.0', true);
			wp_enqueue_script( 'wc-custom-cart' );

			wp_dequeue_script( 'wc-single-product' );
			wp_register_script( 'wc-custom-single-product', get_template_directory_uri() . '/woocommerce/single-product.js', 'jQuery', '1.0', true);
			wp_enqueue_script( 'wc-custom-single-product' );
			wp_dequeue_style ('woocommerce_chosen_styles' );
		}
		add_action( 'wp_enqueue_scripts', 'child_manage_woo_styles', 20 );
	}

/**
 * ------------------------------------------------------------------------
 * 7.	Checkout
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_checkout_breadcrumb' ) ) {
		add_action('woocommerce_before_checkout_form','custom_checkout_breadcrumb',11);
		function custom_checkout_breadcrumb() {
			?>
				<div class="panel checkout-breadcrumb hide-on-print">
					<div class="row">
						<div class="six columns mobile-two first_step active">
							<h3>1 / Review information</h3>
						</div>
						<div class="six columns mobile-two second_step">
							<h3>2 / Place order</h3>
						</div>
					</div>
				</div>
			<?php
		}
	}

/**
 * ------------------------------------------------------------------------
 * 8.	Order confirmation
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_thankyou_breadcrumb' ) ) {
		add_action('woocommerce_thankyou','custom_thankyou_breadcrumb',8);
		function custom_thankyou_breadcrumb() {
			?>
				<div class="panel checkout-breadcrumb hide-on-print">
					<div class="row">
						<div class="six columns mobile-two first_step">
							<h3>1 / Review information</h3>
						</div>
						<div class="six columns mobile-two second_step active">
							<h3>2 / Place order</h3>
						</div>
					</div>
				</div>
			<?php
		}
	}

	remove_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );
	add_action( 'custom_thankyou', 'woocommerce_order_details_table', 10 );

/**
 * ------------------------------------------------------------------------
 * 9.	View order
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_view_order' ) ) {
		function custom_view_order($attr, $content = null) {
			$output = apply_filters('woocommerce_view_order', '', $attr, $content);
			if ( $output != '' )
				return $output;


			global $woocommerce;

			$woocommerce->nocache();

			if ( ! is_user_logged_in() ) return;

			$user_id      	= get_current_user_id();
			$order_id		= ( isset( $_GET['order'] ) ) ? $_GET['order'] : 0;
			$order 			= new WC_Order( $order_id );

			if ( $order_id == 0 ) {
				woocommerce_get_template('myaccount/my-orders.php', array( 'recent_orders' => 10 ));
				return;
			}

			if ( $order->user_id != $user_id ) {
				echo '<ul class="woocommerce_message alert alert-box"><li><span class="alert-color"><em class="icon-cancel"></em></span></li><li>' . __('Invalid order.', 'woocommerce') . '</li></ul>';


				echo '<p class="submit-changes text-center"><a href="'.get_permalink( woocommerce_get_page_id('myaccount') ).'" class="button large"><em class="icon-left-open"></em> '. __('My Account', 'woocommerce') .'</a>' . '</p>';
				return;
			}

			$status = get_term_by('slug', $order->status, 'shop_order_status');

			$order_status_text = sprintf( __('Order %s which was made %s has the status &ldquo;%s&rdquo;', 'woocommerce'), $order->get_order_number(),date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ), 'woocommerce');

		?>

				<div class="tracking_alert alert-box <?php echo $status->name; ?>">
					<div class="icon-box">
						<?php
							switch($status->name) {
								case "pending" :
									echo '<em class="icon-progress"></em>';
									break;
								case "failed" :
									echo '<em class="icon-cancel"></em>';
									break;
								case "on-hold" :
									echo '<em class="icon-flag"></em>';
									break;
								case "processing" :
									echo '<em class="icon-progress"></em>';
									break;
								case "completed" :
									echo '<em class="icon-ok"></em>';
									break;
								case "refunded" :
									echo '<em class="icon-back-alt"></em>';
									break;
								case "cancelled" :
									echo '<em class="icon-cancel"></em>';
									break;
							}
						?>
					</div>
					<div>
						<p><?php _e('Thank you. Your order has been received.', 'woocommerce'); ?></p>
						<?php
							if ($order->status == 'completed') {
								$order_status_text .= ' ' . __('made on', 'woocommerce') . ' ' . date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) );
							}

							$order_status_text .= '.';

							echo wpautop(apply_filters('woocommerce_order_tracking_status', $order_status_text, $order));
						?>
					</div>
				</div>

			<?php

			$notes = $order->get_customer_order_notes();
			if ($notes) :
				?>
				<h4><em class="icon-rss-alt"></em> <?php _e('Order Updates', 'woocommerce'); ?></h4>
				<div class="panel order_updates">
					<ol class="commentlist notes">
						<?php foreach ($notes as $note) : ?>
						<li class="comment note">
							<div class="comment_container row container">
								<div class="comment-text four columns">
									<p class="meta"><?php echo date_i18n('l jS \of F Y, h:ia', strtotime($note->comment_date)); ?></p>
								</div>
								<div class="description eight columns">
										<?php echo wpautop(wptexturize($note->comment_content)); ?>
								</div>
							</div>
						</li>
						<?php endforeach; ?>
					</ol>
				</div>
				<?php
			endif;

			do_action( 'woocommerce_view_order', $order_id );
		}
		add_shortcode('woocommerce_view_order', 'custom_view_order');
	}

/**
 * ------------------------------------------------------------------------
 * 10.	My account
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'info_user_panel' ) ) {
		add_action('before_title_user_info','info_user_panel',10);
		function info_user_panel() {
			?>
		<div class="panel user_info log_box logged_in">
			<div class="icon-box">
				<?php global $userdata; get_currentuserinfo(); echo get_avatar( $userdata->ID, 42 ); ?>
			</div>
			<h5>Hello <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><span class="alert-color"><?php echo $userdata->display_name; ?></span></a> !</h5>
			<div class="utility-links">
				<a href="<?php echo get_permalink(woocommerce_get_page_id('change_password')); ?>" class="changepassword"><em class="icon-key"></em> <span class="hide-for-small">Change password</span></a>
				&#124;
				<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout"><em class="icon-logout"></em> <span class="hide-for-small">Logout</span></a>
			</div>
		</div>
			<?php
		}
	}

/**
 * ------------------------------------------------------------------------
 * 11.	Widgets
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_price_filter_init' ) ) {
		remove_action('init','woocommerce_price_filter_init');
		add_action('init','custom_price_filter_init');
		function custom_price_filter_init() {
			global $woocommerce;

			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_register_script( 'wc-price-slider', $woocommerce->plugin_url() . '/assets/js/frontend/price-slider' . $suffix . '.js', array( 'jquery-ui' ), '1.6', true );

			unset( $_SESSION['min_price'] );
			unset( $_SESSION['max_price'] );

			if ( isset( $_GET['min_price'] ) )
				$_SESSION['min_price'] = $_GET['min_price'];

			if ( isset( $_GET['max_price'] ) )
				$_SESSION['max_price'] = $_GET['max_price'];

			add_filter( 'loop_shop_post_in', 'woocommerce_price_filter' );
		}
	}

	if ( ! function_exists( 'custom_layered_nav_init' ) ) {
		remove_action('init','woocommerce_layered_nav_init',1);
		add_action('init','custom_layered_nav_init',1);
		function custom_layered_nav_init() {
			global $_chosen_attributes, $woocommerce, $_attributes_array;

			$_chosen_attributes = array();
			$_attributes_array = array();

			$attribute_taxonomies = $woocommerce->attribute_taxonomies;
			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $tax ) {

			    	$attribute = strtolower(sanitize_title($tax->attribute_name));
			    	$taxonomy = $woocommerce->attribute_taxonomy_name($attribute);

					// create an array of product attribute taxonomies
					$_attributes_array[] = $taxonomy;

			    	$name = 'filter_' . $attribute;
			    	$query_type_name = 'query_type_' . $attribute;

			    	if ( ! empty( $_GET[$name] ) && taxonomy_exists( $taxonomy ) ) {

			    		$_chosen_attributes[$taxonomy]['terms'] = explode( ',', $_GET[ $name ] );

			    		if ( ! empty( $_GET[$query_type_name] ) && $_GET[ $query_type_name ] == 'or' )
			    			$_chosen_attributes[$taxonomy]['query_type'] = 'or';
			    		else
			    			$_chosen_attributes[$taxonomy]['query_type'] = 'and';

					}
				}
		    }

		    add_filter('loop_shop_post_in', 'woocommerce_layered_nav_query');
		}
	}

/**
 * ------------------------------------------------------------------------
 * 12.	Shortcodes
 * ------------------------------------------------------------------------
 */
	function sc_sale_products( $atts ) {

	global $woocommerce_loop, $wp_query, $woocommerce;

	extract(shortcode_atts(array(
		'per_page' 	=> '12',
		'orderby' => 'date',
		'order' => 'desc'
	), $atts));


// Get products on sale
		if ( false === ( $product_ids_on_sale = get_transient( 'wc_products_onsale' ) ) ) {

			$meta_query = array();

		    $meta_query[] = array(
		    	'key' => '_sale_price',
		        'value' 	=> 0,
				'compare' 	=> '>',
				'type'		=> 'NUMERIC'
		    );

			$on_sale = get_posts(array(
				'post_type' 		=> array('product', 'product_variation'),
				'posts_per_page' 	=> -1,
				'post_status' 		=> 'publish',
				'meta_query' 		=> $meta_query,
				'fields' 			=> 'id=>parent'
			));

			$product_ids 	= array_keys( $on_sale );
			$parent_ids		= array_values( $on_sale );

			// Check for scheduled sales which have not started
			foreach ( $product_ids as $key => $id )
				if ( get_post_meta( $id, '_sale_price_dates_from', true ) > current_time('timestamp') )
					unset( $product_ids[ $key ] );

			$product_ids_on_sale = array_unique( array_merge( $product_ids, $parent_ids ) );

			set_transient( 'wc_products_onsale', $product_ids_on_sale );

		}

		$product_ids_on_sale[] = 0;

		$meta_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
	    $meta_query[] = $woocommerce->query->stock_status_meta_query();

    	$query_args = array(
    		'posts_per_page' 	=> $per_page,
    		'no_found_rows' => 1,
    		'post_status' 	=> 'publish',
    		'post_type' 	=> 'product',
    		'orderby' 		=> $orderby,
    		'order' 		=> $order,
    		'meta_query' 	=> $meta_query,
    		'post__in'		=> $product_ids_on_sale
    	);

	ob_start();

	$products = new WP_Query( $query_args );

	if ( $products->have_posts() ) : ?>

		<ul class="products">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		</ul>

	<?php endif;

	wp_reset_query();

	return ob_get_clean();
}

/**
 * ------------------------------------------------------------------------
 * 13.	Various
 * ------------------------------------------------------------------------
 */
	if ( ! function_exists( 'custom_single_item_availability' ) ) {
		add_action('woocommerce_after_add_to_cart_form','custom_single_item_availability',10);
		function custom_single_item_availability() {
			global $woocommerce, $product;
			// Availability
			$availability = $product->get_availability();

			if ($availability['availability']) :

				if ( $product->is_in_stock() ) :
					echo '<div class="clear separator-form-stock clearfix"></div>';
				endif;

				echo apply_filters( 'woocommerce_stock_html', '<div class="clear"></div><p class="stock '.$availability['class'].'"><em class="icon-info"></em> '.$availability['availability'].'</p>', $availability['availability'] );
		    endif;

		}
	}

	if ( ! function_exists( 'custom_variable_add_to_cart' ) ) {
		remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
		add_action( 'woocommerce_variable_add_to_cart', 'custom_variable_add_to_cart', 30 );
		function custom_variable_add_to_cart() {
			global $product;
			wp_register_script( 'wc-custom-add-to-cart-variation', get_template_directory_uri() . '/woocommerce/add-to-cart-variation.js', 'jQuery', '1.0', true);
			wp_enqueue_script( 'wc-custom-add-to-cart-variation' );
		// Load the template
		woocommerce_get_template( 'single-product/add-to-cart/variable.php', array(
				'available_variations'  => $product->get_available_variations(),
				'attributes'   			=> $product->get_variation_attributes(),
				'selected_attributes' 	=> $product->get_variation_default_attributes()
			) );
		}
	}

	remove_filter( 'wp_nav_menu_items', 'woocommerce_nav_menu_items', 10, 2 );

	if ( ! function_exists( 'change_free_price_notice' ) ) {
		add_filter( 'woocommerce_variable_free_price_html', 'change_free_price_notice', 10, 2 );
		add_filter( 'woocommerce_free_price_html',          'change_free_price_notice', 10, 2 );
		function change_free_price_notice( $price, $product ) {
	  		return '<span class="amount">Free !</span>';
		}
	}

	if ( ! function_exists( 'custom_taxonomy_archive_description' ) ) {
		remove_action( 'woocommerce_taxonomy_archive_description', 'woocommerce_taxonomy_archive_description');
		add_action( 'woocommerce_taxonomy_archive_description', 'custom_taxonomy_archive_description',10);
		function custom_taxonomy_archive_description() {
			if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 )
				if(term_description())
				echo '<div class="term-description panel">' . wpautop( wptexturize( term_description() ) ) . '</div>';
		}
	}

	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );