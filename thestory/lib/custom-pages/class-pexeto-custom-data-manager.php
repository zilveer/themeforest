<?php

/**
 * This class contains some functionality for creating/updating different data 
 * structures such as posts, taxonomies, terms etc.
 *
 * @author Pexeto
 *
 */
class PexetoCustomDataManager {
	protected $user_capability;

	function __construct( $user_capability ) {
		$this->user_capability = $user_capability;
	}

	/**
	 * Creates a custom post.
	 *
	 * @param $data        an array that contains the data to be inserted
	 * @param $custom_page a custom page object that represents the current custom page
	 * @param $prefix      the prefix of the fields in the form
	 * @param $sufix       the category term suffix
	 */
	public function insert_post( $data, $custom_page, $prefix, $suffix ) {
		global $current_user;

		if ( !current_user_can( $this->user_capability ) ) {
			return false;
		}

		$title=isset( $data[$prefix.'title'] )?$data[$prefix.'title']:$data['default_title'];
		$content=isset( $data[$prefix.'content'] )?$data[$prefix.'content']:'';
		$post_type=$data['post_type'];
		$order=( isset( $data['order'] )&&$data['order'] )?$data['order']:'';
		$category=(int)$data['category'];

		//Create post object
		$new_post = array(
			'post_title' => $title,
			'post_content' => $content,
			'post_status' => 'publish',
			'post_author' => $current_user->ID,
			'post_type' =>$post_type
		);

		// Insert the post into the database
		$post_id=wp_insert_post( $new_post );
		$cat_id=array( $category );

		$order.=','.$post_id;

		update_option( 'pexeto_order'.$category.$post_type, $order );

		//set the category to the item
		wp_set_object_terms( $post_id, $cat_id, $post_type.$suffix );


		$prefix_length=strlen( $prefix );
		$post_keys=array_keys( $data );

		foreach ($custom_page->fields as $field) {
			$key = $prefix.$field['id'];
			if(isset($data[$key]) && $key!=$prefix.'_title' && $key!=$prefix.'_content'){
				$val = is_array($data[$key]) ? implode(',', $data[$key]) : $data[$key];
				add_post_meta( $post_id, $key, $val );
				// echo '*** add '.$key.' '.$val;
			}
		}

		$post=get_post( $post_id );
		return $post;
	}


	public function delete_post( $post_id, $category, $post_type ) {
		if ( !current_user_can( $this->user_capability ) ) {
			return false;
		}

		$res=wp_delete_post( $post_id );
		if ( $res ) {
			//the item has been deleted successfully, update the new order value
			$order_option='pexeto_order'.$category.$post_type;
			$order_arr=explode( ',', get_option( $order_option ) );
			$new_order=$this->remove_item_by_value( $order_arr , $post_id );
			update_option( $order_option, implode( ',', $new_order ) );
		}
		return $res;
	}

	public function remove_item_by_value( $array, $val = '' ) {
		if ( empty( $array ) || !is_array( $array ) ) return false;
		if ( !in_array( $val, $array ) ) return $array;

		foreach ( $array as $key => $value ) {
			if ( $value == $val ) unset( $array[$key] );
		}

		return array_values( $array );
	}


	/**
	 * Creates a new instance of a custom page item - it is related with inserting a new
	 * category from the selected custom post type.
	 *
	 * @param string  $name     the name of the new instance
	 * @param string  $taxonomy the name of the taxonomy it will belong to
	 * @return object containing the new term if it is created successfully or false if it is not
	 * created successfully.
	 */
	public function insert_instance( $name, $taxonomy ) {
		if ( !current_user_can( $this->user_capability ) ) {
			return false;
		}
		$res=wp_insert_term( $name, $taxonomy );
		if ( $res instanceof WP_Error ) {
			$res = false;
		}
		return $res;
	}

	/**
	 * Edits a post (item).
	 *
	 * @param $data   the data that corresponds to the post such as ID, title 
	 * and other custom meta fields
	 * @param $prefix the custom meta id prefix, so that these fields can be 
	 * distinguished apart the other fields in the post
	 * @return false if the post was not edited successfully and true in all the other cases
	 */
	public function edit_post( $data, $prefix, $custom_page ) {
		if ( !current_user_can( $this->user_capability ) ) {
			return false;
		}

		$itemid=(int)$data['itemid'];
		$edited_post = array( "ID"=>$itemid );
		$toEdit=false;  //whether the single post should be edited (if the title and content are set)
		foreach ( $custom_page->fields as $field ) {
			$key = $prefix.$field['id'];
			if ( isset($data[$key]) ) {
				$value = $data[$key];
				//this is a custom value, insert it
				if ( $key==$prefix.'title' ) {
					$edited_post['post_title'] = $value;
					$toEdit=true;
				}elseif ( $key==$prefix.'content' ) {
					$edited_post['post_content'] = $value;
					$toEdit=true;
				}else {
					if(is_array($value)){
						$value = implode(',', $value);
					}
					update_post_meta( $itemid, $key, $value );
				}
			}
			else{
				if($field['type']=='checkbox'){
					update_post_meta( $itemid, $key, 'none' );
				}else{
					delete_post_meta($itemid, $key);
				}
			}
		}

		if ( $toEdit ) {
			wp_update_post( $edited_post );
		}

		return true;
	}

	/**
	 * Deletes a term (instance) and all the items (posts) that belong to it.
	 *
	 * @param $id        the ID of the term
	 * @param $taxonomy  the taxonomy it belongs to
	 * @param $post_type the post type of the items that belong to this term
	 */
	public function delete_instance( $id, $taxonomy, $post_type ) {
		if ( !current_user_can( $this->user_capability ) ) {
			return false;
		}
		$slug=get_term( $id, $taxonomy )->slug;

		$posts = get_posts( array( 'post_type' => $post_type,
				$taxonomy=>$slug ) );

		//delete the posts
		foreach ( $posts as $post ) {
			wp_delete_post( $post->ID );
		}

		//delete the category
		wp_delete_term( $id, $taxonomy );

		return true;
	}

}
