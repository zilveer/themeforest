<?php
	$path = dirname(__FILE__);
	$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
	$abspath = ($os === "win") ? substr($path, 0, strpos($path, "\wp-content"))."\wp-load.php" : substr($path, 0, strpos($path, "/wp-content"))."/wp-load.php";
	require_once($abspath);
	
	global $wpdb;
	if (isset($_GET['xmlPath'])){
		$handle = fopen($_GET['xmlPath'], "r");
		$xml = stream_get_contents($handle);
		fclose($handle);
		$contents = json_decode(json_encode((array)simplexml_load_string($xml)),1);
		$des_styletemplates = array();
		foreach($contents['option'] as $opt){
    		update_option($opt['id'], $opt['value']);
			if (substr($opt['id'], 0, 12) === "des_template"){
				array_push($des_styletemplates, $opt['id']);
			}
		}
		update_option("des_styletemplates", $des_styletemplates);
	}

?>