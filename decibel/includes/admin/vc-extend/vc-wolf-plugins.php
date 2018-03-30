<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( class_exists( 'Wolf_Facebook_Page_Box' ) ) {
	// Facebook Box Shortcode
	vc_map(
		array(
			'name' => 'Facebook Page Box',
			'base' => 'wolf_facebook_page_box',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-facebook',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Page URL', 'wolf' ),
					'param_name' => 'page_url',
					'description' => '',
					'value' => 'https://www.facebook.com/facebook',
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Height', 'wolf' ),
					'param_name' => 'height',
					'description' => '',
					'value' => 400,
				),

				array(
					'type' => 'checkbox',
					'holder' => 'div',
					'class' => '',
					//'heading' => __( 'Hide Cover', 'wolf' ),
					'param_name' => 'hide_cover',
					'description' => '',
					'value' => array( __( 'Hide Cover', 'wolf' ) => true ),
				),

				array(
					'type' => 'checkbox',
					'holder' => 'div',
					'class' => '',
					//'heading' => __( 'Show posts', 'wolf' ),
					'param_name' => 'show_posts',
					'description' => '',
					'value' => array( __( 'Show posts', 'wolf' ) => true ),
				),

				array(
					'type' => 'checkbox',
					'holder' => 'div',
					'class' => '',
					//'heading' => __( 'Show faces', 'wolf' ),
					'param_name' => 'show_faces',
					'description' => '',
					'value' => array( __( 'Show faces', 'wolf' ) => true ),
				),
			)
		)
	);
}

if ( class_exists( 'Wolf_Twitter' ) ) {
	// Twitter Shortcode
	vc_map(
		array(
			'name' => __( 'Last tweets', 'wolf' ),
			'base' => 'wolf_tweet',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-twitter',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Username', 'wolf' ),
					'param_name' => 'username',
					'description' => '',
					'value' => '',
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Type', 'wolf' ),
					'param_name' => 'type',
					'description' => '',
					'value' => array(
						__( 'single', 'wolf' ) => 'single',
						__( 'list', 'wolf' ) => 'list',
					),
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => '',
					'dependency' => array( 'element' => 'type', 'value' => array( 'list' ) ),
				),
			)
		)
	);
}

if ( class_exists( 'Wolf_Dribbble' ) ) {
	// Dribbble Shortcode
	vc_map(
		array(
			'name' => __( 'Last Dribbbles', 'wolf' ),
			'base' => 'wolf_dribbble',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-dribbble',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Player ID', 'wolf' ),
					'param_name' => 'player_id',
					'description' => '',
					'value' => '',
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => '',
				),
			)
		)
	);
}

if ( class_exists( 'Wolf_Instagram' ) ) {
	// Instagram Shortcode
	vc_map(
		array(
			'name' => __( 'Last Grams', 'wolf' ),
			'base' => 'wolfgram_gallery',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-instagram',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => '',
				),
			)
		)
	);
}

if ( class_exists( 'Wolf_Portfolio' ) ) {
	// Portfolio Shortcode
	vc_map(
		array(
			'name' => __( 'Last works', 'wolf' ),
			'base' => 'wolf_last_posts_work',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-works',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Columns', 'wolf' ),
					'param_name' => 'layout',
					'description' => '',
					'value' => array(
						__( 'classic', 'wolf' ) => 'classic',
						__( 'grid', 'wolf' ) => 'grid',
						__( 'square grid', 'wolf' ) => 'grid-square',
						//__( 'masonry', 'wolf' ) => 'masonry',
						__( 'modern', 'wolf' ) => 'modern',
					),
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => 3,
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Columns', 'wolf' ),
					'param_name' => 'col',
					'description' => '',
					'value' => array( 3,2,4 ),
					'dependency' => array(
						'element' => 'layout', 'value' => array( 'classic', 'grid', 'grid-square', 'masonry' )
					),
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Display in carousel', 'wolf' ),
					'param_name' => 'carousel',
					'description' => '',
					'value' => array(
						__( 'No', 'wolf' ) => '',
						__( 'Yes', 'wolf' ) => 'yes',
					),
					'dependency' => array( 'element' => 'layout', 'value' => array( 'grid', 'grid-square' ) ),
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Padding', 'wolf' ),
					'param_name' => 'padding',
					'value' => array(
						__( 'yes', 'wolf' ) => 'yes',
						__( 'no', 'wolf' ) => 'no',
					),
					'dependency' => array( 'element' => 'layout', 'value' => array( 'classic', 'grid', 'grid-square', 'masonry' ) ),
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Category', 'wolf' ),
					'param_name' => 'category',
					'description' => __( 'Include only one or several categories. Paste category slug(s) separated by a comma', 'wolf' ),
					'value' => '',
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Animation', 'wolf' ),
					'description' => '',
					'param_name' => 'animation',
					'value' => $animations,
					'description' => '',
				),
			)
		)
	);
}

if ( class_exists( 'Wolf_Videos' ) ) {
	// Video Shortcode
	vc_map(
		array(
			'name' => __( 'Last videos', 'wolf' ),
			'base' => 'wolf_last_posts_video',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-videos',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => 4,
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Columns', 'wolf' ),
					'param_name' => 'col',
					'description' => '',
					'value' => array( 4,3,2 ),
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Category', 'wolf' ),
					'param_name' => 'category',
					'description' => __( 'Include only one or several categories. Paste category slug(s) separated by a comma', 'wolf' ),
					'value' => '',
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Padding', 'wolf' ),
					'param_name' => 'padding',
					'value' => array(
						__( 'yes', 'wolf' ) => 'yes',
						__( 'no', 'wolf' ) => 'no',
					),
					'dependency' => array( 'element' => 'layout', 'value' => array( 'classic', 'grid', 'grid-square', 'masonry' ) ),
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Animation', 'wolf' ),
					'description' => '',
					'param_name' => 'animation',
					'value' => $animations,
					'description' => '',
				),
			)
		)
	);

	vc_map(
		array(
			'name' => __( 'Videos carousel', 'wolf' ),
			'base' => 'wolf_last_videos_carousel',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-videos',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => 4,
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Category', 'wolf' ),
					'param_name' => 'category',
					'description' => __( 'Include only one or several categories. Paste category slug(s) separated by a comma', 'wolf' ),
					'value' => '',
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Inline style', 'wolf' ),
					'param_name' => 'inline_style',
					'description' => __( 'Additional inline CSS style', 'wolf' ),
					'value' => '',
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Extra class', 'wolf' ),
					'param_name' => 'class',
					'description' => __( 'Optional additional CSS class to add to the element', 'wolf' ),
					'value' => '',
				),
			)
		)
	);
}

if ( class_exists( 'Wolf_Albums' ) ) {
	// Albums Shortcode
	vc_map(
		array(
			'name' => __( 'Last galleries', 'wolf' ),
			'base' => 'wolf_last_albums',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-albums',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => 4,
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Columns', 'wolf' ),
					'param_name' => 'col',
					'description' => '',
					'value' => array( 4,3,2 ),
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Category', 'wolf' ),
					'param_name' => 'category',
					'description' => __( 'Include only one or several categories. Paste category slug(s) separated by a comma', 'wolf' ),
					'value' => '',
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Animation', 'wolf' ),
					'description' => '',
					'param_name' => 'animation',
					'value' => $animations,
					'description' => '',
				),

			)
		)
	);

	// Last Photos Shortcode
	vc_map(
		array(
			'name' => __( 'Last photos widget', 'wolf' ),
			'base' => 'wolf_last_photos_widget',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-albums',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => 4,
				),
			)
		)
	);
}

if ( class_exists( 'Wolf_jPlayer' ) ) {

	global $wpdb;
	$wolf_jplayer_playlists_table = esc_sql( $wpdb->prefix . 'wolf_jplayer_playlists' );

	$playlists = $wpdb->get_results( "SELECT * FROM $wolf_jplayer_playlists_table" );

	$args = array();

	if ( $playlists ) {

		$args = array(
			'name' => 'jPlayer',
			'base' => 'wolf_jplayer_playlist',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-jplayer',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Playlist', 'wolf' ),
					'param_name' => 'id',
					'description' => '',
					'value' => array(),
				),
			)
		);

		foreach ( $playlists as $p ) {
			$args['params'][0]['value'][ $p->name ] = $p->id;
		}

	} else {
		$args = array(
			'name' => 'jPlayer',
			'base' => 'wolf_jplayer_playlist',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-jplayer',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Playlist', 'wolf' ),
					'param_name' => 'id',
					'description' => '',
					'value' => array( __( 'No playlist created yet', 'wolf' ) => 0 ),
				),
			)
		);
	}

	// jPlayer Shortcode
	vc_map( $args );
}

if ( class_exists( 'Wolf_Music_Network' ) ) {
	vc_map(
		array(
			'name' => 'Music network',
			'base' => 'wolf_music_network',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-music-network',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Height', 'wolf' ),
					'param_name' => 'height',
					'description' => '',
					'value' => 32,
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Alignment', 'wolf' ),
					'param_name' => 'align',
					'description' => '',
					'value' => array(
						__( 'Centered', 'wolf' ) => 'center',
						__( 'Left', 'wolf' ) => 'left',
						__( 'Right', 'wolf' ) => 'right',
					),
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Services', 'wolf' ),
					'param_name' => 'services',
					'value' => '',
					'description' => 'separated by a comma (empty for all)'
				),

			)
		)
	);
}

if ( class_exists( 'Wolf_Tour_Dates' ) ) {
	vc_map(
		array(
			'name' => __( 'Tour Dates', 'wolf' ),
			'base' => 'wolf_tour_dates',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-tour-dates',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => 10,
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Link to single show page', 'wolf' ),
					'param_name' => 'link',
					'description' => '',
					'value' => array(
						__( 'No', 'wolf' ) => 'false',
						__( 'Yes', 'wolf' ) => 'true',
					),
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Display Past Shows', 'wolf' ),
					'param_name' => 'past',
					'description' => '',
					'value' => array(
						__( 'No', 'wolf' ) => 'false',
						__( 'Yes', 'wolf' ) => 'true',
					),
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Artist slug', 'wolf' ),
					'param_name' => 'artist',
					'description' => '',
					'value' => '',
				),
			)
		)
	);

	vc_map(
		array(
			'name' => __( 'Upcoming Shows Widget', 'wolf' ),
			'base' => 'wolf_upcoming_shows_widget',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-tour-dates',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => 10,
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Artist slug', 'wolf' ),
					'param_name' => 'artist',
					'description' => '',
					'value' => '',
				),
			)
		)
	);
}

if ( class_exists( 'Wolf_Discography' ) ) {
	// Discography Shortcode
	vc_map(
		array(
			'name' => __( 'Last releases', 'wolf' ),
			'base' => 'wolf_last_posts_release',
			'category' => 'by WolfThemes',
			'icon' => 'wolf-vc-icon wolf-vc-releases',
			'allowed_container_element' => 'vc_row',
			'params' => array(

				/*array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Layout', 'wolf' ),
					'param_name' => 'layout',
					'description' => '',
					'value' => array(
						__( 'grid', 'wolf' ) => 'grid',
						__( 'classic', 'wolf' ) => 'classic',
					),
				),*/

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Count', 'wolf' ),
					'param_name' => 'count',
					'description' => '',
					'value' => 3,
				),

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Columns', 'wolf' ),
					'param_name' => 'col',
					'description' => '',
					'value' => array( 3,2,4 ),
				),

				/*array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Display in carousel', 'wolf' ),
					'param_name' => 'carousel',
					'description' => '',
					'value' => array(
						__( 'No', 'wolf' ) => '',
						__( 'Yes', 'wolf' ) => 'yes',
					),
				),*/

				array(
					'type' => 'dropdown',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Padding', 'wolf' ),
					'param_name' => 'padding',
					'value' => array(
						__( 'yes', 'wolf' ) => 'yes',
						__( 'no', 'wolf' ) => 'no',
					),
					'dependency' => array( 'element' => 'layout', 'value' => array( 'classic', 'grid', 'grid-square', 'masonry' ) ),
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Label', 'wolf' ),
					'param_name' => 'label',
					'description' => __( 'Include only one or several categories. Paste category slug(s) separated by a comma', 'wolf' ),
					'value' => '',
				),

				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Band', 'wolf' ),
					'param_name' => 'band',
					'description' => __( 'Include only one or several categories. Paste category slug(s) separated by a comma', 'wolf' ),
					'value' => '',
				),

			)
		)
	);
}
