<?php
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';

$is_show_top_bar = rwmb_meta($prefix . 'top_bar_mobile');

if (($is_show_top_bar === '') || ($is_show_top_bar == '-1')) {
	$is_show_top_bar = $g5plus_options['top_bar_mobile'];
}
if (!$is_show_top_bar) {
	return; // NOT SHOW TOP BAR
}

$top_bar_layout = rwmb_meta($prefix . 'top_bar_mobile_layout');
if (($top_bar_layout === '') || ($top_bar_layout == '-1')) {
	$top_bar_layout = $g5plus_options['top_bar_mobile_layout'];
}

$left_sidebar = rwmb_meta($prefix . 'top_bar_mobile_left_sidebar');
if (($left_sidebar === '') || ($left_sidebar == '-1')) {
	$left_sidebar = $g5plus_options['top_bar_mobile_left_sidebar'];
}

$right_sidebar = rwmb_meta($prefix . 'top_bar_mobile_right_sidebar');
if (($right_sidebar === '') || ($right_sidebar == '-1')) {
	$right_sidebar = $g5plus_options['top_bar_mobile_right_sidebar'];
}

$col_top_bar_left = '';
$col_top_bar_right = '';

if (is_active_sidebar($left_sidebar) && is_active_sidebar($right_sidebar) ) {
	switch ($top_bar_layout) {
		case 'top-bar-1':
			$col_top_bar_left = 'col-xs-6';
			$col_top_bar_right = 'col-xs-6';
			break;
		case 'top-bar-2':
			$col_top_bar_left = 'col-xs-8';
			$col_top_bar_right = 'col-xs-4';
			break;
		case 'top-bar-3':
			$col_top_bar_left = 'col-xs-4';
			$col_top_bar_right = 'col-xs-8';
			break;
	}

}else if (is_active_sidebar($left_sidebar) || is_active_sidebar($right_sidebar) ) {
	$col_top_bar_left = 'col-xs-12';
	$col_top_bar_right = 'col-xs-12';
}

if (empty($col_top_bar_left)) {
	return; // NOT SHOW TOP BAR
}

$top_bar_class = array('top-bar-mobile');
?>
<div class="<?php echo join(' ', $top_bar_class); ?>">
	<div class="container">
		<div class="header-mobile-container-inner">
			<div class="row">
				<?php if (is_active_sidebar($left_sidebar)): ?>
					<div class="sidebar top-bar-left <?php echo esc_attr($col_top_bar_left) ?>">
						<?php dynamic_sidebar( $left_sidebar );?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar($right_sidebar)): ?>
					<div class="sidebar top-bar-right <?php echo esc_attr($col_top_bar_right) ?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>