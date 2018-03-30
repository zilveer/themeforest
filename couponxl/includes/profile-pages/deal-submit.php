<h1></h1>
<div>
    <div class="input-group">
        <label for="deal_items"><?php _e( 'Deal Items', 'couponxl' ); ?> <span class="required">*</span></label>
        <input type="text" name="deal_items" id="deal_items" value="<?php echo esc_attr( $deal_items ) ?>" class="form-control" data-validation="required" data-error="<?php esc_attr_e( 'Please input number of deal items you wish to sell', 'couponxl' ) ?>">
        <p class="description"><?php _e( 'Input number of deal items or services which will be available for purchase.', 'couponxl' ); ?></p>    
    </div>
    <div class="input-group">
        <label for="deal_item_vouchers"><?php _e( 'Deal Item Vouchers', 'couponxl' ); ?></label>
        <textarea name="deal_item_vouchers" id="deal_item_vouchers" class="form-control" data-validation="length_conditional" data-field_number_val="#deal_items" data-error="<?php esc_attr_e( 'You need to input number of vouchers same as inputed deal item.', 'couponxl' ) ?>"><?php echo esc_attr( $deal_item_vouchers ) ?></textarea>
        <p class="description"><?php _e( 'If you want to serve predefined vouchers instead of random generated ones, input them here one in a row and make sure that you have same amount of these vouchers as the number of items.', 'couponxl' ); ?></p>    
    </div>
    <div class="input-group">
        <label for="deal_voucher_expire"><?php _e( 'Deal Voucher Expire Date', 'couponxl' ); ?> </label>
        <input type="text" name="deal_voucher_expire" id="deal_voucher_expire" value="<?php echo !empty( $deal_voucher_expire ) ? date( 'Y-m-d', $deal_voucher_expire ) : ''; ?>" class="form-control" readonly="readonly" data-min-date="<?php echo date( 'Y/m/d', current_time( 'timestamp' ) + 24*60*60 ); ?>" >
        <p class="description"><?php _e( 'Set expire date and time for vouchers generated after purchase or leave empty for unlimited last ( How much time voucher is valid after purchase? )', 'couponxl' ); ?></p>
    </div>
    <div class="input-group">
        <label for="deal_images"><?php _e( 'Deal Images', 'couponxl' ); ?> </label>
        <input type="hidden" name="deal_images" id="deal_images" class="form-control">
        <div class="deal-images-wrap"></div>
        <a href="javascript:;" class="image-upload deal-images"><?php _e( 'Select deal images', 'couponxl' ) ?></a>
        <p class="description"><?php _e( 'Choose images for the deal. Drag and drop to change their order.', 'couponxl' ); ?></p>
    </div>
    <div class="input-group">
        <label for="deal_link"><?php _e( 'Deal Affiliate Link', 'couponxl' ); ?> </label>
        <input type="text" name="deal_link" id="deal_link" value="<?php echo esc_attr( $deal_link ) ?>" class="form-control">
        <p class="description"><?php _e( 'Input affiliate link for the deal in order to avoid payment over this website.', 'couponxl' ); ?></p>
    </div>
    <div class="input-group">
        <label for="deal_in_short"><?php _e( 'Short Description', 'couponxl' ); ?> <span class="required">*</span></label>
        <textarea type="text" name="deal_in_short" id="deal_in_short" class="form-control" data-validation="required" data-error="<?php esc_attr_e( 'Please input deal in short', 'couponxl' ); ?>"><?php echo $deal_in_short ?></textarea>
        <p class="description"><?php _e( 'Input description which will appear in the deal single page sidebar.', 'couponxl' ); ?></p>
    </div>    
</div>

<h1></h1>
<div>
    <div class="input-group">
        <label for="deal_price"><?php _e( 'Deal Price', 'couponxl' ); ?> <span class="required">*</span></label>
        <input type="text" name="deal_price" id="deal_price" value="<?php echo esc_attr( $deal_price ) ?>" class="form-control" data-validation="required" data-error="<?php esc_attr_e( 'Please input real deal price', 'couponxl' ) ?>">
        <p class="description"><?php _e( 'Input real price of the deal without currency simbol. If this value is decimal than use . as decimal separator and max two decimal places.', 'couponxl' ); ?></p>    
    </div>

    <div class="input-group">
        <label for="deal_sale_price"><?php _e( 'Deal Sale Price', 'couponxl' ); ?> <span class="required">*</span></label>
        <input type="text" name="deal_sale_price" id="deal_sale_price" value="<?php echo esc_attr( $deal_sale_price ) ?>" class="form-control" data-validation="required" data-error="<?php esc_attr_e( 'Please input deal sale price', 'couponxl' ) ?>">
        <p class="description"><?php _e( 'Input sale price of the deal without currency simbol ( auto updated by the percentage change in the next field ). If this value is decimal than use . as decimal separator and max two decimal places.', 'couponxl' ); ?></p>
    </div>

    <div class="input-group">
        <label for="deal_discount"><?php _e( 'Deal Discount', 'couponxl' ); ?> <span class="required">*</span></label>
        <input type="text" name="deal_discount" id="deal_discount" value="<?php echo esc_attr( $deal_discount ) ?>" class="form-control" data-validation="required" data-error="<?php esc_attr_e( 'Please value of the discount', 'couponxl' ) ?>">
        <p class="description"><?php _e( 'Input discount percentage number with the % sign after number ( auto updated by the sale price change in the previous field ).', 'couponxl' ); ?></p>
    </div>
    <div class="input-group">
        <label for="deal_markers"><?php _e( 'Deal Marker Locations', 'couponxl' ); ?> </label>
        <a href="javascript:;" class="btn new-marker" title="<?php esc_attr_e( 'Add new marker', 'couponxl' ); ?>"><i class="fa fa-plus"></i></a>
        <div class="row marker-wrap">
            <div class="col-xs-5">
                <div class="input-group">
                    <label for="deal_in_short"><?php _e( 'Marker Longitude', 'couponxl' ); ?> </label>            
                    <input type="text" name="deal_markers[deal_marker_longitude][]" id="deal_markers" class="form-control">
                </div>
            </div>
            <div class="col-xs-5">
                <div class="input-group">
                    <label for="deal_in_short"><?php _e( 'Marker Latitude', 'couponxl' ); ?> </label>            
                    <input type="text" name="deal_markers[deal_marker_latitude][]" id="deal_markers" class="form-control">
                </div>        
            </div>
            <div class="col-xs-2">
                <a href="javascript:;" class="btn remove-marker" title="<?php esc_attr_e( 'Remove marker', 'couponxl' ); ?>"><i class="fa fa-minus"></i></a>
            </div>        
        </div>
        <p class="description"><?php _e( 'Set places where customers can use their vauchers. Use Longitude & Latitude for google map markers, to findlong/lat ', 'couponxl' ); ?><a href="http://www.latlong.net/" target="_blank"><?php _e( 'use this link', 'couponxl' ) ?></a></p>
    </div>
    <div class="input-group">
        <label for="deal_type"><?php _e( 'Deal Type', 'couponxl' ); ?> <span class="required">*</span></label>
        <select name="deal_type" id="deal_type" class="form-control" data-validation="required" data-error="<?php esc_attr_e( 'Select deal type', 'couponxl' ); ?>" data-shared="<?php echo couponxl_get_option( 'deal_owner_price_shared' ) ?>" data-not_shared="<?php echo couponxl_get_option( 'deal_owner_price_not_shared' ) ?>" data-unit="<?php echo couponxl_get_option( 'unit' ) ?>" data-unit_position="<?php echo couponxl_get_option( 'unit_position' ) ?>">
            <option value=""><?php _e( '- Select -', 'couponxl' ) ?></option>
            <option value="shared" <?php echo $deal_type == 'shared' ? 'selected="selected"' : ''; ?>><?php _e( 'Website Offer', 'couponxl' ) ?></option>
            <option value="not_shared" <?php echo $deal_type == 'not_shared' ? 'selected="selected"' : ''; ?>><?php _e( 'Store Offer', 'couponxl' ) ?></option>
        </select>
        <div class="alert alert-info shared_info">
            <p><?php _e( 'Website Offer:', 'couponxl' ) ?></p>
            <p><?php echo '<strong>'.__( 'This type of deal is usually picked when you want to sell discounted products or services.', 'couponxl' ).'</strong>'; ?></p>
            <p><?php _e( 'Sell discounted products and services through website.', 'couponxl' ) ?></p>
            <p><?php echo __( 'Deal buyer will be charged ', 'couponxl').'<strong><span class="charged"></span></strong>'.__(' for each purchase by site owner.', 'couponxl' ) ?></p>
        </div>
        <div class="alert alert-info not_shared_info">
            <p><?php _e( 'Store Offer:', 'couponxl' ) ?></p>
            <p><?php echo '<strong>'.__( 'This type of deal is usually picked when you want to sell codes/vouchers for discounted products.', 'couponxl' ).'</strong>'; ?></p>
            <p><?php _e( 'Sell discounted products and services through your store.', 'couponxl' ) ?></p>
            <p><?php echo __( 'Deal buyer will be charged ', 'couponxl').'<strong><span class="charged"></span></strong>'.__(' for each purchase by site owner.', 'couponxl' ) ?></p>
        </div>    
        <p class="description"><?php _e( 'Choose deal type. Choose for more details', 'couponxl' ); ?></p>
        <?php include( locate_template( 'includes/profile-pages/terms.php' ) ); ?>
    </div>    
</div>