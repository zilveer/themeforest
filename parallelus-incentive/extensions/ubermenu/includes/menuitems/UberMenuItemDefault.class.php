<?php

/*
 * A regular menu item
 */
class UberMenuItemDefault extends UberMenuItem{

	protected $type = 'default';


	function get_term_id(){
		if( $this->item->type == 'taxonomy' ){
			return $this->item->object_id;
		}
		return false;
	}


	function get_new_column( $output ){

		if( $this->depth >= 2 ){
			if( $this->getSetting( 'new_column' ) == 'on' ){			//New Columns
				$cols = $this->walker->parent_item()->getSetting( 'columns' );
				//if( $cols == 'auto' ) $cols = $this->walker->grandparent_item()->getSetting( 'submenu_column_default' );
				$output.= '</ul></li>';
				$output.= '<li class="ubermenu-item ubermenu-column ubermenu-column-'.$cols.' ubermenu-item-header ubermenu-newcol">'.
							'<span class="ubermenu-target">&nbsp;</span><ul class="ubermenu-submenu ubermenu-submenu-type-stack">';
			}
		}

		return $output;
	}


	function get_start_el(){
		
		//Variable Initialization
		$item_output = '';
		$class_names = $value = '';

		$item_output = $this->get_new_column( $item_output );

		//Setup Classes
		$this->add_class_item_defaults();
		$this->add_class_id();
		$this->prefix_classes();
		$this->add_class_item_display();
		$this->add_class_level();
		$this->add_class_layout_columns();
		$this->add_class_alignment();
		$this->add_class_mini_item();
		$this->add_class_submenu();
		$this->add_class_rtl_sub();
		$this->add_class_disable_padding();
		$this->add_class_responsive();

		$class_names = $this->filter_item_classes();

		//Setup ID
		$id = $this->filter_item_id();

		//Setup Trigger
		$this->setup_trigger();

		//Atts
		$atts = ' ';
		foreach( $this->item_atts as $att => $val ){
			$atts.= $att.'="'.$val.'" ';
		}

		//Item LI
		$item_output .= '<li' . $id . $value . $class_names . $atts.'>';

		//Anchor
		$atts = $this->anchor_atts(); //Attributes
		$item_output .= $this->get_anchor( $atts );

		//Custom Content
		$item_output .= $this->get_custom_content();

		//Widget
		$item_output .= $this->get_widget_area();

		return $item_output;
	}

}