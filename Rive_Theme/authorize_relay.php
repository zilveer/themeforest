<?php

// Transaction was successful
if (  $_REQUEST['x_response_code'] == "1" ) {

	$project_id     = $_REQUEST['custom'];
	$payment_amount = $_REQUEST['amount'];
	$return			= urldecode($_REQUEST['return']);

	// Get current donations amount and fundraisers count
	$current_donations   = get_post_meta( $project_id, '_donations_so_far', true );
	$current_fundraisers = get_post_meta( $project_id, '_fundraisers', true );

	// Update DB
	update_post_meta($project_id, '_donations_so_far', ( (float)$current_donations + (float)$payment_amount ) );
	update_post_meta($project_id, '_fundraisers', ( (int)$current_fundraisers + 1 ) );

	?>
	<script type="text/javascript">
		window.location = "<?php echo $return; ?>"; 
	</script>
	<?php
	exit();
}