<?php

/* Text */

add_filter( 'of_sanitize_text', 'sanitize_text_field' );

/* Textarea */

function of_sanitize_textarea($input) {
	global $allowedposttags;
	$output = wp_kses( $input, $allowedposttags);
	return $output;
}

add_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );

/* Select */

add_filter( 'of_sanitize_select', 'of_sanitize_enum', 10, 2);

/* Radio */

add_filter( 'of_sanitize_radio', 'of_sanitize_enum', 10, 2);

/* Images */

add_filter( 'of_sanitize_images', 'of_sanitize_enum', 10, 2);

/* Checkbox */

function of_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}
add_filter( 'of_sanitize_checkbox', 'of_sanitize_checkbox' );

/* Multicheck */

function of_sanitize_multicheck( $input, $option ) {
	$output = '';
	if ( is_array( $input ) ) {
		foreach( $option['options'] as $key => $value ) {
			$output[$key] = "0";
		}
		foreach( $input as $key => $value ) {
			if ( array_key_exists( $key, $option['options'] ) && $value ) {
				$output[$key] = "1";
			}
		}
	}
	return $output;
}
add_filter( 'of_sanitize_multicheck', 'of_sanitize_multicheck', 10, 2 );

/* Color Picker */

add_filter( 'of_sanitize_color', 'of_sanitize_hex' );

/* Uploader */

function of_sanitize_upload( $input ) {
	$output = '';
	$filetype = wp_check_filetype($input);
	if ( $filetype["ext"] ) {
		$output = $input;
	}
	return $output;
}
add_filter( 'of_sanitize_upload', 'of_sanitize_upload' );

/* Editor */

function of_sanitize_editor($input) {
	if ( current_user_can( 'unfiltered_html' ) ) {
		$output = $input;
	}
	else {
		global $allowedtags;
		$output = wpautop(wp_kses( $input, $allowedtags));
	}
	return $output;
}
add_filter( 'of_sanitize_editor', 'of_sanitize_editor' );

/* Allowed Tags */

function of_sanitize_allowedtags($input) {
	global $allowedtags;
	$output = wpautop(wp_kses( $input, $allowedtags));
	return $output;
}

/* Allowed Post Tags */

function of_sanitize_allowedposttags($input) {
	global $allowedposttags;
	$tb_allowed_br = array('br' => array());
	$tb_allowed_tags = array_merge($allowedposttags, $tb_allowed_br);
	$output = wpautop(wp_kses( $input, $tb_allowed_tags));
	return $output;
}

add_filter( 'of_sanitize_info', 'of_sanitize_allowedposttags' );


/* Check that the key value sent is valid */

function of_sanitize_enum( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option['options'] ) ) {
		$output = $input;
	}
	return $output;
}

/* Background */

function of_sanitize_background( $input ) {
	$output = wp_parse_args( $input, array(
		'color' => '',
		'image'  => '',
		'repeat'  => 'repeat',
		'position' => 'top center',
		'attachment' => 'scroll'
	) );

	$output['color'] = apply_filters( 'of_sanitize_hex', $input['color'] );
	$output['image'] = apply_filters( 'of_sanitize_upload', $input['image'] );
	$output['repeat'] = apply_filters( 'of_background_repeat', $input['repeat'] );
	$output['position'] = apply_filters( 'of_background_position', $input['position'] );
	$output['attachment'] = apply_filters( 'of_background_attachment', $input['attachment'] );

	return $output;
}
add_filter( 'of_sanitize_background', 'of_sanitize_background' );

function of_sanitize_background_repeat( $value ) {
	$recognized = of_recognized_background_repeat();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_background_repeat', current( $recognized ) );
}
add_filter( 'of_background_repeat', 'of_sanitize_background_repeat' );

function of_sanitize_background_position( $value ) {
	$recognized = of_recognized_background_position();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_background_position', current( $recognized ) );
}
add_filter( 'of_background_position', 'of_sanitize_background_position' );

function of_sanitize_background_attachment( $value ) {
	$recognized = of_recognized_background_attachment();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_background_attachment', current( $recognized ) );
}
add_filter( 'of_background_attachment', 'of_sanitize_background_attachment' );


/* Typography */

function of_sanitize_typography( $input, $option ) {

	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'color' => ''
	) );

	if ( isset( $option['options']['faces'] ) && isset( $input['face'] ) ) {
		if ( !( array_key_exists( $input['face'], $option['options']['faces'] ) ) ) {
			$output['face'] = '';
		}
	}
	else {
		$output['face']  = apply_filters( 'of_font_face', $output['face'] );
	}

	$output['size']  = apply_filters( 'of_font_size', $output['size'] );
	$output['style'] = apply_filters( 'of_font_style', $output['style'] );
	$output['color'] = apply_filters( 'of_sanitize_color', $output['color'] );
	return $output;
}
add_filter( 'of_sanitize_typography', 'of_sanitize_typography', 10, 2 );

function of_sanitize_font_size( $value ) {
	$recognized = of_recognized_font_sizes();
	$value_check = preg_replace('/px/','', $value);
	if ( in_array( (int) $value_check, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_font_size', $recognized );
}
add_filter( 'of_font_size', 'of_sanitize_font_size' );


function of_sanitize_font_style( $value ) {
	$recognized = of_recognized_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_font_style', current( $recognized ) );
}
add_filter( 'of_font_style', 'of_sanitize_font_style' );


function of_sanitize_font_face( $value ) {
	$recognized = of_recognized_font_faces();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_font_face', current( $recognized ) );
}
add_filter( 'of_font_face', 'of_sanitize_font_face' );

/**
 * Get recognized background repeat settings
 *
 * @return   array
 *
 */
function of_recognized_background_repeat() {
	$default = array(
		'no-repeat' => __( 'No Repeat', 'options_framework_theme' ),
		'repeat-x'  => __( 'Repeat Horizontally', 'options_framework_theme' ),
		'repeat-y'  => __( 'Repeat Vertically', 'options_framework_theme' ),
		'repeat'    => __( 'Repeat All', 'options_framework_theme' ),
		);
	return apply_filters( 'of_recognized_background_repeat', $default );
}

/**
 * Get recognized background positions
 *
 * @return   array
 *
 */
function of_recognized_background_position() {
	$default = array(
		'top left'      => __( 'Top Left', 'options_framework_theme' ),
		'top center'    => __( 'Top Center', 'options_framework_theme' ),
		'top right'     => __( 'Top Right', 'options_framework_theme' ),
		'center left'   => __( 'Middle Left', 'options_framework_theme' ),
		'center center' => __( 'Middle Center', 'options_framework_theme' ),
		'center right'  => __( 'Middle Right', 'options_framework_theme' ),
		'bottom left'   => __( 'Bottom Left', 'options_framework_theme' ),
		'bottom center' => __( 'Bottom Center', 'options_framework_theme' ),
		'bottom right'  => __( 'Bottom Right', 'options_framework_theme')
		);
	return apply_filters( 'of_recognized_background_position', $default );
}

/**
 * Get recognized background attachment
 *
 * @return   array
 *
 */
function of_recognized_background_attachment() {
	$default = array(
		'scroll' => __( 'Scroll Normally', 'options_framework_theme' ),
		'fixed'  => __( 'Fixed in Place', 'options_framework_theme')
		);
	return apply_filters( 'of_recognized_background_attachment', $default );
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 * @return   string
 *
 */

function of_sanitize_hex( $hex, $default = '' ) {
	if ( of_validate_hex( $hex ) ) {
		return $hex;
	}
	return $default;
}

/**
 * Get recognized font sizes.
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return   array
 */

function of_recognized_font_sizes() {
	$sizes = range( 9, 71 );
	$sizes = apply_filters( 'of_recognized_font_sizes', $sizes );
	$sizes = array_map( 'absint', $sizes );
	return $sizes;
}

/**
 * Get recognized font faces.
 *
 * Returns an array of all recognized font faces.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function of_recognized_font_faces() {
	$default = array(
		'helvetica' => 'Helvetica Neue, Helvetica*',
		'arial'     => 'Arial, Helvetica',
		'tahoma'    => 'Tahoma, Verdana',
		'georgia'   => 'Georgia, Constantia',
		'cambria'   => 'Cambria, Times New Roman',
		'palatino'  => 'Palatino Linotype, Garamond',		
		'verdana'   => 'Verdana, Geneva'
	);
	return apply_filters( 'of_recognized_font_faces', $default );
}

/**
 * Get recognized font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function of_recognized_font_styles() {
	$default = array(
		'normal'      => __( 'Normal', 'options_framework_theme' ),
		'italic'      => __( 'Italic', 'options_framework_theme' ),
		'bold'        => __( 'Bold', 'options_framework_theme' ),
		'bold italic' => __( 'Bold Italic', 'options_framework_theme' )
	);
	return apply_filters( 'of_recognized_font_styles', $default );
}

/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @return   bool
 *
 */

function of_validate_hex( $hex ) {
	$hex = trim( $hex );
	/* Strip recognized prefixes. */
	if ( 0 === strpos( $hex, '#' ) ) {
		$hex = substr( $hex, 1 );
	}
	elseif ( 0 === strpos( $hex, '%23' ) ) {
		$hex = substr( $hex, 3 );
	}
	/* Regex match. */
	if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		return false;
	}
	else {
		return true;
	}
}

/***************************************/
/*      APPENDED BY THEME BLOSSOM      */
/***************************************/

function of_recognized_gfont_faces() {

	$googleFonts = 'Default,Abel,Abril Fatface,Aclonica,Acme,Actor,Adamina,Advent Pro,Aguafina Script,Aladin,Aldrich,Alegreya,Alegreya SC,Alex Brush,Alfa Slab One,Alice,Alike,Alike Angular,Allan,Allerta,Allerta Stencil,Allura,Almendra,Almendra SC,Amarante,Amaranth,Amatic SC,Amethysta,Andada,Andika,Annie Use Your Telescope,Anonymous Pro,Antic,Antic Didone,Antic Slab,Anton,Arapey,Arbutus,Architects Daughter,Arimo,Arizonia,Armata,Artifika,Arvo,Asap,Asset,Astloch,Asul,Atomic Age,Aubrey,Audiowide,Average,Averia Gruesa Libre,Averia Libre,Averia Sans Libre,Averia Serif Libre,Bad Script,Balthazar,Bangers,Basic,Baumans,Belgrano,Belleza,Bentham,Berkshire Swash,Bevan,Bigshot One,Bilbo,Bilbo Swash Caps,Bitter,Black Ops One,Bonbon,Boogaloo,Bowlby One,Bowlby One SC,Brawler,Bree Serif,Bubblegum Sans,Buda,Buenard,Butcherman,Butterfly Kids,Cabin,Cabin Condensed,Cabin Sketch,Caesar Dressing,Cagliostro,Calligraffitti,Cambo,Candal,Cantarell,Cantata One,Capriola,Cardo,Carme,Carter One,Caudex,Cedarville Cursive,Ceviche One,Changa One,Chango,Chau Philomene One,Chelsea Market,Cherry Cream Soda,Chewy,Chicle,Chivo,Cinzel Decorative,Coda,Coda Caption,Codystar,Comfortaa,Coming Soon,Concert One,Condiment,Contrail One,Convergence,Cookie,Copse,Corben,Courgette,Cousine,Coustard,Covered By Your Grace,Crafty Girls,Creepster,Crete Round,Crimson Text,Crushed,Cuprum,Cutive,Damion,Dancing Script,Dawning of a New Day,Days One,Delius,Delius Swash Caps,Delius Unicase,Della Respira,Devonshire,Didact Gothic,Diplomata,Diplomata SC,Doppio One,Dorsa,Dosis,Dr Sugiyama,Droid Sans,Droid Sans Mono,Droid Serif,Duru Sans,Dynalight,EB Garamond,Eagle Lake,Eater,Economica,Electrolize,Emblema One,Emilys Candy,Engagement,Enriqueta,Erica One,Esteban,Euphoria Script,Ewert,Exo,Expletus Sans,Fanwood Text,Fascinate,Fascinate Inline,Federant,Federo,Felipa,Fjord One,Flamenco,Flavors,Fondamento,Fontdiner Swanky,Forum,Francois One,Fredericka the Great,Fredoka One,Fresca,Frijole,Fugaz One,Galdeano,Gentium Basic,Gentium Book Basic,Geo,Geostar,Geostar Fill,Germania One,Give You Glory,Glass Antiqua,Glegoo,Gloria Hallelujah,Goblin One,Gochi Hand,Gorditas,Goudy Bookletter 1911,Graduate,Gravitas One,Great Vibes,Gruppo,Gudea,Habibi,Hammersmith One,Handlee,Happy Monkey,Henny Penny,Herr Von Muellerhoff,Holtwood One SC,Homemade Apple,Homenaje,IM Fell DW Pica,IM Fell DW Pica SC,IM Fell Double Pica,IM Fell Double Pica SC,IM Fell English,IM Fell English SC,IM Fell French Canon,IM Fell French Canon SC,IM Fell Great Primer,IM Fell Great Primer SC,Iceberg,Iceland,Imprima,Inconsolata,Inder,Indie Flower,Inika,Irish Grover,Istok Web,Italiana,Italianno,Jim Nightshade,Jockey One,Jolly Lodger,Josefin Sans,Josefin Slab,Judson,Julee,Junge,Jura,Just Another Hand,Just Me Again Down Here,Kameron,Karla,Kaushan Script,Kelly Slab,Kenia,Knewave,Kotta One,Kranky,Kreon,Kristi,Krona One,La Belle Aurore,Lancelot,Lato,League Script,Leckerli One,Ledger,Lekton,Lemon,Lilita One,Limelight,Linden Hill,Lobster,Lobster Two,Londrina Outline,Londrina Shadow,Londrina Sketch,Londrina Solid,Lora,Love Ya Like A Sister,Loved by the King,Lovers Quarrel,Luckiest Guy,Lusitana,Lustria,Macondo,Macondo Swash Caps,Magra,Maiden Orange,Mako,Marcellus,Marck Script,Marko One,Marmelad,Marvel,Mate,Mate SC,Maven Pro,Meddon,MedievalSharp,Medula One,Megrim,Merienda One,Merriweather,Metamorphous,Metrophobic,Michroma,Miltonian,Miltonian Tattoo,Miniver,Miss Fajardose,Modern Antiqua,Molengo,Monofett,Monoton,Monsieur La Doulaise,Montaga,Montez,Montserrat,Mountains of Christmas,Mr Bedfort,Mr Dafoe,Mr De Haviland,Mrs Saint Delafield,Mrs Sheppards,Muli,Mystery Quest,Neucha,Neuton,News Cycle,Niconne,Nixie One,Nobile,Norican,Nosifer,Nothing You Could Do,Noticia Text,Noto Serif,Nova Cut,Nova Flat,Nova Mono,Nova Oval,Nova Round,Nova Script,Nova Slim,Nova Square,Numans,Nunito,Old Standard TT,Oldenburg,Oleo Script,Open Sans,Open Sans Condensed,Orbitron,Original Surfer,Oswald,Over the Rainbow,Overlock,Overlock SC,Ovo,Oxygen,PT Mono,PT Sans,PT Sans Caption,PT Sans Narrow,PT Serif,PT Serif Caption,Pacifico,Parisienne,Passero One,Passion One,Patrick Hand,Patua One,Paytone One,Permanent Marker,Petrona,Philosopher,Piedra,Pinyon Script,Plaster,Play,Playball,Playfair Display,Podkova,Poiret One,Poller One,Poly,Pompiere,Pontano Sans,Port Lligat Sans,Port Lligat Slab,Prata,Press Start 2P,Princess Sofia,Prociono,Prosto One,Puritan,Quando,Quantico,Quattrocento,Quattrocento Sans,Questrial,Quicksand,Qwigley,Radley,Raleway,Rammetto One,Rancho,Rationale,Redressed,Reenie Beanie,Revalia,Ribeye,Ribeye Marrow,Righteous,Rochester,Rock Salt,Rokkitt,Ropa Sans,Rosario,Rosarivo,Rouge Script,Ruda,Ruge Boogie,Ruluko,Ruslan Display,Russo One,Ruthie,Sail,Salsa,Sancreek,Sansita One,Sarina,Satisfy,Schoolbell,Seaweed Script,Sevillana,Shadows Into Light,Shadows Into Light Two,Shanti,Share,Shojumaru,Short Stack,Sigmar One,Signika,Signika Negative,Simonetta,Sirin Stencil,Six Caps,Slackey,Smokum,Smythe,Sniglet,Snippet,Sofia,Sonsie One,Sorts Mill Goudy,Special Elite,Spicy Rice,Spinnaker,Spirax,Squada One,Stardos Stencil,Stint Ultra Condensed,Stint Ultra Expanded,Stoke,Sue Ellen Francisco,Sunshiney,Supermercado One,Swanky and Moo Moo,Syncopate,Tangerine,Telex,Tenor Sans,The Girl Next Door,Tienne,Tinos,Titan One,Trade Winds,Trocchi,Trochut,Trykker,Tulpen One,Ubuntu,Ubuntu Condensed,Ubuntu Mono,Ultra,Uncial Antiqua,UnifrakturCook,UnifrakturMaguntia,Unkempt,Unlock,Unna,VT323,Varela,Varela Round,Vast Shadow,Vibur,Vidaloka,Viga,Voces,Volkhov,Vollkorn,Voltaire,Waiting for the Sunrise,Wallpoet,Walter Turncoat,Wellfleet,Wire One,Yanone Kaffeesatz,Yellowtail,Yeseva One,Yesteryear,Zeyada';
	$tempA = explode(',', $googleFonts);
	
	foreach ($tempA as $temp) {
		$default[$temp] = $temp;
	}
	
	return apply_filters( 'of_recognized_gfont_faces', $default );
}

function of_sanitize_gfont_face( $value ) {
	$recognized = of_recognized_gfont_faces();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_gfont_face', current( $recognized ) );
}
add_filter( 'of_gfont_face', 'of_sanitize_gfont_face' );

function of_sanitize_gfont( $input ) {
	$output = wp_parse_args( $input, array(
		'face'  => ''
	) );

	$output['face']  = apply_filters( 'of_gfont_face', $output['face'] );

	return $output;
}
add_filter( 'of_sanitize_gfont', 'of_sanitize_gfont' );

function of_sanitize_gtypography( $input, $option ) {

	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'color' => ''
	) );

	if ( isset( $option['options']['faces'] ) && isset( $input['face'] ) ) {
		if ( !( array_key_exists( $input['face'], $option['options']['faces'] ) ) ) {
			$output['face'] = '';
		}
	}
	else {
		$output['face']  = apply_filters( 'of_gfont_face', $output['face'] );
	}

	$output['size']  = apply_filters( 'of_font_size', $output['size'] );
	$output['style'] = apply_filters( 'of_font_style', $output['style'] );
	$output['color'] = apply_filters( 'of_sanitize_color', $output['color'] );
	return $output;
}
add_filter( 'of_sanitize_gtypography', 'of_sanitize_gtypography', 10, 2 );

function of_sanitize_color2( $input ) {
	$output = wp_parse_args( $input, array(
		'color1' => '',
		'color2' => ''
	));

	$output['color1'] = apply_filters( 'of_color', $output['color1'] );
	$output['color2'] = apply_filters( 'of_color', $output['color2'] );

	return $output;
}
add_filter( 'of_sanitize_color2', 'of_sanitize_color2' );

function of_sanitize_color3( $input ) {
	$output = wp_parse_args( $input, array(
		'color1' => '',
		'color2' => '',
		'color3' => ''
	));

	$output['color1'] = apply_filters( 'of_color', $output['color1'] );
	$output['color2'] = apply_filters( 'of_color', $output['color2'] );
	$output['color3'] = apply_filters( 'of_color', $output['color3'] );

	return $output;
}
add_filter( 'of_sanitize_color3', 'of_sanitize_color3' );

function of_sanitize_color4( $input ) {
	$output = wp_parse_args( $input, array(
		'color1' => '',
		'color2' => '',
		'color3' => '',
		'color4' => ''
	));

	$output['color1'] = apply_filters( 'of_color', $output['color1'] );
	$output['color2'] = apply_filters( 'of_color', $output['color2'] );
	$output['color3'] = apply_filters( 'of_color', $output['color3'] );
	$output['color4'] = apply_filters( 'of_color', $output['color4'] );

	return $output;
}
add_filter( 'of_sanitize_color4', 'of_sanitize_color4' );


function of_sanitize_color5( $input ) {
	$output = wp_parse_args( $input, array(
		'color1' => '',
		'color2' => '',
		'color3' => '',
		'color4' => '',
		'color5' => ''
	));

	$output['color1'] = apply_filters( 'of_color', $output['color1'] );
	$output['color2'] = apply_filters( 'of_color', $output['color2'] );
	$output['color3'] = apply_filters( 'of_color', $output['color3'] );
	$output['color4'] = apply_filters( 'of_color', $output['color4'] );
	$output['color5'] = apply_filters( 'of_color', $output['color5'] );

	return $output;
}
add_filter( 'of_sanitize_color5', 'of_sanitize_color5' );


function of_sanitize_color6( $input ) {
	$output = wp_parse_args( $input, array(
		'color1' => '',
		'color2' => '',
		'color3' => '',
		'color4' => '',
		'color5' => '',
		'color6' => ''
	));

	$output['color1'] = apply_filters( 'of_color', $output['color1'] );
	$output['color2'] = apply_filters( 'of_color', $output['color2'] );
	$output['color3'] = apply_filters( 'of_color', $output['color3'] );
	$output['color4'] = apply_filters( 'of_color', $output['color4'] );
	$output['color5'] = apply_filters( 'of_color', $output['color5'] );
	$output['color6'] = apply_filters( 'of_color', $output['color6'] );

	return $output;
}
add_filter( 'of_sanitize_color6', 'of_sanitize_color6' );

/* SCRIPTS */


/*------------------Options Panel - Custom Scripts------------------*/
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

if (!function_exists('optionsframework_custom_scripts')) {

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#use_logo_image').click(function() {
		jQuery('#section-logo_style,#section-header_logo,#section-logo_width,#section-logo_height, #section-logo_top, #section-logo_bottom').fadeToggle(400);
	});
	
	if (jQuery('#use_logo_image:checked').val() !== undefined) {
		jQuery('#section-logo_style,#section-header_logo,#section-logo_width,#section-logo_height, #section-logo_top, #section-logo_bottom').show();
	}

	jQuery('#use_google_fonts').click(function() {
		jQuery('#section-h1_typography,#section-h2_typography,#section-h3_typography, #section-h4_typography, #section-h5_typography, #section-h3_typography_comments, #section-blockquote_typography, #section-quote_typography, #section-button_font, #section-date_font, #section-widget_link_font, #section-navigation_typography, #section-promo_line_font').fadeToggle(400);
	});
	
	if (jQuery('#use_google_fonts:checked').val() !== undefined) {
		jQuery('#section-h1_typography,#section-h2_typography,#section-h3_typography, #section-h4_typography, #section-h5_typography, #section-h3_typography_comments, #section-blockquote_typography, #section-quote_typography, #section-button_font, #section-date_font, #section-widget_link_font, #section-navigation_typography, #section-promo_line_font').show();
	}

	jQuery('#show_ornament_line').click(function() {
		jQuery('#section-ornament_line_bckg_image').fadeToggle(400);
	});
	
	if (jQuery('#show_ornament_line:checked').val() !== undefined) {
		jQuery('#section-ornament_line_bckg_image').show();
	}

	jQuery('#show_promo_line').click(function() {
		jQuery('#section-promo_line_bckg_color, #section-promo_line_opacity, #section-promo_line_colors, #section-promo_line_content, #section-promo_line_icon_colors').fadeToggle(400);
	});
	
	if (jQuery('#show_promo_line:checked').val() !== undefined) {
		jQuery('#section-promo_line_bckg_color, #section-promo_line_opacity, #section-promo_line_colors, #section-promo_line_content, #section-promo_line_icon_colors').show();
	}

	jQuery('#specific_background_height').click(function() {
		jQuery('#section-background_height').fadeToggle(400);
	});
	
	if (jQuery('#specific_background_height:checked').val() !== undefined) {
		jQuery('#section-background_height').show();
	}

});
</script>

<?php
}
}

/* @end APPENDED BY THEME BLOSSOM */

?>