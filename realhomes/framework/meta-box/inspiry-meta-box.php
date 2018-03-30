<?php
/**
 * Loads Meta Box Plugin and Related Extensions
 * Also, Loads related configuration file
 */

/**
 * Deactivate Meta Box Plugin and related extensions if Installed.
 * As Real Homes theme already have those embedded
 */
add_action( 'admin_init', function() {

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    // Meta Box Plugin
    if ( is_plugin_active( 'meta-box/meta-box.php' ) ) {
        deactivate_plugins( 'meta-box/meta-box.php' );
        add_action( 'admin_notices', function () {
            ?>
            <div class="update-nag notice is-dismissible">
                <p><strong><?php _e( 'Meta Box plugin has been deactivated!', 'framework' ); ?></strong></p>
                <p><?php _e( 'As now its functionality is embedded with in Real Homes theme.', 'framework' ); ?></p>
                <p><em><?php _e( 'So, You should completely remove it from your plugins.', 'framework' ); ?></em></p>
            </div>
            <?php
        } );
    }

    // Meta Box Columns
    if ( is_plugin_active( 'meta-box-columns/meta-box-columns.php' ) ) {
        deactivate_plugins( 'meta-box-columns/meta-box-columns.php' );
        add_action( 'admin_notices', function () {
            ?>
            <div class="update-nag notice is-dismissible">
                <p>
                    <strong><?php _e( 'Meta Box Columns plugin has been deactivated!', 'framework' ); ?></strong>
                    &nbsp;<?php _e( 'As now its functionality is embedded with in Real Homes theme.', 'framework' ); ?>
                </p>
                <p><em><?php _e( 'So, You should completely remove it from your plugins.', 'framework' ); ?></em></p>
            </div>
            <?php
        } );
    }

    // Meta Box Tabs
    if ( is_plugin_active( 'meta-box-tabs/meta-box-tabs.php' ) ) {
        deactivate_plugins( 'meta-box-tabs/meta-box-tabs.php' );
        add_action( 'admin_notices', function () {
            ?>
            <div class="update-nag notice is-dismissible">
                <p>
                    <strong><?php _e( 'Meta Box Tabs plugin has been deactivated!', 'framework' ); ?></strong>
                    &nbsp;<?php _e( 'As now its functionality is embedded with in Real Homes theme.', 'framework' ); ?>
                </p>
                <p><em><?php _e( 'So, You should completely remove it from your plugins.', 'framework' ); ?></em></p>
            </div>
            <?php
        } );
    }

    // Meta Box Show Hide
    if ( is_plugin_active( 'meta-box-show-hide/meta-box-show-hide.php' ) ) {
        deactivate_plugins( 'meta-box-show-hide/meta-box-show-hide.php' );
        add_action( 'admin_notices', function () {
            ?>
            <div class="update-nag notice is-dismissible">
                <p>
                    <strong><?php _e( 'Meta Box Show Hide plugin has been deactivated!', 'framework' ); ?></strong>
                    &nbsp;<?php _e( 'As now its functionality is embedded with in Real Homes theme.', 'framework' ); ?>
                </p>
                <p><em><?php _e( 'So, You should completely remove it from your plugins.', 'framework' ); ?></em></p>
            </div>
            <?php
        } );
    }

    // Meta Box Group
    if ( is_plugin_active( 'meta-box-group/meta-box-group.php' ) ) {
        deactivate_plugins( 'meta-box-group/meta-box-group.php' );
        add_action( 'admin_notices', function () {
            ?>
            <div class="update-nag notice is-dismissible">
                <p>
                    <strong><?php _e( 'Meta Box Group plugin has been deactivated!', 'framework' ); ?></strong>
                    &nbsp;<?php _e( 'As now its functionality is embedded with in Real Homes theme.', 'framework' ); ?>
                </p>
                <p><em><?php _e( 'So, You should completely remove it from your plugins.', 'framework' ); ?></em></p>
            </div>
            <?php
        } );
    }

} );


/**
 * Embedded Meta Box Plugin
 */
if ( ! class_exists( 'RW_Meta_Box' ) ) {
    define( 'RWMB_DIR', get_template_directory() . '/framework/meta-box/meta-box-plugin/' );
    define( 'RWMB_URL', get_template_directory_uri() . '/framework/meta-box/meta-box-plugin/' );
    require_once RWMB_DIR . 'meta-box.php';
}


/**
 * Columns Extension
 */
if ( !class_exists( 'RWMB_Columns' ) ) {
    require_once( get_template_directory() . '/framework/meta-box/extensions/meta-box-columns/meta-box-columns.php' );
}


/**
 * Tabs Extension
 */
if ( !class_exists( 'RWMB_Tabs' ) ) {
    require_once( get_template_directory() . '/framework/meta-box/extensions/meta-box-tabs/meta-box-tabs.php' );
}


/**
 * Show Hide Extension
 */
if ( !class_exists( 'RWMB_Show_Hide' ) ) {
    require_once( get_template_directory() . '/framework/meta-box/extensions/meta-box-show-hide/meta-box-show-hide.php' );
}


/**
 * Group Extension
 */
if ( !class_exists( 'RWMB_Group' ) ) {
    require_once( get_template_directory() . '/framework/meta-box/extensions/meta-box-group/meta-box-group.php' );
}


/**
 * Meta Box Configuration File
 */
require_once( get_template_directory() . '/framework/meta-box/config-meta-boxes.php' );


/**
 * Custom Meta Box Script - To provide additional details feature
 */
require_once( get_template_directory() . '/framework/include/additional-details-metabox.php' );

