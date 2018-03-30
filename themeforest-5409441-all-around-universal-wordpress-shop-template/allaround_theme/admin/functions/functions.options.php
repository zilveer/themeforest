<?php 
/**
 * SMOF Modified / AllAround
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @theme AllAround
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		global $allaround_data;

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

		//Sidebars
		$sidebars = array();
		if ( $allaround_data['sidebar'] ) : $sidebar = $allaround_data['sidebar']; else : $sidebar = array ( '1' ); endif;
		$sidebars[] = 'None';
		foreach ( $sidebar as $single_sidebar ) {
			$title = sanitize_title( $single_sidebar['title'] );
			if ( $title !== '' ) $sidebars[] = $title;
		}			

		//Revsliders
		if ( in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			global $wpdb;
			$get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
			if($get_sliders) {
				foreach($get_sliders as $slider) {
					$revsliders[$slider->alias] = $slider->alias;
				}
			}
			else {
				$revsliders = array ("No Slider Templates." => "No Slider Templates.");
			}
			$page_sliders = array (
							"revolution" 	=> "Revolution",
							"icarousel"		=> "iCarousel",
							"3dslider"		=> "3DSlider"
						);
		}
		else {
			$revsliders = array ("Revolution Slider not installed." => "Revolution Slider not installed.");
			$page_sliders = array (
							"icarousel"		=> "iCarousel",
							"3dslider"		=> "3DSlider"
						);
		}


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
$fonts = array( 'Arial' => 'Arial, Helvetica, sans-serif', 'Lucida Sans Unicode' => 'Lucida Sans Unicode, Lucida Grande, sans-serif', 'Georgia' => 'Georgia, serif', 'Impact' => 'Impact, Charcoal, sans-serif', 'Palatino Linotype' => 'Palatino Linotype, Book Antiqua, Palatino, serif', 'Tahome' => 'Tahoma, Geneva, sans-serif', 'Trebuchet MS' => 'Trebuchet MS, Helvetica, sans-serif', 'Times New Roman' => 'Times New Roman, Times, serif', 'Verdana' => 'Verdana, Geneva, sans-serif', /* Google Fonts */ "ABeeZee" => "ABeeZee", "Abel" => "Abel", "Abril Fatface" => "Abril Fatface", "Aclonica" => "Aclonica", "Acme" => "Acme", "Actor" => "Actor", "Adamina" => "Adamina", "Advent Pro" => "Advent Pro", "Aguafina Script" => "Aguafina Script", "Akronim" => "Akronim", "Aladin" => "Aladin", "Aldrich" => "Aldrich", "Alegreya" => "Alegreya", "Alegreya SC" => "Alegreya SC", "Alex Brush" => "Alex Brush", "Alfa Slab One" => "Alfa Slab One", "Alice" => "Alice", "Alike" => "Alike", "Alike Angular" => "Alike Angular", "Allan" => "Allan", "Allerta" => "Allerta", "Allerta Stencil" => "Allerta Stencil", "Allura" => "Allura", "Almendra" => "Almendra", "Almendra Display" => "Almendra Display", "Almendra SC" => "Almendra SC", "Amarante" => "Amarante", "Amaranth" => "Amaranth", "Amatic SC" => "Amatic SC", "Amethysta" => "Amethysta", "Anaheim" => "Anaheim", "Andada" => "Andada", "Andika" => "Andika", "Angkor" => "Angkor", "Annie Use Your Telescope" => "Annie Use Your Telescope", "Anonymous Pro" => "Anonymous Pro", "Antic" => "Antic", "Antic Didone" => "Antic Didone", "Antic Slab" => "Antic Slab", "Anton" => "Anton", "Arapey" => "Arapey", "Arbutus" => "Arbutus", "Arbutus Slab" => "Arbutus Slab", "Architects Daughter" => "Architects Daughter", "Archivo Black" => "Archivo Black", "Archivo Narrow" => "Archivo Narrow", "Arimo" => "Arimo", "Arizonia" => "Arizonia", "Armata" => "Armata", "Artifika" => "Artifika", "Arvo" => "Arvo", "Asap" => "Asap", "Asset" => "Asset", "Astloch" => "Astloch", "Asul" => "Asul", "Atomic Age" => "Atomic Age", "Aubrey" => "Aubrey", "Audiowide" => "Audiowide", "Autour One" => "Autour One", "Average" => "Average", "Average Sans" => "Average Sans", "Averia Gruesa Libre" => "Averia Gruesa Libre", "Averia Libre" => "Averia Libre", "Averia Sans Libre" => "Averia Sans Libre", "Averia Serif Libre" => "Averia Serif Libre", "Bad Script" => "Bad Script", "Balthazar" => "Balthazar", "Bangers" => "Bangers", "Basic" => "Basic", "Battambang" => "Battambang", "Baumans" => "Baumans", "Bayon" => "Bayon", "Belgrano" => "Belgrano", "Belleza" => "Belleza", "BenchNine" => "BenchNine", "Bentham" => "Bentham", "Berkshire Swash" => "Berkshire Swash", "Bevan" => "Bevan", "Bigelow Rules" => "Bigelow Rules", "Bigshot One" => "Bigshot One", "Bilbo" => "Bilbo", "Bilbo Swash Caps" => "Bilbo Swash Caps", "Bitter" => "Bitter", "Black Ops One" => "Black Ops One", "Bokor" => "Bokor", "Bonbon" => "Bonbon", "Boogaloo" => "Boogaloo", "Bowlby One" => "Bowlby One", "Bowlby One SC" => "Bowlby One SC", "Brawler" => "Brawler", "Bree Serif" => "Bree Serif", "Bubblegum Sans" => "Bubblegum Sans", "Bubbler One" => "Bubbler One", "Buda" => "Buda", "Buenard" => "Buenard", "Butcherman" => "Butcherman", "Butterfly Kids" => "Butterfly Kids", "Cabin" => "Cabin", "Cabin Condensed" => "Cabin Condensed", "Cabin Sketch" => "Cabin Sketch", "Caesar Dressing" => "Caesar Dressing", "Cagliostro" => "Cagliostro", "Calligraffitti" => "Calligraffitti", "Cambo" => "Cambo", "Candal" => "Candal", "Cantarell" => "Cantarell", "Cantata One" => "Cantata One", "Cantora One" => "Cantora One", "Capriola" => "Capriola", "Cardo" => "Cardo", "Carme" => "Carme", "Carrois Gothic" => "Carrois Gothic", "Carrois Gothic SC" => "Carrois Gothic SC", "Carter One" => "Carter One", "Caudex" => "Caudex", "Cedarville Cursive" => "Cedarville Cursive", "Ceviche One" => "Ceviche One", "Changa One" => "Changa One", "Chango" => "Chango", "Chau Philomene One" => "Chau Philomene One", "Chela One" => "Chela One", "Chelsea Market" => "Chelsea Market", "Chenla" => "Chenla", "Cherry Cream Soda" => "Cherry Cream Soda", "Cherry Swash" => "Cherry Swash", "Chewy" => "Chewy", "Chicle" => "Chicle", "Chivo" => "Chivo", "Cinzel" => "Cinzel", "Cinzel Decorative" => "Cinzel Decorative", "Clicker Script" => "Clicker Script", "Coda" => "Coda", "Coda Caption" => "Coda Caption", "Codystar" => "Codystar", "Combo" => "Combo", "Comfortaa" => "Comfortaa", "Coming Soon" => "Coming Soon", "Concert One" => "Concert One", "Condiment" => "Condiment", "Content" => "Content", "Contrail One" => "Contrail One", "Convergence" => "Convergence", "Cookie" => "Cookie", "Copse" => "Copse", "Corben" => "Corben", "Courgette" => "Courgette", "Cousine" => "Cousine", "Coustard" => "Coustard", "Covered By Your Grace" => "Covered By Your Grace", "Crafty Girls" => "Crafty Girls", "Creepster" => "Creepster", "Crete Round" => "Crete Round", "Crimson Text" => "Crimson Text", "Croissant One" => "Croissant One", "Crushed" => "Crushed", "Cuprum" => "Cuprum", "Cutive" => "Cutive", "Cutive Mono" => "Cutive Mono", "Damion" => "Damion", "Dancing Script" => "Dancing Script", "Dangrek" => "Dangrek", "Dawning of a New Day" => "Dawning of a New Day", "Days One" => "Days One", "Delius" => "Delius", "Delius Swash Caps" => "Delius Swash Caps", "Delius Unicase" => "Delius Unicase", "Della Respira" => "Della Respira", "Denk One" => "Denk One", "Devonshire" => "Devonshire", "Didact Gothic" => "Didact Gothic", "Diplomata" => "Diplomata", "Diplomata SC" => "Diplomata SC", "Domine" => "Domine", "Donegal One" => "Donegal One", "Doppio One" => "Doppio One", "Dorsa" => "Dorsa", "Dosis" => "Dosis", "Dr Sugiyama" => "Dr Sugiyama", "Droid Sans" => "Droid Sans", "Droid Sans Mono" => "Droid Sans Mono", "Droid Serif" => "Droid Serif", "Duru Sans" => "Duru Sans", "Dynalight" => "Dynalight", "EB Garamond" => "EB Garamond", "Eagle Lake" => "Eagle Lake", "Eater" => "Eater", "Economica" => "Economica", "Electrolize" => "Electrolize", "Elsie" => "Elsie", "Elsie Swash Caps" => "Elsie Swash Caps", "Emblema One" => "Emblema One", "Emilys Candy" => "Emilys Candy", "Engagement" => "Engagement", "Englebert" => "Englebert", "Enriqueta" => "Enriqueta", "Erica One" => "Erica One", "Esteban" => "Esteban", "Euphoria Script" => "Euphoria Script", "Ewert" => "Ewert", "Exo" => "Exo", "Expletus Sans" => "Expletus Sans", "Fanwood Text" => "Fanwood Text", "Fascinate" => "Fascinate", "Fascinate Inline" => "Fascinate Inline", "Faster One" => "Faster One", "Fasthand" => "Fasthand", "Federant" => "Federant", "Federo" => "Federo", "Felipa" => "Felipa", "Fenix" => "Fenix", "Finger Paint" => "Finger Paint", "Fjalla One" => "Fjalla One", "Fjord One" => "Fjord One", "Flamenco" => "Flamenco", "Flavors" => "Flavors", "Fondamento" => "Fondamento", "Fontdiner Swanky" => "Fontdiner Swanky", "Forum" => "Forum", "Francois One" => "Francois One", "Freckle Face" => "Freckle Face", "Fredericka the Great" => "Fredericka the Great", "Fredoka One" => "Fredoka One", "Freehand" => "Freehand", "Fresca" => "Fresca", "Frijole" => "Frijole", "Fruktur" => "Fruktur", "Fugaz One" => "Fugaz One", "GFS Didot" => "GFS Didot", "GFS Neohellenic" => "GFS Neohellenic", "Gabriela" => "Gabriela", "Gafata" => "Gafata", "Galdeano" => "Galdeano", "Galindo" => "Galindo", "Gentium Basic" => "Gentium Basic", "Gentium Book Basic" => "Gentium Book Basic", "Geo" => "Geo", "Geostar" => "Geostar", "Geostar Fill" => "Geostar Fill", "Germania One" => "Germania One", "Gilda Display" => "Gilda Display", "Give You Glory" => "Give You Glory", "Glass Antiqua" => "Glass Antiqua", "Glegoo" => "Glegoo", "Gloria Hallelujah" => "Gloria Hallelujah", "Goblin One" => "Goblin One", "Gochi Hand" => "Gochi Hand", "Gorditas" => "Gorditas", "Goudy Bookletter 1911" => "Goudy Bookletter 1911", "Graduate" => "Graduate", "Grand Hotel" => "Grand Hotel", "Gravitas One" => "Gravitas One", "Great Vibes" => "Great Vibes", "Griffy" => "Griffy", "Gruppo" => "Gruppo", "Gudea" => "Gudea", "Habibi" => "Habibi", "Hammersmith One" => "Hammersmith One", "Hanalei" => "Hanalei", "Hanalei Fill" => "Hanalei Fill", "Handlee" => "Handlee", "Hanuman" => "Hanuman", "Happy Monkey" => "Happy Monkey", "Headland One" => "Headland One", "Henny Penny" => "Henny Penny", "Herr Von Muellerhoff" => "Herr Von Muellerhoff", "Holtwood One SC" => "Holtwood One SC", "Homemade Apple" => "Homemade Apple", "Homenaje" => "Homenaje", "IM Fell DW Pica" => "IM Fell DW Pica", "IM Fell DW Pica SC" => "IM Fell DW Pica SC", "IM Fell Double Pica" => "IM Fell Double Pica", "IM Fell Double Pica SC" => "IM Fell Double Pica SC", "IM Fell English" => "IM Fell English", "IM Fell English SC" => "IM Fell English SC", "IM Fell French Canon" => "IM Fell French Canon", "IM Fell French Canon SC" => "IM Fell French Canon SC", "IM Fell Great Primer" => "IM Fell Great Primer", "IM Fell Great Primer SC" => "IM Fell Great Primer SC", "Iceberg" => "Iceberg", "Iceland" => "Iceland", "Imprima" => "Imprima", "Inconsolata" => "Inconsolata", "Inder" => "Inder", "Indie Flower" => "Indie Flower", "Inika" => "Inika", "Irish Grover" => "Irish Grover", "Istok Web" => "Istok Web", "Italiana" => "Italiana", "Italianno" => "Italianno", "Jacques Francois" => "Jacques Francois", "Jacques Francois Shadow" => "Jacques Francois Shadow", "Jim Nightshade" => "Jim Nightshade", "Jockey One" => "Jockey One", "Jolly Lodger" => "Jolly Lodger", "Josefin Sans" => "Josefin Sans", "Josefin Slab" => "Josefin Slab", "Joti One" => "Joti One", "Judson" => "Judson", "Julee" => "Julee", "Julius Sans One" => "Julius Sans One", "Junge" => "Junge", "Jura" => "Jura", "Just Another Hand" => "Just Another Hand", "Just Me Again Down Here" => "Just Me Again Down Here", "Kameron" => "Kameron", "Karla" => "Karla", "Kaushan Script" => "Kaushan Script", "Kavoon" => "Kavoon", "Keania One" => "Keania One", "Kelly Slab" => "Kelly Slab", "Kenia" => "Kenia", "Khmer" => "Khmer", "Kite One" => "Kite One", "Knewave" => "Knewave", "Kotta One" => "Kotta One", "Koulen" => "Koulen", "Kranky" => "Kranky", "Kreon" => "Kreon", "Kristi" => "Kristi", "Krona One" => "Krona One", "La Belle Aurore" => "La Belle Aurore", "Lancelot" => "Lancelot", "Lato" => "Lato", "League Script" => "League Script", "Leckerli One" => "Leckerli One", "Ledger" => "Ledger", "Lekton" => "Lekton", "Lemon" => "Lemon", "Libre Baskerville" => "Libre Baskerville", "Life Savers" => "Life Savers", "Lilita One" => "Lilita One", "Limelight" => "Limelight", "Linden Hill" => "Linden Hill", "Lobster" => "Lobster", "Lobster Two" => "Lobster Two", "Londrina Outline" => "Londrina Outline", "Londrina Shadow" => "Londrina Shadow", "Londrina Sketch" => "Londrina Sketch", "Londrina Solid" => "Londrina Solid", "Lora" => "Lora", "Love Ya Like A Sister" => "Love Ya Like A Sister", "Loved by the King" => "Loved by the King", "Lovers Quarrel" => "Lovers Quarrel", "Luckiest Guy" => "Luckiest Guy", "Lusitana" => "Lusitana", "Lustria" => "Lustria", "Macondo" => "Macondo", "Macondo Swash Caps" => "Macondo Swash Caps", "Magra" => "Magra", "Maiden Orange" => "Maiden Orange", "Mako" => "Mako", "Marcellus" => "Marcellus", "Marcellus SC" => "Marcellus SC", "Marck Script" => "Marck Script", "Margarine" => "Margarine", "Marko One" => "Marko One", "Marmelad" => "Marmelad", "Marvel" => "Marvel", "Mate" => "Mate", "Mate SC" => "Mate SC", "Maven Pro" => "Maven Pro", "McLaren" => "McLaren", "Meddon" => "Meddon", "MedievalSharp" => "MedievalSharp", "Medula One" => "Medula One", "Megrim" => "Megrim", "Meie Script" => "Meie Script", "Merienda" => "Merienda", "Merienda One" => "Merienda One", "Merriweather" => "Merriweather", "Merriweather Sans" => "Merriweather Sans", "Metal" => "Metal", "Metal Mania" => "Metal Mania", "Metamorphous" => "Metamorphous", "Metrophobic" => "Metrophobic", "Michroma" => "Michroma", "Milonga" => "Milonga", "Miltonian" => "Miltonian", "Miltonian Tattoo" => "Miltonian Tattoo", "Miniver" => "Miniver", "Miss Fajardose" => "Miss Fajardose", "Modern Antiqua" => "Modern Antiqua", "Molengo" => "Molengo", "Molle" => "Molle", "Monda" => "Monda", "Monofett" => "Monofett", "Monoton" => "Monoton", "Monsieur La Doulaise" => "Monsieur La Doulaise", "Montaga" => "Montaga", "Montez" => "Montez", "Montserrat" => "Montserrat", "Montserrat Alternates" => "Montserrat Alternates", "Montserrat Subrayada" => "Montserrat Subrayada", "Moul" => "Moul", "Moulpali" => "Moulpali", "Mountains of Christmas" => "Mountains of Christmas", "Mouse Memoirs" => "Mouse Memoirs", "Mr Bedfort" => "Mr Bedfort", "Mr Dafoe" => "Mr Dafoe", "Mr De Haviland" => "Mr De Haviland", "Mrs Saint Delafield" => "Mrs Saint Delafield", "Mrs Sheppards" => "Mrs Sheppards", "Muli" => "Muli", "Mystery Quest" => "Mystery Quest", "Neucha" => "Neucha", "Neuton" => "Neuton", "New Rocker" => "New Rocker", "News Cycle" => "News Cycle", "Niconne" => "Niconne", "Nixie One" => "Nixie One", "Nobile" => "Nobile", "Nokora" => "Nokora", "Norican" => "Norican", "Nosifer" => "Nosifer", "Nothing You Could Do" => "Nothing You Could Do", "Noticia Text" => "Noticia Text", "Nova Cut" => "Nova Cut", "Nova Flat" => "Nova Flat", "Nova Mono" => "Nova Mono", "Nova Oval" => "Nova Oval", "Nova Round" => "Nova Round", "Nova Script" => "Nova Script", "Nova Slim" => "Nova Slim", "Nova Square" => "Nova Square", "Numans" => "Numans", "Nunito" => "Nunito", "Odor Mean Chey" => "Odor Mean Chey", "Offside" => "Offside", "Old Standard TT" => "Old Standard TT", "Oldenburg" => "Oldenburg", "Oleo Script" => "Oleo Script", "Oleo Script Swash Caps" => "Oleo Script Swash Caps", "Open Sans" => "Open Sans", "Open Sans Condensed" => "Open Sans Condensed", "Oranienbaum" => "Oranienbaum", "Orbitron" => "Orbitron", "Oregano" => "Oregano", "Orienta" => "Orienta", "Original Surfer" => "Original Surfer", "Oswald" => "Oswald", "Over the Rainbow" => "Over the Rainbow", "Overlock" => "Overlock", "Overlock SC" => "Overlock SC", "Ovo" => "Ovo", "Oxygen" => "Oxygen", "Oxygen Mono" => "Oxygen Mono", "PT Mono" => "PT Mono", "PT Sans" => "PT Sans", "PT Sans Caption" => "PT Sans Caption", "PT Sans Narrow" => "PT Sans Narrow", "PT Serif" => "PT Serif", "PT Serif Caption" => "PT Serif Caption", "Pacifico" => "Pacifico", "Paprika" => "Paprika", "Parisienne" => "Parisienne", "Passero One" => "Passero One", "Passion One" => "Passion One", "Patrick Hand" => "Patrick Hand", "Patrick Hand SC" => "Patrick Hand SC", "Patua One" => "Patua One", "Paytone One" => "Paytone One", "Peralta" => "Peralta", "Permanent Marker" => "Permanent Marker", "Petit Formal Script" => "Petit Formal Script", "Petrona" => "Petrona", "Philosopher" => "Philosopher", "Piedra" => "Piedra", "Pinyon Script" => "Pinyon Script", "Pirata One" => "Pirata One", "Plaster" => "Plaster", "Play" => "Play", "Playball" => "Playball", "Playfair Display" => "Playfair Display", "Playfair Display SC" => "Playfair Display SC", "Podkova" => "Podkova", "Poiret One" => "Poiret One", "Poller One" => "Poller One", "Poly" => "Poly", "Pompiere" => "Pompiere", "Pontano Sans" => "Pontano Sans", "Port Lligat Sans" => "Port Lligat Sans", "Port Lligat Slab" => "Port Lligat Slab", "Prata" => "Prata", "Preahvihear" => "Preahvihear", "Press Start 2P" => "Press Start 2P", "Princess Sofia" => "Princess Sofia", "Prociono" => "Prociono", "Prosto One" => "Prosto One", "Puritan" => "Puritan", "Purple Purse" => "Purple Purse", "Quando" => "Quando", "Quantico" => "Quantico", "Quattrocento" => "Quattrocento", "Quattrocento Sans" => "Quattrocento Sans", "Questrial" => "Questrial", "Quicksand" => "Quicksand", "Quintessential" => "Quintessential", "Qwigley" => "Qwigley", "Racing Sans One" => "Racing Sans One", "Radley" => "Radley", "Raleway" => "Raleway", "Raleway Dots" => "Raleway Dots", "Rambla" => "Rambla", "Rammetto One" => "Rammetto One", "Ranchers" => "Ranchers", "Rancho" => "Rancho", "Rationale" => "Rationale", "Redressed" => "Redressed", "Reenie Beanie" => "Reenie Beanie", "Revalia" => "Revalia", "Ribeye" => "Ribeye", "Ribeye Marrow" => "Ribeye Marrow", "Righteous" => "Righteous", "Risque" => "Risque", "Roboto" => "Roboto", "Roboto Condensed" => "Roboto Condensed", "Rochester" => "Rochester", "Rock Salt" => "Rock Salt", "Rokkitt" => "Rokkitt", "Romanesco" => "Romanesco", "Ropa Sans" => "Ropa Sans", "Rosario" => "Rosario", "Rosarivo" => "Rosarivo", "Rouge Script" => "Rouge Script", "Ruda" => "Ruda", "Rufina" => "Rufina", "Ruge Boogie" => "Ruge Boogie", "Ruluko" => "Ruluko", "Rum Raisin" => "Rum Raisin", "Ruslan Display" => "Ruslan Display", "Russo One" => "Russo One", "Ruthie" => "Ruthie", "Rye" => "Rye", "Sacramento" => "Sacramento", "Sail" => "Sail", "Salsa" => "Salsa", "Sanchez" => "Sanchez", "Sancreek" => "Sancreek", "Sansita One" => "Sansita One", "Sarina" => "Sarina", "Satisfy" => "Satisfy", "Scada" => "Scada", "Schoolbell" => "Schoolbell", "Seaweed Script" => "Seaweed Script", "Sevillana" => "Sevillana", "Seymour One" => "Seymour One", "Shadows Into Light" => "Shadows Into Light", "Shadows Into Light Two" => "Shadows Into Light Two", "Shanti" => "Shanti", "Share" => "Share", "Share Tech" => "Share Tech", "Share Tech Mono" => "Share Tech Mono", "Shojumaru" => "Shojumaru", "Short Stack" => "Short Stack", "Siemreap" => "Siemreap", "Sigmar One" => "Sigmar One", "Signika" => "Signika", "Signika Negative" => "Signika Negative", "Simonetta" => "Simonetta", "Sintony" => "Sintony", "Sirin Stencil" => "Sirin Stencil", "Six Caps" => "Six Caps", "Skranji" => "Skranji", "Slackey" => "Slackey", "Smokum" => "Smokum", "Smythe" => "Smythe", "Sniglet" => "Sniglet", "Snippet" => "Snippet", "Snowburst One" => "Snowburst One", "Sofadi One" => "Sofadi One", "Sofia" => "Sofia", "Sonsie One" => "Sonsie One", "Sorts Mill Goudy" => "Sorts Mill Goudy", "Source Code Pro" => "Source Code Pro", "Source Sans Pro" => "Source Sans Pro", "Special Elite" => "Special Elite", "Spicy Rice" => "Spicy Rice", "Spinnaker" => "Spinnaker", "Spirax" => "Spirax", "Squada One" => "Squada One", "Stalemate" => "Stalemate", "Stalinist One" => "Stalinist One", "Stardos Stencil" => "Stardos Stencil", "Stint Ultra Condensed" => "Stint Ultra Condensed","Stint Ultra Expanded" => "Stint Ultra Expanded", "Stoke" => "Stoke", "Strait" => "Strait", "Sue Ellen Francisco" => "Sue Ellen Francisco", "Sunshiney" => "Sunshiney", "Supermercado One" => "Supermercado One", "Suwannaphum" => "Suwannaphum", "Swanky and Moo Moo" => "Swanky and Moo Moo", "Syncopate" => "Syncopate", "Tangerine" => "Tangerine", "Taprom" => "Taprom", "Tauri" => "Tauri", "Telex" => "Telex", "Tenor Sans" => "Tenor Sans", "Text Me One" => "Text Me One", "The Girl Next Door" => "The Girl Next Door", "Tienne" => "Tienne", "Tinos" => "Tinos", "Titan One" => "Titan One", "Titillium Web" => "Titillium Web", "Trade Winds" => "Trade Winds", "Trocchi" => "Trocchi", "Trochut" => "Trochut", "Trykker" => "Trykker", "Tulpen One" => "Tulpen One", "Ubuntu" => "Ubuntu", "Ubuntu Condensed" => "Ubuntu Condensed", "Ubuntu Mono" => "Ubuntu Mono", "Ultra" => "Ultra", "Uncial Antiqua" => "Uncial Antiqua", "Underdog" => "Underdog", "Unica One" => "Unica One", "UnifrakturCook" => "UnifrakturCook", "UnifrakturMaguntia" => "UnifrakturMaguntia", "Unkempt" => "Unkempt", "Unlock" => "Unlock", "Unna" => "Unna", "VT323" => "VT323", "Vampiro One" => "Vampiro One", "Varela" => "Varela", "Varela Round" => "Varela Round", "Vast Shadow" => "Vast Shadow", "Vibur" => "Vibur", "Vidaloka" => "Vidaloka", "Viga" => "Viga", "Voces" => "Voces", "Volkhov" => "Volkhov", "Vollkorn" => "Vollkorn", "Voltaire" => "Voltaire", "Waiting for the Sunrise" => "Waiting for the Sunrise", "Wallpoet" => "Wallpoet", "Walter Turncoat" => "Walter Turncoat", "Warnes" => "Warnes", "Wellfleet" => "Wellfleet", "Wendy One" => "Wendy One", "Wire One" => "Wire One", "Yanone Kaffeesatz" => "Yanone Kaffeesatz", "Yellowtail" => "Yellowtail", "Yeseva One" => "Yeseva One", "Yesteryear" => "Yesteryear", "Zeyada" => "Zeyada" );

global $page_options;
$page_options = array();
$page_options[] = array( 	"name" 		=> __("Basic Options", "allaround"),
						"type" 		=> "heading"
				);
					
$page_options[] = array( 	"name" 		=> "Basic Options",
						"desc" 		=> "",
						"id" 		=> "basicoptions",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__("Basic Options", "allaround")."</h3>".
						__("Theme basic page options.", "allaround")."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$page_options[] = array( 	"name" 		=> __("Title", "allaround"),
						"desc" 		=> __("Show post title", "allaround"),
						"id" 		=> "title",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$page_options[] = array( 	"name" 		=> __("Breadcrumbs", "allaround"),
						"desc" 		=> __("Turn OFF Breadcrumbs", "allaround"),
						"id" 		=> "breadcrumbs",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$page_options[] = array( 	"name" 		=> __("Custom Sidebar", "allaround"),
						"desc" 		=> __("Select custom right sidebar. You can define new sidebars in Theme Options > Sidebar.", "allaround"),
						"id" 		=> "override-sidebar-right",
						"std" 		=> "None",
						"type" 		=> "select",
						"options" 	=> $sidebars
				);

$page_options[] = array( 	"name" 		=> __("Slider Options", "allaround"),
						"type" 		=> "heading"
				);
					
$page_options[] = array( 	"name" 		=> "Slider",
						"desc" 		=> "",
						"id" 		=> "sliderinfo",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__("Insert Slider", "allaround")."</h3>".
						__("Activate slider. Set up slides and slider parametars.", "allaround")."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$page_options[] = array( 	"name" 		=> __("Slider ON/OFF", "allaround"),
						"desc" 		=> __("Enable slider on this page.", "allaround"),
						"id" 		=> "slider",
						"std" 		=> 0,
						"folds"		=> 1,
						"type" 		=> "switch"
				);
$page_options[] = array( 	"name" 		=> __("Slider Type", "allaround"),
						"desc" 		=> __("Select slider type.", "allaround"),
						"id" 		=> "allaround_slider_type",
						"std" 		=> "Revolution",
						"type" 		=> "select",
						"options" 	=> $page_sliders, 
						"fold"		=> "slider"
				);
$page_options[] = array( 	"name" 		=> "Slider Settings",
						"desc" 		=> "",
						"id" 		=> "sliderinfo",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__("Configure selected slider", "allaround")."</h3>".
						__("If you've selected Revolution slider please select your saved Revolution slider template. If you've selected other slide systems please use Slide Manager bellow to configure your slides.", "allaround")."",
						"icon" 		=> true,
						"type" 		=> "info",
						"fold"		=> "slider"

				);

$page_options[] = array( 	"name" 		=> __("Revolution Slider", "allaround"),
						"desc" 		=> __("Select saved revolution slider template.", "allaround"),
						"id" 		=> "revolution_slider",
						"std" 		=> "",
						"type" 		=> "select",
						"options" 	=> $revsliders,
						"fold"		=> "slider"

				);
$page_options[] = array( 	"name" 		=> "Slider Manager",
						"desc" 		=> "",
						"id" 		=> "slidermanager",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__("Slider Manager", "allaround")."</h3>".
						__("Use this drag&drop manager to create your slides. For more information on sliders view our AllAround documentation.", "allaround")."",
						"icon" 		=> true,
						"type" 		=> "info",
						"fold"		=> "slider"

				);
$page_options[] = array( 	"name" 		=> __("Slides", "allaround"),
						"desc" 		=> __("Add or remove slides. Drag and drop to change slide order.", "allaround"),
						"id" 		=> "slides",
						'slider'	=> '0',
						'std'	=> array( 1 => array (
											'title' => 'Slide 1',
											'url' => ''
										) ),
						"type" 		=> "slider",
						"fold"		=> "slider"
				);
$page_options[] = array( 	"name" 		=> __("Shortcode Generator", "allaround"),
						"type" 		=> "heading"
				);
					
$page_options[] = array( 	"name" 		=> "Content",
						"desc" 		=> "",
						"id" 		=> "contentinfo",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__("Shortcode Generator", "allaround")."</h3>".
						__("Use Shortcode Generator to create your page layouts. Templates can be inserted, loaded, saved or edited. Use Add New Element to add elements to template. Drag and drop elements to change their order. This Shortcode Generator supports only AllAround shortcodes. Shortcodes for plugins as WooCommerce or Revolution slider can be put inside Text/HTML element for saving template purposes.<p>Please note that Full-Width Shortcodes are working only on full width pages when sidebars are not used.</p>", "allaround")."",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$page_options[] = array( 	"name" 		=> __("Insert Elements", "allaround"),
						"desc" 		=> "",
						"id" 		=> "contents",
						"std" 		=> "",
						"type" 		=> "content",
				);

global $products_options;
$products_options = array();

$products_options[] = array( 	"name" 		=> "Customer Evaluation",
						"desc" 		=> "",
						"id" 		=> "customerevaluation",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__("Customer Evaluation", "allaround")."</h3>".
						__("Setup your Customer Evaluation options.", "allaround")."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$products_options[] = array( 	"name" 		=> __("Product line", "allaround"),
						"desc" 		=> __("The line just below CUSTOMER EVALUTION title.", "allaround"),
						"id" 		=> "product-text",
						"std" 		=> '',
						"type" 		=> "text"
				);
$products_options[] = array( 	"name" 		=> __("Bar #1 Title", "allaround"),
						"desc" 		=> __("Title for Bar #1.", "allaround"),
						"id" 		=> "bar1-text",
						"std" 		=> '',
						"type" 		=> "text"
				);
$products_options[] = array( 	"name" 		=> __("Bar #1 Progress", "allaround"),
						"desc" 		=> __("Progress for Bar #1.", "allaround"),
						"id" 		=> "bar1-progress",
						"min" 		=> 0,
						"max"		=> 100,
						"step"		=> 1,
						"std"		=> 50,
						"type" 		=> "sliderui"
				);
$products_options[] = array( 	"name" 		=> __("Bar #2 Title", "allaround"),
						"desc" 		=> __("Title for Bar #2.", "allaround"),
						"id" 		=> "bar2-text",
						"std" 		=> '',
						"type" 		=> "text"
				);
$products_options[] = array( 	"name" 		=> __("Bar #2 Progress", "allaround"),
						"desc" 		=> __("Progress for Bar #2.", "allaround"),
						"id" 		=> "bar2-progress",
						"min" 		=> 0,
						"max"		=> 100,
						"step"		=> 1,
						"std"		=> 50,
						"type" 		=> "sliderui"
				);
$products_options[] = array( 	"name" 		=> __("Bar #3 Title", "allaround"),
						"desc" 		=> __("Title for Bar #3.", "allaround"),
						"id" 		=> "bar3-text",
						"std" 		=> '',
						"type" 		=> "text"
				);
$products_options[] = array( 	"name" 		=> __("Bar #3 Progress", "allaround"),
						"desc" 		=> __("Progress for Bar #3.", "allaround"),
						"id" 		=> "bar3-progress",
						"min" 		=> 0,
						"max"		=> 100,
						"step"		=> 1,
						"std"		=> 50,
						"type" 		=> "sliderui"
				);
$products_options[] = array( 	"name" 		=> __("Bar #4 Title", "allaround"),
						"desc" 		=> __("Title for Bar #4.", "allaround"),
						"id" 		=> "bar4-text",
						"std" 		=> '',
						"type" 		=> "text"
				);
$products_options[] = array( 	"name" 		=> __("Bar #4 Progress", "allaround"),
						"desc" 		=> __("Progress for Bar #4.", "allaround"),
						"id" 		=> "bar4-progress",
						"min" 		=> 0,
						"max"		=> 100,
						"step"		=> 1,
						"std"		=> 50,
						"type" 		=> "sliderui"
				);

global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> __('General Settings', 'allaround'),
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> __('General Settings', 'allaround'),
						"desc" 		=> "",
						"id" 		=> "generalsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Welcome to the Theme Options', 'allaround')."</h3>
						".__('Use this Theme Options page to setup your site.', 'allaround')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> __('Theme Color', 'allaround'),
						"desc" 		=> __('Select Theme Color. Default lime green color code is #e84c3d.', 'allaround'),
						"id" 		=> "custom_color",
						"std" 		=> "#e84c3d",
						"type" 		=> "color"
				);
$of_options[] = array( 	"name" 		=> __('Upload Logo', 'allaround'),
						"desc" 		=> __('Upload your logo using the native media uploader, or define the URL directly.', 'allaround'),
						"id" 		=> "logo",
						"std" 		=> get_template_directory_uri() . '/images/home/logo.png',
						"type" 		=> "media"
				);
$of_options[] = array( 	"name" 		=> __('Upload Small Logo', 'allaround'),
						"desc" 		=> __('Upload your small logo using the native media uploader, or define the URL directly.', 'allaround'),
						"id" 		=> "logo_small",
						"std" 		=> get_template_directory_uri() . '/images/home/logo_small.png',
						"type" 		=> "media"
				);

$of_options[] = array( 	"name" 		=> __('Blog Settings', 'allaround'),
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> __('Blog Settings', 'allaround'),
						"desc" 		=> "",
						"id" 		=> "blog-settings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Blog Settings', 'allaround')."</h3>
						".__('Setup blog archive pages default type.', 'allaround')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> __('Blog Type', 'allaround'),
						"desc" 		=> __('Select your default blog type.<br/> 1 - Blog Regular<br/> 2 - Blog Circles<br/> 3 - Blog Circles Two Columns<br/> 4 - Blog Circles Three Columns<br/> 5 - Blog Small Circles<br/> 6 - Blog Small Circles Two Columns<br/> 7 - Blog Small Circles Three Columns', 'allaround'),
						"id" 		=> "blog-type",
						"std" 		=> "1",
						"type" 		=> "select",
						"options" 	=> array(
										"1" => "1",
										"2" => "2",
										"3" => "3",
										"4" => "4",
										"5" => "5",
										"6" => "6",
										"7" => "7"
						)
				);
$of_options[] = array( 	"name" 		=> __('Single Post Settings', 'allaround'),
						"desc" 		=> "",
						"id" 		=> "blog-settings-single",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Single Post Settings', 'allaround')."</h3>
						".__('Single Post display options.', 'allaround')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> __('Enable Excerpt', 'allaround'),
						"desc" 		=> __('Enable excerpts on single posts that appear just bellow the featured image.', 'allaround'),
						"id" 		=> "blog-excerpt",
						"std" 		=> 0,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> __('Enable Related', 'allaround'),
						"desc" 		=> __('Enable related posts on single posts that appear before comments.', 'allaround'),
						"id" 		=> "blog-related",
						"std" 		=> 0,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> __('Enable Author', 'allaround'),
						"desc" 		=> __('Enable author information on single posts that appear at the bottom.', 'allaround'),
						"id" 		=> "blog-author",
						"std" 		=> 0,
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> __('Header Socials', 'allaround'),
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> __('Disable Cart/Login', 'allaround'),
						"desc" 		=> __('Disable Cart and Login icons in the header. This option is usefull if you are usign AllAround theme only to showcase your products.', 'allaround'),
						"id" 		=> "disable_cart",
						"std" 		=> 0,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> __('Header Settings', 'allaround'),
						"desc" 		=> "",
						"id" 		=> "header-settings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Header Settings', 'allaround')."</h3>
						".__('Set your header social network urls.', 'allaround')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> __("Facebook URL", "allaround"),
						"desc" 		=> __("Enter your Facebook URL e.g. http://www.facebook.com/user/", "allaround"),
						"id" 		=> "header-facebook",
						"std" 		=> '',
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> __("Twitter URL", "allaround"),
						"desc" 		=> __("Enter your Twitter URL e.g. http://www.twitter.com/user/", "allaround"),
						"id" 		=> "header-twitter",
						"std" 		=> '',
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> __("Digg URL", "allaround"),
						"desc" 		=> __("Enter your Digg URL e.g. http://www.digg.com/user/", "allaround"),
						"id" 		=> "header-digg",
						"std" 		=> '',
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> __("LinkedIn URL", "allaround"),
						"desc" 		=> __("Enter your LinkedIn URL e.g. http://www.linkedin.com/user/", "allaround"),
						"id" 		=> "header-linkedin",
						"std" 		=> '',
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> __("RSS Feed URL", "allaround"),
						"desc" 		=> __("Enter your RSS Feed URL e.g. http://www.yoursite.com/rss/", "allaround"),
						"id" 		=> "header-rss",
						"std" 		=> '',
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> __("Google+ URL", "allaround"),
						"desc" 		=> __("Enter your Google+ URL e.g. http://www.googleplus.com/user/", "allaround"),
						"id" 		=> "header_google",
						"std" 		=> '',
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> __('Sidebar Settings', 'allaround'),
						"type" 		=> "heading"
				);
					
$of_options[] = array( 	"name" 		=> __('Sidebar Settings', 'allaround'),
						"desc" 		=> "",
						"id" 		=> "sidebarsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Sidebar Settings', 'allaround')."</h3>
						".__('Setup default post/product archive sidebar. Create custom sidebars to use on pages.', 'allaround')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);

$of_options[] = array( 	"name" 		=> __('Blog Archive Sidebar', 'allaround'),
						"desc" 		=> __('Enable blog archive sidebar.', 'allaround'),
						"id" 		=> "sidebar-blog",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> __('Woocommerce Archive Sidebar', 'allaround'),
						"desc" 		=> __('Enable WooCommerce archive sidebar including the "Shop" page.', 'allaround'),
						"id" 		=> "sidebar-woocommerce",
						"std" 		=> 0,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> __('Sidebars', 'allaround'),
						"desc" 		=> __('Unlimited sidebars for your pages/posts.', 'allaround'),
						"id" 		=> "sidebar",
						"std" 		=> array(
										1 => array(
											'order' => 1,
											'title' => 'Your first Sidebar!'
									)
						),
						"type" 		=> "sidebar"
				);
$of_options[] = array( 	"name" 		=> __('Footer Settings', 'allaround'),
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> __('Footer Settings', 'allaround'),
						"desc" 		=> "",
						"id" 		=> "footersettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Footer Settings', 'allaround')."</h3>
						".__('Choose footer columns. Set up the copyright text.', 'allaround')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> __('Footer widget areas', 'allaround'),
						"desc" 		=> __('Select number of footer widget areas.', 'allaround'),
						"id" 		=> "footer_sidebar",
						"std" 		=> "4",
						"type" 		=> "select",
						"options" 	=> array(
										"1" => "1",
										"2" => "2",
										"3" => "3",
										"4" => "4"
						)
				);
$of_options[] = array( 	"name" 		=> __('Footer links', 'allaround'),
						"desc" 		=> __('Set small slider images and links. Please use icons 60x60px.', 'allaround'),
						"id" 		=> "footer-links",
						"std" 		=> array(
										1 => array (
											"order" => 1,
											"title" => "Your first Link!",
											"url" => "http://www.shindiristudio.com/allaroundwp/wp-content/uploads/2013/07/1.png",
											"link" => "http://www.shindiristudio.com/allaroundwp/"
										)
						),
						"type" 		=> "slider"
				);
$of_options[] = array( 	"name" 		=> __('Copyright text', 'allaround'),
						"desc" 		=> __('Input text to be displayed after footer.', 'allaround'),
						"id" 		=> "after_footer",
						"std" 		=> "Copyright: <a href='#'>Shindiri Studio</a>, All Rights Reserved. May, 2013",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> __('Footer Twitter ON/OFF', 'allaround'),
						"desc" 		=> __('Switch ON or OFF the Top Area.', 'allaround'),
						"id" 		=> "footer-twitter",
						"std" 		=> 0,
						"folds"		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> __('Username', 'allaround'),
						"desc" 		=> __('Please enter Twitter username. e.g. themeforest', 'allaround'),
						"id" 		=> "footer-twitter-user",
						"std" 		=> "",
						"fold" 		=> "footer-twitter",
						"type" 		=> "text"
				);
$of_options[] = array( 	"name" 		=> __('Typography', 'allaround'),
						"type" 		=> "heading"
				);
					
$of_options[] = array( 	"name" 		=> "Typography",
						"desc" 		=> "",
						"id" 		=> "introduction",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Set your typography options.', 'allaround')."</h3>
						".__('In this theme you can set your custom fonts. Choose your font for text and headers.', 'allaround')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> __('Select main text font', 'allaround'),
						"desc" 		=> __('Selected main font is used for text on pages and posts.', 'allaround'),
						"id" 		=> "font",
						"std" 		=> "Dosis",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "AllAround Theme! 123#",
										"size" => "30px"
						),
						"options" 	=> $fonts
				);
$of_options[] = array( 	"name" 		=> __('Select cursive font', 'allaround'),
						"desc" 		=> __('Selected cursive font is used for italic text, quotes etc.', 'allaround'),
						"id" 		=> "cursive_font",
						"std" 		=> "PT Sans",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "AllAround Theme! 123#",
										"size" => "30px"
						),
						"options" 	=> $fonts
				);
$of_options[] = array( 	"name" 		=> __('Contact Settings', 'allaround'),
						"type" 		=> "heading"
				);
					
$of_options[] = array( 	"name" 		=> __('Contact Settings', 'allaround'),
						"desc" 		=> "",
						"id" 		=> "contactsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">" . __('Contact Settings', 'allaround') . "</h3>" .
						__('Setup your team members.', 'allaround'),
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> __('Contact Settings / Team Members', 'allaround'),
						"desc" 		=> __('Add or remove contact options/team members. You can use this entries later in your content as Team element or Contact Form element.', 'allaround'),
						"id" 		=> "contact",
						"std" 		=> array(
										1 => array (
											'order' => 1,
											'name' => 'Your first Contact!',
											'url' => 'http://www.shindiristudio.com/allaroundwp/wp-content/uploads/2013/07/1.jpg',
											'job' => 'designer',
											'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
											'email' => 'google@gmail.com',
											'contact' => array (
												1 => array (
													'socialnetworksurl' => '#',
													'socialnetworks' => 'white_facebook.png'
												)
											)
										)
						),
						"type" 		=> "contact"
				);				

$of_options[] = array( 	"name" 		=> __('Advanced Settings', 'allaround'),
						"type" 		=> "heading"
				);
					
$of_options[] = array( 	"name" 		=> __('Advanced Settings', 'allaround'),
						"desc" 		=> "",
						"id" 		=> "advancedsettings",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">".__('Advanced Settings', 'allaround')."</h3>
						".__('Set custom CSS classes, Google Analytics code.', 'allaround')."",
						"icon" 		=> true,
						"type" 		=> "info"
				);
$of_options[] = array( 	"name" 		=> __("Responsive / Fixed Layout", "allaround"),
						"desc" 		=> __("Enable Responsive layout or use Fixed layout insted.", "allaround"),
						"id" 		=> "responsive",
						"std" 		=> 1,
						"on" 		=> "Responsive",
						"off" 		=> "Fixed",
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __("Boxed / Wide Layout", "allaround"),
						"desc" 		=> __("Enable Boxed layout or use Wide layout insted.", "allaround"),
						"id" 		=> "boxed",
						"std" 		=> 0,
						"on" 		=> "Boxed",
						"off" 		=> "Wide",
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> __('Product Evaluation ON/OFF', 'allaround'),
						"desc" 		=> __('Enable Product Evaluation on Single Products.', 'allaround'),
						"id" 		=> "product_evaluation",
						"std" 		=> 1,
						"type" 		=> "switch"
				);
$of_options[] = array( 	"name" 		=> __('Tracking Code', 'allaround'),
						"desc" 		=> __('Paste your Google Analytics (or other) tracking code here. This will be added into the header of your site.', 'allaround'),
						"id" 		=> "tracking-code",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
$of_options[] = array( 	"name" 		=> __('Custom CSS', 'allaround'),
						"desc" 		=> __('Quickly add some CSS to your theme by adding it to this block.', 'allaround'),
						"id" 		=> "custom-css",
						"std" 		=> "",
						"type" 		=> "textarea"
				);				
$of_options[] = array( 	"name" 		=> __("Backup Options", 'allaround'),
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> __("Backup and Restore Options", 'allaround'),
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'allaround'),
				);
				
$of_options[] = array( 	"name" 		=> __("Transfer Theme Options Data", 'allaround'),
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'allaround'),
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>