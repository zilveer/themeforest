	
<?php 
global $qode_options_passage;

?>
	<div class="column_inner">
		<aside>
			<?php
			wp_reset_query();	
			$sidebarr = "";
			
			if(get_post_meta($id, 'qode_choose-sidebar', true) != ""){
				$sidebar = get_post_meta($id, 'qode_choose-sidebar', true);
			}else{
				if (is_singular("post")) {
					if(isset($qode_options_passage['blog_single_sidebar_custom_display']) && $qode_options_passage['blog_single_sidebar_custom_display'] != ""){
						$sidebar = $qode_options_passage['blog_single_sidebar_custom_display'];
					}else{
						$sidebar = "Sidebar";
					}
				} else {
					$sidebar = "SidebarPage";
				}
			}
			
			?>
				
			<?php if(function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)) : 
			endif;  ?>
		</aside>
	</div>
