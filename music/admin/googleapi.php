<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<?php 
$gfont = $_GET['data']; 

$gdata = str_replace(" ", "+", $gfont);

echo '<link href="http://fonts.googleapis.com/css?family=' .  $gdata . '" rel="stylesheet" type="text/css">';

echo '<style>body{font-family: "' . $gfont  .  '", sans-serif;}</style>';

?>

<style type="text/css">
  html { height: 100%; background-color:transparent; }
  body { height: 360px; width: 260px; margin: 0px; padding: 0px; background-color:transparent; border: 0px solid #000; overflow: hidden; line-height: 150%; }
</style>
 

</head>
<div id="main">
	<h1>The five boxing wizards jump quickly.</h1>
	<h2>The five boxing wizards jump quickly.</h2>
	<h3>The five boxing wizards jump quickly.</h3>
	<p>The five boxing wizards jump quickly.</p>
	
</div>


</body>
</html>

