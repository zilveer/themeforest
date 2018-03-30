<?php

class bebelUpdate
{
    
    
    /**
     * The Version of the theme
     * @var type 
     */
    protected $installed_version;
    
    protected $files_version;
    
    protected $settings;
    
    
    public function __construct()
    {
        $this->settings = BebelSingleton::getInstance('BebelSettings');
        $this->installed_version = $this->settings->get('theme_version');
        $this->files_version = $this->settings->getVersion();
    }
    
    public function checkForUpdate()
    {
        
        if($this->installed_version < $this->files_version)
        {
            $file_version = str_replace(".","_", $this->files_version);
            $file = dirname(__FILE__).'/../versions/version'.$file_version.'.php';
            
            if(file_exists($file))
            {
                include $file;
                
                if(bebel_update($this->installed_version))
                {
                    $this->settings->update('theme_version', $this->files_version);
                    $this->settings->save();
                }else {
                    throw new Exception("Updating the theme failed. Please contact the creator of this theme.");
                }
                
            }
        }
        
    }
    
    
    
}