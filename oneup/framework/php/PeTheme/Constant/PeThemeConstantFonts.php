<?php

class PeThemeConstantFonts {
	public $google;

	public function __construct() {
		include_once("google-fonts.php");

		$list = array(__("Default",'Pixelentity Theme/Plugin') => 0);
		$supports = array();
		foreach ($fonts["google"] as $name => $data) {
			$list[$name] = $name;
			$classes = "";
			$request = "$name";
			foreach ($data[0] as $variant) {
				$add = false;
				switch ($variant) {
				case "bold":
				case "italic":
				case "regular":
					$add = $variant;
					break;
				case "700":
					$add = "bold";
					break;
				case "700italic":
					$add = "bolditalic";
				}
				if ($add) {
					$classes .= "has_$add ";
					$request .= ":$add";
				}
			}
			$supports[$name]["classes"] = $classes;
			$supports[$name]["request"] = $request;
			//$supports[$name]["subsets"] = $data[1];
		}

		$this->google = new StdClass();
		$this->google->list =& $list;
		$this->google->all =& $supports;

		//$this->list["google"] =& array_merge(array(__("Default",'Pixelentity Theme/Plugin') => 0),array_combine($fonts["google"],$fonts["google"]));
	}

}

?>