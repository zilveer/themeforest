<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

$idy_date = $atts['date'];
$idy_timestamp = strtotime($idy_date);
$idy_year = date('Y', $idy_timestamp);
$idy_month = date('m', $idy_timestamp);
$idy_day = date('d', $idy_timestamp);
?>

<!-- CountDown -->
<span class="idy_countdown" data-year="<?php echo esc_attr($idy_year); ?>" data-month="<?php echo esc_attr($idy_month); ?>" data-day="<?php echo esc_attr($idy_day); ?>"></span>
