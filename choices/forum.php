<?php 
global $avia_config;

	/*
	 * check which page template should be applied: 
	 * cecks for dynamic pages as well as for portfolio, fullwidth, blog, contact and any other possibility :)
	 * Be aware that if a match was found another template wil be included and the code bellow will not be executed
 	 * located at the bottom of includes/helper-templates.php
	 */
	 do_action( 'avia_action_template_check' , 'forum' );

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 		
 	$avia_config['currently_viewing'] = 'forum';	
 	$avia_config['no_slider'] = true;
 	
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
 	 $args = array();
 	 if(!empty($title)) $args['title'] = $title;
 	 echo avia_title($args);
	 ?>
		
		<div class='container_wrap main_color <?php avia_layout_class( 'main' ); ?>'>
		
			<div class='container'>

				<div class='template-page content  <?php avia_layout_class( 'content' ); ?> units'>

				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-page.php and that will be used instead.
				*/
				
				get_template_part( 'includes/loop', 'page' );
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	


<?php get_footer(); ?>

