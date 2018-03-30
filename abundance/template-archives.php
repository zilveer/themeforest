<?php 
	/*
	Template Name: Archives
	*/

	global $avia_config, $more;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 		
	?>


		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['layout']; ?>' id='main'>
		
			<div class='container'>	
				<?php echo avia_title(); ?>
				<div class='template-archives content'>
				
				<div class="entry-content">	
				
				<?php 
				//display the actual post content
				the_post();
				the_content();
				
				
				/*
				* Display the latest 20 blog posts
				*/
				
				
				query_posts(array('posts_per_page'=>20));

				// check if we got posts to display:
				if (have_posts()) :
				
				echo "<h3>" . __('The 20 latest Blog Posts','avia_framework') . "</h3>";
				echo "<ul>";
					while (have_posts()) : the_post();
					
		        	echo "<li><a href='".get_permalink()."' rel='bookmark' title='". __('Permanent Link:','avia_framework')." ".get_the_title()."'>".get_the_title()."</a></li>";
					
					endwhile;
				echo "</ul>";
				endif;
				
				
				
				
				
				
				
				/*
				* Display pages, categories and month archives
				*/
				
				
				echo "<div class='hr'></div>";
				echo "<div class='one_third first archive_list'>";
				echo "<h3>" . __('Available Pages','avia_framework') . "</h3>";
				echo "<ul>";
				wp_list_pages('title_li=&depth=-1' );
				echo "</ul>";
				echo "</div>";
				
				echo "<div class='one_third archive_list'>";
				echo "<h3>" . __('Archives by Subject:','avia_framework') . "</h3>";
				echo "<ul>";
				wp_list_categories('sort_column=name&optioncount=0&hierarchical=0&title_li=');
				echo "</ul>";
				echo "</div>";
				
				echo "<div class='one_third archive_list'>";
				echo "<h3>" . __('Archives by Month:','avia_framework') . "</h3>";
				echo "<ul>";
				wp_get_archives('type=monthly');
				echo "</ul>";
				echo "</div>";

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

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>