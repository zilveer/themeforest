<?php
	add_shortcode('wraper', 'wraper_handler');
	add_shortcode('pricing', 'pricing_handler');
	
	function wraper_handler($atts, $content=null, $code="") {

		$return =  '<div class="paragraph-row price-grid">';
			$return.=	do_shortcode($content);
		$return.=  '</div>';


		return $return;
	}	
	function pricing_handler($atts, $content=null, $code="") {
		extract(shortcode_atts(array('active' => null,'title' => null,'color' => null,'price' => null,'currency' => null,'period' => null,'btntext' => null,'url' => null, 'list' => null), $atts) );
		if($active=="yes") {
			$tableClass = " highlighted";
			$style = 'style="box-shadow: 0px 0px 0px 3px #'.$color.';"';
		} else {
			$tableClass = null;
			$style = null;
		}
		/* Target */
		$target=$atts["target"];
		if(!isset($atts["target"]) || $atts["target"]=="blank") {
			$target="_blank";
		} else {
			$target="_self";
		}	

		$list = explode(";", $list);

		$return = '<div class="column3">';
			$return.= '<div class="price-block'.$tableClass.'" '.$style.'>';
				$return.= '<div class="price-color" style="background-color: #'.$color.';">';
					$return.= '<h3>'.$title.'</h3>';
					$return.= '<div class="price">';
						$return.= $currency.$price;
						$return.= '<small>/'.$period.'</small>';
					$return.= '</div>';
				$return.= '</div>';
				$return.= '<ul>';
					foreach ($list as $value) {
						$return.= '<li>'.stripslashes($value).'</li>';
					} 
				$return.= '</ul>';
				if($btntext) {
					$return.= '<a href="'.$url.'" class="price-button" target="'.$target.'" style="background-color: #'.$color.';">'.$btntext.'</a>';
				}
				
			$return.= '</div>';
		$return.= '</div>';


		return $return;
	}
	
?>