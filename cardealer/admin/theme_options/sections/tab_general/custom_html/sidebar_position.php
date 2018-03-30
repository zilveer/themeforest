<?php $sidebar_position_selected = TMM::get_option('sidebar_position'); ?>
<?php $sidebar_position_selected = (!$sidebar_position_selected ? "sbr" : $sidebar_position_selected) ?>

<input type="hidden" value="<?php echo $sidebar_position_selected ?>" name="sidebar_position" />

<ul class="admin-choice-sidebar clearfix">
	<li data-val="sbl" class="lside <?php echo ($sidebar_position_selected == "sbl" ? "current-item" : "") ?>"><a href="sbl"><?php _e('Left Sidebar', 'cardealer'); ?></a></li>
	<li data-val="no_sidebar" class="wside <?php echo ($sidebar_position_selected == "no_sidebar" ? "current-item" : "") ?>"><a href="no_sidebar" ><?php _e('Without Sidebar', 'cardealer'); ?></a></li>
	<li data-val="sbr" class="rside <?php echo ($sidebar_position_selected == "sbr" ? "current-item" : "") ?>"><a href="sbr"><?php _e('Right Sidebar', 'cardealer'); ?></a></li>
</ul>
<script type="text/javascript">
	tmm_options_reset_array.push("sidebar_position");
</script>