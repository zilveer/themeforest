<?php
	add_shortcode('df-subtitle', 'df_subtitle');

	function df_subtitle($atts, $content=null, $code="") {

		return '<div class="head_title"><h2>'.$content.'</h2></div>';
	
	}
?>
