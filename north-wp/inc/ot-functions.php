<?php
function thb_bgecho($array) {
	if(!empty($array)) {
		if (!empty($array['background-color'])) { 
			echo "background-color: " . $array['background-color'] . " !important;\n";
		}
		if (!empty($array['background-image'])) { 
			echo "background-image: url(" . $array['background-image'] . ") !important;\n";
		}
		if (!empty($array['background-repeat'])) { 
			echo "background-repeat: " . $array['background-repeat'] . " !important;\n";
		}
		if (!empty($array['background-attachment'])) { 
			echo "background-attachment: " . $array['background-attachment'] . " !important;\n";
		}
		if (!empty($array['background-position'])) { 
			echo "background-position: " . $array['background-position'] . " !important;\n";
		}
		if (!empty($array['background-size'])) { 
			echo "background-size: " . $array['background-size'] . " !important;\n";
		}
	}
}
function thb_paddingecho($array) {
	if(!empty($array)) {
		if (!empty($array['top'])) { 
			echo "padding-top: " . $array['top'] . $array['unit'].";\n";
		}
		if (!empty($array['right'])) { 
			echo "padding-right: " . $array['right'] . $array['unit'].";\n";
		}
		if (!empty($array['bottom'])) { 
			echo "padding-bottom: " . $array['bottom'] . $array['unit'].";\n";
		}
		if (!empty($array['left'])) { 
			echo "padding-left: " . $array['left'] . $array['unit'].";\n";
		}
	}
}

$thb_fontlist = array();

function thb_google_webfont() {
		global $thb_fontlist;
		$options = array( 
			array( 
					'option' => "body_type", 
					'default' => "Hind"
			),
			array( 
					'option' => "title_type", 
					'default' => "Hind"
			),
			array( 
					'option' => "menu_left_type", 
					'default' => false
			),
			array( 
					'option' => "menu_left_submenu_type", 
					'default' => false
			),
			array( 
					'option' => "menu_right_type", 
					'default' => false
			),
			array( 
					'option' => "menu_mobile_type", 
					'default' => false
			),
			array( 
					'option' => "menu_mobile_submenu_type", 
					'default' => false
			)
		);
		$import = '';	
								
		$subsets = 'latin,latin-ext';
		$subset = ot_get_option('font_subsets');

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$weights = ':300,400,500,600,700,900';
		$google_fonts = wp_list_pluck( get_theme_mod( 'ot_google_fonts', array() ), 'family' );

		foreach($options as $option) {
			$array = ot_get_option($option['option']);
			if (!empty($array['font-family'])) { 
				if (!in_array($array['font-family'], $thb_fontlist)) {
					if (in_array($array['font-family'], $google_fonts)) {
						$font = $array['font-family'].$weights;
						array_push($thb_fontlist, $font);
					}
				}
			} else if ($option['default']) {
				if (!in_array($option['default'], $thb_fontlist)) {
					if (in_array($option['default'], $google_fonts)) {
						$font = $option['default'].$weights;
						array_push($thb_fontlist, $font);
					}
				}
			}
		}
		$font_list = array_unique($thb_fontlist);
			
		$cssfont = implode('|', $font_list);
		$query_args = array(
			'family' => $cssfont,
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "https://fonts.googleapis.com/css" );
		return $font_url;
}

function thb_typeecho($array, $important = false, $default = false) {

	if(!empty($array)) {
		
		if (!empty($array['font-family'])) { 
			echo "font-family: " . $array['font-family'] . ";\n";
		} else if ($default) {
			echo "font-family: '" . $default . "';\n";
		}
		if (!empty($array['font-color'])) { 
			echo "color: " . $array['font-color'] . ";\n";
		}
		if (!empty($array['font-style'])) { 
			echo "font-style: " . $array['font-style'] . ";\n";
		}
		if (!empty($array['font-variant'])) { 
			echo "font-variant: " . $array['font-variant'] . ";\n";
		}
		if (!empty($array['font-weight'])) { 
			echo "font-weight: " . $array['font-weight'] . ";\n";
		}
		if (!empty($array['font-size'])) { 
			
			if ($important) {
				echo "font-size: " . $array['font-size'] . " !important;\n";
			} else {
				echo "font-size: " . $array['font-size'] . ";\n";
			}
		}
		if (!empty($array['text-decoration'])) { 
				echo "text-decoration: " . $array['text-decoration'] . " !important;\n";
		}
		if (!empty($array['text-transform'])) { 
				echo "text-transform: " . $array['text-transform'] . " !important;\n";
		}
		if (!empty($array['line-height'])) { 
				echo "line-height: " . $array['line-height'] . " !important;\n";
		}
		if (!empty($array['letter-spacing'])) { 
				echo "letter-spacing: " . $array['letter-spacing'] . " !important;\n";
		}
	}
	if(empty($array) && !empty($default)) {
		echo "font-family: '" . $default . "';\n";
	}
}

function thb_measurementecho($array) {
	if(!empty($array)) {
		echo $array[0] . $array[1];
	}
}

function thb_hex2rgb($hex) {

   $hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {

      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));

   } else {

      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));

   }

   $rgb = array($r, $g, $b);

   return implode(",", $rgb); // returns the rgb values separated by commas

}
function thb_adjustColorLightenDarken($color_code,$percentage_adjuster = 0) {
    $percentage_adjuster = round($percentage_adjuster/100,2);
    if(is_array($color_code)) {
        $r = $color_code["r"] - (round($color_code["r"])*$percentage_adjuster);
        $g = $color_code["g"] - (round($color_code["g"])*$percentage_adjuster);
        $b = $color_code["b"] - (round($color_code["b"])*$percentage_adjuster);

        return array("r"=> round(max(0,min(255,$r))),
            "g"=> round(max(0,min(255,$g))),
            "b"=> round(max(0,min(255,$b))));
    }
    else if(preg_match("/#/",$color_code)) {
        $hex = str_replace("#","",$color_code);
        $r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
        $g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
        $b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
        $r = round($r - ($r*$percentage_adjuster));
        $g = round($g - ($g*$percentage_adjuster));
        $b = round($b - ($b*$percentage_adjuster));

        return "#".str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);

    }
}