<?php

/*
 * Functions for the database and stuff
 */
class bebelEventsUtils extends BebelUtils {
    
  
  
  /**
   * gets all guests for a given event id
   *
   * @global type $wpdb
   * @param type $id
   * @return object 
   */
  
  public static function getGuestlistDetailsByEventId($id)
  {
    global $wpdb;

    return $wpdb->get_results(sprintf("SELECT id, first_name, last_name, email, created_at, mailchimp_list, access_code, in_mailchimp  FROM ".self::getTableName()." WHERE event_id = %d ORDER BY last_name ASC", $id));
  }
  
  
  
  public static function getEventListEntries($id)
  {
    global $wpdb;

    return $wpdb->get_results(sprintf("SELECT id  FROM ".self::getTableName()." WHERE event_id = %d", $id));
  }
  
  
  public static function generateAccessCode($event_id)
  {
      global $wpdb;
      // get all acces codes for this event
      $old_codes_res = $wpdb->get_results(sprintf("SELECT access_code  FROM ".self::getTableName()." WHERE event_id = %d", $event_id));
      
      // build up array
      $old_codes = array();
      foreach($old_codes_res as $code)
      {
          $old_codes[] = $code->access_code;
      }
      
      // generate new code
      $code = BebelUtils::mnemonicCode(2, 2, false);
      
      while(isset($old_codes[$code]))
      {
          $code = BebelUtils::mnemonicCode(2, 2, false);
      }
      
      return $code;
  }
  
  public static function isSignedUp($id, $userdata)
  {
      global $wpdb;  
      $is_in_db = $wpdb->get_row(sprintf("SELECT email FROM ".self::getTableName()." WHERE event_id = %d AND (email = '%s')", $id, $userdata['email']));
      
      return $is_in_db;
    
    
  }
  
  public static function getUserdetailsByEvent($event_id, $userdata)
  {
      global $wpdb;  
      $userdetails = $wpdb->get_row(sprintf("SELECT first_name, last_name, email, access_code, wants_newsletter FROM ".self::getTableName()." WHERE event_id = %d AND email = '%s'", $event_id, $userdata['email']));
      
      
      return $userdetails;
  }
  
  public static function checkForFreeSlot($event_id)
    {
        // number of people registered
        $count_object = bebelEventsUtils::getEventListEntries($event_id);
        $registered = count($count_object);
        
        // get event slots number
        $slots = BebelUtils::getCustomMeta('event_slot_count', '', $event_id);
        
        
        if($slots != "0" && $slots != '')
        {
            // limited slots free
            if($slots <= $registered)
            {
                // already full
                return false;
            }
            return true;
            
        }
        return true;
        
    }
  
  
  public static function putUserOnList($id, $userdata)
  {
    global $wpdb;  
    
    $is_in_db = self::isSignedUp($id, $userdata);
    
    if($is_in_db) 
    {
        return "alreadyon";
    }

    $userdata['event_id'] = $id;
    
    return $wpdb->insert(self::getTableName(), $userdata);

  }
  
  
  public static function getTableName()
  {
      global $wpdb;
      
      $settings = BebelSingleton::getInstance('BebelSettings');
      
      $bundleSettings = new bebelEventsBundleConfig();
      $installData = $bundleSettings->getTableInstallData();
      
      
      return $wpdb->prefix.$settings->getPrefix().'_'.$installData['event_guestlist']['table_name'];
  }
  
  
  public function getAllEmailsThatWantNewsletter()
  {
      global $wpdb;
      
 //     return $wpdb->get_results("SELECT first_name, last_name, email  FROM ".self::getTableName()." WHERE wants_newsletter = 1 GROUP BY email");
      return $wpdb->get_results("SELECT first_name, last_name, email  FROM ".self::getTableName()." GROUP BY email");
  }
  
  public function deleteUser($event_id, $user_id)
  {
      global $wpdb;
      
      $wpdb->query($wpdb->prepare("DELETE FROM ".self::getTableName()." WHERE id = %d AND event_id = %d", $user_id, $event_id));
  }
  
  
  public static function sendLostKeyEmail()
  {
      
  }
  
    
}

