<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for show a simple custom button
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */
global $yit_button_index;
if ( !isset( $yit_button_index ) ) {
    $yit_button_index = 0;
}

$id           = 'button_' . mt_rand();
$target       = ( isset( $target ) && $target != '' ) ? 'target="' . $target . '"' : '';
$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';

if ( isset( $color ) && $color != '' ) {

    //if( isset($force_style) && $force_style == "1" ) {
    //wp_enqueue_style( "custom-button-{$color}-css", YIT_CORE_ASSETS_URL . "/css/buttons/{$color}.css" );
    //}


}
elseif ( isset( $colorstart ) && isset( $colorend ) && $colorstart != '' && $colorend != '' ) {
    $colortext = ( isset( $colortext ) && $colortext != '' ) ? $colortext : '#FFFFFF';
    $color     = 'id' . $yit_button_index;
    $name      = 'id' . $yit_button_index;
    $align     = ( $align == '' ) ? 'vertical' : $align;

    $yit_button_index ++;

    $yit_gradients = new YIT_Gradients();
    ?>
    <style type="text/css">
        <?php
            echo $yit_gradients->gradient_from_to( '.btn-' . $name, $colorstart, $colorend, $align );
            echo $yit_gradients->gradient_lighter( '.btn-' . $name .':hover', $colorstart, $align, 50);
            echo 'a.btn-' . $name . '{ color: ' . $colortext . ';}';
            echo 'a.btn-' . $name . ':hover { color: ' . $colortext . ';}';

        ?>
    </style>
<?php
}

if ( isset( $animation ) && $animation != '' ) {
    echo '<style type="text/css">a#' . $id . '.btn.animated:before{font-size:' . $icon_size . 'px}</style>';
}
?>
<?php
$color     = ' btn-' . $color;
$dimension = ( $dimension == 'normal' || $dimension == 'medium' || $dimension == '' ) ? '' : 'btn-' . $dimension;
$icon_size = ( $icon_size != '' ) ? 'style="font-size: ' . $icon_size . 'px;"' : '';

$content = ( isset( $content ) && $content != '' ) ? $content : '&nbsp;';
if ( isset( $icon ) && ! empty( $icon ) && ! in_array( $icon, array( 'None', 'no-icon' ) ) ) {

    if ( isset( $animation ) && $animation != '' ) {
        $html = '<a id="' . $id . '" href="' . $href . '" ' . $target . ' class="btn animated ' . $animation . ' ' . $dimension . ' ' . $animate . $vc_css . ' ' . $color . ' ' . $class . ' fa fa-' . $icon . '" ' . $animate_data . ' ><span>' . $content . '</span></a>';
    }
    else {
        $icon = '<i class="fa fa-' . $icon . '" ' . $icon_size . '></i>';
        $html = '<a id="' . $id . '" href="' . $href . '" ' . $target . ' class="btn ' . $dimension . ' ' . $color . ' ' . $class . $vc_css . '">' . $icon . ' ' . $content . '</a>';
    }

}
else {
    $html = '<a id="' . $id . '" href="' . $href . '" ' . $target . ' class="btn ' . $dimension . ' ' . $animate . $vc_css . ' ' . $color . ' ' . $class . '" ' . $animate_data . '  >' . $content . '</a>';
}
?>
<?php echo $html; ?>