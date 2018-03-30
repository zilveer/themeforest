<?php
require_once '../../../../wp-load.php';

		$cs_like_counter = get_post_meta( $_POST['post_id'] , "cs_like_counter", true);
			if ( !isset($_COOKIE["cs_like_counter".$_POST['post_id'] ]) ){
				setcookie("cs_like_counter".$_POST['post_id'], 'true', time()+86400, '/');
				update_post_meta( $_POST['post_id'], 'cs_like_counter', $cs_like_counter+1 );
			}
		$cs_like_counter = get_post_meta($_POST['post_id'], "cs_like_counter", true);
		if ( !isset($cs_like_counter) or empty($cs_like_counter) ) $cs_like_counter = 0;
	echo $cs_like_counter;

?>