<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}
   
/*
* Located in header.php after <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />  
*/

if( !function_exists('ut_meta_hook') ) {

    function ut_meta_hook(){
    
        do_action('ut_meta_hook');
    
    }

}

/*
* Located in header.php before <header> 
*/

if( !function_exists('ut_before_header_hook') ) {
    
    function ut_before_header_hook(){
    
        do_action('ut_before_header_hook');
    
    }

}

/*
* Located in header.php before <> 
*/

if( !function_exists('ut_before_content_hook') ) {

    function ut_before_content_hook(){
    
        do_action('ut_before_content_hook');
    
    }

}

/*
* Located in footer.php before <footer> 
*/

if( !function_exists('ut_before_footer_hook') ) {

    function ut_before_footer_hook(){
    
        do_action('ut_before_footer_hook');
    
    }

}

/*
* Located in footer.php after </footer>
*/

if( !function_exists('ut_after_footer_hook') ) {

    function ut_after_footer_hook(){
    
        do_action('ut_after_footer_hook');
    
    }

}
/*
* Located in footer.php after </footer>
*/

if( !function_exists('ut_footer_java_hook') ) {

    function ut_footer_java_hook(){
    
        do_action('ut_footer_java_hook');
    
    }

}