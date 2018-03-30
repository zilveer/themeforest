<?php

	function gdl_custom_search_query( $query ) {
		global $gdl_search_package;
		
		
		if( is_search() && $query->is_main_query() && isset($_GET['posttype']) && $_GET['posttype'] == 'package' ){
			$gdl_search_package = true;
		
			$meta_query = array(
				'relation' => 'AND'
			);
			
			if( isset($_GET['location']) ){
				array_push($meta_query,
					array(
						'key'=>'package-location',
						'value'=>$_GET['location'],
						'compare'=>'LIKE'
					)
				);
			} 
			
			if( isset($_GET['package-type']) ){
				$query->query_vars['package-tag'] = $_GET['package-type'];
			} 

			if( isset($_GET['departure-date']) ){
				array_push($meta_query,
					array(
						'key'=>'package-start-date',
						'value'=>$_GET['departure-date'],
						'compare'=>'='
					)
				);				
			} 

			if( isset($_GET['arrival-date']) ){
				array_push($meta_query,
					array(
						'key'=>'package-end-date',
						'value'=>$_GET['arrival-date'],
						'compare'=>'='
					)
				);				
			} 

			if( isset($_GET['max-budget']) ){		
				array_push($meta_query,
					array(
						'key'=>'package-min-price',
						'value'=>$_GET['max-budget'],
						'compare'=>'<=',
						'type'=>'DECIMAL'
					)
				);	
			} 			

			$query->set( 'meta_query', $meta_query );
			$query->query_vars['post_type'] = 'package';
		}
		
	}
	 
	add_action( 'pre_get_posts', 'gdl_custom_search_query' );

?>