<?php 
	
	global $avia_config;
	 /* 
	  * create a new dynamic template object and display it.
	  * The rendering class is located in includes/helper-templates.php
	  */
	 $post_id = avia_get_the_ID();
	 $template_name  = avia_post_meta($post_id, 'dynamic_templates');
 	 $template = new avia_dynamic_template($template_name);
 	 $avia_config['dynamic_title'] = $template->get_option('dynamic_title'); 
 	 
 	 $template -> generate_html();
 	 $template -> special_slider_config();
	
	 if(!empty($avia_config['slide_output']) && $avia_config['dynamic_title'] == 'yes')
	 {
	 	$avia_config['slide_output_before'] = avia_title();
	 } 
	

 	 /*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
 	 get_header();
	 do_action( 'avia_action_query_check' , 'template-dynamic' );


	 $color = 'main_color';
	 
	 //if the first content element is a pagesplit dont do a real split but rather change the color of the main content class
	$pos = $shadow = false;
	if($template->check(0) == 'page_split') $pos = 0;
	if($template->check(0) == 'slideshow' && $template->check(1) == 'page_split') $pos = 1;

	if($pos !== false) 
	{
		$color  = $template->get_value($pos,0, 'page_split_style')." container_split";
		$shadow = $template->get_value($pos,0, 'page_split_shadow');
		$template->unset_key($pos);
	}
	
	
	$layout = avia_layout_class('content', false);
	if($template->check(0) == 'heading' || ($template->check(0) == 'page_split' && $template->check(1) == 'heading' && $template->check(2) == 'page_split'))
	{
		$layout = "alpha ";
	}
	
	
	//display title + bc if the users wants it
	if($avia_config['dynamic_title'] == 'yes' && empty($avia_config['slide_output_before'])) echo avia_title();
	
	 ?>

		
		<div class='container_wrap  <?php echo $color." "; avia_layout_class( 'main' ); ?>'>
				
			<div class='container'>
			
				<div class='content <?php echo $layout; ?> units template-dynamic template-dynamic-<?php echo $template_name; ?>'>
				
				<?php
				
				if(!post_password_required($post_id))
				{
					$template -> display();
				}
				else
				{
					echo get_the_password_form();
				}
				
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				wp_reset_query();
				
				if(!isset($avia_config['currently_viewing']))
				{
					$avia_config['currently_viewing'] = 'page';
					if(is_singular('post')) $avia_config['currently_viewing'] = 'blog';
					if(is_front_page()) $avia_config['currently_viewing'] = "frontpage";

				}

				if($avia_config['layout']['current']['main'] != 'fullsize') get_sidebar();
				
				?>
				
				
			</div><!--end container-->

	


<?php get_footer(); ?>