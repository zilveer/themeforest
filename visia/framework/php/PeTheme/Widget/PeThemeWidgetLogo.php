<?php

class PeThemeWidgetLogo extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Logo",'Pixelentity Theme/Plugin');
		$this->description = __("Logo, info, social links",'Pixelentity Theme/Plugin');
		$this->wclass = "widget_info";

		$content = <<<EOL
<p>15 Block 8/c, Hll Street,<br/>San Francisco, CA.</p>
<span class="phone">+353 (0) 123 456 78</span>
<a href="#">hello@emailaddress.com</a>
EOL;

$this->fields = array(
							  "logo" => 
							  array(
									"label"=>__("Logo/Image",'Pixelentity Theme/Plugin'),
									"type"=>"Upload",
									"section"=>__("General",'Pixelentity Theme/Plugin'),
									"description" => __("Logo/Image to be used as the widget title",'Pixelentity Theme/Plugin'),
									"default"=> PE_THEME_URL."/img/skin/logo.png"
									),
							  "content" => 
							  array(
									"label"=>__("Statistics",'Pixelentity Theme/Plugin'),
									"type"=>"TextArea",
									"description" => __("Info section",'Pixelentity Theme/Plugin'),
									"default"=>$content
									),
							  "social" => 
							  array(
									"label"=>__("Social Profile Links",'Pixelentity Theme/Plugin'),
									"type"=>"Items",
									"section"=>__("Header",'Pixelentity Theme/Plugin'),
									"description" => __("Add one or more links to social networks.",'Pixelentity Theme/Plugin'),
									"button_label" => __("Add Social Link",'Pixelentity Theme/Plugin'),
									"sortable" => true,
									"auto" => __("Layer",'Pixelentity Theme/Plugin'),
									"unique" => false,
									"editable" => false,
									"legend" => false,
									"fields" => 
									array(
										  array(
												"label" => __("Social Network",'Pixelentity Theme/Plugin'),
												"name" => "icon",
												"type" => "select",
												"options" => apply_filters('pe_theme_social_icons',array()),
												"width" => 100,
												"default" => ""
												),
										  array(
												"name" => "url",
												"type" => "text",
												"width" => 190, 
												"default" => "#"
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
		$t->get_template_part("widget","logo");
	}


}
?>
