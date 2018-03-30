<?php if($footer_bottom_border != '') {
	if($footer_bottom_border_in_grid != '') { ?>
		<div class="eltd-footer-ingrid-border-holder-outer">
	<?php } ?>
	<div class="eltd-footer-bottom-border-holder <?php echo esc_attr($footer_bottom_border_in_grid); ?>" <?php flow_elated_inline_style($footer_bottom_border); ?>></div>
	<?php if($footer_bottom_border_in_grid != '') { ?>
		</div>
	<?php }
} ?>

<div class="eltd-footer-bottom-holder">
	<div class="eltd-footer-bottom-holder-inner">
		<?php if($footer_in_grid) { ?>
			<div class="eltd-container">
				<div class="eltd-container-inner">

		<?php }

		switch ($footer_bottom_columns) {
			case 3:
				flow_elated_get_footer_bottom_sidebar_three_columns();
				break;
			case 2:
				flow_elated_get_footer_bottom_sidebar_two_columns();
				break;
			case 1:
				flow_elated_get_footer_bottom_sidebar_one_column();
				break;
		}
		if($footer_in_grid){ ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
<?php if($footer_bottom_border_bottom != ''){ ?>
	<div class="eltd-footer-bottom-border-bottom-holder <?php echo esc_attr($footer_top_border_in_grid); ?>" <?php flow_elated_inline_style($footer_bottom_border_bottom); ?>></div>
<?php } ?>