<?php $sidebar_position_selected = TMM::get_option('single_car_sidebar_position', TMM_APP_CARDEALER_PREFIX); ?>
<?php $sidebar_position_selected = (!$sidebar_position_selected ? "sbr" : $sidebar_position_selected) ?>

<input type="hidden" value="<?php echo $sidebar_position_selected ?>" name="single_car_sidebar_position" />

<ul class="admin-choice-sidebar admin-car-choice-sidebar clearfix">
	<li data-val="sbl" class="lside <?php echo ($sidebar_position_selected == "sbl" ? "current-item" : "") ?>"><a href="sbl"><?php _e('Left Sidebar', 'cardealer'); ?></a></li>
	<li data-val="no_sidebar" class="wside <?php echo ($sidebar_position_selected == "no_sidebar" ? "current-item" : "") ?>"><a href="no_sidebar" ><?php _e('Without Sidebar', 'cardealer'); ?></a></li>
	<li data-val="sbr" class="rside <?php echo ($sidebar_position_selected == "sbr" ? "current-item" : "") ?>"><a href="sbr"><?php _e('Right Sidebar', 'cardealer'); ?></a></li>
</ul>
