<section class="mkdf-side-menu right">
	<div class="mkdf-side-menu-close-holder">
		<a href="javascript:void(0)" class="mkdf-close-side-menu">
			<span class="mkdf-side-menu-close">
			   <span class="mkdf-close-1"></span>
			   <span class="mkdf-close-2"></span>
			</span>
		</a>
	</div>
	<?php if ($show_side_area_title) {
		hashmag_mikado_get_side_area_title();
	} ?>
	<?php if(is_active_sidebar('sidearea')) {
		dynamic_sidebar('sidearea');
	} ?>
</section>