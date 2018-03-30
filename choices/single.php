<?php 
	global $avia_config;

	/*
	 * check which page template should be applied: 
	 * cecks for dynamic pages as well as for portfolio, fullwidth, blog, contact and any other possibility :)
	 * Be aware that if a match was found another template wil be included and the code bellow will not be executed
 	 * located at the bottom of includes/helper-templates.php
	 */
	 do_action( 'avia_action_template_check' , 'single' );

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
		
			<div class='container template-blog template-single-blog'>
				
				<div class='content units <?php avia_layout_class( 'content' ); ?>'>
				
				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*
				*/
				
					get_template_part( 'includes/loop', 'index' );
					
					//show related posts based on tags if there are any
					get_template_part( 'includes/related-posts');
					
					//wordpress function that loads the comments template "comments.php"
					comments_template( '/includes/comments.php'); 
				
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 
				$avia_config['currently_viewing'] = "blog";
				//get the sidebar
				get_sidebar();
				
				//display link to previeous and next portfolio entry
					echo avia_post_nav();
				?>
			
				
			</div><!--end container-->

	


<?php get_footer(); ?>