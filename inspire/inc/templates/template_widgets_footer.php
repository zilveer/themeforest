		<div id="widgets-footer" class="col-1-1">

			<div class="widget-area third">

				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('boost_footer_widget_area_1')) : ?>  
					
                    <h4 class="no-widgets-heading"><?php _e("No Widgets added.", "loc_canon"); ?></h4>
                    <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p> 
				
		        <?php endif; ?>  

			</div>

			<div class="widget-area third">

				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('boost_footer_widget_area_2')) : ?>  
					
                    <h4 class="no-widgets-heading"><?php _e("No Widgets added.", "loc_canon"); ?></h4>
                    <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p> 
				
		        <?php endif; ?>  

			</div>

			<div class="widget-area third last">

				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('boost_footer_widget_area_3')) : ?>  
					
                    <h4 class="no-widgets-heading"><?php _e("No Widgets added.", "loc_canon"); ?></h4>
                    <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p> 
				
		        <?php endif; ?> 

			</div>

		</div>