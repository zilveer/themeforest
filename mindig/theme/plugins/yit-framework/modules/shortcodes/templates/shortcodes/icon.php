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
 * Template file for show icon
 *
 * @package Yithemes
 * @author  Emanuela Castorina <emanuela.castorina@yithemes.com>
 * @since   1.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

$icon_data = '';
$icon = '';
$icon_type = ( $icon_type == '' ) ? 'theme-icon' : $icon_type;

if ( $icon_type == 'theme-icon' ) :

    $color_property = ( $color == '' ) ? '' : 'color:' . $color . ';';
    $border_color   = ( $color == '' ) ? '' : 'border-color:' . $color . ';';
    $icon_size      = ( $icon_size == '' ) ? '60' : $icon_size;
    $circle         = ( $circle == 'no' ) ? false : true;
    if ( isset( $icon_theme ) && $icon_theme != '' ) {
        
        if( strpos( $icon_theme, ':' )  ){
            $icon_data = YIT_Plugin_Common::get_icon( $icon_theme );    
            $icon = '<i ' . $icon_data . ' style="' . $color_property . ' font-size: ' . $icon_size . 'px"></i>';
        }else{
            $icon = '<i class="fa fa-'. $icon_theme .'" style="'. $color_property.' font-size: '.$icon_size.'px"></i>';
        }    
    }


    ?>
    <?php if ( $circle ): ?>
    <span class="icon-circle" style="width:<?php echo $circle_size ?>px; height:<?php echo $circle_size ?>px; <?php echo $border_color ?>;">
        <?php echo $icon ?>
    </span>
<?php else: ?>
    <?php echo $icon ?>
<?php endif ?>
<?php else: ?>
    <img src="<?php echo $icon_url ?>">
<?php endif ?>