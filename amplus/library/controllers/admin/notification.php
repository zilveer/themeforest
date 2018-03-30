<?php

class BFIAdminNotificationController {
    
    private static $warnings = array();
    private static $reminders = array();
    private static $custom = array();
    
    function __construct() {
        add_filter('admin_notices', array($this, 'displayNotifications'));
    }
    
    public function displayNotifications() {
        if (count(self::$custom)) {
            foreach (self::$custom as $message) {
                echo "<div class='updated'><p>{$message}</p></div>";
            }
        }
        
        if (count(self::$warnings)) {
            $messages = "";
            foreach (self::$warnings as $key => $message) {
                $hash = $this->generateSmallHash($message);
                
                // check the db whether the user has previously
                // clicked the remove icon for this notification
                if (!$this->shouldDisplay($hash)) continue;
                
                $messages .= "<p>" . ($key + 1) . ". $message <a href='#' onclick='". $this->getRemoveScript($hash) . "'><i class='icon-remove-sign icon-large'></i></a></p><div style='clear: both;'></div>";
            }
            
            $title = count(self::$reminders) > 1 ? __("Theme alerts", BFI_I18NDOMAIN) : __("Theme alert", BFI_I18NDOMAIN);
            
            // display the messages
            if ($messages) {
                echo "<div class='error'><p><strong>{$title}:</strong></p>{$messages}</div>";
            }
        }
        
        if (count(self::$reminders)) {
            $messages = "";
            foreach (self::$reminders as $key => $message) {
                $hash = $this->generateSmallHash($message);
                
                // check the db whether the user has previously
                // clicked the remove icon for this notification
                if (!$this->shouldDisplay($hash)) continue;
                
                $messages .= "<p>" . ($key + 1) . ". $message <a href='#' onclick='". $this->getRemoveScript($hash) . "'><i class='icon-remove-sign icon-large'></i></a></p><div style='clear: both;'></div>";
            }
            
            $title = count(self::$reminders) > 1 ? __("Theme reminders", BFI_I18NDOMAIN) : __("Theme reminder", BFI_I18NDOMAIN);
            
            // display the messages
            if ($messages) {
                echo "<div class='updated'><p><strong>{$title}:</strong></p>{$messages}</div>";
            }
        }
    }
    
    public static function addNotification($message, $type = 'reminder') {
        if ($type == 'reminder') {
            self::$reminders[] = $message;
        } else if ($type == 'custom') {
            self::$custom[] = $message;
        } else {
            self::$warnings[] = $message;
        }
    }
    
    private function generateSmallHash($message) {
        return substr(md5($message), 0, 10);
    }
    
    private function shouldDisplay($hash) {
        return !bfi_get_option("adminnotice_$hash");
    }
    
    private function getRemoveScript($hash) {
        return sprintf("
            var removeMe = this;
            var jqxhr = jQuery.ajax(\"%s\")
                              .done(function() { 
                                  jQuery(removeMe).parent().parent().remove();
                              });
            return false;",
            BFI_LIBRARYURL 
            . "includes/remove-notification.php?hash=" 
            . $hash
        );
    }
}
