<?php
/* ------------------------------------------------------------------------*
 * This file contains the main theme options functionality.
 * ------------------------------------------------------------------------*/

/**
 * ADD THE ACTIONS
 */
if ( isset($_GET['page']) && $_GET['page'] == 'options' ){
	//options actions
	add_action('init', 'pexeto_init_options_functionality');  
	add_action('init', 'pexeto_set_options'); 
}
add_action('admin_menu', 'pexeto_theme_add_admin'); 

/**
 * Add the Theme Options Page
 */
function pexeto_theme_add_admin() {

	add_theme_page(PEXETO_THEMENAME." Options", "".PEXETO_THEMENAME." Options", 'edit_themes', 'options', 'pexeto_theme_admin');
}



/**
 * Inits the options functionality. Loads the files that contain the options arrays
 * to populate the global options array.
 */
function pexeto_init_options_functionality(){
	global $pexeto_options;

	$pexeto_options=array();

	//get all the categories
	$categories=get_categories('hide_empty=0');
	$pexeto_categories=array();
	for($i=0; $i<sizeof($categories); $i++){
		$pexeto_categories[]=array('id'=>$categories[$i]->cat_ID, 'name'=>$categories[$i]->cat_name);
	}

	//load the files that contain the options
	$pexeto_options_files=array('general', 'pages', 'sliders', 'styles', 'translation', 'documentation');
	foreach($pexeto_options_files as $file){
		require_once(PEXETO_OPTIONS_PATH.$file.'.php');
	}

}


/**
 * Sets the Pexeto Options save functionality.
 */
function pexeto_set_options(){
	global $pexeto_options;
	
	$nonsavable_types=array('open', 'close','subtitle','title','documentation');

	
	//insert the default values if the fields are empty
	if(!get_option(PEXETO_SHORTNAME.'_first_save')){
		foreach ($pexeto_options as $value) {
			if(get_option($value['id'])=='' && isset($value['std']) && !in_array($value['type'], $nonsavable_types)){
				update_option( $value['id'], $value['std']);
			}
		}
		update_option(PEXETO_SHORTNAME.'_first_save','true');
	}
	
	//save the field's values if the Save action is present
	if ( $_GET['page'] == 'options' ) {
		if ( 'save' == $_REQUEST['action'] ) {
			//verify the nonce
			if ( empty($_POST) || !wp_verify_nonce($_POST['pexeto-theme-options'],'pexeto-theme-update-options') )
			{
				print 'Sorry, your nonce did not verify.';
				exit;
			}else{
				foreach ($pexeto_options as $value) {
					if( isset( $_REQUEST[ $value['id'] ] ) && !in_array($value['type'], $nonsavable_types)) {
						update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
					} elseif(!in_array($value['type'], $nonsavable_types)){
						delete_option( $value['id'] );
					}

					/* Update the values for the custom options that contain unlimited suboptions - for example when having
					 * a slider with fields "title" and "imageurl", for all the entities the titles will be saved in one field,
					 * separated by a separator. In this case, if the field name is slider_title and it contains some data like
					 * title 1|*|title2|*|title3 (|*| is the separator), then all this data will be saved into a custom field
					 * with id slider_titles.
					 */
					if($value['type']=='custom'){
						foreach($value['fields'] as $field){
							update_option( $field['id'].'s', $_REQUEST[ $field['id'].'s' ] );
						}
					}
				}
				header("Location: themes.php?page=options&saved=true");
				die;
			}
		}
	}

}

/**
 * Calls the options manager to print the Options page.
 */
function pexeto_theme_admin() {
	global $pexeto_options,$pexeto_options_manager;

	$pexeto_options_manager=new PexetoOptionsManager(PEXETO_THEMENAME, PEXETO_IMAGES_URL, PEXETO_UTILS_URL, PEXETO_UPLOADS_URL, PEXETO_VERSION);
	$pexeto_options_manager->set_options($pexeto_options);

	if ( $_REQUEST['saved'] ) {
		$pexeto_options_manager->print_saved_message();
	}
	if ( $_REQUEST['reset'] ) {
		$pexeto_options_manager->print_reset_message();
	}

	$pexeto_options_manager->print_heading(OPTIONS_HEADING);
	$pexeto_options_manager->print_options();
	$pexeto_options_manager->print_footer();
}


/**
 * Adds all the options that an array contains to the current global options array.
 * @param $option_arr the array that contains the options values
 */
function pexeto_add_options($option_arr){
	global $pexeto_options;

	foreach($option_arr as $option){
		$pexeto_options[]=$option;
	}
}


/**
 * Prints an option.
 * @param $option the option's second part of the ID (after the theme's shortname part)
 */
function echo_option($option){
	echo(stripslashes(get_option(PEXETO_SHORTNAME.$option)));
}

/**
 * Gets an option
 * @param $option the option's second part of the ID (after the theme's shortname part)
 */
function get_opt($option){
	return stripslashes(get_option(PEXETO_SHORTNAME.$option));
}

/**
 * Gets an array containing options settings and if there is an option for adding
 * multiple entities of one type, generates addional array elements for these entities.
 * For example: If there have been created 2 additional sliders, it will append
 * to option elements to this array for each slider.
 * @param $opt_array the array to be modified
 * @return an array containing the custom entity options
 */
function pexeto_add_custom_options($opt_array){
	$new_pexeto_options=array();

	foreach($opt_array as $option){
		if($option['type']=='multiple_custom'){
			//insert the new custom options here
				
			$saved_values=get_option($option['refers']);
			$saved_array=explode(PEXETO_SEPARATOR, $saved_values);
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
						
					array_push($new_pexeto_options, $custom_option);
				}
			}
				
		}else{
			//this is just a normal option, just append it into the new array
			array_push($new_pexeto_options, $option);
		}
	}

	return $new_pexeto_options;
}

?>