<?php

class PeThemeFormElementItems extends PeThemeFormElementUpload {

	private static $icon = false;

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.items.js",array("pe_theme_utils","jquery-ui-sortable","json2"),"pe_theme_field_items");
		wp_enqueue_script("pe_theme_field_items");

		// prototype.js alters JSON2 behaviour, it shouldn't be loaded in our admin page anyway but
		// if other plugins are forcing it in all wordpress admin pages, we get rid of it here.
		wp_deregister_script("prototype");

		if (!self::$icon) {
			// we need icon field assets to be enqueued, this is done only once 
			// by storing the object into a static class variable
			self::$icon = new PeThemeFormElementIcon(null,null,$null);
			self::$icon->registerAssets();
		}
		
	}
	
	protected function template() {

		if (!empty($this->data["options"]) && is_array($this->data["options"])) {
			$input = '<select>';
			foreach ($this->data["options"] as $label => $value) {
				$input .= sprintf('<option value="%s">%s</option>',esc_attr($value),$label);
			}
			$input .= '</select>';
		} else {
			$input = '<input type="text" class="upload pe_sidebar_title" />';
		}

		$html = <<<EOT
<div class="option option-input pe_field_items [AUTO_CLASS]" id="[ID]" data-auto="[AUTO]" data-unique="[UNIQUE]" data-name="[NAME]" data-id="[ID]" data-legend="[LEGEND]">
    [LABEL]
    <div class="section">
        <div class="element">
			$input
			<input type="button" class="ob_button pe_sidebar_new" value="[BUTTON_LABEL]"/>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
    <div class="pe_field_items_data">
		<div class="[SORTABLE] [EDITABLE]" data-items="[TBODY]" data-fields="[FIELDS]"></div>
	</div>

	</div>[SCRIPT]
EOT;

		return $html;
	}

	public function jsInit() {
		return 'jQuery("#[ID]").peFieldItems({api:true});';
	}

	protected function addTemplateValues(&$data) {

		if (!isset($this->data["noscript"])) {
			$data['[SCRIPT]'] = sprintf('<script type="text/javascript">%s</script>',str_replace("[ID]",$data['[ID]'],$this->jsInit()));
		} else {
			$data['[SCRIPT]'] = "";
		}

		$sidebars = isset($this->data["value"]) ? $this->data["value"] : false;
		if (!$sidebars && is_array($data["[DEFAULT]"])) {
			$sidebars = $data["[DEFAULT]"];
		}
		$data["[SORTABLE]"] = isset($this->data["sortable"]) && $this->data["sortable"] ? "ui-sortable" : "";
		$data["[EDITABLE]"] = isset($this->data["editable"]) && $this->data["editable"] ? "ui-editable" : "";
		$data["[UNIQUE]"] = isset($this->data["unique"]) && ($this->data["unique"] === false) ? "no" : "yes";
		if (isset($this->data["auto"]) && $this->data["auto"]) {
			$data["[AUTO_CLASS]"] = "pe_auto_values";
			$data["[AUTO]"] = $this->data["auto"];
		} else {
			$data["[AUTO_CLASS]"] = $data["[AUTO]"] = "";
		}
		$data["[BUTTON_LABEL]"] = isset($this->data["button_label"]) ? $this->data["button_label"] : __("Add new",'Pixelentity Theme/Plugin');

		if (!empty($data["[LABEL]"])) {
			$data["[LABEL]"] = "<h4>".$data["[LABEL]"].(empty($data["[TOOLTIP]"]) ? "" : $data["[TOOLTIP]"] )."</h4>";
		}

		$name = $data["[NAME]"];
		$buffer =& $data["[TBODY]"];
		$buffer = "";
		if ($sidebars && is_array($sidebars) && count($sidebars) > 0) {
			$buffer = esc_attr(json_encode($sidebars));
		}

		$data["[FIELDS]"] = esc_attr(json_encode($this->data["fields"]));
		$data["[LEGEND]"] = isset($this->data["legend"]) && $this->data["legend"] ? "yes" : "";

	}

}

?>
