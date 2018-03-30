<?php

class UberMenuItemColumn extends UberMenuItem{

	protected $type = 'column';

	function get_start_el(){

		$this->prefix_classes();

		//Setup Classes
		$this->add_class_item_defaults();
		$this->add_class_id();
		$this->prefix_classes();
		//$this->add_class_item_display();
		$this->add_class_level();
		$this->add_class_layout_columns();
		$this->add_class_alignment();
		$this->add_class_submenu();
		$this->add_class_disable_padding();
		$this->add_class_responsive();

		$this->item_classes[] = 'ubermenu-item-type-column';
		$this->item_classes[] = 'ubermenu-column-id-'.$this->ID;

		// $this->item_classes[] = 'ubermenu-item-type-column';
		// $this->add_class_layout_columns();
		// $this->add_class_item_defaults();
		// $this->item_classes[] = 'ubermenu-column-id-'.$this->ID;
		// $this->add_class_responsive();

		
		$submenu_column_default = $this->getSetting( 'submenu_column_default' );
		switch( $submenu_column_default ){
			case 'auto':
			case 'natural':
			case 'full':
				$this->settings['submenu_type'] = 'stack';
				break;
			default:
				$this->settings['submenu_type'] = 'block';
				break;
		}

		return '<li class="'.implode( ' ' , $this->item_classes ).'">';
	}
}