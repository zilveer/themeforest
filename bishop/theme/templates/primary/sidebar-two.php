<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$sidebar = yit_get_sidebars();

if ( 'sidebar-double' != $sidebar['layout'] ) {
    return;
}

$sidebar_name = $sidebar['sidebar-left'];
?>

<!-- START SIDEBAR -->
<div class="sidebar sidebar-left col-sm-3 col-sm-pull-6 clearfix" role="secondary">

    <?php if ( ! dynamic_sidebar( $sidebar_name ) ) do_action( 'yit_default_sidebar' ) ?>

</div>
<!-- END SIDEBAR -->

