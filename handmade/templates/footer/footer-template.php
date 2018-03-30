<?php
global $g5plus_options;
$prefix = 'g5plus_';

$footer_top_bar_show_hide = rwmb_meta($prefix . 'footer_top_bar_show_hide');
if ($footer_top_bar_show_hide == '') {
	$footer_top_bar_show_hide = '1';
}
if ($footer_top_bar_show_hide == '0') return;

$footer_sidebar = array();

$footer_wrap_layout = rwmb_meta($prefix . 'footer_wrap_layout');
if (!isset($footer_wrap_layout) || $footer_wrap_layout == '' || $footer_wrap_layout == '-1') {
	$footer_wrap_layout = $g5plus_options['footer_wrap_layout'];
}


$footer_layout_custom = rwmb_meta($prefix . 'footer_layout');
$footer_layout = $footer_layout_custom;
if (!isset($footer_layout) || $footer_layout == '' || $footer_layout == '-1') {
	$footer_layout = $g5plus_options['footer_layout'];
}

if (!isset($footer_layout_custom) || $footer_layout_custom == '' || $footer_layout_custom == '-1') {
	$footer_sidebar_1 = $g5plus_options['footer_sidebar_1'];
} else {
	$footer_sidebar_1 = rwmb_meta($prefix. 'footer_sidebar_1');
}

$footer_sidebar[0] = $footer_sidebar_1;

if (!isset($footer_layout_custom) || $footer_layout_custom == '' || $footer_layout_custom == '-1') {
	$footer_sidebar_2 = $g5plus_options['footer_sidebar_2'];
} else {
	$footer_sidebar_2 = rwmb_meta($prefix . 'footer_sidebar_2');
}

$footer_sidebar[1] = $footer_sidebar_2;

if (!isset($footer_layout_custom) || $footer_layout_custom == '' || $footer_layout_custom == '-1') {
	$footer_sidebar_3 = $g5plus_options['footer_sidebar_3'];
} else {
	$footer_sidebar_3 = rwmb_meta($prefix . 'footer_sidebar_3');
}
$footer_sidebar[2] = $footer_sidebar_3;

if (!isset($footer_layout_custom) || $footer_layout_custom == '' || $footer_layout_custom == '-1') {
	$footer_sidebar_4 = $g5plus_options['footer_sidebar_4'];
} else {
	$footer_sidebar_4 = rwmb_meta($prefix . 'footer_sidebar_4');
}
$footer_sidebar[3] = $footer_sidebar_4;


$col_footer = 0;
for ($i=0; $i<4; $i++) {
	if(is_active_sidebar($footer_sidebar[$i])) {
		$col_footer +=1;
	}
}


$col_footer_class = array();

if($footer_layout=='footer-1'){
	$col_footer_class[0] = $col_footer_class[1] = $col_footer_class[2] = $col_footer_class[3] =  'col-md-3 col-sm-6';
}
if($footer_layout=='footer-2'){
	$col_footer_class[0] = 'col-md-6 col-sm-12';
	$col_footer_class[1] = $col_footer_class[2] = 'col-md-3 col-sm-6';
}

if($footer_layout=='footer-3'){
	$col_footer_class[0] = $col_footer_class[1] = 'col-md-3 col-sm-6';
	$col_footer_class[2] = 'col-md-6 col-sm-12';
}

if($footer_layout=='footer-4'){
	$col_footer_class[0] = $col_footer_class[1] = 'col-md-6 col-sm-12';
}

if($footer_layout=='footer-5'){
	$col_footer_class[0] = $col_footer_class[1] = $col_footer_class[2] = 'col-md-4 col-sm-12';
}

if($footer_layout=='footer-6'){
	$col_footer_class[0] = 'col-md-9 col-sm-12';
	$col_footer_class[1] = 'col-md-3 col-sm-12';
}

if($footer_layout=='footer-7'){
	$col_footer_class[0] = 'col-md-3 col-sm-12';
	$col_footer_class[1] = 'col-md-9 col-sm-12';
}

if($footer_layout=='footer-8'){
	$col_footer_class[0] = 'col-md-3 col-sm-12';
	$col_footer_class[1] = 'col-md-6 col-sm-12';
	$col_footer_class[2] = 'col-md-3 col-sm-12';
}

if($footer_layout=='footer-9'){
	$col_footer_class[0] = 'col-md-12 col-sm-12';
}

if ($col_footer == 0) return;

?>
<div class="main-footer">
	<div class="footer_inner clearfix">
        <?php  g5plus_get_template('footer/top-bar'); ?>
		<?php if ($col_footer > 0):?>
			<div class="footer_top_holder col-<?php echo esc_attr($col_footer); ?>">
				<div class="container">
					<div class="row footer-top-col-<?php echo esc_attr($col_footer . ' ' . $footer_layout); ?>">
						<?php
						for ($j=1; $j<=4; $j++) {
							if(is_active_sidebar($footer_sidebar[$j -1])) {
								if(count($col_footer_class) >= $j ){
									echo '<div class="sidebar footer-sidebar '. esc_attr($col_footer_class[$j-1]).' col-'. $j .'">';
									dynamic_sidebar($footer_sidebar[$j -1]);
									echo '</div>';
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		<?php endif;?>
	</div>
</div>