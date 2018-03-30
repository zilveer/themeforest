<?php

class PeThemeFormElementThumbnails extends PeThemeFormElement {
	
	public function registerAssets() {
		parent::registerAssets();
		peTheme()->asset->registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.thumbnails.js",array("jquery","pe_theme_transform","pe_theme_utils_geom"),"pe_theme_field_thumbnails");
		PeThemeAsset::addStyle("framework/css/jquery.theme.field.thumbnails.css",null,"pe_theme_field_thumbnails");
		wp_enqueue_script("pe_theme_field_thumbnails");
		wp_enqueue_style("pe_theme_field_thumbnails");
	}

	protected function template() {
		$html = <<<EOT
<div class="option option-thumbnails">
    <div class="section">
        <div class="element">
			<div class="pe-theme-thumbnails" id="[ID]" data-orig="[ORIG]">
				[THUMBNAILS]
			</div>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>[SCRIPT]
EOT;
		return $html;
	}

	public function jsInit() {
		return 'jQuery("#[ID]").peFieldThumbnails();';
	}

	protected function addTemplateValues(&$data) {

		$thumbs = $this->data["thumbs"];
		$orig = $this->data["orig"];
		$data["[ORIG]"] = $orig;
		$buffer =& $data["[THUMBNAILS]"];
		
		$buffer = "";
		$image =& peTheme()->image;

		$pw = 400;

		list($img,$w,$h) = $image->aq_resize($orig,$pw,null,null,false);
		$pw = $w;
		$ph = $h;

		$w = 304;
		$h = 228;

		$buffer .= sprintf('<div class="pe-theme-editor" data-nonce="%s" data-id="%s" data-scale="%s" data-w="%s" data-h="%s" data-pw="%s" data-ph="%s"><img src="%s"/><div class="pe-controls"><input type="button" id="pe-theme-done" class="ob_button" value="%s"/><input type="button" id="pe-theme-cancel" class="ob_button" value="%s"/></div></div>',$this->data["nonce"],$this->data["id"],$this->data["width"]/$pw,$w,$h,$pw,$ph,$img,__("save",'Pixelentity Theme/Plugin'),__("cancel",'Pixelentity Theme/Plugin'));

		foreach ($thumbs as $t => $size) {

			list($tw,$th,$mtime) = $size;
			$key=sprintf("%sx%s",$tw,$th);

			$buffer .= sprintf('<div class="pe-theme-thumbnail">');
			$buffer .= sprintf('<h5>%sx%s</h5>',$tw,$th);
			$buffer .= sprintf('<div class="pe-theme-preview" data-size="%sx%s" style="width:%spx;height:%spx"><div style="width:%spx;height:%spx"><img src="%s?t=%s"/></div></div>',$tw,$th,$w,$h,$tw,$th,$t,$mtime);
			$value = empty($this->data["value"][$key]) ? "" : $this->data["value"][$key];
			$buffer .= sprintf('<input type="hidden" name="%s[%s]" value="%s" data-orig="%s" />',$data['[NAME]'],$key,$value,$value);
			$buffer .= sprintf('</div>');
		}

		if (!isset($this->data["noscript"])) {
			$data['[SCRIPT]'] = sprintf('<script type="text/javascript">%s</script>',str_replace("[ID]",$data['[ID]'],$this->jsInit()));
		} else {
			$data['[SCRIPT]'] = "";
		}

	}

}

?>
