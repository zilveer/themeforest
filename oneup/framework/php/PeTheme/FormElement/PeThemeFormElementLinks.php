<?php

class PeThemeFormElementLinks extends PeThemeFormElementSidebars {

	protected function template() {
		return str_replace("pe_field_sidebar","pe_field_links",parent::template());
	}

}

?>
