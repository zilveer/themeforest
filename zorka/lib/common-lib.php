<?php
/**
 * Created by PhpStorm.
 * User: hoantv1
 * Date: 2014-08-23
 * Time: 5:05 PM
 */

// Convert hex code to rgb code
function g5plus_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );
	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );

	return $rgb; // returns an array with the rgb values
}
if(! function_exists('g5plus_hex2rgba')){
    function g5plus_hex2rgba($hex,$opacity=1) {
        $hex = str_replace("#", "", $hex);
        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        }
        else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
        return $rgba;
    }
}
/**
 * Determine if SSL is used.
 *
 * @since 2.6.0
 *
 * @return bool True if SSL, false if not used.
 */
function g5plus_is_ssl() {
	if ( isset($_SERVER['HTTPS']) ) {
		if ( 'on' == strtolower($_SERVER['HTTPS']) )
			return true;
		if ( '1' == $_SERVER['HTTPS'] )
			return true;
	} elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
		return true;
	}
	return false;
}

function g5plus_excerpt( $limit ) {
    $content = get_the_excerpt();
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    $content = explode( ' ', $content, $limit );
    array_pop( $content );
    $content = implode( " ", $content );
    $content = '<div class="excerpt">' . $content . '</div>';
    return $content;
}
function g5plus_substr( $str, $txt_len, $end_txt = '...' ) {
	if (empty($str)) return '';
	if (strlen($str) <= $txt_len) return $str;

	$i = $txt_len;
	while ($str[$i] != ' ') {
		$i--;
		if ($i ==-1) break;
	}
	while ($str[$i] == ' ') {
		$i--;
		if ($i ==-1) break;
	}

	return substr($str, 0, $i + 1) . $end_txt;
}
function g5plus_the_attr($attr) {
	$attr_string = '';
	foreach ($attr as $key => $value) {
		$attr_string .= esc_attr($key) . '="' . esc_attr($value) .  '" ';
	}
	echo  wp_kses_post($attr_string);
}

function g5plus_the_attr_value($attr) {
	foreach ($attr as $key) {
		echo esc_attr($key) . ' ';
	}
}

/*================================================
GET CURRENT PAGE URL
================================================== */
if (!function_exists('g5plus_endsWith')) {
	function g5plus_endsWith($haystack,$needle,$case=true)
	{
		$expectedPosition = strlen($haystack) - strlen($needle);

		if ($case)
			return strrpos($haystack, $needle, 0) === $expectedPosition;

		return strripos($haystack, $needle, 0) === $expectedPosition;
	}
}