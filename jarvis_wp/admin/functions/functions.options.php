<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		$font_weight 		= array("normal","bold","bolder","lighter","300","600","700","800");		

    global $google_fonts;
	$google_fonts = array(
							"0" => "Select Font",
							"ABeeZee" => "ABeeZee",
							"Abel" => "Abel",
							"Abril Fatface" => "Abril Fatface",
							"Aclonica" => "Aclonica",
							"Acme" => "Acme",
							"Actor" => "Actor",
							"Adamina" => "Adamina",
							"Advent Pro" => "Advent Pro",
							"Aguafina Script" => "Aguafina Script",
							"Akronim" => "Akronim",
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
							"Almendra Display" => "Almendra Display",
							"Almendra SC" => "Almendra SC",
							"Amarante" => "Amarante",
							"Amaranth" => "Amaranth",
							"Amatic SC" => "Amatic SC",
							"Amethysta" => "Amethysta",
							"Anaheim" => "Anaheim",
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
							"Arbutus Slab" => "Arbutus Slab",
							"Architects Daughter" => "Architects Daughter",
							"Archivo Black" => "Archivo Black",
							"Archivo Narrow" => "Archivo Narrow",
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
							"Autour One" => "Autour One",
							"Average" => "Average",
							"Average Sans" => "Average Sans",
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
							"BenchNine" => "BenchNine",
							"Bentham" => "Bentham",
							"Berkshire Swash" => "Berkshire Swash",
							"Bevan" => "Bevan",
							"Bigelow Rules" => "Bigelow Rules",
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
							"Carrois Gothic" => "Carrois Gothic",
							"Carrois Gothic SC" => "Carrois Gothic SC",
							"Carter One" => "Carter One",
							"Caudex" => "Caudex",
							"Cedarville Cursive" => "Cedarville Cursive",
							"Ceviche One" => "Ceviche One",
							"Changa One" => "Changa One",
							"Chango" => "Chango",
							"Chau Philomene One" => "Chau Philomene One",
							"Chela One" => "Chela One",
							"Chelsea Market" => "Chelsea Market",
							"Chenla" => "Chenla",
							"Cherry Cream Soda" => "Cherry Cream Soda",
							"Cherry Swash" => "Cherry Swash",
							"Chewy" => "Chewy",
							"Chicle" => "Chicle",
							"Chivo" => "Chivo",
							"Cinzel" => "Cinzel",
							"Cinzel Decorative" => "Cinzel Decorative",
							"Clicker Script" => "Clicker Script",
							"Coda" => "Coda",
							"Coda Caption" => "Coda Caption",
							"Codystar" => "Codystar",
							"Combo" => "Combo",
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
							"Croissant One" => "Croissant One",
							"Crushed" => "Crushed",
							"Cuprum" => "Cuprum",
							"Cutive" => "Cutive",
							"Cutive Mono" => "Cutive Mono",
							"Damion" => "Damion",
							"Dancing Script" => "Dancing Script",
							"Dangrek" => "Dangrek",
							"Dawning of a New Day" => "Dawning of a New Day",
							"Days One" => "Days One",
							"Delius" => "Delius",
							"Delius Swash Caps" => "Delius Swash Caps",
							"Delius Unicase" => "Delius Unicase",
							"Della Respira" => "Della Respira",
							"Denk One" => "Denk One",
							"Devonshire" => "Devonshire",
							"Didact Gothic" => "Didact Gothic",
							"Diplomata" => "Diplomata",
							"Diplomata SC" => "Diplomata SC",
							"Domine" => "Domine",
							"Donegal One" => "Donegal One",
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
							"Elsie" => "Elsie",
							"Elsie Swash Caps" => "Elsie Swash Caps",
							"Emblema One" => "Emblema One",
							"Emilys Candy" => "Emilys Candy",
							"Engagement" => "Engagement",
							"Englebert" => "Englebert",
							"Enriqueta" => "Enriqueta",
							"Erica One" => "Erica One",
							"Esteban" => "Esteban",
							"Euphoria Script" => "Euphoria Script",
							"Ewert" => "Ewert",
							"Exo" => "Exo",
							"Expletus Sans" => "Expletus Sans",
							"Fanwood Text" => "Fanwood Text",
							"Fascinate" => "Fascinate",
							"Fascinate Inline" => "Fascinate Inline",
							"Faster One" => "Faster One",
							"Fasthand" => "Fasthand",
							"Federant" => "Federant",
							"Federo" => "Federo",
							"Felipa" => "Felipa",
							"Fenix" => "Fenix",
							"Finger Paint" => "Finger Paint",
							"Fjalla One" => "Fjalla One",
							"Fjord One" => "Fjord One",
							"Flamenco" => "Flamenco",
							"Flavors" => "Flavors",
							"Fondamento" => "Fondamento",
							"Fontdiner Swanky" => "Fontdiner Swanky",
							"Forum" => "Forum",
							"Francois One" => "Francois One",
							"Freckle Face" => "Freckle Face",
							"Fredericka the Great" => "Fredericka the Great",
							"Fredoka One" => "Fredoka One",
							"Freehand" => "Freehand",
							"Fresca" => "Fresca",
							"Frijole" => "Frijole",
							"Fruktur" => "Fruktur",
							"Fugaz One" => "Fugaz One",
							"GFS Didot" => "GFS Didot",
							"GFS Neohellenic" => "GFS Neohellenic",
							"Gabriela" => "Gabriela",
							"Gafata" => "Gafata",
							"Galdeano" => "Galdeano",
							"Galindo" => "Galindo",
							"Gentium Basic" => "Gentium Basic",
							"Gentium Book Basic" => "Gentium Book Basic",
							"Geo" => "Geo",
							"Geostar" => "Geostar",
							"Geostar Fill" => "Geostar Fill",
							"Germania One" => "Germania One",
							"Gilda Display" => "Gilda Display",
							"Give You Glory" => "Give You Glory",
							"Glass Antiqua" => "Glass Antiqua",
							"Glegoo" => "Glegoo",
							"Gloria Hallelujah" => "Gloria Hallelujah",
							"Goblin One" => "Goblin One",
							"Gochi Hand" => "Gochi Hand",
							"Gorditas" => "Gorditas",
							"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
							"Graduate" => "Graduate",
							"Grand Hotel" => "Grand Hotel",
							"Gravitas One" => "Gravitas One",
							"Great Vibes" => "Great Vibes",
							"Griffy" => "Griffy",
							"Gruppo" => "Gruppo",
							"Gudea" => "Gudea",
							"Habibi" => "Habibi",
							"Hammersmith One" => "Hammersmith One",
							"Hanalei" => "Hanalei",
							"Hanalei Fill" => "Hanalei Fill",
							"Handlee" => "Handlee",
							"Hanuman" => "Hanuman",
							"Happy Monkey" => "Happy Monkey",
							"Headland One" => "Headland One",
							"Henny Penny" => "Henny Penny",
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
							"Joti One" => "Joti One",
							"Judson" => "Judson",
							"Julee" => "Julee",
							"Julius Sans One" => "Julius Sans One",
							"Junge" => "Junge",
							"Jura" => "Jura",
							"Just Another Hand" => "Just Another Hand",
							"Just Me Again Down Here" => "Just Me Again Down Here",
							"Kameron" => "Kameron",
							"Karla" => "Karla",
							"Kaushan Script" => "Kaushan Script",
							"Kavoon" => "Kavoon",
							"Keania One" => "Keania One",
							"Kelly Slab" => "Kelly Slab",
							"Kenia" => "Kenia",
							"Khmer" => "Khmer",
							"Kite One" => "Kite One",
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
							"Libre Baskerville" => "Libre Baskerville",
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
							"Macondo" => "Macondo",
							"Macondo Swash Caps" => "Macondo Swash Caps",
							"Magra" => "Magra",
							"Maiden Orange" => "Maiden Orange",
							"Mako" => "Mako",
							"Marcellus" => "Marcellus",
							"Marcellus SC" => "Marcellus SC",
							"Marck Script" => "Marck Script",
							"Margarine" => "Margarine",
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
							"Merienda" => "Merienda",
							"Merienda One" => "Merienda One",
							"Merriweather" => "Merriweather",
							"Merriweather Sans" => "Merriweather Sans",
							"Metal" => "Metal",
							"Metal Mania" => "Metal Mania",
							"Metamorphous" => "Metamorphous",
							"Metrophobic" => "Metrophobic",
							"Michroma" => "Michroma",
							"Milonga" => "Milonga",
							"Miltonian" => "Miltonian",
							"Miltonian Tattoo" => "Miltonian Tattoo",
							"Miniver" => "Miniver",
							"Miss Fajardose" => "Miss Fajardose",
							"Modern Antiqua" => "Modern Antiqua",
							"Molengo" => "Molengo",
							"Molle" => "Molle",
							"Monda" => "Monda",
							"Monofett" => "Monofett",
							"Monoton" => "Monoton",
							"Monsieur La Doulaise" => "Monsieur La Doulaise",
							"Montaga" => "Montaga",
							"Montez" => "Montez",
							"Montserrat" => "Montserrat",
							"Montserrat Alternates" => "Montserrat Alternates",
							"Montserrat Subrayada" => "Montserrat Subrayada",
							"Moul" => "Moul",
							"Moulpali" => "Moulpali",
							"Mountains of Christmas" => "Mountains of Christmas",
							"Mouse Memoirs" => "Mouse Memoirs",
							"Mr Bedfort" => "Mr Bedfort",
							"Mr Dafoe" => "Mr Dafoe",
							"Mr De Haviland" => "Mr De Haviland",
							"Mrs Saint Delafield" => "Mrs Saint Delafield",
							"Mrs Sheppards" => "Mrs Sheppards",
							"Muli" => "Muli",
							"Mystery Quest" => "Mystery Quest",
							"Neucha" => "Neucha",
							"Neuton" => "Neuton",
							"New Rocker" => "New Rocker",
							"News Cycle" => "News Cycle",
							"Niconne" => "Niconne",
							"Nixie One" => "Nixie One",
							"Nobile" => "Nobile",
							"Nokora" => "Nokora",
							"Norican" => "Norican",
							"Nosifer" => "Nosifer",
							"Nothing You Could Do" => "Nothing You Could Do",
							"Noticia Text" => "Noticia Text",
							"Noto Sans" => "Noto Sans",
							"Noto Serif" => "Noto Serif",
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
							"Odor Mean Chey" => "Odor Mean Chey",
							"Offside" => "Offside",
							"Old Standard TT" => "Old Standard TT",
							"Oldenburg" => "Oldenburg",
							"Oleo Script" => "Oleo Script",
							"Oleo Script Swash Caps" => "Oleo Script Swash Caps",
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
							"Paprika" => "Paprika",
							"Parisienne" => "Parisienne",
							"Passero One" => "Passero One",
							"Passion One" => "Passion One",
							"Patrick Hand" => "Patrick Hand",
							"Patrick Hand SC" => "Patrick Hand SC",
							"Patua One" => "Patua One",
							"Paytone One" => "Paytone One",
							"Peralta" => "Peralta",
							"Permanent Marker" => "Permanent Marker",
							"Petit Formal Script" => "Petit Formal Script",
							"Petrona" => "Petrona",
							"Philosopher" => "Philosopher",
							"Piedra" => "Piedra",
							"Pinyon Script" => "Pinyon Script",
							"Pirata One" => "Pirata One",
							"Plaster" => "Plaster",
							"Play" => "Play",
							"Playball" => "Playball",
							"Playfair Display" => "Playfair Display",
							"Playfair Display SC" => "Playfair Display SC",
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
							"Purple Purse" => "Purple Purse",
							"Quando" => "Quando",
							"Quantico" => "Quantico",
							"Quattrocento" => "Quattrocento",
							"Quattrocento Sans" => "Quattrocento Sans",
							"Questrial" => "Questrial",
							"Quicksand" => "Quicksand",
							"Quintessential" => "Quintessential",
							"Qwigley" => "Qwigley",
							"Racing Sans One" => "Racing Sans One",
							"Radley" => "Radley",
							"Raleway" => "Raleway",
							"Raleway Dots" => "Raleway Dots",
							"Rambla" => "Rambla",
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
							"Risque" => "Risque",
							"Roboto" => "Roboto",
							"Roboto Condensed" => "Roboto Condensed",
							"Roboto Slab" => "Roboto Slab",
							"Rochester" => "Rochester",
							"Rock Salt" => "Rock Salt",
							"Rokkitt" => "Rokkitt",
							"Romanesco" => "Romanesco",
							"Ropa Sans" => "Ropa Sans",
							"Rosario" => "Rosario",
							"Rosarivo" => "Rosarivo",
							"Rouge Script" => "Rouge Script",
							"Ruda" => "Ruda",
							"Rufina" => "Rufina",
							"Ruge Boogie" => "Ruge Boogie",
							"Ruluko" => "Ruluko",
							"Rum Raisin" => "Rum Raisin",
							"Ruslan Display" => "Ruslan Display",
							"Russo One" => "Russo One",
							"Ruthie" => "Ruthie",
							"Rye" => "Rye",
							"Sacramento" => "Sacramento",
							"Sail" => "Sail",
							"Salsa" => "Salsa",
							"Sanchez" => "Sanchez",
							"Sancreek" => "Sancreek",
							"Sansita One" => "Sansita One",
							"Sarina" => "Sarina",
							"Satisfy" => "Satisfy",
							"Scada" => "Scada",
							"Schoolbell" => "Schoolbell",
							"Seaweed Script" => "Seaweed Script",
							"Sevillana" => "Sevillana",
							"Seymour One" => "Seymour One",
							"Shadows Into Light" => "Shadows Into Light",
							"Shadows Into Light Two" => "Shadows Into Light Two",
							"Shanti" => "Shanti",
							"Share" => "Share",
							"Share Tech" => "Share Tech",
							"Share Tech Mono" => "Share Tech Mono",
							"Shojumaru" => "Shojumaru",
							"Short Stack" => "Short Stack",
							"Siemreap" => "Siemreap",
							"Sigmar One" => "Sigmar One",
							"Signika" => "Signika",
							"Signika Negative" => "Signika Negative",
							"Simonetta" => "Simonetta",
							"Sintony" => "Sintony",
							"Sirin Stencil" => "Sirin Stencil",
							"Six Caps" => "Six Caps",
							"Skranji" => "Skranji",
							"Slackey" => "Slackey",
							"Smokum" => "Smokum",
							"Smythe" => "Smythe",
							"Sniglet" => "Sniglet",
							"Snippet" => "Snippet",
							"Snowburst One" => "Snowburst One",
							"Sofadi One" => "Sofadi One",
							"Sofia" => "Sofia",
							"Sonsie One" => "Sonsie One",
							"Sorts Mill Goudy" => "Sorts Mill Goudy",
							"Source Code Pro" => "Source Code Pro",
							"Source Sans Pro" => "Source Sans Pro",
							"Special Elite" => "Special Elite",
							"Spicy Rice" => "Spicy Rice",
							"Spinnaker" => "Spinnaker",
							"Spirax" => "Spirax",
							"Squada One" => "Squada One",
							"Stalemate" => "Stalemate",
							"Stalinist One" => "Stalinist One",
							"Stardos Stencil" => "Stardos Stencil",
							"Stint Ultra Condensed" => "Stint Ultra Condensed",
							"Stint Ultra Expanded" => "Stint Ultra Expanded",
							"Stoke" => "Stoke",
							"Strait" => "Strait",
							"Sue Ellen Francisco" => "Sue Ellen Francisco",
							"Sunshiney" => "Sunshiney",
							"Supermercado One" => "Supermercado One",
							"Suwannaphum" => "Suwannaphum",
							"Swanky and Moo Moo" => "Swanky and Moo Moo",
							"Syncopate" => "Syncopate",
							"Tangerine" => "Tangerine",
							"Taprom" => "Taprom",
							"Tauri" => "Tauri",
							"Telex" => "Telex",
							"Tenor Sans" => "Tenor Sans",
							"Text Me One" => "Text Me One",
							"The Girl Next Door" => "The Girl Next Door",
							"Tienne" => "Tienne",
							"Tinos" => "Tinos",
							"Titan One" => "Titan One",
							"Titillium Web" => "Titillium Web",
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
							"Underdog" => "Underdog",
							"Unica One" => "Unica One",
							"UnifrakturCook" => "UnifrakturCook",
							"UnifrakturMaguntia" => "UnifrakturMaguntia",
							"Unkempt" => "Unkempt",
							"Unlock" => "Unlock",
							"Unna" => "Unna",
							"VT323" => "VT323",
							"Vampiro One" => "Vampiro One",
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
							"Wendy One" => "Wendy One",
							"Wire One" => "Wire One",
							"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
							"Yellowtail" => "Yellowtail",
							"Yeseva One" => "Yeseva One",
							"Yesteryear" => "Yesteryear",
							"Zeyada" => "Zeyada"
						);		
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( "name" 		=> "Accent Color",
					"desc" 		=> "Pick an Accent color for overall site display.",
					"id" 		=> "rnr_accent_color",
					"std" 		=> "#ffd600",
					"type" 		=> "color"
				);

$of_options[] = array( "name" => "Enable Widescren layout",
					"desc" => "Check to enable Widescreen layout for the theme",
					"id" => "rnr_enable_widescreen",
					"std" => 0,
					"type" => "checkbox"); 				
					
$of_options[] = array( "name" => "Enable Dark Skin",
					"desc" => "Check to enable Dark skin for the theme",
					"id" => "rnr_enable_dark_skin",
					"std" => 0,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable RTL Layout",
					"desc" => "Check to enable RTL layour for the theme",
					"id" => "rnr_enable_rtl_layout",
					"std" => 0,
					"type" => "checkbox"); 	
					
$of_options[] = array( "name" => "Disable Animations for the theme",
					"desc" => "Check to disable element css animations in the theme.",
					"id" => "rnr_disable_animation",
					"std" => 0,
					"type" => "checkbox");  
					
$of_options[] = array( "name" => "Disable Animations for only mobile devices",
					"desc" => "Check to disable element css animations in the theme for onlymobile devices.",
					"id" => "rnr_disable_mob_animation",
					"std" => 0,
					"type" => "checkbox"); 					
					
$of_options[] = array( "name" => "Disable Smooth Scrolling for the theme",
					"desc" => "Check to disable smooth scrolling in the theme.",
					"id" => "rnr_disable_smoothscroll",
					"std" => 0,
					"type" => "checkbox"); 		
					
					
$of_options[] = array( "name" => "Disable Pre loader",
					"desc" => "Check to disable preloader.",
					"id" => "rnr_disable_preloader",
					"std" => 0,
					"type" => "checkbox"); 				
										

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Favicon Options",
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => "Upload Favicon",
					"desc" => "Upload images using the native media uploader, or define the URL directly",
					"id" => "rnr_favicon_url",
					"std" => "",
					"type" => "media");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Logo Options",
					"icon" => false,
					"type" => "info"); 
					
$of_options[] = array( "name" => "Logo Upload",
					"desc" => "Upload your Logo",
					"id" => "rnr_logo_url",
					"std" => "",
					"type" => "media");
					
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Parallax Overlay Options",
					"icon" => false,
					"type" => "info");					
					
$of_options[] = array( "name" => "Disable Overlay Grid for parallax sections",
					"desc" => "This will disable the overlay grid",
					"id" => "rnr_disable_overlay",
					"std" => 0,
					"type" => "checkbox"); 	
					
$of_options[] = array( "name" => "Upload Own Parallax Overlay pattern",
					"desc" => "Upload images using the native media uploader, or define the URL directly",
					"id" => "rnr_parallax_overlay_url",
					"std" => "",
					"type" => "media");	
					
$of_options[] = array( "name" => "Use Colored background overlay",
					"desc" => "This will overwrite the default parallax pattenr with colored overlay",
					"id" => "rnr_enable_color_pattern",
					"std" => 0,
					"type" => "checkbox");					


$of_options[] = array( "name" 		=> "Parallax Overlay Background Color",
					"desc" 		=> "Pick color for parallax overlay background.",
					"id" 		=> "rnr_parallax_overlay_bgcolor",
					"std" 		=> "#ffd600",
					"type" 		=> "color"
				);					
					
$of_options[] = array( "name" => "Parallax Overlay opacity for background color",
					"desc" => "Select between 0 and 100 to set your opacity value",
					"id" => "rnr_parallax_overlay_opacity",
					"std" 		=> "100",
					"min" 		=> "0",
					"step"		=> "10",
					"max" 		=> "100",
					"type" => "sliderui");										

					


$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Custom Editing",
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => "Custom CSS",
					"desc" => "Paste your Custom CSS Code here.",
					"id" => "rnr_custom_css",
					"std" => "",
					"type" => "textarea"); 
					
$of_options[] = array( "name" => "Custom Javascript/Analytics",
					"desc" => "Paste your Google Analytics Code (or other script) here.",
					"id" => "rnr_custom_js",
					"std" => "",
					"type" => "textarea");
					
					
					

$of_options[] = array( 	"name" 		=> "Home Settings",
						"type" 		=> "heading"
				); 
				
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "home_heading",
					"std" => "Home Screen Logo options",
					"icon" => false,
					"type" => "info");
	
				
$of_options[] = array( "name" => "Show Home Logo",
					"desc" => "Enable this to show logo on your home section.",
					"id" => "rnr_enable_home_logo",
					"std" => "",
					"type" => "checkbox");	

$of_options[] = array( "name" => "Home Logo Text type",
					"desc" => "Select between light and dark versions of logo text.",
					"id" => "rnr_home_logo_text_type",
					"std" => "dark",
					"type" => "select",
					"options" => array('light','dark'));	
					
$of_options[] = array( "name" => "Home Logo Text",
					"desc" => "Type your line if you want home logo to be text.",
					"id" => "rnr_home_logo_text",
					"std" => "We are Jarvis",
					"type" => "text");									

$of_options[] = array( "name" => "Home Logo Upload",
					"desc" => "Upload your Logo for home section. Uploading image will replace home logo text.",
					"id" => "rnr_home_logo_url",
					"std" => "",
					"type" => "media");	
					
					
$of_options[] = array( "name" => "Disable Scroll Down for Home Section",
					"desc" => "Check to disable scroll down button for home section.",
					"id" => "rnr_disable_home_scrolldown",
					"std" => 0,
					"type" => "checkbox"); 	
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "home_screen_heading",
					"std" => "Home Section Settings",
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" 	=> "Home Layout Type",
					"desc" 		=> "Select your home secton layout type. <strong>Regular<strong> should be cused for revolution slider",
					"id" 		=> "rnr_home_look_type",
					"type" 		=> "select",
					"options" 	=> array("Full Screen", "Regular", "Regular with padding"));	

						
$of_options[] = array( "name" 		=> "Home Section Content Type",
					"desc" 		=> "Select your Home version type.",
					"id" 		=> "rnr_home_type",
					"type" 		=> "select",
					"options" 	=> array("Full Width Content","Boxed Content","Revolution Slider","FullScreen Slider","Video"));	

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "home_video_option",
					"std" => "Home Video Options",
					"icon" => false,
					"type" => "info");	
					
										
$of_options[] = array( "name" 		=> "Home Video Type",
					"desc" 		=> "Select between youtube and vimeo video options",
					"id" 		=> "rnr_home_video_type",
					"type" 		=> "select",
					"options" 	=> array("select one","youtube","vimeo"));					


					
									
$of_options[] = array( "name" => "",
					"desc" => "Enter Youtube/Vimeo Video URL link",
					"id" => "rnr_home_video_id",
					"std" => "",
					"type" => "text");
						
$of_options[] = array( "name" => "Enable video looping",
					"desc" => "This will Enable video looping",
					"id" => "rnr_enable_video_loop",
					"std" => "",
					"type" => "checkbox");		
					
$of_options[] = array( "name" => "Mute Video",
					"desc" => "This will mute video",
					"id" => "rnr_video_mute",
					"std" => "1",
					"type" => "checkbox");										
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "home_slider_heading",
					"std" => "Home FullScreen Slider Options",
					"icon" => false,
					"type" => "info");						

$of_options[] = array( "name" => "Use Fullscreen Slider as only background Slider",
					"desc" => "Enabling this will keep fullscreen slider as background slider and you can add content in edit page.",
					"id" => "rnr_fullscreenslider_as_background",
					"std" => "0",
					"type" => "checkbox");	
					
$of_options[] = array( "name" 		=> "Fullscreen background slider content type",
					"desc" 		=> "Select between full width content and boxed content for fullscreen background slider",
					"id" 		=> "rnr_fullscreenslider_content_type",
					"type" 		=> "select",
					"options" 	=> array("select one","full width","boxed"));						
					
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Unlimited slider with drag and drop sortings.",
						"id" 		=> "rnr_home_slider",
						"std" 		=> "",
						"type" 		=> "slider"
				);														


/* ------------------------------------------------------------------------ */
/* MENU SECTION
/* ------------------------------------------------------------------------ */	

$of_options[] = array( 	"name" 		=> "Menu Settings",
						"type" 		=> "heading"
				);				
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Menu Styling",
					"icon" => false,
					"type" => "info"); 					
					
$of_options[] = array( "name" 		=> "Menu Type",
					"desc" 		=> "Select your menu style type.",
					"id" 		=> "rnr_menu_type",
					"std" => "colored",					
					"type" 		=> "select",
					"options" 	=> array("light","dark","colored","transparent"));	
					
					
$of_options[] = array( "name" 		=> "Menu Position",
					"desc" 		=> "Select your menu position.",
					"id" 		=> "rnr_menu_style",
					"std" => "default",					
					"type" 		=> "select",
					"options" 	=> array("top","bottom","default"));	
					
					
$of_options[] = array( "name" 		=> "Transparent Menu Default Color",
					"desc" 		=> "Pick a default color for the Transparent Navigation Menu.",
					"id" 		=> "rnr_menu_transdefault_color",
					"std" 		=> "#ffffff",
					"type" 		=> "color"
				);										
					
	
				
$of_options[] = array( 	"name" 		=> "Menu Styling",
						"desc" 		=> "Specify the menu font properties",
						"id" 		=> "rnr_menu",
						"std" 		=> array('size' => '14px','face' => 'Oswald','style' => 'normal','color' => '#ffffff'),
						"type" 		=> "typography"
				); 	
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_menu_font_weight",
					"std" 		=> "normal",
					"type" 		=> "select",
					"options" 	=> $font_weight );
   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your text transorm for overall text.",
					"id" 		=> "rnr_menu_text_transform",
					"std" 		=> "uppercase",
					"type" 		=> "select",
					"options" 	=> array("none","uppercase"));				
				
$of_options[] = array( "name" 		=> "Navigation Link Hover Color",
					"desc" 		=> "Pick a Link hover color for the Navigation Menu.",
					"id" 		=> "rnr_menu_link_hover_color",
					"std" 		=> "#242424",
					"type" 		=> "color"
				);


/* ------------------------------------------------------------------------ */
/* PORTFOLIO SECTION
/* ------------------------------------------------------------------------ */

$of_options[] = array( 	"name" 		=> "Portfolio Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( "name" => "Custom Portfolio Slug",
					"desc" => "Enter the number of portfolio posts you want to display per page",
					"id" => "rnr_portfolio_slug",
					"std" => "portfolio-item",
					"type" => "text"); 
			
$of_options[] = array( "name" => "No. of Portfolio Posts by default",
					"desc" => "Enter the number of portfolio posts you want to display per page",
					"id" => "rnr_portfolio_number",
					"std" => "10",
					"type" => "text"); 							
				
$of_options[] = array( "name" => "Show Portfolio Filtering",
					"desc" => "Enabling this will show portfolio filtering in portfolio section",
					"id" => "rnr_enable_portfolio_filter",
					"std" => "1",
					"type" => "checkbox");		
					
$of_options[] = array( "name" => "Disable Portfolio Ajax Functionality",
					"desc" => "Disabling this will remove ajax functionality and redirect to Separate Project page",
					"id" => "rnr_disable_portfolio_ajax",
					"std" => "",
					"type" => "checkbox");									
				
$of_options[] = array( "name" 		=> "Select Portfolio Single Display Type",
					"desc" 		=> "Select how you want to display the portfolio single page",
					"id" 		=> "rnr_portfolio_single_type",
					"type" 		=> "select",
					"std" 		=> "Full Width",
					"options" 	=> array("Side By Side","Full Width"));	
					
$of_options[] = array( "name" => "Project Description Title",
					"desc" => "Leave blank if you don't want to display Description title",
					"id" => "rnr_portfolio_description_title",
					"std" => __('Project Description','rocknrolla'),
					"type" => "text");
					
$of_options[] = array( "name" => "Project Details Title",
					"desc" => "Leave blank if you don't want to display Description title",
					"id" => "rnr_portfolio_details_title",
					"std" => __('Project Details','rocknrolla'),
					"type" => "text");						
					

/* ------------------------------------------------------------------------ */
/* CONTACT SECTION
/* ------------------------------------------------------------------------ */

$of_options[] = array( 	"name" 		=> "Contact Settings",
						"type" 		=> "heading"
				);			
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Google Map Settings",
					"icon" => false,
					"type" => "info"); 	
					
$of_options[] = array( "name" => "Enable Google Maps",
					"desc" => "Check to enable Google Map",
					"id" => "rnr_enable_googlemap",
					"std" => 0,
					"type" => "checkbox"); 		
				
$of_options[] = array( "name" => "Address",
					"desc" => "Enter your Address.",
					"id" => "rnr_contact_address",
					"std" => "Envato , Level 13, 2 Elizabeth ST, Melbourne, Victoria 3000, Australia.",
					"type" => "text");									
					
$of_options[] = array( "name" => "Latitude Position",
					"desc" => "Find your latitude position at <a href='http://itouchmap.com/latlong.html' target='_blank'>http://itouchmap.com/latlong.html </a>",
					"id" => "rnr_map_lat",
					"std" => "-37.811367",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Longitude Position",
					"desc" => "Find your longitude position at <a href='http://itouchmap.com/latlong.html' target='_blank'>http://itouchmap.com/latlong.html </a>",
					"id" => "rnr_map_lon",
					"std" => "144.971829",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Upload Logo for map",
					"desc" => "Upload images using the native media uploader, or define the URL directly",
					"id" => "rnr_map_logo",
					"std" => "https://pbs.twimg.com/profile_images/655904741617086464/nwevoHSQ_400x400.png",
					"type" => "media");
					
$of_options[] = array( "name" => "Map Zoom Value",
					"desc" => "Give Map Zoom value.",
					"id" => "rnr_map_zoom",
					"std" => "18",
					"type" => "text"); 
	
																				


/* ------------------------------------------------------------------------ */
/* FOOTER SECTION
/* ------------------------------------------------------------------------ */	

$of_options[] = array( 	"name" 		=> "Footer Settings",
						"type" 		=> "heading"
				);			
				
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Footer Styling",
					"icon" => false,
					"type" => "info"); 					
					
$of_options[] = array( "name" => "Logo Upload",
					"desc" => "Upload your Logo",
					"id" => "rnr_footer_logo_url",
					"std" => "http://demo.rocknrolladesigns.com/wordpress/jarvis/wp-content/uploads/2014/03/logo2-e1395949158894.png",
					"type" => "media");
					
$of_options[] = array( "name" => "Footer Copyright Text",
					"desc" => "Write a line for your copyright Info.",
					"id" => "rnr_footer_caption",
					"std" => "Designed with love By RocknRolla",
					"type" => "textarea");					
					
$of_options[] = array( "name" 		=> "Footer Background Color",
					"desc" 		=> "Pick a background color for Footer.",
					"id" 		=> "rnr_footer_background",
					"std" 		=> "#ffd600",
					"type" 		=> "color"
				);		
				
$of_options[] = array( 	"name" 		=> "Footer Styling",
						"desc" 		=> "Specify the footer font properties",
						"id" 		=> "rnr_footer",
						"std" 		=> array('size' => '14px','face' => 'Open Sans','style' => 'normal','color' => '#ffffff'),
						"type" 		=> "typography"
				); 	
				
$of_options[] = array( "name" 		=> "Footer Link Color",
					"desc" 		=> "Pick a Link hover color for the Footer.",
					"id" 		=> "rnr_footer_link_color",
					"std" 		=> "#ffffff",
					"type" 		=> "color"
				);	
$of_options[] = array( "name" 		=> "Footer Link Hover Color",
					"desc" 		=> "Pick a Link hover color for the Footer.",
					"id" 		=> "rnr_footer_link_hover_color",
					"std" 		=> "#000000",
					"type" 		=> "color"
				);
				
				
				
		
/* ------------------------------------------------------------------------ */
/* BLOG SETTINGS
/* ------------------------------------------------------------------------ */																								


$of_options[] = array( 	"name" 		=> "Blog Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Blog Styling",
					"icon" => false,
					"type" => "info"); 



$of_options[] = array( "name" => "Enable Share-Box on Post Detail",
					"desc" => "Check to enable Share-Box",
					"id" => "rnr_blog_socialshare",
					"std" => 1,
					"type" => "checkbox"); 

$of_options[] = array( "name" => "Enable Author Info on Post Detail",
					"desc" => "Check to enable Author Info",
					"id" => "rnr_blog_authorinfo",
					"std" => 1,
					"type" => "checkbox"); 
	

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Social Sharing Box Icons",
					"icon" => false,
					"type" => "info"); 
					
$of_options[] = array( "name" => "Enable Facebook in Social Sharing Box",
					"desc" => "Check to enable Facebook in Social Sharing Box",
					"id" => "rnr_share_facebook",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable Twitter in Social Sharing Box",
					"desc" => "Check to enable Twitter in Social Sharing Box",
					"id" => "rnr_share_twitter",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable LinkedIn in Social Sharing Box",
					"desc" => "Check to enable LinkedIn in Social Sharing Box",
					"id" => "rnr_share_linkedin",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable Reddit in Social Sharing Box",
					"desc" => "Check to enable Reddit in Social Sharing Box",
					"id" => "rnr_share_reddit",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable Digg in Social Sharing Box",
					"desc" => "Check to enable Digg in Social Sharing Box",
					"id" => "rnr_share_digg",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => "Enable Delicious in Social Sharing Box",
					"desc" => "Check to enable Delicious in Social Sharing Box",
					"id" => "rnr_share_delicious",
					"std" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => "Enable Google in Social Sharing Box",
					"desc" => "Check to enable Google in Social Sharing Box",
					"id" => "rnr_share_google",
					"std" => 1,
					"type" => "checkbox"); 

$of_options[] = array( "name" => "Enable E-Mail in Social Sharing Box",
					"desc" => "Check to enable Google in E-Mail Sharing Box",
					"id" => "rnr_share_email",
					"std" => 1,
					"type" => "checkbox"); 
					


/* ------------------------------------------------------------------------ */
/* Twitter Section
/* ------------------------------------------------------------------------ */

$of_options[] = array( "name" 		=> "Twitter Settings",
					"type" 		=> "heading");				
				
$of_options[] = array( "name" => "Twitter Username", 
					"desc" => "Enter your Twitter Username",
					"id" => "rnr_twitter_username",
					"std" => "",
					"type" => "text");				

$of_options[] = array( "name" => "Twitter Consumer Key", 
					"desc" => "Enter your Twitter Consumer Key",
					"id" => "rnr_twitter_consumer_key",
					"std" => "",
					"type" => "text");		
					
$of_options[] = array( "name" => "Twitter Consumer Secret", 
					"desc" => "Enter your Twitter Consumer Secret",
					"id" => "rnr_twitter_cosumer_secret",
					"std" => "",
					"type" => "text");	
					
$of_options[] = array( "name" => "Twitter Access Token", 
					"desc" => "Enter your Twitter Access Token",
					"id" => "rnr_twitter_access_token",
					"std" => "",
					"type" => "text");	
					
$of_options[] = array( "name" => "Twitter Access Token Secret", 
					"desc" => "Enter your Twitter Access Token Secret",
					"id" => "rnr_twitter_access_token_secret",
					"std" => "",
					"type" => "text");			
					
					
/* ------------------------------------------------------------------------ */
/* WooCommerce Section
/* ------------------------------------------------------------------------ */

$of_options[] = array( "name" 		=> "Woocommerce Settings",
					"type" 		=> "heading");	 		
					
$of_options[] = array( "name" => "Number of posts per page", 
					"desc" => "Enter ynumber of porducts per page",
					"id" => "rnr_wc_products_perpage",
					"std" => "12",
					"type" => "text");				
				
$of_options[] = array( "name" => "Enable Shop/Category sidebar.",
					"desc" => "Enabling this will activate a sidebar for woocommerce shop page or category page. Add widgets in widgets section.",
					"id" => "rnr_enable_wc_sidebar",
					"std" => 0,
					"type" => "checkbox"); 					
				
$of_options[] = array( "name" => "Enable Product single sidebar.",
					"desc" => "Enabling this will activate a sidebar for woocommerce product page. Add widgets in widgets section.",
					"id" => "rnr_enable_wc_single_sidebar",
					"std" => 0,
					"type" => "checkbox");																								

/* ------------------------------------------------------------------------ */
/* Typography
/* ------------------------------------------------------------------------ */
				
				
$of_options[] = array( "name" => "Typography",
					"type" => "heading");


$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Body",
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => "Body Text Font",
					"desc" => "Specify the Body font properties",
					"id" => "rnr_body_text",
					"std" => array('size' => '13px','face' => 'Open Sans','style' => 'normal','color' => '#000000'),
					"type" => "typography");
					
$of_options[] = array( "name" 		=> "Body Font Weight",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_body_font_weight",
					"type" 		=> "select",
					"options" 	=> $font_weight );						
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Headings",
					"icon" => false,
					"type" => "info");
				
$of_options[] = array( "name" => "H1 Heading Font",
					"desc" => "Specify the H1 Heading font properties",
					"id" => "rnr_heading_h1",
					"std" => array('size' => '80px','face' => '','style' => 'normal','color' => '#000000'),
					"type" => "typography");    
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_heading_h1_font_weight",
					"type" 		=> "select",
					"options" 	=> $font_weight );
   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your text transorm for overall text.",
					"id" 		=> "rnr_heading_h1_text_transform",
					"type" 		=> "select",
					"options" 	=> array("none","uppercase"));
					
					
					
									

$of_options[] = array( "name" => "H2 Heading Font",
					"desc" => "Specify the H2 Heading font properties",
					"id" => "rnr_heading_h2",
					"std" => array('size' => '36px','face' => '','style' => 'normal','color' => '#000000'),
					"type" => "typography");    
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_heading_h2_font_weight",
					"type" 		=> "select",
					"options" 	=> $font_weight );
   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your text transorm for overall text.",
					"id" 		=> "rnr_heading_h2_text_transform",
					"type" 		=> "select",
					"options" 	=> array("none","uppercase"));
					
					
					
					
					
					
					
$of_options[] = array( "name" => "H3 Heading Font",
					"desc" => "Specify the H3 Heading font properties",
					"id" => "rnr_heading_h3",
					"std" => array('size' => '20px','face' => '','style' => 'normal','color' => '#000000'),
					"type" => "typography");    
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_heading_h3_font_weight",
					"type" 		=> "select",
					"options" 	=> $font_weight );
   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your text transorm for overall text.",
					"id" 		=> "rnr_heading_h3_text_transform",
					"type" 		=> "select",
					"options" 	=> array("none","uppercase"));
					
					
					
					
					
					

$of_options[] = array( "name" => "H4 Heading Font",
					"desc" => "Specify the H4 Heading font properties",
					"id" => "rnr_heading_h4",
					"std" => array('size' => '18px','face' => '','style' => 'normal','color' => '#000000'),
					"type" => "typography");    
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_heading_h4_font_weight",
					"type" 		=> "select",
					"options" 	=> $font_weight );
   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your text transorm for overall text.",
					"id" 		=> "rnr_heading_h4_text_transform",
					"type" 		=> "select",
					"options" 	=> array("none","uppercase"));
					
					
					
					
					
					
					
					
$of_options[] = array( "name" => "H5 Heading Font",
					"desc" => "Specify the H5 Heading font properties",
					"id" => "rnr_heading_h5",
					"std" => array('size' => '16px','face' => '','style' => 'normal','color' => '#000000'),
					"type" => "typography");    
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_heading_h5_font_weight",
					"type" 		=> "select",
					"options" 	=> $font_weight );
   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your text transorm for overall text.",
					"id" 		=> "rnr_heading_h5_text_transform",
					"type" 		=> "select",
					"options" 	=> array("none","uppercase"));	
					
					
					
					
					

$of_options[] = array( "name" => "H6 Heading Font",
					"desc" => "Specify the H6 Heading font properties",
					"id" => "rnr_heading_h6",
					"std" => array('size' => '14px','face' => '','style' => 'normal','color' => '#000000'),
					"type" => "typography");   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_heading_h6_font_weight",
					"type" 		=> "select",
					"options" 	=> $font_weight );
   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your text transorm for overall text.",
					"id" 		=> "rnr_heading_h6_text_transform",
					"type" 		=> "select",
					"options" 	=> array("none","uppercase"));		


$of_options[] = array( "name" => "Hello there!",
					"desc" => "",
					"id" => "subtitle",
					"std" => "Section Subtitle Typography",
					"icon" => true,
					"type" => "info");
					
					
$of_options[] = array( "name" => "Keep a Classic Section Title",
					"desc" => "Check to enable the basic/classic SEction title without any background colors & borders.",
					"id" => "rnr_enable_classic_title",
					"std" => 0,
					"type" => "checkbox"); 						


					

$of_options[] = array( "name" => "Section Subtitle Font",
					"desc" => "Specify the Subtitle  font properties",
					"id" => "rnr_heading_subtitle",
					"std" => array('size' => '25px','face' => '','style' => 'normal','color' => '#000000'),
					"type" => "typography");   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_heading_subtitle_font_weight",
					"std" 		=> "lighter",					
					"type" 		=> "select",
					"options" 	=> $font_weight );
   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your text transorm for overall text.",
					"id" 		=> "rnr_heading_subtitle_text_transform",
					"type" 		=> "select",
					"std" 		=> "uppercase",					
					"options" 	=> array("none","uppercase"));			
					

$of_options[] = array( "name" => "Hello there!",
					"desc" => "",
					"id" => "parallax",
					"std" => "Home/Parallax Section Typography",
					"icon" => true,
					"type" => "info");


$of_options[] = array( "name" => "Parallax & Home Section Headings Font",
					"desc" => "Specify the Parallax Headings properties",
					"id" => "rnr_parallax_headings_font",
					"std" => array('size' => '45px','face' => '','style' => 'normal','color' => '#ffffff'),
					"type" => "typography");   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your font weight for overall text.",
					"id" 		=> "rnr_parallax_headings_font_weight",
					"type" 		=> "select",
					"options" 	=> $font_weight );
   
					
$of_options[] = array( "name" 		=> "",
					"desc" 		=> "Select your text transorm for overall text.",
					"id" 		=> "rnr_parallax_headings_text_transform",
					"type" 		=> "select",
					"options" 	=> array("none","uppercase"));		
					

$of_options[] = array( "name" => "Parallax Section Text Font",
					"desc" => "Specify the Parallax Text properties",
					"id" => "rnr_parallax_text_font",
					"std" => array('size' => '16px','face' => '','style' => 'normal','color' => '#ffffff'),
					"type" => "typography"); 															
					


/* ------------------------------------------------------------------------ */
/* SOCIAL SECTION
/* ------------------------------------------------------------------------ */	

$of_options[] = array( 	"name" 		=> "Social Sharing",
						"type" 		=> "heading"
				);	

$of_options[] = array( "name" => "Hello there!",
					"desc" => "",
					"id" => "introduction",
					"std" => "Enter your username / URL to show or leave blank to hide Social Media Icons",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => "Email URL",
					"desc" => "Enter URL to your Email Account",
					"id" => "rnr_social_email",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Aim URL",
					"desc" => "Enter URL to your Aim Account",
					"id" => "rnr_social_aim",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Apple URL",
					"desc" => "Enter URL to your Apple Account",
					"id" => "rnr_social_apple",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Behance URL",
					"desc" => "Enter URL to your Behance Account",
					"id" => "rnr_social_behance",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Blogger URL",
					"desc" => "Enter URL to your Blogger Account",
					"id" => "rnr_social_blogger",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Delicious URL",
					"desc" => "Enter URL to your Delicious Account",
					"id" => "rnr_social_delicious",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Deviantart URL",
					"desc" => "Enter URL to your Deviantart Account",
					"id" => "rnr_social_deviantart",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Digg URL",
					"desc" => "Enter URL to your Digg Account",
					"id" => "rnr_social_digg",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Dribbble URL",
					"desc" => "Enter URL to your Dribbble Account",
					"id" => "rnr_social_dribbble",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Ember URL",
					"desc" => "Enter URL to your Ember Account",
					"id" => "rnr_social_ember",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Facebook URL",
					"desc" => "Enter URL to your Facebook Account",
					"id" => "rnr_social_facebook",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Flickr URL",
					"desc" => "Enter URL to your Flickr Account",
					"id" => "rnr_social_flickr",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Forrst URL",
					"desc" => "Enter URL to your Forrst Account",
					"id" => "rnr_social_forrst",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Google URL",
					"desc" => "Enter URL to your Google Account",
					"id" => "rnr_social_google",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Googleplus URL",
					"desc" => "Enter URL to your Googleplus Account",
					"id" => "rnr_social_googleplus",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Gowalla URL",
					"desc" => "Enter URL to your Gowalla Account",
					"id" => "rnr_social_gowalla",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Grooveshark URL",
					"desc" => "Enter URL to your Grooveshark Account",
					"id" => "rnr_social_grooveshark",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Html5 URL",
					"desc" => "Enter URL to your Html5 Account",
					"id" => "rnr_social_html5",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Lastfm URL",
					"desc" => "Enter URL to your Lastfm Account",
					"id" => "rnr_social_lastfm",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Linkedin URL",
					"desc" => "Enter URL to your Linkedin Account",
					"id" => "rnr_social_linkedin",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Metacafe URL",
					"desc" => "Enter URL to your Metacafe Account",
					"id" => "rnr_social_metacafe",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Mixx URL",
					"desc" => "Enter URL to your Mixx Account",
					"id" => "rnr_social_mixx",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Netvibes URL",
					"desc" => "Enter URL to your Netvibes Account",
					"id" => "rnr_social_netvibes",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Paypal URL",
					"desc" => "Enter URL to your Paypal Account",
					"id" => "rnr_social_paypal",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Picasa URL",
					"desc" => "Enter URL to your Picasa Account",
					"id" => "rnr_social_picasa",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Pinterest URL",
					"desc" => "Enter URL to your Pinterest Account",
					"id" => "rnr_social_pinterest",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Plurk URL",
					"desc" => "Enter URL to your Plurk Account",
					"id" => "rnr_social_plurk",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Reddit URL",
					"desc" => "Enter URL to your Reddit Account",
					"id" => "rnr_social_reddit",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Rss URL",
					"desc" => "Enter URL to your Rss Account",
					"id" => "rnr_social_rss",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Skype URL",
					"desc" => "Enter URL to your Skype Account",
					"id" => "rnr_social_skype",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Stumbleupon URL",
					"desc" => "Enter URL to your Stumbleupon Account",
					"id" => "rnr_social_stumbleupon",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Technorati URL",
					"desc" => "Enter URL to your Technorati Account",
					"id" => "rnr_social_technorati",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Tumblr URL",
					"desc" => "Enter URL to your Tumblr Account",
					"id" => "rnr_social_tumblr",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Twitter URL",
					"desc" => "Enter URL to your Twitter Account",
					"id" => "rnr_social_twitter",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Vimeo URL",
					"desc" => "Enter URL to your Vimeo Account",
					"id" => "rnr_social_vimeo",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Wordpress URL",
					"desc" => "Enter URL to your Wordpress Account",
					"id" => "rnr_social_wordpress",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Yahoo URL",
					"desc" => "Enter URL to your Yahoo Account",
					"id" => "rnr_social_yahoo",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Yelp URL",
					"desc" => "Enter URL to your Yelp Account",
					"id" => "rnr_social_yelp",
					"std" => "",
					"type" => "text"); 
$of_options[] = array( "name" => "Youtube URL",
					"desc" => "Enter URL to your Youtube Account",
					"id" => "rnr_social_youtube",
					"std" => "",
					"type" => "text");  
					
$of_options[] = array( "name" => "Xing URL",
					"desc" => "Enter URL to your Xing Account",
					"id" => "rnr_social_xing",
					"std" => "",
					"type" => "text"); 
 
$of_options[] = array( "name" => "Instagram URL",
					"desc" => "Enter URL to your Instagram Account",
					"id" => "rnr_social_instagram",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => "Angellist URL",
					"desc" => "Enter URL to your Angellist Account",
					"id" => "rnr_social_angellist",
					"std" => "",
					"type" => "text"); 					



/* ------------------------------------------------------------------------ */
/* BACKUP SECTION
/* ------------------------------------------------------------------------ */	

// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);

				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
