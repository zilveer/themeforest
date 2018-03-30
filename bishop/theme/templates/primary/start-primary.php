<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$sidebar = yit_get_sidebars();


?>
<!-- START PRIMARY -->
<div id="primary">
    <?php do_action( 'yit_after_primary_starts' ) ?>
    <div class="container <?php echo $sidebar['layout']; ?> clearfix">
        <div class="row">
