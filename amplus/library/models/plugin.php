<?php

class BFIPluginModel {
    
	public $name = null;
	public $slug = null;
	public $source = null;
	public $required = false;
	public $version = null;
	public $force_activation = false;
	public $force_deactivation = false;
	public $external_url = null;
	
	function __construct() {
	    if ($this->source) {
	        if (file_exists(BFI_LIBRARYPATH . 'plugins/' . basename($this->source))) {
	            $this->source = BFI_LIBRARYPATH . 'plugins/' . basename($this->source);
	        }
	        if (file_exists(BFI_APPLICATIONPATH . 'plugins/' . basename($this->source))) {
	            $this->source = BFI_APPLICATIONPATH . 'plugins/' . basename($this->source);
	        }
	    }
        if ($this->name && !$this->slug) {
            $this->slug = str_replace(array('-', ' ', '_'), '', strtolower($this->name));
        }
	}
	
	public function createPluginArgs() {
	    return get_object_vars($this);
    }
}
