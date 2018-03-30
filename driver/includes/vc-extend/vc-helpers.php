<?php

function mk_get_fontfamily( $element_name, $id, $font_family, $font_type, $child_el = null ) {
    $output = '';
    if ( $font_type == 'google' ) {
        if ( !function_exists( "my_strstr" ) ) {
            function my_strstr( $haystack, $needle, $before_needle = false ) {
                if ( !$before_needle ) return strstr( $haystack, $needle );
                else return substr( $haystack, 0, strpos( $haystack, $needle ) );
            }
        }
        wp_enqueue_style( $font_family, 'https://fonts.googleapis.com/css?family=' .$font_family , false, false, 'all' );
        $format_name = strpos( $font_family, ':' );
        if ( $format_name !== false ) {
            $google_font =  my_strstr( str_replace( '+', ' ', $font_family ), ':', true );
        } else {
            $google_font = str_replace( '+', ' ', $font_family );
        }
        $output .= '<style type="text/css">'.$element_name.$id.' '.$child_el.'{font-family: "'.$google_font.'"}</style>';

    } else if ( $font_type == 'safefont' ) {
            $output .= '<style type="text/css">'.$element_name.$id.' '.$child_el.'{font-family: '.$font_family.' !important}</style>';
        }
    return $output;
}


    
function iron_get_google_fonts() {
	
	$cache_key = 'iron_google_fonts';
	$cache_expire =  (60 * 60 * 24) * 7; // 1 week
	
	$fonts_data = get_transient($cache_key);
	if($fonts_data !== false) {
	
		$fonts_data = unserialize($fonts_data);

	}else{
	
		$url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDulJCJNv_1EH02qfgRhj5SYUT4A6O4QN4";
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$json = curl_exec($ch);
		curl_close($ch);
	
		$fonts_data = json_decode($json);
		if(!empty($fonts_data->items)) {
			$fonts_data = $fonts_data->items;
			set_transient($cache_key, serialize($fonts_data), $cache_expire);
		}else{
			$fonts_data	= array();
		}	
	}
		
	if(empty($fonts_data))
		return array();
		
	$fonts = array();	
	foreach($fonts_data as $item) {
		
		$font = new stdClass;
		$font->font_family = $item->family;
		$font->font_styles = implode(",", $item->variants);
		
		$styles = array();
		foreach($item->variants as $variant) {
		
			if($variant == "regular") {
			
				$styles[] = '400 regular:400:normal';
				
			}else if($variant == "italic") {	
			
				$styles[] = '400 italic:400:italic';
				
			}else if(is_numeric(substr($variant, 0, 2))) {
			
				if(strlen($variant) == 3) {
					
					if($variant <= 300) {
						$weight = "light";
					}else{
						$weight = "bold";
					}
					$styles[] = $variant.' '.$weight.' regular:'.$variant.':normal';
					
				}else{
				
					$variant_prefix = substr($variant, 0, 3);
					$variant_suffix = substr($variant, 3);
					
					$styles[] = $variant_prefix.' '.$variant_suffix.':'.$variant_prefix.':'.$variant_suffix;
				}
			
			}
		}
		$font->font_types = implode(",", $styles);
		
		$fonts[] = $font;
		
	}

	return $fonts;
}


add_filter('vc_google_fonts_get_fonts_filter', 'iron_get_google_fonts');
?>