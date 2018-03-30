<?php

require_once 'UberMenuItem.class.php';
require_once 'UberMenu_dummy_item.class.php';
require_once 'UberMenuItemDefault.class.php';
require_once 'UberMenuItemRow.class.php';
require_once 'UberMenuItemColumn.class.php';


add_filter( 'ubermenu_item_object_class' , 'ubermenu_get_item_object_class' , 10 , 4 );
function ubermenu_get_item_object_class( $class , $item , $id , $auto_child = '' ){
	$ubermenu_custom_type = '';

	if( $item->custom_type ){
		$ubermenu_custom_type = $item->custom_type;
	}
	else{
		$ubermenu_custom_type = get_post_meta( $item->db_id , '_ubermenu_custom_item_type' , true );
	}

	switch( $ubermenu_custom_type ){
		case 'row':
			$class = 'UberMenuItemRow';
			break;

		case 'column';
			$class = 'UberMenuItemColumn';
			break;

		case 'divider':
			$class = 'UberMenuItemDivider';
			break;

		default:
			$class = 'UberMenuItemDefault';
			break;

	}

	return $class;
}