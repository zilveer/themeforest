<?php
/*-----------------------------------------------------------------------------------*/
/* This theme supports WooCommerce, woo! */
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

// Load WooCommerce stylsheet
if ( ! is_admin() ) { add_action( 'get_header', 'woo_load_woocommerce_css', 20 ); }

if ( ! function_exists( 'woo_load_woocommerce_css' ) ) {
	function woo_load_woocommerce_css () {
		wp_register_style( 'woocommerce', get_template_directory_uri() . '/includes/assets/css/woocommerce.css' );
		wp_enqueue_style( 'woocommerce' );
	}
}

// If theme lightbox is enabled, disable the WooCommerce lightbox and make product images prettyPhoto galleries
add_action( 'wp_footer', 'woocommerce_prettyphoto' );
function woocommerce_prettyphoto() {
	global $woo_options;
	if ( isset( $woo_options[ 'woo_enable_lightbox' ] ) && $woo_options[ 'woo_enable_lightbox' ] == "true" ) {
		update_option( 'woocommerce_enable_lightbox', false );
		?>
			<script>
				jQuery(document).ready(function(){
					jQuery('.images a').attr('rel', 'prettyPhoto[product-gallery]');
				});
			</script>
		<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Hook in on activation */
/*-----------------------------------------------------------------------------------*/

global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action('init', 'woo_install_theme', 1);

/*-----------------------------------------------------------------------------------*/
/* Install */
/*-----------------------------------------------------------------------------------*/

function woo_install_theme() {

	// Image sizes
		update_option( 'woocommerce_thumbnail_image_width', '100' );
		update_option( 'woocommerce_thumbnail_image_height', '100' );
		update_option( 'woocommerce_single_image_width', '600' ); // Single
		update_option( 'woocommerce_single_image_height', '600' ); // Single
		update_option( 'woocommerce_catalog_image_width', '460' ); // Catalog
		update_option( 'woocommerce_catalog_image_height', '460' ); // Catlog

}

// Disable WooCommerce styles
if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	// WooCommerce 2.1 or above is active
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	// WooCommerce is less than 2.1
	define( 'WOOCOMMERCE_USE_CSS', false );
}

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// WooCommerce layout overrides
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'woocommerce_freschi_before_content' ) ) {
	// WooCommerce layout overrides
	add_action( 'woocommerce_before_main_content', 'woocommerce_freschi_before_content', 10 );
	function woocommerce_freschi_before_content() {
		global $woo_options;

		$columns = ( ! isset( $woo_options['woocommerce_products_per_column'] ) && ( is_shop() || is_product_category() || is_product_tag() ) )
			 				?  'woocommerce-columns-3' :  (isset( $woo_options['woocommerce_products_per_column'] ) && ( is_shop()  || is_product_category() || is_product_tag() ) )
			 					? 'woocommerce-columns-' . ( $woo_options['woocommerce_products_per_column'] ) : '';

    if ( is_product() ) {

    $page_header_style = get_post_meta( get_the_ID(), 'df_metabox_header_style', true );

    if ( 'hide' != $page_header_style ) {

      // remove product title
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

    }
  }

	?>
		<!-- #content Starts -->
		<?php woo_content_before(); ?>
	    <div id="content" class="col-full <?php echo esc_attr( $columns ); ?>">

	    	<div id="main-sidebar-container">

	            <!-- #main Starts -->
	            <?php woo_main_before(); ?>
	            <section id="main" class="col-left">
	    <?php
	}
}

if ( ! function_exists( 'woocommerce_freschi_after_content' ) ) {
	// WooCommerce layout overrides
	add_action( 'woocommerce_after_main_content', 'woocommerce_freschi_after_content', 20 );
	function woocommerce_freschi_after_content() {
	?>
				</section><!-- /#main -->
	            <?php woo_main_after(); ?>

				<?php dahz_get_sidebar('shop'); ?>

			</div><!-- /#main-sidebar-container -->

	        <?php dahz_get_sidebar( 'secondary' ); ?>

	    </div><!-- /#content -->
	    <?php
	}
}

// Add the WC sidebar in the right place
add_action( 'woo_main_after', 'woocommerce_get_sidebar', 10 );

if ( ! function_exists( 'woocommerce_get_sidebar' ) ) {
	function woocommerce_get_sidebar() {

		global $woo_options;

		// Display the sidebar if full width option is disabled on archives
		if ( is_shop() || is_product_category() || is_product_tag() ) {
		if ( isset($woo_options[ 'woocommerce_archives_fullwidth' ]) && $woo_options[ 'woocommerce_archives_fullwidth' ] == "true" ) :
			dahz_get_sidebar('shop');
		endif;
		}

		// Display the sidebar if full width option is disabled on product pages
		if ( is_product() ) {
		if ( isset($woo_options[ 'woocommerce_products_fullwidth' ]) && $woo_options[ 'woocommerce_products_fullwidth' ] == "true" ) :
			dahz_get_sidebar('shop');
		endif;
		}


	}
}


function woocommerceframework_add_search_fragment ( $settings ) {
	$settings['add_fragment'] = '&post_type=product';

	return $settings;
} // End woocommerceframework_add_search_fragment()

if ( ! function_exists( 'freschi_commerce_pagination' ) ) {
	add_action( 'woocommerce_after_main_content', 'freschi_commerce_pagination', 01 );

	function freschi_commerce_pagination() {
		if ( is_search() && is_post_type_archive() ) {
			add_filter( 'woo_pagination_args', 'woocommerceframework_add_search_fragment', 10 );
		}
		woo_pagenav();
	}
}

// Remove pagination - we're using WF pagination.
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 ); // < 2.0
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); // 2.0 +

/*-----------------------------------------------------------------------------------*/
/* PRODUCTS */
/*-----------------------------------------------------------------------------------*/


add_filter( 'loop_shop_columns', 'wooframework_loop_columns' );
if ( ! function_exists( 'wooframework_loop_columns' ) ) {
	// Change columns in product loop to 3
	function wooframework_loop_columns() {
		global $woo_options;
		if( ! isset( $woo_options['woocommerce_products_per_column'] ) ){
			$cols = 3;
		} else {
		  	 $cols = $woo_options['woocommerce_products_per_column'];
		}
		return $cols;
	}

}


// Number of products per page

add_filter('loop_shop_per_page', 'wooframework_products_per_page');
if (!function_exists('wooframework_products_per_page')) {
	function wooframework_products_per_page() {
		global $woo_options;
	if( isset( $_GET['show_products'] ) ){
		if ($_GET['show_products'] == "all") {
			 return -1 ;
	    } else {
	    	return $_GET['show_products'];
	    }
	} else {
		if ( isset( $woo_options['woocommerce_products_per_page'] ) ) {
			return $woo_options['woocommerce_products_per_page'];
		}
	}
		}
}


remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',  10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',  1 );

/*-----------------------------------------------------------------------------------*/
/* SINGLE PRODUCTS */
/*-----------------------------------------------------------------------------------*/

// Change thumbs on the single page to 4 per column
add_filter( 'woocommerce_product_thumbnails_columns', 'woocommerce_custom_product_thumbnails_columns' );

if (!function_exists('woocommerce_custom_product_thumbnails_columns')) {
	function woocommerce_custom_product_thumbnails_columns() {
		return 4;
	}
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );


// Display related products?
add_action( 'wp_head','wooframework_related_products' );
if ( ! function_exists( 'wooframework_related_products' ) ) {
	function wooframework_related_products() {
		global $woo_options;
		if ( isset( $woo_options['woocommerce_related_products'] ) &&  'false' == $woo_options['woocommerce_related_products'] ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		}
	} // End wooframework_related_products()
}

if (!function_exists('wc_output_related_products')) {
	add_filter( 'woocommerce_output_related_products_args', 'wc_output_related_products' );
	function wc_output_related_products() {
		//Display related products in correct layout.
	   global $woo_options;
	  if ( isset($woo_options[ 'woocommerce_products_fullwidth' ]) && $woo_options[ 'woocommerce_products_fullwidth' ] == "false"  ) {
		$args = apply_filters( 'wc_output_related_products_args', array(
			'posts_per_page' => 4,
			'columns'        => 4,
		) );
	   } else {
		$args = apply_filters( 'wc_output_related_products_args', array(
			'posts_per_page' => 3,
			'columns'        => 3,
		) );
	  }
	   return $args;
	}
}

// Upsells
if ( ! function_exists( 'woo_upsell_display' ) ) {
	function woo_upsell_display() {
	    // Display up sells in correct layout.
	   global $woo_options;
	   if ( isset($woo_options[ 'woocommerce_products_fullwidth' ]) && $woo_options[ 'woocommerce_products_fullwidth' ] == "false"  ) {
	             woocommerce_upsell_display( -1, 4 );
	} else {
		woocommerce_upsell_display( -1, 3 );
	}

	}
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woo_upsell_display', 15 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
// Display the ratings in the loop and on the single page
add_action( 'woocommerce_single_product_summary', 'freschi_single_product_rating_overview', 6);

if (!function_exists('freschi_single_product_rating_overview')) {
	function freschi_single_product_rating_overview() {
		global $product;
		$review_total = get_comments_number();
		if ( $review_total > 0 && get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			echo '<div class="rating-wrap">';
				echo '<span class="review-count"><a href="#reviews">';
					comments_number( '', __('( 1 customer review )', 'woothemes'), __('( % customer reviews )', 'woothemes') );
				echo '</a></span>';
				echo $product->get_rating_html();
			echo '</div>';
		}
	}
}


// Adjust the star rating in the sidebar
add_filter('woocommerce_star_rating_size_sidebar', 'woofreschi_star_sidebar');

if (!function_exists('woofreschi_star_sidebar')) {
	function woofreschi_star_sidebar() {
		return 12;
	}
}

// Custom place holder
add_filter( 'woocommerce_placeholder_img_src', 'wooframework_wc_placeholder_img_src' );

if ( ! function_exists( 'wooframework_wc_placeholder_img_src' ) ) {
function wooframework_wc_placeholder_img_src( $src ) {
	$settings = array( 'placeholder_url' => get_template_directory_uri() . '/includes/assets/images/wc-placeholder.gif' );
	$settings = woo_get_dynamic_values( $settings );

	return esc_url( $settings['placeholder_url'] );
} // End wooframework_wc_placeholder_img_src()
}

add_action( 'woocommerce_single_product_summary','woocommerce_custom_sharethis', 50 );

function woocommerce_custom_sharethis(){
	global $post;
	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
	//do_action( 'woocommerce_custom_sharethis' );?>
	<div class="single-product-share">
	<h4><?php _e('Share', 'woothemes') ?></h4>
	<a href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(apply_filters( 'woocommerce_short_description', $post->post_excerpt )); ?> <?php the_permalink(); ?>" class="product_share_email eml"> </a>
	<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="product_share_facebook face"> </a>
	<a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="product_share_twitter twit"> </a>
	<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="goo"> </a>
	<a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $src[0]; ?>&description=<?php the_title(); ?>" target="_blank" class="product_share_pinterest pin"> </a>

	</div>
			<?php
}


/*-------------------------------------------------------------------------------------------*/
/* BREADCRUMB */
/*-------------------------------------------------------------------------------------------*/

// Remove WC breadcrumb (we're using the WooFramework breadcrumb)

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/*--------------------------------------------------------------------------*/

add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');

function header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	freschi_cart_button();

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;

}

add_filter('woocommerce_add_to_cart_fragments', 'mheader_add_to_cart_fragment');

function mheader_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	echo '<sup class="mobile-cart-count">'. WC()->cart->cart_contents_count .'</sup>';

	$fragments['.mobile-cart-count'] = ob_get_clean();

	return $fragments;

}

do_action( 'freschi_user' );
function freschi_user() {
	global $woo_options; ?>
  <nav class="account-links">
		           	<ul>
		           		<?php
		           			global $current_user;
							$url_myaccount = get_permalink( wc_get_page_id( 'myaccount' ) );

							if ( $woo_options['woo_popup_account'] == 'true' ) {
								$hrefVal = '#go-signup';
							} else {
								$hrefVal = $url_myaccount;
							}

							if ( is_user_logged_in() ) {
								
								if ( wc_get_page_id( 'myaccount' ) !== -1 ) {
									?>
										<li class="my-account">
											<a rel="leanmodal" href="<?php echo $url_myaccount; ?>" title="<?php _e( 'My Account', 'woothemes' ) ?>">
												<span>
													<?php _e( 'My Account', 'woothemes' ); ?>
												</span>
											</a>
										</li>
									<?php
								}

							} else {
								
								if ( wc_get_page_id( 'myaccount' ) !== -1 ) {
									if ( is_lost_password_page() ) {
										?>
											<li class="my-account">
												<a rel="leanmodal" href="<?php echo $url_myaccount; ?>" title="<?php _e( 'Login', 'woothemes' ) ?>">
													<span>
														<?php _e( 'Login', 'woothemes' ); ?>
													</span>
												</a>
											</li>
										<?php
									} else {
										?>
											<li class="my-account">
												<a rel="leanmodal" href="<?php echo $hrefVal; ?>" title="<?php _e( 'Login', 'woothemes' ) ?>">
													<span>
														<?php _e( 'Login', 'woothemes' ); ?>
													</span>
												</a>
											</li>
										<?php
											if ( get_option('woocommerce_enable_myaccount_registration') == 'yes' ) {
												?>
													<span><?php _e( 'Or', 'woothemes' ) ?></span>
													<li class="register">
														<a rel="leanmodal" href="<?php echo $hrefVal; ?>" title="<?php _e( 'Signup', 'woothemes' ); ?>">
															<span>
																<?php _e( 'Signup', 'woothemes' ); ?>
															</span>
														</a>
													</li>
												<?php
											}
									}
								}

							}

						?>
			</ul>
		          </nav>

		         <!--   </div> -->
		           <div id="go-signup">
		           	<div class="inner">
		           	<a class="modal_close" href="#"><div class="fa fa-remove-sign"></div></a>
		           	<?php echo do_shortcode( '[woocommerce_my_account]' );?>
		           	<div class="clear"></div>
		           </div>
		           </div>
<?php }

do_action( 'freschi_user_mobile' );
function freschi_user_mobile() {
	global $current_user;
	$url_myaccount = get_permalink( wc_get_page_id( 'myaccount' ) );
	?>
	<?php if ( wc_get_page_id( 'myaccount' ) !== -1 ) { ?>
		<li class="col-3 ">
		<a href="<?php echo $url_myaccount; ?>"  title="<?php if ( is_user_logged_in() ) {  _e('My Account', 'woothemes' ); } else { _e( 'Login', 'woothemes' ); } ?>"><span><?php if ( is_user_logged_in() ) { _e('<i class="fa fa-user"></i>', 'woothemes' ); } else { _e( '<i class="fa fa-sign-in" ></i>', 'woothemes' ); } ?></span></a>

		</li>
		<?php } ?>

	<?php if ( is_user_logged_in() ) { ?>
		<?php if ( wc_get_page_id( 'view_order' ) !== -1 ) { ?>
		<li class="col-3 "><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e( 'Logout', 'woothemes' ); ?>"><i class="fa fa-signout"></i></a></li>
		<?php } ?>
	<?php } ?>



<?php }

function freschi_cart_button() {
	?>
	<a class="cart-contents woo-cart" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'woothemes' ); ?>"><?php echo WC()->cart->get_cart_total(); ?> <span class="contents"><?php if(WC()->cart->cart_contents_count > 1 || WC()->cart->cart_contents_count == 0) echo '( ' . WC()->cart->cart_contents_count . __('Items', 'woothemes') . ')'; else echo '( ' . WC()->cart->cart_contents_count . __('Item','woothemes') . ')'; ?></span></a>
	<?php
}

do_action('freschi_mini_cart');
function freschi_mini_cart() {
	global $woocommerce;
	?>

	<ul class="cart">
		<li class="container">

       		<?php

       		freschi_cart_button();

       		if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
				the_widget( 'WC_Widget_Cart', 'title=' );
			} else {
				the_widget( 'WooCommerce_Widget_Cart', 'title=' );
			}

       		?>
		</li>
	</ul>



	<?php
}


	function dahz_wishlist_button() {

		global $product, $yith_wcwl;

		if ( class_exists( 'YITH_WCWL_UI' ) )  {
			$url = $yith_wcwl->get_wishlist_url();
			$product_type = $product->product_type;
			$exists = $yith_wcwl->is_product_in_wishlist( $product->id );

			$classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';

			$html  = '<div class="yith-wcwl-add-to-wishlist add-to-wishlist-'. $product->id .'">';
			    $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

			    $html .= $exists ? ' hide" style="display:none;"' : ' show"';

			    $html .= '><a href="' . htmlspecialchars($yith_wcwl->get_addtowishlist_url()) . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' ><i class="fa fa-heart"></i></a>';
			    $html .= '</div>';

			$html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><span class="feedback">' . __( 'Product added to wishlist.', 'woothemes' ) . '</span> <a href="' . $url . '"><i class="fa fa-check"></i></a></div>';
			$html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . $url . '"><i class="fa fa-check"></i></a></div>';
			$html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

			$html .= '</div>';

			return $html;

		}

	}

/*-----------------------------------------------------------------------------------*/
/* Shop Page Title */
/*-----------------------------------------------------------------------------------*/
function df_woocommerce_title_controller() {
    $post_id = get_the_ID();

     if ( is_shop() ) {

     $post_id =  wc_get_page_id( 'shop' );
    } else if ( is_product_category() || is_product_tag() ) {

     $post_id =  wc_get_page_id( 'terms' );
    } else if ( is_cart() ) {

     $post_id =  wc_get_page_id( 'cart' );
    } else if ( is_checkout() ) {

     $post_id =  wc_get_page_id( 'checkout' );
    }

  $page_header_style = get_post_meta( $post_id, 'df_metabox_header_style', true );

  if ( 'hide' != $page_header_style ) {

    $title_align = get_option('woo_page_header_title_align');
    $title_classes = array( 'df-page-header' );
    switch( $title_align ) {

      case 'right' :
        $title_classes[] = 'title-right';
        break;

      case 'left' :
        $title_classes[] = 'title-left';
        break;

      default:
        $title_classes[] = 'title-center';
    }

    $before_title = '<div id="df-normal-header" class="' . esc_attr( implode( ' ', $title_classes ) ) . '"><div class="col-full df-header-wrap"><div class="df-header-container">';
    $after_title = '</div></div></div>';
    $df_breadcrumbs = (  'true' == get_option('woo_breadcrumbs_show') );

    echo $before_title;

    if ( 'right' == $title_align ) {

      if ( $df_breadcrumbs ) {
      echo '<div class="breadcrumbs df-header" >';
      woo_breadcrumbs();
        echo '</div>';
      }

      echo '<div class="df-header"><h1>';
      woocommerce_page_title();
      echo '</h1></div>';
    } else {

      echo '<div class="df-header"><h1>';
      woocommerce_page_title();
      echo '</h1></div>';

      if ( $df_breadcrumbs ) {
      echo '<div class="breadcrumbs df-header" >';
      woo_breadcrumbs();
        echo '</div>';
      }

    }

    echo $after_title;

  }

}


function df_wc_page_title( $page ){



  $show_titles = (  'true' == get_option( 'woo_show_page_header_title' ) );

  if ( !$show_titles ) return;


  if('shop' == $page) {

       df_woocommerce_title_controller();

  }

}
add_filter( 'woocommerce_show_page_title', 'df_wc_page_title', 15);


function df_template_shop_page_title_config( $page ){

  if('shop' == $page) {

    if ( !is_product() ) {

    remove_action( 'dahztheme_title_controller', 'df_page_title_header_controller', 15 );

    }


  }

}
add_action( 'get_header',  'df_template_shop_page_title_config', 5 );

