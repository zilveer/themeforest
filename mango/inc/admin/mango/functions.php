<?php
//after save settings and reset settingsd
add_action ( 'redux/options/mango_settings/saved', 'mango_save_settings', 30 );
add_action ( 'redux/options/mango_settings/reset', 'mango_save_settings', 30 );
add_action ( 'redux/options/mango_settings/section/reset', 'mango_save_settings', 30 );

//for after demo import of theme options
add_action ( 'wbc_importer_after_theme_options_import', 'mango_after_theme_options_imported', 10, 2 );

//to import rev sliders
//add_action ( 'wbc_importer_after_theme_options_import', 'mango_import_rev_sliders', 11, 2 );

function mango_save_settings () {
    global $reduxmangoSettings, $mango_settings;
    update_option ( 'mango_init_theme', '1' );
    $reduxFramework = $reduxmangoSettings->ReduxFramework;
    $template_dir = get_template_directory ();
    $address = get_option ( "mango_google_address" );
    $saved_address = $mango_settings[ 'mango_google_map_address' ];
    if ( $address != $saved_address && $saved_address != '' ) {
        update_option ( "mango_google_address", $saved_address );
        $geo = file_get_contents ( 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode ( $saved_address ) . '&sensor=false' );
        $geo = json_decode ( $geo, true );
        // print_r($geo);
        if ( $geo[ 'status' ] == 'OK' ) {
            update_option ( "mango_lat", $geo[ 'results' ][ 0 ][ 'geometry' ][ 'location' ][ 'lat' ] );
            update_option ( "mango_lng", $geo[ 'results' ][ 0 ][ 'geometry' ][ 'location' ][ 'lng' ] );
        } else {
            update_option ( "mango_lat", "" );
            update_option ( "mango_lng", "" );
        }
    }

    ob_start ();
    //$mango_settings =  get_option('mango_settings');
    if ( $mango_settings[ 'mango_compile_css' ] ) {
        get_template_part ( 'inc/admin/mango/config' );
    } else {
        $mobile_menu_size = ( $mango_settings[ 'mobile_menu_enable_size' ] ) ? $mango_settings[ 'mobile_menu_enable_size' ] : 992; ?>
    @media (min-width:<?php echo esc_ettr($mobile_menu_size); ?>px) {
        .menu,#menu-container {
            display:block;
        }
        #mobile-menu-btn {
            display:none;
        }
        .side-menu .header-search-container.header-simple-search, .side-menu .smenu, #side-menu-footer {
            display: block;
        }
        .side-menu {
            position: fixed;
            top: 0;
            bottom: 0;
            width: 300px;
            z-index: 1040;
            padding: 0 5px 0 0;
        }
        #header.header12 #header-inner {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1030;
            background-color: #fff;
        }
        #header.header12 #header-inner .mango_nav_header_16{
            display : block;
        }
    }
    <?php }
    $_config_css = ob_get_clean ();
    $filename = $template_dir . '/_config/settings_' . get_current_blog_id () . '.css';
    if ( file_exists ( $filename ) ) {
        if ( is_writable ( $filename ) == false ) {
            @chmod ( $filename, 0755 );
        }
        //@unlink($filename);
    }

    $reduxFramework->filesystem->execute ( 'put_contents', $filename, array ( 'content' => $_config_css ) );
}

function mango_after_theme_options_imported ( $demo_active_import, $demo_directory_path ) {
    reset( $demo_active_import );
    $current_key = key( $demo_active_import );
    if(isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] )){
        update_option("mango_demo_content",$demo_active_import[$current_key]['directory']);
    }
    mango_save_settings ();
}

if ( !function_exists ( "mango_validate_skype_username" ) ) {
    function mango_validate_skype_username ( $field, $value ) {
        $error = false;
        $return[ 'value' ] = $value;
        if ( !preg_match ( '/^[a-z][a-z0-9\.,\-_]{5,31}$/i', $value ) ) {
            $field[ 'msg' ] = __ ( 'You must provide a valid skype username.', 'mango' );
            $error = true;
            $return[ 'error' ] = $field;
        }
        return $return;
    }
}

if ( !function_exists ( "mango_validate_skype_number" ) ) {
    function mango_validate_skype_number ( $field, $value ) {
        $error = false;
        $return[ 'value' ] = $value;
        if ( !preg_match ( '/^([+]?)([0-9]{9,15})$/', $value ) ) {
            $field[ 'msg' ] = __ ( "You must provide a valid skype number.", 'mango' );
            $error = true;
            $return[ 'error' ] = $field;
        }
        return $return;
    }
}

function mango_hex2rgb ( $hex ) {
    $hex = str_replace ( '#', '', $hex );

    if ( strlen ( $hex ) === 3 ) {
        $r = hexdec ( substr ( $hex, 0, 1 ) . substr ( $hex, 0, 1 ) );
        $g = hexdec ( substr ( $hex, 1, 1 ) . substr ( $hex, 1, 1 ) );
        $b = hexdec ( substr ( $hex, 2, 1 ) . substr ( $hex, 2, 1 ) );
    } else {
        $r = hexdec ( substr ( $hex, 0, 2 ) );
        $g = hexdec ( substr ( $hex, 2, 2 ) );
        $b = hexdec ( substr ( $hex, 4, 2 ) );
    }

    return array ( $r, $g, $b );
}

function mango_rgb2hex ( $rgb ) {
    $hex = "#";
    $hex .= str_pad ( dechex ( $rgb[ 0 ] ), 2, "0", STR_PAD_LEFT );
    $hex .= str_pad ( dechex ( $rgb[ 1 ] ), 2, "0", STR_PAD_LEFT );
    $hex .= str_pad ( dechex ( $rgb[ 2 ] ), 2, "0", STR_PAD_LEFT );

    return $hex; // returns the hex value including the number sign (#)
}

function mango_generate_alternate_color_levels ( $color, $level ) {
    $rgb = mango_hex2rgb ( $color );
    $rgb[] = $level;
    $r = "rgba(";
    $r .= implode ( ", ", $rgb );
    $r .= ")";
    return $r;
}

function mango_generate_theme_color_shades ( $color, $num ) {
    $rgb = mango_hex2rgb ( $color );
    if ( $num == 1 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 10;
        $rgb[ 1 ] = $rgb[ 1 ] + 6;
        $rgb[ 2 ] = $rgb[ 2 ] + 6;
    } else if ( $num == 2 ) {
        $rgb[ 0 ] = $rgb[ 0 ] - 23;
        $rgb[ 1 ] = $rgb[ 1 ] - 6;
        $rgb[ 2 ] = $rgb[ 2 ] - 6;
    } else if ( $num == 3 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 3;
        $rgb[ 1 ] = $rgb[ 1 ] - 21;
        $rgb[ 2 ] = $rgb[ 2 ] - 21;
    } else if ( $num == 4 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 5;
        $rgb[ 1 ] = $rgb[ 1 ] + 45;
        $rgb[ 2 ] = $rgb[ 2 ] + 45;
    } else if ( $num == 5 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 12;
        $rgb[ 1 ] = $rgb[ 1 ] + 11;
        $rgb[ 2 ] = $rgb[ 2 ] + 11;
    } else if ( $num == 6 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 23;
        $rgb[ 1 ] = $rgb[ 1 ] - 1;
        $rgb[ 2 ] = $rgb[ 2 ] - 1;
    } else if ( $num == 7 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 44;
        $rgb[ 1 ] = $rgb[ 1 ] + 121;
        $rgb[ 2 ] = $rgb[ 2 ] + 121;
    }

    for ( $i = 0; $i <= 2; $i ++ ) {
        if ( $rgb[ $i ] > 255 ) {
            $rgb[ $i ] = 255;
        }
        if ( $rgb[ $i ] < 0 ) {
            $rgb[ $i ] = 00;
        }
    }

    return mango_rgb2hex ( $rgb );
}

function mango_generate_theme_alter_color_shades ( $color, $num ) {
    $rgb = mango_hex2rgb ( $color );
    if ( $num == 1 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 38;
        $rgb[ 1 ] = $rgb[ 1 ] + 38;
        $rgb[ 2 ] = $rgb[ 2 ] + 38;
    } else if ( $num == 2 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 26;
        $rgb[ 1 ] = $rgb[ 1 ] + 26;
        $rgb[ 2 ] = $rgb[ 2 ] + 26;
    } else if ( $num == 3 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 49;
        $rgb[ 1 ] = $rgb[ 1 ] + 49;
        $rgb[ 2 ] = $rgb[ 2 ] + 49;
    } else if ( $num == 4 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 60;
        $rgb[ 1 ] = $rgb[ 1 ] + 60;
        $rgb[ 2 ] = $rgb[ 2 ] + 60;
    } else if ( $num == 5 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 74;
        $rgb[ 1 ] = $rgb[ 1 ] + 74;
        $rgb[ 2 ] = $rgb[ 2 ] + 74;
    } else if ( $num == 6 ) {
        $rgb[ 0 ] = $rgb[ 0 ] + 84;
        $rgb[ 1 ] = $rgb[ 1 ] + 84;
        $rgb[ 2 ] = $rgb[ 2 ] + 84;
    }

    for ( $i = 0; $i <= 2; $i ++ ) {
        if ( $rgb[ $i ] > 255 ) {
            $rgb[ $i ] = 255;
        }
        if ( $rgb[ $i ] < 0 ) {
            $rgb[ $i ] = 00;
        }
    }

    return mango_rgb2hex ( $rgb );
}
?>