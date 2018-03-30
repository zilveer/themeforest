<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

$sidebars = YIT_Plugin_Sidebar()->custom_sidebars; ?>

<div class="wrap" id="layout-panel-option">
    <h2><?php echo __( 'Sidebar Settings', 'yit' ) ?></h2>
    <div id="layout-panel">
        <div id="poststuff">
            <p id="message"></p>
            <form id="sidebar-form">
                <?php wp_nonce_field( 'yit-add-sidebar', 'wpnonce-sidebar' ) ?>
                <div id="add-sidebar" class="postbox">
                    <h3><?php echo __( 'Add Sidebar ', 'yit' ) ?></h3>
                    <div class="inside">
                        <div class="option">
                            <div class="panel-field clearfix" style="margin-top: 20px; margin-bottom:20px">
                                <input type="text" name="add-sidebar-name" id="add-sidebar-name" value="" style="float:left; width:400px; ">
                                <input type="submit" class="button-primary" id="sidebar-form-submit" value="<?php _e( 'Add', 'yit' ) ?>" style="float:left;margin-left:10px;" />
                                <span class="spinner"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="postbox">
                <h3><?php echo __( 'Custom Sidebars', 'yit' ) ?></h3>

                <div class="inside">
                    <ul class="sidebar-list">
                        <?php if ( ! empty( $sidebars ) ):
                            $i = 0;
                            foreach ( $sidebars as $sidebar ): ?>
                                <li>
                                    <span class="delete"><a href="#" data-id="<?php echo $i ++ ?>" data-nonce="<?php echo wp_create_nonce( 'delete-sidebar' ) ?>" title="<?php _e( 'Delete', 'yit' ) ?>"></a></span><?php echo $sidebar ?>
                                    <span class="spinner"></span>
                                </li>
                            <?php endforeach;
                        endif ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>




