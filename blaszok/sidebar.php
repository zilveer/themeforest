<?php
/**
 * The Sidebar base for MPC Themes
 *
 * Displays sidebar.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */
?>

<a id="mpcth_toggle_mobile_sidebar" href="#"><i class="fa fa-columns"></i><i class="fa fa-times"></i></a>
<div id="mpcth_sidebar">
	<div class="mpcth-sidebar-arrow"></div>
	<ul class="mpcth-widget-column">
		<?php
			global $sidebar_position;

			if ($sidebar_position != 'none')
				dynamic_sidebar('mpcth_sidebar');
		?>
	</ul>
</div>