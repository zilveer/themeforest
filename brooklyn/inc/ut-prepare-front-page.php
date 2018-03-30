<?php

if( ! function_exists( 'ut_get_posts_children_ids' ) ) :

	function ut_get_posts_children_ids( $parent_id ){
		
		/* id is empty , we leave here */
		if( empty($parent_id) ) {
			return array();
		}
		
		$children_array = array();
		
		$child_query = new WP_Query();
		$children = $child_query->query( array( 'post_type' => 'page' , 'order' => 'ASC' , 'post_status' => 'publish' , 'orderby' => 'menu_order' , 'post_parent' => $parent_id ));
		
		if( !empty( $children ) ) {		
			
			foreach( $children as $child ){
								
				/* push current child into array */
				$children_array[] = $child->ID;
				
				/* recursive - here we go! */
				$gchildren = ut_get_posts_children_ids( $child->ID );
				
				if( !empty( $gchildren ) ) {
					
					foreach($gchildren as $gchild) {
						
						$children_array[] = $gchild;
						
					}
					
				}
			
			}
			
		}
		
		wp_reset_postdata();
		
		return !empty($children_array) ? $children_array : array();
		
	}

endif;

/*
|--------------------------------------------------------------------------
| Prepare Custom Query
|--------------------------------------------------------------------------
*/

if ( ! function_exists( 'ut_prepare_front_query' ) ) :

	function ut_prepare_front_query() {
		
		    /* needed variables and arrays */
			$ut_query_pages = array();
		
			
			/* check if primary navigation has been created and set */
			if ( has_nav_menu( 'primary' ) ) :
				
				
				/* get primary navigation ID */
				$ut_theme_locations = get_nav_menu_locations();
				$ut_menu_objects = get_term( $ut_theme_locations['primary'] , 'nav_menu' );
				$ut_menu_id = $ut_menu_objects->term_id;
				
				
				/* now we get all menu items from primary navigation  */
				$menu_args = array(
					'orderby'   =>  'menu_order'
				);
				
				$ut_menu_items = wp_get_nav_menu_items( $ut_menu_id , $menu_args );
				
				
				/* create an array of page ID's for query_posts() */
				foreach ( (array) $ut_menu_items as $key => $ut_menu_item ) {
					
					$blog_page_id = get_option('page_for_posts');
					$frontpage_id = get_option('page_on_front');
                    
					if( $ut_menu_item->menutype != 'page' && $blog_page_id != $ut_menu_item->object_id && $frontpage_id != $ut_menu_item->object_id) {
							
						$ut_query_pages[] = $ut_menu_item->object_id;						
						
						/* get child pages */
						$children = ut_get_posts_children_ids( $ut_menu_item->object_id );										
						$ut_query_pages = array_merge($ut_query_pages , $children);					
						
					}
					
				}
                
				/* return query arguements */
				if( !empty( $ut_query_pages ) ) {
						
					/* query args for main query  */
					$pagequery = array(
							
                            'posts_per_page' => count($ut_query_pages),
							'post_type' => 'page',
							'post__in' => $ut_query_pages,
							'orderby'=> 'post__in'
					
					);
					
					return $pagequery;
					
				} else {
					
					/* return empty arguments */
					return array();
					
				}
				
			endif;
		
	}


endif;


if ( ! function_exists( 'ut_get_the_slug' ) ) :

	function ut_get_the_slug( $ID ) {
		
		if( empty($ID) ) {
			return;
		}
						
		$post_data = get_post( $ID , ARRAY_A );
		$slug = $post_data['post_name'];
		
		return $slug; 
		
	}

endif; 

?>