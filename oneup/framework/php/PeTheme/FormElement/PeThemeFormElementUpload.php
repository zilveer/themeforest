<?php

class PeThemeFormElementUpload extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();
		wp_enqueue_script("pe_theme_field_select");
		if (function_exists("wp_enqueue_media")) {
			PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.upload.v35.js",array(),"pe_theme_field_upload");
			wp_enqueue_media();
		} else {
			PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.upload.js",array(),"pe_theme_field_upload");
			wp_enqueue_script("thickbox");
			wp_enqueue_script("media-upload");
			wp_enqueue_style("thickbox");
		}
		wp_enqueue_script("pe_theme_field_upload");
	}

	protected function template() {
		$html = <<<EOT
<div class="option option-input">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
            <input id="[ID]" type="text" value="[VALUE]" name="[NAME]" class="upload [UPCLASS]" />
			<input id="upload_[ID]" class="upload_button" type="button" value="Upload" />
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>[SCRIPT]
EOT;

		return $html;
	}

	public function jsInit() {
		return 'jQuery("#[ID]").peFieldUpload();';
	}

	protected function addTemplateValues(&$data) {
		$data["[UPCLASS]"]="pepreview";
		if (!isset($this->data["noscript"])) {
			$data['[SCRIPT]'] = sprintf('<script type="text/javascript">%s</script>',str_replace("[ID]",$data['[ID]'],$this->jsInit()));
		} else {
			$data['[SCRIPT]'] = "";
		}
	}

}

?>
