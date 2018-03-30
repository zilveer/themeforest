<?php


class bebelBaseBundleAdminConfig extends BebelAdminConfig
{


  public function getBebelHelp() {

    include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/bebelBaseBundle/help/index.php');

  }

  public function getImport()
  {
    $this->settings = BebelSingleton::getInstance('BebelSettings');
    if(isset($_GET['save']) && $_GET['save'] == "true")
    {
      if(isset($_POST['import_data']))
      {        
        $this->settings->importSettings(stripslashes($_POST['import_data']));
      }
    }
    include_once TEMPLATEPATH.BebelUtils::getAdminPath().'/import.php';
  }

  public function getBebelSidebars()
  {
    $this->settings = BebelSingleton::getInstance('BebelSettings');
    $bSidebarsAdmin = new BebelSidebarGeneratorAdmin($this->settings);

    if(isset($_GET['save']) && $_GET['save'] == "true")
    {
      $bSidebarsAdmin->update($_POST);
    }
    if(isset($_GET['delete']) && !empty($_GET['delete']))
    {
      $bSidebarsAdmin->delete($_GET['delete']);
    }
    include_once TEMPLATEPATH.BebelUtils::getAdminPath().'/sidebars.php';
  }





}