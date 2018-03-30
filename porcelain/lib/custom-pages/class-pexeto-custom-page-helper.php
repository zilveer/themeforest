<?php
/**
 * Includes general functions used for the custom pages and their custom posts.
 */
class PexetoCustomPageHelper {

	/**
	 * Creates an ordered post list - gets the unordered posts and the order
	 * string saved as option that corresponds to those post group.
	 *
	 * @param array   $posts    the posts to be ordered
	 * @param unknown $category the category the posts belong to
	 * @return an array of the posts that ordered according to the saved order
	 */
	public static function get_ordered_post_list( $posts, $category, $posttype ) {
		$new_post_array=array();

		$order=explode( ',', get_option( 'pexeto_order'.$category.$posttype ) );
		if ( sizeof( $order )!=sizeof( $posts ) ) {
			return $posts;
		}else {
			//make the post array key the ID of the post so that it can be
			//accessed by ID
			foreach ( $posts as $post ) {
				$new_post_array[$post->ID]=$post;
			}

			foreach ( $order as $index ) {
				$ordered_post_array[]=$new_post_array[$index];
			}
		}

		return $ordered_post_array;
	}

	/**
	 * Returns all the main sliders data that are registered for the theme.
	 */
	public static function get_custom_sliders( $custom_pages, $slider_type ) {
		$sliders=array();

		foreach ( $custom_pages as $id=>$page ) {
			if ( $page->type==$slider_type ) {
				$sliders[]=array( 'id'=>$id, 'name'=>$page->page_name, 'class'=>$id );
			}
		}

		return $sliders;
	}

	/**
	 * Generates arrays containing all the sliders names, so that this data
	 * would be used in an drop down select.
	 *
	 * @param array   $custom_pages array containing all the custom page objects
	 * @param string  $slider_type  the ID of the slider type
	 * @return array               containing the slider data, including the
	 * default no slider and static image options
	 */
	public static function get_created_sliders( $custom_pages, $slider_type ) {
		$pexeto_slider_data=array();
		$pexeto_sliders=self::get_custom_sliders( $custom_pages, $slider_type );

		$pexeto_slider_data[]= array( "name"=>"None", "id"=>"none" );
		$pexeto_slider_data[]= array( "name"=>"Static Image", "id"=>"static" );


		foreach ( $pexeto_sliders as $slider ) {
			$slider_id=$slider['id'];

			//the slider caption that will be shown in a select box as disabled
			$pexeto_slider_data[]=array(
				'id'=>'disabled',
				'name'=>$slider['name'],
				'class'=>'caption'
			);

			$terms=get_terms( $slider_id.PexetoCustomPage::term_suffix,
				array( 'hide_empty'=>false, 'orderby'=>'id', 'order'=>'desc' ) );

			//display all the instances of the page
			foreach ( $terms as $term ) {
				$name=$term->name==PexetoCustomPage::default_term ?
					$term->name.' '.$slider['name'] : $term->name;
				$pexeto_slider_data[]=array(
					'id'=>self::generate_slider_id( $slider_id, $term->term_id ),
					'name'=>ucfirst( $name )
				);
			}
		}
		return $pexeto_slider_data;
	}

	/**
	 * Generates an unique string for a slider ID combined from the slider
	 * post type and the category ID.
	 *
	 * @param string $name    the name (post type) of the slider
	 * @param int $term_id the ID of the term the slider posts will belong to
	 * @return unique string in the form name:term_id
	 */
	public static function generate_slider_id( $name, $term_id ) {
		return $name.':'.$term_id;
	}

	/**
	 * Returns the slider posts.
	 *
	 * @param string  $id unique ID in the form posttype:term_id
	 * (post type + term ID separated by ":")
	 * @return an array containing the slider data including the custom slider posts
	 */
	public static function get_slider_data( $id ) {
		global $pexeto;

		$parts = self::get_slider_data_parts( $id );
		$post_type=$parts[0];
		$category=$parts[1];

		$post_data = self::get_instance_data( $post_type, $category );
		$post_data['filename']=$pexeto->custom_pages[$post_type]->file_name;

		return $post_data;
	}

	/**
	 * Retrieves an instance data - the items (posts) that have been added to
	 * a custom data instance.
	 *
	 * @param string  $post_type the post type of the custom data object
	 * @param string  $category  the ID of the category
	 * @param string  $by_field the field of the category that is passed, allowed
	 * values id, name, slug
	 * @return array  containing the instances data
	 */
	public static function get_instance_data( $post_type, $category, $by_field='id' ) {
		global $pexeto;

		$taxonomy=$post_type.PexetoCustomPage::term_suffix;

		if($by_field == 'id'){
			//get the actual term ID, if it's been split it will return the new term ID
			$category = pexeto_get_actual_term_id( $category, $taxonomy);
		}

		$term = get_term_by( $by_field, $category, $taxonomy );

		$args=array( 'numberposts' => -1, 'post_type' => $post_type );

		if($term){
			$args[$taxonomy] = $term->slug;
		}

		$posts = get_posts( $args );
		$term_id = isset($term) && isset($term->term_id) ? $term->term_id : -1;
		$ordered_posts=self::get_ordered_post_list( $posts, $term_id, $post_type );

		$post_data=array();


		$post_data['posts']=$ordered_posts;

		return $post_data;
	}

	/**
	 * Retrieves the slider post type and taxanomy by its ID.
	 *
	 * @param string  $id the ID of the slider in the format posttype:term_id
	 * @return array     first element contains the post type of the slider
	 * data and the second one contains the term ID
	 */
	public static function get_slider_data_parts( $id ) {
		return explode( ':', $id );
	}

	/**
	 * Returns a custom page instance by setting its custom post type. Looks
	 * in the global $pexeto->custom_pages array which contains all the custom
	 * page instances.
	 *
	 * @param string $post_type the post type pof the custom page
	 * @return PexetoCustomPage instance
	 */
	public static function get_custom_page_by_type( $post_type ) {
		global $pexeto;

		return $pexeto->custom_pages[$post_type];
	}

}
