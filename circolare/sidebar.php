
			<div id="sidebar" class="sidebar<?php echo (of_get_option('sidebar_alignment', "left") == "right")? " right float-right" : " left float-left"; ?>">
				<aside>
				<?php if(function_exists('is_woocommerce') && is_woocommerce()){ 
				 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('shop_sidebar') ) : ?><?php endif; ?>
				<?php }  else { 
				 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('blog_sidebar') ) : ?><?php endif; ?>
				<?php } ?>
				</aside>
			</div>
			
			<br class="clear"/>