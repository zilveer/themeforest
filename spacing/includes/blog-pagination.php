<?php
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_newer_posts = $of_option[$prefix.'tr_newer_posts'];
	$tr_older_posts = $of_option[$prefix.'tr_older_posts'];
}else{			
	$tr_newer_posts = __('Newer Posts', 'spacing');
	$tr_older_posts = __('Older Posts', 'spacing');
}
?>

