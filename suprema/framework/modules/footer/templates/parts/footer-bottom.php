<?php if($footer_bottom_border != '') {
	if($footer_bottom_border_in_grid != '') { ?>
		<div class="qodef-footer-ingrid-border-holder-outer">
	<?php } ?>
	<div class="qodef-footer-bottom-border-holder <?php echo esc_attr($footer_bottom_border_in_grid); ?>" <?php suprema_qodef_inline_style($footer_bottom_border); ?>></div>
	<?php if($footer_bottom_border_in_grid != '') { ?>
		</div>
	<?php }
} ?>

<div class="qodef-footer-bottom-holder">
	<div class="qodef-footer-bottom-holder-inner">
		<?php if($footer_in_grid) { ?>
			<div class="qodef-container">
				<div class="qodef-container-inner">

		<?php }

		switch ($footer_bottom_columns) {
			case 3:
				suprema_qodef_get_footer_bottom_sidebar_three_columns();
				break;
			case 2:
				suprema_qodef_get_footer_bottom_sidebar_two_columns();
				break;
			case 1:
				suprema_qodef_get_footer_bottom_sidebar_one_column();
				break;
		}
		if($footer_in_grid){ ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
<?php if($footer_bottom_border_bottom != ''){ ?>
	<div class="qodef-footer-bottom-border-bottom-holder <?php echo esc_attr($footer_top_border_in_grid); ?>" <?php suprema_qodef_inline_style($footer_bottom_border_bottom); ?>></div>
<?php } ?>