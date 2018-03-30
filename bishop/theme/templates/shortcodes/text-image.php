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
 * Template file for text with image shortcode
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="text-with-image <?php echo esc_attr( $vc_css ); ?>" style="background-image: url('<?php echo esc_url($image) ?>'); <?php if( $last == 'yes' ) echo 'border:none;' ?>">
    <?php if( isset( $subtitle ) ): ?>
        <span><?php echo $subtitle ?></span>
    <?php endif; ?>

    <h3><?php echo $title ?></h3>

    <p><?php echo $content ?></p>

    <?php if( $button == 'yes' ){
        ?><a href="<?php echo esc_url( $link ) ?>" class="btn btn-flat"><?php echo $button_text ?></a> <?php
    }?>
</div>