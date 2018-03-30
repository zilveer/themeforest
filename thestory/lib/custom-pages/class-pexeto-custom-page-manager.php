<?php

require_once 'class-pexeto-custom-page-helper.php';
require_once 'class-pexeto-custom-data-manager.php';
require_once 'class-pexeto-custom-page-builder.php';

/**
 * Custom page manager - this class contains the main functionality for building 
 * custom pages - creating their main structure.
 *
 * @author Pexeto
 *
 */
class PexetoCustomPageManager {

	public $custom_page=null;
	public $templater=null;
	public $taxonomy='';
	public $suffix='';
	public $default='';
	const custom_prefix = 'custom_';
	const nonce = 'pexeto-custom-page';

	/**
	 * Main constructor
	 *
	 * @param $custom_page a custom page object whose data will be used 
	 * to build the page
	 * @param $suffix      the custom term suffix
	 * @param $default     the default term name for the custom post 
	 * type category
	 */
	function __construct( $custom_page, $suffix, $default) {
		$this->custom_page=$custom_page;
		$this->suffix=$suffix;
		$this->default=$default;
	}

	/**
	 * Builds a page - calls the main functionality for creating the main structure of the
	 * custom page.
	 */
	public function build_page() {
		$title='Default '.$this->custom_page->page_name;
		$category = get_term_by( 'name', $this->default, $this->custom_page->post_type.$this->suffix )->term_id;
		$this->templater=new PexetoCustomPageBuilder( $this->default );
		$this->taxonomy=$this->custom_page->post_type.$this->suffix;
		$terms=get_terms( $this->taxonomy, array( 'hide_empty'=>false, 'orderby'=>'id', 'order'=>'desc' ) );

		echo '<div class="custom-page-wrapper">';
		$this->print_heading();

		//display all the instances of the page
		foreach ( $terms as $term ) {
			echo $this->templater->get_before_custom_section( $term->name );
			$this->print_custom_section( $term->name, $term->term_id );
			echo $this->templater->get_after_custom_section();
		}

		echo '<input type="hidden" value="'.$this->taxonomy.'" id="taxnonomy_id" />
			  <input type="hidden" value="'.$this->custom_page->post_type.'" id="post_type" />
			  <input type="hidden" value="'.wp_create_nonce( self::nonce ).'" id="pexeto_nonce" />
		      </div>';
	}

	/**
	 * Prints the heading of the custom page- the main title and an "Add instance" button.
	 */
	protected function print_heading() {
		$html='';
		$html.='<h1>'.$this->custom_page->page_name.'</h1>';

		//if the page allows multiple instances, add an "Add instance" button
		if ( $this->custom_page->allow_multiinstance ) {
			$html.='<a class="pex-button new-instance-button"><span>'
			.'<i class="icon-plus" aria-hidden="true"></i>Add New '
			.$this->custom_page->set_name.'</span></a>';
		}

		echo $html;
	}

	/**
	 * Prints the section that contains the form for adding new items
	 *
	 * @param $title    the title of the section
	 * @param $category the custom category ID that corresponds to the custom section
	 */
	protected function print_custom_section( $title, $category ) {

		//build the section template
		echo $this->templater->get_custom_page_form_template( 
			$title, 
			$category, 
			$this->custom_page, 
			self::custom_prefix );
		$this->print_items( $category );

	}

	/**
	 * Prints the already added items to a section
	 *
	 * @param $category the custom category ID that corresponds to the custom section
	 */
	protected function print_items( $category ) {
		$args=array( 'numberposts' => -1,
			'post_type' => $this->custom_page->post_type,
			$this->taxonomy=>get_term( $category, $this->taxonomy )->slug );
		$posts = get_posts( $args );

		$ordered_posts=PexetoCustomPageHelper::get_ordered_post_list( 
			$posts, 
			$category, 
			$this->custom_page->post_type );

		$html='<ul class="sortable pexeto-sortable">';
		foreach ( $ordered_posts as $post ) {
			$html.=$this->templater->get_custom_page_list_template( 
				$post, 
				$this->custom_page, 
				self::custom_prefix );
		}

		$html.='</ul>';
		echo $html;
	}

}
