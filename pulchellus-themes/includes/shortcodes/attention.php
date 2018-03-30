<?php
	add_shortcode('attention', 'attention_handler');

	function attention_handler($atts, $content=null, $code="") {
		/* Target */
		if(!isset($atts["target"]) || $atts["target"]=="blank") {
			$target="_blank";
		} else {
			$target="_self";
		}

		/* link */
		if(isset($atts["link"])) {
			$link = $atts["link"];
		} else {
			$link = "#";
		}
		
		/* align */
		if(isset($atts["align"]) && $atts["align"]=="center") {
			$align = " text-center";
		} else {
			$align = false;
		}
		
		$return =  '<div class="attention-unit'.$align.'">';
		if($atts["title"]) $return.=  ' <h3>'.$atts["title"].'</h3>';
		$return.=  "<p>".do_shortcode($content)."</p>";
		if($atts["button"]) $return.=  '<p><a href="'.$link.'" target="'.$target.'" class="button">'.$atts["button"].'</a></p>';
		$return.=  '</div>';

		return $return;
	}
?>
