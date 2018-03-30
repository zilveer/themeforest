<?php
/**
 *
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
global $cththemes_options;

if(!function_exists('cththemes_gather_theme_hex2rgb')){
    function cththemes_gather_theme_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } 
        else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }
}
if(!function_exists('cththemes_gather_theme_colourBrightness')){
    /*
    * $hex = '#ae64fe';
    * $percent = 0.5; // 50% brighter
    * $percent = -0.5; // 50% darker
    */
    function cththemes_gather_theme_colourBrightness($hex, $percent) {
        // Work out if hash given
        $hash = '';
        if (stristr($hex,'#')) {
            $hex = str_replace('#','',$hex);
            $hash = '#';
        }
        /// HEX TO RGB
        $rgb = cththemes_gather_theme_hex2rgb($hex);
        //// CALCULATE 
        for ($i=0; $i<3; $i++) {
            // See if brighter or darker
            if ($percent > 0) {
                // Lighter
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
            } else {
                // Darker
                $positivePercent = $percent - ($percent*2);
                $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
            }
            // In case rounding up causes us to go to 256
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
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
}

function cththemes_gather_theme_bg_png($color, $input, $output){
    $image = imagecreatefrompng ( $input );
    $rgbs = cththemes_gather_theme_hex2rgb($color);
    $background = imagecolorallocate( $image, $rgbs[0], $rgbs[1], $rgbs[2] );

    imagepng( $image, $output);

}
if(!function_exists('cththemes_gather_theme_stripWhitespace')){
    /**
     * Strip whitespace.
     *
     * @param  string $content The CSS content to strip the whitespace for.
     * @return string
     */
    function cththemes_gather_theme_stripWhitespace($content)
    {
        // remove leading & trailing whitespace
        $content = preg_replace('/^\s*/m', '', $content);
        $content = preg_replace('/\s*$/m', '', $content);

        // replace newlines with a single space
        $content = preg_replace('/\s+/', ' ', $content);

        // remove whitespace around meta characters
        // inspired by stackoverflow.com/questions/15195750/minify-compress-css-with-regex
        $content = preg_replace('/\s*([\*$~^|]?+=|[{};,>~]|!important\b)\s*/', '$1', $content);
        $content = preg_replace('/([\[(:])\s+/', '$1', $content);
        $content = preg_replace('/\s+([\]\)])/', '$1', $content);
        $content = preg_replace('/\s+(:)(?![^\}]*\{)/', '$1', $content);

        // whitespace around + and - can only be stripped in selectors, like
        // :nth-child(3+2n), not in things like calc(3px + 2px) or shorthands
        // like 3px -2px
        $content = preg_replace('/\s*([+-])\s*(?=[^}]*{)/', '$1', $content);

        // remove semicolon/whitespace followed by closing bracket
        $content = preg_replace('/;}/', '}', $content);

        return trim($content);
    }

}



function cththemes_gather_add_rgba_background_inline_style($color = '#ed5153', $handle = 'skin') {
    $inline_style = '.testimoni-wrapper,.pricing-wrapper,.da-thumbs li  article,.team-caption,.home-centered{background-color:rgba(' . implode(",", hex2rgb($color)) . ', 0.9);}';
    wp_add_inline_style($handle, $inline_style);
}

if(!function_exists('cththemes_gather_theme_overridestyle')){
	function cththemes_gather_theme_overridestyle(){
		global $cththemes_options;

		$inline_style = '
/*White bg*/
body, .pace .pace-progress {
    background: '.$cththemes_options['main-bg-color'].';
}
footer.page-footer {background:'.$cththemes_options['footer-bg-color'].'; }
.navbar-default {background:'.$cththemes_options['navigation-bg-color'].'; }
/*Grey*/
body, .timeline-content h2 {
    color: '.$cththemes_options['main-text-color'].';
}
.nav-pills>li>a {
    color: #C2C2C2;
}
.form-control:focus {
    border-color: #C2C2C2;
}
.navbar-default .navbar-nav>li>a {
    color: '.$cththemes_options['navigation-menu-color'].';
}
.slick-prev:before, .slick-next:before {
    color: #C2C2C2;
}
/* green
 * ----- */
::-moz-selection {
    background: '.$cththemes_options['theme-skin-color'].';
    color: #FFF;
}
::selection {
    background: '.$cththemes_options['theme-skin-color'].';
    color: #FFF;
}
.header, .sub-header {
    color: #FFF;
    background-color: '.$cththemes_options['theme-skin-color'].';
}
/*color*/
a, a:hover, a:focus, .speaker-info p, .highlighted-plan .price, .highlighted-plan .plan-name, a.popup-video:hover i {
    color: '.$cththemes_options['theme-skin-color'].';
}
.benefit-item .benefit-icon i {
    color: '.$cththemes_options['theme-skin-color'].';
}
/*background*/
.timeline::before {
    background: '.$cththemes_options['theme-skin-color'].';
}
.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover
, .navbar-default .navbar-nav>.current-menu-parent > a, .navbar-default .navbar-nav>.current-menu-parent > a:focus, .navbar-default .navbar-nav>.current-menu-parent > a:hover
{    color: '.$cththemes_options['navigation-menu-active-color'].';
    background-color: '.$cththemes_options['theme-skin-color'].';
}
.navbar-default .navbar-nav > li > a:hover,.navbar-default .navbar-nav > li > a:focus{color: '.$cththemes_options['navigation-menu-hover-color'].';}
/*border*/
.post-wrap .sticky,
.timeline-bullet, .highlighted-plan {
    border-color: '.$cththemes_options['theme-skin-color'].';
}
/*background color*/
.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover, .dropdown-menu > .active > a, .dropdown-menu > .active > a:focus, .dropdown-menu > .active > a:hover {
    background-color: '.$cththemes_options['theme-skin-color'].';
}
/* 
  BUTTONS
  ------- */
.btn-default {
    color: '.$cththemes_options['theme-skin-color'].';
    border-color: #FFF;
}
.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active {
    background-color: transparent;
    border-color: #FFF;
    color: #FFF;
}
.btn-primary {
    background-color: #5c5c5c;
}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active {
    background-color: #3b3b3b;
}
.btn-success {
    background-color: '.$cththemes_options['theme-skin-color'].';
    border-color: '.$cththemes_options['theme-skin-color'].';
}
.btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active {
    background-color: #FFF;
    border-color: '.$cththemes_options['theme-skin-color'].';
    color: '.$cththemes_options['theme-skin-color'].';
}
.btn-outline {
    color: #8C8C8C;
    border-color: #CACACA;
}
.btn-outline:hover, .btn-outline:focus, .btn-outline:active, .btn-outline.active {
    background-color: transparent;
    border-color: #818181;
    color: #8C8C8C;
}
.vc_tta-tabs.vc_tta-tabs-position-top:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill) .vc_tta-tab.vc_active > a {
    color: #FFF !important;
    background-color: '.$cththemes_options['theme-skin-color'].' !important;
}
.vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title a, .vc_tta.vc_general .vc_tta-panel-title:hover a {
    color: '.$cththemes_options['theme-skin-color'].' !important;
}
';

        
        // Remove whitespace
        $inline_style = cththemes_gather_theme_stripWhitespace($inline_style);

        return $inline_style;

	}
}
