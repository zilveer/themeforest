<?php

class UberMenuItemRow extends UberMenuItem{

	protected $type = 'row';

	function init(){
		if( $this->depth == 0 ){
			$this->walker->set_ignore( $this->item->ID );
			return '<!-- Rows can only be used in submenus-->';
		}
	}


	function get_start_el(){

		$classes = array();

		//Rob submenus should be like if they were in a mega sub
		$this->settings['submenu_type_calc'] = 'mega';

		//If the submenu column default is auto, inherit from parent
		if( $this->getSetting( 'submenu_column_default' ) == 'auto' ){
			$this->settings['submenu_column_default'] = $this->walker->parent_item()->getSetting( 'submenu_column_default' );
		}
		

		//Autoclear
		$autoclear = '';

		//Dummy inherits
		if( $this->is_dummy ){	//if this is a dummy row, check with the parent
			if( $this->walker->parent_item()->getSetting( 'submenu_column_autoclear' ) == 'on' ){
				$autoclear = 'ubermenu-autoclear';
			}
		}
		//Row setting
		else{
			if( $this->getSetting( 'submenu_column_autoclear' ) == 'on' ){
				$autoclear = 'ubermenu-autoclear';
			}
		}

		if( $this->getSetting( 'grid_row' ) == 'on' ){
			$classes[] = 'ubermenu-grid-row';
		}

		$classes = implode( ' ' , $classes );

		return '<ul class="ubermenu-row ubermenu-row-id-'.$this->item->ID.' ' . $autoclear .' '. $classes.'">';
	}
	function get_end_el(){
		$item_output = "</ul>"; //<!-- end row ".$this->item->ID."-->\n";
		return $item_output;
	}

	function get_submenu_wrap_start(){
		return '';
	}
	function get_submenu_wrap_end(){
		return '';
	}
}