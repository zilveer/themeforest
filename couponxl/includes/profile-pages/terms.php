<?php 
$terms = couponxl_get_option( 'terms' ); 
if( !empty( $terms ) ):
?>
    <div class="input-group">
        <label for="offer_expire"><?php _e( 'Terms & Condition', 'couponxl' ); ?> <span class="required">*</span></label>
        <div class="terms_conditions">
        	<?php echo apply_filters( 'the_content', $terms ); ?>
        </div>
        <div class="checkbox checkbox-inline">
        	<input type="checkbox" name="terms" id="terms" data-validation="checked" data-error="<?php esc_attr_e( 'You must read and accept terms in order to be able to submit your offer', 'couponxl' ); ?>">
        	<label for="terms"><?php _e( 'I have read and agreed with the terms and conditions.', 'couponxl' ); ?></label>
        </div>
    </div>
<?php endif; ?>