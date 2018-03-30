<?php


function krown_parse_flickr_feed( $id, $no ) {

	$url = "http://api.flickr.com/services/feeds/photos_public.gne?id={$id}&lang=en-en&format=rss_200";
	$s = file_get_contents( $url );

	preg_match_all('#<item>(.*)</item>#Us', $s, $items);

	$output = "";

	for ( $i = 0; $i < count( $items[1] ); $i++ ) {

		if( $i >= $no ) {
			return $output;
		} 		

		$item = $items[1][$i];
		preg_match_all( '#<link>(.*)</link>#Us', $item, $temp );

		$link = $temp[1][0];
		preg_match_all( '#<title>(.*)</title>#Us', $item, $temp );

		$title = $temp[1][0];
		preg_match_all( '#<media:thumbnail([^>]*)>#Us', $item, $temp );

		//$thumb = str_replace( '_s.jpg', '_m.jpg', krown_parse_flickr_attr( $temp[0][0], "url" ) );
		$thumb = krown_parse_flickr_attr( $temp[0][0], "url" );

		$output .= "<li><a href='$link' target='_blank' title=\"" . str_replace( '"', '', $title ) . "\"><img alt='$title' src='$thumb'/></a></li>";

	}

	return $output;

}

function krown_parse_flickr_attr( $s, $attrname ) { 

	preg_match_all( '#\s*(' . $attrname . ')\s*=\s*["|\']([^"\']*)["|\']\s*#i', $s, $x );

	if ( count( $x ) >= 3 ) {
		return $x[2][0]; 
	} else { 
		return "";
	}

}

?>