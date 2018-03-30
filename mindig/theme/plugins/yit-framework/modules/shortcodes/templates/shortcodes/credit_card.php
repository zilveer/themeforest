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
 * Template file for how an images of credit cards
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

    $card = explode(',', str_replace(' ', '',$type));
?>
<?php foreach ($card as $type) : 
	if ($type != '') : ?>
	<div class="credit_card <?php echo esc_attr( $type. $vc_css ) ?>"></div>
<?php endif;
endforeach ?>