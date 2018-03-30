<?php
/** Gallery Template
  *
  * This file is use to create a galllery page. Gallery pages
  * are much like post lists in that a user can specify what
  * posts to use, in what order, etc. They differ in look and
  * handling.
  *
  * Gallery pages can be filtered using controls at the top.
  * By default the layout and filtering is handed via
  * Isotope.
  *
  * @package Elderberry
  *
  */

global $blueprint, $post, $paged, $parent;
$indent_side = ( $blueprint->get_sidebar_position() == 'right' ) ? 'left' : 'right';

$parent = $post;
$args = $blueprint->get_postlist_args( $parent->postmeta );
$postlist = new WP_Query( $args );


if( $postlist->have_posts() ) {


	$category = @unserialize( $post->postmeta['category'] );

	if( !empty( $post->postmeta['category'] ) AND is_array( $category ) AND count( $category ) > 1 AND $post->postmeta['show_item_filters'] == 'yes' ) {
		echo '<div class="gallery-filter indent ' . $indent_side . '">';
		echo '<a href="#" data-filter="*" class="current gallery-filter-link">All</a>';

		foreach( $category as $cat ) {
			echo '<a href="#" data-filter=".category-'.$cat.'" class="gallery-filter-link">' . get_cat_name( $cat ) . '</a>';

		}

		echo '</div>';
	}


	echo '<div class="indent '.$indent_side.'"><div data-col="' . $post->postmeta['columns'] . '" class="gallery align-' . $post->postmeta['content_align']. ' col-' . $post->postmeta['columns'] . ' posts-container" ><div class="loader"></div>
		<div class="inner posts"
			data-paged="' . $paged . '"
			data-type="postlist"
			data-layout="' . $parent->postmeta['layout'] . '"
			data-args="' . urlencode( serialize( $args ) ) . '"
		>';

	while( $postlist->have_posts() ) {
		$postlist->the_post(); $blueprint->add_data();
		$blueprint->layout_template( 'gallery', $parent->postmeta['layout'] );
	}
	echo "<div class='clear'></div>";
	echo '</div></div></div>';

}
else {
	$blueprint->show_no_posts();
}


$post = $parent;
?>