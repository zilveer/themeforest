<section class="mkd-side-menu right">
	<?php if ($show_side_area_title) {
		libero_mikado_get_side_area_title();
	} ?>
	<div class="mkd-close-side-menu-holder">
		<div class="mkd-close-side-menu-holder-inner">
			<a href="#" target="_self" class="mkd-close-side-menu">
				<span class="ion-ios-close-empty"></span>
			</a>
		</div>
	</div>
	<?php if(is_active_sidebar('sidearea')) {
		dynamic_sidebar('sidearea');
	} ?>
</section>