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
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
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
'Zeyada' => "Zeyada"
);


	$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = true;

//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!

//$args['stylesheet_override'] = true;


//Add HTML before the form

//$args['intro_text'] = __('<p>Don\'t forget to save the settings!</p>', 'nhp-opts');



//Setup custom links in the footer for share icons
$args['share_icons']['facebook'] = array(
										'link' => 'http://www.facebook.com/finaldestiny16',
										'title' => 'My facebook account', 
										'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_320_facebook.png'
										);

$args['share_icons']['themeforest'] = array(
										'link' => 'http://themeforest.net/user/FinalDestiny',
										'title' => 'My themeforest account',
										'img' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_050_link.png'
										);

$args['share_icons']['linkedin'] = array(
										'link' => 'http://www.linkedin.com/in/cristimacovei',
										'title' => 'My LinkedIn account',
										'img' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_337_linked_in.png'
										);

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'fffolio';



//$args['google_api_key'] = 'AIzaSyB0_zr4gsc6PkFl5UiHDj6ROiXtuYb7QBk';

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('fffolio Options', 'nhp-opts');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('fffolio Theme Options', 'nhp-opts');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'fffolio';

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
				'title' => __('General Settings', 'nhp-opts'),
				'desc' => __('<p class="description">Here you can configure the general aspects of the theme.!</p>', 'nhp-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_062_attach.png',
				'fields' => array(
					array(
						'id' => 'favicon',
						'type' => 'upload',
						'title' => 'Favicon',
						'sub_desc' => 'This is the little icon in the address bar for your website'
						),
					array(
						'id' => 'logo_letter',
						'type' => 'text',
						'title' => 'The logo letter in the menu',
						'sub_desc' => 'You can use the first letter of your brand/name for the logo, if you don\'t want to have an image',
						'std' => 'F'
						),
					array(
						'id' => 'logo',
						'type' => 'upload',
						'title' => 'Logo',
						'sub_desc' => 'You can use this option in order to replace the default letter and use a custom image'
						),
					array(
						'id' => 'color_scheme',
						'type' => 'button_set',
						'options' => array('1' => 'Orange', '2' => 'Blue'),
						'title' => 'Show a home link in the top menu?',
						'sub_desc' => '<strong>This will work only if you didn\'t set a menu in Appearance -> Menus.</strong>',
						'std' => 1
						),
					array(
						'id' => 'superadmin',
						'type' => 'text',
						'title' => 'Super admin username',
						'sub_desc' => '<strong>You can show the Theme options just for one admin user with this option! BE CAREFUL WITH THIS ONE!</strong>.',
						'std' => ''
						),
					array(
						'id' => 'email',
						'type' => 'text',
						'title' => 'Contact form e-mail',
						'sub_desc' => 'This is the e-mail where you\'ll receive all the messages from the contact page. Shows up near the contact form as well',
						'std' => get_bloginfo('admin_email')
						),
					array(
						'id' => 'wordpress_version',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => 'Show the wordpress version in your source code?',
						'std' => 1
						),
					array(
						'id' => 'blog_page',
						'type' => 'pages_multi_select',
						'title' => 'Page used for the blog page',
						'sub_desc' => 'This will be added in the menu if you don\'t setup the menu in Appearance > Menus',
						'args' => array(),
						'std' => ''
						),
					array(
						'id' => 'bg_image',
						'type' => 'upload',
						'title' => 'Background image',
						'sub_desc' => 'Use this only if you want a custom background image, different than the default one.'
						),
					array(
						'id' => 'bg2_image',
						'type' => 'upload',
						'title' => 'Background image on the separator and contact pages',
						'sub_desc' => 'Use this only if you want a custom background image, different than the default one.'
						),
					array(
						'id' => 'topslogan_text',
						'type' => 'text',
						'title' => 'Top slogan text',
						'sub_desc' => 'This is the top header text, like Hello.',
						'std' => 'Hello'
						),
					array(
						'id' => 'topprimary_text',
						'type' => 'text',
						'title' => 'Top Primary text',
						'sub_desc' => 'This is the top header text, below slogan, like "WELCOME, MY NAME IS" on the demo.',
						'std' => 'WELCOME, MY NAME IS'
						),
					array(
						'id' => 'top_secondarytext',
						'type' => 'text',
						'title' => 'Top secondary text',
						'sub_desc' => 'Shows up below the slogan and the primary text.',
						'std' => 'JOHN DOE'
						),
					array(
						'id' => 'top_thirdtext',
						'type' => 'text',
						'title' => 'Top third text',
						'sub_desc' => 'It shows up below the slogan and the primary / secondary text. Use it if applicable.',
						'std' => 'I\'M A WEB DESIGNER'
						),
					array(
						'id' => 'phone',
						'type' => 'text',
						'title' => 'Phone',
						'sub_desc' => 'The phone shows up near the contact form.',
						'std' => ''
						),
					array(
						'id' => 'address',
						'type' => 'textarea',
						'title' => 'Address',
						'sub_desc' => 'The location shows up near the contact form. HTML code accepted.',
						'std' => ''
						),
					array(
						'id' => 'google_map',
						'type' => 'textarea',
						'title' => 'Google map embed code',
						'sub_desc' => 'You should take the code from the official google maps website and paste it here.',
						'std' => ''
						),
					array(
						'id' => 'custom_css',
						'type' => 'textarea',
						'title' => 'Custom CSS',
						'sub_desc' => 'Include here any custom CSS you want, it will be kept when updating the theme'
						),
					array(
						'id' => 'contact_description',
						'type' => 'textarea',
						'title' => 'Header description on the contact page',
						'sub_desc' => 'Shows up under the Contact title on the homepage.',
						'std' => ''
						),
					array(
						'id' => 'contact_description',
						'type' => 'textarea',
						'title' => 'Header description on the contact page',
						'sub_desc' => 'Shows up under the Contact title on the homepage.',
						'std' => ''
						),
					)
				);

$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_150_check.png',
				'title' => __('Navigation', 'nhp-opts'),
				'desc' => __('<p class="description">This area controls the menu(if it\'s not setup in Appearance -> Menus and the Breadcrumbs section. </p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'pages_topmenu',
						'type' => 'pages_multi_select',
						'title' => __('Pages to include in the top menu', 'nhp-opts'), 
						'sub_desc' => __('Choose what pages you want in the top menu.', 'nhp-opts'),
						'args' => '',
						'std' => ''
						),
					array(
						'id' => 'menu_homelink',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => 'Show a home link in the top menu?',
						'sub_desc' => '<strong>This will work only if you didn\'t set a menu in Appearance -> Menus.</strong>',
						'std' => 1
						)											
					)
				);

$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_157_show_lines.png',
				'title' => __('Integration', 'nhp-opts'),
				'desc' => __('<p class="description">Use this to integrate google analytics code or to add any meta tag / html code you want.</p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'integration_footer',
						'type' => 'textarea',
						'title' => __('Code before the &lt;/body&gt; tag', 'nhp-opts'), 
						'sub_desc' => __('<strong>Use this one for google analytics for example.</strong>', 'nhp-opts'),
						'std' => ''
						),
					array(
						'id' => 'integration_header',
						'type' => 'textarea',
						'title' => __('The code will be added before the &lt;/head&gt; tag', 'nhp-opts'), 
						'sub_desc' => __('Use this one if you want to verify your site for google/bing/alexa/etc for example.', 'nhp-opts'),
						'std' => ''
						),
					)
				);

$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_107_text_resize.png',
				'title' => __('Colorization & Fonts', 'nhp-opts'),
				'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'nhp-opts'),
				'fields' => array(
					array(
						'id' => 'enable_colorization',
						'type' => 'button_set',
						'options' => array('1' => 'Yes', '0' => 'No'),
						'title' => 'Enable custom colorization & font changes?',
						'sub_desc' => '<strong>Please note that if you enable if, all the bottom settings will be used. For just some changes, use style.css.</strong>',
						'std' => 0
						),
					array(
						'id' => 'body_font',
						'title' => 'Font for the body text:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the body text',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'body_size',
						'type' => 'text',
						'title' => 'The default font size for the body text',
						'sub_desc' => 'This is the default font-size used on the body text(use just numbers, without px)',
						'std' => '14',
						'validate' => 'numeric'
						),
					array(
						'id' => 'body_color',
						'type' => 'color',
						'title' => 'Color for the body text',
						'sub_desc' => 'This is the color of the body text.',
						'std' => '#444444'
						),	
					array(
						'id' => 'top_slogantext_size',
						'type' => 'text',
						'title' => 'Font-size for the top slogan text',
						'sub_desc' => 'This is the font-size of the first big slogan text on the homepage. Use just numeric values without px',
						'std' => '60',
						'validate' => 'numeric'
						),		
					array(
						'id' => 'top_slogantext_color',
						'type' => 'color',
						'title' => 'Color for the top slogan text',
						'sub_desc' => 'This is the color of the first big slogan text on the homepage.',
						'std' => '#FFFFFF'
						),	
					array(
						'id' => 'top_slogantext_font',
						'title' => 'Font for the top slogan text:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the top slogan text',
						'std' => 'Marck+Script'
						),
					array(
						'id' => 'top_primarytext_size',
						'type' => 'text',
						'title' => 'Font-size for the small header text',
						'sub_desc' => 'Font-size for the small text under the big one, on the first page. Use just numeric values without px',
						'std' => '44',
						'validate' => 'numeric'
						),		
					array(
						'id' => 'top_primarytext_color',
						'type' => 'color',
						'title' => 'Color for the small header text',
						'sub_desc' => 'This is the color of the small text in the header, under the big heading.',
						'std' => '#FFFFFF',
						),	
					array(
						'id' => 'top_primarytext_font',
						'title' => 'Font for the small header text:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the small header text',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'top_secondarytext_size',
						'type' => 'text',
						'title' => 'Font-size for the smaller header text',
						'sub_desc' => 'Font-size for the smaller text under the small text above, on the first page. Use just numeric values without px',
						'std' => '100',
						'validate' => 'numeric'
						),		
					array(
						'id' => 'top_secondarytext_color',
						'type' => 'color',
						'title' => 'Color for the smaller header text',
						'sub_desc' => 'This is the color of the smaller text in the header, under the small text above.',
						'std' => '#FFFFFF',
						),
					array(
						'id' => 'top_secondarytext_font',
						'title' => 'Font for the small header text:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the small header text',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'nav_color',
						'type' => 'color',
						'title' => 'The color for the navigation menu',
						'sub_desc' => 'The color used on the navigation menu',
						'std' => '#FFFFFF'
						),
					array(
						'id' => 'nav_hovercolor',
						'type' => 'color',
						'title' => 'The hover color for the navigation menu',
						'sub_desc' => 'The hover color used on the navigation menu',
						'std' => '#E76343'
						),
					array(
						'id' => 'nav_size',
						'type' => 'text',
						'title' => 'The font-size for the navigation menu items',
						'sub_desc' => 'The font-size used on the navigation menu items',
						'std' => '16'
						),
					array(
						'id' => 'nav_font',
						'title' => 'Font for the navigation menu items:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the navigation menu items',
						'std' => 'Open+Sans'
						),	
					array(
						'id' => 'pagetitle_font',
						'title' => 'Font for the page titles:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on paragraphs',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'pagetitle_size',
						'type' => 'text',
						'title' => 'The default font size for the page titles',
						'sub_desc' => 'This is the default font-size used on the page titles(use just numbers, without px)',
						'std' => '54',
						'validate' => 'numeric'
						),	
					array(
						'id' => 'pagetitle_color',
						'title' => 'Color for the page titles:',
						'type' => 'color',
						'sub_desc' => 'The color used on the page titles',
						'std' => '#333333'
						),
					array(
						'id' => 'h3_size',
						'type' => 'text',
						'title' => 'The default font size for the h3 heading',
						'sub_desc' => 'This is the default font-size used on the h3 headings(use just numbers, without px)',
						'std' => '28',
						'validate' => 'numeric'
						),					
					array(
						'id' => 'h3_font',
						'title' => 'The default font for the h3 heading:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the h3 headings',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'h3_color',
						'type' => 'color',
						'title' => 'The default color for the h3 heading',
						'sub_desc' => 'This is the default color used on the h3 headings',
						'std' => '#333333',
						),	
					array(
						'id' => 'h4_size',
						'type' => 'text',
						'title' => 'The default font size for the h4 heading',
						'sub_desc' => 'This is the default font-size used on the h4 headings(use just numbers, without px)',
						'std' => '16',
						'validate' => 'numeric'
						),					
					array(
						'id' => 'h4_font',
						'title' => 'The default font for the h4 heading:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the h4 headings',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'h4_color',
						'type' => 'color',
						'title' => 'The default color for the h4 heading',
						'sub_desc' => 'This is the default color used on the h4 headings',
						'std' => '#E76343',
						),
					array(
						'id' => 'h5_size',
						'type' => 'text',
						'title' => 'The default font size for the h5 heading',
						'sub_desc' => 'This is the default font-size used on the h4 headings(use just numbers, without px)',
						'std' => '18',
						'validate' => 'numeric'
						),					
					array(
						'id' => 'h5_font',
						'title' => 'The default font for the h5 heading:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the h5 headings',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'h5_color',
						'type' => 'color',
						'title' => 'The default color for the h5 heading',
						'sub_desc' => 'This is the default color used on the h4 headings',
						'std' => '#333333',
						),
					array(
						'id' => 'footer_size',
						'type' => 'text',
						'title' => 'The default font size for the footer text',
						'sub_desc' => 'This is the default font-size used on the footer text(use just numbers, without px)',
						'std' => '12',
						'validate' => 'numeric'
						),					
					array(
						'id' => 'footer_font',
						'title' => 'The default font for the footer text:',
						'type' => 'select',
						'options' => $google_fonts,
						'sub_desc' => 'The google font to be used on the footer text',
						'std' => 'Open+Sans'
						),
					array(
						'id' => 'footer_color',
						'title' => 'The default color for the footer text:',
						'type' => 'color',
						'sub_desc' => 'The color of the footer text',
						'std' => '#FFFFFF'
						),
				)

			);				

				

	$tabs = array();

	$theme_data = wp_get_theme();
	$theme_uri = $theme_data->get('ThemeURI');
	$description = $theme_data->get('Description');
	$author = $theme_data->get('Author');
	$version = $theme_data->get('Version');
	$tags = $theme_data->get('Tags');	

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