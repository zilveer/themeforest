<?php
global $cat_id;
global $post_layout;
$categories = get_the_category( get_the_ID() );

$cats_html = '';
if($categories){
	foreach($categories as $category) {
		$cat_id = $category->cat_ID;
		$cat_link = get_category_link( $cat_id );

		if( $post_layout == 'e' || $post_layout == 'f' ) {
			$cats_html .= '<a href="' . esc_url( $cat_link ) . '">' . esc_html( $category->name ) . '</a>';
		} else {
			$cats_html .= '<a class="cat-color-' . intval( $cat_id ) . '" href="' . esc_url( $cat_link ) . '">' . esc_html( $category->name ) . '</a>';
		}
	}

	echo $cats_html;
}
?>