<?php

class PeThemeShortcodeColumns extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "col";
		$this->group = __("LAYOUT",'Pixelentity Theme/Plugin');
		$this->name = __("Columns",'Pixelentity Theme/Plugin');
		$this->description = __("Add 2 columns",'Pixelentity Theme/Plugin');
		$this->fields = array(
							  "size" =>
							  array(
									"label" => __("Layout",'Pixelentity Theme/Plugin'),
									"type" => "SelectColumns",
									"groups" => true,
									"description" => __("Select the number and proportion of the columns required. The bar will update to show the layout of the chosen arrangement",'Pixelentity Theme/Plugin'),
									"options" => $this->getOptions()
									)
							  );
	}

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.shortcode.columns.js",array(),"pe_theme_shortcode_columns");
		wp_enqueue_script("pe_theme_shortcode_columns");
	}

	protected function getOptions() {
		$options = array();

		$options[__("2 Column layouts",'Pixelentity Theme/Plugin')] = 
			array(
					 __("1/2 1/2",'Pixelentity Theme/Plugin') => "1/2 1/2",
					 __("1/3 2/3",'Pixelentity Theme/Plugin') => "1/3 2/3",
					 __("2/3 1/3",'Pixelentity Theme/Plugin') => "2/3 1/3",
					 __("1/4 3/4",'Pixelentity Theme/Plugin') => "1/4 3/4",
					 __("3/4 1/4",'Pixelentity Theme/Plugin') => "3/4 1/4",
					 __("1/5 4/5",'Pixelentity Theme/Plugin') => "1/5 4/5",
					 __("4/5 1/5",'Pixelentity Theme/Plugin') => "4/5 1/5",
					 );

		$options[__("3 Column layouts",'Pixelentity Theme/Plugin')] = 
			array(
				  __("1/3 1/3 1/3",'Pixelentity Theme/Plugin') => "1/3 1/3 1/3",
				  __("1/4 1/4 2/4",'Pixelentity Theme/Plugin') => "1/4 1/4 2/4",
				  __("2/4 1/4 1/4",'Pixelentity Theme/Plugin') => "2/4 1/4 1/4",
				  __("2/5 2/5 1/5",'Pixelentity Theme/Plugin') => "2/5 2/5 1/5",
				  __("1/5 2/5 2/5",'Pixelentity Theme/Plugin') => "1/5 2/5 2/5",
				  );


		$options[__("4 Column layouts",'Pixelentity Theme/Plugin')] = 
			array(
				  __("1/4 1/4 1/4 1/4",'Pixelentity Theme/Plugin') => "1/4 1/4 1/4 1/4"
				  );


		$options[__("5 Column layouts",'Pixelentity Theme/Plugin')] = 
			array(
				  __("1/5 1/5 1/5 1/5 1/5",'Pixelentity Theme/Plugin') => "1/5 1/5 1/5 1/5 1/5"
				  );


		return $options;
	}

	protected function script() {
		$html = <<<EOT
<script type="text/javascript">
jQuery.pixelentity.shortcodes.$this->trigger = jQuery("#{$this->trigger}_size_").peShortcodeColumns({tag:"{$this->trigger}"});
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
		$class = "col_".strtr(isset($sc_size) ? $sc_size : $sc_last,"/","-");
		if (isset($sc_last)) {
			$class = "$class last";
		}
		$content = $this->parseContent($content);
		return "<div class=\"$class\">$content</div>";
	}


}

?>
