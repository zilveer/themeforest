<?php

/**
 * Simple class that listens to one thing only. Is the theme currently being activated?
 */

class bebelOneClickInstallationUtils
{
    
    public static function checkIfThemeIsActivated($page)
    {
        
        if(isset($_GET['activated']) && $page == 'themes.php')
        {
            header('location: '.get_admin_url().'admin.php?page=bebelOneClickInstallation');
        } 
    }
    
    
}