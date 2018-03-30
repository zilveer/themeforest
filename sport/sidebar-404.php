<?php
	
	$canon_options = get_option('canon_options');
	$aside_class = ($canon_options['sidebars_alignment'] == 'left') ? 'left-aside fourth top-margin-x6' : 'right-aside fourth last top-margin-x6';

?>
				 <!-- 404 sidebar -->
				<aside class="<?php echo $aside_class; ?>">

					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("canon_404_sidebar_widget_area")) : ?>  
						
						<h4><?php _e("404 Sidebar Widget Area", "loc_canon"); ?></h4>
						<p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p> 
					
					<?php endif; ?>  

				</aside>
				 <!-- Finish Sidebar -->

