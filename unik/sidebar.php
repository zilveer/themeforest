<?php 
/**
 * It display widgeted area within pages,posts etc.
 *
 */
	global $post;
	$options = get_post_custom($post->ID);  
	$sidebar_choice = (isset($options['select_sidebar']) ? $options['select_sidebar'] : null); 
	$sidebar_choice = $sidebar_choice[0];
	
?>  
<aside id="sidebar" class="floatleft">  
      
<?php 
		
	if(is_home()){
		dynamic_sidebar('blog-sidebar');
	}

	else{
		if(is_page()){
			if(isset($sidebar_choice)){
				if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar($sidebar_choice) );
			}
			else{
				dynamic_sidebar('main-sidebar');
			}
		}
		
		elseif(is_single() && get_post_type( get_the_ID() )=='event'){
			dynamic_sidebar('event-sidebar');
		}
		
		// sidebar for single posts
		else{ 
			dynamic_sidebar('blog-sidebar');
		}
	}
?>  
</aside>  

