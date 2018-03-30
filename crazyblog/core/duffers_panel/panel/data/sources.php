<?php

/**
 * Here is the place to put your own defined function that serve as
 * datasource to field with multiple options.
 */
function vp_get_menus() {
	$items = wp_get_nav_menu_items( 'primary-menu' );
	$menus = wp_get_nav_menus();
	$menu_locations = get_nav_menu_locations();
	$location_id = 'primary-menu';

	if ( isset( $menu_locations[$location_id] ) ) {
		foreach ( $menus as $menu ) {
			if ( $menu->term_id == $menu_locations[$location_id] ) {
				$menu_items = wp_get_nav_menu_items( $menu );
				break;
			}
		}
	} else {
		// The location that you're trying to search doesn't exist
	}

	$result = array();
	if ( !empty( $menu_items ) ) {
		foreach ( $menu_items as $item ) {
			if ( crazyblog_set( $item, 'menu_item_parent' ) == 0 ) {
				$result[] = array( 'value' => $item->ID, 'label' => $item->title );
			}
		}
	}
	return $result;
}

function vp_get_categories() {
	$wp_cat = get_categories( array( 'hide_empty' => 0 ) );
	$result = array();
	$result[] = array( 'value' => 'all', 'label' => esc_html__( 'All Categories', 'crazyblog' ) );
	foreach ( $wp_cat as $cat ) {
		$result[] = array( 'value' => $cat->cat_ID, 'label' => $cat->name );
	}
	return $result;
}

function vp_get_users() {
	$wp_users = VP_WP_User::get_users();
	$result = array();
	foreach ( $wp_users as $user ) {
		$result[] = array( 'value' => $user['id'], 'label' => $user['display_name'] );
	}
	return $result;
}

function vp_get_posts() {
	$wp_posts = get_posts( array(
		'posts_per_page' => -1,
			) );
	$result = array();
	foreach ( $wp_posts as $post ) {
		$result[] = array( 'value' => $post->ID, 'label' => $post->post_title );
	}
	return $result;
}

function vp_get_posts_custom() {
	if ( function_exists( 'crazyblog_blog_post_types_setup' ) ) {
		$args = array(
			'post_type' => 'blog_profile',
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);
		$result = array();
		$my_query = null;
		$my_query = new WP_Query( $args );
		if ( $my_query->have_posts() ) {
			foreach ( $my_query->posts as $key => $value ):
				$result[] = array( 'value' => $value->ID, 'label' => $value->post_title );
			endforeach;
		}
		return $result;
		wp_reset_postdata();
	}else {
		$result[] = array( 'value' => 'note', 'label' => 'Please Activate (Blog Post Type) Plugin' );
		return $result;
	}
}

function vp_get_pages() {
	$wp_pages = get_pages();
	$result = array();
	foreach ( $wp_pages as $page ) {
		$result[] = array( 'value' => $page->ID, 'label' => $page->post_title );
	}
	return $result;
}

function vp_get_tags() {
	$wp_tags = get_tags( array( 'hide_empty' => 0 ) );
	$result = array();
	foreach ( $wp_tags as $tag ) {
		$result[] = array( 'value' => $tag->term_id, 'label' => $tag->name );
	}
	return $result;
}

function vp_get_roles() {
	$result = array();
	$editable_roles = VP_WP_User::get_editable_roles();
	foreach ( $editable_roles as $key => $role ) {
		$result[] = array( 'value' => $key, 'label' => $role['name'] );
	}
	return $result;
}

function vp_get_gwf_family() {
	$fonts = wp_remote_get( crazyblog_URI . 'core/duffers_panel/panel/data/gwf.json', array( 'timeout' => 120, 'httpversion' => '1.1' ) );
	$get_fonts = crazyblog_set( $fonts, 'body' );
	$fonts = json_decode( $get_fonts );
	$fonts = array_keys( get_object_vars( $fonts ) );
	foreach ( $fonts as $font ) {
		$result[] = array( 'value' => $font, 'label' => $font );
	}
	return $result;
}

VP_Security::instance()->whitelist_function( 'vp_get_gwf_weight' );

function vp_get_gwf_weight( $face ) {
	if ( empty( $face ) )
		return array();
	$fonts = wp_remote_get( crazyblog_URI . 'core/duffers_panel/panel/data/gwf.json' );
	$get_fonts = crazyblog_set( $fonts, 'body' );
	$fonts = json_decode( $get_fonts );
	$weights = $fonts->{$face}->weights;
	foreach ( $weights as $weight ) {
		$result[] = array( 'value' => $weight, 'label' => $weight );
	}
	return $result;
}

VP_Security::instance()->whitelist_function( 'vp_get_gwf_style' );

function vp_get_gwf_style( $face ) {
	if ( empty( $face ) )
		return array();
	$fonts = wp_remote_get( crazyblog_URI . 'core/duffers_panel/panel/data/gwf.json' );
	$get_fonts = crazyblog_set( $fonts, 'body' );
	$fonts = json_decode( $get_fonts );
	$styles = $fonts->{$face}->styles;
	foreach ( $styles as $style ) {
		$result[] = array( 'value' => $style, 'label' => $style );
	}
	return $result;
}

function vp_get_social_medias() {
	$socmeds = array(
		array( 'value' => 'facebook', 'label' => 'Facebook' ),
		array( 'value' => 'twitter', 'label' => 'Twitter' ),
		array( 'value' => 'gplus', 'label' => 'Google+' ),
		array( 'value' => 'digg', 'label' => 'Digg' ),
		array( 'value' => 'reddit', 'label' => 'Reddit' ),
		array( 'value' => 'linkedin', 'label' => 'LinkedIn' ),
		array( 'value' => 'pinterest', 'label' => 'Pinterest' ),
		array( 'value' => 'stumbleupon', 'label' => 'StumbleUpon' ),
		array( 'value' => 'tumblr', 'label' => 'Tumblr' ),
		array( 'value' => 'email', 'label' => 'Email' ),
	);
	return $socmeds;
}

function vp_get_fontawesome_icons() {
	// scrape list of icons from fontawesome css
	if ( false === ( $icons = get_transient( 'vp_get_fontawesome_icons' ) ) ) {
		$pattern = '/\.(fa-(?:\w+(?:-)?)+):before/';
		$subject = wp_remote_get( crazyblog_URI . 'core/duffers_panel/panel/public/css/vendor/font-awesome.min.css' );
		preg_match_all( $pattern, crazyblog_set( $subject, 'body' ), $matches, PREG_SET_ORDER );
		$icons = array();
		foreach ( $matches as $match ) {
			//printr($matches);
			$icons[] = array( 'value' => 'fa ' . $match[1], 'label' => 'fa ' . $match[1] );
		}
		set_transient( 'vp_fontawesome_icons', $icons, 60 * 60 * 24 );
	}
	return $icons;
}

function vp_get_flate_icons() {
	// scrape list of icons from fontawesome css
	if ( false === ( $icons = get_transient( 'vp_get_flate_icons' ) ) ) {
		$pattern = '/\.(flaticon-(?:\w+(?:-)?)+):before\s*{\s*content/';
		$subject = wp_remote_get( crazyblog_URI . 'core/duffers_panel/panel/public/css/flaticon.css' );
		preg_match_all( $pattern, crazyblog_set( $subject, 'body' ), $matches, PREG_SET_ORDER );
		$icons = array();
		foreach ( $matches as $match ) {
			$clone = str_replace( 'flaticon-', '', $match[1] );
			$icons[] = array( 'value' => $match[1], 'label' => ucwords( $clone ) );
		}
		set_transient( 'vp_flaticon_icons', $icons, 60 * 60 * 24 );
	}
	return $icons;
}

function fw_get_languages( $lang_dir = '' ) {
	$directory = wp_get_theme()->DomainPath;
	$dir = ( $lang_dir ) ? $lang_dir : Shineblog_LANG_DIR;
	$data = @scandir( $dir );
	if ( !$data )
		return array();
	if ( $data && is_array( $data ) )
		unset( $data[0], $data[1] );
	$return = array();
	foreach ( $data as $d ) {
		if ( substr( $d, -3 ) == '.mo' ) {
			$name = substr( $d, 0, (strlen( $d ) - 3 ) );
			$return[] = array( 'value' => $name, 'label' => $name );
		}
	}
	return $return;
}

VP_Security::instance()->whitelist_function( 'vp_dep_boolean' );

function vp_dep_boolean( $value = null ) {
	$args = func_get_args();
	$result = true;
	foreach ( $args as $val ) {
		$result = ($result and ! empty( $val ));
	}
	return $result;
}

function crazyblog_time_zone() {
	if ( false === ( $timezone = get_transient( 'crazyblog_time_zone' ) ) ) {
		$timezone = array(
			array( 'value' => '-12', 'label' => 'International Date Line West' ),
			array( 'value' => '-11', 'label' => 'Coordinated Universal Time-11' ),
			array( 'value' => '-10', 'label' => 'Hawaii' ),
			array( 'value' => '-9', 'label' => 'Alaska' ),
			array( 'value' => '-8', 'label' => 'Baja California' ),
			array( 'value' => '-8', 'label' => 'Pacific Time(US & Canada)' ),
			array( 'value' => '-7', 'label' => 'Arizona' ),
			array( 'value' => '-7', 'label' => 'Chihuahua, La Paz, Mazatlan' ),
			array( 'value' => '-7', 'label' => 'Mountain Time (US & Canada)' ),
			array( 'value' => '-6', 'label' => 'Central America' ),
			array( 'value' => '-6', 'label' => 'Central Time (US & Canada)' ),
			array( 'value' => '-6', 'label' => 'Guadalajara, Mexico City, Monterrey' ),
			array( 'value' => '-6', 'label' => 'Saskatchewan' ),
			array( 'value' => '-5', 'label' => 'Bogota, Lima, Quito, Rio Branco' ),
			array( 'value' => '-5', 'label' => 'Eastern Time (US & Canada)' ),
			array( 'value' => '-5', 'label' => 'Indiana (East)' ),
			array( 'value' => '-4.30', 'label' => 'Caracas' ),
			array( 'value' => '-4', 'label' => 'Asuncion' ),
			array( 'value' => '-4', 'label' => 'Atlantic Time (Canada)' ),
			array( 'value' => '-4', 'label' => 'Cuiaba' ),
			array( 'value' => '-4', 'label' => 'Georgetown, LA PAZ Manaus, San Juan' ),
			array( 'value' => '-4', 'label' => 'Santiago' ),
			array( 'value' => '-3.30', 'label' => 'Newfoundland' ),
			array( 'value' => '-3', 'label' => 'Brasilia' ),
			array( 'value' => '-3', 'label' => 'Busenos Aires' ),
			array( 'value' => '-3', 'label' => 'Cayenne, Fortaleza' ),
			array( 'value' => '-3', 'label' => 'Greenland' ),
			array( 'value' => '-3', 'label' => 'Mountevideo' ),
			array( 'value' => '-3', 'label' => 'Salvador' ),
			array( 'value' => '-2', 'label' => 'Coordinated Universal Time-02' ),
			array( 'value' => '-1', 'label' => 'Azores' ),
			array( 'value' => '-1', 'label' => 'Cape Verde Is.' ),
			array( 'value' => '0', 'label' => 'Casablanca' ),
			array( 'value' => '0', 'label' => 'Coordinated Universal Time' ),
			array( 'value' => '0', 'label' => 'Dublin, Edinburgh, Lisbon, London' ),
			array( 'value' => '0', 'label' => 'Monrovia, Reykjavik' ),
			array( 'value' => '+1', 'label' => 'Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna' ),
			array( 'value' => '+1', 'label' => 'Belgrade, Bratislava, Budapest, Ljubljana, Prague' ),
			array( 'value' => '+1', 'label' => 'Brussels, Copenhagen, Madrid, Paris' ),
			array( 'value' => '+1', 'label' => 'Sarajevo, Skopje, Warsaw, Zagreb' ),
			array( 'value' => '+1', 'label' => 'West Central Africa' ),
			array( 'value' => '+1', 'label' => 'Windhoek' ),
			array( 'value' => '+2', 'label' => 'Amman' ),
			array( 'value' => '+2', 'label' => 'Athens, Bucharest' ),
			array( 'value' => '+2', 'label' => 'Beirut' ),
			array( 'value' => '+2', 'label' => 'Cairo' ),
			array( 'value' => '+2', 'label' => 'Damascus' ),
			array( 'value' => '+2', 'label' => 'E. Europe' ),
			array( 'value' => '+2', 'label' => 'Harare, Pretoria' ),
			array( 'value' => '+2', 'label' => 'Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius' ),
			array( 'value' => '+2', 'label' => 'Istanbul' ),
			array( 'value' => '+2', 'label' => 'Jerusalem' ),
			array( 'value' => '+2', 'label' => 'Tripoli' ),
			array( 'value' => '+3', 'label' => 'Baghdad' ),
			array( 'value' => '+3', 'label' => 'Kaliningrad, Minsk' ),
			array( 'value' => '+3', 'label' => 'Kuwait, Riyadh' ),
			array( 'value' => '+3', 'label' => 'Nairobi' ),
			array( 'value' => '+3', 'label' => 'Tehran' ),
			array( 'value' => '+4', 'label' => 'Abu Dhabi, Muscat' ),
			array( 'value' => '+4', 'label' => 'Baku' ),
			array( 'value' => '+4', 'label' => 'Moscow, St. Petersburg, Volgograd' ),
			array( 'value' => '+4', 'label' => 'Port Louis' ),
			array( 'value' => '+4', 'label' => 'Tbilisi' ),
			array( 'value' => '+4', 'label' => 'Yerevan' ),
			array( 'value' => '+4.30', 'label' => 'Kabul' ),
			array( 'value' => '+5', 'label' => 'Ashgabat, Tashkent' ),
			array( 'value' => '+5', 'label' => 'Islamabad, Karachi' ),
			array( 'value' => '+5.30', 'label' => 'Chennai, Kolkata, Mumbai, New Delhi' ),
			array( 'value' => '+5.30', 'label' => 'Sri Jayawardenepura' ),
			array( 'value' => '+5.45', 'label' => 'Kathmandu' ),
			array( 'value' => '+6', 'label' => 'Astana' ),
			array( 'value' => '+6', 'label' => 'Dhaka' ),
			array( 'value' => '+6', 'label' => 'Ekaterinburg' ),
			array( 'value' => '+6.30', 'label' => 'Yangon (Rangoon)' ),
			array( 'value' => '+7', 'label' => 'Bangkok, Henoi, Jakarta' ),
			array( 'value' => '+7', 'label' => 'Novosibirsk' ),
			array( 'value' => '+8', 'label' => 'Beijing, Chongqing, Hong Kong, Urumqi' ),
			array( 'value' => '+8', 'label' => 'Krasnoyarsk' ),
			array( 'value' => '+8', 'label' => 'Kuala Lumpur, Singapore' ),
			array( 'value' => '+8', 'label' => 'Perth' ),
			array( 'value' => '+8', 'label' => 'Taipei' ),
			array( 'value' => '+8', 'label' => 'Ulaanbaatar' ),
			array( 'value' => '+9', 'label' => 'Lrkutsk' ),
			array( 'value' => '+9', 'label' => 'Osaka, Sapporo, Tokyo' ),
			array( 'value' => '+9', 'label' => 'Seoul' ),
			array( 'value' => '+9.30', 'label' => 'Adelaide' ),
			array( 'value' => '+9.30', 'label' => 'Darwin' ),
			array( 'value' => '+10', 'label' => 'Brisbane' ),
			array( 'value' => '+10', 'label' => 'Canberra, Melbourne, Sydney' ),
			array( 'value' => '+10', 'label' => 'Guam, Port Moresby' ),
			array( 'value' => '+10', 'label' => 'Hobart' ),
			array( 'value' => '+10', 'label' => 'Yekutsk' ),
			array( 'value' => '+11', 'label' => 'Solomon Is., New Caledonia' ),
			array( 'value' => '+11', 'label' => 'Vladivostok' ),
			array( 'value' => '+12', 'label' => 'Auckland, Wellington' ),
			array( 'value' => '+12', 'label' => 'Coordinated Universal Time+12' ),
			array( 'value' => '+12', 'label' => 'Fiji' ),
			array( 'value' => '+12', 'label' => 'Magadan' ),
			array( 'value' => '+13', 'label' => 'Nuku\'alofa' ),
			array( 'value' => '+13', 'label' => 'Samoa' ),
			array( 'value' => '+14', 'label' => 'Kiritimati Island' ),
		);
	}
	set_transient( 'crazyblog_time_zone', $timezone, 60 * 60 * 24 );
	$new_zone = array();
	foreach ( $timezone as $key => $value ) {
		$new_zone[] = array( 'value' => crazyblog_set( $value, 'value' ) . ' ' . crazyblog_set( $value, 'label' ), 'label' => crazyblog_set( $value, 'value' ) . ' ' . crazyblog_set( $value, 'label' ) );
	}
	return $new_zone;
}

VP_Security::instance()->whitelist_function( 'megamenu_post_carousel_type' );

function megamenu_post_carousel_type( $value ) {
	if ( $value === 'megamenu-style3' )
		return true;

	return false;
}

VP_Security::instance()->whitelist_function( 'megamenu_post_carousel_post_number' );

function megamenu_post_carousel_post_number( $value ) {
	if ( $value === 'carousel-recent-posts' || $value === 'carousel-popular-posts' )
		return true;

	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_megamenu_position_left' );

function vp_dep_megamenu_position_left( $value ) {
	if ( $value === 'left' || $value === 'center' )
		return true;

	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_megamenu_position_right' );

function vp_dep_megamenu_position_right( $value ) {
	if ( $value === 'right' )
		return true;

	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_show_tab_section' );

function vp_dep_show_tab_section( $value ) {
	if ( $value === 'megamenu-style2' )
		return true;

	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_number_of_column' );

function vp_dep_number_of_column( $value ) {
	if ( $value === 'megamenu-style1' )
		return true;

	return false;
}

VP_Security::instance()->whitelist_function( 'vp_header_upper_carousel' );

function vp_header_upper_carousel( $value ) {
	if ( $value === 'carousel' )
		return true;

	return false;
}

VP_Security::instance()->whitelist_function( 'vp_header_upper_video' );

function vp_header_upper_video( $value ) {
	if ( $value === 'video' )
		return true;

	return false;
}

// start header 3
VP_Security::instance()->whitelist_function( 'vp_dep_header_3' );

function vp_dep_header_3( $value ) {
	if ( $value === 'header_3' )
		return true;

	return false;
}

// start header 4
VP_Security::instance()->whitelist_function( 'vp_dep_header_4' );

function vp_dep_header_4( $value ) {
	if ( $value === 'header_4' )
		return true;

	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_show_light_option' );

function vp_dep_show_light_option( $value ) {
	if ( $value === 'simple-header' || $value === 'simple-header simpleheader2' )
		return true;

	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_show_social_option' );

function vp_dep_show_social_option( $value ) {
	if ( $value === 'simple-header' || $value === 'transparent-header' )
		return true;

	return false;
}

function crazyblog_adSizes() {
	$size = array(
		array( 'value' => '', 'label' => esc_html__( 'Auto', 'crazyblog' ) ),
		array( 'value' => '120x90', 'label' => '120 x 90' ),
		array( 'value' => '120x240', 'label' => '120 x 240' ),
		array( 'value' => '120x600', 'label' => '120 x 600' ),
		array( 'value' => '125x125', 'label' => '125 x 125' ),
		array( 'value' => '160x90', 'label' => '160 x 90' ),
		array( 'value' => '160x600', 'label' => '160 x 600' ),
		array( 'value' => '180x90', 'label' => '180 x 90' ),
		array( 'value' => '180x150', 'label' => '180 x 150' ),
		array( 'value' => '200x90', 'label' => '200 x 90' ),
		array( 'value' => '200x200', 'label' => '200 x 200' ),
		array( 'value' => '234x60', 'label' => '234 x 60' ),
		array( 'value' => '250x250', 'label' => '250 x 250' ),
		array( 'value' => '320x100', 'label' => '320 x 100' ),
		array( 'value' => '300x250', 'label' => '300 x 250' ),
		array( 'value' => '300x600', 'label' => '300 x 600' ),
		array( 'value' => '300x1050', 'label' => '300 x 1050' ),
		array( 'value' => '320x50', 'label' => '320 x 50' ),
		array( 'value' => '336x280', 'label' => '336 x 280' ),
		array( 'value' => '360x300', 'label' => '360 x 300' ),
		array( 'value' => '435x300', 'label' => '435 x 300' ),
		array( 'value' => '468x15', 'label' => '468 x 15' ),
		array( 'value' => '468x60', 'label' => '468 x 60' ),
		array( 'value' => '640x165', 'label' => '640 x 165' ),
		array( 'value' => '640x190', 'label' => '640 x 190' ),
		array( 'value' => '640x300', 'label' => '640 x 300' ),
		array( 'value' => '728x15', 'label' => '728 x 15' ),
		array( 'value' => '728x90', 'label' => '728 x 90' ),
		array( 'value' => '970x90', 'label' => '970 x 90' ),
		array( 'value' => '970x250', 'label' => '970 x 250' ),
		array( 'value' => '240x400', 'label' => '240 x 400 - ' . esc_html__( 'Regional ad sizes', 'crazyblog' ) ),
		array( 'value' => '250x360', 'label' => '250 x 360 - ' . esc_html__( 'Regional ad sizes', 'crazyblog' ) ),
		array( 'value' => '580x400', 'label' => '580 x 400 - ' . esc_html__( 'Regional ad sizes', 'crazyblog' ) ),
		array( 'value' => '750x100', 'label' => '750 x 100 - ' . esc_html__( 'Regional ad sizes', 'crazyblog' ) ),
		array( 'value' => '750x200', 'label' => '750 x 200 - ' . esc_html__( 'Regional ad sizes', 'crazyblog' ) ),
		array( 'value' => '750x300', 'label' => '750 x 300 - ' . esc_html__( 'Regional ad sizes', 'crazyblog' ) ),
		array( 'value' => '980x120', 'label' => '980 x 120 - ' . esc_html__( 'Regional ad sizes', 'crazyblog' ) ),
		array( 'value' => '930x180', 'label' => '930 x 180 - ' . esc_html__( 'Regional ad sizes', 'crazyblog' ) ),
	);
	return apply_filters( 'adsSizes', $size );
}
