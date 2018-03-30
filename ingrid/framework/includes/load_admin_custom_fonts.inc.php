<?php
error_reporting(0);
header('Content-Type: text/css');


if(!empty($_GET['fonts'])){
	$expfonts = explode(',',$_GET['fonts']);
	foreach($expfonts as $font){
		$font = str_replace(' ','+',$font);
		print '@import url(http://fonts.googleapis.com/css?family='.$font.');	
';	
	}	
	
	foreach($expfonts as $font){
		$fontx = strtolower(str_replace(' ','_',$font));
		print '
#preview-'.$fontx.'{
	font-family: \''.$font.'\',sans;
	font-weight: normal;
    font-style: normal;
}
';

	}
}
?>