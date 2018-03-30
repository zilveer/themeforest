<?php

/* Text */

add_filter( 'of_sanitize_text', 'sanitize_text_field' );

/* Textarea */

function of_sanitize_textarea($input) {
	global $allowedposttags;
	$output = $input;
	return $output;
}

add_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );

/* Info */

add_filter( 'of_sanitize_info', 'of_sanitize_allowedposttags' );

/* Select */

add_filter( 'of_sanitize_select', 'of_sanitize_enum', 10, 2);

/* Radio */

add_filter( 'of_sanitize_radio', 'of_sanitize_enum', 10, 2);

/* Images */

add_filter( 'of_sanitize_images', 'of_sanitize_enum', 10, 2);

/* Checkbox */

function of_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = "1";
	} else {
		$output = "0";
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

/* Allowed Tags */

function of_sanitize_allowedtags($input) {
	global $allowedtags;
	$output = wpautop(wp_kses( $input, $allowedtags));
	return $output;
}

add_filter( 'of_sanitize_info', 'of_sanitize_allowedtags' );

/* Allowed Post Tags */

function of_sanitize_allowedposttags($input) {
	global $allowedposttags;
	$output = wpautop(wp_kses( $input, $allowedposttags));
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

function of_sanitize_typography( $input ) {
	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'style2' => ''
	) );

	$output['size']  = apply_filters( 'of_font_size', $output['size'] );
	$output['face']  = apply_filters( 'of_font_face', $output['face'] );
	$output['style'] = apply_filters( 'of_font_style', $output['style'] );
	$output['style2'] = apply_filters( 'of_font_style2', $output['style2'] );

	return $output;
}
add_filter( 'of_sanitize_typography', 'of_sanitize_typography' );

/* Typography Nosizes */

function of_sanitize_typography_nosize( $input ) {
	$output = wp_parse_args( $input, array(
		'face'  => '',
		'style' => '',
		'style2' => ''
	) );

	$output['face']  = apply_filters( 'of_font_face', $output['face'] );
	$output['style'] = apply_filters( 'of_font_style', $output['style'] );
	$output['style2'] = apply_filters( 'of_font_style2', $output['style2'] );

	return $output;
}
add_filter( 'of_sanitize_typography_nosize', 'of_sanitize_typography_nosize' );


function of_sanitize_font_size( $value ) {
	$recognized = of_recognized_font_sizes();
	$value = preg_replace('/px/','', $value);
	if ( in_array( (int) $value, $recognized ) ) {
		return (int) $value;
	}
	return (int) apply_filters( 'of_default_font_size', $recognized );
}
add_filter( 'of_font_face', 'of_sanitize_font_face' );


function of_sanitize_font_style( $value ) {
	$recognized = of_recognized_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_font_style', current( $recognized ) );
}
add_filter( 'of_font_style', 'of_sanitize_font_style' );

function of_sanitize_font_style2( $value ) {
	$recognized = of_recognized_font_styles2();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_font_style2', current( $recognized ) );
}
add_filter( 'of_font_style2', 'of_sanitize_font_style2' );


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
		'no-repeat' => 'No Repeat',
		'repeat-x'  => 'Repeat Horizontally',
		'repeat-y'  => 'Repeat Vertically',
		'repeat'    => 'Repeat All',
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
		'top left'      => 'Top Left',
		'top center'    => 'Top Center',
		'top right'     => 'Top Right',
		'center left'   => 'Middle Left',
		'center center' => 'Middle Center',
		'center right'  => 'Middle Right',
		'bottom left'   => 'Bottom Left',
		'bottom center' => 'Bottom Center',
		'bottom right'  => 'Bottom Right'
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
		'scroll' => 'Scroll Normally',
		'fixed'  => 'Fixed in Place'
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
	$sizes = range( 9, 14);
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
	$default = $options_googlefonts = array(
	"Arial" => "Arial",
    "Georgia" => "Georgia",
    "Tahoma" => "Tahoma",
    "Verdana" => "Verdana",
    "Helvetica" => "Helvetica",
    "Abel" => "Abel",
    "Abril Fatface" => "Abril Fatface",
    "Aclonica" => "Aclonica",
    "Actor" => "Actor",
    "Adamina" => "Adamina",
    "Aguafina Script" => "Aguafina Script",
    "Aladin" => "Aladin",
    "Aldrich" => "Aldrich",
    "Alice" => "Alice",
    "Alike Angular" => "Alike Angular",
    "Alike" => "Alike",
    "Allan" => "Allan",
    "Allerta Stencil" => "Allerta Stencil",
    "Allerta" => "Allerta",
    "Amaranth" => "Amaranth",
    "Amatic SC" => "Amatic SC",
    "Andada" => "Andada",
    "Andika" => "Andika",
    "Annie Use Your Telescope" => "Annie Use Your Telescope",
    "Anonymous Pro" => "Anonymous Pro",
    "Antic" => "Antic",
    "Anton" => "Anton",
    "Arapey" => "Arapey",
    "Architects Daughter" => "Architects Daughter",
    "Arimo" => "Arimo",
    "Artifika" => "Artifika",
    "Arvo" => "Arvo",
    "Asset" => "Asset",
    "Astloch" => "Astloch",
    "Atomic Age" => "Atomic Age",
    "Aubrey" => "Aubrey",
    "Bangers" => "Bangers",
    "Bentham" => "Bentham",
    "Bevan" => "Bevan",
    "Bigshot One" => "Bigshot One",
    "Bitter" => "Bitter",
    "Black Ops One" => "Black Ops One",
    "Bowlby One SC" => "Bowlby One SC",
    "Bowlby One" => "Bowlby One",
    "Brawler" => "Brawler",
    "Bubblegum Sans" => "Bubblegum Sans",
    "Buda" => "Buda",
    "Butcherman Caps" => "Butcherman Caps",
    "Cabin Condensed" => "Cabin Condensed",
    "Cabin Sketch" => "Cabin Sketch",
    "Cabin" => "Cabin",
    "Cagliostro" => "Cagliostro",
    "Calligraffitti" => "Calligraffitti",
    "Candal" => "Candal",
    "Cantarell" => "Cantarell",
    "Cardo" => "Cardo",
    "Carme" => "Carme",
    "Carter One" => "Carter One",
    "Caudex" => "Caudex",
    "Cedarville Cursive" => "Cedarville Cursive",
    "Changa One" => "Changa One",
    "Cherry Cream Soda" => "Cherry Cream Soda",
    "Chewy" => "Chewy",
    "Chicle" => "Chicle",
    "Chivo" => "Chivo",
    "Coda Caption" => "Coda Caption",
    "Coda" => "Coda",
    "Comfortaa" => "Comfortaa",
    "Coming Soon" => "Coming Soon",
    "Contrail One" => "Contrail One",
    "Convergence" => "Convergence",
    "Cookie" => "Cookie",
    "Copse" => "Copse",
    "Corben" => "Corben",
    "Cousine" => "Cousine",
    "Coustard" => "Coustard",
    "Covered By Your Grace" => "Covered By Your Grace",
    "Crafty Girls" => "Crafty Girls",
    "Creepster Caps" => "Creepster Caps",
    "Crimson Text" => "Crimson Text",
    "Crushed" => "Crushed",
    "Cuprum" => "Cuprum",
    "Damion" => "Damion",
    "Dancing Script" => "Dancing Script",
    "Dawning of a New Day" => "Dawning of a New Day",
    "Days One" => "Days One",
    "Delius Swash Caps" => "Delius Swash Caps",
    "Delius Unicase" => "Delius Unicase",
    "Delius" => "Delius",
    "Devonshire" => "Devonshire",
    "Didact Gothic" => "Didact Gothic",
    "Dorsa" => "Dorsa",
    "Dr Sugiyama" => "Dr Sugiyama",
    "Droid Sans Mono" => "Droid Sans Mono",
    "Droid Sans" => "Droid Sans",
    "Droid Serif" => "Droid Serif",
    "EB Garamond" => "EB Garamond",
    "Eater Caps" => "Eater Caps",
    "Expletus Sans" => "Expletus Sans",
    "Fanwood Text" => "Fanwood Text",
    "Federant" => "Federant",
    "Federo" => "Federo",
    "Fjord One" => "Fjord One",
    "Fondamento" => "Fondamento",
    "Fontdiner Swanky" => "Fontdiner Swanky",
    "Forum" => "Forum",
    "Francois One" => "Francois One",
    "Gentium Basic" => "Gentium Basic",
    "Gentium Book Basic" => "Gentium Book Basic",
    "Geo" => "Geo",
    "Geostar Fill" => "Geostar Fill",
    "Geostar" => "Geostar",
    "Give You Glory" => "Give You Glory",
    "Gloria Hallelujah" => "Gloria Hallelujah",
    "Goblin One" => "Goblin One",
    "Gochi Hand" => "Gochi Hand",
    "Goudy Bookletter 1911" => "Goudy Bookletter 1911",
    "Gravitas One" => "Gravitas One",
    "Gruppo" => "Gruppo",
    "Hammersmith One" => "Hammersmith One",
    "Herr Von Muellerhoff" => "Herr Von Muellerhoff",
    "Holtwood One SC" => "Holtwood One SC",
    "Homemade Apple" => "Homemade Apple",
    "IM Fell DW Pica SC" => "IM Fell DW Pica SC",
    "IM Fell DW Pica" => "IM Fell DW Pica",
    "IM Fell Double Pica SC" => "IM Fell Double Pica SC",
    "IM Fell Double Pica" => "IM Fell Double Pica",
    "IM Fell English SC" => "IM Fell English SC",
    "IM Fell English" => "IM Fell English",
    "IM Fell French Canon SC" => "IM Fell French Canon SC",
    "IM Fell French Canon" => "IM Fell French Canon",
    "IM Fell Great Primer SC" => "IM Fell Great Primer SC",
    "IM Fell Great Primer" => "IM Fell Great Primer",
    "Iceland" => "Iceland",
    "Inconsolata" => "Inconsolata",
    "Indie Flower" => "Indie Flower",
    "Irish Grover" => "Irish Grover",
    "Istok Web" => "Istok Web",
    "Jockey One" => "Jockey One",
    "Josefin Sans" => "Josefin Sans",
    "Josefin Slab" => "Josefin Slab",
    "Judson" => "Judson",
    "Julee" => "Julee",
    "Jura" => "Jura",
    "Just Another Hand" => "Just Another Hand",
    "Just Me Again Down Here" => "Just Me Again Down Here",
    "Kameron" => "Kameron",
    "Kelly Slab" => "Kelly Slab",
    "Kenia" => "Kenia",
    "Knewave" => "Knewave",
    "Kranky" => "Kranky",
    "Kreon" => "Kreon",
    "Kristi" => "Kristi",
    "La Belle Aurore" => "La Belle Aurore",
    "Lancelot" => "Lancelot",
    "Lato" => "Lato",
    "League Script" => "League Script",
    "Leckerli One" => "Leckerli One",
    "Lekton" => "Lekton",
    "Lemon" => "Lemon",
    "Limelight" => "Limelight",
    "Linden Hill" => "Linden Hill",
    "Lobster Two" => "Lobster Two",
    "Lobster" => "Lobster",
    "Lora" => "Lora",
    "Love Ya Like A Sister" => "Love Ya Like A Sister",
    "Loved by the King" => "Loved by the King",
    "Luckiest Guy" => "Luckiest Guy",
    "Maiden Orange" => "Maiden Orange",
    "Mako" => "Mako",
    "Marck Script" => "Marck Script",
    "Marvel" => "Marvel",
    "Mate SC" => "Mate SC",
    "Mate" => "Mate",
    "Maven Pro" => "Maven Pro",
    "Meddon" => "Meddon",
    "MedievalSharp" => "MedievalSharp",
    "Megrim" => "Megrim",
    "Merienda One" => "Merienda One",
    "Merriweather" => "Merriweather",
    "Metrophobic" => "Metrophobic",
    "Michroma" => "Michroma",
    "Miltonian Tattoo" => "Miltonian Tattoo",
    "Miltonian" => "Miltonian",
    "Miss Fajardose" => "Miss Fajardose",
    "Miss Saint Delafield" => "Miss Saint Delafield",
    "Modern Antiqua" => "Modern Antiqua",
    "Molengo" => "Molengo",
    "Monofett" => "Monofett",
    "Monoton" => "Monoton",
    "Monsieur La Doulaise" => "Monsieur La Doulaise",
    "Montez" => "Montez",
    "Mountains of Christmas" => "Mountains of Christmas",
    "Mr Bedford" => "Mr Bedford",
    "Mr Dafoe" => "Mr Dafoe",
    "Mr De Haviland" => "Mr De Haviland",
    "Mrs Sheppards" => "Mrs Sheppards",
    "Muli" => "Muli",
    "Neucha" => "Neucha",
    "Neuton" => "Neuton",
    "News Cycle" => "News Cycle",
    "Niconne" => "Niconne",
    "Nixie One" => "Nixie One",
    "Nobile" => "Nobile",
    "Nosifer Caps" => "Nosifer Caps",
    "Nothing You Could Do" => "Nothing You Could Do",
    "Nova Cut" => "Nova Cut",
    "Nova Flat" => "Nova Flat",
    "Nova Mono" => "Nova Mono",
    "Nova Oval" => "Nova Oval",
    "Nova Round" => "Nova Round",
    "Nova Script" => "Nova Script",
    "Nova Slim" => "Nova Slim",
    "Nova Square" => "Nova Square",
    "Numans" => "Numans",
    "Nunito" => "Nunito",
    "Old Standard TT" => "Old Standard TT",
    "Open Sans Condensed" => "Open Sans Condensed",
    "Open Sans" => "Open Sans",
    "Orbitron" => "Orbitron",
    "Oswald" => "Oswald",
    "Over the Rainbow" => "Over the Rainbow",
    "Ovo" => "Ovo",
    "PT Sans Caption" => "PT Sans Caption",
    "PT Sans Narrow" => "PT Sans Narrow",
    "PT Sans" => "PT Sans",
    "PT Serif Caption" => "PT Serif Caption",
    "PT Serif" => "PT Serif",
    "Pacifico" => "Pacifico",
    "Passero One" => "Passero One",
    "Patrick Hand" => "Patrick Hand",
    "Paytone One" => "Paytone One",
    "Permanent Marker" => "Permanent Marker",
    "Petrona" => "Petrona",
    "Philosopher" => "Philosopher",
    "Piedra" => "Piedra",
    "Pinyon Script" => "Pinyon Script",
    "Play" => "Play",
    "Playfair Display" => "Playfair Display",
    "Podkova" => "Podkova",
    "Poller One" => "Poller One",
    "Poly" => "Poly",
    "Pompiere" => "Pompiere",
    "Prata" => "Prata",
    "Prociono" => "Prociono",
    "Puritan" => "Puritan",
    "Quattrocento Sans" => "Quattrocento Sans",
    "Quattrocento" => "Quattrocento",
    "Questrial" => "Questrial",
    "Quicksand" => "Quicksand",
    "Radley" => "Radley",
    "Raleway" => "Raleway",
    "Rammetto One" => "Rammetto One",
    "Rancho" => "Rancho",
    "Rationale" => "Rationale",
    "Redressed" => "Redressed",
    "Reenie Beanie" => "Reenie Beanie",
    "Ribeye Marrow" => "Ribeye Marrow",
    "Ribeye" => "Ribeye",
    "Righteous" => "Righteous",
    "Rochester" => "Rochester",
    "Rock Salt" => "Rock Salt",
    "Rokkitt" => "Rokkitt",
    "Rosario" => "Rosario",
    "Ruslan Display" => "Ruslan Display",
    "Salsa" => "Salsa",
    "Sancreek" => "Sancreek",
    "Sansita One" => "Sansita One",
    "Satisfy" => "Satisfy",
    "Schoolbell" => "Schoolbell",
    "Shadows Into Light" => "Shadows Into Light",
    "Shanti" => "Shanti",
    "Short Stack" => "Short Stack",
    "Sigmar One" => "Sigmar One",
    "Signika Negative" => "Signika Negative",
    "Signika" => "Signika",
    "Six Caps" => "Six Caps",
    "Slackey" => "Slackey",
    "Smokum" => "Smokum",
    "Smythe" => "Smythe",
    "Sniglet" => "Sniglet",
    "Snippet" => "Snippet",
    "Sorts Mill Goudy" => "Sorts Mill Goudy",
    "Special Elite" => "Special Elite",
    "Spinnaker" => "Spinnaker",
    "Spirax" => "Spirax",
    "Stardos Stencil" => "Stardos Stencil",
    "Sue Ellen Francisco" => "Sue Ellen Francisco",
    "Sunshiney" => "Sunshiney",
    "Supermercado One" => "Supermercado One",
    "Swanky and Moo Moo" => "Swanky and Moo Moo",
    "Syncopate" => "Syncopate",
    "Tangerine" => "Tangerine",
    "Tenor Sans" => "Tenor Sans",
    "Terminal Dosis" => "Terminal Dosis",
    "The Girl Next Door" => "The Girl Next Door",
    "Tienne" => "Tienne",
    "Tinos" => "Tinos",
    "Tulpen One" => "Tulpen One",
    "Ubuntu Condensed" => "Ubuntu Condensed",
    "Ubuntu Mono" => "Ubuntu Mono",
    "Ubuntu" => "Ubuntu",
    "Ultra" => "Ultra",
    "UnifrakturCook" => "UnifrakturCook",
    "UnifrakturMaguntia" => "UnifrakturMaguntia",
    "Unkempt" => "Unkempt",
    "Unlock" => "Unlock",
    "Unna" => "Unna",
    "VT323" => "VT323",
    "Varela Round" => "Varela Round",
    "Varela" => "Varela",
    "Vast Shadow" => "Vast Shadow",
    "Vibur" => "Vibur",
    "Vidaloka" => "Vidaloka",
    "Volkhov" => "Volkhov",
    "Vollkorn" => "Vollkorn",
    "Voltaire" => "Voltaire",
    "Waiting for the Sunrise" => "Waiting for the Sunrise",
    "Wallpoet" => "Wallpoet",
    "Walter Turncoat" => "Walter Turncoat",
    "Wire One" => "Wire One",
    "Yanone Kaffeesatz" => "Yanone Kaffeesatz",
    "Yellowtail" => "Yellowtail",
    "Yeseva One" => "Yeseva One",
    "Zeyada" => "Zeyada"
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
		'normal'      => 'Normal',
		'italic'      => 'Italic',
		'bold'        => 'Bold',
		'bold italic' => 'Bold Italic'
		);
	return apply_filters( 'of_recognized_font_styles', $default );
}

function of_recognized_font_styles2() {
	$default = array(
		'none'      => 'Normal',
		'uppercase'      => 'Uppercase'
		);
	return apply_filters( 'of_recognized_font_styles2', $default );
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