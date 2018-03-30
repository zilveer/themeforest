<?php
/**
 * This file contains functions related to property submit and property edit
 */


if ( ! function_exists( 'generate_posts_list' ) ) {
	/**
	 * Generates options list for given post arguments
	 *
	 * @param $post_args
	 * @param int $selected
	 */
	function generate_posts_list( $post_args, $selected = 0 ) {

		$defaults = array( 'posts_per_page' => -1, 'suppress_filters' => true );

		if ( is_array( $post_args ) ) {
			$post_args = wp_parse_args( $post_args, $defaults );
		} else {
			$post_args = wp_parse_args( array( 'post_type' => $post_args ), $defaults );
		}

		$posts = get_posts( $post_args );
		foreach ( $posts as $post ) :
			?><option value="<?php echo $post->ID; ?>" <?php if ( isset( $selected ) && ( $selected == $post->ID ) ) { echo "selected"; } ?>><?php echo $post->post_title; ?></option><?php
		endforeach;
	}
}