<?php

//define dynamic styles path
$upload_dir = wp_upload_dir();
if ( is_ssl() ) {
    if ( strpos( $upload_dir['baseurl'], 'https://' ) === false) {
        $upload_dir['baseurl'] = str_ireplace('http', 'https', $upload_dir['baseurl']);
    }
}

Kleo::set_config( 'upload_dir_path', $upload_dir['basedir'] );
Kleo::set_config( 'custom_style_path', $upload_dir['basedir'] . '/custom_styles' );
Kleo::set_config( 'custom_style_url', $upload_dir['baseurl'] . '/custom_styles' );
Kleo::set_config( 'custom_style_name', 'kleo_dynamic.css' );



/***************************************************
:: Render custom css resulted from theme options
 ***************************************************/

if ( ! is_admin() ) {

    if ( is_writable( trailingslashit( Kleo::get_config('upload_dir_path') ) ) ) {
        add_action( 'wp_enqueue_scripts', 'kleo_load_dynamic_css' );
    }
    else {
        add_action( 'wp_head', 'kleo_custom_head_css', 999 );
    }
}


/**
 * Load generated CSS file containing theme customizations
 *
 */
function kleo_load_dynamic_css() {

    $dynamic_file = trailingslashit( Kleo::get_config( 'custom_style_path' ) ) . Kleo::get_config( 'custom_style_name' ) ;

    //write the file if isn't there
    if ( ! file_exists( $dynamic_file ) || 0 == filesize( $dynamic_file ) ) {
        kleo_generate_dynamic_css();
    }

    wp_register_style( 'kleo-dynamic', trailingslashit( Kleo::get_config( 'custom_style_url' ) ) . Kleo::get_config( 'custom_style_name' ), array(), KLEO_THEME_VERSION, 'all' );
    wp_enqueue_style( 'kleo-dynamic' );
}



/**
 * Generate CSS styles in head section if write file was not possible
 */
function kleo_custom_head_css() {

    if ( ! class_exists( 'Less_Parser' ) ) {
        require_once KLEO_LIB_DIR . '/dynamic-css/less/Less.php';
    }

    $options = array( 'compress' => true );
    $variables = apply_filters( 'kleo_get_dynamic_variables', array() );

    $parser = new Less_Parser( $options );
    $parser->parseFile( THEME_DIR . "/assets/less/theme-dynamic.less", '' );
    $parser->ModifyVars( $variables );
    $css = $parser->getCss();

    echo "\n<style>";
    echo $css;
    echo '</style>';
}


function kleo_generate_dynamic_css() {

    if ( ! is_writable( trailingslashit( Kleo::get_config('upload_dir_path') ) ) ) {
        return;
    }

    if ( ! class_exists( 'Less_Parser' ) ) {
        require_once KLEO_LIB_DIR . '/dynamic-css/less/Less.php';
    }

    // dir doesn't exist, make it
    if ( ! is_dir( Kleo::get_config( 'custom_style_path' ) ) ) {
        wp_mkdir_p( Kleo::get_config( 'custom_style_path' ) );
    }

    $options = array();

    if ( sq_option( 'dev_mode', false ) == false )  {
        $options['compress'] = true;
    }

    $variables = apply_filters( 'kleo_get_dynamic_variables', array() );

    /* For the development team to easily test the less code */
    if ( defined( 'LOCAL_DEVELOPMENT' ) ) {
        $less_files = array();
        $less_files[THEME_DIR . "/assets/less/themes/default/variables.less"] = '';
        $less_files[THEME_DIR . "/assets/less/themes/default/mixins.less"] = '';
    } else {
        $less_files = array( THEME_DIR . "/assets/less/theme-dynamic.less" => '' );
    }

    $less_files = apply_filters( 'kleo_less_files', $less_files );
    $directories = array( THEME_DIR . "/assets/less" => '' );

    try {

        $parser = new Less_Parser( $options );
        $parser->SetImportDirs( $directories );
        if (! empty( $less_files )) {
            foreach( $less_files as $k => $v ) {
                $parser->parseFile( $k, '' );
            }
        }

        $parser->ModifyVars( $variables );
        $css = $parser->getCss();

        $file_path = trailingslashit( Kleo::get_config( 'custom_style_path' ) ) . Kleo::get_config( 'custom_style_name');

        if ( sq_fs_put_contents( $file_path, $css ) ) {
            // do nothing
        } elseif (is_admin()) {
            echo '<div class="error settings-error">';
            esc_html_e('Cannot write dynamic css file. Please check file permissions with hosting', 'buddyapp');
            echo '</div>';
        }

    } catch ( Exception $e ) {
        esc_html_e( 'Something went wrong when compiling less files.', 'buddyapp');
        echo esc_html( $e->getMessage() );
    }

}

if ( ! function_exists( 'kleo_unlink_dynamic_css' ) ) {
    function kleo_unlink_dynamic_css() {
        if ( file_exists(trailingslashit(Kleo::get_config('custom_style_path')) . Kleo::get_config('custom_style_name')) ) {
            // Delete it
            unlink( trailingslashit(Kleo::get_config('custom_style_path')) . Kleo::get_config('custom_style_name' ) );
        }
    }
}


add_action( 'init', 'kleo_manually_generate_css');

function kleo_manually_generate_css() {
    if ( is_super_admin() && isset($_GET['regen_css']) ) {
        kleo_unlink_dynamic_css();
    }
}
