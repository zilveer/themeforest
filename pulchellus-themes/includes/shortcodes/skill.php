<?php
	add_shortcode('skill', 'skill_handler');
	function skill_handler($atts, $content=null, $code="") {		
        $return =  '<div id="skill-bars">';		$title = array();		
		for($i=1; $i<=50; $i++) {			if(!isset($atts['title'.$i]) || $atts['title'.$i]=="") break;			$return.='<div class="skill-bar">';				$return.='<div class="skill-bar-content" style="width: '.intval($atts['level'.$i]).'%;"></div>';				$return.='<div class="skill-bar-title">'.intval($atts['level'.$i]).'% '.$atts['title'.$i].'</div>';			$return.=  '</div>';
		}
        $return.=  '</div>';
		return $return;
	}
?>