<?php 
	// Prevent the direct loading
	
	if(!empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php') {
		die(__('You cannot access this file', ET_DOMAIN));
	}

	et_load_template('comments');
?>