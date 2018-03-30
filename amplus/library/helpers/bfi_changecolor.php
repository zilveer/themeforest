<?php
/**
 */
 
function bfi_is_color_light($hex) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	if (strlen($hex) == 3) {
	    $hex = substr($hex, 0, 1) . substr($hex, 0, 1)
	         . substr($hex, 1, 1) . substr($hex, 1, 1)
	         . substr($hex, 2, 1) . substr($hex, 2, 1);
	}
	/// HEX TO RGB
	if ((hexdec(substr($hex,0,2)) + hexdec(substr($hex,2,2)) + hexdec(substr($hex,4,2))) / 3 < 255 * .45) {
	    // dark
	    return false;
	} else {    
	    // light
	    return true;
	}
}
 
/**
 * Lightens or darkens a hex color
 *
 * @see http://lab.clearpixel.com.au/2008/06/darken-or-lighten-colours-dynamically-using-php/
 * @param string $hex color to change
 * @param float $percent -1.0 - 1.0
 * @return string new hex color
 */
function bfi_changecolor($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	if (strlen($hex) == 3) {
	    $hex = substr($hex, 0, 1) . substr($hex, 0, 1)
	         . substr($hex, 1, 1) . substr($hex, 1, 1)
	         . substr($hex, 2, 1) . substr($hex, 2, 1);
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE 
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
        // if ($percent > 0) {
            // Lighter
            // $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
            $rgb[$i] = round($rgb[$i] * (1+$percent));
        // } else {
			// Darker
            // $positivePercent = $percent - ($percent*2);
            // $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
        // }
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		} else if ($rgb[$i] < 0) {
		    $rgb[$i] = 0;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}

?>