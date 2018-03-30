<?php


class bebelUpdateBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelUpdateBundle';
  }


  public function getAutoload()
  {
    $a = array(
        'bebelupdatebundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelUpdateBundleAdminConfig.class.php',
        'bebelupdate' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelUpdate.class.php',

    );

    return $a;
  }


  public function getSettings()
  {
    $s = array(
        'theme_version' => '1.0' // this is not the most recent version. this one will be found in functions.php 
        );

    return $s;
  }



}