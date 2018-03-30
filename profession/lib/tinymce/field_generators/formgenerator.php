<?php

require_once('fieldgenerator.php');
require_once('generatorfactory.php');
require_once(dirname(__FILE__) . '/utilities.php');

//Generates form HTML
class FormGenerator extends FieldGenerator
{
	//Generates string output of the template array
	public function ToString(array $options=null)
	{
		$missingKeys = array_check_keys($this->template, array('shortcode', 'fields'));
		
		if(count($missingKeys) > 0)
			return 'Required keys are not present in the template array';
		
		if(!$this->CheckFlagsCompatibility())
			return 'Incompatible Flags Found';
		
		return $this->GenerateForm();
	}
	
	public function CheckFlagsCompatibility()
	{
		$flags = $this->GetFlags();
		
		if(in_array('static', $flags) && in_array('duplicable', $flags)) 
			return false;
			
		return true;
	}
	
	protected function GenerateForm()
	{
		$fields    = $this->GetArray('fields');
		$shortcode = $this->GetString('shortcode');
		$flags     = $this->GetString('flags');
		$title     = $this->GetString('title');
		
		$output    = "<div id=\"px-sc-flags\">$flags</div>\n
					  <div id=\"px-sc-template\">$shortcode</div>\n
					  <ul id=\"px-sc-form\">\n<li>\n
						<div class=\"px-sc-head\">\n
							<div class=\"clear-parent\">\n
								<h3>$title</h3>\n
								<a href=\"#\" class=\"close_button\"></a>
								<a href=\"#\" class=\"clone_button\"></a>\n
							</div>\n
						</div>";
		
		foreach($fields as $key => $field)
		{
			//ToDo: Check for required keys
			$type = $field['type'];
			
			//Get the field generator
			$gen = GeneratorFactory::Get($type, $key, $field);
			
			$output .= $gen->ToString() . "\n";
		}
		
		$output .= "</li></ul>\n";

		return $output;
	}
	
}

?>