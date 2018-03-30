<?php if($footer_top_border != '') {
	//Footer top border
	if($footer_top_border_in_grid !== '') { ?>
		<div class="eltd-footer-ingrid-border-holder-outer">
	<?php } ?>
	<div class="eltd-footer-top-border-holder <?php echo esc_attr($footer_top_border_in_grid); ?>" <?php flow_elated_inline_style($footer_top_border); ?>></div>
	<?php if($footer_top_border_in_grid !== '') { ?>
		</div>
	<?php }
} ?>

<div class="eltd-footer-top-holder">
	<div class="eltd-footer-top <?php echo esc_attr($footer_top_classes) ?>">
		<?php if($footer_in_grid) { ?>

		<div class="eltd-container">
			<div class="eltd-container-inner">

		<?php }

		switch ($footer_top_columns) {
			case 6:
				flow_elated_get_footer_sidebar_25_25_50();
				break;
			case 5:
				flow_elated_get_footer_sidebar_50_25_25();
				break;
			case 4:
				flow_elated_get_footer_sidebar_four_columns();
				break;
			case 3:
				flow_elated_get_footer_sidebar_three_columns();
				break;
			case 2:
				flow_elated_get_footer_sidebar_two_columns();
				break;
			case 1:
				flow_elated_get_footer_sidebar_one_column();
				break;
		}

		if($footer_in_grid) { ?>
			</div>
		</div>
	<?php } ?>
	</div>
</div>
