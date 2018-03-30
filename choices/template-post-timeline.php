<?php 
	/*
	Template Name: Post Timeline
	*/


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 
	 
	 global $avia_config, $more;
	 get_header();
	 
	 echo avia_title();
	?>


		
		<div class='container_wrap main_color <?php avia_layout_class( 'main' ); ?>'>
		
			<div class='container'>	
				<div class='template-post-timeline content <?php avia_layout_class( 'content' ); ?> units'>
				
				<div class="entry-content">	
				
				<?php 
				//display the actual post content
				the_post();
				
				$slider = new avia_slideshow(get_the_ID());
				if($slider->slidecount) echo $slider->display();
				
				the_content();
				
				
				/*
				* Display the latest 20 blog posts
				*/
				
				
				query_posts(array('posts_per_page'=>-1));
				$last_year = "";
				
				// check if we got posts to display:
				if (have_posts()) :
					while (have_posts()) : the_post();
					
					$new_list 		= false;
					$current_year 	= get_the_time('Y');
					if($current_year != $last_year) 
					{
						$last_year = $new_list= $current_year;
						if(!empty($last_year)) echo "</ul>";
						echo "<h3 class='post_timeline_header'>$current_year</h3>";
						echo "<ul class='post_timeline'>";
					}
					
					
		        	echo "<li><span class='timeline-bullet'></span><a href='".get_permalink()."' rel='bookmark' title='". __('Permanent Link:','avia_framework')." ".the_title_attribute('echo=0')."'>".get_the_title()."</a></li>";
					
					endwhile;
				
				if(!empty($last_year)) echo "</ul>";
				endif;
				
				
				
			?>				 
								
				</div>	
				
				
				<!--end content-->
				</div>
				
				<?php 
				wp_reset_query();
				//get the sidebar
				$avia_config['currently_viewing'] = 'page';
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	


<?php get_footer(); ?>