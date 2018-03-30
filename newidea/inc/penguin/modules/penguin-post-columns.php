<?php

/**
	Penguin Framework

	Copyright (c) 2009-2015 ThemeFocus

	@url http://penguin.themefocus.co
	@package Penguin
	@version 4.0
**/


class PenguinPostColumns {
	
	public $posts = array();
	
	function PenguinPostColumns($posts = array()){

		if(count($posts) > 0){
			foreach($posts as $post){
				$this->posts[] = new PenguinPostColumn( $post['type'], $post['fields']);
			}
			add_filter( 'request', array($this,'penguin_posts_column_orderby'));
		}
	}
	
	// reset orderby
	function penguin_posts_column_orderby($vars ) {
		if ( isset( $vars['orderby'] )){
			foreach($this->posts as $post){
				foreach($post->fields as $field){
					if($vars['orderby'] == $field['id']){
						if(isset($field['type']) && $field['type'] == "num"){
							$vars = array_merge( $vars, array(
								'meta_key' => isset($field['key']) ? $field['key'] : $field['id'],
								'orderby' => 'meta_value_num'
							) );
						}else{
							$vars = array_merge( $vars, array(
								'meta_key' => isset($field['key']) ? $field['key'] : $field['id'],
								'orderby' => 'meta_value'
							) );
						}
						break;
					}
				}
			}
		}
		return $vars;
	}
}

class PenguinPostColumn {
	
	public $type;
	public $fields;
	
	function PenguinPostColumn($type,$fields = array()){
		
		$this->type 	= $type;
		$this->fields 	= $fields;
		if(count($fields) > 0){
			//add_filter( 'manage_edit-'.$this->type.'_columns', array($this,'penguin_posts_column_views') );
			add_filter('manage_'.$this->type.'_posts_columns', array($this,'penguin_posts_column_views'));
			add_action('manage_'.$this->type.'_posts_custom_column', array($this,'penguin_posts_custom_column_views'), 10, 2);
			add_filter( 'manage_edit-'.$this->type.'_sortable_columns', array($this,'penguin_posts_column_register_sortable') );
		}
	}
	
	// show columns fileds
	function penguin_posts_column_views($defaults){
		foreach($this->fields as $field){
			$defaults[$field['id']] = __($field['name'],Penguin::$THEME_NAME);
		}
		return $defaults;
	}
	
	// get columns value
	function penguin_posts_custom_column_views($column_name, $id){
		if(function_exists('Penguin_Custom_Posts_Columns_Value')){
			Penguin_Custom_Posts_Columns_Value($this->type, $column_name, $id);
		}
	}
	
	// add sortable
	function penguin_posts_column_register_sortable($defaults){
		foreach($this->fields as $field){
			$defaults[$field['id']] = $field['id'];
		}
		return $defaults;
	}
}


?>