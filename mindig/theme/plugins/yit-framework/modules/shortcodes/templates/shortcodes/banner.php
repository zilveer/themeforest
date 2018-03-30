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
 * Template file for create an animated banner
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.com>
 * @since 1.0.0
 */

global $yit_banner_index;
if ( ! isset( $yit_banner_index )  ) $yit_banner_index = 0;
    
$id = 'banner' . $yit_banner_index++;

$background = ( !empty( $background_image ) ) ? 'url(' . $background_image . ') repeat top left' : $background;
$icon  = ( empty( $icon ) ) ? '' :  $icon;
$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate '.$animate : '';
?>
<div class="sc-banner <?php echo $type . ( $style != 'no' ? ' ' . $style : '' ) ?> <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?> id="<?php echo $id ?>">
    <a href="<?php echo $url ?>" <?php echo ( $target == 'yes' ) ? ' target="_blank"' : '' ?>>
        <i class="fa fa-<?php echo $icon ?>"></i>
        <div class="sc-content">
            <h2><?php echo $title ?></h2>
            <?php if( !empty( $subtitle ) ) : ?><h3><?php echo $subtitle ?></h3><?php endif ?>
        </div>
    </a>
</div>
<style type="text/css">
#<?php echo $id ?> {width:<?php echo $width == '0' ? '100%' : $width . 'px' ?>;height:<?php echo $height ?>px;overflow:hidden}
<?php if( $style == 'no' ) : ?>
#<?php echo $id ?> {background: <?php echo $background ?>;border:1px solid <?php echo $border ?>}
#<?php echo $id ?> i {color:<?php echo $color_icon ?>;font-size:<?php echo $icon_size ?>px;margin-top:<?php echo intval( ( int ) $icon_size / 2 ) ?>}
#<?php echo $id ?> h2{color:<?php echo $color_title ?>;font-size:<?php echo $title_size ?>px;line-height:<?php echo $title_size ?>px}
<?php if( !empty( $subtitle ) ) : ?>#<?php echo $id ?> h3{color:<?php echo $color_subtitle ?>;font-size:<?php echo $subtitle_size ?>px;line-height:<?php echo $subtitle_size ?>px}<?php endif ?>

<?php if( empty( $background_image ) ) : ?>#<?php echo $id ?>:hover {background: <?php echo $background_hover ?>;border:1px solid <?php echo $border_hover ?>}<?php endif ?>
#<?php echo $id ?>:hover i {color:<?php echo $color_icon_hover ?>;font-size:<?php echo $icon_size_hover ?>px;margin-top:<?php echo intval( ( int ) $icon_size_hover / 2 ) ?>}
#<?php echo $id ?>:hover h2{color:<?php echo $color_title_hover ?>;font-size:<?php echo $title_size_hover ?>px;line-height:<?php echo $title_size_hover ?>px}
<?php if( !empty( $subtitle ) ) : ?>#<?php echo $id ?>:hover h3{color:<?php echo $color_subtitle_hover ?>;font-size:<?php echo $subtitle_size_hover ?>px;line-height:<?php echo $subtitle_size ?>px}<?php endif ?>
<?php endif ?>
</style>