<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 9/26/15
 * Time: 3:52 PM
 */
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';

$footer_above_enable = rwmb_meta($prefix . 'footer_above_enable');
if (!isset($footer_above_enable) || $footer_above_enable == '-1' || $footer_above_enable=='') {
    $footer_above_enable = $g5plus_options['footer_above'];
}
if ($footer_above_enable != '1') {
	return;
}

$footer_above_layout_custom = rwmb_meta($prefix . 'footer_above_layout');
$footer_above_layout = $footer_above_layout_custom;
if (!isset($footer_above_layout) || $footer_above_layout == '-1' || $footer_above_layout == '') {
    $footer_above_layout = isset($g5plus_options['footer_above_layout']) ? $g5plus_options['footer_above_layout'] : 'footer-above-1';
}

if (!isset($footer_above_layout_custom) || $footer_above_layout_custom == '-1' || $footer_above_layout_custom == '') {
    $footer_above_left_sidebar = isset($g5plus_options['footer_above_left_sidebar']) ? $g5plus_options['footer_above_left_sidebar'] : '';
} else {
    $footer_above_left_sidebar = rwmb_meta($prefix . 'footer_above_left_sidebar');
}

if (!isset($footer_above_layout_custom) || $footer_above_layout_custom == '-1' || $footer_above_layout_custom == '') {
    $footer_above_right_sidebar = isset($g5plus_options['footer_above_right_sidebar']) ? $g5plus_options['footer_above_right_sidebar'] : '';
} else {
    $footer_above_right_sidebar = rwmb_meta($prefix . 'footer_above_right_sidebar');
}

$col_left_class = $col_right_class = '';
switch ($footer_above_layout) {
    case 'footer-above-2':
        $col_left_class = $col_right_class = 'col-md-6';
        break;
}

$sidebar_bottom_right_class = array($col_right_class, 'sidebar', 'text-right');
$sidebar_bottom_left_class = array($col_left_class, 'sidebar');

global $g5plus_footer_container_layout;
if (!isset($g5plus_footer_container_layout)) {
	$g5plus_footer_container_layout = 'container';
}

if ((($footer_above_left_sidebar != '' && is_active_sidebar($footer_above_left_sidebar)) ||
        ($footer_above_right_sidebar != '' && is_active_sidebar($footer_above_right_sidebar)))):
?>
    <div class="footer-above-wrapper">
	    <div class="<?php echo esc_attr($g5plus_footer_container_layout) ?>">
		    <div class="footer-above-inner">
			    <div class="row">
				    <?php if ($footer_above_left_sidebar != '' && is_active_sidebar($footer_above_left_sidebar)): ?>
					    <div class="<?php echo join(' ', $sidebar_bottom_left_class) ?>">
						    <?php dynamic_sidebar($footer_above_left_sidebar); ?>
					    </div>
				    <?php endif; ?>
				    <?php if ($footer_above_right_sidebar != '' && is_active_sidebar($footer_above_right_sidebar)): ?>
					    <div class="<?php echo join(' ', $sidebar_bottom_right_class) ?>">
						    <?php dynamic_sidebar($footer_above_right_sidebar); ?>
					    </div>
				    <?php endif; ?>
			    </div>
		    </div>
	    </div>
    </div>
<?php endif; ?>