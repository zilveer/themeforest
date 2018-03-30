<?php

class PeThemeViewLayoutModuleForm extends PeThemeViewLayoutModule {

	public function name() {
		return __("Contact Form",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Contact Form",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "content" =>
				  array(
						"label" => __("Intro Text",'Pixelentity Theme/Plugin'),
						"type" => "Editor",
						"description" => __("Text shown before the form fields.",'Pixelentity Theme/Plugin'),
						"default" => sprintf(__('<h3>Your Personal Details</h3>%s<h6>Tell Us About Yourself</h6>','Pixelentity Theme/Plugin'),"\n")
						),
				  "submit" =>
				  array(
						"label" => __("Submit Label",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Label of the form submit button.",'Pixelentity Theme/Plugin'),
						"default" => __('Submit Form','Pixelentity Theme/Plugin')
						),
				  "msgOK" =>
				  array(
						"label" => __("Confirmation",'Pixelentity Theme/Plugin'),
						"type" => "Editor",
						"description" => __("Text shown when form is successfully submitted.",'Pixelentity Theme/Plugin'),
						"default" => __('<strong>Your Message Has Been Sent!</strong> Thank you for contacting us.','Pixelentity Theme/Plugin')
						),
				  "msgKO" =>
				  array(
						"label" => __("Errors",'Pixelentity Theme/Plugin'),
						"type" => "Editor",
						"description" => __("Text shown when there are validation errors.",'Pixelentity Theme/Plugin'),
						"default" => __('<strong>Oops, An error has ocurred!</strong> See the marked fields above to fix the errors.','Pixelentity Theme/Plugin')
						),
				  "fields" => 
				  array(
						"label"=>__("Fields",'Pixelentity Theme/Plugin'),
						"type"=>"Items",
						"section"=>__("Header",'Pixelentity Theme/Plugin'),
						"description" => __("Add one or more fields to the form.",'Pixelentity Theme/Plugin'),
						"button_label" => __("Add New Field",'Pixelentity Theme/Plugin'),
						"sortable" => true,
						"auto" => __("Layer",'Pixelentity Theme/Plugin'),
						"unique" => false,
						"editable" => false,
						"legend" => true,
						"fields" => 
						array(
							  array(
									"label" => __("Type",'Pixelentity Theme/Plugin'),
									"name" => "type",
									"type" => "select",
									"options" => 
									array(
										  __("Text",'Pixelentity Theme/Plugin') => "text",
										  __("TextArea",'Pixelentity Theme/Plugin') => "textarea"
										  ),
									"width" => 100,
									"default" => "text"
									),
							  array(
									"label" => __("Label",'Pixelentity Theme/Plugin'),
									"name" => "label",
									"type" => "text",
									"width" => 150, 
									"default" => __("Name",'Pixelentity Theme/Plugin')
									),
							  array(
									"label" => __("Name",'Pixelentity Theme/Plugin'),
									"name" => "name",
									"type" => "text",
									"width" => 100, 
									"default" => "Name"
									),
							  array(
									"label" => __("Required",'Pixelentity Theme/Plugin'),
									"name" => "required",
									"type" => "select",
									"width" => 150,
									"options" => 
									array(
										  __("Required",'Pixelentity Theme/Plugin') => "required",
										  __("Not Required",'Pixelentity Theme/Plugin') => ""
										  ),
									"default" => "required"
									)
							  ),
						"default" => 
						array(
							  array(
									"type" => "text",
									"label" => __("Name",'Pixelentity Theme/Plugin'),
									"name" => "author",
									"required" => "required"
									),
							  array(
									"type" => "text",
									"label" => __("Address",'Pixelentity Theme/Plugin'),
									"name" => "address",
									"required" => ""
									),
							  array(
									"type" => "text",
									"label" => __("Phone",'Pixelentity Theme/Plugin'),
									"name" => "phone",
									"required" => ""
									),
							  array(
									"type" => "text",
									"label" => __("Email",'Pixelentity Theme/Plugin'),
									"name" => "email",
									"required" => "required"
									),
							  array(
									"type" => "text",
									"label" => __("Website",'Pixelentity Theme/Plugin'),
									"name" => "website",
									"required" => ""
									),
							  array(
									"type" => "textarea",
									"label" => __("Message",'Pixelentity Theme/Plugin'),
									"name" => "message",
									"required" => "required"
									)
							  )
						)
				  );
		
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","form");
	}

	public function tooltip() {
		return __("Use this block to add a contact form to your layout. This block consists of a form with configurable input fields.",'Pixelentity Theme/Plugin');
	}


}

?>
