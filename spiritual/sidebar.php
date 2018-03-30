<?php
$swm_page_post_layout_type = swm_page_post_layout_type();
if ( $swm_page_post_layout_type == 'layout-full-width' ) return; 
$swm_post_type = get_post_type();
?>	
<aside class="swm_column sidebar" id="sidebar">		
	<?php 	

		$swm_blog_sidebar = 'blog-sidebar';
		$swm_archive_pages_sidebar = get_theme_mod('swm_archives_sidebar',$swm_blog_sidebar);

		if ($swm_post_type == 'portfolio' && is_active_sidebar('swm-portfolio-single-page-sidebar')) {

			dynamic_sidebar('swm-portfolio-single-page-sidebar');

		} else if ( is_archive() && is_active_sidebar($swm_archive_pages_sidebar) ){
			
			dynamic_sidebar($swm_archive_pages_sidebar);			

		} else if ( !function_exists('generated_dynamic_sidebar') || !generated_dynamic_sidebar() ) {

			if ( is_active_sidebar($swm_blog_sidebar) ) {
				dynamic_sidebar($swm_blog_sidebar);	
			}

		} 
 			
	?>		
	<div class="clear"></div>
</aside>