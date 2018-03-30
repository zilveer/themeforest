<?php 

// get warp    
$warp = require(__DIR__.'/warp.php');   

// load main template file    
echo $warp['template']->render('single-services');
?>