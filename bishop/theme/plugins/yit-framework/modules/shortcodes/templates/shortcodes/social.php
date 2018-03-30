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
 * Template file for Social Shortcode
 *
 * @package Yithemes
 * @author  Antonio La Rocca <antonio.larocca@yithemes.com>
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

//IE8 and IE9 Fix
global $is_IE;

if( $is_IE ) {
    $ie_version = yit_ie_version();
    $is_old_ie = $ie_version < 10 && $ie_version != -1 ? true : false;
}else{
    $is_old_ie = false;
}

if ( is_null( $title ) ) {
    $title = "";
}

$target = ( isset( $target ) && $target != '' ) ? 'target="' . $target . '"' : '';

/* Code snipped from icon shortcode */
$circle = ( $circle == 'no' ) ? false : true;
$style_color = ( $color == '' ) ? '' : 'color:' . $color . ';';
$color_hover = ( $color_hover == '' ) ? '#000000' : $color_hover;

if ( isset( $border_color ) ) {
	$style_border_color = 'border-color:' . $border_color . ';';
} else {
	$style_border_color = ( $color == '' ) ? '' : 'border-color:' . $color . ';';
}

$style_border_size = "border-width:0px;";
if ( $circle ) {
    $style_border_size = ( $circle_border_size == '' ) ? 'border-width:1px;' : 'border-width:' . $circle_border_size . 'px;';
}

$icon_size = ( $icon_size == '' ) ? $default_atts['icon_size'] : $icon_size;


$icon = '<i class="fa fa-' . $icon_social . '" style="' . $style_color . ' font-size: ' . $icon_size . 'px"></i>';
/* end */

$id_link = "link_socials" . $index;

// class
$class = ! empty( $class ) ? ' ' . $class : '';
?>

<?php if ( $icon_type == 'icon' ) : ?>

    <?php if( ! $is_old_ie ) : ?>
        <style>
            #<?php echo $id_link?>:hover span.icon-circle {
                border-color: <?php echo $color_hover; ?> !important;
            }

            #<?php echo $id_link?>:hover i.fa {
                color: <?php echo $color_hover;?> !important;
            }
        </style>
    <?php endif; ?>

    <a href="<?php echo $href; ?>" data-normal="<?php echo $color; ?>" data-hover="<?php echo $color_hover ?>" id="<?php echo $id_link ?>" class="link_socials<?php echo $class ?>" title="<?php echo $title; ?>" <?php echo $target; ?>>
        <span class="icon-circle" style="width:<?php echo $circle_size ?>px; height:<?php echo $circle_size ?>px; <?php echo $style_border_color ?> <?php echo $style_border_size ?>">
                <?php echo $icon ?>
            </span>
    </a>

<?php elseif ( $icon_type == 'text' ) : ?>
    <div class="socials-text">
        <a href="<?php echo $href; ?>" class="link-<?php echo $title; ?>" <?php echo $target; ?>>
            <?php echo $title; ?>
        </a>
    </div>

<?php endif ?>

<?php
if( $is_old_ie ){
    wp_enqueue_script( 'yit-shortcodes-social' );
}
?>