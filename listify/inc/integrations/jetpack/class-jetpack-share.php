<?php
/**
 * Jetpack Share
 */

class Listify_Jetpack_Share extends listify_Jetpack {

	public function __construct() {
		add_action( 'wp_head', array( $this, 'loop_start' ) );
		add_action( 'listify_single_job_listing_actions_start', array( $this, 'output' ) );
	}

	public function loop_start() {
		if ( ! is_singular( 'job_listing' ) ) {
			return;
		}

		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );

		if ( class_exists( 'Jetpack_Likes' ) ) {
			remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
		}
	}

	public function output() {
		global $post;

		if ( ! function_exists( 'sharing_display' ) ) {
			return;
		}

		$buttons = sharing_display( '' );

		if ( '' == $buttons ) {
			return;
		}

		$sharer = new Sharing_Service();
		$global = $sharer->get_global_options();

		$sharing = '';

		$sharing .= sprintf(
			'<a href="#share-%d" class="popup-trigger"><i class="ion-share"></i> %s</a>',
			$post->ID,
			__( 'Share', 'listify' )
		);

		$sharing .= sprintf(
			'<div class="popup share-popup" id="share-%1$d">
				<h3 class="popup-title">%2$s</h3>
				%3$s
			</div>',
			$post->ID,
			$global[ 'sharing_label' ],
			$buttons
		);

		echo $sharing;
	}
}

new Listify_Jetpack_Share;
