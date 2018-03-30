<?php
	add_shortcode('tabs', 'tabs_handler');
	function tabs_handler($atts, $content=null, $code="") {		
        $return =  '<div class="tab-container"><ul class="tabs">';		$title = array();		
		for($i=1; $i<=5; $i++) {			if(!isset($atts['title'.$i]) || $atts['title'.$i]=="") break;
			$title[$i] = $atts['title'.$i];
			if($title) $return.='<li class="tab"><a href="#tabs-'.str_replace(" ", "", $title[$i]).'-'.$i.'">'.do_shortcode($title[$i]).'</a></li>';
		}
		$return.= '</ul><div class="panel-container">';
		for($i=1; $i<=5; $i++) {			if(!isset($atts['text'.$i]) || $atts['text'.$i]=="") break;
			$text = $atts['text'.$i];
			if($text) $return.=  '<div id="tabs-'.str_replace(" ", "", $title[$i]).'-'.$i.'"><p>'.do_shortcode($text).'</p></div>';
		}
        $return.=  '</div></div>';
		return $return;
	}
?>