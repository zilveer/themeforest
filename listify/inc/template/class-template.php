<?php

class Listify_Template {
	
	public function __construct() {
		$this->includes = array(
			'class-template-page-templates.php'
		);

		$this->includes();
		$this->setup();
	}

	private function includes() {
		foreach ( $this->includes as $file ) {
			require( trailingslashit( dirname( __FILE__) ) . $file );
		}
	}

	private function setup() {
		$this->page_templates = new Listify_Template_Page_Templates;
	}

}

$GLOBALS[ 'listify_template' ] = new Listify_Template();
