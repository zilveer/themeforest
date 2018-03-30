<?php
/**
 * The functions for the fonts of the theme
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */

define( 'YIW_FONT_OPTION_ID', apply_filters( 'yiw_font_option_id', 'font_%s' ) );    // %s = font type (cufon, google font or standard)
define( 'YIW_FONT_TYPE_OPTION_ID', apply_filters( 'yiw_font_type_option_id', 'font_type' ) );

// the fonts
include_once YIW_THEME_FUNC_DIR . 'fonts.php';

function yiw_retrieve_font_options( &$yiw_options ) {
	$yiw_options = yiw_retrieve_customizable_options( $yiw_options, 'fonts' );
}

function yiw_fonts() {

	if ( is_admin() )
		return;

	$loading = yiw_get_all_fonts_user();

    $output = '';

//     global $wp_scripts;
//     yiw_debug($wp_scripts->registered);

	// cufon
	if ( isset( $loading['cufon'] ) && ! empty( $loading['cufon'] ) ) :
        //yiw_fonts_cufon();
        add_action( 'wp_enqueue_scripts', 'yiw_fonts_cufon' );
    endif;

	// google font
	if ( isset( $loading['google-font'] ) && ! empty( $loading['google-font'] ) ) :
        yiw_fonts_google_fonts();
        //add_action( 'wp_enqueue_styes', 'yiw_fonts_google_fonts' );
    endif;

	// web font
	if ( isset( $loading['web-fonts'] ) && ! empty( $loading['web-fonts'] ) ) :
        yiw_fonts_web_fonts();
    endif;
}
add_action( 'init', 'yiw_fonts' );

function yiw_get_all_fonts_user() {
    global $yiw_fonts;

	$loading = array();

	foreach ( $yiw_fonts as $font_option ) {
        $the_ = maybe_unserialize( yiw_get_option( $font_option['id_option'] ) );
//         $loading[ $the_['type'] ][]['value'] = $the_[ $the_['type'] ];
//         $loading[ $the_['type'] ][]['css'] = $font_option['css_role'];
        $loading[ $the_['type'] ][] = array(
            'value' => $the_[ $the_['type'] ],
            'css' => $font_option['css_role']
        );
    }

    return $loading;
}

function yiw_fonts_cufon() {
    $loading = yiw_get_all_fonts_user();

    $output = '';

	// cufon
	if ( isset( $loading['cufon'] ) && ! empty( $loading['cufon'] ) ) :

        $output .= '<script type="text/javascript">';
    	foreach ( $loading['cufon'] as $font ) {
    	    wp_register_script( 'cufon',              YIW_FRAMEWORK_URL . 'includes/js/cufon-yui.js', array(), '1.09');
            wp_enqueue_script( 'cufon-' . $font['value'], get_template_directory_uri()."/fonts/".$font['value'].".font.js", array('cufon'));
            $output .= "  Cufon.replace( '$font[css]', { fontFamily: '$font[value]', hover: true } );\n";
            yiw_add_font_bodyclass( 'cufon-' . $font['value'] );
        }
        $output .= '</script>' . "\n";

    add_action( 'wp_head', create_function( '', "echo stripslashes('".addslashes($output)."');" ) );

    add_action( 'wp_footer', 'yiw_cufon_footer' );
    endif;
}

function yiw_fonts_google_fonts() {
    $loading = yiw_get_all_fonts_user();

    $output = '';

	// google font
	if ( isset( $loading['google-font'] ) && ! empty( $loading['google-font'] ) ) :
    	foreach ( $loading['google-font'] as $font ) {
            $gfont = yiw_get_list_google_fonts( $font['value'] );
            wp_enqueue_style( sanitize_title( $gfont['font-name'] ) . '-font', yiw_ssl_url( 'http://fonts.googleapis.com/css?family=' . $gfont['css-name'] . '&subset=latin,latin-ext,cyrillic,greek,latin-ext' ) );

		    $font_family = str_replace( ';', '', $gfont['font-family'] );
            $output .= "$font[css] { $font_family !important; }\n";
            yiw_add_font_bodyclass( 'google-font-' . sanitize_title( $gfont['font-name'] ) );
        }
    endif;

    add_action( 'yiw_custom_styles', create_function( '', "echo stripslashes('".addslashes($output)."');" ) );
}

function yiw_fonts_web_fonts() {
    $loading = yiw_get_all_fonts_user();

    $output = '';

	// web font
	if ( isset( $loading['web-fonts'] ) && ! empty( $loading['web-fonts'] ) ) :
    	foreach ( $loading['web-fonts'] as $font ) {
            $output .= "$font[css] { font-family: $font[value] !important; }\n";
        }
    endif;

    add_action( 'yiw_custom_styles', create_function( '', "echo stripslashes('".addslashes($output)."');" ) );
}

function yiw_cufon_footer() {
	if ( yiw_get_option( YIW_FONT_TYPE_OPTION_ID ) != 'cufon' )
		return;
	?>
	<script type="text/javascript">
        //<![CDATA[
        Cufon.now();  //]]>
    </script>
	<?php
}
add_action( 'wp_footer', 'yiw_cufon_footer' );

function yiw_get_font_option( $id ) {
	return yiw_get_option( 'fonts_' . $id );
}

function yiw_list_cufon_fonts()
{
    global $yiw_list_cufon_fonts;
    if ( isset( $yiw_list_cufon_fonts ) ) return $yiw_list_cufon_fonts;

    $folder = dirname(__FILE__) . '/../fonts/';

    $files = $fonts = array();

	$files = yiw_list_files_into( $folder );

	foreach ( $files as $file ) {
		$file = preg_replace( '/(.*).font.(.*)/', '$1', $file );
		$fonts[$file] = ucfirst( str_replace( '_', ' ', $file ) );
	}

    $yiw_list_cufon_fonts = $fonts;
    return $fonts;
}

function yiw_add_font_bodyclass( $class ) {
    add_filter( 'body_class', create_function( '$classes', '$classes[] = \'' . $class . '\'; $classes = array_unique( $classes ); return $classes;' ) );
}

function yiw_list_google_fonts() {
    global $yiw_list_google_fonts;
    if ( isset( $yiw_list_google_fonts ) ) return $yiw_list_google_fonts;

    $fonts = yiw_get_list_google_fonts();

    $r = array();
    foreach ( $fonts as $the_ )
        $r[ $the_['font-name'] ] = $the_['font-name'];

    $yiw_list_google_fonts = $r;

    return $r;
}


function yiw_get_list_google_fonts( $font_name = false ) {
    $fonts = array();

    $fontsJson = file_get_contents( dirname(__FILE__) . '/google-fonts.txt' );
    $google_fonts = json_decode($fontsJson);

	foreach ( $google_fonts->items as $font ) {
	   if ( preg_match( '/(.*):(.*)/', $font->family ) )
	      list( $fname, $args ) = explode( ':', $font->family );
	   else
	      $fname = $font->family;

	   // variant
	   if ( ! in_array( '400', $font->variants ) && ! in_array( 'regular', $font->variants ) )
	       $variant = ':' . $font->variants[0];
	   else
	       $variant = '';

	   $fonts[] = array( 'font-family' => "font-family: '$fname', sans-serif", 'font-name' => $fname, 'css-name' => str_replace( ' ', '+', $font->family ) . $variant );
	}

    $fonts = apply_filters( 'yiw_google_fonts', $fonts );

    // ritorna uno specifico font, se questi è specificato in parametro
    if ( $font_name != false ) {
        foreach ( $fonts as $key => $font )
            foreach ( $font as $t => $val )
                if ( $font_name == $val )
                    return $fonts[$key];
        return '';
    }

	return $fonts;
}

function yiw_list_standard_fonts() {
	global $yiw_list_standard_fonts;
    if ( isset( $yiw_list_standard_fonts ) ) return $yiw_list_standard_fonts;

    $standard_fonts = array(
		"Arial, Helvetica, sans-serif" => "Arial, Helvetica, sans-serif",
		"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
		"'Bookman Old Style', serif" => "'Bookman Old Style', serif",
		"'Cambria', 'Times New Roman', serif" => "'Cambria', 'Times New Roman', serif",
		"'Century Gothic',verdana,arial,helvetica,sans-serif" => "'Century Gothic',verdana,arial,helvetica,sans-serif",
		"'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
		"Courier, monospace" => "Courier, monospace",
		"'Courier New', Courier, monospace" => "'Courier New', Courier, monospace",
		"Garamond, serif" => "Garamond, serif",
		"Georgia, serif" => "Georgia, serif",
		"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
		"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
		"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
		"'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
		"'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
		"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		"Symbol, sans-serif" => "Symbol, sans-serif",
		"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
		"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
		"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
		"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif",
		"Webdings, sans-serif" => "Webdings, sans-serif",
		"Wingdings, 'Zapf Dingbats', sans-serif" => "Wingdings, 'Zapf Dingbats', sans-serif"
	);

	$yiw_list_standard_fonts = apply_filters( 'yiw_web_standard_fonts', $standard_fonts );
	return $yiw_list_standard_fonts;
}
?>