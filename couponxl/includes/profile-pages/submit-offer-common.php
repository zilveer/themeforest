<?php
$date_ranges = couponxl_get_option( 'date_ranges' );
$unlimited_expire = couponxl_get_option( 'unlimited_expire' );
$message = '';
$show_form = true;

/* IF WE ARE RETURNING FROM THE PAYPAL */
$is_paypal = isset( $_GET['paypal'] ) ? $_GET['paypal'] : '';
$offer_id = isset( $_GET['offer_id'] ) ? $_GET['offer_id'] : '';
$subaction = isset( $_GET['subaction'] ) ? $_GET['subaction'] : '';

if( $is_paypal == 'yes' ){
	if( $subaction == 'paid_offer' ){
		$offer = get_post( $offer_id );
		if( !empty( $offer ) ){
			$message  = couponxl_check_submission( $offer_id );
		}
		else{
			$message = '<div class="alert alert-danger">'.__( 'There is no offer with the provided ID', 'couponxl' ).'</div>';
		}
	}
	else if( $subaction == 'remove_offer' ){
		$offer = get_post( $offer_id );
		if( get_current_user_id() == $offer->post_author ){
			wp_delete_post( $offer_id, true );
			$message = '<div class="alert alert-success">'.__( 'Offer is deleted', 'couponxl' ).'</div>';
		}
	}
}
else if( isset( $_GET['skrill_return'] ) ){
	$message = '<div class="alert alert-info">'.__( 'Payment is processed and once skrill verifies it you will see offer as pending', 'couponxl' ).'</div>';
}
else if( isset( $_GET['ideal_return'] ) ){
	$message = '<div class="alert alert-info">'.__( 'Payment is processed and once iDEAL verifies it you will see offer as pending', 'couponxl' ).'</div>';
}
else if( isset( $_POST['hash'] ) ){
	$status = $_POST["status"];
	$firstname = $_POST["firstname"];
	$amount = $_POST["amount"];
	$txnid = $_POST["txnid"];
	$posted_hash = $_POST["hash"];
	$key = $_POST["key"];
	$productinfo = $_POST["productinfo"];
	$email = $_POST["email"];
	$offer_id = $_GET['id_offer'];
	$salt = couponxl_get_option( 'payu_merchant_salt' );

	$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	$hash = hash( "sha512", $retHashSeq );

	if ( $hash != $posted_hash ) {
		$message = '<div class="alert alert-danger">'.__( 'Invalid Transaction. Please try again', 'couponxl' ).'</strong></div>';
	}
	else {
		update_post_meta( $offer_id, 'offer_initial_payment', 'paid' );
		$message = '<div class="alert alert-success">'.__( 'Your offer is submited and it will be reviewed as soon as possible.', 'couponxl' ).'</div>';
	}
}
/* END IF WE ARE RETURNING FROM THE PAYPAL */

$offer_type = isset( $_POST['offer_type'] ) ? $_POST['offer_type'] : '';
$offer_title = isset( $_POST['offer_title'] ) ? $_POST['offer_title'] : '';
$offer_description = isset( $_POST['offer_description'] ) ? $_POST['offer_description'] : '';
$offer_featured_image = isset( $_POST['offer_featured_image'] ) ? $_POST['offer_featured_image'] : '';
$offer_store = isset( $_POST['offer_store'] ) ? $_POST['offer_store'] : '';
$offer_new_store = isset( $_POST['offer_new_store'] ) ? $_POST['offer_new_store'] : '';
$offer_cat = isset( $_POST['offer_cat'] ) ? $_POST['offer_cat'] : '';
$offer_new_category = isset( $_POST['offer_new_category'] ) ? $_POST['offer_new_category'] : '';
$location = isset( $_POST['location'] ) ? $_POST['location'] : '';
$offer_new_location = isset( $_POST['offer_new_location'] ) ? $_POST['offer_new_location'] : '';
$offer_start = isset( $_POST['offer_start'] ) ? strtotime( $_POST['offer_start'] ) : current_time( 'timestamp' );
$offer_expire = isset( $_POST['offer_expire'] ) ? strtotime( $_POST['offer_expire'] ) : '';
/*COUPON RELATED */
$coupon_excerpt = isset( $_POST['coupon_excerpt'] ) ? $_POST['coupon_excerpt'] : '';
$coupon_type = isset( $_POST['coupon_type'] ) ? $_POST['coupon_type'] : '';
$coupon_code = isset( $_POST['coupon_code'] ) ? $_POST['coupon_code'] : '';
$coupon_sale = isset( $_POST['coupon_sale'] ) ? $_POST['coupon_sale'] : '';
$coupon_image = isset( $_POST['coupon_image'] ) ? $_POST['coupon_image'] : '';
$coupon_link = isset( $_POST['coupon_link'] ) ? $_POST['coupon_link'] : '';
/*DEAL REALTED*/
$deal_link = isset( $_POST['deal_link'] ) ? $_POST['deal_link'] : '';
$deal_items = isset( $_POST['deal_items'] ) ? $_POST['deal_items'] : '';
$deal_item_vouchers = isset( $_POST['deal_item_vouchers'] ) ? $_POST['deal_item_vouchers'] : '';
$deal_price = isset( $_POST['deal_price'] ) ? $_POST['deal_price'] : '';
$deal_sale_price = isset( $_POST['deal_sale_price'] ) ? $_POST['deal_sale_price'] : '';
$deal_discount = isset( $_POST['deal_discount'] ) ? $_POST['deal_discount'] : '';
$deal_voucher_expire = isset( $_POST['deal_voucher_expire'] ) ? strtotime( $_POST['deal_voucher_expire'] ) : '';
$deal_in_short = isset( $_POST['deal_in_short'] ) ? $_POST['deal_in_short'] : '';
$deal_markers = isset( $_POST['deal_markers'] ) ? $_POST['deal_markers'] : '';
$deal_images = isset( $_POST['deal_images'] ) ? $_POST['deal_images'] : '';
$deal_type = isset( $_POST['deal_type'] ) ? $_POST['deal_type'] : '';

if( isset( $_POST['offer_type'] ) ){
	if( !empty( $offer_title ) ){
		if( !empty( $offer_description ) ){
			if( !empty( $offer_featured_image ) ){
				if( !empty( $offer_store ) || !empty( $offer_new_store ) ){
					if( !empty( $offer_cat ) || !empty( $offer_new_category ) ){
						if( !empty( $location ) || !empty( $offer_new_location ) ){
							if( ( ( empty( $unlimited_expire ) || $unlimited_expire == 'no' ) && !empty( $offer_expire ) ) || $unlimited_expire == 'yes' ){
								$check_ranges = true;
								if( !empty( $date_ranges ) && $unlimited_expire !== 'yes' ){
									if( $offer_expire - $offer_start >= $date_ranges*24*60*60 ){
										$check_ranges = false;
										$message = '<div class="alert alert-danger">'.__( 'Maximum range between days is ', 'couponxl' ).' '.$date_ranges.'</div>';
									}
								}

								if( $check_ranges = true ){
									if( empty( $offer_expire ) ){
										$offer_expire = '99999999999';
									}
									$show_form = false;
									/* HANDLE COUPON DATA */
									if( $offer_type == 'coupon' ){
										if( !empty( $coupon_type ) ){
											$check_coupon_type_value = true;
											switch( $coupon_type ){
												case 'code' : 
													if( empty( $coupon_code ) ){
														$check_coupon_type_value = false;
														$message = '<div class="alert alert-danger">'.__( 'You need to input code for the coupon type code', 'couponxl' ).'</div>';
													}
													break;
												case 'sale' : 
													if( empty( $coupon_sale ) ){
														$check_coupon_type_value = false;
														$message = '<div class="alert alert-danger">'.__( 'You need to input sale link for the coupon type sale', 'couponxl' ).'</div>';
													}
													break;
												case 'printable' : 
													if( empty( $coupon_image ) ){
														$check_coupon_type_value = false;
														$message = '<div class="alert alert-danger">'.__( 'You need to upload coupon image for the printable coupon type', 'couponxl' ).'</div>';
													}
													break;
												default: 
													$check_coupon_type_value = false;
													$message = '<div class="alert alert-danger">'.__( 'You need to specify coupon data based on its type', 'couponxl' ).'</div>';
											}
											if( $check_coupon_type_value == true ){
												include( locate_template( 'includes/profile-pages/insert-offer.php' ) );
											}
										}
										else{
											$message = '<div class="alert alert-danger">'.__( 'You need to select coupon type', 'couponxl' ).'</div>';
										}
									}
									/* HANDLE DEAL DATA */
									else{
										if( !empty( $deal_items ) ){
											if( !empty( $deal_price ) ){
												if( !empty( $deal_sale_price ) ){
													if( !empty( $deal_discount ) ){
														if( !empty( $deal_in_short ) ){
															if( !empty( $deal_type ) ){
																$seller_payout_method = get_user_meta( $current_user->ID, 'seller_payout_method', true );
																$method_check = true;
																if( $deal_type  == 'shared' && empty( $seller_payout_method ) ){
																	$method_check = false;
																}
																if( $method_check ){
																	include( locate_template( 'includes/profile-pages/insert-offer.php' ) );
																}
																else{
																	$message = '<div class="alert alert-danger">'.__( 'You need to connect your profile with some payment in order to use shared deal.', 'couponxl' ).'</div>';	
																}
															}
															else{
																$message = '<div class="alert alert-danger">'.__( 'You need to select deal type', 'couponxl' ).'</div>';	
															}
														}
														else{
															$message = '<div class="alert alert-danger">'.__( 'You need to input short description of the deal', 'couponxl' ).'</div>';	
														}
													}
													else{
														$message = '<div class="alert alert-danger">'.__( 'You need to specify amount of the discount based on the real price and sale price ( SALE PRICE / REAL PRICE * 100 )', 'couponxl' ).'</div>';
													}
												}
												else{
													$message = '<div class="alert alert-danger">'.__( 'You need to specify sale price of the deal ( number only with max two decimal separated by . )', 'couponxl' ).'</div>';
												}
											}
											else{
												$message = '<div class="alert alert-danger">'.__( 'You need to specify real price of the deal ( number only with max two decimal separated by . )', 'couponxl' ).'</div>';
											}
										}
										else{
											$message = '<div class="alert alert-danger">'.__( 'You need to specify number of items you wish to sell', 'couponxl' ).'</div>';
										}
									}
								}
							}
							else{
								$message = '<div class="alert alert-danger">'.__( 'You need to specify expire date', 'couponxl' ).'</div>';
							}
						}
						else{
							$message = '<div class="alert alert-danger">'.__( 'You need to select ro submit new location', 'couponxl' ).'</div>';
						}
					}
					else{
						$message = '<div class="alert alert-danger">'.__( 'You need to select or submit new category', 'couponxl' ).'</div>';
					}
				}
				else{
					$message = '<div class="alert alert-danger">'.__( 'You need to select or submit new store', 'couponxl' ).'</div>';
				}
			}
			else{
				$message = '<div class="alert alert-danger">'.__( 'You need to select featuerd image for the coupon', 'couponxl' ).'</div>';
			}
		}
		else{
			$message = '<div class="alert alert-danger">'.__( 'Description is required', 'couponxl' ).'</div>';
		}
	}
	else{
		$message = '<div class="alert alert-danger">'.__( 'Title is required', 'couponxl' ).'</div>';
	}
}

if( !empty( $message ) ){
	echo $message;
}

if( $show_form ):
?>	
	<?php
	$message = '';
	if( $type == 'coupon' ){
		$offer_submit_price = couponxl_get_option( 'coupon_submit_price' );
		$name = __('coupon', 'couponxl');
	}
	else{
		$offer_submit_price = couponxl_get_option( 'deal_submit_price' );
		$name = __('deal', 'couponxl');
	}
	if( !empty( $offer_submit_price ) ){
		echo '<div class="alert alert-info">'.__( 'Submission of the ','couponxl').$name.__(' is charged ', 'couponxl' ).couponxl_format_price_number( $offer_submit_price ).'</div>';
	}	
	?>	
	<form method="POST" action="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => $subpage, 'action' => 'add' ), array( 'all' ) ) ) ?>" enctype="multipart/form-data">
		<div id="wizard" class="<?php echo $type == 'coupon' ? 'coupon-wizard' : '' ?>">
		    <h1></h1>
		    <div>
			    <div class="input-group">
			        <label for="offer_title"><?php _e( 'Offer Title', 'couponxl' ); ?> <span class="required">*</span></label>
			        <input type="text" name="offer_title" id="offer_title" value="<?php echo esc_attr( $offer_title ) ?>" class="form-control" data-validation="required"  data-error="<?php esc_attr_e( 'Please input offer description', 'couponxl' ); ?>">
			        <p class="description"><?php _e( 'Input title for the offer.', 'couponxl' ); ?></p>
			    </div>

			    <div class="input-group">
			        <label for="offer_description" data-error="<?php esc_attr_e( 'Please type description of the offer', 'couponxl' ); ?>"><?php _e( 'Offer Description', 'couponxl' ); ?> <span class="required">*</span></label>
			        <?php wp_editor( $offer_description, 'offer_description' ); ?>
			        <p class="description"><?php _e( 'Input description of the offer.', 'couponxl' ); ?></p>
			    </div>

			    <div class="input-group">
			        <label for="offer_featured_image"><?php _e( 'Offer Image', 'couponxl' ); ?> <span class="required">*</span></label>
			        <input type="hidden" name="offer_featured_image" id="offer_featured_image" value="<?php esc_attr( $offer_featured_image ) ?>" data-validation="required"  data-error="<?php esc_attr_e( 'Please input offer presentation image', 'couponxl' ); ?>">
			        <div class="upload-image-wrap featured-image-wrap"></div>
			        <a href="javascript:;" class="image-upload featured-image"><?php _e( 'Select featured image', 'couponxl' ) ?></a>
			        <p class="description"><?php _e( 'Upload and select featured image for the offer.', 'couponxl' ); ?></p>
			    </div>			    
			</div>

			<h1></h1>
			<div>
			    <div class="input-group">
			        <label for="offer_store"><?php _e( 'Offer Store', 'couponxl' ); ?> <span class="required">*</span></label>
			        <select name="offer_store" id="offer_store" class="form-control" data-validation="conditional" data-conditional-field="offer_new_store" data-error="<?php esc_attr_e( 'Please select offer store', 'couponxl' ); ?>">
			        	<option value=""><?php _e( '- Select -', 'couponxl' ) ?></option>
				        <?php
				        $stores = couponxl_get_custom_list( 'store', array(
				        	'orderby' => 'title',
				        	'order' => 'ASC'
				        ) );

				        if( !empty( $stores ) ){
				        	foreach( $stores as $store_key => $store_name ){
				        		echo '<option value="'.$store_key.'">'.$store_name.'</option>';
				        	}
				        }
				        ?>
			        </select>
			        <p class="description"><?php _e( 'Select store for the offer or populate field bellow to request new one leaving this field not selected.', 'couponxl' ); ?></p>
			    </div>
			    <div class="input-group">
			        <label for="offer_new_store"><?php _e( 'Store not listed?', 'couponxl' ); ?></label>
			        <textarea name="offer_new_store" id="offer_new_store" class="form-control" ><?php echo $offer_new_store; ?></textarea>
			        <p class="description"><?php _e( 'If you can not find store in the list populate this field with as much information as you can. Relevant informations are: store name, store logo, store description, links to facebook, twiiter, google pages, google map longitude and latitude, map marker image.', 'couponxl' ); ?></p>
			    </div>

			    <div class="input-group">
			        <label for="offer_cat"><?php _e( 'Offer Category', 'couponxl' ); ?> <span class="required">*</span></label>
			        <select name="offer_cat" id="offer_cat" class="form-control" data-validation="conditional" data-conditional-field="offer_new_category" data-error="<?php esc_attr_e( 'Please select offer category', 'couponxl' ); ?>">
			            <option value=""><?php _e( '- Select -', 'couponxl' ) ?></option>
			            <?php
			            $categories = couponxl_get_organized( 'offer_cat' );

			            if( !empty( $categories ) ){
			            	foreach( $categories as $key => $category){
			            		couponxl_display_select_tree( $category );
			            	}
			            }
			            ?>
			        </select>
			        <p class="description"><?php _e( 'Select category for the offer or populate field bellow to request new one leaving this field not selected.', 'couponxl' ); ?></p>
			    </div>
			    <div class="input-group">
			        <label for="offer_new_category"><?php _e( 'Category not listed?', 'couponxl' ); ?></label>
			        <textarea name="offer_new_category" id="offer_new_category" class="form-control" ><?php echo $offer_new_category; ?></textarea>
			        <p class="description"><?php _e( 'Populate this field if desired category is not listed in the previous field.', 'couponxl' ); ?></p>
			    </div>

			    <div class="input-group">
			        <label for="location"><?php _e( 'Offer Location', 'couponxl' ); ?> <span class="required">*</span></label>
			        <select name="location" id="location" class="form-control" data-validation="conditional" data-conditional-field="offer_new_location" data-error="<?php esc_attr_e( 'Please select offer location', 'couponxl' ); ?>">
			            <option value=""><?php _e( '- Select -', 'couponxl' ) ?></option>
			            <?php
			            $locations = couponxl_get_organized( 'location' );

			            if( !empty( $locations ) ){
			            	foreach( $locations as $key => $location){
			            		couponxl_display_select_tree( $location );
			            	}
			            }
			            ?>
			        </select>
			        <p class="description"><?php _e( 'Select location for the offer or populate field bellow to request new one leaving this field not selected.', 'couponxl' ); ?></p>
			    </div>
			    <div class="input-group">
			        <label for="offer_new_location"><?php _e( 'Location not listed?', 'couponxl' ); ?></label>
			        <textarea name="offer_new_location" id="offer_new_location" class="form-control" ><?php echo $offer_new_location; ?></textarea>
			        <p class="description"><?php _e( 'Populate this field if desired location is not listed in the previous field.', 'couponxl' ); ?></p>
			    </div>
			</div>

			<h1></h1>
			<div>
			    <div class="input-group">
			        <label for="offer_start"><?php _e( 'Offer Start Date', 'couponxl' ); ?> </label>
			        <input type="text" name="offer_start" id="offer_start" value="<?php echo date( 'Y-m-d', $offer_start ) ?>" class="form-control" readonly="readonly" data-range="<?php echo esc_attr( $date_ranges ); ?>">
			        <p class="description"><?php _e( 'Set start date for the offer. If this field is empty current time will be applied to the offer.', 'couponxl' ); ?></p>
			    </div>

			    <div class="input-group">
			        <label for="offer_expire"><?php _e( 'Offer Expire Date', 'couponxl' ); ?> <span class="required">*</span></label>
			        <input type="text" name="offer_expire" id="offer_expire" value="<?php echo !empty( $offer_expire ) && $offer_expire !== '99999999999' ? date( 'Y-m-d', $offer_expire ) : '' ?>" class="form-control" readonly="readonly" data-range="<?php echo esc_attr( $date_ranges ); ?>" <?php echo !empty( $date_ranges ) ? 'data-validation="required"  data-error="'.esc_attr__( 'Please input offer expiration date', 'couponxl' ).'"' : ''; ?> >
			        <p class="description"><?php _e( 'Set expire date for the offer.', 'couponxl' ); ?></p>
			    </div>
			</div>

		    <?php
		    if( $type == 'coupon' ){
		    	?>
		    	<h1></h1>
		    	<div>
		    	    <?php include( locate_template( 'includes/profile-pages/coupon-submit.php' ) ); ?>
		    	</div>
		    	<?php
		    }
		    else{
		    	include( locate_template( 'includes/profile-pages/deal-submit.php' ) );
		    }
		    ?>
	    	<input type="hidden" name="offer_type" value="<?php echo esc_attr( $type ); ?>">
	    </div>
	</form>
<?php endif; ?>