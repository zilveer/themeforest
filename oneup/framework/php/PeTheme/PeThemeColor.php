<?php

class PeThemeColor {

	public $master;

	public function __construct($master) {
		$this->master =& $master;
		$this->colors =& PeGlobal::$config["colors"];
	}

	public function &options() {
		$options = array();
		foreach ($this->colors as $key=>$value) {
			$options[$key] =
				array(
					  "label"=>$value["label"],
					  "description" => __("Where the selected color will be used.",'Pixelentity Theme/Plugin'),
					  "type"=>"Color",
					  "section"=>__("Colors",'Pixelentity Theme/Plugin'),
					  "default"=>$value["default"]
					  );			
		}
		return $options;
	}
	
	public function customCSS($force = false,$colorKey = null) {
		$options = $this->master->options->all();
		$customCSS = "";
		$skins = false;
		if (isset(PeGlobal::$config["skins"])) {
			$skins = array_values(PeGlobal::$config["skins"]);
			// drop default skin
			array_shift($skins);
		}
		foreach ($this->colors as $key => $values) {
			
			if ($colorKey && $colorKey != $key) continue;

			if ($color = $options->{$key}) {
				// skip when using default value
				if (!$color || (!$force && $color == $values["default"])) continue;
				foreach ($values["selectors"] as $selector => $property) {
					$selector = str_replace(" > ",">",$selector);
					$rule = "$selector";
					if ($skins) {
						foreach ($skins as $skin) {
							$rule .= ",html.skin_$skin $selector";
						}
					}
					$property = explode(":",$property);
					$rgba = false;
					if (count($property) > 1) {
						$alpha = floatval($property[1]);
						$rgba = sprintf(
										  "rgba(%s,%s,%s,%s)",
										  hexdec(substr($color, 1, 2)),
										  hexdec(substr($color, 3, 2)),
										  hexdec(substr($color, 5, 2)),
										  $alpha);
					}
					$property = $property[0];
					$customCSS .= $rgba ? sprintf("%s{%s:%s;%s:%s;}",$rule,$property,$color,$property,$rgba) : sprintf("%s{%s:%s;}",$rule,$property,$color);
				}
			}
		}

		return $customCSS;
	}

	public function apply($force = false,$colorKey = null) {
		$customCSS = $this->customCSS($force);
		if ($customCSS) {
			printf('<style type="text/css" id="pe-theme-custom-colors">%s</style>',$customCSS);
		}
	}

}

?>