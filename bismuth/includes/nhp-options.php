<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('NHP_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('NHP_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'nhp-opts'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'nhp-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_280_settings.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');


/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){

	$google_fonts = array(
		'ABeeZee' => "ABeeZee",
		'Abel' => "Abel",
		'Abril+Fatface' => "Abril Fatface",
		'Aclonica' => "Aclonica",
		'Acme' => "Acme",
		'Actor' => "Actor",
		'Adamina' => "Adamina",
		'Advent+Pro' => "Advent Pro",
		'Aguafina+Script' => "Aguafina Script",
		'Akronim' => "Akronim",
		'Aladin' => "Aladin",
		'Aldrich' => "Aldrich",
		'Alegreya' => "Alegreya",
		'Alegreya+SC' => "Alegreya SC",
		'Alex+Brush' => "Alex Brush",
		'Alfa+Slab+One' => "Alfa Slab One",
		'Alice' => "Alice",
		'Alike' => "Alike",
		'Alike+Angular' => "Alike Angular",
		'Allan' => "Allan",
		'Allerta' => "Allerta",
		'Allerta+Stencil' => "Allerta Stencil",
		'Allura' => "Allura",
		'Almendra' => "Almendra",
		'Almendra+Display' => "Almendra Display",
		'Almendra+SC' => "Almendra SC",
		'Amarante' => "Amarante",
		'Amaranth' => "Amaranth",
		'Amatic+SC' => "Amatic SC",
		'Amethysta' => "Amethysta",
		'Anaheim' => "Anaheim",
		'Andada' => "Andada",
		'Andika' => "Andika",
		'Angkor' => "Angkor",
		'Annie+Use+Your+Telescope' => "Annie Use Your Telescope",
		'Anonymous+Pro' => "Anonymous Pro",
		'Antic' => "Antic",
		'Antic+Didone' => "Antic Didone",
		'Antic+Slab' => "Antic Slab",
		'Anton' => "Anton",
		'Arapey' => "Arapey",
		'Arbutus' => "Arbutus",
		'Arbutus+Slab' => "Arbutus Slab",
		'Architects+Daughter' => "Architects Daughter",
		'Archivo+Black' => "Archivo Black",
		'Archivo+Narrow' => "Archivo Narrow",
		'Arimo' => "Arimo",
		'Arizonia' => "Arizonia",
		'Armata' => "Armata",
		'Artifika' => "Artifika",
		'Arvo' => "Arvo",
		'Asap' => "Asap",
		'Asset' => "Asset",
		'Astloch' => "Astloch",
		'Asul' => "Asul",
		'Atomic+Age' => "Atomic Age",
		'Aubrey' => "Aubrey",
		'Audiowide' => "Audiowide",
		'Autour+One' => "Autour One",
		'Average' => "Average",
		'Average+Sans' => "Average Sans",
		'Averia+Gruesa+Libre' => "Averia Gruesa Libre",
		'Averia+Libre' => "Averia Libre",
		'Averia+Sans+Libre' => "Averia Sans Libre",
		'Averia+Serif+Libre' => "Averia Serif Libre",
		'Bad+Script' => "Bad Script",
		'Balthazar' => "Balthazar",
		'Bangers' => "Bangers",
		'Basic' => "Basic",
		'Battambang' => "Battambang",
		'Baumans' => "Baumans",
		'Bayon' => "Bayon",
		'Belgrano' => "Belgrano",
		'Belleza' => "Belleza",
		'BenchNine' => "BenchNine",
		'Bentham' => "Bentham",
		'Berkshire+Swash' => "Berkshire Swash",
		'Bevan' => "Bevan",
		'Bigelow+Rules' => "Bigelow Rules",
		'Bigshot+One' => "Bigshot One",
		'Bilbo' => "Bilbo",
		'Bilbo+Swash+Caps' => "Bilbo Swash Caps",
		'Bitter' => "Bitter",
		'Black+Ops+One' => "Black Ops One",
		'Bokor' => "Bokor",
		'Bonbon' => "Bonbon",
		'Boogaloo' => "Boogaloo",
		'Bowlby+One' => "Bowlby One",
		'Bowlby+One+SC' => "Bowlby One SC",
		'Brawler' => "Brawler",
		'Bree+Serif' => "Bree Serif",
		'Bubblegum+Sans' => "Bubblegum Sans",
		'Bubbler+One' => "Bubbler One",
		'Buda' => "Buda",
		'Buenard' => "Buenard",
		'Butcherman' => "Butcherman",
		'Butterfly+Kids' => "Butterfly Kids",
		'Cabin' => "Cabin",
		'Cabin+Condensed' => "Cabin Condensed",
		'Cabin+Sketch' => "Cabin Sketch",
		'Caesar+Dressing' => "Caesar Dressing",
		'Cagliostro' => "Cagliostro",
		'Calligraffitti' => "Calligraffitti",
		'Cambo' => "Cambo",
		'Candal' => "Candal",
		'Cantarell' => "Cantarell",
		'Cantata+One' => "Cantata One",
		'Cantora+One' => "Cantora One",
		'Capriola' => "Capriola",
		'Cardo' => "Cardo",
		'Carme' => "Carme",
		'Carrois+Gothic' => "Carrois Gothic",
		'Carrois+Gothic+SC' => "Carrois Gothic SC",
		'Carter+One' => "Carter One",
		'Caudex' => "Caudex",
		'Cedarville+Cursive' => "Cedarville Cursive",
		'Ceviche+One' => "Ceviche One",
		'Changa+One' => "Changa One",
		'Chango' => "Chango",
		'Chau+Philomene+One' => "Chau Philomene One",
		'Chela+One' => "Chela One",
		'Chelsea+Market' => "Chelsea Market",
		'Chenla' => "Chenla",
		'Cherry+Cream+Soda' => "Cherry Cream Soda",
		'Cherry+Swash' => "Cherry Swash",
		'Chewy' => "Chewy",
		'Chicle' => "Chicle",
		'Chivo' => "Chivo",
		'Cinzel' => "Cinzel",
		'Cinzel+Decorative' => "Cinzel Decorative",
		'Clicker+Script' => "Clicker Script",
		'Coda' => "Coda",
		'Coda+Caption' => "Coda Caption",
		'Codystar' => "Codystar",
		'Combo' => "Combo",
		'Comfortaa' => "Comfortaa",
		'Coming+Soon' => "Coming Soon",
		'Concert+One' => "Concert One",
		'Condiment' => "Condiment",
		'Content' => "Content",
		'Contrail+One' => "Contrail One",
		'Convergence' => "Convergence",
		'Cookie' => "Cookie",
		'Copse' => "Copse",
		'Corben' => "Corben",
		'Courgette' => "Courgette",
		'Cousine' => "Cousine",
		'Coustard' => "Coustard",
		'Covered+By+Your+Grace' => "Covered By Your Grace",
		'Crafty+Girls' => "Crafty Girls",
		'Creepster' => "Creepster",
		'Crete+Round' => "Crete Round",
		'Crimson+Text' => "Crimson Text",
		'Croissant+One' => "Croissant One",
		'Crushed' => "Crushed",
		'Cuprum' => "Cuprum",
		'Cutive' => "Cutive",
		'Cutive+Mono' => "Cutive Mono",
		'Damion' => "Damion",
		'Dancing+Script' => "Dancing Script",
		'Dangrek' => "Dangrek",
		'Dawning+of+a+New+Day' => "Dawning of a New Day",
		'Days+One' => "Days One",
		'Delius' => "Delius",
		'Delius+Swash+Caps' => "Delius Swash Caps",
		'Delius+Unicase' => "Delius Unicase",
		'Della+Respira' => "Della Respira",
		'Denk+One' => "Denk One",
		'Devonshire' => "Devonshire",
		'Didact+Gothic' => "Didact Gothic",
		'Diplomata' => "Diplomata",
		'Diplomata+SC' => "Diplomata SC",
		'Domine' => "Domine",
		'Donegal+One' => "Donegal One",
		'Doppio+One' => "Doppio One",
		'Dorsa' => "Dorsa",
		'Dosis' => "Dosis",
		'Dr+Sugiyama' => "Dr Sugiyama",
		'Droid+Sans' => "Droid Sans",
		'Droid+Sans+Mono' => "Droid Sans Mono",
		'Droid+Serif' => "Droid Serif",
		'Duru+Sans' => "Duru Sans",
		'Dynalight' => "Dynalight",
		'EB+Garamond' => "EB Garamond",
		'Eagle+Lake' => "Eagle Lake",
		'Eater' => "Eater",
		'Economica' => "Economica",
		'Electrolize' => "Electrolize",
		'Elsie' => "Elsie",
		'Elsie+Swash+Caps' => "Elsie Swash Caps",
		'Emblema+One' => "Emblema One",
		'Emilys+Candy' => "Emilys Candy",
		'Engagement' => "Engagement",
		'Englebert' => "Englebert",
		'Enriqueta' => "Enriqueta",
		'Erica+One' => "Erica One",
		'Esteban' => "Esteban",
		'Euphoria+Script' => "Euphoria Script",
		'Ewert' => "Ewert",
		'Exo' => "Exo",
		'Expletus+Sans' => "Expletus Sans",
		'Fanwood+Text' => "Fanwood Text",
		'Fascinate' => "Fascinate",
		'Fascinate+Inline' => "Fascinate Inline",
		'Faster+One' => "Faster One",
		'Fasthand' => "Fasthand",
		'Federant' => "Federant",
		'Federo' => "Federo",
		'Felipa' => "Felipa",
		'Fenix' => "Fenix",
		'Finger+Paint' => "Finger Paint",
		'Fjalla+One' => "Fjalla One",
		'Fjord+One' => "Fjord One",
		'Flamenco' => "Flamenco",
		'Flavors' => "Flavors",
		'Fondamento' => "Fondamento",
		'Fontdiner+Swanky' => "Fontdiner Swanky",
		'Forum' => "Forum",
		'Francois+One' => "Francois One",
		'Freckle+Face' => "Freckle Face",
		'Fredericka+the+Great' => "Fredericka the Great",
		'Fredoka+One' => "Fredoka One",
		'Freehand' => "Freehand",
		'Fresca' => "Fresca",
		'Frijole' => "Frijole",
		'Fruktur' => "Fruktur",
		'Fugaz+One' => "Fugaz One",
		'GFS+Didot' => "GFS Didot",
		'GFS+Neohellenic' => "GFS Neohellenic",
		'Gabriela' => "Gabriela",
		'Gafata' => "Gafata",
		'Galdeano' => "Galdeano",
		'Galindo' => "Galindo",
		'Gentium+Basic' => "Gentium Basic",
		'Gentium+Book+Basic' => "Gentium Book Basic",
		'Geo' => "Geo",
		'Geostar' => "Geostar",
		'Geostar+Fill' => "Geostar Fill",
		'Germania+One' => "Germania One",
		'Gilda+Display' => "Gilda Display",
		'Give+You+Glory' => "Give You Glory",
		'Glass+Antiqua' => "Glass Antiqua",
		'Glegoo' => "Glegoo",
		'Gloria+Hallelujah' => "Gloria Hallelujah",
		'Goblin+One' => "Goblin One",
		'Gochi+Hand' => "Gochi Hand",
		'Gorditas' => "Gorditas",
		'Goudy+Bookletter+1911' => "Goudy Bookletter 1911",
		'Graduate' => "Graduate",
		'Grand+Hotel' => "Grand Hotel",
		'Gravitas+One' => "Gravitas One",
		'Great+Vibes' => "Great Vibes",
		'Griffy' => "Griffy",
		'Gruppo' => "Gruppo",
		'Gudea' => "Gudea",
		'Habibi' => "Habibi",
		'Hammersmith+One' => "Hammersmith One",
		'Hanalei' => "Hanalei",
		'Hanalei+Fill' => "Hanalei Fill",
		'Handlee' => "Handlee",
		'Hanuman' => "Hanuman",
		'Happy+Monkey' => "Happy Monkey",
		'Headland+One' => "Headland One",
		'Henny+Penny' => "Henny Penny",
		'Herr+Von+Muellerhoff' => "Herr Von Muellerhoff",
		'Holtwood+One+SC' => "Holtwood One SC",
		'Homemade+Apple' => "Homemade Apple",
		'Homenaje' => "Homenaje",
		'IM+Fell+DW+Pica' => "IM Fell DW Pica",
		'IM+Fell+DW+Pica+SC' => "IM Fell DW Pica SC",
		'IM+Fell+Double+Pica' => "IM Fell Double Pica",
		'IM+Fell+Double+Pica+SC' => "IM Fell Double Pica SC",
		'IM+Fell+English' => "IM Fell English",
		'IM+Fell+English+SC' => "IM Fell English SC",
		'IM+Fell+French+Canon' => "IM Fell French Canon",
		'IM+Fell+French+Canon+SC' => "IM Fell French Canon SC",
		'IM+Fell+Great+Primer' => "IM Fell Great Primer",
		'IM+Fell+Great+Primer+SC' => "IM Fell Great Primer SC",
		'Iceberg' => "Iceberg",
		'Iceland' => "Iceland",
		'Imprima' => "Imprima",
		'Inconsolata' => "Inconsolata",
		'Inder' => "Inder",
		'Indie+Flower' => "Indie Flower",
		'Inika' => "Inika",
		'Irish+Grover' => "Irish Grover",
		'Istok+Web' => "Istok Web",
		'Italiana' => "Italiana",
		'Italianno' => "Italianno",
		'Jacques+Francois' => "Jacques Francois",
		'Jacques+Francois+Shadow' => "Jacques Francois Shadow",
		'Jim+Nightshade' => "Jim Nightshade",
		'Jockey+One' => "Jockey One",
		'Jolly+Lodger' => "Jolly Lodger",
		'Josefin+Sans' => "Josefin Sans",
		'Josefin+Slab' => "Josefin Slab",
		'Joti+One' => "Joti One",
		'Judson' => "Judson",
		'Julee' => "Julee",
		'Julius+Sans+One' => "Julius Sans One",
		'Junge' => "Junge",
		'Jura' => "Jura",
		'Just+Another+Hand' => "Just Another Hand",
		'Just+Me+Again+Down+Here' => "Just Me Again Down Here",
		'Kameron' => "Kameron",
		'Karla' => "Karla",
		'Kaushan+Script' => "Kaushan Script",
		'Kavoon' => "Kavoon",
		'Keania+One' => "Keania One",
		'Kelly+Slab' => "Kelly Slab",
		'Kenia' => "Kenia",
		'Khmer' => "Khmer",
		'Kite+One' => "Kite One",
		'Knewave' => "Knewave",
		'Kotta+One' => "Kotta One",
		'Koulen' => "Koulen",
		'Kranky' => "Kranky",
		'Kreon' => "Kreon",
		'Kristi' => "Kristi",
		'Krona+One' => "Krona One",
		'La+Belle+Aurore' => "La Belle Aurore",
		'Lancelot' => "Lancelot",
		'Lato' => "Lato",
		'League+Script' => "League Script",
		'Leckerli+One' => "Leckerli One",
		'Ledger' => "Ledger",
		'Lekton' => "Lekton",
		'Lemon' => "Lemon",
		'Libre+Baskerville' => "Libre Baskerville",
		'Life+Savers' => "Life Savers",
		'Lilita+One' => "Lilita One",
		'Limelight' => "Limelight",
		'Linden+Hill' => "Linden Hill",
		'Lobster' => "Lobster",
		'Lobster+Two' => "Lobster Two",
		'Londrina+Outline' => "Londrina Outline",
		'Londrina+Shadow' => "Londrina Shadow",
		'Londrina+Sketch' => "Londrina Sketch",
		'Londrina+Solid' => "Londrina Solid",
		'Lora' => "Lora",
		'Love+Ya+Like+A+Sister' => "Love Ya Like A Sister",
		'Loved+by+the+King' => "Loved by the King",
		'Lovers+Quarrel' => "Lovers Quarrel",
		'Luckiest+Guy' => "Luckiest Guy",
		'Lusitana' => "Lusitana",
		'Lustria' => "Lustria",
		'Macondo' => "Macondo",
		'Macondo+Swash+Caps' => "Macondo Swash Caps",
		'Magra' => "Magra",
		'Maiden+Orange' => "Maiden Orange",
		'Mako' => "Mako",
		'Marcellus' => "Marcellus",
		'Marcellus+SC' => "Marcellus SC",
		'Marck+Script' => "Marck Script",
		'Margarine' => "Margarine",
		'Marko+One' => "Marko One",
		'Marmelad' => "Marmelad",
		'Marvel' => "Marvel",
		'Mate' => "Mate",
		'Mate+SC' => "Mate SC",
		'Maven+Pro' => "Maven Pro",
		'McLaren' => "McLaren",
		'Meddon' => "Meddon",
		'MedievalSharp' => "MedievalSharp",
		'Medula+One' => "Medula One",
		'Megrim' => "Megrim",
		'Meie+Script' => "Meie Script",
		'Merienda' => "Merienda",
		'Merienda+One' => "Merienda One",
		'Merriweather' => "Merriweather",
		'Merriweather+Sans' => "Merriweather Sans",
		'Metal' => "Metal",
		'Metal+Mania' => "Metal Mania",
		'Metamorphous' => "Metamorphous",
		'Metrophobic' => "Metrophobic",
		'Michroma' => "Michroma",
		'Milonga' => "Milonga",
		'Miltonian' => "Miltonian",
		'Miltonian+Tattoo' => "Miltonian Tattoo",
		'Miniver' => "Miniver",
		'Miss+Fajardose' => "Miss Fajardose",
		'Modern+Antiqua' => "Modern Antiqua",
		'Molengo' => "Molengo",
		'Molle' => "Molle",
		'Monda' => "Monda",
		'Monofett' => "Monofett",
		'Monoton' => "Monoton",
		'Monsieur+La+Doulaise' => "Monsieur La Doulaise",
		'Montaga' => "Montaga",
		'Montez' => "Montez",
		'Montserrat' => "Montserrat",
		'Montserrat+Alternates' => "Montserrat Alternates",
		'Montserrat+Subrayada' => "Montserrat Subrayada",
		'Moul' => "Moul",
		'Moulpali' => "Moulpali",
		'Mountains+of+Christmas' => "Mountains of Christmas",
		'Mouse+Memoirs' => "Mouse Memoirs",
		'Mr+Bedfort' => "Mr Bedfort",
		'Mr+Dafoe' => "Mr Dafoe",
		'Mr+De+Haviland' => "Mr De Haviland",
		'Mrs+Saint+Delafield' => "Mrs Saint Delafield",
		'Mrs+Sheppards' => "Mrs Sheppards",
		'Muli' => "Muli",
		'Mystery+Quest' => "Mystery Quest",
		'Neucha' => "Neucha",
		'Neuton' => "Neuton",
		'New+Rocker' => "New Rocker",
		'News+Cycle' => "News Cycle",
		'Niconne' => "Niconne",
		'Nixie+One' => "Nixie One",
		'Nobile' => "Nobile",
		'Nokora' => "Nokora",
		'Norican' => "Norican",
		'Nosifer' => "Nosifer",
		'Nothing+You+Could+Do' => "Nothing You Could Do",
		'Noticia+Text' => "Noticia Text",
		'Noto+Sans' => "Noto Sans",
		'Noto+Serif' => "Noto Serif",
		'Nova+Cut' => "Nova Cut",
		'Nova+Flat' => "Nova Flat",
		'Nova+Mono' => "Nova Mono",
		'Nova+Oval' => "Nova Oval",
		'Nova+Round' => "Nova Round",
		'Nova+Script' => "Nova Script",
		'Nova+Slim' => "Nova Slim",
		'Nova+Square' => "Nova Square",
		'Numans' => "Numans",
		'Nunito' => "Nunito",
		'Odor+Mean+Chey' => "Odor Mean Chey",
		'Offside' => "Offside",
		'Old+Standard+TT' => "Old Standard TT",
		'Oldenburg' => "Oldenburg",
		'Oleo+Script' => "Oleo Script",
		'Oleo+Script+Swash+Caps' => "Oleo Script Swash Caps",
		'Open+Sans' => "Open Sans",
		'Open+Sans+Condensed' => "Open Sans Condensed",
		'Oranienbaum' => "Oranienbaum",
		'Orbitron' => "Orbitron",
		'Oregano' => "Oregano",
		'Orienta' => "Orienta",
		'Original+Surfer' => "Original Surfer",
		'Oswald' => "Oswald",
		'Over+the+Rainbow' => "Over the Rainbow",
		'Overlock' => "Overlock",
		'Overlock+SC' => "Overlock SC",
		'Ovo' => "Ovo",
		'Oxygen' => "Oxygen",
		'Oxygen+Mono' => "Oxygen Mono",
		'PT+Mono' => "PT Mono",
		'PT+Sans' => "PT Sans",
		'PT+Sans+Caption' => "PT Sans Caption",
		'PT+Sans+Narrow' => "PT Sans Narrow",
		'PT+Serif' => "PT Serif",
		'PT+Serif+Caption' => "PT Serif Caption",
		'Pacifico' => "Pacifico",
		'Paprika' => "Paprika",
		'Parisienne' => "Parisienne",
		'Passero+One' => "Passero One",
		'Passion+One' => "Passion One",
		'Patrick+Hand' => "Patrick Hand",
		'Patrick+Hand+SC' => "Patrick Hand SC",
		'Patua+One' => "Patua One",
		'Paytone+One' => "Paytone One",
		'Peralta' => "Peralta",
		'Permanent+Marker' => "Permanent Marker",
		'Petit+Formal+Script' => "Petit Formal Script",
		'Petrona' => "Petrona",
		'Philosopher' => "Philosopher",
		'Piedra' => "Piedra",
		'Pinyon+Script' => "Pinyon Script",
		'Pirata+One' => "Pirata One",
		'Plaster' => "Plaster",
		'Play' => "Play",
		'Playball' => "Playball",
		'Playfair+Display' => "Playfair Display",
		'Playfair+Display+SC' => "Playfair Display SC",
		'Podkova' => "Podkova",
		'Poiret+One' => "Poiret One",
		'Poller+One' => "Poller One",
		'Poly' => "Poly",
		'Pompiere' => "Pompiere",
		'Pontano+Sans' => "Pontano Sans",
		'Port+Lligat+Sans' => "Port Lligat Sans",
		'Port+Lligat+Slab' => "Port Lligat Slab",
		'Prata' => "Prata",
		'Preahvihear' => "Preahvihear",
		'Press+Start+2P' => "Press Start 2P",
		'Princess+Sofia' => "Princess Sofia",
		'Prociono' => "Prociono",
		'Prosto+One' => "Prosto One",
		'Puritan' => "Puritan",
		'Purple+Purse' => "Purple Purse",
		'Quando' => "Quando",
		'Quantico' => "Quantico",
		'Quattrocento' => "Quattrocento",
		'Quattrocento+Sans' => "Quattrocento Sans",
		'Questrial' => "Questrial",
		'Quicksand' => "Quicksand",
		'Quintessential' => "Quintessential",
		'Qwigley' => "Qwigley",
		'Racing+Sans+One' => "Racing Sans One",
		'Radley' => "Radley",
		'Raleway' => "Raleway",
		'Raleway+Dots' => "Raleway Dots",
		'Rambla' => "Rambla",
		'Rammetto+One' => "Rammetto One",
		'Ranchers' => "Ranchers",
		'Rancho' => "Rancho",
		'Rationale' => "Rationale",
		'Redressed' => "Redressed",
		'Reenie+Beanie' => "Reenie Beanie",
		'Revalia' => "Revalia",
		'Ribeye' => "Ribeye",
		'Ribeye+Marrow' => "Ribeye Marrow",
		'Righteous' => "Righteous",
		'Risque' => "Risque",
		'Roboto' => "Roboto",
		'Roboto+Condensed' => "Roboto Condensed",
		'Rochester' => "Rochester",
		'Rock+Salt' => "Rock Salt",
		'Rokkitt' => "Rokkitt",
		'Romanesco' => "Romanesco",
		'Ropa+Sans' => "Ropa Sans",
		'Rosario' => "Rosario",
		'Rosarivo' => "Rosarivo",
		'Rouge+Script' => "Rouge Script",
		'Ruda' => "Ruda",
		'Rufina' => "Rufina",
		'Ruge+Boogie' => "Ruge Boogie",
		'Ruluko' => "Ruluko",
		'Rum+Raisin' => "Rum Raisin",
		'Ruslan+Display' => "Ruslan Display",
		'Russo+One' => "Russo One",
		'Ruthie' => "Ruthie",
		'Rye' => "Rye",
		'Sacramento' => "Sacramento",
		'Sail' => "Sail",
		'Salsa' => "Salsa",
		'Sanchez' => "Sanchez",
		'Sancreek' => "Sancreek",
		'Sansita+One' => "Sansita One",
		'Sarina' => "Sarina",
		'Satisfy' => "Satisfy",
		'Scada' => "Scada",
		'Schoolbell' => "Schoolbell",
		'Seaweed+Script' => "Seaweed Script",
		'Sevillana' => "Sevillana",
		'Seymour+One' => "Seymour One",
		'Shadows+Into+Light' => "Shadows Into Light",
		'Shadows+Into+Light+Two' => "Shadows Into Light Two",
		'Shanti' => "Shanti",
		'Share' => "Share",
		'Share+Tech' => "Share Tech",
		'Share+Tech+Mono' => "Share Tech Mono",
		'Shojumaru' => "Shojumaru",
		'Short+Stack' => "Short Stack",
		'Siemreap' => "Siemreap",
		'Sigmar+One' => "Sigmar One",
		'Signika' => "Signika",
		'Signika+Negative' => "Signika Negative",
		'Simonetta' => "Simonetta",
		'Sintony' => "Sintony",
		'Sirin+Stencil' => "Sirin Stencil",
		'Six+Caps' => "Six Caps",
		'Skranji' => "Skranji",
		'Slackey' => "Slackey",
		'Smokum' => "Smokum",
		'Smythe' => "Smythe",
		'Sniglet' => "Sniglet",
		'Snippet' => "Snippet",
		'Snowburst+One' => "Snowburst One",
		'Sofadi+One' => "Sofadi One",
		'Sofia' => "Sofia",
		'Sonsie+One' => "Sonsie One",
		'Sorts+Mill+Goudy' => "Sorts Mill Goudy",
		'Source+Code+Pro' => "Source Code Pro",
		'Source+Sans+Pro' => "Source Sans Pro",
		'Special+Elite' => "Special Elite",
		'Spicy+Rice' => "Spicy Rice",
		'Spinnaker' => "Spinnaker",
		'Spirax' => "Spirax",
		'Squada+One' => "Squada One",
		'Stalemate' => "Stalemate",
		'Stalinist+One' => "Stalinist One",
		'Stardos+Stencil' => "Stardos Stencil",
		'Stint+Ultra+Condensed' => "Stint Ultra Condensed",
		'Stint+Ultra+Expanded' => "Stint Ultra Expanded",
		'Stoke' => "Stoke",
		'Strait' => "Strait",
		'Sue+Ellen+Francisco' => "Sue Ellen Francisco",
		'Sunshiney' => "Sunshiney",
		'Supermercado+One' => "Supermercado One",
		'Suwannaphum' => "Suwannaphum",
		'Swanky+and+Moo+Moo' => "Swanky and Moo Moo",
		'Syncopate' => "Syncopate",
		'Tangerine' => "Tangerine",
		'Taprom' => "Taprom",
		'Tauri' => "Tauri",
		'Telex' => "Telex",
		'Tenor+Sans' => "Tenor Sans",
		'Text+Me+One' => "Text Me One",
		'The+Girl+Next+Door' => "The Girl Next Door",
		'Tienne' => "Tienne",
		'Tinos' => "Tinos",
		'Titan+One' => "Titan One",
		'Titillium+Web' => "Titillium Web",
		'Trade+Winds' => "Trade Winds",
		'Trocchi' => "Trocchi",
		'Trochut' => "Trochut",
		'Trykker' => "Trykker",
		'Tulpen+One' => "Tulpen One",
		'Ubuntu' => "Ubuntu",
		'Ubuntu+Condensed' => "Ubuntu Condensed",
		'Ubuntu+Mono' => "Ubuntu Mono",
		'Ultra' => "Ultra",
		'Uncial+Antiqua' => "Uncial Antiqua",
		'Underdog' => "Underdog",
		'Unica+One' => "Unica One",
		'UnifrakturCook' => "UnifrakturCook",
		'UnifrakturMaguntia' => "UnifrakturMaguntia",
		'Unkempt' => "Unkempt",
		'Unlock' => "Unlock",
		'Unna' => "Unna",
		'VT323' => "VT323",
		'Vampiro+One' => "Vampiro One",
		'Varela' => "Varela",
		'Varela+Round' => "Varela Round",
		'Vast+Shadow' => "Vast Shadow",
		'Vibur' => "Vibur",
		'Vidaloka' => "Vidaloka",
		'Viga' => "Viga",
		'Voces' => "Voces",
		'Volkhov' => "Volkhov",
		'Vollkorn' => "Vollkorn",
		'Voltaire' => "Voltaire",
		'Waiting+for+the+Sunrise' => "Waiting for the Sunrise",
		'Wallpoet' => "Wallpoet",
		'Walter+Turncoat' => "Walter Turncoat",
		'Warnes' => "Warnes",
		'Wellfleet' => "Wellfleet",
		'Wendy+One' => "Wendy One",
		'Wire+One' => "Wire One",
		'Yanone+Kaffeesatz' => "Yanone Kaffeesatz",
		'Yellowtail' => "Yellowtail",
		'Yeseva+One' => "Yeseva One",
		'Yesteryear' => "Yesteryear",
		'Zeyada' => "Zeyada",
		);

	$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false

$args['dev_mode'] = false;

//google api key MUST BE DEFINED IF YOU WANT TO USE GOOGLE WEBFONTS
//$args['google_api_key'] = '***';

//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
//$args['intro_text'] = __('<p>Don\'t forget to save the settings!</p>', 'nhp-opts');

//Setup custom links in the footer for share icons
$args['share_icons']['themeforest'] = array(
										'link' => 'http://themeforest.net/user/LosBastardos',
										'title' => 'LosBastardos on ThemeForest',
										'img' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_316_tree_conifer.png'
										);
//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'lb_opc';

$args['google_api_key'] = 'AIzaSyB0_zr4gsc6PkFl5UiHDj6ROiXtuYb7QBk';

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Theme Options', 'nhp-opts');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Theme Options', 'nhp-opts');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'lb_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = null;

$args['footer_credit'] = '';

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';

//Want to disable the sections showing as a submenu in the admin? uncomment this line
//$args['allow_sub_menu'] = false;
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-1',
							'title' => __('Theme Information 1', 'nhp-opts'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-2',
							'title' => __('Theme Information 2', 'nhp-opts'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
							);

//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'nhp-opts');



$sections = array();

$sections[] = array(
				'title' => __('General', 'nhp-opts'),
				'desc' => __('<p class="description"></p>', 'nhp-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_280_settings.png',
				'fields' => array(
					array(
						'id' => 'favicon',
						'type' => 'upload',
						'title' => 'Favicon',
						'sub_desc' => ''
						),
//slide start
					array(
						'id' => 'slider_interval',
						'type' => 'text',
						'title' => 'Slider - length between transitions',
						'sub_desc' => '',
						'std' => '3000'
						),
//slide end
//top start
					array(
						'id' => 'logo_header',
						'type' => 'upload',
						'title' => 'Header Image',
						'sub_desc' => ''
						),
//top end
					array(
						'id' => 'topheader_smallertext',
						'type' => 'textarea',
						'title' => 'Header Smaller Text',
						'sub_desc' => '',
						'std' => ''
						),

//footer start
					array(
						'id' => 'logo_footer',
						'type' => 'upload',
						'title' => 'Footer Image',
						'sub_desc' => ''
						),
					array(
						'id' => 'footer_copytext',
						'type' => 'text',
						'title' => 'Copyright Text',
						'sub_desc' => '',
						'std' => '2013 - Bismuth'
						),
//footer end
					array(
						'id' => 'custom_css',
						'type' => 'textarea',
						'title' => 'Custom CSS',
						'sub_desc' => 'Include here any custom CSS.'
						),
					)
				);


//social start
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_043_group.png',
				'title' => __('Social', 'nhp-opts'),
				'desc' => __('<p class="description">Be social'),
				'fields' => array(
					array(
						'id' => 'facebook_url',
						'type' => 'text',
						'title' => 'Facebook URL',
						'sub_desc' => ''
						),
					array(
						'id' => 'twitter_username',
						'type' => 'text',
						'title' => 'Twitter Username',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'gplus_url',
						'type' => 'text',
						'title' => 'Google+ URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'dribble_url',
						'type' => 'text',
						'title' => 'Dribble URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'linkedin_url',
						'type' => 'text',
						'title' => 'Linkedin URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'flickr_url',
						'type' => 'text',
						'title' => 'Flickr URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'soundcloud_url',
						'type' => 'text',
						'title' => 'SoundCloud URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'skype_url',
						'type' => 'text',
						'title' => 'Skype URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'pinterest_url',
						'type' => 'text',
						'title' => 'Pinterest URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'vimeo_url',
						'type' => 'text',
						'title' => 'Vimeo URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'youtube_url',
						'type' => 'text',
						'title' => 'Youtube URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'instagram_url',
						'type' => 'text',
						'title' => 'Instagram URL',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'behance_url',
						'type' => 'text',
						'title' => 'Behance URL',
						'sub_desc' => '',
						'std' => ''
						),
					)
				);
//social end
//blog start
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_235_pen.png',
				'title' => __('Blog', 'nhp-opts'),
				'desc' => __('', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'blog_fullwidth',
						'type' => 'checkbox',
						'title' => 'Check for add the blog sidebar',
						'sub_desc' => '',
						'std' => ''// 1 = on | 0 = off
						),									
					)
				);
//blog end
//contact start
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_077_headset.png',
				'title' => __('Contact', 'nhp-opts'),
				'desc' => __('', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'contactseven',
						'type' => 'text',
						'title' => 'Contact Form 7 Shotcode',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'email',
						'type' => 'text',
						'title' => 'Contact e-mail',
						'sub_desc' => '',
						'std' => get_bloginfo('admin_email')
						),
					array(
						'id' => 'phone',
						'type' => 'text',
						'title' => 'Phone',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'location',
						'type' => 'text',
						'title' => 'Location',
						'sub_desc' => '',
						'std' => ''
						),
					array(
						'id' => 'contact_description',
						'type' => 'textarea',
						'title' => 'Contact Page Description',
						'sub_desc' => '',
						'std' => ''
						),										
					)
				);
//contact end
				
	$tabs = array();
			
	if (function_exists('wp_get_theme')){
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data->get('ThemeURI');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');
	}else{
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data['ThemeURI'];
		$description = $theme_data['Description'];
		$author = $theme_data['Author'];
		$version = $theme_data['Version'];
		$tags = $theme_data['Tags'];
	}	

	$theme_info = '<div class="nhp-opts-section-desc">';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'nhp-opts').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'nhp-opts').$author.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'nhp-opts').$version.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-description">'.$description.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'nhp-opts').implode(', ', $tags).'</p>';
	$theme_info .= '</div>';



	$tabs['theme_info'] = array(
					'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_195_circle_info.png',
					'title' => __('Theme Information', 'nhp-opts'),
					'content' => $theme_info
					);
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'nhp-opts'),
						'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory()).'README.html'))
						);
	}//if

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>