<?php

class PeThemeShortcodeProperties extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "prop";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Properties",'Pixelentity Theme/Plugin');
		$this->description = __("Item properties",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "size" =>
							  array(
									"label" => __("Number of Properties",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"single" => true,
									"description" => __("Select the number of property-value pairs the table will contain",'Pixelentity Theme/Plugin'),
									"options" => range(1,10)
									)
							  );
	}

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.shortcode.properties.js",array(),"pe_theme_shortcode_properties");
		wp_enqueue_script("pe_theme_shortcode_properties");
	}

	protected function script() {
		$html = <<<EOT
<script type="text/javascript">
jQuery.pixelentity.shortcodes.$this->trigger = jQuery("#{$this->trigger}_size_").peShortcodeProperties({tag:"{$this->trigger}"});
</script>
EOT;
		echo $html;
	}

	public function render() {
		parent::render();
		$this->script();
	}

	public function output($atts,$content=null,$code="") {
		extract($atts,EXTR_PREFIX_ALL,"sc");
		$footer = "";
		$header = "";
		if (isset($sc_first)) {
			$header = '<div class="properties">';
			$class = "prop first";
			$sc_name = $sc_first;
		} elseif (isset($sc_last)) {
			$class = "prop last";
			$sc_name = $sc_last;
			$footer = "</div>";
		} else {
			$class = "prop";
		}
		if ($content) {
			$content = $this->parseContent($content);
		}		
		$html = <<<EOL
$header<div class="$class"><span class="name">$sc_name</span><span class="val">$content</span></div>$footer
EOL;
		
return trim($html);
	}


}

?>
