<?php 
global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
	 
 	 //get the layout mode
 	 avia_template_set_page_layout(false, avia_get_option('page_layout'));
 	 $avia_config['no_slider'] = true;
	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['layout']; ?>' id='main'>
		
			<div class='container'>

				<?php 
				
				$title = "";
				if(!is_singular()) $title = __('Forums',"avia_framework");
				if(function_exists('bbp_is_single_user_edit') && (bbp_is_single_user_edit() || bbp_is_single_user()))
				{
					$user_info = get_userdata(bbp_get_displayed_user_id());
					$title = __("Profile for User:","avia_framework")." ".$user_info->display_name;
					if(bbp_is_single_user_edit()) 
					{
						$title = __("Edit profile for User:","avia_framework")." ".$user_info->display_name; 
					}
				}
				
				avia_title($title); 
				?>
				<div class='template-page template-forum content <?php echo $avia_config['content_class']; ?> units'>

				<?php
				$extraForumClass = "solid_background_forum";
				if(avia_get_option('boxed') == "stretched" && !empty($avia_config['colorRules']['bg_image'])) $extraForumClass = "";
				
				echo "<div class='template-forum-wrap entry-content $extraForumClass'>";
				/* output the forum content */
				get_template_part( 'includes/loop', 'page' );
				echo "</div>";
				?>
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				$avia_config['currently_viewing'] = 'forum';
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>