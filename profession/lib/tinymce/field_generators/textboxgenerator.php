<?php

include_once('fieldgenerator.php');
include_once('formatter.php');
require_once(dirname(__FILE__) . '/utilities.php');

//Generates form HTML
class TextboxGenerator extends FieldGenerator
{
	//Generates string output of the template array
	public function ToString(array $options=null)
	{
		return $this->GenerateField($options);
	}
	
	protected function GenerateField($options)
	{
		$label  = array_get_default('label', '', $this->template);
		$desc   = array_get_default('desc', '', $this->template);
		$attrs  = $this->GetAttrsString();
		
		return Formatter::FormatRow(
			Formatter::FormatLabel($label),
			Formatter::FormatInput("<input type=\"text\" value=\"\" name=\"$this->key\" $attrs/>", "px-sc-text-input"),
			Formatter::FormatDescription($desc)
		);
		
	}
	
}

?>