<?php

class PeThemeFormElementSidebars extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.sidebars.js",array("pe_theme_utils","jquery-ui-sortable","json2"),"pe_theme_field_sidebars");
		wp_enqueue_script("pe_theme_field_sidebars");

		// prototype.js alters JSON2 behaviour, it shouldn't be loaded in our admin page anyway but
		// if other plugins are forcing it in all wordpress admin pages, we get rid of it here.
		wp_deregister_script("prototype");
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
<div class="option option-input pe_field_sidebar [AUTO_CLASS]" id="[ID]" data-auto="[AUTO]" data-unique="[UNIQUE]" data-name="[NAME]" data-id="[ID]">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
			$input
			<input type="button" class="ob_button pe_sidebar_new" value="[BUTTON_LABEL]"/>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
    <table cellspacing="0">
        <thead>
            <tr>
				<th class="col-title" colspan="4">Title</th>
            </tr>
        </thead>
		<tbody class="[SORTABLE] [EDITABLE]" data-items="[TBODY]">
		</tbody>
	</table>

	</div>[SCRIPT]
EOT;

		return $html;
	}

	public function jsInit() {
		return 'jQuery("#[ID]").peFieldSidebars({api:true});';
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

		$name = $data["[NAME]"];
		$buffer =& $data["[TBODY]"];
		$buffer = "";
		if ($sidebars && is_array($sidebars) && count($sidebars) > 0) {
			$buffer = esc_attr(json_encode($sidebars));
		}

	}

}

?>
