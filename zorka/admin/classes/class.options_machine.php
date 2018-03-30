<?php
/**
 * SMOF Options Machine Class
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.0.0
 * @author      Syamil MJ
 */
class Options_Machine {

	/**
	 * PHP5 contructor
	 *
	 * @since 1.0.0
	 */
	function __construct($options) {

		$return = $this->optionsframework_machine($options);

		$this->Inputs = $return[0];
		$this->Menu = $return[1];
		$this->Defaults = $return[2];

	}

	/**
	 * Sanitize option
	 *
	 * Sanitize & returns default values if don't exist
	 *
	 * Notes:
	 *	- For further uses, you can check for the $value['type'] and performs
	 *	  more speficic sanitization on the option
	 *	- The ultimate objective of this function is to prevent the "undefined index"
	 *	  errors some authors are having due to malformed options array
	 */
	public static function sanitize_option( $value ) {

		$defaults = array(
			"name" 		=> "",
			"desc" 		=> "",
			"id" 		=> "",
			"std" 		=> "",
			"mod"		=> "",
			"type" 		=> ""
		);

		$value = wp_parse_args( $value, $defaults );

		return $value;

	}


	/**
	 * Process options data and build option fields
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function optionsframework_machine($options) {
		global $smof_output;
		$smof_data = of_get_options();
		$data = $smof_data;
		$defaults = array();
		$counter = 0;
		$menu = '';
		$output = '';

		do_action('optionsframework_machine_before', array(
			'options'	=> $options,
			'smof_data'	=> $smof_data,
		));
		$output .= $smof_output;

		foreach ($options as $value) {

			// sanitize option
			$value = self::sanitize_option($value);

			$counter++;
			$val = '';

			//create array of defaults		
			if ($value['type'] == 'multicheck' ){
				if (is_array($value['std'])){
					foreach($value['std'] as $i=>$key){
						$defaults[$value['id']][$key] = true;
					}
				} else {
					$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) $defaults[$value['id']] = $value['std'];
			}

			/* condition start */
			if(!empty($smof_data) || !empty($data)){

				//Start Heading
				if ( $value['type'] != "heading" )
				{
					$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }

					//hide items in checkbox group
					$fold='';
					if (array_key_exists("fold",$value)) {
						if (isset($smof_data[$value['fold']]) && $smof_data[$value['fold']]) {
							$fold="f_".$value['fold']." ";
						} else {
							$fold="f_".$value['fold']." temphide ";
						}
					}

					$output .= '<div id="section-'.$value['id'].'" class="'.$fold.'section section-'.$value['type'].' '. $class .'">'."\n";

					//only show header if 'name' value exists
					if($value['name']) $output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";

					$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

				}
				//End Heading


                if(!array_key_exists($value['id'],$smof_data)){
                    $smof_data[$value['id']] = $value['std'];
                }

				if (!isset($smof_data[$value['id']]) && $value['type'] != "heading")
				{
					$output .= '<div class="clear"> </div></div></div></div>'."\n";
					continue;
				}


				//switch statement to handle various options type
				switch ( $value['type'] ) {

					//text input
					case 'text':
						$t_value = '';
						$t_value = stripslashes($smof_data[$value['id']]);

						$mini ='';
						if(!isset($value['mod'])) $value['mod'] = '';
						if($value['mod'] == 'mini') { $mini = 'mini';}

						$output .= '<input class="of-input '.$mini.'" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $t_value .'" />';
						break;

					//select option
					case 'select':
						$mini ='';
						if(!isset($value['mod'])) $value['mod'] = '';
						if($value['mod'] == 'mini') { $mini = 'mini';}
						$output .= '<div class="select_wrapper ' . $mini . '">';
						$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';

						foreach ($value['options'] as $select_ID => $option) {
							$theValue = $select_ID;
							$output .= '<option id="' . $select_ID . '" value="'.$theValue.'" ' . selected($smof_data[$value['id']], $theValue, false) . ' />'.$option.'</option>';
						}
						$output .= '</select></div>';
						break;

					//textarea option
					case 'textarea':
						$cols = '8';
						$ta_value = '';

						if(isset($value['options'])){
							$ta_options = $value['options'];
							if(isset($ta_options['cols'])){
								$cols = $ta_options['cols'];
							}
						}

						$ta_value = stripslashes($smof_data[$value['id']]);
						$output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
						break;

					//radiobox option
					case "radio":
						foreach($value['options'] as $option=>$name) {
							$output .= '<label class="radio"><input class="of-input of-radio" name="'.$value['id'].'" type="radio" value="'.$option.'" ' . checked($smof_data[$value['id']], $option, false) . ' />' .$name.'</label><br/>';
						}
						break;

					//checkbox option
					case 'checkbox':
						if (!isset($smof_data[$value['id']])) {
							$smof_data[$value['id']] = 0;
						}

						$fold = '';
						if (array_key_exists("folds",$value)) $fold="fld ";

						$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
						$output .= '<input type="checkbox" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($smof_data[$value['id']], 1, false) .' />';
						break;

					//multiple checkbox option
					case 'multicheck':
						(isset($smof_data[$value['id']]))? $multi_stored = $smof_data[$value['id']] : $multi_stored="";

						foreach ($value['options'] as $key => $option) {
							if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
							$of_key_string = $value['id'] . '_' . $key;
							$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label class="multicheck" for="'. $of_key_string .'">'. $option .'</label><br />';
						}
						break;

					// Color picker
					case "color":
						$default_color = '';
						if ( isset($value['std']) ) {
							if ( $smof_data[$value['id']] !=  $value['std'] )
								$default_color = ' data-default-color="' .$value['std'] . '" ';
						}
						$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" class="of-color"  type="text" value="' . $smof_data[$value['id']] . '"' . $default_color .' />';

						break;

					//typography option
					case 'typography':

						$typography_stored = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];



						/* Font Face */
						if(isset($typography_stored['face'])) {
							$google_fonts = array(
								"ABeeZee"                  => "ABeeZee",
								"Abel"                     => "Abel",
								"Abril Fatface"            => "Abril Fatface",
								"Aclonica"                 => "Aclonica",
								"Acme"                     => "Acme",
								"Actor"                    => "Actor",
								"Adamina"                  => "Adamina",
								"Advent Pro"               => "Advent Pro",
								"Aguafina Script"          => "Aguafina Script",
								"Akronim"                  => "Akronim",
								"Aladin"                   => "Aladin",
								"Aldrich"                  => "Aldrich",
								"Alegreya"                 => "Alegreya",
								"Alegreya SC"              => "Alegreya SC",
								"Alex Brush"               => "Alex Brush",
								"Alfa Slab One"            => "Alfa Slab One",
								"Alice"                    => "Alice",
								"Alike"                    => "Alike",
								"Alike Angular"            => "Alike Angular",
								"Allan"                    => "Allan",
								"Allerta"                  => "Allerta",
								"Allerta Stencil"          => "Allerta Stencil",
								"Allura"                   => "Allura",
								"Almendra"                 => "Almendra",
								"Almendra Display"         => "Almendra Display",
								"Almendra SC"              => "Almendra SC",
								"Amarante"                 => "Amarante",
								"Amaranth"                 => "Amaranth",
								"Amatic SC"                => "Amatic SC",
								"Amethysta"                => "Amethysta",
								"Anaheim"                  => "Anaheim",
								"Andada"                   => "Andada",
								"Andika"                   => "Andika",
								"Angkor"                   => "Angkor",
								"Annie Use Your Telescope" => "Annie Use Your Telescope",
								"Anonymous Pro"            => "Anonymous Pro",
								"Antic"                    => "Antic",
								"Antic Didone"             => "Antic Didone",
								"Antic Slab"               => "Antic Slab",
								"Anton"                    => "Anton",
								"Arapey"                   => "Arapey",
								"Arbutus"                  => "Arbutus",
								"Arbutus Slab"             => "Arbutus Slab",
								"Architects Daughter"      => "Architects Daughter",
								"Archivo Black"            => "Archivo Black",
								"Archivo Narrow"           => "Archivo Narrow",
								"Arimo"                    => "Arimo",
								"Arizonia"                 => "Arizonia",
								"Armata"                   => "Armata",
								"Artifika"                 => "Artifika",
								"Arvo"                     => "Arvo",
								"Asap"                     => "Asap",
								"Asset"                    => "Asset",
								"Astloch"                  => "Astloch",
								"Asul"                     => "Asul",
								"Atomic Age"               => "Atomic Age",
								"Aubrey"                   => "Aubrey",
								"Audiowide"                => "Audiowide",
								"Autour One"               => "Autour One",
								"Average"                  => "Average",
								"Average Sans"             => "Average Sans",
								"Averia Gruesa Libre"      => "Averia Gruesa Libre",
								"Averia Libre"             => "Averia Libre",
								"Averia Sans Libre"        => "Averia Sans Libre",
								"Averia Serif Libre"       => "Averia Serif Libre",
								"Bad Script"               => "Bad Script",
								"Balthazar"                => "Balthazar",
								"Bangers"                  => "Bangers",
								"Basic"                    => "Basic",
								"Battambang"               => "Battambang",
								"Baumans"                  => "Baumans",
								"Bayon"                    => "Bayon",
								"Belgrano"                 => "Belgrano",
								"Belleza"                  => "Belleza",
								"BenchNine"                => "BenchNine",
								"Bentham"                  => "Bentham",
								"Berkshire Swash"          => "Berkshire Swash",
								"Bevan"                    => "Bevan",
								"Bigelow Rules"            => "Bigelow Rules",
								"Bigshot One"              => "Bigshot One",
								"Bilbo"                    => "Bilbo",
								"Bilbo Swash Caps"         => "Bilbo Swash Caps",
								"Bitter"                   => "Bitter",
								"Black Ops One"            => "Black Ops One",
								"Bokor"                    => "Bokor",
								"Bonbon"                   => "Bonbon",
								"Boogaloo"                 => "Boogaloo",
								"Bowlby One"               => "Bowlby One",
								"Bowlby One SC"            => "Bowlby One SC",
								"Brawler"                  => "Brawler",
								"Bree Serif"               => "Bree Serif",
								"Bubblegum Sans"           => "Bubblegum Sans",
								"Bubbler One"              => "Bubbler One",
								"Buda"                     => "Buda",
								"Buenard"                  => "Buenard",
								"Butcherman"               => "Butcherman",
								"Butterfly Kids"           => "Butterfly Kids",
								"Cabin"                    => "Cabin",
								"Cabin Condensed"          => "Cabin Condensed",
								"Cabin Sketch"             => "Cabin Sketch",
								"Caesar Dressing"          => "Caesar Dressing",
								"Cagliostro"               => "Cagliostro",
								"Calligraffitti"           => "Calligraffitti",
								"Cambo"                    => "Cambo",
								"Candal"                   => "Candal",
								"Cantarell"                => "Cantarell",
								"Cantata One"              => "Cantata One",
								"Cantora One"              => "Cantora One",
								"Capriola"                 => "Capriola",
								"Cardo"                    => "Cardo",
								"Carme"                    => "Carme",
								"Carrois Gothic"           => "Carrois Gothic",
								"Carrois Gothic SC"        => "Carrois Gothic SC",
								"Carter One"               => "Carter One",
								"Caudex"                   => "Caudex",
								"Cedarville Cursive"       => "Cedarville Cursive",
								"Ceviche One"              => "Ceviche One",
								"Changa One"               => "Changa One",
								"Chango"                   => "Chango",
								"Chau Philomene One"       => "Chau Philomene One",
								"Chela One"                => "Chela One",
								"Chelsea Market"           => "Chelsea Market",
								"Chenla"                   => "Chenla",
								"Cherry Cream Soda"        => "Cherry Cream Soda",
								"Cherry Swash"             => "Cherry Swash",
								"Chewy"                    => "Chewy",
								"Chicle"                   => "Chicle",
								"Chivo"                    => "Chivo",
								"Cinzel"                   => "Cinzel",
								"Cinzel Decorative"        => "Cinzel Decorative",
								"Clicker Script"           => "Clicker Script",
								"Coda"                     => "Coda",
								"Coda Caption"             => "Coda Caption",
								"Codystar"                 => "Codystar",
								"Combo"                    => "Combo",
								"Comfortaa"                => "Comfortaa",
								"Coming Soon"              => "Coming Soon",
								"Concert One"              => "Concert One",
								"Condiment"                => "Condiment",
								"Content"                  => "Content",
								"Contrail One"             => "Contrail One",
								"Convergence"              => "Convergence",
								"Cookie"                   => "Cookie",
								"Copse"                    => "Copse",
								"Corben"                   => "Corben",
								"Courgette"                => "Courgette",
								"Cousine"                  => "Cousine",
								"Coustard"                 => "Coustard",
								"Covered By Your Grace"    => "Covered By Your Grace",
								"Crafty Girls"             => "Crafty Girls",
								"Creepster"                => "Creepster",
								"Crete Round"              => "Crete Round",
								"Crimson Text"             => "Crimson Text",
								"Croissant One"            => "Croissant One",
								"Crushed"                  => "Crushed",
								"Cuprum"                   => "Cuprum",
								"Cutive"                   => "Cutive",
								"Cutive Mono"              => "Cutive Mono",
								"Damion"                   => "Damion",
								"Dancing Script"           => "Dancing Script",
								"Dangrek"                  => "Dangrek",
								"Dawning of a New Day"     => "Dawning of a New Day",
								"Days One"                 => "Days One",
								"Delius"                   => "Delius",
								"Delius Swash Caps"        => "Delius Swash Caps",
								"Delius Unicase"           => "Delius Unicase",
								"Della Respira"            => "Della Respira",
								"Denk One"                 => "Denk One",
								"Devonshire"               => "Devonshire",
								"Didact Gothic"            => "Didact Gothic",
								"Diplomata"                => "Diplomata",
								"Diplomata SC"             => "Diplomata SC",
								"Domine"                   => "Domine",
								"Donegal One"              => "Donegal One",
								"Doppio One"               => "Doppio One",
								"Dorsa"                    => "Dorsa",
								"Dosis"                    => "Dosis",
								"Dr Sugiyama"              => "Dr Sugiyama",
								"Droid Sans"               => "Droid Sans",
								"Droid Sans Mono"          => "Droid Sans Mono",
								"Droid Serif"              => "Droid Serif",
								"Duru Sans"                => "Duru Sans",
								"Dynalight"                => "Dynalight",
								"EB Garamond"              => "EB Garamond",
								"Eagle Lake"               => "Eagle Lake",
								"Eater"                    => "Eater",
								"Economica"                => "Economica",
								"Electrolize"              => "Electrolize",
								"Elsie"                    => "Elsie",
								"Elsie Swash Caps"         => "Elsie Swash Caps",
								"Emblema One"              => "Emblema One",
								"Emilys Candy"             => "Emilys Candy",
								"Engagement"               => "Engagement",
								"Englebert"                => "Englebert",
								"Enriqueta"                => "Enriqueta",
								"Erica One"                => "Erica One",
								"Esteban"                  => "Esteban",
								"Euphoria Script"          => "Euphoria Script",
								"Ewert"                    => "Ewert",
								"Exo"                      => "Exo",
								"Expletus Sans"            => "Expletus Sans",
								"Fanwood Text"             => "Fanwood Text",
								"Fascinate"                => "Fascinate",
								"Fascinate Inline"         => "Fascinate Inline",
								"Faster One"               => "Faster One",
								"Fasthand"                 => "Fasthand",
								"Federant"                 => "Federant",
								"Federo"                   => "Federo",
								"Felipa"                   => "Felipa",
								"Fenix"                    => "Fenix",
								"Finger Paint"             => "Finger Paint",
								"Fjalla One"               => "Fjalla One",
								"Fjord One"                => "Fjord One",
								"Flamenco"                 => "Flamenco",
								"Flavors"                  => "Flavors",
								"Fondamento"               => "Fondamento",
								"Fontdiner Swanky"         => "Fontdiner Swanky",
								"Forum"                    => "Forum",
								"Francois One"             => "Francois One",
								"Freckle Face"             => "Freckle Face",
								"Fredericka the Great"     => "Fredericka the Great",
								"Fredoka One"              => "Fredoka One",
								"Freehand"                 => "Freehand",
								"Fresca"                   => "Fresca",
								"Frijole"                  => "Frijole",
								"Fruktur"                  => "Fruktur",
								"Fugaz One"                => "Fugaz One",
								"GFS Didot"                => "GFS Didot",
								"GFS Neohellenic"          => "GFS Neohellenic",
								"Gabriela"                 => "Gabriela",
								"Gafata"                   => "Gafata",
								"Galdeano"                 => "Galdeano",
								"Galindo"                  => "Galindo",
								"Gentium Basic"            => "Gentium Basic",
								"Gentium Book Basic"       => "Gentium Book Basic",
								"Geo"                      => "Geo",
								"Geostar"                  => "Geostar",
								"Geostar Fill"             => "Geostar Fill",
								"Germania One"             => "Germania One",
								"Gilda Display"            => "Gilda Display",
								"Give You Glory"           => "Give You Glory",
								"Glass Antiqua"            => "Glass Antiqua",
								"Glegoo"                   => "Glegoo",
								"Gloria Hallelujah"        => "Gloria Hallelujah",
								"Goblin One"               => "Goblin One",
								"Gochi Hand"               => "Gochi Hand",
								"Gorditas"                 => "Gorditas",
								"Goudy Bookletter 1911"    => "Goudy Bookletter 1911",
								"Graduate"                 => "Graduate",
								"Grand Hotel"              => "Grand Hotel",
								"Gravitas One"             => "Gravitas One",
								"Great Vibes"              => "Great Vibes",
								"Griffy"                   => "Griffy",
								"Gruppo"                   => "Gruppo",
								"Gudea"                    => "Gudea",
								"Habibi"                   => "Habibi",
								"Hammersmith One"          => "Hammersmith One",
								"Hanalei"                  => "Hanalei",
								"Hanalei Fill"             => "Hanalei Fill",
								"Handlee"                  => "Handlee",
								"Hanuman"                  => "Hanuman",
								"Happy Monkey"             => "Happy Monkey",
								"Headland One"             => "Headland One",
								"Henny Penny"              => "Henny Penny",
								"Herr Von Muellerhoff"     => "Herr Von Muellerhoff",
								"Holtwood One SC"          => "Holtwood One SC",
								"Homemade Apple"           => "Homemade Apple",
								"Homenaje"                 => "Homenaje",
								"IM Fell DW Pica"          => "IM Fell DW Pica",
								"IM Fell DW Pica SC"       => "IM Fell DW Pica SC",
								"IM Fell Double Pica"      => "IM Fell Double Pica",
								"IM Fell Double Pica SC"   => "IM Fell Double Pica SC",
								"IM Fell English"          => "IM Fell English",
								"IM Fell English SC"       => "IM Fell English SC",
								"IM Fell French Canon"     => "IM Fell French Canon",
								"IM Fell French Canon SC"  => "IM Fell French Canon SC",
								"IM Fell Great Primer"     => "IM Fell Great Primer",
								"IM Fell Great Primer SC"  => "IM Fell Great Primer SC",
								"Iceberg"                  => "Iceberg",
								"Iceland"                  => "Iceland",
								"Imprima"                  => "Imprima",
								"Inconsolata"              => "Inconsolata",
								"Inder"                    => "Inder",
								"Indie Flower"             => "Indie Flower",
								"Inika"                    => "Inika",
								"Irish Grover"             => "Irish Grover",
								"Istok Web"                => "Istok Web",
								"Italiana"                 => "Italiana",
								"Italianno"                => "Italianno",
								"Jacques Francois"         => "Jacques Francois",
								"Jacques Francois Shadow"  => "Jacques Francois Shadow",
								"Jim Nightshade"           => "Jim Nightshade",
								"Jockey One"               => "Jockey One",
								"Jolly Lodger"             => "Jolly Lodger",
								"Josefin Sans"             => "Josefin Sans",
								"Josefin Slab"             => "Josefin Slab",
								"Joti One"                 => "Joti One",
								"Judson"                   => "Judson",
								"Julee"                    => "Julee",
								"Julius Sans One"          => "Julius Sans One",
								"Junge"                    => "Junge",
								"Jura"                     => "Jura",
								"Just Another Hand"        => "Just Another Hand",
								"Just Me Again Down Here"  => "Just Me Again Down Here",
								"Kameron"                  => "Kameron",
								"Karla"                    => "Karla",
								"Kaushan Script"           => "Kaushan Script",
								"Kavoon"                   => "Kavoon",
								"Keania One"               => "Keania One",
								"Kelly Slab"               => "Kelly Slab",
								"Kenia"                    => "Kenia",
								"Khmer"                    => "Khmer",
								"Kite One"                 => "Kite One",
								"Knewave"                  => "Knewave",
								"Kotta One"                => "Kotta One",
								"Koulen"                   => "Koulen",
								"Kranky"                   => "Kranky",
								"Kreon"                    => "Kreon",
								"Kristi"                   => "Kristi",
								"Krona One"                => "Krona One",
								"La Belle Aurore"          => "La Belle Aurore",
								"Lancelot"                 => "Lancelot",
								"Lato"                     => "Lato",
								"League Script"            => "League Script",
								"Leckerli One"             => "Leckerli One",
								"Ledger"                   => "Ledger",
								"Lekton"                   => "Lekton",
								"Lemon"                    => "Lemon",
								"Libre Baskerville"        => "Libre Baskerville",
								"Life Savers"              => "Life Savers",
								"Lilita One"               => "Lilita One",
								"Limelight"                => "Limelight",
								"Linden Hill"              => "Linden Hill",
								"Lobster"                  => "Lobster",
								"Lobster Two"              => "Lobster Two",
								"Londrina Outline"         => "Londrina Outline",
								"Londrina Shadow"          => "Londrina Shadow",
								"Londrina Sketch"          => "Londrina Sketch",
								"Londrina Solid"           => "Londrina Solid",
								"Lora"                     => "Lora",
								"Love Ya Like A Sister"    => "Love Ya Like A Sister",
								"Loved by the King"        => "Loved by the King",
								"Lovers Quarrel"           => "Lovers Quarrel",
								"Luckiest Guy"             => "Luckiest Guy",
								"Lusitana"                 => "Lusitana",
								"Lustria"                  => "Lustria",
								"Macondo"                  => "Macondo",
								"Macondo Swash Caps"       => "Macondo Swash Caps",
								"Magra"                    => "Magra",
								"Maiden Orange"            => "Maiden Orange",
								"Mako"                     => "Mako",
								"Marcellus"                => "Marcellus",
								"Marcellus SC"             => "Marcellus SC",
								"Marck Script"             => "Marck Script",
								"Margarine"                => "Margarine",
								"Marko One"                => "Marko One",
								"Marmelad"                 => "Marmelad",
								"Marvel"                   => "Marvel",
								"Mate"                     => "Mate",
								"Mate SC"                  => "Mate SC",
								"Maven Pro"                => "Maven Pro",
								"McLaren"                  => "McLaren",
								"Meddon"                   => "Meddon",
								"MedievalSharp"            => "MedievalSharp",
								"Medula One"               => "Medula One",
								"Megrim"                   => "Megrim",
								"Meie Script"              => "Meie Script",
								"Merienda"                 => "Merienda",
								"Merienda One"             => "Merienda One",
								"Merriweather"             => "Merriweather",
								"Merriweather Sans"        => "Merriweather Sans",
								"Metal"                    => "Metal",
								"Metal Mania"              => "Metal Mania",
								"Metamorphous"             => "Metamorphous",
								"Metrophobic"              => "Metrophobic",
								"Michroma"                 => "Michroma",
								"Milonga"                  => "Milonga",
								"Miltonian"                => "Miltonian",
								"Miltonian Tattoo"         => "Miltonian Tattoo",
								"Miniver"                  => "Miniver",
								"Miss Fajardose"           => "Miss Fajardose",
								"Modern Antiqua"           => "Modern Antiqua",
								"Molengo"                  => "Molengo",
								"Molle"                    => "Molle",
								"Monda"                    => "Monda",
								"Monofett"                 => "Monofett",
								"Monoton"                  => "Monoton",
								"Monsieur La Doulaise"     => "Monsieur La Doulaise",
								"Montaga"                  => "Montaga",
								"Montez"                   => "Montez",
								"Montserrat"               => "Montserrat",
								"Montserrat Alternates"    => "Montserrat Alternates",
								"Montserrat Subrayada"     => "Montserrat Subrayada",
								"Moul"                     => "Moul",
								"Moulpali"                 => "Moulpali",
								"Mountains of Christmas"   => "Mountains of Christmas",
								"Mouse Memoirs"            => "Mouse Memoirs",
								"Mr Bedfort"               => "Mr Bedfort",
								"Mr Dafoe"                 => "Mr Dafoe",
								"Mr De Haviland"           => "Mr De Haviland",
								"Mrs Saint Delafield"      => "Mrs Saint Delafield",
								"Mrs Sheppards"            => "Mrs Sheppards",
								"Muli"                     => "Muli",
								"Mystery Quest"            => "Mystery Quest",
								"Neucha"                   => "Neucha",
								"Neuton"                   => "Neuton",
								"New Rocker"               => "New Rocker",
								"News Cycle"               => "News Cycle",
								"Niconne"                  => "Niconne",
								"Nixie One"                => "Nixie One",
								"Nobile"                   => "Nobile",
								"Nokora"                   => "Nokora",
								"Norican"                  => "Norican",
								"Nosifer"                  => "Nosifer",
								"Nothing You Could Do"     => "Nothing You Could Do",
								"Noticia Text"             => "Noticia Text",
								"Noto Sans"                => "Noto Sans",
								"Noto Serif"               => "Noto Serif",
								"Nova Cut"                 => "Nova Cut",
								"Nova Flat"                => "Nova Flat",
								"Nova Mono"                => "Nova Mono",
								"Nova Oval"                => "Nova Oval",
								"Nova Round"               => "Nova Round",
								"Nova Script"              => "Nova Script",
								"Nova Slim"                => "Nova Slim",
								"Nova Square"              => "Nova Square",
								"Numans"                   => "Numans",
								"Nunito"                   => "Nunito",
								"Odor Mean Chey"           => "Odor Mean Chey",
								"Offside"                  => "Offside",
								"Old Standard TT"          => "Old Standard TT",
								"Oldenburg"                => "Oldenburg",
								"Oleo Script"              => "Oleo Script",
								"Oleo Script Swash Caps"   => "Oleo Script Swash Caps",
								"Open Sans"                => "Open Sans",
								"Open Sans Condensed"      => "Open Sans Condensed",
								"Oranienbaum"              => "Oranienbaum",
								"Orbitron"                 => "Orbitron",
								"Oregano"                  => "Oregano",
								"Orienta"                  => "Orienta",
								"Original Surfer"          => "Original Surfer",
								"Oswald"                   => "Oswald",
								"Over the Rainbow"         => "Over the Rainbow",
								"Overlock"                 => "Overlock",
								"Overlock SC"              => "Overlock SC",
								"Ovo"                      => "Ovo",
								"Oxygen"                   => "Oxygen",
								"Oxygen Mono"              => "Oxygen Mono",
								"PT Mono"                  => "PT Mono",
								"PT Sans"                  => "PT Sans",
								"PT Sans Caption"          => "PT Sans Caption",
								"PT Sans Narrow"           => "PT Sans Narrow",
								"PT Serif"                 => "PT Serif",
								"PT Serif Caption"         => "PT Serif Caption",
								"Pacifico"                 => "Pacifico",
								"Paprika"                  => "Paprika",
								"Parisienne"               => "Parisienne",
								"Passero One"              => "Passero One",
								"Passion One"              => "Passion One",
								"Patrick Hand"             => "Patrick Hand",
								"Patrick Hand SC"          => "Patrick Hand SC",
								"Patua One"                => "Patua One",
								"Paytone One"              => "Paytone One",
								"Peralta"                  => "Peralta",
								"Permanent Marker"         => "Permanent Marker",
								"Petit Formal Script"      => "Petit Formal Script",
								"Petrona"                  => "Petrona",
								"Philosopher"              => "Philosopher",
								"Piedra"                   => "Piedra",
								"Pinyon Script"            => "Pinyon Script",
								"Pirata One"               => "Pirata One",
								"Plaster"                  => "Plaster",
								"Play"                     => "Play",
								"Playball"                 => "Playball",
								"Playfair Display"         => "Playfair Display",
								"Playfair Display SC"      => "Playfair Display SC",
								"Podkova"                  => "Podkova",
								"Poiret One"               => "Poiret One",
								"Poller One"               => "Poller One",
								"Poly"                     => "Poly",
								"Pompiere"                 => "Pompiere",
								"Pontano Sans"             => "Pontano Sans",
								"Port Lligat Sans"         => "Port Lligat Sans",
								"Port Lligat Slab"         => "Port Lligat Slab",
								"Prata"                    => "Prata",
								"Preahvihear"              => "Preahvihear",
								"Press Start 2P"           => "Press Start 2P",
								"Princess Sofia"           => "Princess Sofia",
								"Prociono"                 => "Prociono",
								"Prosto One"               => "Prosto One",
								"Puritan"                  => "Puritan",
								"Purple Purse"             => "Purple Purse",
								"Quando"                   => "Quando",
								"Quantico"                 => "Quantico",
								"Quattrocento"             => "Quattrocento",
								"Quattrocento Sans"        => "Quattrocento Sans",
								"Questrial"                => "Questrial",
								"Quicksand"                => "Quicksand",
								"Quintessential"           => "Quintessential",
								"Qwigley"                  => "Qwigley",
								"Racing Sans One"          => "Racing Sans One",
								"Radley"                   => "Radley",
								"Raleway"                  => "Raleway",
								"Raleway Dots"             => "Raleway Dots",
								"Rambla"                   => "Rambla",
								"Rammetto One"             => "Rammetto One",
								"Ranchers"                 => "Ranchers",
								"Rancho"                   => "Rancho",
								"Rationale"                => "Rationale",
								"Redressed"                => "Redressed",
								"Reenie Beanie"            => "Reenie Beanie",
								"Revalia"                  => "Revalia",
								"Ribeye"                   => "Ribeye",
								"Ribeye Marrow"            => "Ribeye Marrow",
								"Righteous"                => "Righteous",
								"Risque"                   => "Risque",
								"Roboto"                   => "Roboto",
								"Roboto Condensed"         => "Roboto Condensed",
								"Roboto Slab"              => "Roboto Slab",
								"Rochester"                => "Rochester",
								"Rock Salt"                => "Rock Salt",
								"Rokkitt"                  => "Rokkitt",
								"Romanesco"                => "Romanesco",
								"Ropa Sans"                => "Ropa Sans",
								"Rosario"                  => "Rosario",
								"Rosarivo"                 => "Rosarivo",
								"Rouge Script"             => "Rouge Script",
								"Ruda"                     => "Ruda",
								"Rufina"                   => "Rufina",
								"Ruge Boogie"              => "Ruge Boogie",
								"Ruluko"                   => "Ruluko",
								"Rum Raisin"               => "Rum Raisin",
								"Ruslan Display"           => "Ruslan Display",
								"Russo One"                => "Russo One",
								"Ruthie"                   => "Ruthie",
								"Rye"                      => "Rye",
								"Sacramento"               => "Sacramento",
								"Sail"                     => "Sail",
								"Salsa"                    => "Salsa",
								"Sanchez"                  => "Sanchez",
								"Sancreek"                 => "Sancreek",
								"Sansita One"              => "Sansita One",
								"Sarina"                   => "Sarina",
								"Satisfy"                  => "Satisfy",
								"Scada"                    => "Scada",
								"Schoolbell"               => "Schoolbell",
								"Seaweed Script"           => "Seaweed Script",
								"Sevillana"                => "Sevillana",
								"Seymour One"              => "Seymour One",
								"Shadows Into Light"       => "Shadows Into Light",
								"Shadows Into Light Two"   => "Shadows Into Light Two",
								"Shanti"                   => "Shanti",
								"Share"                    => "Share",
								"Share Tech"               => "Share Tech",
								"Share Tech Mono"          => "Share Tech Mono",
								"Shojumaru"                => "Shojumaru",
								"Short Stack"              => "Short Stack",
								"Siemreap"                 => "Siemreap",
								"Sigmar One"               => "Sigmar One",
								"Signika"                  => "Signika",
								"Signika Negative"         => "Signika Negative",
								"Simonetta"                => "Simonetta",
								"Sintony"                  => "Sintony",
								"Sirin Stencil"            => "Sirin Stencil",
								"Six Caps"                 => "Six Caps",
								"Skranji"                  => "Skranji",
								"Slackey"                  => "Slackey",
								"Smokum"                   => "Smokum",
								"Smythe"                   => "Smythe",
								"Sniglet"                  => "Sniglet",
								"Snippet"                  => "Snippet",
								"Snowburst One"            => "Snowburst One",
								"Sofadi One"               => "Sofadi One",
								"Sofia"                    => "Sofia",
								"Sonsie One"               => "Sonsie One",
								"Sorts Mill Goudy"         => "Sorts Mill Goudy",
								"Source Code Pro"          => "Source Code Pro",
								"Source Sans Pro"          => "Source Sans Pro",
								"Special Elite"            => "Special Elite",
								"Spicy Rice"               => "Spicy Rice",
								"Spinnaker"                => "Spinnaker",
								"Spirax"                   => "Spirax",
								"Squada One"               => "Squada One",
								"Stalemate"                => "Stalemate",
								"Stalinist One"            => "Stalinist One",
								"Stardos Stencil"          => "Stardos Stencil",
								"Stint Ultra Condensed"    => "Stint Ultra Condensed",
								"Stint Ultra Expanded"     => "Stint Ultra Expanded",
								"Stoke"                    => "Stoke",
								"Strait"                   => "Strait",
								"Sue Ellen Francisco"      => "Sue Ellen Francisco",
								"Sunshiney"                => "Sunshiney",
								"Supermercado One"         => "Supermercado One",
								"Suwannaphum"              => "Suwannaphum",
								"Swanky and Moo Moo"       => "Swanky and Moo Moo",
								"Syncopate"                => "Syncopate",
								"Tangerine"                => "Tangerine",
								"Taprom"                   => "Taprom",
								"Tauri"                    => "Tauri",
								"Telex"                    => "Telex",
								"Tenor Sans"               => "Tenor Sans",
								"Text Me One"              => "Text Me One",
								"The Girl Next Door"       => "The Girl Next Door",
								"Tienne"                   => "Tienne",
								"Tinos"                    => "Tinos",
								"Titan One"                => "Titan One",
								"Titillium Web"            => "Titillium Web",
								"Trade Winds"              => "Trade Winds",
								"Trocchi"                  => "Trocchi",
								"Trochut"                  => "Trochut",
								"Trykker"                  => "Trykker",
								"Tulpen One"               => "Tulpen One",
								"Ubuntu"                   => "Ubuntu",
								"Ubuntu Condensed"         => "Ubuntu Condensed",
								"Ubuntu Mono"              => "Ubuntu Mono",
								"Ultra"                    => "Ultra",
								"Uncial Antiqua"           => "Uncial Antiqua",
								"Underdog"                 => "Underdog",
								"Unica One"                => "Unica One",
								"UnifrakturCook"           => "UnifrakturCook",
								"UnifrakturMaguntia"       => "UnifrakturMaguntia",
								"Unkempt"                  => "Unkempt",
								"Unlock"                   => "Unlock",
								"Unna"                     => "Unna",
								"VT323"                    => "VT323",
								"Vampiro One"              => "Vampiro One",
								"Varela"                   => "Varela",
								"Varela Round"             => "Varela Round",
								"Vast Shadow"              => "Vast Shadow",
								"Vibur"                    => "Vibur",
								"Vidaloka"                 => "Vidaloka",
								"Viga"                     => "Viga",
								"Voces"                    => "Voces",
								"Volkhov"                  => "Volkhov",
								"Vollkorn"                 => "Vollkorn",
								"Voltaire"                 => "Voltaire",
								"Waiting for the Sunrise"  => "Waiting for the Sunrise",
								"Wallpoet"                 => "Wallpoet",
								"Walter Turncoat"          => "Walter Turncoat",
								"Warnes"                   => "Warnes",
								"Wellfleet"                => "Wellfleet",
								"Wendy One"                => "Wendy One",
								"Wire One"                 => "Wire One",
								"Yanone Kaffeesatz"        => "Yanone Kaffeesatz",
								"Yellowtail"               => "Yellowtail",
								"Yeseva One"               => "Yeseva One",
								"Yesteryear"               => "Yesteryear",
								"Zeyada"                   => "Zeyada"
							);

							$standard_fonts = array(
								'Arial, Helvetica, sans-serif'                         => 'Arial, Helvetica, sans-serif',
								"'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
								"'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
								"'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
								"Courier, monospace"                                   => "Courier, monospace",
								"Garamond, serif"                                      => "Garamond, serif",
								"Georgia, serif"                                       => "Georgia, serif",
								"Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
								"'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
								"'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
								"'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
								"'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
								"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
								"Tahoma, Geneva, sans-serif"                           => "Tahoma, Geneva, sans-serif",
								"'Times New Roman', Times, serif"                      => "'Times New Roman', Times, serif",
								"'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
								"Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                                "Proxima Nova"                          => "Proxima Nova"
							);




							$faces = array('arial'=>'Arial',
										   'verdana'=>'Verdana, Geneva',
										   'trebuchet'=>'Trebuchet',
										   'georgia' =>'Georgia',
										   'times'=>'Times New Roman',
										   'tahoma'=>'Tahoma, Geneva',
										   'palatino'=>'Palatino',
										   'helvetica'=>'Helvetica' );
                            if(!isset($i))
                                $i = 0;
							$output .= '<div class="controls-group">';
							$output .= '<label for="'. $value['id'].'_face">Font family</label>';
							$output .= '<div class="select_wrapper typography-face" original-title="Font family">';
							$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
							$output .= '<option value="none" ' . selected($typography_stored['face'], $i, false) . ' data-face-type="0">Select Font</option>';
							$output .= '<optgroup label="Standards Fonts">';



							foreach ($standard_fonts as $i=>$face) {
								$output .= '<option data-face-type="0" value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
							}

							$output .= ' </optgroup>';
							$output .= '<optgroup label="Google Fonts">';

							foreach ($google_fonts as $i=>$face) {
								$output .= '<option data-face-type="1" value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
							}

							$output .= ' </optgroup>';


							/*foreach ($faces as $i=>$face) {
								$output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
							}	*/

							$output .= '</select>';


							$face_type = !isset($typography_stored['face-type'])   ? 0 : $typography_stored['face-type'];

							$output .= '<input type="hidden" id="'. $value['id'].'_face_type" value="' .$face_type . '" name="'. $value['id'].'[face-type]" class="of-typography-face-type">';
							$output .= '</div></div>';
						}



						/* Font Size */

						if(isset($typography_stored['size'])) {
							$output .= '<div class="controls-group">';
							$output .= '<label for="'. $value['id'].'_size">Font size</label>';
							$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
							$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
							for ($i = 9; $i <= 60; $i++){
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>';
							}

							$output .= '</select></div></div>';

						}

						/* Line Height */
						if(isset($typography_stored['height'])) {
							$output .= '<div class="controls-group">';
							$output .= '<label for="'. $value['id'].'_height">Line height</label>';
							$output .= '<div class="select_wrapper typography-height" original-title="Line height">';
							$output .= '<select class="of-typography of-typography-height select" name="'.$value['id'].'[height]" id="'. $value['id'].'_height">';
							$output .= '<option value="none" ' . selected($typography_stored['height'], $test, false) . '>None</option>';
							for ($i = 18; $i < 38; $i++){
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($typography_stored['height'], $test, false) . '>'. $i .'px</option>';
							}

							$output .= '</select></div></div>';

						}



						/* Font Style */
						if(isset($typography_stored['style'])) {

							$styles = array(
								'normal'  => 'Normal',
								'italic'  => 'Italic',
								'oblique' => 'Oblique',
								'inherit' => 'Inherit'
							);
							$output .= '<div class="controls-group">';
							$output .= '<label for="'. $value['id'].'_style">Font style</label>';
							$output .= '<div class="select_wrapper typography-style" original-title="Font Weight">';
							$output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
							foreach ($styles as $i=>$style){

								$output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';
							}
							$output .= '</select></div></div>';

						}

						/*Font Weight*/

						if(isset($typography_stored['weight'])) {

							$styles = array(
								'normal'  => 'Normal',
								'bold'    => 'Bold',
								'lighter' => 'Lighter',
								'100'     => '100',
								'200'     => '200',
								'300'     => '300',
								'400'     => '400',
								'500'     => '500',
								'600'     => '600',
								'700'     => '700',
								'800'     => '800',
								'900'     => '900',
								'inherit' => 'Inherit'
							);
							$output .= '<div class="controls-group">';
							$output .= '<label for="'. $value['id'].'_style">Font weight</label>';
							$output .= '<div class="select_wrapper typography-weight" original-title="Font weight">';
							$output .= '<select class="of-typography of-typography-weight select" name="'.$value['id'].'[weight]" id="'. $value['id'].'_weight">';
							foreach ($styles as $i=>$style){

								$output .= '<option value="'. $i .'" ' . selected($typography_stored['weight'], $i, false) . '>'. $style .'</option>';
							}
							$output .= '</select></div></div>';

						}

						/*Text Transform*/
						if (isset($typography_stored['text-transform']))
						{
							$text_transforms = array(
								'capitalize' => 'Capitalize',
								'inherit'    => 'Inherit',
								'lowercase'  => 'Lowercase',
								'none'       => 'None',
								'uppercase'  => 'Uppercase'
							);
							$output .= '<div class="controls-group">';
							$output .= '<label for="'. $value['id'].'_text_transform">Text transform</label>';
							$output .= '<div class="select_wrapper typography-text-transform" original-title="Text Transform">';
							$output .= '<select class="of-typography of-typography-text-transform select" name="'.$value['id'].'[text-transform]" id="'. $value['id'].'_text_transform">';
							foreach ($text_transforms as $i=>$text_transform){

								$output .= '<option value="'. $i .'" ' . selected($typography_stored['text-transform'], $i, false) . '>'. $text_transform .'</option>';
							}
							$output .= '</select></div></div>';


						}

						/* Font Color */
						if(isset($typography_stored['color'])) {
							$output .= '<div class="controls-group">';
							$output .= '<label for="'. $value['id'].'_color">Text color</label>';
							$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
							$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';
							$output .= '</div>';
						}

						/* Font Color Hover */
						if(isset($typography_stored['color-hover'])) {
							$output .= '<div class="controls-group">';
							$output .= '<label for="'. $value['id'].'_color_hover">Hover color</label>';
							$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: '.$typography_stored['color-hover'].'"></div></div>';
							$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color hover" name="'.$value['id'].'[color-hover]" id="'. $value['id'] .'_color_hover" type="text" value="'. $typography_stored['color-hover'] .'" />';
							$output .= '</div>';
						}

						break;

					//border option
					case 'border':

						/* Border Width */
						$border_stored = $smof_data[$value['id']];

						$output .= '<div class="select_wrapper border-width">';
						$output .= '<select class="of-border of-border-width select" name="'.$value['id'].'[width]" id="'. $value['id'].'_width">';
						for ($i = 0; $i < 21; $i++){
							$output .= '<option value="'. $i .'" ' . selected($border_stored['width'], $i, false) . '>'. $i .'</option>';				 }
						$output .= '</select></div>';

						/* Border Style */
						$output .= '<div class="select_wrapper border-style">';
						$output .= '<select class="of-border of-border-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';

						$styles = array('none'=>'None',
										'solid'=>'Solid',
										'dashed'=>'Dashed',
										'dotted'=>'Dotted');

						foreach ($styles as $i=>$style){
							$output .= '<option value="'. $i .'" ' . selected($border_stored['style'], $i, false) . '>'. $style .'</option>';
						}

						$output .= '</select></div>';

						/* Border Color */
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$border_stored['color'].'"></div></div>';
						$output .= '<input class="of-color of-border of-border-color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $border_stored['color'] .'" />';

						break;

					//images checkbox - use image as checkboxes
					case 'images':

						$i = 0;

						$select_value = (isset($smof_data[$value['id']])) ? $smof_data[$value['id']] : '';

						foreach ($value['options'] as $key => $option)
						{
							$i++;

							$checked = '';
							$selected = '';
							if(NULL!=checked($select_value, $key, false)) {
								$checked = checked($select_value, $key, false);
								$selected = 'of-radio-img-selected';
							}
							$output .= '<span>';
							$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'.$value['id'].'" '.$checked.' />';
							$output .= '<div class="of-radio-img-label">'. $key .'</div>';
							$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
							$output .= '</span>';
						}

						break;

					//info (for small intro box etc)
					case "info":
						$info_text = $value['std'];
						$output .= '<div class="of-info">'.$info_text.'</div>';
						break;

					//display a single image
					case "image":
						$src = $value['std'];
						$output .= '<img src="'.$src.'">';
						break;

					//tab heading
					case 'heading':
						if($counter >= 2){
							$output .= '</div>'."\n";
						}
						//custom icon
						$icon = '';
						if(isset($value['icon'])){
							$icon = ' style="background-image: url('. $value['icon'] .');"';
						}
						$header_class = str_replace(' ','',strtolower($value['name']));
						$jquery_click_hook = str_replace(' ', '', strtolower($value['name']) );
						$jquery_click_hook = "of-option-" . $jquery_click_hook;
						$menu .= '<li class="'. $header_class .'"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'"'. $icon .'>'.  $value['name'] .'</a></li>';
						$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
						break;

					//drag & drop slide manager
					case 'slider':
						$output .= '<div class="slider"><ul id="'.$value['id'].'">';
						$slides = $smof_data[$value['id']];
						$count = count($slides);
						if ($count < 2) {
							$oldorder = 1;
							$order = 1;
							$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order);
						} else {
							$i = 0;
							foreach ($slides as $slide) {
								$oldorder = $slide['order'];
								$i++;
								$order = $i;
								$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order);
							}
						}
						$output .= '</ul>';
						$output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';

						break;

					//drag & drop block manager
					case 'sorter':

						// Make sure to get list of all the default blocks first
						$all_blocks = $value['std'];

						$temp = array(); // holds default blocks
						$temp2 = array(); // holds saved blocks

						foreach($all_blocks as $blocks) {
							$temp = array_merge($temp, $blocks);
						}

						$sortlists = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['std'];

						foreach( $sortlists as $sortlist ) {
							$temp2 = array_merge($temp2, $sortlist);
						}

						// now let's compare if we have anything missing
						foreach($temp as $k => $v) {
							if(!array_key_exists($k, $temp2)) {
								$sortlists['disabled'][$k] = $v;
							}
						}

						// now check if saved blocks has blocks not registered under default blocks
						foreach( $sortlists as $key => $sortlist ) {
							foreach($sortlist as $k => $v) {
								if(!array_key_exists($k, $temp)) {
									unset($sortlist[$k]);
								}
							}
							$sortlists[$key] = $sortlist;
						}

						// assuming all sync'ed, now get the correct naming for each block
						foreach( $sortlists as $key => $sortlist ) {
							foreach($sortlist as $k => $v) {
								$sortlist[$k] = $temp[$k];
							}
							$sortlists[$key] = $sortlist;
						}

						$output .= '<div id="'.$value['id'].'" class="sorter">';


						if ($sortlists) {

							foreach ($sortlists as $group=>$sortlist) {

								$output .= '<ul id="'.$value['id'].'_'.$group.'" class="sortlist_'.$value['id'].'">';
								$output .= '<h3>'.$group.'</h3>';

								foreach ($sortlist as $key => $list) {

									$output .= '<input class="sorter-placebo" type="hidden" name="'.$value['id'].'['.$group.'][placebo]" value="placebo">';

									if ($key != "placebo") {

										$output .= '<li id="'.$key.'" class="sortee">';
										$output .= '<input class="position" type="hidden" name="'.$value['id'].'['.$group.']['.$key.']" value="'.$list.'">';
										$output .= $list;
										$output .= '</li>';

									}

								}

								$output .= '</ul>';
							}
						}

						$output .= '</div>';
						break;

					//background images option
					case 'tiles':

						$i = 0;
						$select_value = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';
						if (is_array($value['options'])) {
							foreach ($value['options'] as $key => $option) {
								$i++;

								$checked = '';
								$selected = '';
								if(NULL!=checked($select_value, $option, false)) {
									$checked = checked($select_value, $option, false);
									$selected = 'of-radio-tile-selected';
								}
								$output .= '<span>';
								$output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="'.$option.'" name="'.$value['id'].'" '.$checked.' />';
								$output .= '<div class="of-radio-tile-img '. $selected .'" style="background: url('.$option.')" onClick="document.getElementById(\'of-radio-tile-'. $value['id'] . $i.'\').checked = true;"></div>';
								$output .= '</span>';
							}
						}

						break;

					//backup and restore options data
					case 'backup':

						$instructions = $value['desc'];
						$backup = of_get_options(BACKUPS);
						$init = of_get_options('smof_init');


						if(!isset($backup['backup_log'])) {
							$log = 'No backups yet';
						} else {
							$log = $backup['backup_log'];
						}

						$output .= '<div class="backup-box">';
						$output .= '<div class="instructions">'.$instructions."\n";
						$output .= '<p><strong>'. esc_html__('Last Backup : ','zorka').'<span class="backup-log">'.$log.'</span></strong></p></div>'."\n";
						$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
						$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
						$output .= '</div>';

						break;

					//export or import data between different installs
					case 'transfer':

						$instructions = $value['desc'];
						$output .= '<textarea id="export_data" rows="8">'.base64_encode(serialize($smof_data)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n";
						$output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';

						break;

					// google font field
					case 'select_google_font':
						$output .= '<div class="select_wrapper">';
						$output .= '<select class="select of-input google_font_select" name="'.$value['id'].'" id="'. $value['id'] .'">';
						foreach ($value['options'] as $select_key => $option) {
							$output .= '<option value="'.$select_key.'" ' . selected((isset($smof_data[$value['id']]))? $smof_data[$value['id']] : "", $option, false) . ' />'.$option.'</option>';
						}
						$output .= '</select></div>';

						if(isset($value['preview']['text'])){
							$g_text = $value['preview']['text'];
						} else {
							$g_text = '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz';
						}
						if(isset($value['preview']['size'])) {
							$g_size = 'style="font-size: '. $value['preview']['size'] .';"';
						} else {
							$g_size = '';
						}

						$output .= '<p class="'.$value['id'].'_ggf_previewer google_font_preview" '. $g_size .'>'. $g_text .'</p>';
						break;

					//JQuery UI Slider
					case 'sliderui':
						$s_val = $s_min = $s_max = $s_step = $s_edit = '';//no errors, please

						$s_val  = stripslashes($smof_data[$value['id']]);

						if(!isset($value['min'])){ $s_min  = '0'; }else{ $s_min = $value['min']; }
						if(!isset($value['max'])){ $s_max  = $s_min + 1; }else{ $s_max = $value['max']; }
						if(!isset($value['step'])){ $s_step  = '1'; }else{ $s_step = $value['step']; }

						if(!isset($value['edit'])){
							$s_edit  = ' readonly="readonly"';
						}
						else
						{
							$s_edit  = '';
						}

						if ($s_val == '') $s_val = $s_min;

						//values
						$s_data = 'data-id="'.$value['id'].'" data-val="'.$s_val.'" data-min="'.$s_min.'" data-max="'.$s_max.'" data-step="'.$s_step.'"';

						//html output
						$output .= '<input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'. $s_val .'" class="mini" '. $s_edit .' />';
						$output .= '<div id="'.$value['id'].'-slider" class="smof_sliderui" style="margin-left: 7px;" '. $s_data .'></div>';

						break;


					//Switch option
					case 'switch':
						if (!isset($smof_data[$value['id']])) {
							$smof_data[$value['id']] = 0;
						}

						$fold = '';
						if (array_key_exists("folds",$value)) $fold="s_fld ";

						$cb_enabled = $cb_disabled = '';//no errors, please

						//Get selected
						if ($smof_data[$value['id']] == 1){
							$cb_enabled = ' selected';
							$cb_disabled = '';
						}else{
							$cb_enabled = '';
							$cb_disabled = ' selected';
						}

						//Label ON
						if(!isset($value['on'])){
							$on = "On";
						}else{
							$on = $value['on'];
						}

						//Label OFF
						if(!isset($value['off'])){
							$off = "Off";
						}else{
							$off = $value['off'];
						}

						$output .= '<p class="switch-options">';
						$output .= '<label class="'.$fold.'cb-enable'. $cb_enabled .'" data-id="'.$value['id'].'"><span>'. $on .'</span></label>';
						$output .= '<label class="'.$fold.'cb-disable'. $cb_disabled .'" data-id="'.$value['id'].'"><span>'. $off .'</span></label>';

						$output .= '<input type="hidden" class="'.$fold.'checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="0"/>';
						$output .= '<input type="checkbox" id="'.$value['id'].'" class="'.$fold.'checkbox of-input main_checkbox" name="'.$value['id'].'"  value="1" '. checked($smof_data[$value['id']], 1, false) .' />';

						$output .= '</p>';

						break;

					// Uploader 3.5
					case "upload":
					case "media":

						if(!isset($value['mod'])) $value['mod'] = '';

						$u_val = '';
						if($smof_data[$value['id']]){
							$u_val = stripslashes($smof_data[$value['id']]);
						}
						else
						{
							$u_val = stripslashes($value['std']);
						}

						$output .= Options_Machine::optionsframework_media_uploader_function($value['id'],$u_val, $value['mod']);

						break;
					case "g5plus_import":

						if ( ! isset( $value['mod'] ) ) {
							$value['mod'] = '';
						}

						$u_val = '';
						if ( $smof_data[$value['id']] ) {
							$u_val = stripslashes( $smof_data[$value['id']] );
						}

						$output .= Options_Machine::optionsframework_import_function( $value['id'], $u_val, $value['mod'] );

						break;
					//text hidden
					case 'hidden':
						$mini = '';

						if ( $value['mod'] == 'mini' ) {
							$mini = 'mini';
						}

						$output .= '<input class="of-input ' . $mini . '" name="' . $value['id'] . '" id="' . $value['id'] . '" type="' . $value['type'] . '" value="' . $value['std'] . '" />';
						break;
				}

				do_action('optionsframework_machine_loop', array(
					'options'	=> $options,
					'smof_data'	=> $smof_data,
					'defaults'	=> $defaults,
					'counter'	=> $counter,
					'menu'		=> $menu,
					'output'	=> $output,
					'value'		=> $value
				));
				$output .= $smof_output;

				//description of each option
				if ( $value['type'] != 'heading') {
					if(!isset($value['desc'])){ $explain_value = ''; } else{
						$explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n";
					}
					$output .= '</div>'.$explain_value."\n";
					$output .= '<div class="clear"> </div></div></div>'."\n";
				}

			} /* condition empty end */

		}

		$output .= '</div>';

		do_action('optionsframework_machine_after', array(
			'options'		=> $options,
			'smof_data'		=> $smof_data,
			'defaults'		=> $defaults,
			'counter'		=> $counter,
			'menu'			=> $menu,
			'output'		=> $output,
			'value'			=> $value
		));
		$output .= $smof_output;

		return array($output,$menu,$defaults);

	}


	/**
	 * Native media library uploader
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_media_uploader_function($id,$std,$mod){

		$data = of_get_options();
		$smof_data = of_get_options();

		$uploader = '';
		$upload = '';
        if(array_key_exists($id,$smof_data )){
            $upload = $smof_data[$id];
        }
		$hide = '';

		if ($mod == "min") {$hide ='hide';}

		if ( $upload != "") { $val = $upload; } else {$val = $std;}

		$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';

		//Upload controls DIV
		$uploader .= '<div class="upload_button_div">';
		//If the user has WP3.5+ show upload/remove button
		if ( function_exists( 'wp_enqueue_media' ) ) {
			$uploader .= '<span class="button media_upload_button" id="'.$id.'">Upload</span>';

			if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
			$uploader .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		}
		else
		{
            $uploader .= '<p class="upload-notice"><i>Upgrade your version of WordPress for full media support.</i></p>';
		}

		$uploader .='</div>' . "\n";

		//Preview
		$uploader .= '<div class="screenshot">';
		if(!empty($val)){
			$uploader .= '<a class="of-uploaded-image" href="'. $val . '">';
			$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$val.'" alt="" />';
			$uploader .= '</a>';
		}
		$uploader .= '</div>';
		$uploader .= '<div class="clear"></div>' . "\n";

		return $uploader;
	}

	/**
	 * Drag and drop slides manager
	 *
	 * @uses get_theme_mod()
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public static function optionsframework_slider_function($id,$std,$oldorder,$order){

		$data = of_get_options();
		$smof_data = of_get_options();

		$slider = '';
		$slide = array();
		$slide = '';
        if(array_key_exists($id,$smof_data )){
            $slide = $smof_data[$id];
        }

		if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}

		//initialize all vars
		$slidevars = array('title','url','link','description');

		foreach ($slidevars as $slidevar) {
			if (!isset($val[$slidevar])) {
				$val[$slidevar] = '';
			}
		}

		//begin slider interface	
		if (!empty($val['title'])) {
			$slider .= '<li><div class="slide_header"><strong>'.stripslashes($val['title']).'</strong>';
		} else {
			$slider .= '<li><div class="slide_header"><strong>Slide '.$order.'</strong>';
		}

		$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';

		$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';

		$slider .= '<div class="slide_body">';

		$slider .= '<label>Title</label>';
		$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. stripslashes($val['title']) .'" />';

		$slider .= '<label>Image URL</label>';
		$slider .= '<input class="upload slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';

		$slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="'.$id.'_'.$order .'">Upload</span>';

		if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
		$slider .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="screenshot">';
		if(!empty($val['url'])){

			$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
			$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';
			$slider .= '</a>';

		}
		$slider .= '</div>';
		$slider .= '<label>Link URL (optional)</label>';
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';

		$slider .= '<label>Description (optional)</label>';
		$slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][description]" id="'. $id .'_'.$order .'_slide_description" cols="8" rows="8">'.stripslashes($val['description']).'</textarea>';

		$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
		$slider .= '<div class="clear"></div>' . "\n";

		$slider .= '</div>';
		$slider .= '</li>';

		return $slider;

	}
	public static function optionsframework_import_function( $id, $std, $mod ) {
		$uploader = '';
		return $uploader;
	}


}//end Options Machine class

?>
