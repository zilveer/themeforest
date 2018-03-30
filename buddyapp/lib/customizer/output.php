<?php

/**
 * Generate output just for customizer view
 *
 */


/**
 * Generate CSS styles in head section
 *
 */
function kleo_customizer_custom_head_css() {

    if ( ! class_exists( 'Less_Parser' ) ) {
        require_once KLEO_LIB_DIR . '/dynamic-css/less/Less.php';
    }

    $css = '';

    $options = array( 'compress' => true );
    $variables  = apply_filters( 'kleo_get_dynamic_variables', array() );
    $directories = array( THEME_DIR . "/assets/less" => '' );

    try {
        $parser = new Less_Parser( $options );
        $parser->SetImportDirs( $directories );
        $less_files = array( THEME_DIR . "/assets/less/theme-dynamic.less" => '' );
        $less_files = apply_filters( 'kleo_less_files', $less_files );

        foreach($less_files as $k => $file) {
            $parser->parseFile( $k, '' );
        }

        $parser->ModifyVars( $variables );
        $css = $parser->getCss();
    } catch ( Exception $e ) {
        esc_html_e( 'Something went wrong when compiling less files.', 'buddyapp');
    }

    echo "\n<style>";
    echo $css;
    echo '</style>';
}

if ( is_customize_preview() ) {

    if (isset($_POST['customized']) && ! empty($_POST['customized']) && $_POST['customized'] != '{}' ) {
        add_filter( 'kleo_options', 'kleo_customizer_override_options' );
        add_action('wp_head', 'kleo_customizer_custom_head_css', 999);
    }
}

function kleo_customizer_override_options( $options ) {

    if (isset($_POST['customized']) && ! empty($_POST['customized']) && $_POST['customized'] != '{}' ) {
        $changed_options = json_decode( wp_unslash( $_POST['customized'] ), true );

        $new_options = array();

        foreach ( $changed_options as $key => $option ) {
            $replaced_key = rtrim(ltrim(str_replace( 'kleo_' . KLEO_DOMAIN, '', $key ), '['), ']');
            $new_options[$replaced_key] = $option;
        }

        return array_merge( $options, $new_options );
    }

    return $options;
}