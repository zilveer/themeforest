<?php

class PeThemeFormElementIcon extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();

		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.icon.js",array("jquery-ui-dialog","pe_theme_utils"),"pe_theme_field_icon");
		PeThemeAsset::addStyle("css/entypo-icon-font.css",array("wp-jquery-ui-dialog"),"pe_theme_admin_icon_font");
	   
		wp_localize_script("pe_theme_field_icon","pe_theme_field_icon",array("icons"=>PeGlobal::$const->data->icons));

		wp_enqueue_style("pe_theme_admin_icon_font");
		wp_enqueue_script("pe_theme_field_icon");

	}

	protected function template() {
		$html = <<<EOT
<div class="option option-icon">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
			<i class="icon-bookmarks"></i>
            <input id="[ID]" type="hidden" value="[VALUE]" name="[NAME]" data-icons="[ICONS]" class="" />
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>[SCRIPT]
EOT;

		return $html;
	}

	public function jsInit() {
		return 'jQuery("#[ID]").peFieldIcon();';
	}

	protected function addTemplateValues(&$data) {
		if (isset($this->data["options"])) {
			$icons = implode(",",$this->data["options"]);
			$data["[ICONS]"] = $icons != implode(",",PeGlobal::$const->data->icons) ? $icons : "";
		} else {
			$data["[ICONS]"] = "";
		}

		if (!isset($this->data["noscript"])) {
			$data['[SCRIPT]'] = sprintf('<script type="text/javascript">%s</script>',str_replace("[ID]",$data['[ID]'],$this->jsInit()));
		} else {
			$data['[SCRIPT]'] = "";
		}
	}

}

?>
