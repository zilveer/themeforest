<?php 

	// OPTIONS
	$canon_options = get_option('canon_options');

	 //SETTTINGS
    $cmb_menu_sidebar = get_post_meta($post->ID, 'cmb_menu_sidebar', true);
    $cmb_menu_sidebar_id = get_post_meta($post->ID, 'cmb_menu_sidebar_id', true);

	$sidebar_alignment = ($cmb_menu_sidebar == 'default') ? $canon_options['sidebars_alignment'] : $cmb_menu_sidebar;
    $aside_class = ($sidebar_alignment == 'left') ? 'left-aside fourth' : 'right-aside fourth last';

    // FAILSAFE DEFAULT
    if (empty($cmb_menu_sidebar_id)) { $cmb_menu_sidebar_id = "canon_page_sidebar_widget_area"; }

?>

				 <!-- Start Main Sidebar -->
				<aside class="<?php echo $aside_class; ?>">

					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cmb_menu_sidebar_id)) : ?>  
						
                        <h4><?php _e("No Widgets added.", "loc_canon"); ?></h4>
                        <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p> 
					
			        <?php endif; ?>  

				</aside>
				 <!-- Finish Sidebar -->