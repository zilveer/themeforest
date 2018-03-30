<?php
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';

global $g5plus_footer_container_layout;
$g5plus_footer_container_layout = rwmb_meta($prefix . 'footer_container_layout');
if (!isset($g5plus_footer_container_layout) || $g5plus_footer_container_layout == '' || $g5plus_footer_container_layout == '-1') {
	$g5plus_footer_container_layout = isset($g5plus_options['footer_container_layout']) ? $g5plus_options['footer_container_layout'] : 'container';
}

$footer_layout_custom = rwmb_meta($prefix . 'footer_layout');
$footer_layout = $footer_layout_custom;
if (!isset($footer_layout) || $footer_layout == '' || $footer_layout == '-1') {
	$footer_layout = $g5plus_options['footer_layout'];
}

$config_col_footer = array(
	'footer-1' => array('col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6'),
	'footer-2' => array('col-md-6 col-sm-12', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6'),
	'footer-3' => array('col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-6 col-sm-12'),
	'footer-4' => array('col-md-6 col-sm-12', 'col-md-6 col-sm-12'),
	'footer-5' => array('col-md-4 col-sm-12', 'col-md-4 col-sm-12', 'col-md-4 col-sm-12'),
	'footer-6' => array('col-md-8 col-sm-12', 'col-md-4 col-sm-12'),
	'footer-7' => array('col-md-4 col-sm-12', 'col-md-8 col-sm-12'),
	'footer-8' => array('col-md-3 col-sm-12', 'col-md-6 col-sm-12', 'col-md-3 col-sm-12'),
	'footer-9' => array('col-md-12 col-sm-12'),
);

$col_footer = 0;
$footer_sidebar = array();

for ($i=0; $i < count($config_col_footer[$footer_layout]); $i++) {
	$footer_sidebar_item = '';
	$sidebar_index = $i + 1;
	if (!isset($footer_layout_custom) || $footer_layout_custom == '' || $footer_layout_custom == '-1') {
		$footer_sidebar_item = $g5plus_options['footer_sidebar_' . $sidebar_index];
	} else {
		$footer_sidebar_item = rwmb_meta($prefix . 'footer_sidebar_' . $sidebar_index);
	}
	$footer_sidebar[$i] = $footer_sidebar_item;

	if(is_active_sidebar($footer_sidebar_item)) {
		$col_footer ++;
	}
}

$col_footer_class = $config_col_footer[$footer_layout];
?>
<?php  g5plus_get_template('footer/footer-above'); ?>
<?php if ($col_footer > 0):?>
	<div class="main-footer">
		<div class="footer_inner clearfix">
	        <div class="footer_top_holder col-<?php echo esc_attr($col_footer); ?>">
	            <div class="<?php echo esc_attr($g5plus_footer_container_layout) ?>">
	                <div class="row footer-top-col-<?php echo esc_attr($col_footer . ' ' . $footer_layout); ?>">
	                    <?php
	                    for ($j=1; $j <= count($config_col_footer[$footer_layout]); $j++) {
	                        if(is_active_sidebar($footer_sidebar[$j -1])) {
		                        echo '<div class="sidebar footer-sidebar '. esc_attr($col_footer_class[$j-1]).'">';
		                        dynamic_sidebar($footer_sidebar[$j -1]);
		                        echo '</div>';
	                        }
	                    }
	                    ?>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
<?php endif;?>
<?php  g5plus_get_template('footer/bottom-bar'); ?>