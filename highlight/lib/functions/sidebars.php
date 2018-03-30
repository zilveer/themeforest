<?php
/**
 * This file contains the sidebars functionality.
 *
 * @author Pexeto
 */

/**
 * ADD THE ACTIONS
 */
add_action('widgets_init', 'pexeto_load_sidebar_names');
add_action('widgets_init', 'pexeto_register_all_sidebars' );   


/**
 * Loads all the existing sidebars to be registered into the global
 * manager object.
 */
function pexeto_load_sidebar_names(){
	global $pexeto_manager;
	
	//there always should be one default sidebar
	$pexeto_sidebars=array(array('name'=>'Default Sidebar', 'id'=>'default'));

	//get the sidebar names that have been saved as option
	$sidebar_strings=get_option('_sidebar_names');
	$generated_sidebars=explode(PEXETO_SEPARATOR, $sidebar_strings);
	array_pop($generated_sidebars);
	$pexeto_generated_sidebars=array();

	//add the generated sidebars to the default ones
	foreach($generated_sidebars as $sidebar){
		$pexeto_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar));
		$pexeto_generated_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar));
	}

	//set the main sidebars to the global manager object
	$pexeto_manager->pexeto_sidebars=$pexeto_sidebars;
	//set the footer sidebars to the global manager object
	$pexeto_manager->pexeto_footer_sidebars=array(array('name'=>'Footer First Column', 'id'=>'footer-first'),
	array('name'=>'Footer Second Column', 'id'=>'footer-second'),
	array('name'=>'Footer Third Column', 'id'=>'footer-third'),
	array('name'=>'Footer Fourth Column', 'id'=>'footer-fourth'));
}


/**
 * Registers all the sidebars that have been created.
 */
function pexeto_register_all_sidebars(){
	global $pexeto_manager;

	$pexeto_sidebars=$pexeto_manager->pexeto_sidebars;
	$pexeto_footer_sidebars=$pexeto_manager->pexeto_footer_sidebars;
	
	//register all the sidebars
	if (function_exists('register_sidebar')){

		//register the sidebars
		foreach($pexeto_sidebars as $sidebar){
			pexeto_register_sidebar($sidebar['name'], $sidebar['id']);
		}

		//register the footer column sidebars
		foreach($pexeto_footer_sidebars as $sidebar){
			pexeto_register_footer_sidebar($sidebar['name'], $sidebar['id']);
		}
	}
}



/**
 * Registers a sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function pexeto_register_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '<div class="sidebar-box %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
	));
}

/**
 * Registers a footer column sidebar.
 * @param $name the name of the sidebar
 * @param $id the id of the sidebar
 */
function pexeto_register_footer_sidebar($name, $id){
	register_sidebar(array('name'=>$name,
		'id' => $id,
        'before_widget' => '<div class="footer-widget %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4><span class="footer-border"></span>',
	));
}

/**
 * Prints a sidebar.
 * @param $name the name of the sidebar to print
 */
function print_sidebar($name){
	?>
	<div class="sidebar">
		<?php   
		if ( function_exists('dynamic_sidebar')) { 
		dynamic_sidebar($name);  
		}?>
	</div>
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
		dynamic_sidebar($name);
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

