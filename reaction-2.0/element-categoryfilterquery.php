<!-- THE POST QUERY -->
<!-- This one's special because it'll look for our category filter and apply some magic -->

			<?php 
			
			wp_reset_query();

			global $paged;
			global $template_file;
			$cat_string = '';
			$format = '';
			
			if(get_post_custom_values('post_count')) :  
				$post_array = get_post_custom_values('post_count');
				$post_count = join(',', $post_array);
			else : 
				$post_count = -1;
			endif;
			
			if(get_custom_field('category_filter')) :     // If the category filter exists on this page...
				$cats = get_custom_field( 'category_filter' ); 	// Returns an array of cat-slugs from the custom field.

				if (is_array($cats)) :	
				
					foreach ( $cats as $cat ) {				
						$acats[] = $cat; 								// Turn the list of ID's into an ARRAY, $acats[]					
					}			
					
					$cat_string = join(',', $acats);					// Join the ARRAY into a comma-separated STRING for use in query_posts
					// echo $cat_string;								    // Test
			
				endif;
				
			endif;												// End the situation... carry on as usual if there was no category filter.
			?>
		
			
			<?php
			
			if ( get_query_var('paged') ) {
			    $paged = get_query_var('paged');			
			} 
			elseif ( get_query_var('page') ) {			
			    $paged = get_query_var('page');			
			} 
			else {
			    $paged = 1;			
			}
			
			$args=array(
				'cat'=>$cat_string,			   // Query for the cat ID's (because you can't use multiple names or slugs... crazy WP!)
				'posts_per_page'=>$post_count, // Set a posts per page limit
				'paged'=>$paged,			   // Basic pagination stuff.
			   );
			query_posts($args); ?>