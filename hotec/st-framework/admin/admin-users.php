<?php 

function st_contactmethods( $contactmethods ) {
    $contactmethods['facebook'] = 'Facebook'; // Add Facebook
    $contactmethods['twitter'] = 'Twitter'; // Add Twitter
    $contactmethods['google_plus'] = 'Google+'; 
    $contactmethods['linkedin'] = 'LinkedIn'; 
    $contactmethods['pinterest'] = 'Pinterest'; 
    
    unset($contactmethods['yim']); // Remove YIM
    unset($contactmethods['aim']); // Remove AIM
    unset($contactmethods['jabber']); // Remove Jabber

    return $contactmethods;
}
add_filter('user_contactmethods','st_contactmethods',10,1);  