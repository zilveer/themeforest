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
 * Template file for print a space
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.com>
 * @since 1.0.0
 */

$height = ( isset( $height ) && $height != '' ) ? intval( $height ) : 30;
?>
<div class="clear space" style="height: <?php echo $height ?>px"></div>