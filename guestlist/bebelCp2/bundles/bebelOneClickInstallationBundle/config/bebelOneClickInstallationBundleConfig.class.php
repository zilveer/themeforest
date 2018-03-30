<?php


class bebelOneClickInstallationBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelOneClickInstallationBundle';
  }


  public function getAutoload()
  {
    $a = array(
        'bebeloneclickinstallationbundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelOneClickInstallationBundleAdminConfig.class.php',
        'bebeloneclickinstallationutils' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelOneClickInstallationUtils.class.php',
        'bebeloneclickinstallation' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelOneClickInstallation.class.php',
        
    );

    return $a;
  }

  public function getSettings()
  {
    $s = array(
        'one_click_installation_bundle_version' => '1.0',
        'one_click_installation_already_run' => 'no'
    );

    return $s;
  }

  // admin stuff
  public function getAdmin()
  {
      
    $modules = array();
    $post_modules = array();
    
    $pages = array(
        'bebelOneClickInstallation' =>
          array(
              'title' => 'Installation / Reset',
              'page_title' => 'Set up the theme with one click - or reset the data.',
              'parent' => 'bebelAdminTop',
              'permission' => 'edit_theme_options',
              'class' => $this->bundleDir

          ),
      );
      
    return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
  }
}