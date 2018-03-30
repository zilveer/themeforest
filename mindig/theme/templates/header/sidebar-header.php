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
?>

<!-- START HEADER SIDEBAR -->
<div id="header-sidebar">
    <?php
    wp_reset_query();
    if( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'header' ) ) { }
    ?>

    <!-- cart -->
    <?php do_action('yit_header_cart') ?>

</div>
<!-- END HEADER SIDEBAR -->
