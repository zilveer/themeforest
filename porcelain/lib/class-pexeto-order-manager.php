<?php

/**
 * Order manager class. Adds a page that allows to set a custom order to the
 * posts from a set post type.
 */
class PexetoOrderManager {

	protected $post_type;
	protected $nonce_id = 'custom_order_nonce';
	public $title = 'Custom Order';
	const slug = '_custom_order';

	/**
	 * Main constructor.
	 *
	 * @param string  $post_type the post type of the posts that will be ordered
	 */
	function __construct( $post_type ) {
		$this->post_type = $post_type;
	}

	/**
	 * Inits the main functionality - adds the actions.
	 */
	public function init() {
		add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
		add_action( 'wp_ajax_pexeto_save_custom_order_'.$this->post_type,
			array( $this, 'process_ajax_request' ) );
	}

	/**
	 * Adds a separate page for this functionality, in the post type section
	 * of the main admin menu.
	 */
	public function add_menu_page() {
		add_submenu_page(
			'edit.php?post_type='.$this->post_type,
			$this->title,
			$this->title,
			'edit_posts',
			$this->post_type.self::slug,
			array( $this, 'init_page' ) );
	}

	/**
	 * Inits the page functionality.
	 */
	public function init_page() {
		$this->print_posts();
	}

	/**
	 * Prints the posts in the page.
	 */
	protected function print_posts() {
		$posts = get_posts( array(
				'post_type'=>$this->post_type,
				'nopaging'=>true,
				'orderby'=>'menu_order title',
				'order'=>'ASC'
			) );

		$html='<div id="custom-order-wrapper">
		<h2 class="co-title"><span><i aria-hidden="true" class="icon-sortable"></i></span>'
		.$this->post_type.' '.$this->title.'</h2>
		<p>Drag and drop the items to change their default order and click on the
		"Save Order" button to save the changes. This order will be applied to
		the items in the displaying page when the page is set to order its items
		by "Custom order". Changing the order of the listed items will update the
		"Order" field of each of the items.</p>
		<a id="co-save-btn" class="button">Save Order</a>
		<ul id="co-ul" data-post_type="'.$this->post_type.'"
		data-nonce="'.wp_create_nonce( $this->nonce_id ).'">';

		foreach ( $posts as $p ) {
			$html.='<li data-order="'.$p->menu_order.'" data-id="'
				.$p->ID.'"><span class="co-number">'.$p->menu_order.'</span>'
				.'<span class="co-icon"><i aria-hidden="true" class="icon-sortable"></i></span>'
				.'<span class="co-post-title">'.$p->post_title.'</span></li>';
		}

		$html.='</ul></div>';

		echo $html;
	}

	/**
	 * AJAX request handler function - when the save button is clicked
	 * calls the save order functionality. Echoes a JSON object which contains
	 * an element with key "success" which sets whether the items were saved
	 * successfully.
	 */
	public function process_ajax_request() {
		$res = array( 'success'=>false );

		check_ajax_referer( $this->nonce_id , 'nonce' );

		if ( isset( $_POST['order'] ) ) {
			$order = $_POST['order'];
			$this->save_order( $order );
			$res['success']=true;
		}

		echo json_encode( $res );
		exit();
	}

	/**
	 * Saves the new order of the items.
	 *
	 * @param array   $order should contain the IDs of the posts in the order
	 * in which they should be saved
	 */
	public function save_order( $order ) {
		for ( $i=0; $i<sizeof( $order ); $i++ ) {
			$post = array();
			$post['ID'] = intval( $order[$i] );
			$post['menu_order'] = $i+1;

			// Update the post into the database
			wp_update_post( $post );
		}
	}
}
