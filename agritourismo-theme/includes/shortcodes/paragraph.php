<?php
	
	add_shortcode('double_paragraph', 'double_paragraph_handler');
	add_shortcode('third_paragraph', 'third_paragraph_handler');
	add_shortcode('forth_paragraph', 'forth_paragraph_handler');
	add_shortcode('paragraph_left', 'paragraph_left_handler');
	add_shortcode('paragraph_right', 'paragraph_right_handler');

	add_shortcode('row', 'row_handler');


	function double_paragraph_handler($atts, $content=null, $code="") {
		$return = '<div class="column6">'.do_shortcode($content).'</div>';
		return $return;
	}
	
	function third_paragraph_handler($atts, $content=null, $code="") {
		$return = '<div class="column4">'.do_shortcode($content).'</div>';
		return $return;
	}	
		
	function forth_paragraph_handler($atts, $content=null, $code="") {
		$return = '<div class="column3">'.do_shortcode($content).'</div>';
		return $return;
	}	
	
	function paragraph_left_handler($atts, $content=null, $code="") {
		$return = '<div class="column8">'.do_shortcode($content).'</div>';
		return $return;
	}	

	function paragraph_right_handler($atts, $content=null, $code="") {
		$return = '<div class="column8">'.do_shortcode($content).'</div>';
		return $return;
	}
	

	function row_handler($atts, $content=null, $code="") {
		$return = '<div class="paragraph-row">'.do_shortcode($content).'</div>';
		return $return;
	}	


?>
