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


				$of_sidebars = array();
				$sidebars    = fave_get_sidebars_list(); 
				foreach ($sidebars as $id => $name ) {
					$of_sidebars[$id] = $name; 
				}
				$of_sidebar_tmp 		= array_unshift($of_sidebars, "None");


				$of_category_posts = array(); 
				$category_post_layouts = fave_get_main_layouts( true ); 
				foreach ($category_post_layouts as $id => $layout ) {
					$of_category_posts[$id] = $layout['img']; 
				}

				$of_archive_posts = array(); 
				$archive_post_layouts = fave_get_archive_layouts( true ); 
				foreach ($archive_post_layouts as $id => $layout ) {
					$of_archive_posts[$id] = $layout['img']; 
				}


				$of_child_cats = array(); 
				$show_child_cat = fave_show_child_cat();
				foreach ( $show_child_cat as $val => $title ) {
					$of_child_cats[$val] = $title['title']; 
				}


				$of_cat_pagination = array();    
				$category_pagination = fave_get_pagination( true );
				foreach ( $category_pagination as $id => $layout ) {
					$of_cat_pagination[$id] = $layout['img']; 
				}

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
		
		$font_weight = array(
			'100' => '100',
			'200' => '200',
			'300' => '300',
			'400' => '400',
			'500' => '500',
			'600' => '600',
			'700' => '700',
			'800' => '800',
			'900' => '900'
			);

		$font_sizes = array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
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
			'21' => '21',
			'22' => '22',
			'23' => '23',
			'24' => '24',
			'25' => '25',
			'26' => '26',
			'27' => '27',
			'28' => '28',
			'29' => '29',
			'30' => '30',
			'31' => '31',
			'32' => '32',
			'33' => '33',
			'34' => '34',
			'35' => '35',
			'36' => '36',
			'37' => '37',
			'38' => '38',
			'39' => '39',
			'40' => '40',
			'41' => '41',
			'42' => '42',
			'43' => '43',
			'44' => '44',
			'45' => '45',
			'46' => '46',
			'47' => '47',
			'48' => '48',
			'49' => '49',
			'50' => '50',
			'51' => '51',
			'52' => '52',
			'53' => '53',
			'54' => '54',
			'55' => '55',
			'56' => '56',
			'57' => '57',
			'58' => '58',
			'59' => '59',
			'60' => '60',
			'61' => '61',
			'62' => '62',
			'63' => '63',
			'64' => '64',
			'65' => '65',
			'66' => '66',
			'67' => '67',
			'68' => '68',
			'69' => '69',
			'70' => '70',
			'71' => '71',
			'72' => '72',
			'73' => '73',
			'74' => '74',
			'75' => '75',
			);

$fonts_list = array(
	"0" => "Select Font ( NONE )",
	'Abel' => 'Abel',
	'Abril Fatface' => 'Abril Fatface',
	'Aclonica' => 'Aclonica',
	'Acme' => 'Acme',
	'Actor' => 'Actor',
	'Adamina' => 'Adamina',
	'Advent Pro' => 'Advent Pro',
	'Aguafina Script' => 'Aguafina Script',
	'Aladin' => 'Aladin',
	'Aldrich' => 'Aldrich',
	'Alegreya' => 'Alegreya',
	'Alegreya SC' => 'Alegreya SC',
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
	'Almendra SC' => 'Almendra SC',
	'Amaranth' => 'Amaranth',
	'Amatic SC' => 'Amatic SC',
	'Amethysta' => 'Amethysta',
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
	'Architects Daughter' => 'Architects Daughter',
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
	'Average' => 'Average',
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
	'Bentham' => 'Bentham',
	'Berkshire Swash' => 'Berkshire Swash',
	'Bevan' => 'Bevan',
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
	'Cardo' => 'Cardo',
	'Carme' => 'Carme',
	'Carter One' => 'Carter One',
	'Carrois Gothic' => 'Carrois Gothic',
	'Caudex' => 'Caudex',
	'Cedarville Cursive' => 'Cedarville Cursive',
	'Ceviche One' => 'Ceviche One',
	'Changa One' => 'Changa One',
	'Chango' => 'Chango',
	'Chau Philomene One' => 'Chau Philomene One',
	'Chelsea Market' => 'Chelsea Market',
	'Chenla' => 'Chenla',
	'Cherry Cream Soda' => 'Cherry Cream Soda',
	'Chewy' => 'Chewy',
	'Chicle' => 'Chicle',
	'Chivo' => 'Chivo',
	'Coda' => 'Coda',
	'Coda Caption' => 'Coda Caption',
	'Codystar' => 'Codystar',
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
	'Cousine' => 'Cousine',
	'Coustard' => 'Coustard',
	'Covered By Your Grace' => 'Covered By Your Grace',
	'Crafty Girls' => 'Crafty Girls',
	'Creepster' => 'Creepster',
	'Crete Round' => 'Crete Round',
	'Crimson Text' => 'Crimson Text',
	'Crushed' => 'Crushed',
	'Cuprum' => 'Cuprum',
	'Cutive' => 'Cutive',
	'Damion' => 'Damion',
	'Dancing Script' => 'Dancing Script',
	'Dangrek' => 'Dangrek',
	'Dawning of a New Day' => 'Dawning of a New Day',
	'Days One' => 'Days One',
	'Delius' => 'Delius',
	'Delius Swash Caps' => 'Delius Swash Caps',
	'Delius Unicase' => 'Delius Unicase',
	'Della Respira' => 'Della Respira',
	'Devonshire' => 'Devonshire',
	'Didact Gothic' => 'Didact Gothic',
	'Diplomata' => 'Diplomata',
	'Diplomata SC' => 'Diplomata SC',
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
	'Eater' => 'Eater',
	'Economica' => 'Economica',
	'Electrolize' => 'Electrolize',
	'Emblema One' => 'Emblema One',
	'Emilys Candy' => 'Emilys Candy',
	'Engagement' => 'Engagement',
	'Enriqueta' => 'Enriqueta',
	'Erica One' => 'Erica One',
	'Esteban' => 'Esteban',
	'Euphoria Script' => 'Euphoria Script',
	'Ewert' => 'Ewert',
	'Exo' => 'Exo',
	'Expletus Sans' => 'Expletus Sans',
	'Fanwood Text' => 'Fanwood Text',
	'Fascinate' => 'Fascinate',
	'Fascinate Inline' => 'Fascinate Inline',
	'Federant' => 'Federant',
	'Federo' => 'Federo',
	'Felipa' => 'Felipa',
	'Fjalla One' => 'Fjalla One',
	'Fjord One' => 'Fjord One',
	'Flamenco' => 'Flamenco',
	'Flavors' => 'Flavors',
	'Fondamento' => 'Fondamento',
	'Fontdiner Swanky' => 'Fontdiner Swanky',
	'Forum' => 'Forum',
	'Francois One' => 'Francois One',
	'Fredericka the Great' => 'Fredericka the Great',
	'Fredoka One' => 'Fredoka One',
	'Freehand' => 'Freehand',
	'Fresca' => 'Fresca',
	'Frijole' => 'Frijole',
	'Fugaz One' => 'Fugaz One',
	'GFS Didot' => 'GFS Didot',
	'GFS Neohellenic' => 'GFS Neohellenic',
	'Galdeano' => 'Galdeano',
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
	'Gravitas One' => 'Gravitas One',
	'Great Vibes' => 'Great Vibes',
	'Gruppo' => 'Gruppo',
	'Gudea' => 'Gudea',
	'Habibi' => 'Habibi',
	'Hammersmith One' => 'Hammersmith One',
	'Handlee' => 'Handlee',
	'Hanuman' => 'Hanuman',
	'Happy Monkey' => 'Happy Monkey',
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
	'Jim Nightshade' => 'Jim Nightshade',
	'Jockey One' => 'Jockey One',
	'Jolly Lodger' => 'Jolly Lodger',
	'Josefin Sans' => 'Josefin Sans',
	'Josefin Slab' => 'Josefin Slab',
	'Judson' => 'Judson',
	'Julee' => 'Julee',
	'Junge' => 'Junge',
	'Jura' => 'Jura',
	'Just Another Hand' => 'Just Another Hand',
	'Just Me Again Down Here' => 'Just Me Again Down Here',
	'Kameron' => 'Kameron',
	'Karla' => 'Karla',
	'Kaushan Script' => 'Kaushan Script',
	'Kelly Slab' => 'Kelly Slab',
	'Kenia' => 'Kenia',
	'Khmer' => 'Khmer',
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
	'Lilita One' => 'Lilita One',
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
	'Marko One' => 'Marko One',
	'Marmelad' => 'Marmelad',
	'Marvel' => 'Marvel',
	'Mate' => 'Mate',
	'Mate SC' => 'Mate SC',
	'Maven Pro' => 'Maven Pro',
	'Meddon' => 'Meddon',
	'MedievalSharp' => 'MedievalSharp',
	'Medula One' => 'Medula One',
	'Megrim' => 'Megrim',
	'Merienda One' => 'Merienda One',
	'Merriweather' => 'Merriweather',
	'Metal' => 'Metal',
	'Metamorphous' => 'Metamorphous',
	'Metrophobic' => 'Metrophobic',
	'Michroma' => 'Michroma',
	'Miltonian' => 'Miltonian',
	'Miltonian Tattoo' => 'Miltonian Tattoo',
	'Miniver' => 'Miniver',
	'Miss Fajardose' => 'Miss Fajardose',
	'Modern Antiqua' => 'Modern Antiqua',
	'Molengo' => 'Molengo',
	'Monofett' => 'Monofett',
	'Monoton' => 'Monoton',
	'Monsieur La Doulaise' => 'Monsieur La Doulaise',
	'Montaga' => 'Montaga',
	'Montez' => 'Montez',
	'Montserrat' => 'Montserrat',
	'Moul' => 'Moul',
	'Moulpali' => 'Moulpali',
	'Mountains of Christmas' => 'Mountains of Christmas',
	'Mr Bedfort' => 'Mr Bedfort',
	'Mr Dafoe' => 'Mr Dafoe',
	'Mr De Haviland' => 'Mr De Haviland',
	'Mrs Saint Delafield' => 'Mrs Saint Delafield',
	'Mrs Sheppards' => 'Mrs Sheppards',
	'Muli' => 'Muli',
	'Mystery Quest' => 'Mystery Quest',
	'Neucha' => 'Neucha',
	'Neuton' => 'Neuton',
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
	'Old Standard TT' => 'Old Standard TT',
	'Oldenburg' => 'Oldenburg',
	'Oleo Script' => 'Oleo Script',
	'Open Sans' => 'Open Sans',
	'Open Sans Condensed' => 'Open Sans Condensed',
	'Orbitron' => 'Orbitron',
	'Original Surfer' => 'Original Surfer',
	'Oswald' => 'Oswald',
	'Over the Rainbow' => 'Over the Rainbow',
	'Overlock' => 'Overlock',
	'Overlock SC' => 'Overlock SC',
	'Ovo' => 'Ovo',
	'Oxygen' => 'Oxygen',
	'PT Mono' => 'PT Mono',
	'PT Sans' => 'PT Sans',
	'PT Sans Caption' => 'PT Sans Caption',
	'PT Sans Narrow' => 'PT Sans Narrow',
	'PT Serif' => 'PT Serif',
	'PT Serif Caption' => 'PT Serif Caption',
	'Pacifico' => 'Pacifico',
	'Parisienne' => 'Parisienne',
	'Passero One' => 'Passero One',
	'Passion One' => 'Passion One',
	'Patrick Hand' => 'Patrick Hand',
	'Patua One' => 'Patua One',
	'Paytone One' => 'Paytone One',
	'Permanent Marker' => 'Permanent Marker',
	'Petrona' => 'Petrona',
	'Philosopher' => 'Philosopher',
	'Piedra' => 'Piedra',
	'Pinyon Script' => 'Pinyon Script',
	'Plaster' => 'Plaster',
	'Play' => 'Play',
	'Playball' => 'Playball',
	'Playfair Display' => 'Playfair Display',
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
	'Quantico' => 'Quantico',
	'Quattrocento' => 'Quattrocento',
	'Quattrocento Sans' => 'Quattrocento Sans',
	'Questrial' => 'Questrial',
	'Quicksand' => 'Quicksand',
	'Qwigley' => 'Qwigley',
	'Radley' => 'Radley',
	'Raleway' => 'Raleway',
	'Rammetto One' => 'Rammetto One',
	'Rancho' => 'Rancho',
	'Rationale' => 'Rationale',
	'Redressed' => 'Redressed',
	'Reenie Beanie' => 'Reenie Beanie',
	'Revalia' => 'Revalia',
	'Ribeye' => 'Ribeye',
	'Ribeye Marrow' => 'Ribeye Marrow',
	'Righteous' => 'Righteous',
	'Roboto' => 'Roboto',
	'Rochester' => 'Rochester',
	'Rock Salt' => 'Rock Salt',
	'Rokkitt' => 'Rokkitt',
	'Ropa Sans' => 'Ropa Sans',
	'Rosario' => 'Rosario',
	'Rosarivo' => 'Rosarivo',
	'Rouge Script' => 'Rouge Script',
	'Ruda' => 'Ruda',
	'Ruge Boogie' => 'Ruge Boogie',
	'Ruluko' => 'Ruluko',
	'Ruslan Display' => 'Ruslan Display',
	'Russo One' => 'Russo One',
	'Ruthie' => 'Ruthie',
	'Sail' => 'Sail',
	'Salsa' => 'Salsa',
	'Sancreek' => 'Sancreek',
	'Sansita One' => 'Sansita One',
	'Sarina' => 'Sarina',
	'Satisfy' => 'Satisfy',
	'Schoolbell' => 'Schoolbell',
	'Seaweed Script' => 'Seaweed Script',
	'Sevillana' => 'Sevillana',
	'Seymour One' => 'Seymour One',
	'Shadows Into Light' => 'Shadows Into Light',
	'Shadows Into Light Two' => 'Shadows Into Light Two',
	'Shanti' => 'Shanti',
	'Share' => 'Share',
	'Shojumaru' => 'Shojumaru',
	'Short Stack' => 'Short Stack',
	'Siemreap' => 'Siemreap',
	'Sigmar One' => 'Sigmar One',
	'Signika' => 'Signika',
	'Signika Negative' => 'Signika Negative',
	'Simonetta' => 'Simonetta',
	'Sirin Stencil' => 'Sirin Stencil',
	'Six Caps' => 'Six Caps',
	'Slackey' => 'Slackey',
	'Smokum' => 'Smokum',
	'Smythe' => 'Smythe',
	'Sniglet' => 'Sniglet',
	'Snippet' => 'Snippet',
	'Sofia' => 'Sofia',
	'Sonsie One' => 'Sonsie One',
	'Sorts Mill Goudy' => 'Sorts Mill Goudy',
	'Special Elite' => 'Special Elite',
	'Spicy Rice' => 'Spicy Rice',
	'Spinnaker' => 'Spinnaker',
	'Spirax' => 'Spirax',
	'Squada One' => 'Squada One',
	'Stardos Stencil' => 'Stardos Stencil',
	'Stint Ultra Condensed' => 'Stint Ultra Condensed',
	'Stint Ultra Expanded' => 'Stint Ultra Expanded',
	'Stoke' => 'Stoke',
	'Sue Ellen Francisco' => 'Sue Ellen Francisco',
	'Sunshiney' => 'Sunshiney',
	'Supermercado One' => 'Supermercado One',
	'Suwannaphum' => 'Suwannaphum',
	'Swanky and Moo Moo' => 'Swanky and Moo Moo',
	'Syncopate' => 'Syncopate',
	'Tangerine' => 'Tangerine',
	'Taprom' => 'Taprom',
	'Telex' => 'Telex',
	'Tenor Sans' => 'Tenor Sans',
	'The Girl Next Door' => 'The Girl Next Door',
	'Tienne' => 'Tienne',
	'Tinos' => 'Tinos',
	'Titillium Web' => 'Titillium Web',
	'Titan One' => 'Titan One',
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
	'UnifrakturCook' => 'UnifrakturCook',
	'UnifrakturMaguntia' => 'UnifrakturMaguntia',
	'Unkempt' => 'Unkempt',
	'Unlock' => 'Unlock',
	'Unna' => 'Unna',
	'VT323' => 'VT323',
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
	'Wellfleet' => 'Wellfleet',
	'Wire One' => 'Wire One',
	'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
	'Yellowtail' => 'Yellowtail',
	'Yeseva One' => 'Yeseva One',
	'Yesteryear' => 'Yesteryear',
	'Zeyada' => 'Zeyada'
	);

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


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$adminurl = ADMIN_DIR . 'assets/images/';
$icons = ADMIN_DIR . 'assets/images/icons/';
$images_url = get_template_directory_uri().'/images/';


// GENERAL SETTINGS
$of_options[] = array(
	"name" => "General Settings",
	"type" => "heading",
	"icon" => $adminurl . "icon-settings.png"
	);


$of_options[] = array( 
	"name" => "Website Favicon",
	"desc" => "Upload website favicon in .ico format.",
	"id" => "site_favicon",
	"std" => "",
	"mod" => "min",
	"type" => "media"
	);

$of_options[] = array( 
	"name" => "Website Retina Favicon",
	"desc" => "Upload website Favicon Retina version. 144x144px .png file required.",
	"id" => "site_retina_favicon",
	"std" => "",
	"mod" => "min",
	"type" => "media"
	);

$of_options[] = array( "name" => "Twitter Username",
	"desc" => "Add twitter username, will be use for twitter share via @username.",
	"id" => "twitter_username",
	"std" => "",
	"type" => "text",
	);

$of_options[] = array( 	
	"name" => "Breadcrumb",
	"desc" => "Enable or Disable breadcrumb. Default: Enable.",
	"id" => "site_breadcrumb",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Author name in posts",
	"desc" => "Enable or Disable author name in posts. Default: Enable.",
	"id" => "site_author_name",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array(
	"name" => "Time Difference",
	"desc" => "Enable or Disable Human Readable time difference. Default: Enable.",
	"id" => "site_time_diff",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
);

$of_options[] = array( 	
	"name" => "Date in posts",
	"desc" => "Enable or Disable date in posts, will work when 'Time Difference' will be disable. Default: Disable.",
	"id" => "site_date",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Time in posts",
	"desc" => "Enable or Disable time in posts, will work when 'Time Difference' will be disable. Default: Disable.",
	"id" => "site_time",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "View Count in posts",
	"desc" => "Enable or Disable view count in posts. Default: Enable.",
	"id" => "site_view_count",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Comment Count in posts",
	"desc" => "Enable or Disable comment count in posts. Default: Enable.",
	"id" => "site_comment_count",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


//=================================== LAYOUT SETTINGS =========================================//

$of_options[] = array(
	"name" => "Layout Options",
	"type" => "heading",
	"icon" => $icons . "site-layout.png"
	);

$of_options[] = array( 	"name" 		=> "Container Width",
	"desc" 		=> "Min: 960, max: 1280, step: 5, default value: 1170",
	"id" 		=> "site_container_width",
	"std" 		=> "1170",
	"min" 		=> "960",
	"step"		=> "5",
	"max" 		=> "1280",
	"type" 		=> "sliderui" 
	);


$of_options[] = array( "name" => "Site Layout",
	"desc" => "",
	"id" => "site_layout",
	"std" => "wide-layout",
	"type" => "select",
	"options" => array(
		"wide-layout"  => "Wide",
		"boxed-layout" => "Boxed",
		"framed-layout" => "Framed",
		"container-fluid"   => "Full Width",
		));

$of_options[] = array( "name" => "Background Type",
	"desc" => "",
	"id" => "background_type",
	"std" => "",
	"type" => "select",
	"options" => array(
		"bg_pattern"  => "Pattern",
		"custom_image" => "Image"
		));

$of_options[] = array( "name" => "Background Image",
	"desc" => "",
	"id" => "background_image",
	"std" => "<h3 style='margin: 0;'> Background Image</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( "name" => "Background Image",
	"desc" => "Upload background image.",
	"id" => "site_bg_image",
	"std" => "",
	"mod" => "max",
	"type" => "media"
	);

$of_options[] = array( "name" => "Background Pattern",
	"desc" => "",
	"id" => "background_Pattern",
	"std" => "<h3 style='margin: 0;'> Background Pattern</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 	
	"name" => "Patterns for Background",
	"desc" => "Select a pattern and set it as background. Choose between these patterns. More to come...",
	"id" => "background_patterns",
	"std" => '',
	"type" => "images",
	"options" => array(
		'' => $adminurl . 'pattern/no-image.png',
		'bg1' => $adminurl . 'pattern/bg1.png',
		'bg2' => $adminurl . 'pattern/bg2.png',
		'bg3' => $adminurl . 'pattern/bg3.png',
		'bg4' => $adminurl . 'pattern/bg4.png',
		'bg5' => $adminurl . 'pattern/bg5.png',
		'bg6' => $adminurl . 'pattern/bg6.png',
		'bg7' => $adminurl . 'pattern/bg7.png',
		'bg8' => $adminurl . 'pattern/bg8.png',
		'bg9' => $adminurl . 'pattern/bg9.png',
		'bg10' => $adminurl . 'pattern/bg10.png',
		'bg11' => $adminurl . 'pattern/bg11.png',
		)
	);

$of_options[] = array( "name" => "Other Background Settings",
	"desc" => "",
	"id" => "other_background_settings",
	"std" => "<h3 style='margin: 0;'> Other Background Settings</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( "name" => "Background Repeat",
	"desc" => "How the site background image will be displayed",
	"id" => "bg_repeat",
	"std" => "repeat",
	"type" => "select",
	"options" => array(
		"no-repeat"  => "No Repeat",
		"repeat" => "Tile",
		"repeat-x" => "Tile Horizontally",
		"repeat-y" => "Tile Vertically",
		));

$of_options[] = array( "name" => "Background Attachment",
	"desc" => "",
	"id" => "bg_attachment",
	"std" => "",
	"type" => "select",
	"options" => array(
		"fixed"  => "Fixed",
		"scroll" => "Scroll"
		));

$of_options[] = array( "name" => "Background Position",
	"desc" => "",
	"id" => "bg_position",
	"std" => "",
	"type" => "select",
	"options" => array(
		"left top"  => "left top",
		"left center" => "left center",
		"left bottom" => "left bottom",
		"right top"		=> "right top",
		"right center"	=> "right center",
		"right bottom"	=> "right bottom",
		"center top"	=> "center top",
		"center center"	=> "center center",
		"center bottom"	=> "center bottom"
		));

$of_options[] = array( "name" => "Background Size",
	"desc" => "",
	"id" => "bg_size",
	"std" => "auto",
	"type" => "select",
	"options" => array(
		"auto" => "Auto",
		"cover"  => "Cover",
		"contain" => "Contain"
		));



//=================================== HEADER SETTINGS =========================================//

$of_options[] = array(
	"name" => "Header Options",
	"type" => "heading",
	"icon" => $icons . "header.png"
	);


$of_options[] = array( "name" => "Select a Header Layout",
	"desc" => "",
	"id" => "header_layout",
	"std" => "header-4",
	"type" => "images",
	"options" => array(
		"header-1" => $adminurl."header-1.png",
		"header-2" => $adminurl."header-2.png",
		"header-3" => $adminurl."header-3.png",
		"header-4" => $adminurl."header-4.png",
		"header-5" => $adminurl."header-5.png",
		"header-6" => $adminurl."header-6.png",
		"header-7" => $adminurl."header-7.png"
		));

$of_options[] = array( "name" => "Header 6 Settings",
       "desc" => "",
       "id" => "header_6_settings",
       "std" => "<h3 style='margin: 0;'> Header 6 Settings</h3>",
       "icon" => true,
       "type" => "info");

$of_options[] = array( "name" => "Logo Position",
       "desc" => "",
       "id" => "header_6_logo_position",
       "std" => "",
       "type" => "select",
       "options" => array(
           "left_align" => "Left",
           "center_align" => "Center",
       ));
$of_options[] = array(
	"name" => "Main Menu Skin",
	"desc" => "Choose skin for header 6 main menu. Default Dark Skin",
	"id" => "header_6_skin",
	"std" => "header-6-dark",
	"options" => array(
		"header-6-dark" => 'Dark Skin',
		"header-6-light" => 'Light Skin',
	),
	"type" => "select",
);
$of_options[] = array( "name" => "Main Menu",
       "desc" => "",
       "id" => "header_6_menu_position",
       "std" => "",
       "type" => "select",
       "options" => array(
           "" => "Left",
           "header-6-center" => "Center",
       ));

$of_options[] = array( "name" => "",
           "desc" => "",
           "id" => "dummy_setting",
           "std" => "<h3 style='margin: 0;'></h3>",
           "icon" => true,
           "type" => "info");

$of_options[] = array( 	
	"name" => "Top Menu",
	"desc" => "Enable or Disable top menu. Default: Enable.",
	"id" => "site_top_strip",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);
$of_options[] = array(
	"name" => "Sticky Nav",
	"desc" => "Enable or Disable sticky nav. Default: Enable.",
	"id" => "desktop_sticky_nav",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array(
	"name" => "Mobile Sticky Nav",
	"desc" => "Enable or Disable mobile sticky nav. Default: Enable.",
	"id" => "mobile_sticky_nav",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Register / Login",
	"desc" => "Enable or Disable login/register in top menu. Default: Enable.",
	"id" => "login_top_menu",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Search",
	"desc" => "Enable or Disable search. Default: Enable.",
	"id" => "header_search",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


/*------------------------------------------- Desktop logo ---------------------------------*/
$of_options[] = array( "name" => "Logo",
	"desc" => "",
	"id" => "header_logo",
	"std" => "<h3 style='margin: 0;'> Desktop Logo</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( "name" => "Logo Type",
	"desc" => "",
	"id" => "logo_type",
	"std" => "text_logo",
	"type" => "select",
	"options" => array(
		"img_logo" => "Image Logo",
		"text_logo" => "Text Logo",
		));

$of_options[] = array( 
	"name" => "Image Logo",
	"desc" => "Upload image logo. ",
	"id" => "site_logo",
	"std" => "",
	"mod" => "max",
	"type" => "media"
	);

$of_options[] = array( "name" => "Enter Logo Text",
	"desc" => "You can choose text logo font family, font size under typography section.",
	"id" => "site_text_logo",
	"std" => "Magazilla",
	"type" => "text",
	);

$of_options[] = array( "name" => "Logo Margin Top",
	"desc" => "Enter the logo margin top.",
	"id" => "site_logo_margin_top",
	"std" => "",
	"type" => "text",
	);
$of_options[] = array( "name" => "Logo Margin Bottom",
                       "desc" => "Enter the logo margin bottom.",
                       "id" => "site_logo_margin_bottom",
                       "std" => "",
                       "type" => "text",
);


/*------------------------------------------- Mobile logo ---------------------------------*/
$of_options[] = array( "name" => "Mobile Logo",
       "desc" => "",
       "id" => "mobile_logo",
       "std" => "<h3 style='margin: 0;'> Mobile Logo</h3>",
       "icon" => true,
       "type" => "info");

$of_options[] = array(
		"desc" => "Upload logo for mobile devices. ",
		"id" => "site_mobile_logo",
		"std" => "",
		"mod" => "max",
		"type" => "media"
);


//****************************** STYLING SETTINGS *******************************************//
$of_options[] = array(
	"name" => "Color",
	"type" => "heading",
	"icon" => $adminurl . "icon-paint.png"
	);

$of_options[] = array( 	
	"name" => "Website Main Color",
	"desc" => "Select the main color for your website",
	"id" => "main_site_color",
	"std" => "#1b8289",
	"type" => "color"
	);

$of_options[] = array( 	
	"name" => "Text Color",
	"desc" => "Select the body text color. Default #282828",
	"id" => "body_text_color",
	"std" => "#282828",
	"type" => "color"
	);

$of_options[] = array( 	
	"name" => "Background Color",
	"desc" => "Select the body background color. Default #ffffff",
	"id" => "body_bg_color",
	"std" => "#ffffff",
	"type" => "color"
	);

$of_options[] = array( "name" => "Boxed Background Color",
	"desc" => " Select Boxed version background color",
	"id" => "bg_color",
	"std" => "#cccccc",
	"type" => "color"
	);

$of_options[] = array( "name" => "Header",
   "desc" => "",
   "id" => "header_bg_options",
   "std" => "<h3 style='margin: 0;'> Header Color </h3>",
   "icon" => true,
   "type" => "info");

$of_options[] = array(
	"name" => "Header Background color",
	"desc" => "Select beckground color for header. Default #ffffff",
	"id" => "header_bg_color",
	"std" => "#ffffff",
	"type" => "color"
);
$of_options[] = array( "name" => "Text Logo Color",
   "desc" => "Choose the color for text logo. Default #000000",
   "id" => "text_logo_color",
   "std" => "#000000",
   "type" => "color",
);

$of_options[] = array(
	"name" => "Tagline color",
	"desc" => "Select tagline text color. Default #141414",
	"id" => "tagline_color",
	"std" => "#141414",
	"type" => "color"
);

$of_options[] = array( "name" => "Top Nav",
	"desc" => "",
	"id" => "top_nav_color_options",
	"std" => "<h3 style='margin: 0;'> Top Nav </h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 	
	"name" => "Text Color",
	"desc" => "Select the top nav text color. Default #000000",
	"id" => "topnav_text_color",
	"std" => "#000000",
	"type" => "color"
	);

$of_options[] = array( 	
	"name" => "Top Nav Background Color",
	"desc" => "Select the top nav background color. Default #f7f7f7",
	"id" => "topnav_bg_color",
	"std" => "#f7f7f7",
	"type" => "color"
	);

$of_options[] = array( "name" => "Main Nav",
   "desc" => "",
   "id" => "main_nav_color_options",
   "std" => "<h3 style='margin: 0;'> Main Navigation </h3>",
   "icon" => true,
   "type" => "info"
);

$of_options[] = array(
	"name" => "Background Color",
	"desc" => "Select the top nav background color. Default #ffffff",
	"id" => "mainnav_bg_color",
	"std" => "#ffffff",
	"type" => "color"
);

$of_options[] = array(
	"name" => "Text Color",
	"desc" => "Select the top nav text color. Default #000000",
	"id" => "mainnav_text_color",
	"std" => "#000000",
	"type" => "color"
);
$of_options[] = array(
	"name" => "Border Bottom Color",
	"desc" => "Select the top nav text color. Default #E3E3E3",
	"id" => "mainnav_border_color",
	"std" => "#E3E3E3",
	"type" => "color"
);

$of_options[] = array( "name" => "Mobile Nav",
	"desc" => "",
	"id" => "mobile_nav_color_options",
	"std" => "<h3 style='margin: 0;'> Mobile Nav </h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array(
	"name" => "Mobile Nav Color",
	"desc" => "Select the mobile nav color. Default #ffffff",
	"id" => "mobile_nav_color",
	"std" => "#fff",
	"type" => "color"
	);
$of_options[] = array(
	"name" => "Mobile Nav Border Color",
	"desc" => "Select the mobile nav border color. Default #E3E3E3",
	"id" => "mobile_nav_border_color",
	"std" => "#E3E3E3",
	"type" => "color"
	);
$of_options[] = array(
	"name" => "Mobile Nav Icons Color ",
	"desc" => "Select the mobile nav icons color. Default #000000",
	"id" => "mobile_nav_icons_color",
	"std" => "#000000",
	"type" => "color"
	);

/*-----------------------------------------------------------------------------------------------
*   Header 5 Color
------------------------------------------------------------------------------------------------ */
$of_options[] = array( "name" => "Header 5",
	"desc" => "",
	"id" => "header_5_color",
	"std" => "<h3 style='margin: 0;'> Header 5 Main Menu </h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array(
	"name" => "Background Color",
	"desc" => "Choose background color for header 5. Default #ffffff",
	"id" => "header_5_bg_color",
	"std" => "#ffffff",
	"type" => "color"
	);
$of_options[] = array(
	"name" => "Text Color",
	"desc" => "Choose text color for header 5. Default #000000",
	"id" => "header_5_text_color",
	"std" => "#000000",
	"type" => "color"
	);
$of_options[] = array(
	"name" => "Text Hover Color",
	"desc" => "Choose text hover color for header 5. Default #ffffff",
	"id" => "header_5_text_hover_color",
	"std" => "#ffffff",
	"type" => "color"
	);

$of_options[] = array(
	"name" => "Footer Color",
	"desc" => "",
	"id" => "footer_color",
	"std" => "<h3 style=\"margin: 0;\">Footer Colors</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array(
	"name" => "Background Color",
	"desc" => "Select the background color for footer. Default #333333",
	"id" => "footer_bg_color",
	"std" => "#333333",
	"type" => "color"
	);

$of_options[] = array(
	"name" => "Titles Color",
	"desc" => "Select the color for footer titles. Default #cccccc",
	"id" => "footer_titles_color",
	"std" => "#cccccc",
	"type" => "color"
	);

$of_options[] = array(
	"name" => "Links Color",
	"desc" => "Select the color for footer links. Default #ffffff",
	"id" => "footer_links_color",
	"std" => "#ffffff",
	"type" => "color"
	);

$of_options[] = array(
	"name" => "Footer Bottom",
	"desc" => "",
	"id" => "footer_bottom",
	"std" => "<h3 style=\"margin: 0;\">Footer Bottom</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array(
	"name" => "Background Color",
	"desc" => "Select the background color for footer bottom. Default #000000",
	"id" => "footer_bottom_bg_color",
	"std" => "#000000",
	"type" => "color"
	);

$of_options[] = array(
	"name" => "Text Color",
	"desc" => "Select the color for footer bottom text. Default #666666",
	"id" => "footer_bottom_text_color",
	"std" => "#666666",
	"type" => "color"
	);

//****************************** Ads *******************************************//

$of_options[] = array(
	"name" => "Ads",
	"type" => "heading",
	"icon" => $adminurl . "icon-settings.png"
	);

$of_options[] = array( "name" => "Header Ad",
	"desc" => "",
	"id" => "header_ads_space",
	"std" => "<h3 style='margin: 0;'> Header Ad</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( "name" => "Ad Banner Left 320 x 100",
	"desc" => "Add header left side advertising banner code 320 x 100",
	"id" => "header_ads_left_320_100",
	"std" => "",
	"type" => "textarea",
	);

$of_options[] = array( "name" => "Ad Banner Right 320 x 100",
	"desc" => "Add header right side advertising banner code 320 x 100",
	"id" => "header_ads_right_320_100",
	"std" => "",
	"type" => "textarea",
	);

$of_options[] = array( "name" => "Ad Banner Right 728 x 90",
	"desc" => "Add header right side advertising banner code 728 x 90",
	"id" => "header_ads_right_728_90",
	"std" => "",
	"type" => "textarea",
	);

$of_options[] = array( "name" => "Below Main Menu Ad Banner 728 x 90",
	"id" => "ads_below_mainmenu",
	"std" => "",
	"type" => "textarea",
	);

$of_options[] = array( "name" => "Article Ad",
	"desc" => "",
	"id" => "article_ad",
	"std" => "<h3 style='margin: 0;'> Article Ad</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 	
	"name" => "Article Ad Top",
	"desc" => "Enable or Disable article Ad top. Default: Disable.",
	"id" => "article_top_state",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( "desc" => "",
	"id" => "article_ad_top",
	"std" => "",
	"fold" => "article_top_state",
	"type" => "textarea",
	);


$of_options[] = array( 	
	"name" => "Article Ad Inline",
	"desc" => "Enable or Disable article Ad inline. Default: Disable.",
	"id" => "article_inline_state",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);
$of_options[] = array( "desc" => "",
	"id" => "article_ad_inline",
	"std" => "",
	"fold" => "article_inline_state",
	"type" => "textarea",
	);

$of_options[] = array( "desc" => "Ad Position in Content",
	"id" => "ad_position_content",
	"std" => "left",
	"fold" => "article_inline_state",
	"type" => "images",
	"options" => array(
		"left" => $adminurl."ad-left.png",
		"center" => $adminurl."ad-center.png",
		"right" => $adminurl."ad-right.png",
		));

$of_options[] = array( "desc" => "After witch paragraph the ad will be displayed. For example 0, 1, 2, 3",
	"id" => "paragraph_no",
	"std" => "",
	"fold" => "article_inline_state",
	"type" => "text",
	);

$of_options[] = array( 	
	"name" => "Article Ad Bottom",
	"desc" => "Enable or Disable article Ad bottom. Default: Disable.",
	"id" => "article_bottom_state",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( "desc" => "",
	"id" => "article_ad_bottom",
	"std" => "",
	"fold" => "article_bottom_state",
	"type" => "textarea",
	);

$of_options[] = array( "name" => "Custom Ads",
	"desc" => "",
	"id" => "custom_ads",
	"std" => "<h3 style='margin: 0;'> Custom Ads</h3><br/> <p>Use by Visual Composer</p>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 
	"name" => "Custom Ad 1",
	"desc" => "",
	"id" => "custom_ad1",
	"std" => "",
	"type" => "textarea",
	);

$of_options[] = array( 
	"name" => "Custom Ad 2",
	"desc" => "",
	"id" => "custom_ad2",
	"std" => "",
	"type" => "textarea",
	);

$of_options[] = array( 
	"name" => "Custom Ad 3",
	"desc" => "",
	"id" => "custom_ad3",
	"std" => "",
	"type" => "textarea",
	);

$of_options[] = array( "name" => "Footer Ad",
	"desc" => "",
	"id" => "footer_ad_info",
	"std" => "<h3 style='margin: 0;'> Footer Ad</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( "name" => "Above Footer Ad Banner 728 x 90",
	"id" => "ads_above_footer",
	"std" => "",
	"type" => "textarea",
	);
$of_options[] = array( 
	"name" => "Ad in Footer",
	"desc" => "Above the footer ad",
	"id" => "footer_ad",
	"std" => "",
	"type" => "textarea",
	);

//****************************** TYPOHGRAPHY ***********************************//

$of_options[] = array(
	"name" => "Typography",
	"type" => "heading",
	"icon" => $adminurl . "icon-typography.png"
	);

$of_options[] = array( 
	"name" => "Body",
	"desc" => "",
	"id" => "typography_body",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Body</h3>",
	"icon" => true,
	"type" => "info");


$of_options[] = array( 
	"name" => "Font Family ( Google Fonts )",
	"desc" => "Select your custom font options for your main body font. Default: PT Serif",
	"id" => "google_body",
	"std" => 'PT Serif',
	"preview" => array(
		"text" => "0123456789 abcdefghijklmnopqrstuvwxyz",
		"size" => "16px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( "name" => "Font Family ( Standard Font )",
	"desc" => "If you have a Google Font selected above, it will override the standard font",
	"id" => "standard_body",
	"std" => "",
	"type" => "select",
	"options" => $standard_fonts);

$of_options[] = array( "desc"	=> "",
	"id"  	=> "body_typo",
	"std"	=> array(
		'font_size' => '16',
		'font_weight' => '500',
		'line_height' => '22',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type" 		=> "favethemes_typo"
	);




$of_options[] = array( 
	"name" => "Main Navigation",
	"desc" => "",
	"id" => "main_navigation",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Main Navigation</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 
	"name" => "Font Family ( Google Font )",
	"desc" => "Select font family for main menu. Default: PT Sans Narrow",
	"id" => "google_main_nav",
	"std" => 'PT Sans Narrow',
	"preview" => array(
		"text" => "This is font preview",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"name" => "Font Family ( Standard Font )",
	"desc" => "If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_main_nav",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);


$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "main_nav_typo",
	"std"	=> array(
		'font_size' => '15',
		'font_weight' => '700',
		'line_height' => '20',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);


$of_options[] = array( 
	"name" => "Top Navigation",
	"desc" => "",
	"id" => "top_navigation",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Top Navigation</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 
	"name" => "Font Family ( Google Font )",
	"desc" => "Select font family for top menu. Default: PT Sans Narrow",
	"id" => "google_secondary_nav",
	"std" => 'PT Sans Narrow',
	"preview" => array(
		"text" => "This is font preview",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"name" => "Font Family ( Standard Font )",
	"desc" => "If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_secondary_nav",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);


$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "top_nav_typo",
	"std"	=> array(
		'font_size' => '14',
		'font_weight' => '500',
		'line_height' => '20',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);
/*==================================== Site text logo =======================================*/

$of_options[] = array( 
	"name" => "Website Logo",
	"desc" => "",
	"id" => "typo_logo",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Logo</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 
	"desc" => "Font Family ( Google Font ). Default: Playfair Display",
	"id" => "google_font_logo",
	"std" => 'Playfair Display',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"desc" => "Standard Font. If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_logo",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);


$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "logo_typo",
	"std"	=> array(
		'font_size' => '36',
		'font_weight' => '700',
		'line_height' => '36',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

$of_options[] = array(
	"name" => "Titles",
	"desc" => "",
	"id" => "titles_headings",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Titles Font Family</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array(
	"name" => "Font Family ( Google Font )",
	"desc" => "Select font family for titles and headings. Default: Playfair Display",
	"id" => "google_font_titles",
	"std" => 'Playfair Display',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array(
	"name" => "Font Family ( Standard Font )",
	"desc" => "If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_titles",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);

$of_options[] = array( "desc"	=> "",
	"id"  	=> "titles_typo",
	"std"	=> array(
		'font_size' => '16',
		'font_weight' => '500',
		'line_height' => '24',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type" 		=> "favethemes_typo"
	);

$of_options[] = array(
	"name" => "Modules Labels",
	"desc" => "",
	"id" => "typo_section_modules",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Visual Composer Modules Labels</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array(
	"desc" => "Font Family ( Google Font ). Default: Lato",
	"id" => "google_font_section_title",
	"std" => 'Lato',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array(
	"desc" => "Standard Font. If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_section_title",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);
$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "module_title_typo",
	"std"	=> array(
		'font_size' => '13',
		'font_weight' => '700',
		'line_height' => '13',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

/*==================================== Module Title =======================================*/

$of_options[] = array( 
	"name" => "Visual Composer Modules",
	"desc" => "",
	"id" => "typo_visual_composer_modules",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Visual Composer Modules</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array(
	"desc" => "Font Family ( Google Font ). Default: Playfair Display",
	"id" => "google_font_module_title",
	"std" => 'Playfair Display',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"desc" => "Standard Font. If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_module_title",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);

/*==================================== Post Titles Big =======================================*/



$of_options[] = array(
	"name" => "Module Big Titles",
	"desc"	=> "",
	"id"  	=> "post_title_big_typo",
	"std"	=> array(
		'font_size' => '24',
		'font_weight' => '700',
		'line_height' => '38',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

/*==================================== Post Titles Small =======================================*/


$of_options[] = array(
	"name" => "Module Small Titles",
	"desc"	=> "",
	"id"  	=> "post_title_small_typo",
	"std"	=> array(
		'font_size' => '18',
		'font_weight' => '700',
		'line_height' => '28',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

/*==================================== Post Meta =======================================*/

$of_options[] = array( 
	"name" => "Posts Meta",
	"desc" => "",
	"id" => "typo_post_meta",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Post Meta (Whole site)</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 
	"desc" => "Font Family ( Google Font ). Default: PT Sans Narrow",
	"id" => "google_font_post_meta",
	"std" => 'PT Sans Narrow',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"desc" => "Standard Font. If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_post_meta",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);


$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "post_meta_typo",
	"std"	=> array(
		'font_size' => '14',
		'font_weight' => '700',
		'line_height' => '22',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

/*==================================== Widgets Title =======================================*/

$of_options[] = array( 
	"name" => "Widgets Titles",
	"desc" => "",
	"id" => "typo_widgets_titles",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Widgets Titles</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 
	"desc" => "Font Family ( Google Font ). Default: PT Sans Narrow",
	"id" => "google_font_widget_title",
	"std" => 'PT Sans Narrow',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"desc" => "Standard Font. If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_widget_title",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);

$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "widgets_title_typo",
	"std"	=> array(
		'font_size' => '14',
		'font_weight' => '700',
		'line_height' => '16',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

/*==================================== Breadcrumb =======================================*/

$of_options[] = array( 
	"name" => "Breadcrumb",
	"desc" => "",
	"id" => "typo_breadcrumb",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Breadcrumb</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 
	"desc" => "Font Family ( Google Font ). Default: Lato",
	"id" => "google_font_breadcrumb",
	"std" => 'Lato',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"desc" => "Standard Font. If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_breadcrumb",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);

/*$of_options[] = array(
					"desc" => "Font Weight. Default 500",
					"id" => "breadcrumb_font_weight",
					"std" => "500",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_weight
				);

$of_options[] = array( 	
					"desc" => "Font Size. Default 13",
					"id" => "breadcrumb_font_size",
					"std" => "13",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_sizes
				);
$of_options[] = array( 	
					"desc" => "Line Height. Default 13",
					"id" => "breadcrumb_line_height",
					"std" => "13",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_sizes
					);*/
$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "breadcrumb_typo",
	"std"	=> array(
		'font_size' => '13',
		'font_weight' => '500',
		'line_height' => '13',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

/*==================================== Single Post =======================================*/

$of_options[] = array( 
	"name" => "Single Post",
	"desc" => "",
	"id" => "typo_single_post",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Single Post</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 
	"name" => "Post Title",
	"desc" => "Font Family ( Google Font ). Default: Playfair Display",
	"id" => "google_font_single_title",
	"std" => 'Playfair Display',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"desc" => "Standard Font. If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_single_title",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);

/*$of_options[] = array(
					"desc" => "Font Weight. Default 700",
					"id" => "single_title_font_weight",
					"std" => "700",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_weight
				);

$of_options[] = array( 	
					"desc" => "Font Size. Default 48",
					"id" => "single_title_font_size",
					"std" => "48",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_sizes
				);
$of_options[] = array( 	
					"desc" => "Line Height. Default 56",
					"id" => "single_title_line_height",
					"std" => "56",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_sizes
					);*/
$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "single_title_typo",
	"std"	=> array(
		'font_size' => '48',
		'font_weight' => '700',
		'line_height' => '56',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

/*========================== Single post meta ========================================*/

$of_options[] = array( 
	"name" => "Post Meta",
	"desc" => "Font Family ( Google Font ). Default: PT Sans Narrow",
	"id" => "google_font_single_meta",
	"std" => 'PT Sans Narrow',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"desc" => "Standard Font. If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_single_meta",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);

/*$of_options[] = array(
					"desc" => "Font Weight. Default 700",
					"id" => "single_meta_font_weight",
					"std" => "700",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_weight
				);

$of_options[] = array( 	
					"desc" => "Font Size. Default 14",
					"id" => "single_meta_font_size",
					"std" => "14",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_sizes
				);
$of_options[] = array( 	
					"desc" => "Line Height. Default 22",
					"id" => "single_meta_line_height",
					"std" => "22",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_sizes
					);*/
$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "single_meta_typo",
	"std"	=> array(
		'font_size' => '14',
		'font_weight' => '700',
		'line_height' => '22',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

/*========================== Single post sections titles ========================================*/

$of_options[] = array( 
	"name" => "Post Sections Titles",
	"desc" => "Font Family ( Google Font ). Default: PT Sans Narrow",
	"id" => "google_font_single_sections",
	"std" => 'PT Sans Narrow',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"desc" => "Standard Font. If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_single_sections",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);

/*$of_options[] = array(
					"desc" => "Font Weight. Default 700",
					"id" => "single_sections_font_weight",
					"std" => "700",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_weight
				);

$of_options[] = array( 	
					"desc" => "Font Size. Default 14",
					"id" => "single_sections_font_size",
					"std" => "14",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_sizes
				);
$of_options[] = array( 	
					"desc" => "Line Height. Default 16",
					"id" => "single_sections_line_height",
					"std" => "16",
					"type" => "select",
					"mod" 		=> "mini",
					"options" => $font_sizes
					);*/
$of_options[] = array(
	"desc"	=> "",
	"id"  	=> "single_sections_typo",
	"std"	=> array(
		'font_size' => '14',
		'font_weight' => '700',
		'line_height' => '16',
		'font_style'  => 'normal',
		'letter_spacing' => '0',
		'text_transform' => 'none'
		),
	"type"  => "favethemes_typo"
	);

/*=================================== Headings =======================================*/

$of_options[] = array( 
	"name" => "Headings",
	"desc" => "",
	"id" => "typo_headings",
	"std" => "<h3 style='margin: 0.5em 0; font-size: 2em;'>Headings</h3>",
	"icon" => true,
	"type" => "info");

$of_options[] = array( 
	"name" => "Font Family ( Google Font )",
	"desc" => "Select font family for headings. Default: Playfair Display",
	"id" => "google_font_headings",
	"std" => 'Playfair Display',
	"preview" => array(
		"text" => "This is font preview title",
		"size" => "24px"
		),
	"options" => $fonts_list,
	"type" => "select_google_font"
	);

$of_options[] = array( 
	"name" => "Font Family ( Standard Font )",
	"desc" => "If you have a Google Font selected above, it will override the standard font.",
	"id" => "standard_font_headings",
	"std" => '',
	"options" => $standard_fonts,
	"type" => "select"
	);

$of_options[] = array( 	
	"name" => "H1",
	"desc" => "Font Size. Default 40",
	"id" => "h1_font_size",
	"std" => "40",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);
$of_options[] = array( 	
	"desc" => "Line Height. Default 48",
	"id" => "h1_line_height",
	"std" => "48",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);

$of_options[] = array( 	
	"desc" => "Font Weight. Default 500",
	"id" => "h1_font_weight",
	"std" => "500",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_weight
	);

$of_options[] = array( 	
	"name" => "H2",
	"desc" => "Font Size. Default 32",
	"id" => "h2_font_size",
	"std" => "32",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);

$of_options[] = array( 	
	"desc" => "Line Height. Default 40",
	"id" => "h2_line_height",
	"std" => "40",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);

$of_options[] = array( 	
	"desc" => "Font Weight. Default 500",
	"id" => "h2_font_weight",
	"std" => "500",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_weight
	);

$of_options[] = array( 	
	"name" => "H3",
	"desc" => "Font Size. Default 24",
	"id" => "h3_font_size",
	"std" => "24",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);
$of_options[] = array( 	
	"desc" => "Line Height. Default 32",
	"id" => "h3_line_height",
	"std" => "32",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);

$of_options[] = array( 	
	"desc" => "Font Weight. Default 500",
	"id" => "h3_font_weight",
	"std" => "500",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_weight
	);

$of_options[] = array( 	
	"name" => "H4",
	"desc" => "Font Size. Default 20",
	"id" => "h4_font_size",
	"std" => "20",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);
$of_options[] = array( 	
	"desc" => "Line Height. Default 28",
	"id" => "h4_line_height",
	"std" => "28",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);

$of_options[] = array( 	
	"desc" => "Font Weight. Default 500",
	"id" => "h4_font_weight",
	"std" => "500",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_weight
	);

$of_options[] = array( 	
	"name" => "H5",
	"desc" => "Font Size. Default 18",
	"id" => "h5_font_size",
	"std" => "18",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);
$of_options[] = array( 	
	"desc" => "Line Height. Default 26",
	"id" => "h5_line_height",
	"std" => "26",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);

$of_options[] = array( 	
	"desc" => "Font Weight. Default 700",
	"id" => "h5_font_weight",
	"std" => "700",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_weight
	);

$of_options[] = array( 	
	"name" => "H6",
	"desc" => "Font Size. Default 16",
	"id" => "h6_font_size",
	"std" => "16",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);
$of_options[] = array( 	
	"desc" => "Line Height. Default 24",
	"id" => "h6_line_height",
	"std" => "24",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_sizes
	);

$of_options[] = array( 	
	"desc" => "Font Weight. Default 700",
	"id" => "h6_font_weight",
	"std" => "700",
	"type" => "select",
	"mod" 		=> "mini",
	"options" => $font_weight
	);


//============================ SINGLE POSTS OPTIONS ========================================
$of_options[] = array(
	"name" => "Single Post",
	"type" => "heading",
	"icon" => $icons . "single-post.png"
	);

$of_options[] = array( 	
	"name" => "Post Default Settings",
	"desc" => "",
	"id" => "post_default_settings",
	"std" => "<h3 style=\"margin: 0;\">Post Default Settings</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Default Settings",
	"desc" => "Enable or Disable post default settings, it will overwrite individual post options. Default: Disable.",
	"id" => "single_post_default_settings",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Template",
	"id" => "single_post_default_template",
	"std" => 'a',
	"type" => "images",
	"options" => array(
		'a' => $images_url  . 'post-templates/layout-a.png',
		'd' => $images_url  . 'post-templates/layout-d.png',
		'b' => $images_url  . 'post-templates/layout-b.png',
		'c' => $images_url  . 'post-templates/layout-c.png',
		'e' => $images_url  . 'post-templates/layout-e.png',
		'f' => $images_url  . 'post-templates/layout-f.png'
		)
	);

$of_options[] = array( 	
	"name" => "Sidebar Position",
	"id" => "single_post_default_sidebar_position",
	"std" => 'right',
	"type" => "images",
	"options" => array(
		'none' => $adminurl . 'content_no_sid.png',
		'left' => $adminurl . 'content_sid_left.png',
		'right' => $adminurl . 'content_sid_right.png'
		)
	);

$of_options[] = array( 	
	"name" => "Custom Sidebar",
	"desc" => "Choose standard sidebar to display.",
	"id" => "single_custom_sidebar",
	"std" => "",
	"type" => "select",
	"options" => $of_sidebars
	);

$of_options[] = array( 	
	"name" => "Post Meta",
	"desc" => "",
	"id" => "post_meta",
	"std" => "<h3 style=\"margin: 0;\">Post Meta</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Author Picture",
	"desc" => "Enable or Disable post author picture. Default: Enable.",
	"id" => "single_author_pic",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Author Name",
	"desc" => "Enable or Disable post author name in all website posts. Default: Enable.",
	"id" => "single_author_name",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Author Social links",
	"desc" => "Enable or Disable author social links. Default: Enable.",
	"id" => "single_author_social_link",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Category",
	"desc" => "Enable or Disable post category. Default: Enable.",
	"id" => "single_post_category",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Views",
	"desc" => "Enable or Disable post views. Default: Enable.",
	"id" => "single_views",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Date",
	"desc" => "Enable or Disable post date in all website posts. Default: Enable.",
	"id" => "single_post_date",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Comment Count",
	"desc" => "Enable or Disable post comment count. Default: Enable.",
	"id" => "single_post_comment_count",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

/*$of_options[] = array( 	
					"name" => "Custom Editor Gallery",
					"desc" => "Disable custom theme gallery layout and make it native WordPress thumbnails.",
					"id" => "single_wp_gallery",
					"std" => 1,
					"on" => "Enable",
					"off" => "Disable",
					"type" => "switch"
					);*/	

$of_options[] = array( 	
	"name" => "Social Share Top",
	"desc" => "Enable or Disable social share button in single post page. Default: Enable.",
	"id" => "single_social_top",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Social Share Bottom",
	"desc" => "Enable or Disable social share button in single post page. Default: Enable.",
	"id" => "single_social_bottom",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Post Navigation",
	"desc" => "",
	"id" => "post_navigation",
	"std" => "<h3 style=\"margin: 0;\">Post Navigation</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Previous Post / Next Post",
	"desc" => "Enable or Disable Prev/Next Post buttons in single post page. Default: Enable.",
	"id" => "single_nav_arrows",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Tags",
	"desc" => "",
	"id" => "post_tags",
	"std" => "<h3 style=\"margin: 0;\">Post Tags</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Tags",
	"desc" => "Enable or Disable tags in single post page. Default: Enable.",
	"id" => "single_tags",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Author Box",
	"desc" => "",
	"id" => "post_author_box",
	"std" => "<h3 style=\"margin: 0;\">Post Author Box</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Author Box",
	"desc" => "Enable or Disable author box in single post page. Default: Enable.",
	"id" => "single_author",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Related Posts",
	"desc" => "",
	"id" => "related_posts_info",
	"std" => "<h3 style=\"margin: 0;\">Related Posts</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Related Posts",
	"desc" => "Enable or Disable 'Related Posts' in single post page. Default: Enable.",
	"id" => "single_related",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$related_posts_by = array("related_category" => "Category","related_tags" => "Tags");
$of_options[] = array( 	
	"name" => "Related Posts By Category or Tags",
	"desc" => "Choose related posts option. Default: Category",
	"id" => "single_related_posts_by",
	"std" => "related_category",
	"type" => "radio",
	"options" => $related_posts_by
	);

$of_options[] = array( 	
	"name" => "Related Posts Title",
	"desc" => "Enter title for 'Related Posts' in single post page.",
	"id" => "single_related_title",
	"std" => "Related",
	"type" => "text"
	);

$related_posts = array("2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10" );
$of_options[] = array( 	
	"name" => "Related Posts To Show",
	"desc" => "Select the number of related posts you want to show. Default: 6",
	"id" => "single_related_posts_to_show",
	"std" => "4",
	"type" => "select",
	"options" => $related_posts
	);


//============================ Sidebar Options ===============================================
$of_options[] = array(
	"name" => "Sidebar Options",
	"type" => "heading",
	"icon" => $icons . "single-post.png"
	);

$of_options[] = array(
	"name" => "Sticky Sidebar",
	"desc" => "Enable or Disable sticky sidebar. Default: Disable.",
	"id" => "sticky_sidebar",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
);

$of_options[] = array( 	
	"name" => "Background Color",
	"desc" => "Select the sidebar background color. Default #f7f7f7",
	"id" => "sidebar_bg_color",
	"std" => "#f7f7f7",
	"type" => "color"
	);
$widgets_titles_align = array("left" => "Left","right" => "Right", "center" => "Center" );
$of_options[] = array(
	"name" => "Widgets Titles Align",
	"desc" => "Select widgets titles align. Default: Left",
	"id" => "widget_title_align",
	"std" => "left",
	"type" => "select",
	"options" => $widgets_titles_align
	);

$of_options[] = array( 	"name" 		=> "Border",
	"desc" 		=> "Border for sidebar",
	"id" 		=> "sidebar_border",
	"std" 		=> array(
		'width' => '1',
		'style' => 'solid',
		'color' => '#f9f9f9'
		),
	"type" 		=> "border"
	);
$of_options[] = array( 	
	"name" => "Padding Top",
	"desc" => "Sidebar Padding top. Default 30",
	"id" => "sidebar_pending_top",
	"std" => "30",
	"type" => "text"
	);
$of_options[] = array( 	
	"name" => "Padding Left",
	"desc" => "Sidebar Padding left. Default 30",
	"id" => "sidebar_pending_left",
	"std" => "30",
	"type" => "text"
	);
$of_options[] = array( 	
	"name" => "Padding Bottom",
	"desc" => "Sidebar Padding bottom. Default 30",
	"id" => "sidebar_pending_bottom",
	"std" => "30",
	"type" => "text"
	);
$of_options[] = array( 	
	"name" => "Padding Right",
	"desc" => "Sidebar Padding right. Default 30",
	"id" => "sidebar_pending_right",
	"std" => "30",
	"type" => "text"
	);


//============================ Category POSTS OPTIONS ========================================
$of_options[] = array(
	"name" => "Categories Options",
	"type" => "heading",
	"icon" => $icons . "single-post.png"
	);

$of_options[] = array( 	
	"name" => "Categories Default Settings",
	"desc" => "",
	"id" => "Categories_default_settings",
	"std" => "<h3 style=\"margin: 0;\">Categories Default Settings</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Default Settings",
	"desc" => "Enable or Disable category default settings, it will overwrite individual category options. Default: Disable.",
	"id" => "category_default_settings",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Template",
	"id" => "category_default_template",
	"std" => 'a',
	"type" => "images",
	"options" => $of_category_posts
	);

$of_options[] = array( 	
	"name" => "Sidebar Position",
	"id" => "category_default_sidebar_position",
	"std" => 'right',
	"type" => "images",
	"options" => array(
		'none' => $adminurl . 'content_no_sid.png',
		'left' => $adminurl . 'content_sid_left.png',
		'right' => $adminurl . 'content_sid_right.png'
		)
	);

$of_options[] = array( 	
	"name" => "Custom Sidebar",
	"desc" => "Choose standard sidebar to display.",
	"id" => "category_custom_sidebar",
	"std" => "",
	"type" => "select",
	"options" => $of_sidebars
	);

$of_options[] = array( 	
	"name" => "Post Excerpt",
	"desc" => "Enable/Disable posts excerpt.",
	"id" => "category_post_excerpt",
	"std" => "",
	"type" => "select",
	"options" => array(
		'enable' => 'Enable',
		'disable' => 'Disable'
		)
	);

$of_options[] = array( 	
	"name" => "Show child categories menu:",
	"desc" => "This will show a menu at the top of the block that contains the child categories of the selected category.",
	"id" => "category_child_cats",
	"std" => "",
	"type" => "select",
	"options" => $of_child_cats
	);

$of_options[] = array( 	
	"name" => "Pagination Style",
	"desc" => "Choose Pagination Style.",
	"id" => "category_pagination_style",
	"std" => "",
	"type" => "images",
	"options" => $of_cat_pagination
	);

//============================ Archives Pages OPTIONS ========================================
$of_options[] = array(
	"name" => "Archives Options",
	"type" => "heading",
	"icon" => $icons . "single-post.png"
	);

$of_options[] = array( 	
	"name" => "Archives Default Settings",
	"desc" => "",
	"id" => "archives_default_settings",
	"std" => "<h3 style=\"margin: 0;\">Archives Default Settings</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Template",
	"id" => "archives_template",
	"std" => 'module-a-b',
	"type" => "images",
	"options" => $of_archive_posts
	);

$of_options[] = array( 	
	"name" => "Sidebar Position",
	"id" => "archives_sidebar_position",
	"std" => 'right',
	"type" => "images",
	"options" => array(
		'none' => $adminurl . 'content_no_sid.png',
		'left' => $adminurl . 'content_sid_left.png',
		'right' => $adminurl . 'content_sid_right.png'
		)
	);

$of_options[] = array( 	
	"name" => "Custom Sidebar",
	"desc" => "Choose standard sidebar to display.",
	"id" => "archives_custom_sidebar",
	"std" => "",
	"type" => "select",
	"options" => $of_sidebars
	);

$of_options[] = array( 	
	"name" => "Post Excerpt",
	"desc" => "Enable/Disable posts excerpt.",
	"id" => "archives_post_excerpt",
	"std" => "",
	"type" => "select",
	"options" => array(
		'enable' => 'Enable',
		'disable' => 'Disable'
		)
	);

$of_options[] = array( 	
	"name" => "Pagination Style",
	"desc" => "Choose Pagination Style.",
	"id" => "archives_pagination_style",
	"std" => "numeric",
	"type" => "images",
	"options" => $of_cat_pagination
	);

/*========================================================================
= Galleries
=========================================================================*/

$of_options[] = array(
	"name" => "Single Gallery",
	"type" => "heading",
	"icon" => $adminurl . "icon-posts.png"
	);


$of_options[] = array( 	
	"name" => "Gallery Post Default Settings",
	"desc" => "",
	"id" => "gallery_post_default_settings",
	"std" => "<h3 style=\"margin: 0;\">Single Gallery Default Settings</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Default Settings",
	"desc" => "Enable or Disable post default settings, it will overwrite individual post options. Default: Disable.",
	"id" => "single_gallery_default_settings",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Template",
	"id" => "single_gallery_default_template",
	"std" => 'a',
	"type" => "images",
	"options" => array(
		'a' => $images_url  . 'post-templates/layout-0.png',
		'b' => $images_url  . 'post-templates/layout-3.png'
		)
	);

$of_options[] = array( 	
	"name" => "Sidebar Position",
	"id" => "single_gallery_default_sidebar_position",
	"std" => 'right',
	"type" => "images",
	"options" => array(
		'none' => $adminurl . 'content_no_sid.png',
		'left' => $adminurl . 'content_sid_left.png',
		'right' => $adminurl . 'content_sid_right.png'
		)
	);

$of_options[] = array( 	
	"name" => "Custom Sidebar",
	"desc" => "Choose standard sidebar to display.",
	"id" => "single_gallery_custom_sidebar",
	"std" => "",
	"type" => "select",
	"options" => $of_sidebars
	);

$of_options[] = array( 	
	"name" => "Post Meta",
	"desc" => "",
	"id" => "gallery_meta",
	"std" => "<h3 style=\"margin: 0;\">Gallery Post Meta</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Author Picture",
	"desc" => "Enable or Disable post author picture. Default: Enable.",
	"id" => "single_gallery_author_pic",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Author Name",
	"desc" => "Enable or Disable post author name. Default: Enable.",
	"id" => "single_gallery_author_name",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Author Social links",
	"desc" => "Enable or Disable author social links. Default: Enable.",
	"id" => "single_gallery_author_social_link",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Gallery Category",
	"desc" => "Enable or Disable post category. Default: Enable.",
	"id" => "single_gallery_category",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Gallery Post Views",
	"desc" => "Enable or Disable post views. Default: Enable.",
	"id" => "single_gallery_views",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Gallery Post Date",
	"desc" => "Enable or Disable post date in all website posts. Default: Enable.",
	"id" => "single_gallery_date",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Gallery Post Comment Count",
	"desc" => "Enable or Disable post comment count. Default: Enable.",
	"id" => "single_gallery_comment_count",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Social Share Top",
	"desc" => "Enable or Disable social share button in single post page. Default: Enable.",
	"id" => "single_gallery_social_top",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Social Share Bottom",
	"desc" => "Enable or Disable social share button in single post page. Default: Enable.",
	"id" => "single_gallery_social_bottom",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Gallery Post Navigation",
	"desc" => "",
	"id" => "gallery_post_navigation",
	"std" => "<h3 style=\"margin: 0;\">Gallery Post Navigation</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Previous Gallery / Next Gallery",
	"desc" => "Enable or Disable Prev/Next gallery buttons in single gallery page. Default: Enable.",
	"id" => "single_gallery_nav_arrows",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Gallery Post Tags",
	"desc" => "",
	"id" => "gallery_post_tags",
	"std" => "<h3 style=\"margin: 0;\">Gallery Post Tags</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Tags",
	"desc" => "Enable or Disable tags in single post page. Default: Enable.",
	"id" => "single_gallery_tags",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Author Box",
	"desc" => "",
	"id" => "gallery_post_author_box",
	"std" => "<h3 style=\"margin: 0;\">Gallery Author Box</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Gallery Author Box",
	"desc" => "Enable or Disable gallery author box in single gallery page. Default: Enable.",
	"id" => "gallery_single_author",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Related Galleries",
	"desc" => "",
	"id" => "related_gallery_info",
	"std" => "<h3 style=\"margin: 0;\">Related Galleries</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Related Galleries",
	"desc" => "Enable or Disable 'Related Galleries' in single gallery post page. Default: Enable.",
	"id" => "gallery_single_related",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Related Galleries Title",
	"desc" => "Type the title for 'Related Galleries' in single gallery post page.",
	"id" => "gallery_single_related_title",
	"std" => "Related Galleries",
	"type" => "text"
	);

$of_options[] = array( 	
	"name" => "Related Galleries To Show",
	"desc" => "Select the number of related galleries you want to show.",
	"id" => "single_related_galleries_to_show",
	"std" => "6",
	"type" => "select",
	"options" => $related_posts
	);

/*========================================================================
= Single Videos Option
=========================================================================*/

$of_options[] = array(
	"name" => "Single Video",
	"type" => "heading",
	"icon" => $adminurl . "icon-posts.png"
	);


$of_options[] = array( 	
	"name" => "Video Post Default Settings",
	"desc" => "",
	"id" => "video_post_default_settings",
	"std" => "<h3 style=\"margin: 0;\">Single Video Default Settings</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Default Settings",
	"desc" => "Enable or Disable post default settings, it will overwrite individual post options. Default: Disable.",
	"id" => "single_video_default_settings",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Template",
	"id" => "single_video_default_template",
	"std" => 'a',
	"type" => "images",
	"options" => array(
		'a' => $images_url  . 'post-templates/layout-0.png',
		'b' => $images_url  . 'post-templates/layout-3.png'
		)
	);

$of_options[] = array( 	
	"name" => "Sidebar Position",
	"id" => "single_video_default_sidebar_position",
	"std" => 'right',
	"type" => "images",
	"options" => array(
		'none' => $adminurl . 'content_no_sid.png',
		'left' => $adminurl . 'content_sid_left.png',
		'right' => $adminurl . 'content_sid_right.png'
		)
	);

$of_options[] = array( 	
	"name" => "Custom Sidebar",
	"desc" => "Choose standard sidebar to display.",
	"id" => "single_video_custom_sidebar",
	"std" => "",
	"type" => "select",
	"options" => $of_sidebars
	);

$of_options[] = array( 	
	"name" => "Post Meta",
	"desc" => "",
	"id" => "video_meta",
	"std" => "<h3 style=\"margin: 0;\">Video Post Meta</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Author Picture",
	"desc" => "Enable or Disable post author picture. Default: Enable.",
	"id" => "single_video_author_pic",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Author Name",
	"desc" => "Enable or Disable post author name. Default: Enable.",
	"id" => "single_video_author_name",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Author Social links",
	"desc" => "Enable or Disable author social links. Default: Enable.",
	"id" => "single_video_author_social_link",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Video Category",
	"desc" => "Enable or Disable post category. Default: Enable.",
	"id" => "single_video_category",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Video Post Views",
	"desc" => "Enable or Disable post views. Default: Enable.",
	"id" => "single_video_views",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Video Post Date",
	"desc" => "Enable or Disable post date in all website posts. Default: Enable.",
	"id" => "single_video_date",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Video Post Comment Count",
	"desc" => "Enable or Disable post comment count. Default: Enable.",
	"id" => "single_video_comment_count",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Social Share Top",
	"desc" => "Enable or Disable social share button in single post page. Default: Enable.",
	"id" => "single_video_social_top",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Social Share Bottom",
	"desc" => "Enable or Disable social share button in single post page. Default: Enable.",
	"id" => "single_video_social_bottom",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Video Post Navigation",
	"desc" => "",
	"id" => "video_post_navigation",
	"std" => "<h3 style=\"margin: 0;\">Video Post Navigation</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Previous Video / Next Video",
	"desc" => "Enable or Disable Prev/Next video buttons in single video page. Default: Enable.",
	"id" => "single_video_nav_arrows",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Video Post Tags",
	"desc" => "",
	"id" => "video_post_tags",
	"std" => "<h3 style=\"margin: 0;\">Video Post Tags</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Tags",
	"desc" => "Enable or Disable tags in single post page. Default: Enable.",
	"id" => "single_video_tags",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array( 	
	"name" => "Post Author Box",
	"desc" => "",
	"id" => "video_post_author_box",
	"std" => "<h3 style=\"margin: 0;\">Video Author Box</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Video Author Box",
	"desc" => "Enable or Disable video author box in single video page. Default: Enable.",
	"id" => "video_single_author",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Related Videos",
	"desc" => "",
	"id" => "related_video_info",
	"std" => "<h3 style=\"margin: 0;\">Related Videos</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array( 	
	"name" => "Related Videos",
	"desc" => "Enable or Disable 'Related Videos' in single video post page. Default: Enable.",
	"id" => "video_single_related",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( 	
	"name" => "Related Videos Title",
	"desc" => "Type the title for 'Related Videos' in single post page.",
	"id" => "video_single_related_title",
	"std" => "Related Videos",
	"type" => "text"
	);

$of_options[] = array( 	
	"name" => "Related Videos To Show",
	"desc" => "Select the number of related videos you want to show.",
	"id" => "single_related_videos_to_show",
	"std" => "6",
	"type" => "select",
	"options" => $related_posts
	);


//*----------------------------------------------------------------------------------------
//  Widgets Meta
//-----------------------------------------------------------------------------------------*/
$of_options[] = array(
	"name" => "Widgets Meta",
	"type" => "heading",
	"icon" => $adminurl . "icon-settings.png"
	);

$of_options[] = array(
	"name" => "Time Difference",
	"desc" => "Enable or Disable Human Readable time difference. Default: Enable.",
	"id" => "widget_time_diff",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
);

$of_options[] = array(
	"name" => "Author name",
	"desc" => "Enable or Disable author name in posts. Default: Enable.",
	"id" => "widget_author_name",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array(
	"name" => "Date",
	"desc" => "Enable or Disable date in posts, will work when 'Time Difference' will be disable. Default: Disable.",
	"id" => "widget_date",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array(
	"name" => "Time",
	"desc" => "Enable or Disable time in posts, will work when 'Time Difference' will be disable. Default: Disable",
	"id" => "widget_time",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array(
	"name" => "View Count",
	"desc" => "Enable or Disable view count in posts. Default: Enable.",
	"id" => "widget_view_count",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);

$of_options[] = array(
	"name" => "Comment Count",
	"desc" => "Enable or Disable comment count in posts. Default: Enable.",
	"id" => "widget_comment_count",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);
$of_options[] = array(
	"name" => "Category",
	"desc" => "Enable or Disable category posts. Default: Enable.",
	"id" => "widget_category",
	"std" => 1,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
);

/*========================================================================
= Social Media
=========================================================================*/
$of_options[] = array( 	"name" => "Social Profiles",
	"type" => "heading",
	"icon" => $adminurl . "icon-social.png"
	);


$of_options[] = array( 	
	"name" => "Top Menu Social Profiles",
	"desc" => "Enable or Disable top menu socical links. Default: Disable",
	"id" => "top_social_profiles",
	"std" => 0,
	"on" => "Enable",
	"off" => "Disable",
	"type" => "switch"
	);


$of_options[] = array( "name" => "Enter your profiles full URL",
	"desc" => "RSS Feed",
	"id" => "sp_feed",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Facebook",
	"id" => "sp_facebook",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Twitter",
	"id" => "sp_twitter",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Google +",
	"id" => "sp_google",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "LinkedIn",
	"id" => "sp_linkedin",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Instagram",
	"id" => "sp_instagram",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Flickr",
	"id" => "sp_flickr",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Vimeo",
	"id" => "sp_vimeo",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "YouTube",
	"id" => "sp_youtube",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Dribble",
	"id" => "sp_dribble",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Pinterest",
	"id" => "sp_pinterest",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "FourSquare",
	"id" => "sp_foursquare",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Tumblr",
	"id" => "sp_tumblr",
	"std" => "",
	"type" => "text");

/*========================================================================
= Social Media
=========================================================================*/
$of_options[] = array( 	"name" => "Social Counter",
	"type" => "heading",
	"icon" => $adminurl . "icon-social.png"
	);

$of_options[] = array(
	"name" => "Facebook",
	"desc" => "",
	"id" => "facebook",
	"std" => "<h3 style=\"margin: 15px 0; font-size: 2.5em;\">Facebook</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array(
	"name" => "Facebook Page URL",
	"desc" => "Please enter your page url. For example https://www.facebook.com/favethemes",
	"id" => "facebook_count_id",
	"std" => '',
	"type" => "text"
	);

$of_options[] = array(
	"name" => "Twitter",
	"desc" => "",
	"id" => "twitter",
	"std" => "<h3 style=\"margin: 15px 0; font-size: 2.5em;\">Twitter</h3>",
	"icon" => false,
	"type" => "info"
	);

$of_options[] = array(
	"name" => "Twitter Username",
	"desc" => "Please enter you twitter username. For example favethemes",
	"id" => "twitter_uname",
	"std" => '',
	"type" => "text"
	);

$of_options[] = array(
	"name" => "Twitter Consumer Key",
	"desc" => "Please create an app on Twitter through this link:<a target='_blank' href='https://dev.twitter.com/apps'>https://dev.twitter.com/apps</a> and get this information.",
	"id" => "twitter_com_key",
	"std" => '',
	"type" => "text"
	);
$of_options[] = array(
	"name" => "Twitter Consumer Secret",
	"desc" => "Please create an app on Twitter through this link:<a target='_blank' href='https://dev.twitter.com/apps'>https://dev.twitter.com/apps</a> and get this information.",
	"id" => "twitter_com_secret",
	"std" => '',
	"type" => "text"
	);
$of_options[] = array(
	"name" => "Twitter Access Token",
	"desc" => "Please create an app on Twitter through this link:<a target='_blank' href='https://dev.twitter.com/apps'>https://dev.twitter.com/apps</a> and get this information.",
	"id" => "twitter_access_token",
	"std" => '',
	"type" => "text"
	);
$of_options[] = array(
	"name" => "Twitter Access Token Secret",
	"desc" => "Please create an app on Twitter through this link:<a target='_blank' href='https://dev.twitter.com/apps'>https://dev.twitter.com/apps</a> and get this information.",
	"id" => "twitter_access_token_secret",
	"std" => '',
	"type" => "text"
	);


$of_options[] = array(
	"name" => "Google +",
	"desc" => "",
	"id" => "google_plus",
	"std" => "<h3 style=\"margin: 15px 0; font-size: 2.5em;\">Google +</h3>",
	"icon" => false,
	"type" => "info"
	);
$of_options[] = array(
	"name" => "Google Plus Page Name or Profile ID",
	"desc" => "Please enter the page name or profile ID.For example:If your page url is https://plus.google.com/+BBCNews then your page name is +BBCNews",
	"id" => "google_page_id",
	"std" => '',
	"type" => "text"
	);

$of_options[] = array(
	"name" => "Google API Key",
	"desc" => 'To get your API Key, first create a project/app in <a target="_blank" href="https://console.developers.google.com/project">https://console.developers.google.com/project</a> and then turn on Google+ API from "APIs & auth >APIs inside your project.Then again go to "APIs & auth > APIs > Credentials > Public API access" and then click "CREATE A NEW KEY" button, select the "Browser key" option and click in the "CREATE" button, and then copy your API key and paste in above field.',
	"id" => "google_api_key",
	"std" => '',
	"type" => "text"
	);

$of_options[] = array(
	"name" => "Instagram",
	"desc" => "",
	"id" => "Instagram",
	"std" => "<h3 style=\"margin: 15px 0; font-size: 2.5em;\">Instagram</h3>",
	"icon" => false,
	"type" => "info"
	);
$of_options[] = array(
	"name" => "User Name",
	"desc" => "Please enter the instagram user name",
	"id" => "instagram_u_name",
	"std" => '',
	"type" => "text"
	);
$of_options[] = array(
	"name" => "User ID",
	"desc" => "Please enter the instagram user ID.You can get this information from <a target='_blank' href='http://www.pinceladasdaweb.com.br/instagram/access-token/'>http://www.pinceladasdaweb.com.br/instagram/access-token/</a>",
	"id" => "instagram_u_id",
	"std" => '',
	"type" => "text"
	);

$of_options[] = array(
	"name" => "Access Tiken",
	"desc" => "Please enter the instagram user ID.You can get this information from <a target='_blank' href='http://www.pinceladasdaweb.com.br/instagram/access-token/'>http://www.pinceladasdaweb.com.br/instagram/access-token/</a>",
	"id" => "instagram_access_token",
	"std" => '',
	"type" => "text"
	);

$of_options[] = array(
	"name" => "Youtube",
	"desc" => "",
	"id" => "youtube",
	"std" => "<h3 style=\"margin: 15px 0; font-size: 2.5em;\">Youtube</h3>",
	"icon" => false,
	"type" => "info"
	);
$of_options[] = array(
	"name" => "Youtube Channel URL",
	"desc" => "Please enter the channel url",
	"id" => "yt_ch_url",
	"std" => '',
	"type" => "text"
	);
$of_options[] = array(
	"name" => "Youtube Channel ID",
	"desc" => "Please enter the youtube channel ID.Your channel ID looks like: UC4WMyzBds5sSZcQxyAhxJ8g. And please note that your channel ID is different from username.Please go <a target='_blank' href='https://support.google.com/youtube/answer/3250431?hl=en'>here</a> to know how to get your channel ID.",
	"id" => "yt_ch_id",
	"std" => '',
	"type" => "text"
	);

$of_options[] = array(
	"name" => "Youtube API",
	"desc" => 'To get your API Key, first create a project/app in <a href="https://console.developers.google.com/project" target="_blank">https://console.developers.google.com/project</a> and then turn on both Youtube Data and Analytics API from "APIs & auth >APIs inside your project.Then again go to "APIs & auth > APIs > Credentials > Public API access" and then click "CREATE A NEW KEY" button, select the "Browser key" option and click in the "CREATE" button, and then copy your API key and paste in above field.',
	"id" => "yt_ch_api",
	"std" => '',
	"type" => "text"
	);

/*=================================================================
= CUSTOM CODE
===================================================================*/
$of_options[] = array( 	"name" => "Custom Code",
	"type" => "heading",
	"icon" => $adminurl . "icon-code.png"
	);

$of_options[] = array( 	
	"name" => "Custom CSS",
	"desc" => "Enter custom CSS code. The code will be added to the header.",
	"id" => "custom_css",
	"std" => "",
	"type" => "textarea"
	);

$of_options[] = array( 	
	"name" => "Custom JavaScript/Analytics Header",
	"desc" => "Enter JavaScript and/or Analytics code wich will appear in the Header of your site",
	"id" => "custom_js_header",
	"std" => "",
	"type" => "textarea"
	);

$of_options[] = array( 	
	"name" => "Custom JavaScript/Analytics Footer",
	"desc" => "Enter JavaScript and/or Analytics code wich will appear in the Footer of your site",
	"id" => "custom_js_footer",
	"std" => "",
	"type" => "textarea"
	);

/*======================================================================
			PAGE 404
			========================================================================*/
			$of_options[] = array( 	"name" => "Page 404",
				"type" => "heading",
				"icon" => $adminurl . "icon-page404.png"
				);

			$of_options[] = array( 	
				"name" => "Page Title",
				"desc" => "Enter a title for 404 page not found",
				"id" => "error_title",
				"std" => "Oh oh! Page not found.",
				"type" => "text"
				);

			$of_options[] = array( 
				"name" => "Page Description",
				"desc" => "",
				"id" => "error_des",
				"std" => "We're sorry, but the page you are looking for doesn't exist.<br>
				You can search your topic using the box below or return to the homepage.",
				"type" => "textarea"
				);				


/*======================================================================
			Footer 404
			========================================================================*/
			$of_options[] = array( 	"name" => "Footer",
				"type" => "heading",
				"icon" => $adminurl . "icon-footer.png"
				);

			$of_options[] = array( 	
				"name" => "Footer Columns",
				"desc" => '',
				"id" => "footer_layout",
				"std" => 'col-3',
				"type" => "images",
				"options" => array(
					'col-1' => $adminurl . 'footer_1_cols.png',
					'col-2' => $adminurl . 'footer_2_cols.png',
					'col-3' => $adminurl . 'footer_3_cols.png',
					'col-4' => $adminurl . 'footer_4_cols.png'
					)
				);

			$of_options[] = array( 	
				"name" => "Footer Copyright",
				"desc" => "Enter website copyright text in the footer",
				"id" => "copyright_text",
				"std" => "&copy; Copyright 2015 - Cooked with love by <a href='http://favethemes.com' target='_blank'>Favethemes</a>",
				"type" => "text"
				);

// BACKUP OPTIONS
			$of_options[] = array( 	"name" => "Backup Options",
				"type" => "heading",
				"icon" => $adminurl . "icon-backup.png"
				);

			$of_options[] = array( 	"name" => "Backup and Restore Options",
				"id" => "of_backup",
				"std" => "",
				"type" => "backup",
				"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);

			$of_options[] = array( 	"name" => "Transfer Theme Options Data",
				"id" => "of_transfer",
				"std" => "",
				"type" => "transfer",
				"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>