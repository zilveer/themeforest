<?php

class bebelOneClickInstallationBundleAdminConfig {
    
    
    public function getBebelOneClickInstallation()
    {
        $this->settings = BebelSingleton::getInstance('BebelSettings');
        
        
        $bOneClickInstall = new bebelOneClickInstallation();
        if(isset($_GET['run']) && $_GET['run'] == 'install')
        {
           
          $bOneClickInstall = new bebelOneClickInstallation();
          $bOneClickInstall->setImportFile('default')->run();
        }
        
        include(dirname(__FILE__).'/../template/oneclickinstall.php');
        
        
    }
    
}