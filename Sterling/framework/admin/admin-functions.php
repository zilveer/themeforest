<?php

/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/

function of_head() {
    do_action( 'of_head' );
}

/*-----------------------------------------------------------------------------------*/
/* Get the style path currently selected */
/*-----------------------------------------------------------------------------------*/

function of_style_path() {

    $style = $_REQUEST['style'];

    if ( '' != $style ) {
        $style_path = $style;
    } else {
        $stylesheet = get_option( 'of_alt_stylesheet' );
        $style_path = str_replace( '.css', '', $stylesheet );
    }

    if ( 'default' == $style_path )
      echo 'images';
    else
      echo 'styles/' . $style_path;

}

/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'propanel_default_settings_install', 90 );
function propanel_default_settings_install(){

    if ( ! is_admin() )
        return;

    global $pagenow;

    // Check if we are on theme activation page and activated is true.
    if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) && true == $_GET['activated'] ) :
        // If we are on theme activation page, do the following..
        $template = get_option( 'of_template' );

        foreach ( $template as $t ) :
            $option_name    = esc_attr( $t['id'] );
            $default_value  = esc_attr( $t['std'] );
            $value_check    = get_option( $option_name );

            if ( '' == $value_check )
                update_option( $option_name, $default_value );
        endforeach;
    endif;

}

/*-----------------------------------------------------------------------------------*/
/* Admin Backend */
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_head', 'siteoptions_admin_head' );
function siteoptions_admin_head() {

    global $pagenow;

    // Check if we are on theme activation page and activated is true.
    if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) && true == $_GET['activated'] ) :
        if ( function_exists( 'wp_get_theme' ) ) :
            $theme_object   = wp_get_theme(); // WordPress 3.4.0 plus.
            $theme_name     = $theme_object->name;
        else :
            $theme_data = get_theme_data( get_template_directory() . '/style.css' ); // Before WordPress 3.4.0 deprecated function.
            $theme_name = $theme_data['Name'];
        endif;
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function($){
                var message = '<?php printf( __( '<p><strong>%s is now activated.</strong> The custom options panel is located under <a href="%s">Appearance > Site Options</a>.</p>', 'tt_theme_framework' ), esc_js( $theme_name ), esc_url(add_query_arg( array( 'page' => 'siteoptions' ), admin_url( 'admin.php' ) ) ) ); ?>';
                $('.themes-php #message2').html(message);
                
                <?php if(class_exists('Jetpack')): ?>
                var jetpack_message = '<div class="updated below-h2" id="message2" style="padding:10px"><p><strong>Attention:</strong><br /><br />We\'ve detected that the JetPack Plugin is currently installed.</p><p>If you wish to use Sterling\'s built-in Form Builder you will first need to disable the JetPack Contact Form, Publicize, and Sharing Modules.</p></div>';
                $(jetpack_message).insertAfter('.themes-php #message2');
                <?php endif; ?>
                
            });
        </script>
        <?php
    endif;

}