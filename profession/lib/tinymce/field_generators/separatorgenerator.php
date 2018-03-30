<?php

include_once('fieldgenerator.php');

//Generates form HTML
class SeparatorGenerator extends FieldGenerator
{
	//Generates string output of the template array
	public function ToString(array $options=null)
	{
		return '<span class="separator"></span>';
	}

}

?>