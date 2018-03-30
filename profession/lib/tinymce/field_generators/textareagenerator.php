<?php

include_once('fieldgenerator.php');
include_once('formatter.php');
require_once(dirname(__FILE__) . '/utilities.php');

//Generates form HTML
class TextareaGenerator extends FieldGenerator
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
			Formatter::FormatInput("<textarea name=\"$this->key\" $attrs rows=\"8\"></textarea>", "px-sc-textarea-input"),
			Formatter::FormatDescription($desc)
		);
		
	}
	
}

?>