<?php

Class Plsh_Settings {

	public $active, $general, $admin_head, $admin_body, $hidden;
	const OPTION_NAME = 'plsh_stored_settings';
	
	function __construct() 
	{
		$this->parse_default_settings();
		$stored_settings = self :: load_settings(self :: OPTION_NAME);
		$this->merge_with_default_settings($stored_settings);
		unset($this->general);
	}
	
	
	function parse_default_settings()
	{			
		global $_settings_static, $_settings_admin_head, $_settings_admin_body, $_settings_hidden;
		$this->admin_head = $_settings_admin_head;
		$this->admin_body = $_settings_admin_body;
		$this->general = $_settings_static;
		$this->hidden = $_settings_hidden;
	}
	
	
	public static function load_settings($option_name)
	{
		$stored_settings = get_option($option_name);
		if($stored_settings != false)
		{
			$stored_settings = json_decode($stored_settings, true);
		}
		
		return $stored_settings;
	}
	
	
	public static function store_settings($data)
	{
        global $_SETTINGS;
        
        //merge with other current settings
        foreach($_SETTINGS->active as $key => $val)
        {
            if(!isset($data[$key]))
            {
                $data[$key] = $val;
            }
        }
        
        $data = self :: filter_settings($data);
        update_option(self :: OPTION_NAME, json_encode($data));
	}
	
	public function update_single($name, $value)
	{
        $this->active[$name] = $value;
        self :: store_settings($this->active);
	}
	
		
	public function merge_with_default_settings($stored_settings)
	{		
        foreach($this->general as $key => $val)
		{
		    $this->active[$key] = $val;
		}
		
		foreach($this->hidden as $key => $val)
		{
			if(isset($stored_settings[$key])) {
				$this->active[$key] = $stored_settings[$key];
			} else {
				$this->active[$key] = $val;
			}
		}
		
		foreach($this->admin_body as $section) {		//insert the options into settings object
            foreach($section as $cf) {
                foreach($cf as $c) {
                    $slug = $c['slug'];
                    if(isset($stored_settings[$slug])) {
                        $value = $stored_settings[$slug];
                     } else {
                        $value = $c['default'];
                     }

                    $this->active[$slug] = $value;
                }
            }
		}

		$this->active = self :: filter_settings($this->active, true);
	}
	
    public static function export_settings()
    {
        global $_SETTINGS;
        return base64_encode(json_encode($_SETTINGS->active));
    }
    
    public static function import_settings($data)
    {
        $settings = json_decode(base64_decode($data), true);
        self :: store_settings($settings);
    }
	
    public static function reset_settings()
    {
        $settings = array();    //write empty array        
        update_option(self :: OPTION_NAME, json_encode($settings));
    }
    
    public static function get_visual_editor_settings()
    {
        global $_SETTINGS;
        $return = array('body' => array(), 'head' => array());
        
        if(!empty($_SETTINGS->admin_body['visual_editor']))
        {
            $return['body'] = $_SETTINGS->admin_body['visual_editor'];
        }
        if(!empty($_SETTINGS->admin_head['visual_editor']))
        {
            $return['head'] = $_SETTINGS->admin_head['visual_editor']['children'];
        }
        return $return;
    }
    
	public static function filter_settings($array, $direction = false)
	{
		if(is_array($array) || is_object($array))
		{
			foreach($array as $key => $val) 
			{
				$filtered = self :: filter_settings($val, $direction);
				if(is_object($array))
				{
					$array->$key = $filtered;
				}
				else
				{
					$array[$key] = $filtered;
				}
			}
		}
		else
		{
			if(!$direction)
			{
                $array = addslashes(trim($array));
			}
			else
			{
				$array = stripslashes($array);
			}
		}
		return $array;
	}
}


?>