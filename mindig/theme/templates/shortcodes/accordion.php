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
 * Template file for create a toggle content
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

wp_enqueue_script( 'yit-shortcodes' );

if ( isset($opened) && $opened == 'yes' ) :
    $class = 'opened';
    $title_link = __( 'Close', 'yit' );
    $class_icon = 'fa fa-' . $class_icon_opened.' opened';
else :
    $class = 'closed';
    $title_link = __( 'Open', 'yit' );
    $class_icon = 'fa fa-' . $class_icon_closed.' closed';
endif;

$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';

?>
<div class="toggle <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?>>
    <div class="toggle-title tab-index tab-<?php echo $class; ?>">
        <span class="<?php echo $class_icon; ?>" data-opened="fa fa-<?php echo $class_icon_opened ?> opened" data-closed="fa fa-<?php echo $class_icon_closed ?> closed"></span>
        <h4>
            <?php echo $title; ?>
        </h4>
    </div>
    <div class="content-tab <?php echo $class; ?>">
        <?php echo wpautop($content); ?>
    </div>
</div>