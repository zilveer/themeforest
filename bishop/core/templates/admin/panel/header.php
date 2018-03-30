<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * The header of the panel.
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$admin_logo = yit_get_option("admin-logo-header");

?>

<?php if (isset($admin_logo) && !empty($admin_logo) && $admin_logo!="") : ?>

    <style>
        #yit-header #logo{
            background: url('<?php echo $admin_logo; ?>') left no-repeat;
            background-size: contain;
        }
    </style>

<?php endif; ?>


<div class="wrap">
    <!-- START HEADER -->
    <?php if(YIT_SHOW_PANEL_HEADER) :?>
        <div id="yit-header">
            <div id="logo"></div>

            <div id="info">
                <p class="name-theme"><?php echo $theme . ' ' . $version; ?></p>
                <p class="framework-version">YIT Framework <?php echo YIT_CORE_VERSION; ?></p>
            </div>
        </div>
    <?php endif ?>
    <!-- END HEADER -->

    <!-- START UTILITY BAR -->
    <?php if(YIT_SHOW_PANEL_HEADER_LINKS): ?>
        <div id="yit-utility-bar">
            <p><?php printf( __( '<strong>Need support?</strong> View the <a href="%s">documentation</a> ', 'yit' ), YIT_DOCUMENTATION_URL );
                printf( __( 'or submit a ticket in our <a href="%s" title="Support platform">support platform</a>', 'yit' ), YIT_SUPPORT_URL ) ?></p>
            <p class="right"><a href="<?php echo get_template_directory_uri() . '/readme.txt' ?>"><?php _e( 'Theme Changelog', 'yit' ) ?></a></p>
        </div>
    <?php endif ?>
    <!-- END UTILITY BAR -->


    <div class="wrap" id="yit_container">
        <div id="yit-wrapper">
