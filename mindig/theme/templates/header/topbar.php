<?php
/*
* This file belongs to the YIT Framework.
*
* This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://www.gnu.org/licenses/gpl-3.0.txt
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly
?>
<!-- START TOPBAR -->
<?php if ( apply_filters( 'yit-enable-topbar', yit_get_option( 'header-enable-topbar' ) ) == 'yes' ): ?>
    <div id="topbar" class="<?php echo class_exists( 'YIT_Style_Picker' ) ? apply_filters( 'yit-stylepicker-topbar-class', '' ) : ''; ?>">
        <div class="container">
            <div class="clearfix header-wrapper">
                <div id="topbar-left">
                    <?php if ( yit_get_header_skin() == 'skin2' ) {
                        yit_get_template( '/header/navigation.php' );
                    }
                    else {
                        yit_get_template( '/header/sidebar-topbar-left.php' );
                    } ?>
                    <?php // ?>
                    <?php  ?>
                </div>
                <div id="topbar-right">
                    <?php yit_get_template( '/header/sidebar-topbar-right.php' ) ?>
                    <?php if ( defined( 'ICL_SITEPRESS_VERSION' ) ): ?>
                        <?php yit_get_template( '/header/wpml.php' ); ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<!-- END TOPBAR -->