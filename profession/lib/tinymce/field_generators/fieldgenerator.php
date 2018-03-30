<?php

//Base class for generating html code from 
//given shortcode template object
abstract class FieldGenerator
{
	protected $template = array();
	protected $key 		= '';
	
	function __construct($key, array $template)
	{
		$this->template = $template;
		$this->key = $key;
	}
	
	public function SetTemplate(array $template)
	{
		$this->template = $template;
	}
	
	public function GetArray($key)
	{
		if(!array_key_exists($key, $this->template))
			return array();
			
		return $this->template[$key];
	}
	
	public function GetString($key)
	{
		if(!array_key_exists($key, $this->template))
			return '';
			
		return $this->template[$key];
	}
	
	//Returns array of flags (if any)
	public function GetFlags()
	{
		return explode( ' ', $this->GetString('flags') );
	}
	
	public function GetAttrsString()
	{
		$attrs = '';
		
		//Process flags
		if(in_array('attr', $this->GetFlags()))
			$attrs = 'data-attr="true"';

		return $attrs;
	}
	
	public function HasPreview()
	{
		if(!array_key_exists('preview', $this->template))
			return true;
			
		return $this->template['preview'];
	}
	
	//Check for flags compatibility
	public function CheckFlagsCompatibility()
	{		
		return true;
	}
	
	//Generates string output of the template array
	abstract public function ToString(array $options=null);
}

?>