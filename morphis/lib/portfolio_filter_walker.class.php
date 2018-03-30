<?php
class Portfolio_Filter_Walker extends Walker_Category {	
	function start_el(&$output, $category, $depth = 0, $args = array(), $current_object_id = 0) {
		extract($args);
 
		$cat_name = esc_attr( $category->name );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		$link = '<a href="#" ';
		$link .= 'title="' . $cat_name . '"';
		$link .= 'class="'. urldecode( $category->slug ) .'" ';
		$link .= '>';
		$link .= $cat_name . '</a>';
		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			//$class = $category->slug;
			//$output .=  ' class="' . $class . '"';
			$output .= ">$link\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}
}