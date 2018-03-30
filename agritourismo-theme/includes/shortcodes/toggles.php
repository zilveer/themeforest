<?php
	add_shortcode('toggles', 'toggles_handler');
	
	function toggles_handler($atts, $content=null, $code="") {
		
			$return =  '		
				<div class="accordion">
					<div>
						<a href="#">'.$atts["title"].'</a>
						<div>
							'.do_shortcode(wpautop($content)).'
						</div>
					</div>
				</div>
				';

		return $return;
	}
	
?>