<?php

if( ! function_exists( 'thb_get_likes' ) ) {
	/**
	 * Count likes for an entry.
	 *
	 * @param integer $id The entry ID.
	 * @return integer
	 */
	function thb_get_likes( $id = null ) {
		if ( ! $id ) {
			$id = get_the_ID();
		}

		return (int) thb_get_post_meta( $id, 'likes' );
	}
}

if( ! function_exists( 'thb_add_like' ) ) {
	/**
	 * Add a like for an entry.
	 *
	 * @param integer $id The entry ID.
	 * @return integer
	 */
	function thb_add_like( $id = null ) {
		if ( ! $id ) {
			$id = get_the_ID();
		}

		$likes = thb_get_likes( $id );
		$likes++;

		thb_update_post_meta( $id, 'likes', $likes );

		return $likes;
	}
}

if( ! function_exists( 'thb_check_already_liked' ) ) {
	/**
	 * Check if an entry has already received a like from the visitor.
	 *
	 * @param integer $id The entry ID.
	 * @return boolean
	 */
	function thb_check_already_liked( $id = null ) {
		if ( ! $id ) {
			$id = get_the_ID();
		}

		$cookie_key = 'thb_like_' . $id;
		return isset( $_COOKIE[$cookie_key] );
	}
}

if( ! function_exists( 'thb_do_like' ) ) {
	/**
	 * AJAX action to perform a like.
	 */
	function thb_do_like() {
		$nonce_check = isset( $_POST['THB_nonce'] ) && wp_verify_nonce( $_POST['THB_nonce'], 'thb_like' );

		if ( ! $nonce_check ) {
			die();
		}

		if ( isset( $_POST['post_id'] ) ) {
			$id = (int) $_POST['post_id'];
			$cookie_key = 'thb_like_' . $id;

			if ( ! thb_check_already_liked( $id ) ) {
				$updated_likes_count = thb_add_like( $id );

				$cookie_path = SITECOOKIEPATH != COOKIEPATH ? SITECOOKIEPATH : COOKIEPATH;
				setcookie( $cookie_key, $id, time() * 20, $cookie_path, COOKIE_DOMAIN );

				echo $updated_likes_count;
			}
		}

		die();
	}
}

if( ! function_exists( 'thb_like' ) ) {
	/**
	 * Display the like button.
	 *
	 * @param integer $id The entry ID.
	 */
	function thb_like( $link_class = '', $id = null ) {
		if ( ! $id ) {
			$id = get_the_ID();
		}

		$data_attrs = array();

		if ( thb_check_already_liked( $id ) ) {
			$link_class .= ' thb-liked';
		}
		else {
			$data_attrs['post-id'] = $id;
			$data_attrs['nonce'] = wp_create_nonce( 'thb_like' );
		}

		$likes_count = thb_get_likes();

		$btn = '<a class="thb-like ' . $link_class . '" href="#" ' . thb_get_data_attributes( $data_attrs ) . '>';
		$btn .= '<span class="thb-likes-label">' . __( 'Like this post', 'thb_text_domain' ) . '</span><span class="thb-likes-count">' . $likes_count . '</span>';
		$btn .= '</a>';

		echo $btn;
	}
}