<?php

/**
 * Contains all the main functionality for initializing and managing the meta 
 * functionality.
 *
 * @author Pexeto
 */
class PexetoMetaManager {

	protected $post_type;
	protected $meta_boxes = array();
	protected $meta;
	public $theme_name;
	public $meta_obj = null;
	public $nonce_id='pexeto-meta';

	/**
	 * Default constructor.
	 *
	 * @param array   $meta       an array containing all the meta fields that
	 *  will be printed.
	 * @param string  $theme_name the name of the theme
	 */
	function __construct( $meta, $theme_name ) {
		$this->meta=$meta;
		$this->theme_name = $theme_name;

		$this->meta_obj = new PexetoMeta();
	}

	/**
	 * Inits the meta functionality. Adds the main actions.
	 */
	public function init() {
		add_action( 'add_meta_boxes', array( &$this, 'init_meta_boxes' ) );
		add_action( 'save_post', array( &$this, 'save_data' ) );
	}

	/**
	 * Initializes the meta boxes. Calls a function to add the main section 
	 * which will contain the meta fields in the post.
	 */
	public function init_meta_boxes() {
		global $post;
		if(empty($post)){
			return;
		}

		$this->set_meta_data();

		$widgets_builder = new PexetoMetaBuilder( $this->meta_obj, $this->meta_boxes, $this->nonce_id );

		if ( !empty( $this->meta_boxes ) ) {
			add_meta_box( 
				'pexeto-meta-'.$this->post_type.'-boxes', 
				'<div class="icon-small"></div> '.$this->theme_name.' '.$this->post_type.' SETTINGS', 
				array( $widgets_builder, 'print_meta_boxes' ), 
				$this->post_type, 
				'normal', 
				'high' );
		}
	}

	/**
	 * Retrieves the current meta object that is used to manage the meta data.
	 *
	 * @return PexetoMeta object
	 */
	public function get_meta_obj() {
		return $this->meta_obj;
	}

	/**
	 * Loads all the needed data - post ID, post type and the current meta array
	 * depending on the post type.
	 */
	protected function set_meta_data() {
		global $current_screen, $post;

		//set the meta boxes for the current page
		if ( empty( $this->meta_boxes ) ) {
			$post_type = $current_screen->post_type;
			if ( isset( $this->meta[$post_type] ) ) {
				$this->meta_boxes = $this->meta[$post_type];
			}
		}

		//set the post ID
		if ( empty( $this->post_id ) ) {
			$this->post_id = $post->ID;
			$this->meta_obj->post_id = $post->ID;
		}

		//set the post type
		if ( empty( $this->post_type ) ) {
			$this->post_type = $current_screen->post_type;
			$this->meta_obj->post_type = $current_screen->post_type;
		}

	}

	/**
	 * Saves the meta data.
	 */
	public function save_data() {
		global $post;

		if ( isset( $post ) ) {
			$this->set_meta_data();
			$this->meta_obj->save_data( $this->post_id, $this->post_type, $this->nonce_id );
		}
	}

	/**
	 * Sets the meta fields array.
	 *
	 * @param array   $meta the array containing the meta fields.
	 */
	public function set_meta( $meta ) {
		$this->meta = $meta;
		$this->meta_obj->set_fields( $meta );
	}

}
