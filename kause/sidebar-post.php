<?php 

	$canon_options = get_option('canon_options');

	 //SETTTINGS
    $cmb_sidebar_id = get_post_meta($post->ID, 'cmb_sidebar_id', true);

    // FAILSAFE DEFAULT
    if (empty($cmb_sidebar_id)) { $cmb_sidebar_id = "canon_blog_sidebar_widget_area"; }

?>

				 <!-- Start Main Sidebar -->
				<aside class="right-aside fourth last">

					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cmb_sidebar_id)) : ?>  
						
                        <h4><?php _e("No Widgets added.", "loc_canon"); ?></h4>
                        <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p> 
					
			        <?php endif; ?>  

				</aside>
				 <!-- Finish Sidebar -->