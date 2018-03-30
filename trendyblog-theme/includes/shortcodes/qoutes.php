<?php
	add_shortcode('blockquote', 'blockquote_handler');

	function blockquote_handler($atts, $content=null, $code="") {

		$return =  '<blockquote><p><span>"</span>';
			$return.=  $content;
		$return.=  '<span>"</span></p>';
		$return.=  '<footer>'.$atts['author'].'</footer>';
		$return.=  '</blockquote>';

		return $return;
	}
?>