<?php
	$selector = 'audio_instance_' . THB_Shortcode::$instance_number;
?>

<div class="thb-audio-wrapper <?php echo implode(' ', $class); ?>">
	<audio width="100%" height="100%" class="thb-audio mejs-thb" id="<?php echo $selector; ?>" src="<?php echo $src; ?>" controls="controls" preload="none" />
</div>