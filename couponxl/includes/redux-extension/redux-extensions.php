<?php
// Replace {$redux_opt_name} with your opt_name.
// Also be sure to change this function name!
$couponxl_extension_path = get_template_directory() . '/includes/redux-extension/extensions/';
if(!function_exists('couponxl_redux_register_custom_extension_loader')) :
    function couponxl_redux_register_custom_extension_loader($ReduxFramework) {
            global $couponxl_extension_path;
            $folders = scandir( $couponxl_extension_path, 1 );
            foreach ( $folders as $folder ) {
                if ( $folder === '.' or $folder === '..' or ! is_dir( $couponxl_extension_path . $folder ) ) {
                    continue;
                }
                $extension_class = 'ReduxFramework_Extension_' . $folder;
                if ( ! class_exists( $extension_class ) ) {
                    // In case you wanted override your override, hah.
                    $class_file = $couponxl_extension_path . $folder . '/extension_' . $folder . '.php';
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
    add_action("redux/extensions/couponxl_options/before", 'couponxl_redux_register_custom_extension_loader', 0);
endif;
?>