<?php

$_GET = array_map('strip_tags', $_GET);

if (isset($_GET['file']))
	$file = $_GET['file'];
else
	die;

$wp_load = dirname(__FILE__);
 
for ($i = 0; $i < 8; $i++) {
	$wp_load = dirname($wp_load);
	if (file_exists($wp_load . '/wp-load.php')) break;
	if ($i == 7) { 
	    echo 'Error: wp-load.php doesn\'t exists';
		die();
	}
}

require_once($wp_load . '/wp-load.php');

global $r_option;

$link = $file;
$link = parse_url($link);
$link = $link['path'];
$link = strstr($link, 'wp-content');
$link =  ABSPATH . $link;

//First, see if the file exists
if (!file_exists($link)) {
	die ("$file <br/> <b>404 File not found!</b>") ;
}
$file = $link;
$file_length = filesize ($file) ;
$filename = basename ($file) ;
$file_extension = strtolower (substr (strrchr ($filename, '.'), 1)) ;
$file_modified = filemtime ($file) ;

//This will set the Content-Type to the appropriate setting for the file
switch ($file_extension)
{
case 'kmz':
	$content_type = 'application/vnd.google-earth.kmz' ;
	break ;
case 'kml':
	$content_type = 'application/vnd.google-earth.kml+xml' ;
	break ;
case 'pdf':
	$content_type = 'application/pdf' ;
	break ;
case 'exe':
	$content_type = 'application/octet-stream' ;
	break ;
case 'zip':
	$content_type = 'application/zip' ;
	break ;
case 'doc':
	$content_type = 'application/msword' ;
	break ;
case 'xls':
	$content_type = 'application/vnd.ms-excel' ;
	break ;
case 'ppt':
	$content_type = 'application/vnd.ms-powerpoint' ;
	break ;
case 'gif':
	$content_type = 'image/gif' ;
	break ;
case 'png':
	$content_type = 'image/png' ;
	break ;
case 'jpeg':
case 'jpg':
	$content_type = 'image/jpg' ;
	break ;
case 'mp3':
	$content_type = 'audio/mpeg' ;
	break ;
case 'wav':
	$content_type = 'audio/x-wav' ;
	break ;
case 'mpeg':
case 'mpg':
case 'mpe':
	$content_type = 'video/mpeg' ;
	break ;
case 'mov':
	$content_type = 'video/quicktime' ;
	break ;
case 'avi':
	$content_type = 'video/x-msvideo' ;
	break ;

//The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
case 'php':
case 'htm':
case 'html':
case 'txt':
	die ('<b>Cannot be used for '. $file_extension .' files!</b>') ;
	break;
default:
	$content_type = 'application/force-download' ;
}


switch ($file_extension)
{
case 'kmz':
case 'kml':
	header ('Last-Modified: ' . gmdate ('D, d M Y H:i:s \G\M\T', $file_modified));
	header ('Content-Length: ' . $file_length) ;
	header ('Content-Type: ' . $content_type) ;
	break ;

default:
	//Begin writing headers
	header ('Pragma: public') ;
	header ('Expires: 0') ;
	header ('Cache-Control: must-revalidate, post-check=0, pre-check=0') ;
	header ('Cache-Control: public') ;
	header ('Content-Description: File Transfer') ;

	//Use the switch-generated Content-Type
	header ('Content-Type: ' . $content_type) ;

	//Force the download - set the headers
	header ('Content-Disposition: attachment; filename=' . $filename . ';') ;
	header ('Content-Transfer-Encoding: binary') ;
	header ('Content-Length: ' . $file_length) ;
}

//Now read the file and exit
@readfile ($file) ;
exit ;
