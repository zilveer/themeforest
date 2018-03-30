<?php
#
#   RT-Framework Font Viewer v1.1
#   
?>

<?php

$font_file=$font_system=$font_face=$font_family=$family_name="";

if(isset($_GET['font_face'])) $font_face=$_GET['font_face']; 
if(isset($_GET['system'])) $font_system=$_GET['system'];  
if(isset($_GET['family_name'])) $family_name=$_GET['family_name'];

if($font_face){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>

<?php 
if($font_system=="google"){
echo "\n".'<link href="http://fonts.googleapis.com/css?family='.$font_face.'" rel="stylesheet" type="text/css">'."\n";
echo '<style type="text/css">#fontdemo {font-family:'.$family_name .';}</style>'."\n";
}

if($font_system=="websafe"){
echo '<style type="text/css">#fontdemo {font-family:'.$family_name .';}</style>'."\n";
}
?>

<style type="text/css" media="all">
#fontdemo{font-size:16px;}
fieldset legend{
	font-size:12px;
	color:#C1C1C1;
	margin:0 10px 0 0;
	background:#fff;
	float:right;
	position:relative;
	top:-14px;
	padding:0 10px;
	
}

fieldset{
	border:1px solid #E9E9E9;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	border-radius: 6px;
	margin:10px 0 0 0;
}

body{
	padding:0;
	margin:0;
}
</style>
</head>

<body class="page"> 
<fieldset><legend>font demo</legend><div id="fontdemo">The quick brown fox jumps over the lazy dog</div> </fieldset>
</body>
</html>
<?php
}
?>