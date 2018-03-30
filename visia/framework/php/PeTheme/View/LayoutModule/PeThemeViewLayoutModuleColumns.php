<?php

class PeThemeViewLayoutModuleColumns extends PeThemeViewLayoutModuleContainer {

	public static $translate = 
		array(
			  "1/6" => "span2",
			  "1/4" => "span3",
			  "1/3" => "span4",
			  "1/2" => "span6",
			  "2/4" => "span6",
			  "2/3" => "span8",
			  "3/4" => "span9",
			  "5/6" => "span10",
			  "last" => ""
			  );

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Columns",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		$description = "blah";

		return
			array(
				  "columns" => 
				  array(
						"label" => __("Layout",'Pixelentity Theme/Plugin'),
						"description" => __("Select the columns layout",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"groups" => true,
						"options" => PeGlobal::$config["columns"],
						)
				  );
	}

	public function name() {
		return __("Columns",'Pixelentity Theme/Plugin');
	}

	public function blockClass() {
		return "pe-container";
	}

	public function rowClass($cols) {
		return apply_filters("pe_theme_layoutmodule_columns_rowclass","row-fluid");
	}

	public function colClass($cl,$idx,$cols) {
		return $cl;
	}

	public function template() {
		$translate = apply_filters("pe_theme_shortcode_columns_mapping",PeThemeViewLayoutModuleColumns::$translate);

		if (empty($this->data->columns)) {
			$cols = count($this->conf->items);
		} else {
			$layout = explode(" ",strtr($this->data->columns,$translate));
			$cols = count($layout);
		}
		

		$idx = 0;
		$last = count($this->conf->items)-1;

		$open = apply_filters("pe_theme_shortcode_columns_parent_open",sprintf('<div class="%s">',$this->rowClass($cols)));
		$close = apply_filters("pe_theme_shortcode_columns_parent_close",'</div>');

		foreach ($this->conf->items as $item) {
			if (($idx % $cols) === 0) echo $open;
			printf('<div class="%s">',$this->colClass(empty($layout[$idx % $cols]) ? false : $layout[$idx % $cols],$idx,$cols));
			$this->outputModule($item);
			echo "</div>";
			if ($idx === $last || ($idx % $cols) === ($cols-1)) echo $close;
			$idx++;
		}

	}

	public function tooltip() {
		return __("Use this block to add columns of content to your layout.",'Pixelentity Theme/Plugin');
	}

}

?>
