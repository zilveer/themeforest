<?php

class PeThemeShortcodeBS_Code extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "codehs";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Code Block (Syntax Highlighting)",'Pixelentity Theme/Plugin');
		$this->description = __("Add a Code Box",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "lang"=> 
							  array(
									"label" => __("Language",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => __("Language type of code block.",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("HTML",'Pixelentity Theme/Plugin') => "html",
										  __("CSS",'Pixelentity Theme/Plugin') => "css",
										  __("Javascript",'Pixelentity Theme/Plugin') => "js",
										  __("PHP",'Pixelentity Theme/Plugin') => "php",
										  __("XML",'Pixelentity Theme/Plugin') => "xml",
										  __("SQL",'Pixelentity Theme/Plugin') => "sql"
										  ),
									"default" => "html"
									),
							  "options"=> 
							  array(
									"label" => __("Options",'Pixelentity Theme/Plugin'),
									"type" => "CheckboxUI",
									"description" => __("Use vertical scrollbar / Show line numbers. If a vertical scrollbar is chosen, the code block's height is fixed as 350px",'Pixelentity Theme/Plugin'),
									"options" => 
									array(
										  __("Scrollbar",'Pixelentity Theme/Plugin') => "pre-scrollable",
										  __("Line Numbers",'Pixelentity Theme/Plugin') => "linenums"
										  )
									),
							  
							  "content" =>
							  array(
									"label" => __("Content",'Pixelentity Theme/Plugin'),
									"type" => "TextArea",
									"description" => __("Enter the content here.",'Pixelentity Theme/Plugin'),
									)
							  );
	}

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.shortcode.code.js",array(),"pe_theme_shortcode_code");
		wp_enqueue_script("pe_theme_shortcode_code");
	}

	protected function script() {
		$html = <<<EOT
<script type="text/javascript">
jQuery.pixelentity.shortcodes.$this->trigger = jQuery("#{$this->trigger}_content_").peShortcodeCode({lang:jQuery("#{$this->trigger}_lang_"),options:jQuery('input[id^="{$this->trigger}_options_"]')});
</script>
EOT;
		echo $html;
	}

	public function render() {
		parent::render();
		$this->script();
	}

		// not used
	public function output($atts,$content=null,$code="") {
		extract($atts);
		$lines = $lines == "yes" ? "linenums" : "";
		$scroll = $scroll == "yes" ? "pre-scrollable" : "";
		$content = $content ? esc_attr($content) : '';
		$html = <<< EOT
<pre class="prettyprint $lines lang-$lang $scroll">$content</pre>
EOT;
        return trim($html);
	}


}

?>
