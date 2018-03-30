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
 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
 * @since 2.0.0
 */

$breaks = array("<br />","<br>","<br/>");
$content = str_ireplace($breaks, "", $content);
$breaks = array("<p>");
$content = str_ireplace($breaks, "\r\n", $content);
$breaks = array("</p>");
$content = str_ireplace($breaks, "", $content);
?>
<div class="code-container <?php echo esc_attr( $vc_css )?>"><pre><?php echo $content; ?></pre></div>