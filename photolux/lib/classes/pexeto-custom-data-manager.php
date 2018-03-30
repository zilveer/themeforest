<?php

/**
 * This class contains some functionality for creating/updating different data structures
 * such as posts, taxonomies, terms etc.
 * @author Pexeto
 *
 */
class PexetoCustomDataManager{

	/**
	 * Creates a custom post.
	 * @param $data an array that contains the data to be inserted
	 * @param $custom_page a custom page object that represents the current custom page
	 * @param $prefix the prefix of the fields in the form
	 * @param $sufix the category term suffix
	 */
	public function insert_post($data, $custom_page, $prefix, $suffix){
		global $current_user;

		$title=isset($data[$prefix.'title'])?$data[$prefix.'title']:$data['default_title'];
		$content=isset($data[$prefix.'content'])?$data[$prefix.'content']:'';
		$post_type=$data['post_type'];
		$order=(isset($_POST['order'])&&$_POST['order'])?$_POST['order']:'';
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
		$cat_id=array($category);

		$order.=','.$post_id;

		update_option('pexeto_order'.$category.$post_type, $order);

		//set the category to the item
		wp_set_object_terms($post_id, $cat_id, $post_type.$suffix );


		$prefix_length=strlen($prefix);
		$post_keys=array_keys($data);
		foreach($post_keys as $key){
			//if this is a custom field (not a setting field)
			if(substr($key, 0, $prefix_length)==$prefix && $key!=$prefix.'_title' && $key!=$prefix.'_content'){
				add_post_meta($post_id, $key, $data[$key]);
			}
		}

		$post=get_post($post_id);
		return $post;
	}

	/**
	 * Edits a post (item).
	 * @param $data the data that corresponds to the post such as ID, title and other custom meta fields
	 * @param $prefix the custom meta id prefix, so that these fields can be distinguished apart the other fields in the post
	 */
	public function edit_post($data, $prefix){
		$itemid=(int)$data['itemid'];
		$edited_post = array();
		$toEdit=false;  //whether the single post should be edited (if the title and content are set)

		foreach ($data as $key => $value){
			if(strpos($key, $prefix)!==false){
				//this is a custom value, insert it
				if($key==$prefix.'_title'){
					$edited_post['title'] = $value;
					$toEdit=true;
				}elseif($key==$prefix.'_content'){
					$edited_post['post_content'] = $value;
					$toEdit=true;
				}else{
					update_post_meta($itemid, $key, $value);
				}
			}
		}

		if($toEdit){
			wp_update_post( $edited_post );
		}
	}

	/**
	 * Deletes a term (instance) and all the items (posts) that belong to it.
	 * @param $id the ID of the term
	 * @param $taxonomy the taxonomy it belongs to
	 * @param $post_type the post type of the items that belong to this term
	 */
	public function delete_term($id, $taxonomy,$post_type){
		$slug=get_term($id, $taxonomy)->slug;
		
		$posts = get_posts(array('post_type' => $post_type,
		$taxonomy=>$slug));

		//delete the posts
		foreach($posts as $post){
			wp_delete_post($post->ID);
		}

		//delete the category
		wp_delete_term( $id, $taxonomy);
	}

}