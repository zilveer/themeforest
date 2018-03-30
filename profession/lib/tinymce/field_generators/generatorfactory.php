<?php

include_once('textareagenerator.php');
include_once('textboxgenerator.php');
include_once('selectgenerator.php');
include_once('separatorgenerator.php');

class GeneratorFactory
{
	public static function Get($type, $key, $template)
	{
		switch ($type) {
			case "textarea":
				return new TextareaGenerator($key, $template);
				break;
			case "textbox":
				return new TextboxGenerator($key, $template);
				break;
			case "select":
				return new SelectGenerator($key, $template);
				break;
			case "separator":
				return new SeparatorGenerator($key, null);
				break;
		}
	}
}

?>