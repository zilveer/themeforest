<?php
/*-------------------- REGISTER SIDEBARS  --------------------*/

$pexeto_sidebars=array(array('name'=>'Blog Sidebar', 'id'=>'blog'),
				array('name'=>'Page Sidebar', 'id'=>'page'),
				array('name'=>'Home Sidebar', 'id'=>'home'),
				array('name'=>'Contact Sidebar', 'id'=>'contact'));
				
$pexeto_footer_sidebars=array(array('name'=>'Footer First Column', 'id'=>'footer-first'),
				array('name'=>'Footer Second Column', 'id'=>'footer-second'),
				array('name'=>'Footer Third Column', 'id'=>'footer-third'),
				array('name'=>'Footer Fourth Column', 'id'=>'footer-fourth'));
				
$sidebar_strings=get_option('_sidebar_names');
$generated_sidebars=explode($pexeto_separator, $sidebar_strings);
array_pop($generated_sidebars);
$pexeto_generated_sidebars=array();
	
//add the generated sidebars to the default ones
foreach($generated_sidebars as $sidebar){
	$pexeto_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar));
	$pexeto_generated_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar));
}

/**
 * Registers all the sidebars.
 */
if (function_exists('register_sidebar')){
	
	//register the sidebars
	foreach($pexeto_sidebars as $sidebar){
		pexeto_register_sidebar($sidebar['name'], $sidebar['id']);
	}
	
	//register the footer column sidebars
	foreach($pexeto_footer_sidebars as $sidebar){
		pexeto_register_sidebar($sidebar['name'], $sidebar['id']);
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
        'after_title' => '</h4><div class="double-hr"></div>',
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
        'after_title' => '</h4><div class="double-hr"></div>',
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
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($name)) { ?>
  
    <?php } ?>
</div>
<?php 
}

/**
 * Prints a footer sidebar column.
 * @param $name the name of the sidebar
 * @param $last if true, then this is the last column
 */
function print_footer_sidebar($name, $last){
	$class=$last?'four-columns-4':'four-columns';
	?>
	<div class="<?php echo $class; ?>">
    <?php     
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($name)) { ?>
  
    <?php } ?>
</div>
<?php 
}

/**
 * Converts a name that consists of more words and different characters to a class (id).
 * @param $name the name to convert
 */
function convert_to_class($name){
	return strtolower(str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name));
}

