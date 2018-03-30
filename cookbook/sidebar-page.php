<?php 

	 //SETTTINGS
    $cmb_page_sidebar_id = get_post_meta($post->ID, 'cmb_page_sidebar_id', true);

    // FAILSAFE DEFAULT
    if (empty($cmb_page_sidebar_id)) { $cmb_page_sidebar_id = "canon_page_sidebar_widget_area"; }

?>

					<!-- SIDEBAR -->
					<aside class="col-1-4 last">

						<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cmb_page_sidebar_id)) : ?>  
							
	                        <h4 class="no-widgets-heading"><?php _e("No Widgets added.", "loc_canon"); ?></h4>
	                        <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p> 
						
				        <?php endif; ?>  

					</aside>
