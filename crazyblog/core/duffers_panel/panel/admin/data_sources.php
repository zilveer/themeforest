<?php

VP_Security::instance()->whitelist_function( 'crazyblog_dep_pb_dropdown' );

function crazyblog_dep_pb_dropdown( $value ) {
	if ( $value == 'select' )
		return true;
	else
		return false;
}

VP_Security::instance()->whitelist_function( 'crazyblog_dep_pb_checkbox' );

function crazyblog_dep_pb_checkbox( $value ) {
	if ( $value == 'checkbox' )
		return true;
	else
		return false;
}

VP_Security::instance()->whitelist_function( 'crazyblog_dep_pb_radio' );

function crazyblog_dep_pb_radio( $value ) {
	if ( $value == 'radio' )
		return true;
	else
		return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_logo' );

function vp_dep_is_logo( $value ) {
	if ( $value === 'image' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_text' );

function vp_dep_is_text( $value ) {
	if ( $value === 'text' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'sh_vp_pages_list' );

function sh_vp_pages_list() {
	$return = array();
	$pages = get_pages();
	foreach ( $pages as $page ) {
		$return[] = array( 'value' => $page->ID, 'label' => $page->post_title );
	}
	return $return;
}

VP_Security::instance()->whitelist_function( 'vp_copy_content' );

function vp_copy_content( $value, $value2 ) {
	$args = func_get_args();
	return implode( '', $args );
}

VP_Security::instance()->whitelist_function( 'vp_simple_shortcode' );

function vp_simple_shortcode( $name = "", $url = "", $image = "" ) {
	if ( is_null( $name ) )
		$name = '';
	if ( is_null( $url ) )
		$url = '';
	if ( is_null( $image ) )
		$image = '';
	$result = "[shortcode name='$name' url='$url' image='$image']";
	return $result;
}

VP_Security::instance()->whitelist_function( 'vp_post_type' );

function vp_post_type() {
	$post_type = array(
		'video',
		'audio',
		'gallery',
		'image'
	);
	$result = array();
	foreach ( $post_type as $data ) {
		$result[] = array( 'value' => $data, 'label' => $data );
	}
	return $result;
}

/* VP_Security::instance()->whitelist_function('vp_bind_bigcontinents');
  function vp_bind_bigcontinents()
  {
  $bigcontinents = array(
  'Eurafrasia',
  'America',
  'Oceania',
  );
  $result = array();
  foreach ($bigcontinents as $data)
  {
  $result[] = array('value' => $data, 'label' => $data, 'img' => 'http://placehold.it/100x100');
  }
  return $result;
  } */
VP_Security::instance()->whitelist_function( 'vp_audio_type' );

function vp_audio_type( $param = '' ) {
	$continents = array(
		'Eurafrasia' => array(
			'Africa',
			'Asia',
			'Europe'
		),
		'America' => array(
			'North America',
			'Central America and the Antilles',
			'South America'
		),
		'Oceania' => array(
			'Australasia',
			'Melanesia',
			'Micronesia',
			'Polynesia',
		),
	);
	$result = array();
	$datas = array();
	if ( is_array( $param ) )
		$param = reset( $param );
	if ( array_key_exists( $param, $continents ) )
		$datas = $continents[$param];
	foreach ( $datas as $data ) {
		$result[] = array( 'value' => $data, 'label' => $data, 'img' => 'http://placehold.it/100x100' );
	}
	return $result;
}

VP_Security::instance()->whitelist_function( 'vp_bind_countries' );

function vp_bind_countries( $param = '' ) {
	$countries = array(
		'Africa' => array(
			'Algeria',
			'Nigeria',
			'Egypt',
		),
		'Asia' => array(
			'Indonesia',
			'Malaysia',
			'China',
			'Japan',
		),
		'Europe' => array(
			'France',
			'Germany',
			'Italy',
			'Netherlands',
		),
		'North America' => array(
			'United States',
			'Mexico',
			'Canada',
		),
		'Central America and the Antilles' => array(
			'Cuba',
			'Guatemala',
			'Haiti',
		),
		'South America' => array(
			'Argentina',
			'Brazil',
			'Paraguay',
		),
		'Australasia' => array(
			'Australia',
			'New Zealand',
			'Christmas Island',
		),
		'Melanesia' => array(
			'Fiji',
			'Papua New Guinea',
			'Vanuatu',
		),
		'Micronesia' => array(
			'Guam',
			'Nauru',
			'Palau'
		),
		'Polynesia' => array(
			'American Samoa',
			'Samoa',
			'Tokelau',
		),
	);
	$result = array();
	$datas = array();
	if ( is_null( $param ) )
		$param = '';
	if ( is_array( $param ) and ! empty( $param ) )
		$param = reset( $param );
	if ( empty( $param ) )
		$param = '';
	if ( array_key_exists( $param, $countries ) )
		$datas = $countries[$param];
	foreach ( $datas as $data ) {
		$result[] = array( 'value' => $data, 'label' => $data, 'img' => 'http://placehold.it/100x100' );
	}
	return $result;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_keyword' );

function vp_dep_is_keyword( $value ) {
	if ( $value === 'keyword' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_tags' );

function vp_dep_is_tags( $value ) {
	if ( $value === 'tags' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_bind_color_accent' );

function vp_bind_color_accent( $preset ) {
	switch ( $preset ) {
		case 'red':
			return '#ff0000';
		case 'green':
			return '#00ff00';
		case 'blue':
			return '#0000ff';
		default:
			return '#000000';
	}
}

VP_Security::instance()->whitelist_function( 'vp_bind_color_subtle' );

function vp_bind_color_subtle( $preset ) {
	return vp_bind_color_accent( $preset );
}

VP_Security::instance()->whitelist_function( 'vp_bind_color_background' );

function vp_bind_color_background( $preset ) {
	return vp_bind_color_accent( $preset );
}

VP_Security::instance()->whitelist_function( 'vp_font_preview' );

function vp_font_preview( $face, $style, $color, $weight, $size ) {
	$gwf = new VP_Site_GoogleWebFont();
	$gwf->add( $face, $style, $weight );
	$links = $gwf->get_font_links();
	$link = reset( $links );
	$dom = '';
	$dom = "<link href=" . esc_url( $link ) . " rel='stylesheet' type='text/css'>
		<div class='font_preivew'><p style='padding: 0 10px 0 10px; font-family: " . $face . "; font-style: " . $style . "; color: " . $color . "; font-weight: " . $weight . "; font-size: " . $size . "px;'>";
	$dom .= esc_html__( '1 2 3 4 5 6 7 8 9 0 A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z', 'crazyblog' ) . '</p></div>';
	return $dom;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_default_color' );

function vp_dep_is_default_color( $value ) {
	if ( $value === 'default' )
		return true;
	return false;
}

//start crazyblog custom dependiencies
VP_Security::instance()->whitelist_function( 'vp_dep_header_style1' );

function vp_dep_header_style1( $value ) {
	if ( $value === 'header_style1' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_style2' );

function vp_dep_header_style2( $value ) {
	if ( $value === 'header_style2' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_style3' );

function vp_dep_header_style3( $value ) {
	if ( $value === 'header_style3' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_style4' );

function vp_dep_header_style4( $value ) {
	if ( $value === 'header_style4' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_5' );

function vp_dep_header_5( $value ) {
	if ( $value === 'header_5' )
		return true;
	return false;
}

//end
// start layout
VP_Security::instance()->whitelist_function( 'vp_dep_is_bg_pattorns' );

function vp_dep_is_bg_pattorns( $value ) {
	if ( $value === 'pat' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_bg_setting' );

function vp_dep_is_bg_setting( $value ) {
	if ( $value === 'own_bg' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_body_bg_type' );

function vp_dep_is_body_bg_type( $value ) {
	if ( $value === 'full' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_back_type' );

function vp_dep_is_back_type( $value ) {
	if ( $value === 'fixed' )
		return true;
	return false;
}

// end layout
VP_Security::instance()->whitelist_function( 'vp_dep_is_site_background' );

function vp_dep_is_site_background( $value ) {
	if ( $value === 'own_bg' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_bg_clr' );

function vp_dep_is_bg_clr( $value ) {
	if ( $value === 'clr' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_body_background' );

function vp_dep_is_body_background( $value ) {
	if ( $value === 'body_img' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_custom_color' );

function vp_dep_is_custom_color( $value ) {
	if ( $value === 'custom' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_image' );

function vp_dep_is_image( $value ) {
	if ( $value === 'image' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_1' );

function vp_dep_header_1( $value ) {
	if ( $value === 'header_1' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_2' );

function vp_dep_header_2( $value ) {
	if ( $value === 'header_2' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_own_image' );

function vp_dep_header_own_image( $value ) {
	if ( $value === 'crazyblog_own_image' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_own_image2' );

function vp_dep_header_own_image2( $value, $value2 ) {
	if ( $value === 'crazyblog_own_image' && $value2 == 'left' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_h_5' );

function vp_dep_h_5( $value ) {
	if ( $value == 'left' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_google_ad' );

function vp_dep_header_google_ad( $value ) {
	if ( $value === 'crazyblog_google_script' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_header_google_ad2' );

function vp_dep_header_google_ad2( $value, $value2 ) {
	if ( $value === 'crazyblog_google_script' && $value == 'left' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_show_footer' );

function vp_dep_show_footer( $value ) {
	if ( $value === true )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_grid' );

function vp_dep_is_grid( $value ) {
	if ( $value === 'grid' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_list' );

function vp_dep_is_list( $value ) {
	if ( $value === 'list' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_video' );

function vp_dep_video( $value ) {
	if ( $value === 'video' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_gallery' );

function vp_dep_gallery( $value ) {
	if ( $value === 'gallery' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_soundcloud' );

function vp_dep_soundcloud( $value ) {

	if ( $value === 'soundcloud' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_ownaudio' );

function vp_dep_ownaudio( $value ) {
	if ( $value === 'ownaudio' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_audio' );

function vp_dep_audio( $value ) {
	if ( $value === 'audio' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_sidebar_boolean' );

function vp_dep_sidebar_boolean( $value ) {
	if ( $value === 'left' || $value === 'right' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_audio_boolean' );

function vp_dep_audio_boolean( $value, $value2 ) {
	if ( $value == 'audio' && $value2 == 'soundcloud' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_is_pattern' );

function vp_dep_is_pattern( $value ) {
	if ( $value == 'pattern' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_product_style' );

function vp_dep_product_style( $value ) {
	if ( $value == '2' || $value == '6' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_more' );

function vp_dep_more( $value ) {
	if ( $value == '3' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_wishlist' );

function vp_dep_wishlist( $value ) {
	if ( $value == '1' || $value == '2' || $value == '3' || $value == '5' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_cols' );

function vp_dep_cols( $value ) {
	if ( $value == '1' || $value == '2' || $value == '3' || $value == '4' || $value == '5' || $value == '6' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_diff_cols' );

function vp_dep_diff_cols( $value ) {
	if ( $value == '7' || $value == '8' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_dep_product_title_style' );

function vp_dep_product_title_style( $value ) {
	if ( $value == '3' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_ad_type_image' );

function vp_ad_type_image( $value1, $value2 ) {
	if ( $value1 == true && $value2 == 'image' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_ad_type_google' );

function vp_ad_type_google( $value1, $value2 ) {
	if ( $value1 == true && $value2 == 'google_ad' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function( 'vp_double_dep_boolean' );

function vp_double_dep_boolean( $value1, $value2 = 'false' ) {
	if ( $value1 == true && $value2 == true )
		return true;
	return false;
}

function vp_megamenu_container_shortcode( $width = "", $mega_menu_bg = "", $position = "", $content = "" ) {
	if ( is_null( $width ) )
		$width = '';
	if ( is_null( $mega_menu_bg ) )
		$mega_menu_bg = '';
	if ( is_null( $position ) )
		$position = '';
	if ( is_null( $content ) )
		$content = '';
	$result = '[megamenu_container_shortcode width="' . $width . '" mega_menu_bg="' . $mega_menu_bg . '" position="' . $position . '"]' . $content . '[/megamenu_container_shortcode]';
	return $result;
}

VP_Security::instance()->whitelist_function( 'vp_megamenu_container_shortcode' );

function vp_custom_menu_shortcode( $title = "", $menu = "", $cols = "" ) {
	if ( is_null( $title ) )
		$title = '';
	if ( is_null( $menu ) )
		$menu = '';
	if ( is_null( $cols ) )
		$cols = '';

	$result = '[custom_menu_shortcode title="' . $title . '" cols="' . $cols . '" menu="' . $menu . '"]';
	return $result;
}

VP_Security::instance()->whitelist_function( 'vp_custom_menu_shortcode' );
