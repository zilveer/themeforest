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
		            	natsort($bg_images); //Sorts the array into a natural order
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
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 
		$list_of_google_fonts = array(
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
					"Alef" => "Alef",
					"Alegreya" => "Alegreya",
					"Alegreya SC" => "Alegreya SC",
					"Alegreya Sans" => "Alegreya Sans",
					"Alegreya Sans SC" => "Alegreya Sans SC",
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
					"Exo 2" => "Exo 2",
					"Expletus Sans" => "Expletus Sans",
					"Fanwood Text" => "Fanwood Text",
					"Fascinate" => "Fascinate",
					"Fascinate Inline" => "Fascinate Inline",
					"Faster One" => "Faster One",
					"Fasthand" => "Fasthand",
					"Fauna One" => "Fauna One",
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
					"Kantumruy" => "Kantumruy",
					"Karla" => "Karla",
					"Kaushan Script" => "Kaushan Script",
					"Kavoon" => "Kavoon",
					"Kdam Thmor" => "Kdam Thmor",
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
					"Lily Script One" => "Lily Script One",
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
					"Pathway Gothic One" => "Pathway Gothic One",
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
					"Zeyada" => "Zeyada",
				);
		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/
		// Set the Options Array
		global $of_options;
		$of_options = array();
						
							
		//////// General Options//////////////
				$of_options[] = array( "name" => "General Options",
					"type" => "heading");
				
							
				$of_options[] = array( "name" => "Demo Contents",
					"desc" => "",
					"id" => "header_info",
					"std" => "<h3 style='margin: 0'>One-Click Demo Content Importer</h3>",
					"icon" => false,
					"type" => "info");
				
				$of_options[] = array( "name" => "Import Demo Content",
					"id" => "of_demo",
					"std" => admin_url('themes.php?page=optionsframework') . "&import_data_content=true",
					"type" => "button",
					"desc" => 'You can import iEvent Wordpress Theme demo by One-click demo importer. By Importing our demo you can start build your website easily exactly similar to the one exist on this link http://ievent.janxcode.com',
					);						
				
				$of_options[] = array( "name" => "Responsive",
						"desc" => "Set responsive option for mobile",
						"id" => "check_responsive",
						"std" => 1,
						"type" => "checkbox");
						
				$of_options[] = array( "name" => "Preloader",
						"desc" => "Set preloader",
						"id" => "check_preloader",
						"std" => 1,
						"type" => "checkbox");								
										
				$of_options[] = array( "name" => "Favicon Options",
					"desc" => "",
					"id" => "favicons",
					"std" => "<h3 style='margin: 0;'>Favicon Options</h3>",
					"icon" => false,
					"type" => "info");
				$of_options[] = array( "name" => "Favicon",
					"desc" => "Favicon for your website (16px x 16px).",
					"id" => "favicon",
					"std" => get_template_directory_uri()."/images/favicon.ico",
					"type" => "upload");
				$of_options[] = array( "name" => "Apple iPhone Icon Upload",
					"desc" => "Favicon for Apple iPhone (57px x 57px).",
					"id" => "iphone_icon",
					"std" => get_template_directory_uri()."/images/apple-touch-icon-57x57.png",
					"type" => "upload");
				$of_options[] = array( "name" => "Apple iPhone Retina Icon Upload",
					"desc" => "Favicon for Apple iPhone Retina Version (114px x 114px).",
					"id" => "iphone_icon_retina",
					"std" => get_template_directory_uri()."/images/apple-touch-icon-114x114.png",
					"type" => "upload");
				$of_options[] = array( "name" => "Apple iPad Icon Upload",
					"desc" => "Favicon for Apple iPad (72px x 72px).",
					"id" => "ipad_icon",
					"std" => get_template_directory_uri()."/images/apple-touch-icon-72x72.png",
					"type" => "upload");
				$of_options[] = array( "name" => "Apple iPad Retina Icon Upload",
					"desc" => "Favicon for Apple iPad Retina Version (144px x 144px).",
					"id" => "ipad_icon_retina",
					"std" => get_template_directory_uri()."/images/apple-touch-icon-144x144.png",
					"type" => "upload");
				$of_options[] = array( "name" => "Custom Code",
					"desc" => "",
					"id" => "code",
					"std" => "<h3 style='margin: 0;'>Add Tracking / Before Head / Before Body Code</h3>",
					"icon" => false,
					"type" => "info");
				$of_options[] = array( "name" => "Custom code before &lt;/head&gt;",
					"desc" => "Add code before the &lt;/head&gt; tag.",
					"id" => "head_code",
					"std" => "",
					"type" => "textarea");
				$of_options[] = array( "name" => "Custom code before &lt;/body&gt;",
					"desc" => "Add code before the &lt;/body&gt; tag.",
					"id" => "body_code",
					"std" => "",
					"type" => "textarea");
					
				$of_options[] = array( "name" =>  "Theme Color",
					"desc" => "Select your theme color.",
					"id" => "theme_color",
					"std" => "#EE163A",
					"type" => "color");
					
				$of_options[] = array( "name" =>  "Theme Base Color",
					"desc" => "Select your theme color.",
					"id" => "theme_base_color",
					"std" => "#333",
					"type" => "color");
					
		
		//////// Header Options//////////////
			
		
		$of_options[] = array( 	"name" 		=> "Event Details",
								"type" 		=> "heading"
						);
		$of_options[] = array( "name" => "Slider Info Bar",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Slider Info Bar</h3>",
							"icon" => false,
							"type" => "info");
		
		$of_options[] = array( "name" => "Event Slider info Bar",
						"desc" => "Set to show event info bar below slider",
						"id" => "check_event_infobar",
						"std" => 1,
						"type" => "checkbox");
								
		$of_options[] = array( "name" => "Show Vertical Date",
							"desc" => "Check to enable Date on the right side of the slider.",
							"id" => "checkbox_show_sliderdate",
							"std" => 1,
							"type" => "checkbox"); //Done Change
		
		
		
		$of_options[] = array( "name" => "Event Date",
							"desc" => "Event Date.",
							"id" => "info_event_date",
							"std" => "25-27 Jan 2015",
							"type" => "text"); //Done Change
							
		$of_options[] = array( "name" => "Event Location",
							"desc" => "Event Location",
							"id" => "info_event_location",
							"std" => "Barrio la Venera, 25",
							"type" => "text"); //Done Change	
		
		$of_options[] = array( "name" => "Event Tickets",
							"desc" => "Event Tickets",
							"id" => "info_event_tickets",
							"std" => "150 Tickets",
							"type" => "text"); //Done Change
							
		$of_options[] = array( "name" => "Event Speakers",
							"desc" => "Event Speakers",
							"id" => "info_event_speakers",
							"std" => "30 Speakers",
							"type" => "text"); //Done Change
						
		$of_options[] = array( "name" => "Venue Details",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Venue Details</h3>",
							"icon" => false,
							"type" => "info");		
									
		$of_options[] = array( "name" => "Venue Name",
							"desc" => "Event Location.",
							"id" => "venue_location",
							"std" => "Mariot Hotel",
							"type" => "text"); //Done Change
							
		$of_options[] = array( "name" => "Venue Address",
							"desc" => "Event Location.",
							"id" => "venue_address",
							"std" => "Barrio la Venera, 25",
							"type" => "text"); //Done Change
							
							
				
		$of_options[] = array( "name" => "Contact Info",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Contact Deatils</h3>",
							"icon" => false,
							"type" => "info");
		
		$of_options[] = array( "name" => "Contact Phone",
							"desc" => "Contact Phone Details",
							"id" => "venue_phone",
							"std" => "80081 80121",
							"type" => "text"); //Done Change
							
		$of_options[] = array( "name" => "Contact Email",
							"desc" => "Contact Email Details",
							"id" => "venue_email",
							"std" => "support@ievent.com",
							"type" => "text"); //Done Change
							
		
		$of_options[] = array( "name" => "Map Location",
					"desc" => "Set Map Location Image.",
					"id" => "map_location_pointer",
					"std" => get_template_directory_uri()."/images/map-location.png",
					"type" => "upload");

		
		//////// Header Options//////////////
		$of_options[] = array( 	"name" 		=> "Header Options",
								"type" 		=> "heading"
						);
						
						
		$of_options[] = array( "name" => "Header Layout ",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Header Options</h3>",
							"icon" => false,
							"type" => "info");
		
		
		$of_options[] = array( "name" => "Select Layout Header",
					"desc" => "Choose layout header.",
					"id" => "select_header",
					"std" => "header-1",
					"type" => "images",
					"options" => array(
						"header-1" => get_template_directory_uri()."/images/headers/header-1.jpg",
						"header-2" => get_template_directory_uri()."/images/headers/header-2.jpg",
						"header-3" => get_template_directory_uri()."/images/headers/header-3.jpg",
						"header-4" => get_template_directory_uri()."/images/headers/header-4.jpg",
						"header-5" => get_template_directory_uri()."/images/headers/header-5.jpg",
						"header-6" => get_template_directory_uri()."/images/headers/header-6.jpg",
						"header-7" => get_template_directory_uri()."/images/headers/header-7.jpg",
						"header-8" => get_template_directory_uri()."/images/headers/header-8.jpg",
						"header-9" => get_template_directory_uri()."/images/headers/header-9.jpg",
						"header-10" => get_template_directory_uri()."/images/headers/header-10.jpg"
						)
				); //Done Change
		
							
					
		//Header V1				
			
		$of_options[] = array( "name" => "Logo",
							"desc" => "Select an image file for your logo.",
							"id" => "logo",
							"std" => get_template_directory_uri()."/images/ievent-logo.png",
							"mod" => "",
							"type" => "media");
							
		$of_options[] = array( "name" => "Logo (Retina Version @2x)",
							"desc" => "Select an image file for the retina version of the logo. It should be exactly 2x the size of main logo.",
							"id" => "logo_retina",
							"std" => "",
							"mod" => "",
							"type" => "media");

				
		$of_options[] = array( "name" => "Sticky Header",
							"desc" => "Check to enable Sticky Header",
							"id" => "check_sticky_header",
							"std" => 1,
							"type" => "checkbox");						
		
		
		
		$of_options[] = array( "name" => "Header Layout ",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Header Info</h3>",
							"icon" => false,
							"type" => "info");
							
		$of_options[] = array( "name" => "Welcome Message",
							"desc" => "Set number of slideshow limit.",
							"id" => "welcome_text",
							"std" => "Welcome to iEvent",
							"type" => "text"); //Done Change
							
		$of_options[] = array( "name" => "Contact Phone",
							"desc" => "Type contact phone.",
							"id" => "hotline_contact",
							"std" => "Hotline + 800 8080 8088",
							"type" => "text"); //Done Change
		
		$of_options[] = array( "name" => "Contact Email",
							"desc" => "Type contact email address.",
							"id" => "email_contact",
							"std" => "info@ievent.com",
							"type" => "text"); //Done Change					
		
		
		$of_options[] = array( "name" => "Header Background Image",
							"desc" => "Upload header background image or paste image path.",
							"id" => "header_bg_image",
							"std" => get_template_directory_uri()."/images/default-titlebar.jpg",
							"mod" => "",
							"type" => "media");	
							
		$of_options[] = array( "name" => "Background Image Position",
							"desc" => "Set Background Position.",
							"id" => "header_bg_image_pos",
							"std" => "center",
							"type" => "select",
							"options" => array(
								'center' => 'Center',
								'top' => 'Top',
								'bottom' => 'Bottom')					
							); //Done Change						
					
		// Header Background
		
		
		//////// Footer Options//////////////
		$of_options[] = array( 	"name" 		=> "Footer Options",
								"type" 		=> "heading"
						);
						
						
		$of_options[] = array( "name" => "Footer Options",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Footer Options</h3>",
							"icon" => false,
							"type" => "info");							
					
		
		$of_options[] = array( "name" => "Select Footer Layout",
			"desc" => "Choose footer layout.",
			"id" => "select_footer",
			"std" => "footer-1",
			"type" => "images",
			"options" => array(
				"footer-1" => get_template_directory_uri()."/images/footer/footer-1.jpg",
				"footer-2" => get_template_directory_uri()."/images/footer/footer-2.jpg",
				)
		); //Done Change
		
		
		$of_options[] = array( "name" => "Enable Footer Info Box",
					"desc" => "Check this to show footer info box ( Address, Tel, Newsletter )",
					"id" => "checkbox_infobox",
					"std" => 1,
					"type" => "checkbox");	
					
		//Header V1				
			
		$of_options[] = array( "name" => "Footer Logo",
							"desc" => "Select an image file for your footer logo.",
							"id" => "footer-logo",
							"std" => get_template_directory_uri()."/images/ievent-logo.png",
							"mod" => "",
							"type" => "media");						
		
									
		$of_options[] = array( "name" => "Copyright",
							"desc" => "Type copyright text.",
							"id" => "copyright",
							"std" => "Copyrights &copy; 2014 - Design by",
							"type" => "text"); //Done Change
							
							
		//////// Background Options//////////////
		$of_options[] = array( 	"name" 		=> "Background Options",
								"type" 		=> "heading"
						);
						
						
		$of_options[] = array( "name" => "Boxed / Wide Layout ",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Boxed / Wide Layout Options</h3>",
							"icon" => false,
							"type" => "info");
							
		$of_options[] = array( "name" => "Select Layout Boxed / Wide",
							"desc" => "Choose Layout mode.",
							"id" => "select_layout",
							"std" => "wide",
							"type" => "select",
							"options" => array(
									"wide" 	=>"Wide",
									"boxed"  	=>"Boxed",
									)
						); //Done Change	
		$of_options[] = array( "name" => "Only for Boxed Layout mode ",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Only for Boxed Layout Option</h3>",
							"icon" => false,
							"type" => "info");
						
		$of_options[] = array( "name" => "Background Image",
					"desc" => "Select Background image or insert image path.",
					"id" => "meida_bg_boxbody_image",
					"std" => "",
					"mod" => "",
					"type" => "media");
					
					
		$of_options[] = array( "name" => "Background Repeat",
							"desc" => "Set Background Repeat option.",
							"id" => "select_bg_repeat",
							"std" => "repeat",
							"type" => "select",
							"options" => array(
								'repeat' => 'repeat',
								'repeat-x' => 'repeat-x',
								'repeat-y' => 'repeat-y',
								'no-repeat' => 'no-repeat')
						
						); //Done Change	
		$of_options[] = array( "name" => "Full Width Background Image (100%)",
					"desc" => "Check this to have full width background image",
					"id" => "check_bg_fullwidth",
					"std" => 0,
					"type" => "checkbox");				
			
					
		$of_options[] = array( "name" =>  "Background Color",
					"desc" => "Select Background color.",
					"id" => "bg_boxbody_color",
					"std" => "",
					"type" => "color");
									
						
		
		//////// Typography Options//////////////
		$of_options[] = array( "name" => "Typography",
							"type" => "heading");
							
							$of_options[] = array( "name" => "Google Fonts",
								"desc" => "",
								"id" => "general_heading",
								"std" => "<h3 style='margin: 0'>Google Fonts</h3>",
								"icon" => false,
								"type" => "info");
					
							$of_options[] = array( "name" => "Body Font Family",
								"desc" => "Select font family for body text",
								"id" => "google_body_font",
								"std" => "Open Sans",
								"type" => "select_google_font",
								"preview" 	=> array(
												"text" => "This is my preview text!", //this is the text from preview box
												"size" => "30px" //this is the text size from preview box
								),
								"options" => $list_of_google_fonts);
					
							$of_options[] = array( "name" => "Menu Font Family",
								"desc" => "Select font family for menu",
								"id" => "google_menu_font",
								"std" => "Roboto",
								"type" => "select_google_font",
								"preview" 	=> array(
												"text" => "This is my preview text!", //this is the text from preview box
												"size" => "30px" //this is the text size from preview box
								),
								"options" => $list_of_google_fonts);
					
							$of_options[] = array( "name" => "Headings Font Family",
								"desc" => "Select font family for general  headings(h1,h2,h3,h4,h5,h6)",
								"id" => "google_headings_font",
								"std" => "Open Sans",
								"type" => "select_google_font",
								"preview" 	=> array(
												"text" => "This is my preview text!", //this is the text from preview box
												"size" => "30px" //this is the text size from preview box
								),
								"options" => $list_of_google_fonts);
							
							$of_options[] = array( "name" => "Subheading Font Family",
								"desc" => "Select font family for general  sub headings",
								"id" => "google_subheadings_font",
								"std" => "Open Sans",
								"type" => "select_google_font",
								"preview" 	=> array(
												"text" => "This is my preview text!", //this is the text from preview box
												"size" => "30px" //this is the text size from preview box
								),
							"options" => $list_of_google_fonts);
								
					
							$of_options[] = array( "name" => "Footer Headings Font Family",
								"desc" => "Select font family for footer headings",
								"id" => "google_footer_headings_font",
								"std" => "Open Sans",
								"type" => "select_google_font",
								"preview" 	=> array(
												"text" => "This is my preview text!", //this is the text from preview box
												"size" => "30px" //this is the text size from preview box
								),
								"options" => $list_of_google_fonts);
								
								
							$of_options[] = array( "name" => "Expetional Font used in code",
								"desc" => "Select font family to be used in css stylesheet ( Manual)",
								"id" => "google_font_manual_load",
								"std" => "Oswald",
								"type" => "select_google_font",
								"preview" 	=> array(
												"text" => "This is my preview text!", //this is the text from preview box
												"size" => "30px" //this is the text size from preview box
								),
								"options" => $list_of_google_fonts);
											
		$of_options[] = array( "name" => "",
							"desc" => "",
							"id" => "general_heading",
							"std" => "<h3 style='margin: 0'>Body and Headlines</h3>",
							"icon" => false,
							"type" => "info");
		$of_options[] = array( "name" => "Body Text Font",
							"desc" => "Set Body font options",
							"id" => "body_font",
							"std" => array(
							'size' => '14px',
							'face' => 'Helvetica',
							'style' => 'normal',
							'color' => ''
							),
							"type" => "typography");
							
		$of_options[] = array( "name" => "",
							"desc" => "",
							"id" => "general_heading",
							"std" => "Headlines (H1,H2,H3,H4,H5,H6)",
							"icon" => false,
							"type" => "info");
						
		$of_options[] = array( "name" => "H1 - Headline Font",
							"desc" => "Set H1 Headline font options",
							"id" => "h1_font",
							"std" => array(
							'size' => '32px',
							'face' => 'Helvetica',
							'style' => 'normal',
							'color' => ''
							),
							"type" => "typography"); 
		$of_options[] = array( "name" => "H2 - Headline Font",
							"desc" => "Set H2 Headline font options",
							"id" => "h2_font",
							"std" => array(
							'size' => '23px',
							'face' => 'Helvetica',
							'style' => 'normal',
							'color' => ''
							),
							"type" => "typography");
		$of_options[] = array( "name" => "H3 - Headline Font",
							"desc" => "Set H3 Headline font options",
							"id" => "h3_font",
							"std" => array(
							'size' => '18px',
							'face' => 'Helvetica',
							'style' => 'normal',
							'color' => ''
							),
							"type" => "typography");
							
		$of_options[] = array( "name" => "H4 - Headline Font",
							"desc" => "Set H4 Headline font options",
							"id" => "h4_font",
							"std" => array(
							'size' => '16px',
							'face' => 'Helvetica',
							'style' => 'normal',
							'color' => ''
							),
							"type" => "typography");
							
		$of_options[] = array( "name" => "H5 - Headline Font",
							"desc" => "Set H5 Headline font options",
							"id" => "h5_font",
							"std" => array(
							'size' => '15px',
							'face' => 'Helvetica',
							'style' => 'normal',
							'color' => ''
							),
							"type" => "typography");
							
		$of_options[] = array( "name" => "H6 - Headline Font",
							"desc" => "Set H6 Headline font options",
							"id" => "h6_font",
							"std" => array(
							'size' => '14px',
							'face' => 'Helvetica',
							'style' => 'normal',
							'color' => ''
							),
							"type" => "typography");
		
		//////// Blog Options//////////////
		$of_options[] = array( 	"name" 		=> "Blog Options",
								"type" 		=> "heading"
						);
						
						
		$of_options[] = array( "name" => "Blog Archive Page",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Blog Archive Options</h3>",
							"icon" => false,
							"type" => "info");
		
		$of_options[] = array( "name" =>  "Image Hover Color",
							"desc" => "Select image hover overlay color.",
							"id" => "image_hoverlay",
							"std" => "",
							"type" => "color");	
							
		$of_options[] = array( "name" => "Image Hover Icons",
					"desc" => "Select image overlay hover icons",
					"id" => "select_img_hovericons",
					"std" => "Zoom+link",
					"type" => "select",
					"options" => array(
							"zoom_link" =>"Zoom+link",
							"zoom" =>"Zoom",
							"link" 	 =>"Link",
							"none" =>"none"
							)
							);							
					
		$of_options[] = array( "name" => "Enable Date",
							"desc" => "Check to enable Date.",
							"id" => "checkbox_date_info",
							"std" => 1,
							"type" => "checkbox"); //Done Change
							
		$of_options[] = array( "name" => "Enable Location",
							"desc" => "Check to enable Comments link.",
							"id" => "checkbox_location",
							"std" => 1,
							"type" => "checkbox"); //Done Change

							
		$of_options[] = array( "name" => "Blog Single Page",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Blog Page Options</h3>",
							"icon" => false,
							"type" => "info");


		$of_options[] = array( "name" => "Featured Image/Slideshow",
							"desc" => "Enable Featured Image or Slideshow in blog page .",
							"id" => "checkbox_slideshowall",
							"std" => 1,
							"type" => "checkbox"); //Done Change						
							
		$of_options[] = array( "name" => "Featured Slideshow",
							"desc" => "Enable Featured Slideshow in blog page .",
							"id" => "checkbox_slideshow",
							"std" => 1,
							"type" => "checkbox"); //Done Change
							
		$of_options[] = array( "name" => "Featured Slideshow Counts",
							"desc" => "Set number of slideshow limit.",
							"id" => "text_slideshow_count",
							"std" => "2",
							"type" => "text"); //Done Change									
		
		$of_options[] = array( "name" => "Enable Comments",
							"desc" => "Check to enable Comments.",
							"id" => "checkbox_comments",
							"std" => 1,
							"type" => "checkbox"); //Done Change
					
					
		//////// PrettyPhoto Lightbox Options//////////////
		$of_options[] = array( 	"name" 		=> "Lightbox Options",
								"type" 		=> "heading"
						);
						
						
		$of_options[] = array( "name" => "Lightbox Options",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Lightbox Options</h3>",
							"icon" => false,
							"type" => "info");
		$of_options[] = array( "name" => "Enable PrettyPhoto Lightbox",
					"desc" => "Check to enable prettyphoto",
					"id" => "prettyphoto_auto_link",
					"std" => 1,
					"type" => "checkbox");
					
		$of_options[] = array( "name" => "Autoplay Slideshow",
					"desc" => "Check to autoplay slideshow",
					"id" => "autoplay_slideshow",
					"std" => 1,
					"type" => "checkbox");
					
		$of_options[] = array( "name" => "Show Title",
					"desc" => "Check to show title",
					"id" => "lightbox_show_title",
					"std" => 1,
					"type" => "checkbox");
		$of_options[] = array( "name" => "Enable Overlay",
					"desc" => "Check to enable gallery overlay",
					"id" => "overlay_gallery",
					"std" => 1,
					"type" => "checkbox");			
							
		$of_options[] = array( "name" => "Lightbox Theme",
							"desc" => "Select lightbox theme.",
							"id" => "slideshow_theme",
							"std" => "facebook",
							"type" => "select",
							"options" => array(
									"light_rounded" =>"Light Rounded",
									"dark_rounded"=>"Dark Rounded",
									"light_square"=>"Light Square",
									"dark_square"=>"Dark Square",
									"facebook"=>"Facebook"));	//Done Change
		$of_options[] = array( "name" => "Lightbox Opacity",
							"desc" => "Set lightbox opacity",
							"id" => "lightbox_opacity",
							"std" => "0.8",
							"min" => "0.1",
							"step"	=> "1",
							"max" => "1",
							"type" => "sliderui");	
		$of_options[] = array( "name" => "Lightbox Animation Speed",
							"desc" => "Set animation speed",
							"id" => "animation_speed",
							"std" => "fast",
							"type" => "select",
							"options" => array(
									"fast" =>"Fast",
									"slow"=>"Slow",
									"normal"=>"Normal"));	//Done Change					
		
		
		$of_options[] = array( "name" => "Enable/Disable Pretty Lightbox",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Enable/Disable Pretty Lightbox</h3>",
							"icon" => false,
							"type" => "info");
		
		$of_options[] = array( "name" => "Speaker",
							"desc" => "Select Speaker view page option.",
							"id" => "speaker_view",
							"std" => "pop-up",
							"type" => "select",
							"options" => array(
								'pop-up' => 'Pop Up',
								'single-page' => 'Single Page')					
							); //Done Change
							
		
		//////// Social Network Options//////////////
		$of_options[] = array( 	"name" 		=> "Social Network Options",
								"type" 		=> "heading"
						);
		$of_options[] = array( "name" => "Enable/Disable Social Network",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Enable/Disable Social Network</h3>",
							"icon" => false,
							"type" => "info");
							
		$of_options[] = array( "name" => "Show in Footer",
							"desc" => "Show social network in footer.",
							"id" => "checkbox_social_footer",
							"std" => 1,
							"type" => "checkbox"); //Done Change							
									
		$of_options[] = array( "name" => "Social Network Options",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Social Network Accounts</h3>",
							"icon" => false,
							"type" => "info");
		$of_options[] = array( "name" => "Facebook",
								"desc" => "Ex: ievent",
								"id" => "text_facebook",
								"std" => "ievent",
								"type" => "text"); //Done Change
		$of_options[] = array( "name" => "Twitter",
								"desc" => "Ex: ievent",
								"id" => "text_twitter",
								"std" => "ievent",
								"type" => "text"); //Done Change		
		$of_options[] = array( "name" => "Youtube",
								"desc" => "Ex: ievent",
								"id" => "text_youtube",
								"std" => "ievent",
								"type" => "text"); //Done Change	
		$of_options[] = array( "name" => "Google +",
								"desc" => "Ex: ievent",
								"id" => "text_googleplus",
								"std" => "ievent",
								"type" => "text"); //Done Change	
		$of_options[] = array( "name" => "Dribbble",
								"desc" => "Ex: ievent",
								"id" => "text_dribbble",
								"std" => "ievent",
								"type" => "text"); //Done Change	
		$of_options[] = array( "name" => "Instagram",
								"desc" => "Ex: ievent",
								"id" => "text_instagram",
								"std" => "ievent",
								"type" => "text"); //Done Change	
		$of_options[] = array( "name" => "Pinterest",
								"desc" => "Ex: ievent",
								"id" => "text_pinterest",
								"std" => "ievent",
								"type" => "text"); //Done Change	
		$of_options[] = array( "name" => "Flickr",
								"desc" => "Ex: ievent",
								"id" => "text_flickr",
								"std" => "ievent",
								"type" => "text"); //Done Change	
		
		
		//////// Woocommerce Options//////////////
		$of_options[] = array( 	"name" 		=> "WooCommerce",
								"type" 		=> "heading"
						);
						
		$of_options[] = array( "name" => "Display Settings",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Display Settings</h3>",
							"icon" => false,
							"type" => "info");
							
		$of_options[] = array( "name" => "Select Layout",
					"desc" => "Choose layout",
					"id" => "woo_layout",
					"std" => "right-sidebar",
					"type" => "images",
					"options" => array(
						"left-sidebar" => get_template_directory_uri()."/images/view/sidebar-left.png",
						"right-sidebar" => get_template_directory_uri()."/images/view/sidebar-right.png",
						"no-sidebar" => get_template_directory_uri()."/images/view/body-full.png"
						)
				); //Done Change					
		
		
		$of_options[] = array( "name" => "Number of Product Columns",
								"desc" => "Set number of columns",
								"id" => "woocoomerce_coulmns",
								"type" => "select",
								"options" => array(
										"4" 	=>"4",
										"3" 	=>"3"
										)
								);
		
		$of_options[] = array( "name" => "Number of Products per page",
								"desc" => "Insert number of products to show per page",
								"id" => "woo_number_per_page",
								"std" => "12",
								"type" => "text"); //Done Change
								
		$of_options[] = array( "name" => "Hide Breadcrumbs?",
							"desc" => "Show/Hide Breadcrumbs",
							"id" => "checkbox_woo_breadcrumbs",
							"std" => 1,
							"type" => "checkbox"); //Done Change
							
		$of_options[] = array( "name" => "Hide Title",
							"desc" => "Show/Hide Page Title",
							"id" => "checkbox_woo_title",
							"std" => 1,
							"type" => "checkbox"); //Done Change
							
							
		$of_options[] = array( "name" => "Product Image",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Product Image Effect</h3>",
							"icon" => false,
							"type" => "info");
		
		
		$of_options[] = array( "name" => "Image Hover",
					"desc" => "Select image hover effect",
					"id" => "woo_image_hover",
					"std" => "stat",
					"type" => "select",
					"options" => array(
							"stat" 	=>"Stat",
							"flip" 	=>"Flip"
							)
					);
		
		
		
		//Extra
		//////// Theme Updates Options//////////////
		$of_options[] = array( 	"name" 		=> "Extra",
								"type" 		=> "heading"
						);
		
		$of_options[] = array( "name" => "Theme Updates",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Theme Updates</h3>",
							"icon" => false,
							"type" => "info");


		$of_options[] = array( "name" => "Themeforest Username",
								"desc" => "Ex: janxcode",
								"id" => "envato_username",
								"std" => "",
								"type" => "text"); //Done Change
								
		$of_options[] = array( "name" => "Themeforest API Key",
								"desc" => "Ex: XXXXXXXXXXXXXXXXXXXXXX",
								"id" => "envato_apikey",
								"std" => "",
								"type" => "text"); //Done Change
								
								
		$of_options[] = array( "name" => "Mailchimp",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Mailchimp</h3>",
							"icon" => false,
							"type" => "info");


		$of_options[] = array( "name" => "Api Key",
								"desc" => "Type mailchimp api key, <a href='http://kb.mailchimp.com/accounts/management/about-api-keys'>Get your key</a>",
								"id" => "mailchimp_apikey",
								"std" => "",
								"type" => "text"); //Done Change
								
		$of_options[] = array( "name" => "List ID",
								"desc" => "Type mailchimp list id, <a href='http://kb.mailchimp.com/article/how-can-i-find-my-list-id'>Get your key</a>",
								"id" => "mailchimp_id",
								"std" => "",
								"type" => "text"); //Done Change
								
	

		$of_options[] = array( "name" => "Google reCaptcha",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Google reCaptcha</h3>",
							"icon" => false,
							"type" => "info");


		$of_options[] = array( "name" => "Site Key",
								"desc" => "Type google site key, <a href='https://www.google.com/recaptcha/'>Get your site key</a>",
								"id" => "site_key",
								"std" => "",
								"type" => "text"); //Done Change
								
		$of_options[] = array( "name" => "Secret Key",
								"desc" => "Type google secret key, <a href='https://www.google.com/recaptcha/'>Get your secret key</a>",
								"id" => "google_recaptcha",
								"std" => "",
								"type" => "text"); //Done Change
								
								
		$of_options[] = array( "name" => "Google Map",
							"desc" => "",
							"id" => "header_info",
							"std" => "<h3 style='margin: 0'>Google Map</h3>",
							"icon" => false,
							"type" => "info");


		$of_options[] = array( "name" => "API Key",
								"desc" => "Type google site key, <a href='https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key'>Get your site key</a>",
								"id" => "google_map_key",
								"std" => "",
								"type" => "text"); //Done Change		
				
		
		// Custom Css
								
		 $of_options[] = array( "name" => "Custom CSS",
					"type" => "heading");
				$of_options[] = array( "name" => "Custom CSS Style",
					"desc" => "",
					"id" => "advanced_css_intro",
					"std" => "<h3 style='margin: 0;'>Custom CSS Style</h3>",
					"icon" => false,
					"type" => "info");
				$of_options[] = array( "name" => "CSS Code",
					"desc" => "Paste your custom css style in this box, you might need to use !important for some cases to override the default css.",
					"id" => "custom_css_style",
					"std" => "",
					"type" => "textarea");
					
		
		// Backup Options
		$of_options[] = array( "name" => "Backup Options",
								"type" => "heading"
								);
		$of_options[] = array( "name" => "Backup and Restore Options",
								"id" => "of_backup",
								"std" => "",
								"type" => "backup",
								"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
								);
		$of_options[] = array( "name" => "Transfer Theme Options Data",
								"id" => "of_transfer",
								"std" => "",
								"type" => "transfer",
								"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
								);
								
			}//End function: of_options()
		}//End chack if function exists: of_options()
?>
