<?php

/**
 * Contains all the main functionality about working with meta data 
 * (saving and retrieving).
 *
 * @author Pexeto
 */
class PexetoMeta extends PexetoDataFields{

	public $post_id;
	public $post_type;

	/**
	 * Saves the meta data of a post.
	 *
	 * @param int     $post_id   the ID of the post whose data is saved
	 * @param string  $post_type the post type of the post
	 * @param string  $nonce_id  the nonce ID string which is used to verify the post
	 * @return true if the data was saved and the post ID if the data was not saved
	 */
	public function save_data( $post_id, $post_type, $nonce_id ) {
		global $post;

		if ( !isset( $post ) || !isset( $_POST['pexeto-meta-nonce'] ) ) {
			return $post_id;
		}

		//verify the nonce field
		if ( !wp_verify_nonce( $_POST['pexeto-meta-nonce'], $nonce_id ) ) {
			return $post_id;
		}

		//check if user can edit the page
		if ( !current_user_can( 'edit_posts' ) ) {
			return $post_id;
		}

		$meta_boxes = $this->fields[$post_type];
		if ( !empty( $meta_boxes ) ) {
			foreach ( $meta_boxes as $meta_field ) {
				if($meta_field['type']!='multioption'){
					//this is a single option meta field
					if ( isset( $meta_field["id"] ) && isset( $_POST[$meta_field["id"]] ) ) {
						$post_val = $_POST[$meta_field["id"]];
						update_post_meta( $post_id, $meta_field["id"], $post_val );
					}
				}elseif(isset($meta_field['fields'])){
					//this is a multi-option metafield
					foreach ($meta_field['fields'] as $sub_field) {
						$sub_field_id = $meta_field["id"].'_'.$sub_field["id"];
						if ( isset( $_POST[$sub_field_id] ) ) {
							$post_val = $_POST[$sub_field_id];
							update_post_meta( $post_id, $sub_field_id, $post_val );
						}
					}
				}
			}

			return true;
		}

		return $post_id;

	}


	/**
	 * Retrieves the value of a meta field
	 *
	 * @param string  $id   the ID of the field
	 * @param array   $args optional array which can contain the post ID as 
	 * "post_id" key and the post type as a "post_type" key. If these values 
	 * have been set to the object they can be omitted.
	 * @return if the meta field has a saved value, it will return the saved 
	 * value, otherwise will return the default value of the field. If the post 
	 * ID and post type are not set, it will return null and if the field
	 * with the specified ID cannot be found, it will rerurn an empty string.
	 */
	public function get_value( $id, $args=array() ) {
		if ( isset( $args['post_id'] ) && isset( $args['post_type'] ) ) {
			//the post ID and type are set in the optional arguments array
			$post_id = $args['post_id'];
			$post_type = $args['post_type'];
		}elseif ( isset( $this->post_id ) && isset( $this->post_type ) ) {
			//the post ID and type are set in the current object
			$post_id = $this->post_id;
			$post_type = $this->post_type;
		}else {
			//no post ID and type are set, return
			return;
		}

		$saved_val = get_post_meta( $post_id, $id, true );


		if ( !empty( $saved_val ) ) {
			//there is a saved value
			return $saved_val;
		}elseif ( isset( $this->fields[$post_type] ) ) {
			//there is no saved value, return the default value for the field
			foreach ( $this->fields[$post_type] as $field ) {
				if ( isset( $field['id'] ) && $field['id']==$id ) {
					if($field['type']=='multioption'){
						//this is a multioption get the values of the subfields
						$res = parent::get_default_value( $field );
						foreach ($field['fields'] as $subfield) {
							$val = get_post_meta( $post_id, $field['id'].'_'.$subfield['id'], true );
							if(!empty($val)){
								$res[$subfield['id']]=$val;
							}
						}
						return $res;
					}else{
						//return the default value of the field
						return parent::get_default_value( $field );
					}
					
				}
			}
		}else {
			return;
		}
		return '';
	}
}
