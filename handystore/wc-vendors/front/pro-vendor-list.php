<?php
/**
 * The Template for displaying a vendor in the vendor list shortcode
 *
 * Override this template by copying it to yourtheme/wc-vendors/front
 *
 * @package    WCVendors_Pro
 * @version    1.2.3
 */

$store_icon_src 	= wp_get_attachment_image_src( get_user_meta( $vendor_id, '_wcv_store_icon_id', true ), array( 100, 100 ) );
$store_icon 			= '';

// see if the array is valid
if ( is_array( $store_icon_src ) ) {
	$store_icon 	= '<img src="'.esc_url($store_icon_src[0]).'" alt="'.esc_attr($vendor_meta['pv_shop_name']).'" class="store-icon" />';
}

// Get all vendor products
$vendor_products_ids = WCVendors_Pro_Vendor_Controller::get_products_by_id( $vendor_id );
$products_count = count($vendor_products_ids);

// Get Vendor address
$address1 			= ( array_key_exists( '_wcv_store_address1', $vendor_meta ) ) ? $vendor_meta[ '_wcv_store_address1' ] : '';
$city	 					= ( array_key_exists( '_wcv_store_city', $vendor_meta ) ) ? $vendor_meta[ '_wcv_store_city' ]  : '';
$state	 				= ( array_key_exists( '_wcv_store_state', $vendor_meta ) ) ? $vendor_meta[ '_wcv_store_state' ] : '';
$store_postcode	= ( array_key_exists( '_wcv_store_postcode', $vendor_meta ) ) ? $vendor_meta[ '_wcv_store_postcode' ]  : '';
$address 				= ( $address1 != '') ? $address1 .', ' . $city .', '. $state .', '. $store_postcode : '';

// Get Vendor socials
$twitter_username 	= get_user_meta( $vendor_id , '_wcv_twitter_username', true );
$instagram_username = get_user_meta( $vendor_id , '_wcv_instagram_username', true );
$facebook_url 		  = get_user_meta( $vendor_id , '_wcv_facebook_url', true );
$linkedin_url 		  = get_user_meta( $vendor_id , '_wcv_linkedin_url', true );
$youtube_url 		    = get_user_meta( $vendor_id , '_wcv_youtube_url', true );
$googleplus_url  	  = get_user_meta( $vendor_id , '_wcv_googleplus_url', true );
$pinterest_url 		  = get_user_meta( $vendor_id , '_wcv_pinterest_url', true );
// Social list
$social_icons_list = '<ul class="social-icons">';
if ( $facebook_url != '') { $social_icons_list .= '<li><a href="'.$facebook_url.'" target="_blank"><i class="fa fa-facebook"></i></a></li>'; }
if ( $instagram_username != '') { $social_icons_list .= '<li><a href="//instagram.com/'.$instagram_username.'" target="_blank"><i class="fa fa-instagram"></i></a></li>'; }
if ( $twitter_username != '') { $social_icons_list .= '<li><a href="//twitter.com/'.$twitter_username.'" target="_blank"><i class="fa fa-twitter"></i></a></li>'; }
if ( $googleplus_url != '') { $social_icons_list .= '<li><a href="'.$googleplus_url.'" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; }
if ( $youtube_url != '') { $social_icons_list .= '<li><a href="'.$youtube_url.'" target="_blank"><i class="fa fa-youtube"></i></a></li>'; }
if ( $linkedin_url != '') { $social_icons_list .= '<li><a href="'.$linkedin_url.'" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; }
$social_icons_list .= '</ul>';

$social_icons = empty( $twitter_username ) && empty( $instagram_username ) && empty( $facebook_url ) && empty( $linkedin_url ) && empty( $youtube_url ) && empty( $googleplus_url ) && empty( $pinterst_url ) ? false : true;

?>

<div class="wcv-pro-vendorlist">

	<div class="wcv-store-grid row">

		<div class="wcv-banner-wrapper hidden-xs col-sm-4 col-md-2">

			<div class="wcv-banner-inner">
					<?php if ($store_icon) { ?>
					<div class="wcv-icon-container">
							<?php echo $store_icon; ?>
					</div>
					<?php } ?>

					<?php if ($social_icons) { ?>
					<div class="wcv-socials-container">
							<?php echo $social_icons_list; ?>
							<i class="fa fa-share-alt" aria-hidden="true"></i>
					</div>
					<?php } ?>
			</div>

		</div>

		<div class="wcv-description-wrapper col-xs-12 col-sm-8 col-md-4">

			<div class="wcv-description-inner">
				<h4><?php echo $shop_name; ?></h4>
				<span class="rating-container">
						<?php if ( ! WCVendors_Pro::get_option( 'ratings_management_cap' ) ) echo WCVendors_Pro_Ratings_Controller::ratings_link( $vendor_id, true ); ?>
				</span>
				<?php if ($products_count && $products_count>0) echo '<span class="products-count">'.esc_html( sprintf( _n( '%s product', '%s products', $products_count, 'plumtree' ), $products_count ) ).'</span>'; ?>
				<?php if ($address && $address!='') echo '<span class="vendor-address"><i class="fa fa-map-marker" aria-hidden="true"></i>'.$address.'</span>'; ?>
				<div class="short-description"><?php echo $vendor_meta[ 'pv_shop_description' ]; ?></div>
				<a href="<?php echo $shop_link; ?>" class="btn btn-default rounded"><?php esc_html_e('Visit Store', 'plumtree'); ?></a>
			</div>

		</div>

		<div class="wcv-products-wrapper hidden-xs hidden-sm col-md-6">

			<div class="wcv-products-inner">
				<?php $product_images = '';
				foreach ($vendor_products_ids as $key => $id) {
						if ($key == 5 || $key == (count($vendor_products_ids)-1) ) {
							$product_images .= '<div class="product-img">'.get_the_post_thumbnail($id, 'pt-vendor-product-thumbs').'<span class="total-qty">'.sprintf( _n( '<span>%s</span> item', '<span>%s</span> items', $products_count, 'plumtree' ), $products_count ).'</span></div>';
							break;
						} else {
							$product_images .= '<div class="product-img">'.get_the_post_thumbnail($id, 'pt-vendor-product-thumbs').'</div>';
						}
				}
				echo $product_images; ?>
			</div>

		</div>

	</div><!-- close wcv-store-grid -->

</div>
