<?php


//Generates table rows
class Formatter
{
	public static function FormatRow($label, $input, $description='')
	{
		$output = "<div class=\"px-sc-row\">\n
		<div class=\"px-sc-col px-label-container\">$label</div>\n
		<div class=\"px-sc-col px-sc-input-container\">$input$description</div>\n
		</div>
		";
		
		return $output;
	}
	
	public static function FormatLabel($label)
	{
		return "<label>$label</label>";
	}
	
	public static function FormatInput($input, $wrapperClass)
	{
		return "<div class=\"px-sc-input $wrapperClass\">$input</div>";
	}
	
	public static function FormatDescription($description)
	{
		return "<span class=\"px-sc-input-desc\">$description</span>";
	}
}

?>