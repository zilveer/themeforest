<?php 

class UberMenu_dummy_item{

	var $is_dummy = true;

	var $ID;
	var $db_id;
	var $custom_type;
	var $classes;
	var $title;
	var $settings;
	var $ref_id;
	var $type_label = 'Dummy';

	//var $object = 'ubermenu-custom-dummy';
	//var $object_id = 0;

	//var $menu_item_parent

	var $type;

	function __construct( $id ,  $custom_type , $title = '' , $ref_id , $settings = array(), $classes = array() ){ //, $props = array() ){
		$this->ID = $id;
		$this->db_id = $id;

		//echo '['.$this->ID . ' :: ' .$this->db_id.']';

		$this->custom_type = $custom_type;
		$this->type = $custom_type;
		$this->title = $title;
		$this->settings = $settings;

		$this->classes = $classes;

		$this->ref_id = $ref_id;
		//$this->object_id = $id;

		$this->type_label = '[UberMenu Dummy '.$title.']';
	}

}