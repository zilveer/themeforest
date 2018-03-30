<?php 
get_header(); 
$blog_style = '';
if(array_key_exists('vntd_blog_layout',$smof_data)) {
	$blog_style = $smof_data['vntd_blog_layout'];
}
$layout = get_post_meta(get_option('page_for_posts'), 'page_layout', true);
?>

<div class="page-holder blog page-layout-<?php echo $layout; ?>">

	<?php
	
	if(!is_front_page()) {
	
		$page_data = get_page(get_option('page_for_posts'));
		
		$content = apply_filters('the_content', $page_data->post_content);
		
		echo $content;
	}
	
	?>

	<div id="blog" class="inner clearfix">	
		
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
	    
	    vntd_pagination();     
    	
    	if($layout != "fullwidth") { 
    		echo '</div>';
    		get_sidebar();    		
    	}
    	
    	?>
    </div>

</div>

<?php get_footer(); ?>