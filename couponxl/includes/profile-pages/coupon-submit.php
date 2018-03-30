<div class="input-group">
    <label for="coupon_excerpt"><?php _e( 'Coupon Excerpt', 'couponxl' ); ?></label>
    <textarea name="coupon_excerpt" id="coupon_excerpt" class="form-control"></textarea>
    <p class="description"><?php _e( 'Input coupon excerpt.', 'couponxl' ); ?></p>
</div>


<div class="input-group">
    <label for="coupon_type"><?php _e( 'Coupon Type', 'couponxl' ); ?> <span class="required">*</span></label>
    <select name="coupon_type" id="coupon_type" class="form-control" data-validation="required" data-error="<?php esc_attr_e( 'Select coupon type', 'couponxl' ); ?>">
    	<option value=""><?php _e( '- Select -', 'couponxl' ) ?></option>
    	<option value="code" <?php echo $coupon_type == 'code' ? 'selected="selected"' : ''; ?>><?php _e( 'Code', 'couponxl' ) ?></option>
    	<option value="sale" <?php echo $coupon_type == 'sale' ? 'selected="selected"' : ''; ?>><?php _e( 'Sale', 'couponxl' ) ?></option>
    	<option value="printable" <?php echo $coupon_type == 'printable' ? 'selected="selected"' : ''; ?>><?php _e( 'Printable', 'couponxl' ) ?></option>
    </select>
    <p class="description"><?php _e( 'Choose type of the coupon.', 'couponxl' ); ?></p>
</div>

<div class="input-group group_code <?php echo $coupon_type == 'code' ? 'visible' : ''; ?>">
    <label for="coupon_code"><?php _e( 'Coupon Code Value', 'couponxl' ); ?> <span class="required">*</span></label>
    <input type="text" name="coupon_code" id="coupon_code" value="<?php echo esc_attr( $coupon_code ) ?>" class="form-control" data-validation="required" data-error="<?php esc_attr_e( 'Please input coupon code for the coupon', 'couponxl' ); ?>">
    <p class="description"><?php _e( 'Input coupon code.', 'couponxl' ); ?></p>
</div>

<div class="input-group group_sale <?php echo $coupon_type == 'sale' ? 'visible' : ''; ?>">
    <label for="coupon_sale"><?php _e( 'Coupon Sale Link', 'couponxl' ); ?> <span class="required">*</span></label>
    <input type="text" name="coupon_sale" id="coupon_sale" value="<?php echo esc_attr( $coupon_sale ) ?>" class="form-control" data-validation="required" data-error="<?php esc_attr_e( 'Please input coupon sale link for the coupon', 'couponxl' ); ?>">
    <p class="description"><?php _e( 'Input sale link.', 'couponxl' ); ?></p>
</div>

<div class="input-group group_printable <?php echo $coupon_type == 'printable' ? 'visible' : ''; ?>">
    <label for="coupon_image"><?php _e( 'Printable Coupon Image', 'couponxl' ); ?> <span class="required">*</span></label>
    <input type="hidden" name="coupon_image" id="coupon_image" value="<?php esc_attr( $coupon_image ) ?>" data-validation="required" data-error="<?php esc_attr_e( 'Please select image for the printable coupon', 'couponxl' ); ?>">
    <div class="upload-image-wrap coupon-image-wrap"></div>
    <a href="javascript:;" class="image-upload coupon-image"><?php _e( 'Select coupon image', 'couponxl' ) ?></a>    
    <p class="description"><?php _e( 'Upload printable coupon image.', 'couponxl' ); ?></p>
</div>

<div class="input-group">
    <label for="coupon_link"><?php _e( 'Affiliate Link', 'couponxl' ); ?></label>
    <input type="text" name="coupon_link" id="coupon_link" value="<?php echo esc_attr( $coupon_link ); ?>" class="form-control">
    <p class="description"><?php _e( 'Input affiliate link which will be opened once the coupon is clicked.', 'couponxl' ); ?></p>
</div>

<?php include( locate_template( 'includes/profile-pages/terms.php' ) ); ?>