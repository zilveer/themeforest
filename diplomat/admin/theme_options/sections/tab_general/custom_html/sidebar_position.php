<?php $sidebar_position_selected = TMM::get_option('sidebar_position'); ?>
<?php $sidebar_position_selected = (!$sidebar_position_selected ? "sbr" : $sidebar_position_selected) ?>

<input type="hidden" value="<?php echo esc_attr($sidebar_position_selected); ?>" name="sidebar_position" />

<ul class="admin-choice-sidebar clearfix">
	<li data-val="sbl" class="lside <?php echo ($sidebar_position_selected == "sbl" ? "current" : "") ?>"><a href="sbl"><?php _e('Left Sidebar', 'diplomat'); ?></a></li>
	<li data-val="no_sidebar" class="wside <?php echo ($sidebar_position_selected == "no_sidebar" ? "current" : "") ?>"><a href="no_sidebar" ><?php _e('Without Sidebar', 'diplomat'); ?></a></li>
	<li data-val="sbr" class="rside <?php echo ($sidebar_position_selected == "sbr" ? "current" : "") ?>"><a href="sbr"><?php _e('Right Sidebar', 'diplomat'); ?></a></li>
</ul>
