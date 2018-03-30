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

    <?php if ( has_nav_menu( 'mobile-nav' ) ) : ?>
        <!-- MOBILE MENU -->
        <div class="nav main-nav mobile-clone">
            <a href="#" class="menu-trigger fa fa-bars"></a>

            <?php
            $nav_args = array(
                'theme_location' => 'mobile-nav',
                'container' => 'none',
                'menu_class' => 'level-1 clearfix',
                'depth' => apply_filters( 'yit_main_nav_depth', 3 ),
            );

            wp_nav_menu( $nav_args );
            ?>

        </div>
        <!-- END MOBILE MENU -->
    <?php endif; ?>

    <?php
        wp_reset_query();
        if( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'header' ) ) { }
    ?>

    <!-- cart -->
    <?php do_action('yit_header_cart') ?>

</div>
<!-- END HEADER SIDEBAR -->
<?php echo ( yit_get_header_skin() == 'skin2') ? '</div><!-- end row1 -->' : '' ?>