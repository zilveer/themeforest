<?php

/* RT-Breadcrumb Function */
function rt_breadcrumb(){
	global $taxonomy,$term_slug,$post,$delimiter;

	if(!get_option('rttheme_breadcrumb_menus')){
		return false;
	}
	
	//Markup 
	$before='<div class="breadcrumb">'.wpml_t(THEMESLUG, 'Breadcrumb Menu Text', get_option(THEMESLUG.'_breadcrumb_text')).' ';
	$after='</div>';
	$delimiter=' | ';

	/*  WooCommerce Breadcrumb */ 
	if ( function_exists( 'woocommerce_breadcrumb' ) ) {
		if( is_woocommerce() ){
			$defaults = array(
				'delimiter'  => $delimiter,
				'wrap_before'  => $before,
				'wrap_after' => $after,
				'before'   => '',
				'after'   => '',
				'home'    => null
			);
	
			woocommerce_breadcrumb($defaults); 
			return false;
		}
	} 

	
	echo $before;
	
	//Home Page
	echo "<a href=\"". BLOGURL ."\" title=\"". get_bloginfo('name')."\">".__( 'Home', 'rt_theme' )."</a>";

	// page parents function
	function page_parents($parent_page_id,$child_pages){
		global $delimiter;

		$parent_page = get_page($parent_page_id);
		$page_parents = $delimiter."<a href=\"".get_permalink($parent_page->ID)."\" title=\"". get_the_title($parent_page->ID) ."\" >". get_the_title($parent_page->ID) ."</a>" .$child_pages;
 
		if ($parent_page->post_parent) page_parents($parent_page->post_parent,$page_parents);
		
		else echo $page_parents;

	}
	
	
	// term parents function
	function term_parents($term_id,$child_terms){
		global $taxonomy,$delimiter;

		$parent_term = get_term_by('ID',$term_id, $taxonomy);
		$term_parents = $delimiter."<a href=\"".get_term_link($parent_term->slug,$taxonomy)."\" title=\"". $parent_term->name ."\" >". $parent_term->name ."</a>" .$child_terms;
		
		if ($parent_term->parent) term_parents($parent_term -> parent,$term_parents);
		
		else echo $term_parents;
	
	}

	//get start page
	function get_start_page($start_page){
		global $delimiter;
		
		//start page parents
		$get_start_page=get_page($start_page);
		if ($get_start_page -> post_parent){
			page_parents( $get_start_page -> post_parent,''); 
		}
		
		//start page
		if ($start_page && !get_query_var('lang')) {
			echo  $delimiter."<a href=\"".get_permalink($start_page)."\" title=\"". get_the_title($start_page) ."\" >". get_the_title($start_page) ."</a>";
		}
	}

	//terms
	function term_links(){
		global $taxonomy,$post_type,$term_slug,$delimiter;
		
		//Find start page and define taxonomy names
		if($taxonomy=="product_categories"){
			$start_page=get_option('rttheme_product_list');
		}elseif($taxonomy=="portfolio_categories"){
			$start_page=get_option('rttheme_portf_page');
		}	
		
		//get start page
		if ($start_page) get_start_page($start_page);

 
		$term=get_term_by('slug',$term_slug, $taxonomy);
		
		//parent terms
		if (is_object($term) && $term -> parent){
			echo term_parents($term -> parent,'');	 
		} 

		//current term
		if(is_object($term) && $term->slug) echo  $delimiter."<a href=\"".get_term_link($term->slug,$taxonomy)."\" title=\"". $term->name ."\" >". $term->name ."</a>";
	}
	

	
	//Pages
	if ( is_page() ){
		//parent pages
		if ($post -> post_parent){
			page_parents( $post -> post_parent,''); 
		} 
		 
		//current page
		echo  $delimiter ."". $post->post_title;
	}
	
	//Single
	elseif (is_single() && !is_attachment()){ 
		// Get post type
		$post_type = get_post_type();
 
		//Taxonomies
		if($post_type == 'products' || $post_type == 'portfolio'){
	
			term_links();
			//current page
			echo  $delimiter."<a href=\"".get_permalink()."\" title=\"". get_the_title() ."\" >". get_the_title() ."</a>";
			
		}else{
		//Categories
		
		//start page
		$start_page=get_option('rttheme_blog_page');
		
		//get start page
		if ($start_page) get_start_page($start_page);
		
			$category_id = get_the_category();
			$category_id = $category_id[0]->cat_ID;//only one category can be show in the list  - the first one
			echo $delimiter;
			if($category_id){
				echo get_category_parents($category_id, TRUE, $delimiter, FALSE );
			}
			echo $post->post_title;
		}

	//Category
	}elseif (is_category()){
		//start page
		$start_page=get_option('rttheme_blog_page');
		
		//get start page
		if ($start_page) get_start_page($start_page);
		
			echo $delimiter."".get_category_parents(get_query_var('cat'), TRUE, $delimiter, FALSE);
		
	//Taxonomy
	}elseif (is_tax()){
		term_links();
	} else {
		echo  $delimiter."";
		wp_title('');
	}
	
	echo $after;
	
	wp_reset_query(); 
}
?>