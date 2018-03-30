<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Handles colors
 * 
 * @since 1.0
 */
class YIT_Colors {
    
    /**
     * Return a color darker then $color.
     * 
     * @param   string  $color
     * @param   int     $factor
     * @return  string
     * @since   1.0
     */
    public function hex_darker( $color, $factor = 30 ) {
        $color = str_replace( '#', '', $color );
	
    	$base['R'] = hexdec( substr( $color, 0, 2 ) );
    	$base['G'] = hexdec( substr( $color, 2, 2 ) );
    	$base['B'] = hexdec( substr( $color, 4, 2 ) );
    	
    	$color = '#';
    	
    	foreach ( $base as $k => $v ) {
            $amount = $v / 100;
            $amount = round( $amount * $factor );
            $new_decimal = $v - $amount;
    
            $new_hex_component = dechex( $new_decimal );
            
            if( strlen( $new_hex_component ) < 2 )
            	$new_hex_component = "0".$new_hex_component;
            
            $color .= $new_hex_component;
    	}
    	        
    	return $color;
    }
    
    /**
     * Return a color lighter then $color.
     * 
     * @param   string  $color
     * @param   int     $factor
     * @return  string
     * @since   1.0
     */
    public function hex_lighter( $color, $factor = 30 ) {
    	$color = str_replace( '#', '', $color );
    	
    	$base['R'] = hexdec( $color{0} . $color{1} );
    	$base['G'] = hexdec( $color{2} . $color{3} );
    	$base['B'] = hexdec( $color{4} . $color{5} );
    	
    	$color = '#';
         
        foreach ( $base as $k => $v ) {
            $amount = 255 - $v; 
            $amount = $amount / 100; 
            $amount = round( $amount * $factor ); 
            $new_decimal = $v + $amount; 
         
            $new_hex_component = dechex( $new_decimal );
             
            if( strlen( $new_hex_component ) < 2 )
            	$new_hex_component = "0".$new_hex_component;
             
            $color .= $new_hex_component; 
       	}
             
       	return $color;
     }
     
     /**
      * Detect if we must use a color darker or lighter then the background.
      * 
      * @param   string  $color
      * @param   string  $dark
      * @param   string  $light
      * @return  string
      * @since   1.0
      */
     public function light_or_dark( $color, $dark = '#000000', $light = '#FFFFFF' ) {
        $hex = str_replace( '#', '', $color );

    	$c_r = hexdec( substr( $hex, 0, 2 ) );
    	$c_g = hexdec( substr( $hex, 2, 2 ) );
    	$c_b = hexdec( substr( $hex, 4, 2 ) );
    	$brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;
    	
    	return ( $brightness > 155 ) ? $dark : $light;
     }
     
     /**
      * Detect if we must use a color darker or lighter then the background.
      * 
      * @param   string  $color
      * @param   string  $dark
      * @param   string  $light
      * @return  string
      * @since   1.0
      */
     public function hex2rgb($hex) {
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
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }
}           
    
if ( ! function_exists( 'yit_light_or_dark' ) ) {
    /**
     * Detect if we must use a color darker or lighter then the background.
     * 
     * @param   string  $color
     * @param   string  $dark
     * @param   string  $light
     * @return  string
     * @since   1.0
     */
    function yit_light_or_dark( $color, $dark = '#000000', $light = '#FFFFFF' ) {
        return yit_get_model('colors')->light_or_dark( $color, $dark, $light );
    }
}

?>