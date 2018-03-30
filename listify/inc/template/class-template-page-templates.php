<?php

class Listify_Template_Page_Templates {

	public function __construct() {
		add_filter( 'theme_page_templates', array( $this, 'visual_composer' ) );
	}

	public function visual_composer( $page_templates ) {
		if ( listify_has_integration( 'visual-composer' ) ) {
			return $page_templates;
		}

		unset( $page_templates[ 'page-templates/template-home-vc.php' ] );

		return $page_templates;
	}

}
