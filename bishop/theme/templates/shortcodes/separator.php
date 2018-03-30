<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$style = ( isset( $style ) && in_array( $style, array( 'single', 'shadow', 'double', 'dotted', 'dashed' ) ) ) ? $style : 'single';
$margin_top = ( isset( $margin_top ) ) ? $margin_top : 0;
$margin_bottom = ( isset( $margin_bottom ) ) ? $margin_bottom : 0;
$color = ( isset( $color ) ) ? $color : "#cdcdcd";
$css = "style = 'border-color: ".$color."; ";

if( $margin_top != 0 || $margin_bottom != 0 ){
    $css .= ( $margin_top != 0 ) ? "margin-top: " . $margin_top . "px; " : "";
    $css .= ( $margin_bottom != 0 ) ? "margin-bottom: " . $margin_bottom . "px;" : "";
}

$css .= "'";
?>

<div class="separator <?php echo esc_attr( $style . $vc_css ) ?>" <?php echo $css?> ></div>