<?php
$output = '';
$default_atts =  array(
	'title'				=>'',
);
extract(shortcode_atts($default_atts, $atts));

$type = 'DH_Mailchimp_Widget';
$args = array('widget_id'=>'dh_widget_mailchimp');
ob_start();
the_widget( $type, wp_parse_args($atts,$default_atts), $args );
$output .= ob_get_clean();
echo $output;