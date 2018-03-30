<?php

class PeThemeViewLayoutModuleFaqsItemContainer extends PeThemeViewLayoutModuleTabsItemContainer {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("FAQ",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		$fields = parent::fields();
		return 
			array(
				  "title" => $fields["title"],
				  "closed" => 
				  array(
						"label" => __("Closed",'Pixelentity Theme/Plugin'),
						"type"=>"RadioUI",
						"options" => PeGlobal::$const->data->yesno,
						"default"=> "yes"
						)
				  );
	}

	public function type() {
		return "FAQs";
	}

	public function group() {
		return "faqs";
	}

	public function tooltip() {
		return __("Use this block to add complex content to the FAQ item. This block is esentially a container into which further blocks may be inserted.",'Pixelentity Theme/Plugin');
	}

}

?>
