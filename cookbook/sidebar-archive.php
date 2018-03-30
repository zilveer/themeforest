<?php 

	//VARS
	$canon_options_post = get_option('canon_options_post'); 

	//DETERMINE PAGE TYPE (home, page or category)
	$page_type = mb_get_page_type();
	
	//DETERMINE ARCHIVE STYLE
	if ($page_type == 'home' || $page_type == 'page') {						// blog
		$archive_sidebar = $canon_options_post['blog_sidebar'];
	} elseif ($page_type == 'category') {									// category
		$archive_sidebar = $canon_options_post['cat_sidebar'];
	} else {
		$archive_sidebar = $canon_options_post['archive_sidebar'];
	}

    // FAILSAFE DEFAULT
    if (empty($archive_sidebar)) { $archive_sidebar = "canon_archive_sidebar_widget_area"; }

?>

				<!-- SIDEBAR -->
				<aside class="col-1-4 last">
						
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($archive_sidebar)) : ?>  
						
                        <h4 class="no-widgets-heading"><?php _e("No Widgets added.", "loc_canon"); ?></h4>
                        <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p> 
					
			        <?php endif; ?>  

				</aside>