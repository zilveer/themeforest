<?php

class Portfolio_Walker extends Walker_Category {

   function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 )  
   {
		extract($args);
		$cat_name = esc_attr( $category->name);
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		
		$link = '<a href="#" data-filter=".term-'.$category->term_id.'" ';
		
		if ( $use_desc_for_title == 0 || empty($category->description) )
			$link .= 'title="' . sprintf(__( 'View all items filed under %s', TEXTDOMAIN ), $cat_name) . '" >';
		else
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '" >';
		
		$link .= $cat_name . '</a>';
		
		if ( isset($current_category) && $current_category )
			$_current_category = get_category( $current_category );
		
		if ( $args['style'] == 'list' ) {
			$class = 'cat-item cat-item-'.$category->term_id;
			
			if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
			{
				$class .=  ' current';
			}
			elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
			{
				$class .=  ' current-parent';
			}
			
			$output .= "<li class=\"$class\"";
			$output .= ">$link\n";
			
		} 
		else 
		{
			$output .= "\t$link<br />\n";
		}
   }
   
}