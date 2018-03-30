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
		$class_icon = $class_icon_opened.' opened';
	else : 
		$class = 'closed';
        $title_link = __( 'Open', 'yit' );
        $class_icon = $class_icon_closed.' closed';
	endif;			
?>
<div class="toggle <?php esc_attr( $vc_css )?>">
    <h4 class="tab-index tab-<?php echo $class; ?>"><a href="#" title="<?php echo $title_link ?>"><span class="<?php echo $class_icon; ?>" data-opened="<?php echo $class_icon_opened ?> opened" data-closed="<?php echo $class_icon_closed ?> closed"></span> <?php echo $title; ?></a></h4>
    <div class="content-tab <?php echo $class; ?>">
        <?php echo wpautop($content); ?>
    </div>  
</div>