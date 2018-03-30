<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if(( ! is_product() && SHOP_SIDEBAR) || (is_product() && SHOP_SINGLE_SIDEBAR)):

	$sidebar_id = 'shop_sidebar';

	$sidebar_widgets = get_option('sidebars_widgets');

	if(is_product() && is_array($sidebar_widgets) && isset($sidebar_widgets['shop_single_sidebar']) && $sidebar_widgets['shop_single_sidebar'])
		$sidebar_id = 'shop_single_sidebar';

	?>
	<div class="col-md-3 col-sm-4">

		<div class="sidebar<?php echo get_data('sidebar_borders') ? '' : ' borderless'; ?>">
			<?php dynamic_sidebar($sidebar_id); ?>
		</div>

	</div>
	<?php

endif;