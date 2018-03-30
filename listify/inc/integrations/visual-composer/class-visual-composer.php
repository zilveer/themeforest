<?php

class Listify_Visual_Composer extends Listify_Integration {

	public function __construct() {
		$this->includes = array();
		$this->integration = 'visual-composer';

		parent::__construct();
	}

	public function setup_actions() {
		add_filter( 'theme_page_templates', array( $this, 'remove_page_template' ) );
	}

	public function remove_page_template( $page_templates ) {
		if ( ! apply_filters( 'listify_use_vc', false ) ) {
			unset( $page_templates[ 'page-templates/template-home-vc.php' ] );
		}

		return $page_templates;
	}

}

$GLOBALS[ 'listify_visual_composer' ] = new Listify_Visual_Composer();
