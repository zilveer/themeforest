<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if(get_data('shop_sidebar_footer')):

	?>
	<div class="row sidebar shop-footer-sidebar<?php echo get_data('sidebar_borders') ? '' : ' borderless'; ?>">
		<?php dynamic_sidebar('shop_footer_sidebar'); ?>
	</div>
	<?php

endif;

laborator_woocommerce_after();

get_footer();