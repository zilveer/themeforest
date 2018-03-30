<?php
/////////////////////////////////////////////////////
// READ SONG INFORMATION
// SHOUTCAST 1 & 2
// ICECAST 1 & 2
// own songtitleURL
// http://native.flashradio.info
//
// Copyright (C) SODAH | JOERG KRUEGER 
// http://www.sodah.de
/////////////////////////////////////////////////////
error_reporting(0);
header('Content-type: text/plain');
header('Pragma: public'); 
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');                  
header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0');
header('Pragma: no-cache'); 
header('Expires: 0'); 

if (isset($_GET['url'])):
	$url = $_GET['url'];
	if ($url == ""):
		echo "";
	else:
		echo utf8_encode(htmlentities(html_entity_decode(shoutcast1($url)), ENT_QUOTES,"ISO-8859-1"));
	endif;
endif;

if (isset($_GET['ownurl'])):
	$url = $_GET['ownurl'];
	if ($url == ""):
		echo "";
	else:
		echo utf8_encode(htmlentities(html_entity_decode(ownsongtitleURL($url)), ENT_QUOTES,"ISO-8859-1"));
	endif;
endif;

function ownsongtitleURL($sURL) {
	$aPathInfo = parse_url($sURL);
	$sHost = $aPathInfo['host'];
	$sPort = empty($aPathInfo['port']) ? 80 : $sPort = $aPathInfo['port'];
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $sURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_PORT, $sPort);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
    curl_setopt($ch, CURLOPT_TIMEOUT, 2); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla");
    $info = curl_exec($ch); 
    curl_close($ch);
	return $info;
}

function shoutcast1($sURL) {
	$aPathInfo = parse_url($sURL);
	$sHost = $aPathInfo['host'];
	$sPort = empty($aPathInfo['port']) ? 80 : $sPort = $aPathInfo['port'];
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://". $sHost . "/7.html");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_PORT, $sPort);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
    curl_setopt($ch, CURLOPT_TIMEOUT, 2); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla");
    $info = curl_exec($ch); 
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if($httpCode == 404) {
	    return icecast2($sURL);
	}
    curl_close($ch);
    $info = str_replace('<HTML><meta http-equiv="Pragma" content="no-cache"></head><body>', "", $info);
	$info = str_replace('</body></html>', "", $info);
	$stats = explode(',', $info);

	if (empty($stats[1])):
		return icecast2($sURL);
	else:
		if ($stats[1] == "1"):
			return $stats[6];
		else:
			return icecast2($sURL);
		endif;
	endif;
}

function icecast2($sURL) {
	$aPathInfo = parse_url($sURL);
	$sHost = $aPathInfo['host'];
	$sPort = empty($aPathInfo['port']) ? 80 : $sPort = $aPathInfo['port'];
	$sPath = empty($aPathInfo['path']) ? '/' : $sPath = $aPathInfo['path'];
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "http://". $sHost . "/status.xsl?mount=".$sPath); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_PORT, $sPort);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
    curl_setopt($ch, CURLOPT_TIMEOUT, 2); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla");
    $info = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if($httpCode == 404) {
	    return shoutcast2($sURL);
	}
    curl_close($ch);
    $info = strip_tags($info);
    $stats = explode('Currently playing:', $info);
    if (count($stats) > 1):
    	$songtitle = explode("<br />", nl2br($stats[1]));  
    	return $songtitle[0];
	 else:
		return shoutcast2($sURL);
	endif;
}

function shoutcast2($sURL) {
	$aPathInfo = parse_url($sURL);
	$sHost = $aPathInfo['host'];
	$sPort = empty($aPathInfo['port']) ? 80 : $sPort = $aPathInfo['port'];
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "http://". $sHost . "/currentsong?sid=1"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_PORT, $sPort);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
    curl_setopt($ch, CURLOPT_TIMEOUT, 2); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla");
    $info = curl_exec($ch); 
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if($httpCode == 404) {
	    return readmeta($sURL);
	}
    curl_close($ch);
    $info = strip_tags($info);
	return $info;
}



function readmeta($sURL){
	$aPathInfo = parse_url($sURL);
	$sHost = $aPathInfo['host'];
	$sPort = empty($aPathInfo['port']) ? 80 : $sPort = $aPathInfo['port'];
	$sPath = empty($aPathInfo['path']) ? '/' : $sPath = $aPathInfo['path'];
	$fp = fsockopen($sHost, $sPort, $errno, $errstr);
	if (!$fp):
		return "";
	else: 
		fputs($fp, "GET $sPath HTTP/1.0\r\n");
		fputs($fp, "Host: $sHost\r\n");
		fputs($fp, "Accept: */*\r\n");
		fputs($fp, "Icy-MetaData:1\r\n");
		fputs($fp, "Connection: close\r\n\r\n");
		$char = "";
		$info = "";
		while ($char != Chr(255)){	//END OF MPEG-HEADER
			if (@feof($fp) || @ftell($fp)>14096){ 
			    exit;
			}
			$char = @fread($fp,1);
			$info .= $char;
		}
		fclose($fp);
		$info = str_replace("\n", "",$info);
		$info = str_replace("\r", "",$info);
		$info = str_replace("\n\r", "",$info);
		$info = str_replace("<BR>", "",$info);
		$info = str_replace(":", "=",$info);
		$info = str_replace("icy", "&icy",$info);
		$info = strtolower($info);
		parse_str($info, $output);
		if ($output['icy-br']!=""){
			$streambitrate = intval($output['icy-br']);
		}
		if ($output['icy-name']==""){
			return "";	
		} else {
			return utf8_encode($output['icy-name']);
		}
	endif;
}
?>