<?php
/*
 * Donations metabox
 */

$config = array(
	'id'       => 'ch_donations',
	'title'    => __('Donations', 'ch'),
	'pages'    => array('ch_cause'),
	'context'  => 'side',
	'priority' => 'high',
);

$options = array(array(
	'name' => __('How many donations are needed?', 'ch'),
	'id'   => '_how_many_donations_are_needed',
	'type' => 'donations',
	'only' => 'ch_cause',
),array(
	'name' => __('Donation so far', 'ch'),
	'id'   => '_donations_so_far',
	'type' => 'donations',
	'only' => 'ch_cause',
),array(
	'name' => __('Fundrisers', 'ch'),
	'id'   => '_fundraisers',
	'type' => 'donations',
	'only' => 'ch_cause',
),array(
	'name' => __('PayPal email', 'ch'),
	'id'   => '_custom_paypal_email',
	'type' => 'donations',
	'only' => 'ch_cause',
));

require_once(CH_METABOXES . '/add_metaboxes.php');
new create_meta_boxes($config, $options);