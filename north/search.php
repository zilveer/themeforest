<?php 
get_header(); 

$layout = 'sidebar_right';

if(array_key_exists('vntd_search_layout', $smof_data)) {
    if($smof_data['vntd_search_layout']) $layout = $smof_data['vntd_search_layout'];   
}

?>

<div class="page-holder blog page-layout-<?php echo $layout; ?>">

	<div class="inner clearfix">	
		
		<?php 		
		
		if($layout != "fullwidth") {
			echo '<div class="page_inner">';
		}
		
		if (have_posts()) : while (have_posts()) : the_post();
		 	
		 	vntd_blog_post_content();
		 	
		endwhile;
		
	    // Archive doesn't exist:
	    else :
	    
	        _e('Nothing found, sorry.','vntd_north');
	    
	    endif;	     
    	
    	if($layout != "fullwidth") { 
    		echo '</div>';
    		get_sidebar();    		
    	}
    	
    	?>
    </div>

</div>

<?php get_footer(); ?>