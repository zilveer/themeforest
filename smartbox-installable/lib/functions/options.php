<?php
/* ------------------------------------------------------------------------*
 * This file contains the main theme options functionality.
 * ------------------------------------------------------------------------*/

/**
 * ADD THE ACTIONS
 */
if ( isset($_GET['page']) && $_GET['page'] == DESIGNARE_OPTIONS_PAGE ){
	//options actions
	add_action('init', 'designare_init_options_functionality');  
	add_action('admin_init', 'designare_set_options'); 
}

/**
 * Inits the options functionality. Loads the files that contain the options arrays
 * to populate the global options array.
 */
function designare_init_options_functionality(){
	global $designare_options;

	$designare_options=array();

	//get all the categories
	$categories=get_categories('hide_empty=0');
	$designare_categories=array();
	for($i=0; $i<sizeof($categories); $i++){
		$designare_categories[]=array('id'=>$categories[$i]->cat_ID, 'name'=>$categories[$i]->cat_name);
	}

	//load the files that contain the options
	$designare_options_files=array('general', 'styles', 'toppanel', 'widgetsarea', 'newsletter', 'translation', 'social', 'sliders', 'customcss', 'data');
	foreach($designare_options_files as $file){
		require_once(DESIGNARE_OPTIONS_PATH.$file.'.php');
	}
}


/**
 * Sets the Options save functionality.
 */
function designare_set_options(){
	global $designare_options;
	
	$nonsavable_types=array('open', 'close','subtitle','title','documentation');

	//insert the default values if the fields are empty
	foreach ($designare_options as $value) {
		if(isset($value['id'])){
			if(get_option($value['id'])=='' && isset($value['std']) && !in_array($value['type'], $nonsavable_types)){
				update_option( $value['id'], $value['std']);
			}
		}
	}
	
	//save the field's values if the Save action is present
	if ( $_GET['page'] == DESIGNARE_OPTIONS_PAGE ) {
	
		if (isset($_REQUEST['action'])){
			if ( 'save' == $_REQUEST['action'] ) {
				//verify the nonce
				if ( empty($_POST) || !wp_verify_nonce($_POST['designare-theme-options'],'designare-theme-update-options') ){
					print 'Sorry, your nonce did not verify.';
					exit;
				} else {
					
					if (!get_option(DESIGNARE_SHORTNAME.'_first_save')){
						update_option(DESIGNARE_SHORTNAME.'_first_save','true');
					}
					
					$uploaddir = wp_upload_dir();
					$filename = $uploaddir['basedir']."/options.xml";
					$doc = new DOMDocument('1.0');
					$doc->formatOutput = true;
					$root = $doc->createElement('root');

					foreach ($designare_options as $value) {
						
						if (isset($value['id'])){
							if( isset( $_REQUEST[ $value['id'] ] ) && !in_array($value['type'], $nonsavable_types)) {
								
								if ($value['id'] === DESIGNARE_SHORTNAME."_portfolio_permalink"){
									$oldval = get_option(DESIGNARE_SHORTNAME."_portfolio_permalink");
									$newval = $_REQUEST[$value['id']];
									
									if ($oldval !== $newval){
										global $wpdb;
										$args = array(
											'posts_per_page' => -1,
											'post_type' => "$oldval"
										);
										$theposts = get_posts( $args );
										foreach ($theposts as $p){
											$q = "UPDATE ".$wpdb->prefix."posts SET post_type='".$newval."' WHERE ID=".$p->ID;
											$oldGuid = $p->guid;
											$aux1 = explode("?post_type=",$oldGuid);
											$newGuid = home_url('/')."?post_type=".$newval."&amp;p=".$p->ID;
											$q2 = "UPDATE ".$wpdb->prefix."posts SET guid='".$newGuid."' WHERE ID=".$p->ID; 
											$wpdb->query($q);
											$wpdb->query($q2);
										}
									} 
									
								}
								
								update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
								
								$opt = $doc->createElement('option');
								$val = $doc->createElement('value');
								$valText = $doc->createTextNode($_REQUEST[$value['id']]);
								$val->appendChild($valText);
								
								$id = $doc->createElement('id');
								$idText = $doc->createTextNode($value['id']);
								$id->appendChild($idText);

								$opt->appendChild($id);								
								$opt->appendChild($val);

								$root->appendChild($opt);
																				
							} else if(!in_array($value['type'], $nonsavable_types)){
								delete_option( $value['id'] );
							}	
						}
	
						/*
						Update the values for the custom options that contain unlimited suboptions - for example when having
						 * a slider with fields "title" and "imageurl", for all the entities the titles will be saved in one field,
						 * separated by a separator. In this case, if the field name is slider_title and it contains some data like
						 * title 1|*|title2|*|title3 (|*| is the separator), then all this data will be saved into a custom field
						 * with id slider_titles.
						 */
						if($value['type']=='custom'){
							foreach($value['fields'] as $field){
								update_option( $field['id'].'s', $_REQUEST[ $field['id'].'s' ] );

								$opt = $doc->createElement('option');
								$val = $doc->createElement('value');
								if (isset($_REQUEST[$value['id']]))
									$valText = $doc->createTextNode($_REQUEST[$value['id']]);
								$val->appendChild($valText);
								
								$id = $doc->createElement('id');
								$idText = $doc->createTextNode($value['id']);
								$id->appendChild($idText);

								$opt->appendChild($id);								
								$opt->appendChild($val);

								$root->appendChild($opt);
																
								
							}
						}
					}
					
					/* pass the values from the templater */
					global $wpdb;
					$q = "SELECT option_value from ".$wpdb->prefix."options WHERE option_name='des_styletemplates'";
					$result = $wpdb->get_results($q, ARRAY_A);
					$opt = $doc->createElement('option');
					$val = $doc->createElement('value');
					$valText = $doc->createTextNode($result[0]['option_value']);
					$val->appendChild($valText);
					
					$id = $doc->createElement('id');
					$idText = $doc->createTextNode('des_styletemplates');
					$id->appendChild($idText);

					$opt->appendChild($id);								
					$opt->appendChild($val);

					$root->appendChild($opt);
					if (is_array(unserialize(trim($result[0]['option_value'])))){
						foreach(unserialize(trim($result[0]['option_value'])) as $r){
							$q = "SELECT option_value from ".$wpdb->prefix."options WHERE option_name='".$r."' LIMIT 1";
							$result = $wpdb->get_results($q, ARRAY_A);
							$opt = $doc->createElement('option');
							$val = $doc->createElement('value');
							$valText = $doc->createTextNode($result[0]['option_value']);
							$val->appendChild($valText);
							
							$id = $doc->createElement('id');
							$idText = $doc->createTextNode($r);
							$id->appendChild($idText);
		
							$opt->appendChild($id);								
							$opt->appendChild($val);
		
							$root->appendChild($opt);
						}	
					}
					
					$doc->appendChild($root);
					$doc->save($filename);		
					header("Location: themes.php?page=".DESIGNARE_OPTIONS_PAGE."&saved=true");
					die;
				}
			}	
		}
	}

}

/**
 * Calls the options manager to print the Options page.
 */
function designare_theme_admin() {
	global $designare_options,$designare_options_manager;

	$designare_options_manager=new DesignareOptionsManager(DESIGNARE_THEMENAME, DESIGNARE_IMAGES_URL, DESIGNARE_UTILS_URL, DESIGNARE_UPLOADS_URL, DESIGNARE_VERSION);
	$designare_options_manager->set_options($designare_options);

	if ( isset($_REQUEST['saved'] )) {
		$designare_options_manager->print_saved_message();
	}
	if ( isset($_REQUEST['reset'] )) {
		$designare_options_manager->print_reset_message();
	}

	$designare_options_manager->print_heading("");
	$designare_options_manager->print_options();
	$designare_options_manager->print_footer();
}


/**
 * Adds all the options that an array contains to the current global options array.
 * @param $option_arr the array that contains the options values
 */
function designare_add_options($option_arr){
	global $designare_options;

	foreach($option_arr as $option){
		$designare_options[]=$option;
	}
}


/**
 * Prints an option.
 * @param $option the option's second part of the ID (after the theme's shortname part)
 */
function echo_option($option){
	echo(stripslashes(get_option(DESIGNARE_SHORTNAME.$option)));
}

/**
 * Gets an option
 * @param $option the option's second part of the ID (after the theme's shortname part)
 */
function get_opt($option){
	return stripslashes(get_option(DESIGNARE_SHORTNAME.$option));
}

/**
 * Returns the checked options from a multicheck widget in an array.
 * @param $option the option ID
 */
function des_get_multiopt($option){
	$res=array();
	if(get_opt($option)){
		$res=explode(',', get_opt($option));
	}
	return $res;
}

/**
 * Returns the options from a custom option field
 * @param $option the option ID
 */
function designare_get_google_fonts(){
	$res=array();
	$fonts=get_option('des_google_fonts_names');
	if($fonts){
		$res=explode(DESIGNARE_SEPARATOR, $fonts);
		array_pop($res);
	}elseif(!get_option('designare_first_save')){
		$res=explode(DESIGNARE_SEPARATOR, DESIGNARE_GOOGLE_FONTS);
		array_pop($res);
	}
	return $res;
}

function designare_get_custom_sidebars(){
	$res=array();
	$sides=get_option('des_sidebar_name_names');
	if($sides){
		$res=explode(DESIGNARE_SEPARATOR, $sides);
		array_pop($res);
	}
	return $res;
}


/**
 * Gets an array containing options settings and if there is an option for adding
 * multiple entities of one type, generates addional array elements for these entities.
 * For example: If there have been created 2 additional sliders, it will append
 * to option elements to this array for each slider.
 * @param $opt_array the array to be modified
 * @return an array containing the custom entity options
 */
function designare_add_custom_options($opt_array){
	$new_designare_options=array();

	foreach($opt_array as $option){
		if($option['type']=='multiple_custom'){
			//insert the new custom options here
				
			$saved_values=get_option($option['refers']);
			$saved_array=explode(DESIGNARE_SEPARATOR, $saved_values);
			if(sizeof($saved_array)>1){
				array_pop($saved_array);
				foreach($saved_array as $custom_name){
					$id=convert_to_class($custom_name);
					$custom_option=array(
					"id"=>$id,
					"name"=>$option["name"].$custom_name,
					"button_text"=>$option["button_text"],
					"type"=>"custom",
					"preview"=>$id.$option["preview"]
					);
						
					//generate new fields with different unique IDs
					$fields=$option['fields'];
					for($i=0; $i<sizeof($fields);$i++){
						$fields[$i]['id']=$id.$fields[$i]['id'];
					}
						
					$custom_option['fields']=$fields;
						
					array_push($new_designare_options, $custom_option);
				}
			}
				
		}else{
			//this is just a normal option, just append it into the new array
			array_push($new_designare_options, $option);
		}
	}

	return $new_designare_options;
}

function designare_fonts_array_builder(){
	$res=array();
	$fam1 = array();
	$fam2 = array();
	$fam3 = array();
	//$res2 = array();
	$res2 = array(array("id" => "", "name"=> "---- Predefined Fonts ----", "class" => "select_font_type"), array("id" => "Open Sans Light", "name" => "Open Sans Light", "class" => "select_font_name"), array("id" => "Open Sans Bold", "name" => "Open Sans Bold", "class" => "select_font_name"), array("id" => "Open Sans Semibold", "name" => "Open Sans Semibold", "class" => "select_font_name"), array("id" => "", "name"=> "---- Standard Fonts ----", "class" => "select_font_type"), array("id" => "Arial", "name" => "Arial", "class" => "select_font_name"), array("id" => "Arial Black", "name" => "Arial Black", "class" => "select_font_name"), array("id" => "Helvetica", "name" => "Helvetica", "class" => "select_font_name"), array("id" => "Helvetica Neue", "name" => "Helvetica Neue", "class" => "select_font_name"), array("id" => "Courier New", "name" => "Courier New", "class" => "select_font_name"), array("id" => "Georgia", "name" => "Georgia", "class" => "select_font_name"), array("id" => "Impact", "name" => "Impact", "class" => "select_font_name"), array("id" => "Lucida Sans Unicode", "name" => "Lucida Sans", "class" => "select_font_name"), array("id" => "Times New Roman", "name" => "Times New Roman", "class" => "select_font_name"), array("id" => "Trebuchet MS", "name" => "Trebuchet MS", "class" => "select_font_name"), array("id" => "Verdana", "name" => "Verdana", "class" => "select_font_name"), array("id" => "", "name"=> "---- Custom Fonts ----", "class" => "select_font_type"));
	
	//array_push($res2, $defaultfonts);
	
	$fonts=get_option('des_google_fonts_names');
	if($fonts && get_option(DESIGNARE_SHORTNAME.'_enable_google_fonts') == 'on'){
		$res=explode(DESIGNARE_SEPARATOR, $fonts);
		
		for ($i = 0; $i < count($res)-1; $i++){
			$fam1 = explode('family=', $res[$i]);	
			$fam2 = explode(':', $fam1[1]);
			$fam3 = str_replace('+', ' ', $fam2[0]);
			$famfinal = array("id"=> $fam3, "name" => $fam3, "class" => "select_font_name");
			array_push($res2, $famfinal);
		}
		
	} 
	return $res2;
}

function designare_portfolio_types(){
	//load the porftfolio categeories
	$portf_taxonomies=designare_get_taxonomies('portfolio_type');
	$portf_categories=array(array('id'=>'all', 'name'=>'All Portfolios'));

	foreach($portf_taxonomies as $taxonomy){
		$portf_categories[]=array("name"=>$taxonomy->name, "id"=>$taxonomy->slug);
	}
	
	return $portf_categories;
}

function designare_get_proj(){
	$designare_proj1 = designare_get_projects();
	
	$designare_proj2=array(array('id'=>'default', 'name'=>'Default'));

	foreach($designare_proj1 as $dp){
		$designare_proj2[]=array("name"=>$dp['p_title'], "id"=>$dp['p_id']);
	}
	return $designare_proj2;
}


function des_get_all_google_fonts(){
	$smartbox_google_fonts = array(	array( 'name' => "Cantarell", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Cardo", 'variant' => ''),
						array( 'name' => "Crimson Text", 'variant' => ''),
						array( 'name' => "Droid Sans", 'variant' => ':r,b'),
						array( 'name' => "Droid Sans Mono", 'variant' => ''),
						array( 'name' => "Droid Serif", 'variant' => ':r,b,i,bi'),
						array( 'name' => "IM Fell DW Pica", 'variant' => ':r,i'),
						array( 'name' => "Inconsolata", 'variant' => ''),
						array( 'name' => "Josefin Sans", 'variant' => ':400,400italic,700,700italic'),
						array( 'name' => "Josefin Slab", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Lobster", 'variant' => ''),
						array( 'name' => "Molengo", 'variant' => ''),
						array( 'name' => "Nobile", 'variant' => ':r,b,i,bi'),
						array( 'name' => "OFL Sorts Mill Goudy TT", 'variant' => ':r,i'),
						array( 'name' => "Old Standard TT", 'variant' => ':r,b,i'),
						array( 'name' => "Reenie Beanie", 'variant' => ''),
						array( 'name' => "Tangerine", 'variant' => ':r,b'),
						array( 'name' => "Vollkorn", 'variant' => ':r,b'),
						array( 'name' => "Yanone Kaffeesatz", 'variant' => ':r,b'),
						array( 'name' => "Cuprum", 'variant' => ''),
						array( 'name' => "Neucha", 'variant' => ''),
						array( 'name' => "Neuton", 'variant' => ''),
						array( 'name' => "PT Sans", 'variant' => ':r,b,i,bi'),
						array( 'name' => "PT Sans Caption", 'variant' => ':r,b'),
						array( 'name' => "PT Sans Narrow", 'variant' => ':r,b'),
						array( 'name' => "Philosopher", 'variant' => ''),
						array( 'name' => "Allerta", 'variant' => ''),
						array( 'name' => "Allerta Stencil", 'variant' => ''),
						array( 'name' => "Arimo", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Arvo", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Bentham", 'variant' => ''),
						array( 'name' => "Coda", 'variant' => ':800'),
						array( 'name' => "Cousine", 'variant' => ''),
						array( 'name' => "Covered By Your Grace", 'variant' => ''),
			 			array( 'name' => "Geo", 'variant' => ''),
						array( 'name' => "Just Me Again Down Here", 'variant' => ''),
						array( 'name' => "Puritan", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Raleway", 'variant' => ':100'),
						array( 'name' => "Tinos", 'variant' => ':r,b,i,bi'),
						array( 'name' => "UnifrakturCook", 'variant' => ':bold'),
						array( 'name' => "UnifrakturMaguntia", 'variant' => ''),
						array( 'name' => "Mountains of Christmas", 'variant' => ''),
						array( 'name' => "Lato", 'variant' => ''),
						array( 'name' => "Orbitron", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Allan", 'variant' => ':bold'),
						array( 'name' => "Anonymous Pro", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Copse", 'variant' => ''),
						array( 'name' => "Kenia", 'variant' => ''),
						array( 'name' => "Ubuntu", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Vibur", 'variant' => ''),
						array( 'name' => "Sniglet", 'variant' => ':800'),
						array( 'name' => "Syncopate", 'variant' => ''),
						array( 'name' => "Cabin", 'variant' => ':400,400italic,700,700italic,'),
						array( 'name' => "Merriweather", 'variant' => ''),
						array( 'name' => "Maiden Orange", 'variant' => ''),
						array( 'name' => "Just Another Hand", 'variant' => ''),
						array( 'name' => "Kristi", 'variant' => ''),
						array( 'name' => "Corben", 'variant' => ':b'),
						array( 'name' => "Gruppo", 'variant' => ''),
						array( 'name' => "Buda", 'variant' => ':light'),
						array( 'name' => "Lekton", 'variant' => ''),
						array( 'name' => "Luckiest Guy", 'variant' => ''),
						array( 'name' => "Crushed", 'variant' => ''),
						array( 'name' => "Chewy", 'variant' => ''),
						array( 'name' => "Coming Soon", 'variant' => ''),
						array( 'name' => "Crafty Girls", 'variant' => ''),
						array( 'name' => "Fontdiner Swanky", 'variant' => ''),
						array( 'name' => "Permanent Marker", 'variant' => ''),
						array( 'name' => "Rock Salt", 'variant' => ''),
						array( 'name' => "Sunshiney", 'variant' => ''),
						array( 'name' => "Unkempt", 'variant' => ''),
						array( 'name' => "Calligraffitti", 'variant' => ''),
						array( 'name' => "Cherry Cream Soda", 'variant' => ''),
						array( 'name' => "Homemade Apple", 'variant' => ''),
						array( 'name' => "Irish Growler", 'variant' => ''),
						array( 'name' => "Kranky", 'variant' => ''),
						array( 'name' => "Schoolbell", 'variant' => ''),
						array( 'name' => "Slackey", 'variant' => ''),
						array( 'name' => "Walter Turncoat", 'variant' => ''),
						array( 'name' => "Radley", 'variant' => ''),
						array( 'name' => "Meddon", 'variant' => ''),
						array( 'name' => "Kreon", 'variant' => ':r,b'),
						array( 'name' => "Dancing Script", 'variant' => ''),
						array( 'name' => "Goudy Bookletter 1911", 'variant' => ''),
						array( 'name' => "PT Serif Caption", 'variant' => ':r,i'),
						array( 'name' => "PT Serif", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Astloch", 'variant' => ':b'),
						array( 'name' => "Bevan", 'variant' => ''),
						array( 'name' => "Anton", 'variant' => ''),
						array( 'name' => "Expletus Sans", 'variant' => ':b'),
						array( 'name' => "VT323", 'variant' => ''),
						array( 'name' => "Pacifico", 'variant' => ''),
						array( 'name' => "Candal", 'variant' => ''),
						array( 'name' => "Architects Daughter", 'variant' => ''),
						array( 'name' => "Indie Flower", 'variant' => ''),
						array( 'name' => "League Script", 'variant' => ''),
						array( 'name' => "Cabin Sketch", 'variant' => ':b'),
						array( 'name' => "Quattrocento", 'variant' => ''),
						array( 'name' => "Amaranth", 'variant' => ''),
						array( 'name' => "Irish Grover", 'variant' => ''),
						array( 'name' => "Oswald", 'variant' => ''),
						array( 'name' => "EB Garamond", 'variant' => ''),
						array( 'name' => "Nova Round", 'variant' => ''),
						array( 'name' => "Nova Slim", 'variant' => ''),
						array( 'name' => "Nova Script", 'variant' => ''),
						array( 'name' => "Nova Cut", 'variant' => ''),
						array( 'name' => "Nova Mono", 'variant' => ''),
						array( 'name' => "Nova Oval", 'variant' => ''),
						array( 'name' => "Nova Flat", 'variant' => ''),
						array( 'name' => "Terminal Dosis Light", 'variant' => ''),
						array( 'name' => "Michroma", 'variant' => ''),
						array( 'name' => "Miltonian", 'variant' => ''),
						array( 'name' => "Miltonian Tattoo", 'variant' => ''),
						array( 'name' => "Annie Use Your Telescope", 'variant' => ''),
						array( 'name' => "Dawning of a New Day", 'variant' => ''),
						array( 'name' => "Sue Ellen Francisco", 'variant' => ''),
						array( 'name' => "Waiting for the Sunrise", 'variant' => ''),
						array( 'name' => "Special Elite", 'variant' => ''),
						array( 'name' => "Quattrocento Sans", 'variant' => ''),
						array( 'name' => "Smythe", 'variant' => ''),
						array( 'name' => "The Girl Next Door", 'variant' => ''),
						array( 'name' => "Aclonica", 'variant' => ''),
						array( 'name' => "News Cycle", 'variant' => ''),
						array( 'name' => "Damion", 'variant' => ''),
						array( 'name' => "Wallpoet", 'variant' => ''),
						array( 'name' => "Over the Rainbow", 'variant' => ''),
						array( 'name' => "MedievalSharp", 'variant' => ''),
						array( 'name' => "Six Caps", 'variant' => ''),
						array( 'name' => "Swanky and Moo Moo", 'variant' => ''),
						array( 'name' => "Bigshot One", 'variant' => ''),
						array( 'name' => "Francois One", 'variant' => ''),
						array( 'name' => "Sigmar One", 'variant' => ''),
						array( 'name' => "Carter One", 'variant' => ''),
						array( 'name' => "Holtdesd One SC", 'variant' => ''),
						array( 'name' => "Paytone One", 'variant' => ''),
						array( 'name' => "Monofett", 'variant' => ''),
						array( 'name' => "Rokkitt", 'variant' => ''),
						array( 'name' => "Megrim", 'variant' => ''),
						array( 'name' => "Judson", 'variant' => ':r,ri,b'),
						array( 'name' => "Didact Gothic", 'variant' => ''),
						array( 'name' => "Play", 'variant' => ':r,b'),
						array( 'name' => "Ultra", 'variant' => ''),
						array( 'name' => "Metrophobic", 'variant' => ''),
						array( 'name' => "Mako", 'variant' => ''),
						array( 'name' => "Shanti", 'variant' => ''),
						array( 'name' => "Caudex", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Jura", 'variant' => ''),
						array( 'name' => "Ruslan Display", 'variant' => ''),
						array( 'name' => "Brawler", 'variant' => ''),
						array( 'name' => "Nunito", 'variant' => ''),
						array( 'name' => "Wire One", 'variant' => ''),
						array( 'name' => "Podkova", 'variant' => ''),
						array( 'name' => "Muli", 'variant' => ''),
						array( 'name' => "Maven Pro", 'variant' => ''),
						array( 'name' => "Tenor Sans", 'variant' => ''),
						array( 'name' => "Limelight", 'variant' => ''),
						array( 'name' => "Playfair Display", 'variant' => ''),
						array( 'name' => "Artifika", 'variant' => ''),
						array( 'name' => "Lora", 'variant' => ''),
						array( 'name' => "Kameron", 'variant' => ':r,b'),
						array( 'name' => "Cedarville Cursive", 'variant' => ''),
						array( 'name' => "Zeyada", 'variant' => ''),
						array( 'name' => "La Belle Aurore", 'variant' => ''),
						array( 'name' => "Shadows Into Light", 'variant' => ''),
						array( 'name' => "Lobster Two", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Nixie One", 'variant' => ''),
						array( 'name' => "Redressed", 'variant' => ''),
						array( 'name' => "Bangers", 'variant' => ''),
						array( 'name' => "Open Sans Condensed", 'variant' => ':300,300italic'),
						array( 'name' => "Open Sans", 'variant' => ':r,i,b,bi'),
						array( 'name' => "Varela", 'variant' => ''),
						array( 'name' => "Goblin One", 'variant' => ''),
						array( 'name' => "Asset", 'variant' => ''),
						array( 'name' => "Gravitas One", 'variant' => ''),
						array( 'name' => "Hammersmith One", 'variant' => ''),
						array( 'name' => "Stardos Stencil", 'variant' => ''),
						array( 'name' => "Love Ya Like A Sister", 'variant' => ''),
						array( 'name' => "Loved by the King", 'variant' => ''),
						array( 'name' => "Bowlby One SC", 'variant' => ''),
						array( 'name' => "Forum", 'variant' => ''),
						array( 'name' => "Patrick Hand", 'variant' => ''),
						array( 'name' => "Varela Round", 'variant' => ''),
						array( 'name' => "Yeseva One", 'variant' => ''),
						array( 'name' => "Give You Glory", 'variant' => ''),
						array( 'name' => "Modern Antiqua", 'variant' => ''),
						array( 'name' => "Bowlby One", 'variant' => ''),
						array( 'name' => "Tienne", 'variant' => ''),
						array( 'name' => "Istok Web", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Yellowtail", 'variant' => ''),
						array( 'name' => "Pompiere", 'variant' => ''),
						array( 'name' => "Unna", 'variant' => ''),
						array( 'name' => "Rosario", 'variant' => ''),
						array( 'name' => "Leckerli One", 'variant' => ''),
						array( 'name' => "Snippet", 'variant' => ''),
						array( 'name' => "Ovo", 'variant' => ''),
						array( 'name' => "IM Fell English", 'variant' => ':r,i'),
						array( 'name' => "IM Fell English SC", 'variant' => ''),
						array( 'name' => "Gloria Hallelujah", 'variant' => ''),
						array( 'name' => "Kelly Slab", 'variant' => ''),
						array( 'name' => "Black Ops One", 'variant' => ''),
						array( 'name' => "Carme", 'variant' => ''),
						array( 'name' => "Aubrey", 'variant' => ''),
						array( 'name' => "Federo", 'variant' => ''),
						array( 'name' => "Delius", 'variant' => ''),
						array( 'name' => "Rochester", 'variant' => ''),
						array( 'name' => "Rationale", 'variant' => ''),
						array( 'name' => "Abel", 'variant' => ''),
						array( 'name' => "Marvel", 'variant' => ':r,b,i,bi'),
						array( 'name' => "Actor", 'variant' => ''),
						array( 'name' => "Delius Swash Caps", 'variant' => ''),
						array( 'name' => "Smokum", 'variant' => ''),
						array( 'name' => "Tulpen One", 'variant' => ''),
						array( 'name' => "Coustard", 'variant' => ':r,b'),
						array( 'name' => "Andika", 'variant' => ''),
						array( 'name' => "Alice", 'variant' => ''),
						array( 'name' => "Questrial", 'variant' => ''),
						array( 'name' => "Comfortaa", 'variant' => ':r,b'),
						array( 'name' => "Geostar", 'variant' => ''),
						array( 'name' => "Geostar Fill", 'variant' => ''),
						array( 'name' => "Volkhov", 'variant' => ''),
						array( 'name' => "Voltaire", 'variant' => ''),
						array( 'name' => "Montez", 'variant' => ''),
						array( 'name' => "Short Stack", 'variant' => ''),
						array( 'name' => "Vidaloka", 'variant' => ''),
						array( 'name' => "Aldrich", 'variant' => ''),
						array( 'name' => "Numans", 'variant' => ''),
						array( 'name' => "Days One", 'variant' => ''),
						array( 'name' => "Gentium Book Basic", 'variant' => ''),
						array( 'name' => "Monoton", 'variant' => ''),
						array( 'name' => "Alike", 'variant' => ''),
						array( 'name' => "Delius Unicase", 'variant' => ''),
						array( 'name' => "Abril Fatface", 'variant' => ''),
						array( 'name' => "Dorsa", 'variant' => ''),
						array( 'name' => "Antic", 'variant' => ''),
						array( 'name' => "Passero One", 'variant' => ''),
						array( 'name' => "Fandesd Text", 'variant' => ''),
						array( 'name' => "Prociono", 'variant' => ''),
						array( 'name' => "Merienda One", 'variant' => ''),
						array( 'name' => "Changa One", 'variant' => ''),
						array( 'name' => "Julee", 'variant' => ''),
						array( 'name' => "Prata", 'variant' => ''),
						array( 'name' => "Adamina", 'variant' => ''),
						array( 'name' => "Sorts Mill Goudy", 'variant' => ''),
						array( 'name' => "Terminal Dosis", 'variant' => ''),
						array( 'name' => "Sansita One", 'variant' => ''),
						array( 'name' => "Chivo", 'variant' => ''),
						array( 'name' => "Spinnaker", 'variant' => ''),
						array( 'name' => "Poller One", 'variant' => ''),
						array( 'name' => "Alike Angular", 'variant' => ''),
						array( 'name' => "Gochi Hand", 'variant' => ''),
						array( 'name' => "Poly", 'variant' => ''),
						array( 'name' => "Andada", 'variant' => ''),
						array( 'name' => "Federant", 'variant' => ''),
						array( 'name' => "Ubuntu Condensed", 'variant' => ''),
						array( 'name' => "Ubuntu Mono", 'variant' => '')
	);
	return $smartbox_google_fonts;
}

?>