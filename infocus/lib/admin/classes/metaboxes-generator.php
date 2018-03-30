<?php
/**
 *
 */
class mysiteMetaBox extends mysiteOptionGenerator {
	
	private $_meta_box;
	
	/**
	 *
	 */
	function __construct( $meta_box ) {
		
		if ( !is_admin() ) return;
		
		$this->_meta_box = $meta_box;
		
		add_action( 'admin_menu', array( &$this, 'add' ) );
		add_action( 'save_post', array( &$this, 'save' ) );
	}
	
	/**
	 *
	 */
	function add() {
		foreach ( $this->_meta_box['pages'] as $page ) {
			add_meta_box( $this->_meta_box['id'], $this->_meta_box['title'], array( &$this, 'show' ), $page, $this->_meta_box['context'], $this->_meta_box['priority'] );
		}
	}
	
	/**
	 *
	 */
	function show() {
		global $post;
		
		$out = '';
		
		foreach ( $this->_meta_box['fields'] as $value ) {
			$meta = get_post_meta( $post->ID, $value['id'], true );
			
			if ( $meta != '' ) 
				$value['default'] = $meta;
				
			$out .= $this->$value['type']( $value );
		}
		
		# Use nonce for verification
		$out .= '<input type="hidden" name="' . $this->_meta_box['id'] . '_meta_box_nonce" value="' . wp_create_nonce( basename(__FILE__) ) . '" />';
		
		echo $out;
	}
	
	
	/**
	 *
	 */
	function save( $post_id ) {
		
		// TinyMCE editor IDs cannot have brackets.
		// This is the fix for now.
		foreach( $_POST as $key => $value ) {
			if( strpos( $key, '-bracket-' ) !== false ) {
				$option_name = explode( '-bracket-', $key );
				$_POST[MYSITE_SETTINGS][$option_name[1]] = $value;
				unset( $_POST[$key] );
			}
		}
		
		# check autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		
		if( empty( $_POST[$this->_meta_box['id'] . '_meta_box_nonce'] ) )
			return $post_id;
		
		# verify nonce
		if ( !wp_verify_nonce( $_POST[$this->_meta_box['id'] . '_meta_box_nonce'], basename(__FILE__) ) ) {
			return $post_id;
		}

		# check permissions
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		
		# save the meta boxes
		foreach ( $this->_meta_box['fields'] as $value ) {
			$name = $value['id'];
			
			$old = get_post_meta( $post_id, $name, true );
			
			$new = ( !empty( $_POST[MYSITE_SETTINGS][$value['id']] ) )
			? $_POST[MYSITE_SETTINGS][$value['id']]
			: '';
						
			if ( $new && $new != $old ) {
				update_post_meta( $post_id, $name, $new );
			} elseif ('' == $new && $old) {
				delete_post_meta( $post_id, $name, $old );
			}
		}
	}
	
}

?>