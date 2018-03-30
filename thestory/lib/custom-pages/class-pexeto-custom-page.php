<?php

require_once('class-pexeto-custom-page-manager.php');


/**
 * This is a custom page class - it contains all fields that are needed for a 
 * custom page builder to build a page.
 * @author Pexeto
 *
 */
class PexetoCustomPage{

	public $post_type='none';
	public $fields=array();
	public $page_name='none';
	public $allow_multiinstance=false;
	public $parent_slug='none';
	public $preview_data='none';
	public $type='none';
	public $file_name='none';
	public $minimizable = true;
	public $set_name = '';
	protected $ajax_manager;
	const term_suffix = '_category';
	const default_term = 'default';
	const user_capability = 'edit_theme_options'; //required capability to open the custom page

	/**
	 * Main Constructor.
	 * 
	 * @param $post_type the custom post type that will represent the custom page
	 * @param $fields an array containing all the fields from which the main form 
	 * structure will be built
	 * Example fields array:
	 * array(
	 *	array('id'=>'image_url', 'type'=>'upload', 'name'=>'Image URL', 'required'=>true),
	 *	array('id'=>'image_link', 'type'=>'text', 'name'=>'Image Link'),
	 *	array('id'=>'description', 'type'=>'textarea', 'name'=>'Image Description')
	 *	)
	 * @param $page_name the name of the page that will appear on the menu
	 * @param $allow_multiinstance a bool variable setting whether to allow 
	 * creating multiple instances
	 * @param $parent_slug the slug of the parent menu item
	 * @param $preview_data the ID of the field that will be used for preview 
	 * image of the items
	 * @param $type the type of the page content (slider, portfolio, etc.)
	 * @param $file_name the name of the file that will be used to display the data
	 * @param $minimizable boolean setting whether an item of this type can be 
	 * mimimized with picture preview when it is added
	 * @param $set_name the text for a set of the custom page - this text can be 
	 * used for example on the "Add new {set name}" instance button
	 * from the "Add" section
	 */
	function __construct($post_type, $fields, $page_name, $allow_multiinstance, $parent_slug, $preview_data, $type, $file_name, $minimizable=true, $set_name=''){
		$this->post_type=$post_type;
		$this->fields=$fields;
		$this->page_name=$page_name;
		$this->allow_multiinstance=$allow_multiinstance;
		$this->parent_slug=$parent_slug;
		$this->preview_data=$preview_data;
		$this->type=$type;
		$this->file_name=$file_name;
		$this->minimizable = $minimizable;

		$this->set_name = empty($set_name) ? $page_name : $set_name;

		$this->_add_actions();
	}


	protected function _add_actions(){
		add_action("init", array($this, "register_posttype"), 10);
		add_action("admin_menu", array($this, "add_to_menu"));
	}


	public function register_posttype(){

		$custom_taxonomy = $this->post_type.self::term_suffix;

		//register the category
		register_taxonomy($custom_taxonomy,
			array($this->post_type),
			array(	"hierarchical" => true,
					"rewrite" => true,
					"query_var" => true,
					"show_in_nav_menus"=>false
		));
			
		if(!get_term_by('name', self::default_term, $custom_taxonomy)){
			//insert a separate category for this post type
			wp_insert_term(self::default_term, $custom_taxonomy);
		}

		//register the custom post type
		register_post_type( $this->post_type,
			array(
		         'public' => true,  
		         'show_ui' => false,  
		         'capability_type' => 'post',  
		         'hierarchical' => false,  
				 'exclude_from_search' => true,
	  			 'show_in_nav_menus'=>false,
				 'can_export' => true,
				 'taxonomies' => array($custom_taxonomy),
		         'supports' => array('title', 'editor', 'thumbnail', 'page-attributes') ) 
			);
	}

	public function add_to_menu(){
		add_submenu_page( $this->parent_slug, $this->page_name, $this->page_name, self::user_capability, $this->post_type, array($this, 'init_page_manager') );
	}


	public function init_page_manager(){
		$custom_page_manager = new PexetoCustomPageManager($this, self::term_suffix, self::default_term);
		$custom_page_manager->build_page();
	}

	public function get_field_by_id($id){
		foreach ($this->fields as $field) {
			if($field['id']==$id){
				return $field;
			}
		}
		return null;
	}

}