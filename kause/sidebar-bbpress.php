<?php $canon_options_post = get_option('canon_options_post'); ?>

				 <!-- Start Main Sidebar -->
				<aside class="right-aside fourth last">

					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($canon_options_post['bbpress_sidebar'])) : ?>  
						
						<h4><?php _e("No Widgets added.", "loc_canon"); ?></h4>  
					    <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p>
					
			        <?php endif; ?>  

				</aside>
				 <!-- Finish Sidebar -->


