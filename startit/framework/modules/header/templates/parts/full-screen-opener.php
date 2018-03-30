<?php
$icon_size = '';
$fullscreen_icon_styles = array();

if (qode_startit_options()->getOptionValue('fullscreen_menu_icon_size') !== '' ) {
	$icon_size = qode_startit_options()->getOptionValue('fullscreen_menu_icon_size');
}

?>
<?php do_action('qode_startit_before_top_navigation'); ?>
	<a href="javascript:void(0)" class="qodef-fullscreen-menu-opener <?php echo esc_attr( $icon_size )?>">
		<span class="qodef-fullscreen-menu-opener-inner">
			<i class="qodef-line">&nbsp;</i>
		</span>
	</a>
<?php do_action('qode_startit_after_top_navigation'); ?>