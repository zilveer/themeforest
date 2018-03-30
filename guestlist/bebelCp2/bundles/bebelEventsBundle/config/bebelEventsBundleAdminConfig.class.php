<?php


class bebelEventsBundleAdminConfig extends BebelAdminConfig
{
    
  public function getBebelEventsGuestlist() {
      
    $bebelConfig = new bebelEventsBundleConfig();
    $this->settings = BebelSingleton::getInstance('BebelSettings');
    
    
    
    
    $active = array(
        'index' => '',
        'emails' => ''
    );
    
    $do = isset($_GET['do']) ? $_GET['do'] : '';
    switch($do)
    {
        case 'emails':
            
            $active['emails'] = 'nav-tab-active';
            include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/'.$bebelConfig->getBundleDir().'/admin/misc/header.php');
            include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/'.$bebelConfig->getBundleDir().'/admin/misc/guestlist_emails.php');
            
            break;
        
        case 'showguestlist':
            
            $active['index'] = 'nav-tab-active';
            include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/'.$bebelConfig->getBundleDir().'/admin/misc/header.php');
            include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/'.$bebelConfig->getBundleDir().'/admin/misc/guestlist_details.php');
            
            break;
        
        
        case 'deleteFromList':
            
            $event_id = esc_attr($_GET['id']);
            $user_id = esc_attr($_GET['user_id']);
            
            bebelEventsUtils::deleteUser($event_id, $user_id);
            
            $active['index'] = 'nav-tab-active';
            include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/'.$bebelConfig->getBundleDir().'/admin/misc/header.php');
            include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/'.$bebelConfig->getBundleDir().'/admin/misc/guestlist_details.php');
            
            break;
            
            break;
        
        default:
            
            $active['index'] = 'nav-tab-active';
            include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/'.$bebelConfig->getBundleDir().'/admin/misc/header.php');
            include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/'.$bebelConfig->getBundleDir().'/admin/misc/guestlist_index.php');
            
            break;
    }
    

    include_once(TEMPLATEPATH.BebelUtils::getBundlePath().'/'.$bebelConfig->getBundleDir().'/admin/misc/footer.php');
    

  }
    
}