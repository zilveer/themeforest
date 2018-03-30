<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/* === ADMIN SERVICE FUNCTIONS === */

if ( ! function_exists( 'yit_backup_reset_compatibility_check' ) ) {
    /**
     * Check Plugin compatibility
     *
     * @return void
     * @since  1.0
     * @author Andrea Grillo   <andrea.grillo@yithemes.com>
     */
    function yit_backup_reset_compatibility_check() {

        $headers['core']   = defined( 'YIT_CORE_VERSION' ) ? YIT_CORE_VERSION : false;
        $headers['author'] = wp_get_theme()->get( 'Author' );

        $is_new_yith_fw = ( ( ! empty( $headers['core'] ) && version_compare( $headers['core'], '2.0.0', '<=' ) ) || $headers['author'] != 'Your Inspiration Themes' ) ? true : false;

        return ( $is_new_yith_fw && is_admin() && ! class_exists( 'YIT_Free' ) );

    }
}


if ( ! function_exists( 'yit_backup_reset_load_text_domain' ) ) {
    /**
     * Load the plugin text domain for localization
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
     */
    function yit_backup_reset_load_text_domain() {
        load_plugin_textdomain( 'yit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }
}


if ( ! function_exists( 'yit_backup_reset_loader' ) ) {
    /**
     * Load the core of the plugin, added to "after_theme_setup" so you can load the core only if it isn't loaded by plugin
     *
     * @return void
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     * @author Andrea Grillo   <andrea.grillo@yithemes.com>
     */
    function yit_backup_reset_loader() {
        if ( yit_backup_reset_compatibility_check() ) {
            add_filter( 'yit_panel_submenu_paths', 'yit_backup_reset_add_panel_template' );
            add_filter( 'yit_admin_menu_pages', 'yit_backup_reset_add_admin_menu_pages' );
            yit_backup_reset_init();
            YIT_Backup_Reset();
        }
    }
}

if ( ! function_exists( 'yit_backup_reset_add_panel_template' ) ) {
    /**
     * Add plugin path to panel template directory
     *
     * @param $path | Theme Path
     *
     * @return array
     *
     * @since  1.0
     * @author Andrea Grillo   <andrea.grillo@yithemes.com>
     */
    function yit_backup_reset_add_panel_template( $path ) {
        $plugin_path = array(
            YIT_BACKUP_RESET_PATH . 'core/yit/panel',
            YIT_BACKUP_RESET_PATH . 'theme/yit/panel'
        );

        return array_merge( $path, $plugin_path );
    }
}

if ( ! function_exists( 'yit_backup_reset_add_admin_menu_pages' ) ) {

    /**
     * Add plugin path to admin menu page template directory
     *
     * @param $path | Admin Path
     *
     * @return array
     *
     * @since  1.0
     * @author Andrea Grillo   <andrea.grillo@yithemes.com>
     */
    function yit_backup_reset_add_admin_menu_pages( $path ) {

        $new_options_page = array(
            /* Sample Data */
            'sample-data'      => array(
                'sample-data-and-image' => array(
                    'install-and-downloads',
                )
            ),

            /* Backup & Reset Tabs */
            'backup-and-reset' => array(
                'backup' => array(
                    'import-and-export-data',
                    'theme_options_backups'
                ),

                'reset'  => array(
                    'reset-option'
                )
            ) );

        return array_merge( $path, $new_options_page );
    }
}

if ( ! function_exists( 'yit_backup_reset_add_plugin_template_path' ) ) {
    /**
     * Return plugin path
     *
     * @return string | The plugin path
     *
     * @since  1.0
     * @author Andrea Grillo   <andrea.grillo@yithemes.com>
     */
    function yit_backup_reset_add_plugin_template_path() {
        return YIT_BACKUP_RESET_PATH;
    }
}

if ( ! function_exists( 'yit_backup_reset_panel_plugin_template_path' ) ) {
    /**
     * Return plugin path
     *
     * @param $paths
     *
     * @return string | The core folder path from plugin
     *
     * @since  1.0
     * @author Andrea Grillo   <andrea.grillo@yithemes.com>
     */
    function yit_backup_reset_panel_plugin_template_path( $paths ) {
        $paths[] = YIT_BACKUP_RESET_THEME_PATH;
        return $paths;
    }
}

/* === SUPPORT TO THIRD PART PLUGINS FUNCTIONS === */

/**
 * Revolution Slider
 */

if ( ! function_exists( 'yit_add_revolution_slider_tables' ) ) {
    /**
     * add Revolution Slider table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yit_add_revolution_slider_tables( $tables ) {
        global $wpdb;

        if ( ! class_exists( 'GlobalsRevSlider' ) ) {
            return $tables;
        }

        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_sliders );
        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_slides );
        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_static_slides );
        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_settings );
        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_css );
        $tables['plugins'][] = str_replace( $wpdb->prefix, '', GlobalsRevSlider::$table_layer_anims );

        $tables['options'][] = 'revslider%';

        return $tables;
    }
}

if ( ! function_exists( 'yit_export_revslider_global_styles' ) ) {
    /**
     * Export Global Styles Css in multisite
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $export Array
     *
     * @return mixed array | bool
     * @since    1.1.1
     */
    function yit_export_revslider_global_styles( &$export ) {
        if ( is_multisite() ) {
            $revslider_static_css = get_site_option( 'revslider-static-css' );
            if ( false != $revslider_static_css ) {
                $export['revslider_static_css'] = $revslider_static_css;
            }
        }
    }
}

if ( ! function_exists( 'yit_import_revslider_global_styles' ) ) {
    /**
     * Import Global Styles
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $import Array
     *
     * @return mixed array | bool
     * @since    1.1.1
     */
    function yit_import_revslider_global_styles( $import ) {
        //check if the file has been exported from a multisite
        if ( isset( $import['revslider_static_css'] ) ) {
            if ( ! is_multisite() ) {
                //simply add the revslider static css options
                update_option( 'revslider-static-css', $import['revslider_static_css'] );
            }
        }
    }
}

/**
 * WooCommerce
 */

if ( ! function_exists( 'yit_add_wc_tables' ) ) {
    /**
     * Add WooCommerce table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yit_add_wc_tables( $tables ) {
        $tables['plugins'][] = 'woocommerce%';
        $tables['options'][] = '%woocommerce%';
        $tables['options'][] = '%wc%';
        $tables['options'][] = '%shop%';

        return $tables;
    }
}

if ( ! function_exists( 'yit_remove_wc_installation_notice' ) ) {
    /**
     * Remove WooCommerce notice after sample data setup
     *
     * we no longer need to install woocommerce pages
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @return void
     * @since    1.1.1
     */
    function yit_remove_wc_installation_notice() {
        delete_option( '_wc_needs_pages' );
        delete_transient( '_wc_activation_redirect' );
    }
}

/**
 * Wordpress Social Login
 */

if ( ! function_exists( 'yit_add_wp_social_login_tables' ) ) {
    /**
     * add wp social login table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yit_add_wp_social_login_tables( $tables ) {
        $wp_social_login_table_name = 'wsl%';

        $tables['plugins'][] = $wp_social_login_table_name;
        $tables['options'][] = $wp_social_login_table_name;

        return $tables;
    }
}

/**
 * Essential Grid
 */

if ( ! function_exists( 'yit_add_essential_grid_tables' ) ) {
    /**
     * add essential slider table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yit_add_essential_grid_tables( $tables ) {
        global $wpdb;

        $tables['plugins'][] = str_replace( $wpdb->prefix, '', Essential_Grid::TABLE_GRID );
        $tables['plugins'][] = str_replace( $wpdb->prefix, '', Essential_Grid::TABLE_ITEM_SKIN );
        $tables['plugins'][] = str_replace( $wpdb->prefix, '', Essential_Grid::TABLE_ITEM_ELEMENTS );
        $tables['plugins'][] = str_replace( $wpdb->prefix, '', Essential_Grid::TABLE_NAVIGATION_SKINS );

        $tables['options'][] = 'tp%';
        $tables['options'][] = 'esg%';

        return $tables;
    }
}

/**
 * Screets ChatX
 */

if ( ! function_exists( 'yit_add_screets_chatx_tables' ) ) {
    /**
     * add essential slider table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yit_add_screets_chatx_tables( $tables ) {
        global $wpdb;

        $screets_chatx_table_name = defined( 'CX_PX' ) ? ( str_replace( $wpdb->prefix, '', CX_PX ) ) : 'cx_';
        $tables['plugins'][]      = $screets_chatx_table_name . '%';

        if ( class_exists( 'CX_options' ) ) {
            $tables['options'][] = '%screets%';
        }

        return $tables;
    }
}

/* === SUPPORT TO YIT PLUGINS FUNCTIONS === */

/**
 * YIT Faqs
 */

if ( ! function_exists( 'yit_add_faqs_tables' ) ) {
    /**
     * add YTH faqs table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.0.2
     */
    function yit_add_faqs_tables( $tables ) {
        $tables['plugins'][] = YIT_Faq()->term_meta_table_name;

        return $tables;
    }
}

/**
 * YITH Wishlist
 */

if ( ! function_exists( 'yit_add_wishlist_tables' ) ) {
    /**
     * Add YITH Wishlist table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.1.1
     */
    function yit_add_wishlist_tables( $tables ) {
        $tables['plugins'][] = YITH_WCWL_TABLE;

        return $tables;
    }
}

/**
 * WP Google Fonts
 */

if ( ! function_exists( 'yit_add_wp_googlefonts_tables' ) ) {
    /**
     * Add WP Google Fonts table to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.2.1
     */
    function yit_add_wp_googlefonts_tables( $tables ) {
        $tables['options'][] = 'googlefonts%';

        return $tables;
    }
}

/**
 * YIT Advanced Reviews
 */

if( ! function_exists( 'yit_add_wc_advanced_reviews_tables' ) ) {
    /**
     * Add YIT Advanced Reviews to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $tables
     *
     * @return mixed array
     * @since    1.2.1
     */
    function yit_add_wc_advanced_reviews_tables( $tables ) {
        $tables['options'][] = 'ywar%';

        return $tables;
    }
}

/**
 * YIT Advanced Reviews
 */

if( ! function_exists( 'yit_add_wc_multi_vendor_tables' ) ) {
    /**
     * Add YITH WooCommerce Multi Vendor to export functions
     *
     * @author   Andrea Grillo  <andrea.grillo@yithemes.com>
     *
     * @param $tables
     *
     * @return mixed array
     * @since    1.2.1
     */
    function yit_add_wc_multi_vendor_tables( $tables ) {
        $tables['options'][] = '%yith_wpv%';
        $tables['plugins'][] = 'yith_vendors_commissions';
        $tables['plugins'][] = 'yith_vendors_commissions_notes';

        return $tables;
    }
}




function yit_backup_reset_init() {
    /* WooCommerce Plugin */
    if ( function_exists( 'WC' ) ) {
        //Remove the "Install WC Pages" and "WC Welcome Screen" after sample data installation
        add_action( 'yit_backup_reset_after_file_import', 'yit_remove_wc_installation_notice' );
    }

    /* Revolution Slider Plugin */
    if ( class_exists( 'GlobalsRevSlider' ) ) {
        add_action( 'yit_backup_reset_before_download_gz', 'yit_export_revslider_global_styles' );
        add_action( 'yit_backup_reset_after_file_import', 'yit_import_revslider_global_styles' );
    }

    /* === FILTERS === */
    if ( is_admin() ) {
        add_filter( 'yit_add_external_template_path', 'yit_backup_reset_add_plugin_template_path' );
        add_filter( 'yit_panel_template_paths', 'yit_backup_reset_panel_plugin_template_path' );

        /* === CHECK FOR THIRD PART PLUGINS === */

        /* Revolution Slider Plugin */
        if ( class_exists( 'GlobalsRevSlider' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_revolution_slider_tables' );
        }

        /* WooCommerce and YITH Wishlist Plugins */
        if ( function_exists( 'WC' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_wc_tables' );
        }

        /* Wordpress Social Login Plugin */
        if ( defined( 'WORDPRESS_SOCIAL_LOGIN_ABS_PATH' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_wp_social_login_tables' );
        }

        /* Essential Grid Plugin */
        if ( class_exists( 'Essential_Grid' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_essential_grid_tables' );
        }

        /* Wordpress Screets CX Plugin */
        if ( class_exists( 'CX' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_screets_chatx_tables' );
        }

        /* WP Google Fonts */
        if ( class_exists( 'googlefonts' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_wp_googlefonts_tables' );
        }

        /* === CHECK FOR YIT PLUGINS === */

        /* YIT FAQ Plugin */
        if ( function_exists( 'YIT_Faq' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_faqs_tables' );
        }

        /* YITH Wishlist Plugin */
        if ( defined( 'YITH_WCWL_TABLE' ) && function_exists( 'WC' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_wishlist_tables' );
        }

        /* YITH Advanced Reviews Plugin */
        if( defined( 'YITH_YWAR_FILE' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_wc_advanced_reviews_tables' );
        }

        /* YITH WooCommerce Multi Vendor Premium */
        if( defined( 'YITH_WPV_PREMIUM' ) ) {
            add_filter( 'yit_export_data_tables', 'yit_add_wc_multi_vendor_tables' );
        }
    }
}

if ( ! function_exists( 'YIT_Backup_Reset' ) ) {
    /**
     * Return the instance of YIT_Panel class
     *
     * @return \YIT_Panel
     * @since    2.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function YIT_Backup_Reset() {
        return new YIT_Backup_reset();
    }
}