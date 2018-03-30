<?php
	global $g5plus_is_bind_canvas_menu;
	if (!isset($g5plus_is_bind_canvas_menu)) {
		$g5plus_is_bind_canvas_menu = 1;
		add_action('g5plus_after_page_wrapper','g5plus_add_canvas_menu_region');
		function g5plus_add_canvas_menu_region() {
			?>
				<nav class="canvas-menu-wrapper dark">
					<a href="#" class="canvas-menu-close"><i class="micon icon-wrong6"></i></a>
					<div class="canvas-menu-inner sidebar">
						<?php if (is_active_sidebar('canvas-menu')) { dynamic_sidebar('canvas-menu'); } ?>
					</div>
				</nav>
			<?php
		}
	}
?>
<div class="header-customize-item canvas-menu-toggle-wrapper">
	<a class="canvas-menu-toggle" href="#"><i class="micon icon-menu27"></i></a>
</div>