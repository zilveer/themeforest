<?php
/**
 * custom field
 */
?>

<?php
	$default = wpml_default(wpml_get_option($id), $default);
	$layout = !(isset($layout) && $layout == false);
	
	if($layout):
	?>
		<div class="wpv-config-row">
			<h4><?php echo $name?></h4>
			
			<p class="description"><?php echo $desc?></p>
			
			<div class="content">
	<?php
	endif; 

	if(isset($function) && function_exists($function))
		$function($value, $default);
	else
		echo $html;
	
	if($layout): ?>
					
		</div>
	</div>
<?php endif; ?>
	
