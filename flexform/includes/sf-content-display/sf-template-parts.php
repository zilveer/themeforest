<?php
	/*
	*
	*	Template Parts
	*	------------------------------------------------
	*	Swift Framework v1.0
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
 	/* BREADCRUMBS
 	================================================== */ 
	function sf_breadcrumbs() {
		$breadcrumb_output = "";
		
		if ( function_exists('bcn_display') ) {
			$breadcrumb_output .= '<div class="breadcrumbs-wrap row"><div id="breadcrumbs" class="span12 alt-bg">';
			$breadcrumb_output .= bcn_display(true);
			$breadcrumb_output .= '</div></div>';
		} else if ( function_exists('yoast_breadcrumb') ) {
			$breadcrumb_output .= '<div class="breadcrumbs-wrap row"><div id="breadcrumbs" class="span12 alt-bg">';
			$breadcrumb_output .= yoast_breadcrumb("","",false);
			$breadcrumb_output .= '</div></div>';
		}
		
		return $breadcrumb_output;
	}
	
?>