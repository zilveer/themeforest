<?php
/**
 * This file is part of the BTP_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 * 
 * 1. class BTP_Item
 * 2. class BTP_Hierarchy
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ------------------------------------------------------------------------- */
/* ---------->>> ITEM <<<--------------------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
 * Item in a hierarchy
 * 
 * @package 				BTP_Framework 
 * @subpackage				BTP_Tools
 */
class BTP_Item implements ArrayAccess {

	/** 
	 * Identifier
	 * @var			string
	 */
	public $id = null;
		
	/** 
	 * Configuration
	 * @var			array
	 */
	public $config = array();	
	
	
	/**
	 * Constructor 
	 * 
	 * @param 			string $id
	 * @param 			array $config
	 */
	public function __construct( $id, $config ) {
		$this->id = $id;
		$this->config = $config;
	}
	
	
	
	/**
	 * Merges an old configuration with a new one
	 * 
	 * @param 			string $config
	 */
	public function config( $config ) {
		$this->config = array_multimerge( $this->config, $config );
	}
	
	
	
	/**
	 * Checks whether an option has children items
	 * 
	 * @return			bool
	 */
	public function has_children() {
		if ( 
			isset ( $this->config[ 'children' ] ) && 
			is_array( $this->config[ 'children' ] ) && 
			count( $this->config[ 'children' ] ) 
		) {
			return true;
		}
		
		return false;
	}	
		
	
	
	/**
     * Implementation of ArrayAccess::offsetSet()
     *
     * @param 			string $offset
     * @param 			mixed $value
     */
    public function offsetSet( $offset, $value ) {
        $this->config[ $offset ] = $value;
    }
    
    

    /**
     * Implementation of ArrayAccess::offsetExists()
     *
     * @param 			string $offset
     * @return 			boolean
     */
    public function offsetExists( $offset ) {
        return isset( $this->config[ $offset ] );
    }
    
    

    /**
     * Implementation of ArrayAccess::offsetUnset()
     *
     * @param 			string $offset
     */
    public function offsetUnset( $offset ) {
        unset( $this->config[ $offset ] );
    }
    
    

    /**
     * Implementation of ArrayAccess::offsetGet()
     *
     * @param 			string $offset
     * @return 			mixed
     */
    public function offsetGet( $offset ) {
        return isset( $this->config[ $offset ] ) ? $this->config[ $offset ] : null;
    }
}



/* ------------------------------------------------------------------------- */
/* ---------->>> HIERARCHY <<<---------------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
* Hierarchy
* 
* Organizes items using a two-levels hierarchy ( subgroups inside groups )
* 
* @package 				BTP_Framework 
* @subpackage			BTP_Tools
*/
abstract class BTP_Hierarchy {

	/** 
	 * Items without hierarchy
	 * @var			array
	 */
	public $items = array(); 
	
	/** 
	 * Item hierarchy
	 * @var			array				 
	 */
	public $hierarchy = array();
	
	/**
	 * Base item configuration
	 * @var 		array
	 */
	public $base_item = array();
	
	/**
	 * Specifies whether the hierarchy is sorted
	 * @var			bool
	 */
	protected $is_sorted = false;
	
	
	
	/**
	 * Constructor
	 */	
	public function __construct() {}
	
	
	/**
	 * Sets base item configuration
	 * 
	 * @param 			array $v
	 */
	public function set_base_item( $v ) {
		if ( is_array( $v ) ) {
			$this->base_item = $v;
		}
	}
	
	
	
	/**
	 * Gets base item configuration
	 * 
	 * @return			array 
	 */
	public function get_base_item() {
		return $this->base_item;
	}

	
	
	/**
	 * Indicates whether or not a group exists.
	 * 
	 * @param 			string $group_id
	 * @return			bool
	 */
	public function has_group( $group_id ) {
		return isset( $this->hierarchy[ $group_id ] );
	}
	
	
	
	/**
	 * Adds item group
	 * 
	 * @param 			string $group_id Must be unique (only lowercase letters and digits, no underscore)
	 * @param 			array $group_args
	 * @param 			int $group_position
	 */
	public function add_group( $group_id, $group_args = array(), $group_position = 100 ) {
		/* Merge defaults with arguments */ 
		$group_args = array_multimerge( 
			array( 'label' => $group_id),
			$group_args
		);
		
		/* If group doesn't exist, create one */
		if ( !isset( $this->hierarchy[ $group_id ] ) ) {
			$this->hierarchy[ $group_id ] = array(
				'args'		=> $group_args,
				'position'	=> $group_position,
				'subgroups'	=> array(),
			);
		/* If group exists, modify it */	
		} else {	
			$this->hierarchy[ $group_id ][ 'args' ] = array_multimerge( 
				$this->hierarchy[ $group_id ][ 'args' ], 
				$group_args
			);
			
			$this->hierarchy[ $group_id ][ 'position' ] = $group_position;
		}
		
		$this->is_sorted = false;		
	}
	
	
	
	/**
	 * Removes item group
	 * 
	 * @param			string $group_id
	 */
	public function remove_group( $group_id ) {
		if ( $this->has_group( $group_id ) ) {			
			/* Unset items from items array */
			foreach( $this->hierarchy[ $group_id ][ 'subgroups' ] as $subgroup_id => $subgroup ) {
				foreach( $subgroup[ 'items' ] as $item_id => $item ) {
					unset( $this->items[ $item_id ] );	
				}				
			}
			
			/* Remove group from hierarchy array */
			unset( $this->hierarchy[ $group_id ] );
		}	
	}
	
	
	
	/**
	 * Indicates whether or not a subgroup exists.
	 * 
	 * @param 			string $subgroup_id
	 * @param 			string $group_id
	 * @return			bool
	 */
	public function has_subgroup( $subgroup_id, $group_id ) {
		if ( isset( $this->hierarchy[ $group_id ] ) ) {
			if ( isset( $this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ] ) )
				return true;
		}
		return false;
	}
	
	
	
	/**
	 * Adds item subgroup
	 * 
	 * @param 			string $subgroup_id Must be unique inside group (only lowercase letters and digits, no underscore)
	 * @param 			string $subgroup_args
	 * @param 			array $group_id 
	 * @param 			int $subgroup_position
	 */
	public function add_subgroup( $subgroup_id, $subgroup_args, $group_id = 'undefined', $subgroup_position = 100 ) {
		/* If group doesn't exist, create one */
		if( !$this->has_group( $group_id ) ) {
			$this->add_group( $group_id );
		}
		
		/* Merge defaults with arguments */
		$subgroup_args = array_multimerge( 
			array( 'label' => $subgroup_id ),
			$subgroup_args		
		);		

		/* If subgroup doesn't exist, create one */
		if ( !isset( $this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ] ) ) {
			$this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ] = array(
				'args'		=> $subgroup_args,
				'position'	=> $subgroup_position,
				'items'	=> array(),
			);
		/* If subgroup exists, modify it */	
		} else {
			$this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ][ 'args' ] = array_multimerge(
				$this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ][ 'args' ], 
				$subgroup_args
			);
			$this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ][ 'position' ] = $subgroup_position;
		}
		
		$this->is_sorted = false;
	}
		
	
	
	/**
	 * Removes item subgroup
	 * 
	 * @param			string $subgroup_id
	 * @param			string $group_id 
	 */
	public function remove_subgroup( $subgroup_id, $group_id ) {		
		if ( $this->has_subgroup( $subgroup_id, $group_id ) ) {			
			/* Unset items from items array */
			foreach( $this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ][ 'items' ] as $item_id => $item ) {
				unset( $this->items[ $item_id ] );
			}
			
			/* Remove subgroup from hierarchy array */
			unset( $this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ] );
		}
	}	
	
	
	
	/**
	 * Indicates whether or not an item exists.
	 * 
	 * @param 			string $item_id
	 * @return			bool
	 */
	public function has_item( $item_id ) {
		return isset ( $this->items[ $item_id ] );
	}
	
	
	
	/**
	 * Adds item 
	 *
	 * @param 			string $item_id Must be unique(only lowercase letters and digits, no underscore)
	 * @param 			array $item_args
	 * @param 			string type $group_id
	 * @param 			string_type $subgroup_id
	 * @param 			int $position
	 */
	public function add_item( $item_id,  $item_args, $group_id = 'undefined', $subgroup_id = 'undefined', $position = 100 ) {
		/* If item doesn't exist, create one */
		if ( !$this->has_item( $item_id ) ) {
			
			$group_id = ( null === $group_id ) ? 'undefined' : $group_id;
			$subgroup_id = ( null === $subgroup_id ) ? 'undefined' : $subgroup_id;
			$position = ( null === $position ) ? 100 : $position;
						
			if ( !$this->has_group( $group_id ) ) {
				$this->add_group( $group_id );
			}	
			if ( !$this->has_subgroup( $subgroup_id, $group_id ) ) {
				$this->add_subgroup( $subgroup_id, array(), $group_id );
			}
		
			$this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ][ 'items' ][ $item_id ] = array(
				'position' => $position 
			);		
		 
			$this->items[ $item_id ] = new BTP_Item( $item_id, array_merge( $this->base_item, $item_args ) );
			 			
		/* If item exists, modify it */		
		} else {				
			$item = $this->get_item( $item_id );			
			$item->config( $item_args );
			
			$group_id = $item[ 'group' ];
			$subgroup_id = $item[ 'subgroup' ];
						
						
			if ( null !== $position ) {
				$this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ][ 'items' ][ $item_id ][ 'position' ] = $position;
			}
		}

		$this->is_sorted = false;
	}

	
	
	/**
	 * Gets item  
	 * 
	 * @param 			string $item_id
	 * @return			array
	 */
	public function get_item( $item_id ) {
		if ( $this->has_item( $item_id ) ) {
			return $this->items[ $item_id ];			
		}
		
		return null;
	}
	
	
	
	/**
	 * Removes item
	 *
	 * @param 			string $item_id
	 */
	public function remove_item( $item_id ) {
		if ( $this->has_item( $item_id ) ) {
			/* Remove item from items array */
			unset( $this->items[ $item_id ] );
			
			/* Unset items from hierarchy array */
			foreach ( $this->hierarchy as $group_id => $group ){
				foreach ( $this->hierarchy[ $group_id ][ 'subgroups' ] as $subgroup_id => $subgroup ) {
					unset( $this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ][ 'items' ][ $item_id ] );
				}
			}
		}	
	}
	
	
	
	/**
	 * Sorts hierarchy by position
	 */
	public function sort() {		
		if ( !$this->is_sorted  ) {		
			uasort ( $this->hierarchy, array( $this, 'usort_position') );
			
			foreach( $this->hierarchy as $group_id => $group ) {
				uasort ( $this->hierarchy[ $group_id ][ 'subgroups' ], array( $this, 'usort_position') );
				
				foreach( $this->hierarchy[ $group_id ]['subgroups'] as $subgroup_id => $subgroup ) {
					uasort ( $this->hierarchy[ $group_id ][ 'subgroups' ][ $subgroup_id ][ 'items' ] , array( $this, 'usort_position') );
				}
			}	

			$this->is_sorted = true;	
		}	
	}	
	
	
	
	/**
	 * Compares positions in hierarchy - usort() callback 
	 * 
	 * @param 			array $a
	 * @param 			array $b
	 * @return 			int
	 */
	public function usort_position( $a, $b ) {		
		if ( $a[ 'position' ] > $b[ 'position' ] ) 
        	return 1;
    	elseif ( $a[ 'position' ] < $b[ 'position' ] )
			return -1;
		else
			return 0;
	}
}
?>