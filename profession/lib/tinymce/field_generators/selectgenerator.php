<?php

include_once('fieldgenerator.php');
include_once('formatter.php');
require_once(dirname(__FILE__) . '/utilities.php');

//Generates form HTML
class SelectGenerator extends FieldGenerator
{
	//Generates string output of the template array
	public function ToString(array $options=null)
	{
		return $this->GenerateField();
	}
	
	protected function GenerateField()
	{
		$attrs = $this->GetAttrsString();
		$input  = "<select name=\"$this->key\" $attrs>\n";
		
		foreach($this->template['options'] as $opKey => $option)
			$input .= "<option value=\"$opKey\">$option</option>\n";
		
		$input .= "</select>";
		
		$input = Formatter::FormatInput($input, "px-sc-select-input");
		
		$label = array_get_default('label', '', $this->template);
		$desc  = array_get_default('desc', '', $this->template);
		
		return Formatter::FormatRow(
			Formatter::FormatLabel($label),
			$input,
			Formatter::FormatDescription($desc)
		);
	}
	
}

?>