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
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

		$google_fonts = array(
			"none" => "Select a font",//please, always use this key: "none"
            'ABeeZee' => 'ABeeZee',
            'Abel' => 'Abel',
            'Abril Fatface' => 'Abril Fatface',
            'Aclonica' => 'Aclonica',
            'Acme' => 'Acme',
            'Actor' => 'Actor',
            'Adamina' => 'Adamina',
            'Advent Pro' => 'Advent Pro',
            'Aguafina Script' => 'Aguafina Script',
            'Akronim' => 'Akronim',
            'Aladin' => 'Aladin',
            'Aldrich' => 'Aldrich',
            'Alef' => 'Alef',
            'Alegreya' => 'Alegreya',
            'Alegreya SC' => 'Alegreya SC',
            'Alegreya Sans' => 'Alegreya Sans',
            'Alegreya Sans SC' => 'Alegreya Sans SC',
            'Alex Brush' => 'Alex Brush',
            'Alfa Slab One' => 'Alfa Slab One',
            'Alice' => 'Alice',
            'Alike' => 'Alike',
            'Alike Angular' => 'Alike Angular',
            'Allan' => 'Allan',
            'Allerta' => 'Allerta',
            'Allerta Stencil' => 'Allerta Stencil',
            'Allura' => 'Allura',
            'Almendra' => 'Almendra',
            'Almendra Display' => 'Almendra Display',
            'Almendra SC' => 'Almendra SC',
            'Amarante' => 'Amarante',
            'Amaranth' => 'Amaranth',
            'Amatic SC' => 'Amatic SC',
            'Amethysta' => 'Amethysta',
            'Anaheim' => 'Anaheim',
            'Andada' => 'Andada',
            'Andika' => 'Andika',
            'Angkor' => 'Angkor',
            'Annie Use Your Telescope' => 'Annie Use Your Telescope',
            'Anonymous Pro' => 'Anonymous Pro',
            'Antic' => 'Antic',
            'Antic Didone' => 'Antic Didone',
            'Antic Slab' => 'Antic Slab',
            'Anton' => 'Anton',
            'Arapey' => 'Arapey',
            'Arbutus' => 'Arbutus',
            'Arbutus Slab' => 'Arbutus Slab',
            'Architects Daughter' => 'Architects Daughter',
            'Archivo Black' => 'Archivo Black',
            'Archivo Narrow' => 'Archivo Narrow',
            'Arimo' => 'Arimo',
            'Arizonia' => 'Arizonia',
            'Armata' => 'Armata',
            'Artifika' => 'Artifika',
            'Arvo' => 'Arvo',
            'Asap' => 'Asap',
            'Asset' => 'Asset',
            'Astloch' => 'Astloch',
            'Asul' => 'Asul',
            'Atomic Age' => 'Atomic Age',
            'Aubrey' => 'Aubrey',
            'Audiowide' => 'Audiowide',
            'Autour One' => 'Autour One',
            'Average' => 'Average',
            'Average Sans' => 'Average Sans',
            'Averia Gruesa Libre' => 'Averia Gruesa Libre',
            'Averia Libre' => 'Averia Libre',
            'Averia Sans Libre' => 'Averia Sans Libre',
            'Averia Serif Libre' => 'Averia Serif Libre',
            'Bad Script' => 'Bad Script',
            'Balthazar' => 'Balthazar',
            'Bangers' => 'Bangers',
            'Basic' => 'Basic',
            'Battambang' => 'Battambang',
            'Baumans' => 'Baumans',
            'Bayon' => 'Bayon',
            'Belgrano' => 'Belgrano',
            'Belleza' => 'Belleza',
            'BenchNine' => 'BenchNine',
            'Bentham' => 'Bentham',
            'Berkshire Swash' => 'Berkshire Swash',
            'Bevan' => 'Bevan',
            'Bigelow Rules' => 'Bigelow Rules',
            'Bigshot One' => 'Bigshot One',
            'Bilbo' => 'Bilbo',
            'Bilbo Swash Caps' => 'Bilbo Swash Caps',
            'Bitter' => 'Bitter',
            'Black Ops One' => 'Black Ops One',
            'Bokor' => 'Bokor',
            'Bonbon' => 'Bonbon',
            'Boogaloo' => 'Boogaloo',
            'Bowlby One' => 'Bowlby One',
            'Bowlby One SC' => 'Bowlby One SC',
            'Brawler' => 'Brawler',
            'Bree Serif' => 'Bree Serif',
            'Bubblegum Sans' => 'Bubblegum Sans',
            'Bubbler One' => 'Bubbler One',
            'Buda' => 'Buda',
            'Buenard' => 'Buenard',
            'Butcherman' => 'Butcherman',
            'Butterfly Kids' => 'Butterfly Kids',
            'Cabin' => 'Cabin',
            'Cabin Condensed' => 'Cabin Condensed',
            'Cabin Sketch' => 'Cabin Sketch',
            'Caesar Dressing' => 'Caesar Dressing',
            'Cagliostro' => 'Cagliostro',
            'Calligraffitti' => 'Calligraffitti',
            'Cambo' => 'Cambo',
            'Candal' => 'Candal',
            'Cantarell' => 'Cantarell',
            'Cantata One' => 'Cantata One',
            'Cantora One' => 'Cantora One',
            'Capriola' => 'Capriola',
            'Cardo' => 'Cardo',
            'Carme' => 'Carme',
            'Carrois Gothic' => 'Carrois Gothic',
            'Carrois Gothic SC' => 'Carrois Gothic SC',
            'Carter One' => 'Carter One',
            'Caudex' => 'Caudex',
            'Cedarville Cursive' => 'Cedarville Cursive',
            'Ceviche One' => 'Ceviche One',
            'Changa One' => 'Changa One',
            'Chango' => 'Chango',
            'Chau Philomene One' => 'Chau Philomene One',
            'Chela One' => 'Chela One',
            'Chelsea Market' => 'Chelsea Market',
            'Chenla' => 'Chenla',
            'Cherry Cream Soda' => 'Cherry Cream Soda',
            'Cherry Swash' => 'Cherry Swash',
            'Chewy' => 'Chewy',
            'Chicle' => 'Chicle',
            'Chivo' => 'Chivo',
            'Cinzel' => 'Cinzel',
            'Cinzel Decorative' => 'Cinzel Decorative',
            'Clicker Script' => 'Clicker Script',
            'Coda' => 'Coda',
            'Coda Caption' => 'Coda Caption',
            'Codystar' => 'Codystar',
            'Combo' => 'Combo',
            'Comfortaa' => 'Comfortaa',
            'Coming Soon' => 'Coming Soon',
            'Concert One' => 'Concert One',
            'Condiment' => 'Condiment',
            'Content' => 'Content',
            'Contrail One' => 'Contrail One',
            'Convergence' => 'Convergence',
            'Cookie' => 'Cookie',
            'Copse' => 'Copse',
            'Corben' => 'Corben',
            'Courgette' => 'Courgette',
            'Cousine' => 'Cousine',
            'Coustard' => 'Coustard',
            'Covered By Your Grace' => 'Covered By Your Grace',
            'Crafty Girls' => 'Crafty Girls',
            'Creepster' => 'Creepster',
            'Crete Round' => 'Crete Round',
            'Crimson Text' => 'Crimson Text',
            'Croissant One' => 'Croissant One',
            'Crushed' => 'Crushed',
            'Cuprum' => 'Cuprum',
            'Cutive' => 'Cutive',
            'Cutive Mono' => 'Cutive Mono',
            'Damion' => 'Damion',
            'Dancing Script' => 'Dancing Script',
            'Dangrek' => 'Dangrek',
            'Dawning of a New Day' => 'Dawning of a New Day',
            'Days One' => 'Days One',
            'Delius' => 'Delius',
            'Delius Swash Caps' => 'Delius Swash Caps',
            'Delius Unicase' => 'Delius Unicase',
            'Della Respira' => 'Della Respira',
            'Denk One' => 'Denk One',
            'Devonshire' => 'Devonshire',
            'Didact Gothic' => 'Didact Gothic',
            'Diplomata' => 'Diplomata',
            'Diplomata SC' => 'Diplomata SC',
            'Domine' => 'Domine',
            'Donegal One' => 'Donegal One',
            'Doppio One' => 'Doppio One',
            'Dorsa' => 'Dorsa',
            'Dosis' => 'Dosis',
            'Dr Sugiyama' => 'Dr Sugiyama',
            'Droid Sans' => 'Droid Sans',
            'Droid Sans Mono' => 'Droid Sans Mono',
            'Droid Serif' => 'Droid Serif',
            'Duru Sans' => 'Duru Sans',
            'Dynalight' => 'Dynalight',
            'EB Garamond' => 'EB Garamond',
            'Eagle Lake' => 'Eagle Lake',
            'Eater' => 'Eater',
            'Economica' => 'Economica',
            'Electrolize' => 'Electrolize',
            'Elsie' => 'Elsie',
            'Elsie Swash Caps' => 'Elsie Swash Caps',
            'Emblema One' => 'Emblema One',
            'Emilys Candy' => 'Emilys Candy',
            'Engagement' => 'Engagement',
            'Englebert' => 'Englebert',
            'Enriqueta' => 'Enriqueta',
            'Erica One' => 'Erica One',
            'Esteban' => 'Esteban',
            'Euphoria Script' => 'Euphoria Script',
            'Ewert' => 'Ewert',
            'Exo' => 'Exo',
            'Exo 2' => 'Exo 2',
            'Expletus Sans' => 'Expletus Sans',
            'Fanwood Text' => 'Fanwood Text',
            'Fascinate' => 'Fascinate',
            'Fascinate Inline' => 'Fascinate Inline',
            'Faster One' => 'Faster One',
            'Fasthand' => 'Fasthand',
            'Fauna One' => 'Fauna One',
            'Federant' => 'Federant',
            'Federo' => 'Federo',
            'Felipa' => 'Felipa',
            'Fenix' => 'Fenix',
            'Finger Paint' => 'Finger Paint',
            'Fjalla One' => 'Fjalla One',
            'Fjord One' => 'Fjord One',
            'Flamenco' => 'Flamenco',
            'Flavors' => 'Flavors',
            'Fondamento' => 'Fondamento',
            'Fontdiner Swanky' => 'Fontdiner Swanky',
            'Forum' => 'Forum',
            'Francois One' => 'Francois One',
            'Freckle Face' => 'Freckle Face',
            'Fredericka the Great' => 'Fredericka the Great',
            'Fredoka One' => 'Fredoka One',
            'Freehand' => 'Freehand',
            'Fresca' => 'Fresca',
            'Frijole' => 'Frijole',
            'Fruktur' => 'Fruktur',
            'Fugaz One' => 'Fugaz One',
            'GFS Didot' => 'GFS Didot',
            'GFS Neohellenic' => 'GFS Neohellenic',
            'Gabriela' => 'Gabriela',
            'Gafata' => 'Gafata',
            'Galdeano' => 'Galdeano',
            'Galindo' => 'Galindo',
            'Gentium Basic' => 'Gentium Basic',
            'Gentium Book Basic' => 'Gentium Book Basic',
            'Geo' => 'Geo',
            'Geostar' => 'Geostar',
            'Geostar Fill' => 'Geostar Fill',
            'Germania One' => 'Germania One',
            'Gilda Display' => 'Gilda Display',
            'Give You Glory' => 'Give You Glory',
            'Glass Antiqua' => 'Glass Antiqua',
            'Glegoo' => 'Glegoo',
            'Gloria Hallelujah' => 'Gloria Hallelujah',
            'Goblin One' => 'Goblin One',
            'Gochi Hand' => 'Gochi Hand',
            'Gorditas' => 'Gorditas',
            'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
            'Graduate' => 'Graduate',
            'Grand Hotel' => 'Grand Hotel',
            'Gravitas One' => 'Gravitas One',
            'Great Vibes' => 'Great Vibes',
            'Griffy' => 'Griffy',
            'Gruppo' => 'Gruppo',
            'Gudea' => 'Gudea',
            'Habibi' => 'Habibi',
            'Hammersmith One' => 'Hammersmith One',
            'Hanalei' => 'Hanalei',
            'Hanalei Fill' => 'Hanalei Fill',
            'Handlee' => 'Handlee',
            'Hanuman' => 'Hanuman',
            'Happy Monkey' => 'Happy Monkey',
            'Headland One' => 'Headland One',
            'Henny Penny' => 'Henny Penny',
            'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
            'Holtwood One SC' => 'Holtwood One SC',
            'Homemade Apple' => 'Homemade Apple',
            'Homenaje' => 'Homenaje',
            'IM Fell DW Pica' => 'IM Fell DW Pica',
            'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
            'IM Fell Double Pica' => 'IM Fell Double Pica',
            'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
            'IM Fell English' => 'IM Fell English',
            'IM Fell English SC' => 'IM Fell English SC',
            'IM Fell French Canon' => 'IM Fell French Canon',
            'IM Fell French Canon SC' => 'IM Fell French Canon SC',
            'IM Fell Great Primer' => 'IM Fell Great Primer',
            'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
            'Iceberg' => 'Iceberg',
            'Iceland' => 'Iceland',
            'Imprima' => 'Imprima',
            'Inconsolata' => 'Inconsolata',
            'Inder' => 'Inder',
            'Indie Flower' => 'Indie Flower',
            'Inika' => 'Inika',
            'Irish Grover' => 'Irish Grover',
            'Istok Web' => 'Istok Web',
            'Italiana' => 'Italiana',
            'Italianno' => 'Italianno',
            'Jacques Francois' => 'Jacques Francois',
            'Jacques Francois Shadow' => 'Jacques Francois Shadow',
            'Jim Nightshade' => 'Jim Nightshade',
            'Jockey One' => 'Jockey One',
            'Jolly Lodger' => 'Jolly Lodger',
            'Josefin Sans' => 'Josefin Sans',
            'Josefin Slab' => 'Josefin Slab',
            'Joti One' => 'Joti One',
            'Judson' => 'Judson',
            'Julee' => 'Julee',
            'Julius Sans One' => 'Julius Sans One',
            'Junge' => 'Junge',
            'Jura' => 'Jura',
            'Just Another Hand' => 'Just Another Hand',
            'Just Me Again Down Here' => 'Just Me Again Down Here',
            'Kameron' => 'Kameron',
            'Kantumruy' => 'Kantumruy',
            'Karla' => 'Karla',
            'Kaushan Script' => 'Kaushan Script',
            'Kavoon' => 'Kavoon',
            'Kdam Thmor' => 'Kdam Thmor',
            'Keania One' => 'Keania One',
            'Kelly Slab' => 'Kelly Slab',
            'Kenia' => 'Kenia',
            'Khmer' => 'Khmer',
            'Kite One' => 'Kite One',
            'Knewave' => 'Knewave',
            'Kotta One' => 'Kotta One',
            'Koulen' => 'Koulen',
            'Kranky' => 'Kranky',
            'Kreon' => 'Kreon',
            'Kristi' => 'Kristi',
            'Krona One' => 'Krona One',
            'La Belle Aurore' => 'La Belle Aurore',
            'Lancelot' => 'Lancelot',
            'Lato' => 'Lato',
            'League Script' => 'League Script',
            'Leckerli One' => 'Leckerli One',
            'Ledger' => 'Ledger',
            'Lekton' => 'Lekton',
            'Lemon' => 'Lemon',
            'Libre Baskerville' => 'Libre Baskerville',
            'Life Savers' => 'Life Savers',
            'Lilita One' => 'Lilita One',
            'Lily Script One' => 'Lily Script One',
            'Limelight' => 'Limelight',
            'Linden Hill' => 'Linden Hill',
            'Lobster' => 'Lobster',
            'Lobster Two' => 'Lobster Two',
            'Londrina Outline' => 'Londrina Outline',
            'Londrina Shadow' => 'Londrina Shadow',
            'Londrina Sketch' => 'Londrina Sketch',
            'Londrina Solid' => 'Londrina Solid',
            'Lora' => 'Lora',
            'Love Ya Like A Sister' => 'Love Ya Like A Sister',
            'Loved by the King' => 'Loved by the King',
            'Lovers Quarrel' => 'Lovers Quarrel',
            'Luckiest Guy' => 'Luckiest Guy',
            'Lusitana' => 'Lusitana',
            'Lustria' => 'Lustria',
            'Macondo' => 'Macondo',
            'Macondo Swash Caps' => 'Macondo Swash Caps',
            'Magra' => 'Magra',
            'Maiden Orange' => 'Maiden Orange',
            'Mako' => 'Mako',
            'Marcellus' => 'Marcellus',
            'Marcellus SC' => 'Marcellus SC',
            'Marck Script' => 'Marck Script',
            'Margarine' => 'Margarine',
            'Marko One' => 'Marko One',
            'Marmelad' => 'Marmelad',
            'Marvel' => 'Marvel',
            'Mate' => 'Mate',
            'Mate SC' => 'Mate SC',
            'Maven Pro' => 'Maven Pro',
            'McLaren' => 'McLaren',
            'Meddon' => 'Meddon',
            'MedievalSharp' => 'MedievalSharp',
            'Medula One' => 'Medula One',
            'Megrim' => 'Megrim',
            'Meie Script' => 'Meie Script',
            'Merienda' => 'Merienda',
            'Merienda One' => 'Merienda One',
            'Merriweather' => 'Merriweather',
            'Merriweather Sans' => 'Merriweather Sans',
            'Metal' => 'Metal',
            'Metal Mania' => 'Metal Mania',
            'Metamorphous' => 'Metamorphous',
            'Metrophobic' => 'Metrophobic',
            'Michroma' => 'Michroma',
            'Milonga' => 'Milonga',
            'Miltonian' => 'Miltonian',
            'Miltonian Tattoo' => 'Miltonian Tattoo',
            'Miniver' => 'Miniver',
            'Miss Fajardose' => 'Miss Fajardose',
            'Modern Antiqua' => 'Modern Antiqua',
            'Molengo' => 'Molengo',
            'Molle' => 'Molle',
            'Monda' => 'Monda',
            'Monofett' => 'Monofett',
            'Monoton' => 'Monoton',
            'Monsieur La Doulaise' => 'Monsieur La Doulaise',
            'Montaga' => 'Montaga',
            'Montez' => 'Montez',
            'Montserrat' => 'Montserrat',
            'Montserrat Alternates' => 'Montserrat Alternates',
            'Montserrat Subrayada' => 'Montserrat Subrayada',
            'Moul' => 'Moul',
            'Moulpali' => 'Moulpali',
            'Mountains of Christmas' => 'Mountains of Christmas',
            'Mouse Memoirs' => 'Mouse Memoirs',
            'Mr Bedfort' => 'Mr Bedfort',
            'Mr Dafoe' => 'Mr Dafoe',
            'Mr De Haviland' => 'Mr De Haviland',
            'Mrs Saint Delafield' => 'Mrs Saint Delafield',
            'Mrs Sheppards' => 'Mrs Sheppards',
            'Muli' => 'Muli',
            'Mystery Quest' => 'Mystery Quest',
            'Neucha' => 'Neucha',
            'Neuton' => 'Neuton',
            'New Rocker' => 'New Rocker',
            'News Cycle' => 'News Cycle',
            'Niconne' => 'Niconne',
            'Nixie One' => 'Nixie One',
            'Nobile' => 'Nobile',
            'Nokora' => 'Nokora',
            'Norican' => 'Norican',
            'Nosifer' => 'Nosifer',
            'Nothing You Could Do' => 'Nothing You Could Do',
            'Noticia Text' => 'Noticia Text',
            'Noto Sans' => 'Noto Sans',
            'Noto Serif' => 'Noto Serif',
            'Nova Cut' => 'Nova Cut',
            'Nova Flat' => 'Nova Flat',
            'Nova Mono' => 'Nova Mono',
            'Nova Oval' => 'Nova Oval',
            'Nova Round' => 'Nova Round',
            'Nova Script' => 'Nova Script',
            'Nova Slim' => 'Nova Slim',
            'Nova Square' => 'Nova Square',
            'Numans' => 'Numans',
            'Nunito' => 'Nunito',
            'Odor Mean Chey' => 'Odor Mean Chey',
            'Offside' => 'Offside',
            'Old Standard TT' => 'Old Standard TT',
            'Oldenburg' => 'Oldenburg',
            'Oleo Script' => 'Oleo Script',
            'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
            'Open Sans' => 'Open Sans',
            'Open Sans Condensed' => 'Open Sans Condensed',
            'Oranienbaum' => 'Oranienbaum',
            'Orbitron' => 'Orbitron',
            'Oregano' => 'Oregano',
            'Orienta' => 'Orienta',
            'Original Surfer' => 'Original Surfer',
            'Oswald' => 'Oswald',
            'Over the Rainbow' => 'Over the Rainbow',
            'Overlock' => 'Overlock',
            'Overlock SC' => 'Overlock SC',
            'Ovo' => 'Ovo',
            'Oxygen' => 'Oxygen',
            'Oxygen Mono' => 'Oxygen Mono',
            'PT Mono' => 'PT Mono',
            'PT Sans' => 'PT Sans',
            'PT Sans Caption' => 'PT Sans Caption',
            'PT Sans Narrow' => 'PT Sans Narrow',
            'PT Serif' => 'PT Serif',
            'PT Serif Caption' => 'PT Serif Caption',
            'Pacifico' => 'Pacifico',
            'Paprika' => 'Paprika',
            'Parisienne' => 'Parisienne',
            'Passero One' => 'Passero One',
            'Passion One' => 'Passion One',
            'Pathway Gothic One' => 'Pathway Gothic One',
            'Patrick Hand' => 'Patrick Hand',
            'Patrick Hand SC' => 'Patrick Hand SC',
            'Patua One' => 'Patua One',
            'Paytone One' => 'Paytone One',
            'Peralta' => 'Peralta',
            'Permanent Marker' => 'Permanent Marker',
            'Petit Formal Script' => 'Petit Formal Script',
            'Petrona' => 'Petrona',
            'Philosopher' => 'Philosopher',
            'Piedra' => 'Piedra',
            'Pinyon Script' => 'Pinyon Script',
            'Pirata One' => 'Pirata One',
            'Plaster' => 'Plaster',
            'Play' => 'Play',
            'Playball' => 'Playball',
            'Playfair Display' => 'Playfair Display',
            'Playfair Display SC' => 'Playfair Display SC',
            'Podkova' => 'Podkova',
            'Poiret One' => 'Poiret One',
            'Poller One' => 'Poller One',
            'Poly' => 'Poly',
            'Pompiere' => 'Pompiere',
            'Pontano Sans' => 'Pontano Sans',
            'Port Lligat Sans' => 'Port Lligat Sans',
            'Port Lligat Slab' => 'Port Lligat Slab',
            'Prata' => 'Prata',
            'Preahvihear' => 'Preahvihear',
            'Press Start 2P' => 'Press Start 2P',
            'Princess Sofia' => 'Princess Sofia',
            'Prociono' => 'Prociono',
            'Prosto One' => 'Prosto One',
            'Puritan' => 'Puritan',
            'Purple Purse' => 'Purple Purse',
            'Quando' => 'Quando',
            'Quantico' => 'Quantico',
            'Quattrocento' => 'Quattrocento',
            'Quattrocento Sans' => 'Quattrocento Sans',
            'Questrial' => 'Questrial',
            'Quicksand' => 'Quicksand',
            'Quintessential' => 'Quintessential',
            'Qwigley' => 'Qwigley',
            'Racing Sans One' => 'Racing Sans One',
            'Radley' => 'Radley',
            'Raleway' => 'Raleway',
            'Raleway Dots' => 'Raleway Dots',
            'Rambla' => 'Rambla',
            'Rammetto One' => 'Rammetto One',
            'Ranchers' => 'Ranchers',
            'Rancho' => 'Rancho',
            'Rationale' => 'Rationale',
            'Redressed' => 'Redressed',
            'Reenie Beanie' => 'Reenie Beanie',
            'Revalia' => 'Revalia',
            'Ribeye' => 'Ribeye',
            'Ribeye Marrow' => 'Ribeye Marrow',
            'Righteous' => 'Righteous',
            'Risque' => 'Risque',
            'Roboto' => 'Roboto',
            'Roboto Condensed' => 'Roboto Condensed',
            'Roboto Slab' => 'Roboto Slab',
            'Rochester' => 'Rochester',
            'Rock Salt' => 'Rock Salt',
            'Rokkitt' => 'Rokkitt',
            'Romanesco' => 'Romanesco',
            'Ropa Sans' => 'Ropa Sans',
            'Rosario' => 'Rosario',
            'Rosarivo' => 'Rosarivo',
            'Rouge Script' => 'Rouge Script',
            'Ruda' => 'Ruda',
            'Rufina' => 'Rufina',
            'Ruge Boogie' => 'Ruge Boogie',
            'Ruluko' => 'Ruluko',
            'Rum Raisin' => 'Rum Raisin',
            'Ruslan Display' => 'Ruslan Display',
            'Russo One' => 'Russo One',
            'Ruthie' => 'Ruthie',
            'Rye' => 'Rye',
            'Sacramento' => 'Sacramento',
            'Sail' => 'Sail',
            'Salsa' => 'Salsa',
            'Sanchez' => 'Sanchez',
            'Sancreek' => 'Sancreek',
            'Sansita One' => 'Sansita One',
            'Sarina' => 'Sarina',
            'Satisfy' => 'Satisfy',
            'Scada' => 'Scada',
            'Schoolbell' => 'Schoolbell',
            'Seaweed Script' => 'Seaweed Script',
            'Sevillana' => 'Sevillana',
            'Seymour One' => 'Seymour One',
            'Shadows Into Light' => 'Shadows Into Light',
            'Shadows Into Light Two' => 'Shadows Into Light Two',
            'Shanti' => 'Shanti',
            'Share' => 'Share',
            'Share Tech' => 'Share Tech',
            'Share Tech Mono' => 'Share Tech Mono',
            'Shojumaru' => 'Shojumaru',
            'Short Stack' => 'Short Stack',
            'Siemreap' => 'Siemreap',
            'Sigmar One' => 'Sigmar One',
            'Signika' => 'Signika',
            'Signika Negative' => 'Signika Negative',
            'Simonetta' => 'Simonetta',
            'Sintony' => 'Sintony',
            'Sirin Stencil' => 'Sirin Stencil',
            'Six Caps' => 'Six Caps',
            'Skranji' => 'Skranji',
            'Slackey' => 'Slackey',
            'Smokum' => 'Smokum',
            'Smythe' => 'Smythe',
            'Sniglet' => 'Sniglet',
            'Snippet' => 'Snippet',
            'Snowburst One' => 'Snowburst One',
            'Sofadi One' => 'Sofadi One',
            'Sofia' => 'Sofia',
            'Sonsie One' => 'Sonsie One',
            'Sorts Mill Goudy' => 'Sorts Mill Goudy',
            'Source Code Pro' => 'Source Code Pro',
            'Source Sans Pro' => 'Source Sans Pro',
            'Special Elite' => 'Special Elite',
            'Spicy Rice' => 'Spicy Rice',
            'Spinnaker' => 'Spinnaker',
            'Spirax' => 'Spirax',
            'Squada One' => 'Squada One',
            'Stalemate' => 'Stalemate',
            'Stalinist One' => 'Stalinist One',
            'Stardos Stencil' => 'Stardos Stencil',
            'Stint Ultra Condensed' => 'Stint Ultra Condensed',
            'Stint Ultra Expanded' => 'Stint Ultra Expanded',
            'Stoke' => 'Stoke',
            'Strait' => 'Strait',
            'Sue Ellen Francisco' => 'Sue Ellen Francisco',
            'Sunshiney' => 'Sunshiney',
            'Supermercado One' => 'Supermercado One',
            'Suwannaphum' => 'Suwannaphum',
            'Swanky and Moo Moo' => 'Swanky and Moo Moo',
            'Syncopate' => 'Syncopate',
            'Tangerine' => 'Tangerine',
            'Taprom' => 'Taprom',
            'Tauri' => 'Tauri',
            'Telex' => 'Telex',
            'Tenor Sans' => 'Tenor Sans',
            'Text Me One' => 'Text Me One',
            'The Girl Next Door' => 'The Girl Next Door',
            'Tienne' => 'Tienne',
            'Tinos' => 'Tinos',
            'Titan One' => 'Titan One',
            'Titillium Web' => 'Titillium Web',
            'Trade Winds' => 'Trade Winds',
            'Trocchi' => 'Trocchi',
            'Trochut' => 'Trochut',
            'Trykker' => 'Trykker',
            'Tulpen One' => 'Tulpen One',
            'Ubuntu' => 'Ubuntu',
            'Ubuntu Condensed' => 'Ubuntu Condensed',
            'Ubuntu Mono' => 'Ubuntu Mono',
            'Ultra' => 'Ultra',
            'Uncial Antiqua' => 'Uncial Antiqua',
            'Underdog' => 'Underdog',
            'Unica One' => 'Unica One',
            'UnifrakturCook' => 'UnifrakturCook',
            'UnifrakturMaguntia' => 'UnifrakturMaguntia',
            'Unkempt' => 'Unkempt',
            'Unlock' => 'Unlock',
            'Unna' => 'Unna',
            'VT323' => 'VT323',
            'Vampiro One' => 'Vampiro One',
            'Varela' => 'Varela',
            'Varela Round' => 'Varela Round',
            'Vast Shadow' => 'Vast Shadow',
            'Vibur' => 'Vibur',
            'Vidaloka' => 'Vidaloka',
            'Viga' => 'Viga',
            'Voces' => 'Voces',
            'Volkhov' => 'Volkhov',
            'Vollkorn' => 'Vollkorn',
            'Voltaire' => 'Voltaire',
            'Waiting for the Sunrise' => 'Waiting for the Sunrise',
            'Wallpoet' => 'Wallpoet',
            'Walter Turncoat' => 'Walter Turncoat',
            'Warnes' => 'Warnes',
            'Wellfleet' => 'Wellfleet',
            'Wendy One' => 'Wendy One',
            'Wire One' => 'Wire One',
            'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
            'Yellowtail' => 'Yellowtail',
            'Yeseva One' => 'Yeseva One',
            'Yesteryear' => 'Yesteryear',
            'Zeyada' => 'Zeyada',
        );

        $google_fonts_subsets = array(
            'latin' => 'latin',
            'latin-ext' => 'latin-ext',
            'cyrillic' => 'cyrillic',
            'cyrillic-ext' => 'cyrillic-ext',
            'greek' => 'greek',
            'greek-ext' => 'greek-ext',
            'vietnamese' => 'vietnamese',
            'khmer' => 'khmer',
        );

// Set the Options Array
global $of_options;
$of_options = array();


$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( "name" => "Preloader Screen",
	"desc" => "",
	"id" => "preloader",
	"type" => "select",
	"options" => array(
		'Shows Spinner 1' => 'Shows Spinner 1',
		'Shows Spinner 2' => 'Shows Spinner 2',
		'Shows Spinner 3' => 'Shows Spinner 3',
		'Shows Spinner 4' => 'Shows Spinner 4',
		'Shows Spinner 5' => 'Shows Spinner 5',
		'Shows Spinner 6' => 'Shows Spinner 6',
		'Shows Spinner 7' => 'Shows Spinner 7',
		'Disabled' => 'Disabled',
	)
);
	
$of_options[] = array( 	"name" 		=> "Logo Image",
	"desc" 		=> "Maximum size is 240px of height (also for retina displays)",
	"id" 		=> "custom_logo",
	"std" 		=> "",
	"type" 		=> "upload");

$of_options[] = array( "name" => "Logo Height",
    "desc" => "Enter value from 20 to 120 (px)",
    "id" => "logo_height",
    "std" => "50",
    "type" => "text");

$of_options[] = array( "name" => "Logo Height on mobiles",
    "desc" => "Enter value from 20 to 120 (px)",
    "id" => "logo_height_mobile",
    "std" => "30",
    "type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Display text instead of image",
	"id" => "logo_as_text",
	"std" => 1,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "Logo Text",
	"desc" => "",
	"id" => "logo_text",
	"std" => "GRATA",
	"fold" => "logo_as_text",
	"type" => "text");

$of_options[] = array( 	"name" 		=> "Favicon",
	"desc" => "Upload a 16px x 16px ICO/PNG/GIF image that will represent your website's favicon",
	"id" => "custom_favicon",
	"std" => "",
	"type" => "upload");

$of_options[] = array( "name" => "Custom HTML code",
	"desc" => "Paste your custom code here, it will be added into the footer section of your site. You can use JS code with &lt;script&gt;&lt;/script&gt; tags. Also you can add Google Analytics or other tracking code into this field.",
	"id" => "tracking_code",
	"std" => "",
	"type" => "textarea");

$of_options[] = array( "name" => "Styling",
	"type" => "heading");

$of_options[] = array( "name" =>  "Rounded Corners",
    "desc" => "Round corners of basic elements",
    "id" => "rounded_corners",
    "std" => 0,
    "type" => "switch");
	
$of_options[] = array( "name" =>  "Screen Borders",
    "desc" => "Add screen borders at One Page",
    "id" => "boxed_style",
    "std" => 0,
    "type" => "switch");
	
$of_options[] = array( "name" => "Predefined Color Style",
	"desc" => "",
	"id" => "color_scheme",
	"std" => "White Cyan",
	"type" => "select",
	"options" => array(
		'0' => 'White Alizarin',
		'1' => 'Nautical Knot',
		'2' => 'Mild Ocean',
		'5' => 'White Royal',
		'4' => 'Twilight',
		'3' => 'Black & White',
		));

/*--------------------------------------*/

$of_options[] = array( "name" => "Custom Color Style",
	"desc" => "Change <strong>Header</strong> colors",
	"id" => "change_header_colors",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" =>  "",
	"desc" => "Header Background Color",
	"id" => "header_bg",
	"std" => "#fff",
	"fold" => "change_header_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Menu Color",
	"id" => "menu_text",
	"std" => "#444",
	"fold" => "change_header_colors",
	"type" => "color");
	
$of_options[] = array( "name" =>  "",
	"desc" => "Menu Active Color",
	"id" => "menu_active_text",
	"std" => "#fe4641",
	"fold" => "change_header_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Menu Hover Color",
	"id" => "menu_hover_text",
	"std" => "#fda527",
	"fold" => "change_header_colors",
	"type" => "color");
	
$of_options[] = array( "name" =>  "",
	"desc" => "Dropdown Background Color",
	"id" => "drop_bg",
	"std" => "#fff",
	"fold" => "change_header_colors",
	"type" => "color");
	
$of_options[] = array( "name" =>  "",
	"desc" => "Dropdown Text Color",
	"id" => "drop_text",
	"std" => "#444",
	"fold" => "change_header_colors",
	"type" => "color");
	
$of_options[] = array( "name" =>  "",
	"desc" => "Dropdown Active Background Color",
	"id" => "drop_active_bg",
	"std" => "#fff",
	"fold" => "change_header_colors",
	"type" => "color");
	
$of_options[] = array( "name" =>  "",
	"desc" => "Dropdown Active Text Color",
	"id" => "drop_active_text",
	"std" => "#fe4641",
	"fold" => "change_header_colors",
	"type" => "color");
	
$of_options[] = array( "name" =>  "",
	"desc" => "Dropdown Hover Background Color",
	"id" => "drop_hover_bg",
	"std" => "#fff",
	"fold" => "change_header_colors",
	"type" => "color");
	
$of_options[] = array( "name" =>  "",
	"desc" => "Dropdown Hover Text Color",
	"id" => "drop_hover_text",
	"std" => "#fda527",
	"fold" => "change_header_colors",
	"type" => "color");

	
/*--------------------------------------*/

$of_options[] = array( "name" =>  "",
	"desc" => "Change <strong>Content</strong> colors",
	"id" => "change_main_content_colors",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" =>  "",
	"desc" => "Background Color",
	"id" => "main_bg",
	"std" => "#fff",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Border Color",
	"id" => "main_border",
	"std" => "#e5e5e5",
	"fold" => "change_main_content_colors",
	"type" => "color");
	
$of_options[] = array( "name" =>  "",
	"desc" => "Text Color",
	"id" => "main_text",
	"std" => "#444",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Primary Color (Link Color)",
	"id" => "main_primary",
	"std" => "#fe4641",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Secondary Color (Link Hover Color)",
	"id" => "main_secondary",
	"std" => "#fda527",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Faded Color",
	"id" => "main_faded",
	"std" => "#999",
	"fold" => "change_main_content_colors",
	"type" => "color");
	
/*--------------------------------------*/

$of_options[] = array( "name" =>  "",
	"desc" => "Change <strong>Footer</strong> colors",
	"id" => "change_footer_colors",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" =>  "",
	"desc" => "Background Color",
	"id" => "footer_bg",
	"std" => "#252525",
	"fold" => "change_footer_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Border Color",
	"id" => "footer_border",
	"std" => "#333",
	"fold" => "change_footer_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Text Color",
	"id" => "footer_text",
	"std" => "#999",
	"fold" => "change_footer_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Link Color",
	"id" => "footer_link",
	"std" => "#fe4641",
	"fold" => "change_footer_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Link Hover Color",
	"id" => "footer_link_hover",
	"std" => "#fda527",
	"fold" => "change_footer_colors",
	"type" => "color");

/*--------------------------------------------------------------------------*/

$of_options[] = array( 	"name" 		=> "Quick CSS",
	"desc" 		=> "Do not include <strong>&lt;pre&gt;&lt;/pre&gt;</strong> tags or any html tag in this field.",
	"id" 		=> "custom_css",
	"std" 		=> "",
	"type" 		=> "textarea"
);

$of_options[] = array(	"name" => "Header Options",
	"type"=> "heading");

$of_options[] = array( "name" => "Header Height",
    "desc" => "Enter value from 50 to 120 (px)",
    "id" => "header_height",
    "std" => "100",
    "type" => "text");

$of_options[] = array( "name" => "Header Height on mobiles",
    "desc" => "Enter value from 50 to 120 (px)",
    "id" => "header_height_mobile",
    "std" => "60",
    "type" => "text");

$of_options[] = array( "name" => "Full Width Header",
    "desc" => "Extend Header content to the width of the screen",
    "id" => "header_full_width",
    "std" => 0,
    "type" => "switch",
);

$of_options[] = array( "name" => "Sticky Header",
    "desc" => "Fix the Header on the top of pages during scroll",
    "id" => "header_is_sticky",
    "std" => 1,
    "folds" => 1,
    "type" => "switch");

$of_options[] = array( "name" => "Type of the initial Sticky Header",
    "desc" => "",
    "id" => "header_sticky_type",
    "std" => "Default",
    "type" => "select",
    "fold" => "header_is_sticky",
    "options" => array(
        'Default' => 'Default',
        'Transparent' => 'Transparent',
        'Hidden' => 'Hidden',
    ));

$of_options[] = array( "name" => "Mobile Menu Start Width",
	"desc" => "If screen width is less than this value, main menu transforms to mobile-friendly layout",
	"id" => "mobile_nav_width",
	"std" => "1000",
	"type" => "text");

$of_options[] = array( "name" => "Social Links",
	"desc" => "Display social links in the Header",
	"id" => "header_socials",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "Facebook",
    "desc" => "",
    "id" => "facebook_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Twitter",
    "desc" => "",
    "id" => "twitter_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Google+",
    "desc" => "",
    "id" => "google_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "LinkedIn",
    "desc" => "",
    "id" => "linkedin_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "YouTube",
    "desc" => "",
    "id" => "youtube_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Vimeo",
    "desc" => "",
    "id" => "vimeo_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Flickr",
    "desc" => "",
    "id" => "flickr_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Instagram",
    "desc" => "",
    "id" => "instagram_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Behance",
    "desc" => "",
    "id" => "behance_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Pinterest",
    "desc" => "",
    "id" => "pinterest_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Skype",
    "desc" => "",
    "id" => "skype_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Tumblr",
    "desc" => "",
    "id" => "tumblr_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Dribbble",
    "desc" => "",
    "id" => "dribbble_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Vkontakte",
    "desc" => "",
    "id" => "vk_header_link",
    "std" => "",
	"fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Xing",
    "desc" => "",
    "id" => "xing_header_link",
    "std" => "",
    "fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Yelp",
    "desc" => "",
    "id" => "yelp_header_link",
    "std" => "",
    "fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Twitch",
    "desc" => "",
    "id" => "twitch_header_link",
    "std" => "",
    "fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "SoundCloud",
    "desc" => "",
    "id" => "soundcloud_header_link",
    "std" => "",
    "fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "DeviantArt",
    "desc" => "",
    "id" => "deviantart_header_link",
    "std" => "",
    "fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "Foursquare",
    "desc" => "",
    "id" => "foursquare_header_link",
    "std" => "",
    "fold" => "header_socials",
    "type" => "text");

$of_options[] = array( "name" => "GitHub",
    "desc" => "",
    "id" => "github_header_link",
    "std" => "",
    "fold" => "header_socials",
    "type" => "text");
	
$of_options[] = array( "name" => "Title Bar Size",
    "desc" => "Set default size of Title Bar at all static pages",
    "id" => "header_layout_type",
    "std" => "Large",
    "type" => "select",
    "options" => array(
        'Large' => 'Large',
        'Compact' => 'Compact',
        'Ultra Compact' => 'Ultra Compact',
    ));


$of_options[] = array(	"name" => "Footer Options",
	"type"=> "heading");

$of_options[] = array( "name" => "Copyright Text",
	"desc" => "",
	"id" => "footer_copyright",
	"std" => "",
	"type" => "text");
	
$of_options[] = array( "name" => "Widgets Section",
	"desc" => "Display Widgets Section",
	"id" => "footer_show_widgets",
	"std" => 0,
	"type" => "switch");

$of_options[] = array( "name" => "Social Links",
	"desc" => "Display social links in the Footer",
	"id" => "footer_socials",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "Facebook",
	"desc" => "",
	"id" => "facebook_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Twitter",
	"desc" => "",
	"id" => "twitter_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Google+",
	"desc" => "",
	"id" => "google_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "LinkedIn",
	"desc" => "",
	"id" => "linkedin_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "YouTube",
	"desc" => "",
	"id" => "youtube_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Vimeo",
	"desc" => "",
	"id" => "vimeo_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Flickr",
	"desc" => "",
	"id" => "flickr_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Instagram",
	"desc" => "",
	"id" => "instagram_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Behance",
	"desc" => "",
	"id" => "behance_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Pinterest",
	"desc" => "",
	"id" => "pinterest_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Skype",
	"desc" => "",
	"id" => "skype_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Tumblr",
	"desc" => "",
	"id" => "tumblr_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Dribbble",
	"desc" => "",
	"id" => "dribbble_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Vkontakte",
	"desc" => "",
	"id" => "vk_link",
	"std" => "",
	"fold" => "footer_socials",
	"type" => "text");

$of_options[] = array( "name" => "Xing",
    "desc" => "",
    "id" => "xing_link",
    "std" => "",
    "fold" => "footer_socials",
    "type" => "text");

$of_options[] = array( "name" => "Yelp",
    "desc" => "",
    "id" => "yelp_link",
    "std" => "",
    "fold" => "footer_socials",
    "type" => "text");

$of_options[] = array( "name" => "Twitch",
    "desc" => "",
    "id" => "twitch_link",
    "std" => "",
    "fold" => "footer_socials",
    "type" => "text");

$of_options[] = array( "name" => "SoundCloud",
    "desc" => "",
    "id" => "soundcloud_link",
    "std" => "",
    "fold" => "footer_socials",
    "type" => "text");

$of_options[] = array( "name" => "DeviantArt",
    "desc" => "",
    "id" => "deviantart_link",
    "std" => "",
    "fold" => "footer_socials",
    "type" => "text");

$of_options[] = array( "name" => "Foursquare",
    "desc" => "",
    "id" => "foursquare_link",
    "std" => "",
    "fold" => "footer_socials",
    "type" => "text");

$of_options[] = array( "name" => "GitHub",
    "desc" => "",
    "id" => "github_link",
    "std" => "",
    "fold" => "footer_socials",
    "type" => "text");

$of_options[] = array( "name" => "Typography",
	"type" => "heading");

$of_options[] = array( 	"name" 		=> "Headings",
	"desc" 		=> "",
	"id" 		=> "heading_font",
	"std" 		=> "Open Sans",
	"type" 		=> "select_google_font",
	"preview" 	=> array(
		"text" => "Heading Font Preview", //this is the text from preview box
		"size" => "30px" //this is the text size from preview box
	),
	"options" 	=> $google_fonts,
);
$of_options[] = array( "name" => "",
    "desc" => "",
    "id" => "heading_weight",
    "std" => "",
    "type" => "select",
    "options" => array(
        'Normal (400) font weight' => 'Normal (400) font weight',
        'Light (300) font weight' => 'Light (300) font weight',
        'Bold (700) font weight' => 'Bold (700) font weight',
        'Semi-bold (600) font weight' => 'Semi-bold (600) font weight',
    ));

$of_options[] = array( "name" =>  "Sizes on Desktops",
    "desc" => "<strong>Mega Heading</strong> font size",
    "id" => "mega_fontsize",
    "std" => "80",
    "class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "Sizes on Mobiles",
    "desc" => "<strong>Mega Heading</strong> font size",
    "id" => "mega_fontsize_mobile",
    "std" => "40",
	"class" => "font",
    "type" => "text");

$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 1</strong> font size",
    "id" => "h1_fontsize",
    "std" => "46",
    "class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 1</strong> font size",
    "id" => "h1_fontsize_mobile",
    "std" => "30",
	"class" => "font",
    "type" => "text");

$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 2</strong> font size",
    "id" => "h2_fontsize",
    "std" => "40",
	"class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 2</strong> font size",
    "id" => "h2_fontsize_mobile",
    "std" => "26",
	"class" => "font",
    "type" => "text");

$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 3</strong> font size",
    "id" => "h3_fontsize",
    "std" => "32",
	"class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 3</strong> font size",
    "id" => "h3_fontsize_mobile",
    "std" => "22",
	"class" => "font",
    "type" => "text");
	
$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 4</strong> font size",
    "id" => "h4_fontsize",
    "std" => "26",
	"class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 4</strong> font size",
    "id" => "h4_fontsize_mobile",
    "std" => "20",
	"class" => "font",
    "type" => "text");
	
$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 5</strong> font size",
    "id" => "h5_fontsize",
    "std" => "22",
	"class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 5</strong> font size",
    "id" => "h5_fontsize_mobile",
    "std" => "18",
	"class" => "font",
    "type" => "text");

$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 6</strong> font size",
    "id" => "h6_fontsize",
    "std" => "18",
	"class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "",
    "desc" => "<strong>Heading 6</strong> font size",
    "id" => "h6_fontsize_mobile",
    "std" => "16",
	"class" => "font",
    "type" => "text");
	
$of_options[] = array( 	"name" 		=> "Regular Text",
    "desc" 		=> "",
    "id" 		=> "body_text_font",
    "std" 		=> "PT Sans",
    "type" 		=> "select_google_font",
    "preview" 	=> array(
        "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum tellus purus condimentum pulvinar. Duis cursus bibendum dui, eget iaculis urna pharetra. Aenean semper nec ipsum vitae mollis.", //this is the text from preview box
        "size" => "16px" //this is the text size from preview box
    ),
    "options" 	=> $google_fonts,
);
$of_options[] = array( "name" => "",
    "desc" => "",
    "id" => "body_text_weight",
    "std" => "",
    "type" => "select",
    "options" => array(
        'Normal (400) font weight' => 'Normal (400) font weight',
        'Light (300) font weight' => 'Light (300) font weight',
        'Bold (700) font weight' => 'Bold (700) font weight',
        'Semi-bold (600) font weight' => 'Semi-bold (600) font weight',
    ));

$of_options[] = array( "name" =>  "Sizes on Desktops",
    "desc" => "Font size",
    "id" => "regular_fontsize",
    "std" => "16",
	"class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "Sizes on Mobiles",
    "desc" => "Font size",
    "id" => "regular_fontsize_mobile",
    "std" => "14",
    "class" => "font",
    "type" => "text");

$of_options[] = array( "name" =>  "",
    "desc" => "Line height",
    "id" => "regular_lineheight",
    "std" => "26",
	"class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "",
    "desc" => "Line height",
    "id" => "regular_lineheight_mobile",
    "std" => "22",
	"class" => "font",
    "type" => "text");
	
$of_options[] = array( 	"name" 		=> "Main Menu Text",
	"desc" 		=> "",
	"id" 		=> "navigation_font",
	"std" 		=> "Open Sans",
	"type" 		=> "select_google_font",
	"preview" 	=> array(
		"text" => "Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;About&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Services&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Portfolio", //this is the text from preview box
		"size" => "17px" //this is the text size from preview box
	),
	"options" 	=> $google_fonts,
);
$of_options[] = array( "name" => "",
    "desc" => "",
    "id" => "navigation_weight",
    "std" => "",
    "type" => "select",
    "options" => array(
        'Normal (400) font weight' => 'Normal (400) font weight',
        'Light (300) font weight' => 'Light (300) font weight',
        'Bold (700) font weight' => 'Bold (700) font weight',
        'Semi-bold (600) font weight' => 'Semi-bold (600) font weight',
    ));

$of_options[] = array( "name" =>  "Sizes on Default Menu",
    "desc" => "Font size of <strong>main</strong> items",
    "id" => "nav_fontsize",
    "std" => "17",
	"class" => "font",
    "type" => "text");
$of_options[] = array( "name" =>  "Sizes on Mobile Menu",
    "desc" => "Font size of <strong>main</strong> items",
    "id" => "nav_fontsize_mobile",
    "std" => "17",
	"class" => "font",
    "type" => "text");
	
$of_options[] = array( "name" =>  "",
    "desc" => "Font size of <strong>sub</strong> items",
    "id" => "subnav_fontsize",
    "std" => "15",
	"class" => "font",
    "type" => "text");	
$of_options[] = array( "name" =>  "",
    "desc" => "Font size of <strong>sub</strong> items",
    "id" => "subnav_fontsize_mobile",
    "std" => "15",
	"class" => "font",
    "type" => "text");

$of_options[] = array( "name" => "Subset",
    "desc" => "Select characters subset for Google fonts. <strong>Please note: some fonts does not support particular subsets!</strong>",
    "id" => "font_subset",
    "std" => "latin",
    "type" => "select",
    "options" => $google_fonts_subsets,
);

$of_options[] = array( "name" => "Blog Options",
	"type" => "heading");

$of_options[] = array( "name" => "Excerpt Length",
	"desc" => "Input the number of words in the Excerpt",
	"id" => "blog_excerpt_length",
	"std" => "22",
	"type" => "text");

$of_options[] = array( "name" => "Sidebar at Blog Page",
	"desc" => "Blog page sidebar position",
	"id" => "blog_sidebar_pos",
	"std" => "No Sidebar",
	"type" => "select",
	"options" => array(
		'Right',
		'Left',
		'No Sidebar',
	));

$of_options[] = array( "name" => "Sidebar at Posts",
	"desc" => "Post pages sidebar position",
	"id" => "post_sidebar_pos",
	"std" => "Right",
	"type" => "select",
	"options" => array(
		'Right',
		'Left',
		'No Sidebar',
	));

$of_options[] = array( "name" => "Default Blog Layout",
    "desc" => "Select blog layout for default front page",
    "id" => "blog_layout",
    "std" => "Masonry Grid",
    "type" => "select",
    "options" => array(
        'Square Image at Left',
        'Rounded Image at Left',
        'Masonry Grid',
    ));

$of_options[] = array( "name" => "Columns",
    "desc" => "Select amount of columns for default front page",
    "id" => "blog_columns",
    "std" => '3 Columns',
    "type" => "select",
    "options" => array(
        '1 Column',
        '2 Columns',
        '3 Columns',
    ));


$of_options[] = array( "name" => "Contact Form",
	"type" => "heading");

$of_options[] = array( "name" => "Contact form reciever Email",
	"desc" => "All contact requests will be sent to this Email",
	"id" => "contact_form_email",
	"std" => "",
	"type" => "text"
);

$of_options[] = array( "name" => "Name field",
	"desc" => "",
	"id" => "contact_form_name_field",
	"std" => "Shown, required",
	"type" => "select",
	"options" => array('required' => 'Shown, required', 'show' => 'Shown, not required', 'hide' => 'Hidden')
);

$of_options[] = array( "name" => "Email field",
	"desc" => "",
	"id" => "contact_form_email_field",
	"std" => "Shown, required",
	"type" => "select",
	"options" => array('required' => 'Shown, required', 'show' => 'Shown, not required', 'hide' => 'Hidden')
);

$of_options[] = array( "name" => "Phone field",
	"desc" => "",
	"id" => "contact_form_phone_field",
	"std" => "Shown, required",
	"type" => "select",
	"options" => array('required' => 'Shown, required', 'show' => 'Shown, not required', 'hide' => 'Hidden')
);

$of_options[] = array( "name" => "Message field",
	"desc" => "",
	"id" => "contact_form_message_field",
	"std" => "Shown, required",
	"type" => "select",
	"options" => array('required' => 'Shown, required', 'show' => 'Shown, not required', 'hide' => 'Hidden')
);

$of_options[] = array( "name" => "Button Color",
	"desc" => "",
	"id" => "contact_form_button_color",
	"std" => "Primary (theme color)",
	"type" => "select",
	"options" => array('primary' => 'Primary (theme color)',
        'secondary' => 'Secondary (theme color)',
        'text' => 'Text (theme color)',
        'faded' => 'Faded (theme color)',
        'white' => 'White',
        'red' => 'Red',
        'blue' => 'Blue',
        'green' => 'Green',
        'yellow' => 'Yellow',
        'purple' => 'Purple',
        'pink' => 'Pink',
        'navy' => 'Navy',
        'brown' => 'Brown',
        'midnight' => 'Midnight',
        'teal' => 'Teal',
        'cream' => 'Cream',
        'lime' => 'Lime',)
);

$of_options[] = array( "name" => "Button Alignment",
	"desc" => "",
	"id" => "contact_form_button_align",
	"std" => "Left",
	"type" => "select",
	"options" => array('left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',)
);

$of_options[] = array( "name" => "Button Text",
    "desc" => "",
    "id" => "contact_form_button_text",
    "std" => "Send Message",
    "type" => "text"
);

$of_options[] = array( "name" => "",
    "desc" => "Apply Outlined Style to the Button",
    "id" => "contact_form_button_outlined",
    "std" => 0,
    "type" => "switch"
);

$of_options[] = array( "name" => "MailChimp Subscribe Form",
    "desc" => "Turn Contact Form to MailChimp Subscribe Form",
    "id" => "contact_form_mailchimp",
    "std" => 0,
    "folds" => 1,
    "type" => "switch");

$of_options[] = array( "name" => "MailChimp API Key",
    "desc" => "Please refer to <a href='http://apidocs.mailchimp.com' target='_blank'>http://apidocs.mailchimp.com/</a> for additional info",
    "id" => "contact_form_mailchimp_api_key",
    "std" => "",
    "fold" => "contact_form_mailchimp",
    "type" => "text");

$of_options[] = array( "name" => "MailChimp List ID",
    "desc" => "",
    "id" => "contact_form_mailchimp_list_id",
    "std" => "",
    "fold" => "contact_form_mailchimp",
    "type" => "text");

if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // WooCommerce Options
    $of_options[] = array( 	"name" 		=> "WooCommerce",
        "type" 		=> "heading"
    );

    $of_options[] = array( "name" => "Sidebar at Shop Pages",
        "desc" => "Sidebar position at shop pages",
        "id" => "shop_sidebar_pos",
        "std" => "Right",
        "type" => "select",
        "options" => array(
            'Right' => 'Right',
            'Left' => 'Left',
            'No Sidebar' => 'No Sidebar',
        ));

    $of_options[] = array( "name" => "Sidebar at Product Pages",
        "desc" => "Sidebar position at product pages",
        "id" => "good_sidebar_pos",
        "std" => "Right",
        "type" => "select",
        "options" => array(
            'Right' => 'Right',
            'Left' => 'Left',
            'No Sidebar' => 'No Sidebar',
        ));
}


// Theme Update Options
$of_options[] = array( 	"name" 		=> "Theme Update",
	"type" 		=> "heading"
);

$of_options[] = array( 	"name" 		=> "Import",
    "std" 		=> "Please enter your Themeforest username and Secret API Key below if you want to get update notifications for GRATA theme.",
    "id" 		=> "themeforest_info",
    "type" 		=> "info"
    );

$of_options[] = array( "name" => "ThemeForest User Name",
    "desc" => "",
    "id" => "themeforest_username",
    "std" => "",
    "type" => "text"
);

$of_options[] = array( "name" => "ThemeForest API Key",
    "desc" => "Copy API Key of your ThemeForest account here. Check this <a target='_blank' href='".get_template_directory_uri()."/img/find-api.png'>screenshot</a> for more info",
    "id" => "themeforest_api_key",
    "std" => "",
    "type" => "text"
);

// Backup Options
$of_options[] = array( 	"name" 		=> "Manage Options",
	"type" 		=> "heading"
);

$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
	"id" 		=> "of_backup",
	"std" 		=> "",
	"type" 		=> "backup",
	"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
);

$of_options[] = array( "name" => "Transfer Theme Options Data",
    "id" => "of_transfer",
    "std" => "",
    "type" => "transfer",
    "desc" => 'You can transfer the saved options data between different installations by copying the text inside the text box. To import data from another installation, replace the data in the text box with the one from another installation and click "Import Options".',
);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
