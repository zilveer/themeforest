<?php

/**
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo check permition for dynamic file 
 */


class fwWritepanelsDataStore {
	public $data = array();		// all datas are stored here
	public $data_metabox = array();
	public $data_clean = array();
	private $act_metabox = null;
	private $act_pagetemplate = null;
        
	public function addOption( $type, $id, $title, $description, $std, $values = null ) {
		$one_option = array();
		$one_option['type'] = $type;
		$one_option['id'] = $id;
		$one_option['title'] = $title;
		$one_option['description'] = $description;
		$one_option['std'] = $std;
		if( $values != null )
			$one_option['values'] = $values;
		                    
		$this->data[] = $one_option;
		$this->data_clean[] = $one_option;
	}
        
	public function getMetaboxData( $metabox_name ) {
		$dta = $this->data_metabox;
		foreach( $dta as $id => $metabox ) {
			foreach( $metabox as $name => $data ) {
				if( $name == $metabox_name )
					return $data;
			}
		}
	}
	
	
	public function metaboxStart( $metabox_name, $pagetemplate = null ) {
		$this->act_metabox = $metabox_name;
		$this->act_pagetemplate[ $metabox_name ] = $pagetemplate;
	}
	
	public function getMetaboxPagetemplate( $metabox_name ) {
		if( isset($this->act_pagetemplate[ $metabox_name ]) )
			return $this->act_pagetemplate[ $metabox_name ];
		return null;
	}
	
	public function metaboxEnd() {
		$data[$this->act_metabox] = $this->data;
		$this->data_metabox[] = $data;
		$this->data = null;
		$this->act_metabox = null;
	}
	public function specificTemplateStart( $template_name ) {
		$one_option = array();
		$one_option['type'] = 'templateStart';
		$one_option['id'] = $template_name;
		
		$this->data[] = $one_option;
	}
	
	public function specificTemplateEnd() {
		$one_option = array();
		$one_option['type'] = 'templateEnd';
		//$one_option['id'] = $template_name;
		
		$this->data[] = $one_option;		
	}
}


