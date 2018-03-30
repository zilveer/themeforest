<?php

class PeThemeViewPortfolioList extends PeThemeViewBlog {

	public function name() {
		return __("Portfolio List",'Pixelentity Theme/Plugin');
	}
	
	public function short() {
		return __("Portfolio",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Portfolio",'Pixelentity Theme/Plugin');
	}

	public function mbox() {
		$mbox = parent::mbox();
		
		$mbox["content"] = 
			array(
				  "pager" => 
				  array(
						"label"=>__("Paged Result",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'Pixelentity Theme/Plugin'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						)
				  );

		return $mbox;	
	}

	public function template($type = "") {
		if ($type != "empty") {
			peTheme()->get_template_part("view","portfolio-list");
		}
	}
}

?>
