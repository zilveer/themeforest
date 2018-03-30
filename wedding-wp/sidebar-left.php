<aside class="col-md-3 sidebar leftside">
     <?php
     
     	GLOBAL $webnus_page_options_meta;
	 	$meta = $webnus_page_options_meta->the_meta();
		
		$sidebar_pos = 'left';
		
		if(!empty($meta) && is_array($meta))
			$sidebar_pos =  isset($meta['webnus_page_options'][0]['sidebar_position'])?$meta['webnus_page_options'][0]['sidebar_position']:'none';
     	
	
		 
	 	if(function_exists('kakapo_sidebar') && ('both' != $sidebar_pos) ) 
	 		kakapo_sidebar();
		else {
			dynamic_sidebar( 'Left Sidebar' );
		} 
     	
     ?>
</aside>
 <!-- end-sidebar-->