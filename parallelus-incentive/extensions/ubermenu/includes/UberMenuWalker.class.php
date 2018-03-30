<?php


/**
 * Create HTML list of nav menu items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker
 */
class UberMenuWalker extends Walker_Nav_Menu {

	var $item_stack = array();
	var $current_umitem;
	var $setting_defaults;
	var $auto_child = '';
	var $trashbin = array();

	var $ignore_items = array(); //Don't print these items
	var $ignore_children = array();
	
	var $detached_content = array();
	var $detached = false;
	var $detached_context = 0;
	
	var $offset_depth = 0;
	
	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 * @since 3.0.0
	 * @var string
	 */
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * Database fields to use.
	 *
	 * @see Walker::$db_fields
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 */
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	function __construct(){	
		$this->setting_defaults = ubermenu_menu_item_setting_defaults();
		$this->setting_defaults['submenu_type_calc'] = 'unk';	//Unknown
		$this->setting_defaults['item_display_calc'] = 'unk';	//Unknown
	}

	/* Recursive function to remove all children */
	function clear_children( &$children_elements , $id ){

		if( empty( $children_elements[ $id ] ) ) return;

		foreach( $children_elements[ $id ] as $child ){
			$this->clear_children( $children_elements , $child->ID );
		}
		unset( $children_elements[ $id ] );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;


		//Offset Depth
		$original_depth = $depth;
		$depth = $depth + $this->offset_depth;

		$id_field = $this->db_fields['id'];


		if( $this->get_ignore( $element->$id_field ) ){
			unset( $children_elements[$element->$id_field] );
			return;
		}



		//Automatically add rows!
		if( isset( $children_elements[ $element->$id_field ] ) && count( $children_elements[ $element->$id_field ] ) > 0 ){
			$has_row = false;
			$has_nonrow = false;
			foreach( $children_elements[ $element->$id_field ] as $child_el ){
				if( $child_el->type_label == '[UberMenu Row]' ){
					$has_row = true;
					//break;
				}
				else{
					$has_nonrow = true;
				}
			}

			if( $has_row ){
				$element->classes[] = 'advanced-sub';

				//If user hasn't added rows, we need to add them
				if( $has_nonrow){

					$row_count = 0;
					$current_row = false; 
					$current_row_id = 0;

					$id = $element->$id_field;

					$my_children = $children_elements[ $id ];
					$children_elements[ $id ] = array();

					//Loop through items, wrap in rows
					foreach( $my_children as $k => $child_el ){

						//If this is a row, reset current vals
						if( $child_el->type_label == '[UberMenu Row]' ){
							$current_row = false;
							$current_row_id = 0;
							$children_elements[ $id ][] = $child_el;
						}
						//If this isn't a row, wrap it in a row
						else{
							//If we don't have a current row, make one
							if( !$current_row_id ){
								$row_count++;
								$current_row_id = $element->$id_field.'_auto_'.$row_count;
								$current_row = new UberMenu_dummy_item( $current_row_id , 'row' , 'Dummy Row' , $element->$id_field );
								$children_elements[$current_row_id] = array();

								//Insert row in appropriate spot.
								$children_elements[$id][] = $current_row;
							}

							//Add Children to Row
							$children_elements[$current_row_id][] = $child_el;

							//Remove Children from Sub?
							//unset( $children_elements[$id][$k] );  // No because we reset array above
							
						}
						

					}
				}
			}
		}


		//Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		

		//display this element - wp-includes/class-wp-walker.php
		$has_children = ! empty( $children_elements[$element->$id_field] );
		if ( isset( $args[0] ) && is_array( $args[0] ) ){			
			$args[0]['has_children'] = $has_children;
		}
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		$id = $element->$id_field;  // Moved up


		// Setup UberMenuItem object
		$umitem_obect_class = apply_filters( 'ubermenu_item_object_class' , 'UberMenuItemDefault' , $element , $id , $this->auto_child );
		//echo '<br/><br/>'.str_repeat("&nbsp;", $depth*5).'['. $id .'] '. $umitem_obect_class . ' :: <strong>' . $element->title.'</strong>';
		//echo $element->$id_field . ' :: ' .$umitem_obect_class.'<br/>';


		$umitem = new $umitem_obect_class( $output , $element , $depth, $cb_args[3], $id , $this , $has_children );	//The $args that get passed to start_el are $cb[3] -- i.e. the 4the element in the array merged above

		


		//Ignoring? Check again after initialization so that item can disable itself
		if( $this->get_ignore( $element->$id_field ) ){
			unset( $children_elements[$element->$id_field] );
			return;
		}


		//Disabled?
		$display_on = $umitem->display_on();

		//If this item is not yet disabled, allow its status to be filtered
		if( $display_on ){
			$display_on = apply_filters( 'ubermenu_display_item' , true , $this , $element , $max_depth, $depth, $args , $umitem );
		}

		//If the item is disabled, kill its children, Lannister-style
		if( !$display_on ){
			$this->clear_children( $children_elements , $id );
			return;
		}

		//If submenu disabled, clear children but don't return
		if( $umitem->getSetting( 'disable_submenu_on_mobile' ) == 'on' ){
			if( wp_is_mobile() ){
				$this->clear_children( $children_elements , $id );
				$umitem->disable_children();
			}
		}


		//Filter

		// Manipulate Structure
		if( $umitem->alter_structure() ){
			$umitem->alter( $children_elements );
		}

		$this->push_item( $umitem );
	
	
		call_user_func_array(array($this, 'start_el'), $cb_args);



		//Check if we are ignoring children
		
		if( !$this->get_ignore_children( $id ) ){

			// descend only when the depth is right and there are childrens for this element
			if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

				foreach( $children_elements[ $id ] as $child ){

					$this->auto_child = $umitem->getAutoChild();
					
					if ( !isset($newlevel) ) {
						$newlevel = true;
						//start the child delimiter
						$cb_args = array_merge( array(&$output, $depth), $args);
						call_user_func_array(array($this, 'start_lvl'), $cb_args);
					}
					$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );

					$this->auto_child = '';

				}

				//Unset this item's children elements
				unset( $children_elements[ $id ] );	//TODO!!!
			}
		}


		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array($this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'end_el'), $cb_args);
	

		//Cleanup when we hit top level items (original depth/without offset matters for menu segments)
		if( $depth == 0 || $original_depth == 0 ){

			//Make sure we don't print trash - actually, these elements don't exist, just child indexes

			foreach( $this->trashbin as $_trash_id => $on ){
				//echo '<br/>$$unset '.$_trash_id.'<br/>';
				unset( $children_elements[$_trash_id] );
			}
			
			if( $depth == 0 ) $this->trashbin = array();	//reset trashbin only at very top

		}


	}



	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		//$indent = str_repeat("\t", $depth);
		$this->current_umitem->start_lvl();
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		//$indent = str_repeat("\t", $depth);
		$this->current_umitem->end_lvl();
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$this->current_umitem->start_el();
		
	}


	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$this->current_umitem->end_el();
		$this->pop_item();
	}


	function feed_trash_collector( $index ){

		if( isset( $this->trashbin[$index] ) && $this->trashbin[$index] ){
			return true;
		}

		$this->trashbin[$index] = true;
		return false;

	}




	function push_item( $umitem ){
		$this->item_stack[] = $umitem;
		$this->current_umitem = $umitem;
	}
	function pop_item(){
		$umitem = array_pop( $this->item_stack );
		$this->current_umitem = $this->current_item();
	}
	function current_item(){
		return end( $this->item_stack );
	}
	function parent_item(){
		return isset( $this->item_stack[count($this->item_stack)-2] ) ? 
				$this->item_stack[count($this->item_stack)-2] :
				false;
	}
	function grandparent_item(){
		return isset( $this->item_stack[count($this->item_stack)-3] ) ? 
				$this->item_stack[count($this->item_stack)-3] :
				false;
	}
	function closest_item_type( $type ){
		for( $k = count( $this->item_stack ) - 1 ; $k >= 0 ; $k-- ){
			if( $this->item_stack[$k]->getType() == $type ){
				return $this->item_stack[$k];
			}
		}
	}

	/* Traverse until an ancestor returns a term ID, otherwise return -1 */
	function find_parent_term(){
		//up( $this->item_stack , 1 );
		for( $k = count( $this->item_stack ) - 1 ; $k >= 0 ; $k-- ){
			$term = $this->item_stack[$k]->get_term_id();
			if( $term ) return $term;
		}
		return -1;
	}

	/* Traverse until an ancestor returns a post ID, otherwise return -1 */
	function find_parent_post(){
		for( $k = count( $this->item_stack ) - 1 ; $k >= 0 ; $k-- ){
			$post = $this->item_stack[$k]->get_post_id();
			if( $post ) return $post;
		}
		return -1;
	}

	function find_inherited_setting( $setting_id , $ignore = '' , $offset = 0 ){

		for( $k = count( $this->item_stack ) - ( $offset + 1 ) ; $k >= 0 ; $k-- ){
			$item = $this->item_stack[$k];
			$settings = $item->get_settings();
			if( isset( $settings[$setting_id] ) && $settings[$setting_id] !== $ignore ){
				return $settings[$setting_id];
			}
		}
		return $this->setting_defaults[$setting_id];
	}


	function alert_dynamic_alter( $id , $source_id , $umitem , &$children ){
		for( $k = count( $this->item_stack ) - 1 ; $k >= 0 ; $k-- ){
			if( $this->item_stack[$k]->dynamic_alter( $id, $source_id , $umitem , $children ) ){
				return;
			}
		}
		return -1;
	}





	
	function setAutoChild( $auto_child ){
		$this->auto_child = $auto_child;
	}
	function getAutoChild(){
		return $this->auto_child;
	}

	function set_ignore( $id , $ignore = true ){
		$this->ignore_items[$id] = $ignore;
	}
	function get_ignore( $id ){
		if( isset( $this->ignore_items[$id] ) && $this->ignore_items[$id] ){
			return true;
		}
		return false;
	}

	function set_ignore_children( $id , $ignore = true ){
		$this->ignore_children[$id] = $ignore;
	}
	function get_ignore_children( $id ){
		if( isset( $this->ignore_children[$id] ) && $this->ignore_children[$id] ){
			return true;
		}
		return false;
	}

	function set_offset_depth( $depth ){
		$this->offset_depth = $depth;
	}
	function get_offset_depth(){
		return $this->offset_depth;
	}

	//passed Key (ID of item) may not be unique if any ancestors
	//are Dynamic Terms or Dynamic Posts
	function unique_path_key( $key = '' ){
		//$key = ;
		for( $k = count( $this->item_stack ) - 1 ; $k >= 0 ; $k-- ){
			$term = $this->item_stack[$k]->get_term_id();
			if( $term ) $key.= '_t'.$term;

			$post = $this->item_stack[$k]->get_post_id();
			if( $post ) $key.= '_p'.$post;
		}
		return $key;
	}

	

}