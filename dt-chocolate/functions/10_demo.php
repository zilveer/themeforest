<?php

function get_demo_option($p)
{
   if (!isset($_SESSION)) @session_start();
   $options = get_option(LANGUAGE_ZONE.'_theme_options');
   
   if (!DEMO)
   {
      if ( !isset($options[$p]) )
        return "";
      return $options[$p];
   }
   
   if ( isset($_SESSION[$p]) )
      return $_SESSION[$p];
   
   return $options[$p];
}

// remember that demo is opened
if ( isset($_POST['set_cust_shown']) )
{
   @session_start();
   ob_get_clean();
   $_SESSION['cust_shown'] = intval($_POST['set_cust_shown']);
   exit;
}

$demo_options = explode(" ", "bgcolor1 bg1 bg2 font bg1_center bg1_fixed bg1_repeat_x bg1_repeat_y bg2_center bg2_fixed bg2_repeat_x bg2_repeat_y");

// reset settings
if ( isset($_GET["action"]) ) 
if ( $_GET["action"] == "reset" && $_GET["from"] )
{
   @session_start();
   foreach ($demo_options as $opt)
      unset($_SESSION[$opt]);
   unset($_SESSION['is_custom']);
   unset($_SESSION['cust_shown']);
   @Header("Location: ".$_GET["from"]);
   exit;
}

// set settings
if ( isset($_GET["action"]) ) 
if ($_GET["action"] == "set_params" && $_GET["from"])
{
	@session_start();
	
	foreach ($demo_options as $opt) {
		if( !isset($_POST[$opt]) ) continue;
		$_SESSION[$opt] = $_POST[$opt];
	}
	
	foreach ($demo_options as $opt)
		if( empty($_POST[$opt]) )
			$_SESSION[$opt] = 0;
   $_SESSION["is_custom"] = 1;
   $_SESSION["cust_shown"] = $_POST["cust_shown"];
   //print_r($_POST); exit;
   @Header("Location: ".$_GET["from"]);
   exit;
}


?>
