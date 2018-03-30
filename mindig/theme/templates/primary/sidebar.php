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

if ( ( isset( $sidebar['layout'] ) || ! $sidebar['layout'] ) && 'sidebar-no' == $sidebar['layout'] ) {
    return;
}

$sidebar_position = $sidebar['layout'] == 'sidebar-double' ? 'sidebar-right' : $sidebar['layout'];
$sidebar_pull = $sidebar_position == 'sidebar-left' ? ' col-sm-pull-9' : '';


$sidebar_name = $sidebar[ $sidebar_position ];
?>

<!-- START SIDEBAR -->
<div class="sidebar <?php echo $sidebar_position ?><?php echo $sidebar_pull; ?> col-sm-3 clearfix" role="secondary">

    <?php do_action('yit_product_single_boxmeta'); ?>

    <?php if ( ! dynamic_sidebar( $sidebar_name ) ) do_action( 'yit_default_sidebar' ) ?>

</div>
<!-- END SIDEBAR -->

