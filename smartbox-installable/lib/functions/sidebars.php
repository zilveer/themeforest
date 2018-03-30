<?php
/**
 * This file contains the sidebars functionality.
 *
 */

/**
 * ADD THE ACTIONS
 */
add_action('widgets_init', 'designare_load_sidebar_names');
add_action('widgets_init', 'designare_register_all_sidebars' );   

//allow shortcodes in sidebar widgets
add_filter('widget_text', 'do_shortcode');

/**
 * Loads all the existing sidebars to be registered into the global
 * manager object.
 */
function designare_load_sidebar_names(){
	global $designare_data;
	
	//there always should be one default sidebar
	$designare_sidebars=array();

	//get the sidebar names that have been saved as option
	$sidebar_strings=get_option('_sidebar_names');
	$generated_sidebars=explode(DESIGNARE_SEPARATOR, $sidebar_strings);
	array_pop($generated_sidebars);
	$designare_generated_sidebars=array();

	//add the generated sidebars to the default ones
	foreach($generated_sidebars as $sidebar){
		$designare_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar));
		$designare_generated_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar));
	}

	//set the main sidebars to the global manager object
	$designare_data->designare_sidebars=$designare_sidebars;
	//set the footer sidebars to the global manager object
	
/*
$designare_data->designare_footer_sidebars=array(array('name'=>'Footer First Column', 'id'=>'footer-first'),
	array('name'=>'Footer Second Column', 'id'=>'footer-second'),
	array('name'=>'Footer Third Column', 'id'=>'footer-third'));
*/
	
	$sides = designare_get_custom_sidebars();
	
	$designare_c_sidebars = array();
	
	foreach($sides as $s){
		$designare_c_sidebars[]=array('name'=>$s, 'id'=>convert_to_class($s));
	}
	
	$designare_data->designare_custom_sidebars = $designare_c_sidebars;
	
	/*TOP PANEL SIDEBARS*/
	if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "one")
		$designare_data->designare_toppanel_sidebars=array(array('name'=>'Top Panel One Column', 'id'=>'toppanel-one-column'));
	if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "two")
		$designare_data->designare_toppanel_sidebars=array(array('name'=>'Top Panel Left Column', 'id'=>'toppanel-two-column-left'), array('name'=>'Top Panel Right Column', 'id'=>'toppanel-two-column-right'));
	if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "three"){
		if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order") == "one_three")
			$designare_data->designare_toppanel_sidebars=array(array('name'=>'Top Panel Left Column', 'id'=>'toppanel-three-column-left'), array('name'=>'Top Panel Center Column', 'id'=>'toppanel-three-column-center'), array('name'=>'Top Panel Right Column', 'id'=>'toppanel-three-column-right'));
		if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order") == "one_two_three")
			$designare_data->designare_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (1/3)', 'id'=>'toppanel-three-column-left-1_3'), array('name'=>'Top Panel Right Column (2/3)', 'id'=>'toppanel-three-column-right-2_3'));
		if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order") == "two_one_three")
			$designare_data->designare_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (2/3)', 'id'=>'toppanel-three-column-left-2_3'), array('name'=>'Top Panel Right Column (1/3)', 'id'=>'toppanel-three-column-right-1_3'));
	}
	if(get_option(DESIGNARE_SHORTNAME . "_toppanel_number_cols") == "four"){
		if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "one_four")
			$designare_data->designare_toppanel_sidebars=array(array('name'=>'Top Panel Left Column', 'id'=>'toppanel-four-column-left'), array('name'=>'Top Panel Center-Left Column', 'id'=>'toppanel-four-column-center-left'), array('name'=>'Top Panel Center-Right Column', 'id'=>'toppanel-four-column-center-right'), array('name'=>'Top Panel Right Column', 'id'=>'toppanel-four-column-right'));
		if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "two_one_two_four")
			$designare_data->designare_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (1/4)', 'id'=>'toppanel-four-column-left-1_2_4'), array('name'=>'Top Panel Center Column (2/4)', 'id'=>'toppanel-four-column-center-2_2_4'), array('name'=>'Top Panel Right Column (1/4)', 'id'=>'toppanel-four-column-right-1_2_4'));
		if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "three_one_four")
			$designare_data->designare_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (3/4)', 'id'=>'toppanel-four-column-left-3_4'), array('name'=>'Top Panel Right Column (1/4)', 'id'=>'toppanel-four-column-right-1_4'));
		if(get_option(DESIGNARE_SHORTNAME . "_toppanel_columns_order_four") == "one_three_four")
			$designare_data->designare_toppanel_sidebars=array(array('name'=>'Top Panel Left Column (1/4)', 'id'=>'toppanel-four-column-left-1_4'), array('name'=>'Top Panel Right Column (3/4)', 'id'=>'toppanel-four-column-right-3_4'));
	}
	
	/* FOOTER SIDEBARS */
	if(get_option(DESIGNARE_SHORTNAME . "_footer_number_cols") == "one")
		$designare_data->designare_footer_sidebars=array(array('name'=>'Footer One Column', 'id'=>'footer-one-column'));
	if(get_option(DESIGNARE_SHORTNAME . "_footer_number_cols") == "two")
		$designare_data->designare_footer_sidebars=array(array('name'=>'Footer Left Column', 'id'=>'footer-two-column-left'), array('name'=>'Footer Right Column', 'id'=>'footer-two-column-right'));
	if(get_option(DESIGNARE_SHORTNAME . "_footer_number_cols") == "three"){
		if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order") == "one_three")
			$designare_data->designare_footer_sidebars=array(array('name'=>'Footer Left Column', 'id'=>'footer-three-column-left'), array('name'=>'Footer Center Column', 'id'=>'footer-three-column-center'), array('name'=>'Footer Right Column', 'id'=>'footer-three-column-right'));
		if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order") == "one_two_three")
			$designare_data->designare_footer_sidebars=array(array('name'=>'Footer Left Column (1/3)', 'id'=>'footer-three-column-left-1_3'), array('name'=>'Footer Right Column (2/3)', 'id'=>'footer-three-column-right-2_3'));
		if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order") == "two_one_three")
			$designare_data->designare_footer_sidebars=array(array('name'=>'Footer Left Column (2/3)', 'id'=>'footer-three-column-left-2_3'), array('name'=>'Footer Right Column (1/3)', 'id'=>'footer-three-column-right-1_3'));
	}
	if(get_option(DESIGNARE_SHORTNAME . "_footer_number_cols") == "four"){
		if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order_four") == "one_four")
			$designare_data->designare_footer_sidebars=array(array('name'=>'Footer Left Column', 'id'=>'footer-four-column-left'), array('name'=>'Footer Center-Left Column', 'id'=>'footer-four-column-center-left'), array('name'=>'Footer Center-Right Column', 'id'=>'footer-four-column-center-right'), array('name'=>'Footer Right Column', 'id'=>'footer-four-column-right'));
		if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order_four") == "two_one_two_four")
			$designare_data->designare_footer_sidebars=array(array('name'=>'Footer Left Column (1/4)', 'id'=>'footer-four-column-left-1_2_4'), array('name'=>'Footer Center Column (2/4)', 'id'=>'footer-four-column-center-2_2_4'), array('name'=>'Footer Right Column (1/4)', 'id'=>'footer-four-column-right-1_2_4'));
		if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order_four") == "three_one_four")
			$designare_data->designare_footer_sidebars=array(array('name'=>'Footer Left Column (3/4)', 'id'=>'footer-four-column-left-3_4'), array('name'=>'Footer Right Column (1/4)', 'id'=>'footer-four-column-right-1_4'));
		if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order_four") == "one_three_four")
			$designare_data->designare_footer_sidebars=array(array('name'=>'Footer Left Column (1/4)', 'id'=>'footer-four-column-left-1_4'), array('name'=>'Footer Right Column (3/4)', 'id'=>'footer-four-column-right-3_4'));
	}
	
}


/**
 * Registers all the sidebars that have been created.
 */
function designare_register_all_sidebars(){
	global $designare_data;

	$designare_sidebars=$designare_data->designare_sidebars;
	$designare_custom_sidebars=$designare_data->designare_custom_sidebars;
	if (isset($designare_data->designare_footer_sidebars))
		$designare_footer_sidebars=$designare_data->designare_footer_sidebars;
	else $designare_footer_sidebars = array();
	if (isset($designare_data->designare_toppanel_sidebars))
		$designare_toppanel_sidebars=$designare_data->designare_toppanel_sidebars;
	else $designare_toppanel_sidebars = array();
	
	//register all the sidebars
	if (function_exists('register_sidebar')){

		//register the sidebars
		foreach($designare_sidebars as $sidebar){
			designare_register_sidebar($sidebar['name'], $sidebar['id']);
		}
		
		if ( $designare_custom_sidebars && ! is_wp_error( $designare_custom_sidebars ) ) {
		//register the custom sidebars
			foreach($designare_custom_sidebars as $sidebar){
				designare_register_custom_sidebar($sidebar['name'], $sidebar['id']);
			}
		}

		if ( $designare_toppanel_sidebars && ! is_wp_error( $designare_toppanel_sidebars ) ) {
		//register the top panel column sidebars
			foreach($designare_toppanel_sidebars as $sidebar){
				designare_register_toppanel_sidebar($sidebar['name'], $sidebar['id']);
			}
		}

		if ( $designare_footer_sidebars && ! is_wp_error( $designare_footer_sidebars ) ) {
		//register the footer column sidebars
			foreach($designare_footer_sidebars as $sidebar){
				designare_register_footer_sidebar($sidebar['name'], $sidebar['id']);
			}
		}
	}
}



/**
 * Registers a sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function designare_register_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '<div class="sidebar-box %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4><div class="double-line"></div>',
	));
}

/**
 * Registers a custom column sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function designare_register_custom_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '<div class="custom-widget %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4><hr/>',
	));
}

/**
 * Registers a top panel column sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function designare_register_toppanel_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4><hr/>',
	));
}

/**
 * Registers a footer column sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function designare_register_footer_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4><hr/>',
	));
}

/**
 * Prints a sidebar.
 * @param $name the name of the sidebar to print
 */
function print_sidebar($name){
		if ( function_exists('dynamic_sidebar')) { 
			do_shortcode(dynamic_sidebar($name));  
		}
}

function des_get_sidebar($name){
		if ( function_exists('dynamic_sidebar')) { 
			ob_start();
	    do_shortcode(dynamic_sidebar($name));
	    $html = ob_get_contents();
	    ob_end_clean();
	    return $html;  
		}
}



/**
 * Prints a custom sidebar column.
 * @param $name the name of the sidebar
 * @param $last if true, then this is the last column
 */
function print_custom_sidebar($name, $last){
	$class=$last?'four-columns nomargin':'four-columns';
	?>
	<div class="<?php echo $class; ?>"><?php     
	if (function_exists('dynamic_sidebar')) { 
		do_shortcode(dynamic_sidebar($name));
	} ?></div>
<?php
}

/**
 * Prints a top panel sidebar column.
 * @param $name the name of the sidebar
 * @param $last if true, then this is the last column
 */
function print_toppanel_sidebar($name, $last){
	$class=$last?'four-columns nomargin':'four-columns';
	?>
	<div class="<?php echo $class; ?>"><?php     
	if (function_exists('dynamic_sidebar')) { 
		do_shortcode(dynamic_sidebar($name));
	} ?></div>
<?php
}

/**
 * Prints a footer sidebar column.
 * @param $name the name of the sidebar
 * @param $last if true, then this is the last column
 */
function print_footer_sidebar($name, $last){
	$class=$last?'four-columns nomargin':'four-columns';
	?>
	<div class="<?php echo $class; ?>"><?php     
	if (function_exists('dynamic_sidebar')) { 
		do_shortcode(dynamic_sidebar($name));
	} ?></div>
<?php
}

/**
 * Converts a name that consists of more words and different characters to a class (id).
 * @param $name the name to convert
 */
function convert_to_class($name){
	return strtolower(str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name));
}

