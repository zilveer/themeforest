<?php

function bucket_option( $option, $default = null ) {
	global $pagenow;
	global $pixcustomify_plugin;

	// if there is set an key in url force that value
	if ( isset( $_GET[ $option ] ) && ! empty( $option ) ) {
		return $_GET[ $option ];
	} elseif ( $pixcustomify_plugin !== null && $pixcustomify_plugin->has_option( $option ) ) {
		// if this is a customify value get it here
		return $pixcustomify_plugin->get_option( $option, $default );
	}

	return $default;
}

if ( ! function_exists( 'bucket_callback_addthis' ) ) {
	function bucket_callback_addthis() {
		//lets determine if we need the addthis script at all
		$share_buttons_settings = bucket_option( 'share_buttons_settings' );
		if ( is_single() && ! empty( $share_buttons_settings ) ):
			wp_enqueue_script( 'addthis-api' );

			//here we will configure the AddThis sharing globally
			global $post;
			if ( empty( $post ) ) {
				return;
			} ?>
			<script type="text/javascript">
				addthis_config = {
					<?php if ( bucket_option( 'share_buttons_enable_tracking' ) && bucket_option( 'share_buttons_enable_addthis_tracking' ) ):
					echo 'username : "' . bucket_option( 'share_buttons_addthis_username' ) . '",';
				endif; ?>
					ui_click: false,
					ui_delay: 100,
					ui_offset_top: 42,
					ui_use_css: true,
					data_track_addressbar: false,
					data_track_clickback: false
					<?php if ( bucket_option( 'share_buttons_enable_tracking' ) && bucket_option( 'share_buttons_enable_ga_tracking' ) ):
					echo ', data_ga_property: "' . bucket_option( 'share_buttons_ga_id' ) . '"';
					if ( bucket_option( 'share_buttons_enable_ga_social_tracking' ) ):
						echo ', data_ga_social : true';
					endif;
				endif; ?>
				};

				addthis_share = {
					url: "<?php echo bucket_get_current_canonical_url(); ?>",
					title: "<?php wp_title( '|', true, 'right' ); ?>",
					description: "<?php echo trim( strip_tags( get_the_excerpt() ) ) ?>"
				};
			</script>
			<?php
		endif;
	}
}
add_action( 'wp_enqueue_scripts', 'bucket_callback_addthis' );

/**
 * The following code is inspired by Yoast SEO.
 */
function bucket_get_current_canonical_url() {
	global $wp_query;

	if ( $wp_query->is_404 || $wp_query->is_search ) {
		return false;
	}

	$haspost = count( $wp_query->posts ) > 0;

	if ( get_query_var( 'm' ) ) {
		$m = preg_replace( '/[^0-9]/', '', get_query_var( 'm' ) );
		switch ( strlen( $m ) ) {
			case 4:
				$link = get_year_link( $m );
				break;
			case 6:
				$link = get_month_link( substr( $m, 0, 4 ), substr( $m, 4, 2 ) );
				break;
			case 8:
				$link = get_day_link( substr( $m, 0, 4 ), substr( $m, 4, 2 ), substr( $m, 6, 2 ) );
				break;
			default:
				return false;
		}
	} elseif ( ( $wp_query->is_single || $wp_query->is_page ) && $haspost ) {
		$post = $wp_query->posts[0];
		$link = get_permalink( $post->ID );
	} elseif ( $wp_query->is_author && $haspost ) {
		$author = get_userdata( get_query_var( 'author' ) );
		if ( $author === false ) {
			return false;
		}
		$link = get_author_posts_url( $author->ID, $author->user_nicename );
	} elseif ( $wp_query->is_category && $haspost ) {
		$link = get_category_link( get_query_var( 'cat' ) );
	} elseif ( $wp_query->is_tag && $haspost ) {
		$tag = get_term_by( 'slug', get_query_var( 'tag' ), 'post_tag' );
		if ( ! empty( $tag->term_id ) ) {
			$link = get_tag_link( $tag->term_id );
		}
	} elseif ( $wp_query->is_day && $haspost ) {
		$link = get_day_link( get_query_var( 'year' ), get_query_var( 'monthnum' ), get_query_var( 'day' ) );
	} elseif ( $wp_query->is_month && $haspost ) {
		$link = get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) );
	} elseif ( $wp_query->is_year && $haspost ) {
		$link = get_year_link( get_query_var( 'year' ) );
	} elseif ( $wp_query->is_home ) {
		if ( ( get_option( 'show_on_front' ) == 'page' ) && ( $pageid = get_option( 'page_for_posts' ) ) ) {
			$link = get_permalink( $pageid );
		} else {
			if ( function_exists( 'icl_get_home_url' ) ) {
				$link = icl_get_home_url();
			} else { // icl_get_home_url does not exist
				$link = home_url();
			}
		}
	} elseif ( $wp_query->is_tax && $haspost ) {
		$taxonomy = get_query_var( 'taxonomy' );
		$term     = get_query_var( 'term' );
		$link     = get_term_link( $term, $taxonomy );
	} elseif ( $wp_query->is_archive && function_exists( 'get_post_type_archive_link' ) && ( $post_type = get_query_var( 'post_type' ) ) ) {
		$link = get_post_type_archive_link( $post_type );
	} else {
		return false;
	}

	//let's see about the page number
	$page = get_query_var( 'page' );
	if ( empty( $page ) ) {
		$page = get_query_var( 'paged' );
	}

	if ( ! empty( $page ) && $page > 1 ) {
		$link = trailingslashit( $link ) . "page/$page";
		$link = user_trailingslashit( $link, 'paged' );
	}

	return $link;
}
