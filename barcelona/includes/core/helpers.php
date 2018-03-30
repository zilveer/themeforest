<?php

/*
 * Require helper classes
 */
if ( ! function_exists( 'barcelona_helper_classes' ) ) {
	function barcelona_helper_classes() {

	if ( ! class_exists( 'Hybrid_Media_Grabber' ) ) {
		require_once BARCELONA_SERVER_PATH .'includes/classes/class-hybrid-media-grabber.php';
	}

	if ( ! class_exists( 'Mobile_Detect' ) ) {
		require_once BARCELONA_SERVER_PATH .'includes/classes/Mobile_Detect.php';
	}

	}
}
add_action( 'init', 'barcelona_helper_classes' );

/*
 * Get current protocol
 */
if ( ! function_exists( 'barcelona_get_protocol' ) ) {
	function barcelona_get_protocol() {

		return is_ssl() ? 'https:' : 'http:';

	}
}

/*
 * Check if is empty
 */
if ( ! function_exists( 'barcelona_is_empty' ) ) {
	function barcelona_is_empty( $str ) {

	if ( ! is_string( $str ) ) {
		return true;
	}

	$str = preg_replace( '#\s+#is', '', $str );
	$str = str_replace( '&nbsp;', '', $str );
	$str = preg_replace( '#<br\s?\/?>#is', '', $str );

	if ( empty( $str ) ) {
		return true;
	}

	return false;

	}
}

/*
 * Get social links
 */
if ( ! function_exists( 'barcelona_get_social_links' ) ) {
	function barcelona_get_social_links() {

		$barcelona_social_links = array(
			'rss' => array(
				'title' => esc_html__( 'RSS Feed', 'barcelona' ),
				'href' => barcelona_get_option( 'social_rss_feed_url' )
			),
			'facebook' => array(
				'title' => 'Facebook',
				'href' => barcelona_get_option( 'social_facebook_url' )
			),
			'twitter' => array(
				'title' => 'Twitter',
				'href' => barcelona_get_option( 'social_twitter_url' )
			),
			'google-plus' => array(
				'title' => 'Google Plus',
				'href' => barcelona_get_option( 'social_google_plus_url' )
			),
			'linkedin' => array(
				'title' => 'Linkedin',
				'href' => barcelona_get_option( 'social_linkedin_url' )
			),
			'youtube' => array(
				'title' => 'Youtube',
				'href' => barcelona_get_option( 'social_youtube_url' )
			),
			'vimeo' => array(
				'title' => 'Vimeo',
				'href' => barcelona_get_option( 'social_vimeo_url' )
			),
			'vk' => array(
				'title' => 'VKontakte',
				'href' => barcelona_get_option( 'social_vk_url' )
			),
			'instagram' => array(
				'title' => 'Instagram',
				'href' => barcelona_get_option( 'social_instagram_url' )
			),
			'pinterest' => array(
				'title' => 'Pinterest',
				'href' => barcelona_get_option( 'social_pinterest_url' )
			),
			'github' => array(
				'title' => 'Github',
				'href' => barcelona_get_option( 'social_github_url' )
			),
			'flickr' => array(
				'title' => 'Flickr',
				'href' => barcelona_get_option( 'social_flickr_url' )
			),
			'SoundCloud' => array(
				'title' => 'SoundCloud',
				'href' => barcelona_get_option( 'social_soundcloud_url' )
			)
		);

		foreach ( $barcelona_social_links as $k => $v ) {

			if ( ! empty( $v['href'] ) ) {

				$i = $k;

				switch( $k ) {
					case 'vimeo':
						$i = 'vimeo-square';
						break;
					case 'pinterest':
						$i = 'pinterest-p';
						break;
					case 'soundcloud':
						$i = 'cloud';
						break;
					case 'facebook';
						$i = 'facebook-official';
						break;
				}

				$barcelona_social_links[ $k ]['icon'] = $i;

			} else {

				unset( $barcelona_social_links[ $k ] );

			}

		}

		return $barcelona_social_links;

	}
}

/*
 * Get author social links
 */
if ( ! function_exists( 'barcelona_get_author_social_links' ) ) {
	function barcelona_get_author_social_links( $author_id ) {

	$barcelona_social_links = array(
		'facebook' => array(
			'title' => 'Facebook',
			'href' => get_the_author_meta( 'facebook', $author_id )
		),
		'twitter' => array(
			'title' => 'Twitter',
			'href' => get_the_author_meta( 'twitter', $author_id )
		),
		'instagram' => array(
			'title' => 'Instagram',
			'href' => get_the_author_meta( 'instagram', $author_id )
		),
		'google-plus' => array(
			'title' => 'Google Plus',
			'href' => get_the_author_meta( 'google_plus', $author_id )
		),
		'linkedin' => array(
			'title' => 'Linkedin',
			'href' => get_the_author_meta( 'linkedin', $author_id )
		)
	);

	foreach ( $barcelona_social_links as $k => $v ) {

		if ( ! empty( $v['href'] ) ) {

			$barcelona_social_links[ $k ]['icon'] = $k;

		} else {

			unset( $barcelona_social_links[ $k ] );

		}

	}

	return $barcelona_social_links;

	}
}

/*
 * Get locale
 */
if ( ! function_exists( 'barcelona_get_locale' ) ) {
	function barcelona_get_locale() {

	$barcelona_locale = get_locale();

	if( preg_match( '#^[a-z]{2}\-[A-Z]{2}$#', $barcelona_locale ) ) {

		$barcelona_locale = str_replace( '-', '_', $barcelona_locale );

	} else if ( preg_match( '#^[a-z]{2}$#', $barcelona_locale ) ) {

		$barcelona_locale .= '_'. mb_strtoupper( $barcelona_locale, 'UTF-8' );

	}

	if ( empty( $barcelona_locale ) ) {
		$barcelona_locale = 'en_US';
	}

	return $barcelona_locale;

	}
}

/*
 * Get featured image url (void)
 */
if ( ! function_exists( 'barcelona_thumbnail_url' ) ) {
	function barcelona_thumbnail_url( $size, $post_id = NULL ) {

	$barcelona_thumbnail_url = barcelona_get_thumbnail_url( $size, $post_id );

	echo is_array( $barcelona_thumbnail_url ) ? esc_url( $barcelona_thumbnail_url[0] ) : '';

	}
}

/*
 * Get featured image url
 */
if ( ! function_exists( 'barcelona_get_thumbnail_url' ) ) {
	function barcelona_get_thumbnail_url( $size, $post_id=NULL, $placeholder=TRUE, $is_attachment=FALSE ) {

	$attachment_id = ( is_attachment( $post_id ) || $is_attachment ) ? $post_id : get_post_thumbnail_id( $post_id );

	$output = false;

	if ( ( ( is_attachment( $post_id ) || $is_attachment ) && wp_attachment_is_image( $post_id ) ) || has_post_thumbnail( $post_id ) ) {

		$output = wp_get_attachment_image_src( $attachment_id, $size );

	} else if ( $placeholder ) { // Return default post thumbnail image url

		if ( is_null( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$barcelona_post_format = get_post_format( $post_id );

		if ( $barcelona_post_format == 'video' && barcelona_get_option( 'use_yt_video_cover__single' ) == 'on' ) {
			$barcelona_placeholder_img = barcelona_get_youtube_video_thumbnail( get_post_meta( $post_id, 'barcelona_format_video_embed', true ), $size );
		}

		if ( ! isset( $barcelona_placeholder_img ) || false === $barcelona_placeholder_img ) {

			$output = array(
				'assets/images/placeholders/' . ( $size == 'full' ? 'barcelona-full' : $size ) . '-pthumb.jpg',
				0,
				0
			);

			if ( is_readable( BARCELONA_SERVER_PATH . $output[0] ) ) {
				@list( $output[1], $output[2] ) = getimagesize( BARCELONA_SERVER_PATH . $output[0] );
			}

			$output[0] = BARCELONA_THEME_PATH . $output[0];

		} else {

			$output[0] = $barcelona_placeholder_img;

		}

	}

	if ( is_array( $output ) ) {
		$output[0] = esc_url( $output[0] );
	}

	return $output;

	}
}

/*
 * Get featured image thumbnail (void)
 */
if ( ! function_exists( 'barcelona_thumbnail' ) ) {
	function barcelona_thumbnail( $size, $post_id = NULL, $attr = array() ) {

	echo barcelona_get_thumbnail( $size, $post_id, $attr );

	}
}

/*
 * Get featured image thumbnail
 */
if ( ! function_exists( 'barcelona_get_thumbnail' ) ) {
	function barcelona_get_thumbnail( $size, $post_id = NULL, $attr = array() ) {

	if ( has_post_thumbnail( $post_id ) && get_the_post_thumbnail( $post_id ) != NULL ) {

		$output = get_the_post_thumbnail( $post_id, $size, $attr );

	} else { // Return default post thumbnail

		if ( is_null( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$barcelona_post_format = get_post_format( $post_id );

		if ( $barcelona_post_format == 'video' && barcelona_get_option( 'use_yt_video_cover__single' ) == 'on' ) {
			$barcelona_placeholder_img = barcelona_get_youtube_video_thumbnail( get_post_meta( $post_id, 'barcelona_format_video_embed', true ), $size );
		}

		if ( ! isset( $barcelona_placeholder_img ) || false === $barcelona_placeholder_img ) {

			$barcelona_placeholder_img = 'assets/images/placeholders/' . ( $size == 'full' ? 'barcelona-full' : $size ) . '-pthumb.jpg';

			if ( is_readable( BARCELONA_SERVER_PATH . $barcelona_placeholder_img ) ) {
				@list( $barcelona_width, $barcelona_height ) = getimagesize( BARCELONA_SERVER_PATH . $barcelona_placeholder_img );
			}

			$barcelona_placeholder_img = BARCELONA_THEME_PATH . $barcelona_placeholder_img;

		}

		$output = '<img src="'. $barcelona_placeholder_img .'"'. ( isset( $barcelona_width ) && isset( $barcelona_height ) ? ' width="'. $barcelona_width .'" height="'. $barcelona_height .'"' : '' ) .' />';

	}

	return $output;

	}
}

/*
 * Get post vote (void)
 */
if ( ! function_exists( 'barcelona_post_vote' ) ) {
	function barcelona_post_vote( $post_id = NULL, $type = 'up' ) {

	echo barcelona_get_post_vote( $post_id, $type );

	}
}

/*
 * Get Post Vote
 */
if ( ! function_exists( 'barcelona_get_post_vote' ) ) {
	function barcelona_get_post_vote( $post_id = NULL, $type = 'up' ) {

	if ( is_null( $post_id ) ) {

	$post_id = get_the_ID();

	if( empty( $post_id ) ) {
		return false;
	}

	}

	if( ! in_array( $type, array( 'up', 'down' ) ) ) {
	return false;
	}

	$barcelona_vote_count = get_post_meta( $post_id, '_barcelona_vote_'. $type, true );
	if ( empty( $barcelona_vote_count ) || ! is_numeric( $barcelona_vote_count ) ) {
	$barcelona_vote_count = 0;
	}

	return intval( $barcelona_vote_count );

	}
}

/*
 * Check if post is voted
 */
if ( ! function_exists( 'barcelona_is_voted_post' ) ) {
	function barcelona_is_voted_post( $post_id = NULL ) {

	if ( is_null( $post_id ) ) {

		$post_id = get_the_ID();

		if( empty( $post_id ) ) {
			return false;
		}

	}

	$barcelona_voted_posts = array_key_exists( 'barcelona_voted_posts', $_COOKIE ) ? stripcslashes( $_COOKIE['barcelona_voted_posts'] ) : '';

	if ( ! empty( $barcelona_voted_posts ) ) {

		$barcelona_voted_posts = json_decode( $barcelona_voted_posts, true );

		if ( is_array( $barcelona_voted_posts ) && array_key_exists( 'post_'. $post_id, $barcelona_voted_posts ) ) {
			return $barcelona_voted_posts[ 'post_'. $post_id ];
		}

	}

	return false;

	}
}

/*
 * Get comment vote (void)
 */
if ( ! function_exists( 'barcelona_comment_vote' ) ) {
	function barcelona_comment_vote( $comment_id = NULL, $type = 'up' ) {

	echo barcelona_get_comment_vote( $comment_id, $type );

	}
}

/*
 * Get comment vote
 */
if ( ! function_exists( 'barcelona_get_comment_vote' ) ) {
	function barcelona_get_comment_vote( $comment_id = NULL, $type = 'up' ) {

	if ( is_null ( $comment_id ) ) {

		global $comment;

		if ( is_object( $comment ) ) {
			$comment_id = $comment->comment_ID;
		} else {
			return false;
		}

	}

	if( ! in_array( $type, array( 'up', 'down' ) ) ) {
		return false;
	}

	$barcelona_vote_count = get_comment_meta( $comment_id, '_barcelona_vote_'. $type, true );
	if ( empty( $barcelona_vote_count ) ) {
		$barcelona_vote_count = 0;
	}

	return intval( $barcelona_vote_count );

	}
}

/*
 * Check if post is voted
 */
if ( ! function_exists( 'barcelona_is_voted_comment' ) ) {
	function barcelona_is_voted_comment( $comment_id = NULL ) {

	if ( is_null ( $comment_id ) ) {

		global $comment;

		if ( is_object( $comment ) ) {
			$comment_id = $comment->comment_ID;
		} else {
			return false;
		}

	}

	$barcelona_voted_comments = array_key_exists( 'barcelona_voted_comments', $_COOKIE ) ? stripcslashes( $_COOKIE['barcelona_voted_comments'] ) : '';

	if ( ! empty( $barcelona_voted_comments ) ) {

		$barcelona_voted_comments = json_decode( $barcelona_voted_comments, true );

		if ( is_array( $barcelona_voted_comments ) && array_key_exists( 'comment_'. $comment_id, $barcelona_voted_comments ) ) {
			return $barcelona_voted_comments[ 'comment_'. $comment_id ];
		}

	}

	return false;

	}
}

/*
 * Get excerpt (void)
 */
if ( ! function_exists( 'barcelona_excerpt' ) ) {
	function barcelona_excerpt( $length ) {

	echo barcelona_get_excerpt( $length );

	}
}

/*
 * Get excerpt
 */
if ( ! function_exists( 'barcelona_get_excerpt' ) ) {
	function barcelona_get_excerpt( $barcelona_words_length ) {

		global $post;

		if ( post_password_required() ) {
			return esc_html__( 'There is no excerpt because this is a protected post.', 'barcelona' );
		}

		$barcelona_post_excerpt = $post->post_excerpt;

		if ( $barcelona_post_excerpt == NULL ) {

			$barcelona_links_pattern = '~http(s)?://[^\s]*~i';

			$barcelona_post_excerpt = $post->post_content;
			$barcelona_post_excerpt = strip_shortcodes( $barcelona_post_excerpt );
			$barcelona_post_excerpt = str_replace( ']]>', ']]&gt;', $barcelona_post_excerpt );
			$barcelona_post_excerpt = strip_tags( $barcelona_post_excerpt );
			$barcelona_post_excerpt = preg_replace( $barcelona_links_pattern, '', $barcelona_post_excerpt );
			$barcelona_post_excerpt = mb_substr( $barcelona_post_excerpt, 0, intval( $barcelona_words_length ) * 4.2, 'UTF-8' ) .'&hellip;';

		}

		return $barcelona_post_excerpt;

	}
}

/*
 * The month abbrev
 */
if ( ! function_exists( 'barcelona_the_month_abbrev' ) ) {
	function barcelona_the_month_abbrev() {

	$barcelona_m_i = get_the_time( 'm' );
	$barcelona_m = $GLOBALS['month'];
	$barcelona_m_a = $GLOBALS['month_abbrev'];

	echo esc_html( $barcelona_m_a[ $barcelona_m[ $barcelona_m_i ] ] );

	}
}

/*
 * Get option
 */
if ( ! function_exists( 'barcelona_get_option' ) ) {
	function barcelona_get_option( $barcelona_field, $barcelona_ignore_override = FALSE, $barcelona_get_default = FALSE ) {

	// Remove prefix of the field key if exists
	if ( strpos( $barcelona_field, 'barcelona_' ) === 0 ) {
		$barcelona_field = preg_replace( '#^barcelona_#is', '', $barcelona_field );
	}

	if ( $barcelona_field == 'featured_image_style'
			&& is_singular()
			&& barcelona_get_post_format() == 'standard'
			&& ! has_post_thumbnail() ) {
		return 'cl';
	}

	if ( $barcelona_field == 'social_links' ) {
		return barcelona_get_social_links();
	}

	if ( $barcelona_field == 'posts_layout' && ( is_archive() || is_search() ) && ! have_posts() ) {
		return 'none';
	}

	$barcelona_defaults = array(
		'header_custom_code'               => '',
		'footer_custom_code'               => '',
		'css_custom_code'                  => '',
		'show_header_logo_as_text'         => 'off',
		'header_logo_text'                 => get_bloginfo( 'name' ),
		'header_dark_logo_url'             => '',
		'header_dark_retina_logo_url'      => '',
		'header_light_logo_url'            => '',
		'header_light_retina_logo_url'     => '',
		'sticky_nav_logo'                  => 'inherit',
		'show_sticky_nav_logo_as_text'     => 'on',
		'sticky_nav_logo_text'             => get_bloginfo( 'name' ),
		'sticky_nav_dark_logo_url'         => '',
		'sticky_nav_dark_retina_logo_url'  => '',
		'sticky_nav_light_logo_url'        => '',
		'sticky_nav_light_retina_logo_url' => '',
		'show_footer_logo_as_text'         => 'off',
		'footer_logo_text'                 => get_bloginfo( 'name' ),
		'footer_dark_logo_url'             => '',
		'footer_dark_retina_logo_url'      => '',
		'footer_light_logo_url'            => '',
		'footer_light_retina_logo_url'     => '',
		'favicon_url'                      => '',
		'apple_touch_icon_iphone'          => '',
		'apple_touch_icon_ipad'            => '',
		'apple_touch_icon_retina'          => '',
		'default_sidebar'                  => 'barcelona-default-sidebar',
		'default_sidebar__buddypress'      => 'barcelona-buddypress-sidebar',
		'default_sidebar__bbpress'         => 'barcelona-bbpress-sidebar',
		'default_sidebar__woocommerce'     => 'barcelona-woocommerce-sidebar',
		'sidebar_position'                 => 'right',
		'header_style'                     => 'a',
		'header_cover_image'               => '',
		'show_top_bar_menu'                => 'on',
		'show_header_social_icons'         => 'on',
		'show_footer'                      => 'on',
		'show_footer_sidebars'             => 'on',
		'show_footer_logo'                 => 'on',
		'show_footer_menu'                 => 'on',
		'footer_copyright_text'            => '',
		'mm_orderby'                       => 'date',
		'mm_order'                         => 'desc',
		'mm_post_meta_choices'             => array(),
		'show_tags_under_mm'               => 'on',
		'boxed_layout'                     => 'off',
		'sticky_nav_bar'                   => 'on',
		'sticky_sidebars'                  => 'on',
		'show_search_button'               => 'on',
		'show_title'                       => 'on',
		'show_content'                     => 'on',
		'show_breadcrumb'                  => 'on',
		'show_breadcrumb__page'            => 'off',
		'show_breadcrumb__woocommerce'     => 'off',
		'show_breadcrumb__buddypress'      => 'off',
		'show_breadcrumb__bbpress'         => 'off',
		'show_cat_title'                   => 'on',
		'zoom_in_post_on_hover'            => 'on',
		'disqus_comments'                  => 'off',
		'disqus_sitename'                  => '',
		'posts_layout'                     => 'c',
		'posts_layout__archive'            => 'd',
		'posts_layout__author'             => 'd',
		'fp_style__category'               => 'none',
		'fp_max_number_of_posts__category' => 3,
		'fp_post_meta_choices__category'   => '',
		'fp_filter_tag__category'          => '',
		'fp_filter_post__category'         => '',
		'fp_orderby__category'             => 'date',
		'fp_order__category'               => 'desc',
		'fp_prevent_duplication__category' => 'off',
		'featured_image_style'             => 'fw',
		'featured_image_credit'            => '',
		'pagination'                       => 'numeric',
		'show_comments'                    => 'on',
		'show_comments__page'              => 'on',
		'show_comment_voting'              => 'on',
		'show_tags'                        => 'on',
		'show_social_sharing'              => 'on',
		'show_social_sharing__page'        => 'off',
		'show_author_box'                  => 'on',
		'show_author_box__page'            => 'off',
		'show_voting'                      => 'on',
		'show_voting__page'                => 'off',
		'post_voting_login_req'            => 'off',
		'comment_voting_login_req'         => 'off',
		'show_post_nav'                    => 'on',
		'show_related_posts'               => 'on',
		'related_posts_columns'            => '3',
		'related_posts_num'                => '9',
		'related_posts_meta'               => array(),
		'post_meta_choices'                => array(),
		'use_yt_video_cover'               => 'off',
		'sidebars'                         => '',
		'social_rss_feed_url'              => '',
		'social_facebook_url'              => '',
		'social_twitter_url'               => '',
		'social_google_plus_url'           => '',
		'social_linkedin_url'              => '',
		'social_youtube_url'               => '',
		'social_vimeo_url'                 => '',
		'social_vk_url'                    => '',
		'social_instagram_url'             => '',
		'social_pinterest_url'             => '',
		'social_github_url'                => '',
		'social_flickr_url'                => '',
		'facebook_app_id'                  => '',
		'add_facebook_og_tags'             => 'on',
		'add_facebook_sdk'                 => 'off',
		'twitter_access_token'             => '',
		'twitter_access_token_secret'      => '',
		'twitter_consumer_key'             => '',
		'twitter_consumer_secret'          => '',
		'font_headings'                    => 'Montserrat',
		'font_headings_custom'             => '',
		'font_general'                     => 'Montserrat',
		'font_general_custom'              => '',
		'font_latin_ext'                   => 'off',
		'font_cyrillic_ext'                => 'off',
		'font_greek_charset'               => 'off',
		'top_nav_color_scheme'             => 'dark',
		'footer_color_scheme'              => 'dark',
		'megamenu_color_scheme'            => 'dark',
		'selection_color'                  => '#f2132d',
		'add_header_ad'                    => 'inherit',
		'header_ad_1'                      => '',
		'header_ad_2'                      => '',
		'set_background'                   => 'inherit',
		'custom_background'                => '',
		'show_post_content_ad'             => 'off',
		'post_content_ad_1'                => '',
		'post_content_ad_2'                => '',
		'override_options'                 => 'off'
	);
	$barcelona_dependencies = array(
		'add_header_ad' => array(
			'header_ad_1',
			'header_ad_2'
		),
		'set_background' => array(
			'custom_background'
		)
	);

	$barcelona_field_raw = $barcelona_field;

	$barcelona_pattern_parent_affix = '#__(home|tag|author|search|archive|category|single|page|woocommerce|bbpress|buddypress)$#is';
	$barcelona_pattern_cat_id_affix = '#__category_([0-9]+)$#is';

	if ( $barcelona_is_parent_field = preg_match( $barcelona_pattern_parent_affix, $barcelona_field, $barcelona_match_parent_affix ) ) {
		$barcelona_field_raw = preg_replace( $barcelona_pattern_parent_affix, '', $barcelona_field );
	}

	if ( $barcelona_is_implicit_category = preg_match( $barcelona_pattern_cat_id_affix, $barcelona_field, $barcelona_match_cat_id_affix ) ) {
		$barcelona_field_raw = preg_replace( $barcelona_pattern_cat_id_affix, '', $barcelona_field );
	}

	foreach ( $barcelona_dependencies as $k => $v ) {
		if ( in_array( $barcelona_field_raw, $v ) ) {
			$barcelona_dep_field = $k;
			break;
		}
	}

	if ( $barcelona_get_default ) {

		if ( array_key_exists( $barcelona_field, $barcelona_defaults ) ) {

			return $barcelona_defaults[ $barcelona_field ];

		} else if ( array_key_exists( $barcelona_field_raw, $barcelona_defaults ) ) {

			return $barcelona_defaults[ $barcelona_field_raw ];

		} else {

			return '';

		}

	}

	if ( class_exists( 'Woocommerce' ) && barcelona_is_woocommerce() && ! $barcelona_is_parent_field ) {

		return barcelona_get_option( $barcelona_field_raw .'__woocommerce' );

	} else if ( function_exists( 'bbpress' ) && is_bbpress() && ! $barcelona_is_parent_field ) {

		return barcelona_get_option( $barcelona_field_raw .'__bbpress' );

	} else if ( function_exists( 'buddypress' ) && is_buddypress() && ! $barcelona_is_parent_field ) {

		return barcelona_get_option( $barcelona_field_raw .'__buddypress' );

	} else if ( is_singular() && ! $barcelona_is_parent_field ) {

		global $post;

		$barcelona_parent_affix = is_page() ? '_page' : '_single';

		if ( ! $barcelona_ignore_override && barcelona_get_option( 'barcelona_override_options_'. $barcelona_parent_affix ) == 'on' ) {
			return barcelona_get_option( $barcelona_field_raw .'_'. $barcelona_parent_affix );
		}

		if ( isset( $barcelona_dep_field ) ) {

			$barcelona_option = get_post_meta( $post->ID, 'barcelona_'. $barcelona_dep_field, true );

			if ( $barcelona_option == 'inherit' ) {
				return barcelona_get_option( $barcelona_field_raw .'_'. $barcelona_parent_affix );
			}

		}

		$barcelona_option = get_post_meta( $post->ID, 'barcelona_' . $barcelona_field_raw );

		if ( ! empty( $barcelona_option ) ) {

			return $barcelona_option[0];

		} else {

			return barcelona_get_option( $barcelona_field_raw .'_'. $barcelona_parent_affix );

		}

	} else if ( ( is_category() || $barcelona_is_implicit_category ) && ! $barcelona_is_parent_field ) {

		if ( $barcelona_is_implicit_category ) {
			$barcelona_cat_id = end( $barcelona_match_cat_id_affix );
		} else {
			global $wp_query;
			$barcelona_cat_id = $wp_query->get_queried_object_id();
		}

		if ( ! $barcelona_ignore_override && barcelona_get_option( 'barcelona_override_options__category' ) == 'on' ) {
			return barcelona_get_option( $barcelona_field_raw .'__category' );
		}

		$barcelona_cat_option = get_option( '_barcelona_category_'. $barcelona_cat_id );

		if ( ! is_array( $barcelona_cat_option ) ) {
			return barcelona_get_option( $barcelona_field_raw .'__category' );
		}

		if ( isset( $barcelona_dep_field ) ) {

			$barcelona_option = array_key_exists( $barcelona_dep_field, $barcelona_cat_option ) ? $barcelona_cat_option[ $barcelona_dep_field ] : '';

			if ( $barcelona_option == 'inherit' ) {
				return barcelona_get_option( $barcelona_field_raw .'__category' );
			}

		}

		if ( array_key_exists( $barcelona_field_raw, $barcelona_cat_option ) ) {

			return $barcelona_cat_option[ $barcelona_field_raw ];

		} else {

			return barcelona_get_option( $barcelona_field_raw .'__category' );

		}

	} else {

		if ( ! $barcelona_is_parent_field ) {

			$barcelona_is_parent_field = true;

			if ( is_home() ) {
				$barcelona_parent_affix = '_home';
			} else if ( is_tag() ) {
				$barcelona_parent_affix = '_tag';
			} else if ( is_author() ) {
				$barcelona_parent_affix = '_author';
			} else if ( is_search() ) {
				$barcelona_parent_affix = '_search';
			} else if ( is_archive() ) {
				$barcelona_parent_affix = '_archive';
			} else {
				$barcelona_is_parent_field = false;
			}

			if ( isset( $barcelona_parent_affix ) && $barcelona_is_parent_field ) {
				$barcelona_field = $barcelona_field_raw .'_'. $barcelona_parent_affix;
			}

		} else {

			$barcelona_parent_affix = '_'. end( $barcelona_match_parent_affix );

		}

		// Get all theme options
		$barcelona_ot_options = get_option( ot_options_id() );

		if ( ! is_array( $barcelona_ot_options ) ) {

			return barcelona_get_option( $barcelona_field, false, true );

		} else {

			foreach( $barcelona_ot_options as $k => $v ) {
				$pk = preg_replace( '#^barcelona_#is', '', $k );
				$barcelona_ot_options[ $pk ] = $v;
				unset( $barcelona_ot_options[ $k ] );
			}

		}

		if ( isset( $barcelona_dep_field ) && isset( $barcelona_parent_affix ) && $barcelona_is_parent_field ) {

			$barcelona_dep_field .= '_'. $barcelona_parent_affix;

			$barcelona_option = array_key_exists( $barcelona_dep_field, $barcelona_ot_options ) ? $barcelona_ot_options[ $barcelona_dep_field ] : '';

			if ( $barcelona_option == 'inherit' ) {

				if ( array_key_exists( $barcelona_field_raw, $barcelona_ot_options ) ) {

					return $barcelona_ot_options[ $barcelona_field_raw ];

				} else {

					return barcelona_get_option( $barcelona_field_raw, false, true );

				}

			}

		}

		if ( array_key_exists( $barcelona_field, $barcelona_ot_options ) ) {

			return $barcelona_ot_options[ $barcelona_field ];

		} else if ( $barcelona_is_parent_field && array_key_exists( $barcelona_field, $barcelona_defaults ) ) {

			return $barcelona_defaults[ $barcelona_field ];

		} else if ( array_key_exists( $barcelona_field_raw, $barcelona_ot_options ) ) {

			return $barcelona_ot_options[ $barcelona_field_raw ];

		} else {

			return barcelona_get_option( $barcelona_field, false, true );

		}

	}

	}
}

/*
 * Get options as an array
 */
if ( ! function_exists( 'barcelona_get_options' ) ) {
	function barcelona_get_options( $fields ) {

		$result = array();

		if ( ! is_array( $fields ) ) {
			$fields = array();
		}

		foreach ( $fields as $k ) {
			$result[ $k ] = barcelona_get_option( $k );
		}

		return $result;

	}
}

/*
 * Get class attr
 */
if ( ! function_exists( 'barcelona_class' ) ) {
	function barcelona_class( $barcelona_cls, $classes ) {

		if ( ! is_array( $classes ) ) {
			$classes = array();
		}

		foreach ( $classes as $v ) {
			$barcelona_cls[] = $v;
		}

		return implode( ' ',  $barcelona_cls );

	}
}

/*
 * Get nav class
 */
if ( ! function_exists( 'barcelona_nav_class' ) ) {
	function barcelona_nav_class( $classes=array() ) {

		$barcelona_options = barcelona_get_options( array(
			'top_nav_color_scheme',
			'megamenu_color_scheme',
			'sticky_nav_bar',
			'header_style',
			'sticky_nav_logo'
		) );

		$barcelona_options['has_nav'] = has_nav_menu( 'main' );

		$barcelona_cls = array(
			'navbar',
			'navbar-static-top',
			'navbar-'. sanitize_html_class( $barcelona_options['top_nav_color_scheme'] ),
			'mega-menu-'. sanitize_html_class( $barcelona_options['megamenu_color_scheme'] ),
			'header-style-'. sanitize_html_class( $barcelona_options['header_style'] ),
			'sticky-logo-'. sanitize_html_class( $barcelona_options['sticky_nav_logo'] )
		);

		if ( $barcelona_options['sticky_nav_bar'] == 'on' && $barcelona_options['has_nav'] ) {
			$barcelona_cls[] = 'navbar-sticky';
		}

		$barcelona_cls[] = $barcelona_options['has_nav'] ? 'has-nav-menu' : 'no-nav-menu';

		return barcelona_class( $barcelona_cls, $classes );

	}
}

/*
 * Get single class
 */
if ( ! function_exists( 'barcelona_single_class' ) ) {
	function barcelona_single_class( $classes=array() ) {

		$barcelona_cls = array( 'container', 'single-container' );

		return barcelona_class( $barcelona_cls, $classes );

	}
}

/*
 * Get row (main wrapper) class
 */
if ( ! function_exists( 'barcelona_row_class' ) ) {
	function barcelona_row_class( $classes=array() ) {

		$barcelona_sidebar_position = barcelona_get_option( 'sidebar_position' );

		$barcelona_cls = array( 'row-primary', 'sidebar-'. sanitize_html_class( $barcelona_sidebar_position ), 'clearfix' );

		if ( $barcelona_sidebar_position != 'none' ) {
			$barcelona_cls[] = 'has-sidebar';
		}

		return barcelona_class( $barcelona_cls, $classes );

	}
}

/*
 * Get main (column) class
 */
if ( ! function_exists( 'barcelona_main_class' ) ) {
	function barcelona_main_class( $classes=array() ) {

		$barcelona_cls = array( 'main' );

		return barcelona_class( $barcelona_cls, $classes );

	}
}

/*
 * Get sidebar class
 */
if ( ! function_exists( 'barcelona_sidebar_class' ) ) {
	function barcelona_sidebar_class( $classes=array() ) {

		$barcelona_cls = array();
		if ( barcelona_get_option( 'sticky_sidebars' ) == 'on' ) {
			$barcelona_cls[] = 'sidebar-sticky';
		}

		return barcelona_class( $barcelona_cls, $classes );

	}
}

/*
 * Get footer class
 */
if ( ! function_exists( 'barcelona_footer_class' ) ) {
	function barcelona_footer_class( $classes=array() ) {

		$barcelona_cls = array(
			'footer',
			'footer-'. sanitize_html_class( barcelona_get_option( 'footer_color_scheme' ) )
		);

		return barcelona_class( $barcelona_cls, $classes );

	}
}

/*
 * Get theme font
 */
if ( ! function_exists( 'barcelona_get_font' ) ) {
	function barcelona_get_font( $extra_fonts=FALSE ) {

		$barcelona_options = barcelona_get_options( array(
			'font_headings',
			'font_headings_custom',
			'font_general',
			'font_general_custom',
			'font_latin_ext',
			'font_cyrillic_ext',
			'font_greek_charset'
		) );

		foreach ( array( 'headings', 'general' ) as $k ) {

			$k = 'font_'. $k;

			if ( $barcelona_options[ $k ] == 'custom' && ! empty( $barcelona_options[ $k .'_custom' ] ) ) {
				$barcelona_options[ $k ] = preg_replace( '#\s+#', '+', $barcelona_options[ $k .'_custom' ] );
			}

		}

		$barcelona_font_names = array( $barcelona_options['font_general'] .':400,700,400italic' );
		if ( $barcelona_options['font_headings'] != $barcelona_options['font_general'] ) {
			$barcelona_font_names[] = $barcelona_options['font_headings'] .':400,700';
		}

		if ( is_array( $extra_fonts ) ) {
			$barcelona_font_names = array_merge( $barcelona_font_names, $extra_fonts );
		}

		$barcelona_font_subset = array( 'latin' );
		if ( $barcelona_options['font_cyrillic_ext'] == 'on' ) {
			$barcelona_font_subset[] = 'cyrillic,cyrillic-ext';
		}

		if ( $barcelona_options['font_latin_ext'] == 'on' ) {
			$barcelona_font_subset[] = 'latin-ext';
		}

		if ( $barcelona_options['font_greek_charset'] == 'on' ) {
			$barcelona_font_subset[] = 'greek,greek-ext';
		}

		$barcelona_font_href = barcelona_get_protocol() .'//fonts.googleapis.com/css?family='. implode( '|', $barcelona_font_names );
		if ( count( $barcelona_font_subset ) > 1 ) {
			$barcelona_font_href .= '&subset='. implode( ',', $barcelona_font_subset );
		}

		$result = array( esc_url( $barcelona_font_href ) );

		$barcelona_body_font_name = $barcelona_heading_font_name = strpos( $barcelona_options['font_general'], "+" ) > 0 ? "'". str_replace( "+", " ", $barcelona_options['font_general'] ) ."'" : $barcelona_options['font_general'];
		if ( $barcelona_options['font_headings'] != $barcelona_options['font_general'] ) {
			$barcelona_heading_font_name = strpos( $barcelona_options['font_headings'], "+" ) > 0 ? "'". str_replace( "+", " ", $barcelona_options['font_headings'] ) ."'" : $barcelona_options['font_headings'];
		}

		$result[] = "<style type=\"text/css\">\nbody { font-family: ". $barcelona_body_font_name .", sans-serif; }\nh1,h2,h3,h4,h5,h6 { font-family: ". $barcelona_heading_font_name .", sans-serif; }\n</style>";

		return $result;

	}
}

/*
 * Get background style as css code
 */
if ( ! function_exists( 'barcelona_get_background' ) ) {
	function barcelona_get_background( $get_fixed=false ) {

		$output = '';

		$barcelona_bg = barcelona_get_option( 'custom_background' );

		if( isset( $barcelona_bg ) && is_array( $barcelona_bg ) ) {

			foreach ( $barcelona_bg as $k => $v ) {
				if ( ( $k != 'background-color' && empty( $barcelona_bg[ 'background-image' ] ) ) || empty( $v ) ) {
					unset( $barcelona_bg[ $k ] );
				}
			}

			if ( ! empty( $barcelona_bg ) ) {

				$barcelona_code = "body { background: ";

				foreach ( array( 'color', 'image', 'repeat', 'attachment', 'position' ) as $k ) {
					if ( ! empty( $barcelona_bg[ 'background-' . $k ] ) && $barcelona_bg[ 'background-' . $k ] != 'inherit' ) {
						$barcelona_code .= ( $k == 'image' ? 'url(' : '' ) . esc_html( $barcelona_bg[ 'background-' . $k ] ) . ( $k == 'image' ? ') ' : ' ' );
					}
				}

				$barcelona_code .= '!important; ';

				if ( ! empty( $barcelona_bg['background-size'] ) ) {
					$barcelona_code .= "background-size: " . sanitize_key( $barcelona_bg['background-size'] ) . '; ';
					$barcelona_code .= "webkit-background-size: " . sanitize_key( $barcelona_bg['background-size'] ) . '; ';
				}

				if ( ! array_key_exists( 'background-attachment', $barcelona_bg ) || $barcelona_bg['background-attachment'] != 'fixed' ) {
					$output .= $barcelona_code . " }";
				}

				if ( $get_fixed ) {

					if ( ! empty( $barcelona_bg['background-image'] ) && $barcelona_bg['background-attachment'] == 'fixed' ) {
						$output .= esc_url( $barcelona_bg['background-image'] );
					} else {
						$output = '';
					}

				}

			}

		}

		return $output;

	}
}

/*
 * Get post format
 */
if ( ! function_exists( 'barcelona_get_post_format' ) ) {
	function barcelona_get_post_format( $post_id=NULL ) {

		$barcelona_post_format = get_post_format( $post_id );
		if ( false === $barcelona_post_format ) {
			$barcelona_post_format = 'standard';
		}

		return $barcelona_post_format;

	}
}

/*
 * Get post views (void)
 */
if ( ! function_exists( 'barcelona_post_views' ) ) {
	function barcelona_post_views( $post_id=NULL ) {

		echo barcelona_get_post_views( $post_id );

	}
}

/*
 * Get post views
 */
if ( ! function_exists( 'barcelona_get_post_views' ) ) {
	function barcelona_get_post_views( $post_id=NULL ) {

		if ( is_null( $post_id ) ) {
			$post_id = get_the_ID();
		}

		/*if ( function_exists( 'stats_get_csv' ) ) {

			$barcelona_stats_csv = stats_get_csv( 'postviews', 'days=-1&post_id='. $post_id );

			if ( is_array( $barcelona_stats_csv ) && ! empty( $barcelona_stats_csv ) ) {
				$barcelona_views = $barcelona_stats_csv[0]['views'];
				return print_r( $barcelona_stats_csv, true );
			}

		}*/

		if ( ! isset( $barcelona_views ) && function_exists( 'ev_get_post_view_count' ) ) {

			$barcelona_views = preg_replace( '#[^0-9]+#', '', ev_get_post_view_count( $post_id ) );

		}

		if ( ! isset( $barcelona_views ) || ! is_numeric( $barcelona_views ) ) {
			$barcelona_views = 0;
		}

		if ( is_single() ) {
			$barcelona_views++;
		}

		return number_format( intval( $barcelona_views ), 0, '.', ',' );

	}
}

/*
 * Convert unix timestamp to 'date ago' format
 */
if ( ! function_exists( 'barcelona_time_ago_format' ) ) {
	function barcelona_time_ago_format( $time ) {

		if ( ! is_numeric( $time ) ) {
			return false;
		}

		// passed time in seconds
		$pt = abs( time() - $time );

		$output = '';

		if ( $pt < 1 ) {

			$output = esc_html__( 'just now', 'barcelona' );

		} elseif ( $pt < 60 ) {

			$output = sprintf( esc_html__( '%s seconds ago', 'barcelona' ), $pt );

		} elseif ( $pt < 120 ) {

			$output = esc_html__( 'about a minute ago', 'barcelona' );

		} elseif ( $pt < ( 45 * 60 ) ) {

			$output = sprintf( esc_html__( 'about %s minutes ago', 'barcelona' ), round( $pt / 60 ) );

		} elseif ( $pt < ( 2 * 60 * 60 ) ) {

			$output = esc_html__( 'about an hour ago', 'barcelona' );

		} elseif ( $pt < ( 24 * 60 * 60 ) ) {

			$barcelona_hours = round( $pt / 3600 );
			$output = sprintf( esc_html( _n( 'about an hour ago', 'about %s hours ago', $barcelona_hours,  'barcelona' ) ), $barcelona_hours );

		} elseif ( $pt < ( 48 * 60 * 60 ) ) {

			$output = esc_html__( 'about a day ago', 'barcelona' );

		} elseif ( $pt > ( 48 * 60 * 60 ) && $pt < ( 24 * 60 * 60 * 30 ) ) {

			$barcelona_days = round( $pt / 86400 );
			$output = sprintf( esc_html( _n( 'about a day ago', 'about %s days ago', $barcelona_days, 'barcelona' ) ), $barcelona_days );

		} elseif ( $pt > ( 24 * 60 * 60 * 30 ) && $pt < ( 24 * 60 * 60 * 30 * 12 ) ) {

			$barcelona_months = round( $pt / 2592000 );
			$output = sprintf( esc_html( _n( 'about a month ago', 'about %s months ago', $barcelona_months, 'barcelona' ) ), $barcelona_months );

		} elseif ( $pt > ( 24 * 60 * 60 * 30 * 12 ) ) {

			$barcelona_years = round( $pt / 31104000 );
			$output = sprintf( esc_html( _n( 'about a year ago', 'about %s years ago', $barcelona_years, 'barcelona' ) ), $barcelona_years );

		}

		return $output;

	}
}

/*
 * Get Featured Posts Query
 */
if ( ! function_exists( 'barcelona_get_featured_posts_query' ) ) {
	function barcelona_get_featured_posts_query( $id, $type ) {

		if ( $type == 'page' ) {

			$barcelona_opts = array(
				'style'               => get_post_meta( $id, 'barcelona_fp_style', true ),
				'number'              => get_post_meta( $id, 'barcelona_fp_max_number_of_posts', true ),
				'offset'              => get_post_meta( $id, 'barcelona_fp_posts_offset', true ),
				'cat'                 => get_post_meta( $id, 'barcelona_fp_filter_category', true ),
				'tag'                 => get_post_meta( $id, 'barcelona_fp_filter_tag', true ),
				'post'                => get_post_meta( $id, 'barcelona_fp_filter_post', true ),
				'orderby'             => get_post_meta( $id, 'barcelona_fp_orderby', true ),
				'order'               => get_post_meta( $id, 'barcelona_fp_order', true ),
				'post_meta_choices'   => get_post_meta( $id, 'barcelona_fp_post_meta_choices', true ),
				'prevent_duplication' => get_post_meta( $id, 'barcelona_fp_prevent_duplication', true )
			);

		} else if ( $type == 'category' ) {

			$barcelona_opts = array(
				'style'               => barcelona_get_option( 'fp_style__category_' . $id ),
				'number'              => barcelona_get_option( 'fp_max_number_of_posts__category_' . $id ),
				'offset'              => barcelona_get_option( 'fp_posts_offset__category_' . $id ),
				'cat'                 => array( $id ),
				'tag'                 => barcelona_get_option( 'fp_filter_tag__category_' . $id ),
				'post'                => barcelona_get_option( 'fp_filter_post__category_' . $id ),
				'orderby'             => barcelona_get_option( 'fp_orderby__category_' . $id ),
				'order'               => barcelona_get_option( 'fp_order__category_' . $id ),
				'post_meta_choices'   => barcelona_get_option( 'fp_post_meta_choices__category_' . $id ),
				'prevent_duplication' => barcelona_get_option( 'fp_prevent_duplication__category_' . $id )
			);

		}

		if ( ! isset( $barcelona_opts ) || empty( $barcelona_opts['style'] ) || $barcelona_opts['style'] == 'none' ) {
			return false;
		}

		$barcelona_params = array(
			'posts_per_page'        => $barcelona_opts['number'],
			'post_type'             => 'post',
			'post_status'           => 'publish',
			'ignore_sticky_posts'   => false,
			'no_found_rows'         => true
		);

		/*
		 * Posts Offset
		 */
		if ( is_numeric( $barcelona_opts['offset'] ) ) {
			$barcelona_params['offset'] = $barcelona_opts['offset'];
		}

		/*
		 * Filter Posts by Category
		 */
		if ( ! empty( $barcelona_opts['cat'] ) ) {
			$barcelona_params['category__in'] = array_values( $barcelona_opts['cat'] );
		}

		/*
		 * Filter Posts by Post IDs
		 */
		if ( ! empty( $barcelona_opts['post'] )  ) {

			$barcelona_params['post__in'] = array_values( array_filter( array_map( function ( $v ) {

				$v = trim( $v );
				if ( ! is_numeric( $v ) || $v <= 0 ) {
					$v = false;
				}

				return $v;

			}, explode( ',', $barcelona_opts['post'] ) ), function( $v ) { return is_numeric( $v ); } ) );

		}

		/*
		 * Filter Posts by Tag Name
		 */
		if ( ! empty( $barcelona_opts['tag'] ) ) {

			$barcelona_tag_names = array_filter( explode( ',', $barcelona_opts['tag'] ) );

			if ( ! empty( $barcelona_tag_names ) ) {

				foreach( $barcelona_tag_names as $barcelona_tag ) {

					$barcelona_tag_term = get_term_by( 'name', trim( $barcelona_tag ), 'post_tag' );
					if ( $barcelona_tag_term ) {
						$barcelona_params['tag__in'][] = $barcelona_tag_term->term_id;
					}

				}

			}

		}

		/*
		 * Posts Ordering
		 */
		switch ( $barcelona_opts['orderby'] ) {
			case 'views':
				$barcelona_params['orderby'] = 'meta_value_num';
				$barcelona_params['meta_key'] = '_barcelona_views';
				break;
			case 'comments':
				$barcelona_params['orderby'] = 'comment_count';
				break;
			case 'votes':
				$barcelona_params['orderby'] = 'meta_value_num';
				$barcelona_params['meta_key'] = '_barcelona_vote_up';
				break;
			case 'random':
				$barcelona_params['orderby'] = 'rand';
				break;
			case 'posts':
				$barcelona_params['orderby'] = 'post__in';
				break;
			default:
				$barcelona_params['orderby'] = 'date';
		}

		$barcelona_params['order'] = ( $barcelona_opts['order'] != 'asc' ) ? 'DESC' : 'ASC';

		$barcelona_query = new WP_Query( $barcelona_params );

		$barcelona_query->fp_style = $barcelona_opts['style'];
		$barcelona_query->post_meta_choices = $barcelona_opts['post_meta_choices'];
		$barcelona_query->prevent_duplication = array_key_exists( 'prevent_duplication', $barcelona_opts ) ? $barcelona_opts['prevent_duplication'] : 'off';

		return $barcelona_query;

	}
}

/*
 * Get youtube video thumbnail
 */
if ( ! function_exists( 'barcelona_get_youtube_video_thumbnail' ) ) {
	function barcelona_get_youtube_video_thumbnail( $embed_code, $thumbnail_size = 'full' ) {

		if ( is_string( $embed_code ) && ! empty( $embed_code ) ) {

			preg_match( '#youtube\.com\/embed\/(.*)?(\/|\")?#is', $embed_code, $barcelona_match );

			if( is_array( $barcelona_match ) && ! empty( $barcelona_match ) ) {

				$barcelona_match = explode( '?', rtrim( end( $barcelona_match ), '"/' ) );

				if ( in_array( $thumbnail_size, array( 'thumbnail' ) ) ) {
					$barcelona_yt_thumb_name = 'default';
				} else if ( in_array( $thumbnail_size, array( 'medium', 'barcelona-sq', 'barcelona-xs' ) ) ) {
					$barcelona_yt_thumb_name = 'mqdefault';
				} else if ( in_array( $thumbnail_size, array( 'barcelona-sm' ) ) ) {
					$barcelona_yt_thumb_name = 'hqdefault';
				} else if ( in_array( $thumbnail_size, array( 'large', 'barcelona-md', 'barcelona-md-vertical' ) ) ) {
					$barcelona_yt_thumb_name = 'sddefault';
				} else {
					$barcelona_yt_thumb_name = 'maxresdefault';
				}

				return 'https://i.ytimg.com/vi/'. $barcelona_match[0] .'/'. $barcelona_yt_thumb_name .'.jpg';

			}

		}

		return null;

	}
}

/*
 * Is Woocommerce pages
 */
if ( ! function_exists( 'barcelona_is_woocommerce' ) ) {
	function barcelona_is_woocommerce() {

		if ( class_exists( 'Woocommerce' ) && ( is_woocommerce() || is_cart() || is_account_page() || is_order_received_page() || is_checkout() ) ) {
			return true;
		} else {
			return false;
		}

	}
}