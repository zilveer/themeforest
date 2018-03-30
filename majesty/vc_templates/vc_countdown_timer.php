<?php
/**
 * Shortcode attributes
 * @var $date
 * @var $size
 * @var $rtl
 * @var $dayslabel
 * @var $hourslabel
 * @var $minuteslabel
 * @var $secondslabel
 * @var $content
 * @var $el_class
 */

wp_enqueue_script('countdown');

$output = $year = $month = $day = '';
$atts 	= vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
if( ! empty( $el_class ) ) {
	$el_class = ' '. $el_class;
}
if( $size == 'smalltimer' ) {
	$el_class .= ' '. esc_attr($size);
}
if( empty( $date ) ) {
	return;
}
$date = apply_filters('sama_countdown_timer_date', $date);

$the_date = explode('/', $date);
if( isset( $the_date[0] ) ) {
	$year 	= $the_date[0];
} else {
	$year 	= 2016;
}
if( isset( $the_date[1] ) ) {
	$month 	= $the_date[1];
} else {
	$month 	= 12;
}
if( isset( $the_date[2] ) ) {
	$day 	= $the_date[2];
} else {
	$day 	= 10;
}

if( empty( $dayslabel ) ) {
	$dayslabel = 'Days';
}
if( empty( $hourslabel ) ) {
	$hourslabel = 'Hours';
}
if( empty( $minuteslabel ) ) {
	$minuteslabel = 'Minutes';
}
if( empty( $secondslabel ) ) {
	$secondslabel = 'Minutes';
}

global $majesty_allowed_tags;
$id = 'count-down-'. rand(1,9999);
echo '<div class="wrap-count-down '. esc_attr( trim($el_class) ) .'"><div class="expiretext">'. do_shortcode($content) .'</div><div id="'. esc_attr($id) .'" class="theme-count-dow" data-year="'. absint($year) .'" data-month="'. absint($month) .'" data-days="'. absint($day) .'" data-days-label="'. esc_attr( $dayslabel ) .'" data-hours-label="'. esc_attr( $hourslabel ) .'" data-minutes-label="'. esc_attr( $minuteslabel ) .'" data-seconds-label="'. esc_attr( $secondslabel ) .'" data-rtl="'. esc_attr( $rtl ) .'"></div></div>';