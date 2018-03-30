<?php
if ( ! function_exists( 'all_cat_items' ) ) {
	function all_cat_items(){
		global $post;
		$cat_lists = get_categories();
		$all_cat_list = array();
		foreach($cat_lists as $cat_list){
			$all_cat_list[$cat_list->cat_name] = $cat_list->cat_name;
		}
		 return $all_cat_list;
	}
}