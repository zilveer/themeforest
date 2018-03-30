<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$seed = mt_rand();
?>

<div class="modal-shortcode <?php echo esc_attr( $vc_css ); ?>">
    <div class="modal-opener" data-toggle="modal" data-target="#modal-<?php echo $seed?>">
        <?php
            if ( $opener == "text" ):

                if( $link_icon_type == 'theme-icon' ){
                    ?><span class="fa fa-<?php echo $link_icon_theme; ?>"></span><?php
                }
                elseif ( $link_icon_type == 'custom' ){
                    ?><img src="<?php echo $link_icon_url; ?>"></span><?php
                }
                    ?>
        <a title="<?php _e( 'Open Modal', 'yit' )?>" style="font-size: <?php echo ( ! empty( $link_text_size ) ) ? $link_text_size : 17?>px"><?php echo $link_text_opener ?></a>
        <?php
            elseif( $opener == "image" ):
        ?>
        <a title="<?php _e( 'Open Modal', 'yit' )?>"><img src="<?php echo $image_opener?>" /></a>
        <?php
            else:
        ?>
        <a class="button btn-<?php echo ( $button_style == 'alternative' ) ? "alternative" : "flat" ?>" title="<?php _e( 'Open Modal', 'yit' )?>"><?php echo $button_text_opener ?></a>
        <?php
            endif;
        ?>
    </div>

    <div class="modal fade" id="modal-<?php echo $seed?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?php echo $seed?>-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-times"></span></a>
                    <h3 class="modal-title" id="modal-<?php echo $seed?>-label"> <?php echo $title?> </h3>
                </div>
                <div class="modal-body">
                    <?php echo wpautop( do_shortcode( $content ) ) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>