<?php

class PeThemeFormElementSelectColumns extends PeThemeFormElementSelect {
	
	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.selectColumns.js",array(),"pe_theme_field_selectColumns");
		wp_enqueue_script("pe_theme_field_selectColumns");
	}

	protected function template() {
		$html = parent::template();
		$html .= <<<EOT
	<script>
		jQuery("#[ID]").peFieldSelectColumns();
	</script>
EOT;
		return $html;
	}

}

?>
