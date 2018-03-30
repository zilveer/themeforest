<?php

$pexeto_custom_ajax = new PexetoCustomPageAjax(
	PexetoCustomPageManager::nonce,
	PexetoCustomPage::term_suffix,
	PexetoCustomPageManager::custom_prefix,
	PexetoCustomPage::default_term,
	PexetoCustomPage::user_capability );

add_action( 'wp_ajax_pexeto_add_post', array( $pexeto_custom_ajax, 'insert_item' ) );
add_action( 'wp_ajax_pexeto_insert_post', array( $pexeto_custom_ajax, 'insert_item' ) );
add_action( 'wp_ajax_pexeto_add_instance', array( $pexeto_custom_ajax, 'add_instance' ) );
add_action( 'wp_ajax_pexeto_save_order', array( $pexeto_custom_ajax, 'save_order' ) );
add_action( 'wp_ajax_pexeto_detele_item', array( $pexeto_custom_ajax, 'delete_item' ) );
add_action( 'wp_ajax_pexeto_edit_item', array( $pexeto_custom_ajax, 'edit_item' ) );
add_action( 'wp_ajax_pexeto_detele_instance', array( $pexeto_custom_ajax, 'delete_instance' ) );
add_action( 'wp_ajax_pexeto_get_edit_form', array ($pexeto_custom_ajax, 'get_edit_form'));

/**
 * This is a class that contains AJAX request handler functions related with the
 * custom page functionality.
 */
class PexetoCustomPageAjax {

	protected $custom_page = null;
	protected $nonce = '';
	protected $custom_prefix='';
	protected $term_suffix='';
	protected $default_term = '';
	protected $templater = null;

	/**
	 * Main class consructor.
	 *
	 * @param string  $nonce         the nonce ID string
	 * @param string  $term_suffix   custom term suffix for the current custom
	 * page
	 * @param string  $custom_prefix the prefix of the fields in the form
	 * @param string  $default_term  the default term for the custom page post
	 * type
	 * @param string  $user_cap      the user capability that is allowed to
	 * manage the custom page data
	 */
	function __construct( $nonce, $term_suffix, $custom_prefix, $default_term, $user_cap ) {
		$this->nonce = $nonce;
		$this->term_suffix = $term_suffix;
		$this->custom_prefix = $custom_prefix;
		$this->default_term = $default_term;

		$this->templater = new PexetoCustomPageBuilder( $this->default_term );
		$this->data_manager = new PexetoCustomDataManager( $user_cap );
	}

	/**
	 * Inserts a post - this is the function that is called via AJAX request, when
	 * a new custom post should be inserted.
	 */
	public function insert_item() {
		check_ajax_referer( $this->nonce, 'nonce' );

		global $pexeto, $current_user;

		$post_type=$_POST['post_type'];
		$custom_page=$pexeto->custom_pages[$post_type];
		//insert the post
		$post=$this->data_manager->insert_post( 
			$_POST, $custom_page, 
			$this->custom_prefix, 
			$this->term_suffix );

		if ( $post ) {
			//get the display template for the inserted post
			echo $this->templater->get_custom_page_list_template( 
				$post, 
				$custom_page, 
				$this->custom_prefix );
		}else {
			echo "-1";
		}
		exit;
	}

	public function get_edit_form(){
		global $pexeto, $current_user;

		if(!isset($_GET['post_id'])){
			echo '-1';
			exit;
		}

		$post_type=$_GET['post_type'];
		$post_id = $_GET['post_id'];
		$custom_page=$pexeto->custom_pages[$post_type];

		$html = $this->templater->get_custom_page_form_template( '', '', $custom_page, $this->custom_prefix, $post_id );

		echo $html;

		exit;

	}


	/**
	 * Creates a new instance of a custom page item - it is related with inserting a new
	 * category from the selected custom post type.
	 */
	public function add_instance() {
		//check the nonce field for security
		check_ajax_referer( $this->nonce, 'nonce' );

		$custom_page = PexetoCustomPageHelper::get_custom_page_by_type( $_POST['post_type'] );
		if ( !isset( $_POST["name"] ) || !isset( $_POST["taxonomy"] ) || empty( $custom_page ) ) {
			echo '-1';
			exit;
		}

		//insert a new category(term) for the custom post type
		$res=$this->data_manager->insert_instance( $_POST['name'], $_POST['taxonomy'] );

		if ( !$res ) {
			echo '-1';
		}else {
			$html=$this->templater->get_before_custom_section( $_POST['name'] );
			$html.=$this->templater->get_custom_page_form_template( 
				$_POST['name'], 
				$res['term_id'], 
				$custom_page, 
				$this->custom_prefix );
			$html.='<ul class="sortable pexeto-sortable"></ul>'.$this->templater->get_after_custom_section();
			echo $html;
		}
		exit;
	}

	/**
	 * Saves the new order of the items - should be called via AJAX post request,
	 * the following parameters should be set in the request:
	 * - order - the new order to be saved (as a string, separated by commas)
	 * - category - the category the items to be ordered belong to
	 */
	public function save_order() {
		//check the nonce field for security
		check_ajax_referer( $this->nonce, 'nonce' );

		if ( isset( $_POST['order'] ) && $_POST['order']
			&& isset( $_POST['category'] ) && $_POST['category']
			&& isset( $_POST['posttype'] ) ) {
			update_option( 'pexeto_order'.$_POST['category'].$_POST['posttype'], $_POST['order'] );
		}
	}

	/**
	 * Deletes an item and changes the saved item order not to contain this item.
	 * Should be called via AJAX post request, the following parameters should be
	 * set in the request:
	 * - itemid - the ID of the item to be deleted
	 * - category - the category the item belongs to
	 */
	public function delete_item() {
		//check the nonce field for security
		check_ajax_referer( $this->nonce, 'nonce' );

		if ( isset( $_POST['itemid'] )
			&& isset( $_POST['category'] )
			&& isset( $_POST['posttype'] ) ) {
			$res= $this->data_manager->delete_post(
				$_POST['itemid'],
				$_POST['category'],
				$_POST['posttype'] );
			if ( !$res ) echo '-1';
		}else {
			echo '-1';
		}
		exit;
	}

	/**
	 * Edits an item - Should be called via AJAX post request,
	 * the following parameters should be set in the request:
	 * - itemid - the ID of the item to be edited
	 */
	public function edit_item() {
		//check the nonce field for security
		global $pexeto;
		
		check_ajax_referer( $this->nonce, 'nonce' );
		$custom_page=$pexeto->custom_pages[$_POST['post_type']];

		if ( isset( $_POST['itemid'] )&& $_POST['itemid'] ) {
			$res=$this->data_manager->edit_post( $_POST, $this->custom_prefix, $custom_page);
		}

		if(isset($res) && $res){
			$post = get_post($_POST['itemid']);
			echo $this->templater->get_custom_page_list_template( 
				$post, 
				$custom_page, 
				$this->custom_prefix );
		}else{
			echo "-1";
		}

		exit;
	}

	/**
	 * Deletes a group of items with their parent instance. Should be called via
	 * AJAX request, the following parameters should be set in the request:
	 * - category - the category (term name) the slider represents
	 * - taxonomy - the taxonomy name
	 * - post_type - the type of the posts the slider contains
	 */
	public function delete_instance() {
		//check the nonce field for security
		check_ajax_referer( $this->nonce, 'nonce' );

		if ( isset( $_POST['category'] )&& isset( $_POST['taxonomy'] ) ) {
			$res=$this->data_manager->delete_instance(
				$_POST['category'],
				$_POST['taxonomy'],
				$_POST['post_type'] );
		}

		$r = isset( $res ) && $res ? "1" : "-1";
		echo $r;
		exit;
	}
}
