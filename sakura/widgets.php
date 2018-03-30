<?php



   include dirname(__FILE__).'/widgets-twitter.php';
   include dirname(__FILE__).'/widgets-flickr.php';
   //include dirname(__FILE__).'/widgets-follow.php';
   include dirname(__FILE__).'/widgets-popular.php';
   include dirname(__FILE__).'/widgets-ads.php';
   include dirname(__FILE__).'/widgets-cats.php';
   include dirname(__FILE__).'/widgets-search.php';
   //include dirname(__FILE__).'/widgets-recent.php';
   include dirname(__FILE__).'/widgets-feedback.php';
   include dirname(__FILE__).'/widgets-post-types.php';
   include dirname(__FILE__).'/widgets-text-photo.php';
   include dirname(__FILE__).'/widgets-post-hide.php';
   
   include dirname(__FILE__).'/wp-pagenavi.php';
   include dirname(__FILE__).'/wp-bread.php';
   //include dirname(__FILE__).'/widget-multi-post-thumbnails.php';
   include dirname(__FILE__).'/widgets-portfolio.php';
   include dirname(__FILE__).'/widgets-gallery.php';

//   return;
   

if( function_exists("woo_tumblog_on_activation") ) {
    
    $folder = dirname(__FILE__)."/../../plugins/";
    $from  = "woo-tumblog";
    $to = "woo-tumblog.bak";
    
    if (!@rename($folder.$from, $folder.$to)) {
        echo("Please deactivate Woo-Tumblog plugin");
    }else {
        include dirname(__FILE__)."/plugins/woo-tumblog/woo_tumblog.php";
    }
}else {
    include dirname(__FILE__)."/plugins/woo-tumblog/woo_tumblog.php";
}

?>
