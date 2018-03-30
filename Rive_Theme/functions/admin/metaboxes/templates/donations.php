<?php
global $post;

$how_many_donations_are_needed = (get_post_meta( $post->ID, $id, true )) ? get_post_meta( $post->ID, $id, true ) : 0;
$current_fundrainers           = (get_post_meta( $post->ID, '_fundraisers', true )) ? get_post_meta( $post->ID, '_fundraisers', true ) : 0;
$current_donations             = (get_post_meta( $post->ID, '_donations_so_far', true )) ? get_post_meta( $post->ID, '_donations_so_far', true ) : 0;
$paypal_email                  = (get_post_meta( $post->ID, '_custom_paypal_email', true )) ? get_post_meta( $post->ID, '_custom_paypal_email', true ) : '';
?>
<div class="row-container">
	<div class="misc-pub-section" style="padding-left: 0;">
		<strong>How many donations are needed?</strong><br />
		<span>$ <input type="text" name="<?php echo $id; ?>" value="<?php echo $how_many_donations_are_needed; ?>" /></span>
	</div>
	<div class="misc-pub-section" style="padding-left: 0;">
		<strong>Donations so far: </strong><br />
		$ <input type="text" name="_donations_so_far" value="<?php echo $current_donations; ?>" />
	</div>
	<div class="misc-pub-section" style="padding-left: 0;">
		<strong>Fundraisers: </strong><br />
		&nbsp;&nbsp;&nbsp;<input type="text" name="_fundraisers" value="<?php echo $current_fundrainers; ?>" />
	</div>
	<div class="misc-pub-section" style="padding-left: 0; border-bottom: 0;">
		<strong>PayPal email: </strong><br />
		&nbsp;&nbsp;&nbsp;<input type="text" name="_custom_paypal_email" value="<?php echo $paypal_email; ?>" />
		<p>Use this field if you want to use custom PayPal email for this specific cause, if left empty then global PayPal email which you have specified on <em>Theme Options</em> page will be used instead</p>
	</div>
</div>