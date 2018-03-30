<?php
	add_shortcode('pricing', 'pricing_handler');

	function pricing_handler($atts, $content=null, $code="") {
		
		/* tooltip */
		$tooltip = $atts["tooltip"];		
		/* title */
		$title = $atts["title"];
		/* price */
		$price = $atts["price"];
		/* text */
		$btnText = $atts["btntext"];
		/* subtitle */
		$subtitle = $atts["subtitle"];
		/* color */
		$color = $atts["color"];
		/* url */
		if(isset($atts["url"])) {
			$url_i = $atts["url"];
		} else {
			$url_i = "#";
		}
		/* Target */
		$target=$atts["target"];
		if(!isset($atts["target"]) || $atts["target"]=="blank") {
			$target="_blank";
		} else {
			$target="self";
		}
		
		$content = explode(",", $content);
		$count = count($content);
		$i=1;
		$return = '<div class="one-third column tooltip" title="'.$tooltip.'">';
			$return.= '<div class="pricing-table">';
				$return.= '<h3>'.$title.'</h3>';
				$return.= '<div class="price-amount">';
					$return.= '<strong>'.$price.'</strong>';
					$return.= '<span>'.$subtitle.'</span>';
				$return.= '</div>';
				$return.= '<ul>';
				foreach($content as $feature) {
					if ($i==$count) break;
					$return.="<li>".$feature."</li>";
					$i++;
				}
				$return.='</ul>';
				if($btnText) {
					$return.= '<a href="'.$url_i.'" class="button '.$color.'-btn gloss-btn"><i class="icon-ok"></i>'.$btnText.'</a>';
				}
			$return.= '</div>';
        $return.= '</div>';
		return $return;
	}

	
	
	
?>