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
 * Template file for show a title centered with line
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

$id = 'bxtitle_' .mt_rand();
$subtitle = ( isset( $subtitle ) || $subtitle != '' ) ? $subtitle: '';
$font_size = ( isset( $font_size ) || $font_size != '' ) ? $font_size: '15';
$font_alignment = ( isset( $font_alignment ) || $font_alignment != '' ) ? $font_alignment: 'center';
$border = ( isset( $border ) || $border != '' ) ? $border : 'none';
$content = ( isset( $content ) && $content != '' ) ? $content : '';

$title_style = "font-size: ".$font_size."px;";
$subtitle_style = "font-size: ".$subtitle_font_size."px;";
$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';

?>
<style>
    #<?php echo $id ?>.box-title.box-title-line-middle .title-bar:after,
    #<?php echo $id ?>.box-title.box-title-line-middle .title-bar:before,
    #<?php echo $id ?>.box-title.box-title-line-around .title-bar:after,
    #<?php echo $id ?>.box-title.box-title-line-around .title-bar:before,
    #<?php echo $id ?>.box-title.box-title-line-around h2{
        border-color: <?php echo $border_color; ?>
    }
</style>
<?php
switch ( $border ):
    case 'middle':
        ?>
        <div id="<?php echo $id ?>" class="box-title box-title-text-<?php echo esc_attr( $font_alignment . $animate . $vc_css ) ?> box-title-line-middle wrap-title <?php echo ( isset( $class ) ) ? $class : '' ?>" <?php echo $animate_data ?>>
            <div class="title-bar">
                <h2 style="<?php echo $title_style ?>">
                    <?php echo yit_decode_title( do_shortcode( $content ) ) ?>
                </h2>
            </div>
            <?php if( $subtitle != '' ):?>
                <p class="subtitle" style="<?php echo $subtitle_style ?>">
                    <?php echo yit_decode_title( $subtitle )?>
                </p>
            <?php endif;?>
        </div>
        <?php
        break;
    case 'bottom':
        ?>
        <div id="<?php echo $id ?>" class="box-title box-title-text-<?php echo $font_alignment  . $animate ?> box-title-line-bottom <?php echo ( isset( $class ) ) ? $class : '' ?>" <?php echo $animate_data ?>>
            <h2 style="<?php echo $title_style ?>">
                <?php echo yit_decode_title ( do_shortcode( $content ) )?>
            </h2>
            <?php if( $subtitle != '' ):?>
                <p class="subtitle" style="<?php echo $subtitle_style ?>">
                    <?php echo yit_decode_title( $subtitle )?>
                </p>
            <?php endif;?>
            <?php echo do_shortcode( "[separator margin_top=17 color={$border_color} style=single]" ) ?>
        </div>
        <?php
        break;
    case 'around':
        ?>
        <div id="<?php echo $id ?>" class="box-title box-title-text-<?php echo $font_alignment  . $animate ?> box-title-line-around wrap-title <?php echo ( isset( $class ) ) ? $class : '' ?>" <?php echo $animate_data ?>>
            <div class="title-bar">
                <h2 style="<?php echo $title_style ?>">
                    <?php echo yit_decode_title( do_shortcode( $content ) ) ?>
                </h2>
            </div>
            <?php if( $subtitle != '' ):?>
                <p class="subtitle" style="<?php echo $subtitle_style ?>">
                    <?php echo $subtitle?>
                </p>
            <?php endif;?>
        </div>
        <?php
        break;
    default:
        ?>
        <div id="<?php echo $id ?>" class="box-title box-title-text-<?php echo $font_alignment . $animate ?> box-title-line-none <?php echo ( isset( $class ) ) ? $class : '' ?>" style="<?php echo $title_style ?>" <?php echo $animate_data ?>>
            <h2>
                <?php echo yit_decode_title( do_shortcode( $content ) ) ?>
            </h2>
            <?php if( $subtitle != '' ):?>
                <p class="subtitle" style="<?php echo $subtitle_style ?>">
                    <?php echo $subtitle?>
                </p>
            <?php endif;?>
        </div>
        <?php
        break;

endswitch;
?>
