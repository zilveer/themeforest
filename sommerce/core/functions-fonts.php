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
            wp_enqueue_style( str_replace( ' ', '', $font['value'] ) . '-font', yiw_ssl_url( 'http://fonts.googleapis.com/css?family=' . $font['value'] ) );
            if ( preg_match( '/(.*):(.*)/', $font['value'] ) )
		      list( $font['value'], $args ) = explode( ':', $font['value'] );
            $output .= "$font[css] { font-family: '$font[value]' !important; }\n";
            yiw_add_font_bodyclass( 'google-font-' . sanitize_title( $font['value'] ) );
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
    $folder = dirname(__FILE__) . '/../fonts/';

    $files = $fonts = array();

	$files = yiw_list_files_into( $folder );

	foreach ( $files as $file ) {
		$file = preg_replace( '/(.*).font.(.*)/', '$1', $file );
		$fonts[$file] = ucfirst( str_replace( '_', ' ', $file ) );
	}

    return $fonts;
}

function yiw_add_font_bodyclass( $class ) {
    add_filter( 'body_class', create_function( '$classes', '$classes[] = \'' . $class . '\'; return $classes;' ) );
}


function yiw_list_google_fonts() {
	$google_fonts = array(
		'Aclonica' => 'Aclonica',
		'Allan' => 'Allan',
		'Annie Use Your Telescope' => 'Annie Use Your Telescope',
		'Anonymous Pro' => 'Anonymous Pro',
		'Anonymous Pro:regular,italic,bold,bolditalic' => 'Anonymous Pro (plus italic, bold, and bold italic)',
		'Allerta Stencil' => 'Allerta Stencil',
		'Allerta' => 'Allerta',
		'Amaranth' => 'Amaranth',
		'Anton' => 'Anton',
		'Architects Daughter' => 'Architects Daughter',
		'Arimo' => 'Arimo',
		'Arimo:regular,italic,bold,bolditalic' => 'Arimo (plus italic, bold, and bold italic)',
		'Artifika' => 'Artifika',
		'Arvo' => 'Arvo',
		'Arvo:regular,italic,bold,bolditalic' => 'Arvo (plus italic, bold, and bold italic)',
		'Asset' => 'Asset',
		'Astloch' => 'Astloch',
		'Astloch:regular,bold' => 'Astloch (plus bold)',
		'Bangers' => 'Bangers',
		'Bentham' => 'Bentham',
		'Bevan' => 'Bevan',
		'Bigshot One' => 'Bigshot One',
		'Bowlby One' => 'Bowlby One',
		'Bowlby One SC' => 'Bowlby One SC',
		'Brawler' => 'Brawler ',
		'Buda:light' => 'Buda',
		'Cabin' => 'Cabin',
		'Cabin:regular,500,600,bold' => 'Cabin (plus 500, 600, and bold)',
		'Cabin Sketch:bold' => 'Cabin Sketch',
		'Calligraffitti' => 'Calligraffitti',
		'Candal' => 'Candal',
		'Cantarell' => 'Cantarell',
		'Cantarell:regular,italic,bold,bolditalic' => 'Cantarell (plus italic, bold, and bold italic)',
		'Cardo' => 'Cardo',
		'Carter One' => 'Carter One',
		'Caudex' => 'Caudex',
		'Caudex:regular,italic,bold,bolditalic' => 'Caudex (plus italic, bold, and bold italic)',
		'Cedarville Cursive' => 'Cedarville Cursive',
		'Cherry Cream Soda' => 'Cherry Cream Soda',
		'Chewy' => 'Chewy',
		'Coda' => 'Coda',
		'Coming Soon' => 'Coming Soon',
		'Copse' => 'Copse',
		'Corben:bold' => 'Corben',
		'Cousine' => 'Cousine',
		'Cousine:regular,italic,bold,bolditalic' => 'Cousine (plus italic, bold, and bold italic)',
		'Covered By Your Grace' => 'Covered By Your Grace',
		'Crafty Girls' => 'Crafty Girls',
		'Crimson Text' => 'Crimson Text',
		'Crushed' => 'Crushed',
		'Cuprum' => 'Cuprum',
		'Damion' => 'Damion',
		'Dancing Script' => 'Dancing Script',
		'Dawning of a New Day' => 'Dawning of a New Day',
		'Didact Gothic' => 'Didact Gothic',
		'Droid Sans' => 'Droid Sans',
		'Droid Sans:regular,bold' => 'Droid Sans (plus bold)',
		'Droid Sans Mono' => 'Droid Sans Mono',
		'Droid Serif' => 'Droid Serif',
		'Droid Serif:regular,italic,bold,bolditalic' => 'Droid Serif (plus italic, bold, and bold italic)',
		'EB Garamond' => 'EB Garamond',
		'Expletus Sans' => 'Expletus Sans',
		'Expletus Sans:regular,500,600,bold' => 'Expletus Sans (plus 500, 600, and bold)',
		'Fontdiner Swanky' => 'Fontdiner Swanky',
		'Forum' => 'Forum',
		'Francois One' => 'Francois One',
		'Geo' => 'Geo',
		'Give You Glory' => 'Give You Glory',
		'Goblin One' => 'Goblin One',
		'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
		'Gravitas One' => 'Gravitas One',
		'Gruppo' => 'Gruppo',
		'Hammersmith One' => 'Hammersmith One',
		'Holtwood One SC' => 'Holtwood One SC',
		'Homemade Apple' => 'Homemade Apple',
		'Inconsolata' => 'Inconsolata',
		'Indie Flower' => 'Indie Flower',
		'IM Fell DW Pica' => 'IM Fell DW Pica',
		'IM Fell DW Pica:regular,italic' => 'IM Fell DW Pica (plus italic)',
		'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
		'IM Fell Double Pica' => 'IM Fell Double Pica',
		'IM Fell Double Pica:regular,italic' => 'IM Fell Double Pica (plus italic)',
		'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
		'IM Fell English' => 'IM Fell English',
		'IM Fell English:regular,italic' => 'IM Fell English (plus italic)',
		'IM Fell English SC' => 'IM Fell English SC',
		'IM Fell French Canon' => 'IM Fell French Canon',
		'IM Fell French Canon:regular,italic' => 'IM Fell French Canon (plus italic)',
		'IM Fell French Canon SC' => 'IM Fell French Canon SC',
		'IM Fell Great Primer' => 'IM Fell Great Primer',
		'IM Fell Great Primer:regular,italic' => 'IM Fell Great Primer (plus italic)',
		'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
		'Irish Grover' => 'Irish Grover',
		'Irish Growler' => 'Irish Growler',
		'Istok Web' => 'Istok Web',
		'Istok Web:400,700,400italic,700italic' => 'Istok Web (plus italic, bold, and bold italic)',
		'Josefin Sans:100' => 'Josefin Sans 100',
		'Josefin Sans:100,100italic' => 'Josefin Sans 100 (plus italic)',
		'Josefin Sans:light' => 'Josefin Sans Light 300',
		'Josefin Sans:light,lightitalic' => 'Josefin Sans Light 300 (plus italic)',
		'Josefin Sans' => 'Josefin Sans Regular 400',
		'Josefin Sans:regular,regularitalic' => 'Josefin Sans Regular 400 (plus italic)',
		'Josefin Sans:600' => 'Josefin Sans 600',
		'Josefin Sans:600,600italic' => 'Josefin Sans 600 (plus italic)',
		'Josefin Sans:bold' => 'Josefin Sans Bold 700',
		'Josefin Sans:bold,bolditalic' => 'Josefin Sans Bold 700 (plus italic)',
		'Josefin Slab:100' => 'Josefin Slab 100',
		'Josefin Slab:100,100italic' => 'Josefin Slab 100 (plus italic)',
		'Josefin Slab:light' => 'Josefin Slab Light 300',
		'Josefin Slab:light,lightitalic' => 'Josefin Slab Light 300 (plus italic)',
		'Josefin Slab' => 'Josefin Slab Regular 400',
		'Josefin Slab:regular,regularitalic' => 'Josefin Slab Regular 400 (plus italic)',
		'Josefin Slab:600' => 'Josefin Slab 600',
		'Josefin Slab:600,600italic' => 'Josefin Slab 600 (plus italic)',
		'Josefin Slab:bold' => 'Josefin Slab Bold 700',
		'Josefin Slab:bold,bolditalic' => 'Josefin Slab Bold 700 (plus italic)',
		'Judson' => 'Judson',
		'Judson:regular,regularitalic,bold' => 'Judson (plus bold)',
		'Jura:light' => ' Jura Light',
		'Jura' => ' Jura Regular',
		'Jura:500' => ' Jura 500',
		'Jura:600' => ' Jura 600',
		'Just Another Hand' => 'Just Another Hand',
		'Just Me Again Down Here' => 'Just Me Again Down Here',
		'Kameron' => 'Kameron',
		'Kameron:400,700' => 'Kameron (plus bold)',
		'Kenia' => 'Kenia',
		'Kranky' => 'Kranky',
		'Kreon' => 'Kreon',
		'Kreon:light,regular,bold' => 'Kreon (plus light and bold)',
		'Kristi' => 'Kristi',
		'La Belle Aurore' => 'La Belle Aurore',
		'Lato:100' => 'Lato 100',
		'Lato:100,100italic' => 'Lato 100 (plus italic)',
		'Lato:light' => 'Lato Light 300',
		'Lato:light,lightitalic' => 'Lato Light 300 (plus italic)',
		'Lato:regular' => 'Lato Regular 400',
		'Lato:regular,regularitalic' => 'Lato Regular 400 (plus italic)',
		'Lato:bold' => 'Lato Bold 700',
		'Lato:bold,bolditalic' => 'Lato Bold 700 (plus italic)',
		'Lato:900' => 'Lato 900',
		'Lato:900,900italic' => 'Lato 900 (plus italic)',
		'League Script' => 'League Script',
		'Lekton' => ' Lekton ',
		'Lekton:regular,italic,bold' => 'Lekton (plus italic and bold)',
		'Limelight' => ' Limelight ',
		'Lobster' => 'Lobster',
		'Lobster Two' => 'Lobster Two',
		'Lobster Two:400,400italic,700,700italic' => 'Lobster Two (plus italic, bold, and bold italic)',
		'Lora' => 'Lora',
		'Lora:400,700,400italic,700italic' => 'Lora (plus bold and italic)',
		'Love Ya Like A Sister' => 'Love Ya Like A Sister',
		'Loved by the King' => 'Loved by the King',
		'Luckiest Guy' => 'Luckiest Guy',
		'Maiden Orange' => 'Maiden Orange',
		'Mako' => 'Mako',
		'Maven Pro' => ' Maven Pro',
		'Maven Pro:500' => ' Maven Pro 500',
		'Maven Pro:bold' => ' Maven Pro 700',
		'Maven Pro:900' => ' Maven Pro 900',
		'Meddon' => 'Meddon',
		'MedievalSharp' => 'MedievalSharp',
		'Megrim' => 'Megrim',
		'Merriweather' => 'Merriweather',
		'Metrophobic' => 'Metrophobic',
		'Michroma' => 'Michroma',
		'Miltonian Tattoo' => 'Miltonian Tattoo',
		'Miltonian' => 'Miltonian',
		'Modern Antiqua' => 'Modern Antiqua',
		'Monofett' => 'Monofett',
		'Molengo' => 'Molengo',
		'Mountains of Christmas' => 'Mountains of Christmas',
		'Muli:light' => 'Muli Light',
		'Muli:light,lightitalic' => 'Muli Light (plus italic)',
		'Muli' => 'Muli Regular',
		'Muli:regular,regularitalic' => 'Muli Regular (plus italic)',
		'Neucha' => 'Neucha',
		'Neuton' => 'Neuton',
		'News Cycle' => 'News Cycle',
		'Nixie One' => 'Nixie One',
		'Nobile' => 'Nobile',
		'Nobile:regular,italic,bold,bolditalic' => 'Nobile (plus italic, bold, and bold italic)',
		'Nova Cut' => 'Nova Cut',
		'Nova Flat' => 'Nova Flat',
		'Nova Mono' => 'Nova Mono',
		'Nova Oval' => 'Nova Oval',
		'Nova Round' => 'Nova Round',
		'Nova Script' => 'Nova Script',
		'Nova Slim' => 'Nova Slim',
		'Nova Square' => 'Nova Square',
		'Nunito:light' => ' Nunito Light',
		'Nunito' => ' Nunito Regular',
		'OFL Sorts Mill Goudy TT' => 'OFL Sorts Mill Goudy TT',
		'OFL Sorts Mill Goudy TT:regular,italic' => 'OFL Sorts Mill Goudy TT (plus italic)',
		'Old Standard TT' => 'Old Standard TT',
		'Old Standard TT:regular,italic,bold' => 'Old Standard TT (plus italic and bold)',
		'Open Sans:light,lightitalic' => 'Open Sans light',
		'Open Sans:regular,regularitalic' => 'Open Sans regular',
		'Open Sans:600,600italic' => 'Open Sans 600',
		'Open Sans:bold,bolditalic' => 'Open Sans bold',
		'Open Sans:800,800italic' => 'Open Sans 800',
		'Open Sans:light,lightitalic,regular,regularitalic,600,600italic,bold,bolditalic,800,800italic' => 'Open Sans (all weights)',
		'Open Sans Condensed:light,lightitalic' => 'Open Sans Condensed',
		'Orbitron' => 'Orbitron Regular (400)',
		'Orbitron:500' => 'Orbitron 500',
		'Orbitron:bold' => 'Orbitron Regular (700)',
		'Orbitron:900' => 'Orbitron 900',
		'Oswald' => 'Oswald',
		'Over the Rainbow' => 'Over the Rainbow',
		'Reenie Beanie' => 'Reenie Beanie',
		'Pacifico' => 'Pacifico',
		'Patrick Hand' => 'Patrick Hand',
		'Paytone One' => 'Paytone One',
		'Permanent Marker' => 'Permanent Marker',
		'Philosopher' => 'Philosopher',
		'Play' => 'Play',
		'Play:regular,bold' => 'Play (plus bold)',
		'Playfair Display' => ' Playfair Display ',
		'Podkova' => ' Podkova ',
		'PT Sans' => 'PT Sans',
		'PT Sans:regular,italic,bold,bolditalic' => 'PT Sans (plus itlic, bold, and bold italic)',
		'PT Sans Caption' => 'PT Sans Caption',
		'PT Sans Caption:regular,bold' => 'PT Sans Caption (plus bold)',
		'PT Sans Narrow' => 'PT Sans Narrow',
		'PT Sans Narrow:regular,bold' => 'PT Sans Narrow (plus bold)',
		'PT Serif' => 'PT Serif',
		'PT Serif:regular,italic,bold,bolditalic' => 'PT Serif (plus italic, bold, and bold italic)',
		'PT Serif Caption' => 'PT Serif Caption',
		'PT Serif Caption:regular,italic' => 'PT Serif Caption (plus italic)',
		'Puritan' => 'Puritan',
		'Puritan:regular,italic,bold,bolditalic' => 'Puritan (plus italic, bold, and bold italic)',
		'Quattrocento' => 'Quattrocento',
		'Quattrocento Sans' => 'Quattrocento Sans',
		'Radley' => 'Radley',
		'Raleway:100' => 'Raleway',
		'Redressed' => 'Redressed',
		'Rock Salt' => 'Rock Salt',
		'Rokkitt' => 'Rokkitt',
		'Ruslan Display' => 'Ruslan Display',
		'Schoolbell' => 'Schoolbell',
		'Shadows Into Light' => 'Shadows Into Light',
		'Shanti' => 'Shanti',
		'Sigmar One' => 'Sigmar One',
		'Six Caps' => 'Six Caps',
		'Slackey' => 'Slackey',
		'Smythe' => 'Smythe',
		'Sniglet:800' => 'Sniglet',
		'Special Elite' => 'Special Elite',
		'Stardos Stencil' => 'Stardos Stencil',
		'Stardos Stencil:400,700' => 'Stardos Stencil (plus bold)',
		'Sue Ellen Francisco' => 'Sue Ellen Francisco',
		'Sunshiney' => 'Sunshiney',
		'Swanky and Moo Moo' => 'Swanky and Moo Moo',
		'Syncopate' => 'Syncopate',
		'Tangerine' => 'Tangerine',
		'Tenor Sans' => ' Tenor Sans ',
		'Terminal Dosis Light' => 'Terminal Dosis Light',
		'The Girl Next Door' => 'The Girl Next Door',
		'Tinos' => 'Tinos',
		'Tinos:regular,italic,bold,bolditalic' => 'Tinos (plus italic, bold, and bold italic)',
		'Ubuntu' => 'Ubuntu',
		'Ubuntu:regular,italic,bold,bolditalic' => 'Ubuntu (plus italic, bold, and bold italic)',
		'Ultra' => 'Ultra',
		'Unkempt' => 'Unkempt',
		'UnifrakturCook:bold' => 'UnifrakturCook',
		'UnifrakturMaguntia' => 'UnifrakturMaguntia',
		'Varela' => 'Varela',
		'Varela Round' => 'Varela Round',
		'Vibur' => 'Vibur',
		'Vollkorn' => 'Vollkorn',
		'Vollkorn:regular,italic,bold,bolditalic' => 'Vollkorn (plus italic, bold, and bold italic)',
		'VT323' => 'VT323',
		'Waiting for the Sunrise' => 'Waiting for the Sunrise',
		'Wallpoet' => 'Wallpoet',
		'Walter Turncoat' => 'Walter Turncoat',
		'Wire One' => 'Wire One',
		'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
		'Yanone Kaffeesatz:300' => 'Yanone Kaffeesatz:300',
		'Yanone Kaffeesatz:400' => 'Yanone Kaffeesatz:400',
		'Yanone Kaffeesatz:700' => 'Yanone Kaffeesatz:700',
		'Yeseva One' => 'Yeseva One',
		'Zeyada' => 'Zeyada'
	);

	return apply_filters( 'yiw_google_fonts', $google_fonts );
}

function yiw_list_standard_fonts() {
	$standard_fonts = array(
		"Arial, Helvetica, sans-serif" => "Arial, Helvetica, sans-serif",
		"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
		"'Bookman Old Style', serif" => "'Bookman Old Style', serif",
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

	return $standard_fonts;
}
?>
