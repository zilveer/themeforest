<?php 

	global $avia_config, $more;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	
	get_header();	
	
			$title  = __('Blog - Latest News', 'avia_framework'); //default blog title
			$t_link = home_url('/');
			$t_sub = "";
			
			if(avia_get_option('frontpage') && $new = avia_get_option('blogpage')) 
			{ 
				$title 	= get_the_title($new); //if the blog is attached to a page use this title
				$t_link = get_permalink($new);
				$t_sub =  avia_post_meta($new, 'subtitle');
			}
			
			echo avia_title(array('title' => $title, 'link' => $t_link, 'subtitle' => $t_sub)); 
					
	?>


		
		<div class='container_wrap main_color <?php avia_layout_class( 'main' ); ?>'>
		
			<div class='container template-blog '>	
				
				<div class='content <?php avia_layout_class( 'content' ); ?> units'>

				<?php

				
				if(is_page())
				{
					$slider = new avia_slideshow(get_the_ID());
					if($slider->slidecount) echo $slider->display();
				}
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*/
				
				
				$more = 0;
				get_template_part( 'includes/loop', 'index' );
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 
				wp_reset_query();
				//get the sidebar
				$avia_config['currently_viewing'] = 'blog';
				if(is_front_page()) $avia_config['currently_viewing'] = "frontpage";
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	


<?php get_footer(); ?>