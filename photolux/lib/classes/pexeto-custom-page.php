<?php

/**
 * This is a custom page class - it contains all fields that are needed for a custom page builder to build a page.
 * @author Pexeto
 *
 */
class PexetoCustomPage{

	public $post_type='none';
	public $fields=array();
	public $page_name='none';
	public $allow_multiinstance=false;
	public $parent_slug='none';
	public $preview_image='none';
	public $type='none';
	public $file_name='none';

	/**
	 * Main Constructor
	 * @param $post_type the custom post type that will represent the custom page
	 * @param $fields an array containing all the fields from which the main form structure will be built
	 * Example fields array:
	 * array(
	 *	array('id'=>'image_url', 'type'=>'upload', 'name'=>'Image URL', 'required'=>true),
	 *	array('id'=>'image_link', 'type'=>'text', 'name'=>'Image Link'),
	 *	array('id'=>'description', 'type'=>'textarea', 'name'=>'Image Description')
	 *	)
	 * @param $page_name the name of the page that will appear on the menu
	 * @param $allow_multiinstance a bool variable setting whether to allow creating multiple instances
	 * @param $parent_slug the slug of the parent menu item
	 * @param $preview_image the ID of the field that will be used for preview image of the items
	 * @param $type the type of the page content (slider, portfolio, etc.)
	 * @param $file_name the name of the file that will be used to display the data
	 */
	function __construct($post_type, $fields, $page_name, $allow_multiinstance, $parent_slug, $preview_image, $type, $file_name){
		$this->post_type=$post_type;
		$this->fields=$fields;
		$this->page_name=$page_name;
		$this->allow_multiinstance=$allow_multiinstance;
		$this->parent_slug=$parent_slug;
		$this->preview_image=$preview_image;
		$this->type=$type;
		$this->file_name=$file_name;
	}

}