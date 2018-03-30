<?php

$offer = get_post( $offer_id );
$offer_discussion_old = get_post_meta( $offer_id, 'offer_discussion', true );

if( isset( $_POST['offer_discussion'] ) ){
	$offer_discussion = $_POST['offer_discussion'];
	$message = __( 'New discussion message for the offer: ', 'couponxl' ).'<a href="'.get_edit_post_link( $offer_id, '' ).'" target="_blank">'.$offer->post_title.'</a>';
	$message .= "\n\n Message:\n\n".$offer_discussion;

	$offer_discussion_old .= "<strong>%user_".get_current_user_id()."% #".current_time( 'timestamp' )."#:</strong>\n".$offer_discussion."\n\n";
	update_post_meta( $offer_id, 'offer_discussion', $offer_discussion_old );

	$info = couponxl_send_admin_message( $message );

	echo '<div class="alert alert-success">'.__( 'Your message has been sent.', 'couponxl' ).'</div>';
}

?>
<h2><?php _e( 'Discussion on ', 'couponxl' ); ?><?php echo $offer->post_title; ?></h2>
<form method="post" action="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => $subpage, 'action' => 'edit', 'offer_id' => $offer_id ), array( 'all' ) ) ) ?>">
    <div class="input-group">
        <label for="offer_discussion"><?php _e( 'WRITE TO ADMINISTRATOR', 'couponxl' ); ?></label>
        <textarea name="offer_discussion" id="offer_discussion"></textarea>
    </div>
    <a href="javascript:;" class="btn submit-form"><?php _e( 'SEND', 'couponxl' ) ?></a>
</form>
<div class="discussion">
	<?php if( !empty( $offer_discussion_old ) ): ?>
		<h4><?php _e( 'Previous discussion', 'couponxl' ); ?></h4>
		<?php 
		$offer_discussion_old = couponxl_prepare_discussion_names( $offer_discussion_old );
		echo apply_filters( 'the_content', $offer_discussion_old );
		?>
	<?php endif; ?>
</div>