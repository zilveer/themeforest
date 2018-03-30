<?php

function  process_shortcode($attributes, $content)
{

extract( shortcode_atts( array(
	
	
	
	'proc_title'=>'','proc_text'=>'','proc_icon'=>'', 
	
	
	
	), $attributes ) );
ob_start();	
?><div class="our-process-item">
<i class="<?php echo $proc_icon; ?>"></i>
<div class="our-process-content">
<h5><?php echo $proc_title; ?></h5>
<p><?php echo $proc_text; ?></p>
</div>
</div><?php

	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode("process", 'process_shortcode');


?>