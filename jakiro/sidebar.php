<div class="col-md-3 sidebar-wrap" role="complementary">
	<div class="main-sidebar">
		<?php 
		$main_sidebar = dh_get_post_meta('main_sidebar');
		if(!empty($main_sidebar) && is_active_sidebar($main_sidebar)):
				dynamic_sidebar($main_sidebar);
		else:
			if(defined('WOOCOMMERCE_VERSION') && is_woocommerce()){
				if(is_active_sidebar('sidebar-shop'))
					dynamic_sidebar('sidebar-shop');
			}else{
				if(is_active_sidebar('sidebar-main'))
					dynamic_sidebar('sidebar-main');
			}
		endif;
		?>
	</div>
</div>
