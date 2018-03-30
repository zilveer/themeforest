<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 9/26/15
 * Time: 3:52 PM
 */
global $g5plus_options;
$prefix = 'g5plus_';
$footer_top_bar = rwmb_meta($prefix . 'footer_top_bar_enable');
if (!isset($footer_top_bar) || $footer_top_bar === '-1' || $footer_top_bar == '') {
    $footer_top_bar = $g5plus_options['footer_top_bar'];
}

$footer_top_bar_layout_custom = rwmb_meta($prefix . 'footer_top_bar_layout');
$footer_top_bar_layout = $footer_top_bar_layout_custom;
if (!isset($footer_top_bar_layout) || $footer_top_bar_layout == '-1' || $footer_top_bar_layout == '') {
    $footer_top_bar_layout = isset($g5plus_options['footer_top_bar_layout']) ? $g5plus_options['footer_top_bar_layout'] : 'footer-top-bar-1';
}

if (!isset($footer_top_bar_layout_custom) || $footer_top_bar_layout_custom == '-1' || $footer_top_bar_layout_custom == '') {
    $footer_top_bar_left_sidebar = $g5plus_options['footer_top_bar_left_sidebar'];
} else {
    $footer_top_bar_left_sidebar = rwmb_meta($prefix . 'footer_top_bar_left_sidebar');
}

if (!isset($footer_top_bar_layout_custom) || $footer_top_bar_layout_custom == '-1' || $footer_top_bar_layout_custom == '') {
    $footer_top_bar_right_sidebar = $g5plus_options['footer_top_bar_right_sidebar'];
} else {
    $footer_top_bar_right_sidebar = rwmb_meta($prefix . 'footer_top_bar_right_sidebar');
}

$col_left_class = $col_right_class = '';
switch ($footer_top_bar_layout) {
    case 'footer-top-bar-2':
        $col_left_class = $col_right_class = 'col-md-6';
        break;
}

$sidebar_bottom_right_class = array($col_right_class, 'sidebar', 'text-right');
$sidebar_bottom_left_class = array($col_left_class, 'sidebar');

if ($footer_top_bar === '1' && (($footer_top_bar_left_sidebar != '' && is_active_sidebar($footer_top_bar_left_sidebar)) ||
        ($footer_top_bar_right_sidebar != '' && is_active_sidebar($footer_top_bar_right_sidebar))
    )
) {
    ?>
    <div class="footer-top-bar-wrapper">
        <div class="footer-top-bar-inner">
            <div class="full">
                <?php if ($footer_top_bar_left_sidebar != '' && is_active_sidebar($footer_top_bar_left_sidebar)) { ?>
                    <div class="<?php echo join(' ', $sidebar_bottom_left_class) ?>">
                        <?php dynamic_sidebar($footer_top_bar_left_sidebar); ?>
                    </div>
                <?php } ?>
                <?php if ($footer_top_bar_right_sidebar != '' && is_active_sidebar($footer_top_bar_right_sidebar)) { ?>
                    <div class="<?php echo join(' ', $sidebar_bottom_right_class) ?>">
                        <?php dynamic_sidebar($footer_top_bar_right_sidebar); ?>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>