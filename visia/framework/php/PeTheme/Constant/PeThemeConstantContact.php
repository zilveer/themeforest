<?php

class PeThemeConstantContact {
	public $metabox;

	public function __construct() {
		$this->metabox = 
			array(
				  "title" =>__("Contact Form",'Pixelentity Theme/Plugin'),
				  "where" => 
				  array(
						"page" => "page-contact",
						),
				  "content"=>
				  array(
						"msgOK" => 	
						array(
							  "label"=>__("Mail Sent Message",'Pixelentity Theme/Plugin'),
							  "type"=>"TextArea",
							  "description" => __("Message shown when form message has been sent without errors",'Pixelentity Theme/Plugin'),
							  "default"=>'<strong>Your Message Has Been Sent!</strong> Thank you for contacting us.'
							  ),
						"msgKO" => 	
						array(
							  "label"=>__("Form Error Message",'Pixelentity Theme/Plugin'),
							  "type"=>"TextArea",
							  "description" => __("Message shown when form message encountered errors",'Pixelentity Theme/Plugin'),
							  "default"=>'<strong>Oops, An error has occured!</strong> See the marked fields above to fix the errors.'
							  )
						)
				  );
	}
	
}

?>