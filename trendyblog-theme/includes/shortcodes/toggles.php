<?php
	add_shortcode('toggles', 'toggles_handler');
	
	function toggles_handler($atts, $content=null, $code="") {
		
			$return =  '		
				<div class="accordion_content">
					<h4 class="accordion_content_title">'.$atts["title"].'</h4>
					<div class="accordion_content_inner">
						'.do_shortcode(wpautop($content)).'
					</div>
				</div>
				';

		return $return;
	}
	
?>