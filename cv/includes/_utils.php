<?php
$ERROR_MSG = $SUCCESS_MSG = $NOTICE_MSG = '';

function getErrorMsg() {
	return $GLOBALS['ERROR_MSG'];
}
function setErrorMsg($msg) {
	$GLOBALS['ERROR_MSG'] = ($GLOBALS['ERROR_MSG']=='' ? '' : '<br />').$msg;
}
function getSuccessMsg() {
	return $GLOBALS['SUCCESS_MSG'];
}
function setSuccessMsg($msg) {
	$GLOBALS['SUCCESS_MSG'] = ($GLOBALS['SUCCESS_MSG']=='' ? '' : '<br />').$msg;
}
function getNoticeMsg() {
	return $GLOBALS['NOTICE_MSG'];
}
function setNoticeMsg($msg) {
	$GLOBALS['NOTICE_MSG'] = ($GLOBALS['NOTICE_MSG']=='' ? '' : '<br />').$msg;
}




/* ========================= Parameters section ============================== */

// Get GET, POST, SESSION value and save it (if need)
function getValueGPS($name, $defa='', $page='') {
global $_GET, $_POST, $_SESSION;
	$putToSession = $page!='';
	$rez = $defa;
	if (isset($_GET[$name])) {
		$rez = stripslashes(trim($_GET[$name]));
	} else if (isset($_POST[$name])) {
		$rez = stripslashes(trim($_POST[$name]));
	} else if (isset($_SESSION[$name.($page!='' ? '_'.$page : '')])) {
		$rez = stripslashes(trim($_SESSION[$name.($page!='' ? '_'.$page : '')]));
		$putToSession = false;
	}
	if ($putToSession)
		setValueToSession($name, $rez, $page);
	return $rez;
}

// Get GET, POST, COOKIE value and save it (if need)
function getValueGPC($name, $defa='', $page='', $exp=0) {
global $_GET, $_POST, $_COOKIE;
	$putToCookie = $page!='';
	$rez = $defa;
	if (isset($_GET[$name])) {
		$rez = stripslashes(trim($_GET[$name]));
	} else if (isset($_POST[$name])) {
		$rez = stripslashes(trim($_POST[$name]));
	} else if (isset($_COOKIE[$name.($page!='' ? '_'.$page : '')])) {
		$rez = stripslashes(trim($_COOKIE[$name.($page!='' ? '_'.$page : '')]));
		$putToCookie = false;
	}
	if ($putToCookie)
		setcookie($name.($page!='' ? '_'.$page : ''), $rez, $exp, '/');
	return $rez;
}

//  Save value into session
function setValueToSession($name, $value, $page='') {
global $_SESSION;
	$_SESSION[$name.($page!='' ? '_'.$page : '')] = $value;
}







/* ========================= INI-files utilities section ============================== */

//  Get value by name from .ini-file
function getIniValue($file, $name, $defa='') {
	if (!is_array($file)) {
		if (file_exists($file))
			$file = file($file);
		else
			return $defa;
	}
	$name = my_strtolower($name);
	$rez = $defa;
	for ($i=0; $i<count($file); $i++) {
		$file[$i] = trim($file[$i]);
		if (($pos = my_strpos($file[$i], ';'))!==false)
			$file[$i] = trim(my_substr($file[$i], 0, $pos));
		$parts = explode('=', $file[$i]);
		if (count($parts)!=2) continue;
		if (my_strtolower(trim(chop($parts[0])))==$name) {
			$rez = trim(chop($parts[1]));
			if (my_substr($rez, 0, 1)=='"')
				$rez = my_substr($rez,1,my_strlen($rez)-2);
			else
				$rez *= 1;
			break;
		}
	}
	return $rez;
}

//  Retrieve all values from .ini-file as assoc array
function getIniValues($file) {
	$rez = array();
	if (!is_array($file)) {
		if (file_exists($file))
			$file = file($file);
		else
			return $rez;
	}
	for ($i=0; $i<count($file); $i++) {
		$file[$i] = trim(chop($file[$i]));
		if (($pos = my_strpos($file[$i], ';'))!==false)
			$file[$i] = trim(my_substr($file[$i], 0, $pos));
		$parts = explode('=', $file[$i]);
		if (count($parts)!=2) continue;
		$key = trim(chop($parts[0]));
		$rez[$key] = trim($parts[1]);
		if (my_substr($rez[$key], 0, 1)=='"')
			$rez[$key] = my_substr($rez[$key],1,my_strlen($rez[$key])-2);
		else
			$rez[$key] *= 1;
	}
	return $rez;
}






/* ========================= Array utilities section ============================== */


//  Return list <option value='id'>name</option> as string from two-dim array
function getComboFromArray($arr, $curID, $name, $js='') {
	$rezList = "<select name=\"$name\" id=\"$name\"".($js!='' ? " $js" : '')." size=\"1\">";
	foreach ($arr as $k=>$v)
		$rezList .= "\n".'<option value="'.$arr[$k]['id'].'"'.($curID==$arr[$k]['id'] ? ' selected>' : '>').HtmlSpecialChars($arr[$k]['name']).'</option>';
	$rezList = $rezList."</select>";
	return $rezList;
}


//  Return 'id' by key from two-dim array
function getArrayIdByKey($curKey, $arr) {
	return (isset($arr[$curKey]) ? $arr[$curKey]['id'] : 0);
}


//  Return key 'name' by key 'id'
function getArrayNameById($curId, $arr) {
	$rez = '';
	foreach ($arr as $k=>$v) {
		if ($arr[$k]['id']==$curId) {
			$rez = $arr[$k]['name'];
			break;
		}
	}
	return $rez;
}





/* ========================= String utilities section ============================== */
define('MULTIBYTE', 'UTF-8');

function my_strlen($text) { return MULTIBYTE ? mb_strlen($text, MULTIBYTE) : strlen($text); }
function my_strpos($text, $char, $from=0) { return MULTIBYTE ? mb_strpos($text, $char, $from, MULTIBYTE) : strpos($text, $char, $from); }
function my_substr($text, $from, $len=-999999) { 
 if ($len==-999999) { 
  if ($from < 0)
   $len = -$from; 
  else
   $len = my_strlen($text)-$from; 
 }
 return  MULTIBYTE ? mb_substr($text, $from, $len, MULTIBYTE) : my_substr($text, $from, $len) ; 
}
function my_strtolower($text) { return  MULTIBYTE ? mb_strtolower($text, MULTIBYTE) : strtolower($text) ; }
function my_strtoupper($text) { return  MULTIBYTE ? mb_strtoupper($text, MULTIBYTE) : strtoupper($text) ; }


// Return part of $str up to $maxlength, appended with $add
function getShortString($str, $maxlength, $add='...') {
//	if ($add && my_substr($add, 0, 1) != ' ')
//		$add .= ' ';
	if ($maxlength < 1 || $maxlength >= my_strlen($str)) 
		return $str;
	$str = my_substr($str, 0, $maxlength - my_strlen($add));
	$ch = my_substr($str, $maxlength - my_strlen($add), 1);
	if ($ch != ' ') {
		for ($i = my_strlen($str) - 1; $i > 0; $i--)
			if (my_substr($str, $i, 1) == ' ') break;
		$str = my_substr($str, 0, $i);
	}
	return $str . $add;
}

// Return Proper String
function strProper($str) {
	$parts = explode(' ', $str);
	$rez = '';
	foreach ($parts as $p) {
		if (trim($p))
			$rez .= ($rez ? ' ' : '') . my_strtoupper(my_substr($p, 0, 1)) . my_strtolower(my_substr($p, 1));
	}
	return $rez;
}





/* ========================= Date utilities section ============================== */

// MySQL -> Date
function SQLToDate($str) {
    return (trim($str)=='' || trim($str)=='0000-00-00' ? '' : trim(my_substr($str,8,2).'.'.my_substr($str,5,2).'.'.my_substr($str,0,4).' '.my_substr($str,11)));
}


//  Date -> MySQL
function DateToSQL($str) {
	if (trim($str)=='') return '';
	$str = strtr(trim($str),'/\-,','....');
	if (trim($str)=='00.00.0000' || trim($str)=='00.00.00') return '';
	$pos = my_strpos($str,'.');
	$d=trim(my_substr($str,0,$pos));
	$str = my_substr($str,$pos+1);
	$pos = my_strpos($str,'.');
	$m=trim(my_substr($str,0,$pos));
	$y=trim(my_substr($str,$pos+1));
	$y=($y<50?$y+2000:($y<1900?$y+1900:$y));
    return ''.$y.'-'.(my_strlen($m)<2?'0':'').$m.'-'.(my_strlen($d)<2?'0':'').$d;
}

// Difference between two dates
function dateDifference($dt1, $dt2=null, $short=true, $sec = false) {
	if ($dt2 == null) $dt2 = time();
	$dt1 = strtotime($dt1);
	$diff = $dt2 - $dt1;
	$days = floor($diff / (24*3600));
	$diff -= $days * 24 * 3600;
	$hours = floor($diff / 3600);
	$diff -= $hours * 3600;
	$min = floor($diff / 60);
	$diff -= $min * 60;
	$rez = '';
	if ($days > 0)
		$rez .= ($rez!='' ? ' ' : '') . $days . ' day' . ($days > 1 ? 's' : '');
	if ((!$short || $rez=='') && $hours > 0)
		$rez .= ($rez!='' ? ' ' : '') . $hours . ' hour' . ($hours > 1 ? 's' : '');
	if ((!$short || $rez=='') && $min > 0)
		$rez .=  ($rez!='' ? ' ' : '') . $min . ' minute' . ($min > 1 ? 's' : '');
	if ($sec || $rez=='')
		$rez .=  $rez!='' || $sec ? (' ' . $diff . ' second' . ($diff > 1 ? 's' : '')) : 'less then minute';
	return $rez;
}




/* ========================= Other section ============================== */

// Return video player URL
function getVideoPlayerURL($url) {
	$prot = is_ssl()? 'https' : 'http'; 
	$url = str_replace(
		array(
			'http://youtu.be/',
			'http://www.youtu.be/',
			'http://youtube.com/watch?v=',
			'http://www.youtube.com/watch?v=',
			'http://vimeo.com/',
			'http://www.vimeo.com/'
		),
		array(
			$prot.'://youtube.com/embed/',
			$prot.'://youtube.com/embed/',
			$prot.'://youtube.com/embed/',
			$prot.'://youtube.com/embed/',
			$prot.'://player.vimeo.com/video/',
			$prot.'://player.vimeo.com/video/'
		),
		trim(chop($url)));
	return $url;
}


//  Cache disable
function NoCache() {
	Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	Header("Cache-Control: no-cache, must-revalidate");
	Header("Pragma: no-cache");
	Header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
}
?>