<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'nanomag'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
        
        $heading_typography_google_defaults = array(
		'size' => '16px',
		'face' => 'Open Sans',
		'style' => 'normal',
		'color' => '#333333');

		$typography_google_defaults = array(
		'size' => '16px',
		'face' => 'Open Sans',
		'style' => 'normal',
		'color' => '#333333');
        
        $os_font = array(
        'Arial' => 'Arial',
		'Avant Garde' => 'Avant Garde',
		'Cambria' => 'Cambria',
		'Copse' => 'Copse',
		'Garamond' => 'Garamond',
		'Georgia' => 'Georgia',
		'Helvetica Neue' => 'Helvetica Neue',
		'Tahoma' => 'Tahoma');
        
	$google_faces = array(
    'none' => 'None',
	'arial'     => 'Arial',
	'verdana'   => 'Verdana',
	'trebuchet' => 'Trebuchet',
	'georgia'   => 'Georgia',
	'times'     => 'Times New Roman',
	'tahoma'    => 'Tahoma',
	'helvetica' => 'Helvetica',
	"Abel" => "Abel",
	"Abril Fatface" => "Abril Fatface",
	"Aclonica" => "Aclonica",
	"Acme" => "Acme",
	"Actor" => "Actor",
	"Adamina" => "Adamina",
	"Advent Pro" => "Advent Pro",
	"Aguafina Script" => "Aguafina Script",
	"Aladin" => "Aladin",
	"Aldrich" => "Aldrich",
	"Alegreya" => "Alegreya",
	"Alegreya SC" => "Alegreya SC",
	"Alex Brush" => "Alex Brush",
	"Alfa Slab One" => "Alfa Slab One",
	"Alice" => "Alice",
	"Alike" => "Alike",
	"Alike Angular" => "Alike Angular",
	"Allan" => "Allan",
	"Allerta" => "Allerta",
	"Allerta Stencil" => "Allerta Stencil",
	"Allura" => "Allura",
	"Almendra" => "Almendra",
	"Almendra SC" => "Almendra SC",
	"Amarante" => "Amarante",
	"Amaranth" => "Amaranth",
	"Amatic SC" => "Amatic SC",
	"Amethysta" => "Amethysta",
	"Andada" => "Andada",
	"Andika" => "Andika",
	"Angkor" => "Angkor",
	"Annie Use Your Telescope" => "Annie Use Your Telescope",
	"Anonymous Pro" => "Anonymous Pro",
	"Antic" => "Antic",
	"Antic Didone" => "Antic Didone",
	"Antic Slab" => "Antic Slab",
	"Anton" => "Anton",
	"Arapey" => "Arapey",
	"Arbutus" => "Arbutus",
	"Architects Daughter" => "Architects Daughter",
	"Arimo" => "Arimo",
	"Arizonia" => "Arizonia",
	"Armata" => "Armata",
	"Artifika" => "Artifika",
	"Arvo" => "Arvo",
	"Asap" => "Asap",
	"Asset" => "Asset",
	"Astloch" => "Astloch",
	"Asul" => "Asul",
	"Atomic Age" => "Atomic Age",
	"Aubrey" => "Aubrey",
	"Audiowide" => "Audiowide",
	"Average" => "Average",
	"Averia Gruesa Libre" => "Averia Gruesa Libre",
	"Averia Libre" => "Averia Libre",
	"Averia Sans Libre" => "Averia Sans Libre",
	"Averia Serif Libre" => "Averia Serif Libre",
	"Bad Script" => "Bad Script",
	"Balthazar" => "Balthazar",
	"Bangers" => "Bangers",
	"Basic" => "Basic",
	"Battambang" => "Battambang",
	"Baumans" => "Baumans",
	"Bayon" => "Bayon",
	"Belgrano" => "Belgrano",
	"Belleza" => "Belleza",
	"Bentham" => "Bentham",
	"Berkshire Swash" => "Berkshire Swash",
	"Bevan" => "Bevan",
	"Bigshot One" => "Bigshot One",
	"Bilbo" => "Bilbo",
	"Bilbo Swash Caps" => "Bilbo Swash Caps",
	"Bitter" => "Bitter",
	"Black Ops One" => "Black Ops One",
	"Bokor" => "Bokor",
	"Bonbon" => "Bonbon",
	"Boogaloo" => "Boogaloo",
	"Bowlby One" => "Bowlby One",
	"Bowlby One SC" => "Bowlby One SC",
	"Brawler" => "Brawler",
	"Bree Serif" => "Bree Serif",
	"Bubblegum Sans" => "Bubblegum Sans",
	"Bubbler One" => "Bubbler One",
	"Buda" => "Buda",
	"Buenard" => "Buenard",
	"Butcherman" => "Butcherman",
	"Butterfly Kids" => "Butterfly Kids",
	"Cabin" => "Cabin",
	"Cabin Condensed" => "Cabin Condensed",
	"Cabin Sketch" => "Cabin Sketch",
	"Caesar Dressing" => "Caesar Dressing",
	"Cagliostro" => "Cagliostro",
	"Calligraffitti" => "Calligraffitti",
	"Cambo" => "Cambo",
	"Candal" => "Candal",
	"Cantarell" => "Cantarell",
	"Cantata One" => "Cantata One",
	"Cantora One" => "Cantora One",
	"Capriola" => "Capriola",
	"Cardo" => "Cardo",
	"Carme" => "Carme",
	"Carter One" => "Carter One",
	"Caudex" => "Caudex",
	"Cedarville Cursive" => "Cedarville Cursive",
	"Ceviche One" => "Ceviche One",
	"Changa One" => "Changa One",
	"Chango" => "Chango",
	"Chau Philomene One" => "Chau Philomene One",
	"Chelsea Market" => "Chelsea Market",
	"Chenla" => "Chenla",
	"Cherry Cream Soda" => "Cherry Cream Soda",
	"Chewy" => "Chewy",
	"Chicle" => "Chicle",
	"Chivo" => "Chivo",
	"Coda" => "Coda",
	"Coda Caption" => "Coda Caption",
	"Codystar" => "Codystar",
	"Comfortaa" => "Comfortaa",
	"Coming Soon" => "Coming Soon",
	"Concert One" => "Concert One",
	"Condiment" => "Condiment",
	"Content" => "Content",
	"Contrail One" => "Contrail One",
	"Convergence" => "Convergence",
	"Cookie" => "Cookie",
	"Copse" => "Copse",
	"Corben" => "Corben",
	"Courgette" => "Courgette",
	"Cousine" => "Cousine",
	"Coustard" => "Coustard",
	"Covered By Your Grace" => "Covered By Your Grace",
	"Crafty Girls" => "Crafty Girls",
	"Creepster" => "Creepster",
	"Crete Round" => "Crete Round",
	"Crimson Text" => "Crimson Text",
	"Crushed" => "Crushed",
	"Cuprum" => "Cuprum",
	"Cutive" => "Cutive",
	"Damion" => "Damion",
	"Dancing Script" => "Dancing Script",
	"Dangrek" => "Dangrek",
	"Dawning of a New Day" => "Dawning of a New Day",
	"Days One" => "Days One",
	"Delius" => "Delius",
	"Delius Swash Caps" => "Delius Swash Caps",
	"Delius Unicase" => "Delius Unicase",
	"Della Respira" => "Della Respira",
	"Devonshire" => "Devonshire",
	"Didact Gothic" => "Didact Gothic",
	"Diplomata" => "Diplomata",
	"Diplomata SC" => "Diplomata SC",
	"Doppio One" => "Doppio One",
	"Dorsa" => "Dorsa",
	"Dosis" => "Dosis",
	"Dr Sugiyama" => "Dr Sugiyama",
	"Droid Sans" => "Droid Sans",
	"Droid Sans Mono" => "Droid Sans Mono",
	"Droid Serif" => "Droid Serif",
	"Duru Sans" => "Duru Sans",
	"Dynalight" => "Dynalight",
	"EB Garamond" => "EB Garamond",
	"Eagle Lake" => "Eagle Lake",
	"Eater" => "Eater",
	"Economica" => "Economica",
	"Electrolize" => "Electrolize",
	"Emblema One" => "Emblema One",
	"Emilys Candy" => "Emilys Candy",
	"Engagement" => "Engagement",
	"Enriqueta" => "Enriqueta",
	"Erica One" => "Erica One",
	"Esteban" => "Esteban",
	"Euphoria Script" => "Euphoria Script",
	"Ewert" => "Ewert",
	"Exo" => "Exo",
	"Expletus Sans" => "Expletus Sans",
	"Fjalla One" => "Fjalla One",
	"Fanwood Text" => "Fanwood Text",
	"Fascinate" => "Fascinate",
	"Fascinate Inline" => "Fascinate Inline",
	"Fasthand" => "Fasthand",
	"Federant" => "Federant",
	"Federo" => "Federo",
	"Felipa" => "Felipa",
	"Fjord One" => "Fjord One",
	"Flamenco" => "Flamenco",
	"Flavors" => "Flavors",
	"Fondamento" => "Fondamento",
	"Fontdiner Swanky" => "Fontdiner Swanky",
	"Forum" => "Forum",
	"Francois One" => "Francois One",
	"Fredericka the Great" => "Fredericka the Great",
	"Fredoka One" => "Fredoka One",
	"Freehand" => "Freehand",
	"Fresca" => "Fresca",
	"Frijole" => "Frijole",
	"Fugaz One" => "Fugaz One",
	"GFS Didot" => "GFS Didot",
	"GFS Neohellenic" => "GFS Neohellenic",
	"Galdeano" => "Galdeano",
	"Galindo" => "Galindo",
	"Gentium Basic" => "Gentium Basic",
	"Gentium Book Basic" => "Gentium Book Basic",
	"Geo" => "Geo",
	"Geostar" => "Geostar",
	"Geostar Fill" => "Geostar Fill",
	"Germania One" => "Germania One",
	"Give You Glory" => "Give You Glory",
	"Glass Antiqua" => "Glass Antiqua",
	"Glegoo" => "Glegoo",
	"Gloria Hallelujah" => "Gloria Hallelujah",
	"Goblin One" => "Goblin One",
	"Gochi Hand" => "Gochi Hand",
	"Gorditas" => "Gorditas",
	"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
	"Graduate" => "Graduate",
	"Gravitas One" => "Gravitas One",
	"Great Vibes" => "Great Vibes",
	"Griffy" => "Griffy",
	"Gruppo" => "Gruppo",
	"Gudea" => "Gudea",
	"Habibi" => "Habibi",
	"Hammersmith One" => "Hammersmith One",
	"Handlee" => "Handlee",
	"Hanuman" => "Hanuman",
	"Happy Monkey" => "Happy Monkey",
	"Headland One" => "Headland One",
	"Henny Penny" => "Henny Penny",
	"Hind" => "Hind",
	"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
	"Holtwood One SC" => "Holtwood One SC",
	"Homemade Apple" => "Homemade Apple",
	"Homenaje" => "Homenaje",
	"IM Fell DW Pica" => "IM Fell DW Pica",
	"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
	"IM Fell Double Pica" => "IM Fell Double Pica",
	"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
	"IM Fell English" => "IM Fell English",
	"IM Fell English SC" => "IM Fell English SC",
	"IM Fell French Canon" => "IM Fell French Canon",
	"IM Fell French Canon SC" => "IM Fell French Canon SC",
	"IM Fell Great Primer" => "IM Fell Great Primer",
	"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
	"Iceberg" => "Iceberg",
	"Iceland" => "Iceland",
	"Imprima" => "Imprima",
	"Inconsolata" => "Inconsolata",
	"Inder" => "Inder",
	"Indie Flower" => "Indie Flower",
	"Inika" => "Inika",
	"Irish Grover" => "Irish Grover",
	"Istok Web" => "Istok Web",
	"Italiana" => "Italiana",
	"Italianno" => "Italianno",
	"Jacques Francois" => "Jacques Francois",
	"Jacques Francois Shadow" => "Jacques Francois Shadow",
	"Jim Nightshade" => "Jim Nightshade",
	"Jockey One" => "Jockey One",
	"Jolly Lodger" => "Jolly Lodger",
	"Josefin Sans" => "Josefin Sans",
	"Josefin Slab" => "Josefin Slab",
	"Judson" => "Judson",
	"Julee" => "Julee",
	"Junge" => "Junge",
	"Jura" => "Jura",
	"Just Another Hand" => "Just Another Hand",
	"Just Me Again Down Here" => "Just Me Again Down Here",
	"Kameron" => "Kameron",
	"Karla" => "Karla",
	"Kaushan Script" => "Kaushan Script",
	"Kelly Slab" => "Kelly Slab",
	"Kenia" => "Kenia",
	"Khmer" => "Khmer",
	"Knewave" => "Knewave",
	"Kotta One" => "Kotta One",
	"Koulen" => "Koulen",
	"Kranky" => "Kranky",
	"Kreon" => "Kreon",
	"Kristi" => "Kristi",
	"Krona One" => "Krona One",
	"La Belle Aurore" => "La Belle Aurore",
	"Lancelot" => "Lancelot",
	"Lato" => "Lato",
	"League Script" => "League Script",
	"Leckerli One" => "Leckerli One",
	"Ledger" => "Ledger",
	"Lekton" => "Lekton",
	"Lemon" => "Lemon",
	"Life Savers" => "Life Savers",
	"Lilita One" => "Lilita One",
	"Limelight" => "Limelight",
	"Linden Hill" => "Linden Hill",
	"Lobster" => "Lobster",
	"Lobster Two" => "Lobster Two",
	"Londrina Outline" => "Londrina Outline",
	"Londrina Shadow" => "Londrina Shadow",
	"Londrina Sketch" => "Londrina Sketch",
	"Londrina Solid" => "Londrina Solid",
	"Lora" => "Lora",
	"Love Ya Like A Sister" => "Love Ya Like A Sister",
	"Loved by the King" => "Loved by the King",
	"Lovers Quarrel" => "Lovers Quarrel",
	"Luckiest Guy" => "Luckiest Guy",
	"Lusitana" => "Lusitana",
	"Lustria" => "Lustria",
	"Monda" => "Monda",
	"Macondo" => "Macondo",
	"Macondo Swash Caps" => "Macondo Swash Caps",
	"Magra" => "Magra",
	"Maiden Orange" => "Maiden Orange",
	"Mako" => "Mako",
	"Marck Script" => "Marck Script",
	"Marko One" => "Marko One",
	"Marmelad" => "Marmelad",
	"Marvel" => "Marvel",
	"Mate" => "Mate",
	"Mate SC" => "Mate SC",
	"Maven Pro" => "Maven Pro",
	"McLaren" => "McLaren",
	"Meddon" => "Meddon",
	"MedievalSharp" => "MedievalSharp",
	"Medula One" => "Medula One",
	"Megrim" => "Megrim",
	"Meie Script" => "Meie Script",
	"Merienda One" => "Merienda One",
	"Merriweather" => "Merriweather",
	"Metal" => "Metal",
	"Metal Mania" => "Metal Mania",
	"Metamorphous" => "Metamorphous",
	"Metrophobic" => "Metrophobic",
	"Michroma" => "Michroma",
	"Miltonian" => "Miltonian",
	"Miltonian Tattoo" => "Miltonian Tattoo",
	"Miniver" => "Miniver",
	"Miss Fajardose" => "Miss Fajardose",
	"Modern Antiqua" => "Modern Antiqua",
	"Molengo" => "Molengo",
	"Monofett" => "Monofett",
	"Monoton" => "Monoton",
	"Monsieur La Doulaise" => "Monsieur La Doulaise",
	"Montaga" => "Montaga",
	"Montez" => "Montez",
	"Montserrat" => "Montserrat",
	"Moul" => "Moul",
	"Moulpali" => "Moulpali",
	"Mountains of Christmas" => "Mountains of Christmas",
	"Mr Bedfort" => "Mr Bedfort",
	"Mr Dafoe" => "Mr Dafoe",
	"Mr De Haviland" => "Mr De Haviland",
	"Mrs Saint Delafield" => "Mrs Saint Delafield",
	"Mrs Sheppards" => "Mrs Sheppards",
	"Muli" => "Muli",
	"Mystery Quest" => "Mystery Quest",
	"Neucha" => "Neucha",
	"Neuton" => "Neuton",
	"News Cycle" => "News Cycle",
	"Niconne" => "Niconne",
	"Nixie One" => "Nixie One",
	"Nobile" => "Nobile",
	"Nokora" => "Nokora",
	"Norican" => "Norican",
	"Nosifer" => "Nosifer",
	"Nothing You Could Do" => "Nothing You Could Do",
	"Noticia Text" => "Noticia Text",
	"Nova Cut" => "Nova Cut",
	"Nova Flat" => "Nova Flat",
	"Nova Mono" => "Nova Mono",
	"Nova Oval" => "Nova Oval",
	"Nova Round" => "Nova Round",
	"Nova Script" => "Nova Script",
	"Nova Slim" => "Nova Slim",
	"Nova Square" => "Nova Square",
	"Noto Sans" => "Noto Sans",
	"Numans" => "Numans",
	"Nunito" => "Nunito",
	"Odor Mean Chey" => "Odor Mean Chey",
	"Old Standard TT" => "Old Standard TT",
	"Oldenburg" => "Oldenburg",
	"Oleo Script" => "Oleo Script",
	"Open Sans" => "Open Sans",
	"Open Sans Condensed" => "Open Sans Condensed",
	"Oranienbaum" => "Oranienbaum",

	"Orbitron" => "Orbitron",
	"Oregano" => "Oregano",
	"Orienta" => "Orienta",
	"Original Surfer" => "Original Surfer",
	"Oswald" => "Oswald",
	"Over the Rainbow" => "Over the Rainbow",
	"Overlock" => "Overlock",
	"Overlock SC" => "Overlock SC",
	"Ovo" => "Ovo",
	"Oxygen" => "Oxygen",
	"Oxygen Mono" => "Oxygen Mono",
	"PT Mono" => "PT Mono",
	"PT Sans" => "PT Sans",
	"PT Sans Caption" => "PT Sans Caption",
	"PT Sans Narrow" => "PT Sans Narrow",
	"PT Serif" => "PT Serif",
	"PT Serif Caption" => "PT Serif Caption",
	"Pacifico" => "Pacifico",
	"Pathway Gothic One" => "Pathway Gothic One",
	"Parisienne" => "Parisienne",
	"Passero One" => "Passero One",
	"Passion One" => "Passion One",
	"Patrick Hand" => "Patrick Hand",
	"Patua One" => "Patua One",
	"Paytone One" => "Paytone One",
	"Peralta" => "Peralta",
	"Permanent Marker" => "Permanent Marker",
	"Petit Formal Script" => "Petit Formal Script",
	"Petrona" => "Petrona",
	"Philosopher" => "Philosopher",
	"Piedra" => "Piedra",
	"Pinyon Script" => "Pinyon Script",
	"Plaster" => "Plaster",
	"Play" => "Play",
	"Playball" => "Playball",
	"Playfair Display" => "Playfair Display",
	"Podkova" => "Podkova",
	"Poiret One" => "Poiret One",
	"Poller One" => "Poller One",
	"Poly" => "Poly",
	"Pompiere" => "Pompiere",
	"Pontano Sans" => "Pontano Sans",
	"Port Lligat Sans" => "Port Lligat Sans",
	"Port Lligat Slab" => "Port Lligat Slab",
	"Prata" => "Prata",
	"Preahvihear" => "Preahvihear",
	"Press Start 2P" => "Press Start 2P",
	"Princess Sofia" => "Princess Sofia",
	"Prociono" => "Prociono",
	"Prosto One" => "Prosto One",
	"Puritan" => "Puritan",
	"Quando" => "Quando",
	"Quantico" => "Quantico",
	"Quattrocento" => "Quattrocento",
	"Quattrocento Sans" => "Quattrocento Sans",
	"Questrial" => "Questrial",
	"Quicksand" => "Quicksand",
	"Qwigley" => "Qwigley",
	"Racing Sans One" => "Racing Sans One",
	"Radley" => "Radley",
	"Raleway" => "Raleway",
	"Raleway Dots" => "Raleway Dots",
	"Rammetto One" => "Rammetto One",
	"Ranchers" => "Ranchers",
	"Rancho" => "Rancho",
	"Rationale" => "Rationale",
	"Redressed" => "Redressed",
	"Reenie Beanie" => "Reenie Beanie",
	"Revalia" => "Revalia",
	"Ribeye" => "Ribeye",
	"Ribeye Marrow" => "Ribeye Marrow",
	"Righteous" => "Righteous",
	"Rochester" => "Rochester",
	"Rock Salt" => "Rock Salt",
	"Rokkitt" => "Rokkitt",
	"Romanesco" => "Romanesco",
	"Ropa Sans" => "Ropa Sans",
	"Rosario" => "Rosario",
	"Rosarivo" => "Rosarivo",
	"Rouge Script" => "Rouge Script",
	"Ruda" => "Ruda",
	"Ruge Boogie" => "Ruge Boogie",
	"Ruluko" => "Ruluko",
	"Ruslan Display" => "Ruslan Display",
	"Russo One" => "Russo One",
	"Ruthie" => "Ruthie",
	"Roboto" => "Roboto",
	"Roboto Condensed" => "Roboto Condensed",
	"Rye" => "Rye",
	"Sail" => "Sail",
	"Salsa" => "Salsa",
	"Sancreek" => "Sancreek",
	"Sansita One" => "Sansita One",
	"Sarina" => "Sarina",
	"Satisfy" => "Satisfy",
	"Schoolbell" => "Schoolbell",
	"Seaweed Script" => "Seaweed Script",
	"Sevillana" => "Sevillana",
	"Shadows Into Light" => "Shadows Into Light",
	"Shadows Into Light Two" => "Shadows Into Light Two",
	"Shanti" => "Shanti",
	"Share" => "Share",
	"Shojumaru" => "Shojumaru",
	"Short Stack" => "Short Stack",
	"Siemreap" => "Siemreap",
	"Sigmar One" => "Sigmar One",
	"Signika" => "Signika",
	"Signika Negative" => "Signika Negative",
	"Simonetta" => "Simonetta",
	"Sirin Stencil" => "Sirin Stencil",
	"Six Caps" => "Six Caps",
	"Skranji" => "Skranji",
	"Slackey" => "Slackey",
	"Smokum" => "Smokum",
	"Smythe" => "Smythe",
	"Sniglet" => "Sniglet",
	"Snippet" => "Snippet",
	"Sofia" => "Sofia",
	"Sonsie One" => "Sonsie One",
	"Sorts Mill Goudy" => "Sorts Mill Goudy",
	"Source Sans Pro" => "Source Sans Pro",
	"Special Elite" => "Special Elite",
	"Spicy Rice" => "Spicy Rice",
	"Spinnaker" => "Spinnaker",
	"Spirax" => "Spirax",
	"Squada One" => "Squada One",
	"Stardos Stencil" => "Stardos Stencil",
	"Stint Ultra Condensed" => "Stint Ultra Condensed",
	"Stint Ultra Expanded" => "Stint Ultra Expanded",
	"Stoke" => "Stoke",
	"Sue Ellen Francisco" => "Sue Ellen Francisco",
	"Sunshiney" => "Sunshiney",
	"Supermercado One" => "Supermercado One",
	"Suwannaphum" => "Suwannaphum",
	"Swanky and Moo Moo" => "Swanky and Moo Moo",
	"Syncopate" => "Syncopate",
	"Tangerine" => "Tangerine",
	"Taprom" => "Taprom",
	"Telex" => "Telex",
	"Tenor Sans" => "Tenor Sans",
	"The Girl Next Door" => "The Girl Next Door",
	"Tienne" => "Tienne",
	"Tinos" => "Tinos",
	"Titan One" => "Titan One",
	"Trade Winds" => "Trade Winds",
	"Trocchi" => "Trocchi",
	"Trochut" => "Trochut",
	"Trykker" => "Trykker",
	"Tulpen One" => "Tulpen One",
	"Ubuntu" => "Ubuntu",
	"Ubuntu Condensed" => "Ubuntu Condensed",
	"Ubuntu Mono" => "Ubuntu Mono",
	"Ultra" => "Ultra",
	"Uncial Antiqua" => "Uncial Antiqua",
	"UnifrakturCook" => "UnifrakturCook",
	"UnifrakturMaguntia" => "UnifrakturMaguntia",
	"Unkempt" => "Unkempt",
	"Unlock" => "Unlock",
	"Unna" => "Unna",
	"VT323" => "VT323",
	"Varela" => "Varela",
	"Varela Round" => "Varela Round",
	"Vast Shadow" => "Vast Shadow",
	"Vibur" => "Vibur",
	"Vidaloka" => "Vidaloka",
	"Viga" => "Viga",
	"Voces" => "Voces",
	"Volkhov" => "Volkhov",
	"Vollkorn" => "Vollkorn",
	"Voltaire" => "Voltaire",
	"Waiting for the Sunrise" => "Waiting for the Sunrise",
	"Wallpoet" => "Wallpoet",
	"Walter Turncoat" => "Walter Turncoat",
	"Warnes" => "Warnes",
	"Wellfleet" => "Wellfleet",
	"Wire One" => "Wire One",
	"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
	"Yellowtail" => "Yellowtail",
	"Yeseva One" => "Yeseva One",
	"Yesteryear" => "Yesteryear",
	"Zeyada" => "Zeyad"	);        
	
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','13','14','16','18','20','24','28','34' ),
		'faces' =>  false,
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => true
	);
	
		// Typography Options
	$typography_p_options = array(
		'sizes' => false,
		'faces' => $google_faces,
		'styles' => false,
		'color' => false
	);

	$typograph_p = array(
		'size' => '14px',	
		'face' => 'Hind',	
		'style' => 'normal',
		'color' => '#545454');         

	
	$typography_header = array(
		'sizes' => false,
		'faces' => $os_font,
		'styles' => false,
		'color' => false
	);     
	
        
	$typograph_h1 = array(
		'size' => '34px',		
		'style' => 'normal',
		'color' => '#333333');
 
	$typograph_h2 = array(
		'size' => '28px',		
		'style' => 'normal',
		'color' => '#333333');    
	$typograph_h3 = array(
		'size' => '24px',		
		'style' => 'normal',
		'color' => '#333333'); 

	$typograph_h4 = array(
		'size' => '18px',		
		'style' => 'normal',
		'color' => '#333333');    
        
	$typograph_h5 = array(
		'size' => '16px',		
		'style' => 'normal',
		'color' => '#333333'); 
        
	$typograph_h6 = array(
		'size' => '13px',		
		'style' => 'normal',
		'color' => '#333333');    
	        
	$typography_header = array(
		'sizes' => false,
		'faces' => $os_font,
		'styles' => false,
		'color' => false
	);        
        
       $typography_google_header = array(
		'sizes' => false,
		'faces' => $google_faces,
		'styles' => array(),
		'color' => false
	);  


	// Option sidebar
	$option_sidebar = array();
	$sidebars = get_option('sbg_sidebars');
	$option_sidebar['']='';
	
	if(isset($sidebars)) {
		if(is_array($sidebars)) {			
			foreach($sidebars as $sidebar) {				
				$option_sidebar[$sidebar] = $sidebar;
			}
			
		}
	}

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
        
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}



	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/inc/option/images/';
	$patternpath =  get_template_directory_uri() . '/img/pattern/';

	$options = array();
        
        
        $options[] = array(
		'name' => esc_attr__('General Setting', 'nanomag'),
		'type' => 'heading');
		
		
        $options[] = array(
		'name' => esc_attr__('Your website logo', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'logo_uploader',
		'type' => 'upload');
		
        $options[] = array(
		'name' => esc_attr__('Your website favicon', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'favicon_uploader',
		'type' => 'upload');

		$options[] = array(
		'name' => "Layout options (This options will switch your theme to personal blog or magazine)",
		'desc' => esc_attr__('', 'nanomag'),
		'id' => "magazine_layout_design",
		'std' => "magazine_default",
		'type' => "images",
		'options' => array(
			'magazine_default' => $imagepath . 'magazine.png',
			'magazine_personal' => $imagepath . 'personal.png'
			)
		);	

		$options[] = array(
		'name' => esc_attr__('Full or Boxed Layout', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'full_or_boxed_layout',
		'std' => 'full_image_option',
		'type' => 'radio',
		'options' => array(
			'full_image_option' => esc_attr__('Full width', 'nanomag'),
			'box_image_option' => esc_attr__('Boxed with', 'nanomag')
		));

		$options[] = array(
		'name' => esc_attr__('Theme header style (This options work with magazine layout only)', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'theme_header_style',
		'std' => 'theme_header_style_0',
		'type' => 'radio',
		'options' => array(
			'theme_header_style_0' => esc_attr__('Default header', 'nanomag'),
			'theme_header_style_1' => esc_attr__('Header Style 1', 'nanomag'),
			'theme_header_style_2' => esc_attr__('Header Style 2', 'nanomag'),
			'theme_header_style_3' => esc_attr__('Header Style 3', 'nanomag'),
			'theme_header_style_4' => esc_attr__('Header Style 4', 'nanomag'),
			'theme_header_style_5' => esc_attr__('Header Style 5', 'nanomag'),
			'theme_header_style_6' => esc_attr__('Header Style 6', 'nanomag'),
			'theme_header_style_7' => esc_attr__('Header Style 7', 'nanomag')
		));

	$options[] = array(
		'name' => esc_attr__('Theme color', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'theme_color',
		'std' => '#da1010',
		'type' => 'color' );
	$options[] = array(
		'name' => esc_attr__('header top background color', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'main_menubg_color',
		'std' => '#da1010',
		'type' => 'color' );

		$options[] = array(
		'name' => esc_attr__('Link color post content', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'theme_link_color',
		'std' => '',
		'type' => 'color' );

		$options[] = array(
		'name' => esc_attr__('Link hover color post content', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'theme_link_hover_color',
		'std' => '',
		'type' => 'color' );  
		
			$options[] = array(
		'name' => esc_attr__('Paragraph Font', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => "body_font",
		'std' => $typograph_p,
		'type' => 'typography',
		'options' => $typography_p_options);  
		        
        $options[] = array(
		'name' => esc_attr__('Menu Title Google Font', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => "menu_title_google_font",
		'std' => $heading_typography_google_defaults,
		'type' => 'typography',
		'options' => $typography_google_header);

        $options[] = array(
		'name' => esc_attr__('Heading Title Google Font', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => "heading_title_google_font",
		'std' => $heading_typography_google_defaults,
		'type' => 'typography',
		'options' => $typography_google_header); 

        $options[] = array(
		'name' => esc_attr__('Title Google Font', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => "title_google_font",
		'std' => $typography_google_defaults,
		'type' => 'typography',
		'options' => $typography_google_header);  

		$options[] = array(
		'name' => esc_attr__('Disable top social icons', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_top_social_icons',
		'std' => '0',                
		'type' => 'checkbox');

		$options[] = array(
		'name' => esc_attr__('Disable top search', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_top_search',
		'std' => '0',                
		'type' => 'checkbox');
		
		$options[] = array(
		'name' => esc_attr__('Disable sticky menu', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_sticky_menu',
		'std' => '0',                
		'type' => 'checkbox');		
		
		$options[] = array(
		'name' => esc_attr__('Disable random post link', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_random_post_link',
		'std' => '0',                
		'type' => 'checkbox');	
		
		$options[] = array(
		'name' => esc_attr__('Disable News ticker', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_newsticker',
		'std' => '0',                
		'type' => 'checkbox');

		$options[] = array(
		'name' => esc_attr__('Disable Home carousel', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_home_carousel',
		'std' => '1',                
		'type' => 'checkbox');	
	
		$options[] = array(
		'name' => esc_attr__('Disable animation when scoll down', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_css_animation',
		'std' => '0',                
		'type' => 'checkbox');

		$options[] = array(
		'name' => esc_attr__('Disable image hover rotation', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'image_hover_disable',
		'std' => '0',                
		'type' => 'checkbox');			
				        
        //End Gerneral setting

		
	
	
	    //background option
	$options[] = array(
		'name' => esc_attr__('Style & Background', 'nanomag'),
		'type' => 'heading');   
		
		
		$options[] = array(
		'name' => "Background option",
		'desc' => esc_attr__('', 'nanomag'),
		'id' => "background_body_option",
		'std' => "pattern",
		'type' => "images",
		'options' => array(
			'pattern' => $imagepath . 'pattern.png',
			'big_image' => $imagepath . 'big_img.png',
			'color' => $imagepath . 'color.png'
			)
	);	
        
	$options[] = array(
		'name' => "Background parttern",
		'desc' => "",
		'id' => "background_parttern",
		'std' => "pattern2",
		'type' => "images",
		'class' => "background_pattern",
		'options' => array(
			'pattern1' => $patternpath . '/pattern1.png',
			'pattern2' => $patternpath . '/pattern2.png',
			'pattern3' => $patternpath . '/pattern3.png',
			'pattern4' => $patternpath . '/pattern4.png',
			'pattern5' => $patternpath . '/pattern5.png',
			'pattern6' => $patternpath . '/pattern6.png',
			'pattern7' => $patternpath . '/pattern7.png',
			'pattern8' => $patternpath . '/pattern8.png',
			'pattern9' => $patternpath . '/pattern9.png',
			'pattern10' => $patternpath . '/pattern10.png',
			'pattern11' => $patternpath . '/pattern11.png',
			'pattern12' => $patternpath . '/pattern12.png',
			'pattern13' => $patternpath . '/pattern13.png',
			'pattern14' => $patternpath . '/pattern14.png',
			'pattern15' => $patternpath . '/pattern15.png',
			'pattern16' => $patternpath . '/pattern16.png',
			'pattern17' => $patternpath . '/pattern17.png',
			'pattern18' => $patternpath . '/pattern18.png',
			'pattern19' => $patternpath . '/pattern19.png',
			'pattern20' => $patternpath . '/pattern20.png',
			'pattern21' => $patternpath . '/pattern21.png',
			'pattern22' => $patternpath . '/pattern22.png',
			'pattern23' => $patternpath . '/pattern23.png',
			'pattern24' => $patternpath . '/pattern24.png',
			'pattern25' => $patternpath . '/pattern25.png',
			'pattern26' => $patternpath . '/pattern26.png',
			'pattern27' => $patternpath . '/pattern27.png',
			'pattern28' => $patternpath . '/pattern28.png',
			'pattern29' => $patternpath . '/pattern29.png',
			'pattern30' => $patternpath . '/pattern30.png',
			'pattern31' => $patternpath . '/pattern31.png',
			'pattern32' => $patternpath . '/pattern32.png',
			'pattern33' => $patternpath . '/pattern33.png',
			'pattern34' => $patternpath . '/pattern34.png',
			'pattern35' => $patternpath . '/pattern35.png',
			'pattern36' => $patternpath . '/pattern36.png',
			'pattern37' => $patternpath . '/pattern37.png',
			'pattern38' => $patternpath . '/pattern38.png',
			'pattern39' => $patternpath . '/pattern39.png',
			'pattern40' => $patternpath . '/pattern40.png',
			'pattern41' => $patternpath . '/pattern41.png',
			'pattern42' => $patternpath . '/pattern42.png',
			'pattern43' => $patternpath . '/pattern43.png',
			'pattern44' => $patternpath . '/pattern44.png',
			'pattern45' => $patternpath . '/pattern45.png',
			'pattern46' => $patternpath . '/pattern46.png',
			'pattern47' => $patternpath . '/pattern47.png',
			'pattern48' => $patternpath . '/pattern48.png',
			'pattern49' => $patternpath . '/pattern49.png',
			'pattern50' => $patternpath . '/pattern50.png',
			'pattern51' => $patternpath . '/pattern51.png',
			'pattern52' => $patternpath . '/pattern52.png',
			'pattern53' => $patternpath . '/pattern53.png',
			'pattern54' => $patternpath . '/pattern54.png'	
			)
	);
	
	    $options[] = array(
		'name' => esc_attr__('Background large Image', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'background_large_image',
		'type' => 'upload');		  


		$options[] = array(
		'name' => esc_attr__('Background color', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'background_color',
		'std' => '',
		'type' => 'color' );    
		
		$options[] = array(
		'name' => esc_attr__('Custom CSS', 'nanomag'),
		'desc' => esc_attr__("", 'nanomag'),
		'id' => 'custom_style',
		'std' => "",		
		'type' => 'textarea'		
		);	
		
		
        $wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
        //End background option



	
	    //Slider option
	$options[] = array(
		'name' => esc_attr__('Header Slider Option', 'nanomag'),
		'type' => 'heading');   


	// Multicheck Array
	$multicheck_array = array(
		'one' => esc_attr__('French Toast', 'nanomag'),
		'two' => esc_attr__('Pancake', 'nanomag'),
		'three' => esc_attr__('Omelette', 'nanomag'),
		'four' => esc_attr__('Crepe', 'nanomag'),
		'five' => esc_attr__('Waffle', 'nanomag')
	);

	
	$options[] = array(
		'name' => esc_attr__('Slider category', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'slider_category_select',
		'std' => '', // These items get checked by default
		'type' => 'multicheck',
		'options' => $options_categories);

	 	$options[] = array(
		'name' => esc_attr__('Right slider title', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'right_slider_title',
		'std' => 'Post list Display',
		'type' => 'text');	

	$options[] = array(
		'name' => esc_attr__('Post on right slider category', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'category_on_right_slider',
		'std' => '', // These items get checked by default
		'type' => 'multicheck',
		'options' => $options_categories);	

		$options[] = array(
		'name' => esc_attr__('News ticker title', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'news_ticker_title',
		'std' => 'BREAKING NEWS',
		'type' => 'text');

	$options[] = array(
		'name' => esc_attr__('News ticker category', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'news_ticker_category',
		'std' => '', // These items get checked by default
		'type' => 'multicheck',
		'options' => $options_categories);	


	$options[] = array(
		'name' => esc_attr__('Post carousel title', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'carousel_post_title',
		'std' => 'Carousel post title',
		'type' => 'text');	

	$options[] = array(
		'name' => esc_attr__('Carousel post', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'carousel_post',
		'std' => '', // These items get checked by default
		'type' => 'multicheck',
		'options' => $options_categories);		

	$options[] = array(
		'name' => esc_attr__('Number of Post carousel', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'number_carousel',
		'std' => '7',
		'type' => 'text');	

		$options[] = array(
		'name' => esc_attr__('Number of news ticker', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'number_news_ticker',
		'std' => '10',
		'type' => 'text');

		$options[] = array(
		'name' => esc_attr__('Number of slider', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'slider_number',
		'std' => '8',
		'type' => 'text');

		$options[] = array(
		'name' => esc_attr__('Number of large slider', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'large_slider_number',
		'std' => '4',
		'type' => 'text');
		
		$options[] = array(
		'name' => esc_attr__('Number of header list slider', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'number_header_list',
		'std' => '7',
		'type' => 'text');	

		$options[] = array(
		'name' => esc_attr__('Offset carousel post', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'number_offset_carousel_post',
		'std' => '0',
		'type' => 'text');

		$options[] = array(
		'name' => esc_attr__('Offset post on right slider', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'number_offset_post_right',
		'std' => '0',
		'type' => 'text');	
		
		       

		
	//End slider option
	
	    
        
        //Menu option
    
	$options[] = array(
		'name' => esc_attr__('Menu background color', 'nanomag'),
		'type' => 'heading');   



	$options[] = array(
		'name' => esc_attr__('Background color 1', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_1',
		'std' => '#485169',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_attr__('Background color 2', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_2',
		'std' => '#b5371b',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_attr__('Background color 3', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_3',
		'std' => '#00ad6a',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('Background color 4', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_4',
		'std' => '#a56d35',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('Background color 5', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_5',
		'std' => '#ff4274',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('Background color 6', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_6',
		'std' => '#10a89e',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('Background color 7', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_7',
		'std' => '#7f42bf',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('Background color 8', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_8',
		'std' => '#f2540c',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('Background color 9', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_9',
		'std' => '#348207',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('Background color 10', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'border_color_10',
		'std' => '#c6a41b',
		'type' => 'color' );



	//Menu option
    
	$options[] = array(
		'name' => esc_attr__('Content border color', 'nanomag'),
		'type' => 'heading');   



	$options[] = array(
		'name' => esc_attr__('border color 1', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_1',
		'std' => '#D03131',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_attr__('border color 2', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_2',
		'std' => '#b5371b',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_attr__('border color 3', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_3',
		'std' => '#00ad6a',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('border color 4', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_4',
		'std' => '#a56d35',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('border color 5', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_5',
		'std' => '#ff4274',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('border color 6', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_6',
		'std' => '#10a89e',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('border color 7', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_7',
		'std' => '#7f42bf',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('border color 8', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_8',
		'std' => '#f2540c',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('border color 9', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_9',
		'std' => '#348207',
		'type' => 'color' );
		
	$options[] = array(
		'name' => esc_attr__('border color 10', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_10',
		'std' => '#c6a41b',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_attr__('border color 11', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_11',
		'std' => '#aa17b5',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_attr__('border color 12', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_12',
		'std' => '#3ebc18',
		'type' => 'color' );
	
	$options[] = array(
		'name' => esc_attr__('border color 13', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_13',
		'std' => '#9e5a11',
		'type' => 'color' );
	
	$options[] = array(
		'name' => esc_attr__('border color 14', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_14',
		'std' => '#128752',
		'type' => 'color' );
	
	$options[] = array(
		'name' => esc_attr__('border color 15', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_15',
		'std' => '#a02c06',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_attr__('border color 16', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_16',
		'std' => '#501edb',
		'type' => 'color' );

	$options[] = array(
		'name' => esc_attr__('border color 17', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'builder_color_17',
		'std' => '#ea2060',
		'type' => 'color' );
	   
        
        //end typography
         
        //Blog
	$options[] = array(
		'name' => esc_attr__('Blog', 'nanomag'),
		'type' => 'heading');   
		
	$options[] = array(
		'name' => esc_attr__('Disable post date', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_date',
		'std' => '0',                
		'type' => 'checkbox');

	$options[] = array(
		'name' => esc_attr__('Disable single post format & feature image', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_format_single',
		'std' => '0',                
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => esc_attr__('Disable post category', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_category',
		'std' => '0',                
		'type' => 'checkbox');		

	$options[] = array(
		'name' => esc_attr__('Disable post comment meta', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_comment_meta',
		'std' => '0',                
		'type' => 'checkbox');	

	$options[] = array(
		'name' => esc_attr__('Disable post review', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_review',
		'std' => '0',                
		'type' => 'checkbox'); 

	$options[] = array(
		'name' => esc_attr__('Disable post tag', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_tag',
		'std' => '0',                
		'type' => 'checkbox'); 
		
	$options[] = array(
		'name' => esc_attr__('Disable post share', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_share',
		'std' => '0',                
		'type' => 'checkbox'); 		

	$options[] = array(
		'name' => esc_attr__('Disable post author', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_author',
		'std' => '0',                
		'type' => 'checkbox'); 	
		
		$options[] = array(
		'name' => esc_attr__('Disable post author box', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_author_box',
		'std' => '0',                
		'type' => 'checkbox');		  

	$options[] = array(
		'name' => esc_attr__('Disable post related', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_post_related',
		'std' => '0',                
		'type' => 'checkbox'); 
        
        //Social Media
	$options[] = array(
		'name' => esc_attr__('Social Link', 'nanomag'),
		'type' => 'heading'); 
		
        
	$options[] = array(
		'name' => esc_attr__('Facebook', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'facebook',
		'std' => '#',		
		'type' => 'text'); 
		
	$options[] = array(
		'name' => esc_attr__('Flickr', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'flickr',
		'std' => '#',		
		'type' => 'text'); 	

	$options[] = array(
		'name' => esc_attr__('Tumblr', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'tumblr',
		'std' => '#',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Google-plus', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'google_plus',
		'std' => '#',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Behance', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'behance',
		'std' => '#',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Vimeo', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'vimeo',
		'std' => '#',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Youtube', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'youtube',
		'std' => '#',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Instagram', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'instagram',
		'std' => '#',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Linkedin', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'linkedin',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Pinterest', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'pinterest',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Twitter', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'twitter',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Blogger', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'blogger',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Deviantart', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'deviantart',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Dribble', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'dribble',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Dropbox', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'dropbox',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('RSS', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'rss',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Skype', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'skype',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Stumbleupon', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'stumbleupon',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Wordpress', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'wordpress',
		'std' => '',		
		'type' => 'text'); 

	$options[] = array(
		'name' => esc_attr__('Yahoo', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'yahoo',
		'std' => '',		
		'type' => 'text'); 		
	
			$options[] = array(
		'name' => esc_attr__('Sidebar', 'nanomag'),
		'type' => 'heading'); 
		
		$options[] = array(
		'name' => esc_attr__('Post sidebar', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'post_sidebar',
		'type' => 'select',
		'options' =>$option_sidebar);
		
		$options[] = array(
		'name' => esc_attr__('Page sidebar', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'page_sidebar',
		'type' => 'select',
		'options' =>$option_sidebar); 
		 	
		$options[] = array(
		'name' => esc_attr__('Category sidebar', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'category_sidebar',
		'type' => 'select',
		'options' =>$option_sidebar); 
		
		$options[] = array(
		'name' => esc_attr__('Tag sidebar', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'tag_sidebar',
		'type' => 'select',
		'options' =>$option_sidebar); 	
		
		$options[] = array(
		'name' => esc_attr__('Archive sidebar', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'archive_sidebar',
		'type' => 'select',
		'options' =>$option_sidebar); 
	

	
        //Footer
       $options[] = array(
		'name' => esc_attr__('Footer', 'nanomag'),
		'type' => 'heading'); 
		

	$options[] = array(
		'name' => esc_attr__('Footer columns', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'footer_columns',
		'std' => 'footer3col',
		'type' => 'radio',
		'options' => array(
			'footer3col' => __('Footer 3 columns', 'nanomag'),
			'footer2col' => __('Footer 2 columns', 'nanomag'),
			'footer1col' => __('Footer 1 columns', 'nanomag'),
			'footer0col' => __('No Footer', 'nanomag')
		));

	$options[] = array(
		'name' => esc_attr__('Disable footer copyright & footer menu', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'disable_footer_copyright_menu',
		'std' => '0',                
		'type' => 'checkbox');
		
		
		$options[] = array(
		'name' => esc_attr__('Footer copyright', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'copyright',
		'std' => 'Copyright All rights reserved',
		'type' => 'textarea');	

	$options[] = array(
		'name' => esc_attr__('Google analytics code', 'nanomag'),
		'desc' => esc_attr__('', 'nanomag'),
		'id' => 'google_analytics_code',
		'type' => 'textarea');		
		 //End Footer
		
			
	return $options;
}