<?php get_sidebar('footer'); ?>

<?php
$footer_copyrights = couponxl_get_option( 'footer_copyrights' );
$footer_facebook = couponxl_get_option( 'footer_facebook' );
$footer_twitter = couponxl_get_option( 'footer_twitter' );
$footer_google = couponxl_get_option( 'footer_google' );

if( !empty( $footer_copyrights ) || !empty( $footer_facebook ) || !empty( $footer_twitter ) || !empty( $footer_google ) ):
?>
	<section class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php
					$show_to_top = couponxl_get_option( 'show_to_top' );
					if( $show_to_top == 'yes' ):
					?>
						<div class="to-top">
							<a href="javascript:;">
								<i class="fa fa-angle-double-up"></i>
							</a>
						</div>
					<?php endif; ?>

					<div class="pull-left">
						<?php echo $footer_copyrights ?>
					</div>

					<div class="pull-right">
						<?php
							if( !empty( $footer_facebook ) ){
								?>
								<a href="<?php echo esc_url( $footer_facebook ) ?>" class="btn facebook" target="_blank"><i class="fa fa-facebook"></i></a>
								<?php
							}
							if( !empty( $footer_twitter ) ){
								?>
								<a href="<?php echo esc_url( $footer_twitter ) ?>" class="btn twitter" target="_blank"><i class="fa fa-twitter"></i></a>
								<?php
							}
							if( !empty( $footer_google ) ){
								?>
								<a href="<?php echo esc_url( $footer_google ) ?>" class="btn google" target="_blank"><i class="fa fa-google-plus"></i></a>
								<?php
							}						
						?>
					</div>

				</div>
			</div>
		</div>
	</section>
<?php
endif;
?>
<!-- modal -->
<div class="modal fade in" id="showCode" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content showCode-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<div class="coupon_modal_content">
				</div>
			</div>
		</div>
	</div>
</div>

<?php if( is_singular( 'offer' ) ): ?>
<div class="modal fade in" id="sendFriend" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<form>
					<div class="input-group">
					    <label for="frinds_email"><?php _e( 'Friend\'s email', 'couponxl' ); ?></label>
					    <input type="text" name="frinds_email" id="frinds_email" class="form-control">
					    <p class="description"><?php _e( 'Input email of your friend.', 'couponxl' ); ?></p>
					</div>
					<div class="input-group">
					    <label for="your_message"><?php _e( 'Message', 'couponxl' ); ?></label>
					    <textarea type="text" name="your_message" id="your_message" class="form-control"></textarea>
					    <p class="description"><?php _e( 'Input optional message for your friend.', 'couponxl' ); ?></p>
					</div>
					<input type="hidden" name="action" value="send_friend">
					<input type="hidden" name="offer_id" value="<?php the_ID(); ?>">
					<div class="friend-response"></div>
					<a href="javascript:;" class="btn send-friend"><?php _e( 'SEND', 'couponxl' ); ?></a>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<!-- .modal -->
<!-- modal -->
<div class="modal fade in" id="showPayment" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content showCode-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<div class="payment-content">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade in" id="payUAdditional" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content showCode-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<div class="payu-content-modal">
				</div>
			</div>
		</div>
	</div>
</div>

<!-- .modal -->
<?php wp_footer(); ?>
</body>
</html>