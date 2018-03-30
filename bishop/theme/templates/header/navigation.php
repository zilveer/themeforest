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
?>

<!-- START NAVIGATION -->
<div id="nav" class="nav">

    <?php
    include_once( YIT_THEME_ASSETS_PATH . '/lib/Walker_Nav_Menu_Div.php' );
    $nav_args = array(
        'theme_location' => 'nav',
        'container' => 'none',
        'menu_class' => 'level-1 clearfix',
        'depth' => apply_filters( 'yit_main_nav_depth', 3 ),
    );

    if ( has_nav_menu( 'nav' ) )
        $nav_args['walker'] = new YIT_Walker_Nav_Menu_Div();

    wp_nav_menu( $nav_args );
    ?>

</div>
<!-- END NAVIGATION -->

