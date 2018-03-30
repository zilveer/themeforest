<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Style_Generator
 * @since G1_Style_Generator 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

class G1_Color_Generator {
    public static function get_light_color( G1_Color $color ) {

    }

    public static function get_dark_color( G1_Color $color ) {

    }

    public static function get_warm_color( G1_Color $color ) {

    }

    public static function get_light_gradient( G1_Color $color ) {

    }

    public static function get_dark_gradient( G1_Color $color ) {

    }


    /**
     * Gets a warm gradient
     *
     * @param 			G1_Color $color
     * @return			array An array of 2 colors
     */
    public static function get_warm_gradient( G1_Color $color ) {
        $from = clone $color;
        if ( $from->get_lightness() > 80 ) {
            $from->set_lightness( $from->get_lightness() - 15);
        }

        $to = clone $from;

        $h1 = $to->get_hue();
        $s1 = $to->get_saturation();
        $l1 = $to->get_lightness();

        $h2 = $h1;
        $s2 = $s1;
        $l2 = $l1;

//        $h2 -= 5;
//
//        if ( $h2 < 0 ) {
//            $h2 = 360 - $h2;
//        }

        if ( $s2 ) {
            $s2 += 15;
            if ( $s2 > 100 ) {
                $s2 = 100;
            }
        }

//        if ( $s2 ) {
//            $s2 -= 25;
//            if ( $s2 < 0 ) {
//                $s2 = 0;
//            }
//        }

        $l2 += 15;
        if ( $l2 > 100 ) {
            $l2 = 100;
        }


        $from->set_hsl(array( $h2, $s2, $l2 ));

        return array( $from, $to);
    }


    public static function get_tone_color( G1_Color $color, $delta = 10, $breakpoint = 50) {
        $out = clone $color;
        $lightness = $color->get_lightness();

        if( $lightness <= $breakpoint ) {
            $lightness += ($lightness + $delta) > 100 ? -$delta : $delta;
        } else {
            $lightness -= ($lightness + $delta) < 0 ? -$delta : $delta;
        }

        $out->set_lightness( $lightness );

        return $out;
    }
}



class G1_Color {
    const SYSTEM_RGB = 'rgb';
    const SYSTEM_HSL = 'hsl';
    const SYSTEM_HEX = 'hex';

    protected
        $rgb,
        $hsl;

    public function __construct( $color, $system = self::SYSTEM_HEX ){

        switch ( $system ) {
            case self::SYSTEM_RGB:
                $this->set_rgb( $color );
                break;

            case self::SYSTEM_HSL:
                $this->set_hsl( $color );
                break;

            default:
                $this->set_hex( $color );
                break;
        }
    }

    /**
     * Checks whether a color is black ( no lightness )
     *
     * @return			bool
     */
    public function is_black() {
        return 0 === $this->hsl[2] ? true : false;
    }



    /**
     * Checks whether a color is white ( maximum lightness )
     *
     * @return			bool
     */
    public function is_white() {
        return 100 === $this->hsl[2] ? true : false;
    }



    /**
     * Checks whether a color is gray ( no saturation )
     *
     * @return			bool
     */
    public function is_gray() {
        return 0 === $this->hsl[1] ? true : false;
    }


    public function get_rgb() {
        return $this->rgb;
    }

    public function get_hsl() {
        return $this->hsl;
    }

    public function get_red() 			{ return $this->rgb[0]; }
    public function get_green() 		{ return $this->rgb[1]; }
    public function get_blue() 			{ return $this->rgb[2]; }

    public function get_hue() 			{ return $this->hsl[0]; }
    public function get_saturation() 	{ return $this->hsl[1]; }
    public function get_lightness() 	{ return $this->hsl[2]; }



    public function set_rgb( $v ) {
        $this->rgb = $v;
        $this->hsl = $this->rgb_to_hsl( $this->rgb );
    }
    public function set_red( $v ) {
        $this->rgb[0] = $v;
        $this->hsl = $this->rgb_to_hsl( $this->rgb );
    }
    public function set_green( $v ) {
        $this->rgb[1] = $v;
        $this->hsl = $this->rgb_to_hsl( $this->rgb );
    }
    public function set_blue( $v ) {
        $this->rgb[2] = $v;
        $this->hsl = $this->rgb_to_hsl( $this->rgb );
    }



    public function set_hsl( $v ) {
        $this->hsl = $v;
        $this->rgb = $this->hsl_to_rgb( $this->hsl );
    }
    public function set_hue( $v ) {
        $this->hsl[0] = $v;
        $this->rgb = $this->hsl_to_rgb( $this->hsl );
    }
    public function set_saturation( $v ) {
        $this->hsl[1] = $v;
        $this->rgb = $this->hsl_to_rgb( $this->hsl );
    }
    public function set_lightness( $v ) {
        $v = $v > 100 ? 100 : $v;
        $v = $v < 0 ? 0 : $v;

        $this->hsl[2] = $v;
        $this->rgb = $this->hsl_to_rgb( $this->hsl );
    }


    public function get_hex() {
        $rgb = $this->get_rgb();

        $rgb = array_map( 'round', $rgb );

        return	str_pad( dechex($rgb[0]), 2, '0', STR_PAD_LEFT) .
            str_pad( dechex($rgb[1]), 2, '0', STR_PAD_LEFT) .
            str_pad( dechex($rgb[2]), 2, '0', STR_PAD_LEFT)
            ;
    }



    public function set_hex( $color ) {
        switch( strlen( $color ) ) {
            case 4:
                $color = substr( $color, 1 );
            case 3:
                $this->set_rgb(array(
                    hexdec( $color[0] . $color[0] ),
                    hexdec( $color[1] . $color[1] ),
                    hexdec( $color[2] . $color[2] ),
                ));

                break;

            case 7:
                $color = substr( $color, 1 );
            case 6:
                $this->set_rgb(array(
                    hexdec( $color[0] . $color[1] ),
                    hexdec( $color[2] . $color[3] ),
                    hexdec( $color[4] . $color[5] ),
                ));

                break;

            default:
                $this->set_rgb(array(255,0,0));

                break;
        }
    }




    public function hsl_to_rgb( $hsl ) {
        $h = $hsl[0];
        $s = $hsl[1];
        $l = $hsl[2];

        $h /= 360;
        $s /= 100;
        $l /= 100;

        $r = 0;
        $g = 0;
        $b = 0;

        if( $s == 0 ) {
            // achromatic
            $r = $l;
            $g = $l;
            $b = $l;
        } else {
            $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
            $p = 2 * $l - $q;
            $r = $this->hue_to_rgb($p, $q, $h + 1/3);
            $g = $this->hue_to_rgb($p, $q, $h);
            $b = $this->hue_to_rgb($p, $q, $h - 1/3);
        }

        return array($r * 255, $g * 255, $b * 255 );
    }


    public function hue_to_rgb( $p, $q, $t ) {
        if ( $t < 0) $t += 1;

        if ( $t > 1) $t -= 1;

        if ( $t < 1/6 ) return $p + ($q - $p) * 6 * $t;
        if ( $t < 1/2 ) return $q;
        if ( $t < 2/3 ) return $p + ($q - $p) * (2/3 - $t) * 6;
        return $p;

    }

    public function rgb_to_hsl( $rgb ){
        $r = $rgb[0];
        $g = $rgb[1];
        $b = $rgb[2];


        $r /= 255;
        $g /= 255;
        $b /= 255;

        $max = max( $r, $g, $b);
        $min = min( $r, $g, $b);

        $h = ($max + $min) / 2;
        $s = ($max + $min) / 2;
        $l = ($max + $min) / 2;

        if ( $max == $min ) {
            // achromatic
            $h = 0;
            $s = 0;
        } else {
            $d = $max - $min;

            if ( $l > 0.5 ) {
                $s = $d / ( 2 - $max - $min );
            } else {
                $s= $d / ( $max + $min );
            }

            switch( $max ){
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }
            $h /= 6;
        }

        return array( $h*360, $s*100, $l*100 );
    }
}