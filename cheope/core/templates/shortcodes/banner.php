<?php
/**
 * Your Inspiration Themes
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

global $yit_banner_index;
if ( ! isset( $yit_banner_index )  ) $yit_banner_index = 0;
    
$id = 'banner' . $yit_banner_index++;

$background = ( !empty( $background_image ) ) ? 'url(' . $background_image . ') repeat top left' : $background;
$icon  = ( empty( $icon ) ) ? '' : '' . str_replace('icon-', '', $icon);
?>
<div class="sc-banner <?php echo $type . ( $style != 'no' ? ' ' . $style : '' ) ?>" id="<?php echo $id ?>">
    <a href="<?php echo $url ?>" <?php echo ( $target == 'yes' ) ? ' target="_blank"' : '' ?>>
        <i class="icon-<?php echo $icon ?>"></i>
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