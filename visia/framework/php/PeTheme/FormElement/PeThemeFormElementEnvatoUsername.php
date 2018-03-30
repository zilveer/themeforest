<?php

class PeThemeFormElementEnvatoUsername  extends PeThemeFormElement {
	
	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.envatoUsername.js",array("jquery"),"pe_theme_field_envatoUsername");
		wp_enqueue_script("pe_theme_field_envatoUsername");
	}

	protected function template() {
		$html = <<<EOT
<div class="option option-input" style="display: none;">
    <h4>[LABEL]</h4>
    <div class="section">
        <div class="element">
            <input id="[ID]" type="text" value="[VALUE]" name="[NAME]" />
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
</div>
<script type="text/javascript">
jQuery(function () {
	jQuery("#[ID]").peFieldEnvatoUsername();
});
</script>
EOT;

		return $html;
	}
}

?>
