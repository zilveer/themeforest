<?php	
	$last_class = (isset($last) && strcmp($last, 'yes') == 0) ? ' last' : '';
?>

<div class="<?php echo $class.$last_class; ?>">
	<h3><span><?php echo $title; ?></span></h3> 
	<?php echo $content; ?>
</div>