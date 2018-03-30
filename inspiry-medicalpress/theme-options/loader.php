<?php
/**
 *
 * Redux Custom Extension Loader
 *
 */
if(!function_exists('inspiry_redux_register_custom_extension_loader')) :
    function inspiry_redux_register_custom_extension_loader( $ReduxFramework ) {
        $path    = dirname( __FILE__ ) . '/extensions/';
            $folders = scandir( $path, 1 );
            foreach ( $folders as $folder ) {
                if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
                    continue;
                }
                $extension_class = 'ReduxFramework_Extension_' . $folder;
                if ( ! class_exists( $extension_class ) ) {
                    // In case you wanted override your override, hah.
                    $class_file = $path . $folder . '/extension_' . $folder . '.php';
                    $class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
                    if ( $class_file ) {
                        require_once( $class_file );
                    }
                }
                if ( ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
                    $ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
                }
            }
    }
    // Modify {$redux_opt_name} to match your opt_name
    add_action("redux/extensions/redux_demo/before", 'inspiry_redux_register_custom_extension_loader', 0);
endif;


/**
 * Filter for changing importer description info in options panel
 * when not setting in Redux config file.
 *
 * @param [string] $title description above demos
 *
 * @return [string] return.
 */
if ( !function_exists( 'wbc_importer_description_text' ) ) {
    function wbc_importer_description_text( $description ) {
        $message =  '<p>'. esc_html__( 'Only use demo importer on new WordPress install.', 'framework' ) . ' ' .
                    esc_html__( 'Imported images are only for demo purpose.', 'framework' ) .'</p>';
        return $message;
    }

    // Uncomment the below
    add_filter( 'wbc_importer_description', 'wbc_importer_description_text', 10 );
}


/**
 *
 * Set menu, home and news page
 *
 */
if ( !function_exists( 'inspiry_after_import_settings' ) ) {
    function inspiry_after_import_settings( $demo_active_import , $demo_directory_path ) {

        reset( $demo_active_import );
        $current_key = key( $demo_active_import );

        /**
         * Setting Menu
         */
        $wbc_menu_array = array( 'demo', 'fallback-demo' );
        if ( isset( $demo_active_import[$current_key]['directory'] ) &&
            !empty( $demo_active_import[$current_key]['directory'] ) &&
            in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
            $top_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
            if ( isset( $top_menu->term_id ) ) {
                set_theme_mod( 'nav_menu_locations', array(
                        'main-menu' => $top_menu->term_id,
                    )
                );
            }
        }

        /**
         * Setting Home Page
         */
        $wbc_home_pages = array(
            'demo' => 'Home',
            'fallback-demo' => 'Home',
        );
        if ( isset( $demo_active_import[$current_key]['directory'] ) &&
            !empty( $demo_active_import[$current_key]['directory'] ) &&
            array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
            $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
            if ( isset( $page->ID ) ) {
                update_option( 'page_on_front', $page->ID );
                update_option( 'show_on_front', 'page' );
            }
        }

        /**
         * Setting News Page
         */
        $wbc_blog_pages = array(
            'demo' => 'News',
            'fallback-demo' => 'News',
        );
        if ( isset( $demo_active_import[$current_key]['directory'] ) &&
            !empty( $demo_active_import[$current_key]['directory'] ) &&
            array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_blog_pages ) ) {
            $page = get_page_by_title( $wbc_blog_pages[$demo_active_import[$current_key]['directory']] );
            if ( isset( $page->ID ) ) {
                update_option( 'page_for_posts', $page->ID );
            }
        }

    }

    add_action( 'wbc_importer_after_content_import', 'inspiry_after_import_settings', 10, 2 );
}
