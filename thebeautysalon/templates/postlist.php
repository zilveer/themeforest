<?php
/** Post List
  *
  * This file is used to show a specific list of posts.
  * Settings for the post list can be found in the admin
  * for the post in question.
  *
  * @package Elderberry
  *
  */

global $blueprint, $post, $paged, $indent_side;

$indent_side = ( $blueprint->get_sidebar_position( ) == 'right' ) ? 'left' : 'right';

$parent = $post;
$args = $blueprint->get_postlist_args( $parent->postmeta );

$postlist = new WP_Query( $args );

if( $postlist->have_posts() ) {

	echo '<div class="posts-container">
		<div class="posts"
			data-paged="' . $paged . '"
			data-type="postlist"
			data-layout="' . $parent->postmeta['layout'] . '"
			data-args="' . urlencode( serialize( $args ) ) . '"
		>';

	while( $postlist->have_posts() ) {
		$postlist->the_post(); $blueprint->add_data();
		$blueprint->layout_template( 'post', $parent->postmeta['layout'] );
	}

	$blueprint->page_navigation( $postlist );

	echo '</div></div>';

}
else {
	$blueprint->show_no_posts();
}


$post = $parent;
?>