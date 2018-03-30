<?php
/*
 * info box
 */

$is_open = isset($visible) && $visible;

$close = __('Close', 'health-center');
$open = __('Open', 'health-center');

$other = $is_open ? $open : $close;
$normal = $is_open ? $close : $open;

?>

<div class="wpv-config-row config-info <?php echo $class ?>">
	<div class="info-wrapper">
		<div class="title"><?php echo $name ?></div>
		<a href="#" data-other="<?php echo esc_attr($other) ?>"><?php echo $normal ?></a>
		<div class="desc <?php if($is_open) echo 'visible' ?>"><?php echo $desc ?></div>
	</div>
</div>