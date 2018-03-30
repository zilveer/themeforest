<?php


/**
 * This fixes the bug with the database we had . 
 * @param type $version 
 */


function bebel_update($version)
{
    $updateversion = "1.6";
    
    // second security check, we don't want to do the changes twice.
    if($version < $updateversion)
    {
        
     
        $table_name = bebelEventsUtils::getTableName();
        
        $sql = "ALTER TABLE $table_name
                    ADD (access_code varchar(255));
               ";
        
        global $wpdb;
        
        $wpdb->query($sql);
        
        // sql update done.
        
        return true;
        
    }
    return false;
}