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
$content_cols = 12;
$content_order = '';

if ( $sidebar['layout'] == 'sidebar-left' ) {
    $content_cols -= 3;
    $content_order = ' col-sm-push-3';
}
elseif ( $sidebar['layout'] == 'sidebar-right' ) {
    $content_cols -= 3;
}
elseif ( $sidebar['layout'] == 'sidebar-double' && $sidebar['sidebar-left'] != '-1' ) {
    $content_cols -= 6;
    $content_order = ' col-sm-push-3';
}


?>

<!-- START CONTENT -->
<div class="content col-sm-<?php echo $content_cols ?><?php echo $content_order ?> clearfix" role="main">

    <?php do_action( 'yit_content_loop' ) ?>

</div>
<!-- END CONTENT -->