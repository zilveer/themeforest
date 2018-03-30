<?php
/**
 * Custom pages - this file contains ana manages the main functionality that is related
 * with custom pages. Custom pages are pages that allow adding items from selected post types.
 * The items data(fields) that should be added is set within an array and the custom pages
 * structure is built depending on the data set in that array.
 * @author Pexeto
 */

add_action('init', 'pexeto_register_custom_posttypes');
add_action('admin_menu', 'pexeto_add_custom_pages');
add_action('wp_ajax_pexeto_insert_post', 'pexeto_insert_post');
add_action('wp_ajax_pexeto_add_instance', 'pexeto_add_instance');
add_action('wp_ajax_pexeto_save_order', 'pexeto_save_order');
add_action('wp_ajax_pexeto_detele_item', 'pexeto_detele_item');
add_action('wp_ajax_pexeto_edit_item', 'pexeto_edit_item');
add_action('wp_ajax_pexeto_detele_instance', 'pexeto_detele_instance');



//define the main constants that will be used
define("PEXETO_NIVOSLIDER_POSTTYPE", 'pexnivoslider');
define("PEXETO_CUSTOM_PREFIX", 'custom_');
define("PEXETO_DEFAULT_TERM", 'default');
define("PEXETO_TERM_SUFFIX", '_category');
define("PEXETO_NONCE", 'pexeto-custom-page');
define("PEXETO_SLIDER_TYPE", 'slider');

//define the custom post types to be registered for the custom pages
$pexeto_data->custom_posttypes=array(PEXETO_NIVOSLIDER_POSTTYPE);

/**
 * Register all the custom post types that are needed for the custom pages.
 */
function pexeto_register_custom_posttypes(){
	$pexeto_data=$GLOBALS['pexeto_data'];

	foreach($pexeto_data->custom_posttypes as $posttype){
		$custom_taxonomy=$posttype.PEXETO_TERM_SUFFIX;
		//register the category
		register_taxonomy($custom_taxonomy,
		array($posttype),
		array(	"hierarchical" => true,
					"rewrite" => true,
					"query_var" => true,
					"show_in_nav_menus"=>false
		));
			
		if(!get_term_by('name', PEXETO_DEFAULT_TERM, $custom_taxonomy)){
			//insert a separate category for this post type
			wp_insert_term(PEXETO_DEFAULT_TERM, $custom_taxonomy);
		}

		//register the custom post type
		register_post_type( $posttype,
		array(
	         'public' => true,  
	         'show_ui' => false,  
	         'capability_type' => 'post',  
	         'hierarchical' => false,  
			 'exclude_from_search' => true,
  			 'show_in_nav_menus'=>false,
			 'can_export' => true,
			 'taxonomies' => array($custom_taxonomy),
	         'supports' => array('title', 'editor', 'thumbnail', 'page-attributes') ) );
	}
}

//define the custom pages - this is the main array that defines the structure of each of the custom pages
$pexeto_data->custom_pages=array(PEXETO_NIVOSLIDER_POSTTYPE=>
new PexetoCustomPage(PEXETO_NIVOSLIDER_POSTTYPE, array(
array('id'=>'image_url', 'type'=>'upload', 'name'=>'Image URL', 'required'=>true),
array('id'=>'image_link', 'type'=>'text', 'name'=>'Image Link'),
array('id'=>'description', 'type'=>'textarea', 'name'=>'Image Description')
), 'Nivo Slider', true, PEXETO_OPTIONS_PAGE, 'image_url', PEXETO_SLIDER_TYPE, 'slider-nivo.php')
);

/**
 * Adds all the custom pages to the menu.
 */
function pexeto_add_custom_pages(){
	global $pexeto_data;

	foreach($pexeto_data->custom_pages as $page){
		add_submenu_page( $page->parent_slug, $page->page_name, $page->page_name, 'edit_theme_options', $page->post_type, 'pexeto_build_custom_page' );
	}
}

/**
 * Returns all the main sliders data that are registered for the theme.
 */
function pexeto_get_custom_sliders(){
	global $pexeto_data;
	$sliders=array();
	
	foreach($pexeto_data->custom_pages as $id=>$page){
		if($page->type==PEXETO_SLIDER_TYPE){
			$sliders[]=array('id'=>$id, 'name'=>$page->page_name, 'class'=>$id);
		}
	}
	return $sliders;
}

/**
 * Generates arrays containing all the sliders names, so that this data would be used in an drop down select.
 */
function pexeto_get_created_sliders(){
	$pexeto_slider_data=array();
	$pexeto_sliders=pexeto_get_custom_sliders();
	
	$pexeto_slider_data[]= array("name"=>"None", "id"=>"none");
	$pexeto_slider_data[]= array("name"=>"Static Image", "id"=>"static");
	

	foreach($pexeto_sliders as $slider){
		$slider_id=$slider['id'];
		
		//the slider caption that will be shown in a select box as disabled
		$pexeto_slider_data[]=array('id'=>'disabled', 'name'=>$slider['name'], 'class'=>'caption');
		
		$terms=get_terms($slider_id.PEXETO_TERM_SUFFIX, array('hide_empty'=>false, 'orderby'=>'id', 'order'=>'desc'));
		//display all the instances of the page
		foreach($terms as $term){
			$name=$term->name==PEXETO_DEFAULT_TERM?$term->name.' '.$slider['name']:$term->name;
			$pexeto_slider_data[]=array('id'=>pexeto_generate_slider_id($slider_id, $term->term_id), 'name'=>ucfirst($name));
		}
		
	}

	return $pexeto_slider_data;
}

function pexeto_generate_slider_id($name, $term_id){
	return $name.':'.$term_id;
}

function pexeto_get_slider_data($id){
	global $pexeto_data;

	$parts=explode(':', $id);
	$post_type=$parts[0];
	$category=$parts[1];
	$taxonomy=$post_type.PEXETO_TERM_SUFFIX;
	
	$args=array('numberposts' => -1, 
					'post_type' => $post_type, 
					$taxonomy=>get_term($category, $taxonomy)->slug);
					
		$posts = get_posts( $args );
		$ordered_posts=pexeto_get_ordered_post_list($posts, $category,$post_type);
		
	$post_data=array();
	//get the file name that will display the data
	$post_data['filename']=$pexeto_data->custom_pages[$post_type]->file_name;
	$post_data['posts']=$ordered_posts;
	return $post_data;
}

/**
 * Builds a custom page - when the page is opened, an object from a manager class builds the page structure.
 */
function pexeto_build_custom_page(){
	if(isset($_GET['page'])){
		global $pexeto_data;

		$pageid=$_GET['page'];
		$custom_page=$pexeto_data->custom_pages[$pageid];
		$custom_page_manager=new PexetoCustomPageManager($custom_page, PEXETO_CUSTOM_PREFIX, PEXETO_TERM_SUFFIX, PEXETO_DEFAULT_TERM, PEXETO_NONCE);
		$custom_page_manager->build_page();
	}

}

function pexeto_print_sliders_page(){
	//TODO Customize sliders page
	echo 'Sliders';
}

/**
 * Inserts a post - this is the function that is called via AJAX request, when
 * a new custom post should be inserted.
 */
function pexeto_insert_post(){
	//check the nonce field for security
	check_ajax_referer(PEXETO_NONCE, 'nonce');

	global $pexeto_data, $current_user;

	$post_type=$_POST['post_type'];
	$custom_page=$pexeto_data->custom_pages[$post_type];

	//insert the post
	$dataManager=new PexetoCustomDataManager();
	$post=$dataManager->insert_post($_POST, $custom_page, PEXETO_CUSTOM_PREFIX, PEXETO_TERM_SUFFIX);

	//get the display template for the inserted post
	$templater=new PexetoTemplater();
	echo $templater->get_custom_page_list_template($post, $custom_page, PEXETO_CUSTOM_PREFIX);
	die();

}

/**
 * Creates a new instance of a custom page item - it is related with inserting a new
 * category from the selected custom post type.
 */
function pexeto_add_instance(){

	//check the nonce field for security
	check_ajax_referer(PEXETO_NONCE, 'nonce');

	global $pexeto_data;

	//insert a new category(term) for the custom post type
	$res=wp_insert_term( $_POST['name'], $_POST['taxonomy']);
	$custom_page=$pexeto_data->custom_pages[$_POST['post_type']];

	if($res instanceof WP_Error){
		$html='-1';
	}else{
		$templater=new PexetoTemplater();
		$html=$templater->get_before_custom_section($_POST['name']);
		$html.=$templater->get_custom_page_form_template($_POST['name'], $res['term_id'], $custom_page, PEXETO_CUSTOM_PREFIX);
		$html.='<ul class="sortable"></ul>'.$templater->get_after_custom_section();
	}

	echo $html;
	die();

}

/**
 * Saves the new order of the items - should be called via AJAX post request, 
 * the following parameters should be set in the request:
 * - order - the new order to be saved (as a string, separated by commas)
 * - category - the category the items to be ordered belong to
 */
function pexeto_save_order(){
	//check the nonce field for security
	check_ajax_referer(PEXETO_NONCE, 'nonce');

	if(isset($_POST['order'])&& $_POST['order'] && isset($_POST['category']) && $_POST['category'] && isset($_POST['posttype'])){
			update_option('pexeto_order'.$_POST['category'].$_POST['posttype'], $_POST['order']);
	}
}

/**
 * Creates an ordered post list - gets the unordered posts and the order string
 * saved as option that corresponds to those post group.
 * @param $posts the posts to be ordered
 * @param $category the category the posts belong to
 * @return an array of the posts that ordered according to the saved order
 */
function pexeto_get_ordered_post_list($posts, $category, $posttype){
	$new_post_array=array();

	$order=explode(',',get_option('pexeto_order'.$category.$posttype));
	if(sizeof($order)!=sizeof($posts)){
		return $posts;
	}else{
		//make the post array key the ID of the post so that it can be accessed by ID
		foreach($posts as $post){
			$new_post_array[$post->ID]=$post;
		}
			
		foreach($order as $index){
			$ordered_post_array[]=$new_post_array[$index];
		}
	}

	return $ordered_post_array;
}

/**
 * Deletes an item and changes the saved item order not to contain this item. Should be called via AJAX post request, 
 * the following parameters should be set in the request:
 * - itemid - the ID of the item to be deleted
 * - category - the category the item belongs to
 */
function pexeto_detele_item(){
	//check the nonce field for security
	check_ajax_referer(PEXETO_NONCE, 'nonce');

	if(isset($_POST['itemid']) && isset($_POST['category']) && isset($_POST['posttype'])){
		$res=wp_delete_post($_POST['itemid']);
		if($res){
			//the item has been deleted successfully, update the new order value
			$order_option='pexeto_order'.$_POST['category'].$_POST['posttype'];
			$order_arr=explode(',',get_option($order_option));
			$new_order=pexeto_remove_item_by_value($order_arr,$_POST['itemid']);
			update_option($order_option, implode(',',$new_order));
		}else{
			echo '-1';
			die();
		}
	}
}

/**
 * Edits an item - Should be called via AJAX post request, 
 * the following parameters should be set in the request:
 * - itemid - the ID of the item to be edited
 */
function pexeto_edit_item(){
	//check the nonce field for security
	check_ajax_referer(PEXETO_NONCE, 'nonce');

	if(isset($_POST['itemid'])&& $_POST['itemid']){
		$dataManager=new PexetoCustomDataManager();
		$post=$dataManager->edit_post($_POST, PEXETO_CUSTOM_PREFIX);
	}
}

/**
 * Deletes a group of items with their parent instance. Should be called via AJAX request, 
 * the following parameters should be set in the request:
 * - category - the category (term name) the slider represents
 * - taxonomy - the taxonomy name
 * - post_type - the type of the posts the slider contains
 */
function pexeto_detele_instance(){
	//check the nonce field for security
	check_ajax_referer(PEXETO_NONCE, 'nonce');

	if(isset($_POST['category'])&& isset($_POST['taxonomy'])){
		$dataManager=new PexetoCustomDataManager();
		$dataManager->delete_term($_POST['category'],$_POST['taxonomy'],$_POST['post_type']);
	}
}
