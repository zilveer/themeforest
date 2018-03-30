<?php require_once( '../../../../../wp-load.php' ); ?>
<?php 
$cryptinstall=TEMPLATEPATH."/scripts/crypt/cryptographp.fct.php";
include $cryptinstall; 
?>


<?php
	$captcha = $_GET['captcha'];
  if (chk_crypt($captcha)) {
	  echo "ok";	  
  } else {
	  echo "no";
  }
?>

