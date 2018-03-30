<?php

class PeThemeWidgetContact extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Contact",'Pixelentity Theme/Plugin');
		$this->description = __("Contact Info",'Pixelentity Theme/Plugin');
		$this->wclass = "widget_contact";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Widget Title.",'Pixelentity Theme/Plugin'),
									"default"=>__("Contact Info",'Pixelentity Theme/Plugin')
									),
							  "info" => 
							  array(
									"label"=>__("Details",'Pixelentity Theme/Plugin'),
									"type"=>"Items",
									"section"=>__("Header",'Pixelentity Theme/Plugin'),
									"description" => __("Add one or more contact info to the widget.",'Pixelentity Theme/Plugin'),
									"button_label" => __("Add New Contact Info",'Pixelentity Theme/Plugin'),
									"sortable" => true,
									"auto" => "icon-info-circled",
									"unique" => false,
									"editable" => false,
									"legend" => false,
									"fields" => 
									array(
										  array(
												"label" => __("Icon",'Pixelentity Theme/Plugin'),
												"name" => "icon",
												"type" => "icon",
												"width" => 100,
												"default" => "icon-bookmarks"
												),
										  array(
												"name" => "content",
												"type" => "textarea",
												"width" => 190,
												"height" => 60,
												"default" => "Mon-Fri: 9:00-18:00"
												)
										  ),
									"default" => ""
									)
							  
							  );

		parent::__construct();
	}

	public function getContent(&$instance) {
		$t =& peTheme();
		$t->template->data((object) $instance);
		$t->get_template_part("widget","contact");
	}


}
?>
