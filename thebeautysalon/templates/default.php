<?php
/** Default Template
  *
  * This file shows the default WordPress archive-type
  * and other similar pages. It is used for loops which
  * contain multiple items.
  *
  * It uses the post template defined by the user.
  *
  * @package Elderberry
  *
  */
global $blueprint, $wp_query, $framework, $indent_side;
$indent_side = ( $blueprint->get_sidebar_position() == 'right' ) ? 'left' : 'right';

echo '<div class="list">';
	while( have_posts() ) {
		the_post();
		$blueprint->layout_template( 'post', $framework->options['post_layout'] );

	}
echo '</div>';

echo '<div class="indent ' . $indent_side . '">';
	$blueprint->page_navigation( $wp_query );
echo '</div>';

?>