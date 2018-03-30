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
		    $of_pages['page-'.$of_page->ID] = $of_page->post_title; }
			
		$of_pages_tmp 	= array_unshift($of_pages, "Select a page:");            

	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		$seconds 	= array(3000,5000,7000,10000,12000,15000,18000,20000);
		$transitions 	= array("0 "=> "None","1 "=> "Fade","2 "=> "Slide Top","3 "=> "Slide Right","4 "=> "Slide Bottom","5 "=> "Slide Left","6 "=> "Carousel Right","7 "=> "Carousel Left");
		$transition_speed 	= array(500,1000,1500,2000,2500,3000,3500,4000);

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
$standard_fonts = array(
						'0' => 'Select Font',
						'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
						"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
						"'Bookman Old Style', serif" => "'Bookman Old Style', serif",
						"'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
						"Courier, monospace" => "Courier, monospace",
						"Garamond, serif" => "Garamond, serif",
						"Georgia, serif" => "Georgia, serif",
						"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
						"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
						"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
						"'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
						"'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
						"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
						"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
						"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
						"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
						"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif"
					);
				
$google_fonts = array(
							"0" => "Select Font",
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
							"Fanwood Text" => "Fanwood Text",
							"Fascinate" => "Fascinate",
							"Fascinate Inline" => "Fascinate Inline",
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
							"Gruppo" => "Gruppo",
							"Gudea" => "Gudea",
							"Habibi" => "Habibi",
							"Hammersmith One" => "Hammersmith One",
							"Handlee" => "Handlee",
							"Hanuman" => "Hanuman",
							"Happy Monkey" => "Happy Monkey",
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
							"Marck Script" => "Marck Script",
							"Marko One" => "Marko One",
							"Marmelad" => "Marmelad",
							"Marvel" => "Marvel",
							"Mate" => "Mate",
							"Mate SC" => "Mate SC",
							"Maven Pro" => "Maven Pro",
							"Meddon" => "Meddon",
							"MedievalSharp" => "MedievalSharp",
							"Medula One" => "Medula One",
							"Megrim" => "Megrim",
							"Merienda One" => "Merienda One",
							"Merriweather" => "Merriweather",
							"Metal" => "Metal",
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
							"Numans" => "Numans",
							"Nunito" => "Nunito",
							"Odor Mean Chey" => "Odor Mean Chey",
							"Old Standard TT" => "Old Standard TT",
							"Oldenburg" => "Oldenburg",
							"Oleo Script" => "Oleo Script",
							"Open Sans" => "Open Sans",
							"Open Sans Condensed" => "Open Sans Condensed",
							"Orbitron" => "Orbitron",
							"Original Surfer" => "Original Surfer",
							"Oswald" => "Oswald",
							"Over the Rainbow" => "Over the Rainbow",
							"Overlock" => "Overlock",
							"Overlock SC" => "Overlock SC",
							"Ovo" => "Ovo",
							"Oxygen" => "Oxygen",
							"PT Mono" => "PT Mono",
							"PT Sans" => "PT Sans",
							"PT Sans Caption" => "PT Sans Caption",
							"PT Sans Narrow" => "PT Sans Narrow",
							"PT Serif" => "PT Serif",
							"PT Serif Caption" => "PT Serif Caption",
							"Pacifico" => "Pacifico",
							"Parisienne" => "Parisienne",
							"Passero One" => "Passero One",
							"Passion One" => "Passion One",
							"Patrick Hand" => "Patrick Hand",
							"Patua One" => "Patua One",
							"Paytone One" => "Paytone One",
							"Permanent Marker" => "Permanent Marker",
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
							"Quantico" => "Quantico",
							"Quattrocento" => "Quattrocento",
							"Quattrocento Sans" => "Quattrocento Sans",
							"Questrial" => "Questrial",
							"Quicksand" => "Quicksand",
							"Qwigley" => "Qwigley",
							"Radley" => "Radley",
							"Raleway" => "Raleway",
							"Rammetto One" => "Rammetto One",
							"Rancho" => "Rancho",
							"Rationale" => "Rationale",
							"Redressed" => "Redressed",
							"Reenie Beanie" => "Reenie Beanie",
							"Revalia" => "Revalia",
							"Ribeye" => "Ribeye",
							"Ribeye Marrow" => "Ribeye Marrow",
							"Righteous" => "Righteous",
							"Roboto" => "Roboto",
							"Roboto Condensed" => "Roboto Condensed",
							"Roboto Slab" => "Roboto Slab",
							"Rochester" => "Rochester",
							"Rock Salt" => "Rock Salt",
							"Rokkitt" => "Rokkitt",
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
							"Slackey" => "Slackey",
							"Smokum" => "Smokum",
							"Smythe" => "Smythe",
							"Sniglet" => "Sniglet",
							"Snippet" => "Snippet",
							"Sofia" => "Sofia",
							"Sonsie One" => "Sonsie One",
							"Sorts Mill Goudy" => "Sorts Mill Goudy",
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
							"Wellfleet" => "Wellfleet",
							"Wire One" => "Wire One",
							"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
							"Yellowtail" => "Yellowtail",
							"Yeseva One" => "Yeseva One",
							"Yesteryear" => "Yesteryear",
							"Zeyada" => "Zeyada",
						);
$font_sizes = array(
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20',
			'22' => '22',
			'24' => '24',
			'26' => '26',
			'30' => '30',
			'32' => '32',
			'36' => '34',
			'40' => '40',
			'44' => '41',
			'48' => '42',
			'60' => '60',			
		);
$font_weights = array(
							"100" => "100",
							"200" => "200",
							"300" => "300",
							"400" => "400",
							"500" => "500",
							"600" => "600",
							"700" => "700",
					);	
					
$url =  ADMIN_DIR . 'assets/images/';						
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();



$of_options[] = array( 	"name" 		=> "Basic Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "basic_settings.png"
				);

				
$of_options[] = array( 	"name" 		=> "Favicon Icon",
						"id" 		=> "favicon",
						"type" 		=> "upload",
						"desc" 		=> "Upload favicon icon"
				);
				
$of_options[] = array( 	"name" 		=> "Logo",
						"id" 		=> "logo",
						"type" 		=> "upload",
						"desc" 		=> "Upload Logo"
				);
				
$of_options[] = array( 	"name" 		=> "Select 404 (not found) page",
						"id" 		=> "page_404",
						"type" 		=> "select",
						"options" 	=> $of_pages,
				);		
				
$of_options[] = array( 	"name" 		=> "Tracking Code",
						"desc" 		=> "Enter your tracking code here. You can use any other script here too. Do not include &lt;script&gt; tag.",
						"id" 		=> "footer_script",
						"std" 		=> "",
						"type" 		=> "textarea"
				);

				
$of_options[] = array( 	"name" 		=> "Use javascript driven scroll",
						"desc" 		=> "Uncheck if you do not want javascript based scrollbar",
						"id" 		=> "nice_scroll",
						"std" 		=> 1,
						"type" 		=> "switch"
				);	
				
$of_options[] = array( "name" => "Show Breadcrumb",
					"desc" => "",
					"id" => "breadcrumb",
					"std" => 1,
					"type" => "switch");
					
$of_options[] = array( 	"name" 		=> "Upload Block Title Background",
						"id" 		=> "block_title_bg",
						"type" 		=> "upload",
						"desc" 		=> "Upload new block title background or keep blank to use default"
				);


$of_options[] = array( 	"name" 		=> "Upload Loading gif Image",
						"id" 		=> "loading_gif",
						"type" 		=> "upload",
						"desc" 		=> "Upload new loading gif animation or keep blank to use default"
				);

$of_options[] = array( 	"name" 		=> "Reservation widget toggle text",
						"id" 		=> "reservation_toggle_text",
						"type" 		=> "text",
						"desc" 		=> ""
				);

				
$of_options[] = array( 	"name" 		=> "Responsive navigation type",
						"id" 		=> "responsive_nav_type",
						"type" 		=> "select",
						"options" 	=> array(
										'smooth' => 'Smooth dropdown navigation',
										'select' => 'Select navigation'),
						"desc" 		=> "Choose responsive navigation type"
				);	
				
$of_options[] = array( 	"name" 		=> "Footer Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "footer_settings.png"
				);
	
				
$of_options[] = array( 	"name" 		=> "Copyright Text",
						"desc" 		=> "",
						"id" 		=> "copyright_text",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
$of_options[] = array( "name" => "Social Icons",
					"desc" => "",
					"id" => "social_icons",
					"std" => "<h3 style='margin: 0;''>Social Icons</h3>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( 	"name" 		=> "Facebook",
						"desc" 		=> "Enter the facebook link. Skip if you do not want it to appear",
						"id" 		=> "facebook",
						"type" 		=> "text"
				);
	
$of_options[] = array( 	"name" 		=> "Twitter",
						"desc" 		=> "Enter the twitter link. Skip if you do not want it to appear",
						"id" 		=> "twitter",
						"type" 		=> "text"
				);
	
$of_options[] = array( 	"name" 		=> "LinkedIn",
						"desc" 		=> "Enter the linkedIn link. Skip if you do not want it to appear",
						"id" 		=> "linkedin",
						"type" 		=> "text"
				);				
	
$of_options[] = array( 	"name" 		=> "Flickr",
						"desc" 		=> "Enter the flickr link. Skip if you do not want it to appear",
						"id" 		=> "flickr",
						"type" 		=> "text"
				);			
	
$of_options[] = array( 	"name" 		=> "RSS",
						"desc" 		=> "Enter the RSS link. Skip if you do not want it to appear",
						"id" 		=> "rss",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "SoundCloud",
						"desc" 		=> "Enter the soundcloud link. Skip if you do not want it to appear",
						"id" 		=> "soundcloud",
						"type" 		=> "text"
				);				
				
$of_options[] = array( 	"name" 		=> "Itunes",
						"desc" 		=> "Enter the itunes link. Skip if you do not want it to appear",
						"id" 		=> "itunes",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Instagram",
						"desc" 		=> "Enter the instagram link. Skip if you do not want it to appear",
						"id" 		=> "instagram",
						"type" 		=> "text"
				);	
$of_options[] = array( 	"name" 		=> "Pinterest",
						"desc" 		=> "Enter the pinterest  link. Skip if you do not want it to appear",
						"id" 		=> "pinterest",
						"type" 		=> "text"
				);					
$of_options[] = array( 	"name" 		=> "Vimeo",
						"desc" 		=> "Enter the vimeo link. Skip if you do not want it to appear",
						"id" 		=> "vimeo",
						"type" 		=> "text"
				);
				
	
$of_options[] = array( 	"name" 		=> "Youtube",
						"desc" 		=> "Enter the youtube link. Skip if you do not want it to appear",
						"id" 		=> "youtube",
						"type" 		=> "text"
				);	

$of_options[] = array( 	"name" 		=> "Tumblr",
						"desc" 		=> "Enter the tumblr link. Skip if you do not want it to appear",
						"id" 		=> "tumblr",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Google Plus",
						"desc" 		=> "Enter the google plus link. Skip if you do not want it to appear",
						"id" 		=> "gplus",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Dribbble",
						"desc" 		=> "Enter the dribbble plus link. Skip if you do not want it to appear",
						"id" 		=> "dribbble",
						"type" 		=> "text"
				);		
				
$of_options[] = array( 	"name" 		=> "Blogger",
						"desc" 		=> "Enter the blogger plus link. Skip if you do not want it to appear",
						"id" 		=> "blogger",
						"type" 		=> "text"
				);		
				
				
$of_options[] = array( 	"name" 		=> "Myspace",
						"desc" 		=> "Enter the myspace plus link. Skip if you do not want it to appear",
						"id" 		=> "myspace",
						"type" 		=> "text"
				);	
								
				
$of_options[] = array( 	"name" 		=> "Reddit",
						"desc" 		=> "Enter the reddit plus link. Skip if you do not want it to appear",
						"id" 		=> "reddit",
						"type" 		=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Custom Icon 1",
						"desc" 		=> "",
						"id" 		=> "custom_icon_1",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Custom Icon 1 Image",
						"desc" 		=> "Upload custom icon 1 image ",
						"id" 		=> "custom_icon_1_image",
						"std" 		=> "",
						"fold" 		=> "custom_icon_1", 
						"type" 		=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Use Font Awesome or Glyphicons class instead of image",
						"desc" 		=> "",
						"id" 		=> "custom_icon_1_class",
						"std" 		=> "",
						"fold" 		=> "custom_icon_1", 
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Custom Icon 1 Link",
						"desc" 		=> "Enter custom icon 1 link",
						"id" 		=> "custom_icon_1_link",
						"std" 		=> "",
						"fold" 		=> "custom_icon_1", 
						"type" 		=> "text"
				);
				
				
$of_options[] = array( 	"name" 		=> "Custom Icon 2",
						"desc" 		=> "",
						"id" 		=> "custom_icon_2",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Custom Icon 2 Image",
						"desc" 		=> "Upload custom icon 2 image ",
						"id" 		=> "custom_icon_2_image",
						"std" 		=> "",
						"fold" 		=> "custom_icon_2", 
						"type" 		=> "upload"
				);
				
$of_options[] = array( 	"name" 		=> "Use Font Awesome or Glyphicons class instead of image",
						"desc" 		=> "",
						"id" 		=> "custom_icon_2_class",
						"std" 		=> "",
						"fold" 		=> "custom_icon_2", 
						"type" 		=> "text"
				);			
				
$of_options[] = array( 	"name" 		=> "Custom Icon 2 Link",
						"desc" 		=> "Enter custom icon 2 link",
						"id" 		=> "custom_icon_2_link",
						"std" 		=> "",
						"fold" 		=> "custom_icon_2", 
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Custom Icon 3",
						"desc" 		=> "",
						"id" 		=> "custom_icon_3",
						"std" 		=> 0,
						"folds" 	=> 1,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Custom Icon 3 Image",
						"desc" 		=> "Upload custom icon 3 image ",
						"id" 		=> "custom_icon_3_image",
						"std" 		=> "",
						"fold" 		=> "custom_icon_3", 
						"type" 		=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Use Font Awesome or Glyphicons class instead of image",
						"desc" 		=> "",
						"id" 		=> "custom_icon_3_class",
						"std" 		=> "",
						"fold" 		=> "custom_icon_3", 
						"type" 		=> "text"
				);			
				
$of_options[] = array( 	"name" 		=> "Custom Icon 3 Link",
						"desc" 		=> "Enter custom icon 3 link",
						"id" 		=> "custom_icon_3_link",
						"std" 		=> "",
						"fold" 		=> "custom_icon_3", 
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Ajax Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "wrench16.png"
				);	
			
$of_options[] = array( 	"name" 		=> "Use ajax load",
						"desc" 		=> "Uncheck if you do not want ajax loading",
						"id" 		=> "ajax_load",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
			
$of_options[] = array( 	"name" 		=> "Minumum screen size for ajax",
						"desc" 		=> "",
						"id" 		=> "ajax_screen_size",
						"min" 		=> 0,
						"max" 		=> 2000,
						"step" 		=> 1,
						"std" 		=> 0,
						"edit" 		=> 'yes',
						"type" 		=> "sliderui"
				);

$of_options[] = array( "name" => "Ajax load scripts",
					"desc" => "",
					"id" => "ajax-load-info",
					"std" => "<h3 style='margin: 0;''>Ajax load scripts are useful when you need to run any script on ajax load.</h3>",
					"icon" => true,
					"type" => "info");	
					
$of_options[] = array( 	"name" 		=> "Ajax load scripts",
						"desc" 		=> "Add scripts",
						"id" 		=> "ajax-scripts",
						"std" 		=> "",
						"type" 		=> "file"
				);						
					
$of_options[] = array( 	"name" 		=> "Blog Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "blog_settings.png"
				);

$of_options[] = array( 	"name" 		=> "Ajax load script 1",
						"id" 		=> "ajax-script-1",
						"type" 		=> "upload",
						"desc" 		=> ""
				);
				
$of_options[] = array( "name" => "Blog Title",
					"desc" => "",
					"id" => "blog_title",
					"std" => "Blog",
					"type" => "text"
					);		
					
$of_options[] = array( "name" => "Blog Secondary Title",
					"desc" => "",
					"id" => "blog_secondary_title",
					"std" => "",
					"type" => "text"
					);	
					
$of_options[] = array( 	"name" 		=> "Blog Layout",
						"desc" 		=> "Select main content and sidebar alignment.",
						"id" 		=> "blog_layout",
						"std" 		=> "right",
						"type" 		=> "images",
						"options" 	=> array(
							'nosidebar' 	=> $url . '1col.png',
							'right' 	=> $url . '2cr.png',
							'left' 	=> $url . '2cl.png',
						)
				);
				
$of_options[] = array( "name" => "Blog Image Size",
					"desc" => "",
					"id" => "blog_image_size",
					"std" => "Large",
					"type" => "select",
					"options" => array(
						'large' => 'Large',
						'medium' => 'Medium',
					));
				
$of_options[] = array( "name" => "Blog post size",
					"desc" => "",
					"id" => "blog_post_size",
					"std" => "excerpt",
					"type" => "select",
					"options" => array(
						'excerpt' => 'Excerpt',
						'full_content' => 'Full content',
					));
$of_options[] = array( "name" => "Excerpt Word Count",
					"desc" => "Enter your desired excerpt length by words",
					"id" => "excerpt_length_blog",
					"std" => "55",
					"type" => "text");
					
$of_options[] = array( "name" => "Blog Single Options",
					"desc" => "",
					"id" => "blog_single",
					"std" => "<h3 style='margin: 0;''>Blog Single Options</h3>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => "Author Info",
					"desc" => "Show author info after posts.",
					"id" => "author_info",
					"std" => 1,
					"type" => "switch");
					
$of_options[] = array( "name" => "Social Sharing",
					"desc" => "Show the social sharing box.",
					"id" => "social_sharing_box",
					"std" => 1,
					"type" => "switch");

$of_options[] = array( "name" => "Related Posts",
					"desc" => "Show related posts.",
					"id" => "show_related_posts",
					"std" => 1,
					"type" => "switch");

$of_options[] = array( "name" => "Comments",
					"desc" => "Show comments.",
					"id" => "show_blog_comments",
					"std" => 1,
					"type" => "switch");
					

$of_options[] = array( 	"name" 		=> "Woocommerce",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "woo.png"
				);

$of_options[] = array( "name" => "Shop Title",
					"desc" => "",
					"id" => "shop_title",
					"std" => "Shop",
					"type" => "text"
					);		
					
$of_options[] = array( 	"name" 		=> "Shop Layout",
						"desc" 		=> "Select main content and sidebar alignment.",
						"id" 		=> "shop_layout",
						"std" 		=> "right",
						"type" 		=> "images",
						"options" 	=> array(
							'nosidebar' 	=> $url . '1col.png',
							'right' 	=> $url . '2cr.png',
							'left' 	=> $url . '2cl.png',
						)
				);
				
$of_options[] = array( 	"name" 		=> "Event Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "event_settings.png"
				);		
				
$of_options[] = array( "name" => "Social Sharing",
					"desc" => "Show the social sharing box.",
					"id" => "social_sharing_box_event",
					"std" => 1,
					"type" => "switch");

$of_options[] = array( "name" => "Comments",
					"desc" => "Show comments.",
					"id" => "show_event_comments",
					"std" => 1,
					"type" => "switch");

					
$of_options[] = array( "name" => "Show related box",
					"desc" => "",
					"id" => "show_related_events",
					"type" => "switch",);
					
					
$of_options[] = array( 	"name" 		=> "Typography",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "typo_settings.png"
				);				

$of_options[] = array( "name" => "Google Fonts",
					"desc" => "",
					"id" => "google_fonts_intro",
					"std" => "<h3 style='margin: 0;''>Google Fonts</h3>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => "Body Font Family",
					"desc" => "Select a google font body text",
					"id" => "google_body_font",
					"std" => "PT Sans",
					"type" => "select_google_font",
					"preview" 	=> array(
										"text" => "Grumpy wizards make toxic brew for the evil Queen and Jack", //this is the text from preview box
										"size" => "13px" //this is the text size from preview box
						),
					"options" => $google_fonts);

$of_options[] = array( "name" => "Menu Font Family",
					"desc" => "Select a google font for navigation",
					"id" => "google_menu_font",
					"std" => "Antic Slab",
					"type" => "select_google_font",
					"preview" 	=> array(
										"text" => "Grumpy wizards make toxic brew for the evil Queen and Jack", //this is the text from preview box
										"size" => "14px" //this is the text size from preview box
						),
					"options" => $google_fonts);

$of_options[] = array( "name" => "Headings Font Family",
					"desc" => "Select a google font for headings",
					"id" => "google_heading_font",
					"std" => "Antic Slab",
					"type" => "select_google_font",
					"preview" 	=> array(
										"text" => "Grumpy wizards make toxic brew for the evil Queen and Jack", //this is the text from preview box
										"size" => "20px" //this is the text size from preview box
						),
					"options" => $google_fonts);

$of_options[] = array( "name" => "Standard Fonts",
					"desc" => "",
					"id" => "font_size_intro",
					"std" => "<h3 style='margin: 0;'>Font Sizes</h3>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => "Body Font Size",
					"desc" => "Default: 13",
					"id" => "body_font_size",
					"std" => "13",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Top Nav Font Size",
					"desc" => "Default: 14",
					"id" => "nav_font_size",
					"std" => "14",
					"type" => "select",
					"options" => $font_sizes);


$of_options[] = array( "name" => "Copyright Font Size",
					"desc" => "Default: 12",
					"id" => "copyright_font_size",
					"std" => "12",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading 1 Font Size",
					"desc" => "Default: 40",
					"id" => "h1_font_size",
					"std" => "40",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading 2 Font Size",
					"desc" => "Default: 26",
					"id" => "h2_font_size",
					"std" => "26",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading 3 Font Size",
					"desc" => "Default: 24",
					"id" => "h3_font_size",
					"std" => "24",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading 4 Font Size ",
					"desc" => "Default: 18",
					"id" => "h4_font_size",
					"std" => "18",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading 5 Font Size",
					"desc" => "Default: 14",
					"id" => "h5_font_size",
					"std" => "14",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading 6 Font Size",
					"desc" => "Default is 12",
					"id" => "h6_font_size",
					"std" => "12",
					"type" => "select",
					"options" => $font_sizes);
					
$of_options[] = array( "name" => "Standard Fonts",
					"desc" => "",
					"id" => "font_weight_intro",
					"std" => "<h3 style='margin: 0;'>Font Weight: Make sure the font weight is available by google</h3>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => "Heading Font Weight",
					"desc" => "",
					"id" => "heading_font_weight",
					"std" => "400",
					"type" => "select",
					"options" => $font_weights);
					
$of_options[] = array( "name" => "Body Font Weight",
					"desc" => "",
					"id" => "body_font_weight",
					"std" => "400",
					"type" => "select",
					"options" => $font_weights);
					
$of_options[] = array( "name" => "Menu Font Weight",
					"desc" => "",
					"id" => "menu_font_weight",
					"std" => "400",
					"type" => "select",
					"options" => $font_weights);					
					
//styling option
$of_options[] = array( 	"name" 		=> "Styling",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "style_settings.png"
				);	

			
$of_options[] = array( 	"name" 		=> "Content Background Opacity",
						"desc" 		=> "Default 80",
						"id" 		=> "content_bg_opacity",
						"std" 		=> "80",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);
				
$of_options[] = array( "name" => "Dotted Pattern For Body Background",
					"desc" => "Will Be Used In Body Background",
					"id" => "pattern_overlay_image",
					"std" => "",
					"type" => "upload");	
					
$of_options[] = array( "name" => "Basic Style",
					"desc" => "",
					"id" => "background_color",
					"std" => "<h3 style='margin: 0;'>Basic Styles</h3>",
					"icon" => true,
					"type" => "info");
					
				
$of_options[] = array( 	"name" 		=> "Content Area Background Color",
						"desc" 		=> "",
						"id" 		=> "content_bg",
						"std" 		=> "#000000",
						"type" 		=> "color"
				);
					
$of_options[] = array( 	"name" 		=> "Content Font Color",
						"desc" 		=> "",
						"id" 		=> "content_color",
						"std" 		=> "#CCCCCC",
						"type" 		=> "color"
				);
					
$of_options[] = array( 	"name" 		=> "Heading Font Color",
						"desc" 		=> "",
						"id" 		=> "heading_color",
						"std" 		=> "#EEEEEE",
						"type" 		=> "color"
				);
		
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "menu_style",
					"std" => "<h3 style='margin: 0;'>Navigation Menu Style</h3>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( 	"name" 		=> "Menu Dropdown Background",
						"desc" 		=> "Menu drop down background color.",
						"id" 		=> "menu_bg",
						"std" 		=> "#666666",
						"type" 		=> "color"
				);
					
$of_options[] = array( 	"name" 		=> "Menu Dropdown Hover Background",
						"desc" 		=> "Menu drop down hover background color.",
						"id" 		=> "menu_hover_bg",
						"std" 		=> "#333333",
						"type" 		=> "color"
				);				
$of_options[] = array( 	"name" 		=> "Menu text color",
						"desc" 		=> "",
						"id" 		=> "menu_color",
						"std" 		=> "#DDDDDD",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Menu Active Color",
						"desc" 		=> "For menu mouseover and active text color",
						"id" 		=> "menu_hover_color",
						"std" 		=> "#FFFFFF",
						"type" 		=> "color"
				);
				
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "button_style",
					"std" => "<h3 style='margin: 0;'>Active Style</h3>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( 	"name" 		=> "Active Background Color",
						"desc" 		=> "",
						"id" 		=> "active_bg_color",
						"std" 		=> "#f6499a",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Active Text Color",
						"desc" 		=> "",
						"id" 		=> "active_color",
						"std" 		=> "#EEEEEE",
						"type" 		=> "color"
				);					
$of_options[] = array( 	"name" 		=> "Active Background Hover Color",
						"desc" 		=> "",
						"id" 		=> "active_bg_hover",
						"std" 		=> "#FFFFFF",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Active Text Hover Color",
						"desc" 		=> "",
						"id" 		=> "active_hover_color",
						"std" 		=> "#EEEEEE",
						"type" 		=> "color"
				);
				
					

								
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "link_style",
					"std" => "<h3 style='margin: 0;'>Link Style</h3>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( 	"name" 		=> "Link Color",
						"desc" 		=> "Link Color",
						"id" 		=> "link_color",
						"std" 		=> "#DDDDDD",
						"type" 		=> "color"
				);
					
$of_options[] = array( 	"name" 		=> "Link Hover Color",
						"desc" 		=> "Link hover(mouse over) color",
						"id" 		=> "link_hover_color",
						"std" 		=> "#EEEEEE",
						"type" 		=> "color"
				);				
		
				
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "input_style",
					"std" => "<h3 style='margin: 0;'>Input Style</h3>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( 	"name" 		=> "Inputs Background Color",
						"desc" 		=> "Background color of input type text, email, html, number, textarea etc",
						"id" 		=> "input_bg",
						"std" 		=> "#1a1a21",
						"type" 		=> "color"
				);
					
$of_options[] = array( 	"name" 		=> "Inputs Text Color",
						"desc" 		=> "Text color of input type text, email, html, number, textarea etc",
						"id" 		=> "input_color",
						"std" 		=> "#CCCCCC",
						"type" 		=> "color"
				);	
				
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "footer_style",
					"std" => "<h3 style='margin: 0;'>Footer Style</h3>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( 	"name" 		=> "Footer Background Color",
						"desc" 		=> "Pick a background color for the footer.",
						"id" 		=> "footer_bg",
						"std" 		=> "#000000",
						"type" 		=> "color"
				);
					
$of_options[] = array( 	"name" 		=> "Footer Text Color",
						"desc" 		=> "Pick a background color for footer text",
						"id" 		=> "footer_color",
						"std" 		=> "#FFFFFF",
						"type" 		=> "color"
				);	

$of_options[] = array( 	"name" 		=> "Footer Player Icon Color",
						"desc" 		=> "Pick a background color for the footer player icons.",
						"id" 		=> "footer_player_color",
						"std" 		=> "#ccc",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Footer Player Background Color",
						"desc" 		=> "Pick a background color for the footer player.",
						"id" 		=> "footer_player_bg",
						"std" 		=> "#283541",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Footer player background image",
						"id" 		=> "footer_player_bg_img",
						"type" 		=> "upload",
				);

$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
						"id" 		=> "custom_css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);

//slider option
$of_options[] = array( 	"name" 		=> "Body Background",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Body Background Color",
						"desc" 		=> "Pick body background color",
						"id" 		=> "body_bg_color",
						"std" 		=> "#FFFFFF",
						"type" 		=> "color"
				);	
				
				
$of_options[] = array( "name" => "Body Background Image",
					"desc" => "Will be applied to the whole site",
					"id" => "body_bg_image",
					"std" => "",
					"type" => "upload");

$of_options[] = array( 	"name" 		=> "Background Image repeat",
						"desc" 		=> "",
						"id" 		=> "body_bg_repeat",
						"std" 		=> "",
						"type" 		=> "select",
						"options" 	=> array(
							"no-repeat" 	=> "No repeat",
							"repeat" 		=> "Repeat",
							"repeat-x" 		=> "Repeat horizontally",
							"repeat-y" 		=> "Repeat vertically",
						),
				);						
					
				
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "slideshow_option",
					"std" => "<h3 style='margin: 0;'>Background Slide show options (Slider is on if body background image is empty.)</h3>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( 	"name" 		=> "Slides",
						"desc" 		=> "Add slides",
						"id" 		=> "supersized_slider",
						"std" 		=> "",
						"type" 		=> "slider"
				);	

				
$of_options[] = array( 	"name" 		=> "Slideshow",
						"desc" 		=> "",
						"id" 		=> "slideshow",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Slide Interval",
						"desc" 		=> "",
						"id" 		=> "slide_interval",
						"type" 		=> "select",
						"options" 	=> $seconds
				);	

$of_options[] = array( 	"name" 		=> "Transition style",
						"desc" 		=> "",
						"id" 		=> "transition",
						"std" 		=> "Carousel Left",
						"type" 		=> "select",
						"options" 	=> $transitions
				);	
				
$of_options[] = array( 	"name" 		=> "Transition Speed",
						"desc" 		=> "",
						"id" 		=> "transition_speed",
						"std" 		=> "1 Second",
						"type" 		=> "select",
						"options" 	=> $transition_speed
				);	

$of_options[] = array( 	"name" 		=> "Music player",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "music_settings.png"
				);				
$of_options[] = array( 	"name" 		=> "Song List",
						"desc" 		=> "Add files",
						"id" 		=> "song_list",
						"std" 		=> "",
						"type" 		=> "audio"
				);	
				
$of_options[] = array( 	"name" 		=> "Turn on/off player",
						"desc" 		=> "",
						"id" 		=> "player-switch",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Auto Play On Load",
						"desc" 		=> "",
						"id" 		=> "audio-autoplay",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Toggle playlist on load",
						"desc" 		=> "",
						"id" 		=> "audio-playlist-toggle",
						"std" 		=> 1,
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Sidebar Generator",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "sidebar.png"
				);				
$of_options[] = array( 	"name" 		=> "Sidebars",
						"desc" 		=> "Add sidebar",
						"id" 		=> "sidebars",
						"std" 		=> "",
						"type" 		=> "sidebar"
				);					
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-backup.png"
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
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box      with the one from another install and click "Import Options".',
				);
/*				
// Backup Options
$of_options[] = array( 	"name" 		=> "Update Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "update.png"
				);
$of_options[] = array( 	"name" 		=> "Your envato username",
						"desc" 		=> "",
						"id" 		=> "buyer_username",
						"type" 		=> "text"
				);	
$of_options[] = array( 	"name" 		=> "Your API",
						"desc" 		=> "",
						"id" 		=> "buyer_api",
						"type" 		=> "text"
				);				
*/			
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
